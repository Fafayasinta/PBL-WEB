-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 07:34 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwl_pbl`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_11_04_115645_create_level_table', 1),
(6, '2024_11_04_120607_create_m_tahun', 1),
(7, '2024_11_04_121359_create_m_user_table', 1),
(8, '2024_11_04_122006_create_m_kategori_kegiatan_table', 1),
(9, '2024_11_04_122427_create_m_beban_kegiatan', 1),
(10, '2024_11_04_124934_create_m_bobot_jabatan', 1),
(11, '2024_11_04_125111_create_t_kegiatan', 1),
(12, '2024_11_04_125346_create_t_bobot_dosen', 1),
(13, '2024_11_04_125952_create_t_anggota_kegiatan', 1),
(14, '2024_11_04_130727_create_t_kegiatan_dosen', 1),
(15, '2024_11_04_131316_create_t_kegiatan_agenda', 1),
(16, '2024_11_04_143303_create_notifikasi_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_beban_kegiatan`
--

CREATE TABLE `m_beban_kegiatan` (
  `beban_kegiatan_id` bigint UNSIGNED NOT NULL,
  `nama_beban` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_beban_kegiatan`
--

INSERT INTO `m_beban_kegiatan` (`beban_kegiatan_id`, `nama_beban`, `deskripsi`, `created_at`) VALUES
(1, 'Berat', 'Kegiatan ini dinilai berat dikarenakan agenda yang banyak, cakupan yang luas, timeline panjang, dan beban kerja tinggi.', '2024-12-15 23:42:45'),
(2, 'Sedang', 'Kegiatan ini dinilai sedang dengan agenda yang terukur, cakupan moderat, dan timeline yang cukup fleksibel.', '2024-12-15 23:42:45'),
(3, 'Ringan', 'Kegiatan ini dinilai ringan dengan sedikit agenda, cakupan kecil, dan timeline yang singkat.', '2024-12-15 23:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `m_bobot_jabatan`
--

CREATE TABLE `m_bobot_jabatan` (
  `bobot_jabatan_id` bigint UNSIGNED NOT NULL,
  `cakupan_wilayah` enum('Luar Institusi','Institusi','Jurusan','Program Studi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `jabatan` enum('PIC','Sekretaris','Bendahara','Anggota') COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor` decimal(4,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_bobot_jabatan`
--

INSERT INTO `m_bobot_jabatan` (`bobot_jabatan_id`, `cakupan_wilayah`, `jabatan`, `skor`, `created_at`, `updated_at`) VALUES
(1, 'Luar Institusi', 'PIC', '5.00', NULL, NULL),
(2, 'Luar Institusi', 'Sekretaris', '4.00', NULL, NULL),
(3, 'Luar Institusi', 'Bendahara', '4.00', NULL, NULL),
(4, 'Luar Institusi', 'Anggota', '3.00', NULL, NULL),
(5, 'Institusi', 'PIC', '4.00', NULL, NULL),
(6, 'Institusi', 'Sekretaris', '3.50', NULL, NULL),
(7, 'Institusi', 'Bendahara', '3.50', NULL, NULL),
(8, 'Institusi', 'Anggota', '3.00', NULL, NULL),
(9, 'Jurusan', 'PIC', '3.00', NULL, NULL),
(10, 'Jurusan', 'Sekretaris', '2.50', NULL, NULL),
(11, 'Jurusan', 'Bendahara', '2.50', NULL, NULL),
(12, 'Jurusan', 'Anggota', '2.00', NULL, NULL),
(13, 'Program Studi', 'PIC', '3.00', NULL, NULL),
(14, 'Program Studi', 'Sekretaris', '2.50', NULL, NULL),
(15, 'Program Studi', 'Bendahara', '2.50', NULL, NULL),
(16, 'Program Studi', 'Anggota', '2.00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori_kegiatan`
--

CREATE TABLE `m_kategori_kegiatan` (
  `kategori_kegiatan_id` bigint UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kategori_kegiatan`
--

INSERT INTO `m_kategori_kegiatan` (`kategori_kegiatan_id`, `nama_kategori`, `deskripsi`, `created_at`) VALUES
(1, 'JTI Terprogram', 'Kegiatan yang telah direncanakan dan terorganisir di lingkup JTI.', '2024-12-15 23:42:45'),
(2, 'JTI Non Program', 'Kegiatan tambahan yang tidak termasuk dalam program utama JTI namun dilakukan dilingkup JTI.', '2024-12-15 23:42:45'),
(3, 'Non JTI', 'Kegiatan yang dilakukan di luar lingkup JTI.', '2024-12-15 23:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_deskripsi` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `level_deskripsi`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADMIN', 'Administrator', 'Administrator sistem dengan akses penuh', '2024-12-15 23:42:24', '2024-12-15 23:42:24', NULL),
(2, 'PIMPINAN', 'Pimpinan', 'Pimpinan dengan akses monitoring', '2024-12-15 23:42:24', '2024-12-15 23:42:24', NULL),
(3, 'DOSEN', 'Dosen', 'Dosen dengan akses terbatas', '2024-12-15 23:42:24', '2024-12-15 23:42:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_tahun`
--

CREATE TABLE `m_tahun` (
  `tahun_id` bigint UNSIGNED NOT NULL,
  `tahun` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_tahun`
--

INSERT INTO `m_tahun` (`tahun_id`, `tahun`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2022', '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(2, '2023', '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(3, '2024', '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `foto_profil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `password`, `nama`, `nip`, `email`, `email_verified_at`, `foto_profil`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin', '$2y$12$Ts74R4Sr3T052AEQmYS.F.8sS5dYxVvigf.s2GiBmig5TCdRDnhuW', 'Administrator', '123456789', 'admin@example.com', '2024-12-15 23:42:24', 'storage/foto_profil/1734367384_logo_jti_baruU.png', NULL, '2024-12-15 23:42:45', '2024-12-16 09:43:04', NULL),
(2, 2, 'pimpinan', '$2y$12$bCbFw425dTLtWgqAikb8oez0HhdeX6XttxsW3/asO0oBGrdEgQsQm', 'Rosa Andrie Asmara, ST., MT., Dr. Eng.', '198010102005011001', 'pimpinan@example.com', '2024-12-15 23:42:24', 'storage/foto_profil/1734367624_Fitria RPrihandiva.jpg', NULL, '2024-12-15 23:42:45', '2024-12-16 09:47:04', NULL),
(3, 3, 'dosen', '$2y$12$pr8zxcWrubOfBD0ZM9Ud0uLxIqumK.zOeLtoueyMyw6Zn8lidF6mu', 'Dosen', '3456789', 'dosen@example.com', '2024-12-15 23:42:25', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(4, 3, 'ahmadi', '$2y$12$5KJftuWnf98DK7pJ3xlxz.s1GuAb9kp0iunDOsKz9vXeDMqsig..2', 'Ahmadi Yuli Ananta, ST., M.M.', '198107052005011002', 'dosen1@example.com', '2024-12-15 23:42:25', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(5, 3, 'ariadi', '$2y$12$Qm45aresfH37eFOWSZzkrOqJx8NIqLsqR/I0VQVVidUJOLaRYHGVC', 'Ariadi Retno Ririd, S.Kom., M.Kom.', '198108102005012002', 'dosen2@example.com', '2024-12-15 23:42:25', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(6, 3, 'arief', '$2y$12$l5ukxbkYtL5LimkSL47VXu5h8EohyzD0BGG9PmzY5MvBH0bufFpMa', 'Arief Prasetyo, S.Kom., M.Kom.', '197903132008121002', 'dosen3@example.com', '2024-12-15 23:42:26', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(7, 3, 'atiqah', '$2y$12$i1jQ0wh5ACMfsCC5PR/6jerdFURnsjs4KXgQSdw/LwumTjL.P8nTu', 'Atiqah Nurul Asri, S.Pd., M.Pd.', '197606252005012001', 'dosen4@example.com', '2024-12-15 23:42:26', 'storage/foto_profil/1734367689_Untitled design (3).png', NULL, '2024-12-15 23:42:45', '2024-12-16 09:48:09', NULL),
(8, 3, 'banni', '$2y$12$nBQrzOuoY1KNXR7UC2/LVuikN4zuzcinCZMCCKgZA3hs.Mqp.F3pW', 'Banni Satria Andoko, S. Kom., M.MSI', '198108092010121002', 'dosen5@example.com', '2024-12-15 23:42:26', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(9, 3, 'budi', '$2y$12$6gmAcOWx1HoH02R4H8DGyesss7.gmdUNc.h/cIhmOKvkSSv53X.tq', 'Budi Harijanto, ST., M.MKom.', '196201051990031002', 'dosen6@example.com', '2024-12-15 23:42:26', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(10, 3, 'cahya', '$2y$12$lTzZTJeBZlTtOZSobta9ZeEsuBksavRABBsui1l6gBE1gqCozkFue', 'Cahya Rahmad, ST., M.Kom., Dr. Eng.', '197202022005011002', 'dosen7@example.com', '2024-12-15 23:42:27', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(11, 3, 'deddy', '$2y$12$mgNIm9tHtMkVn5yNvQFQv.8d6lbKbPc/u974w5UoYHQu3QcBbCr72', 'Deddy Kusbianto PA, Ir., M.Mkom.', '196211281988111001', 'dosen72@example.com', '2024-12-15 23:42:27', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(12, 3, 'dhebys', '$2y$12$GqEXeUckCvrdJTZYAU.uaeSTxzHsPvtZz3uEtwBJDJGLbfADpr.aK', 'Dhebys Suryani, S.Kom., MT', '198311092014042001', 'dosen8@example.com', '2024-12-15 23:42:27', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(13, 3, 'dimas', '$2y$12$jqqKmrvsE6Cz3UmsnNRo7usK7Tl1NPRO9WrKBlgCe4s75nisfthBe', 'Dimas Wahyu Wibowo, ST., MT.', '198410092015041001', 'dosen9@example.com', '2024-12-15 23:42:28', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(14, 3, 'dwi', '$2y$12$Yb2p2br9Ezz0aU8Uy0qMAOYGhrllJgsnoRmhXcLi0TBRdb6DXU45m', 'Dwi Puspitasari, S.Kom., M.Kom.', '197911152005012002', 'dosen10@example.com', '2024-12-15 23:42:28', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(15, 3, 'eka', '$2y$12$yZBrFnCc6rk/DYnRCXp1VeI4H6takJjpE8EEGnxqfjJLR68y2NJei', 'Eka Larasati Amalia, S.ST., MT.', '198807112015042005', 'dosen11@example.com', '2024-12-15 23:42:28', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(16, 3, 'ekojono', '$2y$12$e0/LWA61SQ7/Z3CI4RaQCuMgAc6mY8MvDAp8chCgWRJqLqTwhbKH.', 'Ekojono, ST., M.Kom.', '195912081985031004', 'dosen12@example.com', '2024-12-15 23:42:28', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(17, 3, 'ely', '$2y$12$LhB89MZXWUGcxjZeByal2ugBV6htJZWEgLSKNZYc7wN7UNCsTSyvS', 'Ely Setyo Astuti, ST., MT.', '197605152009122001', 'dosen13@example.com', '2024-12-15 23:42:29', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(18, 3, 'erfan', '$2y$12$R2RPiPL/uFfrwGDpyIkuV.kFy0cLC2wdghDo3A8dj6zTBnN5JvkdO', 'Erfan Rohadi, ST., M.Eng., Ph.D.', '197201232008011006', 'dosen14@example.com', '2024-12-15 23:42:29', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(19, 3, 'gunawan', '$2y$12$8XYZ9OURvRPVFMeQ4DYaZ.F4QCf/GW4chcdwrxCImdBsKgwHQdx6y', 'Gunawan Budi Prasetyo, ST., MMT., Ph.D.', '197704242008121001', 'dosen15@example.com', '2024-12-15 23:42:29', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(20, 3, 'hendra', '$2y$12$mCEUAVJk81mWYDnRdRZRSOybZJyKiCUQkJs9f/lPbkH0fbBkA2IaW', 'Hendra Pradibta, SE., M.Sc.', '198305212006041003', 'dosen16@example.com', '2024-12-15 23:42:29', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(21, 3, 'imam', '$2y$12$7JDNyltDINKbzLZCyFpg9OIqQzvLDhuqRBKkspEbs0aeqvLxBu8Om', 'Imam Fahrur Rozi, ST., MT.', '198406102008121004', 'dosen17@example.com', '2024-12-15 23:42:30', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(22, 3, 'indra', '$2y$12$0XKa2gh2rNrAd2BO9OJU6OdA/KvfsbuwBh3svgF.3E06hY7A6boe6', 'Indra Dharma Wijaya, ST., M.MT.', '197305102008011010', 'dosen18@example.com', '2024-12-15 23:42:30', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(23, 3, 'luqman', '$2y$12$SotG2DOsqdIQUjqz3ht6keEtmdTdkqYddGNQ.u/B4U7xGdDixz8Y.', 'Luqman Affandi, S.Kom., MMSI', '198211302014041001', 'dosen19@example.com', '2024-12-15 23:42:30', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(24, 3, 'mungki', '$2y$12$4qpG8Jz87eUJzuYuvVDWzuc3m8YJ1hLox2.vv6einxcuD0kKzp/Vu', 'Mungki Astiningrum, ST., M.Kom.', '197710302005012001', 'dosen20@example.com', '2024-12-15 23:42:31', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(25, 3, 'pramana', '$2y$12$2KqsFBchco4IXRijzZDLSuDsjKPK8ky9RrVTKfOcQXv2DcfyLcV72', 'Pramana Yoga Saputra, S.Kom., MMT.', '198805042015041001', 'dosen21@example.com', '2024-12-15 23:42:31', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(26, 3, 'putra', '$2y$12$BHjGHbGLegi55rMCyK.oMeoGRtOuTWVzbAyktB1plQ6TolxTqfl/q', 'Putra Prima A., ST., M.Kom.', '198611032014041001', 'dosen22@example.com', '2024-12-15 23:42:31', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(27, 3, 'rawansyah', '$2y$12$ey/sYI/e9ZMHa0OJtMRE/OvcGjaVQxNLWpeFZcKSXWKsYqSGcl79C', 'Rawansyah., Drs., M.Pd.', '195906201994031001', 'dosen23@example.com', '2024-12-15 23:42:31', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(28, 3, 'ridwan', '$2y$12$1OwXkQFAc9DxPMb8tVHqpOeElHjSLMsn9IH6c2jvEocudu4yWoTGC', 'Ridwan Rismanto, SST., M.Kom.', '198603182012121001', 'dosen24@example.com', '2024-12-15 23:42:32', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(29, 3, 'rudy', '$2y$12$lz5SJ7GTiHGy.2nkFN.b3.qIU/I5es6nuXgAILScNTCHVzNqY1t5S', 'Rudy Ariyanto, ST., M.Cs.', '197111101999031002', 'dosen25@example.com', '2024-12-15 23:42:32', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(30, 3, 'dr', '$2y$12$ot6BoGDhYuBl3IVNspYYOeoztvEZixGILZQmPyJB3zXzjpsD9URqa', 'Dr. Shohib Muslim, S.H., M.Hum', '198507222014041001', 'dosen26@example.com', '2024-12-15 23:42:32', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(31, 3, 'ulla', '$2y$12$lHDw9EUxAsmyW/6cJ9D0zuwpe7M4okHpghZfvevGKFDxXYqMWuTYK', 'Ulla Delfana Rosiani, ST., MT.', '197803272003122002', 'dosen27@example.com', '2024-12-15 23:42:32', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(32, 3, 'usman', '$2y$12$adOIErcyPUkH0d8cfd3Zhe.O6.5MYh.E2CiT5KELNmtLbPlrEmi0m', 'Usman Nurhasan, S.Kom., MT.', '198609232015041001', 'dosen28@example.com', '2024-12-15 23:42:33', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(33, 3, 'widaningsih', '$2y$12$zcIOaMKJQDNSUVpJ7f0oue8520s6yXv5/wUM.VAp5o3T8AR2uyDRa', 'Widaningsih Condrowardhani, SH, MH.', '198103182010122002', 'dosen29@example.com', '2024-12-15 23:42:33', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(34, 3, 'yan', '$2y$12$FG1wI1beEsKG5jW8w3iBleWv1CqgMgDxx.9p/p3531UUqWETiDK0C', 'Yan Watequlis Syaifuddin, ST., M.MT.', '198101052005011005', 'dosen30@example.com', '2024-12-15 23:42:33', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(35, 3, 'yuri', '$2y$12$eFmZyfT46DpVykIPNgoaYuiPJtKgBOJQjol8D/KjUw0V5eoAjKPBS', 'Yuri Ariyanto, S.Kom., M.Kom.', '198007162010121002', 'dosen31@example.com', '2024-12-15 23:42:34', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(36, 3, 'agung', '$2y$12$LKo5ERJb28T4Ej69aLxkru7dC981YzmkUz93/f.upH.FcmSOurgQS', 'Agung Nugroho Pramudhita, S.T., M.T.', '198902102019031020', 'dosen32@example.com', '2024-12-15 23:42:34', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(37, 3, 'annisa', '$2y$12$8pqjzjKPq1LCUcqO3ZjIbO1.gL5KVeOaYaTQRQjTLuJg2W2wCqosa', 'Annisa Puspa Kirana, S.Kom., M.Kom', '198901232019032016', 'dosen33@example.com', '2024-12-15 23:42:34', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(38, 3, 'anugrah', '$2y$12$Ux7rmqHLlhKgIJNgHk1IkO0pDVCo1l3c.9VSsSq4z8cVx7ds5pvB6', 'Anugrah Nur Rahmanto, S.Sn., M.Ds.', '199112302019031016', 'dosen35@example.com', '2024-12-15 23:42:35', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(39, 3, 'arie', '$2y$12$YUZWi0bGU72vmQJGoT3GBu2TbGtaGAXNa0aHuupE1J8LFfEgt7poi', 'Arie Rachmad Syulistyo, S.Kom., M.Kom', '198708242019031010', 'dosen36@example.com', '2024-12-15 23:42:35', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(40, 3, 'dian', '$2y$12$mJGQ0NmN2QYgzuSpacQQY.dEN1w3JBwRZwX5M1zXcveLssN0baARe', 'Dian Hanifudin Subhi, S.Kom., M.Kom.', '198806102019031018', 'dosen37@example.com', '2024-12-15 23:42:35', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(41, 3, 'dika', '$2y$12$ocYEH97QPZiU1phqyqa49O4r2yPe1Wu7.F5pkB678FKwEy0UZreKG', 'Dika Rizky Yunianto, S.Kom, M.Kom', '199206062019031017', 'dosen38@example.com', '2024-12-15 23:42:36', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(42, 3, 'elok', '$2y$12$g5Q4Cj2H8SwcGU3XvYaSYucD9kR1N31Hrx6yvkr5pcbE7oF5OydUe', 'Elok Nur Hamdana, S.T., M.T', '198610022019032011', 'dosen39@example.com', '2024-12-15 23:42:36', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(43, 3, 'kadek', '$2y$12$MNFCx2juNHTjXBjex/OvIecC8raUZaZza2t7d1XUTZj/37QHSs9G2', 'Kadek Suarjuna Batubulan, S.Kom, MT', '199003202019031016', 'dosen40@example.com', '2024-12-15 23:42:36', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(44, 3, 'meyti', '$2y$12$XIa6DTPQkP/2L18QZ1WtseohwdsWE7yn7Q0G1WNsSTkltJgOvrpy2', 'Meyti Eka Apriyani ST., MT.', '198704242019032017', 'dosen41@example.com', '2024-12-15 23:42:36', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(45, 3, 'afif', '$2y$12$cBvjQgH02TTCj5WkPqtK0.EchgGSMpaAuer9FDqWvt2qIqDLlNXPO', 'Muhammad Afif Hendrawan.,S.Kom., MT', '199111282019031013', 'dosen42@example.com', '2024-12-15 23:42:37', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(46, 3, 'khairy', '$2y$12$SW0xKtlSZCowhUQ6wV9zUutbkNHrwU4vnjW39vOFTpKkbpHVnpM9G', 'Muhammad Shulhan Khairy, S.Kom, M.Kom', '199205172019031020', 'dosen43@example.com', '2024-12-15 23:42:37', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(47, 3, 'mustika', '$2y$12$NoYDJEYlB5l9L5vYwq73e.U4Dq2D6.lHKaEBrEb0XS3zXHpnhZvOW', 'Mustika Mentari, S.Kom., M.Kom', '198806072019032016', 'dosen44@example.com', '2024-12-15 23:42:37', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(48, 3, 'retno', '$2y$12$doBRnhUsHspyoplxw5Rb9OgzJtCTcDs59EhwTXiEqVGo2mb5IqxEG', 'Retno Damayanti, S.Pd., M.T.', '198910042019032023', 'dosen45@example.com', '2024-12-15 23:42:37', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(49, 3, 'sofyan', '$2y$12$/q7eLwbceoh/3KVgH5cYgurDN9CkiMkBkwLhUArP79uzUdGq5E9AS', 'Sofyan Noor Arief, S.ST., M.Kom.', '198908132019031017', 'dosen46@example.com', '2024-12-15 23:42:38', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(50, 3, 'vipkas', '$2y$12$yyiWQRoJO2dyYk/z0ybEQO6sHYrNCrLHM5qXnreRCLN1cToImPaT.', 'Vipkas Al Hadid Firdaus, ST,. MT', '199105052019031029', 'dosen47@example.com', '2024-12-15 23:42:38', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(51, 3, 'vivi', '$2y$12$r3VixzRvgrknPYLAGUW9oOvpn6/WXsFmgRZ9hiCPP1kNdws0vycRi', 'Vivi Nur Wijayaningrum, S.Kom, M.Kom', '199308112019032025', 'dosen48@example.com', '2024-12-15 23:42:38', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(52, 3, 'vivin', '$2y$12$a4JyCwILAFPXAEYacjP3l.iebp5zbQc4ddME8AgOayQwd.Zx5bsXC', 'Vivin Ayu Lestari, S.Pd., M.Kom.', '199106212019032020', 'dosen49@example.com', '2024-12-15 23:42:39', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(53, 3, 'yoppy', '$2y$12$zxz9OfWT3W5M.PfdrJgtWeMfxDtL/ibV9/EVyLrO0kpaFirzPFwDy', 'Yoppy Yunhasnawa, S.ST., M.Sc.', '198906212019031013', 'dosen50@example.com', '2024-12-15 23:42:39', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(54, 3, 'bagas', '$2y$12$UPnsUe78u1YkJBn2e3DcEeX7yq.mpOuYbQVbSprBgGVtcVEe.HeTq', 'Bagas Satya Dian Nugraha, ST., MT.', '199006192019031017', 'dosen51@example.com', '2024-12-15 23:42:39', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(55, 3, 'candra', '$2y$12$XsrDf.8ajrdZf6dqubREdOvq9OwqG0oKwhg88V1l8q9v7z2jYPGvC', 'Candra Bella Vista, S.Kom., MT.', '199412172019032020', 'dosen52@example.com', '2024-12-15 23:42:39', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(56, 3, 'faiz', '$2y$12$hkrwkbQO9JXgMr7iq9ZqhuSJmD/DdfWjDKRa10lF5Bpqff2jkAw46', 'Faiz Ushbah Mubarok, S.Pd., M.Pd.', '199305052019031018', 'dosen53@example.com', '2024-12-15 23:42:40', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(57, 3, 'habibie', '$2y$12$Zpf3ne21lLabGRWdQRK4zupGkKZKN1tOawtzN/1pBN4hXbXYC4N6q', 'Habibie Ed Dien, S.Kom., M.T.', '199204122019031013', 'dosen54@example.com', '2024-12-15 23:42:40', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(58, 3, 'ika', '$2y$12$z0Ud1PZGHPgyiOIdYhiBHef0CCZJn9YMXnj6eSfRSV.FVJpWjtYAu', 'Ika Kusumaning Putri, S.Kom., MT.', '199110142019032020', 'dosen55@example.com', '2024-12-15 23:42:40', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(59, 3, 'irsyad', '$2y$12$4v2kL28Dc6/EOWwO7QQK8eW7.ZRGUxR3F9eg5EW8LUibf8kzjel3K', 'Irsyad Arif Mashudi, S.Kom., M.Kom', '198902012019031009', 'dosen56@example.com', '2024-12-15 23:42:40', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(60, 3, 'mamluatul', '$2y$12$Ya/MtWAypYoF/6q7PwvJ8OL26LbmKs2NlNruNxOenIPIDO5IjFN1G', 'Mamluatul Haniah, S.Kom., M.Kom', '199002062019032013', 'dosen57@example.com', '2024-12-15 23:42:41', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(61, 3, 'milyun', '$2y$12$f5TTThIvgklnGrQDP3A7yOFxsHmBxFrj9BruqHz1WC64AA1diqcxi', 'Milyun Nima Shoumi, S.Kom., M.Kom', '198805072019032012', 'dosen58@example.com', '2024-12-15 23:42:41', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(62, 3, 'moch', '$2y$12$h/AJiFqV5xszgJ/jhNzeneLhlwYUo10L/3PvA/spDLq7LU16FTZpq', 'Moch. Zawaruddin Abdullah, S.ST., M.Kom', '198902102019031019', 'dosen59@example.com', '2024-12-15 23:42:41', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(63, 3, 'noprianto', '$2y$12$T3abOSySzmhuJbfj8naN0.a2fgBcSJzj0Bsvj83vNxTQug1qOzKSG', 'Noprianto, S.Kom., M.Eng', '198911082019031020', 'dosen60@example.com', '2024-12-15 23:42:42', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(64, 3, 'rokhimatul', '$2y$12$Uj4Qf7ReC3X46VJ8O7vS8uOA3gYWeociJv/Yf5YoXge1iBLsUN3Im', 'Rokhimatul Wakhidah, S.Pd., M.T.', '198903192019032013', 'dosen61@example.com', '2024-12-15 23:42:42', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(65, 3, 'septian', '$2y$12$pAhmm1XTaf82t4BTw3f/EOP4rXSAJOrYCuZDsQCpYEdzoWbI4CM4S', 'Septian Enggar Sukmana, S.Pd., M.T', '198909012019031010', 'dosen62@example.com', '2024-12-15 23:42:42', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(66, 3, 'wilda', '$2y$12$uMkcQ0EYxQzpYyaqDCW2au.q1OmPZAfRBazVP6XZNgWEK0N9tJskG', 'Wilda Imama Sabilla, S.Kom., M.Kom', '199208292019032023', 'dosen63@example.com', '2024-12-15 23:42:42', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(67, 3, 'ade', '$2y$12$hnWsV65LfbFmHFUJL.zTAeNRdeZMA5QIFhcYTIoQLIHL2xGTgtt.q', 'Ade Ismail, S.Kom., M.TI', '199107042019031021', 'dosen64@example.com', '2024-12-15 23:42:43', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(68, 3, 'rakhmat', '$2y$12$nbapPNskWycsDizBhMGg6uZjPS5CtjeY.g9GAr8RiDhnyyL91RGLu', 'Rakhmat Arianto, S.ST., M.Kom', '198701082019031004', 'dosen65@example.com', '2024-12-15 23:42:43', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(69, 3, 'm', '$2y$12$OjGkYPAa29CEgULGMJbEk.hjmAo1y34OwqkLWRzR/1OgTu4RO6G8O', 'M. Hasyim Ratsanjani, S.Kom., M.Kom', '199003052019031013', 'dosen66@example.com', '2024-12-15 23:42:43', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(70, 3, 'farid', '$2y$12$6bRxTGxO9srtd128ScD1zew7p/p/blLb5/VB024IQChOmcmgJ179m', 'Farid Angga Pribadi, S.Kom.,M.Kom', '198910072020121003', 'dosen67@example.com', '2024-12-15 23:42:43', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(71, 3, 'vit', '$2y$12$ZOuUtVYQ4tW8d1upLlGHo.DGOmkqhwaw882RWsKe5DWgDHv3DG2GC', 'Vit Zuraida,S.Kom., M.Kom.', '198901092020122005', 'dosen68@example.com', '2024-12-15 23:42:44', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(72, 3, 'astrifidha', '$2y$12$Zq9bRLgwm/QFtyNdsjWvgOi3hTaNdWWVnS1mov6b/rnb3zCwiNeT6', 'Astrifidha Rahma Amalia,S.Pd., M.Pd.', '199405212022032006', 'dosen69@example.com', '2024-12-15 23:42:44', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(73, 3, 'endah', '$2y$12$oSQXiINwxQZuirPgbmqvWOIKY92VyIgqD7e1TKFK4XuK0.jpx0C3S', 'Endah Septa Sintiya,S.Pd., M.Kom', '199401312022032007', 'dosen70@example.com', '2024-12-15 23:42:44', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL),
(74, 3, 'toga', '$2y$12$MASKLH4pc1ACdYNu4.26ZuNlTFlClFHiGYc12R4QDgo5vXANgK/2a', 'Toga Aldila Cinderatama,S.ST., M.Sc.', '198710112022031002', 'dosen71@example.com', '2024-12-15 23:42:45', NULL, NULL, '2024-12-15 23:42:45', '2024-12-15 23:42:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `notif_id` bigint UNSIGNED NOT NULL,
  `kegiatan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`notif_id`, `kegiatan_id`, `user_id`, `judul`, `deskripsi`, `created_at`) VALUES
(1, 1, 42, 'DIALOG DOSEN MAHASISWA', 'lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua', '2024-12-16 06:42:45'),
(2, 4, 7, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(3, 4, 8, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(4, 4, 8, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(5, 4, 12, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(6, 4, 13, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(7, 4, 17, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(8, 4, 18, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(9, 4, 23, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(10, 4, 24, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(11, 4, 29, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(12, 4, 31, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(13, 4, 32, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(14, 4, 33, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(15, 4, 37, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(16, 4, 39, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(17, 4, 41, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(18, 4, 41, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(19, 4, 43, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(20, 4, 44, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(21, 4, 45, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(22, 4, 47, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(23, 4, 51, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(24, 4, 52, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(25, 4, 56, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(26, 4, 62, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25'),
(27, 4, 62, 'Surat Tugas sudah ditambahkan', 'surat tugas sudah ditambahkan', '2024-12-16 17:05:25');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_anggota_kegiatan`
--

CREATE TABLE `t_anggota_kegiatan` (
  `anggota_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kegiatan_id` bigint UNSIGNED NOT NULL,
  `jabatan` enum('PIC','Sekretaris','Bendahara','Anggota') COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_anggota_kegiatan`
--

INSERT INTO `t_anggota_kegiatan` (`anggota_id`, `user_id`, `kegiatan_id`, `jabatan`, `skor`) VALUES
(1, 41, 1, 'PIC', '5.00'),
(2, 51, 1, 'Sekretaris', '4.00'),
(3, 62, 1, 'Bendahara', '4.00'),
(4, 17, 1, 'Anggota', '3.00'),
(5, 56, 2, 'PIC', '3.00'),
(6, 44, 2, 'Sekretaris', '2.50'),
(7, 24, 2, 'Bendahara', '2.50'),
(8, 37, 2, 'Anggota', '2.00'),
(9, 7, 3, 'PIC', '3.00'),
(10, 13, 3, 'Sekretaris', '2.50'),
(11, 29, 3, 'Bendahara', '2.50'),
(12, 47, 3, 'Anggota', '2.00'),
(13, 41, 4, 'PIC', '3.00'),
(14, 8, 4, 'Sekretaris', '2.50'),
(15, 12, 4, 'Bendahara', '2.50'),
(16, 33, 4, 'Anggota', '2.00'),
(17, 52, 5, 'PIC', '3.00'),
(18, 18, 5, 'Sekretaris', '2.50'),
(19, 32, 5, 'Bendahara', '2.50'),
(20, 43, 5, 'Anggota', '2.00'),
(21, 45, 6, 'PIC', '3.00'),
(22, 23, 6, 'Sekretaris', '2.50'),
(23, 39, 6, 'Bendahara', '2.50'),
(24, 31, 6, 'Anggota', '2.00'),
(25, 62, 7, 'PIC', '4.00'),
(26, 8, 8, 'PIC', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `t_bobot_dosen`
--

CREATE TABLE `t_bobot_dosen` (
  `bobot_dosen_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `beban_kegiatan_id` bigint UNSIGNED NOT NULL,
  `kegiatan_id` bigint UNSIGNED NOT NULL,
  `skor` decimal(4,2) NOT NULL,
  `waktu_mulai` date NOT NULL,
  `waktu_selesai` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_bobot_dosen`
--

INSERT INTO `t_bobot_dosen` (`bobot_dosen_id`, `user_id`, `beban_kegiatan_id`, `kegiatan_id`, `skor`, `waktu_mulai`, `waktu_selesai`, `created_at`, `updated_at`) VALUES
(1, 42, 1, 1, '5.00', '2024-10-01', '2024-11-03', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(2, 57, 2, 2, '3.00', '2024-04-01', '2024-05-15', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(3, 7, 3, 3, '3.00', '2024-02-01', '2024-03-05', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(4, 42, 1, 4, '3.00', '2024-11-10', '2025-01-25', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(5, 53, 1, 5, '3.00', '2024-11-10', '2025-01-25', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(6, 46, 3, 6, '3.00', '2024-03-01', '2024-04-25', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(7, 63, 2, 7, '4.00', '2024-01-01', '2026-01-01', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(8, 8, 2, 8, '5.00', '2024-10-18', '2024-10-18', '2024-12-16 06:42:45', '2024-12-16 06:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `t_kegiatan`
--

CREATE TABLE `t_kegiatan` (
  `kegiatan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kategori_kegiatan_id` bigint UNSIGNED NOT NULL,
  `beban_kegiatan_id` bigint UNSIGNED NOT NULL,
  `tahun_id` bigint UNSIGNED NOT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_kegiatan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cakupan_wilayah` enum('Luar Institusi','Institusi','Jurusan','Program Studi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_mulai` date DEFAULT NULL,
  `waktu_selesai` date DEFAULT NULL,
  `deadline` date NOT NULL,
  `surat_tugas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `laporan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Belum Proses','Proses','Selesai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `progres` decimal(8,2) DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_kegiatan`
--

INSERT INTO `t_kegiatan` (`kegiatan_id`, `user_id`, `kategori_kegiatan_id`, `beban_kegiatan_id`, `tahun_id`, `icon`, `nama_kegiatan`, `cakupan_wilayah`, `deskripsi`, `waktu_mulai`, `waktu_selesai`, `deadline`, `surat_tugas`, `laporan`, `status`, `progres`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 41, 1, 1, 3, 'kegiatan/jtiplayit.png', 'JTI Play IT!', 'Luar Institusi', 'JTI Play Kegiatan yang diadakan oleh jurusan teknologi informasi setiap tahunnya', '2024-10-01', '2024-11-03', '2024-11-10', 'storage/surat_tugas/1734353760_Surat Izin Orang Tua Study Excursie 2024.pdf', 'storage/laporan/1734355746_GD Surat Permohonan Perizinan Orang Tua Study Excursie 2024 - Google Docs.pdf', 'Proses', '0.80', 'Kurang Penyusunan LPJ', '2024-12-16 06:42:45', '2024-12-16 06:29:06'),
(2, 56, 1, 2, 3, 'kegiatan/dialog.png', 'Dialog Dosen Mahasiswa 2024', 'Jurusan', 'DDM Kegiatan yang diadakan oleh jurusan teknologi informasi setiap tahunnya', '2024-04-01', '2024-05-15', '2024-05-20', NULL, NULL, 'Selesai', '1.00', 'LPJ Telah diserahkan', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(3, 7, 1, 3, 3, 'kegiatan/coaching.png', 'Coaching Clinic 2024', 'Jurusan', '', '2024-02-01', '2024-03-05', '2024-03-17', 'storage/surat_tugas/1734366233_Surat Izin Orang Tua Study Excursie 2024.pdf', 'storage/laporan/1734366203_GD Surat Permohonan Perizinan Orang Tua Study Excursie 2024 - Google Docs.pdf', 'Selesai', '1.00', 'LPJ Telah diserahkan', '2024-12-16 06:42:45', '2024-12-16 09:23:53'),
(4, 41, 2, 1, 3, 'kegiatan/magangti.png', 'Magang Prodi D4 Teknik Informatika', 'Program Studi', 'Magang TI Kegiatan yang diadakan oleh jurusan teknologi informasi setiap tahunnya', '2024-11-10', '2025-01-25', '2025-01-30', 'storage/surat_tugas/1734368725_GD Surat Permohonan Perizinan Orang Tua Study Excursie 2024 - Google Docs.pdf', NULL, 'Proses', '0.40', 'Tahap Penjaringan Mahasiswa', '2024-12-16 06:42:45', '2024-12-16 10:05:25'),
(5, 52, 2, 1, 3, 'kegiatan/magangsib.png', 'Magang Prodi D4 Sistem Informasi Bisnis', 'Program Studi', 'Magang SIB Kegiatan yang diadakan oleh jurusan teknologi informasi setiap tahunnya', '2024-11-10', '2025-01-25', '2025-01-30', 'storage/surat_tugas/1734354306_Page Break for PBL.pdf', NULL, 'Proses', '0.40', 'Tahap Penjaringan Mahasiswa', '2024-12-16 06:42:45', '2024-12-16 06:05:06'),
(6, 45, 1, 3, 3, 'kegiatan/intercomp.png', 'Intercomp 2024', 'Jurusan', '', '2024-03-01', '2024-04-25', '2024-04-29', NULL, NULL, 'Selesai', '1.00', 'LPJ Telah Diserahkan', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(7, 62, 3, 1, 3, 'kegiatan/programmer.png', 'Programmer di Puskom Polinema', 'Institusi', '', '2024-01-01', '2026-01-01', '2026-01-01', NULL, NULL, 'Proses', '0.20', 'Menjadi Programmer di Puskom Polinema Pusat', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(8, 8, 3, 2, 3, 'kegiatan/upskill.png', 'Upskilling Training dengan tema Communication Skill', 'Luar Institusi', '', '2024-10-18', '2024-10-18', '2024-10-18', NULL, NULL, 'Selesai', '1.00', 'Mengikuti training di luar polinema', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(9, 14, 3, 3, 1, NULL, 'coba', 'Luar Institusi', 'Coba euy', '2024-12-17', NULL, '2024-12-21', 'storage/surat_tugas/1734335627_Surat Izin Orang Tua Study Excursie 2024.pdf', NULL, 'Proses', NULL, 'Briefing dan simulasi kegiatan secara langsung', '2024-12-16 00:53:47', '2024-12-16 01:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `t_kegiatan_agenda`
--

CREATE TABLE `t_kegiatan_agenda` (
  `agenda_id` bigint UNSIGNED NOT NULL,
  `kegiatan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nama_agenda` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` date NOT NULL,
  `lokasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progres` decimal(8,2) NOT NULL,
  `keterangan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_kegiatan_agenda`
--

INSERT INTO `t_kegiatan_agenda` (`agenda_id`, `kegiatan_id`, `user_id`, `nama_agenda`, `icon`, `deadline`, `lokasi`, `progres`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 17, 'Rapat Persiapan', 'kegiatan/icon1.png', '2024-12-01', 'Ruang Rapat A', '1.00', 'Rapat persiapan awal untuk kegiatan JTI Play IT!', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(2, 1, 62, 'Rapat Koordinasi', 'kegiatan/icon2.png', '2024-12-05', 'Ruang Koordinasi B', '1.00', 'Rapat koordinasi dengan panitia utama', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(3, 1, 51, 'Rapat Evaluasi', 'kegiatan/icon3.png', '2024-12-10', 'Ruang Evaluasi C', '1.00', 'Rapat evaluasi tahapan kegiatan', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(4, 1, 41, 'Hari Pelaksanaan', 'kegiatan/icon4.png', '2024-12-12', 'Outdoor Area', '1.00', 'Briefing dan simulasi kegiatan secara langsung', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(5, 2, 37, 'Rapat Persiapan', 'kegiatan/icon3.png', '2024-11-01', 'Ruang Rapat A', '1.00', 'Rapat persiapan awal untuk kegiatan Dialog Dosen Mahasiswa', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(6, 2, 24, 'Rapat Koordinasi', 'kegiatan/icon4.png', '2024-11-05', 'Ruang Koordinasi B', '0.00', 'Rapat koordinasi dengan dosen dan mahasiswa', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(7, 2, 44, 'Rapat Evaluasi', 'kegiatan/icon5.png', '2024-11-10', 'Ruang Evaluasi C', '0.00', 'Rapat evaluasi tentang tema kegiatan', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(8, 2, 56, 'Hari Pelaksanaan', 'kegiatan/icon7.png', '2024-11-15', 'Outdoor Area', '0.00', 'Briefing dan simulasi sesi dialog', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(9, 3, 47, 'Rapat Persiapan', 'kegiatan/icon2.png', '2024-10-01', 'Ruang Rapat A', '1.00', 'Rapat persiapan untuk kegiatan Coaching Clinic', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(10, 3, 29, 'Rapat Koordinasi', 'kegiatan/icon4.png', '2024-10-05', 'Ruang Koordinasi B', '1.00', 'Rapat koordinasi dengan pembicara', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(11, 3, 13, 'Rapat Evaluasi', 'kegiatan/icon7.png', '2024-10-10', 'Ruang Evaluasi C', '0.00', 'Rapat evaluasi hasil klinik coaching', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(12, 3, 7, 'Hari Pelaksanaan', 'kegiatan/icon8.png', '2024-10-12', 'Outdoor Area', '0.00', 'Briefing dan simulasi kegiatan', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(13, 4, 33, 'Rapat Persiapan', 'kegiatan/icon2.png', '2024-09-01', 'Ruang Rapat A', '1.00', 'Rapat persiapan untuk kegiatan magang D4 TI', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(14, 4, 12, 'Rapat Koordinasi', 'kegiatan/icon3.png', '2024-09-05', 'Ruang Koordinasi B', '1.00', 'Rapat koordinasi dengan perusahaan mitra', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(15, 4, 8, 'Rapat Evaluasi', 'kegiatan/icon1.png', '2024-09-10', 'Ruang Evaluasi C', '1.00', 'Rapat evaluasi kegiatan magang', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(16, 4, 41, 'Hari Pelaksanaan', 'kegiatan/icon1.png', '2024-09-12', 'Outdoor Area', '0.00', 'Briefing dan simulasi proses magang', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(17, 5, 43, 'Rapat Persiapan', 'kegiatan/icon1.png', '2024-08-01', 'Ruang Rapat A', '1.00', 'Rapat persiapan untuk kegiatan magang D4 SIB', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(18, 5, 32, 'Rapat Koordinasi', 'kegiatan/icon1.png', '2024-08-05', 'Ruang Koordinasi B', '1.00', 'Rapat koordinasi dengan perusahaan mitra', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(19, 5, 18, 'Rapat Evaluasi', 'kegiatan/icon1.png', '2024-08-10', 'Ruang Evaluasi C', '0.00', 'Rapat evaluasi kegiatan magang', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(20, 5, 52, 'Hari Pelaksanaan', 'kegiatan/icon1.png', '2024-08-12', 'Outdoor Area', '0.00', 'Briefing dan simulasi proses magang', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(21, 6, 31, 'Rapat Persiapan', 'kegiatan/icon1.png', '2024-07-01', 'Ruang Rapat A', '1.00', 'Rapat persiapan untuk kegiatan Intercomp', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(22, 6, 39, 'Rapat Koordinasi', 'kegiatan/icon1.png', '2024-07-05', 'Ruang Koordinasi B', '1.00', 'Rapat koordinasi dengan tim', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(23, 6, 23, 'Rapat Evaluasi', 'kegiatan/icon1.png', '2024-07-10', 'Ruang Evaluasi C', '0.00', 'Rapat evaluasi tentang hasil persiapan kegiatan', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(24, 6, 45, 'Hari Pelaksanaan', 'kegiatan/icon1.png', '2024-07-12', 'Outdoor Area', '0.00', 'Briefing dan simulasi kegiatan', '2024-12-16 06:42:45', '2024-12-16 06:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `t_kegiatan_dosen`
--

CREATE TABLE `t_kegiatan_dosen` (
  `kegiatan_dosen_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `kegiatan_id` bigint UNSIGNED NOT NULL,
  `deadline` date NOT NULL,
  `jabatan` enum('PIC','Sekretaris','Bendahara','Anggota') COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor` decimal(4,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_kegiatan_dosen`
--

INSERT INTO `t_kegiatan_dosen` (`kegiatan_dosen_id`, `user_id`, `kegiatan_id`, `deadline`, `jabatan`, `skor`, `created_at`, `updated_at`) VALUES
(1, 41, 1, '2024-12-05', 'PIC', '5.00', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(2, 51, 1, '2024-12-05', 'Sekretaris', '4.00', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(3, 62, 1, '2024-12-05', 'Bendahara', '4.00', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(4, 17, 1, '2024-12-05', 'Anggota', '3.00', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(5, 56, 2, '2024-11-20', 'PIC', '3.00', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(6, 44, 2, '2024-11-20', 'Sekretaris', '2.50', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(7, 24, 2, '2024-11-20', 'Bendahara', '2.50', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(8, 37, 2, '2024-11-20', 'Anggota', '2.00', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(9, 62, 7, '2024-12-30', 'PIC', '4.00', '2024-12-16 06:42:45', '2024-12-16 06:42:45'),
(10, 8, 8, '2024-11-30', 'PIC', '5.00', '2024-12-16 06:42:45', '2024-12-16 06:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_beban_kegiatan`
--
ALTER TABLE `m_beban_kegiatan`
  ADD PRIMARY KEY (`beban_kegiatan_id`),
  ADD UNIQUE KEY `m_beban_kegiatan_nama_beban_unique` (`nama_beban`);

--
-- Indexes for table `m_bobot_jabatan`
--
ALTER TABLE `m_bobot_jabatan`
  ADD PRIMARY KEY (`bobot_jabatan_id`);

--
-- Indexes for table `m_kategori_kegiatan`
--
ALTER TABLE `m_kategori_kegiatan`
  ADD PRIMARY KEY (`kategori_kegiatan_id`),
  ADD UNIQUE KEY `m_kategori_kegiatan_nama_kategori_unique` (`nama_kategori`);

--
-- Indexes for table `m_level`
--
ALTER TABLE `m_level`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `m_level_level_kode_unique` (`level_kode`);

--
-- Indexes for table `m_tahun`
--
ALTER TABLE `m_tahun`
  ADD PRIMARY KEY (`tahun_id`),
  ADD UNIQUE KEY `m_tahun_tahun_unique` (`tahun`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `m_user_username_unique` (`username`),
  ADD UNIQUE KEY `m_user_nip_unique` (`nip`),
  ADD UNIQUE KEY `m_user_email_unique` (`email`),
  ADD KEY `1` (`level_id`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `notifikasi_kegiatan_id_foreign` (`kegiatan_id`),
  ADD KEY `notifikasi_user_id_index` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `t_anggota_kegiatan`
--
ALTER TABLE `t_anggota_kegiatan`
  ADD PRIMARY KEY (`anggota_id`),
  ADD KEY `t_anggota_kegiatan_user_id_index` (`user_id`),
  ADD KEY `t_anggota_kegiatan_kegiatan_id_index` (`kegiatan_id`);

--
-- Indexes for table `t_bobot_dosen`
--
ALTER TABLE `t_bobot_dosen`
  ADD PRIMARY KEY (`bobot_dosen_id`),
  ADD KEY `t_bobot_dosen_user_id_index` (`user_id`),
  ADD KEY `t_bobot_dosen_beban_kegiatan_id_index` (`beban_kegiatan_id`),
  ADD KEY `t_bobot_dosen_kegiatan_id_index` (`kegiatan_id`);

--
-- Indexes for table `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  ADD PRIMARY KEY (`kegiatan_id`),
  ADD KEY `t_kegiatan_user_id_index` (`user_id`),
  ADD KEY `t_kegiatan_kategori_kegiatan_id_index` (`kategori_kegiatan_id`),
  ADD KEY `t_kegiatan_beban_kegiatan_id_index` (`beban_kegiatan_id`),
  ADD KEY `t_kegiatan_tahun_id_index` (`tahun_id`);

--
-- Indexes for table `t_kegiatan_agenda`
--
ALTER TABLE `t_kegiatan_agenda`
  ADD PRIMARY KEY (`agenda_id`),
  ADD KEY `t_kegiatan_agenda_kegiatan_id_index` (`kegiatan_id`),
  ADD KEY `t_kegiatan_agenda_user_id_index` (`user_id`);

--
-- Indexes for table `t_kegiatan_dosen`
--
ALTER TABLE `t_kegiatan_dosen`
  ADD PRIMARY KEY (`kegiatan_dosen_id`),
  ADD KEY `t_kegiatan_dosen_user_id_index` (`user_id`),
  ADD KEY `t_kegiatan_dosen_kegiatan_id_index` (`kegiatan_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `m_beban_kegiatan`
--
ALTER TABLE `m_beban_kegiatan`
  MODIFY `beban_kegiatan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_bobot_jabatan`
--
ALTER TABLE `m_bobot_jabatan`
  MODIFY `bobot_jabatan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `m_kategori_kegiatan`
--
ALTER TABLE `m_kategori_kegiatan`
  MODIFY `kategori_kegiatan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_tahun`
--
ALTER TABLE `m_tahun`
  MODIFY `tahun_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `notif_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_anggota_kegiatan`
--
ALTER TABLE `t_anggota_kegiatan`
  MODIFY `anggota_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `t_bobot_dosen`
--
ALTER TABLE `t_bobot_dosen`
  MODIFY `bobot_dosen_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  MODIFY `kegiatan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `t_kegiatan_agenda`
--
ALTER TABLE `t_kegiatan_agenda`
  MODIFY `agenda_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t_kegiatan_dosen`
--
ALTER TABLE `t_kegiatan_dosen`
  MODIFY `kegiatan_dosen_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `1` FOREIGN KEY (`level_id`) REFERENCES `m_level` (`level_id`);

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `notifikasi_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `t_kegiatan` (`kegiatan_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifikasi_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_anggota_kegiatan`
--
ALTER TABLE `t_anggota_kegiatan`
  ADD CONSTRAINT `t_anggota_kegiatan_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `t_kegiatan` (`kegiatan_id`),
  ADD CONSTRAINT `t_anggota_kegiatan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_bobot_dosen`
--
ALTER TABLE `t_bobot_dosen`
  ADD CONSTRAINT `t_bobot_dosen_beban_kegiatan_id_foreign` FOREIGN KEY (`beban_kegiatan_id`) REFERENCES `m_beban_kegiatan` (`beban_kegiatan_id`),
  ADD CONSTRAINT `t_bobot_dosen_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `t_kegiatan` (`kegiatan_id`),
  ADD CONSTRAINT `t_bobot_dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_kegiatan`
--
ALTER TABLE `t_kegiatan`
  ADD CONSTRAINT `t_kegiatan_beban_kegiatan_id_foreign` FOREIGN KEY (`beban_kegiatan_id`) REFERENCES `m_beban_kegiatan` (`beban_kegiatan_id`),
  ADD CONSTRAINT `t_kegiatan_kategori_kegiatan_id_foreign` FOREIGN KEY (`kategori_kegiatan_id`) REFERENCES `m_kategori_kegiatan` (`kategori_kegiatan_id`),
  ADD CONSTRAINT `t_kegiatan_tahun_id_foreign` FOREIGN KEY (`tahun_id`) REFERENCES `m_tahun` (`tahun_id`),
  ADD CONSTRAINT `t_kegiatan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_kegiatan_agenda`
--
ALTER TABLE `t_kegiatan_agenda`
  ADD CONSTRAINT `t_kegiatan_agenda_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `t_kegiatan` (`kegiatan_id`),
  ADD CONSTRAINT `t_kegiatan_agenda_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_kegiatan_dosen`
--
ALTER TABLE `t_kegiatan_dosen`
  ADD CONSTRAINT `t_kegiatan_dosen_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `t_kegiatan` (`kegiatan_id`),
  ADD CONSTRAINT `t_kegiatan_dosen_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
