-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2024 at 08:43 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ptud_fastfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `bangchamcong`
--

CREATE TABLE `bangchamcong` (
  `MaChamCong` int(11) NOT NULL auto_increment,
  `NgayChamCong` datetime default NULL,
  `GioBatDau` time default NULL,
  `GioKetThuc` time default NULL,
  `MaNV` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`MaChamCong`),
  KEY `MaNV` (`MaNV`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bangchamcong`
--

INSERT INTO `bangchamcong` (`MaChamCong`, `NgayChamCong`, `GioBatDau`, `GioKetThuc`, `MaNV`) VALUES
(1, '2024-11-12 00:00:00', '06:00:00', '14:00:00', 'NVBH001'),
(2, '2024-11-04 00:00:00', '14:00:00', '18:00:00', 'NVBH002');

-- --------------------------------------------------------

--
-- Table structure for table `bangluong`
--

CREATE TABLE `bangluong` (
  `MaBangLuong` int(11) NOT NULL auto_increment,
  `ThangLuong` int(11) NOT NULL,
  `SoGioLamViec` float NOT NULL default '0',
  `LuongCoBan` float NOT NULL,
  `Thuong` float default NULL,
  `Tong` float NOT NULL default '0',
  `MaNV` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`MaBangLuong`),
  KEY `MaNV` (`MaNV`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `bangluong`
--

INSERT INTO `bangluong` (`MaBangLuong`, `ThangLuong`, `SoGioLamViec`, `LuongCoBan`, `Thuong`, `Tong`, `MaNV`) VALUES
(1, 1, 0, 23.8, NULL, 0, 'NVBH001'),
(2, 1, 0, 30, NULL, 0, 'NVBH002');

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `idorder` int(11) NOT NULL auto_increment,
  `MaDonHang` int(11) NOT NULL,
  `MaMonAn` int(11) NOT NULL,
  `Soluongdat` int(11) NOT NULL,
  PRIMARY KEY  (`idorder`),
  KEY `MaMonAn` (`MaMonAn`),
  KEY `MaDonHang` (`MaDonHang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`idorder`, `MaDonHang`, `MaMonAn`, `Soluongdat`) VALUES
