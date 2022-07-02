-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2022 at 09:02 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akuntansiku`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id_aset` varchar(11) NOT NULL,
  `nama_aset` varchar(30) NOT NULL,
  `jml_aset` int(11) NOT NULL,
  `tot_harga` bigint(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `nama_toko` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id_aset`, `nama_aset`, `jml_aset`, `tot_harga`, `tgl_beli`, `upload_pembayaran`, `keterangan`, `nama_toko`) VALUES
('A-01', 'Bangunan', 4, 2000000, '2021-12-04', '', 'Cash', ''),
('A-02', 'Tanah', 4, 1000000, '2021-12-16', 'Wallpaper.jpg', 'Cash', 'UD.Jaya'),
('A-03', 'Rumah', 0, 2200000, '2022-03-26', 'Wallpaper_3.jpg', 'Kas', 'PT Jaya Makmur');

--
-- Triggers `aset`
--
DELIMITER $$
CREATE TRIGGER `insert_aset_lama` AFTER INSERT ON `aset` FOR EACH ROW BEGIN
 IF new.nama_aset IS NOT NULL THEN
INSERT INTO aset_dimiliki(id, id_aset,nama_toko,nama_aset ,tot_harga ,tgl_beli,keterangan,upload_pembayaran)
VALUES (id, new.id_aset,new.nama_toko, new.nama_aset, new.tot_harga, new.tgl_beli, new.keterangan, new.upload_pembayaran); 
 END IF;
 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_aset_dimiliki` AFTER UPDATE ON `aset` FOR EACH ROW BEGIN
UPDATE aset_dimiliki
SET
nama_aset = new.nama_aset,
nama_toko = new.nama_toko,
tot_harga = new.tot_harga,
tgl_beli = new.tgl_beli,
keterangan = new.keterangan,
upload_pembayaran=new.upload_pembayaran
WHERE id_aset=new.id_aset ;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aset_dimiliki`
--

CREATE TABLE `aset_dimiliki` (
  `id` int(11) NOT NULL,
  `id_aset` varchar(11) NOT NULL,
  `nama_aset` varchar(30) NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `jml_aset` int(11) NOT NULL,
  `tot_harga` bigint(20) NOT NULL,
  `tgl_beli` date NOT NULL,
  `keterangan` text NOT NULL,
  `upload_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aset_dimiliki`
--

INSERT INTO `aset_dimiliki` (`id`, `id_aset`, `nama_aset`, `nama_toko`, `jml_aset`, `tot_harga`, `tgl_beli`, `keterangan`, `upload_pembayaran`) VALUES
(1, 'A-01', 'Bangunan', '', 4, 500000, '2021-12-04', 'Cash', ''),
(2, 'A-02', 'Tanah', 'UD.Jaya', 4, 1000000, '2021-12-16', 'Cash', 'Wallpaper.jpg'),
(9, 'PA-001', 'Tanah', '', 2, 500000, '2021-12-29', 'Tanah', ''),
(10, 'PA-002', 'Tanah', '', 0, 500000, '2022-01-08', 'Tanah', ''),
(11, 'PA-003', 'Peralatan Kantor', '', 0, 50000, '2022-01-09', 'Peralatan Kantor', ''),
(13, 'A-03', 'Rumah', 'PT Jaya Makmur', 0, 2200000, '2022-03-26', 'Kas', 'Wallpaper_3.jpg'),
(14, 'PA-004', 'Tanah', 'PT Jaya Makmur', 0, 5000000, '2022-04-17', 'Tanah', 'Wallpaper_2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_bahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan`, `nama_bahan`, `quantity`, `satuan`, `harga_bahan`) VALUES
('BB-001', 'Kain', 18, 'Meter', 500),
('BB-002', 'Benang', 307, 'Meter', 300),
('BB-003', 'Tali', 25, 'Meter', 200),
('BB-004', 'Pensil', 40, 'Buah', 100),
('BB-005', 'Penggaris', 20, 'Buah', 300),
('BB-006', 'kain pink', 100, 'meter', 250);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_baku_gudang`
--

CREATE TABLE `bahan_baku_gudang` (
  `id_bahan` varchar(11) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `safety_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bahan_baku_gudang`
--

INSERT INTO `bahan_baku_gudang` (`id_bahan`, `nama_bahan`, `stock`, `satuan`, `harga`, `safety_stok`) VALUES
('BHN001', 'Kain', 500, 'Meter', 500, 100),
('BHN002', 'Benang', 200, 'Meter', 500, 100),
('BHN003', 'Kayu', 500, 'Meter', 500, 100),
('BHN004', 'Tali', 0, 'Meter', 400, 100),
('BHN005', 'Pensil', 0, 'Buah', 500, 100),
('BHN006', 'Penggaris', 0, 'Buah', 500, 100),
('BHN007', 'retsleting', 0, 'pcs', 5000, 10),
('BHN008', 'retsleting hitam', 0, 'pcs', 5000, 10);

--
-- Triggers `bahan_baku_gudang`
--
DELIMITER $$
CREATE TRIGGER `insert_sisa_bahan` AFTER INSERT ON `bahan_baku_gudang` FOR EACH ROW BEGIN
INSERT INTO sisa_bahan_gudang(id_bahan, nama_bahan, stock, satuan, stok_sisa, safety_stok) VALUES
(new.id_bahan, new.nama_bahan, new.stock, new.satuan, new.stock, new.safety_stok);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jmlh_barang` int(11) NOT NULL,
  `harga_barang` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `jmlh_barang`, `harga_barang`) VALUES
