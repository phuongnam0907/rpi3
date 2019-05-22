-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 19, 2019 lúc 02:15 PM
-- Phiên bản máy phục vụ: 10.1.34-MariaDB
-- Phiên bản PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `data`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nodelink`
--

CREATE TABLE `nodeLink` (
  `No` int(11) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `gateway` varchar(50) NOT NULL,
  `dad` varchar(50) DEFAULT NULL,
  `son` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `nodeLink`
--

INSERT INTO `nodeLink` (`No`, `ip`, `gateway`, `dad`, `son`) VALUES
(1, '101', '101', '', 1),
(2, '102', '102', '', 1),
(3, '007', '102', '102', 1),
(4, '004', '101', '101', 1),
(5, '005', '101', '101', 0),
(6, '103', '103', '', 1),
(7, '001', '103', '103', 0),
(8, '002', '103', '103', 0),
(9, '008', '102', '102', 0),
(10, '003', '101', '004', 0),
(11, '006', '102', '007', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `Gateway` varchar(50) DEFAULT NULL,
  `Node` varchar(50) DEFAULT NULL,
  `phValue` float UNSIGNED NOT NULL,
  `tempValue` float UNSIGNED NOT NULL,
  `liqValue` float UNSIGNED NOT NULL,
  `doValue` float UNSIGNED NOT NULL,
  `tdsValue` int(10) UNSIGNED NOT NULL,
  `orpValue` float UNSIGNED NOT NULL,
  `time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `sensor`
--

INSERT INTO `sensor` (`id`, `Gateway`, `Node`, `phValue`, `tempValue`, `liqValue`, `doValue`, `tdsValue`, `orpValue`, `time`) VALUES
(1, '101', '003', 3.11, 25.75, 53.12, 12.112, 1000, 4.45, 0),
(2, '101', '003', 3.11, 25.75, 53.12, 12.112, 1000, 4.45, 1),
(3, '101', '004', 8.04, 34.12, 81, 11.22, 542, 6.15, 2),
(4, '101', '005', 7.03, 35.12, 80.01, 12.22, 615, 5.15, 3),
(5, '101', '005', 3.11, 25.75, 53.12, 12.112, 1000, 4.45, 4),
(6, '102', '008', 3.11, 25.75, 53.12, 12.112, 1000, 4.45, 5),
(7, '101', '004', 3.11, 25.75, 53.12, 12.112, 1000, 4.45, 6),
(8, '102', '006', 3.11, 25.75, 53.12, 12.112, 1000, 4.45, 7),
(9, '102', '006', 3.11, 25.75, 53.12, 12.112, 1000, 4.45, 8),
(10, '102', '007', 3.1, 26.75, 43.12, 22.112, 500, 4.45, 9),
(11, '101', '005', 7.03, 35.12, 80.01, 12.22, 615, 5.15, 1000),
(12, '101', '005', 7.03, 35.12, 80.01, 12.22, 615, 5.15, 2000),
(13, '101', '005', 7.03, 35.12, 80.01, 12.22, 615, 5.15, 3000),
(14, '101', '005', 3.11, 25.75, 53.12, 12.112, 1000, 4.45, 4000),
(15, '103', '001', 7.03, 35.12, 80.01, 12.22, 615, 5.15, 10000),
(16, '103', '002', 7.03, 35.12, 80.01, 12.22, 615, 5.15, 10100);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `nodelink`
--
ALTER TABLE `nodeLink`
  ADD PRIMARY KEY (`No`);

--
-- Chỉ mục cho bảng `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `nodelink`
--
ALTER TABLE `nodeLink`
  MODIFY `No` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
