-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2025 at 06:16 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `review` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `review`) VALUES
(1, 'sasuke', 'test@gmail.com', 'The online ticket booking system exceeded my expectations! It was incredibly intuitive and user-friendly, making the entire process effortless. The navigation was smooth, and I appreciated the real-time updates on seat availability. The payment options were diverse, catering to all preferences, and the confirmation email arrived almost instantly.'),
(2, 'meet', 'meetpatel0434@gmail.com', 'I had a great experience with the ticket booking system! The interface was clean and organized, allowing me to find and book my tickets with ease. The site’s responsiveness was impressive, even during peak hours. The inclusion of helpful features like filters and sorting options made the process even more convenient. Kudos to the team for an excellent design.'),
(3, 'Prince', 'parulpatel23512@gmail.com', 'I am extremely satisfied with the online ticket booking system. The process was quick, hassle-free, and very straightforward. The seamless integration of payment options made it easy to complete my transaction, and the systems reliability gave me confidence.');

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

DROP TABLE IF EXISTS `places`;
CREATE TABLE IF NOT EXISTS `places` (
  `id` int NOT NULL AUTO_INCREMENT,
  `place_name` varchar(50) NOT NULL,
  `o_time` time NOT NULL,
  `c_time` time NOT NULL,
  `a_price` varchar(5) NOT NULL,
  `c_price` varchar(5) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `place_name`, `o_time`, `c_time`, `a_price`, `c_price`, `img`) VALUES
(1, 'SOU Entry Ticket', '08:00:00', '06:00:00', '200', '160', '1742490750.jpg'),
(2, 'Viewing Gallery', '08:00:00', '06:00:00', '300', '150', '1742490726.jpg'),
(3, 'Maha Aarti', '08:00:00', '06:00:00', '120', '120', '1742490774.jpg'),
(4, 'Jungle Safari', '08:00:00', '06:00:00', '150', '130', '1742490687.jpg'),
(5, 'Maze Garden', '08:00:00', '06:00:00', '150', '130', '1742490704.jpg'),
(6, 'Light Show', '09:00:00', '10:00:00', '100', '100', '1742490190.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `places_backup`
--

DROP TABLE IF EXISTS `places_backup`;
CREATE TABLE IF NOT EXISTS `places_backup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `place_name` varchar(50) NOT NULL,
  `o_time` time NOT NULL,
  `c_time` time NOT NULL,
  `a_price` varchar(5) NOT NULL,
  `c_price` varchar(5) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `places_backup`
--

INSERT INTO `places_backup` (`id`, `place_name`, `o_time`, `c_time`, `a_price`, `c_price`, `img`) VALUES
(1, 'SOU Entry Ticket', '08:00:00', '06:00:00', '200', '160', '1742490750.jpg'),
(2, 'Viewing Gallery', '08:00:00', '06:00:00', '300', '150', '1742490726.jpg'),
(3, 'Maha Aarti', '08:00:00', '06:00:00', '120', '120', '1742490774.jpg'),
(4, 'Jungle Safari', '08:00:00', '06:00:00', '150', '130', '1742490687.jpg'),
(5, 'Maze Garden', '08:00:00', '06:00:00', '150', '130', '1742490704.jpg'),
(6, 'Light Show', '09:00:00', '10:00:00', '100', '100', '1742490190.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_book`
--

DROP TABLE IF EXISTS `ticket_book`;
CREATE TABLE IF NOT EXISTS `ticket_book` (
  `id` int NOT NULL AUTO_INCREMENT,
  `place_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `adult` int NOT NULL,
  `child` int NOT NULL,
  `date` date NOT NULL,
  `total_price` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket_book`
--

INSERT INTO `ticket_book` (`id`, `place_name`, `email`, `phone`, `adult`, `child`, `date`, `total_price`) VALUES
(3, 'SOU Entry Ticket', 'sasuke@gmail.com', '2222222222', 3, 4, '2024-09-24', 1000),
(11, 'SOU Entry Ticket', 'test@gmail.com', '8780580109', 4, 6, '2024-09-27', 1400),
(17, 'Viewing Gallery', 'test@gmail.com', '8780580109', 2, 1, '2025-03-22', 500),
(18, 'Light Show', 'test@gmail.com', '8780580109', 3, 2, '2025-03-20', 800),
(19, 'Jungle Safari', 'test@gmail.com', '8780580109', 2, 0, '2025-03-21', 400);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `age` int NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone`, `age`, `password`) VALUES
(1, 'naruto', 'naruto@gamil.com', '8320445769', 22, '14333324234'),
(2, 'sasuke', 'test@gmail.com', '8780580109', 25, '123'),
(3, 'meet', 'meetpatel0434@gmail.com', '9825056110', 22, '12345678'),
(9, 'Prince', 'parulpatel23512@gmail.com', '2222222222', 54, '78456123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
