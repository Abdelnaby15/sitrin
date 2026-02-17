<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = App\Models\Product::first();
echo "Main Image: " . $p->main_image . "\n";
echo "Expected path: public/" . $p->main_image . "\n";
echo "File exists: " . (file_exists("public/" . $p->main_image) ? "YES" : "NO") . "\n";
