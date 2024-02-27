-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 27, 2024 lúc 02:08 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `vuonuom_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `businesses`
--

CREATE TABLE `businesses` (
  `businessid` int(11) NOT NULL,
  `businessname` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `premiumstatus` int(11) NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `businesses`
--

INSERT INTO `businesses` (`businessid`, `businessname`, `image`, `premiumstatus`, `userid`) VALUES
(1, 'china', 'upload/icon.jpg', 0, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `businesspackages`
--

CREATE TABLE `businesspackages` (
  `businesspackageid` int(11) NOT NULL,
  `businessid` int(11) NOT NULL,
  `packageid` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `categoryid` int(11) NOT NULL,
  `categoryname` varchar(255) NOT NULL,
  `categoryimage` text NOT NULL,
  `categorystatus` int(11) NOT NULL DEFAULT 0,
  `businessid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`categoryid`, `categoryname`, `categoryimage`, `categorystatus`, `businessid`) VALUES
(4, 'máy tính', '../uploadBS/Apple-vision-pro.jpg', 1, 1),
(7, 'Điện thoại', '../uploadBS/z5193017863606_02d98d5f4b9e34508db01e1fe2432139.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `packages`
--

CREATE TABLE `packages` (
  `packageid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `packagedate` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `packages`
--

INSERT INTO `packages` (`packageid`, `name`, `price`, `packagedate`, `description`) VALUES
(1, 'Gói thường', 1000000011, '4', '<p>Mua đi chờ chi</p>');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `productimages`
--

CREATE TABLE `productimages` (
  `productimageid` int(11) NOT NULL,
  `imageurl` varchar(255) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `productimages`
--

INSERT INTO `productimages` (`productimageid`, `imageurl`, `productid`) VALUES
(1, '0', 8),
(2, '0', 8),
(10, '../uploadBS/11708681127_12212112.jpg', 11),
(11, '../uploadBS/21708681127_212.jpg', 11),
(12, '../uploadBS/31708681127_123.jpg', 11),
(16, '../uploadBS/11708933202_acer1.png', 13),
(17, '../uploadBS/21708933202_asus1.jpg', 13),
(20, '../uploadBS/11708933268_lenovo1.jpg', 14),
(21, '../uploadBS/11708935522_2.jpg', 15),
(22, '../uploadBS/21708935522_3.jpg', 15),
(23, '../uploadBS/31708935522_4.jpg', 15),
(24, '../uploadBS/41708935522_5.jpg', 15),
(25, '../uploadBS/51708935522_6.jpg', 15),
(26, '../uploadBS/61708935522_7.jpg', 15),
(27, '../uploadBS/71708935522_8.jpg', 15),
(28, '../uploadBS/11708936770_2.jpg', 16),
(29, '../uploadBS/21708936770_3.jpg', 16),
(30, '../uploadBS/31708936770_4.jpg', 16);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `thumbnail` text NOT NULL,
  `description` longtext NOT NULL,
  `businessid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`productid`, `productname`, `price`, `thumbnail`, `description`, `businessid`, `categoryid`) VALUES
(8, 'ccc', 1233, '../uploadBS/icon.jpg', '<p>132123123</p>', 1, 4),
(11, 'sieu hay', 100, '../uploadBS/banner-samsung-1.jpg', '<p>213213132</p>', 1, 4),
(13, '12321', 123132, '../uploadBS/apple1.jpg', '<p>s</p>', 1, 4),
(14, '123', 0, '../uploadBS/apple1.jpg', '<p>sda</p>', 1, 7),
(15, 'laptop', 213231312, '../uploadBS/1.jpg', '<p>dasad</p>', 1, 4),
(16, '1212', 211212, '../uploadBS/1.jpg', '<p>ads</p>', 1, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '0 = customer, 1 = bussiness, 2 = admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `fullname`, `address`, `phone`, `role`) VALUES
(1, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 2),
(2, 'user@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 0),
(5, 'business@gmail.com', '202cb962ac59075b964b07152d234b70', 'Kunwg duong tui', 'abc,xyz', '0123461237123', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`businessid`);

--
-- Chỉ mục cho bảng `businesspackages`
--
ALTER TABLE `businesspackages`
  ADD PRIMARY KEY (`businesspackageid`),
  ADD KEY `businessid` (`businessid`),
  ADD KEY `packageid` (`packageid`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryid`),
  ADD KEY `bussinessid` (`businessid`);

--
-- Chỉ mục cho bảng `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`packageid`);

--
-- Chỉ mục cho bảng `productimages`
--
ALTER TABLE `productimages`
  ADD PRIMARY KEY (`productimageid`),
  ADD KEY `productid` (`productid`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `businessid` (`businessid`),
  ADD KEY `categoryid` (`categoryid`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `businesses`
--
ALTER TABLE `businesses`
  MODIFY `businessid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `businesspackages`
--
ALTER TABLE `businesspackages`
  MODIFY `businesspackageid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `packages`
--
ALTER TABLE `packages`
  MODIFY `packageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `productimages`
--
ALTER TABLE `productimages`
  MODIFY `productimageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `businesspackages`
--
ALTER TABLE `businesspackages`
  ADD CONSTRAINT `businesspackages_ibfk_1` FOREIGN KEY (`businessid`) REFERENCES `businesses` (`businessid`),
  ADD CONSTRAINT `businesspackages_ibfk_2` FOREIGN KEY (`packageid`) REFERENCES `packages` (`packageid`);

--
-- Các ràng buộc cho bảng `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`businessid`) REFERENCES `businesses` (`businessid`);

--
-- Các ràng buộc cho bảng `productimages`
--
ALTER TABLE `productimages`
  ADD CONSTRAINT `productimages_ibfk_1` FOREIGN KEY (`productid`) REFERENCES `products` (`productid`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`businessid`) REFERENCES `businesses` (`businessid`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`categoryid`) REFERENCES `categories` (`categoryid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
