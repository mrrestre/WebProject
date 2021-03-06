-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2020 at 11:45 AM
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
(2, 7),
(2, 8),
(5, 8),
(6, 8),
(2, 9),
(4, 10),
(7, 9),
(1, 11),
(3, 11),
(5, 11),
(6, 11),
(3, 13),
(1, 13),
(2, 14),
(2, 15),
(5, 15);

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

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`commentId`, `content`, `newsId`, `userId`) VALUES
(1, 'Thats a really cool Tablet ', 1, 1),
(2, 'It is but a think is way to expensive!', 1, 2),
(8, 'I would buy it', 1, 3),
(9, 'This is a cool article', 3, 4),
(10, 'This is a comment', 1, 4),
(11, 'I have this watch and I love it', 5, 6),
(12, 'Nice Phone!', 8, 6),
(13, 'Cool but way to expensive', 14, 4),
(14, 'I Want This so Bad', 15, 4),
(15, 'I used this as nightstand 8)', 13, 3),
(16, 'Not the best i\'ve seen', 14, 3),
(17, 'No Laser? BOOOORING', 5, 3),
(18, 'I would sell my liver for one of those ', 14, 5),
(19, 'Im prefer products not made by Apple', 11, 5),
(20, 'Never gonna give you up', 13, 13);

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
(1, 'iPad2020.jpg', 'Apple iPad', 1),
(2, 'galaxyBlomm.jpg', 'https://ww.9to5google.com/2020/01/10/galaxy-bloom/', 2),
(3, 'lenovo.jpg', 'https://unsplash.com/photos/3Zy3pR28IKc', 4),
(4, 'akku.jpg', 'https://unsplash.com/photos/rAtzDB6hWrU', 3),
(5, 'appleWatch.jpg', 'https://unsplash.com/photos/vCF5sB7QecM', 5),
(6, 'iPhoneSE2.jpg', 'https://ww.9to5mac.com/2020/01/11/iphone-se-2-price-specs-features-roundup/', 6),
(7, 'androidBoatware.jpg', 'https://ww.9to5google.com/2020/01/11/android-bloatware-privacy-open-letter/', 7),
(8, 'galaxyBuds.jpg', 'https://9to5google.com/2020/02/20/samsung-galaxy-buds-plus-review/', 8),
(9, 'samsungGalaxyChromebook.jpg', 'https://9to5google.com/2020/02/20/samsung-galaxy-chromebook-release-date-leak/', 9),
(10, 'surfacePro.jpg', 'https://cdn0.tnwcdn.com/wp-content/blogs.dir/1/files/2019/10/Surface-Pro-7-and-X-2-of-7.jpg', 10),
(11, 'AirPods.jpg', 'https://9to5mac.com/2020/02/11/airpods-continue-to-dominate/', 11),
(12, 'MacPro.jpg', NULL, 13),
(13, 'S20Ultra.jpg', 'https://www.schmidtisblog.de/samsung-galaxy-s20-ultra-hat-erwartungsgemaess-das-beste-smartphone-dis', 14),
(14, 'active2.jpg', 'https://www.golem.de/news/galaxy-watch-active-2-samsungs-neue-smartwatch-bekommt-eine-digitale-luene', 15);

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
  `newsShortDescription` varchar(300) NOT NULL,
  `likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsId`, `creation`, `updated`, `userId`, `content`, `copyright`, `paidNew`, `price`, `newsTitle`, `newsShortDescription`, `likes`) VALUES
