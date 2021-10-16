-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 07, 2021 lúc 11:36 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.11

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

INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES(100000689, 100001, 1, 340000, NULL);
INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES(100000690, 100002, 1, 350000, NULL);
INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES(100000692, 100000, 2, 430000, NULL);
INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES(100000692, 100002, 1, 350000, NULL);
INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES(100000692, 100006, 1, 365000, NULL);
INSERT INTO `chitietdathang` (`SoDonDH`, `MSHH`, `SoLuong`, `GiaDatHang`, `GiamGia`) VALUES(100000693, 100036, 4, 350000, NULL);

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
  `NgayDH` date NOT NULL,
  `NgayGH` date DEFAULT NULL,
  `TrangThaiDH` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `dathang`
--

INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`) VALUES(100000689, 2100010, 1000, '2021-06-06', '2021-06-09', 1);
INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`) VALUES(100000690, 2100010, 1000, '2021-06-06', '2021-06-08', 1);
INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`) VALUES(100000692, 2100011, 1000, '2021-06-07', '2021-06-10', 1);
INSERT INTO `dathang` (`SoDonDH`, `MSKH`, `MSNV`, `NgayDH`, `NgayGH`, `TrangThaiDH`) VALUES(100000693, 2100012, 1000, '2021-06-07', '2021-06-09', 1);

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

INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES(7, 'KTXB Đại học Cần Thơ, Xuân Khánh, Ninh Kiều, Cần Thơ', 2100010);
INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES(8, '180 Đ. 3-2, Hưng Lợi, Ninh Kiều, Cần Thơ 94100', 2100011);
INSERT INTO `diachikh` (`MaDC`, `DiaChi`, `MSKH`) VALUES(9, '54 Đường Cách Mạng Tháng 8, An Thới, Bình Thủy, Cần Thơ 94000', 2100012);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `MSHH` int(11) NOT NULL,
  `TenHH` varchar(200) CHARACTER SET utf8 NOT NULL,
  `QuyCach` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `Gia` float DEFAULT NULL,
  `SoLuongHang` int(11) DEFAULT NULL CHECK (`SoLuongHang` >= 0),
  `MaLoaiHang` int(11) NOT NULL,
  `GhiChu` varchar(800) CHARACTER SET utf8 DEFAULT NULL,
  `AnhMinhHoa` varchar(100) NOT NULL,
  `TinhTrang` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100000, 'BIG NORON', '', 430000, 98, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách chất lừ sẽ giúp đôi tay của bạn thêm nổi bật. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/big-noron.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100001, 'BLACK GEM LINE', '', 340000, 22, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/black-gem-line.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100002, 'BLACK ONYX V BALL LINE', '', 350000, 3, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/black-onyx-v-ball-line.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100003, 'CROSS LINE', '', 245000, 30, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/cross.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100004, 'CROSS DOUBLE LINE', '', 250000, 38, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/cross-2.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100005, 'CROSS PATTERN', '', 350000, 25, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/cross-pattern.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100006, 'DOT LINE', '', 365000, 40, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/dot-line.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100007, 'DOUBLE BLACK FLOWER', '', 450000, 50, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/double-black-flower.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100008, 'DOUBLE LINE', '', 235000, 45, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/double-line.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100009, 'DOUBLE THREAD', '', 310000, 45, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/double-thread.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100010, 'DOUBLE WHITE FLOWER', '', 450000, 50, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/double-white-flower.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100011, 'FLOWER 3D', '', 360000, 35, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/flower-3d.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100012, 'FLOWER ROSE', '', 480000, 45, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/flower-rose.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100013, 'GEOMETRIC CROSS', '', 320000, 60, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/geometric-cross.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100014, 'INDI BLACK 3LINE', '', 650000, 50, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/indi-black-3line.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100015, 'INDI OVAL RED STONE', '', 580000, 50, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/indi-oval-garnet-red-stone.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100016, 'INDI OVAL GREY STONE', '', 585000, 55, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/indi-oval-grey-stone.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100017, 'INDI OVAL LIGHT BLUE STONE', '', 580000, 50, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/indi-oval-light-blue-stone.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100018, 'INDI OVAL PURPLE STONE', '', 480000, 50, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/indi-oval-purple-stone.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100019, 'LINE HEART', '', 250000, 100, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/line-heart.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100020, 'SUN MOON STAR', '', 550000, 50, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/moon-star.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100021, 'OXDIZE MULTI TWIST LINE', '', 460000, 40, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/oxdize-multi-twist-line.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100022, 'RAIN DROP', '', 330000, 50, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/rain-drop.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100023, 'BLACK RAIN DROP', '', 350000, 40, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/rain-drop-black.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100024, 'TWIST RIBBON', '', 200000, 100, 1, 'Nhẫn bạc cao cấp được thiết kế theo phong cách tối giản sẽ giúp bạn phù hợp với mọi loại phong cách. Một tí cách điệu cho bản thân thêm độc đáo . ', 'img/twist-ribbon.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100025, 'CIRCLE BALL DROP MULTI CHAIN', '', 490000, 49, 2, 'Những chiếc bông tai bạc gài chui đơn giản giúp bạn tự tin mỗi ngày thì những đôi bông tai bạc treo tòng ten sẽ làm bạn tỏa sáng trong những dịp họp mặt và những bữa tiệc sang trọng. Những đôi bông tai bạc này được thiết kế hợp với mọi tính cách đó nhe.', 'img/circle-ball-drop-multi-chain.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100026, 'CLIMBER GEM AND LEAF', '', 450000, 40, 2, 'Bông tai bạc climber sẽ đi theo vành tai làm nổi bật gương mặt của bạn. Kiểu này ko cần gài chui nhưng vẫn chắc chắn lắm nha, chỉ cần đeo vào rồi chỉnh theo vành tai là bạn đã có 1 kiểu bông tai mới mà ít đụng hàng rồi đó. Tại sao lại không tạo sự mới mẻ...', 'img/climber-dem-and-leaf.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100027, 'CURVE NAIL', '', 250000, 50, 2, 'Những chiếc bông tai bạc gài chui đơn giản giúp bạn tự tin mỗi ngày thì những đôi bông tai bạc treo tòng ten sẽ làm bạn tỏa sáng trong những dịp họp mặt và những bữa tiệc sang trọng. ', 'img/curve-nail.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100028, 'BUTTERFLY', '', 320000, 50, 2, 'Những chiếc bông tai bạc gài chui đơn giản giúp bạn tự tin mỗi ngày thì những đôi bông tai bạc treo tòng ten sẽ làm bạn tỏa sáng trong những dịp họp mặt và những bữa tiệc sang trọng.', 'img/butterfly.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100029, 'HALLOWEEN RABBIT DOLL', '', 540000, 25, 2, 'Những chiếc bông tai bạc gài chui đơn giản giúp bạn tự tin mỗi ngày thì những đôi bông tai bạc treo tòng ten sẽ làm bạn tỏa sáng trong những dịp họp mặt và những bữa tiệc sang trọng.', 'img/halloween-rabbit-doll.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100030, 'SAKURA FLOWER', '', 280000, 60, 2, 'Những chiếc bông tai bạc gài chui đơn giản giúp bạn tự tin mỗi ngày thì những đôi bông tai bạc treo tòng ten sẽ làm bạn tỏa sáng trong những dịp họp mặt và những bữa tiệc sang trọng.', 'img/sakura-flower.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100031, 'CROWN-OXIDIZE', '', 350000, 100, 2, 'Những chiếc bông tai bạc gài chui đơn giản giúp bạn tự tin mỗi ngày thì những đôi bông tai bạc treo tòng ten sẽ làm bạn tỏa sáng trong những dịp họp mặt và những bữa tiệc sang trọng. Những đôi bông tai bạc này được thiết kế hợp với mọi tính cách đó nhe.', 'img/CROWN-OXIDIZE.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100032, 'ANGEL WING BALL', '', 450000, 100, 3, 'Nhấn nhá cho cho outfit của bạn thêm phần nổi bật với 1 sợi dây chuyền bạc cao cấp 925 thiết kế của KaT Jewelry nhé. Có nhiều thiết kế đa dạng dành cho tất cả mọi người nhé, từ đơn giản đến cầu kỳ sang trọng đều có hết. Đây sẽ là một mảnh ghép hoàn hảo cho bộ sưu tập trang sức của bạn đó.', 'img/ANGEL-WING-BALL.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100033, 'BIG OVAL STONE DROP GEM', '', 430000, 100, 3, 'Nhấn nhá cho cho outfit của bạn thêm phần nổi bật với 1 sợi dây chuyền bạc cao cấp 925 thiết kế của KaT Jewelry nhé. Có nhiều thiết kế đa dạng dành cho tất cả mọi người nhé, từ đơn giản đến cầu kỳ sang trọng đều có hết. Đây sẽ là một mảnh ghép hoàn hảo cho bộ sưu tập trang sức của bạn đó.', 'img/BIG-OVAL-STONE-DROP-GEM.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100034, 'BIG PACIFIC BLUE STONE', '', 435000, 100, 3, 'Nhấn nhá cho cho outfit của bạn thêm phần nổi bật với 1 sợi dây chuyền bạc cao cấp 925 thiết kế của KaT Jewelry nhé. Có nhiều thiết kế đa dạng dành cho tất cả mọi người nhé, từ đơn giản đến cầu kỳ sang trọng đều có hết. Đây sẽ là một mảnh ghép hoàn hảo cho bộ sưu tập trang sức của bạn đó.', 'img/BIG-PACIFIC-BLUE-STONE.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100035, 'BIG SNOW FIRE', '', 490000, 100, 3, 'Nhấn nhá cho cho outfit của bạn thêm phần nổi bật với 1 sợi dây chuyền bạc cao cấp 925 thiết kế của KaT Jewelry nhé. Có nhiều thiết kế đa dạng dành cho tất cả mọi người nhé, từ đơn giản đến cầu kỳ sang trọng đều có hết. Đây sẽ là một mảnh ghép hoàn hảo cho bộ sưu tập trang sức của bạn đó.', 'img/BIG-SNOW-FIRE.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100036, 'CIRCLE DROP GEM', '', 350000, 96, 3, 'Nhấn nhá cho cho outfit của bạn thêm phần nổi bật với 1 sợi dây chuyền bạc cao cấp 925 thiết kế của KaT Jewelry nhé. Có nhiều thiết kế đa dạng dành cho tất cả mọi người nhé, từ đơn giản đến cầu kỳ sang trọng đều có hết. Đây sẽ là một mảnh ghép hoàn hảo cho bộ sưu tập trang sức của bạn đó.', 'img/CIRCLE-DROP-GEM.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100037, 'COMPASS', '', 320000, 100, 3, 'Nhấn nhá cho cho outfit của bạn thêm phần nổi bật với 1 sợi dây chuyền bạc cao cấp 925 thiết kế của KaT Jewelry nhé. Có nhiều thiết kế đa dạng dành cho tất cả mọi người nhé, từ đơn giản đến cầu kỳ sang trọng đều có hết. Đây sẽ là một mảnh ghép hoàn hảo cho bộ sưu tập trang sức của bạn đó.', 'img/COMPASS.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100038, 'DEER HORN', '', 450000, 100, 3, 'Nhấn nhá cho cho outfit của bạn thêm phần nổi bật với 1 sợi dây chuyền bạc cao cấp 925 thiết kế của KaT Jewelry nhé. Có nhiều thiết kế đa dạng dành cho tất cả mọi người nhé, từ đơn giản đến cầu kỳ sang trọng đều có hết. Đây sẽ là một mảnh ghép hoàn hảo cho bộ sưu tập trang sức của bạn đó.', 'img/DEER-HORN.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100039, 'PUZZLE', '', 120000, 100, 3, 'Nhấn nhá cho cho outfit của bạn thêm phần nổi bật với 1 sợi dây chuyền bạc cao cấp 925 thiết kế của KaT Jewelry nhé. Có nhiều thiết kế đa dạng dành cho tất cả mọi người nhé, từ đơn giản đến cầu kỳ sang trọng đều có hết. Đây sẽ là một mảnh ghép hoàn hảo cho bộ sưu tập trang sức của bạn đó.', 'img/PUZZLE.jpg', 1);
INSERT INTO `hanghoa` (`MSHH`, `TenHH`, `QuyCach`, `Gia`, `SoLuongHang`, `MaLoaiHang`, `GhiChu`, `AnhMinhHoa`, `TinhTrang`) VALUES(100040, 'BUTTERFLY OXIDIZE', '', 340000, 100, 4, 'Vòng tay bạc 925 bên KaT Jewelry có rất nhiều mẫu để các bạn lựa chọn luôn. Hoặc bạn có thể đặt cho mình 1 chiếc vòng độc nhất không đụng hàng nữa nè. Ngoài những mẫu bạc có sẵn, bên mình sẽ nhận đặt bằng vàng hoặc vàng rose luôn đó. Hãy chọn KaT Jewelry là 1 nơi để làm cho mình lộng lẫy hơn trong mắt mọi người nhé.', 'img/BUTTERFLY-OXIDIZE.jpg', 1);

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
  `KHPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `TenCongTy`, `SoDienThoai`, `Email`, `KHPass`) VALUES(2100010, 'NGUYEN HA KIM ANH', 'CTY TNHH MTV LEO', '0774847989', 'kimanh@gmail.com', '10c5da53d9e47c9fe112b3f7406fd60d');
INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `TenCongTy`, `SoDienThoai`, `Email`, `KHPass`) VALUES(2100011, 'Nguyễn Ngọc Ngân', '', '0234567891', 'ngan@gmail.com', '25d55ad283aa400af464c76d713c07ad');
INSERT INTO `khachhang` (`MSKH`, `HoTenKH`, `TenCongTy`, `SoDienThoai`, `Email`, `KHPass`) VALUES(2100012, 'Huỳnh Yến Linh', '', '0234567892', 'linh@gmail.com', '25d55ad283aa400af464c76d713c07ad');

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

INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES(1, 'Nhẫn bạc');
INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES(2, 'Bông tai');
INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES(3, 'Dây chuyền');
INSERT INTO `loaihanghoa` (`MaLoaiHang`, `TenLoaiHang`) VALUES(4, 'Vòng tay');

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

INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `NVpass`) VALUES(1000, 'Nguyễn Thị Bảo Ni', 'Quản lý', 'Xuân Khánh, Ninh Kiều, Cần Thơ', '0335459366', '12345678');
INSERT INTO `nhanvien` (`MSNV`, `HoTenNV`, `ChucVu`, `DiaChi`, `SoDienThoai`, `NVpass`) VALUES(1002, 'Nguyễn Yến Nhi', 'Nhân viên', 'Tân Kiều, Tháp Mười, Đồng Tháp', '0231445222', '12345678');

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
  ADD KEY `MSNV` (`MSNV`);

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
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MSKH`);

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
  MODIFY `SoDonDH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100000694;

--
-- AUTO_INCREMENT cho bảng `diachikh`
--
ALTER TABLE `diachikh`
  MODIFY `MaDC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `MSHH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100041;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MSKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2100013;

--
-- AUTO_INCREMENT cho bảng `loaihanghoa`
--
ALTER TABLE `loaihanghoa`
  MODIFY `MaLoaiHang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MSNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
