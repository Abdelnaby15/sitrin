-- ========================================
-- SITRIN Ramadan Abayas E-Commerce Database
-- Complete Database Setup
-- ========================================

-- Create Database
CREATE DATABASE IF NOT EXISTS sitrin_ramadan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sitrin_ramadan;

-- ========================================
-- Table: users
-- ========================================
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT FALSE,
    phone VARCHAR(20) NULL,
    address TEXT NULL,
    city VARCHAR(100) NULL,
    country VARCHAR(100) NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: categories
-- ========================================
CREATE TABLE categories (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NULL,
    image VARCHAR(255) NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: products
-- ========================================
CREATE TABLE products (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT NOT NULL,
    features TEXT NULL,
    price DECIMAL(10, 2) NOT NULL,
    sale_price DECIMAL(10, 2) NULL,
    main_image VARCHAR(255) NOT NULL,
    images JSON NULL,
    size VARCHAR(50) NULL,
    color VARCHAR(50) NULL,
    fabric VARCHAR(100) NULL,
    stock INT DEFAULT 0,
    is_featured BOOLEAN DEFAULT FALSE,
    is_new_arrival BOOLEAN DEFAULT FALSE,
    is_active BOOLEAN DEFAULT TRUE,
    views INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: orders
-- ========================================
CREATE TABLE orders (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NULL,
    order_number VARCHAR(255) NOT NULL UNIQUE,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    shipping_address TEXT NOT NULL,
    shipping_city VARCHAR(100) NOT NULL,
    shipping_country VARCHAR(100) NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50) NOT NULL,
    payment_status VARCHAR(50) DEFAULT 'pending',
    order_status VARCHAR(50) DEFAULT 'pending',
    notes TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: order_items
-- ========================================
CREATE TABLE order_items (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    order_id BIGINT UNSIGNED NOT NULL,
    product_id BIGINT UNSIGNED NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_image VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Table: contacts
-- ========================================
CREATE TABLE contacts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- Sample Data: Admin User
-- ========================================
-- Password: admin123
INSERT INTO users (name, email, password, is_admin, created_at, updated_at) VALUES
('Admin', 'admin@sitrin.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', TRUE, NOW(), NOW());

-- ========================================
-- Sample Data: Categories
-- ========================================
INSERT INTO categories (name, slug, description, is_active, created_at, updated_at) VALUES
('Ramadan Abayas', 'ramadan-abayas', 'Elegant abayas perfect for Ramadan prayers and gatherings', TRUE, NOW(), NOW()),
('Eid Collection', 'eid-collection', 'Special collection for Eid celebrations', TRUE, NOW(), NOW()),
('Everyday Modest Wear', 'everyday-modest-wear', 'Comfortable and stylish modest wear for daily use', TRUE, NOW(), NOW()),
('Luxury Edition', 'luxury-edition', 'Premium luxury abayas with intricate details', TRUE, NOW(), NOW());

-- ========================================
-- Sample Data: Products
-- ========================================
INSERT INTO products (category_id, name, slug, description, features, price, sale_price, main_image, size, color, fabric, stock, is_featured, is_new_arrival, is_active, created_at, updated_at) VALUES
(1, 'Golden Crescent Abaya', 'golden-crescent-abaya', 'Luxurious black abaya with delicate golden crescent embroidery, perfect for Ramadan evenings. Features flowing fabric and comfortable fit.', 'Hand-embroidered golden crescents\nPremium crepe fabric\nComfortable loose fit\nElegant flowing design', 299.99, 249.99, 'golden-crescent-abaya.jpg', 'M,L,XL', 'Black with Gold Embroidery', 'Premium Crepe', 15, TRUE, TRUE, TRUE, NOW(), NOW()),

(1, 'Moonlight Prayer Abaya', 'moonlight-prayer-abaya', 'Soft beige abaya adorned with subtle Islamic geometric patterns. Designed for comfort during long prayer sessions.', 'Breathable fabric\nGeometric pattern details\nSoft inner lining\nAdjustable sleeves', 249.99, NULL, 'moonlight-prayer-abaya.jpg', 'S,M,L,XL', 'Beige', 'Cotton Blend', 20, TRUE, FALSE, TRUE, NOW(), NOW()),

(2, 'Eid Celebration Emerald', 'eid-celebration-emerald', 'Stunning emerald green abaya with golden trim, perfect for Eid celebrations. Features intricate hand-stitched details.', 'Emerald green premium fabric\nGolden trim accents\nHand-stitched details\nMatching hijab included', 399.99, 349.99, 'eid-emerald.jpg', 'M,L,XL', 'Emerald Green', 'Silk Blend', 10, TRUE, TRUE, TRUE, NOW(), NOW()),

(3, 'Classic Black Elegance', 'classic-black-elegance', 'Timeless black abaya suitable for any occasion. Simple yet elegant design with quality craftsmanship.', 'Classic design\nQuality stitching\nDurable fabric\nEveryday comfort', 179.99, NULL, 'classic-black.jpg', 'S,M,L,XL,XXL', 'Black', 'Polyester Crepe', 30, FALSE, FALSE, TRUE, NOW(), NOW()),

(4, 'Royal Velvet Collection', 'royal-velvet-collection', 'Luxurious deep green velvet abaya with pearl embellishments. A statement piece for special occasions.', 'Premium velvet fabric\nPearl embellishments\nLuxury packaging\nLimited edition', 599.99, 499.99, 'royal-velvet.jpg', 'M,L', 'Deep Green', 'Premium Velvet', 5, TRUE, TRUE, TRUE, NOW(), NOW()),

(3, 'Casual Comfort Taupe', 'casual-comfort-taupe', 'Light taupe abaya perfect for daily wear. Comfortable, breathable, and easy to style.', 'Breathable fabric\nPractical pockets\nEasy care\nVersatile style', 159.99, 139.99, 'casual-taupe.jpg', 'S,M,L,XL', 'Taupe', 'Jersey', 25, FALSE, FALSE, TRUE, NOW(), NOW());

-- ========================================
-- Database Setup Complete
-- ========================================

SELECT 'Database setup complete!' AS Status;
SELECT COUNT(*) AS total_categories FROM categories;
SELECT COUNT(*) AS total_products FROM products;
SELECT COUNT(*) AS total_users FROM users;
