<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display admin dashboard.
     */
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_products' => Product::count(),
            'total_users' => User::where('is_admin', false)->count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
        ];

        $recentOrders = Order::with('user', 'items')
            ->latest()
            ->take(10)
            ->get();

        $lowStockProducts = Product::where('stock', '<=', 5)
            ->where('is_active', true)
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentOrders', 'lowStockProducts'));
    }
}
