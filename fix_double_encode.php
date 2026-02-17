<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Get raw data
$raw = DB::select('SELECT id, images FROM products WHERE id = 7')[0];

echo "Step 1 - Raw JSON from DB:\n" . $raw->images . "\n\n";

// First decode (gets a string with escaped slashes)
$firstDecode = json_decode($raw->images);
echo "Step 2 - After first json_decode (type: " . gettype($firstDecode) . "):\n";
var_dump($firstDecode);
echo "\n";

// If it's still a string, decode again
if (is_string($firstDecode)) {
    $secondDecode = json_decode($firstDecode, true);
    echo "Step 3 - After second json_decode:\n";
    print_r($secondDecode);
} else {
    $secondDecode = $firstDecode;
}

// Now we should have a proper array - save it
if (is_array($secondDecode)) {
    // Clean paths
    $cleaned = array_map(function($path) {
        return str_replace('\\/', '/', $path);
        return str_replace('\\', '', $path);
    }, $secondDecode);
    
    echo "\nStep 4 - Cleaned array:\n";
    print_r($cleaned);
    
    // Save with proper encoding
    $newJson = json_encode($cleaned);
    echo "\nStep 5 - New JSON to save:\n" . $newJson . "\n";
    
    DB::table('products')->where('id', 7)->update(['images' => $newJson]);
    echo "\n✓ Updated successfully!\n";
} else {
    echo "ERROR: Could not decode to array\n";
}
