-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2020 at 09:40 PM
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
CREATE DATABASE IF NOT EXISTS `taketec-pdo-version-1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `taketec-pdo-version-1`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `description`) VALUES
(1, 'IOS'),
(2, 'Android'),
(3, 'Apple'),
(4, 'Windows'),
(5, 'Wearables'),
(6, 'Audio'),
(7, 'Chrome OS');

-- --------------------------------------------------------

--
-- Table structure for table `category_has_news`
--

DROP TABLE IF EXISTS `category_has_news`;
CREATE TABLE `category_has_news` (
  `catId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_has_news`
--

INSERT INTO `category_has_news` (`catId`, `newsId`) VALUES
(3, 1),
(2, 2),
(2, 3),
(7, 4),
(5, 5),
(3, 5),
(1, 6),
(3, 6),
(2, 7);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `newsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `content`, `newsId`, `userId`) VALUES
(1, 'Thats a really cool Tablet ', 1, 1),
(2, 'It is but a think is way to expensive!', 1, 2),
(8, 'I would buy it', 1, 3),
(9, 'This is a cool article', 3, 4),
(10, 'This is a comment', 1, 4),
(11, 'I have this watch and I love it', 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
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
(1, 'iPad2020.jpg', 'Apple iPad', 1),
(2, 'galaxyBlomm.jpg', 'https://ww.9to5google.com/2020/01/10/galaxy-bloom/', 2),
(3, 'lenovo.jpg', 'https://unsplash.com/photos/3Zy3pR28IKc', 4),
(4, 'akku.jpg', 'https://unsplash.com/photos/rAtzDB6hWrU', 3),
(5, 'appleWatch.jpg', 'https://unsplash.com/photos/vCF5sB7QecM', 5),
(6, 'iPhoneSE2.jpg', 'https://ww.9to5mac.com/2020/01/11/iphone-se-2-price-specs-features-roundup/', 6),
(7, 'androidBoatware.jpg', 'https://ww.9to5google.com/2020/01/11/android-bloatware-privacy-open-letter/', 7);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
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
  `newsShortDescription` varchar(300) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsId`, `creation`, `updated`, `userId`, `content`, `copyright`, `paidNew`, `price`, `newsTitle`, `newsShortDescription`, `likes`) VALUES
(1, '2019-01-09', NULL, 1, 'Apple first introduced the 12.9-inch iPad Pro in 2015 followed by the 9.7-inch model in March of 2016. Second generation models were introduced in both 12.9-inch and 10.5-inch form factors in 2017.\r\n\r\nApple’s third-generation iPad Pro, which launched in November of 2018, comes in both 12.9-inch and a 11-inch sizes, features an all-screen display with minimal bezels, and no Home button. \r\n\r\nThe new iPads incorporate the TrueDepth camera from the iPhone line, allowing for Face ID biometric authentication.The iPad Pro is marketed as a device that is more powerful than most PCs, and the latest benchmarks of the A12X inside the 2018 models back that claim up.', 'https://ww.9to5mac.com/guides/ipad-pro/', 0, NULL, 'Everything about the iPad Pro', 'Get to know the iPad Pro and its features', 8),
(2, '2020-01-09', '2020-01-10', 2, 'Ever since Samsung showcased its potential clamshell foldable design at the Samsung Developer Conference late last year, we’ve been eagerly waiting for a glimpse of a potential clamshell Galaxy Fold sequel.In a secret meeting at CES 2020, Samsung appears to have confirmed the name of the new clamshell device according to South Korean news outlet Ajunews (via SamMobile). \r\n\r\nAt this secret meeting, it was confirmed that the updated foldable will be called the Galaxy Bloom, with DJ Koh even talking to select partners and potential providers.A leaked image of the slideshow presentation does indeed show the device with “Bloom” front-and-center. Koh explained to those lucky enough to attend, that the Galaxy Bloom has been inspired by the silhouette of the commonly seen makeup powder boxes from French cosmetic firm  Lancôme.', 'https://ww.9to5google.com/2020/01/10/galaxy-bloom/', 1, '1.99', 'Samsung Galaxy Bloom', 'Report: Samsung’s next foldable will be the ‘Galaxy Bloom’, gets secret CES showcase', 2),
(3, '2020-01-01', NULL, 2, 'Samsung’s One UI skin over Android has breathed new life into the company’s smartphones and as time goes on, it’s just getting better.\r\n\r\nThanks to a teardown of the latest One UI update, we’ve got some hints at what’s coming next to Samsung’s software including battery health monitoring, faster charging, and more new camera features.\r\n\r\nThe folks over at XDA-Developers took a deep dive into One UI 2.0 to see what’s in preparation under the hood. Among what they found, firstly, is a handful of new details on upcoming camera features.\r\nNew Camera Features\r\nIf you’ll recall last year, several new camera modes likely arriving on the Galaxy S11/S20 were discovered. One of those new modes was “Director’s View” and this latest teardown digs into that a bit further. Strings suggest that this camera mode will allow users to lock in on a subject and the phone will keep that subject in focus as well as getting close-up shots of the subject.\r\n\r\nFurther, another new camera is found in this latest teardown called “Single Take Photo.” With this mode, Samsung uses AI to automatically capture the best shots. Google does this to an extent with features such as Photobooth on the Pixel, but Samsung seems to be expanding things with tips for framing shots or different angles.\r\n\r\nFinally, rounding things out, there’s evidence that Samsung is bringing back a “Pro Video” mode. This would allow users to adjust shutter speed, ISO, exposure, and more in video just like Galaxy devices can currently do with photos. Bokeh effects may also arrive to mirror some of the Live Focus video effects that arrived with Note 10.', NULL, 0, NULL, 'New Battery for Samsung', 'Samsung teardown hints at new camera features, ‘Battery Health,’ super fast charging', 0),
(4, '2020-01-02', '2020-01-03', 1, 'The success of Chrome OS is thanks to the cheap Chromebooks that sell en masse, not the high-end models. At CES 2020 this week, we got a chance to spend some time with the Lenovo IdeaPad Duet, a Chrome OS tablet that ticks pretty much all of the boxes.\r\n\r\nSo, what’s been the problem with Chrome OS tablets so far? To date, only two Chrome OS tablets have launched, and, frankly, neither of them have been very good. That’s Google’s Pixel Slate, which was a monumental failure that saw the company pull out of tablets entirely, and the Acer Chromebook Tab 10, an education-focused machine. HP’s Chromebook X2 was perhaps the best effort, but it was still priced too high for general consumers.\r\n\r\nThe IdeaPad Duet solves the problems of those machines. Firstly, it’s affordable. The entire product is $279, and that includes the keyboard and kickstand cover, unlike other Chrome OS tablets that have launched to date.\r\nSecondly, the Lenovo IdeaPad Duet is a Chrome OS tablet that consumers might actually be interested in. A 10-inch tablet with a keyboard and a full browser is a compelling package that might even sway some iPad users, too.', 'https://ww.9to5google.com/2020/01/06/lenovo-ideapad-duet-first-impressions-chrome-os-tablet/', 1, '19.99', 'Chrome OS in Lenovo IdeaPad', 'Lenovo IdeaPad Duet finally gives Chrome OS the tablet it needs', 5),
(5, '2020-01-13', NULL, 2, 'Apple Watch is Apple’s wearable is designed to help you stay active, motivated, and connected. The newest version is the Series 4. Apple Watch is a main product for Apple’s health initiatives.\r\n\r\nSeries 4 features:\r\n64-bit dual-core S4 processor (Up to 2x faster than S3 processor)\r\n10.7mm thin\r\nElectrical heart sensor (ECG app)\r\nSecond-generation optical heart sensor\r\nFall Detection\r\nDigital Crown with haptic feedback\r\nLTE option\r\nThe original Watch (later called Series 0) was released April 24, 2015 after years of rumors. \r\n\r\nWhile there was a lot of initial hype around it, the 3rd party watchOS apps were slow to launch due to API limitations. Native apps were available in watchOS 2. The original watch came in 38mm and 42mm sizes.\r\n\r\nThe Series 2 Watch was released on September 16th, 2016 along with a Series 1 Watch. The Series 2 included the S2 chip, built-in GPS, and water-proof construction. The Series 1 included the S2, but lacked GPS and water proofing.\r\n\r\nThe Series 3 Watch was released on the September 22nd 2017, and it included an LTE option and the S3 chip.\r\n\r\nThe Series 4 Watch was released on September 21st, 2018. New hardware included the S4 Chip, Electrical heart sensor w/ ECG app, and larger display (40mm and 44mm sizes).\r\n\r\nThe Series 5 watch is expected to be released in 2019.\r\n\r\nThe Apple Watch runs watchOS, and the current version is watchOS 5.', 'https://ww.9to5mac.com/guides/apple-watch/', 0, '0.00', 'Get to Know the Apple Watch', 'Apple Watch is Apple’s wearable is designed to help you stay active, motivated, and connected.', 11),
(6, '2020-01-13', NULL, 2, 'Rumors of a new entry-level iPhone have picked up steam lately, thanks in large part to reliable Apple analyst Ming-Chi Kuo.\r\n\r\nThe new low-cost iPhone will reportedly target people still using older devices like the iPhone 6 that can’t run iOS 13. Read on as we round up what we know so far about the iPhone SE 2 features, specifications, and more.\r\n\r\nUpdate 1/11/20: As of the beginning of 2020, all signs still point to a spring release for the iPhone SE 2, but we’ve learned a few more details about the device.\r\n\r\nFirst off, as far as naming, a report has suggested that the iPhone SE 2 might actually be called the “iPhone 9.” This would make sense given the device’s rumored similarities to the iPhone 8, both in terms of design and form factor.\r\n\r\nSpeaking of design, a new set of video renders has offered a closer peak at what the iPhone 9 might look like. These renders depict a home with a form factor nearly identical to the iPhone 8, but with a frosted glass back similar to the iPhone 11 Pro finish. This would create a sense of uniformity among Apple’s iPhone lineup, despite the other differences in design.', 'https://ww.9to5mac.com/2020/01/11/iphone-se-2-price-specs-features-roundup/', 1, '1.99', 'The New iPhone SE 2', '[Update: Design details, ‘iPhone 9’] Everything we know about the iPhone SE 2', 2),
(7, '2020-01-13', NULL, 2, 'Whether it’s from OEMs or carriers, Android has always had a bit of a problem with bloatware. This week, an open letter hit the web with the backing of over 50 privacy organizations pushing Google to take action against bloatware on Android.\r\n\r\nPrivacy International (via ZDNet) posted an open letter to Google/Alphabet CEO Sundar Pichai asking him to take action against “exploitative pre-installed software on Android devices.” The letter pulls a statistic from a study that found that 91% of Android bloatware doesn’t even appear on Google Play.\r\n\r\nSince these apps are pre-installed and can’t be deleted as system apps, they can have more advanced permissions than a typical app. In that case, they might leave more privacy loopholes that the end-user isn’t even aware of. There have been examples of this in the past, too.\r\n\r\nIn the letter, Google is called to take the following “urgent” changes regarding Android bloatware. Firstly, that users should be allowed to fully delete any pre-installed app on their device. Secondly, these pre-installed apps should “adhere to the same scrutiny as Play Store apps.” Finally, pre-installed apps should have “some update mechanism” that doesn’t require an account and that Google should refuse to certify devices with privacy concerns.', 'https://ww.9to5google.com/2020/01/11/android-bloatware-privacy-open-letter/', 0, '0.00', 'Google Against Android Bloatware', 'Google pushed to take action against Android bloatware by 50+ organizations', 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

DROP TABLE IF EXISTS `payment_method`;
CREATE TABLE `payment_method` (
  `paymentMethodId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `cardType` tinyint(4) NOT NULL COMMENT '1 = Credit card\n0 = Debit card',
  `cardNumber` varchar(30) NOT NULL,
  `CVV` varchar(3) DEFAULT NULL,
  `nameOnCard` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`paymentMethodId`, `userId`, `cardType`, `cardNumber`, `CVV`, `nameOnCard`) VALUES
