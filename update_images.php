<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Update all products to use placeholder image
$count = DB::table('products')->update(['main_image' => 'images/products/placeholder.svg']);

echo "Updated $count products with placeholder image!\n";
