-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2020 at 06:51 AM
-- Server version: 5.5.60-0+deb8u1
-- PHP Version: 5.6.40-0+deb8u8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ditoko`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
`id` int(11) unsigned NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `product_name` varchar(80) NOT NULL,
  `detloc_id` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `size` varchar(50) NOT NULL,
  `variant` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(80) NOT NULL,
  `total` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `order_id`, `product_id`, `product_name`, `detloc_id`, `weight`, `size`, `variant`, `qty`, `price`, `total`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '1011202001', 5, 'SW17', 2, 400, '39', 'kuning', 1, '50000', 50000, 1, '2020-11-05 05:09:24', '2020-11-25 22:43:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) unsigned NOT NULL DEFAULT '0',
  `name` varchar(80) NOT NULL,
  `type` varchar(15) NOT NULL,
  `param` varchar(20) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `type`, `param`, `sub_id`, `slug`, `photo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Pria', 'category', 'menu', 0, 'pria', 'black-and-white-1.-pria.png', 1, '2020-10-10 07:18:43', NULL, NULL),
(2, 'Sepatu Pria', 'subcategory', 'brand', 1, 'sepatu-pria', 'SP11-BIRU-1593397837.jpg', 1, '2020-10-10 07:19:53', NULL, NULL),
(3, 'Jam Pria', 'subcategory', 'brand', 1, 'jam-pria', 'JP9-g-1599467047.jpg', 1, '2020-10-10 07:22:18', NULL, NULL),
(4, 'Dompet', 'subcategory', 'menu', 1, 'dompet', 'DP1-iklan-1593741398.jpg', 1, '2020-10-10 07:22:18', NULL, NULL),
(5, 'Baju Pria', 'subcategory', 'brand', 1, 'baju-pria', 'HITAM-1599464204.jpg', 1, '2020-10-10 07:23:59', NULL, NULL),
(6, 'Celana Pria', 'subcategory', 'brand', 1, 'celana-pria', 'cp1-hit-1599466953.jpg', 1, '2020-10-10 07:23:59', NULL, NULL),
(7, 'Kacamata', 'subcategory', 'menu', 1, 'kacamata', 'SG1-1593741249.jpg', 1, '2020-10-10 07:26:07', NULL, NULL),
(8, 'Tas Pria', 'subcategory', 'menu', 1, 'tas-pria', 'tp53-abu-1599469668.jpg', 1, '2020-10-10 07:26:07', NULL, NULL),
(9, 'Wanita', 'category', 'menu', 0, 'wanita', 'black-and-white-2.-wanita.png', 1, '2020-10-10 07:28:00', NULL, NULL),
(10, 'Tas Wanita', 'subcategory', 'brand', 9, 'tas-wanita', 'tw20-putih-1599531216.jpg', 1, '2020-10-10 07:28:00', NULL, NULL),
(11, 'Cincin', 'subcategory', 'menu', 9, 'cincin', '9460817620_1266202242-1593740081.jpg', 1, '2020-10-10 07:30:52', NULL, NULL),
(12, 'Gelang', 'subcategory', 'menu', 9, 'gelang', 'B2-B-1586409297-1591664796.jpg', 1, '2020-10-10 07:30:52', NULL, NULL),
(13, 'Kalung', 'subcategory', 'menu', 9, 'kalung', 'products/N5-1593741265.jpg', 1, '2020-10-10 07:30:55', NULL, NULL),
(14, 'Anting', 'subcategory', 'menu', 9, 'anting', 'PUTIH-1599193395.jpg', 1, '2020-10-10 07:30:55', NULL, NULL),
(15, 'Sepatu Wanita', 'subcategory', 'brand', 9, 'sepatu-wanita', 'ezgif-1596867447.jpg', 1, '2020-10-10 07:34:28', NULL, NULL),
(16, 'Baju Wanita', 'subcategory', 'brand', 9, 'baju-wanita', 'biru-1597806870.jpg', 1, '2020-10-10 07:35:07', NULL, NULL),
(17, 'Celana Wanita', 'subcategory', 'menu', 9, 'celana-wanita', 'Biru-1596701612.jpg', 1, '2020-10-10 07:35:22', NULL, NULL),
(18, 'Jam Wanita', 'subcategory', 'brand', 9, 'jam-wanita', 'COKELAT-1599474429.jpg', 1, '2020-10-10 07:35:22', NULL, NULL),
(19, 'Dompet Wanita', 'subcategory', 'menu', 9, 'dompet-wanita', 'dompet-wanita.png', 1, '2020-10-10 07:36:04', NULL, NULL),
(20, 'Tekno', 'category', 'menu', 0, 'tekno', 'black-and-white-3.-gadget.png', 1, '2020-10-10 07:41:11', NULL, NULL),
(21, 'Oppo', 'subcategory', 'menu', 20, 'oppo', 'Oppo%20Pink-1595211124.jpg', 1, '2020-10-10 07:41:11', NULL, NULL),
(22, 'Xiomi', 'subcategory', 'menu', 20, 'xiomi', 'CS4-1593739078.jpg', 1, '2020-10-10 07:41:11', NULL, NULL),
(23, 'Vivo', 'subcategory', 'menu', 20, 'vivo', 'Vivo%20Pink-1595211038.jpg', 1, '2020-10-10 07:41:11', NULL, NULL),
(24, 'Samsung', 'subcategory', 'menu', 20, 'samsung', 'CS1-1593739857.jpg', 1, '2020-10-10 07:41:11', NULL, NULL),
(25, 'Anak', 'category', 'menu', 0, 'anak', 'black-and-white-4.-anak.png', 1, '2020-10-10 07:43:31', NULL, NULL),
(26, 'Bayi Alat', 'subcategory', 'menu', 25, 'bayi-alat', 'ezgif-1599033125.jpg', 1, '2020-10-10 07:43:31', NULL, NULL),
(27, 'Bayi Sepatu', 'subcategory', 'menu', 25, 'bayi-sepatu', 'ezgif-1599033457.jpg', 1, '2020-10-10 07:43:31', NULL, NULL),
(28, 'Kesehatan', 'category', 'menu', 0, 'kesehatan', 'black-and-white-5.-sehat.png', 1, '2020-10-10 08:22:15', NULL, NULL),
(29, 'Alat Kesehatan', 'subcategory', 'menu', 28, 'alat-kesehatan', 'Pink-1598600275.jpg', 1, '2020-10-10 08:22:15', NULL, NULL),
(30, 'Kecantikan', 'category', 'menu', 0, 'kecantikan', 'black-and-white-6.-cantik.png', 1, '2020-10-10 08:22:15', NULL, NULL),
(31, 'Cantik Kuku', 'subcategory', 'menu', 30, 'cantik-kuku', 'Abu-1598512319.jpg', 1, '2020-10-10 08:22:15', NULL, NULL),
(32, 'Cantik Tubuh', 'subcategory', 'menu', 30, 'cantik-tubuh', 'Hijau-1598862282.jpg', 1, '2020-10-10 08:22:15', NULL, NULL),
(33, 'Rumah', 'category', 'menu', 0, 'rumah', 'black-and-white-7.-rumah.png', 1, '2020-10-10 08:22:15', NULL, NULL),
(34, 'Ruang Dapur', 'subcategory', 'menu', 33, 'ruang-dapur', 'ezgif-1598589691.jpg', 1, '2020-10-10 08:22:15', NULL, NULL),
(35, 'Ruang Mandi', 'subcategory', 'menu', 33, 'ruang-mandi', 'ezgif-1598865431.jpg', 1, '2020-10-10 08:22:15', NULL, NULL),
(36, 'Ruang Tidur', 'subcategory', 'menu', 33, 'ruang-tidur', 'ezgif-1598948823.jpg', 1, '2020-10-10 08:22:15', NULL, NULL),
(37, 'Ruang Luar', 'subcategory', 'menu', 33, 'ruang-luar', 'Biru-1600681954.jpg', 1, '2020-10-10 08:22:15', NULL, NULL),
(38, 'Travel', 'category', 'menu', 0, 'travel', '8.-hobi.png', 1, '2020-10-10 08:22:15', NULL, NULL),
(39, 'Cantik Mata', 'subcategory', 'menu', 30, 'cantik-mata', 'Gold-1598589513.jpg', 1, '2020-10-10 08:59:52', NULL, NULL),
(40, 'Cantik Muka', 'subcategory', 'menu', 30, 'cantik-muka', 'Pink-1598435075.jpg', 1, '2020-10-10 08:59:52', NULL, NULL),
(41, 'Cantik Rambut', 'category', 'menu', 30, 'cantik-rambut', 'Pink-1599033528.jpg', 1, '2020-10-10 08:59:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

CREATE TABLE IF NOT EXISTS `courier` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `value` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`id`, `name`, `value`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'JNE', 'jne', 1, '2020-10-11 15:07:09', NULL, NULL),
(2, 'J&T', 'jnt', 1, '2020-10-11 15:07:09', NULL, NULL),
(3, 'Ninja Express', 'ninja', 1, '2020-10-11 15:07:09', NULL, NULL),
(4, 'Sicepat', 'sicepat', 1, '2020-10-11 15:08:04', NULL, NULL),
(5, 'POS', 'pos', 1, '2020-10-12 02:41:04', NULL, NULL),
(6, 'TIKI', 'tiki', 1, '2020-10-12 02:41:04', NULL, NULL),
(7, 'RPX', 'rpx', 1, '2020-10-12 02:41:42', NULL, NULL),
(8, 'Pandu', 'pandu', 1, '2020-10-12 02:41:42', NULL, NULL),
(9, 'Wahana', 'wahana', 1, '2020-10-12 02:42:26', NULL, NULL),
(10, 'Pahala', 'pahala', 1, '2020-10-12 02:42:26', NULL, NULL),
(11, 'SAP', 'sap', 1, '2020-10-12 02:43:00', NULL, NULL),
(12, 'jet', 'jet', 1, '2020-10-12 02:43:00', NULL, NULL),
(13, 'Indah', 'indah', 1, '2020-10-12 02:43:30', NULL, NULL),
(14, 'DSE', 'dse', 1, '2020-10-12 02:43:30', NULL, NULL),
(15, 'SLIS', 'slis', 1, '2020-10-12 02:45:04', NULL, NULL),
(16, 'First', 'first', 1, '2020-10-12 02:45:04', NULL, NULL),
(17, 'NCS', 'ncs', 1, '2020-10-12 02:45:29', NULL, NULL),
(18, 'Star', 'star', 1, '2020-10-12 02:45:29', NULL, NULL),
(19, 'Lion', 'lion', 1, '2020-10-12 02:46:51', NULL, NULL),
(20, 'IDL', 'idl', 1, '2020-10-12 02:46:51', NULL, NULL),
(21, 'REX', 'rex', 1, '2020-10-12 02:47:03', NULL, NULL),
(22, 'IDE', 'ide', 1, '2020-10-12 02:47:03', NULL, NULL),
(23, 'Sentral', 'sentral', 1, '2020-10-12 02:47:29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_attribut_product`
--

CREATE TABLE IF NOT EXISTS `detail_attribut_product` (
  `id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `detlocproduct_id` int(11) unsigned NOT NULL,
  `variant_id` int(11) unsigned NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_attribut_product`
--

INSERT INTO `detail_attribut_product` (`id`, `product_id`, `detlocproduct_id`, `variant_id`, `size`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 1, 1, 39, '2020-10-11 15:41:34', NULL, NULL),
(2, 6, 1, 2, 40, '2020-10-11 15:41:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_cart`
--

CREATE TABLE IF NOT EXISTS `detail_cart` (
`id` int(11) unsigned NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `inventory_id` int(11) unsigned NOT NULL,
  `destination` int(30) NOT NULL,
  `total_weight` int(30) NOT NULL,
  `total_price` int(10) NOT NULL,
  `shippingcost` int(30) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_cart`
--

INSERT INTO `detail_cart` (`id`, `order_id`, `user_id`, `inventory_id`, `destination`, `total_weight`, `total_price`, `shippingcost`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1011202001', 33, 1, 5781, 400, 50000, 0, 1, '2020-11-12 20:33:54', '2020-11-25 22:43:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_location_product`
--

CREATE TABLE IF NOT EXISTS `detail_location_product` (
  `id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `inventory_id` int(11) unsigned NOT NULL,
  `courier_service` varchar(80) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_location_product`
--

INSERT INTO `detail_location_product` (`id`, `product_id`, `inventory_id`, `courier_service`, `stock`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 6, 1, 'OKE', 100, '2020-10-11 15:12:02', NULL, NULL),
(2, 5, 1, 'OKE', 50, '2020-11-05 05:10:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_photo_product`
--

CREATE TABLE IF NOT EXISTS `detail_photo_product` (
`id` int(11) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `photo` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_photo_product`
--

INSERT INTO `detail_photo_product` (`id`, `product_id`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'SW3-HITAM-1593483386.jpg', '2020-10-10 09:03:18', NULL, NULL),
(2, 1, 'SW3-PUTIH1-1593483386.jpg', '2020-10-10 09:03:18', NULL, NULL),
(3, 2, 'SP26-HITAM-1593480828.jpg', '2020-10-10 22:26:44', NULL, NULL),
(4, 2, 'SP26-Cokelat-1593480833.jpg', '2020-10-10 22:26:44', NULL, NULL),
(5, 4, 'Abu-1596706025.jpg', '2020-10-10 22:37:39', NULL, NULL),
(6, 4, 'Biru-1596706026.jpg', '2020-10-10 22:37:39', NULL, NULL),
(7, 3, 'Cokelat-1596706026.jpg', '2020-10-10 22:39:09', NULL, NULL),
(8, 5, 'SW17- KUNING-1598493258.jpg', '2020-10-10 22:43:56', NULL, NULL),
(9, 5, 'OREN-1598493286.jpg', '2020-10-10 22:43:56', NULL, NULL),
(10, 5, 'PINK-1598493287.jpg', '2020-10-10 22:44:15', NULL, NULL),
(11, 3, 'Abu-1597134972.jpg', '2020-10-10 23:22:57', NULL, NULL),
(12, 3, 'Hitam-1597135043.jpg', '2020-10-10 23:22:57', NULL, NULL),
(13, 6, 'SP26-HITAM-1593480828.jpg', '2020-10-31 23:10:00', NULL, NULL),
(14, 7, 'SEPATU WARNI 2-1597974058.jpg', '2020-10-31 23:32:06', NULL, NULL),
(15, 7, 'SEPATU WARNI 3-1597974141.jpg', '2020-10-31 23:32:06', NULL, NULL),
(16, 7, 'SEPATU WARNI-1597974142.jpg', '2020-10-31 23:32:43', NULL, NULL),
(17, 6, 'SP26-Cokelat-1593480833.jpg', '2020-11-01 20:12:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `followup`
--

CREATE TABLE IF NOT EXISTS `followup` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `messages` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followup`
--

INSERT INTO `followup` (`id`, `name`, `messages`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Follow up Coustumer', 'tes', 'costumer', '2020-11-25 21:54:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `courier_id` int(11) unsigned NOT NULL,
  `optional` varchar(50) NOT NULL,
  `courier_service` varchar(80) NOT NULL,
  `province_id` int(11) unsigned NOT NULL,
  `province_name` varchar(50) NOT NULL,
  `city_id` int(11) unsigned NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `subdistrict_id` int(11) unsigned NOT NULL,
  `subdistrict_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `name`, `courier_id`, `optional`, `courier_service`, `province_id`, `province_name`, `city_id`, `city_name`, `subdistrict_id`, `subdistrict_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'GD Yogyakarta', 3, 'special', 'STANDARD', 5, 'DI Yogyakarta', 419, 'Sleman', 5779, 'Berbah', 1, '2020-11-12 21:10:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Tanggerang', 2, 'all', '', 3, '', 457, '', 6312, '', 1, '2020-11-12 21:09:55', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `summary` text NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) unsigned NOT NULL,
  `subcategory_id` int(11) unsigned NOT NULL,
  `type` varchar(25) NOT NULL,
  `weight` int(11) NOT NULL,
  `favorite` varchar(11) NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `pixel_id` varchar(100) NOT NULL,
  `pixel_event` varchar(100) NOT NULL,
  `warranty` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `slug`, `summary`, `description`, `category_id`, `subcategory_id`, `type`, `weight`, `favorite`, `price`, `discount`, `pixel_id`, `pixel_event`, `warranty`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SW03', 'sw03', '<span style="font-family: Roboto;"><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;">-</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><span style="font-weight: bold;">Bisa COD / Bayar di Tempat Se-Indonesia</span></span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Promo Beli 2 BONUS Dompet / Jam / Sunglass UV</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"></span><span style="color: rgb(0, 0, 0); font-size: 15px; text-align: start; white-space: pre-wrap;">- </span></span><span style="color: rgb(34, 34, 34); font-family: Roboto; font-size: medium; white-space: pre-wrap;">Klik <span style="font-weight: bold;">Tombol Orange BELI SEKARANG</span> Dibawah. Jika Ada Error Whatsapp ke 0811122214.</span></br>', '<div>                         <div>                                                          <span style="font-family: Roboto;">                                      </br>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                                                          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Bahan</span><span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> : Kulit </span>                                     </br>                                     </br>                                        <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Ukuran</span>                                      <span style="text-align: justify;">                                     <span style="color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">  : P x L                                 39 (26 cm x 9 cm)                                 40 (27 cm x 9 cm )                                 41 (28 cm x 9,5 cm )                                 42 (28,5 cm x 10 cm )                                 43 (29 cm x 10 cm)<br></span></span>                             </span>                          </div>          <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">         - </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Pembayaran via COD </span>         </br>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">     -</span>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Foto diatas adalah 100% Asli</span>     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> (Jikapun ada Sedikit Perbedaan Warna Mungkin Karena Efek Pencahayaan)</span>     </span>          </br>         </br>      <p>     <span style="font-family: Roboto;">                  <span style="color: rgb(74, 85, 104); font-family: system-ui, -apple-system, BlinkMacSystemFont;">- </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Merek</span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;"> </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Produk ini : ditokocom </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kode Sertifikat SP26, </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kerahasiaan data anda dipastikan terjaga ketika berbelanja disini.</span>     </span>     </p>      <p>     <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><br>         </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">-</span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Pembelian hanya melalui Web &amp; Whatsapp </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">tidak membuka toko di marketplace (Toped, BL, Shopee) &amp; tidak memiliki reseller / dropshipper</span>     </span>     </p>  </div>', 9, 15, 'promo', 50, 'yes', 49000, 45000, '', '', 1, 1, '2020-10-10 08:38:36', NULL, NULL),
(2, 'SP26', 'sp26', '<span style="font-family: Roboto;"><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;">-</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><span style="font-weight: bold;">Bisa COD / Bayar di Tempat Se-Indonesia</span></span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Promo Beli 2 BONUS Dompet / Jam / Sunglass UV</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"></span><span style="color: rgb(0, 0, 0); font-size: 15px; text-align: start; white-space: pre-wrap;">- </span></span><span style="color: rgb(34, 34, 34); font-family: Roboto; font-size: medium; white-space: pre-wrap;">Klik <span style="font-weight: bold;">Tombol Orange BELI SEKARANG</span> Dibawah. Jika Ada Error Whatsapp ke 0811122214.</span></br>', '<div>                         <div>                                                          <span style="font-family: Roboto;">                                      </br>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                                                          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Bahan</span><span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> : Kulit </span>                                     </br>                                     </br>                                        <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Ukuran</span>                                      <span style="text-align: justify;">                                     <span style="color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">  : P x L                                 39 (26 cm x 9 cm)                                 40 (27 cm x 9 cm )                                 41 (28 cm x 9,5 cm )                                 42 (28,5 cm x 10 cm )                                 43 (29 cm x 10 cm)<br></span></span>                             </span>                          </div>          <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">         - </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Pembayaran via COD </span>         </br>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">     -</span>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Foto diatas adalah 100% Asli</span>     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> (Jikapun ada Sedikit Perbedaan Warna Mungkin Karena Efek Pencahayaan)</span>     </span>          </br>         </br>      <p>     <span style="font-family: Roboto;">                  <span style="color: rgb(74, 85, 104); font-family: system-ui, -apple-system, BlinkMacSystemFont;">- </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Merek</span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;"> </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Produk ini : ditokocom </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kode Sertifikat SP26, </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kerahasiaan data anda dipastikan terjaga ketika berbelanja disini.</span>     </span>     </p>      <p>     <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><br>         </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">-</span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Pembelian hanya melalui Web &amp; Whatsapp </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">tidak membuka toko di marketplace (Toped, BL, Shopee) &amp; tidak memiliki reseller / dropshipper</span>     </span>     </p>  </div>', 9, 15, 'promo', 50, 'no', 49000, 45000, '', '', 1, 1, '2020-10-10 08:39:22', NULL, NULL),
(3, 'SP65', 'sp65', '<span style="font-family: Roboto;"><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;">-</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><span style="font-weight: bold;">Bisa COD / Bayar di Tempat Se-Indonesia</span></span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Promo Beli 2 BONUS Dompet / Jam / Sunglass UV</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"></span><span style="color: rgb(0, 0, 0); font-size: 15px; text-align: start; white-space: pre-wrap;">- </span></span><span style="color: rgb(34, 34, 34); font-family: Roboto; font-size: medium; white-space: pre-wrap;">Klik <span style="font-weight: bold;">Tombol Orange BELI SEKARANG</span> Dibawah. Jika Ada Error Whatsapp ke 0811122214.</span></br>', '<div>                         <div>                                                          <span style="font-family: Roboto;">                                      </br>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                                                          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Bahan</span><span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> : Kulit </span>                                     </br>                                     </br>                                        <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Ukuran</span>                                      <span style="text-align: justify;">                                     <span style="color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">  : P x L                                 39 (26 cm x 9 cm)                                 40 (27 cm x 9 cm )                                 41 (28 cm x 9,5 cm )                                 42 (28,5 cm x 10 cm )                                 43 (29 cm x 10 cm)<br></span></span>                             </span>                          </div>          <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">         - </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Pembayaran via COD </span>         </br>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">     -</span>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Foto diatas adalah 100% Asli</span>     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> (Jikapun ada Sedikit Perbedaan Warna Mungkin Karena Efek Pencahayaan)</span>     </span>          </br>         </br>      <p>     <span style="font-family: Roboto;">                  <span style="color: rgb(74, 85, 104); font-family: system-ui, -apple-system, BlinkMacSystemFont;">- </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Merek</span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;"> </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Produk ini : ditokocom </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kode Sertifikat SP26, </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kerahasiaan data anda dipastikan terjaga ketika berbelanja disini.</span>     </span>     </p>      <p>     <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><br>         </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">-</span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Pembelian hanya melalui Web &amp; Whatsapp </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">tidak membuka toko di marketplace (Toped, BL, Shopee) &amp; tidak memiliki reseller / dropshipper</span>     </span>     </p>  </div>', 9, 15, 'promo', 50, 'no', 49000, 45000, '', '', 1, 1, '2020-10-10 08:39:39', NULL, NULL),
(4, 'SP36', 'sp36', '<span style="font-family: Roboto;"><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;">-</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><span style="font-weight: bold;">Bisa COD / Bayar di Tempat Se-Indonesia</span></span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Promo Beli 2 BONUS Dompet / Jam / Sunglass UV</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"></span><span style="color: rgb(0, 0, 0); font-size: 15px; text-align: start; white-space: pre-wrap;">- </span></span><span style="color: rgb(34, 34, 34); font-family: Roboto; font-size: medium; white-space: pre-wrap;">Klik <span style="font-weight: bold;">Tombol Orange BELI SEKARANG</span> Dibawah. Jika Ada Error Whatsapp ke 0811122214.</span></br>', '<div>                         <div>                                                          <span style="font-family: Roboto;">                                      </br>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                                                          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Bahan</span><span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> : Kulit </span>                                     </br>                                     </br>                                        <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Ukuran</span>                                      <span style="text-align: justify;">                                     <span style="color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">  : P x L                                 39 (26 cm x 9 cm)                                 40 (27 cm x 9 cm )                                 41 (28 cm x 9,5 cm )                                 42 (28,5 cm x 10 cm )                                 43 (29 cm x 10 cm)<br></span></span>                             </span>                          </div>          <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">         - </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Pembayaran via COD </span>         </br>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">     -</span>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Foto diatas adalah 100% Asli</span>     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> (Jikapun ada Sedikit Perbedaan Warna Mungkin Karena Efek Pencahayaan)</span>     </span>          </br>         </br>      <p>     <span style="font-family: Roboto;">                  <span style="color: rgb(74, 85, 104); font-family: system-ui, -apple-system, BlinkMacSystemFont;">- </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Merek</span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;"> </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Produk ini : ditokocom </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kode Sertifikat SP26, </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kerahasiaan data anda dipastikan terjaga ketika berbelanja disini.</span>     </span>     </p>      <p>     <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><br>         </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">-</span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Pembelian hanya melalui Web &amp; Whatsapp </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">tidak membuka toko di marketplace (Toped, BL, Shopee) &amp; tidak memiliki reseller / dropshipper</span>     </span>     </p>  </div>', 1, 2, 'promo', 50, 'yes', 49000, 10000, '', '', 0, 1, '2020-10-10 15:50:46', NULL, NULL),
(5, 'SW17', 'sw17', '<span style="font-family: Roboto;"><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;">-</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><span style="font-weight: bold;">Bisa COD / Bayar di Tempat Se-Indonesia</span></span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Promo Beli 2 BONUS Dompet / Jam / Sunglass UV</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"></span><span style="color: rgb(0, 0, 0); font-size: 15px; text-align: start; white-space: pre-wrap;">- </span></span><span style="color: rgb(34, 34, 34); font-family: Roboto; font-size: medium; white-space: pre-wrap;">Klik <span style="font-weight: bold;">Tombol Orange BELI SEKARANG</span> Dibawah. Jika Ada Error Whatsapp ke 0811122214.</span></br>', '<div>                         <div>                                                          <span style="font-family: Roboto;">                                      </br>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                                                          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Bahan</span><span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> : Kulit </span>                                     </br>                                     </br>                                        <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Ukuran</span>                                      <span style="text-align: justify;">                                     <span style="color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">  : P x L                                 39 (26 cm x 9 cm)                                 40 (27 cm x 9 cm )                                 41 (28 cm x 9,5 cm )                                 42 (28,5 cm x 10 cm )                                 43 (29 cm x 10 cm)<br></span></span>                             </span>                          </div>          <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">         - </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Pembayaran via COD </span>         </br>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">     -</span>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Foto diatas adalah 100% Asli</span>     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> (Jikapun ada Sedikit Perbedaan Warna Mungkin Karena Efek Pencahayaan)</span>     </span>          </br>         </br>      <p>     <span style="font-family: Roboto;">                  <span style="color: rgb(74, 85, 104); font-family: system-ui, -apple-system, BlinkMacSystemFont;">- </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Merek</span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;"> </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Produk ini : ditokocom </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kode Sertifikat SP26, </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kerahasiaan data anda dipastikan terjaga ketika berbelanja disini.</span>     </span>     </p>      <p>     <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><br>         </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">-</span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Pembelian hanya melalui Web &amp; Whatsapp </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">tidak membuka toko di marketplace (Toped, BL, Shopee) &amp; tidak memiliki reseller / dropshipper</span>     </span>     </p>  </div>', 9, 15, 'promo', 20, 'no', 49000, 10000, '', '', 1, 1, '2020-10-10 22:42:55', NULL, NULL),
(6, 'SP24', 'sp24', '<span style="font-family: Roboto;">    <span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;">-</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">     </span>    <span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">        <span style="font-weight: bold;">Bisa COD / Bayar di Tempat Se-Indonesia</span>    </span>   </br>    <span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>    <span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Promo Beli 2 BONUS Dompet / Jam / Sunglass UV</span>    <span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">    </span>   </br>    <span style="color: rgb(0, 0, 0); font-size: 15px; text-align: start; white-space: pre-wrap;">- </span>    </span>       <span style="color: rgb(34, 34, 34); font-family: Roboto; font-size: medium; white-space: pre-wrap;">Klik <span style="font-weight: bold;">Tombol Orange BELI SEKARANG</span> Dibawah. Jika Ada Error Whatsapp ke 0811122214.</span> <br>', '<div>                         <div>                                                          <span style="font-family: Roboto;">                                      </br>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                                                          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Bahan</span><span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> : Kulit </span>                                     </br>                                     </br>                                        <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Ukuran</span>                                      <span style="text-align: justify;">                                     <span style="color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">  : P x L                                 39 (26 cm x 9 cm)                                 40 (27 cm x 9 cm )                                 41 (28 cm x 9,5 cm )                                 42 (28,5 cm x 10 cm )                                 43 (29 cm x 10 cm)<br></span></span>                             </span>                          </div>          <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">         - </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Pembayaran via COD </span>         </br>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">     -</span>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Foto diatas adalah 100% Asli</span>     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> (Jikapun ada Sedikit Perbedaan Warna Mungkin Karena Efek Pencahayaan)</span>     </span>          </br>         </br>      <p>     <span style="font-family: Roboto;">                  <span style="color: rgb(74, 85, 104); font-family: system-ui, -apple-system, BlinkMacSystemFont;">- </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Merek</span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;"> </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Produk ini : ditokocom </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kode Sertifikat SP26, </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kerahasiaan data anda dipastikan terjaga ketika berbelanja disini.</span>     </span>     </p>      <p>     <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><br>         </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">-</span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Pembelian hanya melalui Web &amp; Whatsapp </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">tidak membuka toko di marketplace (Toped, BL, Shopee) &amp; tidak memiliki reseller / dropshipper</span>     </span>     </p>  </div>', 1, 2, 'standar', 10, 'yes', 49000, 100000, '', '', 1, 1, '2020-10-10 23:21:26', NULL, NULL),
(7, 'SW08', 'sw08', '<span style="font-family: Roboto;"><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;">-</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><span style="font-weight: bold;">Bisa COD / Bayar di Tempat Se-Indonesia</span></span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Promo Beli 2 BONUS Dompet / Jam / Sunglass UV</span><span style="text-align: start; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"></span><span style="color: rgb(0, 0, 0); font-size: 15px; text-align: start; white-space: pre-wrap;">- </span></span><span style="color: rgb(34, 34, 34); font-family: Roboto; font-size: medium; white-space: pre-wrap;">Klik <span style="font-weight: bold;">Tombol Orange BELI SEKARANG</span> Dibawah. Jika Ada Error Whatsapp ke 0811122214.</span></br>', '<div>                         <div>                                                          <span style="font-family: Roboto;">                                      </br>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                                                          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Bahan</span><span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> : Kulit </span>                                     </br>                                     </br>                                        <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- </span>                                     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Ukuran</span>                                      <span style="text-align: justify;">                                     <span style="color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">  : P x L                                 39 (26 cm x 9 cm)                                 40 (27 cm x 9 cm )                                 41 (28 cm x 9,5 cm )                                 42 (28,5 cm x 10 cm )                                 43 (29 cm x 10 cm)<br></span></span>                             </span>                          </div>          <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">         - </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;">Pembayaran via COD </span>         </br>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">     -</span>      <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Foto diatas adalah 100% Asli</span>     <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"> (Jikapun ada Sedikit Perbedaan Warna Mungkin Karena Efek Pencahayaan)</span>     </span>          </br>         </br>      <p>     <span style="font-family: Roboto;">                  <span style="color: rgb(74, 85, 104); font-family: system-ui, -apple-system, BlinkMacSystemFont;">- </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Merek</span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; font-weight: 700; white-space: pre-wrap;"> </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">Produk ini : ditokocom </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kode Sertifikat SP26, </span>          <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">- Kerahasiaan data anda dipastikan terjaga ketika berbelanja disini.</span>     </span>     </p>      <p>     <span style="font-family: Roboto;">         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;"><br>         </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">-</span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap; font-weight: bold;"> Pembelian hanya melalui Web &amp; Whatsapp </span>         <span style="text-align: justify; color: rgb(0, 0, 0); font-size: 15px; white-space: pre-wrap;">tidak membuka toko di marketplace (Toped, BL, Shopee) &amp; tidak memiliki reseller / dropshipper</span>     </span>     </p>  </div>', 9, 15, 'standar', 10, 'yes', 49000, 100000, '', '', 1, 1, '2020-10-31 23:29:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_bundle`
--

CREATE TABLE IF NOT EXISTS `product_bundle` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `description` text NOT NULL,
  `variant` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_service`
--

CREATE TABLE IF NOT EXISTS `product_service` (
`id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `status` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_service`
--

INSERT INTO `product_service` (`id`, `user_id`, `product_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 30, 6, 0, '2020-11-25 22:04:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `slug` varchar(80) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `name`, `slug`, `photo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'COD', 'cod', 'promoCOD.png', 1, '2020-10-10 14:40:10', NULL, NULL),
(2, 'Bel1 2 Bonus Kacamata', 'beli-2-bonus-kacamata', 'PromoPria.png', 1, '2020-10-10 14:40:10', NULL, NULL),
(3, 'Beli 2 Bonus Kalung', 'beli-2-bonus-kalung', 'PromoWanita.png', 1, '2020-10-10 14:41:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `province_id` int(20) NOT NULL,
  `province_name` varchar(50) NOT NULL,
  `city_id` int(20) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `subdistrict_id` int(20) NOT NULL,
  `subdistrict_name` varchar(50) NOT NULL,
  `remember_token` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `optional` varchar(10) NOT NULL,
  `related` int(11) NOT NULL,
  `status` int(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `password`, `province_id`, `province_name`, `city_id`, `city_name`, `subdistrict_id`, `subdistrict_name`, `remember_token`, `photo`, `type`, `optional`, `related`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', '085726202220', 'tes', '$2y$08$bm5jNUdTR2JNU1JXS1NGbeJLG/fghzCS.6oT5RYRCAO35BF.acqa6', 6, 'DKI Jakarta', 151, 'Jakarta Barat', 2087, 'Cengkareng', 'CKZZNqobF8j13DLiUFK0inVXVWnmwaQzyVneHIJskgSE8TzTeYEZbfNamNJx', '', 'admin', '', 0, 0, '2020-07-16 16:49:50', '2020-11-26 06:29:33', NULL),
(29, 'rizal faozi', '08575957550', 'tes', '$2y$10$pHRfubRu/8Fzp7H0DHPPjuR10TN8cljyflgh3slMdtY.IfkrN8rAC', 5, 'DI Yogyakarta', 419, 'Sleman', 5781, 'Depok', '', '', 'member', 'primary', 0, 1, '2020-11-23 09:54:46', '2020-11-24 10:00:48', NULL),
(30, 'rizal faozi', '0857259575550', 'tesx', '$2y$10$mRNPRl23VuR6op6swpNHQurLpkLqVT1xiqVhK3XNlXUuOTndQoclO', 5, 'DI Yogyakarta', 39, 'Bantul', 538, 'Banguntapan', '', '', 'cs', '', 29, 1, '2020-11-24 02:56:52', '2020-11-24 02:56:52', NULL),
(31, 'rizal faozi', '085726242222', 'tes', '$2y$10$.2a0gN2ukkKr2wa2jypnOePRk3Nw/fIqq7fo0QREZhGOcR8LnW7j.', 5, 'DI Yogyakarta', 419, 'Sleman', 5781, 'Depok', '', '', 'member', '', 29, 1, '2020-11-24 03:17:29', '2020-11-24 10:00:48', NULL),
(32, 'rizal faozi', '08572624222', 'tes', '$2y$10$rZ/hj847IooJt1NGtNG13ejEhj4DIlRbhogZzC8hmHURdWVLYLXl2', 5, 'DI Yogyakarta', 419, 'Sleman', 5781, 'Depok', '', '', 'member', '', 29, 1, '2020-11-24 04:30:17', '2020-11-24 04:30:17', NULL),
(33, 'rizal faozi', '085726242220', 'tes', '$2y$10$jZkGHrJPlexN/bbxqp8ri.ZfhuN8ZROqF0g6wuKUvBB2nlchcJ6E.', 5, 'DI Yogyakarta', 419, 'Sleman', 5781, 'Depok', '', '', 'member', 'primary', 0, 1, '2020-11-24 10:00:56', '2020-11-25 22:43:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `variant`
--

CREATE TABLE IF NOT EXISTS `variant` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `color_bg` varchar(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variant`
--

INSERT INTO `variant` (`id`, `name`, `color_bg`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kuning', '', '2020-10-11 15:39:37', NULL, NULL),
(2, 'Merah', '', '2020-10-11 15:39:37', NULL, NULL),
(3, 'Putih', '', '2020-10-11 15:39:37', NULL, NULL),
(4, 'Pink', '', '2020-10-11 15:39:37', NULL, NULL),
(5, 'Biru', '', '2020-10-11 15:39:37', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier`
--
ALTER TABLE `courier`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_attribut_product`
--
ALTER TABLE `detail_attribut_product`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`), ADD KEY `location_id` (`detlocproduct_id`), ADD KEY `color_id` (`variant_id`);

--
-- Indexes for table `detail_cart`
--
ALTER TABLE `detail_cart`
 ADD PRIMARY KEY (`id`), ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `detail_location_product`
--
ALTER TABLE `detail_location_product`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`,`inventory_id`), ADD KEY `inventory_id` (`inventory_id`);

--
-- Indexes for table `detail_photo_product`
--
ALTER TABLE `detail_photo_product`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `followup`
--
ALTER TABLE `followup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
 ADD PRIMARY KEY (`id`), ADD KEY `courier_id` (`courier_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_bundle`
--
ALTER TABLE `product_bundle`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_service`
--
ALTER TABLE `product_service`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `variant`
--
ALTER TABLE `variant`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `courier`
--
ALTER TABLE `courier`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `detail_cart`
--
ALTER TABLE `detail_cart`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `detail_photo_product`
--
ALTER TABLE `detail_photo_product`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `followup`
--
ALTER TABLE `followup`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `product_bundle`
--
ALTER TABLE `product_bundle`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_service`
--
ALTER TABLE `product_service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `variant`
--
ALTER TABLE `variant`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_attribut_product`
--
ALTER TABLE `detail_attribut_product`
ADD CONSTRAINT `detail_attribut_product_detlocproduct_id_foreign` FOREIGN KEY (`detlocproduct_id`) REFERENCES `detail_location_product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `detail_attribut_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `detail_attribut_product_variant_id_foreign` FOREIGN KEY (`variant_id`) REFERENCES `variant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_cart`
--
ALTER TABLE `detail_cart`
ADD CONSTRAINT `detail_cart_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_location_product`
--
ALTER TABLE `detail_location_product`
ADD CONSTRAINT `detail_location_product_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `detail_location_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_photo_product`
--
ALTER TABLE `detail_photo_product`
ADD CONSTRAINT `detail_photo_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
ADD CONSTRAINT ` inventory_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `courier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_service`
--
ALTER TABLE `product_service`
ADD CONSTRAINT `product_service_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `product_service_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
