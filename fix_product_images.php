<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$products = Product::whereNotNull('images')->get();

echo "Fixing product images encoding...\n\n";

foreach ($products as $product) {
    $rawImages = $product->getRawOriginal('images');
    
    if ($rawImages) {
        // Decode the JSON string
        $imagesArray = json_decode($rawImages, true);
        
        if (is_array($imagesArray)) {
            // Re-save using the model which will properly encode it
            $product->images = $imagesArray;
            $product->save();
            echo "✓ Fixed product: {$product->name} (ID: {$product->id})\n";
            echo "  Images count: " . count($imagesArray) . "\n";
        }
    }
}

echo "\nDone!\n";
