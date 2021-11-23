-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2021 lúc 07:09 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `quanlydathang`
--
CREATE DATABASE IF NOT EXISTS `quanlydathang` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `quanlydathang`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietdathang`
--

CREATE TABLE `chitietdathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSHH` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaDatHang` float NOT NULL,
  `GiamGia` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chitietdathang`
--

INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES
(19, 9, 4, 13990000, NULL),
(19, 10, 1, 13990000, NULL),
(20, 1, 3, 19990000, NULL),
(20, 9, 2, 13990000, NULL),
(20, 11, 1, 8450000, NULL),
(20, 14, 2, 4990000, NULL),
(24, 2, 1, 5990000, NULL),
(24, 11, 1, 8450000, NULL),
(25, 1, 1, 19990000, NULL),
(25, 17, 2, 27490000, NULL),
(25, 25, 4, 9490000, NULL),
(26, 11, 1, 8450000, NULL),
(26, 22, 1, 990000, NULL),
(26, 23, 1, 952000, NULL),
(26, 25, 1, 9490000, NULL),
(27, 17, 1, 27490000, NULL),
(27, 25, 1, 9490000, NULL),
(27, 26, 1, 10990000, NULL),
(28, 8, 1, 69990000, NULL),
(28, 12, 1, 4990000, NULL),
(28, 18, 1, 44990000, NULL),
(28, 22, 1, 990000, NULL),
(29, 24, 1, 5752000, NULL),
(29, 25, 1, 9490000, NULL),
(30, 10, 1, 13990000, NULL),
(30, 19, 1, 41990000, NULL),
(30, 26, 7, 10990000, NULL),
(31, 25, 1, 9490000, NULL),
(32, 2, 1, 5990000, NULL),
(32, 12, 3, 4990000, NULL),
(33, 22, 1, 990000, NULL),
(33, 23, 1, 952000, NULL),
(34, 25, 1, 9490000, NULL);

--
-- Bẫy `chitietdathang`
--
DELIMITER $$
CREATE TRIGGER `DatHang` AFTER INSERT ON `chitietdathang` FOR EACH ROW BEGIN
	update HangHoa set HangHoa.SoLuongHang = HangHoa.SoLuongHang- New.SoLuong
	where HangHoa.MSHH=New.MSHH;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dathang`
--

CREATE TABLE `dathang` (
  `SoDonDH` int(11) NOT NULL,
  `MSKH` int(11) NOT NULL,
  `MSNV` int(11) DEFAULT NULL,
  `NgayDH` datetime NOT NULL,
  `NgayGH` datetime DEFAULT NULL,
  `TrangThaiDH` smallint(6) DEFAULT NULL,
  `MaDC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`, `MaDC`) VALUES
