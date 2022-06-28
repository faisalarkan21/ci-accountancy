-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Des 2021 pada 13.20
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_akuntansi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset`
--

CREATE TABLE `aset` (
  `id_aset` varchar(11) NOT NULL,
  `nama_aset` varchar(30) NOT NULL,
  `jml_aset` int(11) NOT NULL,
  `tot_harga` int(11) NOT NULL,
  `tgl_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aset`
--

INSERT INTO `aset` (`id_aset`, `nama_aset`, `jml_aset`, `tot_harga`, `tgl_beli`) VALUES
('AS1234', 'gedung', 2, 2200000, '2021-12-02'),
('AS1235', 'Rumah', 4, 2200000, '2021-12-05');

--
-- Trigger `aset`
--
DELIMITER $$
CREATE TRIGGER `insert_aset_lama` AFTER INSERT ON `aset` FOR EACH ROW BEGIN
 IF new.nama_aset IS NOT NULL THEN
INSERT INTO aset_dimiliki(id, id_aset, nama_aset, jml_aset ,tot_harga ,tgl_beli)
VALUES (id, new.id_aset, new.nama_aset, new.jml_aset, new.tot_harga, new.tgl_beli); 
 END IF;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `aset_dimiliki`
--

CREATE TABLE `aset_dimiliki` (
  `id` int(11) NOT NULL,
  `id_aset` varchar(11) NOT NULL,
  `nama_aset` varchar(30) NOT NULL,
  `jml_aset` int(11) NOT NULL,
  `tot_harga` int(11) NOT NULL,
  `tgl_beli` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `aset_dimiliki`
--

INSERT INTO `aset_dimiliki` (`id`, `id_aset`, `nama_aset`, `jml_aset`, `tot_harga`, `tgl_beli`) VALUES
(1, 'AS1235', 'Rumah', 4, 2200000, '2021-12-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_baku`
--

