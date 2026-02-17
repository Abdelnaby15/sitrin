<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with featured products.
     */
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with('category')
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(8)
            ->get();

        $newArrivals = Product::where('is_new_arrival', true)
            ->where('is_active', true)
            ->with('category')
            ->orderBy('sort_order', 'asc')
            ->latest()
            ->take(4)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('home', compact('featuredProducts', 'newArrivals', 'categories'));
    }

    /**
     * Display the about page.
     */
    public function about()
    {
        return view('about');
    }
}
