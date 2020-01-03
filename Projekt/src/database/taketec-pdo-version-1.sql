-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2020 at 04:59 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taketec-pdo-version-1`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `description`) VALUES
(0, 'Apple');

-- --------------------------------------------------------

--
-- Table structure for table `category_has_news`
--

CREATE TABLE `category_has_news` (
  `catId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_has_news`
--

INSERT INTO `category_has_news` (`catId`, `newsId`) VALUES
(0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `newsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `imageId` int(11) NOT NULL,
  `imagePath` varchar(200) NOT NULL,
  `copyright` varchar(100) DEFAULT NULL,
  `newsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`imageId`, `imagePath`, `copyright`, `newsId`) VALUES
(0, 'assets\\images\\apple.jpg', 'https://ww.9to5mac.com/2019/12/30/product-red-apple-watch-series-5/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsId` int(11) NOT NULL,
  `creation` date NOT NULL,
  `updated` date DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `content` text NOT NULL,
  `copyright` varchar(100) DEFAULT NULL,
  `paidNew` tinyint(4) NOT NULL DEFAULT 0,
  `price` decimal(5,2) DEFAULT NULL,
  `newsTitle` varchar(100) NOT NULL,
  `newsShortDescription` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsId`, `creation`, `updated`, `userId`, `content`, `copyright`, `paidNew`, `price`, `newsTitle`, `newsShortDescription`) VALUES
(0, '2020-01-01', '2020-01-03', 1, 'Apple may be planning to launch the first PRODUCT (RED) Apple Watch as soon as spring 2020 according to a new report from WatchGeneration. The product was spotted as it showed up briefly in an Apple database.\r\n\r\nApple has participated in the PRODUCT (RED) charity for many years producing iPods, iPhones, cases, watch bands, and more in collaboration with the organization. One product itself that’s never been offered in (RED) is Apple Watch.', 'https://ww.9to5mac.com/2019/12/30/product-red-apple-watch-series-5/', 0, NULL, '(RED) Apple Watch found in Apple database, could arrive next spring', 'Apple may be planning to launch the first PRODUCT (RED) Apple Watch as soon as spring 2020 according to a new report from WatchGeneration.');

-- --------------------------------------------------------

--
-- Table structure for table `news_has_orders`
--

CREATE TABLE `news_has_orders` (
  `shoppingCartId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(11) NOT NULL,
  `user'Id` int(11) NOT NULL,
  `orderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `paymentMethodId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `cardType` tinyint(4) NOT NULL COMMENT '1 = Credit card\n0 = Debit card',
  `cardNumber` varchar(30) NOT NULL,
  `CVV` varchar(3) DEFAULT NULL,
  `nameOnCard` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `DOB` date NOT NULL,
  `country` varchar(2) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `eMail` varchar(256) NOT NULL,
  `permission` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `firstName`, `surname`, `password`, `gender`, `DOB`, `country`, `phone`, `eMail`, `permission`) VALUES
(1, 'max', 'mustermann', 'blablabla', 'm', '2020-01-02', 'DE', '5456416103652', 'aojsfdkoasjfd@sodfodfgj.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`);

--
-- Indexes for table `category_has_news`
--
ALTER TABLE `category_has_news`
  ADD KEY `fk_CATEGORY_has_NEWS_NEWS1_idx` (`newsId`),
  ADD KEY `fk_CATEGORY_has_NEWS_CATEGORY1_idx` (`catId`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `fk_COMMENT_NEWS1_idx` (`newsId`),
  ADD KEY `fk_COMMENT_USER1_idx` (`userId`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `fk_IMAGE_NEWS1_idx` (`newsId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`),
  ADD KEY `fk_NEWS_USER1_idx` (`userId`);

--
-- Indexes for table `news_has_orders`
--
ALTER TABLE `news_has_orders`
  ADD PRIMARY KEY (`shoppingCartId`),
  ADD KEY `fk_SHOPPING_CAR_ORDER1_idx` (`orderId`),
  ADD KEY `fk_SHOPPING_CAR_NEWS1_idx` (`newsId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `fk_ORDER_USER1` (`user'Id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`paymentMethodId`),
  ADD KEY `USERID_idx` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_has_news`
--
ALTER TABLE `category_has_news`
  ADD CONSTRAINT `fk_CATEGORY_has_NEWS_CATEGORY1` FOREIGN KEY (`catId`) REFERENCES `category` (`catId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CATEGORY_has_NEWS_NEWS1` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_COMMENT_NEWS1` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMMENT_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_IMAGE_NEWS1` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_NEWS_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `news_has_orders`
--
ALTER TABLE `news_has_orders`
  ADD CONSTRAINT `fk_SHOPPING_CAR_NEWS1` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SHOPPING_CAR_ORDER1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_ORDER_USER1` FOREIGN KEY (`user'Id`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `USERID` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
