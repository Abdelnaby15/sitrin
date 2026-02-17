<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get products with categories
$products = DB::table('products')
    ->join('categories', 'products.category_id', '=', 'categories.id')
    ->where('products.is_active', true)
    ->select('products.*', 'categories.name as category_name')
    ->get();

echo "Products with category data:\n\n";

foreach ($products as $product) {
    echo "ID: {$product->id}\n";
    echo "Name: {$product->name}\n";
    echo "Category: {$product->category_name}\n";
    echo "Price: {$product->price}\n";
    echo "Sale Price: " . ($product->sale_price ?? 'null') . "\n";
    echo "Stock: {$product->stock}\n";
    echo "Active: " . ($product->is_active ? 'yes' : 'no') . "\n";
    echo "---\n";
}
