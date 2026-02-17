<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display checkout page.
     */
    public function index()
    {
        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartItems = [];
        $subtotal = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product && $product->is_active) {
                $item['product'] = $product;
                $item['subtotal'] = $product->final_price * $item['quantity'];
                $subtotal += $item['subtotal'];
                $cartItems[$id] = $item;
            }
        }

        $shippingCost = 50; // Fixed shipping cost (can be dynamic)
        $total = $subtotal + $shippingCost;

        return view('checkout.index', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    /**
     * Process checkout and create order.
     */
    public function process(Request $request)
    {
        // Honeypot check - if filled, it's a bot
        if ($request->filled('website')) {
            return back()->with('error', 'Invalid submission detected.');
        }
        
        $request->validate([
            'shipping_name' => 'required|string|min:3|max:255|regex:/^[a-zA-Z\s]+$/',
            'shipping_email' => 'required|email:rfc',
            'shipping_phone' => ['required', 'regex:/^(\+20|0)?1[0125]\d{8}$/'],
            'shipping_address' => 'required|string|min:10|max:500',
            'shipping_city' => 'required|string',
            'shipping_country' => 'required|string|max:100',
            'payment_method' => 'required|in:cash_on_delivery,instapay_on_delivery',
            'shipping_postal_code' => 'nullable|string|max:10',
            'notes' => 'nullable|string|max:1000',
        ], [
            'shipping_name.required' => 'Full name is required.',
            'shipping_name.min' => 'Name must be at least 3 characters.',
            'shipping_name.regex' => 'Name should contain only letters and spaces.',
            'shipping_email.required' => 'Email address is required.',
            'shipping_email.email' => 'Please enter a valid email address.',
            'shipping_phone.required' => 'Phone number is required.',
            'shipping_phone.regex' => 'Please enter a valid Egyptian mobile number (e.g., 01012345678 or +201012345678).',
            'shipping_address.required' => 'Street address is required.',
            'shipping_address.min' => 'Please provide a detailed address (at least 10 characters).',
            'shipping_city.required' => 'City is required.',
            'payment_method.required' => 'Please select a payment method.',
        ]);

        $cart = Session::get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        try {
            DB::beginTransaction();

            $subtotal = 0;
            foreach ($cart as $id => $item) {
                $product = Product::find($id);
                if ($product) {
                    $subtotal += $product->final_price * $item['quantity'];
                }
            }

            $shippingCost = 50;
            $total = $subtotal + $shippingCost;

            // Create order
            $order = Order::create([
                'user_id' => Auth::id() ?? null,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_country' => $request->shipping_country,
                'shipping_postal_code' => $request->shipping_postal_code,
                'notes' => $request->notes,
            ]);

            // Create order items
            foreach ($cart as $id => $item) {
                $product = Product::where('id', $id)->lockForUpdate()->first();
                if ($product) {
                    // Check stock availability
                    if ($product->stock < $item['quantity']) {
                        DB::rollBack();
                        return back()->with('error', "Insufficient stock for {$product->name}");
                    }
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'price' => $product->final_price,
                        'quantity' => $item['quantity'],
                        'size' => $item['size'] ?? null,
                        'color' => $item['color'] ?? null,
                        'subtotal' => $product->final_price * $item['quantity'],
                    ]);

                    // Decrease stock
                    $product->decrement('stock', $item['quantity']);
                }
            }

            DB::commit();

            // Send order confirmation email
            try {
                \Mail::to($order->shipping_email)->send(new \App\Mail\OrderConfirmation($order));
            } catch (\Exception $e) {
                // Log email error but don't stop the order process
                \Log::error('Order confirmation email failed: ' . $e->getMessage());
            }

            // Clear cart
            Session::forget('cart');
            
            // Redirect with token for guest orders
            $successUrl = route('checkout.success', $order->id);
            if (!Auth::check() && $order->order_token) {
                $successUrl .= '?token=' . $order->order_token;
            }

            return redirect($successUrl)
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Display order success page.
     */
    public function success($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        // If user is logged in, verify order belongs to them
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        }
        
        // For guest orders, verify token
        if (!Auth::check() && $order->order_token) {
            $token = request()->query('token');
            if (!$token || !hash_equals($order->order_token, $token)) {
                abort(403, 'Invalid order token');
            }
        }

        return view('checkout.success', compact('order'));
    }

    /**
     * Track order status (public method).
     */
    public function track($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId);

        // If user is logged in, verify order belongs to them
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this order.');
        }
        
        // For guest orders, verify token from URL or session
        if (!Auth::check()) {
            $token = request()->query('token') ?? session('order_token_' . $orderId);
            
            if ($order->order_token) {
                if (!$token || !hash_equals($order->order_token, $token)) {
                    abort(403, 'Invalid order access token.');
                }
                
                // Store token in session for this order
                session(['order_token_' . $orderId => $token]);
            }
        }

        return view('orders.track', compact('order'));
    }
}