('BRG001', 'Baju', 864, 5000),
('BRG002', 'Bangku', 95, 50000),
('BRG003', 'Kereasi Penggaris', 90, 5000),
('BRG004', 'jaket', 50, 0),
('BRG005', 'kemeja', 200, 0),
('BRG006', 'Daster', 55, 0),
('BRG007', 'daster', 50, 0),
('BRG008', 'Jaket Ungu', 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang_siap_jual`
--

CREATE TABLE `barang_siap_jual` (
  `id_barang_siap` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `merchant` varchar(20) NOT NULL,
  `jmlh_barang` int(11) NOT NULL,
  `harga_barang` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_siap_jual`
--

INSERT INTO `barang_siap_jual` (`id_barang_siap`, `nama_barang`, `merchant`, `jmlh_barang`, `harga_barang`) VALUES
('BSJ001', 'Baju', 'Shopee', 130, 50000),
('BSJ002', 'Baju', 'Lazada', 80, 100000),
('BSJ003', 'Bangku', 'Shopee', 50, 50000),
('BSJ004', 'Bangku', 'Lazada', 30, 400000),
('BSJ005', 'Kereasi Penggaris', 'Tokopedia', 10, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `barang_terjual`
--

CREATE TABLE `barang_terjual` (
  `id_retur` int(11) NOT NULL,
  `id_penjualan` varchar(20) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jmlh_barang` int(11) NOT NULL,
  `stock_barang` int(11) NOT NULL,
  `sisa_stock` int(11) NOT NULL,
  `nama_merchant` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_terjual`
--

INSERT INTO `barang_terjual` (`id_retur`, `id_penjualan`, `tgl_penjualan`, `nama_barang`, `jmlh_barang`, `stock_barang`, `sisa_stock`, `nama_merchant`) VALUES
(40, 'PNJ002', '2022-01-09', 'Bangku', 1, 177, 176, ''),
(41, 'PNJ001', '2022-01-09', 'Baju', 3, 500, 497, ''),
(42, 'PNJ001', '2022-01-09', 'Bangku', 1, 176, 175, ''),
(43, 'PNJ003', '2022-01-09', 'Baju', 3, 497, 494, ''),
(58, 'PNJ005', '2022-04-16', 'Baju', 20, 200, 180, 'Shopee'),
(59, 'PNJ005', '2022-04-16', 'Baju', 10, 100, 90, 'Lazada'),
(60, 'PNJ006', '2022-04-25', 'Bangku', 50, 100, 50, 'Shopee'),
(61, 'PNJ006', '2022-04-25', 'Baju', 50, 180, 130, 'Shopee'),
(62, 'PNJ007', '2022-04-25', 'Bangku', 20, 50, 30, 'Lazada'),
(63, 'PNJ007', '2022-04-25', 'Baju', 10, 90, 80, 'Lazada');

--
-- Triggers `barang_terjual`
--
DELIMITER $$
CREATE TRIGGER `update_stok` AFTER INSERT ON `barang_terjual` FOR EACH ROW BEGIN
UPDATE barang_siap_jual SET jmlh_barang=new.sisa_stock 
WHERE nama_barang = new.nama_barang 
AND merchant=new.nama_merchant; 
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `beban_op`
--

CREATE TABLE `beban_op` (
  `id_bebanop` varchar(20) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tot_harga_beban` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL,
  `jenis_beban` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `beban_op`
--

INSERT INTO `beban_op` (`id_bebanop`, `tgl_bayar`, `tot_harga_beban`, `keterangan`, `upload_pembayaran`, `jenis_beban`) VALUES
('BO-01', '2021-12-02', 500000, 'biaya peralatan', '', 'biaya perjalanan'),
('BO-02', '2021-12-16', 50000, 'Biaya', '', 'biaya perjalanan'),
('BO-03', '2022-01-07', 500000, 'apa saja', '', 'biaya perjalanan'),
('BO-04', '2022-04-17', 100000, 'Beban Air', 'Wallpaper_1.jpg', 'Beban Air');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_bahan`
--

CREATE TABLE `biaya_bahan` (
  `id_biaya_bahan` varchar(20) NOT NULL,
  `id_bom` varchar(20) NOT NULL,
  `nama_bahan` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_biaya` bigint(20) NOT NULL,
  `kategori` varchar(11) NOT NULL,
  `file_upload` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `biaya_bahan`
--

INSERT INTO `biaya_bahan` (`id_biaya_bahan`, `id_bom`, `nama_bahan`, `quantity`, `total_biaya`, `kategori`, `file_upload`) VALUES
('BBB-007', 'BOM-004', 'Benang, kain pink', 100, 25000, '114-1', 'Education-Background-Check.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `biaya_overhead`
--

CREATE TABLE `biaya_overhead` (
  `id_biaya_overhead` varchar(20) NOT NULL,
  `nama_overhead` varchar(50) NOT NULL,
  `total_overhead` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `biaya_produksi`
--

CREATE TABLE `biaya_produksi` (
  `id_biaya_produksi` varchar(20) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `biaya_tenaga` bigint(20) NOT NULL,
  `biaya_overhead` int(11) NOT NULL,
  `total_produksi` bigint(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `biaya_tenaga_kerja`
--

CREATE TABLE `biaya_tenaga_kerja` (
  `id_biaya_tenaga` varchar(20) NOT NULL,
  `jenis_tenaga_kerja` varchar(50) NOT NULL,
  `gaji` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bom_baru`
--

CREATE TABLE `bom_baru` (
  `id` int(11) NOT NULL,
  `id_bom` varchar(20) NOT NULL,
  `nama_product` varchar(50) NOT NULL,
  `id_bahan` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `target_produksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bom_baru`
--

INSERT INTO `bom_baru` (`id`, `id_bom`, `nama_product`, `id_bahan`, `quantity`, `target_produksi`) VALUES
(1, 'BOM-001', 'Daster', 'BB-001', 2, 100),
(2, 'BOM-002', 'Celana', 'BB-001', 78, 100),
(3, 'BOM-003', 'Baju', 'BB-002', 3, 100),
(5, 'BOM-002', 'Celana', 'BB-002', 10, 100),
(6, 'BOM-001', 'Daster', 'BB-006', 10, 100),
(7, 'BOM-001', 'Daster', 'BB-005', 30, 100),
(8, 'BOM-004', 'Kereasi Penggaris', 'BB-001', 10, 0),
(9, 'BOM-004', 'Kereasi Penggaris', 'BB-001', 10, 0),
(10, 'BOM-004', 'Kereasi Penggaris', 'BB-003', 8, 0),
(11, 'BOM-004', 'Kereasi Penggaris', 'BB-005', 90, 0),
(12, 'BOM-005', 'Jaket Ungu', 'BB-001', 50, 0),
(13, 'BOM-005', 'Jaket Ungu', 'BB-002', 50, 0),
(14, 'BOM-006', 'kemeja', 'BB-001', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `kode_akun` varchar(11) NOT NULL,
  `nama_akun` varchar(30) NOT NULL,
  `header_akun` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`kode_akun`, `nama_akun`, `header_akun`) VALUES
('111', 'Kas', 1),
('112', 'Bank', 1),
('112-1', 'Mandiri ', 1),
('112-2', 'BCA ', 1),
('112-3', 'BRI', 1),
('113', 'Piutang Usaha', 1),
('114', 'Persediaan Barang Dalam Proses', 1),
('114-1', 'BDP - BBB', 1),
('114-2', 'BDP - BTKL', 1),
('114-3', 'BDP - BOP', 1),
('115', 'Persediaan Barang Dagang', 1),
('115-1', 'Persediaan Barang Jadi', 1),
('116', 'Persediaan Bahan', 1),
('116-1', 'Persediaan Bahan Baku', 1),
('116-2', 'Persediaan Bahan Penolong', 1),
('121', 'Aset Tetap', 1),
('121-1', 'Tanah', 1),
('121-2', 'Bangunan', 1),
('121-3', 'Peralatan Kantor', 1),
('121-4', 'Kendaraan', 1),
('210', 'Utang', 2),
('211', 'Utang Bank', 2),
('211-1', 'Utang Bank Mandiri', 2),
('211-2', 'Utang Bank BCA', 2),
('211-3', 'Utang Bank BRI', 2),
('212', 'Utang Usaha', 2),
('212-1', 'Utang Pembelian Bahan', 2),
('212-2', 'Utang Gaji', 2),
('311', 'Ekuitas', 3),
('311-1', 'Modal', 3),
('311-2', 'Prive ', 3),
('411', 'Penjualan', 4),
('411-1', 'Penjualan', 4),
('411-2', 'Retur Penjualan', 4),
('411-3', 'Potongan penjualan', 4),
('411-4', 'Harga pokok penjualan', 4),
('422', 'Potongan Penjualan', 4),
('511', 'Beban Operasional', 5),
('511-1', 'Beban Air', 5),
('511-2', 'Beban Listrik ', 5),
('511-3', 'Beban Gaji', 5),
('511-4', 'Beban Reparasi Mesin', 5),
('511-5', 'BOP yang dibebankan', 5),
('512', 'Beban Penyusutan', 5),
('512-1', 'Beban Penyusutan Tanah', 5),
('512-2', 'Beban Penyusutan Bangunan', 5),
('512-3', 'Beban Penyusutan Peralatan Kan', 5),
('512-4', 'Beban Penyusutan Kendaraan', 5),
('512-5', 'Beban Pemesanan', 5),
('512-6', 'Beban Penyimpanan', 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(20) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `alamat`, `no_telp`, `email`) VALUES
('PLG001', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', '08214885932', 'dika@gmail.com'),
('PLG002', 'Sandi', 'Jl Kenangan 12', '0832323211', 'sandi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ekspedisi`
--

CREATE TABLE `ekspedisi` (
  `id_ekspedisi` varchar(20) NOT NULL,
  `nama_ekspedisi` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ekspedisi`
--

INSERT INTO `ekspedisi` (`id_ekspedisi`, `nama_ekspedisi`, `no_telp`) VALUES
('EKS001', 'JNE', '08214885932'),
('EKS002', 'J&T', '08214885932');

-- --------------------------------------------------------

--
-- Table structure for table `eoq`
--

CREATE TABLE `eoq` (
  `id_eoq` varchar(20) NOT NULL,
  `id_pembelian` varchar(11) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `biaya_pemesanan` bigint(20) NOT NULL,
  `biaya_penyimpanan` bigint(20) NOT NULL,
  `biaya_bahan` bigint(20) NOT NULL,
  `jmlh_pembelian` int(11) NOT NULL,
  `eoq` int(11) NOT NULL,
  `rop` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `biaya_optimal` bigint(20) NOT NULL,
  `safety_stok` int(11) NOT NULL,
  `jmlh_hari` int(4) NOT NULL,
  `satuan_safety` varchar(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eoq`
--

INSERT INTO `eoq` (`id_eoq`, `id_pembelian`, `nama_bahan`, `biaya_pemesanan`, `biaya_penyimpanan`, `biaya_bahan`, `jmlh_pembelian`, `eoq`, `rop`, `lead_time`, `biaya_optimal`, `safety_stok`, `jmlh_hari`, `satuan_safety`, `status`) VALUES
('EOQ001', 'PBG-001', 'Tali', 5000, 1000, 400, 200, 45, 4, 8, 18000, 100, 30, 'Pcs', 'Diproses'),
('EOQ002', 'PBG-002', 'Pensil', 5000, 2000, 500, 200, 32, 6, 5, 16000, 100, 30, 'Pcs', 'Diproses'),
('EOQ003', 'PBG-003', 'Penggaris', 5000, 1000, 500, 50, 22, 2, 15, 11000, 100, 30, 'Pcs', 'Diproses'),
('EOQ004', 'PBG-004', 'retsleting hitam', 1000, 5000, 5000, 60, 5, 12, 2, 25000, 10, 28, 'pcs', 'Diproses');

-- --------------------------------------------------------

--
-- Table structure for table `gaji_tenaga_kerja`
--

CREATE TABLE `gaji_tenaga_kerja` (
  `id_gaji` varchar(11) NOT NULL,
  `jenis_tenaga_kerja` varchar(20) NOT NULL,
  `total_gaji` int(20) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gaji_tenaga_kerja`
--

INSERT INTO `gaji_tenaga_kerja` (`id_gaji`, `jenis_tenaga_kerja`, `total_gaji`, `tgl_bayar`) VALUES
('GTK-001', 'Penjahit', 500000, '2022-04-11'),
('GTK-002', 'pemasang kancing', 2500000, '2022-05-13'),
('GTK-001', 'Penjahit', 500000, '2022-04-11'),
('GTK-002', 'pemasang kancing', 2500000, '2022-05-13');

-- --------------------------------------------------------

--
-- Table structure for table `good_issue`
--

CREATE TABLE `good_issue` (
  `id_good` varchar(20) NOT NULL,
  `id_permintaan` varchar(11) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tgl_penerimaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `good_issue`
--

INSERT INTO `good_issue` (`id_good`, `id_permintaan`, `nama_bahan`, `quantity`, `harga`, `total`, `tgl_penerimaan`) VALUES
('GI001', 'PB-002', 'Tali', 10, 400, 4000, '2022-03-31'),
('GI002', 'PB-003', 'Pensil', 50, 500, 25000, '2022-04-17'),
('GI003', 'PB-004', 'Tali', 20, 400, 8000, '2022-04-17'),
('GI004', 'PB-005', 'Penggaris', 30, 500, 15000, '2022-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `good_receipt`
--

CREATE TABLE `good_receipt` (
  `id_receipt` varchar(11) NOT NULL,
  `id_pembelian` varchar(11) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `tgl_penerimaan` date NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `good_receipt`
--

INSERT INTO `good_receipt` (`id_receipt`, `id_pembelian`, `nama_vendor`, `tgl_penerimaan`, `nama_bahan`, `quantity`) VALUES
('GR001', 'PMB001', 'Mahmud', '2022-03-30', 'Tali', 200),
('GR002', 'PMB002', 'Mahmud', '2022-04-17', 'Pensil', 200),
('GR003', 'PMB003', 'Mahmud', '2022-04-17', 'Penggaris', 50);

-- --------------------------------------------------------

--
-- Table structure for table `history_bahan_baku`
--

CREATE TABLE `history_bahan_baku` (
  `id` int(11) NOT NULL,
  `id_history_bahan` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bahan_pakai` int(11) NOT NULL,
  `sisa_stock` int(11) NOT NULL,
  `tgl_ambil_stock` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_bahan_baku`
--

INSERT INTO `history_bahan_baku` (`id`, `id_history_bahan`, `nama_bahan`, `quantity`, `bahan_pakai`, `sisa_stock`, `tgl_ambil_stock`) VALUES
(11, 'BB-001', 'Kain', 180, 3, 177, '2022-01-03'),
(12, 'BB-002', 'Benang', 490, 3, 487, '2022-01-03'),
(21, 'BB-003', 'Tali', 10, 3, 7, '2022-04-10'),
(26, 'BB-001', 'Kain', 325, 3, 322, '2022-04-10'),
(27, 'BB-003', 'Tali', 7, 2, 5, '2022-04-10'),
(28, 'BB-004', 'Pensil', 50, 10, 40, '2022-04-17'),
(29, 'BB-005', 'Penggaris', 30, 10, 20, '2022-04-17'),
(30, 'BB-001', 'Kain', 322, 50, 272, '2022-05-13'),
(31, 'BB-002', 'Benang', 557, 50, 507, '2022-05-13'),
(32, 'BB-001', 'Kain', 272, 100, 172, '2022-05-17'),
(33, 'BB-001', 'Kain', 172, 100, 72, '2022-06-07'),
(34, 'BB-002', 'Benang', 507, 100, 407, '2022-06-07'),
(35, 'BB-002', 'Benang', 407, 100, 307, '2022-06-21'),
(36, 'BB-001', 'Kain', 72, 90, -18, '2022-06-21');

--
-- Triggers `history_bahan_baku`
--
DELIMITER $$
CREATE TRIGGER `update_stok_bahan_baku` AFTER INSERT ON `history_bahan_baku` FOR EACH ROW BEGIN
UPDATE bahan_baku 
SET 
quantity = new.sisa_stock
WHERE nama_bahan = new.nama_bahan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_biaya_bahan`
--

CREATE TABLE `history_biaya_bahan` (
  `id` int(11) NOT NULL,
  `id_biaya_bahan` varchar(20) NOT NULL,
  `id_bom` varchar(20) NOT NULL,
  `nama_bahan` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_biaya` bigint(20) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `kategori` varchar(11) NOT NULL,
  `file_upload` varchar(50) NOT NULL,
  `sts_jurnal` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_biaya_bahan`
--

INSERT INTO `history_biaya_bahan` (`id`, `id_biaya_bahan`, `id_bom`, `nama_bahan`, `quantity`, `total_biaya`, `tgl_pembayaran`, `kategori`, `file_upload`, `sts_jurnal`) VALUES
(4, 'BBB-001', 'BOM-001', 'Kain', 200, 100000, '2021-12-17', '', '', 'OK'),
(8, 'BBB-002', 'BOM-005', 'Benang, Kain', 6, 2400, '2022-01-03', '114-1', '', ''),
(16, 'BBB-003', 'BOM-006', 'Kain, Tali', 5, 2300, '2022-04-10', '111', 'IMG_20220305_153926.jpg', ''),
(18, 'BBB-004', 'BOM-006', 'Kain, Tali', 5, 2300, '2022-04-17', '111', 'Wallpaper_1.jpg', ''),
(19, 'BBB-005', 'BOM-006', 'Kain, Tali', 5, 2300, '2022-04-17', '212', 'Wallpaper_2.jpg', ''),
(20, 'BBB-006', 'BOM-008', 'Benang, Kain', 100, 50000, '2022-05-13', '114-1', '1294b45788becfec2cc05a25d0cd7a97.jpg', '');

--
-- Triggers `history_biaya_bahan`
--
DELIMITER $$
CREATE TRIGGER `delete_biaya_bahan` AFTER INSERT ON `history_biaya_bahan` FOR EACH ROW BEGIN
DELETE FROM biaya_bahan WHERE id_biaya_bahan = new.id_biaya_bahan;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_biaya_overhead`
--

CREATE TABLE `history_biaya_overhead` (
  `id` int(11) NOT NULL,
  `id_biaya_overhead` varchar(20) NOT NULL,
  `nama_overhead` varchar(50) NOT NULL,
  `total_overhead` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_biaya_overhead`
--

INSERT INTO `history_biaya_overhead` (`id`, `id_biaya_overhead`, `nama_overhead`, `total_overhead`, `tgl_pembayaran`, `kategori`, `upload_pembayaran`) VALUES
(11, 'BOP-001', 'Belajar', 500000, '2022-04-10', '111', 'Wallpaper.jpg'),
(12, 'BOP-002', 'Belajar', 200000, '2022-05-13', '114-3', '880393.jpg');

--
-- Triggers `history_biaya_overhead`
--
DELIMITER $$
CREATE TRIGGER `delete_biaya_overhead` AFTER INSERT ON `history_biaya_overhead` FOR EACH ROW BEGIN
DELETE FROM biaya_overhead WHERE id_biaya_overhead = new.id_biaya_overhead;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_biaya_produksi`
--

CREATE TABLE `history_biaya_produksi` (
  `id` int(11) NOT NULL,
  `id_biaya_produksi` varchar(20) NOT NULL,
  `tgl_pembayaran_produksi` date NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `biaya_tenaga` bigint(20) NOT NULL,
  `biaya_overhead` int(11) NOT NULL,
  `total_produksi` bigint(20) NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_biaya_produksi`
--

INSERT INTO `history_biaya_produksi` (`id`, `id_biaya_produksi`, `tgl_pembayaran_produksi`, `biaya_bahan`, `biaya_tenaga`, `biaya_overhead`, `total_produksi`, `upload_pembayaran`, `kategori`) VALUES
(3, 'BP-001', '2021-12-17', 100000, 0, 500000, 600000, '', ''),
(5, 'BP-002', '2022-01-03', 2400, 2000000, 100000, 2102400, '', ''),
(8, 'BP-003', '2022-04-17', 100000, 500000, 500000, 1100000, 'Wallpaper_2.jpg', '111'),
(9, 'BP-004', '2022-05-13', 100000, 2500000, 200000, 2800000, '5b80c505d89f67247ac5430964ae239c.jpg', '111');

--
-- Triggers `history_biaya_produksi`
--
DELIMITER $$
CREATE TRIGGER `delete_biaya_produksi` AFTER INSERT ON `history_biaya_produksi` FOR EACH ROW BEGIN
DELETE FROM biaya_produksi WHERE id_biaya_produksi = new.id_biaya_produksi;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_biaya_tenaga`
--

CREATE TABLE `history_biaya_tenaga` (
  `id` int(11) NOT NULL,
  `id_biaya_tenaga` varchar(20) NOT NULL,
  `jenis_kerja` varchar(50) NOT NULL,
  `gaji` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_biaya_tenaga`
--

INSERT INTO `history_biaya_tenaga` (`id`, `id_biaya_tenaga`, `jenis_kerja`, `gaji`, `tgl_bayar`, `kategori`, `upload_pembayaran`) VALUES
(10, 'BTK-001', 'Penjahit', 500000, '2022-04-10', '111', 'Wallpaper.jpg'),
(11, 'BTK-002', 'pemasang kancing', 2500000, '2022-05-13', '114-2', '8f8075124a571e1b61f1b7f3f56188a6.png');

--
-- Triggers `history_biaya_tenaga`
--
DELIMITER $$
CREATE TRIGGER `delete_biaya_tenaga` AFTER INSERT ON `history_biaya_tenaga` FOR EACH ROW BEGIN
DELETE FROM biaya_tenaga_kerja WHERE id_biaya_tenaga = new.id_biaya_tenaga;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_good_issue`
--

CREATE TABLE `history_good_issue` (
  `id` int(11) NOT NULL,
  `id_good` varchar(20) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `harga` int(11) NOT NULL,
  `jmlh` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_terima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_good_issue`
--

INSERT INTO `history_good_issue` (`id`, `id_good`, `nama_vendor`, `tgl_pembelian`, `harga`, `jmlh`, `total`, `keterangan`, `tgl_terima`) VALUES
(1, 'G001', 'Shasa', '2021-12-08', 5000, 20, 100000, 'Baju', '2021-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `history_jadwal`
--

CREATE TABLE `history_jadwal` (
  `id` int(11) NOT NULL,
  `id_jadwal` varchar(20) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `rencana_produksi` int(11) NOT NULL,
  `tgl_selesai` date NOT NULL,
  `waktu_pengerjaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_jadwal`
--

INSERT INTO `history_jadwal` (`id`, `id_jadwal`, `nama_produk`, `rencana_produksi`, `tgl_selesai`, `waktu_pengerjaan`) VALUES
(3, 'JP-001', 'Kain', 200, '2021-12-07', 0),
(4, 'JP-002', 'Kain', 200, '2021-12-17', 0),
(5, 'JP-003', 'Kain', 400, '2022-03-16', 0),
(8, 'JP-004', 'Baju', 200, '2022-04-01', 1),
(9, 'JP-005', 'Baju', 200, '2022-04-10', 10),
(14, 'JP-005', 'Baju', 200, '2022-04-10', 10),
(15, 'JP-006', 'Baju', 200, '2022-04-17', 0),
(16, 'JP-007', 'Kereasi Penggaris', 100, '2022-04-17', 0),
(17, 'JP-008', 'jaket', 50, '2022-05-13', 0),
(18, 'JP-009', 'kemeja', 100, '2022-06-07', 0),
(19, 'JP-010', 'kemeja', 100, '2022-06-11', 1),
(20, 'JP-013', 'Daster', 55, '2022-06-22', 0),
(21, 'JP-016', 'daster', 50, '2022-06-25', 1),
(22, 'JP-017', 'Jaket Ungu', 50, '2022-06-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_op`
--

CREATE TABLE `history_op` (
  `id` int(11) NOT NULL,
  `id_pembayaranop` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_beban` date NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `tot_harga_beban` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis_beban` varchar(50) NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_op`
--

INSERT INTO `history_op` (`id`, `id_pembayaranop`, `keterangan`, `tgl_beban`, `tgl_pembayaran`, `tot_harga_beban`, `kategori`, `jenis_beban`, `bukti_bayar`) VALUES
(19, 'PBO-001', 'Beban Air', '2022-04-22', '2022-04-24', 100000, '', 'Beban Air', 'Wallpaper.jpg'),
(20, 'PBO-002', 'Beban Listrik ', '2022-04-24', '2022-04-25', 500000, '', 'Beban Listrik', 'Wallpaper_1.jpg'),
(21, 'PBO-003', 'Beban Reparasi Mesin', '2022-04-25', '2022-04-25', 800000, '', 'Beban Reparasi', 'Wallpaper_2.jpg');

--
-- Triggers `history_op`
--
DELIMITER $$
CREATE TRIGGER `delete_operasional` AFTER INSERT ON `history_op` FOR EACH ROW BEGIN
DELETE FROM pembayaran_op WHERE id_pembayaranop = new.id_pembayaranop;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_pembelian_aset`
--

CREATE TABLE `history_pembelian_aset` (
  `id` int(11) NOT NULL,
  `id_pembelian_aset` varchar(20) NOT NULL,
  `nama_aset` varchar(50) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `tot_biaya_pembelian` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jmlh_aset` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_pembelian_aset`
--

INSERT INTO `history_pembelian_aset` (`id`, `id_pembelian_aset`, `nama_aset`, `tgl_pembelian`, `nama_toko`, `tgl_pembayaran`, `tot_biaya_pembelian`, `kategori`, `jmlh_aset`, `keterangan`, `bukti_bayar`) VALUES
(9, 'PA-001', 'Tanah', '2021-12-29', 'Jaya Makmur', '2021-12-29', 500000, '121-1', 2, 'Tanah', ''),
(10, 'PA-002', 'Tanah', '2022-01-01', 'Jaya Makmur', '2022-01-08', 500000, '121-1', 0, 'Tanah', ''),
(11, 'PA-003', 'Peralatan Kantor', '2022-01-06', 'Jaya Makmur', '2022-01-09', 50000, '121-3', 0, 'Peralatan Kantor', ''),
(13, 'PA-004', 'Tanah', '2022-04-17', 'PT Jaya Makmur', '2022-04-17', 5000000, '', 0, 'Tanah', 'Wallpaper_2.jpg');

--
-- Triggers `history_pembelian_aset`
--
DELIMITER $$
CREATE TRIGGER `delete_pembelian_aset` AFTER INSERT ON `history_pembelian_aset` FOR EACH ROW BEGIN
DELETE FROM pembelian_aset WHERE id_pembelian_aset = new.id_pembelian_aset;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `history_pembelian_bahan`
--

CREATE TABLE `history_pembelian_bahan` (
  `id` int(11) NOT NULL,
  `id_pembelian` varchar(20) NOT NULL,
  `id_eoq` varchar(11) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `jmlh_pembelian` int(11) NOT NULL,
  `harga_pembelian` bigint(20) NOT NULL,
  `frekuensi` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_pembelian` bigint(20) NOT NULL,
  `tgl_pembayaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_pembelian_bahan`
--

INSERT INTO `history_pembelian_bahan` (`id`, `id_pembelian`, `id_eoq`, `nama_bahan`, `nama_vendor`, `jmlh_pembelian`, `harga_pembelian`, `frekuensi`, `lead_time`, `tgl_pembelian`, `total_pembelian`, `tgl_pembayaran`) VALUES
(19, 'PMB001', 'EOQ001', 'Tali', 'Mahmud', 200, 18000, 4, 8, '2022-03-30', 80000, '2022-03-30'),
(21, 'PMB002', 'EOQ002', 'Pensil', 'Mahmud', 200, 16000, 6, 5, '2022-04-17', 100000, '2022-04-17'),
(22, 'PMB003', 'EOQ003', 'Penggaris', 'Mahmud', 50, 11000, 2, 15, '2022-04-17', 25000, '2022-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `history_penjualan`
--

CREATE TABLE `history_penjualan` (
  `id` int(11) NOT NULL,
  `id_penjualan` varchar(20) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` int(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jmlh_barang` int(11) NOT NULL,
  `nama_merchant` varchar(20) NOT NULL,
  `nama_ekspedisi` varchar(20) NOT NULL,
  `no_resi` varchar(50) NOT NULL,
  `tgl_retur` date NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `tgl_kirim` date NOT NULL,
  `sub_total` bigint(20) NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `harga_ongkir` int(11) NOT NULL,
  `click` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `bukti_bayar` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_penjualan`
--

INSERT INTO `history_penjualan` (`id`, `id_penjualan`, `nama_customer`, `alamat`, `no_telp`, `nama_barang`, `jmlh_barang`, `nama_merchant`, `nama_ekspedisi`, `no_resi`, `tgl_retur`, `tgl_penjualan`, `tgl_kirim`, `sub_total`, `total_harga`, `harga_ongkir`, `click`, `status`, `bukti_bayar`) VALUES
(38, 'PNJ002', 'Sandi', 'Jl Kenangan 12', 832323211, 'Bangku', 1, 'Shopee', 'JNE', '2323123123', '2022-01-09', '2022-01-09', '0000-00-00', 50000, 55000, 5000, 0, 'Terjual', ''),
(39, 'PNJ001', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju, Bangku', 4, 'Shopee', 'JNE', '2323123123', '2022-01-09', '2022-01-09', '0000-00-00', 65000, 70000, 5000, 0, 'Terjual', ''),
(40, 'PNJ003', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju', 3, 'Lazada', 'J&T', '2222222', '2022-01-09', '2022-01-09', '0000-00-00', 15000, 20000, 5000, 0, 'Terjual', ''),
(43, 'PNJ004', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju, Bangku', 20, 'Shopee', 'JNE', '2323123123', '2022-04-15', '0000-00-00', '2022-04-15', 550000, 555000, 5000, 0, 'Retur', 'Wallpaper.jpg'),
(52, 'PNJ005', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju', 30, 'Shopee', 'J&T', '1231231231', '0000-00-00', '2022-04-16', '2022-04-15', 150000, 157000, 7000, 0, 'Terjual', 'Wallpaper_8.jpg'),
(54, 'PNJ006', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju, Bangku', 100, 'Shopee', 'JNE', '2323123123', '0000-00-00', '2022-04-25', '2022-04-25', 5000000, 5005000, 5000, 0, 'Terjual', 'Wallpaper_10.jpg'),
(55, 'PNJ007', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju, Bangku', 30, 'Lazada', 'JNE', '1231231231', '0000-00-00', '2022-04-25', '2022-04-25', 9000000, 9050000, 50000, 0, 'Terjual', 'Wallpaper_11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `history_ut`
--

CREATE TABLE `history_ut` (
  `id` int(11) NOT NULL,
  `id_pembayaranut` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_utang` date NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `tot_harga_utang` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis_utang` varchar(50) NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history_ut`
--

INSERT INTO `history_ut` (`id`, `id_pembayaranut`, `keterangan`, `tgl_utang`, `tgl_pembayaran`, `tot_harga_utang`, `kategori`, `jenis_utang`, `bukti_bayar`) VALUES
(15, 'PU-001', 'Utang Pembelian Bahan', '2022-04-26', '2022-04-26', 3000000, '', 'Utang Pembelian Bahan', 'Wallpaper_2.jpg'),
(16, 'PU-002', 'Utang Gaji', '2022-04-26', '2022-04-26', 5000000, '', 'Utang Gaji', 'Wallpaper_4.jpg'),
(17, 'PU-003', 'Utang Bank BRI', '2022-05-13', '2022-05-13', 123000, '', 'Bank BRI', '2b1dc8312255d248a877953ac8406084.jpg');

--
-- Triggers `history_ut`
--
DELIMITER $$
CREATE TRIGGER `delete_pembayaran_utang` AFTER INSERT ON `history_ut` FOR EACH ROW BEGIN
DELETE FROM pembayaran_ut WHERE id_pembayaranut = new.id_pembayaranut;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_produksi`
--

CREATE TABLE `jadwal_produksi` (
  `id_jadwal` varchar(20) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `id_operation` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `rencana_produksi` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_produksi`
--

INSERT INTO `jadwal_produksi` (`id_jadwal`, `nama_produk`, `id_operation`, `keterangan`, `rencana_produksi`, `tgl_mulai`, `tgl_selesai`) VALUES
('JP-004', 'Baju', '', 'Selesai', 200, '2022-03-31', '2022-04-01'),
('JP-005', 'Baju', '', 'Selesai', 200, '2022-03-31', '2022-04-10'),
('JP-006', 'Baju', '', 'Selesai', 200, '2022-04-17', '2022-04-17'),
('JP-007', 'Kereasi Penggaris', '', 'Selesai', 100, '2022-04-17', '2022-04-17'),
('JP-008', 'jaket', '', 'Selesai', 50, '2022-05-13', '2022-05-13'),
('JP-009', 'kemeja', '', 'Selesai', 100, '2022-06-07', '2022-06-07'),
('JP-010', 'kemeja', '', 'Selesai', 100, '2022-06-10', '2022-06-11'),
('JP-011', 'Celana', '', 'Mulai Produksi', 0, '0000-00-00', '0000-00-00'),
('JP-012', 'Celana', '', 'Mulai Produksi', 50, '0000-00-00', '0000-00-00'),
('JP-013', 'Daster', '', 'Selesai', 55, '2022-06-22', '2022-06-22'),
('JP-014', 'Celana', 'OPL-001', 'Mulai Produksi', 78, '2022-06-30', '0000-00-00'),
('JP-015', 'Daster', 'OPL-002', 'Mulai Produksi', 90, '2022-06-30', '0000-00-00'),
('JP-016', 'daster', 'OPL-003', 'Selesai', 50, '2022-06-24', '2022-06-25'),
('JP-017', 'Jaket Ungu', 'OPL-004', 'Selesai', 50, '2022-06-30', '2022-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_beban`
--

CREATE TABLE `jenis_beban` (
  `id_jen_beban` varchar(20) NOT NULL,
  `jenis_beban` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_beban`
--

INSERT INTO `jenis_beban` (`id_jen_beban`, `jenis_beban`) VALUES
('JBO-01', 'Beban Listrik'),
('JBO-02', 'Beban Air'),
('JBO-03', 'Beban Reparasi');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_penerimaan`
--

CREATE TABLE `jenis_penerimaan` (
  `id_jenis_penerimaan` varchar(20) NOT NULL,
  `jenis_penerimaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_penerimaan`
--

INSERT INTO `jenis_penerimaan` (`id_jenis_penerimaan`, `jenis_penerimaan`) VALUES
('JPK001', 'Pendanaan'),
('JPK002', 'Investasi'),
('JPK003', 'Operasional'),
('JPK004', 'Modal');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_utang`
--

CREATE TABLE `jenis_utang` (
  `id_jen_utang` varchar(20) NOT NULL,
  `jenis_utang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_utang`
--

INSERT INTO `jenis_utang` (`id_jen_utang`, `jenis_utang`) VALUES
('JU-01', 'Usaha'),
('JU-02', 'Bank BRI'),
('JU-03', 'Utang Pembelian Bahan'),
('JU-04', 'Utang Gaji');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_keuangan`
--

CREATE TABLE `jurnal_keuangan` (
  `id_jurnal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id` varchar(100) NOT NULL,
  `kode_akun` varchar(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurnal_keuangan`
--

INSERT INTO `jurnal_keuangan` (`id_jurnal`, `tanggal`, `id`, `kode_akun`, `debet`, `kredit`) VALUES
(1, '2022-04-24', 'BA1', '121-2', 15000000, 0),
(2, '2022-04-24', 'BA1', '111', 0, 15000000),
(3, '2022-04-26', 'MA1', '111', 3000000, 0),
(4, '2022-04-26', 'MA1', '311-1', 0, 3000000),
(5, '2022-04-29', 'PENJ1', '111', 14212000, 0),
(6, '2022-04-29', 'PENJ1', '411', 0, 14212000),
(13, '2022-04-29', 'RET1', '411-2', 555000, 0),
(14, '2022-04-29', 'RET1', '113', 0, 555000),
(15, '2022-04-24', 'UA1', '511-1', 100000, 0),
(16, '2022-04-24', 'UA1', '111', 0, 100000),
(17, '2022-04-25', 'UL1', '511-2', 500000, 0),
(18, '2022-04-25', 'UL1', '111', 0, 500000),
(19, '2022-04-25', 'URM1', '511-4', 800000, 0),
(20, '2022-04-25', 'URM1', '111', 0, 800000),
(21, '2022-04-26', 'UPB1', '212-1', 3000000, 0),
(22, '2022-04-26', 'UPB1', '111', 0, 3000000),
(23, '2022-04-26', 'UG1', '212-2', 5000000, 0),
(24, '2022-04-26', 'UG1', '111', 0, 5000000),
(25, '2022-04-27', 'PRV1', '311-2', 500000, 0),
(26, '2022-04-27', 'PRV1', '111', 0, 500000),
(51, '2022-04-24', 'HPP-PEN', '115-1', 1006900, 0),
(52, '2022-04-24', 'HPP-PEN', '411-4', 0, 1006900),
(53, '2022-05-13', 'HPP-PEN', '115-1', 2750000, 0),
(54, '2022-05-13', 'HPP-PEN', '411-4', 0, 2750000);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_mankas`
--

CREATE TABLE `jurnal_mankas` (
  `id_jurnal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id` varchar(100) NOT NULL,
  `kode_akun` varchar(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurnal_mankas`
--

INSERT INTO `jurnal_mankas` (`id_jurnal`, `tanggal`, `id`, `kode_akun`, `debet`, `kredit`) VALUES
(2, '2022-04-24', 'UA1', '511-1', 100000, 0),
(3, '2022-04-24', 'UA1', '111', 0, 100000),
(4, '2022-04-24', 'BA1', '121-2', 15000000, 0),
(5, '2022-04-24', 'BA1', '111', 0, 15000000),
(6, '2022-04-25', 'UL1', '511-2', 500000, 0),
(7, '2022-04-25', 'UL1', '111', 0, 500000),
(8, '2022-04-25', 'URM1', '511-4', 800000, 0),
(9, '2022-04-25', 'URM1', '111', 0, 800000),
(10, '2022-04-26', 'UPB1', '212-1', 3000000, 0),
(11, '2022-04-26', 'UPB1', '111', 0, 3000000),
(12, '2022-04-26', 'UG1', '212-2', 5000000, 0),
(13, '2022-04-26', 'UG1', '111', 0, 5000000),
(16, '2022-04-27', 'PRV1', '311-2', 500000, 0),
(17, '2022-04-27', 'PRV1', '111', 0, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_pembelian`
--

CREATE TABLE `jurnal_pembelian` (
  `id_jurnal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id` varchar(100) NOT NULL,
  `kode_akun` varchar(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurnal_pembelian`
--

INSERT INTO `jurnal_pembelian` (`id_jurnal`, `tanggal`, `id`, `kode_akun`, `debet`, `kredit`) VALUES
(1, '2022-04-27', 'PBB1', '116-1', 125000, 0),
(2, '2022-04-27', 'PBB1', '210', 0, 125000),
(5, '2022-04-27', 'BPEM1', '512-5', 1250000, 0),
(6, '2022-04-27', 'BPEM1', '111', 0, 1250000),
(7, '2022-04-27', 'BPNY1', '512-6', 450000, 0),
(8, '2022-04-27', 'BPNY1', '111', 0, 450000);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_penerimaan`
--

CREATE TABLE `jurnal_penerimaan` (
  `id_jurnal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id` varchar(100) NOT NULL,
  `kode_akun` varchar(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurnal_penerimaan`
--

INSERT INTO `jurnal_penerimaan` (`id_jurnal`, `tanggal`, `id`, `kode_akun`, `debet`, `kredit`) VALUES
(1, '2022-04-26', 'MA1', '311-1', 3000000, 0),
(2, '2022-04-26', 'MA1', '111', 0, 3000000),
(3, '2022-04-28', 'PENJ1', '111', 14212000, 0),
(4, '2022-04-28', 'PENJ1', '411', 0, 14212000);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_produksi`
--

CREATE TABLE `jurnal_produksi` (
  `id_jurnal` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id` varchar(100) NOT NULL,
  `kode_akun` varchar(11) NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurnal_produksi`
--

INSERT INTO `jurnal_produksi` (`id_jurnal`, `tanggal`, `id`, `kode_akun`, `debet`, `kredit`) VALUES
(21, '2022-04-24', 'BDP1', '115-1', 1006900, 0),
(22, '2022-04-24', 'BDP1', '114-1', 0, 6900),
(23, '2022-04-24', 'BDP1', '114-2', 0, 500000),
(24, '2022-04-24', 'BDP1', '114-3', 0, 500000),
(25, '2022-04-24', 'HPP-PEN', '411-4', 1006900, 0),
(26, '2022-04-24', 'HPP-PEN', '115-1', 0, 1006900),
(28, '2022-04-24', 'UA1', '511-1', 100000, 0),
(29, '2022-04-24', 'UA1', '210', 0, 100000),
(32, '2022-04-25', 'PENJ1', '111', 14212000, 0),
(33, '2022-04-25', 'PENJ1', '411', 0, 14212000),
(34, '2022-04-25', 'UL1', '511-2', 500000, 0),
(35, '2022-04-25', 'UL1', '210', 0, 500000),
(36, '2022-04-25', 'URM1', '511-4', 800000, 0),
(37, '2022-04-25', 'URM1', '210', 0, 800000),
(52, '2022-05-13', 'BDP1', '115-1', 2750000, 0),
(53, '2022-05-13', 'BDP1', '114-1', 0, 50000),
(54, '2022-05-13', 'BDP1', '114-2', 0, 2500000),
(55, '2022-05-13', 'BDP1', '114-3', 0, 200000),
(56, '2022-05-13', 'HPP-PEN', '411-4', 2750000, 0),
(57, '2022-05-13', 'HPP-PEN', '115-1', 0, 2750000);

-- --------------------------------------------------------

--
-- Table structure for table `login_activity`
--

CREATE TABLE `login_activity` (
  `id_login` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_activity`
--

INSERT INTO `login_activity` (`id_login`, `id_user`, `login_time`, `logout_time`) VALUES
(1, 1, '2021-09-15 03:11:02', '0000-00-00 00:00:00'),
(2, 1, '2021-09-15 03:14:09', '0000-00-00 00:00:00'),
(3, 1, '2021-09-15 03:15:52', '0000-00-00 00:00:00'),
(4, 1, '2021-09-15 03:19:39', '0000-00-00 00:00:00'),
(5, 1, '2021-09-15 03:21:47', '0000-00-00 00:00:00'),
(6, 1, '2021-09-15 03:26:02', '0000-00-00 00:00:00'),
(7, 1, '2021-09-15 03:28:21', '0000-00-00 00:00:00'),
(8, 1, '2021-09-15 03:30:51', '0000-00-00 00:00:00'),
(9, 1, '2021-09-15 03:34:21', '0000-00-00 00:00:00'),
(10, 1, '2021-09-15 03:48:50', '0000-00-00 00:00:00'),
(11, 1, '2021-09-15 03:51:45', '2021-09-15 03:52:04'),
(12, 1, '2021-09-15 03:52:11', '2021-09-15 03:54:01'),
(13, 1, '2021-09-15 03:54:07', '0000-00-00 00:00:00'),
(14, 1, '2021-09-16 03:33:39', '2021-09-16 05:55:54'),
(15, 1, '2021-09-16 05:58:21', '0000-00-00 00:00:00'),
(16, 1, '2021-09-17 02:32:41', '2021-09-17 03:19:55'),
(17, 1, '2021-09-17 03:21:40', '2021-09-17 05:06:10'),
(18, 1, '2021-09-17 05:06:15', '2021-09-17 05:19:31'),
(19, 1, '2021-09-17 05:19:40', '0000-00-00 00:00:00'),
(20, 5, '2021-09-17 10:42:59', '0000-00-00 00:00:00'),
(21, 6, '2021-09-17 10:56:46', '0000-00-00 00:00:00'),
(22, 1, '2021-09-19 12:19:30', '2021-09-19 12:36:49'),
(23, 1, '2021-09-19 12:36:57', '2021-09-19 12:39:02'),
(24, 1, '2021-09-19 12:39:08', '0000-00-00 00:00:00'),
(25, 1, '2021-09-19 12:39:30', '0000-00-00 00:00:00'),
(26, 1, '2021-09-19 06:39:52', '0000-00-00 00:00:00'),
(27, 1, '2021-09-19 03:03:12', '2021-09-19 03:29:29'),
(28, 1, '2021-09-19 03:29:37', '0000-00-00 00:00:00'),
(29, 1, '2021-09-20 11:49:30', '0000-00-00 00:00:00'),
(30, 1, '2021-09-21 02:06:10', '0000-00-00 00:00:00'),
(31, 1, '2021-09-22 02:30:04', '0000-00-00 00:00:00'),
(32, 1, '2021-09-23 06:27:53', '0000-00-00 00:00:00'),
(33, 1, '2021-09-23 03:18:28', '2021-09-23 03:23:29'),
(34, 1, '2021-09-23 03:24:15', '2021-09-23 04:53:57'),
(35, 1, '2021-09-23 04:54:18', '0000-00-00 00:00:00'),
(36, 1, '2021-09-23 08:45:15', '0000-00-00 00:00:00'),
(37, 1, '2021-09-23 09:01:25', '0000-00-00 00:00:00'),
(38, 1, '2021-09-23 09:14:03', '0000-00-00 00:00:00'),
(39, 1, '2021-09-23 09:17:21', '0000-00-00 00:00:00'),
(40, 1, '2021-09-23 09:19:44', '2021-09-23 10:33:52'),
(41, 1, '2021-09-23 10:36:37', '2021-09-24 12:09:42'),
(42, 1, '2021-09-24 12:09:54', '2021-09-24 12:19:36'),
(43, 1, '2021-09-24 12:25:08', '2021-09-24 12:25:54'),
(44, 1, '2021-09-24 12:26:45', '0000-00-00 00:00:00'),
(45, 1, '2021-09-24 12:26:54', '0000-00-00 00:00:00'),
(46, 1, '2021-09-24 12:29:33', '2021-09-24 12:29:43'),
(47, 1, '2021-09-24 01:13:49', '2021-09-24 01:26:06'),
(48, 1, '2021-09-24 05:16:44', '2021-09-24 05:53:08'),
(49, 1, '2021-09-24 05:53:14', '0000-00-00 00:00:00'),
(50, 1, '2021-09-24 07:40:25', '2021-09-24 08:58:35'),
(51, 1, '2021-09-24 08:58:42', '2021-09-24 08:58:52'),
(52, 6, '2021-09-24 08:59:00', '2021-09-24 09:19:06'),
(53, 1, '2021-09-24 09:19:13', '0000-00-00 00:00:00'),
(54, 1, '2021-09-24 09:19:44', '0000-00-00 00:00:00'),
(55, 6, '2021-09-24 10:44:24', '2021-09-24 10:45:06'),
(56, 6, '2021-09-25 12:45:23', '2021-09-25 12:50:58'),
(57, 1, '2021-09-25 12:51:04', '2021-09-25 01:11:00'),
(58, 1, '2021-09-28 06:28:25', '2021-09-28 06:43:37'),
(59, 1, '2021-09-28 06:50:01', '2021-09-28 06:50:04'),
(60, 1, '2021-09-28 06:59:15', '2021-09-28 06:59:19'),
(61, 1, '2021-09-28 07:00:15', '2021-09-28 07:00:50'),
(62, 1, '2021-09-28 02:36:33', '0000-00-00 00:00:00'),
(63, 1, '2021-09-28 02:36:41', '0000-00-00 00:00:00'),
(64, 1, '2021-09-28 02:37:42', '0000-00-00 00:00:00'),
(65, 1, '2021-09-28 03:01:15', '0000-00-00 00:00:00'),
(66, 1, '2021-09-28 03:01:34', '2021-09-28 03:10:25'),
(67, 1, '2021-09-28 03:10:35', '2021-09-28 03:10:42'),
(68, 1, '2021-09-28 03:15:34', '2021-09-28 03:15:49'),
(69, 1, '2021-09-28 03:17:22', '0000-00-00 00:00:00'),
(70, 1, '2021-10-01 01:37:35', '0000-00-00 00:00:00'),
(71, 1, '2021-10-01 04:30:49', '0000-00-00 00:00:00'),
(72, 1, '2021-10-01 07:21:23', '0000-00-00 00:00:00'),
(73, 6, '2021-10-02 03:09:13', '2021-10-02 03:11:07'),
(74, 6, '2021-10-02 03:11:44', '2021-10-02 03:12:40'),
(75, 6, '2021-10-02 03:13:58', '0000-00-00 00:00:00'),
(76, 1, '2021-10-06 01:57:03', '0000-00-00 00:00:00'),
(77, 1, '2021-10-06 03:51:30', '0000-00-00 00:00:00'),
(78, 1, '2021-10-07 01:47:55', '0000-00-00 00:00:00'),
(79, 1, '2021-10-08 05:31:06', '2021-10-08 07:21:12'),
(80, 1, '2021-10-08 07:21:16', '2021-10-08 07:21:21'),
(81, 6, '2021-10-08 07:21:34', '0000-00-00 00:00:00'),
(82, 1, '2021-10-08 02:33:38', '2021-10-08 04:39:22'),
(83, 1, '2021-10-08 04:39:48', '0000-00-00 00:00:00'),
(84, 6, '2021-10-09 12:44:16', '0000-00-00 00:00:00'),
(85, 1, '2021-10-11 06:42:03', '0000-00-00 00:00:00'),
(86, 1, '2021-11-10 11:33:56', '2021-11-10 11:34:12'),
(87, 1, '2021-11-11 12:02:39', '0000-00-00 00:00:00'),
(88, 7, '2021-11-15 02:18:17', '2021-11-15 02:18:32'),
(89, 7, '2021-11-15 03:31:37', '2021-11-15 03:31:43'),
(90, 1, '2021-11-15 03:34:31', '2021-11-15 03:34:34'),
(91, 1, '2021-11-15 04:07:27', '2021-11-15 04:25:37'),
(92, 1, '2021-11-15 04:31:23', '0000-00-00 00:00:00'),
(93, 1, '2021-11-18 01:13:28', '2021-11-18 01:16:20'),
(94, 1, '2021-11-18 01:16:26', '2021-11-18 01:19:44'),
(95, 2, '2021-11-18 01:20:19', '2021-11-18 01:24:25'),
(96, 2, '2021-11-18 01:24:33', '2021-11-18 01:24:37'),
(97, 1, '2021-11-18 01:24:44', '2021-11-18 01:25:20'),
(98, 2, '2021-11-18 01:25:32', '2021-11-18 01:29:49'),
(99, 1, '2021-11-18 01:29:54', '0000-00-00 00:00:00'),
(100, 1, '2021-11-23 12:18:51', '0000-00-00 00:00:00'),
(101, 1, '2021-11-23 12:48:19', '0000-00-00 00:00:00'),
(102, 1, '2021-11-23 11:25:05', '2021-11-23 12:02:58'),
(103, 1, '2021-11-23 12:09:01', '0000-00-00 00:00:00'),
(104, 1, '2021-11-23 12:18:10', '0000-00-00 00:00:00'),
(105, 2, '2021-11-23 12:18:43', '0000-00-00 00:00:00'),
(106, 1, '2021-11-23 12:20:20', '0000-00-00 00:00:00'),
(107, 1, '2021-11-23 12:21:12', '0000-00-00 00:00:00'),
(108, 1, '2021-11-23 12:23:07', '0000-00-00 00:00:00'),
(109, 1, '2021-11-23 12:24:32', '0000-00-00 00:00:00'),
(110, 1, '2021-11-23 12:24:57', '2021-11-23 12:27:05'),
(111, 1, '2021-11-23 12:27:12', '2021-11-23 12:33:14'),
(112, 2, '2021-11-23 12:33:23', '0000-00-00 00:00:00'),
(113, 2, '2021-11-23 12:33:59', '0000-00-00 00:00:00'),
(114, 1, '2021-11-23 12:34:36', '2021-11-23 02:26:18'),
(115, 1, '2021-11-23 02:27:30', '0000-00-00 00:00:00'),
(116, 1, '2021-11-23 10:09:13', '0000-00-00 00:00:00'),
(117, 1, '2021-11-25 12:40:56', '2021-11-25 12:44:00'),
(118, 1, '2021-11-25 12:45:06', '0000-00-00 00:00:00'),
(119, 1, '2021-11-26 12:32:42', '2021-11-26 12:35:53'),
(120, 1, '2021-11-26 01:15:58', '0000-00-00 00:00:00'),
(121, 2, '2021-11-26 01:20:54', '2021-11-26 01:37:24'),
(122, 1, '2021-11-26 01:37:37', '2021-11-26 01:38:25'),
(123, 4, '2021-11-26 01:39:53', '2021-11-26 03:16:45'),
(124, 3, '2021-11-26 03:16:52', '2021-11-26 03:17:28'),
(125, 6, '2021-11-26 03:29:29', '0000-00-00 00:00:00'),
(126, 1, '2021-11-26 03:51:07', '0000-00-00 00:00:00'),
(127, 1, '2021-11-26 03:52:36', '0000-00-00 00:00:00'),
(128, 1, '2021-11-26 03:53:37', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `merchant`
--

CREATE TABLE `merchant` (
  `id_merchant` varchar(20) NOT NULL,
  `nama_merchant` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merchant`
--

INSERT INTO `merchant` (`id_merchant`, `nama_merchant`, `no_telp`) VALUES
('MRC001', 'Shopee', '08214885922'),
('MRC002', 'Lazada', '08214885922'),
('MRC003', 'Tokopedia', '08214885922');

-- --------------------------------------------------------

--
-- Table structure for table `operasional`
--

CREATE TABLE `operasional` (
  `kode_operasional` varchar(20) NOT NULL,
  `tgl_operasional` date NOT NULL,
  `jenis_operasional` varchar(20) NOT NULL,
  `ket_operasional` text NOT NULL,
  `nominal_operasional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operasional`
--

INSERT INTO `operasional` (`kode_operasional`, `tgl_operasional`, `jenis_operasional`, `ket_operasional`, `nominal_operasional`) VALUES
('OP1123', '2021-11-23', 'Kendaraan', 'isi', 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `operation_list`
--

CREATE TABLE `operation_list` (
  `id` int(11) NOT NULL,
  `id_operation` varchar(50) NOT NULL,
  `id_tenaga_kerja` varchar(20) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tarif` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operation_list`
--

INSERT INTO `operation_list` (`id`, `id_operation`, `id_tenaga_kerja`, `nama_produk`, `quantity`, `tarif`) VALUES
(1, 'OPL-001', 'TK-001', 'Celana', 50, 100000),
(2, 'OPL-001', 'TK-001', 'Celana', 50, 200000),
(4, 'OPL-002', 'TK-002', 'Celana', 68, 100000),
(6, 'OPL-002', 'TK-002', 'Celana', 68, 50000),
(7, 'OPL-003', 'TK-003', 'daster', 50, 100000),
(8, 'OPL-004', 'TK-001', 'Jaket Ungu', 50, 0),
(9, 'OPL-004', 'TK-001', 'Jaket Ungu', 50, 0),
(10, 'OPL-004', 'TK-001', 'Jaket Ungu', 50, 0),
(11, 'OPL-004', 'TK-003', 'Jaket Ungu', 50, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `opl_baru`
--

CREATE TABLE `opl_baru` (
  `id` int(11) NOT NULL,
  `id_operation` varchar(20) NOT NULL,
  `jenis_tenaga_kerja` varchar(50) NOT NULL,
  `produk_jadi` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opl_baru`
--

INSERT INTO `opl_baru` (`id`, `id_operation`, `jenis_tenaga_kerja`, `produk_jadi`, `quantity`) VALUES
(1, 'OPL-001', 'Pengrajin', 'kemeja', 66),
(2, 'OPL-002', 'Penjahit', 'jaket', 55),
(3, 'OPL-001', 'Pengrajin', 'kemeja', 66);

-- --------------------------------------------------------

--
-- Table structure for table `overhead`
--

CREATE TABLE `overhead` (
  `id_overhead` varchar(20) NOT NULL,
  `nama_overhead` varchar(50) NOT NULL,
  `tgl_overhead` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `overhead`
--

INSERT INTO `overhead` (`id_overhead`, `nama_overhead`, `tgl_overhead`) VALUES
('OP-001', 'Belajar', '2022-04-10'),
('OP-002', 'Studi', '2022-04-17'),
('OP-003', 'Overhead Pabrik', '2022-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_op`
--

CREATE TABLE `pembayaran_op` (
  `id_pembayaranop` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_beban` date NOT NULL,
  `tot_harga_beban` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jenis_beban` varchar(50) NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_ut`
--

CREATE TABLE `pembayaran_ut` (
  `id_pembayaranut` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `tgl_utang` date NOT NULL,
  `tot_harga_utang` int(11) NOT NULL,
  `jenis_utang` varchar(50) NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_aset`
--

CREATE TABLE `pembelian_aset` (
  `id_pembelian_aset` varchar(20) NOT NULL,
  `nama_aset` varchar(50) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `tot_biaya_pembelian` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `jmlh_aset` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_aset`
--

INSERT INTO `pembelian_aset` (`id_pembelian_aset`, `nama_aset`, `tgl_pembelian`, `nama_toko`, `tot_biaya_pembelian`, `kategori`, `jmlh_aset`, `keterangan`, `bukti_bayar`) VALUES
('PA-005', 'Bangunan', '2022-04-19', 'PT Jaya Makmur', 15000000, '', 0, 'Bangunan', 'Wallpaper_5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_bahan`
--

CREATE TABLE `pembelian_bahan` (
  `id_pembelian` varchar(20) NOT NULL,
  `id_eoq` varchar(11) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `jmlh_pembelian` int(11) NOT NULL,
  `harga_pembelian` bigint(20) NOT NULL,
  `frekuensi` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_pembelian` bigint(20) NOT NULL,
  `tgl_click` date NOT NULL,
  `tgl_clickafter` date NOT NULL,
  `jmlh_click` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_bahan`
--

INSERT INTO `pembelian_bahan` (`id_pembelian`, `id_eoq`, `nama_bahan`, `nama_vendor`, `jmlh_pembelian`, `harga_pembelian`, `frekuensi`, `lead_time`, `tgl_pembelian`, `total_pembelian`, `tgl_click`, `tgl_clickafter`, `jmlh_click`) VALUES
('PMB001', 'EOQ001', 'Tali', 'Mahmud', 200, 18000, 4, 8, '2022-03-30', 80000, '2022-03-30', '2022-04-07', 2),
('PMB002', 'EOQ002', 'Pensil', 'Mahmud', 200, 16000, 6, 5, '2022-04-17', 100000, '2022-04-17', '2022-05-01', 1),
('PMB003', 'EOQ003', 'Penggaris', 'Mahmud', 50, 11000, 2, 15, '2022-04-17', 25000, '2022-04-17', '2022-05-02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_gudang`
--

CREATE TABLE `pembelian_gudang` (
  `id_pembelian` varchar(10) NOT NULL,
  `nama_bahan` varchar(20) NOT NULL,
  `jmlh_pembelian` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `biaya_pemesanan` int(11) NOT NULL,
  `biaya_penyimpanan` int(11) NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `safety_stok` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_gudang`
--

INSERT INTO `pembelian_gudang` (`id_pembelian`, `nama_bahan`, `jmlh_pembelian`, `tgl_pembelian`, `satuan`, `biaya_pemesanan`, `biaya_penyimpanan`, `biaya_bahan`, `safety_stok`, `status`) VALUES
('PBG-001', 'Tali', 200, '2022-03-29', 'Meter', 5000, 1000, 400, 100, 'Selesai'),
('PBG-002', 'Pensil', 200, '2022-04-17', 'Buah', 5000, 2000, 500, 100, 'Selesai'),
('PBG-003', 'Penggaris', 50, '2022-04-17', 'Buah', 5000, 1000, 500, 100, 'Selesai'),
('PBG-004', 'retsleting hitam', 60, '2022-06-18', 'pcs', 1000, 5000, 5000, 10, 'Sedang Proses');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian_permintaan_bahan`
--

CREATE TABLE `pembelian_permintaan_bahan` (
  `id_permintaan` varchar(20) NOT NULL,
  `nama_bahan` varchar(20) NOT NULL,
  `jmlh_permintaan` int(11) NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembelian_permintaan_bahan`
--

INSERT INTO `pembelian_permintaan_bahan` (`id_permintaan`, `nama_bahan`, `jmlh_permintaan`, `biaya_bahan`, `status`, `tgl_permintaan`, `satuan`) VALUES
('PB002', 'Kain', 100, 500000, 'Menunggu Diterima', '2021-12-08', 'meter'),
('PB003', 'Benang', 10, 50000, 'Menunggu Diterima', '2021-12-08', 'meter');

-- --------------------------------------------------------

--
-- Table structure for table `penerimaan_kas`
--

CREATE TABLE `penerimaan_kas` (
  `id_penerimaan` varchar(20) NOT NULL,
  `tgl_penerimaan` date NOT NULL,
  `jenis_penerimaan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerimaan_kas`
--

INSERT INTO `penerimaan_kas` (`id_penerimaan`, `tgl_penerimaan`, `jenis_penerimaan`, `keterangan`, `total`, `kategori`) VALUES
('PMK001', '2021-12-23', 'Pendanaan', 'Beli Es Buah', 100000, 'Pembelian'),
('PMK002', '2022-04-26', 'Modal', '', 3000000, 'Modal');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `id_penjualan` varchar(20) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` int(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jmlh_barang` int(11) NOT NULL,
  `nama_merchant` varchar(20) NOT NULL,
  `nama_ekspedisi` varchar(20) NOT NULL,
  `no_resi` varchar(50) NOT NULL,
  `tgl_retur` date NOT NULL,
  `tgl_kirim` date NOT NULL,
  `total_harga` bigint(20) NOT NULL,
  `harga_ongkir` int(11) NOT NULL,
  `click` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `id_penjualan`, `nama_customer`, `alamat`, `no_telp`, `nama_barang`, `jmlh_barang`, `nama_merchant`, `nama_ekspedisi`, `no_resi`, `tgl_retur`, `tgl_kirim`, `total_harga`, `harga_ongkir`, `click`) VALUES
(31, 'PNJ001', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju', 3, 'Shopee', 'JNE', '2323123123', '2022-01-09', '0000-00-00', 15000, 5000, 1),
(32, 'PNJ001', '', '', 0, 'Bangku', 1, '', '', '2323123123', '0000-00-00', '0000-00-00', 50000, 0, 1),
(33, 'PNJ002', 'Sandi', 'Jl Kenangan 12', 832323211, 'Bangku', 1, 'Shopee', 'JNE', '2323123123', '2022-01-09', '0000-00-00', 50000, 5000, 1),
(34, 'PNJ003', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju', 3, 'Lazada', 'J&T', '2222222', '2022-01-09', '0000-00-00', 15000, 5000, 1),
(36, 'PNJ004', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju', 10, 'Shopee', 'JNE', '2323123123', '2022-04-12', '2022-04-15', 50000, 5000, 1),
(49, 'PNJ004', '', '', 0, 'Bangku', 10, 'Shopee', '', '2323123123', '0000-00-00', '2022-04-15', 500000, 0, 1),
(50, 'PNJ005', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju', 20, 'Shopee', 'J&T', '1231231231', '0000-00-00', '2022-04-15', 100000, 7000, 1),
(51, 'PNJ005', '', '', 0, 'Baju', 10, 'Lazada', '', '1231231231', '0000-00-00', '2022-04-15', 50000, 0, 1),
(52, 'PNJ006', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Bangku', 50, 'Shopee', 'JNE', '2323123123', '0000-00-00', '2022-04-25', 2500000, 5000, 1),
(53, 'PNJ006', '', '', 0, 'Baju', 50, 'Shopee', '', '2323123123', '0000-00-00', '2022-04-25', 2500000, 0, 1),
(55, 'PNJ007', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Bangku', 20, 'Lazada', 'JNE', '1231231231', '0000-00-00', '2022-04-25', 8000000, 50000, 1),
(56, 'PNJ007', '', '', 0, 'Baju', 10, 'Lazada', '', '1231231231', '0000-00-00', '2022-04-25', 1000000, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penyusutan_aset`
--

CREATE TABLE `penyusutan_aset` (
  `id_penyusutan` varchar(20) NOT NULL,
  `id_aset` varchar(11) NOT NULL,
  `nama_aset` varchar(30) NOT NULL,
  `tot_harga` bigint(20) NOT NULL,
  `umr_ekonomis` int(11) NOT NULL,
  `nilai_pen` int(11) NOT NULL,
  `nilai_sisa` int(11) NOT NULL,
  `tgl_penyusutan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyusutan_aset`
--

INSERT INTO `penyusutan_aset` (`id_penyusutan`, `id_aset`, `nama_aset`, `tot_harga`, `umr_ekonomis`, `nilai_pen`, `nilai_sisa`, `tgl_penyusutan`) VALUES
('PNA-001', 'A-01', 'Bangunan', 2000000, 2, 500000, 1000000, '2022-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `perhitungan_costing`
--

CREATE TABLE `perhitungan_costing` (
  `id_costing` int(11) NOT NULL,
  `b_bahan_baku` int(11) NOT NULL,
  `b_admin_umum` int(11) NOT NULL,
  `gaji` int(11) NOT NULL,
  `orang` int(11) NOT NULL,
  `b_pemasaran` int(11) NOT NULL,
  `b_overhead` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perhitungan_costing`
--

INSERT INTO `perhitungan_costing` (`id_costing`, `b_bahan_baku`, `b_admin_umum`, `gaji`, `orang`, `b_pemasaran`, `b_overhead`) VALUES
(1, 0, 100000, 500000, 10, 200000, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_bahan`
--

CREATE TABLE `permintaan_bahan` (
  `id_permintaan` varchar(10) NOT NULL,
  `nama_bahan` varchar(20) NOT NULL,
  `jmlh_permintaan` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_bahan`
--

INSERT INTO `permintaan_bahan` (`id_permintaan`, `nama_bahan`, `jmlh_permintaan`, `status`, `tgl_permintaan`, `satuan`) VALUES
('PB-001', 'Benang', 10, 'Diterima', '2022-03-27', 'Meter'),
('PB-002', 'Tali', 10, 'Diterima', '2022-03-29', 'Meter'),
('PB-003', 'Pensil', 50, 'Diterima', '2022-04-17', 'Buah'),
('PB-004', 'Tali', 20, 'Diterima', '2022-04-17', 'Meter'),
('PB-005', 'Penggaris', 30, 'Diterima', '2022-04-17', 'Buah'),
('PB-006', 'retsleting hitam', 50, 'Menunggu Diterima', '2022-06-18', 'pcs');

--
-- Triggers `permintaan_bahan`
--
DELIMITER $$
CREATE TRIGGER `insert_permintaan_gudang` AFTER INSERT ON `permintaan_bahan` FOR EACH ROW BEGIN
 IF new.nama_bahan IS NOT NULL THEN
INSERT INTO permintaan_gudang(id_permintaan, nama_bahan,jmlh_permintaan,tgl_permintaan,status,satuan)
VALUES (new.id_permintaan,new.nama_bahan,new.jmlh_permintaan,
        new.tgl_permintaan,new.status,new.satuan); 
 END IF;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang`
--

CREATE TABLE `permintaan_barang` (
  `id_permintaan` int(11) NOT NULL,
  `jmlh_brg_dibutuhkan` int(11) NOT NULL,
  `b_pemesanan` int(11) NOT NULL,
  `b_penyimpanan` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `pem_min` int(11) NOT NULL,
  `pem_maks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_barang`
--

INSERT INTO `permintaan_barang` (`id_permintaan`, `jmlh_brg_dibutuhkan`, `b_pemesanan`, `b_penyimpanan`, `lead_time`, `pem_min`, `pem_maks`) VALUES
(1, 10, 20000, 10000, 5, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_gudang`
--

CREATE TABLE `permintaan_gudang` (
  `id_permintaan` varchar(10) NOT NULL,
  `nama_bahan` varchar(20) NOT NULL,
  `jmlh_permintaan` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `safety_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permintaan_gudang`
--

INSERT INTO `permintaan_gudang` (`id_permintaan`, `nama_bahan`, `jmlh_permintaan`, `tgl_permintaan`, `satuan`, `status`, `biaya_bahan`, `safety_stok`) VALUES
('PB-001', 'Benang', 10, '2022-03-27', 'Meter', 'Diterima', 500, 0),
('PB-002', 'Tali', 10, '2022-03-29', 'Meter', 'Diterima', 400, 0),
('PB-003', 'Pensil', 50, '2022-04-17', 'Buah', 'Diterima', 500, 0),
('PB-004', 'Tali', 20, '2022-04-17', 'Meter', 'Diterima', 400, 0),
('PB-005', 'Penggaris', 30, '2022-04-17', 'Buah', 'Diterima', 500, 0),
('PB-006', 'retsleting hitam', 50, '2022-06-18', 'pcs', 'Menunggu Diterima', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `persediaan_barang`
--

CREATE TABLE `persediaan_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_produksi` int(11) NOT NULL,
  `jmlh_bahan_baku` int(11) NOT NULL,
  `tgl_stock` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `persediaan_barang`
--

INSERT INTO `persediaan_barang` (`id_barang`, `nama_barang`, `harga_produksi`, `jmlh_bahan_baku`, `tgl_stock`) VALUES
(1, 'Bangku', 50000, 20, '2021-10-08'),
(2, 'kursi', 20000, 10, '2021-10-08'),
(3, 'Meja', 2000, 5, '2021-10-09'),
(4, 'Lemari', 50000, 6, '2021-10-09');

-- --------------------------------------------------------

--
-- Table structure for table `prive`
--

CREATE TABLE `prive` (
  `id_prive` varchar(20) NOT NULL,
  `tgl_prive` date NOT NULL,
  `jmlh_prive` int(11) NOT NULL,
  `keterangan` varchar(40) NOT NULL,
  `bukti_bayar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prive`
--

INSERT INTO `prive` (`id_prive`, `tgl_prive`, `jmlh_prive`, `keterangan`, `bukti_bayar`) VALUES
('PR-001', '2021-12-29', 500000, 'Biaya Hidup', ''),
('PR-002', '2022-01-07', 100000, 'Biaya Hidup', ''),
('PR-003', '2022-04-17', 500000, 'Prive ', 'Wallpaper_1.jpg');

--
-- Triggers `prive`
--
DELIMITER $$
CREATE TRIGGER `update_harga_prive` AFTER UPDATE ON `prive` FOR EACH ROW BEGIN
IF new.jmlh_prive IS NOT NULL THEN
UPDATE jurnal
SET
debet=new.jmlh_prive
WHERE id=new.id_prive AND jurnal.kode_akun = "311-2";
UPDATE jurnal
SET
kredit=new.jmlh_prive
WHERE id=new.id_prive AND jurnal.kode_akun ="111";
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `production_details`
--

CREATE TABLE `production_details` (
  `id` int(11) NOT NULL,
  `id_bom` varchar(20) NOT NULL,
  `id_operation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `production_details`
--

INSERT INTO `production_details` (`id`, `id_bom`, `id_operation`) VALUES
(7, 'BOM-002', 'OPL-001'),
(8, 'BOM-001', 'OPL-002'),
(16, 'BOM-003', 'OPL-001'),
(18, 'BOM-004', 'OPL-003');

-- --------------------------------------------------------

--
-- Table structure for table `produk_jadi`
--

CREATE TABLE `produk_jadi` (
  `id_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `tgl_mulai` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `waktu_pengerjaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_jadi`
--

INSERT INTO `produk_jadi` (`id_produk`, `nama_produk`, `stock`, `tgl_mulai`, `tgl_selesai`, `waktu_pengerjaan`) VALUES
('PJ-001', 'Baju', 20, '0000-00-00', '0000-00-00', 0),
('PJ-002', 'Baju', 200, '2022-03-31', '2022-04-10', 10),
('PJ-003', 'Baju', 200, '2022-03-31', '2022-04-10', 10),
('PJ-004', 'Baju', 200, '2022-04-17', '2022-04-17', 0),
('PJ-005', 'Kereasi Penggaris', 100, '2022-04-17', '2022-04-17', 0),
('PJ-006', 'jaket', 50, '2022-05-13', '2022-05-13', 0),
('PJ-007', 'kemeja', 100, '2022-06-07', '2022-06-07', 0),
('PJ-008', 'kemeja', 100, '2022-06-10', '2022-06-11', 1),
('PJ-009', 'Daster', 55, '2022-06-22', '2022-06-22', 0),
('PJ-010', 'daster', 50, '2022-06-24', '2022-06-25', 1),
('PJ-011', 'Jaket Ungu', 50, '2022-06-30', '2022-06-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rencana_produksi`
--

CREATE TABLE `rencana_produksi` (
  `id_rencana` varchar(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rencana_produksi`
--

INSERT INTO `rencana_produksi` (`id_rencana`, `nama_produk`) VALUES
('RP-001', 'Baju'),
('RP-002', 'Celana'),
('RP-003', 'Kereasi Penggaris'),
('RP-004', 'jaket'),
('RP-005', 'kemeja'),
('RP-006', 'daster'),
('RP-007', 'jaket biru'),
('RP-008', 'Jaket Ungu');

-- --------------------------------------------------------

--
-- Table structure for table `safety_stok`
--

CREATE TABLE `safety_stok` (
  `id_safety` varchar(20) NOT NULL,
  `pemakaian_max` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `consumption` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sisa_bahan`
--

CREATE TABLE `sisa_bahan` (
  `id_bahan` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `bahan_diminta` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `stock_sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sisa_bahan`
--

INSERT INTO `sisa_bahan` (`id_bahan`, `nama_bahan`, `satuan`, `stok`, `bahan_diminta`, `tgl_permintaan`, `stock_sisa`) VALUES
('B001', 'Kain', 'meter', 100, 20, '2021-12-08', 80);

-- --------------------------------------------------------

--
-- Table structure for table `sisa_bahan_gudang`
--

CREATE TABLE `sisa_bahan_gudang` (
  `id` int(11) NOT NULL,
  `id_bahan` varchar(11) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `jmlh_permintaan` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `stok_sisa` int(11) NOT NULL,
  `safety_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sisa_bahan_gudang`
--

INSERT INTO `sisa_bahan_gudang` (`id`, `id_bahan`, `nama_bahan`, `stock`, `satuan`, `jmlh_permintaan`, `tgl_permintaan`, `stok_sisa`, `safety_stok`) VALUES
(4, 'BHN001', 'Kain', 500, 'Meter', 5, '2022-01-07', 440, 100),
(5, 'BHN002', 'Benang', 200, 'Meter', 10, '2022-03-27', 140, 100),
(7, 'BHN003', 'Kayu', 500, 'Meter', 5, '2022-01-07', 94, 100),
(8, 'BHN004', 'Tali', 0, 'Meter', 20, '2022-04-17', 170, 100),
(10, 'BHN005', 'Pensil', 0, 'Buah', 50, '2022-04-17', 150, 100),
(11, 'BHN006', 'Penggaris', 0, 'Buah', 30, '2022-04-17', 20, 100),
(12, 'BHN007', 'retsleting', 0, 'pcs', 0, '0000-00-00', 0, 10),
(13, 'BHN008', 'retsleting hitam', 0, 'pcs', 0, '0000-00-00', 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tenaga_kerja`
--

CREATE TABLE `tenaga_kerja` (
  `id` int(11) NOT NULL,
  `id_tenaga_kerja` varchar(20) NOT NULL,
  `tarif` bigint(20) NOT NULL,
  `jenis_tenaga_kerja` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tenaga_kerja`
--

INSERT INTO `tenaga_kerja` (`id`, `id_tenaga_kerja`, `tarif`, `jenis_tenaga_kerja`) VALUES
(1, 'TK-001', 100000, 'Penjahit'),
(2, 'TK-002', 10000, 'Pengrajin'),
(3, 'TK-003', 50000, 'pemasang kancing');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime DEFAULT current_timestamp(),
  `last_logout` timestamp NULL DEFAULT current_timestamp(),
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL,
  `profil_pic` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `last_login`, `last_logout`, `create_at`, `update_at`, `profil_pic`) VALUES
(1, 'admin', 'admin', '$2y$10$/fwaBZ/G3zrbRY0ceQhsOeZOVmYnEX8ABB4dAszjGY1e47aIqtC/W', 'admin', '2022-05-02 18:57:06', '2022-05-02 11:58:17', '2021-11-26 06:46:38', '0000-00-00 00:00:00', ''),
(2, 'produksi', 'produksi', '$2y$10$ikBZMyogCNr08C0i8IrSS.lo0jK/OsiOeXofCnaTp3DS1zzjtlXQG', 'produksi', '2022-07-01 13:56:15', '2022-06-28 04:31:15', '2021-11-26 06:47:26', '0000-00-00 00:00:00', ''),
(3, 'pembelian', 'pembelian', '$2y$10$QU0YlPbLtntkI9xLEOu7aubLqh0wxhdxa/6sQSaj4oDq6kDdPWgcS', 'pembelian', '2022-05-02 19:09:07', '2022-05-02 11:54:24', '2021-11-26 06:47:54', '0000-00-00 00:00:00', ''),
(4, 'manajemen kas', 'manajemenkas', '$2y$10$glB39yVZFlazHkHSx9f4/OMcv7IBayERTAqVzUduHEiDzmap/VE8W', 'manajemenkas', '2022-05-13 21:57:07', '2022-05-13 15:03:42', '2021-11-26 06:48:18', '0000-00-00 00:00:00', ''),
(5, 'keuangan', 'keuangan', '$2y$10$KD5g6xwkBDOftTYVEccYWOPEwqTRMVtdmzeew2VpkaqIkpWQIDZCu', 'keuangan', '2022-05-02 19:08:49', '2022-05-02 12:08:59', '2021-11-26 06:48:45', '2021-11-26 12:56:12', ''),
(6, 'gudang', 'gudang', '$2y$10$h2KVs3HgN0fGtqz8cYr5n.SjfV7d5fLQtoor.o/5/EuMgNhxsapse', 'gudang', '2022-06-18 20:33:42', '2022-06-18 13:37:33', '2021-11-26 06:49:08', '0000-00-00 00:00:00', ''),
(7, 'asdasdsdada', 'arnol123', '$2y$10$RqEFUJlqQzGvFWnAZ9CTneOqcWkk5wycJ52T8/DxQct28gGbVypTC', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-11-26 10:30:00', '2021-11-26 18:21:15', ''),
(8, 'TESTER', 'tester', '$2y$10$/.3tP.KnkIc2.G8ztAZOFeR4dx4KK0ClCSXCqpAXhCLb1IIZ3DKMO', 'admin', '2021-11-27 13:11:43', '2021-11-27 06:11:48', '2021-11-27 06:10:41', '2021-11-27 13:11:11', '');

-- --------------------------------------------------------

--
-- Table structure for table `utang`
--

CREATE TABLE `utang` (
  `id_utang` varchar(20) NOT NULL,
  `id_pembayaranut` varchar(20) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tgl_lunas` date NOT NULL,
  `tot_utang` int(11) NOT NULL,
  `ket_utang` text NOT NULL,
  `upload_pembayaran` varchar(100) NOT NULL,
  `jenis_utang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utang`
--

INSERT INTO `utang` (`id_utang`, `id_pembayaranut`, `tgl_bayar`, `tgl_lunas`, `tot_utang`, `ket_utang`, `upload_pembayaran`, `jenis_utang`) VALUES
('U-01', 'PU-005', '2022-04-14', '2022-04-16', 500000, 'Bank', 'Wallpaper_1.jpg', 'Bank BRI');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` varchar(11) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `alamat`, `no_telp`) VALUES
('VD001', 'Mahmud', 'Jl. pisang mangga 2 blok. K no 10', '08214885932');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indexes for table `aset_dimiliki`
--
ALTER TABLE `aset_dimiliki`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan`),
  ADD KEY `id_bahan` (`id_bahan`) USING BTREE;

--
-- Indexes for table `bahan_baku_gudang`
--
ALTER TABLE `bahan_baku_gudang`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_siap_jual`
--
ALTER TABLE `barang_siap_jual`
  ADD PRIMARY KEY (`id_barang_siap`);

--
-- Indexes for table `barang_terjual`
--
ALTER TABLE `barang_terjual`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `beban_op`
--
ALTER TABLE `beban_op`
  ADD PRIMARY KEY (`id_bebanop`);

--
-- Indexes for table `biaya_bahan`
--
ALTER TABLE `biaya_bahan`
  ADD PRIMARY KEY (`id_biaya_bahan`);

--
-- Indexes for table `biaya_overhead`
--
ALTER TABLE `biaya_overhead`
  ADD PRIMARY KEY (`id_biaya_overhead`);

--
-- Indexes for table `biaya_produksi`
--
ALTER TABLE `biaya_produksi`
  ADD PRIMARY KEY (`id_biaya_produksi`);

--
-- Indexes for table `biaya_tenaga_kerja`
--
ALTER TABLE `biaya_tenaga_kerja`
  ADD PRIMARY KEY (`id_biaya_tenaga`);

--
-- Indexes for table `bom_baru`
--
ALTER TABLE `bom_baru`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_bahan` (`id_bahan`),
  ADD KEY `id_bom` (`id_bom`);

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `ekspedisi`
--
ALTER TABLE `ekspedisi`
  ADD PRIMARY KEY (`id_ekspedisi`);

--
-- Indexes for table `eoq`
--
ALTER TABLE `eoq`
  ADD PRIMARY KEY (`id_eoq`);

--
-- Indexes for table `good_issue`
--
ALTER TABLE `good_issue`
  ADD PRIMARY KEY (`id_good`);

--
-- Indexes for table `good_receipt`
--
ALTER TABLE `good_receipt`
  ADD PRIMARY KEY (`id_receipt`);

--
-- Indexes for table `history_bahan_baku`
--
ALTER TABLE `history_bahan_baku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_biaya_bahan`
--
ALTER TABLE `history_biaya_bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_biaya_overhead`
--
ALTER TABLE `history_biaya_overhead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_biaya_produksi`
--
ALTER TABLE `history_biaya_produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_biaya_tenaga`
--
ALTER TABLE `history_biaya_tenaga`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_good_issue`
--
ALTER TABLE `history_good_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_jadwal`
--
ALTER TABLE `history_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_op`
--
ALTER TABLE `history_op`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_pembelian_aset`
--
ALTER TABLE `history_pembelian_aset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_pembelian_bahan`
--
ALTER TABLE `history_pembelian_bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_penjualan`
--
ALTER TABLE `history_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_ut`
--
ALTER TABLE `history_ut`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_produksi`
--
ALTER TABLE `jadwal_produksi`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `id_operation` (`id_operation`);

--
-- Indexes for table `jenis_beban`
--
ALTER TABLE `jenis_beban`
  ADD PRIMARY KEY (`id_jen_beban`);

--
-- Indexes for table `jenis_penerimaan`
--
ALTER TABLE `jenis_penerimaan`
  ADD PRIMARY KEY (`id_jenis_penerimaan`);

--
-- Indexes for table `jenis_utang`
--
ALTER TABLE `jenis_utang`
  ADD PRIMARY KEY (`id_jen_utang`);

--
-- Indexes for table `jurnal_keuangan`
--
ALTER TABLE `jurnal_keuangan`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `kode_coa` (`kode_akun`);

--
-- Indexes for table `jurnal_mankas`
--
ALTER TABLE `jurnal_mankas`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `kode_coa` (`kode_akun`);

--
-- Indexes for table `jurnal_pembelian`
--
ALTER TABLE `jurnal_pembelian`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `kode_coa` (`kode_akun`);

--
-- Indexes for table `jurnal_penerimaan`
--
ALTER TABLE `jurnal_penerimaan`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `kode_coa` (`kode_akun`);

--
-- Indexes for table `jurnal_produksi`
--
ALTER TABLE `jurnal_produksi`
  ADD PRIMARY KEY (`id_jurnal`),
  ADD KEY `kode_coa` (`kode_akun`);

--
-- Indexes for table `login_activity`
--
ALTER TABLE `login_activity`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`id_merchant`);

--
-- Indexes for table `operasional`
--
ALTER TABLE `operasional`
  ADD PRIMARY KEY (`kode_operasional`);

--
-- Indexes for table `operation_list`
--
ALTER TABLE `operation_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_operation` (`id_operation`),
  ADD KEY `id_tenaga_kerja` (`id_tenaga_kerja`);

--
-- Indexes for table `opl_baru`
--
ALTER TABLE `opl_baru`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overhead`
--
ALTER TABLE `overhead`
  ADD PRIMARY KEY (`id_overhead`);

--
-- Indexes for table `pembayaran_op`
--
ALTER TABLE `pembayaran_op`
  ADD PRIMARY KEY (`id_pembayaranop`);

--
-- Indexes for table `pembayaran_ut`
--
ALTER TABLE `pembayaran_ut`
  ADD PRIMARY KEY (`id_pembayaranut`);

--
-- Indexes for table `pembelian_aset`
--
ALTER TABLE `pembelian_aset`
  ADD PRIMARY KEY (`id_pembelian_aset`);

--
-- Indexes for table `pembelian_bahan`
--
ALTER TABLE `pembelian_bahan`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_gudang`
--
ALTER TABLE `pembelian_gudang`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_permintaan_bahan`
--
ALTER TABLE `pembelian_permintaan_bahan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `penerimaan_kas`
--
ALTER TABLE `penerimaan_kas`
  ADD PRIMARY KEY (`id_penerimaan`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyusutan_aset`
--
ALTER TABLE `penyusutan_aset`
  ADD PRIMARY KEY (`id_penyusutan`);

--
-- Indexes for table `perhitungan_costing`
--
ALTER TABLE `perhitungan_costing`
  ADD PRIMARY KEY (`id_costing`);

--
-- Indexes for table `permintaan_bahan`
--
ALTER TABLE `permintaan_bahan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `permintaan_gudang`
--
ALTER TABLE `permintaan_gudang`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `persediaan_barang`
--
ALTER TABLE `persediaan_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `prive`
--
ALTER TABLE `prive`
  ADD PRIMARY KEY (`id_prive`);

--
-- Indexes for table `production_details`
--
ALTER TABLE `production_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_bom_2` (`id_bom`),
  ADD KEY `id_bom` (`id_bom`),
  ADD KEY `id_jadwal` (`id_operation`);

--
-- Indexes for table `produk_jadi`
--
ALTER TABLE `produk_jadi`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `rencana_produksi`
--
ALTER TABLE `rencana_produksi`
  ADD PRIMARY KEY (`id_rencana`);

--
-- Indexes for table `safety_stok`
--
ALTER TABLE `safety_stok`
  ADD PRIMARY KEY (`id_safety`);

--
-- Indexes for table `sisa_bahan`
--
ALTER TABLE `sisa_bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `sisa_bahan_gudang`
--
ALTER TABLE `sisa_bahan_gudang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenaga_kerja`
--
ALTER TABLE `tenaga_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tenaga_kerja` (`id_tenaga_kerja`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `utang`
--
ALTER TABLE `utang`
  ADD PRIMARY KEY (`id_utang`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id_vendor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset_dimiliki`
--
ALTER TABLE `aset_dimiliki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `barang_terjual`
--
ALTER TABLE `barang_terjual`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `bom_baru`
--
ALTER TABLE `bom_baru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `history_bahan_baku`
--
ALTER TABLE `history_bahan_baku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `history_biaya_bahan`
--
ALTER TABLE `history_biaya_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `history_biaya_overhead`
--
ALTER TABLE `history_biaya_overhead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `history_biaya_produksi`
--
ALTER TABLE `history_biaya_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history_biaya_tenaga`
--
ALTER TABLE `history_biaya_tenaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `history_good_issue`
--
ALTER TABLE `history_good_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history_jadwal`
--
ALTER TABLE `history_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `history_op`
--
ALTER TABLE `history_op`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `history_pembelian_aset`
--
ALTER TABLE `history_pembelian_aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `history_pembelian_bahan`
--
ALTER TABLE `history_pembelian_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `history_penjualan`
--
ALTER TABLE `history_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `history_ut`
--
ALTER TABLE `history_ut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jurnal_keuangan`
--
ALTER TABLE `jurnal_keuangan`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `jurnal_mankas`
--
ALTER TABLE `jurnal_mankas`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `jurnal_pembelian`
--
ALTER TABLE `jurnal_pembelian`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jurnal_penerimaan`
--
ALTER TABLE `jurnal_penerimaan`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jurnal_produksi`
--
ALTER TABLE `jurnal_produksi`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `login_activity`
--
ALTER TABLE `login_activity`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `operation_list`
--
ALTER TABLE `operation_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `opl_baru`
--
ALTER TABLE `opl_baru`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `perhitungan_costing`
--
ALTER TABLE `perhitungan_costing`
  MODIFY `id_costing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `persediaan_barang`
--
ALTER TABLE `persediaan_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `production_details`
--
ALTER TABLE `production_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sisa_bahan_gudang`
--
ALTER TABLE `sisa_bahan_gudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tenaga_kerja`
--
ALTER TABLE `tenaga_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bom_baru`
--
ALTER TABLE `bom_baru`
  ADD CONSTRAINT `fk_id_bahan_bom` FOREIGN KEY (`id_bahan`) REFERENCES `bahan_baku` (`id_bahan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `operation_list`
--
ALTER TABLE `operation_list`
  ADD CONSTRAINT `fk_id_tenaga_kerja` FOREIGN KEY (`id_tenaga_kerja`) REFERENCES `tenaga_kerja` (`id_tenaga_kerja`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `production_details`
--
ALTER TABLE `production_details`
  ADD CONSTRAINT `fk_id_bom` FOREIGN KEY (`id_bom`) REFERENCES `bom_baru` (`id_bom`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_operation` FOREIGN KEY (`id_operation`) REFERENCES `operation_list` (`id_operation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_id_operation_jadwal_produksi` FOREIGN KEY (`id_operation`) REFERENCES `jadwal_produksi` (`id_operation`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