(1, 1, 2, 5),
(2, 2, 3, 7),
(3, 1, 7, 2),
(4, 2, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cuahang`
--

CREATE TABLE `cuahang` (
  `idcuahang` int(11) NOT NULL auto_increment,
  `TenCuaHang` varchar(100) collate utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(100) collate utf8_unicode_ci NOT NULL,
  `MaNV` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`idcuahang`),
  KEY `MaNV` (`MaNV`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cuahang`
--

INSERT INTO `cuahang` (`idcuahang`, `TenCuaHang`, `DiaChi`, `MaNV`) VALUES
(1, 'Quang Trung', '157 Quang Trung', 'QL001'),
(2, 'Lê Quang Định', '1145 Lê Quang Định', 'QL002');

-- --------------------------------------------------------

--
-- Table structure for table `dondathang`
--

CREATE TABLE `dondathang` (
  `MaDonDat` int(11) NOT NULL auto_increment,
  `NgayDatHang` datetime NOT NULL,
  `SLDat` float NOT NULL,
  `TongTien` decimal(10,2) NOT NULL,
  `TrangThaiDon` varchar(100) collate utf8_unicode_ci NOT NULL,
  `MaNguyenLieu` int(11) NOT NULL,
  PRIMARY KEY  (`MaDonDat`),
  KEY `MaNguyenLieu` (`MaNguyenLieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dondathang`
--

INSERT INTO `dondathang` (`MaDonDat`, `NgayDatHang`, `SLDat`, `TongTien`, `TrangThaiDon`, `MaNguyenLieu`) VALUES
(1, '2024-11-05 05:35:38', 13, '1620000.00', 'Đã xác nhận', 3),
(2, '2024-11-06 07:36:12', 10, '567000.00', 'Đã xác nhận', 1),
(3, '2024-11-08 07:41:06', 4, '120000.68', 'Đang chờ xử lý', 5),
(4, '2024-11-10 07:41:10', 5, '100000.00', 'Đã hủy', 7);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `MaDonHang` int(11) NOT NULL auto_increment,
  `NgayDatHang` datetime default NULL,
  `TongTien` double NOT NULL default '0',
  `TrangThai` varchar(20) collate utf8_unicode_ci default NULL,
  `MaKH` int(11) NOT NULL,
  PRIMARY KEY  (`MaDonHang`),
  KEY `MaKH` (`MaKH`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`MaDonHang`, `NgayDatHang`, `TongTien`, `TrangThai`, `MaKH`) VALUES
(1, '2024-11-05 05:35:38', 235000, 'Đã hoàn thành', 1),
(2, '2024-11-07 08:29:34', 540000, 'Đã hoàn thành', 2);

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL auto_increment,
  `HoTen` varchar(20) collate utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(50) collate utf8_unicode_ci default NULL,
  `SoDienThoai` varchar(11) collate utf8_unicode_ci default NULL,
  `email` varchar(20) collate utf8_unicode_ci default NULL,
  `LichsuDatHang` datetime default NULL,
  `MaDonHang` int(11) NOT NULL,
  `password` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`MaKH`),
  KEY `MaDonHang` (`MaDonHang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `HoTen`, `DiaChi`, `SoDienThoai`, `email`, `LichsuDatHang`, `MaDonHang`, `password`) VALUES
(1, 'Minh An', NULL, '0123792365', NULL, NULL, 1, 'an1234'),
(2, 'Khánh Vy', '124 An Dương Vương', '0978171742', NULL, NULL, 2, 'vy1234'),
(3, 'Quốc Bảo', '78A Quốc lộ 50', '0907555479', 'bao123@gmail.com', '2024-11-03 14:43:24', 3, 'bao123');

-- --------------------------------------------------------

--
-- Table structure for table `khuyenmai`
--

CREATE TABLE `khuyenmai` (
  `idkhuyenmai` int(11) NOT NULL auto_increment,
  `tenchuongtrinh` varchar(100) collate utf8_unicode_ci NOT NULL,
  `mucuudai` float default NULL,
  `ngaybatdau` datetime default NULL,
  `ngayketthuc` datetime default NULL,
  `MaDonHang` int(11) default NULL,
  PRIMARY KEY  (`idkhuyenmai`),
  KEY `MaDonHang` (`MaDonHang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `khuyenmai`
--

INSERT INTO `khuyenmai` (`idkhuyenmai`, `tenchuongtrinh`, `mucuudai`, `ngaybatdau`, `ngayketthuc`, `MaDonHang`) VALUES
(1, 'Bùng nổ sale gà rán', NULL, NULL, NULL, NULL),
(2, 'Đại tiệc pizza', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lichlamviec`
--

CREATE TABLE `lichlamviec` (
  `MaLLV` int(11) NOT NULL auto_increment,
  `NgayLamViec` date NOT NULL,
  `CaLamViec` varchar(10) collate utf8_unicode_ci NOT NULL,
  `TrangThai` varchar(10) collate utf8_unicode_ci NOT NULL,
  `MaNV` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`MaLLV`),
  KEY `MaNV` (`MaNV`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `lichlamviec`
--

INSERT INTO `lichlamviec` (`MaLLV`, `NgayLamViec`, `CaLamViec`, `TrangThai`, `MaNV`) VALUES
(1, '2024-11-12', '2', 'Đã duyệt', 'NVBH001'),
(2, '2024-11-12', '1', 'Đã duyệt', 'NVBH002'),
(3, '2024-11-13', '14-18', 'Đang chờ x', 'NVB001'),
(4, '2024-11-13', '18-22', 'Đang chờ x', 'NVB002');

-- --------------------------------------------------------

--
-- Table structure for table `mon`
--

CREATE TABLE `mon` (
  `MaMonAn` int(11) NOT NULL auto_increment,
  `TenMonAn` varchar(100) collate utf8_unicode_ci NOT NULL,
  `GiaGoc` float NOT NULL,
  `GiaGiam` float default NULL,
  `Mota` varchar(100) collate utf8_unicode_ci NOT NULL,
  `Hinhanh` longtext collate utf8_unicode_ci NOT NULL,
  `MaNguyenLieu` int(11) NOT NULL,
  PRIMARY KEY  (`MaMonAn`),
  KEY `MaNguyenLieu` (`MaNguyenLieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `mon`
--

INSERT INTO `mon` (`MaMonAn`, `TenMonAn`, `GiaGoc`, `GiaGiam`, `Mota`, `Hinhanh`, `MaNguyenLieu`) VALUES
(2, 'Pizza phô mai', 108000, NULL, 'Bánh pizza đế mềm giòn, phủ phô mai mozzarella thơm ngậy, tan chảy trên bề mặt.', 'pizza phô mai.jpg', 6),
(3, 'Pizza hải sản', 149000, NULL, 'Đế bánh mỏng kết hợp với sốt cà chua, phô mai và các loại hải sản tươi như tôm, mực, và nghêu.', 'pzhaisan.jpg', 6),
(4, 'Pizza thập cẩm', 200000, NULL, 'Sự kết hợp hoàn hảo của phô mai, xúc xích, thịt xông khói, ớt chuông, và nấm trên nền sốt cà chua.', 'pzthapcam.jpg', 6),
(5, 'Gà rán giòn cay', 45000, NULL, 'Gà chiên giòn tan với lớp vỏ phủ gia vị cay nồng, hấp dẫn vị giác.', 'gacay.jpg', 1),
(6, 'Gà rán mật ong', 54000, NULL, 'Lớp da gà vàng óng được phủ sốt mật ong ngọt nhẹ, đậm đà, thấm đều vào từng miếng thịt.', 'ga ran mat ong.jpg', 1),
(7, 'Gà rán truyền thống', 39000, NULL, 'Lớp da vàng giòn rụm ', 'ga.jpg', 1),
(8, 'Hamburger bò', 37000, NULL, 'Bánh hamburger với nhân thịt bò nướng thơm phức, kèm phô mai, xà lách, cà chua và sốt mayonnaise.', 'f2.png', 7),
(9, 'Hamburger gà', 36000, NULL, 'Bánh hamburger với nhân gà rán giòn rụm, ăn kèm rau xanh và sốt đặc biệt.', 'hamga.jpg', 1),
(10, 'Salad rau trộn', 17000, NULL, 'Rau xà lách tươi mát, cà chua bi, dưa chuột, và sốt chua ngọt, mang đến bữa ăn nhẹ lành mạnh.', 'salad.jpg', 4),
(11, 'Khoai tây chiên truyền thống', 25000, NULL, 'Những miếng khoai tây chiên vàng ươm, giòn rụm, dùng kèm với sốt cà hoặc tương ớt.', 'f5.png', 8),
(12, 'Khoai tây lắc phô mai', 29000, NULL, 'Khoai tây chiên giòn lắc cùng bột phô mai béo ngậy, thơm ngon.', 'khoaiphomai.jpg', 8),
(13, 'Hotdog xúc xích', 28000, NULL, 'Xúc xích nướng thơm lừng trong bánh mì dài mềm, thêm sốt cà chua và mù tạt.', 'hotdog.jpg', 9),
(14, 'Sandwich kẹp thịt nguội', 24000, NULL, 'Bánh sandwich mềm với nhân thịt nguội, phô mai, xà lách và một chút sốt mayonnaise.', 'sw.jpg', 10),
(15, 'Tacos bò tiêu đen', 65000, NULL, 'Lớp vỏ bánh ngô giòn tan kèm nhân bò xay đậm đà, phô mai, rau thơm và sốt đặc biệt.', 'tacos.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `nguoidung`
--

CREATE TABLE `nguoidung` (
  `MaNV` varchar(20) collate utf8_unicode_ci NOT NULL,
  `password` varchar(30) collate utf8_unicode_ci NOT NULL,
  `HoTen` varchar(20) collate utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(50) collate utf8_unicode_ci NOT NULL,
  `Sdt` varchar(11) collate utf8_unicode_ci NOT NULL,
  `Email` varchar(20) collate utf8_unicode_ci NOT NULL,
  `ChucVu` varchar(20) collate utf8_unicode_ci NOT NULL,
  `ViTri` varchar(20) collate utf8_unicode_ci NOT NULL,
  `Phanquyen` enum('nhanvienbep','nhanvienbanhang','quanly') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`MaNV`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nguoidung`
--

INSERT INTO `nguoidung` (`MaNV`, `password`, `HoTen`, `DiaChi`, `Sdt`, `Email`, `ChucVu`, `ViTri`, `Phanquyen`) VALUES
('NVB001', 'b01', 'Nguyễn Đăng Nguyễn', '56 Nguyễn Văn Trỗi', '0952147963', 'nguyen@gmail.com', 'NhanVien', 'Bep', 'nhanvienbep'),
('NVB002', 'b02', 'Nguyễn Ngọc Thanh', '16/3 Nguyễn Hữu Cảnh', '0123785469', 'thanh@gmail.com', 'NhanVien', 'Bep', 'nhanvienbep'),
('NVBH001', '01', 'Nguyễn Công Bằng', '194 Cao Lỗ', '0794450814', 'bang@gmail.com', 'NhanVien', 'BanHang', 'nhanvienbanhang'),
('NVBH002', '02', 'Nguyễn Hữu Toàn', '92 Đề Thám', '0564712365', 'toan@gmail.com', 'NhanVien', 'BanHang', 'nhanvienbanhang'),
('QL001', 'admin1', 'Nguyễn Văn An', '12 Nguyễn Văn Bảo', '0357146985', 'AN1@gmail.com', 'Quan Ly', '', 'quanly'),
('QL002', 'admin2', 'Nguyễn Thị Ngọc Thảo', '60 Lê Lợi', '0937123897', 'Thao1@gmail.com', 'Quan Ly', '', 'quanly');

-- --------------------------------------------------------

--
-- Table structure for table `nguyenlieu`
--

CREATE TABLE `nguyenlieu` (
  `MaNguyenLieu` int(11) NOT NULL auto_increment,
  `TenNguyenLieu` varchar(100) collate utf8_unicode_ci NOT NULL,
  `LoaiNguyenLieu` varchar(100) collate utf8_unicode_ci NOT NULL,
  `Donvi` varchar(10) collate utf8_unicode_ci NOT NULL,
  `Soluongton` float NOT NULL,
  `idcuahang` int(11) NOT NULL,
  `MaNCC` int(11) NOT NULL,
  PRIMARY KEY  (`MaNguyenLieu`),
  KEY `idcuahang` (`idcuahang`),
  KEY `MaNCC` (`MaNCC`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `nguyenlieu`
--

INSERT INTO `nguyenlieu` (`MaNguyenLieu`, `TenNguyenLieu`, `LoaiNguyenLieu`, `Donvi`, `Soluongton`, `idcuahang`, `MaNCC`) VALUES
(1, 'Thịt gà', 'Thực phẩm dài hạn', 'kg', 15, 1, 1),
(2, 'Trứng gà', 'Thực phẩm ngắn hạn', 'vỉ', 40, 1, 1),
(3, 'Phô mai', 'Thực phẩm ngắn hạn', 'hộp', 10, 1, 2),
(4, 'Rau', 'Thực phẩm ngắn hạn', 'kg', 24, 1, 3),
(5, 'Xốt cà chua', 'Thực phẩm dài hạn', 'chai', 50, 2, 4),
(6, 'bột mì', 'thực phẩm dài hạn', 'kg', 4, 1, 3),
(7, 'Thịt bò', 'Thực phẩm dài hạn', 'kg', 14, 2, 4),
(8, 'Khoai tây ', 'Thực phẩm dài hạn', 'bịch', 20, 1, 2),
(9, 'Bánh hotdog', 'Thực phẩm ngắn hạn', 'bịch', 50, 1, 4),
(10, 'Bánh sandwich', 'Thực phẩm ngắn hạn', 'bịch', 34, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `nhacungcap`
--

CREATE TABLE `nhacungcap` (
  `MaNCC` int(11) NOT NULL auto_increment,
  `TenNCC` varchar(100) collate utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(100) collate utf8_unicode_ci NOT NULL,
  `SDT` varchar(20) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`MaNCC`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `nhacungcap`
--

INSERT INTO `nhacungcap` (`MaNCC`, `TenNCC`, `DiaChi`, `SDT`) VALUES
(1, 'Cong ty TNHH Vissan', '12 Pham Ngu Lao', '0714788782'),
(2, 'Cong ty TNHH San Ha', '34 Nguyen Binh Khiem', '0914752789'),
(3, 'Cong ty TNHH CJ Food', '26 Dinh Tien Hoang', '0124789536'),
(4, 'Cong ty Hoang Lam', '1134 Vo Van Tan', '0898124753');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bangchamcong`
--
ALTER TABLE `bangchamcong`
  ADD CONSTRAINT `bangchamcong_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `nguoidung` (`MaNV`);

--
-- Constraints for table `bangluong`
--
ALTER TABLE `bangluong`
  ADD CONSTRAINT `bangluong_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `nguoidung` (`MaNV`);

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_4` FOREIGN KEY (`MaMonAn`) REFERENCES `mon` (`MaMonAn`),
  ADD CONSTRAINT `chitietdonhang_ibfk_3` FOREIGN KEY (`MaDonHang`) REFERENCES `donhang` (`MaDonHang`);

--
-- Constraints for table `cuahang`
--
ALTER TABLE `cuahang`
  ADD CONSTRAINT `cuahang_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `nguoidung` (`MaNV`);

--
-- Constraints for table `dondathang`
--
ALTER TABLE `dondathang`
  ADD CONSTRAINT `dondathang_ibfk_1` FOREIGN KEY (`MaNguyenLieu`) REFERENCES `nguyenlieu` (`MaNguyenLieu`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_3` FOREIGN KEY (`MaKH`) REFERENCES `khachhang` (`MaKH`);

--
-- Constraints for table `khuyenmai`
--
ALTER TABLE `khuyenmai`
  ADD CONSTRAINT `khuyenmai_ibfk_1` FOREIGN KEY (`MaDonHang`) REFERENCES `donhang` (`MaDonHang`);

--
-- Constraints for table `lichlamviec`
--
ALTER TABLE `lichlamviec`
  ADD CONSTRAINT `lichlamviec_ibfk_1` FOREIGN KEY (`MaNV`) REFERENCES `nguoidung` (`MaNV`);

--
-- Constraints for table `mon`
--
ALTER TABLE `mon`
  ADD CONSTRAINT `mon_ibfk_1` FOREIGN KEY (`MaNguyenLieu`) REFERENCES `nguyenlieu` (`MaNguyenLieu`);

--
-- Constraints for table `nguyenlieu`
--
ALTER TABLE `nguyenlieu`
  ADD CONSTRAINT `nguyenlieu_ibfk_2` FOREIGN KEY (`MaNCC`) REFERENCES `nhacungcap` (`MaNCC`),
  ADD CONSTRAINT `nguyenlieu_ibfk_1` FOREIGN KEY (`idcuahang`) REFERENCES `cuahang` (`idcuahang`);
