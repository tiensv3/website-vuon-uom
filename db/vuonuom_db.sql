-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 11, 2024 lúc 09:52 AM
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
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `businesses`
--

INSERT INTO `businesses` (`businessid`, `businessname`, `image`, `userid`) VALUES
(1, 'Apple', 'upload/icon.jpg', 5),
(7, 'PKMayTinh', 'upload/vuonuom.jpg', 30);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `businesspackages`
--

CREATE TABLE `businesspackages` (
  `businesspackageid` int(11) NOT NULL,
  `businessid` int(11) NOT NULL,
  `packageid` int(11) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `businesspackages`
--

INSERT INTO `businesspackages` (`businesspackageid`, `businessid`, `packageid`, `startdate`, `enddate`, `status`) VALUES
(1, 1, 1, '2024-02-02', '2024-03-03', 1),
(2, 1, 3, NULL, NULL, 0),
(4, 1, 1, '2024-03-01', '2024-03-30', 1),
(12, 7, 1, '2024-03-04', '2024-04-04', 1);

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
(32, 'Laptop', '../uploadBS/1_20240311140744_1.jpg', 1, 1),
(33, 'Macbook', '../uploadBS/1_20240311141025_1.jpg', 1, 1),
(34, 'Chuột', '../uploadBS/7_20240311141504_1.jpg', 1, 7),
(35, 'Danh mục A', '../uploadBS/1_20240311144630_1.jpeg', 1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `contactid` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderdetailid` int(11) NOT NULL,
  `quantityproduct` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `businessid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetails`
--

INSERT INTO `orderdetails` (`orderdetailid`, `quantityproduct`, `orderid`, `productid`, `businessid`) VALUES
(7, 3, 3, 54, 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `ordercode` text NOT NULL,
  `shipaddress` text NOT NULL,
  `total` bigint(20) NOT NULL DEFAULT 0,
  `method` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `orderdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`orderid`, `ordercode`, `shipaddress`, `total`, `method`, `status`, `orderdate`, `userid`) VALUES
(3, 'FNOQJ7545894', 'Trà Vinh', 0, 1, 1, '2024-03-11 07:48:07', 35);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `packages`
--

CREATE TABLE `packages` (
  `packageid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `numberofcategories` int(11) NOT NULL DEFAULT 0,
  `numberofproducts` int(11) NOT NULL DEFAULT 0,
  `packagedate` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `packages`
--

INSERT INTO `packages` (`packageid`, `name`, `price`, `numberofcategories`, `numberofproducts`, `packagedate`, `description`) VALUES
(1, 'Gói thường', 300000, 7, 10, 1, '<p>Mua đi chờ chi</p>'),
(3, 'Gói dùng thử', 150000, 5, 5, 1, '<h2><i><strong>adssadsadsdasdas1dsa</strong></i></h2>'),
(4, 'Gói kim cương', 800000, 15, 15, 1, '<blockquote><p>sad</p></blockquote><figure class=\"table\"><table><tbody><tr><td>dsa</td><td>sadasd</td><td>ádsa</td><td>ádasđá</td></tr><tr><td>ádasd</td><td>ádsad</td><td>ádads</td><td>ád1</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>sda</td><td>ưqe</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table></figure>'),
(5, 'Gói vip', 1000000, 20, 20, 1, '<p>123123</p>'),
(6, 'Gói bạc', 500000, 5, 5, 1, '');

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
(267, '../uploadBS/11710141153_2.jpg', 53),
(268, '../uploadBS/21710141153_3.jpg', 53),
(269, '../uploadBS/31710141153_4.jpg', 53),
(270, '../uploadBS/41710141153_5.jpg', 53),
(271, '../uploadBS/51710141153_6.jpg', 53),
(272, '../uploadBS/61710141153_7.jpg', 53),
(273, '../uploadBS/71710141153_8.jpg', 53),
(274, '../uploadBS/11710141449_2.jpg', 54),
(275, '../uploadBS/21710141449_3.jpg', 54),
(276, '../uploadBS/31710141449_4.jpg', 54),
(277, '../uploadBS/41710141449_5.jpg', 54),
(278, '../uploadBS/51710141449_6.jpg', 54);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `sale` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `productstatus` int(11) DEFAULT 0,
  `trending` int(11) NOT NULL DEFAULT 0,
  `thumbnail` text NOT NULL,
  `shortdesc` text NOT NULL,
  `description` longtext NOT NULL,
  `businessid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`productid`, `productname`, `price`, `sale`, `quantity`, `productstatus`, `trending`, `thumbnail`, `shortdesc`, `description`, `businessid`, `categoryid`) VALUES
(53, 'Macbook  M1 2020', 30000000, 22500000, 10, 0, 1, '../uploadBS/1_20240311141233_1.jpg', 'Sản phẩm chất lượng', '<p>Đây là sản phẩm đến từ apple</p>', 1, 33),
(54, 'Chuột rappo b2', 150000, 100000, 10, 1, 1, '../uploadBS/7_20240311141729_1.jpg', 'Chuột giá rẻ', '<p>Chuột giá rẻ đến từ rappo</p>', 7, 34);

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
  `role` int(11) NOT NULL DEFAULT 0 COMMENT '0 = customer, 1 = bussiness, 2 = admin',
  `active` int(11) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `fullname`, `address`, `phone`, `role`, `active`, `token`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 2, 1, '', '2024-03-07 07:14:21', '2024-03-08 08:07:28'),
(5, 'business@gmail.com', '202cb962ac59075b964b07152d234b70', 'Kunwg duong tui', 'abc,xyz', '0123461237123', 1, 1, '', '2024-03-07 07:14:21', '2024-03-08 08:07:28'),
(30, 'business1@gmail.com', '202cb962ac59075b964b07152d234b70', 'Dương Tuấn Vũ', 'abc', '10237402631', 1, 1, '', '2024-03-07 09:19:07', '2024-03-11 07:14:26'),
(34, 'sostien0409@gmail.com', 'b752e76141fdabe92d77024ddece3dc7', 'sostien0409@gmail.com', 'abc', '123', 0, 1, '', '2024-03-08 07:30:41', '2024-03-11 04:14:18'),
(35, 'debugxuyendem@gmail.com', 'b752e76141fdabe92d77024ddece3dc7', 'Nguyễn Văn B', 'Trà Vinh', '0337777111', 0, 1, '', '2024-03-11 07:41:29', '2024-03-11 07:41:46');

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
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contactid`);

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderdetailid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `productid` (`productid`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

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
  MODIFY `businessid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `businesspackages`
--
ALTER TABLE `businesspackages`
  MODIFY `businesspackageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contactid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderdetailid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `packages`
--
ALTER TABLE `packages`
  MODIFY `packageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `productimages`
--
ALTER TABLE `productimages`
  MODIFY `productimageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
-- Các ràng buộc cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`orderid`) REFERENCES `orders` (`orderid`);

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

DELIMITER $$
--
-- Sự kiện
--
CREATE DEFINER=`root`@`localhost` EVENT `update_token_event` ON SCHEDULE EVERY 1 MINUTE STARTS '2024-03-08 15:17:36' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE users SET token = NULL WHERE token IS NOT NULL AND updated_at < NOW() - INTERVAL 5 MINUTE$$

CREATE DEFINER=`root`@`localhost` EVENT `delete_old_users` ON SCHEDULE EVERY 1 MINUTE STARTS '2024-03-11 13:51:42' ON COMPLETION NOT PRESERVE DISABLE DO DELETE FROM users
    WHERE created_at < NOW() - INTERVAL 5 MINUTE AND active != 1$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
