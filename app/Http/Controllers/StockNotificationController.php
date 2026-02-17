<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockNotification;

class StockNotificationController extends Controller
{
    public function subscribe(Request $request, Product $product)
    {
        $request->validate([
            'email' => 'required|email:rfc,dns',
        ]);
        
        // Check if product is in stock
        if ($product->stock > 0) {
            return back()->with('error', 'This product is currently in stock.');
        }
        
        // Check if already subscribed
        $existing = StockNotification::where('product_id', $product->id)
            ->where('email', $request->email)
            ->whereNull('notified_at')
            ->first();
        
        if ($existing) {
            return back()->with('info', 'You are already subscribed to notifications for this product.');
        }
        
        // Create notification
        StockNotification::create([
            'product_id' => $product->id,
            'email' => $request->email,
        ]);
        
        return back()->with('success', 'You will be notified when this product is back in stock!');
    }
    
    public function unsubscribe($token)
    {
        $notification = StockNotification::where('token', $token)->firstOrFail();
        $notification->delete();
        
        return view('stock-notifications.unsubscribe');
    }
}
