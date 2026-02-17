<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product && $product->is_active) {
                $item['product'] = $product;
                $item['subtotal'] = $product->final_price * $item['quantity'];
                $total += $item['subtotal'];
                $cartItems[$id] = $item;
            }
        }

        return view('cart.index', compact('cartItems', 'total'));
    }

    /**
     * Add product to cart.
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active || !$product->inStock()) {
            return back()->with('error', 'Product is not available.');
        }

        $cart = Session::get('cart', []);
        $cartKey = $request->product_id;

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $request->quantity;
        } else {
            $cart[$cartKey] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->final_price,
                'quantity' => $request->quantity,
                'size' => $request->size,
                'color' => $request->color,
                'image' => $product->main_image,
            ];
        }

        Session::put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            Session::put('cart', $cart);
            return back()->with('success', 'Cart updated successfully!');
        }

        return back()->with('error', 'Item not found in cart.');
    }

    /**
     * Remove item from cart.
     */
    public function remove($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
            return back()->with('success', 'Item removed from cart.');
        }

        return back()->with('error', 'Item not found in cart.');
    }

    /**
     * Clear entire cart.
     */
    public function clear()
    {
        Session::forget('cart');
        return back()->with('success', 'Cart cleared successfully!');
    }

    /**
     * Get cart count (for AJAX).
     */
    public function count()
    {
        $cart = Session::get('cart', []);
        $count = array_sum(array_column($cart, 'quantity'));
        return response()->json(['count' => $count]);
    }
}
