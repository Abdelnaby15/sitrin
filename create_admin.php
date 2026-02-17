<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Create admin user
$admin = User::create([
    'name' => 'Abdelnaby Mohamed',
    'email' => 'abdelnabymohamed277@gmial.com',
    'password' => Hash::make('Nouran15@01/2002'),
    'is_admin' => true,
    'phone' => '+20 123 456 7890',
    'city' => 'Cairo',
    'country' => 'Egypt',
]);

echo "✅ Admin user created successfully!\n\n";
echo "👤 Name: Abdelnaby Mohamed\n";
echo "📧 Email: abdelnabymohamed277@gmial.com\n";
echo "🔑 Password: Nouran15@01/2002\n\n";
echo "🌐 Login at: http://127.0.0.1:8000/login\n";
echo "📊 Admin Dashboard: http://127.0.0.1:8000/admin/dashboard\n";
