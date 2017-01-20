-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2017 at 11:22 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kevin`
--

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `name` varchar(255) NOT NULL,
  `address` varchar(500) NOT NULL,
  `rollno` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `bday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `address`, `rollno`, `gender`, `bday`) VALUES
('kevin', 'virar', 23, 'Male', '0000-00-00'),
('kevin', 'virar', 23, 'Male', '0000-00-00'),
('lpz', 'nop', 3, 'Female', '0000-00-00'),
('sam', 'qat', 1234, 'Male', '0000-00-00'),
('qae', 'qatqe', 1234, 'Female', '0000-00-00'),
('shw', 'vasai', 42, 'Female', '0000-00-00'),
('', '', 0, 'Male', '0000-00-00'),
('fes', 'doha', 3121, 'Female', '0000-00-00'),
('Kavin', 'sahara umrale', 89, 'Male', '0000-00-00'),
('Kavin', 'sahara umrale', 89, 'Male', '0000-00-00'),
('Alric Dmonty', 'vasai', 46, 'M', '0000-00-00'),
('Amber Lopez', 'QATAR', 90, 'F', '0000-00-00'),
('', '', 0, '', '0000-00-00'),
('Donal Gonsalves', 'Nanbhat', 23, 'M', '0000-00-00'),
('moto m', 'india', 43, 'F', '0000-00-00'),
('Kevo llopes', 'vasai', 12, 'F', '0000-00-00'),
('Damian Dmonte', 'Nanabhat', 234, 'M', '0000-00-00'),
('Sam', 'vasai', 23, 'M', '0000-00-00'),
('Dev patil', 'dadar', 23, 'M', '2015-04-28'),
('Priya Menezes ', 'Mumbai', 55, 'F', '2012-09-30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


