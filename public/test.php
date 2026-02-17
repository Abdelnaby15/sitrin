<!DOCTYPE html>
<html>
<head>
    <title>Test Products</title>
</head>
<body>
    <h1>Test Products Page</h1>
    <?php
    require __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    $products = App\Models\Product::where('is_active', true)->with('category')->get();
    ?>
    <p>Products Count: <?= $products->count() ?></p>
    
    <?php foreach($products as $product): ?>
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
            <h3><?= $product->name ?></h3>
            <p>Category: <?= $product->category->name ?></p>
            <p>Price: EGP <?= number_format($product->price, 2) ?></p>
            <img src="<?= $product->main_image ?>" alt="<?= $product->name ?>" style="max-width: 200px;">
        </div>
    <?php endforeach; ?>
</body>
</html>
