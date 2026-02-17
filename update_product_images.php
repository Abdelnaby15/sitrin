<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\Category;

// Ensure at least one category exists
$category = Category::first();
if (!$category) {
    $category = Category::create([
        'name' => 'Ramadan Collection',
        'slug' => 'ramadan-collection',
        'description' => 'Special Ramadan abayas and dresses',
        'is_active' => true,
    ]);
}

// Create or update products with SKU
$products = [
    [
        'name' => 'Golden Crescent Abaya',
        'slug' => 'golden-crescent-abaya',
        'sku' => 'GCA-001',
        'description' => 'Elegant golden embroidered abaya perfect for Ramadan gatherings.',
        'price' => 899.00,
        'stock' => 15,
        'main_image' => 'images/products/golden-crescent-abaya.svg',
        'category_id' => $category->id,
        'is_active' => true,
        'is_featured' => true,
        'is_new_arrival' => true,
    ],
    [
        'name' => 'Moonlight Prayer Abaya',
        'slug' => 'moonlight-prayer-abaya',
        'sku' => 'MPA-002',
        'description' => 'Comfortable and modest abaya for daily prayers during Ramadan.',
        'price' => 699.00,
        'stock' => 20,
        'main_image' => 'images/products/moonlight-prayer-abaya.svg',
        'category_id' => $category->id,
        'is_active' => true,
        'is_featured' => true,
    ],
    [
        'name' => 'Eid Emerald Dress',
        'slug' => 'eid-emerald-dress',
        'sku' => 'EED-003',
        'description' => 'Stunning emerald dress perfect for Eid celebrations.',
        'price' => 1299.00,
        'stock' => 10,
        'main_image' => 'images/products/eid-emerald.svg',
        'category_id' => $category->id,
        'is_active' => true,
        'is_new_arrival' => true,
    ],
    [
        'name' => 'Classic Black Abaya',
        'slug' => 'classic-black-abaya',
        'sku' => 'CBA-004',
        'description' => 'Timeless black abaya with delicate embroidery.',
        'price' => 599.00,
        'stock' => 25,
        'main_image' => 'images/products/classic-black.svg',
        'category_id' => $category->id,
        'is_active' => true,
        'is_featured' => true,
    ],
    [
        'name' => 'Royal Velvet Abaya',
        'slug' => 'royal-velvet-abaya',
        'sku' => 'RVA-005',
        'description' => 'Luxurious velvet abaya for special occasions.',
        'price' => 1499.00,
        'stock' => 8,
        'main_image' => 'images/products/royal-velvet.svg',
        'category_id' => $category->id,
        'is_active' => true,
    ],
    [
        'name' => 'Casual Taupe Dress',
        'slug' => 'casual-taupe-dress',
        'sku' => 'CTD-006',
        'description' => 'Comfortable everyday dress in elegant taupe.',
        'price' => 499.00,
        'stock' => 30,
        'main_image' => 'images/products/casual-taupe.svg',
        'category_id' => $category->id,
        'is_active' => true,
    ],
];

foreach ($products as $productData) {
    $product = Product::updateOrCreate(
        ['sku' => $productData['sku']],
        $productData
    );
    echo "Created/Updated product: {$product->name} (SKU: {$product->sku})\n";
}

echo "\nAll products created/updated successfully!\n";
