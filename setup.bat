@echo off
echo ========================================
echo   SITRIN - Ramadan Abayas E-Commerce
echo   Installation Script
echo ========================================
echo.

REM Check if composer is installed
where composer >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Composer is not installed or not in PATH
    echo Please install Composer from https://getcomposer.org/
    pause
    exit /b 1
)

REM Check if PHP is installed
where php >nul 2>nul
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] PHP is not installed or not in PATH
    echo Please install PHP 8.1+ from https://windows.php.net/
    pause
    exit /b 1
)

echo [1/7] Installing Composer dependencies...
call composer install
if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Failed to install Composer dependencies
    pause
    exit /b 1
)

echo.
echo [2/7] Creating .env file...
if not exist .env (
    copy .env.example .env
    echo .env file created successfully
) else (
    echo .env file already exists, skipping...
)

echo.
echo [3/7] Generating application key...
php artisan key:generate

echo.
echo [4/7] Creating database...
echo Please make sure MySQL is running and accessible.
echo.
set /p DB_NAME="Enter database name (default: sitrin): "
if "%DB_NAME%"=="" set DB_NAME=sitrin

set /p DB_USER="Enter database username (default: root): "
if "%DB_USER%"=="" set DB_USER=root

set /p DB_PASS="Enter database password (press Enter if none): "

echo.
echo Creating database %DB_NAME%...
mysql -u %DB_USER% -p%DB_PASS% -e "CREATE DATABASE IF NOT EXISTS %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if %ERRORLEVEL% NEQ 0 (
    echo [WARNING] Could not create database automatically.
    echo Please create it manually using:
    echo CREATE DATABASE %DB_NAME% CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    pause
)

echo.
echo [5/7] Updating .env with database credentials...
powershell -Command "(Get-Content .env) -replace 'DB_DATABASE=.*', 'DB_DATABASE=%DB_NAME%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_USERNAME=.*', 'DB_USERNAME=%DB_USER%' | Set-Content .env"
powershell -Command "(Get-Content .env) -replace 'DB_PASSWORD=.*', 'DB_PASSWORD=%DB_PASS%' | Set-Content .env"

echo.
echo [6/7] Running migrations...
php artisan migrate

if %ERRORLEVEL% NEQ 0 (
    echo [ERROR] Migration failed. Please check your database connection.
    pause
    exit /b 1
)

echo.
echo [7/7] Creating admin user...
set /p ADMIN_NAME="Enter admin name: "
set /p ADMIN_EMAIL="Enter admin email: "
set /p ADMIN_PASS="Enter admin password: "

php artisan tinker --execute="$user = new App\Models\User(); $user->name = '%ADMIN_NAME%'; $user->email = '%ADMIN_EMAIL%'; $user->password = bcrypt('%ADMIN_PASS%'); $user->is_admin = true; $user->save(); echo 'Admin user created successfully';"

echo.
echo ========================================
echo   Installation Complete!
echo ========================================
echo.
echo Next steps:
echo 1. Place your SITRIN.Logo.png file in public/images/
echo 2. Add sample product images to public/images/products/
echo 3. Start the development server with: php artisan serve
echo 4. Visit http://localhost:8000 to see your website
echo 5. Login to admin panel at http://localhost:8000/admin
echo.
echo Admin credentials:
echo Email: %ADMIN_EMAIL%
echo Password: (the one you entered)
echo.
pause
