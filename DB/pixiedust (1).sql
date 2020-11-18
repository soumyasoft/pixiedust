-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2019 at 02:16 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pixiedust`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `banner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `banner`, `created_at`, `updated_at`) VALUES
(2, '41718Lighthouse.jpg', '2018-12-19 01:05:50', '2018-12-19 01:05:50'),
(3, '54383Penguins.jpg', '2018-12-19 01:09:54', '2018-12-19 01:09:54'),
(4, '27975Jellyfish.jpg', '2018-12-19 01:10:30', '2018-12-19 01:10:30'),
(5, '59239Tulips.jpg', '2018-12-19 01:11:06', '2018-12-19 01:11:06'),
(6, '93356Hydrangeas.jpg', '2018-12-19 01:11:29', '2018-12-19 01:11:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Jewelry', 'jewelry', '90817subcat_graphics-0.jpg', '2018-12-20 23:17:33', '2018-12-20 23:17:33'),
(2, 'Statues', 'statues', '82693A4C184CE-421C-48BD-B0A8-316BE740E91F-1024x768.jpeg', '2018-12-31 05:03:04', '2018-12-31 05:03:04'),
(3, 'Candles', 'candles', '20873IMG_1530.jpeg', '2019-01-28 04:34:06', '2019-01-28 04:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

DROP TABLE IF EXISTS `cms_pages`;
CREATE TABLE `cms_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_pages`
--

INSERT INTO `cms_pages` (`id`, `title`, `description`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 'About Us', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s&nbsp;</p>', 'Lorem Ipsum testing email', 'lorem', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', '2018-12-19 18:30:00', '2018-12-21 03:52:17'),
(2, 'Delivery Information', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>', 'Lorem Ipsum', 'lorem', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', '2018-12-19 18:30:00', '2018-12-21 03:52:09'),
(3, 'Privacy Policy', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 'Lorem Ipsum ', 'lorem', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', '2018-12-19 18:30:00', '2018-12-19 18:30:00'),
(4, 'Terms & Conditions', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>', 'Lorem Ipsum', 'lorem', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', '2018-12-19 18:30:00', '2018-12-21 01:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_codes`
--

DROP TABLE IF EXISTS `coupon_codes`;
CREATE TABLE `coupon_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_percentage` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1=Active,2=InActive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupon_codes`
--

INSERT INTO `coupon_codes` (`id`, `coupon_code`, `discount_percentage`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(2, 'CASH10', 10, '2019-01-03', '2019-01-31', 1, '2019-01-02 06:41:01', '2019-01-07 00:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Contact Email', '<table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">\r\n  <tr>\r\n    <td align="center" valign="top" bgcolor="#EFEFEF"><table class="contenttable" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff" style="border-width: 8px; border-style: solid; border-collapse: separate; border-color:#ececec; margin-top:40px; font-family:Arial, Helvetica, sans-serif">\r\n        <tr>\r\n          <td bgcolor="#037ad1"><table border="0" cellpadding="0" cellspacing="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n                  <td width="100%" height="20" bgcolor="#006eb7">&nbsp;</td>\r\n                </tr>\r\n                <tr>\r\n                  <td align="center" valign="top" bgcolor="#353535"><a href="#" style="padding-top:10px; padding-bottom:10px; display:inline-block;">\r\n                  <img src="http://192.168.0.111/pixiedust/public/images/logo.png" title="Pixie Dust" alt="Pixie Dust" width="400"></a></td>\r\n                </tr>\r\n                <tr>\r\n                  <td width="100%" height="20" bgcolor="#006eb7">&nbsp;</td>\r\n                </tr>\r\n                <tr>\r\n              </tbody>\r\n            </table></td>\r\n        </tr>\r\n        <tr>\r\n          <td><table border="0" cellpadding="0" cellspacing="0" width="100%">\r\n              <tbody>\r\n                <tr>\r\n              </tbody>\r\n            </table></td>\r\n        </tr>\r\n        <tr>\r\n          <td class="tablepadding" style="padding:5px; padding-left:36px; font-size:14px; line-height:20px;"><h3>Dear Admin,</h3></td>\r\n        </tr>\r\n        <tr>\r\n          <td class="tablepadding" style="border-top:1px solid #eaeaea;border-bottom:1px solid #eaeaea;padding:13px 20px;"><table width="100%" align="center" cellpadding="0" cellspacing="20" border="0">\r\n              <tbody>\r\n                <tr>\r\n                  <td width="21%" style="font-size:13px; font-family:Arial, Helvetica, sans-serif; color:#676767"><strong><span style="color:#707070">Full Name :</span></strong></td>\r\n                  <td width="79%" align="left" style="font-size:14px; font-family:Arial, Helvetica, sans-serif; color:#676767"><span style="color: #707070">[NAME]</span></td>\r\n                </tr>\r\n                <tr>\r\n                  <td style="font-size:13px; font-family:Arial, Helvetica, sans-serif; color:#676767"><strong>Email :</strong></td>\r\n                  <td align="left" style="font-size:13px; font-family:Arial, Helvetica, sans-serif; color:#676767">[EMAIL]</td>\r\n                </tr>\r\n                <tr>\r\n                  <td style="font-size:13px; font-family:Arial, Helvetica, sans-serif; color:#676767"><strong>Phone No :</strong></td>\r\n                  <td align="left" style="font-size:13px; font-family:Arial, Helvetica, sans-serif; color:#676767">[PHONE]</td>\r\n                </tr>\r\n                <tr>\r\n                  <td style="font-size:13px; font-family:Arial, Helvetica, sans-serif; color:#676767"><strong>Message :</strong></td>\r\n                  <td align="left" style="font-size:13px; font-family:Arial, Helvetica, sans-serif; color:#676767;" width="400px">\r\n                  \r\n                  <span style="width:250px; display:inline">[MESSAGE]</span></td>\r\n                </tr>\r\n                \r\n              </tbody>\r\n            </table></td>\r\n        </tr>\r\n        <tr>\r\n          <td><table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">\r\n              <tbody>\r\n                <tr>\r\n                  <td></td>\r\n                </tr>\r\n              </tbody>\r\n            </table></td>\r\n        </tr>\r\n        <tr>\r\n          <td><table width="100%" cellspacing="0" cellpadding="0" border="0" style="font-size:13px;color:#555555; font-family:Arial, Helvetica, sans-serif;">\r\n              <tbody>\r\n                <tr>\r\n                  <td class="tablepadding" align="center" style="font-size:14px; line-height:22px; padding:20px; border-top:1px solid #ececec; background: #cccccc8f; border-top:solid 5px #353535;"> THANK YOU,<br />\r\n                    <strong>PIXIE DUST\r\n                    </strong></td>\r\n                </tr>\r\n                <tr> </tr>\r\n              </tbody>\r\n            </table></td>\r\n        </tr>\r\n        \r\n      </table></td>\r\n  </tr>\r\n  <tr>\r\n    <td></td>\r\n  </tr>\r\n</table>', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `intutive_price_settings`
--

DROP TABLE IF EXISTS `intutive_price_settings`;
CREATE TABLE `intutive_price_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `intutive_timing` time NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intutive_price_settings`
--

INSERT INTO `intutive_price_settings` (`id`, `intutive_timing`, `price`, `created_at`, `updated_at`) VALUES
(1, '00:15:00', '30.00', '2019-01-29 21:30:00', '2019-01-31 01:39:26'),
(2, '00:30:00', '40.00', '2019-01-29 18:30:00', '2019-01-31 01:05:00'),
(3, '00:45:00', '60.00', '2019-01-29 18:30:00', '2019-01-29 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `intutive_reading_bookings`
--

DROP TABLE IF EXISTS `intutive_reading_bookings`;
CREATE TABLE `intutive_reading_bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `booking_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intutive_reading_bookings`
--

INSERT INTO `intutive_reading_bookings` (`id`, `user_id`, `booking_time`, `booking_date`, `created_at`, `updated_at`) VALUES
(1, 11, '10:00,10:15', '2019-02-08', '2019-02-05 18:30:00', '2019-02-05 18:30:00'),
(2, 11, '12:45,13:00', '2019-02-08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `massage_price_settings`
--

DROP TABLE IF EXISTS `massage_price_settings`;
CREATE TABLE `massage_price_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `massage_timing` time NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `massage_price_settings`
--

INSERT INTO `massage_price_settings` (`id`, `massage_timing`, `price`, `created_at`, `updated_at`) VALUES
(1, '00:30:00', '39.00', '2019-01-30 18:30:00', '2019-01-31 01:41:40'),
(2, '01:00:00', '75.00', '2019-01-30 18:30:00', '2019-01-30 18:30:00'),
(3, '01:30:00', '110.00', '2019-01-30 18:30:00', '2019-01-30 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `massage_therapy_bookings`
--

DROP TABLE IF EXISTS `massage_therapy_bookings`;
CREATE TABLE `massage_therapy_bookings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `booking_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_orders`
--

DROP TABLE IF EXISTS `master_orders`;
CREATE TABLE `master_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `bill_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_post_code` int(11) DEFAULT NULL,
  `bill_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_post_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ship_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL,
  `coupon_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_amount` decimal(10,2) DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` tinyint(4) DEFAULT '0' COMMENT '1=Paid,0=Unpaid',
  `order_status` tinyint(4) DEFAULT '0' COMMENT '1=Ship,0=Not Shipped',
  `shipping_date` date DEFAULT NULL,
  `order_notes` text COLLATE utf8mb4_unicode_ci,
  `shipping_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tracking_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_orders`
--

INSERT INTO `master_orders` (`id`, `user_id`, `bill_first_name`, `bill_last_name`, `email`, `bill_phone_number`, `bill_address1`, `bill_address2`, `bill_city`, `bill_post_code`, `bill_state`, `bill_country`, `ship_full_name`, `ship_phone_number`, `ship_address1`, `ship_address2`, `ship_city`, `ship_post_code`, `ship_state`, `ship_country`, `total_amount`, `discount_amount`, `discount_percentage`, `coupon_code`, `shipping_amount`, `transaction_id`, `payment_status`, `order_status`, `shipping_date`, `order_notes`, `shipping_url`, `tracking_id`, `created_at`, `updated_at`) VALUES
(6, 11, 'Wynter', 'Christensen', 'soumyadas02009@gmail.com', '68-9956871', '955 East Nobel Road', 'Hic laboris', 'Ipsum', 751010, 'Sit', 'Nostrum', ' Wynter Christensen', '68-9956871', '955 East Nobel Road', 'Hic laboris', 'Ipsum ', '751010', 'Sit', 'Nostrum', '37.99', '0.00', NULL, NULL, '3.00', '3WS05124JJ400603W', 1, 1, '2019-01-24', NULL, 'https://adminlte.io/themes/dev/AdminLTE/index2.html', 'NSANADAS89900', '2019-01-21 05:32:27', '2019-01-24 04:27:37'),
(7, 11, 'Wynter', 'Christensen', 'soumyadas02009@gmail.com', '68-9956871', '955 East Nobel Road', 'Hic laboris', 'Ipsum incidunt nobis id eum amet deserunt eu ullamco quo non qui et nulla ipsa repudiandae et', 751010, 'Sit', 'Nostrum', 'Wynter Christensen', '68-9956871', '955 East Nobel Road', 'Hic laboris', 'Ipsum incidunt nobis id eum amet deserunt eu ullamco quo non qui et nulla ipsa repudiandae et', '751010', 'Sit', 'Nostrum', '155.98', '0.00', NULL, NULL, '0.00', NULL, 0, 0, NULL, NULL, NULL, NULL, '2019-01-24 04:30:48', '2019-01-24 04:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2018_12_18_052822_create_banners_table', 1),
(7, '2018_12_20_055408_create_cms_pages_table', 2),
(8, '2018_12_20_072324_create_categories_table', 3),
(9, '2018_12_27_063400_create_news_letters_table', 4),
(10, '2018_12_27_125308_create_email_templates_table', 4),
(11, '2018_12_28_045630_create_products_table', 5),
(12, '2019_01_01_062500_create_coupon_codes_table', 6),
(13, '2019_01_08_122044_create_product_images_table', 7),
(14, '2019_01_09_122353_create_temp_carts_table', 8),
(15, '2019_01_17_054718_create_user_registrations_table', 9),
(16, '2019_01_17_070139_create_master_orders_table', 10),
(17, '2019_01_17_065549_create_order_items_table', 11),
(18, '2019_01_28_053132_create_service_schedules_table', 12),
(19, '2019_01_30_061904_create_intutive_price_settings_table', 13),
(20, '2019_01_30_061941_create_Massage_price_settings_table', 13),
(21, '2019_02_06_065524_create_intutive_reading_bookings_table', 14),
(22, '2019_02_06_070041_create_massage_therapy_bookings_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `news_letters`
--

DROP TABLE IF EXISTS `news_letters`;
CREATE TABLE `news_letters` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news_letters`
--

INSERT INTO `news_letters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'soumya@gmail.com', '2018-12-27 07:33:30', '2018-12-27 07:33:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `shipping_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `unit_price`, `quantity`, `total_price`, `shipping_price`, `created_at`, `updated_at`) VALUES
(7, 6, 1, '34.99', 1, '34.99', '3.00', '2019-01-21 05:32:27', '2019-01-21 05:32:27'),
(8, 7, 2, '55.99', 2, '111.98', '6.00', '2019-01-24 04:30:48', '2019-01-24 04:30:48'),
(9, 7, 3, '22.00', 2, '44.00', '6.00', '2019-01-24 04:30:48', '2019-01-24 04:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_settings`
--

DROP TABLE IF EXISTS `payment_settings`;
CREATE TABLE `payment_settings` (
  `id` int(11) NOT NULL,
  `paypal_environment` tinyint(4) NOT NULL COMMENT '1=Sandbox,2=Live',
  `paypal_email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_settings`
--

INSERT INTO `payment_settings` (`id`, `paypal_environment`, `paypal_email`, `created_at`, `updated_at`) VALUES
(1, 1, 'suresk_1314104870_biz@yahoo.com', '2019-01-21 06:41:12', '2019-01-21 01:11:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `sub_category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `discount_price` decimal(10,2) DEFAULT NULL,
  `shipping_price` decimal(10,2) DEFAULT NULL,
  `best_seller` tinyint(4) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `sub_category_id`, `name`, `slug`, `description`, `price`, `discount`, `discount_price`, `shipping_price`, `best_seller`, `image`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Iona', 'iona', '<p>Our Iona necklace is a must-have for those looking to calm upset states of mind and/or emotion. Comprised of Howlite, the wonder stone for healing, this gorgeous necklace is the perfect, subtle addition to any outfit.</p>', '69.99', 50, '34.99', '3.00', 0, '24275ZJ999005-1_540x.jpg', 'Iona', 'Iona', 'Iona', '2018-12-28 07:09:06', '2019-01-08 00:36:32'),
(2, 1, 1, 'Atri', 'atri', '<p>Consisting of Blue Point stone, and natural White Quartz, it&#39;s believed that this gorgeous combination of stones aids self-expression, safety and peace. Our Atri necklace is perfect for those seeking a inner-peace and confidence.</p>', '69.99', 20, '55.99', '3.00', 1, '36048ZJ999006-1_2048x2048.jpg', 'Atri', 'Atri', 'Atri', '2018-12-28 07:54:07', '2019-01-10 00:09:07'),
(3, 1, 3, 'Rose Quartz Crystal Point Pendant (Gold)', 'rose-quartz-crystal-point-pendant-gold', '<p>Rose Quartz Crystal Point Necklace (Gold)</p>\r\n\r\n<p>Rose Quartz opens the heart to all types of love. It helps to raise your self-esteem, restore confidence and balance the emotions. Rose Quartz also reduces Stress and grief. Rose Quartz is known to attract love.</p>\r\n\r\n<p>Listing is for 1 (one) polished rose quartz&nbsp; pendant with Gold attachment and the optional Gold LINK 2.5mm Necklace Chain with Lobster claw clasp, you choose the length.&nbsp;</p>', '22.00', NULL, NULL, '3.00', 1, '68432IMG_6551_889_1024x1024.jpg', 'Rose Quartz Crystal Point Pendant (Gold)', 'Rose Quartz Crystal Point Pendant (Gold)', 'Rose Quartz Crystal Point Pendant (Gold)', '2019-01-08 07:48:58', '2019-01-10 00:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE `product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(10, 3, '52229IMG_6557_563_1024x1024.jpg', '2019-01-09 05:07:08', '2019-01-09 05:07:08'),
(12, 3, '87426IMG_6543_751_1024x1024.jpg', '2019-01-09 05:33:42', '2019-01-09 05:33:42'),
(13, 3, '56060IMG_6551_889_1024x1024.jpg', '2019-01-09 05:33:42', '2019-01-09 05:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `service_schedules`
--

DROP TABLE IF EXISTS `service_schedules`;
CREATE TABLE `service_schedules` (
  `id` int(10) UNSIGNED NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_schedules`
--

INSERT INTO `service_schedules` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, '<ul>\r\n	<li>Monday: Jay (Astrologer)</li>\r\n	<li>Tuesday: Michael (Tarot )</li>\r\n	<li>Wednesday: Jay (Astrologer)</li>\r\n	<li>Thursday: Michael (Tarot)</li>\r\n	<li>Friday: Peggy (Clairvoyant)</li>\r\n	<li>Saturday: 10-2 pm Susan (Clairvoyant) 2-5 pm Tammy (Tarot)</li>\r\n	<li>Sunday: Lydia (Angel Card Readings)</li>\r\n</ul>', '2019-01-27 20:30:00', '2019-01-28 03:59:33'),
(2, '<ul>\r\n	<li>Monday: Eric</li>\r\n	<li>Tuesday: Eric</li>\r\n	<li>Wednesday: Hazel</li>\r\n	<li>Thursday: Eisha</li>\r\n	<li>Friday: Eisha</li>\r\n	<li>Saturday: Eisha and Eric</li>\r\n	<li>Sunday: Eric</li>\r\n</ul>', '2019-01-27 19:30:00', '2019-01-28 04:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 'Prayer Mala Necklaces', 'prayer-mala-necklaces', '2018-12-24 05:28:52', '2018-12-24 07:52:28'),
(2, 2, 'Eastern', 'eastern', '2018-12-31 05:07:07', '2018-12-31 05:07:07'),
(3, 1, 'Crystal Point Pendants', 'crystal-point-pendants', '2019-01-08 05:58:37', '2019-01-08 05:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `temp_carts`
--

DROP TABLE IF EXISTS `temp_carts`;
CREATE TABLE `temp_carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `total_shipping_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_carts`
--

INSERT INTO `temp_carts` (`id`, `user_id`, `session_id`, `product_id`, `unit_price`, `quantity`, `total_price`, `total_shipping_price`, `created_at`, `updated_at`) VALUES
(1, NULL, 'HnGenVSf012UhiqcRP5MLmt3Ix4sqzuqTQLlTuUF', 1, '34.99', 3, '104.97', '9.00', '2019-01-11 07:08:53', '2019-01-11 07:18:39'),
(2, NULL, 'HnGenVSf012UhiqcRP5MLmt3Ix4sqzuqTQLlTuUF', 2, '55.99', 1, '55.99', '3.00', '2019-01-11 07:09:29', '2019-01-11 07:09:29'),
(3, NULL, 'JsKOURzMi2JzLhSQpctAhJw7nEXfS83zGgq3MY3T', 1, '34.99', 1, '34.99', '3.00', '2019-01-14 00:25:27', '2019-01-14 00:25:27'),
(4, NULL, 'JsKOURzMi2JzLhSQpctAhJw7nEXfS83zGgq3MY3T', 2, '55.99', 1, '55.99', '3.00', '2019-01-14 00:25:41', '2019-01-14 00:25:41'),
(7, NULL, 'wz3SbvgRDdOyZ6jCP2k0egb2siPf0ysW9ZeWvNCY', 1, '34.99', 59, '2064.41', '177.00', '2019-01-14 06:51:58', '2019-01-14 08:05:49'),
(8, NULL, 'NcSozm91gquC5WFaGy3qMDNoWrVf4goixMPhXfZf', 1, '34.99', 76, '2659.24', '228.00', '2019-01-14 23:21:16', '2019-01-15 01:16:00'),
(10, NULL, 'NcSozm91gquC5WFaGy3qMDNoWrVf4goixMPhXfZf', 3, '22.00', 1, '22.00', '3.00', '2019-01-15 01:22:58', '2019-01-15 01:22:58'),
(11, NULL, 'vtyiZmLWpJGUOGRi0Mep2ZSQKemAexLKE55uA8cB', 1, '34.99', 1, '34.99', '3.00', '2019-01-15 01:25:06', '2019-01-15 01:25:06'),
(15, NULL, 'h9ozL1f332SoAMLz2Y4466FBo3AuLJJSJvdc61ix', 1, '34.99', 3, '104.97', '9.00', '2019-01-15 04:40:24', '2019-01-15 04:40:29'),
(27, NULL, 'TNTl0qAjStwLJVVnGxa58V3plNtdx52si1LkMfFb', 3, '22.00', 3, '66.00', '9.00', '2019-01-15 07:16:21', '2019-01-15 07:16:35'),
(28, NULL, 'phwuzp9qkYsfgWITljBwYSXofsKotF8MnX5dCw35', 2, '55.99', 1, '55.99', '3.00', '2019-01-15 07:23:37', '2019-01-15 07:23:37'),
(30, NULL, 'tkWf7f4ckoBOAkUB1OhvK1srotZJokjGATAM8q5l', 3, '22.00', 3, '66.00', '9.00', '2019-01-15 07:31:27', '2019-01-15 07:31:31'),
(31, NULL, 'qPbtmbKIDW9owudrBJlUG41EF8uRoYhWLJJFwJTE', 2, '55.99', 6, '335.94', '18.00', '2019-01-15 07:42:46', '2019-01-15 07:46:20'),
(34, NULL, 'cTotlubFNJPtEdHgQx8YTHwMqESTGJ3UhGFoyETw', 3, '22.00', 1, '22.00', '3.00', '2019-01-15 23:29:52', '2019-01-15 23:29:52'),
(38, NULL, '0CSB6XjqSB9tESvpAYKY4313G7RHMR0noUppxA31', 1, '34.99', 2, '69.98', '6.00', '2019-01-15 23:46:10', '2019-01-16 00:47:35'),
(41, NULL, '0CSB6XjqSB9tESvpAYKY4313G7RHMR0noUppxA31', 2, '55.99', 1, '55.99', '3.00', '2019-01-16 01:08:25', '2019-01-16 01:08:25'),
(42, NULL, 'O3RqWhAVTkhSxMOr7eVS9dQeA6QOPeKAWMkCHcPl', 1, '34.99', 3, '104.97', '9.00', '2019-01-16 23:14:17', '2019-01-16 23:14:21'),
(43, NULL, 'O3RqWhAVTkhSxMOr7eVS9dQeA6QOPeKAWMkCHcPl', 2, '55.99', 2, '111.98', '6.00', '2019-01-16 23:14:31', '2019-01-16 23:14:34'),
(44, NULL, 'fXjBSdQBpS7cOTEjT3xtEnx3FDFOQJmVItn7WlA9', 3, '22.00', 1, '22.00', '3.00', '2019-01-16 23:20:39', '2019-01-16 23:20:39'),
(45, NULL, 'RUGMDLPcDgCLgvnFb3K4lNuDNMux1BxwdSfFXGt8', 2, '55.99', 8, '447.92', '24.00', '2019-01-17 01:53:00', '2019-01-17 01:53:24'),
(46, NULL, 'xNBtx4jUmtSRWE9uD8Xsj1x8UQ1YNW8CefmqgTTs', 1, '34.99', 3, '104.97', '9.00', '2019-01-17 04:46:50', '2019-01-17 04:47:02'),
(47, NULL, 'xNBtx4jUmtSRWE9uD8Xsj1x8UQ1YNW8CefmqgTTs', 3, '22.00', 2, '44.00', '6.00', '2019-01-17 04:46:57', '2019-01-17 04:47:09'),
(48, NULL, 'ElEn25zRRtm1QEmgzUZcxOpvFDycYzSJTOeIhEib', 1, '34.99', 4, '139.96', '12.00', '2019-01-17 23:16:22', '2019-01-18 00:45:58'),
(49, NULL, 'ElEn25zRRtm1QEmgzUZcxOpvFDycYzSJTOeIhEib', 2, '55.99', 1, '55.99', '3.00', '2019-01-18 00:45:53', '2019-01-18 00:45:53'),
(53, NULL, 'ipLic3IEtIN6WJwyDUgmu5a1n2zsacuy9bCvCuKs', 2, '55.99', 2, '111.98', '6.00', '2019-01-18 05:53:31', '2019-01-18 05:53:34'),
(62, NULL, 'ON38TX2jMGtaad0npgHDnCgePUOIskzLTnxOCV0w', 3, '22.00', 2, '44.00', '6.00', '2019-01-21 03:13:24', '2019-01-21 04:39:20'),
(66, 11, 'PdRjF0UHHYDqqBLG1RVE9m9LQLsyuKflmMiV8w5o', 1, '34.99', 2, '69.98', '6.00', '2019-01-21 07:54:59', '2019-01-21 08:15:45'),
(69, NULL, 'iNcPCRslVkZpmLmrlrJmigGsuaZrPo5Tjx3QaHZS', 3, '22.00', 1, '22.00', '3.00', '2019-01-22 06:48:16', '2019-01-22 06:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_hours` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `alt_email`, `password`, `contact_no`, `address`, `opening_hours`, `facebook_url`, `twitter_url`, `instagram_url`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pixie Dust Admin', 'admin@pixiedust.com', 'info@pixiedustsarasota.com', '$2y$10$Zkx902clJCbwGzhB2GtF7OvRGpIRu0bnZ7l6ym/wOM3nQknn51MzK', '9413666325', 'Pixie Dust Metaphysical Boutique, 1476 Main Street, Sarasota, FL', 'Monday through Friday 11:00 am-6:00 pm</br>\r\nSaturday 9:00-5:00</br>\r\nSunday 11:00 am to 5:00 pm', 'https://facebook.com', 'https://twitter.com', 'https://instagram.com', 'MzUUwcpzpllKqABj3oCa7AWt1sIIh82o5EmKNlVOcn21KrulsfjALfZoZZ8z', '2018-12-13 13:00:00', '2019-01-03 05:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_registrations`
--

DROP TABLE IF EXISTS `user_registrations`;
CREATE TABLE `user_registrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_address2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_post_code` int(11) DEFAULT NULL,
  `bill_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bill_country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `same_for_billing` tinyint(4) NOT NULL COMMENT '1=Other,0=Same',
  `user_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_registrations`
--

INSERT INTO `user_registrations` (`id`, `bill_first_name`, `bill_last_name`, `email`, `bill_phone_number`, `user_password`, `bill_address1`, `bill_address2`, `bill_city`, `bill_post_code`, `bill_state`, `bill_country`, `same_for_billing`, `user_status`, `created_at`, `updated_at`) VALUES
(11, 'Wynter', 'Christensen', 'soumyadas02009@gmail.com', '68-9956871', '$2y$10$Zkx902clJCbwGzhB2GtF7OvRGpIRu0bnZ7l6ym/wOM3nQknn51MzK', '955 East Nobel Road1', 'Hic laboris', 'Ipsum incidunt nobis id eum amet deserunt eu ullamco quo non qui et nulla ipsa repudiandae et', 751010, 'Sit', 'Nostrum', 0, 1, '2019-01-21 05:32:21', '2019-02-08 05:01:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intutive_price_settings`
--
ALTER TABLE `intutive_price_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `intutive_reading_bookings`
--
ALTER TABLE `intutive_reading_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `intutive_reading_bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `massage_price_settings`
--
ALTER TABLE `massage_price_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `massage_therapy_bookings`
--
ALTER TABLE `massage_therapy_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `massage_therapy_bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `master_orders`
--
ALTER TABLE `master_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `master_orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_settings`
--
ALTER TABLE `payment_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `service_schedules`
--
ALTER TABLE `service_schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_carts`
--
ALTER TABLE `temp_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `temp_carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_alt_email_unique` (`alt_email`);

--
-- Indexes for table `user_registrations`
--
ALTER TABLE `user_registrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `coupon_codes`
--
ALTER TABLE `coupon_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `intutive_price_settings`
--
ALTER TABLE `intutive_price_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `intutive_reading_bookings`
--
ALTER TABLE `intutive_reading_bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `massage_price_settings`
--
ALTER TABLE `massage_price_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `massage_therapy_bookings`
--
ALTER TABLE `massage_therapy_bookings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_orders`
--
ALTER TABLE `master_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `payment_settings`
--
ALTER TABLE `payment_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `service_schedules`
--
ALTER TABLE `service_schedules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `temp_carts`
--
ALTER TABLE `temp_carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_registrations`
--
ALTER TABLE `user_registrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `intutive_reading_bookings`
--
ALTER TABLE `intutive_reading_bookings`
  ADD CONSTRAINT `intutive_reading_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user_registrations` (`id`);

--
-- Constraints for table `massage_therapy_bookings`
--
ALTER TABLE `massage_therapy_bookings`
  ADD CONSTRAINT `massage_therapy_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user_registrations` (`id`);

--
-- Constraints for table `master_orders`
--
ALTER TABLE `master_orders`
  ADD CONSTRAINT `master_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `user_registrations` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `master_orders` (`id`),
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `temp_carts`
--
ALTER TABLE `temp_carts`
  ADD CONSTRAINT `temp_carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