(1, '2019-01-09', NULL, 1, 'Apple first introduced the 12.9-inch iPad Pro in 2015 followed by the 9.7-inch model in March of 2016. Second generation models were introduced in both 12.9-inch and 10.5-inch form factors in 2017.\r\n\r\nApple’s third-generation iPad Pro, which launched in November of 2018, comes in both 12.9-inch and a 11-inch sizes, features an all-screen display with minimal bezels, and no Home button. \r\n\r\nThe new iPads incorporate the TrueDepth camera from the iPhone line, allowing for Face ID biometric authentication.The iPad Pro is marketed as a device that is more powerful than most PCs, and the latest benchmarks of the A12X inside the 2018 models back that claim up.', 'https://ww.9to5mac.com/guides/ipad-pro/', 0, '0.00', 'Everything about the iPad Pro', 'Get to know the iPad Pro and its features', 8),
(2, '2020-01-09', '2020-01-10', 2, 'Ever since Samsung showcased its potential clamshell foldable design at the Samsung Developer Conference late last year, we’ve been eagerly waiting for a glimpse of a potential clamshell Galaxy Fold sequel.In a secret meeting at CES 2020, Samsung appears to have confirmed the name of the new clamshell device according to South Korean news outlet Ajunews (via SamMobile). \r\n\r\nAt this secret meeting, it was confirmed that the updated foldable will be called the Galaxy Bloom, with DJ Koh even talking to select partners and potential providers.A leaked image of the slideshow presentation does indeed show the device with “Bloom” front-and-center. Koh explained to those lucky enough to attend, that the Galaxy Bloom has been inspired by the silhouette of the commonly seen makeup powder boxes from French cosmetic firm  Lancôme.', 'https://ww.9to5google.com/2020/01/10/galaxy-bloom/', 1, '1.99', 'Samsung Galaxy Bloom', 'Report: Samsung’s next foldable will be the ‘Galaxy Bloom’, gets secret CES showcase', 2),
(3, '2020-01-01', NULL, 2, 'Samsung’s One UI skin over Android has breathed new life into the company’s smartphones and as time goes on, it’s just getting better.\r\n\r\nThanks to a teardown of the latest One UI update, we’ve got some hints at what’s coming next to Samsung’s software including battery health monitoring, faster charging, and more new camera features.\r\n\r\nThe folks over at XDA-Developers took a deep dive into One UI 2.0 to see what’s in preparation under the hood. Among what they found, firstly, is a handful of new details on upcoming camera features.\r\nNew Camera Features\r\nIf you’ll recall last year, several new camera modes likely arriving on the Galaxy S11/S20 were discovered. One of those new modes was “Director’s View” and this latest teardown digs into that a bit further. Strings suggest that this camera mode will allow users to lock in on a subject and the phone will keep that subject in focus as well as getting close-up shots of the subject.\r\n\r\nFurther, another new camera is found in this latest teardown called “Single Take Photo.” With this mode, Samsung uses AI to automatically capture the best shots. Google does this to an extent with features such as Photobooth on the Pixel, but Samsung seems to be expanding things with tips for framing shots or different angles.\r\n\r\nFinally, rounding things out, there’s evidence that Samsung is bringing back a “Pro Video” mode. This would allow users to adjust shutter speed, ISO, exposure, and more in video just like Galaxy devices can currently do with photos. Bokeh effects may also arrive to mirror some of the Live Focus video effects that arrived with Note 10.', NULL, 0, '0.00', 'New Battery for Samsung', 'Samsung teardown hints at new camera features, ‘Battery Health,’ super fast charging', 0),
(4, '2020-01-02', '2020-01-03', 1, 'The success of Chrome OS is thanks to the cheap Chromebooks that sell en masse, not the high-end models. At CES 2020 this week, we got a chance to spend some time with the Lenovo IdeaPad Duet, a Chrome OS tablet that ticks pretty much all of the boxes.\r\n\r\nSo, what’s been the problem with Chrome OS tablets so far? To date, only two Chrome OS tablets have launched, and, frankly, neither of them have been very good. That’s Google’s Pixel Slate, which was a monumental failure that saw the company pull out of tablets entirely, and the Acer Chromebook Tab 10, an education-focused machine. HP’s Chromebook X2 was perhaps the best effort, but it was still priced too high for general consumers.\r\n\r\nThe IdeaPad Duet solves the problems of those machines. Firstly, it’s affordable. The entire product is $279, and that includes the keyboard and kickstand cover, unlike other Chrome OS tablets that have launched to date.\r\nSecondly, the Lenovo IdeaPad Duet is a Chrome OS tablet that consumers might actually be interested in. A 10-inch tablet with a keyboard and a full browser is a compelling package that might even sway some iPad users, too.', 'https://ww.9to5google.com/2020/01/06/lenovo-ideapad-duet-first-impressions-chrome-os-tablet/', 1, '2.99', 'Chrome OS in Lenovo IdeaPad', 'Lenovo IdeaPad Duet finally gives Chrome OS the tablet it needs', 5),
(5, '2020-01-13', '2020-02-12', 2, 'Apple Watch is Apple’s wearable is designed to help you stay active, motivated, and connected. The newest version is the Series 4. Apple Watch is a main product for Apple’s health initiatives.\r\n\r\nSeries 4 features:\r\n64-bit dual-core S4 processor (Up to 2x faster than S3 processor)\r\n10.7mm thin\r\nElectrical heart sensor (ECG app)\r\nSecond-generation optical heart sensor\r\nFall Detection\r\nDigital Crown with haptic feedback\r\nLTE option\r\nThe original Watch (later called Series 0) was released April 24, 2015 after years of rumors. \r\n\r\nWhile there was a lot of initial hype around it, the 3rd party watchOS apps were slow to launch due to API limitations. Native apps were available in watchOS 2. The original watch came in 38mm and 42mm sizes.\r\n\r\nThe Series 2 Watch was released on September 16th, 2016 along with a Series 1 Watch. The Series 2 included the S2 chip, built-in GPS, and water-proof construction. The Series 1 included the S2, but lacked GPS and water proofing.\r\n\r\nThe Series 3 Watch was released on the September 22nd 2017, and it included an LTE option and the S3 chip.\r\n\r\nThe Series 4 Watch was released on September 21st, 2018. New hardware included the S4 Chip, Electrical heart sensor w/ ECG app, and larger display (40mm and 44mm sizes).\r\n\r\nThe Series 5 watch is expected to be released in 2019.\r\n\r\nThe Apple Watch runs watchOS, and the current version is watchOS 5.', 'https://ww.9to5mac.com/guides/apple-watch/', 0, '0.00', 'Get to Know the Apple Watch', 'Apple Watch is Apple’s wearable is designed to help you stay active, motivated, and connected.', 12),
(6, '2020-01-13', NULL, 2, 'Rumors of a new entry-level iPhone have picked up steam lately, thanks in large part to reliable Apple analyst Ming-Chi Kuo.\r\n\r\nThe new low-cost iPhone will reportedly target people still using older devices like the iPhone 6 that can’t run iOS 13. Read on as we round up what we know so far about the iPhone SE 2 features, specifications, and more.\r\n\r\nUpdate 1/11/20: As of the beginning of 2020, all signs still point to a spring release for the iPhone SE 2, but we’ve learned a few more details about the device.\r\n\r\nFirst off, as far as naming, a report has suggested that the iPhone SE 2 might actually be called the “iPhone 9.” This would make sense given the device’s rumored similarities to the iPhone 8, both in terms of design and form factor.\r\n\r\nSpeaking of design, a new set of video renders has offered a closer peak at what the iPhone 9 might look like. These renders depict a home with a form factor nearly identical to the iPhone 8, but with a frosted glass back similar to the iPhone 11 Pro finish. This would create a sense of uniformity among Apple’s iPhone lineup, despite the other differences in design.', 'https://ww.9to5mac.com/2020/01/11/iphone-se-2-price-specs-features-roundup/', 1, '1.99', 'The New iPhone SE 2', '[Update: Design details, ‘iPhone 9’] Everything we know about the iPhone SE 2', 3),
(7, '2020-01-13', NULL, 2, 'Whether it’s from OEMs or carriers, Android has always had a bit of a problem with bloatware. This week, an open letter hit the web with the backing of over 50 privacy organizations pushing Google to take action against bloatware on Android.\r\n\r\nPrivacy International (via ZDNet) posted an open letter to Google/Alphabet CEO Sundar Pichai asking him to take action against “exploitative pre-installed software on Android devices.” The letter pulls a statistic from a study that found that 91% of Android bloatware doesn’t even appear on Google Play.\r\n\r\nSince these apps are pre-installed and can’t be deleted as system apps, they can have more advanced permissions than a typical app. In that case, they might leave more privacy loopholes that the end-user isn’t even aware of. There have been examples of this in the past, too.\r\n\r\nIn the letter, Google is called to take the following “urgent” changes regarding Android bloatware. Firstly, that users should be allowed to fully delete any pre-installed app on their device. Secondly, these pre-installed apps should “adhere to the same scrutiny as Play Store apps.” Finally, pre-installed apps should have “some update mechanism” that doesn’t require an account and that Google should refuse to certify devices with privacy concerns.', 'https://ww.9to5google.com/2020/01/11/android-bloatware-privacy-open-letter/', 0, '0.00', 'Google Against Android Bloatware', 'Google pushed to take action against Android bloatware by 50+ organizations', 0),
(8, '2020-02-22', NULL, 2, 'Truly wireless earbuds have exploded in popularity over the past couple of years, pushing options like Apple’s AirPods to become a multi-billion-dollar market. There’s no shortage of options out there, but one that many Android users have gravitated toward has been Samsung’s Galaxy Buds, and now, they’ve got a second generation.\r\n\r\nI never had a chance to use the original Galaxy Buds, unfortunately, but I’ve been able to try quite a few pairs of truly wireless earbuds in the past several months. After a few days of testing out the Galaxy Buds+ pretty extensively, I’m surprised at how much I like them. I don’t think they’re the right answer for everyone, but there’s a lot to love with the Galaxy Buds+, especially if you’re a Spotify user. Here’s the good and the bad.\r\n\r\nGalaxy Buds+: The Good\r\nWorks great with Android, even better with Samsung\r\nFirst, let’s talk about the main reason you’re probably interested in these earbuds — they work with Android. Pretty much every pair of truly wireless earbuds work with Android in one way or another, even Apple’s AirPods. However, a lot of them lack extra functions on the platform.\r\n\r\nWith the Samsung Galaxy Buds+, there’s no shortage of extra functionality. On a Samsung smartphone, just pair and you’ll be greeted with a pop-up that shows the battery status of each bud and the case, too. It’s a direct clone of what Apple shows with AirPods, but that’s not really a bad thing!\r\nUnfortunately, those bonuses aren’t available on all Android phones. My testing was paired to a Pixel 4 XL, which meant I had to download extra apps. More on that later, but once the apps are installed, you’ll have control over the Buds+ to customize taps and the like. The only thing you won’t get is the pop-up with battery details. That’s held within the app only.\r\n\r\nGalaxy Buds+: The Bad\r\nPoor default sound profile\r\nIf you’re not a Samsung user, there’s one big negative to the Galaxy Buds+. The default sound profile is legitimately awful. When I first paired these and listened to them, I wondered if there was some plastic still on, then realizing there wasn’t, I just assumed they were worse than I’d heard.\r\n\r\nThis review would have had a very different outcome had that sound profile been what these always sound like. Upon downloading the Samsung Gear app, you can switch the Buds+ to “Dynamic” mode, which sounds a whole lot better. I’d still rank Jabra’s Elite 75t above the Buds+, but with Dynamic mode, they’re pretty decent.', 'https://9to5google.com/2020/02/20/samsung-galaxy-buds-plus-review/', 1, '2.99', 'Samsung Galaxy Buds+ Review', 'The new Galaxy Buds+: Come for Android compatibility, stay for Spotify', 3),
(9, '2020-02-22', '2020-02-24', 2, 'One of the most exciting things coming in the Chrome OS world right now is the Galaxy Chromebook, but Samsung wasn’t keen to share its release date back at CES. Now, a product listing might be revealing that information and it’s not too far off.\r\n\r\nWhen the Galaxy Chromebook was announced, Samsung only said that it would be coming out sometime in Q1 of this year. That’s definitely soon, but it’s not quite enough of an exact timeline to help customers put aside the cash needed to buy it.\r\n\r\nAboutChromebooks spotted a product listing from Best Buy — since removed — which mentions an April 6 release date for the Galaxy Chromebook. Of course, that’s definitely subject to change, but it’s the first mention we’ve heard of a release date for the product outside of Samsung’s vague timeline. That date makes sense, too, as it gives Samsung a bit of time to cool off following the Galaxy S20/Z Flip launch.\r\n\r\nAlso of interest, an LTE model was spotted on Samsung’s own website. Samsung didn’t announce this previously, but it’d be an appreciated option for Chrome OS users. As it stands today, there are very few Chromebooks with LTE connectivity, Samsung’s Chromebook Plus v2 being one of the only ones that comes to mind.\r\n\r\nIf that is actually happening, though, Samsung would have to create another variant of the machine, possibly running on a different chip. This is definitely within the realm of possibility, but I wouldn’t get too excited.', 'https://9to5google.com/2020/02/20/samsung-galaxy-chromebook-release-date-leak/', 0, '0.00', 'Samsung Galaxy Chromebook', 'Samsung Galaxy Chromebook release date may be April 6', 0),
(10, '2020-02-22', NULL, 2, 'I\'ve been a Surface Book 2 user — and fan — since it was released in 2017. I bit the bullet and preordered the 13-inch model shortly after it was announced, and I never looked back. However, when my Surface Book 2 met an untimely demise due to an unfortunate incident involving a glass of water a few weeks ago (it got very wet), I started re-thinking what I wanted out of a portable PC.\r\n\r\nEnter the Surface Pro X. I wound up going with Microsoft\'s latest iteration on the long-running Surface Pro line, and it\'s been the perfect fit. Still, it\'s a relatively big step down in terms of capabilities. Here\'s why I ultimately decided that it doesn\'t matter, and why I\'m loving the Surface Pro X.\r\n\r\nSurface Pro X is the perfect fit\r\n\r\nWhen I picked up my Surface Pro X, several people on Twitter rightly pointed out the sudden \"lane change\". Making the jump from an Intel processor with a discrete graphics chip to Microsoft\'s custom ARM SQ1 chip (a riff on the Snapdragon 8cx) does have its downsides. But, for me, the positives outweigh the negatives.\r\n\r\nThe key here is that my laptop is no longer my main PC. I bought the Surface Book 2 when I didn\'t have a desktop PC to fall back on, so I went for power and maximum app compatibility. Now, I spend more time at a pretty powerful desktop rig than not, so my priorities have shifted drastically.\r\n\r\nThe three biggest draws for me with the Surface Pro X were LTE connectivity, portability, and battery life. There are several LTE laptops on the market nowadays, but none of them check all three of those boxes quite like the Surface Pro X.', 'https://www.windowscentral.com/i-went-surface-book-2-surface-pro-x-and-im-love-heres-why', 1, '0.99', 'I switched from Surface Book 2 to Surface Pro X', 'I switched from Surface Book 2 to Surface Pro X, and I\'m in love. Here\'s why.', 1),
(11, '2020-02-22', NULL, 2, 'The latest estimate of the true wireless in-ear headphones market shows that Apple’s AirPods continue to dominate the market, with a 47% market share across 2019.\r\n\r\nSecond place was shared by Xiaomi and Samsung, who weren’t even close …\r\n\r\nCounterpoint Research said that the Apple’s market share did dip a little in the final quarter, but still left its rivals standing.\r\n\r\nThe launch of Apple’s new AirPods Pro model in late October helped the company record steady 44% growth in 4Q19, with 6m units sold despite supply shortages. Apple’s market share fell slightly to 41% QoQ as it attempted to keep up with swift overall market growth; market share for the full year reached 47% […]\r\n\r\nXiaomi kept its second-place spot in the quarter supported by strong sales of its Redmi Airdots, followed by Samsung, QCY and JLab. The race for second intensified, with both Xiaomi and Samsung holding around 6% unit market share for the year.\r\n\r\nThe market as a whole grew significantly in the final quarter of the year.\r\n\r\nThe global market size for true wireless hearables beat expectations, growing 53% QoQ in 4Q19, topping 51m units for the quarter and 130m units for the full year, according to Counterpoint Research’s latest Hearables Market Tracker. The US was the main driver for the quarter, growing 76% QoQ and accounting for 35% of the global market on the back of seasonal promotions and Apple’s new model launch.\r\n\r\nCounterpoint expects AirPods sales to top 100M this year, and says that while Samsung is targeting a distant second place, it may struggle to achieve this.\r\n\r\n“We expect Apple to sell more than 100m true wireless hearables in 2020, including AirPods Pros, to maintain their comfortable lead in the market,” said Liz Lee, Senior Analyst at Counterpoint Research. “The real competition will be for second place, especially in the premium market; Samsung, which sold 8m Galaxy Buds last year, will need further upgrades to those expected in the Galaxy Buds Plus, including noise cancellation and other advanced features and designs, in order to beat its rivals.”\r\n\r\nThere may be a temporary dent in AirPods sales this quarter. Apple was already struggling to meet demand, and production seems near-certain to be hit by the coronavirus outbreak. Other manufacturers will also be hit, however, so the prediction that AirPods continue to dominate sales this year seems safe.', 'https://9to5mac.com/2020/02/11/airpods-continue-to-dominate/', 0, '0.00', 'AirPods continue to dominate', 'AirPods continue to dominate; Samsung will struggle for 2nd place this year', 4),
(13, '2020-02-26', NULL, 1, 'After letting the Mac Pro become stagnant since 2013, Apple has finally unveiled the new version. In early 2017, Apple made a handful of announcements regarding the product. The company explained that it is rethinking its Mac Pro approach and plans to unveil a new modular model sometime in the future.\r\n\r\nThe company admitted that its 2013 model approach hasn’t been as upgradable in practice as it had hoped.\r\n\r\nAt some point [Apple] came to the conclusion that the 2013 Mac Pro concept was fundamentally flawed. It was tightly integrated internally, which allowed for some very nice features: it was small and beautiful (a pro machine that demanded placement on your desk, not under your desk) and it could run whisper quietly. But that tight integration made it hard to update regularly. The idea that expansion could be handled almost entirely by external Thunderbolt peripherals sounded good on paper, but hasn’t panned out in practice. And the GPU design was a bad prediction. Apple bet on a dual-GPU design (multiple smaller GPUs, with “pro”-level performance coming from parallel processing) but the industry has gone entirely in the other direction (machines with one big GPU).\r\n\r\nPhil Schiller acknowledged that the 2013 Mac Pro had not been well received by many pros, and it was this that had led to the radical rethink.\r\n\r\nWith regards to the Mac Pro, we are in the process of what we call “completely rethinking the Mac Pro”. We’re working on it. We have a team working hard on it right now, and we want to architect it so that we can keep it fresh with regular improvements, and we’re committed to making it our highest-end, high-throughput desktop system, designed for our demanding pro customers.\r\n\r\nAs part of doing a new Mac Pro — it is, by definition, a modular system — we will be doing a pro display as well. Now you won’t see any of those products this year; we’re in the process of that. We think it’s really important to create something great for our pro customers who want a Mac Pro modular system, and that’ll take longer than this year to do.\r\n\r\nIn the interim, we know there are a number of customers who continue to buy our [current Mac Pros]. To be clear, our current Mac Pro has met the needs of some of our customers, and we know clearly not all of our customers. None of this is black and white, it’s a wide variety of customers. Some… it’s the kind of system they wanted; others, it was not.\r\n\r\nIn the meantime, we’re going to update the configs to make it faster and better for their dollar. This is not a new model, not a new design, we’re just going to update the configs. We’re doing that this week. We can give you the specifics on that.\r\n\r\nThe CPUs, we’re moving them down the line. The GPUs, down the line, to get more performance per dollar for customers who DO need to continue to buy them on the interim until we get to a newly architected system.\r\n\r\nAt WWDC 2019 Apple offered the first look at its new Mac Pro. The new version is a return of the cheese grater design from a generation previous.\r\n\r\nApple says the new Mac Pro was designed with easy access to its components. There are stainless steel handles for modularity, all internal components mount to the frame with 360-degree components.\r\n\r\nMac Pro Specs\r\n300 watts of power, runs fully unconstrained\r\n2933MHz ECC memory, 12 DIMM slots\r\n8 internal PCI slots, four double-wide slots, three single side slots\r\nHalf-length slot populated with two TB3 ports, audio jack, two USB A ports, two 10Gb Ethernet ports\r\nUp to 1.5 terabytes of RAM\r\nIntel Xeon processor with up to 28 cores\r\nApple designed a PCI connector with a second PCIe connector and power\r\nMultiple graphics options; can configure with options such as Radeon Pro Vega II\r\nTwo GPUs connected via Infinity Fabric Link, 5X faster than PCI bust\r\nApple built a brand new card called Afterburner for video editing, 6 billion pixels per second. 3 streams of 8K, 12 streams of 4K', 'https://9to5mac.com/guides/mac-pro/', 1, '2.99', 'MacPro 7,1: Cheese Grater?', 'The new expensive MacPro and his expensive Display', 2),
(14, '2020-02-26', NULL, 1, 'Perhaps one of the most exciting things about the Galaxy S20 Ultra is its huge 5,000 mAh battery. That number on its own should mean killer battery life, but it seems the Galaxy S20 Ultra’s 120Hz display is going to put a pretty huge drain on that.\r\n\r\nTom’s Guide has been putting the S20 Ultra through its paces over the past several days and so far, the results on the out-of-the-box settings have been more than respectable. Using it’s default settings, the Galaxy S20 Ultra’s battery averaged just shy of 12 hours — 11:58 to be exact.\r\n\r\nThis battery test sees the device run from a 100% charge with continuous web surfing over a cellular connection until the phone dies. In this case, that was using the Ultra’s 5G connectivity on T-Mobile’s network. This is notable, too, since the newer 5G radios are more battery intensive, meaning the test would probably have even better results on a 4G connection or WiFi. That 5G connection is probably why the S10+ averaged around 40 extra minutes in the same test.\r\n\r\nWhat’s important to note with this battery test, though, is just how much of a dent the Galaxy S20 Ultra’s 120Hz display makes on the 5,000 mAh cell. Simply switching from the out-of-the-box default of FHD 60Hz to FHD 120Hz sees the device losing nearly 3 hours on this test.\r\n\r\nOf course, real-life results will definitely vary since no one hardly anyone actually uses their phone for 9 hours straight, but it’s clear the 120Hz panel is going to have a pretty big effect on battery life. This is probably part of the reason Samsung didn’t enable the 120Hz refresh rate at the full QHD+ resolution at launch, though that feature is rumored to be coming later.', 'https://9to5google.com/2020/02/25/galaxy-s20-ultra-battery-test-120hz-display/', 0, NULL, 'Samsung Galaxy S20 Ultra Battery', 'Galaxy S20 Ultra battery test shows how much of a drain 120Hz might be', 3),
(15, '2020-02-26', '2020-02-27', 1, 'Released just six months after its predecessor, the Active 2 is a reasonably good option. Some software issues keep it from being great, though. And if your phone isn’t made by Samsung, plan on some software annoyances.\r\n\r\nThe obvious and clear success of the Apple Watch for iPhone owners has made the dearth of quality options for Android phones feel that much more acute. But Samsung has been quietly plugging away at improving the Galaxy Watch and the software that runs it. The result is a watch that checks off most of the boxes smartwatch buyers should care about.\r\n\r\nThe Galaxy Watch Active 2 is a round smartwatch that starts at $279, though you can pay higher prices depending on the size and LTE. It comes in 40 and 44mm sizes, has a few different finishes, and the watch bands can be easily swapped out. (The original Active is still available and slightly less expensive. The original Galaxy Watch with a physical rotating bezel is also sticking around for a higher price.)\r\n\r\nI like how unassuming the Active 2 looks. I have the basic black model, and its matte finish and slightly curved glass give it simple, clean lines. In a world where most Android smartwatches either look explicitly like fitness bands (the Fitbit) or emulate big, expensive watches (hiding how big they need to be), the Active 2 just looks like a simple watch.\r\n\r\nIt is not a watch I expected to exist because its predecessor is barely six months old. The main problem with the last one is that Samsung whiffed on supporting the very best feature of the Galaxy Watch lineup: a rotating bezel for scrolling through the software.\r\n\r\nThe Active 2 doesn’t fully bring that back, but it now has a touch-sensitive capacitive ring around the screen. Dragging your finger around it to scroll through various screens feels much more intuitive than just swiping because the Active 2’s interface is mostly built on circles.\r\n\r\nMore specifically, the software works by presenting you with a lot of screens you can quickly scroll through. In one direction, you have notifications. In the other, there are a bunch of widgets with discrete pieces of information. I enjoy jamming through these screens more with a physical bezel, but the touch-sensitive one isn’t terrible and much better than not having this kind of control at all.\r\n\r\nOne of the reasons this interface works is that it’s fast. Especially if you go with a simple watchface that doesn’t have a bunch of information in complications, it’s convenient to just rotate through your weather, calendar, and fitness. (It’s such a good idea that Google lifted it wholesale for Wear OS.) That would never work if the watch were slow. You will have some delays when launching full apps, but the widget system means you don’t have to that often.\r\n\r\nI also like that it has Spotify on it, and it’s relatively easy to download Spotify playlists directly to the watch. But the quality of third-party apps drops off steeply from there. There’s no built-in mapping or directions app, and the app store doesn’t have anything good to fill the gap. The third-party app situation isn’t very good at all, but then again, it’s not great on any platform.', 'https://www.theverge.com/2019/10/8/20903452/samsung-galaxy-watch-active-2-review-fitness-tizen-apps-', 0, '0.00', 'Samsung Galaxy Watch Active 2', 'The best smartwatch for Android users?', 1);

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

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`paymentMethodId`, `userId`, `cardType`, `cardNumber`, `CVV`, `nameOnCard`) VALUES
(1, 1, 1, '0000000000000000000', '865', 'Ahmad Abo Louha'),
(2, 2, 0, '111111111111', NULL, 'Alejandro Restrepo Klinge'),
(9, 2, 1, '265948152000', '554', 'Alejandro Restrepo Klinge'),
(10, 6, 0, '20332569856', '', 'Sabrina Oberli'),
(11, 6, 1, '2011023659', '555', 'Sabrina Oberli'),
(12, 3, 0, '256595362258', '', 'James Pedro Bond'),
(13, 13, 0, '2565592556', '', 'Rick Astley');

