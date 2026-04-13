-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2026 at 01:14 AM
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
-- Database: `peminjaman_alat`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `aksi`, `modul`, `deskripsi`, `created_at`, `updated_at`) VALUES
(5, 1, 'pinjam', 'peminjaman', 'Meminjam alat: Gerinda Tangan', '2026-01-31 22:59:51', '2026-01-31 22:59:51'),
(6, 1, 'kembalikan', 'peminjaman', 'Mengembalikan alat: Gerinda Tangan', '2026-01-31 23:03:09', '2026-01-31 23:03:09'),
(7, 1, 'tambah', 'kategori', 'Menambahkan kategori: aelxander', '2026-01-31 23:10:25', '2026-01-31 23:10:25'),
(8, 1, 'Hapus', 'kategori', 'Menghapus kategori: aelxander', '2026-01-31 23:12:03', '2026-01-31 23:12:03'),
(9, 1, 'update', 'alat', 'Update alat: baut', '2026-02-04 17:31:41', '2026-02-04 17:31:41'),
(10, 1, 'hapus', 'alat', 'Menghapus alat: baut', '2026-02-04 17:32:28', '2026-02-04 17:32:28'),
(11, 1, 'update', 'alat', 'Update alat: Compressor', '2026-02-04 17:42:11', '2026-02-04 17:42:11'),
(12, 1, 'update', 'alat', 'Update alat: Jack Hammer', '2026-02-04 17:46:50', '2026-02-04 17:46:50'),
(13, 1, 'update', 'alat', 'Update alat: Mesin Molen', '2026-02-04 18:04:17', '2026-02-04 18:04:17'),
(14, 1, 'update', 'alat', 'Update alat: Obeng Set', '2026-02-04 18:05:43', '2026-02-04 18:05:43'),
(15, 1, 'update', 'alat', 'Update alat: Kunci Inggris', '2026-02-04 18:06:43', '2026-02-04 18:06:43'),
(16, 1, 'update', 'alat', 'Update alat: Palu Besi', '2026-02-04 18:07:15', '2026-02-04 18:07:15'),
(17, 1, 'update', 'alat', 'Update alat: Gerinda Duduk', '2026-02-04 18:07:50', '2026-02-04 18:07:50'),
(18, 1, 'update', 'alat', 'Update alat: Gerinda Tangan', '2026-02-04 18:08:54', '2026-02-04 18:08:54'),
(19, 1, 'update', 'alat', 'Update alat: BOR Tangan', '2026-02-04 18:09:24', '2026-02-04 18:09:24'),
(20, 1, 'update', 'alat', 'Update alat: BOR Beton', '2026-02-04 18:09:58', '2026-02-04 18:09:58'),
(21, 1, 'update', 'alat', 'Update alat: BOR Listrik', '2026-02-04 18:10:33', '2026-02-04 18:10:33'),
(22, 1, 'update', 'alat', 'Update alat: Mesin Molen', '2026-02-04 18:21:03', '2026-02-04 18:21:03'),
(23, 1, 'update', 'alat', 'Update alat: Obeng Set', '2026-02-04 18:26:02', '2026-02-04 18:26:02'),
(24, 1, 'update', 'alat', 'Update alat: Kunci Inggris', '2026-02-04 23:45:57', '2026-02-04 23:45:57'),
(25, 1, 'update', 'alat', 'Update alat: Palu Besi', '2026-02-04 23:48:34', '2026-02-04 23:48:34'),
(26, 1, 'update', 'alat', 'Update alat: Gerinda Duduk', '2026-02-04 23:51:06', '2026-02-04 23:51:06'),
(27, 1, 'update', 'alat', 'Update alat: Gerinda Tangan', '2026-02-04 23:52:44', '2026-02-04 23:52:44'),
(28, 1, 'update', 'alat', 'Update alat: BOR Tangan', '2026-02-04 23:54:42', '2026-02-04 23:54:42'),
(29, 1, 'update', 'alat', 'Update alat: BOR Beton', '2026-02-04 23:55:45', '2026-02-04 23:55:45'),
(30, 1, 'hapus', 'alat', 'Menghapus alat: BOR Listrik', '2026-02-04 23:57:39', '2026-02-04 23:57:39'),
(31, 2, 'pinjam', 'peminjaman', 'Meminjam alat: Compressor', '2026-02-05 04:37:25', '2026-02-05 04:37:25'),
(32, 2, 'ajukan', 'peminjaman', 'Mengajukan peminjaman alat: Jack Hammer', '2026-02-05 05:10:21', '2026-02-05 05:10:21'),
(33, 3, 'setujui', 'peminjaman', 'Menyetujui peminjaman alat: ', '2026-02-06 00:05:55', '2026-02-06 00:05:55'),
(34, 2, 'kembalikan', 'peminjaman', 'Mengembalikan alat: ', '2026-02-06 00:19:45', '2026-02-06 00:19:45'),
(35, 2, 'ajukan', 'peminjaman', 'Mengajukan peminjaman alat: ', '2026-02-11 16:58:34', '2026-02-11 16:58:34'),
(36, 3, 'setujui', 'peminjaman', 'Menyetujui peminjaman alat: ', '2026-02-11 16:59:54', '2026-02-11 16:59:54'),
(37, 2, 'ajukan', 'peminjaman', 'Mengajukan peminjaman alat: ', '2026-02-11 17:44:13', '2026-02-11 17:44:13'),
(38, 3, 'tolak', 'peminjaman', 'Menolak peminjaman alat: Palu Besi', '2026-02-11 17:49:12', '2026-02-11 17:49:12'),
(39, 2, 'ajukan', 'peminjaman', 'Mengajukan peminjaman alat: ', '2026-02-11 19:06:24', '2026-02-11 19:06:24'),
(40, 2, 'ajukan', 'peminjaman', 'Mengajukan peminjaman alat: ', '2026-03-30 19:01:23', '2026-03-30 19:01:23'),
(41, 1, 'tambah', 'kategori', 'Menambahkan kategori: abangg', '2026-03-30 19:19:03', '2026-03-30 19:19:03'),
(42, 1, 'hapus', 'kategori', 'Menghapus kategori: abangg', '2026-03-30 19:19:12', '2026-03-30 19:19:12'),
(43, 2, 'ajukan', 'peminjaman', 'Mengajukan peminjaman alat: ', '2026-04-01 19:05:28', '2026-04-01 19:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `alats`
--

CREATE TABLE `alats` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_alat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_alat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `stok` int NOT NULL,
  `status` enum('tersedia','dipinjam') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alats`
--

INSERT INTO `alats` (`id`, `nama_alat`, `kode_alat`, `kategori_id`, `stok`, `status`, `deskripsi`, `image`, `created_at`, `updated_at`) VALUES
(2, 'BOR Beton', 'BOR-002', 1, 10, 'tersedia', 'Bor beton adalah alat untuk melubangi material keras seperti beton, tembok, dan batu dengan tenaga putar dan pukulan.', 'alat/qrwjYyrtweXyB9T8nhjQAyzFTMYXfKE9s2SGuyYK.jpg', '2026-01-26 01:21:12', '2026-02-04 23:55:45'),
(3, 'BOR Tangan', 'BOR-003', 1, 10, 'tersedia', 'Bor tangan adalah alat untuk membuat lubang atau memasang sekrup pada berbagai jenis material.', 'alat/8bD80nSvha2XhzOgOSf0ACXHduYobAA9OUUUfadi.jpg', '2026-01-26 01:22:07', '2026-02-04 23:54:42'),
(4, 'Gerinda Tangan', 'GRN-001', 2, 10, 'tersedia', 'Gerinda tangan adalah alat untuk memotong, menghaluskan, atau mengikis material seperti besi dan batu secara praktis dan fleksibel.', 'alat/WF97wv67U6Fp1Z5UeFYVpwnv5pKOHOXUGdU5GJM3.jpg', '2026-01-26 01:22:48', '2026-02-04 23:52:44'),
(5, 'Gerinda Duduk', 'GRN-002', 2, 10, 'tersedia', 'Gerinda duduk adalah alat untuk mengasah, meratakan, atau memotong material dengan tingkat presisi yang stabil.', 'alat/vi2ffT9rTRvYMPl8KcRREn9ZU2m5kmnpByErhk5I.jpg', '2026-01-26 01:23:26', '2026-02-04 23:51:06'),
(6, 'Palu Besi', 'PL-001', 3, 10, 'tersedia', 'Palu besi adalah alat yang digunakan untuk memukul, memasang, atau melepas benda keras seperti paku dan besi.', 'alat/fJhOLYUwL0IXTp2cOYQlfbcsTb1LUGpesyxnbA6J.jpg', '2026-01-26 01:24:07', '2026-02-04 23:48:34'),
(7, 'Kunci Inggris', 'KI-001', 3, 10, 'tersedia', 'Kunci inggris adalah alat yang digunakan untuk mengencangkan atau melepas mur dan baut dengan ukuran yang dapat disesuaikan.', 'alat/cSOloqlLtUNjlzLg0JdtF2w2vhuEmBmkZRBozhe0.jpg', '2026-01-26 01:24:44', '2026-02-04 23:45:56'),
(8, 'Obeng Set', 'OB-001', 3, 9, 'tersedia', 'Obeng set adalah satu set alat yang digunakan untuk mengencangkan atau melepas sekrup dengan berbagai ukuran dan jenis.', 'alat/b6Rbsj5GsSNxx2T9EpOHXnry3c9uoejCKIzXKCM3.jpg', '2026-01-26 01:25:27', '2026-02-11 16:59:53'),
(9, 'Mesin Molen', 'MOL-001', 4, 10, 'tersedia', 'Mesin molen adalah alat untuk mencampur semen, pasir, dan air secara merata dalam proses pembuatan adukan beton pada pekerjaan konstruksi.', 'alat/ofopxvphGlGumH9SYAjzcyaOyuxtwDuSxzRekJXP.jpg', '2026-01-26 01:26:04', '2026-02-04 18:21:03'),
(10, 'Jack Hammer', 'JH-001', 4, 9, 'tersedia', 'Jack hammer adalah alat untuk memecah beton, aspal, atau permukaan keras lainnya menggunakan getaran dan pukulan kuat.', 'alat/49CNLeuEOUIYEe3nxpTdCk8BX0AQT5Eo0qU2Ghsr.webp', '2026-01-26 01:26:38', '2026-02-06 00:05:55'),
(11, 'Compressor', 'CMP-001', 4, 6, 'tersedia', 'compressor adalah alat untuk menghasilkan udara bertekanan guna mendukung berbagai pekerjaan.', 'alat/qIWkSYYI4blLBopNMvAcet1n1Vi6pN9i7bvAAXcf.webp', '2026-01-26 01:27:38', '2026-04-01 19:01:10');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `name`, `deskripsi`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'BOR', 'Kategori Bor menyediakan berbagai jenis mesin bor untuk kebutuhan pertukangan dan konstruksi, baik untuk material kayu, besi, maupun beton. Tersedia dalam berbagai ukuran dan spesifikasi sesuai kebutuhan pekerjaan Anda.', 'bor', '2026-01-26 01:15:04', '2026-01-26 01:15:04'),
(2, 'Gerinda', 'Gerinda adalah alat listrik yang digunakan untuk memotong dan menghaluskan material seperti besi, baja, atau keramik. Cocok untuk pekerjaan konstruksi dan pertukangan karena praktis dan serbaguna.', 'gerinda', '2026-01-26 01:17:02', '2026-01-26 01:17:02'),
(3, 'Alat Tangan', 'Alat Tangan adalah peralatan manual yang digunakan tanpa tenaga listrik, seperti palu, obeng, tang, dan kunci pas. Cocok untuk berbagai pekerjaan perbaikan dan perakitan dengan penggunaan yang praktis dan mudah.', 'alat-tangan', '2026-01-26 01:17:49', '2026-01-26 01:17:49'),
(4, 'Alat Proyek', 'Alat Proyek adalah peralatan yang digunakan dalam kegiatan konstruksi atau pekerjaan lapangan, seperti bor, mesin pemotong, dan alat ukur. Dirancang untuk membantu pekerjaan menjadi lebih cepat, efisien, dan presisi.', 'alat-proyek', '2026-01-26 01:18:40', '2026-01-26 01:18:40');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_18_123216_add_role_to_users_table', 1),
(5, '2026_01_18_123239_create_kategoris_table', 1),
(6, '2026_01_18_124239_create_alats_table', 1),
(7, '2026_01_20_105915_create_peminjamen_table', 1),
(8, '2026_01_27_035329_create_peminjaman_table', 2),
(9, '2026_01_28_120939_add_user_id_to_peminjamen_table', 3),
(10, '2026_02_01_045842_create_activity_logs_table', 4),
(11, '2026_02_04_084216_add_image_to_alats_table', 5),
(12, '2026_02_12_001809_add_alasan_penolakan_to_peminjaman_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peminjamen`
--

CREATE TABLE `peminjamen` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `alat_id` bigint UNSIGNED NOT NULL,
  `nama_peminjam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` enum('menunggu','disetujui','dikembalikan','ditolak') COLLATE utf8mb4_unicode_ci DEFAULT 'menunggu',
  `alasan_penolakan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjamen`
--

INSERT INTO `peminjamen` (`id`, `user_id`, `alat_id`, `nama_peminjam`, `alamat`, `no_telp`, `tanggal_pinjam`, `tanggal_kembali`, `status`, `alasan_penolakan`, `created_at`, `updated_at`) VALUES
(8, 1, 3, 'farel', 'cibingbin', '082134546321', '2026-02-01', '2026-02-01', 'dikembalikan', NULL, '2026-01-31 21:14:37', '2026-01-31 21:27:54'),
(9, 1, 8, 'Ghifari', 'bakrom', '082134546321', '2026-02-01', '2026-02-01', 'dikembalikan', NULL, '2026-01-31 21:34:46', '2026-01-31 21:38:02'),
(11, 1, 4, 'farel', 'ytytrytrtyr', '083454326754', '2026-02-01', '2026-02-01', 'dikembalikan', NULL, '2026-01-31 22:59:51', '2026-01-31 23:03:09'),
(12, 2, 11, 'Andi', 'cempaka', '098354657986', '2026-02-05', '2026-02-06', 'dikembalikan', NULL, '2026-02-05 04:37:24', '2026-02-06 00:19:45'),
(13, 2, 10, 'Abdan', 'Cimindi', '083454322143', '2026-02-05', NULL, 'disetujui', NULL, '2026-02-05 05:10:21', '2026-02-06 00:05:55'),
(14, 2, 8, 'Ndiww', 'Cempaka', '082134546321', '2026-02-12', NULL, 'disetujui', NULL, '2026-02-11 16:58:31', '2026-02-11 16:59:54'),
(15, 2, 6, 'Pareski', 'jln.Sangkuriang', '083454322143', '2026-02-12', NULL, 'ditolak', 'Dibagian nama terdapat unsur rasisme', '2026-02-11 17:44:13', '2026-02-11 17:49:12'),
(16, 2, 11, 'Kintara', 'Jln.Cimareme', '083454326754', '2026-02-13', NULL, 'menunggu', NULL, '2026-02-11 19:06:23', '2026-02-11 19:06:23'),
(17, 2, 11, 'abng', 'dijalan', '08765678764', '2026-03-31', NULL, 'disetujui', NULL, '2026-03-30 19:01:20', '2026-03-30 19:04:03'),
(18, 2, 11, 'farel', 'jln bandung', '08765432354', '2026-04-02', NULL, 'disetujui', NULL, '2026-04-01 18:58:50', '2026-04-01 18:58:50'),
(19, 2, 11, 'farel', 'jln.Bandung', '087654567689', '2026-04-02', NULL, 'dikembalikan', NULL, '2026-04-01 19:01:10', '2026-04-02 00:28:09'),
(20, 2, 11, 'evi', 'jln.bandung', '082134546321', '2026-04-02', NULL, 'menunggu', NULL, '2026-04-01 19:05:28', '2026-04-01 19:05:28');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin@gmail.com', 'admin', NULL, '$2y$12$61eOWRo4afP5D4FXo6ePQ.ZbAqV1dZoizr8jD5N2i3OABCAfzwUXe', NULL, '2026-01-26 01:12:37', '2026-02-04 00:20:43'),
(2, 'User', 'User@gmail.com', 'user', NULL, '$2y$12$sSGPHntA/CG3Ddkb4Ei0G.ba2fmqMdMVbdAZHlphAl8Modo0Y0yoG', NULL, '2026-02-04 00:16:19', '2026-02-04 00:16:19'),
(3, 'Petugas', 'Petugas@gmail.com', 'petugas', NULL, '$2y$12$ilfOvCu7EVn711KMvuSuJ.rinAMS8fVgVAPh9vejRec0duunHhTty', NULL, '2026-02-04 00:18:13', '2026-02-04 00:20:12'),
(4, 'abang', 'abangaerul12@gmail.com', 'user', NULL, '$2y$12$Xly8vjYSzCKEJsVwiJxJtuNXbKoq/V9Vapk4II7kFpjMDB.W4x74G', NULL, '2026-03-30 19:10:06', '2026-03-30 19:10:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `alats`
--
ALTER TABLE `alats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alats_kode_alat_unique` (`kode_alat`),
  ADD KEY `alats_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kategori_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjamen_alat_id_foreign` (`alat_id`),
  ADD KEY `peminjamen_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `alats`
--
ALTER TABLE `alats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjamen`
--
ALTER TABLE `peminjamen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `alats`
--
ALTER TABLE `alats`
  ADD CONSTRAINT `alats_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamen`
--
ALTER TABLE `peminjamen`
  ADD CONSTRAINT `peminjamen_alat_id_foreign` FOREIGN KEY (`alat_id`) REFERENCES `alats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjamen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
