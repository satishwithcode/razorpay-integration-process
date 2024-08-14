-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 09, 2024 at 05:57 AM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u598372859_ductor`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `dr_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `src` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `selected_day` varchar(100) DEFAULT NULL,
  `selected_date` varchar(255) DEFAULT NULL,
  `appointment_time` varchar(50) DEFAULT NULL,
  `appointment_type` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `p_name` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `p_mail` varchar(255) DEFAULT NULL,
  `p_age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female','Others') DEFAULT NULL,
  `payment` varchar(255) NOT NULL DEFAULT 'Pending',
  `payment_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `dr_name`, `designation`, `src`, `price`, `duration`, `selected_day`, `selected_date`, `appointment_time`, `appointment_type`, `payment_method`, `p_name`, `contact`, `p_mail`, `p_age`, `gender`, `payment`, `payment_id`) VALUES
(1, 'Dr Sudip Chowdhury', 'Senior Consultant Paediatrician', 'images/00017531.webp', 1000.00, '15min', 'Thursday', '9 May 2024', '2pm-3pm', 'Clinic Visit', 'Razor Pay', 'Satish Yadav', '3452345234', 'satishwithcode@gmail.com', 23, 'Male', 'Pending', 'not done'),
(2, 'Nupur Sah', 'Head Lacational Consultant', 'images/0002326.webp', 800.00, '45min', 'Wednesday', '8 May 2024', '10am-11am', 'Clinic Visit', 'Razor Pay', 'Satish Yadav', '3452345234', 'satishwithcode@gmail.com', 23, 'Male', 'Pending', 'not done'),
(3, 'Dr Sudip Chowdhury', 'Senior Consultant Paediatrician', 'images/00017531.webp', 1000.00, '15min', 'Wednesday', '8 May 2024', '10am-11am', 'Clinic Visit', 'Razor Pay', 'Satish Yadav', '3452345234', 'satishwithcode@gmail.com', 23, 'Male', 'Pending', 'not done'),
(4, 'Dr Shweta Sharma', 'Consultant Clinical Psychologist', 'images/00017551.webp', 1.00, '45min', 'Wednesday', '8 May 2024', '10am-11am', 'Clinic Visit', 'Razor Pay', 'Test', '8299566707', 'test@gmail.com', 67, 'Male', 'Success', 'pay_O7zXW7WEjODzPd'),
(5, 'Dr Shweta Sharma', 'Consultant Clinical Psychologist', 'images/00017551.webp', 1.00, '45min', 'Wednesday', '8 May 2024', '12pm-1pm', 'Clinic Visit', 'Pay in clinic', 'Test', '8299566707', 'test@gmail.com', 67, 'Female', 'Pending', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
