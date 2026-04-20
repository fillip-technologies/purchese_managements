-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2026 at 02:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `purchasesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approval_status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `comments` text DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(150) NOT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `company_name`, `address`, `contact_person`, `phone`, `email`, `gst_no`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Client 1', 'Company 1', 'Address 1, Patna, Bihar', 'Person 1', '900000001', 'client1@example.com', 'GSTIN001', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(2, 'Client 2', 'Company 2', 'Address 2, Patna, Bihar', 'Person 2', '900000002', 'client2@example.com', 'GSTIN002', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(3, 'Client 3', 'Company 3', 'Address 3, Patna, Bihar', 'Person 3', '900000003', 'client3@example.com', 'GSTIN003', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(4, 'Client 4', 'Company 4', 'Address 4, Patna, Bihar', 'Person 4', '900000004', 'client4@example.com', 'GSTIN004', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(5, 'Client 5', 'Company 5', 'Address 5, Patna, Bihar', 'Person 5', '900000005', 'client5@example.com', 'GSTIN005', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(6, 'Client 6', 'Company 6', 'Address 6, Patna, Bihar', 'Person 6', '900000006', 'client6@example.com', 'GSTIN006', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(7, 'Client 7', 'Company 7', 'Address 7, Patna, Bihar', 'Person 7', '900000007', 'client7@example.com', 'GSTIN007', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(8, 'Client 8', 'Company 8', 'Address 8, Patna, Bihar', 'Person 8', '900000008', 'client8@example.com', 'GSTIN008', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(9, 'Client 9', 'Company 9', 'Address 9, Patna, Bihar', 'Person 9', '900000009', 'client9@example.com', 'GSTIN009', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42'),
(10, 'Client 10', 'Company 10', 'Address 10, Patna, Bihar', 'Person 10', '9000000010', 'client10@example.com', 'GSTIN0010', 'active', '2026-04-17 00:52:42', '2026-04-17 00:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dispatch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `received_by_name` varchar(255) DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `drop_point` varchar(255) DEFAULT NULL,
  `received_photo` varchar(255) DEFAULT NULL,
  `receipt_file` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dispatches`
--

CREATE TABLE `dispatches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `dispatch_date` datetime DEFAULT NULL,
  `transport_mode` varchar(255) DEFAULT NULL,
  `vehicle_no` varchar(255) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `driver_phone` varchar(255) DEFAULT NULL,
  `from_location` varchar(255) DEFAULT NULL,
  `to_location` varchar(255) DEFAULT NULL,
  `transport_cost` decimal(12,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `dispatch_photo` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dispatches`
--

