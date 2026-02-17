<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get all products
$products = DB::table('products')->get();

echo "Total products: " . $products->count() . "\n\n";

foreach ($products as $product) {
    echo "ID: {$product->id}\n";
    echo "Name: {$product->name}\n";
    echo "Category ID: {$product->category_id}\n";
    echo "Is Active: " . ($product->is_active ? 'Yes' : 'No') . "\n";
    echo "Stock: {$product->stock}\n";
    echo "Main Image: {$product->main_image}\n";
    echo "---\n";
}
