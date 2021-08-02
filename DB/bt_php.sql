-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2021 at 05:04 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bt_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `IDAdmin` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `TaiKhoan` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `MatKhau` char(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`IDAdmin`, `Email`, `TaiKhoan`, `MatKhau`) VALUES
('ADM001', 'admin123@gmail.com', 'admin', '123456'),
('ADM002', 'admin356@gmail.com', 'admin356', '1234567'),
('ADM003', 'admin2354@gmail.com', 'admin2356', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `sId` varchar(225) NOT NULL,
  `TenSanPham` varchar(15) NOT NULL,
  `GiaBan` int(11) NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `MaSanPham` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`sId`, `TenSanPham`, `GiaBan`, `SoLuong`, `cartId`, `MaSanPham`) VALUES
('sdfmdflf', '3434', 0, 0, 1, '1'),
('edaknn2ul5v6edfaaelembmk5k', 'Đèn Laze', 3500, 12, 24, 'SP07'),
('edaknn2ul5v6edfaaelembmk5k', 'Đèn Led', 200, 10, 27, 'SP06');

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `MaHD` int(11) NOT NULL,
  `MaSanPham` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `DonGia` int(11) NOT NULL,
  `ThanhTien` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`MaHD`, `MaSanPham`, `SoLuong`, `DonGia`, `ThanhTien`) VALUES
(34, 'SP07', 1, 3500, 3500),
(35, 'SP03', 1, 2000, 2000),
(36, 'SP06', 10, 200, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `chungloaisp`
--

CREATE TABLE `chungloaisp` (
  `MaChungLoaiSP` int(11) NOT NULL,
  `TenChungLoaiSP` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chungloaisp`
--

INSERT INTO `chungloaisp` (`MaChungLoaiSP`, `TenChungLoaiSP`) VALUES
(111, 'Cây cảnh'),
(222, 'Chậu cây'),
(333, 'Hoa'),
(444, 'Phân bón'),
(555, 'Cây ăn quả'),
(666, 'Cây lâu năm'),
(777, 'Phụ kiện cây'),
(888, 'Đèn trang trí cây'),
(999, 'Cây bóng mát'),
(1010, 'Cây văn phòng'),
(1026, 'Cây hoa hồng');

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `MaHD` int(11) NOT NULL,
  `MaNhanVien` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `MaKH` int(15) NOT NULL,
  `NgayBan` char(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`MaHD`, `MaNhanVien`, `MaKH`, `NgayBan`) VALUES
(34, '', 12, '2021-08-02'),
(35, '', 12, '2021-08-02'),
(36, '', 12, '2021-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `MaKH` int(11) NOT NULL,
  `TenKH` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`MaKH`, `TenKH`, `SDT`, `DiaChi`, `email`, `password`) VALUES
(1, 'Nhật Trường', '123456', 'Nam Định', '', ''),
(2, 'Đức Chung', '124885', 'Hải Dương', '', ''),
(3, 'Trọng Đức', '741258', 'Hà Nội', '', ''),
(4, 'Văn Hùng', '741253', 'Hà Nội', 'a@a.com', '123456'),
(5, 'Minh Hùng', '963258', 'Bắc Ninh', '', ''),
(6, 'Văn Hòa', '7415826', 'Hòa Bình', '', ''),
(7, 'Văn Liệu', '196258', 'Bắc Ninh', '', ''),
(8, 'Đình Thành', '3692563', 'Từ Sơn', '', ''),
(9, 'Mạnh Hưng', '987456', 'Hà Nội', '', ''),
(10, 'Văn Linh', '951753', 'Hải Phòng', '', ''),
(12, 'Hùng dương', '1234567890', 'Ha noi', 'h@g.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `TenNhanVien` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` char(15) COLLATE utf8_unicode_ci NOT NULL,
  `DiaChi` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `TenNhanVien`, `SDT`, `DiaChi`) VALUES
('NV01', 'Trọng Thanh', '111111', 'Thanh Hóa'),
('NV02', 'Anh Toan', '222222', 'Nam Định'),
('NV03', 'Thủy Linh', '145491', 'Thanh Hóa'),
('NV04', 'Minh Đức', '545645', 'Hải Phòng'),
('NV05', 'Quang Đức', '151515', 'Nghệ An'),
('NV06', 'Văn Thành', '7894562', 'Hải Phòng'),
('NV07', 'Văn Minh', '985321', 'Thanh Hóa'),
('NV08', 'Thùy Trang', '786226', 'Nam Định'),
('NV09', 'Đức Minh', '321123', 'Nam Định'),
('NV10', 'Đức Hòa', '484885', 'Hải Phòng');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSanPham` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `TenSanPham` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `GiaBan` int(11) NOT NULL,
  `MaChungLoaiSP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSanPham`, `TenSanPham`, `SoLuong`, `GiaBan`, `MaChungLoaiSP`) VALUES
('SP01', 'Cây Bàng Singapore', 0, 1500, 1010),
('SP02', 'Chậu Sứ', 10, 200, 222),
('SP03', 'Chậu Thủy Tinh', 15, 2000, 222),
('SP04', 'Cây Trầu', 14, 2500, 1010),
('SP05', 'Cây Kim Tiền', 16, 3600, 1010),
('SP06', 'Đèn Led', 32, 200, 888),
('SP07', 'Đèn Laze', 14, 3500, 888),
('SP08', 'Cây Táo', 36, 1500, 555),
('SP09', 'Cây Lê', 14, 2500, 555),
('SP10', 'NPK', 65, 500, 444);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`IDAdmin`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`MaHD`) USING BTREE,
  ADD KEY `fk_sp` (`MaSanPham`),
  ADD KEY `MaHD` (`MaHD`);

--
-- Indexes for table `chungloaisp`
--
ALTER TABLE `chungloaisp`
  ADD PRIMARY KEY (`MaChungLoaiSP`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`MaKH`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD KEY `fk_loaisp_idx` (`MaChungLoaiSP`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `chungloaisp`
--
ALTER TABLE `chungloaisp`
  MODIFY `MaChungLoaiSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1031;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `MaKH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_lsp` FOREIGN KEY (`MaChungLoaiSP`) REFERENCES `chungloaisp` (`MaChungLoaiSP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
