<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$defaultSize = 'One Size (160cm height × 90cm width)';

$products = Product::whereNull('size')->orWhere('size', '')->get();

echo "Updating products with default size...\n\n";

foreach ($products as $product) {
    $product->size = $defaultSize;
    $product->save();
    echo "✓ Updated: {$product->name}\n";
}

echo "\n✅ Updated " . $products->count() . " products with default size!\n";
