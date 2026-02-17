<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Test ProductController logic
$products = App\Models\Product::where('is_active', true)->with('category')->get();
$categories = App\Models\Category::where('is_active', true)->orderBy('name')->get();

echo "Active Products: " . $products->count() . "\n";
echo "Active Categories: " . $categories->count() . "\n\n";

if ($products->count() > 0) {
    echo "First product:\n";
    $p = $products->first();
    echo "- Name: {$p->name}\n";
    echo "- Category: {$p->category->name}\n";
    echo "- Price: {$p->price}\n";
    echo "- Image: {$p->main_image}\n";
}
