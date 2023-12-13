-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 10:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlynhahang`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adm_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(6, 'admin', 'dad3a37aa9d50688b5157698acfd7aee', 'admin@gmail.com', '', '2023-07-31 08:51:04'),
(9, 'admin2', 'dad3a37aa9d50688b5157698acfd7aee', 'ninbook0708@gmail.com', 'QFE6ZM', '2023-11-29 19:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `admin_codes`
--

CREATE TABLE `admin_codes` (
  `id` int(222) NOT NULL,
  `codes` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_codes`
--

INSERT INTO `admin_codes` (`id`, `codes`) VALUES
(1, 'QX5ZMN'),
(2, 'QFE6ZM'),
(3, 'QMZR92'),
(4, 'QPGIOV'),
(5, 'QSTE52'),
(6, 'QMTZ2J');

-- --------------------------------------------------------

--
-- Table structure for table `detail_order`
--

CREATE TABLE `detail_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_order`
--

INSERT INTO `detail_order` (`id`, `order_id`, `restaurant_id`, `title`, `quantity`, `price`) VALUES
(4, 3, 58, 'món ăn số 2', 1, 120),
(5, 4, 58, 'Dồi dê nghĩa', 3, 245),
(6, 4, 58, 'món ăn số 2', 2, 120),
(7, 5, 59, 'Dồi dê nghĩa', 1, 245),
(8, 6, 59, 'Dồi dê nghĩa', 3, 245),
(9, 7, 58, 'Dồi dê nghĩa', 1, 245),
(10, 7, 58, 'món ăn số 2', 1, 120),
(11, 9, 58, 'Dồi dê nghĩa', 1, 245),
(12, 11, 58, 'Dồi dê nghĩa', 1, 245),
(16, 14, 58, 'Dồi dê nghĩa', 1, 245),
(17, 14, 58, 'món ăn số 2', 1, 120);

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

CREATE TABLE `dishes` (
  `d_id` int(222) NOT NULL,
  `rs_id` int(222) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slogan` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `img` varchar(222) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES
(30, 58, 'Dồi dê nghĩa', 'Dồi Dê được làm từ thịt dê tươi, ruột dê, đậu xanh xây nhuyễn, tía tô, rau thơm, xả, gia vị các loại. Do vậy, Dồi dê rất lành tính, dễ ăn và tốt cho sức khỏe. Bà bầu, người già, trẻ em đều ăn được Dồi dê nhé. ', 245.000, '6527f6e38a982.jpeg'),
(31, 59, 'Dồi dê nghĩa', 'Dồi Dê được làm từ thịt dê tươi, ruột dê, đậu xanh xây nhuyễn, tía tô, rau thơm, xả, gia vị các loại. Do vậy, Dồi dê rất lành tính, dễ ăn và tốt cho sức khỏe. Bà bầu, người già, trẻ em đều ăn được Dồi dê nhé. ', 245.000, '6527f6f522fd6.jpeg'),
(43, 58, 'món ăn số 2', 'Dồi Dê được làm từ thịt dê tươi, ruột dê, đậu xanh xây nhuyễn, tía tô, rau thơm, xả, gia vị các loại. Do vậy, Dồi dê rất lành tính, dễ ăn và tốt cho sức khỏe. Bà bầu, người già, trẻ em đều ăn được Dồi dê nhé. ', 120.000, '656ae5c98ecba.jpeg'),
(44, 78, 'Dê tái chanh', 'Dồi Dê được làm từ thịt dê tươi, ruột dê, đậu xanh xây nhuyễn, tía tô, rau thơm, xả, gia vị các loại. Do vậy, Dồi dê rất lành tính, dễ ăn và tốt cho sức khỏe. Bà bầu, người già, trẻ em đều ăn được Dồi dê nhé. ', 120.000, '656caced450e1.jpeg'),
(45, 80, 'Thịt dê xào lá lốt', 'Thịt dê có các chất béo không bão hòa giúp giảm nguy cơ mắc các bệnh về tim mạch. Các dưỡng chất có trong thịt dê còn tăng cường hệ miễn dịch, cải thiện trí nhớ, làm giảm căng thẳng, chữa nhức mỏi, bổ sung chất sắt rất tốt', 275.000, '656cad25c2c7a.jpeg'),
(46, 78, 'món ăn số 2', 'Dồi Dê được làm từ thịt dê tươi, ruột dê, đậu xanh xây nhuyễn, tía tô, rau thơm, xả, gia vị các loại. Do vậy, Dồi dê rất lành tính, dễ ăn và tốt cho sức khỏe. Bà bầu, người già, trẻ em đều ăn được Dồi dê nhé. ', 120.000, '656cad9637eef.jpeg'),
(47, 59, 'Dê tái chanh', 'Từng miếng thịt vị ngọt, thanh mát kết hợp cùng với các loại đồ gói và tương bần tạo nên hương vị hoàn hảo.', 125.000, '656e46ef9cec6.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `ship` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `u_id`, `code`, `ship`, `status`, `date`) VALUES
(3, 61, 2540, 1, 'Đã giao hàng', '2023-12-02 18:54:17'),
(4, 37, 1854, 1, 'Đã thanh toán 50%', '2023-12-03 16:09:52'),
(5, 37, 9534, 1, 'Đã giao hàng', '2023-12-03 16:07:40'),
(6, 37, 9056, 1, 'Đã giao hàng', '2023-12-03 16:05:56'),
(7, 64, 5983, 2, 'Đã giao hàng', '2023-12-03 16:01:32'),
(8, 64, 7030, 1, 'Đã giao hàng', '2023-12-03 16:26:48'),
(9, 64, 5712, 1, 'Đã giao hàng', '2023-12-03 16:26:25'),
(10, 64, 7181, 1, 'Đã giao hàng', '2023-12-03 16:26:04'),
(11, 64, 3015, 1, 'Đã giao hàng', '2023-12-03 16:13:29'),
(14, 37, 9617, 2, 'Đã giao hàng', '2023-12-04 21:38:10');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

CREATE TABLE `remark` (
  `id` int(11) NOT NULL,
  `frm_id` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remark` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `rs_id` int(222) NOT NULL,
  `restaurant_id` int(222) NOT NULL,
  `title` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `o_hr` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `c_hr` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `o_days` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`rs_id`, `restaurant_id`, `title`, `email`, `phone`, `url`, `o_hr`, `c_hr`, `o_days`, `address`, `image`, `date`, `status`) VALUES
