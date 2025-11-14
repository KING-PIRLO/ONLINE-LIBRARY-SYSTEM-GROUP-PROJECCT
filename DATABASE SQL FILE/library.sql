-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2025 at 11:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Anuj Kumar', 'admin@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2024-12-31 19:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Anuj kumar', '2023-12-31 21:23:03', '2025-01-07 06:18:43'),
(2, 'Chetan Bhagatt', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(3, 'Anita Desai', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(4, 'HC Verma', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(5, 'R.D. Sharma ', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(9, 'fwdfrwer', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(10, 'Dr. Andy Williams', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(11, 'Kyle Hill', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(12, 'Robert T. Kiyosak', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(13, 'Kelly Barnhill', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(14, 'Herbert Schildt', '2023-12-31 21:23:03', '2025-01-07 06:18:50'),
(16, ' Tiffany Timbers', '2025-01-07 06:55:54', NULL),
(18, 'John Shovic', '2025-01-17 14:23:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` varchar(25) DEFAULT NULL,
  `BookPrice` decimal(10,2) DEFAULT NULL,
  `bookImage` varchar(250) NOT NULL,
  `isIssued` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `bookQty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `bookImage`, `isIssued`, `RegDate`, `UpdationDate`, `bookQty`) VALUES
(1, 'PHP And MySql programming', 5, 1, '222333', 20.00, '1efecc0ca822e40b7b673c0d79ae943f.jpg', 0, '2024-01-02 01:23:03', '2025-01-14 07:08:11', 10),
(3, 'physics', 6, 4, '1111', 15.00, 'dd8267b57e0e4feee5911cb1e1a03a79.jpg', 0, '2024-01-02 01:23:03', '2025-11-12 04:05:24', 10),
(5, 'Murach\'s MySQL', 5, 1, '9350237695', 455.00, '5939d64655b4d2ae443830d73abc35b6.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 20),
(6, 'WordPress for Beginners 2022: A Visual Step-by-Step Guide to Mastering WordPress', 5, 10, 'B019MO3WCM', 100.00, '144ab706ba1cb9f6c23fd6ae9c0502b3.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:05:35', 15),
(7, 'WordPress Mastery Guide:', 5, 11, 'B09NKWH7NP', 53.00, '90083a56014186e88ffca10286172e64.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:05:39', 14),
(8, 'Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not', 8, 12, 'B07C7M8SX9', 120.00, '52411b2bd2a6b2e0df3eb10943a5b640.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:05:41', 5),
(9, 'The Girl Who Drank the Moon', 8, 13, '1848126476', 200.00, 'f05cd198ac9335245e1fdffa793207a7.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:05:45', 1),
(10, 'C++: The Complete Reference, 4th Edition', 5, 14, '007053246X', 142.00, '36af5de9012bf8c804e499dc3c3b33a5.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 2),
(11, 'ASP.NET Core 5 for Beginners', 9, 11, 'GBSJ36344563', 422.00, 'b1b6788016bbfab12cfd2722604badc9.jpg', NULL, '2024-01-02 01:23:03', '2025-01-13 11:11:01', 5),
(12, 'Python Packages', 9, 16, '0367687771', 3034.00, 'd3ee811a36f79de3a2e940b94cb1132a.jpg', NULL, '2025-01-07 06:56:50', '2025-11-12 03:52:07', 25),
(13, 'Python All-in-One for Dummies', 9, 18, '9388991214', 700.00, 'f4ba4705a075527dd6ff5bd83a7d7562.jpg', 0, '2025-01-17 14:23:48', '2025-01-17 14:25:52', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Romantic', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:11'),
(5, 'Technology', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(6, 'Science', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(7, 'Management', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(8, 'General', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21'),
(9, 'Programming', 1, '2025-01-01 07:23:03', '2025-01-07 06:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL,
  `finePaymentStatus` int(1) DEFAULT 0,
  `remark` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`, `finePaymentStatus`, `remark`) VALUES
(1, 1, 'SID002', '2025-01-13 11:12:40', '2025-01-14 06:00:56', 1, 0, 0, 'NA'),
(2, 7, 'SID010', '2025-01-14 05:55:25', NULL, NULL, NULL, 0, 'NA'),
(3, 1, 'SID010', '2025-01-14 05:55:39', NULL, NULL, NULL, 0, 'NA'),
(5, 1, 'SID002', '2025-01-14 06:02:14', '2025-01-14 06:03:36', 1, 0, 0, 'ds'),
(6, 7, 'SID012', '2025-01-17 14:16:31', NULL, NULL, NULL, 0, 'NA'),
(7, 13, 'SID013', '2025-01-17 14:24:47', '2025-01-17 14:25:52', 1, 0, 0, 'NA'),
(8, 13, 'SID012', '2025-01-17 14:25:34', '2025-11-05 09:13:14', 1, 0, 0, 'NA'),
(9, 3, 'SID009', '2025-11-12 03:55:16', NULL, NULL, NULL, 0, '12'),
(10, 3, 'SID009', '2025-11-12 04:02:23', '2025-11-13 02:14:31', 1, 20, 1, 'HELLO');

-- --------------------------------------------------------

--
-- Table structure for table `tbllibrarians`
--

CREATE TABLE `tbllibrarians` (
  `id` int(11) NOT NULL,
  `LibrarianId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbllibrarians`
--

INSERT INTO `tbllibrarians` (`id`, `LibrarianId`, `FullName`, `MobileNumber`, `EmailId`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, 'LIB001', 'lib', '10000000001', 'lib@gmail.com', 'e8acc63b1e238f3255c900eed37254b8', 1, '2025-11-07 12:46:40', '2025-11-13 05:16:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblpasswordreset`
--

CREATE TABLE `tblpasswordreset` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Message` text DEFAULT NULL,
  `Status` int(1) DEFAULT 0 COMMENT '0=Pending, 1=Resolved',
  `RequestDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpasswordreset`
--

INSERT INTO `tblpasswordreset` (`id`, `StudentId`, `EmailId`, `MobileNumber`, `Message`, `Status`, `RequestDate`) VALUES
(1, 'SID009', 'test@gmail.com', '2359874527', 'please help me reset the password', 0, '2025-11-14 03:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, 'SID002', 'Anuj kumar', 'anujk@gmail.com', '9865472555', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-01-03 07:23:03', '2025-11-13 05:13:33'),
(4, 'SID005', 'sdfsd', 'csfsd@dfsfks.com', '8569710025', '92228410fc8b872914e023160cf4ae8f', 1, '2024-01-03 07:23:03', '2025-01-07 06:20:36'),
(8, 'SID009', 'test', 'test@gmail.com', '2359874527', '098f6bcd4621d373cade4e832627b4f6', 1, '2024-01-03 07:23:03', '2025-11-14 03:40:54'),
(9, 'SID010', 'Amit', 'amit@gmail.com', '8585856224', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-01-03 07:23:03', '2025-01-07 06:20:36'),
(10, 'SID011', 'Sarita Pandey', 'sarita@gmail.com', '4672423754', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-01-03 07:23:03', '2025-01-07 06:20:36'),
(11, 'SID012', 'John Doe', 'john@test.com', '1234569870', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-01-03 07:23:03', '2025-01-07 06:20:36'),
(12, 'SID013', 'Ajay Kumar Singh', 'ajay12@t.com', '1231231230', 'f925916e2754e5e03f75dd58a5733251', 1, '2025-01-17 14:20:50', '2025-01-17 14:21:21'),
(13, 'SID015', 'h', 'h@h.com', '12112', '2510c39011c5be704182423e3a695e91', 1, '2025-11-05 09:14:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbllibrarians`
--
ALTER TABLE `tbllibrarians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `LibrarianId` (`LibrarianId`);

--
-- Indexes for table `tblpasswordreset`
--
ALTER TABLE `tblpasswordreset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbllibrarians`
--
ALTER TABLE `tbllibrarians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblpasswordreset`
--
ALTER TABLE `tblpasswordreset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
