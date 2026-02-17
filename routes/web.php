<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\StockNotificationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// Debug route
Route::get('/test-products', function() {
    $products = \App\Models\Product::where('is_active', true)->with('category')->get();
    return response()->json([
        'count' => $products->count(),
        'products' => $products->map(function($p) {
            return [
                'id' => $p->id,
                'name' => $p->name,
                'category' => $p->category->name,
                'price' => $p->price,
                'image' => $p->main_image,
                'image_url' => asset($p->main_image),
            ];
        })
    ]);
});

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process')->middleware('throttle:10,1');
Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

// Contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store')->middleware('throttle:5,1');

// Order Tracking (Public)
Route::get('/orders/track/{order}', [CheckoutController::class, 'track'])->name('orders.track');

// Stock Notifications
Route::post('/stock-notifications/{product}', [StockNotificationController::class, 'subscribe'])->name('stock-notifications.subscribe')->middleware('throttle:5,1');
Route::get('/stock-notifications/unsubscribe/{token}', [StockNotificationController::class, 'unsubscribe'])->name('stock-notifications.unsubscribe');

// Authentication Routes
Auth::routes();

// Admin Routes (Protected by auth and admin middleware)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Products Management
    Route::resource('products', AdminProductController::class);
    Route::post('products/reorder', [AdminProductController::class, 'reorder'])->name('products.reorder');
    Route::post('products/{product}/move-up', [AdminProductController::class, 'moveUp'])->name('products.moveUp');
    Route::post('products/{product}/move-down', [AdminProductController::class, 'moveDown'])->name('products.moveDown');
    
    // Categories Management
    Route::resource('categories', CategoryController::class);
    
    // Orders Management
    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::patch('orders/{order}/payment', [OrderController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus');
});
