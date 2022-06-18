-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2022 at 12:06 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `kategori` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `nama`, `harga`, `kategori`, `created_at`, `updated_at`) VALUES
(1, 'Rendang', 8000, 1, '2022-06-11 08:58:39', '2022-06-11 08:58:39'),
(2, 'Es Teh Manis', 3000, 2, '2022-06-11 09:05:22', '2022-06-11 09:05:22'),
(4, 'Tunjang', 15000, 1, '2022-06-12 06:53:15', '2022-06-12 06:53:15'),
(5, 'Ikan Bakar', 12500, 1, '2022-06-12 06:53:25', '2022-06-12 06:53:25'),
(6, 'Es Jeruk', 7000, 2, '2022-06-12 06:53:37', '2022-06-12 06:53:37'),
(7, 'Kerupuk Ikan', 5000, 3, '2022-06-12 06:53:50', '2022-06-12 06:53:50'),
(8, 'Ayam Bakar', 10000, 1, '2022-06-12 06:54:10', '2022-06-12 07:53:24'),
(9, 'Jengkol', 2000, 1, '2022-06-13 17:22:44', '2022-06-13 17:22:44'),
(10, 'Ikan Bakar', 12000, 1, '2022-06-18 01:36:08', '2022-06-18 01:36:08'),
(11, 'Jeruk Anget', 4000, 2, '2022-06-18 01:36:22', '2022-06-18 01:36:22'),
(12, 'Kacang Bawang', 2000, 3, '2022-06-18 01:36:35', '2022-06-18 01:36:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2022_06_11_131414_create_users_table', 2),
(6, '2022_06_11_145741_create_foods_table', 3),
(7, '2022_06_11_151951_add_kategori_to_foods_table', 4),
(8, '2022_06_11_152056_create_foods_table', 5),
(9, '2022_06_11_155559_create_foods_table', 6),
(10, '2022_06_11_174615_create_orders_table', 7),
(11, '2022_06_12_151047_create_orders_table', 8),
(12, '2022_06_13_224711_create_orders_table', 9),
(13, '2022_06_13_230140_create_transactions_table', 10),
(14, '2022_06_13_233223_create_transactions_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `kode`, `nama`, `harga`, `qty`, `subtotal`, `status`, `bayar`, `kembalian`, `created_at`, `updated_at`) VALUES
(4, 'TRX-0008', 'Jengkol', 2000, 5, 10000, 1, 0, 0, '2022-06-13 17:23:19', '2022-06-13 17:23:19'),
(5, 'TRX-0008', 'Es Jeruk', 7000, 1, 7000, 1, 0, 0, '2022-06-13 17:23:27', '2022-06-13 17:23:27'),
(6, 'TRX-0008', 'Tunjang', 15000, 1, 15000, 1, 0, 0, '2022-06-13 17:23:35', '2022-06-13 17:23:35'),
(7, 'TRX-0009', 'Ayam Bakar', 10000, 1, 10000, 1, 0, 0, '2022-06-18 01:34:18', '2022-06-18 01:34:18'),
(8, 'TRX-0009', 'Es Teh Manis', 3000, 1, 3000, 1, 0, 0, '2022-06-18 01:34:24', '2022-06-18 01:34:24'),
(10, 'TRX-0010', 'Ayam Bakar', 10000, 1, 10000, 1, 0, 0, '2022-06-18 02:53:21', '2022-06-18 02:53:21'),
(11, 'TRX-0010', 'Ikan Bakar', 12500, 1, 12500, 1, 0, 0, '2022-06-18 02:53:25', '2022-06-18 02:53:25'),
(12, 'TRX-0010', 'Jengkol', 2000, 10, 20000, 1, 0, 0, '2022-06-18 09:56:30', '2022-06-18 09:56:30'),
(13, 'TRX-0010', 'Kacang Bawang', 2000, 1, 2000, 1, 0, 0, '2022-06-18 10:00:38', '2022-06-18 10:00:38'),
(14, 'TRX-0010', 'Jeruk Anget', 4000, 10, 40000, 1, 0, 0, '2022-06-18 10:00:44', '2022-06-18 10:00:44'),
(15, 'TRX-0010', 'Es Jeruk', 7000, 1, 7000, 1, 0, 0, '2022-06-18 10:01:04', '2022-06-18 10:01:04'),
(16, 'TRX-0010', 'Es Teh Manis', 3000, 5, 15000, 1, 0, 0, '2022-06-18 10:02:44', '2022-06-18 10:02:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$I/qeZru.BUaiVUS1IGqbjOHFnd.wsP8npFhtEhZAXTeLugpvOp12y', '2022-06-11 05:55:16');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `kode`, `total`, `bayar`, `kembalian`, `created_at`, `updated_at`) VALUES
(8, 'TRX-0008', 32000, 33000, 1000, '2022-06-18 01:30:40', '2022-06-18 01:30:40'),
(9, 'TRX-0009', 13000, 15000, 2000, '2022-06-18 01:34:29', '2022-06-18 01:34:29'),
(10, 'TRX-0010', 22500, 22500, 0, '2022-06-18 02:54:17', '2022-06-18 02:54:17'),
(11, 'TRX-0010', 20000, 20000, 0, '2022-06-18 09:56:34', '2022-06-18 09:56:34'),
(12, 'TRX-0010', 49000, 50000, 1000, '2022-06-18 10:01:10', '2022-06-18 10:01:10'),
(13, 'TRX-0010', 15000, 20000, 5000, '2022-06-18 10:02:50', '2022-06-18 10:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `last_name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'admin@gmail.com', NULL, '$2y$10$h02f75uPc5bP2StB/rIEUezY.mYq1/8Kp7LVvnyABnucXeq4jlrai', 1, NULL, '2022-06-11 06:21:10', '2022-06-18 01:40:42'),
(4, 'Joko', 'Pitoyo', 'joko@gmail.com', NULL, '$2y$10$rgyXYCF36nhm9iuRtJIrEeQ56K53J5iig873GJeoI2SevVe0Oy7CG', 2, NULL, '2022-06-11 07:52:13', '2022-06-11 07:52:22'),
(5, 'Bambang', 'Susanto', 'bambang@gmail.com', NULL, '$2y$10$XbuyN9d19CfuwhahbxAcaupH7fnYSQ3xlhwZXYWbQ4T/o8VxDz4K.', 2, NULL, '2022-06-11 08:54:44', '2022-06-11 08:54:44'),
(6, 'Anjas', 'Awaludin', 'anjas@gmail.com', NULL, '$2y$10$M7AaB0y7feQBuHqC09VPlugAv7Fp6dW4uS63nQZU0nPublNNzPe4a', 2, NULL, '2022-06-18 09:57:47', '2022-06-18 09:57:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
