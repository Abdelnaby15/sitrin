<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display orders list.
     */
    public function index(Request $request)
    {
        $query = Order::with('user', 'items');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display order details.
     */
    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled',
        ]);
        
        $oldStatus = $order->status;
        $order->update(['status' => $request->status]);
        
        ActivityLog::log('updated', "Updated order #{$order->order_number} status", $order, [
            'old_status' => $oldStatus,
            'new_status' => $request->status,
        ]);

        return back()->with('success', 'Order status updated successfully!');
    }

    /**
     * Update payment status.
     */
    public function updatePaymentStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:pending,paid,failed',
        ]);
        
        $oldStatus = $order->payment_status;
        $order->update(['payment_status' => $request->payment_status]);
        
        ActivityLog::log('updated', "Updated order #{$order->order_number} payment status", $order, [
            'old_payment_status' => $oldStatus,
            'new_payment_status' => $request->payment_status,
        ]);

        return back()->with('success', 'Payment status updated successfully!');
    }
}