CREATE TABLE `bahan_baku` (
  `id_bahan` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `harga_bahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bahan_baku`
--

INSERT INTO `bahan_baku` (`id_bahan`, `nama_bahan`, `quantity`, `satuan`, `harga_bahan`) VALUES
('B12223', 'Kain', 50, 'Meter', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bahan_pembelian`
--

CREATE TABLE `bahan_pembelian` (
  `id_bahan` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jmlh_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `jmlh_barang`) VALUES
('B2322', 'Baju', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_terjual`
--

CREATE TABLE `barang_terjual` (
  `id_retur` int(11) NOT NULL,
  `tgl_retur` date NOT NULL,
  `id_penjualan` varchar(20) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jmlh_barang` int(11) NOT NULL,
  `stock_barang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_terjual`
--

INSERT INTO `barang_terjual` (`id_retur`, `tgl_retur`, `id_penjualan`, `tgl_penjualan`, `nama_barang`, `jmlh_barang`, `stock_barang`) VALUES
(1, '2021-12-06', 'PEN1223', '2021-12-06', 'Baju', 20, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `beban_op`
--

CREATE TABLE `beban_op` (
  `id_bebanop` varchar(20) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tot_harga_beban` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `beban_op`
--

INSERT INTO `beban_op` (`id_bebanop`, `tgl_bayar`, `tot_harga_beban`, `keterangan`) VALUES
('B1234', '2021-12-02', 500000, 'apa saja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_bahan`
--

CREATE TABLE `biaya_bahan` (
  `id_biaya_bahan` varchar(20) NOT NULL,
  `id_bom` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_overhead`
--

CREATE TABLE `biaya_overhead` (
  `id_biaya_overhead` varchar(20) NOT NULL,
  `nama_overhead` varchar(50) NOT NULL,
  `total_overhead` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_produksi`
--

CREATE TABLE `biaya_produksi` (
  `id_biaya_produksi` varchar(20) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `biaya_overhead` int(11) NOT NULL,
  `total_produksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `biaya_produksi`
--

INSERT INTO `biaya_produksi` (`id_biaya_produksi`, `tgl_pembayaran`, `biaya_bahan`, `biaya_overhead`, `total_produksi`) VALUES
('BP001', '2021-12-08', 5000000, 640000, 5640000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `biaya_tenaga_kerja`
--

CREATE TABLE `biaya_tenaga_kerja` (
  `id_biaya_tenaga` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenis_kerja` varchar(50) NOT NULL,
  `gaji` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `bom`
--

CREATE TABLE `bom` (
  `id_bom` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `nama_bom` varchar(50) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `harga_bahan` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `target_produksi` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bom`
--

INSERT INTO `bom` (`id_bom`, `nama_pegawai`, `nama_bom`, `nama_bahan`, `harga_bahan`, `quantity`, `target_produksi`, `total_biaya`) VALUES
('BM1221', 'Dodi', 'C4', 'Kain', 50000, 50, 100, 2500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `coa`
--

CREATE TABLE `coa` (
  `kode_akun` int(11) NOT NULL,
  `nama_akun` varchar(30) NOT NULL,
  `header_akun` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `coa`
--

INSERT INTO `coa` (`kode_akun`, `nama_akun`, `header_akun`) VALUES
(1122, 'Pembelian', 3),
(1123, 'Penjualan', 1),
(1124, 'pemasaran', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(20) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `alamat`, `no_telp`, `email`) VALUES
('CUS1232', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', '08214885932', 'dika@gmail.com'),
('CUS1233', 'Sandi', 'Jl Kenangan 12', '0832323211', 'sandi@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ekspedisi`
--

CREATE TABLE `ekspedisi` (
  `id_ekspedisi` varchar(20) NOT NULL,
  `nama_ekspedisi` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ekspedisi`
--

INSERT INTO `ekspedisi` (`id_ekspedisi`, `nama_ekspedisi`, `no_telp`) VALUES
('EK1232', 'JNE', '08214885932');

-- --------------------------------------------------------

--
-- Struktur dari tabel `eoq`
--

CREATE TABLE `eoq` (
  `id_eoq` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `eoq` int(11) NOT NULL,
  `rop` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `biaya_optimal` int(11) NOT NULL,
  `safety_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `good_issue`
--

CREATE TABLE `good_issue` (
  `id_good` varchar(20) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `harga` int(11) NOT NULL,
  `jmlh` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `good_issue`
--

INSERT INTO `good_issue` (`id_good`, `nama_vendor`, `tgl_pembelian`, `harga`, `jmlh`, `total`, `keterangan`) VALUES
('G001', 'Shasa', '2021-12-08', 5000, 20, 100000, 'Baju');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_bahan_baku`
--

CREATE TABLE `history_bahan_baku` (
  `id_history_bahan` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `bahan_pakai` int(11) NOT NULL,
  `sisa_stock` int(11) NOT NULL,
  `tgl_ambil_stock` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_bahan_baku`
--

INSERT INTO `history_bahan_baku` (`id_history_bahan`, `nama_bahan`, `quantity`, `bahan_pakai`, `sisa_stock`, `tgl_ambil_stock`) VALUES
('SS12321', 'Kain', 50, 20, 30, '2021-12-07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_biaya_bahan`
--

CREATE TABLE `history_biaya_bahan` (
  `id` int(11) NOT NULL,
  `id_biaya_bahan` varchar(20) NOT NULL,
  `id_bom` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_biaya_bahan`
--

INSERT INTO `history_biaya_bahan` (`id`, `id_biaya_bahan`, `id_bom`, `nama_bahan`, `quantity`, `total_biaya`, `tgl_pembayaran`) VALUES
(2, 'BB002', 'BM1221', 'Kain', 50, 2500000, '2021-12-08'),
(3, 'BB001', 'BM1221', 'Kain', 50, 2500000, '2021-12-08');

--
-- Trigger `history_biaya_bahan`
--
DELIMITER $$
CREATE TRIGGER `delete_biaya_bahan` AFTER INSERT ON `history_biaya_bahan` FOR EACH ROW BEGIN
DELETE FROM biaya_bahan WHERE id_biaya_bahan = new.id_biaya_bahan;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_biaya_overhead`
--

CREATE TABLE `history_biaya_overhead` (
  `id` int(11) NOT NULL,
  `id_biaya_overhead` varchar(20) NOT NULL,
  `nama_overhead` varchar(50) NOT NULL,
  `total_overhead` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_biaya_overhead`
--

INSERT INTO `history_biaya_overhead` (`id`, `id_biaya_overhead`, `nama_overhead`, `total_overhead`, `tgl_pembayaran`) VALUES
(2, 'OH001', 'Studi', 500000, '2021-12-08'),
(3, 'OH002', 'Belajar', 20000, '2021-12-08'),
(4, 'OH002', 'Belajar', 20000, '2021-12-08'),
(5, 'OH002', 'Belajar', 100000, '2021-12-08');

--
-- Trigger `history_biaya_overhead`
--
DELIMITER $$
CREATE TRIGGER `delete_biaya_overhead` AFTER INSERT ON `history_biaya_overhead` FOR EACH ROW BEGIN
DELETE FROM biaya_overhead WHERE id_biaya_overhead = new.id_biaya_overhead;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_biaya_produksi`
--

CREATE TABLE `history_biaya_produksi` (
  `id` int(11) NOT NULL,
  `id_biaya_produksi` varchar(20) NOT NULL,
  `tgl_pembayaran_produksi` date NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `biaya_overhead` int(11) NOT NULL,
  `total_produksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_biaya_produksi`
--

INSERT INTO `history_biaya_produksi` (`id`, `id_biaya_produksi`, `tgl_pembayaran_produksi`, `biaya_bahan`, `biaya_overhead`, `total_produksi`) VALUES
(2, 'BP003', '2021-12-08', 5000000, 540000, 5540000);

--
-- Trigger `history_biaya_produksi`
--
DELIMITER $$
CREATE TRIGGER `delete_biaya_produksi` AFTER INSERT ON `history_biaya_produksi` FOR EACH ROW BEGIN
DELETE FROM biaya_produksi WHERE id_biaya_produksi = new.id_biaya_produksi;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_biaya_tenaga`
--

CREATE TABLE `history_biaya_tenaga` (
  `id` int(11) NOT NULL,
  `id_biaya_tenaga` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenis_kerja` varchar(50) NOT NULL,
  `gaji` int(11) NOT NULL,
  `tgl_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_biaya_tenaga`
--

INSERT INTO `history_biaya_tenaga` (`id`, `id_biaya_tenaga`, `nama_pegawai`, `jenis_kerja`, `gaji`, `tgl_bayar`) VALUES
(3, 'BT001', 'Dodi', 'Penjahit', 2000000, '2021-12-08'),
(4, 'BT001', 'Dodi', 'Penjahit', 2000000, '2021-12-08');

--
-- Trigger `history_biaya_tenaga`
--
DELIMITER $$
CREATE TRIGGER `delete_biaya_tenaga` AFTER INSERT ON `history_biaya_tenaga` FOR EACH ROW BEGIN
DELETE FROM biaya_tenaga_kerja WHERE id_biaya_tenaga = new.id_biaya_tenaga;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_good_issue`
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
-- Dumping data untuk tabel `history_good_issue`
--

INSERT INTO `history_good_issue` (`id`, `id_good`, `nama_vendor`, `tgl_pembelian`, `harga`, `jmlh`, `total`, `keterangan`, `tgl_terima`) VALUES
(1, 'G001', 'Shasa', '2021-12-08', 5000, 20, 100000, 'Baju', '2021-12-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_jadwal`
--

CREATE TABLE `history_jadwal` (
  `id` int(11) NOT NULL,
  `id_jadwal` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rencana_produksi` int(11) NOT NULL,
  `tgl_produksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_jadwal`
--

INSERT INTO `history_jadwal` (`id`, `id_jadwal`, `nama_bahan`, `quantity`, `rencana_produksi`, `tgl_produksi`) VALUES
(3, 'JW1232', 'Kain', 50, 200, '2021-12-07');

--
-- Trigger `history_jadwal`
--
DELIMITER $$
CREATE TRIGGER `delete_jadwal_produksi` AFTER INSERT ON `history_jadwal` FOR EACH ROW BEGIN
DELETE FROM jadwal_produksi WHERE id_jadwal = new.id_jadwal;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_op`
--

CREATE TABLE `history_op` (
  `id` int(11) NOT NULL,
  `id_pembayaranop` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `jenis_beban` varchar(50) NOT NULL,
  `tgl_beban` date NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `tot_harga_beban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_op`
--

INSERT INTO `history_op` (`id`, `id_pembayaranop`, `keterangan`, `jenis_beban`, `tgl_beban`, `tgl_pembayaran`, `tot_harga_beban`) VALUES
(1, 'PO2332', 'apa saja', 'Bersama', '2021-12-03', '2021-12-04', 500000),
(4, 'PO2332', 'apa saja', 'Keluarga', '2021-12-04', '2021-12-04', 500000),
(5, 'PO2333', 'apa saja', 'Keluarga', '2021-12-04', '2021-12-04', 500000),
(6, 'PO2332', 'apa saja', 'Bersama', '2021-12-04', '2021-12-04', 500000),
(7, 'PO2332', 'apa saja', 'Bersama', '2021-12-04', '2021-12-06', 500000),
(8, 'PO2332', 'apa saja', 'Bersama', '2021-12-06', '2021-12-06', 500000);

--
-- Trigger `history_op`
--
DELIMITER $$
CREATE TRIGGER `delete_operasional` AFTER INSERT ON `history_op` FOR EACH ROW BEGIN
DELETE FROM pembayaran_op WHERE id_pembayaranop = new.id_pembayaranop;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_pembayaran_pembelian`
--

CREATE TABLE `history_pembayaran_pembelian` (
  `id` int(11) NOT NULL,
  `id_pembelian` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `biaya_pembelian` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_pembayaran_pembelian`
--

INSERT INTO `history_pembayaran_pembelian` (`id`, `id_pembelian`, `nama_barang`, `tgl_pembelian`, `biaya_pembelian`, `tgl_pembayaran`) VALUES
(1, 'PP001', 'Baju', '2021-12-08', 50000, '2021-12-08'),
(3, 'PP001', 'Baju', '2021-12-08', 50000, '2021-12-08'),
(4, 'PP002', 'Meja', '2021-12-08', 500000, '2021-12-08');

--
-- Trigger `history_pembayaran_pembelian`
--
DELIMITER $$
CREATE TRIGGER `delete_pembayaran_pembelian` AFTER INSERT ON `history_pembayaran_pembelian` FOR EACH ROW BEGIN
DELETE FROM pembayaran_pembelian WHERE id_pembelian = new.id_pembelian;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_pembelian_aset`
--

CREATE TABLE `history_pembelian_aset` (
  `id` int(11) NOT NULL,
  `id_pembelian_aset` varchar(20) NOT NULL,
  `nama_aset` varchar(50) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `tot_biaya_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_pembelian_aset`
--

INSERT INTO `history_pembelian_aset` (`id`, `id_pembelian_aset`, `nama_aset`, `tgl_pembelian`, `nama_toko`, `tgl_pembayaran`, `tot_biaya_pembelian`) VALUES
(3, 'PA2342', 'Rumah', '2021-12-04', 'Jaya Makmur', '2021-12-04', 50000),
(4, 'PA2342', 'Rumah', '2021-12-04', 'Jaya Makmur', '2021-12-06', 50000),
(5, 'PA2342', 'gedung', '2021-12-06', 'Jaya Makmur', '2021-12-06', 50000),
(6, 'PA2342', 'Rumah', '2021-12-06', 'Jaya Makmur', '2021-12-06', 50000),
(7, 'PA2343', 'gedung', '2021-12-06', 'Jaya Makmur', '2021-12-06', 50000);

--
-- Trigger `history_pembelian_aset`
--
DELIMITER $$
CREATE TRIGGER `delete_pembelian_aset` AFTER INSERT ON `history_pembelian_aset` FOR EACH ROW BEGIN
DELETE FROM pembelian_aset WHERE id_pembelian_aset = new.id_pembelian_aset;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_pembelian_bahan`
--

CREATE TABLE `history_pembelian_bahan` (
  `id` int(11) NOT NULL,
  `id_pembelian` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `jmlh_kebutuhan` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total` int(11) NOT NULL,
  `eoq` int(11) NOT NULL,
  `tgl_terima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_pembelian_bahan`
--

INSERT INTO `history_pembelian_bahan` (`id`, `id_pembelian`, `nama_bahan`, `nama_vendor`, `jmlh_kebutuhan`, `tgl_pembelian`, `total`, `eoq`, `tgl_terima`) VALUES
(1, 'PB001', 'Kain', 'Shasa', 20, '2021-12-08', 20, 10, '2021-12-08'),
(2, 'PB001', 'Kain', 'Shasa', 20, '2021-12-08', 20, 10, '2021-12-09'),
(3, 'PB001', 'Kain', 'Shasa', 20, '2021-12-08', 20, 10, '2021-12-10'),
(4, 'PB001', 'Kain', 'Shasa', 20, '2021-12-08', 20, 10, '2021-12-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_penjualan`
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
  `tgl_penjualan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_penjualan`
--

INSERT INTO `history_penjualan` (`id`, `id_penjualan`, `nama_customer`, `alamat`, `no_telp`, `nama_barang`, `jmlh_barang`, `nama_merchant`, `nama_ekspedisi`, `no_resi`, `tgl_retur`, `tgl_penjualan`) VALUES
(5, 'PEN1222', 'Dika', 'Jl. pisang mangga 2 blok. K no 10', 2147483647, 'Baju', 3, 'Shopee', 'JNE', '2323123123', '2021-12-06', '2021-12-06'),
(6, 'PEN1223', 'Sandi', 'Jl Kenangan 12', 832323211, 'Baju', 20, 'Shopee', 'JNE', '2323123123', '2021-12-06', '2021-12-06');

--
-- Trigger `history_penjualan`
--
DELIMITER $$
CREATE TRIGGER `delete_penjualan` AFTER INSERT ON `history_penjualan` FOR EACH ROW BEGIN
DELETE FROM penjualan WHERE id_penjualan = new.id_penjualan;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_barang_terjual` AFTER INSERT ON `history_penjualan` FOR EACH ROW BEGIN
 IF new.id_penjualan IS NOT NULL THEN
INSERT INTO barang_terjual(tgl_retur, id_penjualan, tgl_penjualan, nama_barang, jmlh_barang)

VALUES(new.tgl_retur, new.id_penjualan, new.tgl_penjualan, new.nama_barang, new.jmlh_barang); 
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `history_ut`
--

CREATE TABLE `history_ut` (
  `id` int(11) NOT NULL,
  `id_pembayaranut` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `jenis_utang` varchar(50) NOT NULL,
  `tgl_utang` date NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `tot_harga_utang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history_ut`
--

INSERT INTO `history_ut` (`id`, `id_pembayaranut`, `keterangan`, `jenis_utang`, `tgl_utang`, `tgl_pembayaran`, `tot_harga_utang`) VALUES
(3, 'PU1232', 'apa saja', 'Usaha', '2021-12-04', '2021-12-04', 50000),
(4, 'PU1232', 'apa saja', 'Usaha', '2021-12-04', '2021-12-04', 50000),
(5, 'PU1233', 'apa saja', 'Keluarga', '2021-12-06', '2021-12-06', 50000);

--
-- Trigger `history_ut`
--
DELIMITER $$
CREATE TRIGGER `delete_pembayaran_utang` AFTER INSERT ON `history_ut` FOR EACH ROW BEGIN
DELETE FROM pembayaran_ut WHERE id_pembayaranut = new.id_pembayaranut;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `investasi`
--

CREATE TABLE `investasi` (
  `kode_inves` varchar(20) NOT NULL,
  `tgl_inves` date NOT NULL,
  `jenis_inves` varchar(20) NOT NULL,
  `ket_inves` text NOT NULL,
  `nominal_inves` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `investasi`
--

INSERT INTO `investasi` (`kode_inves`, `tgl_inves`, `jenis_inves`, `ket_inves`, `nominal_inves`) VALUES
('INV1122', '2021-11-23', 'Project', 'Apa aja', 50000),
('INV1123', '2021-11-23', 'Sendiri', 'Apa aja', 500000),
('INV1124', '2021-11-23', 'Sendiri', 'Apa aja', 50000),
('INV1125', '2021-11-23', 'Project', 'Apa aja', 500000),
('INV1126', '2021-11-23', 'Project', 'Apa aja', 100000),
('INV1127', '2021-11-25', 'Sendiri', 'Apa aja', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_produksi`
--

CREATE TABLE `jadwal_produksi` (
  `id_jadwal` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rencana_produksi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_beban`
--

CREATE TABLE `jenis_beban` (
  `id_jen_beban` varchar(20) NOT NULL,
  `jenis_beban` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_beban`
--

INSERT INTO `jenis_beban` (`id_jen_beban`, `jenis_beban`) VALUES
('JB1231', 'Bersama'),
('JB1232', 'Keluarga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_penerimaan`
--

CREATE TABLE `jenis_penerimaan` (
  `id_jenis_penerimaan` varchar(20) NOT NULL,
  `jenis_penerimaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_penerimaan`
--

INSERT INTO `jenis_penerimaan` (`id_jenis_penerimaan`, `jenis_penerimaan`) VALUES
('JP0001', 'Pendanaan'),
('JP0002', 'Investasi'),
('JP0003', 'Operasional');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_utang`
--

CREATE TABLE `jenis_utang` (
  `id_jen_utang` varchar(20) NOT NULL,
  `jenis_utang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jenis_utang`
--

INSERT INTO `jenis_utang` (`id_jen_utang`, `jenis_utang`) VALUES
('JU1232', 'Keluarga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_activity`
--

CREATE TABLE `login_activity` (
  `id_login` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `login_activity`
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
-- Struktur dari tabel `merchant`
--

CREATE TABLE `merchant` (
  `id_merchant` varchar(20) NOT NULL,
  `nama_merchant` varchar(50) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `merchant`
--

INSERT INTO `merchant` (`id_merchant`, `nama_merchant`, `no_telp`) VALUES
('MR12322', 'Shopee', '08214885922');

-- --------------------------------------------------------

--
-- Struktur dari tabel `operasional`
--

CREATE TABLE `operasional` (
  `kode_operasional` varchar(20) NOT NULL,
  `tgl_operasional` date NOT NULL,
  `jenis_operasional` varchar(20) NOT NULL,
  `ket_operasional` text NOT NULL,
  `nominal_operasional` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `operasional`
--

INSERT INTO `operasional` (`kode_operasional`, `tgl_operasional`, `jenis_operasional`, `ket_operasional`, `nominal_operasional`) VALUES
('OP1123', '2021-11-23', 'Kendaraan', 'isi', 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `operation_list`
--

CREATE TABLE `operation_list` (
  `id_operation` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `produk_jadi` varchar(50) NOT NULL,
  `jenis_tenaga` varchar(50) NOT NULL,
  `waktu_pengerjaan` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `operation_list`
--

INSERT INTO `operation_list` (`id_operation`, `nama_pegawai`, `produk_jadi`, `jenis_tenaga`, `waktu_pengerjaan`, `total_biaya`) VALUES
('OP001', 'Dodi', 'Baju', 'Penjahit', 4, 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `overhead`
--

CREATE TABLE `overhead` (
  `id_overhead` varchar(20) NOT NULL,
  `nama_overhead` varchar(50) NOT NULL,
  `tgl_overhead` date NOT NULL,
  `biaya_overhead` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `overhead`
--

INSERT INTO `overhead` (`id_overhead`, `nama_overhead`, `tgl_overhead`, `biaya_overhead`) VALUES
('OV1231', 'Studi', '2021-12-07', 500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_op`
--

CREATE TABLE `pembayaran_op` (
  `id_pembayaranop` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `jenis_beban` varchar(50) NOT NULL,
  `tgl_beban` date NOT NULL,
  `tot_harga_beban` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_pembelian`
--

CREATE TABLE `pembayaran_pembelian` (
  `id_pembelian` varchar(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `biaya_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_ut`
--

CREATE TABLE `pembayaran_ut` (
  `id_pembayaranut` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `jenis_utang` varchar(50) NOT NULL,
  `tgl_utang` date NOT NULL,
  `tot_harga_utang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran_ut`
--

INSERT INTO `pembayaran_ut` (`id_pembayaranut`, `keterangan`, `jenis_utang`, `tgl_utang`, `tot_harga_utang`) VALUES
('PU1232', 'apa saja', 'Usaha', '2021-12-04', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_aset`
--

CREATE TABLE `pembelian_aset` (
  `id_pembelian_aset` varchar(20) NOT NULL,
  `nama_aset` varchar(50) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `nama_toko` varchar(50) NOT NULL,
  `tot_biaya_pembelian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_aset`
--

INSERT INTO `pembelian_aset` (`id_pembelian_aset`, `nama_aset`, `tgl_pembelian`, `nama_toko`, `tot_biaya_pembelian`) VALUES
('PA2342', 'Rumah', '2021-12-06', 'Jaya Makmur', 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_bahan`
--

CREATE TABLE `pembelian_bahan` (
  `id_pembelian` varchar(20) NOT NULL,
  `nama_bahan` varchar(50) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `jmlh_kebutuhan` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total` int(11) NOT NULL,
  `eoq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_bahan`
--

INSERT INTO `pembelian_bahan` (`id_pembelian`, `nama_bahan`, `nama_vendor`, `jmlh_kebutuhan`, `tgl_pembelian`, `total`, `eoq`) VALUES
('PB001', 'Kain', 'Shasa', 20, '2021-12-08', 20, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_permintaan_bahan`
--

CREATE TABLE `pembelian_permintaan_bahan` (
  `id_permintaan` varchar(20) NOT NULL,
  `nama_bahan` varchar(20) NOT NULL,
  `jmlh_permintaan` int(11) NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_permintaan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembelian_permintaan_bahan`
--

INSERT INTO `pembelian_permintaan_bahan` (`id_permintaan`, `nama_bahan`, `jmlh_permintaan`, `biaya_bahan`, `status`, `tgl_permintaan`) VALUES
('PB002', 'Kain', 100, 500000, 'Menunggu Diterima', '2021-12-08'),
('PB003', 'Benang', 10, 50000, 'Menunggu Diterima', '2021-12-08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendanaan`
--

CREATE TABLE `pendanaan` (
  `kode_pendanaan` varchar(20) NOT NULL,
  `tgl_pendanaan` date NOT NULL,
  `jenis_pendanaan` varchar(20) NOT NULL,
  `ket_pendanaan` text NOT NULL,
  `nominal_pendanaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendanaan`
--

INSERT INTO `pendanaan` (`kode_pendanaan`, `tgl_pendanaan`, `jenis_pendanaan`, `ket_pendanaan`, `nominal_pendanaan`) VALUES
('PEN1123', '2021-11-23', 'Pribadi', 'Isi Aja', 2000),
('PEN1124', '2021-11-29', 'Pribadi', 'Isi Aja', 66000),
('PEN1125', '2021-12-05', 'Pribadi', 'Isi Aja', 20000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penerimaan_kas`
--

CREATE TABLE `penerimaan_kas` (
  `id_penerimaan` varchar(20) NOT NULL,
  `tgl_penerimaan` date NOT NULL,
  `jenis_penerimaan` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `penerimaan_kas`
--

INSERT INTO `penerimaan_kas` (`id_penerimaan`, `tgl_penerimaan`, `jenis_penerimaan`, `keterangan`, `total`) VALUES
('PK1232', '2021-12-08', 'Pendanaan', 'Beli Es Buah', 20000),
('PK1233', '2021-12-08', 'Investasi', 'Beli Es', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(20) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` int(20) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `jmlh_barang` int(11) NOT NULL,
  `nama_merchant` varchar(20) NOT NULL,
  `nama_ekspedisi` varchar(20) NOT NULL,
  `no_resi` varchar(50) NOT NULL,
  `tgl_retur` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `perhitungan_costing`
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
-- Dumping data untuk tabel `perhitungan_costing`
--

INSERT INTO `perhitungan_costing` (`id_costing`, `b_bahan_baku`, `b_admin_umum`, `gaji`, `orang`, `b_pemasaran`, `b_overhead`) VALUES
(1, 0, 100000, 500000, 10, 200000, 200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_bahan`
--

CREATE TABLE `permintaan_bahan` (
  `id_permintaan` varchar(20) NOT NULL,
  `nama_bahan` varchar(20) NOT NULL,
  `jmlh_permintaan` int(11) NOT NULL,
  `biaya_bahan` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `satuan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaan_bahan`
--

INSERT INTO `permintaan_bahan` (`id_permintaan`, `nama_bahan`, `jmlh_permintaan`, `biaya_bahan`, `status`, `tgl_permintaan`, `satuan`) VALUES
('PB001', 'Benang', 100, 50000, 'Menunggu Diterima', '2021-12-08', ''),
('PB002', 'Kain', 100, 500000, 'Menunggu Diterima', '2021-12-08', ''),
('PB003', 'Benang', 10, 50000, 'Menunggu Diterima', '2021-12-08', 'Meter');

--
-- Trigger `permintaan_bahan`
--
DELIMITER $$
CREATE TRIGGER `insert_pembelian_permintaan` AFTER INSERT ON `permintaan_bahan` FOR EACH ROW BEGIN
INSERT INTO pembelian_permintaan_bahan(id_permintaan, nama_bahan, jmlh_permintaan,biaya_bahan, status, tgl_permintaan)
VALUES (new.id_permintaan, new.nama_bahan, new.jmlh_permintaan,new.biaya_bahan, new.status, new.tgl_permintaan); 
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaan_barang`
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
-- Dumping data untuk tabel `permintaan_barang`
--

INSERT INTO `permintaan_barang` (`id_permintaan`, `jmlh_brg_dibutuhkan`, `b_pemesanan`, `b_penyimpanan`, `lead_time`, `pem_min`, `pem_maks`) VALUES
(1, 10, 20000, 10000, 5, 2, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `persediaan_barang`
--

CREATE TABLE `persediaan_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_produksi` int(11) NOT NULL,
  `jmlh_bahan_baku` int(11) NOT NULL,
  `tgl_stock` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `persediaan_barang`
--

INSERT INTO `persediaan_barang` (`id_barang`, `nama_barang`, `harga_produksi`, `jmlh_bahan_baku`, `tgl_stock`) VALUES
(1, 'Bangku', 50000, 20, '2021-10-08'),
(2, 'kursi', 20000, 10, '2021-10-08'),
(3, 'Meja', 2000, 5, '2021-10-09'),
(4, 'Lemari', 50000, 6, '2021-10-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prive`
--

CREATE TABLE `prive` (
  `id_prive` varchar(20) NOT NULL,
  `tgl_prive` date NOT NULL,
  `jmlh_prive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `prive`
--

INSERT INTO `prive` (`id_prive`, `tgl_prive`, `jmlh_prive`) VALUES
('PR1232', '2021-12-04', 100);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_jadi`
--

CREATE TABLE `produk_jadi` (
  `id_produk` varchar(20) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_jadi`
--

INSERT INTO `produk_jadi` (`id_produk`, `nama_produk`, `stock`) VALUES
('PJ1223', 'Baju', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `safety_stok`
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
-- Struktur dari tabel `tenaga_kerja`
--

CREATE TABLE `tenaga_kerja` (
  `id_tenaga_kerja` varchar(20) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `jenis_tenaga_kerja` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tenaga_kerja`
--

INSERT INTO `tenaga_kerja` (`id_tenaga_kerja`, `nama_pegawai`, `jenis_tenaga_kerja`) VALUES
('TK2321', 'Dodi', 'Penjahit');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `role`, `last_login`, `last_logout`, `create_at`, `update_at`, `profil_pic`) VALUES
(1, 'admin', 'admin', '$2y$10$/fwaBZ/G3zrbRY0ceQhsOeZOVmYnEX8ABB4dAszjGY1e47aIqtC/W', 'admin', '2021-12-08 19:05:47', '2021-12-08 12:15:42', '2021-11-26 06:46:38', '0000-00-00 00:00:00', ''),
(2, 'produksi', 'produksi', '$2y$10$ikBZMyogCNr08C0i8IrSS.lo0jK/OsiOeXofCnaTp3DS1zzjtlXQG', 'produksi', '2021-12-08 18:58:11', '2021-12-08 11:58:48', '2021-11-26 06:47:26', '0000-00-00 00:00:00', ''),
(3, 'pembelian', 'pembelian', '$2y$10$QU0YlPbLtntkI9xLEOu7aubLqh0wxhdxa/6sQSaj4oDq6kDdPWgcS', 'pembelian', '2021-12-08 19:15:51', '2021-12-08 12:17:19', '2021-11-26 06:47:54', '0000-00-00 00:00:00', ''),
(4, 'manajemen kas', 'manajemenkas', '$2y$10$glB39yVZFlazHkHSx9f4/OMcv7IBayERTAqVzUduHEiDzmap/VE8W', 'manajemenkas', '2021-12-08 19:17:28', '2021-12-08 12:17:45', '2021-11-26 06:48:18', '0000-00-00 00:00:00', ''),
(5, 'keuangan', 'keuangan', '$2y$10$KD5g6xwkBDOftTYVEccYWOPEwqTRMVtdmzeew2VpkaqIkpWQIDZCu', 'keuangan', '2021-12-08 18:59:59', '2021-12-08 12:05:42', '2021-11-26 06:48:45', '2021-11-26 12:56:12', ''),
(6, 'gudang', 'gudang', '$2y$10$h2KVs3HgN0fGtqz8cYr5n.SjfV7d5fLQtoor.o/5/EuMgNhxsapse', 'gudang', '2021-12-08 18:59:37', '2021-12-08 11:59:47', '2021-11-26 06:49:08', '0000-00-00 00:00:00', ''),
(7, 'asdasdsdada', 'arnol123', '$2y$10$RqEFUJlqQzGvFWnAZ9CTneOqcWkk5wycJ52T8/DxQct28gGbVypTC', 'admin', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-11-26 10:30:00', '2021-11-26 18:21:15', ''),
(8, 'TESTER', 'tester', '$2y$10$/.3tP.KnkIc2.G8ztAZOFeR4dx4KK0ClCSXCqpAXhCLb1IIZ3DKMO', 'admin', '2021-11-27 13:11:43', '2021-11-27 06:11:48', '2021-11-27 06:10:41', '2021-11-27 13:11:11', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `utang`
--

CREATE TABLE `utang` (
  `id_utang` varchar(20) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `tot_utang` int(11) NOT NULL,
  `ket_utang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `utang`
--

INSERT INTO `utang` (`id_utang`, `tgl_bayar`, `tot_utang`, `ket_utang`) VALUES
('UT1232', '2021-12-02', 250000, 'apa saja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vendor`
--

CREATE TABLE `vendor` (
  `id_vendor` varchar(20) NOT NULL,
  `nama_vendor` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `vendor`
--

INSERT INTO `vendor` (`id_vendor`, `nama_vendor`, `alamat`, `no_telp`) VALUES
('V0001', 'Mahmud', 'Jl. pisang mangga 2 blok. K no 10', '08214885932');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id_aset`);

--
-- Indeks untuk tabel `aset_dimiliki`
--
ALTER TABLE `aset_dimiliki`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bahan_baku`
--
ALTER TABLE `bahan_baku`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indeks untuk tabel `bahan_pembelian`
--
ALTER TABLE `bahan_pembelian`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `barang_terjual`
--
ALTER TABLE `barang_terjual`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indeks untuk tabel `beban_op`
--
ALTER TABLE `beban_op`
  ADD PRIMARY KEY (`id_bebanop`);

--
-- Indeks untuk tabel `biaya_bahan`
--
ALTER TABLE `biaya_bahan`
  ADD PRIMARY KEY (`id_biaya_bahan`);

--
-- Indeks untuk tabel `biaya_overhead`
--
ALTER TABLE `biaya_overhead`
  ADD PRIMARY KEY (`id_biaya_overhead`);

--
-- Indeks untuk tabel `biaya_produksi`
--
ALTER TABLE `biaya_produksi`
  ADD PRIMARY KEY (`id_biaya_produksi`);

--
-- Indeks untuk tabel `biaya_tenaga_kerja`
--
ALTER TABLE `biaya_tenaga_kerja`
  ADD PRIMARY KEY (`id_biaya_tenaga`);

--
-- Indeks untuk tabel `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`id_bom`);

--
-- Indeks untuk tabel `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`kode_akun`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `ekspedisi`
--
ALTER TABLE `ekspedisi`
  ADD PRIMARY KEY (`id_ekspedisi`);

--
-- Indeks untuk tabel `eoq`
--
ALTER TABLE `eoq`
  ADD PRIMARY KEY (`id_eoq`);

--
-- Indeks untuk tabel `good_issue`
--
ALTER TABLE `good_issue`
  ADD PRIMARY KEY (`id_good`);

--
-- Indeks untuk tabel `history_bahan_baku`
--
ALTER TABLE `history_bahan_baku`
  ADD PRIMARY KEY (`id_history_bahan`);

--
-- Indeks untuk tabel `history_biaya_bahan`
--
ALTER TABLE `history_biaya_bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_biaya_overhead`
--
ALTER TABLE `history_biaya_overhead`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_biaya_produksi`
--
ALTER TABLE `history_biaya_produksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_biaya_tenaga`
--
ALTER TABLE `history_biaya_tenaga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_good_issue`
--
ALTER TABLE `history_good_issue`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_jadwal`
--
ALTER TABLE `history_jadwal`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_op`
--
ALTER TABLE `history_op`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_pembayaran_pembelian`
--
ALTER TABLE `history_pembayaran_pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_pembelian_aset`
--
ALTER TABLE `history_pembelian_aset`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_pembelian_bahan`
--
ALTER TABLE `history_pembelian_bahan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_penjualan`
--
ALTER TABLE `history_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `history_ut`
--
ALTER TABLE `history_ut`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `investasi`
--
ALTER TABLE `investasi`
  ADD PRIMARY KEY (`kode_inves`);

--
-- Indeks untuk tabel `jadwal_produksi`
--
ALTER TABLE `jadwal_produksi`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indeks untuk tabel `jenis_beban`
--
ALTER TABLE `jenis_beban`
  ADD PRIMARY KEY (`id_jen_beban`);

--
-- Indeks untuk tabel `jenis_penerimaan`
--
ALTER TABLE `jenis_penerimaan`
  ADD PRIMARY KEY (`id_jenis_penerimaan`);

--
-- Indeks untuk tabel `jenis_utang`
--
ALTER TABLE `jenis_utang`
  ADD PRIMARY KEY (`id_jen_utang`);

--
-- Indeks untuk tabel `login_activity`
--
ALTER TABLE `login_activity`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `merchant`
--
ALTER TABLE `merchant`
  ADD PRIMARY KEY (`id_merchant`);

--
-- Indeks untuk tabel `operasional`
--
ALTER TABLE `operasional`
  ADD PRIMARY KEY (`kode_operasional`);

--
-- Indeks untuk tabel `operation_list`
--
ALTER TABLE `operation_list`
  ADD PRIMARY KEY (`id_operation`);

--
-- Indeks untuk tabel `overhead`
--
ALTER TABLE `overhead`
  ADD PRIMARY KEY (`id_overhead`);

--
-- Indeks untuk tabel `pembayaran_pembelian`
--
ALTER TABLE `pembayaran_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_aset`
--
ALTER TABLE `pembelian_aset`
  ADD PRIMARY KEY (`id_pembelian_aset`);

--
-- Indeks untuk tabel `pembelian_bahan`
--
ALTER TABLE `pembelian_bahan`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `pembelian_permintaan_bahan`
--
ALTER TABLE `pembelian_permintaan_bahan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indeks untuk tabel `pendanaan`
--
ALTER TABLE `pendanaan`
  ADD PRIMARY KEY (`kode_pendanaan`);

--
-- Indeks untuk tabel `penerimaan_kas`
--
ALTER TABLE `penerimaan_kas`
  ADD PRIMARY KEY (`id_penerimaan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `perhitungan_costing`
--
ALTER TABLE `perhitungan_costing`
  ADD PRIMARY KEY (`id_costing`);

--
-- Indeks untuk tabel `permintaan_bahan`
--
ALTER TABLE `permintaan_bahan`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indeks untuk tabel `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indeks untuk tabel `persediaan_barang`
--
ALTER TABLE `persediaan_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `prive`
--
ALTER TABLE `prive`
  ADD PRIMARY KEY (`id_prive`);

--
-- Indeks untuk tabel `produk_jadi`
--
ALTER TABLE `produk_jadi`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `safety_stok`
--
ALTER TABLE `safety_stok`
  ADD PRIMARY KEY (`id_safety`);

--
-- Indeks untuk tabel `tenaga_kerja`
--
ALTER TABLE `tenaga_kerja`
  ADD PRIMARY KEY (`id_tenaga_kerja`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `utang`
--
ALTER TABLE `utang`
  ADD PRIMARY KEY (`id_utang`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aset_dimiliki`
--
ALTER TABLE `aset_dimiliki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `barang_terjual`
--
ALTER TABLE `barang_terjual`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `history_biaya_bahan`
--
ALTER TABLE `history_biaya_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `history_biaya_overhead`
--
ALTER TABLE `history_biaya_overhead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `history_biaya_produksi`
--
ALTER TABLE `history_biaya_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `history_biaya_tenaga`
--
ALTER TABLE `history_biaya_tenaga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `history_good_issue`
--
ALTER TABLE `history_good_issue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `history_jadwal`
--
ALTER TABLE `history_jadwal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `history_op`
--
ALTER TABLE `history_op`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `history_pembayaran_pembelian`
--
ALTER TABLE `history_pembayaran_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `history_pembelian_aset`
--
ALTER TABLE `history_pembelian_aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `history_pembelian_bahan`
--
ALTER TABLE `history_pembelian_bahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `history_penjualan`
--
ALTER TABLE `history_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `history_ut`
--
ALTER TABLE `history_ut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `login_activity`
--
ALTER TABLE `login_activity`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT untuk tabel `perhitungan_costing`
--
ALTER TABLE `perhitungan_costing`
  MODIFY `id_costing` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `persediaan_barang`
--
ALTER TABLE `persediaan_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
