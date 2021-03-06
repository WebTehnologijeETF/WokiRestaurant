-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2015 at 11:13 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `novosti`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vijest` int(11) NOT NULL,
  `datum` timestamp NOT NULL,
  `autor` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vijest` (`vijest`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=70 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `vijest`, `datum`, `autor`, `email`, `tekst`) VALUES
(69, 2, '2015-06-17 19:18:18', 'N', 'nn@nn.com', 'nnn');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_slovenian_ci NOT NULL,
  `email` varchar(254) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'nermina@hotmail');

-- --------------------------------------------------------

--
-- Table structure for table `vijest`
--

CREATE TABLE IF NOT EXISTS `vijest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naziv` varchar(30) COLLATE utf8_slovenian_ci NOT NULL,
  `datum` timestamp NOT NULL,
  `autor` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `slika` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `opis` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `opsirnije` varchar(500) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `vijest`
--

INSERT INTO `vijest` (`id`, `naziv`, `datum`, `autor`, `slika`, `opis`, `opsirnije`) VALUES
(2, 'Druga vijest', '2015-05-28 08:02:22', 'Nermina', '', 'Proba 2 Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2P', 'Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Proba 2Pro'),
(9, 'Nova ponuda u Wokiju', '2015-06-17 18:02:53', 'Woki tim', 'slike/woki3.jpg', 'Od 18.06. do 18.07. u ponudi je novi iftarski meni sa mnoštvom novih specijaliteta.', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`vijest`) REFERENCES `vijest` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
