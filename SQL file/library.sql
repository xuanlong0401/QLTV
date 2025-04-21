-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2025 at 10:33 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Nguyễn Xuân Long', 'admin@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2025-02-21 16:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Marin', '2023-12-31 21:23:03', '2025-03-04 07:04:34'),
(2, 'ABC', '2023-12-31 21:23:03', '2025-03-04 07:01:37'),
(3, 'Khánh Toàn', '2023-12-31 21:23:03', '2025-03-04 07:01:49'),
(4, 'Eyehoon', '2023-12-31 21:23:03', '2025-03-04 07:02:15'),
(5, 'Faker', '2023-12-31 21:23:03', '2025-03-04 07:02:27'),
(9, 'Gumayushi', '2023-12-31 21:23:03', '2025-03-04 07:02:36'),
(10, 'Keria', '2023-12-31 21:23:03', '2025-03-04 07:02:42'),
(11, 'Doran', '2023-12-31 21:23:03', '2025-03-04 07:02:53'),
(12, 'Đỗ Lan', '2023-12-31 21:23:03', '2025-03-04 07:03:01'),
(13, 'Kkoma', '2023-12-31 21:23:03', '2025-03-04 07:03:15'),
(14, 'Tạ Diệm', '2023-12-31 21:23:03', '2025-03-04 07:03:31'),
(16, 'Kim Dokja', '2025-01-07 06:55:54', '2025-03-04 07:03:45'),
(18, 'Oner', '2025-01-17 14:23:10', '2025-03-04 07:04:07'),
(19, 'Begin', '2025-02-20 03:19:00', '2025-03-04 07:04:17');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `bookImage`, `isIssued`, `RegDate`, `UpdationDate`, `bookQty`) VALUES
(1, 'Lập trình PHP', 5, 1, '1', 20.00, '1efecc0ca822e40b7b673c0d79ae943f.jpg', 0, '2024-01-02 01:23:03', '2025-03-04 07:05:01', 10),
(3, 'Vật Lý', 6, 13, '2', 15.00, 'dd8267b57e0e4feee5911cb1e1a03a79.jpg', NULL, '2024-01-02 01:23:03', '2025-03-04 07:05:12', 10),
(5, 'Cơ sở dữ liệu MySQL', 5, 16, '3', 455.00, '5939d64655b4d2ae443830d73abc35b6.jpg', NULL, '2024-01-02 01:23:03', '2025-03-04 07:05:26', 20),
(6, 'Xây dựng Wordpress 2022', 5, 11, 'B019MO3WCM', 100.00, '144ab706ba1cb9f6c23fd6ae9c0502b3.jpg', NULL, '2024-01-02 01:23:03', '2025-03-04 07:07:07', 15),
(7, 'Xây dựng Wordpress', 5, 4, 'B09NKWH7NP', 53.00, '90083a56014186e88ffca10286172e64.jpg', 0, '2024-01-02 01:23:03', '2025-04-21 07:17:54', 14),
(8, 'Cha giàu , con giàu', 8, 9, 'B07C7M8SX9', 120.00, '52411b2bd2a6b2e0df3eb10943a5b640.jpg', NULL, '2024-01-02 01:23:03', '2025-03-04 07:06:31', 5),
(9, 'Cô gái uống trăng', 11, 13, '1848126476', 200.00, 'f05cd198ac9335245e1fdffa793207a7.jpg', 0, '2024-01-02 01:23:03', '2025-03-04 07:07:41', 1),
(10, 'Lập trình C++', 5, 5, '007053246X', 142.00, '36af5de9012bf8c804e499dc3c3b33a5.jpg', NULL, '2024-01-02 01:23:03', '2025-03-04 07:07:27', 2),
(11, 'ASP.NET Core 5 for Beginners', 9, 19, 'GBSJ36344563', 422.00, 'b1b6788016bbfab12cfd2722604badc9.jpg', NULL, '2024-01-02 01:23:03', '2025-02-20 03:24:50', 5),
(12, 'Python Packages', 9, 16, '0367687771', 3034.00, 'ba719639def504c64ebac89cdd0d0a85.jpg', NULL, '2025-01-07 06:56:50', NULL, 25),
(13, 'Python All-in-One for Dummies', 9, 11, '9388991214', 700.00, 'f4ba4705a075527dd6ff5bd83a7d7562.jpg', 0, '2025-01-17 14:23:48', '2025-03-04 07:08:06', 30),
(14, 'Kỷ Nguyên Kỳ Lạ', 11, 19, '3698', 15000.00, 'ecb4313730e24e0d4f8e4c28051268db.jpg', 0, '2025-02-20 03:22:20', '2025-02-20 03:42:24', 36);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Lãng mạn', 1, '2025-01-01 07:23:03', '2025-03-04 08:56:41'),
(5, 'Công nghệ', 1, '2025-01-01 07:23:03', '2025-03-04 08:56:18'),
(6, 'Khoa học', 1, '2025-01-01 07:23:03', '2025-02-20 03:14:27'),
(7, 'Quản lý', 1, '2025-01-01 07:23:03', '2025-02-20 03:16:49'),
(8, 'Văn học', 1, '2025-01-01 07:23:03', '2025-02-20 03:48:19'),
(9, 'Lập trình', 1, '2025-01-01 07:23:03', '2025-02-20 03:17:23'),
(11, 'Thám hiểm', 1, '2025-02-20 03:17:36', '0000-00-00 00:00:00');

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
  `remark` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`, `remark`) VALUES
(9, 14, 'SID021', '2025-02-20 03:40:06', '2025-02-20 03:42:24', 1, 1, '1111'),
(10, 9, 'SID021', '2025-02-20 03:49:25', '2025-02-20 03:51:35', 1, 0, 'cho mượn'),
(11, 1, 'SID022', '2025-04-21 04:12:11', '2025-04-21 04:12:42', 1, 0, 'trả trước ngày 17/04/2025'),
(12, 7, 'SID023', '2025-04-21 07:07:49', '2025-04-21 07:18:25', 1, 0, 'trả trước ngày 30/04/2025'),
(13, 7, 'SID022', '2025-04-21 07:11:48', '2025-04-21 07:17:54', 1, 15000, 'Trả trước ngày 01/05/2025');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(13, 'SID021', 'nguyễn hoàng hà', 'kaenguyen@gmail.com', '0123456789', '0c8abdb962f042d1857c66dd26b0c87b', 1, '2025-02-20 03:34:09', '2025-02-20 07:23:05'),
(14, 'SID022', 'Nguyễn Xuân Long', 'xuanlong@gmail.com', '0124785136', '210b48b542659fb951a80a15c5997513', 1, '2025-03-04 09:08:43', NULL),
(15, 'SID023', 'nguyễn việt tiến', 'hoanghoang@gmail.com', '123456789', 'e10adc3949ba59abbe56e057f20f883e', 1, '2025-04-17 04:11:59', '2025-04-21 02:53:33'),
(16, 'SID024', 'nguyễn văn c', 'abc@gmail.com', '012345678', '25f9e794323b453885f5181f1b624d0b', 1, '2025-04-21 07:32:04', '2025-04-21 08:04:56');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_book_category` (`CatId`),
  ADD KEY `fk_book_author` (`AuthorId`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_issued_book` (`BookId`),
  ADD KEY `fk_issued_student` (`StudentID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD CONSTRAINT `fk_book_author` FOREIGN KEY (`AuthorId`) REFERENCES `tblauthors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_category` FOREIGN KEY (`CatId`) REFERENCES `tblcategory` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD CONSTRAINT `fk_issued_book` FOREIGN KEY (`BookId`) REFERENCES `tblbooks` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_issued_student` FOREIGN KEY (`StudentID`) REFERENCES `tblstudents` (`StudentId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
