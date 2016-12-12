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
-- Table structure for table `Inventories`
--

DROP TABLE IF EXISTS `Inventories`;
CREATE TABLE `Inventories` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(64) NOT NULL,
    `quantity` varchar(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `Inventories` (`name`, `quantity`) VALUES
('Milk', 1000),
('Ice', 1000),
('Sugar', 1000),
('Water', 1000),
('Banana', 1000),
('Blueberry', 1000),
('Apple', 1000),
('Grape', 1000),
('Orange', 1000),
('Coconut Milk', 1000),
('Honey', 1000),
('Lime Refresher Base', 1000),
('Berry Refresher Base', 1000),
('Classic Syrup', 1000),
('An Infusion Of', 1000),
('Mocha Sauce', 1000),
('Whipped Cream', 1000),
('Vanilla Syrup', 1000),
('Chili Mocha Powder', 1000),
('Spiced Mocha Topping', 1000);


--
-- Table structure for table `Menu`
--

DROP TABLE IF EXISTS `Menu`;
CREATE TABLE `Menu` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(64) NOT NULL,
    `description` text NOT NULL,
    `price` decimal(20,2) NOT NULL,
    `picture` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `Menu` (`name`, `description`, `price`, `picture`) VALUES
('Caramel Macchiato', 'Freshly steamed milk with vanilla-flavored syrup is marked with espresso and topped with caramel drizzle for an oh-so-sweet finish.', 3.49, '1.jpg'),
('Cappuccino', 'Dark, rich espresso lies in wait under a smoothed and stretched layer of thick foam. It is truly the height of our baristas craft.', 3.99, '2.jpg'),
('Latte', 'Our dark, rich espresso balanced with steamed milk and a light layer of foam. A perfect milk forward warm up.', 4.35, '3.jpg'),
('Mocha', 'We combine our rich, full-bodied espresso with bittersweet mocha sauce and steamed milk, then top it off with sweetened whipped cream. The classic coffee drink to satisfy your sweet tooth.', 3.79, '4.jpg'),
('Pumpkin Spice Latte', 'Our signature espresso and milk are highlighted by flavor notes of pumpkin, cinnamon, nutmeg and clove to create this incredible beverage thats a fall favorite. Enjoy it topped with whipped cream and real pumpkin pie spices.', 4.99, '5.jpg'),
('White Chocolate Mocha', 'Our signature espresso meets white chocolate sauce and steamed milk, then is finished off with sweetened whipped cream in this white chocolate delight.', 4.99, '6.jpg'),
('Chocolate Mocha', 'Our signature espresso meets white chocolate sauce and steamed milk, then is finished off with sweetened whipped cream in this chocolate delight.', 3.59, '7.jpg');


--
-- Table structure for table `Recipes`
--

DROP TABLE IF EXISTS `Recipes`;
CREATE TABLE `Recipes` (
    `menu_id` int NOT NULL,
    `inventory_id` int NOT NULL,
    `quantity` varchar(3) NOT NULL,
    PRIMARY KEY (`menu_id`,`inventory_id`),
    FOREIGN KEY (`inventory_id`) REFERENCES `Inventories` (`id`),
    FOREIGN KEY (`menu_id`) REFERENCES `Menu` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `Recipes` (`menu_id`, `inventory_id`, `quantity`) VALUES
(1, 1, 2),
(1, 2, 3),
(1, 7, 4),
(1, 9, 5),
(1, 12, 5),
(1, 17, 1),
(2, 1, 5),
(2, 4, 1),
(2, 5, 2),
(2, 3, 1),
(3, 10, 2),
(3, 12, 4),
(3, 9, 8),
(3, 19, 5),
(3, 18, 5),
(4, 6, 4),
(4, 20, 5),
(4, 19, 1),
(4, 8, 2),
(4, 9, 3),
(5, 9, 3),
(5, 13, 7),
(5, 4, 6),
(5, 5, 4),
(5, 16, 1),
(5, 18, 5),
(6, 20, 6),
(6, 19, 7),
(6, 18, 1),
(7, 11, 3),
(7, 2, 2),
(7, 3, 5),
(7, 14, 5),
(7, 15, 3),
(7, 16, 2),
(7, 17, 3);

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