INSERT INTO `dispatches` (`id`, `purchase_order_id`, `dispatch_date`, `transport_mode`, `vehicle_no`, `driver_name`, `driver_phone`, `from_location`, `to_location`, `transport_cost`, `remarks`, `dispatch_photo`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 3, '2026-04-03 18:20:00', 'Truk', 'bir-2345', 'johan', '4567890987', 'patna', 'ballia', 3432.00, 'test', 'dispatchs/1776516700.png', 2, '2026-04-18 07:21:40', '2026-04-18 07:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 2),
(3, '0001_01_01_000002_create_jobs_table', 2),
(4, '2026_04_16_102609_create_roles_table', 2),
(5, '2026_04_17_044422_create_products_table', 3),
(6, '2026_04_17_044454_create_clients_table', 3),
(7, '2026_04_17_044624_create_vendors_table', 3),
(8, '2026_04_17_054041_create_purchase_requisitions_table', 4),
(9, '2026_04_17_054041_create_vendor_products_table', 4),
(10, '2026_04_17_054042_create_purchase_requisition_items_table', 4),
(11, '2026_04_17_054526_create_purchase_order_items_table', 10),
(12, '2026_04_17_054526_create_purchase_orders_table', 11),
(13, '2026_04_17_054527_create_approvals_table', 11),
(14, '2026_04_17_055017_create_dispatches_table', 12),
(15, '2026_04_17_055018_create_deliveries_table', 12),
(16, '2026_04_17_055018_create_purchase_bills_table', 12),
(17, '2026_04_17_055019_create_stock_movements_table', 12),
(18, '2026_04_17_055019_create_stocks_table', 12);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `sku_code` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `base_price` decimal(12,2) DEFAULT NULL,
  `gst_percent` decimal(5,2) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `sku_code`, `category`, `description`, `unit`, `base_price`, `gst_percent`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'SKU001', 'Category 2', 'Sample description for product 1', 'pcs', 140.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(2, 'Product 2', 'SKU002', 'Category 1', 'Sample description for product 2', 'pcs', 696.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(3, 'Product 3', 'SKU003', 'Category 2', 'Sample description for product 3', 'pcs', 152.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(4, 'Product 4', 'SKU004', 'Category 2', 'Sample description for product 4', 'pcs', 939.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(5, 'Product 5', 'SKU005', 'Category 1', 'Sample description for product 5', 'pcs', 872.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(6, 'Product 6', 'SKU006', 'Category 2', 'Sample description for product 6', 'pcs', 734.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(7, 'Product 7', 'SKU007', 'Category 3', 'Sample description for product 7', 'pcs', 466.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(8, 'Product 8', 'SKU008', 'Category 2', 'Sample description for product 8', 'pcs', 824.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(9, 'Product 9', 'SKU009', 'Category 2', 'Sample description for product 9', 'pcs', 874.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53'),
(10, 'Product 10', 'SKU0010', 'Category 3', 'Sample description for product 10', 'pcs', 576.00, 18.00, 'active', '2026-04-17 00:53:53', '2026-04-17 00:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bills`
--

CREATE TABLE `purchase_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `uploaded_by` bigint(11) NOT NULL,
  `bill_no` varchar(255) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `bill_amount` decimal(12,2) DEFAULT NULL,
  `gst_amount` decimal(12,2) DEFAULT NULL,
  `total_amount` decimal(12,2) DEFAULT NULL,
  `bill_file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_bills`
--

INSERT INTO `purchase_bills` (`id`, `purchase_order_id`, `vendor_id`, `uploaded_by`, `bill_no`, `bill_date`, `bill_amount`, `gst_amount`, `total_amount`, `bill_file`, `created_at`, `updated_at`) VALUES
(2, 3, 1, 2, 'Bill-001', '2026-04-18', 200.00, 60.00, 260.00, 'bills/1776515061.png', '2026-04-18 06:54:21', '2026-04-18 06:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_number` varchar(255) DEFAULT NULL,
  `requisition_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vendor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `subtotal` decimal(12,2) DEFAULT NULL,
  `gst_amount` decimal(12,2) DEFAULT NULL,
  `total_amount` decimal(12,2) DEFAULT NULL,
  `status` enum('pending_approval','approved','sent_to_vendor','in_progress','dispatched','completed') NOT NULL DEFAULT 'pending_approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po_number`, `requisition_id`, `vendor_id`, `client_id`, `approved_by`, `subtotal`, `gst_amount`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(3, 'PO-2026-04-001', 6, 1, 1, 1, 280.00, 50.40, 330.40, 'approved', '2026-04-18 01:09:18', '2026-04-18 01:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchase_order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `gst_percent` decimal(5,2) DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `product_id`, `quantity`, `price`, `gst_percent`, `total`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 2.00, 140.00, NULL, 280.00, '2026-04-18 01:09:18', '2026-04-18 01:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisitions`
--

CREATE TABLE `purchase_requisitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `req_no` varchar(255) DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `requested_by` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` enum('draft','submitted','approved','rejected','po_created') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_requisitions`
--

INSERT INTO `purchase_requisitions` (`id`, `req_no`, `client_id`, `project_name`, `requested_by`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(6, 'PR-20260418-823', 1, 'Zoo Projects', 2, 'This is the very argents', 'approved', '2026-04-17 23:22:03', '2026-04-18 01:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_requisition_items`
--

CREATE TABLE `purchase_requisition_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `requisition_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_requisition_items`
--

INSERT INTO `purchase_requisition_items` (`id`, `requisition_id`, `product_id`, `quantity`, `unit`, `remarks`, `created_at`, `updated_at`) VALUES
(2, 6, 1, 2.00, '3', 'Argents', '2026-04-17 23:22:03', '2026-04-17 23:22:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','user') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2026-04-16 05:18:53', '2026-04-16 05:18:59'),
(2, 'user', '2026-04-17 05:18:24', '2026-04-17 05:18:24');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `available_qty` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock_movements`
--

CREATE TABLE `stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `movement_type` enum('in','out') NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `reference_type` varchar(255) DEFAULT NULL,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `email` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `password`, `role_id`, `phone`, `status`, `email`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '$2y$12$2TCd9g6zEB8aM/M8YDwDaOqG91UNbP9e8XXh4ty4/AI572rEauece', 1, '2288990022', 'active', 'admin@gmail.com', NULL, '2026-04-16 05:12:22', '2026-04-16 05:12:22'),
(2, 'User 1', '$2y$12$Pd8Wfu0JD.3rZfA9Kj6CKO8aTvOMMCIaN7NI5/5N6wdtbWj62kNM6', 2, '987654321', 'active', 'user1@gmail.com', NULL, '2026-04-17 00:51:38', '2026-04-17 00:51:38'),
(3, 'User 2', '$2y$12$IRJWtaZ8oIl/asNCEs0SYOO7YnHgbokQee/oP6siS1485ZNDzajn.', 2, '987654322', 'active', 'user2@gmail.com', NULL, '2026-04-17 00:51:38', '2026-04-17 00:51:38'),
(4, 'User 3', '$2y$12$f76OPwSF2qB/GDExXwHtYu3FCrkknPCSmgbT2DNc32HIV9X3Xqv0S', 2, '987654323', 'active', 'user3@gmail.com', NULL, '2026-04-17 00:51:39', '2026-04-17 00:51:39'),
(5, 'User 4', '$2y$12$WtdcBA0EYMqWojn8AmBszOf0k0ARFKrubtR6SOA9NcNglqrjnhkay', 2, '987654324', 'active', 'user4@gmail.com', NULL, '2026-04-17 00:51:39', '2026-04-17 00:51:39'),
(6, 'User 5', '$2y$12$Bp603Z2DC9PF/M3PAwOGp.X7B/dz9uqDJWkazYMXFh61QC7.f8CQK', 2, '987654325', 'active', 'user5@gmail.com', NULL, '2026-04-17 00:51:39', '2026-04-17 00:51:39'),
(7, 'User 6', '$2y$12$PRtv/Yy4xdhIYfQvvbo.AubisSdf33pL14KH0lfJc4utqwLtWyFgK', 2, '987654326', 'active', 'user6@gmail.com', NULL, '2026-04-17 00:51:39', '2026-04-17 00:51:39'),
(8, 'User 7', '$2y$12$CxBTDPTXR2jO0LthCpDGTO6QSZHYZZxCLx5fGMohmM3pQVKZs4YvK', 2, '987654327', 'active', 'user7@gmail.com', NULL, '2026-04-17 00:51:40', '2026-04-17 00:51:40'),
(9, 'User 8', '$2y$12$DfYuq6up7jjfZ5SGHKJ7c.gT0whTTU3FG7IxSVTCJrpMBUWlkYfOC', 2, '987654328', 'active', 'user8@gmail.com', NULL, '2026-04-17 00:51:40', '2026-04-17 00:51:40'),
(10, 'User 9', '$2y$12$Bw3oGVmKGehUnDVouWnZY.XvpWLRiEhI7LojEGyV2qHtL7N1DeNpe', 2, '987654329', 'active', 'user9@gmail.com', NULL, '2026-04-17 00:51:40', '2026-04-17 00:51:40'),
(11, 'User 10', '$2y$12$jg.H8IrmyHpw4oi3fmgcTurACwXUEFTqNGYbaAWYoq2ZBMHcrp0k6', 2, '9876543210', 'active', 'user10@gmail.com', NULL, '2026-04-17 00:51:40', '2026-04-17 00:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_name` varchar(150) NOT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `company_name`, `gst_no`, `address`, `contact_person`, `phone`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Vendor 1', 'Company 1', 'GSTIN001', 'Address 1, Bihar', 'Person 1', '900000001', 'vendor1@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(2, 'Vendor 2', 'Company 2', 'GSTIN002', 'Address 2, Bihar', 'Person 2', '900000002', 'vendor2@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(3, 'Vendor 3', 'Company 3', 'GSTIN003', 'Address 3, Bihar', 'Person 3', '900000003', 'vendor3@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(4, 'Vendor 4', 'Company 4', 'GSTIN004', 'Address 4, Bihar', 'Person 4', '900000004', 'vendor4@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(5, 'Vendor 5', 'Company 5', 'GSTIN005', 'Address 5, Bihar', 'Person 5', '900000005', 'vendor5@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(6, 'Vendor 6', 'Company 6', 'GSTIN006', 'Address 6, Bihar', 'Person 6', '900000006', 'vendor6@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(7, 'Vendor 7', 'Company 7', 'GSTIN007', 'Address 7, Bihar', 'Person 7', '900000007', 'vendor7@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(8, 'Vendor 8', 'Company 8', 'GSTIN008', 'Address 8, Bihar', 'Person 8', '900000008', 'vendor8@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(9, 'Vendor 9', 'Company 9', 'GSTIN009', 'Address 9, Bihar', 'Person 9', '900000009', 'vendor9@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53'),
(10, 'Vendor 10', 'Company 10', 'GSTIN0010', 'Address 10, Bihar', 'Person 10', '9000000010', 'vendor10@example.com', 'active', '2026-04-17 00:54:53', '2026-04-17 00:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_products`
--

CREATE TABLE `vendor_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `gst_percent` decimal(5,2) DEFAULT NULL,
  `lead_time_days` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_products`
--

INSERT INTO `vendor_products` (`id`, `vendor_id`, `product_id`, `price`, `gst_percent`, `lead_time_days`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 933.00, 12.00, 5, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(2, 1, 7, 1639.00, 12.00, 2, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(3, 1, 9, 4343.00, 12.00, 6, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(4, 2, 3, 2638.00, 18.00, 9, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(5, 2, 6, 1830.00, 18.00, 4, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(6, 2, 9, 2257.00, 5.00, 6, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(7, 3, 3, 4420.00, 12.00, 8, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(8, 3, 5, 371.00, 12.00, 10, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(9, 3, 7, 653.00, 18.00, 10, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(10, 3, 8, 2619.00, 12.00, 8, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(11, 3, 10, 987.00, 12.00, 5, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(12, 4, 2, 1685.00, 18.00, 9, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(13, 4, 8, 1733.00, 5.00, 10, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(14, 5, 7, 1062.00, 12.00, 1, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(15, 5, 10, 2776.00, 5.00, 4, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(16, 6, 2, 2017.00, 12.00, 3, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(17, 6, 3, 2137.00, 12.00, 9, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(18, 6, 5, 3885.00, 12.00, 5, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(19, 6, 8, 2961.00, 18.00, 10, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(20, 7, 3, 3517.00, 18.00, 9, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(21, 7, 5, 579.00, 18.00, 6, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(22, 8, 1, 1102.00, 12.00, 5, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(23, 8, 4, 266.00, 12.00, 8, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(24, 8, 10, 3246.00, 5.00, 1, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(25, 9, 2, 189.00, 5.00, 8, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(26, 9, 7, 2527.00, 12.00, 7, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(27, 10, 2, 119.00, 5.00, 6, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(28, 10, 3, 916.00, 12.00, 4, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(29, 10, 5, 3270.00, 12.00, 8, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(30, 10, 6, 1307.00, 12.00, 7, '2026-04-17 00:56:20', '2026-04-17 00:56:20'),
(31, 10, 8, 577.00, 12.00, 2, '2026-04-17 00:56:20', '2026-04-17 00:56:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approvals_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `approvals_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_dispatch_id_foreign` (`dispatch_id`);

--
-- Indexes for table `dispatches`
--
ALTER TABLE `dispatches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dispatches_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `dispatches_created_by_foreign` (`created_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_code_unique` (`sku_code`);

--
-- Indexes for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_bills_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `purchase_bills_vendor_id_foreign` (`vendor_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_orders_po_number_unique` (`po_number`),
  ADD KEY `purchase_orders_requisition_id_foreign` (`requisition_id`),
  ADD KEY `purchase_orders_vendor_id_foreign` (`vendor_id`),
  ADD KEY `purchase_orders_client_id_foreign` (`client_id`),
  ADD KEY `purchase_orders_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_requisitions`
--
ALTER TABLE `purchase_requisitions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_requisitions_req_no_unique` (`req_no`),
  ADD KEY `purchase_requisitions_client_id_foreign` (`client_id`),
  ADD KEY `purchase_requisitions_requested_by_foreign` (`requested_by`);

--
-- Indexes for table `purchase_requisition_items`
--
ALTER TABLE `purchase_requisition_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_requisition_items_requisition_id_foreign` (`requisition_id`),
  ADD KEY `purchase_requisition_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_product_id_foreign` (`product_id`);

--
-- Indexes for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_movements_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_products`
--
ALTER TABLE `vendor_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_products_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_products_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dispatches`
--
ALTER TABLE `dispatches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_requisitions`
--
ALTER TABLE `purchase_requisitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_requisition_items`
--
ALTER TABLE `purchase_requisition_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_movements`
--
ALTER TABLE `stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vendor_products`
--
ALTER TABLE `vendor_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `approvals`
--
ALTER TABLE `approvals`
  ADD CONSTRAINT `approvals_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `approvals_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_dispatch_id_foreign` FOREIGN KEY (`dispatch_id`) REFERENCES `dispatches` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dispatches`
--
ALTER TABLE `dispatches`
  ADD CONSTRAINT `dispatches_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `dispatches_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_bills`
--
ALTER TABLE `purchase_bills`
  ADD CONSTRAINT `purchase_bills_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_bills_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_orders_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `purchase_requisitions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_orders_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_requisitions`
--
ALTER TABLE `purchase_requisitions`
  ADD CONSTRAINT `purchase_requisitions_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_requisitions_requested_by_foreign` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `purchase_requisition_items`
--
ALTER TABLE `purchase_requisition_items`
  ADD CONSTRAINT `purchase_requisition_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_requisition_items_requisition_id_foreign` FOREIGN KEY (`requisition_id`) REFERENCES `purchase_requisitions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stock_movements`
--
ALTER TABLE `stock_movements`
  ADD CONSTRAINT `stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vendor_products`
--
ALTER TABLE `vendor_products`
  ADD CONSTRAINT `vendor_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vendor_products_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
