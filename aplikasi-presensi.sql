-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2024 pada 06.21
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi-presensi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(6, '0001_01_01_000000_create_users_table', 1),
(7, '0001_01_01_000001_create_cache_table', 1),
(8, '0001_01_01_000002_create_jobs_table', 1),
(10, '2024_11_06_070938_create_presensi_table', 2),
(11, '2024_11_12_151907_add_profile_image_to_users_table', 3),
(12, '2024_11_13_144956_add_image_and_keterangan_to_presensi_table', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `presensi`
--

CREATE TABLE `presensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('Hadir','Izin','Sakit') NOT NULL DEFAULT 'Hadir',
  `image_path` varchar(255) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `qr_code_data` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `presensi`
--

INSERT INTO `presensi` (`id`, `user_id`, `timestamp`, `status`, `image_path`, `keterangan`, `qr_code_data`, `created_at`, `updated_at`) VALUES
(6, 3, '2024-11-07 09:04:50', 'Hadir', NULL, NULL, '510001', '2024-11-07 02:04:50', '2024-11-07 02:04:50'),
(7, 2, '2024-11-07 10:09:14', 'Hadir', NULL, NULL, '710001', '2024-11-07 03:09:14', '2024-11-07 03:09:14'),
(9, 2, '2024-11-08 14:53:59', 'Hadir', NULL, NULL, '710001', '2024-11-08 07:53:59', '2024-11-08 07:53:59'),
(14, 2, '2024-11-11 12:52:19', 'Hadir', NULL, NULL, '710001', '2024-11-11 05:52:19', '2024-11-11 05:52:19'),
(15, 3, '2024-11-11 13:11:38', 'Hadir', NULL, NULL, '510001', '2024-11-11 06:11:38', '2024-11-11 06:11:38'),
(45, 8, '2024-11-11 17:25:18', 'Hadir', NULL, NULL, '654001', '2024-11-11 10:25:18', '2024-11-11 10:25:18'),
(46, 8, '2024-11-12 14:05:05', 'Hadir', NULL, NULL, '654001', '2024-11-12 07:05:05', '2024-11-12 07:05:05'),
(47, 3, '2024-11-12 14:12:19', 'Hadir', NULL, NULL, '510001', '2024-11-12 07:12:19', '2024-11-12 07:12:19'),
(48, 2, '2024-11-12 14:14:14', 'Hadir', NULL, NULL, '710001', '2024-11-12 07:14:14', '2024-11-12 07:14:14'),
(49, 4, '2024-11-12 16:21:27', 'Hadir', NULL, NULL, '670003', '2024-11-12 09:21:27', '2024-11-12 09:21:27'),
(50, 5, '2024-11-12 16:21:36', 'Hadir', NULL, NULL, '340201', '2024-11-12 09:21:36', '2024-11-12 09:21:36'),
(51, 6, '2024-11-12 16:21:46', 'Hadir', NULL, NULL, '647803', '2024-11-12 09:21:46', '2024-11-12 09:21:46'),
(53, 3, '2024-11-18 16:42:17', 'Hadir', NULL, NULL, '510001', '2024-11-18 09:42:17', '2024-11-18 09:42:17'),
(95, 2, '2024-11-18 19:49:38', 'Izin', 'D:\\xampp\\tmp\\phpC6F1.tmp', 'asdasdasd', '710001', '2024-11-18 12:53:26', '2024-11-18 12:53:26'),
(96, 2, '2024-11-19 13:19:40', 'Izin', 'D:\\xampp\\tmp\\phpEDDA.tmp', 'Tidak bisa hadir karena ada keperluan diluar', '710001', '2024-11-19 06:20:00', '2024-11-19 06:20:00'),
(97, 3, '2024-11-19 14:01:51', 'Sakit', 'D:\\xampp\\tmp\\php8D32.tmp', 'Sakit Pusing tidak bisa hadir ke kantor hari ini.', '510001', '2024-11-19 07:02:11', '2024-11-19 07:02:11'),
(98, 8, '2024-11-19 14:39:57', 'Izin', 'D:\\xampp\\tmp\\php5968.tmp', 'sdasdasd', '654001', '2024-11-19 07:40:11', '2024-11-19 07:40:11'),
(114, 2, '2024-11-20 14:18:17', 'Izin', '/storage/uploads/1732087202_jurnal partikulat.pdf', 'asdadasdas', '710001', '2024-11-20 07:20:02', '2024-11-20 07:20:02'),
(115, 8, '2024-11-20 14:21:08', 'Hadir', NULL, NULL, '654001', '2024-11-20 07:21:08', '2024-11-20 07:21:08'),
(116, 3, '2024-11-20 14:22:33', 'Sakit', '/storage/uploads/1732087374_WhatsApp Image 2024-11-13 at 21.42.05 (2).jpeg', 'Tidak bisa hadir ke kantor, dan hanya bisa melalui via online.', '510001', '2024-11-20 07:22:54', '2024-11-20 07:22:54'),
(117, 8, '2024-11-21 14:03:45', 'Hadir', NULL, NULL, '654001', '2024-11-21 07:03:45', '2024-11-21 07:03:45'),
(118, 6, '2024-11-21 14:04:13', 'Hadir', NULL, NULL, '647803', '2024-11-21 07:04:13', '2024-11-21 07:04:13'),
(119, 5, '2024-11-21 14:06:13', 'Hadir', NULL, NULL, '340201', '2024-11-21 07:06:13', '2024-11-21 07:06:13'),
(120, 2, '2024-11-21 14:08:31', 'Izin', '/storage/uploads/1732172926_1395-3023-1-SM.pdf', 'daaadadadad', '710001', '2024-11-21 07:08:47', '2024-11-21 07:08:47'),
(121, 3, '2024-11-21 14:13:24', 'Sakit', '/storage/uploads/1732173214_1395-3023-1-SM.pdf', 'asdasdmasdmaskfnaskfnas', '510001', '2024-11-21 07:13:35', '2024-11-21 07:13:35'),
(122, 2, '2024-11-22 00:32:05', 'Izin', '/storage/uploads/1732210361_1395-3023-1-SM.pdf', 'Tidak bisa hadir dikarenakan ada kelas.', '710001', '2024-11-21 17:32:41', '2024-11-21 17:32:41'),
(123, 3, '2024-11-22 18:14:36', 'Izin', '/storage/uploads/1732274084_default-profile.jpg', 'asdasdasdasdasd', '510001', '2024-11-22 11:14:45', '2024-11-22 11:14:45'),
(124, 8, '2024-11-22 18:15:12', 'Izin', '/storage/uploads/1732274121_default-profile.jpg', 'asadsadsadsadsads', '654001', '2024-11-22 11:15:21', '2024-11-22 11:15:21'),
(125, 4, '2024-11-22 18:17:55', 'Izin', '/storage/uploads/1732274294_default-profile.jpg', 'Astrsfdghdhhtfjyfjyjyfjyfjyfyjfj', '670003', '2024-11-22 11:18:14', '2024-11-22 11:18:14'),
(126, 5, '2024-11-22 18:19:47', 'Hadir', NULL, NULL, '340201', '2024-11-22 11:19:47', '2024-11-22 11:19:47'),
(127, 6, '2024-11-22 18:25:07', 'Hadir', NULL, NULL, '647803', '2024-11-22 11:25:07', '2024-11-22 11:25:07'),
(128, 8, '2024-11-23 15:10:13', 'Hadir', NULL, NULL, '654001', '2024-11-23 08:10:13', '2024-11-23 08:10:13'),
(129, 6, '2024-11-23 15:12:51', 'Hadir', NULL, NULL, '647803', '2024-11-23 08:12:51', '2024-11-23 08:12:51'),
(130, 5, '2024-11-23 15:14:07', 'Hadir', NULL, NULL, '340201', '2024-11-23 08:14:07', '2024-11-23 08:14:07'),
(131, 4, '2024-11-23 15:14:16', 'Hadir', NULL, NULL, '670003', '2024-11-23 08:14:16', '2024-11-23 08:14:16'),
(132, 3, '2024-11-23 15:14:25', 'Hadir', NULL, NULL, '510001', '2024-11-23 08:14:25', '2024-11-23 08:14:25'),
(133, 2, '2024-11-23 15:15:23', 'Sakit', '/storage/uploads/1732349778_LAPORAN PRAKTIKUM HYGIENE INDUSTRI HUMAN VIBRATION.pdf', 'Tidak bisa hadir dikarenakan tidak enak badan dan disarankan untuk beristirahat.', '710001', '2024-11-23 08:16:19', '2024-11-23 08:16:19'),
(134, 2, '2024-11-24 17:00:40', 'Izin', '/storage/uploads/1732442479_coba coba.pdf', 'tidak bisa hadir dikarenakan ada masalah yang harus diselesaikan', '710001', '2024-11-24 10:01:20', '2024-11-24 10:01:20'),
(135, 8, '2024-11-24 18:32:06', 'Hadir', NULL, NULL, '654001', '2024-11-24 11:32:06', '2024-11-24 11:32:06'),
(136, 6, '2024-11-24 18:32:19', 'Hadir', NULL, NULL, '647803', '2024-11-24 11:32:19', '2024-11-24 11:32:19'),
(137, 5, '2024-11-24 18:34:24', 'Hadir', NULL, NULL, '340201', '2024-11-24 11:34:24', '2024-11-24 11:34:24'),
(138, 4, '2024-11-24 18:39:40', 'Hadir', NULL, NULL, '670003', '2024-11-24 11:39:40', '2024-11-24 11:39:40'),
(139, 3, '2024-11-24 18:39:59', 'Hadir', NULL, NULL, '510001', '2024-11-24 11:39:59', '2024-11-24 11:39:59'),
(140, 5, '2024-11-28 19:04:37', 'Hadir', NULL, NULL, '340201', '2024-11-28 12:04:37', '2024-11-28 12:04:37'),
(141, 2, '2024-12-03 11:00:14', 'Hadir', NULL, NULL, '710001', '2024-12-03 04:00:14', '2024-12-03 04:00:14'),
(142, 3, '2024-12-03 11:01:04', 'Hadir', NULL, NULL, '510001', '2024-12-03 04:01:04', '2024-12-03 04:01:04'),
(143, 4, '2024-12-03 11:01:28', 'Hadir', NULL, NULL, '670003', '2024-12-03 04:01:28', '2024-12-03 04:01:28'),
(144, 5, '2024-12-03 11:01:36', 'Hadir', NULL, NULL, '340201', '2024-12-03 04:01:36', '2024-12-03 04:01:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5Q2h7AwIwCGsBiSeTz2Q0OgKV0AkunoI66QKWfpS', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZnpjdFdqQXQ1eFZ2ZTRoSm1hVkM2V1RMR3RHUzBKOVNpT1M5R2ZUSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hZG1pbi9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1733200100),
('lHcuVy4IDesNw8jCSHhqceZnpDc394HJ7rFKClMW', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibDB4MFZPREY2V0phQzNnTFUzQnZQSkZjVnZrcTV0UUpYOUxJNmlhVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM1OiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYWRtaW4vbGFwb3JhbiI7fX0=', 1733200018);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `jk` varchar(15) DEFAULT NULL,
  `divisi` varchar(50) DEFAULT NULL,
  `bagian` varchar(50) DEFAULT NULL,
  `role` enum('admin','karyawan') DEFAULT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 0,
  `qr_code_data` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nip`, `nik`, `nama`, `password`, `alamat`, `email`, `telepon`, `jk`, `divisi`, `bagian`, `role`, `checked`, `qr_code_data`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '1234567891011', 'Admin', '$2y$12$uiuG05yaOL4dodwbnGesku5lBiBN6SxN3nASDIZ5VAo2S8enyAXPe', 'Jl. Lamongan-Babat', 'admin@gmail.com', '0812345678910', 'Perempuan', 'Admin', 'Admin', 'admin', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(9.524)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M8 0L8 1L9 1L9 0ZM10 0L10 2L8 2L8 5L9 5L9 6L8 6L8 7L9 7L9 6L10 6L10 7L11 7L11 8L8 8L8 9L10 9L10 10L5 10L5 9L4 9L4 8L0 8L0 11L1 11L1 12L3 12L3 13L4 13L4 12L5 12L5 11L7 11L7 12L6 12L6 13L7 13L7 12L12 12L12 13L11 13L11 15L10 15L10 16L9 16L9 17L8 17L8 21L9 21L9 20L10 20L10 21L11 21L11 19L10 19L10 18L9 18L9 17L10 17L10 16L11 16L11 15L13 15L13 14L12 14L12 13L13 13L13 12L12 12L12 10L15 10L15 9L14 9L14 8L13 8L13 5L12 5L12 4L13 4L13 3L12 3L12 1L13 1L13 0ZM10 2L10 4L9 4L9 5L11 5L11 4L12 4L12 3L11 3L11 2ZM11 6L11 7L12 7L12 6ZM6 8L6 9L7 9L7 8ZM16 8L16 9L17 9L17 11L14 11L14 12L15 12L15 13L14 13L14 14L15 14L15 16L12 16L12 17L11 17L11 18L12 18L12 19L13 19L13 21L14 21L14 19L16 19L16 20L15 20L15 21L16 21L16 20L17 20L17 19L19 19L19 18L20 18L20 17L21 17L21 16L20 16L20 15L18 15L18 14L19 14L19 13L18 13L18 14L17 14L17 15L16 15L16 14L15 14L15 13L16 13L16 12L18 12L18 10L19 10L19 11L21 11L21 8L20 8L20 10L19 10L19 8ZM1 10L1 11L4 11L4 10ZM10 10L10 11L11 11L11 10ZM8 13L8 14L10 14L10 13ZM20 13L20 14L21 14L21 13ZM12 17L12 18L13 18L13 19L14 19L14 17ZM15 17L15 18L16 18L16 19L17 19L17 18L18 18L18 17L17 17L17 18L16 18L16 17ZM20 19L20 20L21 20L21 19ZM18 20L18 21L19 21L19 20ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '2024-11-06 00:44:22', '2024-11-06 00:44:22'),
