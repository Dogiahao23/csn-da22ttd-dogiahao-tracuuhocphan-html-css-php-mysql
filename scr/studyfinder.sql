-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2025 at 03:57 PM
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
-- Database: `studyfinder`
--

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `theoretical_credits` int(11) NOT NULL DEFAULT 0,
  `practical_credits` int(11) NOT NULL DEFAULT 0,
  `course_type` enum('Bắt buộc','Tự chọn') NOT NULL DEFAULT 'Bắt buộc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `course_code`, `course_name`, `semester`, `user_id`, `theoretical_credits`, `practical_credits`, `course_type`) VALUES
(1, 'Điện toán đám mây', 'SC-01', '2024', 1, 0, 30, 20, 'Bắt buộc'),
(13, 'Kiến trúc máy tính', 'SC-02', '2011', 1, 12, 30, 15, 'Bắt buộc'),
(16, 'Kỹ thuật lập trình', 'SC-03', '2024', 1, 110, 30, 15, 'Bắt buộc'),
(28, 'Lập trình hướng đối tượng', 'SC-04', '2024', 2, 110, 30, 15, 'Tự chọn'),
(29, 'Nhập môn công nghệ thông tin', 'SC-05', '2023', 1, 110, 45, 15, 'Tự chọn'),
(30, 'Cấu trúc dữ liệu và giải thuật', 'SC-06', '2025', 2, 110, 30, 60, 'Bắt buộc'),
(31, 'Cơ sở dữ liệu', 'SC-07', '2024', 1, 110, 30, 30, 'Bắt buộc'),
(32, 'Mạng máy tính', 'SC-08', '2025', 2, 110, 30, 30, 'Bắt buộc'),
(33, 'Hệ điều hành', 'SC-09', '2', 2, 110, 30, 30, 'Bắt buộc'),
(34, 'Thiết kế Web', 'SC-10', '2025', 1, 110, 15, 30, 'Bắt buộc'),
(35, 'Lập trình ứng dụng trên Windows', 'SC-11', '2025', 1, 110, 30, 30, 'Bắt buộc'),
(36, 'Phân tích và thiết kế hệ thống thông tin', 'SC-12', '2025', 2, 110, 30, 30, 'Bắt buộc'),
(37, 'Hóa', '123', '2213', 1, 110, 1, 1, 'Bắt buộc');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `password`, `role`, `created_at`, `user_id`) VALUES
(2, 'haodeptrai', 'Hào đẹp trai', '$2y$10$9OjuzURbUuQAF0F/yBPBzuSBH9ZvyKmef.6LB2WUzyPM4Zpmrx4JK', 'user', '2024-12-25 15:22:04', 2),
(11, 'admin', 'Quản trị viên', '$2y$10$YiOwhxXHbtWDVrFZCmmlz.hUODoXdE8F5BKC29xzd2z2oWXP48dEO', 'admin', '2024-12-29 10:23:00', 1),
(13, '110122070', 'Đỗ Gia Hào', '$2y$10$Gzp9y3G5W8Ehocixp1tlVeHBM4oFpBhC0dewMeYGTrMjJODGgfOy2', 'user', '2025-01-07 15:37:57', 110);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
