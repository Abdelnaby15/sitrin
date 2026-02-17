<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$product = Product::find(7); // The product with slug 'lb'

if ($product) {
    echo "Product: {$product->name}\n";
    echo "SKU: {$product->sku}\n";
    echo "Main Image: {$product->main_image}\n";
    echo "Additional Images (raw): " . ($product->getRawOriginal('images') ?? 'NULL') . "\n";
    echo "Additional Images (array): " . print_r($product->images, true) . "\n";
    echo "Is Array: " . (is_array($product->images) ? 'YES' : 'NO') . "\n";
} else {
    echo "Product not found\n";
}
