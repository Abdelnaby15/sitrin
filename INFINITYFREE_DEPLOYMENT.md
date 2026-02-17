# InfinityFree Deployment Guide for SITRIN

## Step 1: Create InfinityFree Account
1. Go to: https://infinityfree.net
2. Click "Sign Up"
3. Create account (no credit card needed!)
4. Verify your email

## Step 2: Create Hosting Account
1. In InfinityFree dashboard, click "Create Account"
2. Choose subdomain: `sitrin-ramadan` (will be: sitrin-ramadan.rf.gd)
3. Or use custom domain if you have one
4. Wait for account creation (~5 minutes)

## Step 3: Access Control Panel
1. Click on your hosting account
2. Click "Control Panel" (cPanel)
3. You'll see File Manager, MySQL Databases, etc.

## Step 4: Upload Files

### Option A: Via File Manager (Easy)
1. Open "File Manager" in cPanel
2. Go to `htdocs` folder (this is your public directory)
3. Delete default files
4. Upload ALL files from your `public` folder to `htdocs`
5. Create folder `laravel` in root (outside htdocs)
6. Upload all other Laravel files (app, config, database, etc.) to `laravel` folder

### Option B: Via FTP (Recommended for large files)
1. Download FileZilla: https://filezilla-project.org
2. Get FTP details from cPanel (Account Settings)
3. Connect via FTP
4. Upload structure:
   ```
   /htdocs/           <- public folder contents
   /laravel/          <- all other Laravel folders
   ```

## Step 5: Create MySQL Database
1. In cPanel, go to "MySQL Databases"
2. Create database: `sitrin_db`
3. Create user: `sitrin_user`
4. Set password (save it!)
5. Add user to database with ALL PRIVILEGES
6. Note down:
   - Database name (will be: `username_sitrin_db`)
   - Username (will be: `username_sitrin_user`)
   - Password
   - Host: `sql###.infinityfree.net`

## Step 6: Import Database
1. Go to phpMyAdmin in cPanel
2. Select your database
3. Click "Import"
4. Upload: `sitrin_database_backup.sql`
5. Click "Go"

## Step 7: Configure Laravel
1. In File Manager, edit `/laravel/.env`:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=http://sitrin-ramadan.rf.gd
   
   DB_CONNECTION=mysql
   DB_HOST=sql###.infinityfree.net
   DB_PORT=3306
   DB_DATABASE=username_sitrin_db
   DB_USERNAME=username_sitrin_user
   DB_PASSWORD=your-password
   ```

2. Edit `/htdocs/index.php`:
   Find these lines and update paths:
   ```php
   require __DIR__.'/../laravel/vendor/autoload.php';
   $app = require_once __DIR__.'/../laravel/bootstrap/app.php';
   ```

## Step 8: Set Permissions
In File Manager, set permissions (right-click → Change Permissions):
- `/laravel/storage/` → 755 (recursive)
- `/laravel/bootstrap/cache/` → 755 (recursive)

## Step 9: Generate APP_KEY
1. In cPanel, go to "Cron Jobs"
2. Or use online PHP executor
3. Run this code once:
   ```php
   <?php
   require '../laravel/vendor/autoload.php';
   $app = require_once '../laravel/bootstrap/app.php';
   $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
   $kernel->call('key:generate', ['--show' => true]);
   ```
4. Copy the key to `.env` file

## Step 10: Clear Caches
Create file `/htdocs/clear.php`:
```php
<?php
require '../laravel/vendor/autoload.php';
$app = require_once '../laravel/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->call('config:clear');
$kernel->call('cache:clear');
$kernel->call('view:clear');
echo "Caches cleared!";
```
Visit: http://sitrin-ramadan.rf.gd/clear.php

## Your Site Will Be Live!
URL: http://sitrin-ramadan.rf.gd

## Important Notes:
- InfinityFree has some limitations (no email sending via SMTP, limited CPU)
- They add ads to free accounts (remove with upgrade)
- No SSH access (use cPanel tools)
- Great for testing and small projects!

## Troubleshooting:
- 404 errors? Check .htaccess file is uploaded
- Database errors? Verify credentials in .env
- Blank page? Check error logs in cPanel
- Permission errors? Set 755 on storage folders

Good luck! 🚀
