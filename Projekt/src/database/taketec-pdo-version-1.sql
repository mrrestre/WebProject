-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 04. Jan 2020 um 19:12
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

--
-- Daten für Tabelle `category`
--

INSERT INTO `category` (`catId`, `description`) VALUES
(1, 'Android'),
(2, 'iOS'),
(3, 'Windows'),
(4, 'macOS'),
(5, 'Samsung'),
(6, 'Google'),
(7, 'Huawei'),
(8, 'iPhone');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `category_has_news`
--

CREATE TABLE `category_has_news` (
  `catId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `category_has_news`
--

INSERT INTO `category_has_news` (`catId`, `newsId`) VALUES
(1, 1),
(6, 1),
(2, 0);

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
(0, '/assets/images/iPad2020.jpg', 'https://flipboard.com/topic/de-ipadpro', 0),
(1, '/assets/images/pixel4a.jpg', 'https://www.gsmarena.com/google_pixel_4_xl_official_render_leak-news-39436.php', 1);

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
  `newsShortDescription` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `news`
--

INSERT INTO `news` (`newsId`, `creation`, `updated`, `userId`, `content`, `copyright`, `paidNew`, `price`, `newsTitle`, `newsShortDescription`) VALUES
(0, '2020-01-01', NULL, 1, 'Should you wait for the 2020 iPad Pro, or is it OK to buy now? That’s a question a lot of people are asking at present, following reports that we’re likely to see new iPads in the first half of the year.\r\n\r\nIt is, of course, a truism in tech that, whenever you buy, something better will come along shortly afterward. You can’t worry about that, or else you’ll never buy anything. The question, then, is how big an upgrade are the 2020 iPad Pro models likely to be?\r\n\r\n\r\n\r\nLet’s start with changes we’re not likely to see.\r\n\r\nThings the 2020 iPad Pro probably won’t offer\r\nThere has long been talk of even larger iPads, with a 14.9-inch model suggested. Indeed, in a reader poll, some 45% of you wanted to see something larger than the 12.9-inch iPad.\r\n\r\nPersonally, I’d love one. It wouldn’t ever leave my home, but there are plenty of times when I’d really appreciate a larger display for home use.\r\n\r\nHowever, while I’m sure there’s a 15-inch iPad prototype floating around in Apple’s design lab, there’s been no indication at all that we’re going to see a larger one next year. The most recent report suggests that the external dimensions of the early 2020 models will be identical to the existing ones.\r\n\r\nWhile it’s not impossible that Apple might make the bezels slightly smaller, it doesn’t seem likely. Chances are that it will be the same display size in the same size casing.\r\n\r\nIt also seems unlikely that Apple will make the switch from LCD to OLED. The type of advanced OLED panels used in the latest iPhones would pose both cost and yield challenges, and there’s been no supply-chain suggestions of any switch at this point.\r\n\r\nIt’s also a safe bet that we won’t see 5G support in this year’s iPads: Apple always introduces new tech to the iPhone first, with the iPad following on behind. Expect 5G iPads next year.\r\n\r\nThings the 2020 iPad Pro may offer\r\nRenders based on a claimed design leak suggests that this year’s iPad Pro models may well get the same triple-camera module as the iPhone 11 Pro.\r\n\r\nWhile some have wondered what the point would be, as taking photos with an iPad is generally considered something of a joke, the leak is via Steve H. McFly, aka Onleaks, who correctly rendered the iPhone 11 Pro design in January of last year. It’s also consistent with a number of earlier reports.\r\n\r\nPersonally, I find the iPad a useful indoor camera, especially for product shots. The large display makes it easy to check focus, and also gives a better sense of the framing than a smaller iPhone screen, so the idea doesn’t seem as far-fetched to me as it does to some.\r\n\r\nWhat might be more interesting to many is a time-of-flight (ToF) camera system for better augmented reality performance, but, like 5G, that is extremely unlikely to come to the iPad ahead of the iPhone.\r\n\r\nBetter performance is a given, but in all honesty, there are few usage patterns that will benefit from it to any notable degree. What might be more appealing is if Apple finally bumps up the storage options. Currently, the base model is 64 GB, a pretty embarrassing starting point for a pro model in 2020. So we could see that boosted to 128 GB.\r\n\r\nWhether that would cascade through the higher storage tiers is a much trickier question. The four current storage tiers are 64 GB, 256 GB, 512 GB, and 1 TB. If the entry point is doubled to 128 GB, would the other levels remain the same, or could we see 512 GB, 1 TB, and 2 TB options?\r\n\r\nIt’s not impossible. Flash storage gets cheaper all the time, and we’ve already seen that reflected in the 16-inch MacBook Pro models, now offering cheaper SSD options throughout — and a massive 8 TB maximum. I wouldn’t, however, put money on it. The current 1 TB maximum is still a huge amount of storage for a tablet, and I suspect just a tiny percentage of buyers go for it. So my money would be on the remaining storage tiers going unchanged.\r\n\r\nSo … buy now, or wait?\r\nIf you do use your iPad Pro as a camera, the reports seem sufficiently plausible to me to suggest waiting in the hope that the triple-camera setup reports are accurate. That would transform the photographic capabilities of the device.\r\n\r\nIf your plan is to buy the base model when it comes to storage, there too I’d suggest waiting. That bump from 64 GB to 128 GB is far from certain, but I’d say there’s at least a decent chance, and it does make the machine significantly more useful when it comes to things like downloading movies and TV shows for viewing on planes and in areas with poor connectivity.\r\n\r\nIf you really do max out the performance of your iPad with things like video editing and games, that too would be another good reason to wait.\r\n\r\nFinally, any new model means discounts available on the old one. While Apple will simply replace the existing one in its lineup, the older models will still be available from other outlets, so you’ll likely save some money by waiting.\r\n\r\nOtherwise, though, I’m not expecting too much. Yes, the new iPad will be better in some respects, and there’s always the chance that Apple has a surprise in store, but you have to weigh that against the fact that if you buy now, you get to enjoy your new iPad for three to six months longer than if you wait for the upgrade. I’d say that if none of the above arguments apply to you, you might as well start enjoying your device today rather than wait an unknown period of time for rather marginal improvements.', 'https://ww.9to5mac.com/2019/12/30/wait-for-the-2020-ipad-pro/', 0, NULL, '2020 iPad Pro', 'Should you wait for the 2020 iPad Pro, or is it OK to buy now?'),
(1, '2020-01-02', '2020-01-03', 3, 'Google’s Pixel lineup usually leaks in huge quantities before launch, but the upcoming Pixel 4a has been relatively quiet so far outside of a couple of leaks and rumors. Today, a new rumor has come out to reveal two details about the Pixel 4a including its color, but it’s important to take it with a huge grain of salt.\r\n\r\n\r\n\r\nYouTuber Dave2D posted a video today talking about some details he was sent regarding the Pixel 4a. This “juice,” as he calls it, shouldn’t be taken as fact by any means. Not only does Dave2D have no track record for leaks of this nature, but he doesn’t specify his sources either. As we’ll further discuss below, this source goes completely contrary to our own sources so we can’t put any faith in this very sketchy rumor.\r\n\r\nLee explains that Pixel 4a will have a 5.81-inch display which does line up with recent CAD-based leaks of the device. He also mentions that the Pixel 4a will have a plastic unibody design and a fingerprint sensor on the back, but it won’t have wireless charging.\r\n\r\nIn the video, Lee also describes a new color variant for the Pixel 4a. Apparently, the device will come in three colors. The white would be a fairly traditional option with a white body and a “coral” power button, but the black model would adopt a green power button. Most interestingly, the Pixel 4a may come in an “arctic blue” color that has a “hot pink” power button.\r\n\r\nThe biggest part of this rumor, though, is mentioning that Pixel 4a won’t come in an “XL” size, but we wouldn’t put any faith in that.\r\n\r\nNot only would this be unprecedented for a Pixel smartphone, but our own sources have already implied there will be a Pixel 4a XL that will be priced slightly higher than the Pixel 3a XL, perhaps around $499. This information was shared last month on an episode of Alphabet Scoop.\r\n\r\nThe only piece of evidence that a Pixel 4a could drop the XL model is that we’ve yet to spot a potential codename for that device. Currently, only one codename, “Needlefish,” is outstanding but we don’t know for a fact that it relates to the 4a. At this time, we can’t put any faith in this rumor that a 4a XL isn’t coming to market.', 'https://ww.9to5google.com/2020/01/03/pixel-4a-blue-color-sketchy-rumor/', 0, NULL, 'Pixel 4a', 'Sketchy rumor claims Google Pixel 4a could include a blue color variant');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news_has_orders`
--

CREATE TABLE `news_has_orders` (
  `shoppingCartId` int(11) NOT NULL,
  `newsId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order`
--

CREATE TABLE `order` (
  `orderId` int(11) NOT NULL,
  `user'Id` int(11) NOT NULL,
  `orderDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Daten für Tabelle `payment_method`
--

INSERT INTO `payment_method` (`paymentMethodId`, `userId`, `cardType`, `cardNumber`, `CVV`, `nameOnCard`) VALUES
(1, 1, 1, 'DE8123456789789789', NULL, 'Ahmad Abo Louha'),
(2, 3, 0, 'DE885522885522885522', NULL, 'Alejandro Restrepo Klinge');

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
(1, 'Ahmad', 'Abo Louha', '12341234', 'm', '1993-09-08', 'DE', '0177889966', 'ahmad@gmail.com', 1),
(3, 'Alejandro', 'Restrepo Klinge', '123123', 'm', '1996-12-12', 'DE', '07788445566', 'alejandro@gmail.com', NULL);

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
-- Indizes für die Tabelle `news_has_orders`
--
ALTER TABLE `news_has_orders`
  ADD PRIMARY KEY (`shoppingCartId`),
  ADD KEY `fk_SHOPPING_CAR_ORDER1_idx` (`orderId`),
  ADD KEY `fk_SHOPPING_CAR_NEWS1_idx` (`newsId`);

--
-- Indizes für die Tabelle `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `fk_ORDER_USER1` (`user'Id`);

--
-- Indizes für die Tabelle `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`paymentMethodId`),
  ADD KEY `USERID_idx` (`userId`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

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
-- Constraints der Tabelle `news_has_orders`
--
ALTER TABLE `news_has_orders`
  ADD CONSTRAINT `fk_SHOPPING_CAR_NEWS1` FOREIGN KEY (`newsId`) REFERENCES `news` (`newsId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SHOPPING_CAR_ORDER1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_ORDER_USER1` FOREIGN KEY (`user'Id`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `payment_method`
--
ALTER TABLE `payment_method`
  ADD CONSTRAINT `USERID` FOREIGN KEY (`userId`) REFERENCES `user` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