(19, 5, 1004, '2021-11-14 23:49:33', NULL, 1, 10),
(20, 1, NULL, '2021-11-21 11:22:19', NULL, 0, 1),
(24, 9, NULL, '2021-11-23 21:52:16', NULL, 0, 12),
(25, 9, 1010, '2021-11-23 22:25:37', '2021-11-23 23:16:13', 1, 12),
(26, 16, NULL, '2021-11-23 22:43:24', NULL, 0, 20),
(27, 16, 1010, '2021-11-23 22:48:22', NULL, 1, 21),
(28, 17, NULL, '2021-11-23 22:56:22', NULL, 0, 22),
(29, 17, NULL, '2021-11-23 22:57:19', NULL, 0, 23),
(30, 18, NULL, '2021-11-23 23:04:01', NULL, 0, 24),
(31, 18, 1010, '2021-11-23 23:04:55', NULL, 1, 24),
(32, 19, NULL, '2021-11-23 23:06:39', NULL, 0, 25),
(33, 19, NULL, '2021-11-23 23:06:56', NULL, 0, 25),
(34, 19, 1010, '2021-11-23 23:13:58', NULL, 1, 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `diachikh`
--

CREATE TABLE `diachikh` (
  `MaDC` int(11) NOT NULL,
  `DiaChi` varchar(100) CHARACTER SET utf8 NOT NULL,
  `MSKH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `diachikh`
--

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES
(1, 'Đường Trần Minh Sơn, phường An Khánh, quận Ninh Kiều, Cần Thơ', 1),
(2, 'Quầy thuốc Đoan Thảo, khóm 2, thị trấn Đầm Dơi, huyện Đầm Dơi, tỉnh Cà Mau', 1),
(6, 'Cần Thơ', 1),
(10, 'Omnis quia sit rem ', 5),
(11, 'Eiusmod qui natus vo', 8),
(12, 'Consectetur dolores ', 9),
(16, 'Tân duyệt, Đầm Dơi, Cà Mau', 1),
(17, 'HAHAHA', 1),
(19, 'Ipsum omnis qui ea p', 15),
(20, 'Reprehenderit dolore', 16),
(21, 'Hậu Giang', 16),
(22, 'Repudiandae aut temp', 17),
(23, 'Hồ Chí Minh', 17),
(24, 'Bạc Liêu', 18),
(25, 'Số 268 Trần Hưng Đạo, P. Nguyễn Cư Trinh, Q.1, TP. HCM', 19),
(26, 'Số 9A Trần Phú, P. Cái Khế, Q. Ninh Kiều, TP. Cần Thơ', 19);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` int(11) NOT NULL,
  `TenHH` varchar(200) CHARACTER SET utf8 NOT NULL,
  `QuyCach` text CHARACTER SET utf8 DEFAULT NULL,
  `Gia` float DEFAULT NULL,
  `SoLuongHang` int(11) DEFAULT NULL CHECK (`SoLuongHang` >= 0),
  `MaLoaiHang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`) VALUES
(1, 'I Phone 12 64GB', 'Trong những tháng cuối năm 2020, Apple đã chính thức giới thiệu đến người dùng cũng như iFan thế hệ iPhone 12 series mới với hàng loạt tính năng bứt phá, thiết kế được lột xác hoàn toàn, hiệu năng đầy mạnh mẽ và một trong số đó chính là iPhone 12 64GB.                ', 19990000, 1, 1),
(2, 'Xiaomi Redmi Note 10S', 'Bên cạnh Redmi Note 10, Xiaomi còn giới thiệu thêm phiên bản Redmi Note 10S với điểm nhấn chính là cụm camera 64 MP, màn hình AMOLED sắc nét, hiệu năng mạnh mẽ nhưng lại có mức giá rẻ đến bất ngờ.                                                ', 5990000, 1, 1),
(7, 'Apple MacBook Pro M1', 'Apple Macbook Pro M1 2020 được nâng cấp với bộ vi xử lý mới cực kỳ mạnh mẽ, chiếc laptop này sẽ phục vụ tốt cho công việc của bạn, đặc biệt cho lĩnh vực đồ họa, kỹ thuật.', 44990000, 3, 1),
(8, 'Laptop Apple MacBook Pro 16 ', 'Được trang bị con chip Apple M1 Pro là phiên bản nâng cấp vượt trội với tốc độ xử lý tăng 70% và hiệu năng gấp 1.7 lần so với dòng M1 tiền nhiệm, sở hữu 200 GB/s memory bandwidth chinh phục mọi tác vụ từ cơ bản đến chuyên sâu với hiệu năng đỉnh cao dẫn đầu so với các dòng sản phẩm cùng phân khúc đồng thời kéo dài thời lượng pin nhờ 10 nhân CPU gồm 8 nhân hiệu suất cao và 2 nhân tiết kiệm điện ấn tượng cùng 33.7 tỷ bóng bán dẫn.', 69990000, 6, 2),
(9, 'Tablet Huawei MatePad 11', 'Trang bị RAM 6 GB có khả năng đa nhiệm thoải mái, bộ nhớ trong 128 GB khá lớn để lưu trữ mọi khoảnh khắc cùng những bức ảnh, video hay một kho game cho việc giải trí bất tận, người dùng còn có thể mở rộng thêm dung lượng thông qua thẻ nhớ MicroSD.', 13990000, 3, 4),
(10, 'Samsung Galaxy Tab S7', 'Samsung chính thức trình làng mẫu máy tính bảng có tên Galaxy Tab S7 FE, máy trang bị cấu hình mạnh mẽ, màn hình giải trí siêu lớn và điểm ấn tượng nhất là viên pin siêu khủng được tích hợp bên trong, giúp tăng hiệu suất làm việc nhưng vẫn có tính di động cực cao                                                                                                                ', 13990000, 8, 4),
(11, 'Apple Watch SE 40mm', 'Apple Watch SE 40mm viền nhôm dây cao su hồng có khung viền chắc chắn, thiết kế bo tròn 4 góc giúp thao tác vuốt chạm thoải mái hơn. Mặt kính cường lực Ion-X strengthened glass với kích thước 1.57 inch, hiển thị rõ ràng. Khung viền nhôm chắc chắn cùng dây đeo cao su có độ đàn hồi cao, êm ái, tạo cảm giác thoải mái khi đeo.                                ', 8450000, 0, 3),
(12, 'Samsung Galaxy Watch 3 45mm', 'Samsung Galaxy Watch 3 45mm viền thép bạc dây da với tấm nền Super AMOLED 1.4 inch và độ phân giải 360x360 pixels, đồng hồ có khả năng hiển thị xuất sắc với màu sắc rực rỡ, thông tin hiển thị đầy đủ, rõ ràng. Khung viền của đồng hồ được làm bằng thép không gỉ chắc chắn và chống ăn mòn.                ', 4990000, 5, 3),
(13, 'Apple MacBook Air M1 2020', 'Apple MacBook Air M1 2020 sở hữu các tính năng hiện đại cùng với hiệu năng mạnh mẽ từ Chip Apple M1 độc quyền từ Apple, chiếc laptop nhỏ gọn này rất phù hợp với sinh viên, nhân viên văn phòng không chỉ xử lý tốt các tác vụ văn phòng mà còn giải quyết ổn định thiết kế đồ hoạ', 34990000, 12, 2),
(14, 'Garmin Lily dây silicone vàng', 'Đồng hồ thông minh Garmin Lily có thiết kế nhỏ gọn, sở hữu đường kính mặt 35 mm và có trọng lượng nhẹ khoảng 24g. Khung viền đồng hồ được làm từ chất liệu polyme bền chắc, có khả năng chịu sự va đập cao. Dây đeo làm từ silicone mềm dẻo, cực kỳ êm tay với độ dài 10 cm và độ rộng của dây thanh mảnh nữ tính khoảng 1.4 cm.                                                                                                                ', 4990000, 6, 3),
(17, 'IPhone 13 256GB ', 'Apple thỏa mãn sự chờ đón của iFan và người dùng với sự ra mắt của iPhone 13. Dù ngoại hình không có nhiều thay đổi so với iPhone 12 nhưng với cấu hình mạnh mẽ hơn, đặc biệt pin “trâu” hơn và khả năng quay phim chụp ảnh cũng ấn tượng hơn, hứa hẹn mang đến những trải nghiệm thú vị trên phiên bản mới này.', 27490000, 4, 1),
(18, 'Asus ROG Zephyrus G14', 'Cùng bạn đối đầu mọi thách thức trên chiến trường ảo nhờ bộ vi xử lý mạnh mẽ AMD và phong cách thiết kế độc đáo, khẳng định chất tôi riêng của siêu phẩm độc nhất vô nhị Asus ROG Zephyrus Gaming G14 Alan Walker (K2064T), hứa hẹn sẽ mang đến những trải nghiệm tuyệt hảo khó quên cho người dùng. Nếu là một fan của Alan Walker thì đây chính là sản phẩm bạn không thể bỏ lỡ.', 44990000, 2, 2),
(19, 'iPad Pro M1 12.9 inch', 'Máy tính bảng iPad Pro M1 12.9 inch Wifi Cellular 256GB (2021) trang bị con chip vô cùng mạnh mẽ M1 cùng công nghệ màn hình mới mini-LED được rất nhiều người dùng đón nhận nồng nhiệt và đánh giá rất tốt sản phẩm này đến từ Apple.', 41990000, 6, 4),
(20, 'iPad Air 4 Wifi 256GB', 'iPad Air 4 khi được cho ra mắt đã gây ra một cơn sốt cho giới công nghệ toàn cầu, khi sử dụng chipset A14 Bionic với hiệu năng cực khủng, bên cạnh một thiết kế cao cấp và những công nghệ hàng đầu.\r\n', 22290000, 8, 4),
(21, 'Huawei MatePad 11', 'MatePad 11 đã được Huawei trình làng với hệ thống giải trí bất tận đáp ứng mọi nhu cầu sáng tạo cùng bút M-Pencil, nâng cấp nhiều về tính năng lẫn sức mạnh xử lý.', 13990000, 9, 4),
(22, 'Mi Band 6', 'Vòng đeo tay thông minh Mi Band 6 là phiên bản đáng mong đợi của nhà Xiaomi với thiết kế màn hình tràn viền cho bạn góc nhìn tốt hơn. Mặt kính cường lực chống trầy xước tốt cùng dây đeo cao su với thiết kế ôm trọn cổ tay, không thấm nước khi đeo, mang lại cho bạn cảm giác dễ chịu cả ngày dài.', 990000, 9, 3),
(23, 'BeU PT1 Hồng', 'Đồng hồ thông minh BeU PT1 Hồng mang thiết kế sang trọng với mặt tròn cá tính. BeU PT1 được trang bị màn hình cảm ứng 1.3 inch cho người dùng quan sát được nhiều thông tin hơn. Bên cạnh đó, dây đeo silicone mềm nhẹ cùng thiết kế rãnh cho bạn cảm giác thông thoáng, dễ chịu khi mang suốt ngày dài.', 952000, 9, 3),
(24, 'Oppo Watch 46mm dây silicone đen', 'Đồng hồ thông minh Oppo Watch màu đen phiên bản 46mm sử dụng mặt đồng hồ vuông, bo cong nhẹ ở 4 cạnh, cùng với mặt kính bo cong 2D sang hai bên có chiều sâu tạo cảm giác như mặt kính cong 3D, màn hình AMOLED 1.91 inch độ phân giải 402 x 476 pixels, mật độ điểm ảnh 326 ppi và dải màu rộng chuẩn DCI-P3 cho chất lượng hiển thị sắc nét, sống động. Dây đeo silicone cho cảm giác mang được dễ chịu và thoải mái.', 5752000, 6, 3),
(25, 'OPPO Reno6 Z 5G', 'Reno6 Z 5G đến từ nhà OPPO với hàng loạt sự nâng cấp và cải tiến không chỉ ngoại hình bên ngoài mà còn sức mạnh bên trong. Đặc biệt, chiếc điện thoại được hãng đánh giá “chuyên gia chân dung bắt trọn mọi cảm xúc chân thật nhất”, đây chắc chắn sẽ là một “siêu phẩm\" mà bạn không thể bỏ qua.', 9490000, 3, 1),
(26, 'Samsung Galaxy A52s 5G', 'Samsung đã chính thức giới thiệu chiếc điện thoại Galaxy A52s 5G đến người dùng, đây phiên bản nâng cấp của Galaxy A52 5G ra mắt cách đây không lâu, với ngoại hình không đổi nhưng được nâng cấp đáng kể về thông số cấu hình bên trong.', 10990000, 0, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hinhhanghoa`
--

CREATE TABLE `hinhhanghoa` (
  `MaHinh` int(11) NOT NULL,
  `TenHinh` varchar(200) NOT NULL,
  `MSHH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hinhhanghoa`
--

INSERT INTO `hinhhanghoa` (`MaHinh`, `TenHinh`, `MSHH`) VALUES
(1, 'xiaomi-redmi-note-10s-xanh-1-600x600.jpg', 2),
(2, 'iphone-12-do-new-2-600x600.jpg', 1),
(3, 'vi-vn-iphone-12-3-(2).jpg', 1),
(4, 'vi-vn-xiaomi-redmi-note-10s-manhinh.jpg', 2),
(12, 'apple-macbook-pro-2020-z11c-061220-1202300.jpg', 7),
(13, 'macbook-pro-m1-2020-gray-600x600.jpg', 7),
(14, '2021-11-06-09-36-23_61863e8700153apple-macbook-pro-16-m1-pro-2021-10-core-cpu-600x600.jpg', 8),
(15, '2021-11-06-09-36-23_61863e8701b7cvi-vn-apple-macbook-pro-16-m1-pro-2021-10-core-cpu-3.jpg', 8),
(16, '2021-11-06-16-21-00_61869d5c49addhuawei-matepad-11-grey-600x600.jpg', 9),
(17, '2021-11-06-16-21-00_61869d5c4ac55vi-vn-huawei-matepad-11-slider-man-hinh.jpg', 9),
(18, '2021-11-06-16-23-16_61869de49c5cdsamsung-galaxy-tab-s7-fan-editon-xanh-la-2.jpg', 10),
(19, '2021-11-06-16-23-16_61869de4a29a0samsung-galaxy-tab-s7-fe-black-1-org.jpg', 10),
(20, '2021-11-06-16-23-16_61869de4a558fsamsung-galaxy-tab-s7-fe-green-600x600.jpg', 10),
(21, '2021-11-06-16-25-30_61869e6a2d896se-40mm-vien-nhom-day-cao-su-hong-thumb-1-600x600.jpg', 11),
(22, '2021-11-06-16-25-30_61869e6a2b687se-40mm-vien-nhom-day-cao-su-hong-glr-1-org.jpg', 11),
(23, '2021-11-06-16-25-30_61869e6a2a2d7se-40mm-vien-nhom-day-cao-su-hong-080221-0348059.jpg', 11),
(24, '2021-11-06-16-26-47_61869eb7df3b8samsung-galaxy-watch-3-45mm-bac-thumb-1-1-600x600.jpg', 12),
(25, '2021-11-06-16-26-47_61869eb7e166evi-vn-samsung-galaxy-watch-3-45mm-bac-10.jpg', 12),
(26, '2021-11-06-16-29-02_61869f3eed6cdmacbook-air-m1-2020-gold-600x600.jpg', 13),
(27, '2021-11-06-16-29-02_61869f3eec27eapple-macbook-air-2020-m1-mgn73saa-011220-0837280.jpg', 13),
(28, '2021-11-07-05-17-19_6187534f38498garmin-lily-day-silicone-vang-thumb-1-1-600x600.jpg', 14),
(29, '2021-11-07-05-17-19_6187534f39d7bvang2-org-org.jpg', 14),
(33, '2021-11-23-15-57-57_619d0175b23b3IPHONE_13.jpg', 17),
(34, '2021-11-23-15-57-57_619d0175b3df5iphone-13-red-1-1.jpg', 17),
(35, '2021-11-23-15-57-57_619d0175b4ae9iphone-13-xanh-1.jpg', 17),
(36, '2021-11-23-16-00-32_619d0210780d0asus-rog-zephyrus-gaming-g14-ga401qec-r9-k2064t-1-org.jpg', 18),
(37, '2021-11-23-16-00-32_619d02107bb00asus-rog-zephyrus-gaming-g14-ga401qec-r9-k2064t-17-600x600.jpg', 18),
(38, '2021-11-23-16-04-31_619d02ff471a6ipad-pro-2021-129-inch-gray-thumb-600x600.jpg', 19),
(39, '2021-11-23-16-04-31_619d02ff47af4ipad-pro-2021-129-inch-silver-thumb-600x600.jpg', 19),
(40, '2021-11-23-16-05-50_619d034ee0d7dipad-air-4-sky-blue-1020x680-org.jpg', 20),
(41, '2021-11-23-16-05-50_619d034ef1a3aipad-air-4-wifi-64gb-2020-xanhla-600x600-600x600.jpg', 20),
(42, '2021-11-23-16-08-25_619d03e9d485bhuawei-matepad-11-grey-600x600.jpg', 21),
(43, '2021-11-23-16-08-25_619d03e9d5314huawei-matepad-11-xam-5.jpg', 21),
(44, '2021-11-23-16-11-54_619d04ba9f331mi-band-6-thumb-1-1-600x600.jpg', 22),
(45, '2021-11-23-16-11-54_619d04ba9e6afmi-band-6-2-1-org.jpg', 22),
(46, '2021-11-23-16-14-34_619d055a6204fbeu-pt1-hong-thumb-1-1-600x600.jpg', 23),
(47, '2021-11-23-16-14-34_619d055a60e78beu-pt1-hong-1-1-org.jpg', 23),
(48, '2021-11-23-16-16-20_619d05c40293boppo-watch-46mm-day-silicone-thumb-1-1-600x600.jpg', 24),
(49, '2021-11-23-16-16-20_619d05c401fa4oppo-watch-46mm-day-silicone-1-1-org.jpg', 24),
(50, '2021-11-23-16-19-38_619d068a1ed09oppo-reno6-z.jpg', 25),
(51, '2021-11-23-16-19-38_619d068a1fe07oppo-reno6-z-5g-den-6aaaaaaaaa-org.jpg', 25),
(52, '2021-11-23-16-23-33_619d077586fb4samsung-ga.jpg', 26),
(53, '2021-11-23-16-23-33_619d077587aabsamsung-galaxy-a52s-5g-violet-2.jpg', 26);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `MSKH` int(11) NOT NULL,
  `HoTenKH` varchar(50) CHARACTER SET utf8 NOT NULL,
  `TenCongTy` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `SoDienThoai` char(10) NOT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `KHPass` varchar(255) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `TenCongTy`, `SoDienThoai`, `Email`, `KHPass`, `fax`) VALUES
(1, 'Trần Đăng Khoa', 'Richard Annowit', '0947685343', 'richardannowit@gmail.com', '1', '3733636373'),
(5, 'Nayda Sanford', 'Stanton Ball Inc', '0938373635', 'xenuk@mailinator.com', NULL, ''),
(8, 'Francis Sargent', NULL, '0958575757', NULL, 'Pa$$w0rd!', NULL),
(9, 'Damian Cain', 'Oneill Gonzales Trading Company', '0947465847', 'xazosazusu@mailinator.com', 'Pa$$w0rd!', '09487857574'),
(15, 'Griffith Ball', NULL, '0948474636', NULL, 'Pa$$w0rd!', NULL),
(16, 'Nguyễn Thị Vân Anh', '', '0924546770', '', 'Pa$$w0rd!', ''),
(17, 'Lenore Chase', 'Barker and Whitney LLC', '0847463736', 'dyqas@mailinator.com', 'Pa$$w0rd!', '+1 (743) 957-8363'),
(18, 'Trần Nguyễn Triệu Vỹ', NULL, '0948475637', NULL, '1', NULL),
(19, 'Richard Annowit', 'Battle Stark Trading', '0937463739', 'gehyfoziv@mailinator.com', '1', '+1 (108) 963-2194');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihanghoa`
--

CREATE TABLE `loaihanghoa` (
  `MaLoaiHang` int(11) NOT NULL,
  `TenLoaiHang` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaihanghoa`
--

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES
(1, 'Điện thoại'),
(2, 'Laptop'),
(3, 'Đồng hồ thông minh'),
(4, 'Máy tính bảng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MSNV` int(11) NOT NULL,
  `HoTenNV` varchar(50) CHARACTER SET utf8 NOT NULL,
  `ChucVu` varchar(50) CHARACTER SET utf8 NOT NULL,
  `DiaChi` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `SoDienThoai` varchar(11) DEFAULT NULL,
  `NVpass` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `NVpass`) VALUES
(1004, 'Trần Đăng Khoa', 'Giám đốc', 'Đầm Dơi, Cà Mau', '0948474746', '1'),
(1005, 'Molestiae est et la', 'Nulla aliquid proide', 'Modi fugiat est volu', 'Est laborio', 'Pa$$w0rd!'),
(1010, 'Trần Văn Tèo', 'Thư ký', 'Cần Thơ', '0939484745', '1'),
(1011, 'Nguyễn Minh Trung', 'Giám đốc', 'Cần Thơ', '0948475646', '12345678');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD PRIMARY KEY (`SoDonDH`,`MSHH`),
  ADD KEY `MSHH` (`MSHH`);

--
-- Chỉ mục cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD PRIMARY KEY (`SoDonDH`),
  ADD KEY `MSKH` (`MSKH`),
  ADD KEY `MSNV` (`MSNV`),
  ADD KEY `dathang_FK` (`MaDC`);

--
-- Chỉ mục cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD PRIMARY KEY (`MaDC`),
  ADD KEY `MSKH` (`MSKH`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`MSHH`),
  ADD KEY `MaLoaiHang` (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD PRIMARY KEY (`MaHinh`),
  ADD KEY `FK_hinhhanghoa_hanghoa` (`MSHH`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`),
  ADD UNIQUE KEY `khachhang_un` (`SoDienThoai`);

--
-- Chỉ mục cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  ADD PRIMARY KEY (`MaLoaiHang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MSNV`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `dathang`
--
ALTER TABLE `dathang`
  MODIFY `SoDonDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MSHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  MODIFY `MaHinh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MSNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitietdathang`
--
ALTER TABLE `chitietdathang`
  ADD CONSTRAINT `chitietdathang_ibfk_1` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`),
  ADD CONSTRAINT `chitietdathang_ibfk_2` FOREIGN KEY (`SoDonDH`) REFERENCES `dathang` (`SoDonDH`);

--
-- Các ràng buộc cho bảng `dathang`
--
ALTER TABLE `dathang`
  ADD CONSTRAINT `dathang_FK` FOREIGN KEY (`MaDC`) REFERENCES `diachikh` (`MaDC`),
  ADD CONSTRAINT `dathang_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`),
  ADD CONSTRAINT `dathang_ibfk_2` FOREIGN KEY (`MSNV`) REFERENCES `nhanvien` (`MSNV`);

--
-- Các ràng buộc cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  ADD CONSTRAINT `diachikh_ibfk_1` FOREIGN KEY (`MSKH`) REFERENCES `khachhang` (`MSKH`);

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `hanghoa_ibfk_1` FOREIGN KEY (`MaLoaiHang`) REFERENCES `loaihanghoa` (`MaLoaiHang`);

--
-- Các ràng buộc cho bảng `hinhhanghoa`
--
ALTER TABLE `hinhhanghoa`
  ADD CONSTRAINT `FK_hinhhanghoa_hanghoa` FOREIGN KEY (`MSHH`) REFERENCES `hanghoa` (`MSHH`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
