-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2016 at 11:37 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nature_gallery`
--
CREATE DATABASE IF NOT EXISTS `nature_gallery` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `nature_gallery`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Forests', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 19:59:18', '2016-02-02 19:59:18'),
(2, 'Lakes', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 19:59:18', '2016-02-02 19:59:18'),
(3, 'Mountains', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 19:59:49', '2016-02-02 19:59:49'),
(4, 'Wildlife', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 19:59:49', '2016-02-02 19:59:49'),
(5, 'Flowers', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:03:57', '2016-02-02 20:03:57'),
(6, 'Beach', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:03:57', '2016-02-02 20:03:57'),
(7, 'Landscape', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:04:40', '2016-02-02 20:04:40'),
(8, 'Sunsets', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:04:40', '2016-02-02 20:04:40'),
(9, 'Seascape', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:06:04', '2016-02-02 20:06:04'),
(10, 'Plants', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:06:04', '2016-02-02 20:07:56'),
(11, 'Animals', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:06:46', '2016-02-02 20:06:46'),
(12, 'Insects', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:06:46', '2016-02-02 20:06:46'),
(13, 'Underwater', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:08:20', '2016-02-02 20:08:20'),
(14, 'Weather', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:08:20', '2016-02-02 20:08:20'),
(15, 'Space', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 20:08:31', '2016-02-02 20:08:31');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `image_id` int(10) unsigned NOT NULL,
  `comment` mediumtext NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_com_1` (`user_id`),
  KEY `fk_com_2` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `image_id`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Lorem ipsum dolor sit amet', '2016-03-13 18:20:22', '2016-03-13 18:20:22'),
