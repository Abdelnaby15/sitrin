<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$products = DB::table('products')->get();

echo "Products in database:\n";
foreach ($products as $product) {
    echo "ID: {$product->id} | Name: {$product->name} | SKU: " . ($product->sku ?? 'NULL') . "\n";
}
