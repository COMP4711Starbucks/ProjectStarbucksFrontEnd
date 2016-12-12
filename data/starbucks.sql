/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  TianyangLiu
 * Created: Dec 8, 2016
 */

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starbucks`
--

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `Orders`;
CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`);

DROP TABLE IF EXISTS `Orderitems`;
CREATE TABLE `Orderitems` (
  `order_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  FOREIGN KEY (`order_id`) REFERENCES `Orders` (`id`),
  FOREIGN KEY (`menu_id`) REFERENCES `Menu` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `Orderitems`
  ADD PRIMARY KEY (`order_id`,`menu_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