(2, 7, 1, 'Lorem ipsum', '2016-03-13 20:37:20', '2016-03-13 20:37:20'),
(3, 44, 1, 'At vero eos et accusamus et iusto odio dignissimos ducimus...', '2016-03-17 15:57:32', '2016-03-17 15:57:32'),
(4, 44, 16, 'Et harum quidem rerum facilis est et expedita distinctio.', '2016-03-17 16:01:35', '2016-03-17 16:01:35'),
(5, 44, 2, 'Et harum quidem rerum facilis est et expedita distinctio.', '2016-03-17 16:25:31', '2016-03-17 16:25:31'),
(6, 44, 15, 'Et harum quidem rerum facilis est et expedita distinctio.', '2016-03-17 16:28:07', '2016-03-17 16:28:07'),
(7, 44, 5, 'Et harum quidem rerum facilis est et expedita distinctio', '2016-03-17 16:29:01', '2016-03-17 16:29:01'),
(8, 44, 26, 'Et harum quidem rerum facilis est et expedita distinctio.', '2016-03-17 16:36:07', '2016-03-17 16:36:07'),
(9, 44, 19, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', '2016-03-17 16:37:53', '2016-03-17 16:37:53'),
(10, 17, 1, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.', '2016-03-17 16:40:56', '2016-03-17 16:40:56'),
(11, 18, 9, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium', '2016-03-31 19:41:09', '2016-03-31 19:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `follower`
--

CREATE TABLE IF NOT EXISTS `follower` (
  `user_id` int(10) unsigned NOT NULL,
  `follower_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`follower_id`),
  KEY `fk_user_2` (`follower_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(80) NOT NULL,
  `type` varchar(45) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `width` int(5) unsigned DEFAULT NULL,
  `height` int(5) unsigned DEFAULT NULL,
  `caption` varchar(200) DEFAULT NULL,
  `description` mediumtext,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_1_image` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `user_id`, `name`, `type`, `size`, `width`, `height`, `caption`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '4657483.jpg', 'image/jpeg', 70621, 800, 538, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-01-13 21:46:45', '2016-02-02 19:26:59'),
(2, 1, '27378589.jpg', 'image/jpeg', 53543, 640, 480, 'Lorem Ipsum', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2016-01-13 21:46:45', '2016-02-02 19:26:59'),
(3, 1, '56473823.jpg', 'image/jpeg', 264957, 1024, 768, 'Lorem Ipsum', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.', '2016-01-13 21:52:02', '2016-02-02 19:26:59'),
(4, 1, '95940202.jpg', 'image/jpeg', 310082, 770, 512, 'Lorem Ipsum', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?', '2016-01-13 21:52:02', '2016-02-02 19:26:59'),
(5, 1, '382480240.jpg', 'image/jpeg', 1451101, 1701, 1100, 'Lorem Ipsum', 'Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.', '2016-01-13 21:54:40', '2016-02-02 21:15:09'),
(8, 8, 'animals1.jpg', 'image/jpeg', 137372, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:14:52', '2016-02-02 21:16:04'),
(9, 8, 'animals2.jpg', 'image/jpeg', 52836, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:14:52', '2016-02-02 21:16:04'),
(10, 8, 'animals3.jpg', 'image/jpeg', 54421, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:18:28', '2016-02-02 21:18:28'),
(11, 8, 'animals4.jpg', 'image/jpeg', 220171, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:18:28', '2016-02-02 21:18:28'),
(12, 8, 'animals5.jpg', 'image/jpeg', 51182, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:20:33', '2016-02-02 21:20:33'),
(13, 13, 'forest1.jpg', 'image/jpeg', 93975, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:20:33', '2016-02-02 21:20:33'),
(14, 13, 'forest2.jpg', 'image/jpeg', 186229, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:22:34', '2016-02-02 21:22:34'),
(15, 13, 'forest3.jpg', 'image/jpeg', 72462, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:22:34', '2016-02-02 21:22:34'),
(16, 13, 'forest4.jpg', 'image/jpeg', 65064, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:24:37', '2016-02-02 21:24:37'),
(17, 13, 'forest5.jpg', 'image/jpeg', 74619, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:24:37', '2016-02-02 21:24:37'),
(18, 16, 'lake1.jpg', 'image/jpeg', 95858, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:26:39', '2016-02-02 21:26:39'),
(19, 16, 'lake2.jpg', 'image/jpeg', 32967, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:26:39', '2016-02-02 21:26:39'),
(20, 17, 'lake3.jpg', 'image/jpeg', 94586, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:29:15', '2016-02-02 21:29:15'),
(21, 17, 'lake4.jpg', 'image/jpeg', 55062, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:29:15', '2016-02-02 21:29:15'),
(22, 20, 'lake5.jpg', 'image/jpeg', 117625, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:31:29', '2016-02-02 21:31:29'),
(23, 13, 'mountain1.jpg', 'image/jpeg', 24646, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:31:29', '2016-02-02 21:31:29'),
(24, 1, 'mountain2.jpg', 'image/jpeg', 106416, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:33:25', '2016-02-02 21:33:25'),
(25, 19, 'mountain3.jpg', 'image/jpeg', 118607, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:33:25', '2016-02-02 21:33:25'),
(26, 19, 'mountain4.jpg', 'image/jpeg', 180053, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:35:48', '2016-02-02 21:35:48'),
(27, 19, 'mountain5.jpg', 'image/jpeg', 100521, 500, 333, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-02 21:35:48', '2016-02-02 21:35:48'),
(28, 18, 'lake6.jpg', 'image/jpeg', 4183255, 2560, 1707, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-02-03 19:21:41', '2016-02-03 19:21:41'),
(30, 44, '6d1dc93321c515eebaeeb9f31c12d5898c627f17.jpg', 'image/jpeg', 780564, NULL, NULL, 'Lorem Ipsum', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio...', '2016-04-05 19:45:32', '2016-04-05 19:45:32'),
(31, 44, 'e9e0074f96a0f8525c8065e345639523ba7b38c1.jpg', 'image/jpeg', 909256, NULL, NULL, 'Lorem Ipsum', 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?', '2016-04-05 19:56:45', '2016-04-20 19:07:50'),
(34, 44, '9eeb330f1329d1b95bb9cbf75166ce246f4e8b67.jpg', 'image/jpeg', 492335, 1920, 1200, 'Lorem Ipsum', 'Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.', '2016-04-06 18:52:37', '2016-04-06 18:52:37'),
(35, 44, '3fcc90ea6c1c82f9562f6edfd7c7d3f290373693.jpg', 'image/jpeg', 336655, 1920, 1200, 'Sea', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', '2016-04-06 18:55:54', '2016-04-06 18:55:54'),
(38, 44, '4ff12579796a357d39c688b92ea4ce8772814589.jpg', 'image/jpeg', 113250, 850, 553, 'Lorem Ipsum', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', '2016-04-06 19:19:29', '2016-04-06 19:19:29'),
(40, 44, '828131e13894fd670dc02b6df04bf37ea32777d1.jpg', 'image/jpeg', 100510, 1000, 635, 'Lorem Ipsum', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', '2016-04-06 19:24:30', '2016-04-06 19:24:30'),
(41, 44, '18a2df5d28b4694ad68ce68a1cdd91930b067ce5.jpg', 'image/jpeg', 40331, 800, 533, 'Lorem Ipsum', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.', '2016-04-06 19:44:27', '2016-04-06 19:44:27'),
(42, 44, '9c392ca8e50a0d9463a9cc5d8ecfc2368b765911.jpg', 'image/jpeg', 341162, 1920, 1200, 'Lorem Ipsum', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', '2016-04-26 18:16:52', '2016-04-26 18:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `image_category`
--

CREATE TABLE IF NOT EXISTS `image_category` (
  `image_id` int(10) unsigned NOT NULL,
  `cat_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`image_id`,`cat_id`),
  KEY `fk_2` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image_category`
--

INSERT INTO `image_category` (`image_id`, `cat_id`) VALUES
(5, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(28, 2),
(30, 2),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(31, 9),
(34, 9),
(35, 9),
(38, 9),
(40, 9),
(41, 9),
(42, 9);

-- --------------------------------------------------------

--
-- Table structure for table `image_rating`
--

CREATE TABLE IF NOT EXISTS `image_rating` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `user_session_id` char(32) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `rating` tinyint(1) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_rat_1` (`image_id`),
  KEY `fk_rat_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `image_tag`
--

CREATE TABLE IF NOT EXISTS `image_tag` (
  `image_id` int(10) unsigned NOT NULL,
  `tag_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`image_id`,`tag_id`),
  KEY `fk_tag_2` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tag` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` char(60) NOT NULL,
  `first_name` varchar(20) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `gender` enum('female','male') NOT NULL,
  `city` varchar(60) DEFAULT NULL,
  `state` varchar(60) DEFAULT NULL,
  `country` varchar(60) DEFAULT NULL,
  `is_active` char(60) DEFAULT NULL,
  `role` varchar(45) DEFAULT 'user',
  `cover_image` varchar(45) DEFAULT NULL,
  `profile_image` varchar(45) DEFAULT NULL,
  `about` mediumtext,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `login` (`username`,`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `gender`, `city`, `state`, `country`, `is_active`, `role`, `cover_image`, `profile_image`, `about`, `created_at`, `updated_at`) VALUES
(1, 'john.d@example.com', 'Johnny', '$2y$10$xj3FwCwSTZx.OTgtD25p5.Zf38vnY2Q2o0gx/Z834FYHNjPdI.hdq', 'John', 'Doe', 'male', 'Los Angeles', 'California', 'United States', NULL, 'user', NULL, 'johnny.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.', '2016-01-13 21:34:55', '2016-03-18 18:40:09'),
(7, 'alex.b@example.com', 'Alex', '$2y$10$Hloitw2z68Z.cjj6PojM5OEXwbj5ryj3CeAt3oSn6jO1HOR2jpUki', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-20 20:51:51', '2016-02-05 19:09:47'),
(8, 'rachel.n@example.com', 'Rachel', '$2y$10$kB73M/ss/8V7vliYCIRuj.IEtv9dClT3ah4lPafrL/PU223Q8Y4Yu', NULL, NULL, 'female', NULL, NULL, 'England', NULL, 'user', NULL, NULL, NULL, '2016-01-20 20:53:44', '2016-03-18 19:06:40'),
(9, 'marcus.d@example.com', 'Marc', '$2y$10$tUTySVowpcmUzltu3w/2i.Rt.bkXS34xX1isVl2doVhxHz0Oltdqa', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-20 21:28:39', '2016-02-05 19:09:47'),
(13, 'marie.m@example.com', 'Marie', '$2y$10$l.HMPiSg/8jCIG6bya9y/u1lE7KJ1SaKm1LtY/jwWPUqPC5vKHnS6', NULL, NULL, 'female', NULL, 'Alabama', NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-21 09:25:12', '2016-03-18 19:05:35'),
(14, 'miriam.s@example.com', 'Miriam', '$2y$10$Nn3p896QehGpcwM2zF0S4OXHV2jCUatt8bJAvKfzcScitqpct/ZKC', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-21 09:28:46', '2016-01-21 09:28:46'),
(15, 'tommy.e@example.com', 'Tommy', '$2y$10$wk4Tyb9RjcMplzRVN3md/e/9kgKumXzSADanjFRdWi/whYb2NLStG', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-24 18:40:59', '2016-02-05 19:09:47'),
(16, 'herminia.a@example.com', 'Herminia', '$2y$10$wV76XCz8jMN7FK3oIO1u6ef351rfqQDboGoxtiilpIAXaivE/o3tG', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-25 18:05:35', '2016-01-25 18:05:35'),
(17, 'monica.w@example.com', 'Monica', '$2y$10$rq/ze8jSiG/BQg8fKbNtxuoEIJSNJfSN.19RI6SKeMDNV.m7wkMMK', 'Monica', 'Wale', 'female', 'New Castle', NULL, 'England', NULL, 'user', NULL, NULL, 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.', '2016-01-26 21:30:37', '2016-03-29 18:51:59'),
(18, 'steve.a@example.com', 'Steve', '$2y$10$HMOMXz3mWuFvwWbR1Hjl4eFnN1TQRwI53dR6sA2Ddv0Xj5Jzvw1.q', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-26 21:33:25', '2016-03-31 20:15:55'),
(19, 'bonnie.a@example.com', 'Bonnie', '$2y$10$t.rWn6ONeNLQYlMVPTyEKuJzVSojpWftiZNSGdf/N.0kKi7wRIgyG', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-28 21:40:01', '2016-01-28 21:40:01'),
(20, 'mabel.p@example.com', 'Mabel', '$2y$10$Jj8ciyMCFoLfMRwlGVVYuO3v/0Y28RCCpBq8kAR5tsnPr/XIkn7gO', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-28 21:42:35', '2016-01-28 21:42:35'),
(21, 'jill.h@example.com', 'Jill', '$2y$10$E/72EmSTrZ/8B7eSV1GM3uaUJh3tJ7768q9k84ZkeawBY9radEUcW', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-28 21:52:43', '2016-01-28 21:52:43'),
(24, 'krin.t@example.com', 'Krin', '$2y$10$4a/BV6i/r489SFs1nQ53ZegAoGyZuWXugBvyBpFSzGrXbYvmg1tia', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-01-28 22:46:10', '2016-01-28 22:46:10'),
(29, 'angelica.t@example.com', 'Angelica', '$2y$10$Ix8RbPURmEJ.JjPBQInrK.sQgWaZCXqmBIX8tjI3PuQtLdSmk/DkC', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-02-22 18:05:12', '2016-02-22 18:48:12'),
(30, 'troy.l@example.com', 'Troy', '$2y$10$g12UqLXKzM.DfiucrdqP/.3aRpHSvR9R1wRtHjWwYU9XSxANaX9Zq', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-02-22 19:10:45', '2016-02-22 19:12:05'),
(31, 'tracy.r@example.com', 'Tracy', '$2y$10$IaDD9xW7Xx95lk5eIQMTE.Q6..2QTWpoltEPnuc8VpuOsmBGeYX4q', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-02-22 19:14:33', '2016-02-22 19:15:12'),
(32, 'april.c@example.com', 'April', '$2y$10$yIycJ8Rl82S2jxGJW5s2q.2tjbbPqXY1oQf/7nARx.dRlF5jvseFq', NULL, NULL, 'female', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-03-07 21:22:27', '2016-03-07 21:23:25'),
(38, 'cameron.a@example.com', 'Cameron', '$2y$10$26tQi6jU9TT2bM3ZnMoQ4OXTRe/ZltbiNO0cXWQCd2QjxlRKiNuK2', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-03-07 21:57:54', '2016-03-07 21:58:40'),
(44, 'amanda.a@example.com', 'Amanda', '$2y$10$TZFGFKfwKsgKuZ2rDzb7We/1jeCoxXJ4f0tVLLMLIO6pIM4cu9eKG', 'Amanda', 'Andersen', 'female', 'Rio de Janeiro', NULL, 'Brasil', NULL, 'user', NULL, 'ac900d6b66f5e3bc27f562f54f251dd41a96cf42.jpg', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.', '2016-03-09 17:16:24', '2016-04-13 20:18:30'),
(46, 'steve.l@example.com', 'Steve007', '$2y$10$hokQI2N/dzMeueNFsRiUO.cnDVBDNQyrNi6So0WwxWYPbtJPfh7KG', NULL, NULL, 'male', NULL, NULL, NULL, '5ea62483f4bf1c61832395a439ad4268', 'user', NULL, NULL, NULL, '2016-03-09 20:57:11', '2016-03-09 20:57:11'),
(49, 'tony.m@example.com', 'Tony', '$2y$10$2Rnz.alq1KC161yM/XXJZOqf6qYnczI0a9Onyy4WMRLkK1476QNcm', NULL, NULL, 'male', NULL, NULL, NULL, NULL, 'user', NULL, NULL, NULL, '2016-03-29 16:31:49', '2016-03-29 16:32:21');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_com_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_com_2` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follower`
--
ALTER TABLE `follower`
  ADD CONSTRAINT `fk_user_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_1_image` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_category`
--
ALTER TABLE `image_category`
  ADD CONSTRAINT `fk_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_2` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_rating`
--
ALTER TABLE `image_rating`
  ADD CONSTRAINT `fk_rat_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rat_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_tag`
--
ALTER TABLE `image_tag`
  ADD CONSTRAINT `fk_tag_1` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tag_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
