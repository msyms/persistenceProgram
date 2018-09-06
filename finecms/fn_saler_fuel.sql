-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 06, 2018 at 02:21 PM
-- Server version: 5.5.53
-- PHP Version: 5.6.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `finecms`
--

-- --------------------------------------------------------

--
-- Table structure for table `fn_saler_fuel`
--

CREATE TABLE IF NOT EXISTS `fn_saler_fuel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `salerId` int(11) NOT NULL,
  `rise` int(11) NOT NULL COMMENT '加油量',
  `money` decimal(10,2) NOT NULL COMMENT '金额',
  `date` date NOT NULL,
  `remark` varchar(100) NOT NULL COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `fn_saler_fuel`
--

INSERT INTO `fn_saler_fuel` (`id`, `salerId`, `rise`, `money`, `date`, `remark`) VALUES
(1, 1, 10, '100.00', '2018-09-02', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