(1, 1, 1, '0000000000000000000', '865', 'Ahmad Abo Louha'),
(2, 2, 0, '111111111111', NULL, 'Alejandro Restrepo Klinge');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_article`
--

DROP TABLE IF EXISTS `purchased_article`;
CREATE TABLE `purchased_article` (
  `newsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchased_article`
--

INSERT INTO `purchased_article` (`newsId`, `userId`) VALUES
(4, 3),
(2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `surname` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
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
(1, 'Ahmad', 'Abo Louha', '$2y$10$v.OesU8F18k20JJxHalb2urgeXJvxy2Qv6inidkph1F5vX381SavK', 'm', '1993-09-08', 'DE', '01778899', 'ahmad@gmail.com', 1),
(2, 'Alejandro', 'Restrepo Klinge', '$2y$10$BA8xz.0aPyP62NX68HnxGeDCfdPdzJMVY3Ia2xPuhKpGwcMH6Xmn.', 'm', '1996-12-24', 'CO', '01778888', 'alejandro@gmail.com', 1),
(3, 'James', 'Bond', '$2y$10$KckKU1PyqY7q4wkAinREn.BDXmNYbpnjRLJDoJXL1Z00x9SmNGT0K', 'm', '1950-07-30', 'UK', '01778877', 'james@gmail.com', NULL),
(4, 'Maria', 'Mustermann', '$2y$10$nxUcO28S3wUS80NY7Tp22ufbGhyLvJm1A4AZIeeI8zc6i7PhTWxG.', 'f', '2002-02-02', 'DE', '2036598', 'maria@gmail.com', NULL),
(5, 'Sara', 'Musterfrau', '$2y$10$AchTLb1s7ZNPr9f5zo1DTebjVIW0OqJmNQYoNDt82mKwByTd6fgsq', 'f', '1999-02-02', 'NF', '01778811', 'sara@gmail.com', NULL),
(6, 'Sabrina', 'Oberli', '$2y$10$ayLfW/.EYyWBybydRpUDYut6yLMSAcl5TTwDrRyREBgxArp5ckKwS', 'f', '1950-11-20', 'VE', '202365986', 'sabrina@gmail.com', NULL);

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
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`paymentMethodId`),
  ADD KEY `USERID_idx` (`userId`);

--
-- Indexes for table `purchased_article`
--
ALTER TABLE `purchased_article`
  ADD KEY `fk_purchase_news` (`newsId`),
  ADD KEY `fk_purchase_user` (`userId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `paymentMethodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `USERID` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `purchased_article`
--
ALTER TABLE `purchased_article`
  ADD CONSTRAINT `fk_purchase_news` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`),
  ADD CONSTRAINT `fk_purchase_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
