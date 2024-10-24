-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 09:42 PM
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
-- Database: `listasianapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `adverts`
--

CREATE TABLE `adverts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `manager_name` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `web` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 0,
  `seo1` tinyint(4) NOT NULL,
  `seo2` tinyint(4) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `package` bigint(20) UNSIGNED NOT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `sub_region_id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) DEFAULT NULL,
  `city_name` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `gplus_url` varchar(255) DEFAULT NULL,
  `youtube_url` varchar(255) DEFAULT NULL,
  `pinterest_url` varchar(255) DEFAULT NULL,
  `country` varchar(5) DEFAULT 'uk',
  `region` varchar(10) DEFAULT 'en-gb',
  `deleted_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `card_hash` varchar(255) NOT NULL,
  `stripe_customer_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` char(10) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `parent_id`, `name`, `url`, `deleted_at`, `created_at`, `updated_at`) VALUES
(24, 'J951', NULL, 'Jobs/Careers', 'jobscareers', NULL, '2024-10-23 07:11:17', '2024-10-23 07:11:17'),
(25, 'CJ885', 24, 'Current Jobs', 'current-jobs', NULL, '2024-10-23 07:11:29', '2024-10-23 07:11:29'),
(26, 'HS700', NULL, 'Home Services', 'home-services', NULL, '2024-10-23 07:11:44', '2024-10-23 07:11:44'),
(27, 'CC682', 26, 'Carpet Cleaning', 'carpet-cleaning', NULL, '2024-10-23 07:11:54', '2024-10-23 07:11:54'),
(28, 'DC582', 26, 'Dry Cleaning', 'dry-cleaning', NULL, '2024-10-23 07:12:15', '2024-10-23 07:12:15'),
(29, 'WS414', NULL, 'Wedding/Event Services', 'weddingevent-services', NULL, '2024-10-23 07:12:41', '2024-10-23 07:12:41'),
(30, 'C886', 29, 'Catering', 'catering', NULL, '2024-10-23 07:12:50', '2024-10-23 07:12:50'),
(31, 'C668', 29, 'Cakes', 'cakes', NULL, '2024-10-23 07:12:58', '2024-10-23 07:12:58'),
(32, 'BH&F817', NULL, 'Beauty, Health & Fitness', 'beauty-health-fitness', NULL, '2024-10-23 07:16:30', '2024-10-23 07:16:30'),
(33, 'BSM793', 32, 'Beauty Salons MUA', 'beauty-salons-mua', NULL, '2024-10-23 07:16:58', '2024-10-23 07:16:58'),
(34, 'D200', 32, 'Dentists', 'dentists', NULL, '2024-10-23 07:17:09', '2024-10-23 07:17:09'),
(35, 'D187', 32, 'Doctor', 'doctor', NULL, '2024-10-23 07:17:16', '2024-10-23 07:17:16'),
(36, 'PT296', 32, 'Personal Trainers', 'personal-trainers', NULL, '2024-10-23 07:17:31', '2024-10-23 07:17:31'),
(37, 'E109', NULL, 'Education', 'education', NULL, '2024-10-23 07:17:43', '2024-10-23 07:17:43'),
(38, 'PT/T768', 37, 'Private Tuition / Tutoring', 'private-tuition-tutoring', NULL, '2024-10-23 07:18:00', '2024-10-23 07:18:00'),
(39, 'E924', NULL, 'Entertainment', 'entertainment', NULL, '2024-10-23 07:18:16', '2024-10-23 07:18:16'),
(40, 'BC432', 39, 'Bouncy Castles', 'bouncy-castles', NULL, '2024-10-23 07:18:35', '2024-10-23 07:18:35'),
(41, 'DGP221', 39, 'Dancers/Bhangra Groups/Dhol Players/Fun', 'dancersbhangra-groupsdhol-playersfun', NULL, '2024-10-23 07:19:14', '2024-10-23 07:19:14'),
(42, 'DE801', 39, 'DJ Equipment', 'dj-equipment', NULL, '2024-10-23 07:19:26', '2024-10-23 07:19:26'),
(43, 'D361', 39, 'DJ\'s', 'djs', NULL, '2024-10-23 07:19:35', '2024-10-23 07:19:35'),
(44, 'PH708', 39, 'Photobooth Hire', 'photobooth-hire', NULL, '2024-10-23 07:19:52', '2024-10-23 07:19:52'),
(45, 'FD&SC749', NULL, 'Food, Drink & Sweet Centres', 'food-drink-sweet-centres', NULL, '2024-10-23 07:20:21', '2024-10-23 07:20:21'),
(46, 'AS627', 45, 'Asian Sweets', 'asian-sweets', NULL, '2024-10-23 07:20:36', '2024-10-23 07:20:36'),
(47, 'B-MG753', 45, 'Barbecues - Mixed Grill', 'barbecues-mixed-grill', NULL, '2024-10-23 07:20:59', '2024-10-23 07:20:59'),
(48, 'B&BS286', 45, 'Beer & Bar Supplies', 'beer-bar-supplies', NULL, '2024-10-23 07:21:20', '2024-10-23 07:21:20'),
(49, 'P439', 45, 'Pubs', 'pubs', NULL, '2024-10-23 07:21:27', '2024-10-23 07:21:27'),
(50, 'R163', 45, 'Restaurants', 'restaurants', NULL, '2024-10-23 07:21:40', '2024-10-23 07:21:40'),
(51, 'T960', 45, 'Takeaways', 'takeaways', NULL, '2024-10-23 07:21:52', '2024-10-23 07:21:52'),
(52, 'TS807', 45, 'Tea Suppliers', 'tea-suppliers', NULL, '2024-10-23 07:22:07', '2024-10-23 07:22:07'),
(53, 'G692', 26, 'Gardening/Landscape', 'gardeninglandscape', NULL, '2024-10-23 07:22:51', '2024-10-23 07:22:51'),
(54, 'GC797', 26, 'General Cleaning', 'general-cleaning', NULL, '2024-10-23 07:23:11', '2024-10-23 07:23:11'),
(55, 'M538', NULL, 'Motoring', 'motoring', NULL, '2024-10-23 07:23:42', '2024-10-23 07:23:42'),
(56, 'C&VH139', 55, 'Car & Van Hire', 'car-van-hire', NULL, '2024-10-23 07:23:56', '2024-10-23 07:23:56'),
(57, 'CP&A603', 55, 'Car Parts & Accessories', 'car-parts-accessories', NULL, '2024-10-23 07:24:13', '2024-10-23 07:24:13'),
(58, 'DS725', 55, 'Driving Schools', 'driving-schools', NULL, '2024-10-23 07:24:31', '2024-10-23 07:24:31'),
(59, 'M987', 55, 'Mechanics', 'mechanics', NULL, '2024-10-23 07:24:43', '2024-10-23 07:24:43'),
(60, 'M613', 55, 'MOT', 'mot', NULL, '2024-10-23 07:24:49', '2024-10-23 07:24:49'),
(61, 'PNP800', 55, 'Private Number Plates', 'private-number-plates', NULL, '2024-10-23 07:25:02', '2024-10-23 07:25:02'),
(62, 'T175', 55, 'Taxis', 'taxis', NULL, '2024-10-23 07:25:09', '2024-10-23 07:25:09'),
(63, 'T100', 55, 'Tyres', 'tyres', NULL, '2024-10-23 07:25:19', '2024-10-23 07:25:19'),
(64, 'OS634', NULL, 'Other Services', 'other-services', NULL, '2024-10-23 07:25:34', '2024-10-23 07:25:34'),
(65, 'A806', 64, 'Astrology', 'astrology', NULL, '2024-10-23 07:25:48', '2024-10-23 07:25:48'),
(66, 'FR513', 64, 'Fashion Retail', 'fashion-retail', NULL, '2024-10-23 07:26:01', '2024-10-23 07:26:01'),
(67, 'M279', 64, 'Misc', 'misc', NULL, '2024-10-23 07:26:08', '2024-10-23 07:26:08'),
(68, 'R624', 64, 'Religious2', 'religious2', NULL, '2024-10-23 07:26:19', '2024-10-23 07:26:19'),
(69, 'R463', NULL, 'Religious', 'religious', NULL, '2024-10-23 07:26:33', '2024-10-23 07:26:33'),
(70, 'G528', 69, 'Gurdwara', 'gurdwara', NULL, '2024-10-23 07:26:43', '2024-10-23 07:26:43'),
(71, 'WOG413', NULL, 'Whats On Guide', 'whats-on-guide', NULL, '2024-10-23 07:26:58', '2024-10-23 07:26:58'),
(72, 'WO228', 71, 'Whats On', 'whats-on', NULL, '2024-10-23 07:27:06', '2024-10-23 07:28:19'),
(74, 'P623', NULL, 'Professional', 'professional', NULL, '2024-10-23 07:33:33', '2024-10-23 07:33:33'),
(76, 'A555', 74, 'Accountants', 'accountants', NULL, '2024-10-23 07:41:00', '2024-10-23 07:41:00'),
(77, 'C478', 74, 'Claims', 'claims', NULL, '2024-10-23 07:41:09', '2024-10-23 07:41:09'),
(78, 'CM626', 74, 'Clothing Manufacturers', 'clothing-manufacturers', NULL, '2024-10-23 07:42:49', '2024-10-23 07:42:49'),
(79, 'E&LA328', 74, 'Estate & Letting Agents', 'estate-letting-agents', NULL, '2024-10-23 07:43:19', '2024-10-23 07:43:19'),
(80, 'F877', 74, 'Finance/Mortgages', 'financemortgages', NULL, '2024-10-23 07:43:44', '2024-10-23 07:43:44'),
(81, 'G&WD120', 74, 'Graphic & Web Design', 'graphic-web-design', NULL, '2024-10-23 07:50:21', '2024-10-23 07:50:21'),
(82, 'I283', 74, 'Immigration', 'immigration', NULL, '2024-10-23 07:50:36', '2024-10-23 07:50:36'),
(83, 'IT773', 74, 'Information Technology', 'information-technology', NULL, '2024-10-23 07:50:58', '2024-10-23 07:50:58'),
(84, 'I526', 74, 'Insurance', 'insurance', NULL, '2024-10-23 07:51:08', '2024-10-23 07:51:08'),
(85, 'MA-MP923', 74, 'Mobile Apps - Mobile Phones', 'mobile-apps-mobile-phones', NULL, '2024-10-23 07:51:25', '2024-10-23 07:51:25'),
(86, 'OM566', 74, 'Online Marketing/SEO', 'online-marketingseo', NULL, '2024-10-23 07:51:40', '2024-10-23 07:51:40'),
(87, 'P593', 74, 'Print', 'print', NULL, '2024-10-23 07:51:48', '2024-10-23 07:51:48'),
(88, 'RAW502', 74, 'Retail and Wholesale', 'retail-and-wholesale', NULL, '2024-10-23 07:52:02', '2024-10-23 07:52:02'),
(89, 'S-L304', 74, 'Solicitors - Lawyers', 'solicitors-lawyers', NULL, '2024-10-23 07:52:22', '2024-10-23 07:52:22'),
(90, 'TA591', 74, 'Travel Agents', 'travel-agents', NULL, '2024-10-23 07:52:31', '2024-10-23 07:52:31'),
(91, 'PI605', NULL, 'Property Improvements', 'property-improvements', NULL, '2024-10-23 07:53:01', '2024-10-23 07:53:01'),
(92, 'AI&R329', 91, 'Aerial Installation & Repair', 'aerial-installation-repair', NULL, '2024-10-23 07:53:44', '2024-10-23 07:53:44'),
(93, 'AC260', 91, 'Air Conditioning', 'air-conditioning', NULL, '2024-10-23 07:54:16', '2024-10-23 07:54:16'),
(94, 'AC&E794', 91, 'Alarms, CCTV & Electrical', 'alarms-cctv-electrical', NULL, '2024-10-23 07:54:36', '2024-10-23 07:54:36'),
(95, 'AS715', 91, 'Architectural Services', 'architectural-services', NULL, '2024-10-23 07:59:18', '2024-10-23 07:59:18'),
(96, 'B406', 91, 'Bedrooms', 'bedrooms', NULL, '2024-10-23 07:59:28', '2024-10-23 07:59:28'),
(97, 'B608', 91, 'Blinds', 'blinds', NULL, '2024-10-23 07:59:41', '2024-10-23 07:59:41'),
(98, 'BAR495', 91, 'Builder All Round', 'builder-all-round', NULL, '2024-10-23 07:59:54', '2024-10-23 07:59:54'),
(99, 'BM913', 91, 'Builders Merchants', 'builders-merchants', NULL, '2024-10-23 08:00:11', '2024-10-23 08:00:11'),
(100, 'CH979', 91, 'Central Heating', 'central-heating', NULL, '2024-10-23 08:00:23', '2024-10-23 08:00:23'),
(101, 'C618', 91, 'Concrete', 'concrete', NULL, '2024-10-23 08:00:36', '2024-10-23 08:00:36'),
(102, 'DP982', 91, 'Damp Proofing', 'damp-proofing', NULL, '2024-10-23 08:00:51', '2024-10-23 08:00:51'),
(103, 'D&H954', 91, 'DIY & Hardware', 'diy-hardware', NULL, '2024-10-23 08:01:08', '2024-10-23 08:01:08'),
(104, 'DG165', 91, 'Double Glazing', 'double-glazing', NULL, '2024-10-23 08:01:17', '2024-10-23 08:01:40'),
(105, 'EC-W964', 91, 'Electrical Contractors - Wholesale', 'electrical-contractors-wholesale', NULL, '2024-10-23 08:02:19', '2024-10-23 08:02:19'),
(106, 'ER479', 91, 'Electrical Repairs', 'electrical-repairs', NULL, '2024-10-23 08:02:39', '2024-10-23 08:02:39'),
(107, 'FS&S979', 91, 'Fencing Services & Supplies', 'fencing-services-supplies', NULL, '2024-10-23 08:07:17', '2024-10-23 08:07:17'),
(108, 'G&G194', 91, 'Gates & Grilles', 'gates-grilles', NULL, '2024-10-23 08:07:36', '2024-10-23 08:07:36'),
(109, 'K&B983', 91, 'Kitchens & Bathroom', 'kitchens-bathroom', NULL, '2024-10-23 08:07:59', '2024-10-23 08:07:59'),
(110, 'M&R551', 91, 'Maintenance & Repairs', 'maintenance-repairs', NULL, '2024-10-23 08:16:59', '2024-10-23 08:16:59'),
(111, 'P&D516', 91, 'Painting & Decorating', 'painting-decorating', NULL, '2024-10-23 08:18:30', '2024-10-23 08:19:07'),
(112, 'P250', 91, 'Plastering', 'plastering', NULL, '2024-10-23 08:19:52', '2024-10-23 08:19:52'),
(113, 'PW188', 91, 'Plastic Wholesale/Retail', 'plastic-wholesaleretail', NULL, '2024-10-23 08:20:11', '2024-10-23 08:20:11'),
(114, 'P122', 91, 'Plumbing', 'plumbing', NULL, '2024-10-23 08:20:21', '2024-10-23 08:20:21'),
(115, 'R331', 91, 'Refrigeration', 'refrigeration', NULL, '2024-10-23 08:20:33', '2024-10-23 08:20:33'),
(116, 'R', 91, 'Roofing', 'roofing', NULL, '2024-10-23 08:20:42', '2024-10-23 08:20:42'),
(117, 'S687', 91, 'Scaffolding', 'scaffolding', NULL, '2024-10-23 08:20:54', '2024-10-23 08:20:54'),
(118, 'S&S466', 91, 'Shopfronts & Shutters', 'shopfronts-shutters', NULL, '2024-10-23 08:21:14', '2024-10-23 08:21:14'),
(119, 'SW125', 91, 'Sign Writers', 'sign-writers', NULL, '2024-10-23 08:21:28', '2024-10-23 08:21:28'),
(120, 'SH893', 91, 'Skip Hire', 'skip-hire', NULL, '2024-10-23 08:21:37', '2024-10-23 08:21:37'),
(121, 'SP365', 91, 'Solar panels', 'solar-panels', NULL, '2024-10-23 08:21:46', '2024-10-23 08:21:46'),
(122, 'SC600', 91, 'Suspended Ceilings', 'suspended-ceilings', NULL, '2024-10-23 08:22:06', '2024-10-23 08:22:06'),
(123, 'WC103', 91, 'Windows Cleaning', 'windows-cleaning', NULL, '2024-10-23 08:22:16', '2024-10-23 08:22:16'),
(124, 'BSV455', 29, 'Banqueting Suites/Wedding Venues', 'banqueting-suiteswedding-venues', NULL, '2024-10-23 08:23:22', '2024-10-23 08:23:22'),
(125, 'BM332', 29, 'Bridal MUA\'s', 'bridal-muas', NULL, '2024-10-23 08:23:34', '2024-10-23 08:23:34'),
(126, 'BSF878', 29, 'Bridalwear, Sarees, Fashion', 'bridalwear-sarees-fashion', NULL, '2024-10-23 08:24:01', '2024-10-23 08:24:01'),
(127, 'C&LH194', 29, 'Car & Limousine Hire', 'car-limousine-hire', NULL, '2024-10-23 08:24:29', '2024-10-23 08:24:29'),
(128, 'C544', 29, 'Cards/Invitations/Printing', 'cardsinvitationsprinting', NULL, '2024-10-23 08:24:53', '2024-10-23 08:24:53'),
(129, 'CC437', 29, 'Chair Covers', 'chair-covers', NULL, '2024-10-23 08:25:15', '2024-10-23 08:25:15'),
(130, 'CF615', 29, 'Chocolate Fountains', 'chocolate-fountains', NULL, '2024-10-23 08:25:34', '2024-10-23 08:25:34'),
(131, 'CS136', 29, 'Clothing/Suit Shops', 'clothingsuit-shops', NULL, '2024-10-23 08:25:52', '2024-10-23 08:25:52'),
(132, 'C&CH609', 29, 'Crockery & Cutlery Hire', 'crockery-cutlery-hire', NULL, '2024-10-23 08:26:28', '2024-10-23 08:26:28'),
(133, 'D684', 29, 'Decorations', 'decorations', NULL, '2024-10-23 08:26:42', '2024-10-23 08:26:42'),
(134, 'E735', 29, 'Entertainments', 'entertainments', NULL, '2024-10-23 08:27:08', '2024-10-23 08:27:08'),
(135, 'FA&S328', 29, 'Fashion Accessories & Shops', 'fashion-accessories-shops', NULL, '2024-10-23 08:27:32', '2024-10-23 08:27:32'),
(136, 'F780', 29, 'Florists', 'florists', NULL, '2024-10-23 08:27:46', '2024-10-23 08:27:46'),
(137, 'FS948', 29, 'Funeral Services', 'funeral-services', NULL, '2024-10-23 08:28:01', '2024-10-23 08:28:01'),
(138, 'IS842', 29, 'Ice Sculptures', 'ice-sculptures', NULL, '2024-10-23 08:28:17', '2024-10-23 08:28:17'),
(139, 'J782', 29, 'Jewellers', 'jewellers', NULL, '2024-10-23 08:28:31', '2024-10-23 08:28:31'),
(140, 'MC752', 29, 'Meat Centres', 'meat-centres', NULL, '2024-10-23 08:28:52', '2024-10-23 08:28:52'),
(141, 'TM&M665', 29, 'Tents, Marquees & Mandaps', 'tents-marquees-mandaps', NULL, '2024-10-23 08:29:19', '2024-10-23 08:29:19'),
(142, 'TT710', 29, 'Turban Tying', 'turban-tying', NULL, '2024-10-23 08:29:30', '2024-10-23 08:29:30'),
(143, 'V&P121', 29, 'Video & Photography', 'video-photography', NULL, '2024-10-23 08:29:57', '2024-10-23 08:29:57'),
(144, 'W347', 29, 'Waitressing', 'waitressing', NULL, '2024-10-23 08:30:10', '2024-10-23 08:30:10'),
(145, 'WH363', 29, 'Wedding Horse', 'wedding-horse', NULL, '2024-10-23 08:30:20', '2024-10-23 08:30:20'),
(146, 'WP180', 29, 'Wedding/Event Planners', 'weddingevent-planners', NULL, '2024-10-23 08:30:36', '2024-10-23 08:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `category_advert`
--

CREATE TABLE `category_advert` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `advert_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `alias` varchar(255) NOT NULL,
  `lat` decimal(20,17) DEFAULT NULL,
  `lng` decimal(20,17) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(18, '0001_01_01_000000_create_users_table', 1),
(19, '0001_01_01_000001_create_cache_table', 1),
(20, '0001_01_01_000002_create_jobs_table', 1),
(21, '2024_10_21_064404_create_cards_table', 1),
(22, '2024_10_21_064540_create_categories_table', 1),
(23, '2024_10_21_064542_create_sub_regions_table', 1),
(24, '2024_10_21_064544_create_package_prices_table', 1),
(25, '2024_10_21_064546_create_prices_table', 1),
(26, '2024_10_21_064548_create_adverts_table', 1),
(27, '2024_10_21_064653_create_temp_images_table', 1),
(28, '2024_10_21_064754_create_plans_table', 1),
(29, '2024_10_21_064756_create_subscriptions_table', 1),
(30, '2024_10_21_064837_create_paylogs_table', 1),
(31, '2024_10_21_092409_create_category_adverts_table', 1),
(32, '2024_10_21_093612_create_countries_table', 1),
(33, '2024_10_21_094518_create_regions_table', 1),
(34, '2024_10_21_095747_create_tbl_migrations_table', 1),
(35, '2024_10_23_081739_add_password_column_to_users_table', 2),
(36, '2024_10_23_172837_add_timestamps_to_prices_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `package_prices`
--

CREATE TABLE `package_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `sub_region_id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) NOT NULL,
  `region_name` varchar(255) NOT NULL,
  `price_1` bigint(20) UNSIGNED NOT NULL,
  `price_2` bigint(20) UNSIGNED NOT NULL,
  `price_3` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paylogs`
--

CREATE TABLE `paylogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `advert_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `token` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `package` int(11) NOT NULL,
  `interval` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(5) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL,
  `value` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Silver', 220, 'UK Silver £219.99 (Yearly/Non-Recurring)', NULL, NULL),
(2, 'Gold', 500, 'UK Gold £499.99 (Yearly/Non-Recurring)', NULL, NULL),
(3, 'Platinum', 1000, 'UK Platinum £999.99 (Yearly/Non-Recurring)', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `country_id` int(10) UNSIGNED DEFAULT 0,
  `code` char(20) DEFAULT NULL,
  `lat` double DEFAULT 0,
  `lng` double DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('bFWzEK2gwRL6Aa6nLm5vRp2RQwQBkKx7W8XmBb39', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoiS0tnclFqZ3h2Qm00cFFFd1FwOG9pZGM4ZFRrMHZhS2FSSnJxR0pRWSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQyOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vYWR2ZXJ0cy9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo2O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkbDNLbXhyOUZnY2hVTU5QYjB5dUY2dW92a2xoN09PNktuQmJtRmsvNVJDTXVpdjEwNTQ1aUciO3M6ODoiZmlsYW1lbnQiO2E6MDp7fXM6NjoidGFibGVzIjthOjI6e3M6MjM6Ikxpc3RDYXRlZ29yaWVzX3Blcl9wYWdlIjtzOjM6ImFsbCI7czoxOToiTGlzdFByaWNlc19wZXJfcGFnZSI7czoxOiI1Ijt9fQ==', 1729710563),
('HP02JAeSLI2R5PPPHaqGpGvw0WNlDHiuZbebZBv4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVWN2YW9vRGxtYjFhY2xCQ3dHWGxUcFJZZmlSaWZQUnNHNXV1RUxBVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1729712243);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advert_id` bigint(20) UNSIGNED NOT NULL,
  `plan_id` bigint(20) UNSIGNED NOT NULL,
  `stripe_subscription_id` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_regions`
--

CREATE TABLE `sub_regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migrations`
--

CREATE TABLE `tbl_migrations` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 2,
  `discount` int(11) DEFAULT 0,
  `phone` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `role`, `discount`, `phone`, `notes`, `expiry`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(6, 'detahermana@gmail.com', 'deta', '$2y$12$l3Kmxr9FgchUMNPb0yuF6uovklh7OO6KnBbmFk/5RCMuiv10545iG', 1, 0, NULL, NULL, NULL, 'L8OvZtla9C1OAS1VJyLenTCiwY2RQfzhWXB4Het7neYxQYfECsFsDvxI0WpS', NULL, '2024-10-23 02:29:14', '2024-10-23 02:29:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adverts_category_id_foreign` (`category_id`),
  ADD KEY `adverts_user_id_foreign` (`user_id`),
  ADD KEY `adverts_package_foreign` (`package`),
  ADD KEY `adverts_sub_region_id_foreign` (`sub_region_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cards_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_code_unique` (`code`),
  ADD UNIQUE KEY `categories_url_unique` (`url`);

--
-- Indexes for table `category_advert`
--
ALTER TABLE `category_advert`
  ADD UNIQUE KEY `category_advert_unique` (`category_id`,`advert_id`),
  ADD KEY `category_advert_advert_id_foreign` (`advert_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_name` (`name`),
  ADD KEY `f930` (`code`);

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
-- Indexes for table `package_prices`
--
ALTER TABLE `package_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_prices_sub_region_id_foreign` (`sub_region_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `paylogs`
--
ALTER TABLE `paylogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paylogs_user_id_foreign` (`user_id`),
  ADD KEY `paylogs_advert_id_foreign` (`advert_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plans_stripe_id_unique` (`stripe_id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_name` (`name`),
  ADD KEY `f797` (`country_id`),
  ADD KEY `reg` (`code`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx-subscription-stripe_subscription_id` (`stripe_subscription_id`),
  ADD KEY `subscriptions_advert_id_foreign` (`advert_id`),
  ADD KEY `subscriptions_plan_id_foreign` (`plan_id`);

--
-- Indexes for table `sub_regions`
--
ALTER TABLE `sub_regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_migrations`
--
ALTER TABLE `tbl_migrations`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
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
-- AUTO_INCREMENT for table `adverts`
--
ALTER TABLE `adverts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `package_prices`
--
ALTER TABLE `package_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paylogs`
--
ALTER TABLE `paylogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_regions`
--
ALTER TABLE `sub_regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adverts`
--
ALTER TABLE `adverts`
  ADD CONSTRAINT `adverts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `adverts_package_foreign` FOREIGN KEY (`package`) REFERENCES `prices` (`id`),
  ADD CONSTRAINT `adverts_sub_region_id_foreign` FOREIGN KEY (`sub_region_id`) REFERENCES `sub_regions` (`id`),
  ADD CONSTRAINT `adverts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `category_advert`
--
ALTER TABLE `category_advert`
  ADD CONSTRAINT `category_advert_advert_id_foreign` FOREIGN KEY (`advert_id`) REFERENCES `adverts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_advert_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_prices`
--
ALTER TABLE `package_prices`
  ADD CONSTRAINT `package_prices_sub_region_id_foreign` FOREIGN KEY (`sub_region_id`) REFERENCES `sub_regions` (`id`);

--
-- Constraints for table `paylogs`
--
ALTER TABLE `paylogs`
  ADD CONSTRAINT `paylogs_advert_id_foreign` FOREIGN KEY (`advert_id`) REFERENCES `adverts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paylogs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_advert_id_foreign` FOREIGN KEY (`advert_id`) REFERENCES `adverts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptions_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