(2, '710001', '3548021211034322', 'Ardhito Reynata', '$2y$12$z.SV72dGAFOxa5ynXKyMsupr33EedQKEcBLEiFBGmMY9qvQpoZale', 'Rungkut Asri Barat 12 No. 4', 'ditoardhito83@gmail.com', '082139962799', 'Laki-Laki', 'IT Support', 'Pengembangan Web', 'karyawan', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(9.524)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 1L8 1L8 3L9 3L9 4L8 4L8 8L6 8L6 9L5 9L5 10L3 10L3 11L2 11L2 8L0 8L0 9L1 9L1 10L0 10L0 11L2 11L2 12L4 12L4 13L5 13L5 11L7 11L7 10L8 10L8 8L9 8L9 10L10 10L10 12L12 12L12 13L10 13L10 14L9 14L9 12L8 12L8 15L10 15L10 17L11 17L11 18L10 18L10 19L11 19L11 18L12 18L12 19L13 19L13 20L11 20L11 21L13 21L13 20L15 20L15 19L13 19L13 18L12 18L12 16L14 16L14 17L17 17L17 18L16 18L16 21L19 21L19 20L20 20L20 19L21 19L21 16L18 16L18 15L19 15L19 14L17 14L17 12L16 12L16 13L15 13L15 12L14 12L14 13L15 13L15 16L14 16L14 14L13 14L13 15L11 15L11 14L12 14L12 13L13 13L13 12L12 12L12 11L14 11L14 10L15 10L15 9L17 9L17 10L18 10L18 11L19 11L19 12L18 12L18 13L20 13L20 15L21 15L21 13L20 13L20 12L21 12L21 9L20 9L20 8L18 8L18 9L17 9L17 8L14 8L14 10L12 10L12 11L11 11L11 10L10 10L10 9L11 9L11 8L13 8L13 4L12 4L12 3L13 3L13 2L12 2L12 1L13 1L13 0L11 0L11 2L12 2L12 3L11 3L11 4L12 4L12 5L11 5L11 6L10 6L10 7L9 7L9 4L10 4L10 0ZM11 6L11 7L12 7L12 6ZM3 8L3 9L4 9L4 8ZM6 9L6 10L7 10L7 9ZM18 9L18 10L19 10L19 11L20 11L20 10L19 10L19 9ZM0 12L0 13L1 13L1 12ZM6 12L6 13L7 13L7 12ZM16 14L16 15L17 15L17 14ZM17 16L17 17L18 17L18 16ZM8 17L8 18L9 18L9 17ZM17 18L17 20L18 20L18 19L20 19L20 18ZM8 19L8 21L10 21L10 20L9 20L9 19ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z\" fill=\"#000000\"/></g></g></svg>\n', 'public/profile_images/1732364716.jpg', '2024-11-06 00:44:22', '2024-12-03 04:26:04'),
(3, '510001', '3578031212970001', 'Handri Hermawan', '$2y$12$8Gy6MUOMxrjP9V1RwYl7VuXMk7EI6pmInV1iijwsJq1MqOmiHIzE.', 'Jl. Lamongan Utara', 'handrihermawan@gmail.com', '0813467891029', 'Laki-Laki', 'SDM', 'HRD', 'karyawan', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(9.524)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 2L8 2L8 3L9 3L9 4L10 4L10 5L11 5L11 4L12 4L12 7L11 7L11 6L10 6L10 7L9 7L9 6L8 6L8 8L4 8L4 9L5 9L5 10L4 10L4 11L5 11L5 13L7 13L7 12L9 12L9 10L11 10L11 9L12 9L12 8L13 8L13 9L14 9L14 10L15 10L15 8L13 8L13 4L12 4L12 3L13 3L13 2L12 2L12 1L13 1L13 0L11 0L11 1L10 1L10 0ZM10 2L10 4L11 4L11 2ZM10 7L10 8L11 8L11 7ZM0 8L0 9L2 9L2 10L1 10L1 12L0 12L0 13L1 13L1 12L2 12L2 13L4 13L4 12L2 12L2 10L3 10L3 8ZM18 8L18 9L17 9L17 10L16 10L16 11L17 11L17 12L16 12L16 13L15 13L15 11L14 11L14 13L13 13L13 12L12 12L12 13L11 13L11 11L10 11L10 13L8 13L8 17L9 17L9 16L10 16L10 14L11 14L11 17L10 17L10 18L11 18L11 17L12 17L12 16L13 16L13 17L14 17L14 18L15 18L15 17L16 17L16 16L18 16L18 18L20 18L20 19L21 19L21 18L20 18L20 17L21 17L21 16L20 16L20 17L19 17L19 16L18 16L18 15L19 15L19 14L18 14L18 15L16 15L16 13L17 13L17 12L18 12L18 13L20 13L20 12L21 12L21 11L20 11L20 10L21 10L21 9L19 9L19 8ZM6 9L6 10L5 10L5 11L6 11L6 12L7 12L7 11L6 11L6 10L8 10L8 9ZM18 9L18 10L17 10L17 11L18 11L18 12L20 12L20 11L18 11L18 10L19 10L19 9ZM12 10L12 11L13 11L13 10ZM12 13L12 15L13 15L13 13ZM14 13L14 14L15 14L15 13ZM14 15L14 16L15 16L15 15ZM8 18L8 21L10 21L10 20L9 20L9 18ZM12 18L12 19L13 19L13 18ZM16 18L16 19L17 19L17 18ZM14 19L14 21L15 21L15 19ZM18 19L18 21L19 21L19 19ZM12 20L12 21L13 21L13 20ZM16 20L16 21L17 21L17 20ZM20 20L20 21L21 21L21 20ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z\" fill=\"#000000\"/></g></g></svg>\n', 'public/profile_images/1732453676.jpg', '2024-11-06 00:44:22', '2024-11-24 15:12:27'),
(4, '670003', '3578031211956001', 'Muhammad Satria Ramadhan', '$2y$12$VnhWOTLFzJWCXy4dTM4RN./I1t/qaLX9XDRYBlNLyNB8URsslQQYq', 'Jl. Unesa Lidah Wetan 1', 'satriaramadhan@gmail.com', '081345894067', 'Laki-Laki', 'IT Support', 'Pengembangan Web', 'karyawan', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(9.524)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 2L8 2L8 3L9 3L9 4L10 4L10 5L11 5L11 4L12 4L12 7L11 7L11 6L10 6L10 7L9 7L9 6L8 6L8 8L4 8L4 9L3 9L3 8L0 8L0 11L1 11L1 12L2 12L2 13L3 13L3 11L4 11L4 10L5 10L5 12L4 12L4 13L8 13L8 17L10 17L10 18L8 18L8 21L11 21L11 17L12 17L12 16L13 16L13 17L14 17L14 18L15 18L15 17L16 17L16 16L18 16L18 18L20 18L20 19L21 19L21 18L20 18L20 17L21 17L21 16L20 16L20 17L19 17L19 16L18 16L18 15L19 15L19 14L21 14L21 13L19 13L19 12L18 12L18 11L20 11L20 10L21 10L21 9L19 9L19 8L18 8L18 9L17 9L17 10L16 10L16 11L17 11L17 12L16 12L16 13L15 13L15 11L14 11L14 13L13 13L13 12L12 12L12 13L10 13L10 12L11 12L11 10L10 10L10 9L12 9L12 8L13 8L13 9L14 9L14 10L15 10L15 8L13 8L13 4L12 4L12 3L13 3L13 2L12 2L12 1L13 1L13 0L11 0L11 1L10 1L10 0ZM10 2L10 4L11 4L11 2ZM10 7L10 8L11 8L11 7ZM2 9L2 11L3 11L3 9ZM5 9L5 10L7 10L7 11L6 11L6 12L7 12L7 11L9 11L9 12L10 12L10 11L9 11L9 9ZM18 9L18 10L17 10L17 11L18 11L18 10L19 10L19 9ZM12 10L12 11L13 11L13 10ZM17 12L17 13L16 13L16 15L18 15L18 12ZM12 13L12 15L13 15L13 13ZM14 13L14 14L15 14L15 13ZM9 14L9 16L10 16L10 15L11 15L11 14ZM14 15L14 16L15 16L15 15ZM12 18L12 19L13 19L13 18ZM16 18L16 19L17 19L17 18ZM9 19L9 20L10 20L10 19ZM14 19L14 21L15 21L15 19ZM18 19L18 21L19 21L19 19ZM12 20L12 21L13 21L13 20ZM16 20L16 21L17 21L17 20ZM20 20L20 21L21 21L21 20ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '2024-11-06 00:44:22', '2024-11-06 00:44:22'),
(5, '340201', '3578034416759101', 'Kandhi Surya Atmaja', '$2y$12$3dnmRJeEDrT/nyIOha1iwuGG8FXpCUQ/ArqKtyjg8tLpgABc6k7xi', 'Jl. Kali Jagir 1', 'kandhisuryaatmaja@gmail.com', '081425690027', 'Laki-Laki', 'IT Support', 'Pengembangan Web', 'karyawan', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(9.524)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 2L8 2L8 3L9 3L9 4L10 4L10 5L11 5L11 4L12 4L12 7L11 7L11 6L10 6L10 7L9 7L9 6L8 6L8 8L4 8L4 10L3 10L3 8L0 8L0 10L1 10L1 9L2 9L2 10L3 10L3 12L1 12L1 11L0 11L0 13L3 13L3 12L4 12L4 11L5 11L5 12L6 12L6 13L8 13L8 17L9 17L9 18L8 18L8 21L10 21L10 19L11 19L11 18L10 18L10 17L12 17L12 16L13 16L13 17L14 17L14 18L15 18L15 17L16 17L16 16L18 16L18 18L20 18L20 19L21 19L21 18L20 18L20 17L21 17L21 16L20 16L20 17L19 17L19 16L18 16L18 15L19 15L19 14L18 14L18 15L16 15L16 13L17 13L17 12L18 12L18 9L19 9L19 11L21 11L21 10L20 10L20 9L19 9L19 8L18 8L18 9L17 9L17 10L16 10L16 11L17 11L17 12L16 12L16 13L15 13L15 11L14 11L14 13L13 13L13 12L12 12L12 13L11 13L11 14L10 14L10 11L11 11L11 9L12 9L12 8L13 8L13 9L14 9L14 10L15 10L15 8L13 8L13 4L12 4L12 3L13 3L13 2L12 2L12 1L13 1L13 0L11 0L11 1L10 1L10 0ZM10 2L10 4L11 4L11 2ZM10 7L10 8L11 8L11 7ZM5 9L5 10L8 10L8 11L10 11L10 10L8 10L8 9ZM12 10L12 11L13 11L13 10ZM6 11L6 12L7 12L7 11ZM19 12L19 13L21 13L21 12ZM12 13L12 15L13 15L13 13ZM14 13L14 14L15 14L15 13ZM9 15L9 16L10 16L10 15ZM14 15L14 16L15 16L15 15ZM12 18L12 19L13 19L13 18ZM16 18L16 19L17 19L17 18ZM14 19L14 21L15 21L15 19ZM18 19L18 21L19 21L19 19ZM12 20L12 21L13 21L13 20ZM16 20L16 21L17 21L17 20ZM20 20L20 21L21 21L21 20ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '2024-11-06 00:44:22', '2024-11-06 00:44:22'),
(6, '647803', '3578031321266701', 'Muhammad Akhtar Ariq', '$2y$12$rV7L6wW2x1U91JmWzkcm1Or/7El9ZiQK18xO2rXtRW.jetJ7Y17GW', 'Jl. Pandugo Raya Indah', 'akhtarariq@gmail.com', '081215794967', 'Laki-Laki', 'IT Support', 'Pengembangan Web', 'karyawan', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(9.524)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M10 0L10 1L8 1L8 2L10 2L10 3L8 3L8 4L9 4L9 5L8 5L8 7L9 7L9 8L6 8L6 9L5 9L5 8L0 8L0 9L1 9L1 10L0 10L0 11L1 11L1 13L3 13L3 12L4 12L4 13L7 13L7 12L8 12L8 15L9 15L9 14L11 14L11 15L12 15L12 14L13 14L13 15L14 15L14 14L13 14L13 12L15 12L15 14L16 14L16 15L15 15L15 16L16 16L16 17L17 17L17 18L18 18L18 17L19 17L19 16L20 16L20 15L21 15L21 12L20 12L20 15L19 15L19 14L18 14L18 13L19 13L19 12L18 12L18 13L17 13L17 14L16 14L16 12L15 12L15 11L16 11L16 10L15 10L15 9L16 9L16 8L15 8L15 9L14 9L14 8L13 8L13 9L12 9L12 8L11 8L11 9L10 9L10 12L12 12L12 14L11 14L11 13L9 13L9 12L8 12L8 11L9 11L9 10L8 10L8 9L9 9L9 8L10 8L10 7L11 7L11 6L12 6L12 7L13 7L13 6L12 6L12 5L13 5L13 0ZM11 1L11 2L12 2L12 1ZM10 3L10 5L9 5L9 7L10 7L10 6L11 6L11 5L12 5L12 3ZM17 8L17 10L18 10L18 11L20 11L20 10L21 10L21 9L20 9L20 8L19 8L19 10L18 10L18 8ZM6 9L6 10L3 10L3 11L2 11L2 12L3 12L3 11L4 11L4 12L7 12L7 11L6 11L6 10L7 10L7 9ZM11 10L11 11L12 11L12 10ZM13 10L13 11L14 11L14 10ZM17 14L17 17L18 17L18 14ZM8 16L8 21L10 21L10 20L12 20L12 21L13 21L13 20L15 20L15 21L16 21L16 20L15 20L15 19L16 19L16 18L15 18L15 17L14 17L14 16L13 16L13 17L12 17L12 16L11 16L11 18L9 18L9 16ZM11 18L11 19L12 19L12 18ZM13 18L13 19L14 19L14 18ZM9 19L9 20L10 20L10 19ZM17 19L17 20L18 20L18 21L19 21L19 20L20 20L20 19L19 19L19 20L18 20L18 19ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '2024-11-06 00:44:22', '2024-11-06 00:44:22'),
(8, '654001', '35780328715273828', 'Pramudya Bramantio Masardi', '$2y$12$zL3Vimv8LT3xMJl7DRij2eLY7EY0x75Z/UXTZTR73a1/I8u2KSMba', 'Jl. Taman Kunang Kunang', 'bramantiomasardi@gmail.com', '085723747628', 'Laki-Laki', 'HRD', 'HRD', 'karyawan', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<svg xmlns=\"http://www.w3.org/2000/svg\" version=\"1.1\" width=\"200\" height=\"200\" viewBox=\"0 0 200 200\"><rect x=\"0\" y=\"0\" width=\"200\" height=\"200\" fill=\"#ffffff\"/><g transform=\"scale(9.524)\"><g transform=\"translate(0,0)\"><path fill-rule=\"evenodd\" d=\"M9 0L9 2L8 2L8 3L9 3L9 4L10 4L10 5L11 5L11 4L12 4L12 7L11 7L11 6L10 6L10 7L9 7L9 6L8 6L8 8L4 8L4 9L3 9L3 8L0 8L0 9L3 9L3 10L6 10L6 11L5 11L5 12L4 12L4 11L3 11L3 12L1 12L1 11L2 11L2 10L0 10L0 13L7 13L7 12L6 12L6 11L8 11L8 12L9 12L9 11L10 11L10 13L8 13L8 17L9 17L9 18L8 18L8 21L11 21L11 20L9 20L9 18L10 18L10 19L11 19L11 18L10 18L10 17L9 17L9 14L10 14L10 16L11 16L11 17L12 17L12 16L13 16L13 17L14 17L14 18L15 18L15 17L16 17L16 16L18 16L18 18L20 18L20 19L21 19L21 18L20 18L20 17L21 17L21 16L20 16L20 17L19 17L19 16L18 16L18 15L19 15L19 14L21 14L21 13L19 13L19 12L20 12L20 10L21 10L21 9L19 9L19 8L18 8L18 9L17 9L17 10L16 10L16 11L17 11L17 12L16 12L16 13L15 13L15 11L14 11L14 13L13 13L13 12L12 12L12 13L11 13L11 11L10 11L10 10L11 10L11 9L12 9L12 8L13 8L13 9L14 9L14 10L15 10L15 8L13 8L13 4L12 4L12 3L13 3L13 2L12 2L12 1L13 1L13 0L11 0L11 1L10 1L10 0ZM10 2L10 4L11 4L11 2ZM10 7L10 8L11 8L11 7ZM6 9L6 10L7 10L7 9ZM9 9L9 10L10 10L10 9ZM18 9L18 10L17 10L17 11L18 11L18 12L17 12L17 13L16 13L16 15L18 15L18 14L19 14L19 13L18 13L18 12L19 12L19 11L18 11L18 10L19 10L19 9ZM12 10L12 11L13 11L13 10ZM10 13L10 14L11 14L11 13ZM12 13L12 15L13 15L13 13ZM14 13L14 14L15 14L15 13ZM14 15L14 16L15 16L15 15ZM12 18L12 19L13 19L13 18ZM16 18L16 19L17 19L17 18ZM14 19L14 21L15 21L15 19ZM18 19L18 21L19 21L19 19ZM12 20L12 21L13 21L13 20ZM16 20L16 21L17 21L17 20ZM20 20L20 21L21 21L21 20ZM0 0L0 7L7 7L7 0ZM1 1L1 6L6 6L6 1ZM2 2L2 5L5 5L5 2ZM14 0L14 7L21 7L21 0ZM15 1L15 6L20 6L20 1ZM16 2L16 5L19 5L19 2ZM0 14L0 21L7 21L7 14ZM1 15L1 20L6 20L6 15ZM2 16L2 19L5 19L5 16Z\" fill=\"#000000\"/></g></g></svg>\n', NULL, '2024-11-06 00:57:55', '2024-11-06 00:57:55');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presensi_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `presensi`
--
ALTER TABLE `presensi`
  ADD CONSTRAINT `presensi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
