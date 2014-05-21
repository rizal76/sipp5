-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2014 at 11:37 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `yii_sipp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id_user` int(11) NOT NULL,
  `departemen` varchar(100) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sipp_code_user`
--

CREATE TABLE IF NOT EXISTS `sipp_code_user` (
  `id_user` int(11) NOT NULL,
  `verified_code` varchar(300) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sipp_code_user`
--

INSERT INTO `sipp_code_user` (`id_user`, `verified_code`) VALUES
(8, '$2a$13$DbRnagrdy9ur135t/DEdRuS/hn96Fc37oj6J7hsMhbTBrSNooTOmG');

-- --------------------------------------------------------

--
-- Table structure for table `sipp_user`
--

CREATE TABLE IF NOT EXISTS `sipp_user` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `level_id` int(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `sipp_user`
--

INSERT INTO `sipp_user` (`id`, `username`, `password`, `level_id`) VALUES
(1, 'rizal@gmail.com', 'd033e22ae348aeb5660fc2140aec35', 1),
(2, 'rizal2@gmail.com', '$2a$10$JTJf6/XqC94rrOtzuF397OHa4mbmZrVTBOQCmYD9U.obZRUut4BoC', 0),
(3, 'rizal', 'manu77', 2),
(4, 'rizal5', 'manu77', 1),
(5, 'rizal7', '$2a$13$VUf7sZG56oYAKtoSW7aUtuwcSL2OChFO2rx5pQwO4nMXCG7x3NZuK', 1),
(7, 'reba', '$2a$13$uYAuDG4J/TqN5Gig2d4/IOwWriMgUvty2GCsNAahZu.tccp.Q/AJS', 2),
(8, 'indrabayu.rizal@gmail.com', '$2a$13$.2og0eAvmkRwWBkz4uCGVueqHFb1Jpy/YmregXyHfN3MTE1SwuJam', 2),
(9, 'rizalmember', '$2a$13$XprQevsy7nCct5arvuBHh.X2nl2s7wf1mgtDZR9RZOJ5998KvaDO2', 0),
(10, 'member', '$2a$13$DRIu9viWuKknYrqKsInGKeHiX3WaKYS/YsfaETR76lBAc03NGG5MW', 0),
(11, 'admin', '$2a$13$RIplgZhNBYWlv87N.gbK6efc4cN.74JRrbR9sBiUSu1wytbqkLUl6', 1),
(12, 'superadmin', '$2a$13$s6g3wwVZAed4bfkujx0c2O52oA35U2Ft87jQKg4o5uS4kqMOJk6O.', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `sipp_user` (`id`);

--
-- Constraints for table `sipp_code_user`
--
ALTER TABLE `sipp_code_user`
  ADD CONSTRAINT `sipp_code_user_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `sipp_user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
