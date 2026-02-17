<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

// Get raw data
$raw = DB::select('SELECT id, images FROM products WHERE id = 7')[0];

echo "Raw JSON from DB: " . $raw->images . "\n\n";

// Decode it
$decoded = json_decode($raw->images, true);
echo "Decoded array:\n";
print_r($decoded);

// Clean up escaped slashes
$cleaned = array_map(function($img) {
    return str_replace('\\/', '/', $img);
}, $decoded);

echo "\nCleaned array:\n";
print_r($cleaned);

// Update directly
$newJson = json_encode($cleaned);
echo "\nNew JSON: " . $newJson . "\n";

DB::table('products')->where('id', 7)->update(['images' => $newJson]);

echo "\n✓ Updated!\n";
