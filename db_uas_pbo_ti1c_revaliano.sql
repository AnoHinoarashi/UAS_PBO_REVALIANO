-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2026 at 06:09 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1c_revaliano`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_karyawan`
--

CREATE TABLE `tabel_karyawan` (
  `id_karyawan` varchar(10) NOT NULL,
  `nama_karyawan` varchar(100) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `hari_kerja_masuk` int NOT NULL,
  `gaji_dasar_per_hari` decimal(12,2) NOT NULL,
  `jenis_karyawan` enum('kontrak','tetap','magang') NOT NULL,
  `durasi_kontrak_bulan` int DEFAULT NULL,
  `agensi_penyalur` varchar(100) DEFAULT NULL,
  `tunjangan_kesehatan` decimal(12,2) DEFAULT NULL,
  `opsi_saham_id` varchar(20) DEFAULT NULL,
  `uang_saku_bulanan` decimal(12,2) DEFAULT NULL,
  `sertifikat_kampus_merdeka` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_karyawan`
--

INSERT INTO `tabel_karyawan` (`id_karyawan`, `nama_karyawan`, `departemen`, `hari_kerja_masuk`, `gaji_dasar_per_hari`, `jenis_karyawan`, `durasi_kontrak_bulan`, `agensi_penyalur`, `tunjangan_kesehatan`, `opsi_saham_id`, `uang_saku_bulanan`, `sertifikat_kampus_merdeka`) VALUES
('KAY-001', 'Revaliano', 'IT Support', 22, 250000.00, 'tetap', NULL, NULL, 500000.00, 'ESOP-001', NULL, NULL),
('KAY-002', 'Amelia Putri', 'Human Resources', 21, 200000.00, 'tetap', NULL, NULL, 450000.00, 'ESOP-002', NULL, NULL),
('KAY-003', 'Budi Santoso', 'Finance', 23, 220000.00, 'tetap', NULL, NULL, 450000.00, 'ESOP-003', NULL, NULL),
('KAY-004', 'Citra Dewi', 'Marketing', 20, 210000.00, 'tetap', NULL, NULL, 400000.00, 'ESOP-004', NULL, NULL),
('KAY-005', 'Dedi Kurniawan', 'Engineering', 22, 300000.00, 'tetap', NULL, NULL, 600000.00, 'ESOP-005', NULL, NULL),
('KAY-006', 'Eka Rahmawati', 'Legal', 21, 240000.00, 'tetap', NULL, NULL, 500000.00, 'ESOP-006', NULL, NULL),
('KAY-007', 'Fahmi Idris', 'Operations', 22, 190000.00, 'tetap', NULL, NULL, 400000.00, 'ESOP-007', NULL, NULL),
('KAY-008', 'Gita Permata', 'Marketing', 22, 180000.00, 'kontrak', 12, 'PT Mitra Sumber Daya', NULL, NULL, NULL, NULL),
('KAY-009', 'Hendra Wijaya', 'IT Support', 19, 200000.00, 'kontrak', 6, 'PT Global Talent', NULL, NULL, NULL, NULL),
('KAY-010', 'Indah Lestari', 'Finance', 21, 185000.00, 'kontrak', 12, 'PT Mitra Sumber Daya', NULL, NULL, NULL, NULL),
('KAY-011', 'Joko Susilo', 'Engineering', 22, 250000.00, 'kontrak', 24, 'PT Tech Solusindo', NULL, NULL, NULL, NULL),
('KAY-012', 'Kartika Sari', 'Human Resources', 20, 170000.00, 'kontrak', 6, 'PT Global Talent', NULL, NULL, NULL, NULL),
('KAY-013', 'Lukman Hakim', 'Operations', 23, 165000.00, 'kontrak', 12, 'PT Outsource Nusantara', NULL, NULL, NULL, NULL),
('KAY-014', 'Mega Utami', 'Procurement', 21, 175000.00, 'kontrak', 6, 'PT Outsource Nusantara', NULL, NULL, NULL, NULL),
('KAY-015', 'Naufal Abdi', 'Engineering', 22, 90000.00, 'magang', NULL, NULL, NULL, NULL, 2000000.00, 'Sertifikat MSIB - Batch 6'),
('KAY-016', 'Olivia Zalianty', 'Marketing', 18, 80000.00, 'magang', NULL, NULL, NULL, NULL, 1500000.00, 'Sertifikat Mandiri - Universitas'),
('KAY-017', 'Putra Perdana', 'IT Support', 20, 95000.00, 'magang', NULL, NULL, NULL, NULL, 2100000.00, 'Sertifikat MSIB - Batch 6'),
('KAY-018', 'Qonita Aulia', 'Human Resources', 21, 85000.00, 'magang', NULL, NULL, NULL, NULL, 1800000.00, 'Sertifikat MSIB - Batch 5'),
('KAY-019', 'Rian Hidayat', 'Finance', 15, 80000.00, 'magang', NULL, NULL, NULL, NULL, 1500000.00, 'Sertifikat Mandiri - Fakultas'),
('KAY-020', 'Siti Aminah', 'Design', 22, 90000.00, 'magang', NULL, NULL, NULL, NULL, 2000000.00, 'Sertifikat MSIB - Batch 6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_karyawan`
--
ALTER TABLE `tabel_karyawan`
  ADD PRIMARY KEY (`id_karyawan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
