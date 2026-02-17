<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = Product::all();

echo "Current product sizes:\n\n";

foreach ($products as $product) {
    echo "ID: {$product->id} | {$product->name}\n";
    echo "Size: " . ($product->size ?? 'NULL') . "\n";
    echo "---\n";
}