(58, 40, 'Nhà hàng Dê Nghĩa cơ sở 2', 'Hethongdenghiavn@gmail.com', '19000 666 88', 'https://hethongdenghia.vn/', '10am', '11pm', 'Mon-Sat', 'B6-B7 Thăng Long, Khuê Trung, Q. Cẩm Lệ, Đà Nẵng', '6526d6391c628.jpg', '2023-10-27 12:41:14', 'ok'),
(59, 41, 'Nhà hàng Dê Nghĩa cơ sở 3', 'Hethongdenghiavn@gmail.com', '19000 666 88', 'https://hethongdenghia.vn/', '10am', '11pm', 'Mon-Sat', '18-19 Nguyễn Sinh Sắc, Hòa Minh, Q. Liên Chiểu, Đà Nẵng', '6526d654a424f.jpg', '2023-10-28 02:44:35', 'ok'),
(80, 46, 'Nhà hàng Dê Nghĩa cơ sở 5', 'Hethongdenghiavn@gmail.com', '19000 666 88', 'https://hethongdenghia.vn/', '6am', '11pm', 'Mon-Sat', '112 hoài thanh, mỹ an, ngũ hành sơn, đà nẵng', 'nha-hang-de-nghia-db-1.jpg', '2023-12-03 16:37:26', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `res_category`
--

CREATE TABLE `res_category` (
  `c_id` int(222) NOT NULL,
  `c_name` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `res_category`
--

INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES
(5, 'grill.', '2023-03-08 15:56:04'),
(6, 'pizza.', '2023-03-08 15:55:52'),
(7, 'pasta.', '2023-03-08 15:55:44'),
(8, 'thaifood.', '2023-03-08 15:55:36'),
(9, 'fish.', '2023-03-08 15:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `statistical`
--

CREATE TABLE `statistical` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `quantity` int(11) NOT NULL,
  `oder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `statistical`
--

INSERT INTO `statistical` (`id`, `date`, `price`, `quantity`, `oder`) VALUES
(4, '2023-11-24', 735.000, 3, 2),
(5, '2023-11-23', 535.000, 2, 2),
(6, '2023-11-25', 490.000, 2, 1),
(7, '2023-11-27', 980.000, 4, 2),
(8, '2023-11-28', 1470.000, 6, 3),
(9, '2023-12-02', 1225.000, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(222) NOT NULL,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `l_name` varchar(222) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int(222) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`, `Role`) VALUES
(37, 'ngokhacsy', 'Ngô Khắc', 'Sỷ', 'ngokhacsyqt@gmail.com', '0358018265', 'e10adc3949ba59abbe56e057f20f883e', '1aa', 0, '2023-12-03 15:50:34', 'User'),
(46, 'nhahang', 'nhà', 'hàng', 'nhahang112@gmail.com', '0942820895', 'e10adc3949ba59abbe56e057f20f883e', '112 hoài thanh ', 0, '2023-12-03 15:50:14', 'RT'),
(64, 'ngokhacsy2002', 'ngô khắc ', 'sỷ ', 'ngokhacsyqt112@gmail.com', '0358018265', '4297f44b13955235245b2497399d7a93', '1', 0, '2023-12-03 15:51:48', 'User'),
(65, 'nhahangtest', 'Ngô', 'Sỷ', 'ngokhacsyqtt32@gmail.com', '0358018265', '4297f44b13955235245b2497399d7a93', '1', 0, '2023-12-03 16:36:48', 'RT');

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

CREATE TABLE `users_orders` (
  `o_id` int(222) NOT NULL,
  `u_id` int(222) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(222) NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `ship` int(11) NOT NULL,
  `status` varchar(222) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `restaurant_id`, `title`, `quantity`, `price`, `ship`, `status`, `date`, `code`) VALUES
(158, 61, 58, 'Dồi dê nghĩa', 1, 245.000, 1, NULL, '2023-12-02 16:33:24', 4857),
(159, 61, 58, 'món ăn số 2', 1, 120.000, 1, NULL, '2023-12-02 16:33:24', 4857),
(160, 61, 58, 'món ăn số 2', 1, 120.000, 1, NULL, '2023-12-02 16:34:46', 2540),
(161, 37, 58, 'Dồi dê nghĩa', 3, 245.000, 1, NULL, '2023-12-02 19:49:00', 1854),
(162, 37, 58, 'món ăn số 2', 2, 120.000, 1, NULL, '2023-12-02 19:49:00', 1854),
(163, 37, 59, 'Dồi dê nghĩa', 1, 245.000, 1, NULL, '2023-12-02 19:58:21', 9534),
(164, 37, 59, 'Dồi dê nghĩa', 3, 245.000, 1, NULL, '2023-12-02 19:59:32', 9056),
(165, 64, 58, 'Dồi dê nghĩa', 1, 245.000, 2, NULL, '2023-12-03 15:52:23', 5983),
(166, 64, 58, 'món ăn số 2', 1, 120.000, 2, NULL, '2023-12-03 15:52:23', 5983),
(167, 64, 58, 'Dồi dê nghĩa', 1, 245.000, 1, NULL, '2023-12-03 16:11:32', 5712),
(168, 64, 58, 'Dồi dê nghĩa', 1, 245.000, 1, NULL, '2023-12-03 16:12:42', 3015),
(169, 64, 78, 'Dê tái chanh', 3, 120.000, 2, NULL, '2023-12-03 16:31:40', 7221),
(170, 64, 78, 'Dê tái chanh', 1, 120.000, 2, NULL, '2023-12-03 16:34:34', 8244),
(171, 64, 78, 'món ăn số 2', 5, 120.000, 2, NULL, '2023-12-03 16:34:34', 8244),
(172, 37, 58, 'Dồi dê nghĩa', 1, 245.000, 2, NULL, '2023-12-04 21:37:38', 9617),
(173, 37, 58, 'món ăn số 2', 1, 120.000, 2, NULL, '2023-12-04 21:37:38', 9617);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adm_id`);

--
-- Indexes for table `admin_codes`
--
ALTER TABLE `admin_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `dishes`
--
ALTER TABLE `dishes`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `remark`
--
ALTER TABLE `remark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`rs_id`);

--
-- Indexes for table `res_category`
--
ALTER TABLE `res_category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `statistical`
--
ALTER TABLE `statistical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `users_orders`
--
ALTER TABLE `users_orders`
  ADD PRIMARY KEY (`o_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adm_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin_codes`
--
ALTER TABLE `admin_codes`
  MODIFY `id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `dishes`
--
ALTER TABLE `dishes`
  MODIFY `d_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `remark`
--
ALTER TABLE `remark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `rs_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `res_category`
--
ALTER TABLE `res_category`
  MODIFY `c_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `statistical`
--
ALTER TABLE `statistical`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `users_orders`
--
ALTER TABLE `users_orders`
  MODIFY `o_id` int(222) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
