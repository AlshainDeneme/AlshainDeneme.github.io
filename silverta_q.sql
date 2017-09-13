-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 16 Haz 2016, 11:59:01
-- Sunucu sürümü: 5.5.50-cll
-- PHP Sürümü: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `silverta_q`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adsoyad` varchar(250) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin5 AUTO_INCREMENT=6 ;

--
-- Tablo döküm verisi `admin`
--

INSERT INTO `admin` (`id`, `adsoyad`, `username`, `password`) VALUES
(1, 'DEMO', 'demo', 'demo');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `likeLog`
--

CREATE TABLE IF NOT EXISTS `likeLog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `_ID` varchar(60) NOT NULL,
  `profilpic` varchar(600) NOT NULL,
  `comment` varchar(600) NOT NULL,
  `date` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin5 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(15) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL,
  `profile` varchar(350) NOT NULL,
  `credi` varchar(30) NOT NULL,
  `cookie` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin5 AUTO_INCREMENT=18 ;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `userid`, `username`, `password`, `fullname`, `profile`, `credi`, `cookie`) VALUES
(1, '1223273546', 'buseclsrr', 'melekbuse', '?BUSE?', 'https://scontent.cdninstagram.com/t51.2885-19/s150x150/13380830_246164725763354_1129983216_a.jpg', '50', '1'),
(2, '3250795336', 'minatoprak19641', 'loyal0634', 'Aybige Karye', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(3, '3250788475', 'refikbelgin2856', 'loyal0634', 'Anatolya Aleyna', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(4, '3250780794', 'gulsahafra99956', 'loyal0634', 'Altug Onuralp', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(5, '3250766778', 'barinyade92982', 'loyal0634', 'Toprak Canay', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(6, '3250763924', 'aycanoyan1625', 'loyal0634', 'Yagizalp Zuhal', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(7, '3250741010', 'ugurahu14114', 'loyal0634', 'Lutfiye Hamza', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(8, '3250736415', 'kasimayben84946', 'loyal0634', 'Ahnes Demiralp', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(9, '3250724461', 'bektasbusena248', 'loyal0634', 'Tugra Elfida', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(10, '3250708919', 'yamanrahman6934', 'loyal0634', 'Gulnur Ismet', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(11, '3250705283', 'ataberkbihruz87', 'loyal0634', 'Asil Arel', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(12, '3250696920', 'okmenceda1101', 'loyal0634', 'Gaye Alkan', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(13, '3250688938', 'asudezulal2454', 'loyal0634', 'Riza Selin', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(14, '3249872718', 'yezrairva79703', 'loyal0634', 'Ayas Merve', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(15, '3246779317', 'huseyin55687gul', '06340634', 'Feryal Ayten', 'https://scontent.cdninstagram.com/t51.2885-19/11906329_960233084022564_1448528159_a.jpg', '50', '1'),
(16, '2106420042', 'abdullah.atlihan', '05073905579apoo', 'Abdullah AtLıhan', 'https://scontent.cdninstagram.com/t51.2885-19/s150x150/13381390_1719539624968938_845081949_a.jpg', '50', '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `webSettings`
--

CREATE TABLE IF NOT EXISTS `webSettings` (
  `id` int(11) NOT NULL,
  `siteName` varchar(70) NOT NULL,
  `keyword` varchar(60) NOT NULL,
  `content` varchar(60) NOT NULL,
  `credi` varchar(100) NOT NULL,
  `followList` varchar(600) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin5;

--
-- Tablo döküm verisi `webSettings`
--

INSERT INTO `webSettings` (`id`, `siteName`, `keyword`, `content`, `credi`, `followList`) VALUES
(1, 'ASLANMEDYA v1 | Instagram Takipçi Hilesi', 'Instagram Takipçi Kazan, Instagram Takipçi Kazan', 'Instagram Takipçi Kazan, Instagram Beğeni Kazan', '50', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
