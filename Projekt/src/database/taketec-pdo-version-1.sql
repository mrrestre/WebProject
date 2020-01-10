-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 10. Jan 2020 um 12:42
-- Server-Version: 10.4.8-MariaDB
-- PHP-Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `taketec-pdo-version-1`
--
CREATE DATABASE IF NOT EXISTS `taketec-pdo-version-1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `taketec-pdo-version-1`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL,
  `description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category_has_news`
--

CREATE TABLE `category_has_news` (
  `catId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comment`
--

CREATE TABLE `comment` (
  `commentId` int(11) NOT NULL,
  `content` text NOT NULL,
  `newsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `image`
--

CREATE TABLE `image` (
  `imageId` int(11) NOT NULL,
  `imagePath` varchar(200) NOT NULL,
  `copyright` varchar(100) DEFAULT NULL,
  `newsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `image`
--

INSERT INTO `image` (`imageId`, `imagePath`, `copyright`, `newsId`) VALUES
(7, '/assets/images/test.jpg', 'google', 10),
(8, 'hallo world', 'hallo worldhallo world', 11);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
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
  `newsShortDescription` varchar(300) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`newsId`, `creation`, `updated`, `userId`, `content`, `copyright`, `paidNew`, `price`, `newsTitle`, `newsShortDescription`, `likes`) VALUES
(2, '2020-01-01', NULL, 1, 'Samsung’s One UI skin over Android has breathed new life into the company’s smartphones and as time goes on, it’s just getting better. Thanks to a teardown of the latest One UI update, we’ve got some hints at what’s coming next to Samsung’s software including battery health monitoring, faster charging, and more new camera features.\r\n\r\n\r\nThe folks over at XDA-Developers took a deep dive into One UI 2.0 to see what’s in preparation under the hood. Among what they found, firstly, is a handful of new details on upcoming camera features.\r\n\r\nNew Camera Features\r\nIf you’ll recall last year, several new camera modes likely arriving on the Galaxy S11/S20 were discovered. One of those new modes was “Director’s View” and this latest teardown digs into that a bit further. Strings suggest that this camera mode will allow users to lock in on a subject and the phone will keep that subject in focus as well as getting close-up shots of the subject.\r\n\r\nFurther, another new camera is found in this latest teardown called “Single Take Photo.” With this mode, Samsung uses AI to automatically capture the best shots. Google does this to an extent with features such as Photobooth on the Pixel, but Samsung seems to be expanding things with tips for framing shots or different angles.\r\n\r\nFinally, rounding things out, there’s evidence that Samsung is bringing back a “Pro Video” mode. This would allow users to adjust shutter speed, ISO, exposure, and more in video just like Galaxy devices can currently do with photos. Bokeh effects may also arrive to mirror some of the Live Focus video effects that arrived with Note 10.', NULL, 0, NULL, 'new Battery', 'Samsung teardown hints at new camera features, ‘Battery Health,’ super fast charging', 0),
(3, '2020-01-02', '2020-01-03', 2, 'The success of Chrome OS is thanks to the cheap Chromebooks that sell en masse, not the high-end models. At CES 2020 this week, we got a chance to spend some time with the Lenovo IdeaPad Duet, a Chrome OS tablet that ticks pretty much all of the boxes.\r\n\r\n\r\nSo, what’s been the problem with Chrome OS tablets so far? To date, only two Chrome OS tablets have launched, and, frankly, neither of them have been very good. That’s Google’s Pixel Slate, which was a monumental failure that saw the company pull out of tablets entirely, and the Acer Chromebook Tab 10, an education-focused machine. HP’s Chromebook X2 was perhaps the best effort, but it was still priced too high for general consumers.\r\n\r\nThe IdeaPad Duet solves the problems of those machines. Firstly, it’s affordable. The entire product is $279, and that includes the keyboard and kickstand cover, unlike other Chrome OS tablets that have launched to date.\r\n\r\nSecondly, the Lenovo IdeaPad Duet is a Chrome OS tablet that consumers might actually be interested in. A 10-inch tablet with a keyboard and a full browser is a compelling package that might even sway some iPad users, too.', 'https://ww.9to5google.com/2020/01/06/lenovo-ideapad-duet-first-impressions-chrome-os-tablet/', 1, '19.99', 'Lenovo IdeaPad', 'Lenovo IdeaPad Duet finally gives Chrome OS the tablet it needs', 0),
(10, '2020-01-08', NULL, 1, 'content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test content test ', 'www.google.com', 0, '0.00', 'title test', 'Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test Teaser Test ', 1),
(11, '2020-01-10', NULL, 1, 'hallo world hallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo worldhallo world', 'hallo worldhallo world', 1, '0.00', 'hallo world', 'hallo worldhallo worldhallo world', 9);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `payment_method`
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
-- Tabellenstruktur für Tabelle `purchased_article`
--

CREATE TABLE `purchased_article` (
  `newsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `purchased_article`
--

INSERT INTO `purchased_article` (`newsId`, `userId`) VALUES
(3, 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
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
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`userId`, `firstName`, `surname`, `password`, `gender`, `DOB`, `country`, `phone`, `eMail`, `permission`) VALUES
(1, 'Ahmad', 'Abo Louha', '123123', 'm', '1993-09-08', 'DE', '01778899', 'ahmad@gmail.com', 1),
(2, 'alejandro', 'Restrepo Klinge', '123123', 'm', '1996-12-24', 'DE', '01778888', 'alejandro@gmail.com', 1),
(3, 'James', 'Bond', '123123', 'm', '1950-07-30', 'UK', '01778877', 'james@gmail.com', NULL),
(5, 'Maria', 'Mustermann', '123123', 'f', '2002-02-02', 'DE', '2036598', 'maria@gmail.com', NULL),
(6, 'Sara', 'Musterfrau', '123123', 'f', '1999-02-02', 'NF', '01778811', 'sara@gmail.com', NULL);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catId`);

--
-- Indizes für die Tabelle `category_has_news`
--
ALTER TABLE `category_has_news`
  ADD KEY `fk_CATEGORY_has_NEWS_NEWS1_idx` (`newsId`),
  ADD KEY `fk_CATEGORY_has_NEWS_CATEGORY1_idx` (`catId`);

--
-- Indizes für die Tabelle `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentId`),
  ADD KEY `fk_COMMENT_NEWS1_idx` (`newsId`),
  ADD KEY `fk_COMMENT_USER1_idx` (`userId`);

--
-- Indizes für die Tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `fk_IMAGE_NEWS1_idx` (`newsId`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`),
  ADD KEY `fk_NEWS_USER1_idx` (`userId`);

--
-- Indizes für die Tabelle `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`paymentMethodId`),
  ADD KEY `USERID_idx` (`userId`);

--
-- Indizes für die Tabelle `purchased_article`
--
ALTER TABLE `purchased_article`
  ADD KEY `fk_purchase_news` (`newsId`),
  ADD KEY `fk_purchase_user` (`userId`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `category`
--
ALTER TABLE `category`
  MODIFY `catId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `comment`
--
ALTER TABLE `comment`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `image`
--
ALTER TABLE `image`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `paymentMethodId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `category_has_news`
--
ALTER TABLE `category_has_news`
  ADD CONSTRAINT `fk_CATEGORY_has_NEWS_CATEGORY1` FOREIGN KEY (`catId`) REFERENCES `category` (`catId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CATEGORY_has_NEWS_NEWS1` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_COMMENT_NEWS1` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_COMMENT_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_IMAGE_NEWS1` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_NEWS_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `USERID` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `purchased_article`
--
ALTER TABLE `purchased_article`
  ADD CONSTRAINT `fk_purchase_news` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`),
  ADD CONSTRAINT `fk_purchase_user` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
