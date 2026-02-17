-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: sitrin_ramadan
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_logs`
--

DROP TABLE IF EXISTS `activity_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_logs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `model_type` varchar(255) DEFAULT NULL,
  `model_id` bigint(20) unsigned DEFAULT NULL,
  `description` text NOT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_logs_user_id_created_at_index` (`user_id`,`created_at`),
  KEY `activity_logs_model_type_model_id_index` (`model_type`,`model_id`),
  CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_logs`
--

LOCK TABLES `activity_logs` WRITE;
/*!40000 ALTER TABLE `activity_logs` DISABLE KEYS */;
INSERT INTO `activity_logs` VALUES (1,1,'updated','App\\Models\\Product',2,'Updated product: ZOMORROD | ╪▓┘Å┘à┘Å╪▒┘æ┘Å╪»','[]','127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/144.0.0.0 Safari/537.36','2026-02-16 18:55:58','2026-02-16 18:55:58');
/*!40000 ALTER TABLE `activity_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Ramadan Collection','ramadan-collection','Special Ramadan abayas and dresses',NULL,1,0,'2026-02-16 14:40:47','2026-02-16 14:40:47');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2024_01_01_000000_create_users_table',1),(3,'2024_01_02_000000_create_categories_table',1),(4,'2024_01_03_000000_create_products_table',1),(5,'2024_01_04_000000_create_orders_table',1),(6,'2024_01_05_000000_create_order_items_table',1),(7,'2024_01_06_000000_create_contacts_table',1),(8,'2024_01_07_000000_add_sort_order_to_products_table',2),(9,'2024_01_08_000000_create_activity_logs_table',3),(11,'2026_02_17_142634_create_stock_notifications_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_items` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) unsigned NOT NULL,
  `product_id` bigint(20) unsigned NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_items_order_id_foreign` (`order_id`),
  KEY `order_items_product_id_foreign` (`product_id`),
  CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (1,1,1,'Golden Crescent Abaya',899.00,3,NULL,NULL,2697.00,'2026-02-16 15:06:34','2026-02-16 15:06:34'),(2,2,3,'DEEM | ╪»┘É┘è┘à',650.00,2,'One Size (160cm height ├ù 90cm width)',NULL,1300.00,'2026-02-16 19:45:18','2026-02-16 19:45:18'),(3,3,11,'JINAN | ╪¼┘É┘å┘Ä╪º┘å',750.00,1,'One Size (160cm height ├ù 90cm width)',NULL,750.00,'2026-02-17 12:58:42','2026-02-17 12:58:42'),(4,4,11,'JINAN | ╪¼┘É┘å┘Ä╪º┘å',750.00,1,'One Size (160cm height ├ù 90cm width)',NULL,750.00,'2026-02-17 13:00:19','2026-02-17 13:00:19'),(5,5,11,'JINAN | ╪¼┘É┘å┘Ä╪º┘å',750.00,1,'One Size (160cm height ├ù 90cm width)',NULL,750.00,'2026-02-17 13:00:23','2026-02-17 13:00:23'),(6,6,11,'JINAN | ╪¼┘É┘å┘Ä╪º┘å',750.00,1,'One Size (160cm height ├ù 90cm width)',NULL,750.00,'2026-02-17 13:01:21','2026-02-17 13:01:21'),(7,7,11,'JINAN | ╪¼┘É┘å┘Ä╪º┘å',750.00,1,'One Size (160cm height ├ù 90cm width)',NULL,750.00,'2026-02-17 13:03:29','2026-02-17 13:03:29'),(8,8,11,'JINAN | ╪¼┘É┘å┘Ä╪º┘å',750.00,1,'One Size (160cm height ├ù 90cm width)',NULL,750.00,'2026-02-17 13:06:12','2026-02-17 13:06:12');
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) NOT NULL DEFAULT 'cash_on_delivery',
  `shipping_name` varchar(255) NOT NULL,
  `shipping_email` varchar(255) NOT NULL,
  `shipping_phone` varchar(255) NOT NULL,
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_country` varchar(255) NOT NULL,
  `shipping_postal_code` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_number_unique` (`order_number`),
  KEY `orders_user_id_foreign` (`user_id`),
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,1,'ORD-6993327A71C59',2697.00,50.00,2747.00,'pending','pending','cash_on_delivery','Abdelnaby Mohamed','abdelnabymohamed277@gmial.com','+20 123 456 7890','fgj','Cairo','Egypt','00000','fdfchgvbjbv','2026-02-16 15:06:34','2026-02-16 15:06:34'),(2,1,'ORD-699373CE8E4FD',1300.00,50.00,1350.00,'pending','pending','cash_on_delivery','Abdelnaby Mohamed','abdelnabymohamed277@gmial.com','vxbdzgz','dsfgasd','Cairo','Egypt',NULL,NULL,'2026-02-16 19:45:18','2026-02-16 19:45:18'),(3,1,'ORD-69946602E5BB0',750.00,50.00,800.00,'pending','pending','cash_on_delivery','Abdelnaby Mohamed','abdelnabymohamed277@gmail.com','+201005726595','54 El-Bostan','Cairo','Egypt','00000',NULL,'2026-02-17 12:58:42','2026-02-17 12:58:42'),(4,1,'ORD-6994666399856',750.00,50.00,800.00,'pending','pending','cash_on_delivery','Abdelnaby Mohamed','abdelnabymohamed277@gmail.com','+201005726595','54 El-Bostan','Cairo','Egypt','00000',NULL,'2026-02-17 13:00:19','2026-02-17 13:00:19'),(5,1,'ORD-6994666780857',750.00,50.00,800.00,'pending','pending','cash_on_delivery','Abdelnaby Mohamed','abdelnabymohamed277@gmail.com','+201005726595','54 El-Bostan','Cairo','Egypt','00000',NULL,'2026-02-17 13:00:23','2026-02-17 13:00:23'),(6,1,'ORD-699466A12136E',750.00,50.00,800.00,'pending','pending','cash_on_delivery','Abdelnaby Mohamed','abdelnabymohamed277@gmail.com','+201005726595','54 El-Bostan','Cairo','Egypt','00000',NULL,'2026-02-17 13:01:21','2026-02-17 13:01:21'),(7,1,'ORD-69946721D84F8',750.00,50.00,800.00,'pending','pending','cash_on_delivery','Abdelnaby Mohamed','abdelnabymohamed277@gmail.com','+201005726595','54 El-Bostan','Cairo','Egypt','00000',NULL,'2026-02-17 13:03:29','2026-02-17 13:03:29'),(8,1,'ORD-699467C42E95E',750.00,50.00,800.00,'pending','pending','cash_on_delivery','Abdelnaby Mohamed','abdelnabymohamed277@gmail.com','+201005726595','54 El-Bostan','Cairo','Egypt','00000',NULL,'2026-02-17 13:06:12','2026-02-17 13:06:12');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `features` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `main_image` varchar(255) NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `size` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `fabric` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_new_arrival` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_slug_unique` (`slug`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_sort_order_index` (`sort_order`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'ASIL | ╪ú┘Ä╪╡┘É┘è┘ä','asil-asyl','GCA-001','╪¬╪╡┘à┘è┘à ┘è╪¼┘à╪╣ ╪¿┘è┘å ╪╣╪▒╪º┘é╪⌐ ╪º┘ä┘ü┘å ╪º┘ä╪Ñ╪│┘ä╪º┘à┘è ┘ê╪¡╪»╪º╪½╪⌐ ╪º┘ä┘é╪╡╪⌐╪î ┘ä┘è╪╣╪¿╪▒ ╪╣┘å ╪¼╪░┘ê╪▒┘å╪º ╪¿╪ú╪│┘ä┘ê╪¿ ╪╣╪╡╪▒┘è.',NULL,700.00,NULL,'images/products/1771265177_69935c99dfc4e.PNG','[\"images\\/products\\/1771265177_69935c99dffa9.PNG\",\"images\\/products\\/1771265177_69935c99e0266.PNG\",\"images\\/products\\/1771265177_69935c99e0403.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,0,1,1,1,0,7,'2026-02-16 14:41:11','2026-02-17 12:54:30'),(2,1,'ZOMORROD | ╪▓┘Å┘à┘Å╪▒┘æ┘Å╪»','zomorrod-zmrd','MPA-002','╪¬╪»╪º╪«┘ä ┘ç┘å╪»╪│┘è ╪¿╪º┘ä┘ä┘ê┘å ╪º┘ä╪ú╪«╪╢╪▒ ╪º┘ä┘à┘ä┘â┘è ╪º┘ä┘à╪│╪¬┘ê╪¡┘ë ┘à┘å ╪º┘ä╪ú╪¡╪¼╪º╪▒ ╪º┘ä┘â╪▒┘è┘à╪⌐╪î ┘ä╪╖┘ä┘æ╪⌐ ┘à╪¬┘à┘è╪▓╪⌐ ┘ê╪¼╪▒┘è╪ª╪⌐.',NULL,650.00,NULL,'images/products/1771268158_6993683e885cf.PNG','[\"images\\/products\\/1771262975_699353ff96da4.PNG\",\"images\\/products\\/1771262975_699353ff96f69.PNG\",\"images\\/products\\/1771262975_699353ff970e7.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,20,1,0,1,2,1,'2026-02-16 14:41:11','2026-02-16 18:55:58'),(3,1,'DEEM | ╪»┘É┘è┘à','deem-dym','EED-003','┘å┘é╪┤╪º╪¬ ╪▒┘é┘è┘é╪⌐ ┘â┘é╪╖╪▒╪º╪¬ ╪º┘ä┘à╪╖╪▒ ╪╣┘ä┘ë ┘é┘à╪º╪┤ ┘ü╪«┘à╪î ╪¬╪╣┘â╪│ ╪º┘ä┘ç╪»┘ê╪í ┘ê╪º┘ä╪¿╪│╪º╪╖╪⌐ ┘ü┘è ╪ú╪¿┘ç┘ë ╪╡┘ê╪▒┘ç╪º.     ╪╖┘é┘à ╪╡┘ä╪º╪⌐',NULL,650.00,NULL,'images/products/1771263542_6993563603fa0.PNG','[\"images\\/products\\/1771263542_69935636042eb.PNG\",\"images\\/products\\/1771263542_6993563604524.PNG\",\"images\\/products\\/1771263542_699356360473d.PNG\",\"images\\/products\\/1771263542_699356360490f.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,8,0,1,1,4,5,'2026-02-16 14:41:11','2026-02-16 19:45:18'),(4,1,'HALA | ┘ç┘Ä╪º┘ä┘Ä╪⌐','hala-hal','CBA-004','╪»┘ê╪º╪ª╪▒ ┘à┘å ╪º┘ä┘å┘ê╪▒ ┘ê╪º┘ä╪ú┘ä┘ê╪º┘å ╪º┘ä┘ç╪º╪»╪ª╪⌐ ╪¬╪¡┘è╪╖ ╪¿┘â┘É╪î ┘à╪╡┘à┘à╪⌐ ┘ä┘à┘å ╪¬╪¿╪¡╪½ ╪╣┘å ╪º┘ä╪¬┘ü╪▒╪» ┘ê╪º┘ä╪│┘â┘è┘å╪⌐.',NULL,750.00,NULL,'images/products/1771262652_699352bc5a616.PNG','[\"images\\/products\\/1771262652_699352bc5ad90.PNG\",\"images\\/products\\/1771262652_699352bc5afc8.PNG\",\"images\\/products\\/1771262652_699352bc5b1bc.PNG\",\"images\\/products\\/1771262652_699352bc5b329.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,10,1,0,1,3,0,'2026-02-16 14:41:11','2026-02-16 18:03:55'),(5,1,'REMAL | ╪▒┘É┘à┘Ä╪º┘ä','remal-rmal','RVA-005','╪ú┘ä┘ê╪º┘å ╪¬╪▒╪º╪¿┘è╪⌐ ╪»╪º┘ü╪ª╪⌐ ┘ê┘å┘é╪┤╪º╪¬ ╪º┘å╪│┘è╪º╪¿┘è╪⌐ ╪¬╪¡╪º┘â┘è ╪│╪¡╪▒ ╪º┘ä╪╡╪¡╪▒╪º╪í ┘ê╪¬┘å╪º╪║┘à ╪º┘ä╪╖╪¿┘è╪╣╪⌐.',NULL,750.00,NULL,'images/products/1771262357_69935195b1eeb.PNG','[\"images\\/products\\/1771262357_69935195b24ad.PNG\",\"images\\/products\\/1771262357_69935195b2970.PNG\",\"images\\/products\\/1771262357_69935195b2c76.PNG\",\"images\\/products\\/1771262357_69935195b335f.PNG\",\"images\\/products\\/1771262357_69935195b36be.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,10,0,0,1,5,2,'2026-02-16 14:41:11','2026-02-16 18:03:55'),(6,1,'NOURAY | ┘å┘Å┘ê╪▒┘Ä╪º┘è','nouray-noray','CTD-006','╪Ñ╪┤╪▒╪º┘é╪⌐ ┘à┘ä┘â┘è╪⌐ ┘à┘å ╪º┘ä╪ú╪¿┘è╪╢ ╪º┘ä┘å┘é┘è╪î ┘à╪▓┘è┘å╪⌐ ╪¿╪¬╪╖╪▒┘è╪▓╪º╪¬ ╪»┘é┘è┘é╪⌐ ╪¬╪╢┘ü┘è ┘ä┘à╪│╪⌐ ┘à┘å ╪º┘ä┘å╪¿┘ä ┘ê╪º┘ä┘ê┘é╪º╪▒.',NULL,650.00,NULL,'images/products/1771261936_69934ff05db62.PNG','[\"images\\/products\\/1771261936_69934ff05e69d.PNG\",\"images\\/products\\/1771261936_69934ff05e978.PNG\",\"images\\/products\\/1771261936_69934ff05ed2d.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,10,0,0,1,1,6,'2026-02-16 14:41:11','2026-02-17 12:02:21'),(8,1,'SEDEER | ╪│┘Ä╪»┘É┘è╪▒','sedeer-sdyr','GEO-008','╪¬╪¿╪º┘è┘å ╪▒╪º┘é┘ì ╪¿┘è┘å ╪º┘ä╪ú╪¿┘è╪╢ ┘ê╪º┘ä╪ú╪│┘ê╪» ┘ü┘è ╪«╪╖┘ê╪╖ ┘ç┘å╪»╪│┘è╪⌐ ┘é┘ê┘è╪⌐╪î ╪¬┘à┘å╪¡┘â┘É ╪¡╪╢┘ê╪▒╪º┘ï ┘ä╪º┘ü╪¬╪º┘ï ┘ê┘à┘à┘è╪▓╪º┘ï.',NULL,650.00,NULL,'images/products/1771265608_69935e48443dc.PNG','[\"images\\/products\\/1771265608_69935e484465d.PNG\",\"images\\/products\\/1771265608_69935e4844834.PNG\",\"images\\/products\\/1771265608_69935e4844aef.PNG\",\"images\\/products\\/1771265608_69935e4844c9b.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,10,0,0,1,0,3,'2026-02-16 18:13:28','2026-02-17 12:02:30'),(9,1,'TARAF | ╪¬┘Ä╪▒┘Ä┘ü','taraf-trf','LUX-009','╪º┘å╪│┘è╪º╪¿┘è╪⌐ ┘ü╪º╪ª┘é╪⌐ ┘ê┘é╪╡╪⌐ ┘ê╪º╪│╪╣╪⌐ ╪¬┘ê┘ü╪▒ ┘ä┘â┘É ╪ú┘é╪╡┘ë ╪»╪▒╪¼╪º╪¬ ╪º┘ä╪▒╪º╪¡╪⌐ ┘à╪╣ ╪º┘ä╪¡┘ü╪º╪╕ ╪╣┘ä┘ë ╪ú┘å╪º┘é╪⌐ ┘ä╪º ╪¬╪╢╪º┘ç┘ë.',NULL,750.00,NULL,'images/products/1771265736_69935ec8dcab8.PNG','[\"images\\/products\\/1771265736_69935ec8dcde6.PNG\",\"images\\/products\\/1771265736_69935ec8dcf92.PNG\",\"images\\/products\\/1771265736_69935ec8dd423.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,10,0,0,1,0,3,'2026-02-16 18:15:36','2026-02-17 12:02:50'),(10,1,'SADEEM | ╪│┘Ä╪»┘É┘è┘à','sadeem-sdym','BLK-002','╪║┘à┘ê╪╢ ╪º┘ä╪ú╪│┘ê╪» ╪º┘ä┘ü╪º╪«╪▒ ┘è┘ä╪¬┘é┘è ╪¿╪▒┘é╪⌐ ╪º┘ä╪»╪º┘å╪¬┘è┘ä╪î ╪╡┘Å┘à┘à ┘ä┘è╪╣┘â╪│ ┘ç┘è╪¿╪⌐ ╪º┘ä╪¡╪╢┘ê╪▒ ┘ê╪│┘â┘è┘å╪⌐ ╪º┘ä╪▒┘ê╪¡.',NULL,650.00,NULL,'images/products/1771265853_69935f3db1c8a.PNG','[\"images\\/products\\/1771265853_69935f3db2178.PNG\",\"images\\/products\\/1771265853_69935f3db2524.PNG\",\"images\\/products\\/1771265853_69935f3db273d.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,10,0,0,1,0,3,'2026-02-16 18:17:33','2026-02-17 12:02:09'),(11,1,'JINAN | ╪¼┘É┘å┘Ä╪º┘å','jinan-gnan','FLR-007','╪¬┘ü╪º╪╡┘è┘ä ╪▓┘ç╪▒┘è╪⌐ ┘à┘à╪¬╪»╪⌐ ╪╣┘ä┘ë ╪«┘ä┘ü┘è╪⌐ ╪¿┘è╪╢╪º╪í ╪╡╪º┘ü┘è╪⌐╪î ╪¬╪¼╪│╪» ╪¡╪»┘è┘é╪⌐ ┘à┘å ╪º┘ä╪╖┘à╪ú┘å┘è┘å╪⌐ ┘ê╪º┘ä╪¼┘à╪º┘ä.',NULL,750.00,NULL,'images/products/1771265953_69935fa12b22e.PNG','[\"images\\/products\\/1771265953_69935fa12b5c2.PNG\",\"images\\/products\\/1771265953_69935fa12b7df.PNG\",\"images\\/products\\/1771265953_69935fa12b9d0.PNG\"]','One Size (160cm height ├ù 90cm width)',NULL,NULL,4,0,0,1,0,9,'2026-02-16 18:19:13','2026-02-17 13:06:12');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_notifications`
--

DROP TABLE IF EXISTS `stock_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `notified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stock_notifications_token_unique` (`token`),
  KEY `stock_notifications_product_id_email_index` (`product_id`,`email`),
  CONSTRAINT `stock_notifications_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_notifications`
--

LOCK TABLES `stock_notifications` WRITE;
/*!40000 ALTER TABLE `stock_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `stock_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'Egypt',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Abdelnaby Mohamed','abdelnabymohamed277@gmial.com',NULL,'$2y$10$HhiOusPz9N0u9axEunMBuu/t.anX79ecdFYlX3CxLEdHGYZXodjWu',1,'+20 123 456 7890',NULL,'Cairo','Egypt','eTynju0bBmp9O7EwKntzwO8o6CkXVFpRRYMFd8FTPCbPaFq8y4qkjDZera1v','2026-02-16 14:39:00','2026-02-16 14:39:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-02-17 15:28:58
