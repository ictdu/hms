-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table ictdu_hms.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `rate` float NOT NULL,
  `description` varchar(255) NOT NULL,
  `capacity` varchar(6) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ictdu_hms.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `rate`, `description`, `capacity`, `image`, `created_at`, `updated_at`) VALUES
	(1000, 'Regular Room I', 999.99, 'A regular room.', '1-2', 'regular.jpg', '2021-02-20 21:53:14', '2021-03-02 08:52:57');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table ictdu_hms.checkouts
CREATE TABLE IF NOT EXISTS `checkouts` (
  `id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `room_number` bigint(6) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `notes` varchar(255) NOT NULL,
  `checked_in_by` bigint(6) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_CHECKED_IN_BY_USERS_ID` (`checked_in_by`)
) ENGINE=InnoDB AUTO_INCREMENT=4001 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ictdu_hms.checkouts: ~0 rows (approximately)
/*!40000 ALTER TABLE `checkouts` DISABLE KEYS */;
/*!40000 ALTER TABLE `checkouts` ENABLE KEYS */;

-- Dumping structure for table ictdu_hms.discounts
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  `code` varchar(6) NOT NULL,
  `discount` float NOT NULL,
  `number_of_usage` int(6) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ictdu_hms.discounts: ~0 rows (approximately)
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;

-- Dumping structure for table ictdu_hms.guests
CREATE TABLE IF NOT EXISTS `guests` (
  `id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `room_number` bigint(6) unsigned NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `notes` varchar(255) NOT NULL,
  `checked_in_by` bigint(6) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_CHECKED_IN_BY_USERS_ID` (`checked_in_by`),
  KEY `FK_GUESTS_ROOM_NUMBER_ROOMS_NUMBER` (`room_number`),
  CONSTRAINT `FK_CHECKED_IN_BY_USERS_ID` FOREIGN KEY (`checked_in_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_GUESTS_ROOM_NUMBER_ROOMS_NUMBER` FOREIGN KEY (`room_number`) REFERENCES `rooms` (`number`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ictdu_hms.guests: ~0 rows (approximately)
/*!40000 ALTER TABLE `guests` DISABLE KEYS */;
/*!40000 ALTER TABLE `guests` ENABLE KEYS */;

-- Dumping structure for table ictdu_hms.invoices
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `number` bigint(6) unsigned NOT NULL,
  `guest_id` bigint(6) unsigned NOT NULL,
  `balance` float unsigned NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `discounted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5001 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ictdu_hms.invoices: ~0 rows (approximately)
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;

-- Dumping structure for table ictdu_hms.reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `guest` bigint(6) unsigned NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_RESERVATION_ID_GUEST_ID` (`guest`),
  CONSTRAINT `FK_RESERVATION_ID_GUEST_ID` FOREIGN KEY (`guest`) REFERENCES `guests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ictdu_hms.reservations: ~0 rows (approximately)
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;

-- Dumping structure for table ictdu_hms.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `number` bigint(6) unsigned NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` varchar(12) NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`number`)
) ENGINE=InnoDB AUTO_INCREMENT=7001 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ictdu_hms.rooms: ~1 rows (approximately)
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` (`id`, `number`, `category`, `status`, `created_at`, `updated_at`) VALUES
	(7000, 69, 'Regular Room I', 'available', '2021-02-21 01:59:00', '2021-03-02 09:05:07');
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;

-- Dumping structure for table ictdu_hms.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(6) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'employee',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8001 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ictdu_hms.users: ~2 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `gender`, `role`, `updated_at`, `created_at`) VALUES
	(1, 'Juan', 'Dela Cruz', 'admin', '$2y$10$tdB657rnVTn7Vv3.ODgGUecibuHkDkAk29SU.VBvVZYN4.AQb/XcS', 'male', 'admin', '2021-02-19 18:39:20', '2021-02-19 15:03:44'),
	(8000, 'Patrick', 'Star', 'employee', '$2y$10$tdB657rnVTn7Vv3.ODgGUecibuHkDkAk29SU.VBvVZYN4.AQb/XcS', 'female', 'employee', '2021-03-02 06:39:11', '2021-02-19 23:13:46');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