-- --------------------------------------------------------

--
-- Table structure for table `purchased_article`
--

CREATE TABLE `purchased_article` (
  `newsId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchased_article`
--

INSERT INTO `purchased_article` (`newsId`, `userId`) VALUES
(4, 3),
(2, 3),
(8, 2),
(10, 2),
(4, 2),
(2, 6),
(10, 6),
(8, 6),
(6, 6),
(13, 3),
(8, 3),
(13, 13),
(13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

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
(1, 'Ahmad', 'Abo Louha', '$2y$10$9Q8CepjIQWsgmmp7/ImSRe7LYXSIU2CmqB7yoMV0jIyxLBantS2kG', 'm', '1993-09-08', 'DE', '01778899', 'ahmad@gmail.com', 1),
(2, 'Alejandro', 'Restrepo Klinge', '$2y$10$tZlX0lRT6E6grLE87nacwOOU4bkA/U3u3nffpLwjCbxz/x6fNyPbW', 'm', '1996-12-24', 'CO', '01778888', 'alejandro@gmail.com', 1),
(3, 'James', 'Bond', '$2y$10$8qNMDCHQMvLvP1M8m6a7g.udiz8Woadp.4WfRb2d.w6OrANg8GMji', 'm', '1950-07-30', 'UK', '01778877', 'james@gmail.com', NULL),
(4, 'Maria', 'Mustermann', '$2y$10$Mxha/vVdoHfCnC.nNWVfpeZuKPJvWQbo/WUGgOQNYR9LNaI2fiwRC', 'f', '2002-02-02', 'DE', '2036598', 'maria@gmail.com', NULL),
(5, 'Sara', 'Musterfrau', '$2y$10$AchTLb1s7ZNPr9f5zo1DTebjVIW0OqJmNQYoNDt82mKwByTd6fgsq', 'f', '1999-02-02', 'NF', '01778811', 'sara@gmail.com', NULL),
(6, 'Sabrina', 'Oberli', '$2y$10$SYkCPXpoDskzKdcgVIuy2ORqaOR4L8r7vG5ZIQIYWqN2Qsd7YnCtK', 'f', '1950-11-20', 'VE', '202365986', 'sabrina@gmail.com', NULL),
(8, 'John', 'Meyer', '$2y$10$nx5DZ52P/bhBGgWdXHXZzOOl96oRGq6hd3Fdlw9JLuAbFH5lOqgE6', 'm', '1920-02-02', 'BS', '956781235', 'john@gmail.com', NULL),
(13, 'Rick ', 'Astley', '$2y$10$gZaphSJeiLmePhn8MEA1m.EALjfuRx3nhmUaKHek2LdF9LkLUF4ZC', 'm', '1962-07-25', 'US', '596826489', 'giveyouup@gmail.com', NULL);

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
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `paymentMethodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
