<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Clear all sessions (which includes cart data)
$sessionPath = storage_path('framework/sessions');

if (is_dir($sessionPath)) {
    $files = glob($sessionPath . '/*');
    foreach ($files as $file) {
        if (is_file($file)) {
            unlink($file);
        }
    }
    echo "✓ All cart sessions cleared!\n";
    echo "Please refresh your browser and add items to cart again.\n";
} else {
    echo "Session directory not found\n";
}
