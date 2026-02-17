<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Fix product 7 images directly in database
$product = DB::table('products')->where('id', 7)->first();

if ($product && $product->images) {
    echo "Current images (raw): {$product->images}\n\n";
    
    // Decode the double-encoded JSON
    $imagesArray = json_decode($product->images, true);
    
    if (is_array($imagesArray)) {
        // Clean up the escaped slashes in the array
        $cleanedImages = array_map(function($img) {
            return str_replace('\/', '/', $img);
        }, $imagesArray);
        
        echo "Cleaned images:\n";
        print_r($cleanedImages);
        
        // Update with properly encoded JSON
        DB::table('products')
            ->where('id', 7)
            ->update(['images' => json_encode($cleanedImages)]);
        
        echo "\n✓ Product images fixed!\n";
    }
}
