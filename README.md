# SITRIN - Premium Ramadan Abayas E-commerce Platform

A complete, production-ready e-commerce website for Ramadan Abayas with modern Islamic luxury design, built with Laravel and Bootstrap 5.

![SITRIN Logo](public/images/logo.png)

## ✨ Features

### Frontend Features
- 🌙 **Modern Islamic Luxury Design** - Ramadan-themed with gold, green, and beige color palette
- 🎨 **Smooth Animations** - Interactive UI with hover effects and page transitions
- 📱 **Fully Responsive** - Mobile-first design that works on all devices
- 🔍 **Advanced Product Filtering** - Search, category, price range, and availability filters
- 🛒 **Shopping Cart** - Session-based cart with add, update, and remove functionality
- 💳 **Checkout System** - Complete order processing with Cash on Delivery & Bank Transfer
- 📧 **Contact Form** - Customer inquiry system with validation
- ⭐ **Product Features** - Image galleries, size selection, stock management

### Admin Panel Features
- 📊 **Dashboard** - Overview with stats, recent orders, and low stock alerts
- 📦 **Product Management** - Full CRUD operations with image uploads
- 🏷️ **Category Management** - Organize products into categories
- 📋 **Order Management** - View orders, update status, and track payments
- 👥 **User Management** - Customer accounts with order history
- 🔐 **Secure Authentication** - Role-based access control (Admin/Customer)

### Technical Features
- 🏗️ **Clean Architecture** - MVC pattern with Laravel best practices
- 🗄️ **Database** - Well-structured MySQL database with relationships
- 🔒 **Security** - CSRF protection, password hashing, validation
- 📝 **SEO-Friendly** - Clean URLs, meta tags, semantic HTML
- ♿ **Accessibility** - ARIA labels, keyboard navigation support

## 🚀 Tech Stack

- **Backend:** Laravel 10 (PHP 8.1+)
- **Frontend:** Blade Templates + Bootstrap 5
- **Database:** MySQL
- **Authentication:** Laravel UI
- **Fonts:** Google Fonts (Cormorant Garamond, Montserrat)
- **Icons:** Bootstrap Icons
- **Animations:** AOS (Animate On Scroll)

## 📋 Prerequisites

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js & NPM (optional, for asset compilation)

## ⚙️ Installation

