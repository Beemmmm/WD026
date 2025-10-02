-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2025 at 06:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db6646_026`
--

-- --------------------------------------------------------

--
-- Table structure for table `td_664230026`
--

CREATE TABLE `td_664230026` (
  `key` int(5) NOT NULL COMMENT 'ลำดับ',
  `std_id` varchar(9) NOT NULL COMMENT 'รหัสนักศึกษา',
  `f_name` varchar(100) NOT NULL COMMENT 'ชื่อ',
  `L_name` varchar(100) NOT NULL COMMENT 'สกุล',
  `mail` varchar(100) NOT NULL COMMENT 'อีเมล',
  `tel` varchar(20) NOT NULL COMMENT 'เบอร์โทร',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู่',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'เวลาสร้าง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `td_664230026`
--

INSERT INTO `td_664230026` (`key`, `std_id`, `f_name`, `L_name`, `mail`, `tel`, `address`, `created_at`) VALUES
(2, '664230026', 'Yonnlada', 'Phukphusa', 'bexmz@mail.com', '0615288509', '99/2 ต.วังตะกู อ.เมืองนครปฐม จ.นครปฐม 73000', '2025-10-02 03:33:50'),
(3, '664230036', 'Kobpong', 'Ausatid', 'Mookob@mail.com', '0984900426', '149 ต.หนองปากโลง อ.เมืองนครปฐม จ.นครปฐม 73000', '2025-10-02 03:33:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_664230026`
--
ALTER TABLE `td_664230026`
  ADD PRIMARY KEY (`key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_664230026`
--
ALTER TABLE `td_664230026`
  MODIFY `key` int(5) NOT NULL AUTO_INCREMENT COMMENT 'ลำดับ', AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
