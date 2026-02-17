<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$product = Product::find(7);

if ($product) {
    $product->size = 'One Size (160cm height × 90cm width)';
    $product->save();
    echo "✓ Updated product: {$product->name}\n";
    echo "New size: {$product->size}\n";
} else {
    echo "Product not found\n";
}