### 1. Clone or Extract the Project
```bash
cd c:\Users\Abdelnaby\sitrin
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Environment Configuration
```bash
# Copy .env.example to .env
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Database
Edit `.env` file and update database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sitrin_ramadan
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Create Database
```sql
CREATE DATABASE sitrin_ramadan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Create Admin User (Manual)
```sql
INSERT INTO users (name, email, password, is_admin, created_at, updated_at)
VALUES ('Admin', 'admin@sitrin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1, NOW(), NOW());
-- Password: password
```

### 8. Create Sample Categories
```sql
INSERT INTO categories (name, slug, description, is_active, `order`, created_at, updated_at) VALUES
('Classic Abayas', 'classic-abayas', 'Timeless elegance for everyday wear', 1, 1, NOW(), NOW()),
('Embroidered Collection', 'embroidered-collection', 'Intricate designs for special occasions', 1, 2, NOW(), NOW()),
('Ramadan Specials', 'ramadan-specials', 'Exclusive designs for the blessed month', 1, 3, NOW(), NOW()),
('Modest Chic', 'modest-chic', 'Contemporary modest fashion', 1, 4, NOW(), NOW());
```

### 9. Start Development Server
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## 🔐 Default Login Credentials

**Admin Account:**
- Email: `admin@sitrin.com`
- Password: `password`

**Create Customer Account:**
- Register through the website at `/register`

## 📁 Project Structure

```
sitrin/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Admin panel controllers
│   │   │   ├── Auth/            # Authentication controllers
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── ContactController.php
│   │   │   ├── HomeController.php
│   │   │   └── ProductController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── Category.php
│       ├── Contact.php
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Product.php
│       └── User.php
├── database/
│   └── migrations/              # Database schema
├── public/
│   ├── css/
│   │   ├── style.css           # Main styles with Ramadan theme
│   │   └── admin.css           # Admin panel styles
│   ├── js/
│   │   └── main.js             # Interactive features
│   └── images/                 # Product & brand images
├── resources/
│   └── views/
│       ├── admin/              # Admin dashboard views
│       ├── auth/               # Login & register views
│       ├── cart/               # Shopping cart views
│       ├── checkout/           # Checkout process views
│       ├── layouts/            # Master layouts
│       ├── products/           # Product listing & details
│       ├── about.blade.php
│       ├── contact.blade.php
│       └── home.blade.php
└── routes/
    └── web.php                 # All application routes
```

## 🎨 Design System

### Color Palette
- **Gold:** `#C9A961` - Primary accent, luxury touch
- **Dark Green:** `#1B4332` - Main brand color, Islamic feel
- **Beige:** `#F5EBD8` - Soft backgrounds
- **Off-White:** `#FDFCF9` - Clean base

### Typography
- **Headings:** Cormorant Garamond (elegant serif)
- **Body:** Montserrat (clean sans-serif)

### Components
- Smooth hover animations (0.3s cubic-bezier)
- Islamic geometric patterns (subtle backgrounds)
- Crescent moon accents
- Rounded corners (15px for cards)
- Soft shadows for depth

## 🛠️ Key Routes

### Public Routes
- `/` - Home page
- `/products` - Product listing with filters
- `/product/{slug}` - Product details
- `/cart` - Shopping cart
- `/checkout` - Checkout process
- `/about` - About the brand
- `/contact` - Contact form
- `/login` - User login
- `/register` - New user registration

### Admin Routes (Requires Authentication & Admin Role)
- `/admin/dashboard` - Admin dashboard
- `/admin/products` - Product management
- `/admin/categories` - Category management
- `/admin/orders` - Order management

## 📦 Adding Products

### Via Admin Panel:
1. Login as admin
2. Navigate to Products → Add New Product
3. Fill in product details:
   - Name
   - Category
   - Description
   - Price (and optional sale price)
   - Upload main image
   - Set stock quantity
   - Add sizes (comma-separated: S,M,L,XL)
   - Set as featured or new arrival
4. Click Save

### Product Image Recommendations:
- Format: JPG, PNG, or WebP
- Dimensions: 800x1200px (portrait)
- Size: Under 500KB
- Background: Clean, preferably white or light beige

## 🌐 Deployment

### For Production:

1. **Environment Setup:**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

2. **Optimize:**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

3. **Security:**
- Use HTTPS
- Set strong `APP_KEY`
- Update database credentials
- Configure proper file permissions

4. **Server Requirements:**
- PHP >= 8.1
- MySQL >= 5.7
- Apache/Nginx with mod_rewrite
- SSL certificate

## 🎯 Usage Tips

### For Customers:
- Browse products by category or search
- Filter by price range and availability
- View detailed product information
- Add items to cart with size selection
- Complete checkout with shipping details
- Choose payment method (COD or Bank Transfer)

### For Admins:
- Monitor dashboard for pending orders
- Update order status as processing → shipped → delivered
- Track low stock products
- Manage product inventory
- View customer orders and contact messages

## 🔧 Customization

### Logo with Crescent Moon:
The logo integration is in `resources/views/layouts/app.blade.php`:
```html
<img src="{{ asset('images/logo.png') }}" alt="SITRIN" class="logo">
```

To style the "i" dot as a crescent:
```css
/* Add to public/css/style.css */
.navbar-brand .logo {
    filter: drop-shadow(0 0 10px rgba(201, 169, 97, 0.3));
}
```

### Color Customization:
Edit CSS variables in `public/css/style.css`:
```css
:root {
    --color-gold: #C9A961;
    --color-green: #1B4332;
    --color-beige: #F5EBD8;
}
```

## 📝 License

This project is created for SITRIN - Premium Ramadan Abayas brand.

## 👨‍💻 Development Notes

- All controllers follow RESTful conventions
- Models use Eloquent ORM with relationships
- Views use Blade templating with component reusability
- Session-based cart (can be upgraded to database)
- Image uploads handled securely
- Forms include CSRF protection
- Validation on both client and server side

## 🐛 Troubleshooting

**Issue: 404 on routes**
```bash
php artisan route:clear
php artisan config:clear
```

**Issue: Images not displaying**
```bash
# Ensure storage is linked
php artisan storage:link
# Check permissions on public/images
```

**Issue: Database connection error**
- Verify MySQL is running
- Check .env database credentials
- Ensure database exists

**Issue: Admin middleware not working**
- Register middleware in `app/Http/Kernel.php`
- Ensure user has `is_admin = 1` in database

## 📞 Support

For questions or issues, contact the development team or refer to Laravel documentation at https://laravel.com/docs

---

**Built with ❤️ for Ramadan 2026 - رمضان كريم**
