-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 25, 2026 lúc 08:31 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `filmlane_laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`) VALUES
(1, 'Hành động', 'action'),
(2, 'Adventure', 'adventure'),
(3, 'Fantasy', 'fantasy'),
(4, 'Sci-Fi', 'sci-fi'),
(5, 'Comedy', 'comedy'),
(6, 'Thriller', 'thriller'),
(7, 'Tình cảm', 'romance'),
(8, 'Anime', 'Anime');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `countries`
--

INSERT INTO `countries` (`id`, `title`, `slug`) VALUES
(1, 'United States', 'united-states'),
(2, 'United Kingdom', 'united-kingdom'),
(3, 'Hàn Quốc', 'korean'),
(4, 'Nhật Bản', 'japan'),
(5, 'Việt Nam', 'Vietnam');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `episodes`
--

CREATE TABLE `episodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `episode_number` int(11) NOT NULL,
  `video_link` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `episodes`
--

INSERT INTO `episodes` (`id`, `movie_id`, `episode_number`, `video_link`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'https://vip.opstream14.com/share/af070abdf5156acd363fca2b6f391ace', 'active', '2026-03-17 04:36:54', '2026-03-17 04:36:54'),
(2, 2, 1, 'https://vip.opstream10.com/20230104/26009_d2334426/index.m3u8', 'active', '2026-03-17 04:36:54', '2026-03-17 04:36:54'),
(3, 3, 1, 'https://vip.opstream12.com/20220513/15200_95feaaf1/index.m3u8', 'active', '2026-03-17 04:36:54', '2026-03-17 04:36:54'),
(4, 4, 1, 'https://vip.opstream14.com/share/aeda4e5a3a22f1e1b0cfe7a8191fb21a', 'active', '2026-03-17 04:36:54', '2026-03-17 04:36:54'),
(5, 5, 1, 'https://vip.opstream14.com/20220505/10961_526ff40d/index.m3u8', 'active', '2026-03-17 04:36:54', '2026-03-17 04:36:54'),
(6, 6, 1, 'https://vip.opstream14.com/share/8780a72513a774d87bae314cb01856ba', 'active', '2026-03-17 04:36:54', '2026-03-17 04:36:54'),
(7, 7, 1, 'https://vip.opstream11.com/share/c8cbd669cfb2f016574e9d147092b5bb', 'active', '2026-03-17 04:36:54', '2026-03-17 04:36:54'),
(8, 8, 1, 'https://vip.opstream11.com/share/d860edd1dd83b36f02ce52bde626c653', 'active', '2026-03-17 04:36:54', '2026-03-17 04:36:54'),
(9, 9, 1, 'https://vip.opstream15.com/share/001fca6b304504b620c727b498b2d814', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(10, 9, 2, 'https://vip.opstream15.com/share/2e4d3f59fa26af64eef3b0795b775ec1', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(11, 9, 3, 'https://vip.opstream15.com/share/a6734d9b7f042da7d5ec0c81964e21a1', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(12, 9, 4, 'https://vip.opstream15.com/share/8412f42034af852f237e3af8209f3a6f', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(13, 9, 5, 'https://vip.opstream15.com/share/eabb26513f3fb940057f1094e6cf2bb1', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(14, 9, 6, 'https://vip.opstream15.com/share/0c72e483c7a71bdfb5ddfe05bb597081', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(15, 9, 7, 'https://vip.opstream15.com/share/9d5ce379163bb569eaec48e30ee1bf3f', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(16, 9, 8, 'https://vip.opstream15.com/share/d7a5f2a23c4cc1af979fefc8348e6936', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(17, 9, 9, 'https://vip.opstream15.com/share/0d10e29d75af6551e75c87d10169a1d2', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(18, 9, 10, 'https://vip.opstream15.com/share/af3f3aefaf93ea8364b3e2cb27b9594c', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(19, 9, 11, 'https://vip.opstream15.com/share/b8452120100ecb4b0ee9eeb2a570fcd7', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(20, 9, 12, 'https://vip.opstream15.com/share/aa22e85f69c07a082c15017f43c5ca66', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(21, 9, 13, 'https://vip.opstream12.com/share/6713524ea458bee4d73485010e9c682f', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(22, 9, 14, 'https://vip.opstream12.com/share/75ad20f9c546aef9e9fcc21e08a8a3dd', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(23, 9, 15, 'https://vip.opstream12.com/share/d8e04b16451f7f67a5da5005d4e032ee', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(24, 9, 16, 'https://vip.opstream12.com/share/8e6386593ca0e8602ff05a069fa23777', 'active', '2026-03-20 08:20:00', '2026-03-20 08:20:00'),
(26, 10, 1, 'https://vip.opstream16.com/share/6ecbdd6ec859d284dc13885a37ce8d81', 'active', '2026-03-20 08:33:17', '2026-03-20 08:33:17'),
(27, 11, 1, 'https://vip.opstream14.com/share/517cd23ae4375b47d04ef6363a229b13', 'active', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 12, 1, 'https://vip.opstream13.com/share/a01f3ca6e3e4ece8e1a30696f52844bc', 'active', '2026-03-24 06:09:44', '2026-03-24 06:09:44'),
(29, 12, 1, 'https://vip.opstream13.com/share/a01f3ca6e3e4ece8e1a30696f52844bc', 'active', '2026-03-24 06:10:26', '2026-03-24 06:10:26'),
(30, 13, 1, 'https://vip.opstream14.com/share/b1562246c02be63bac86a26684cdce58', 'active', '2026-03-24 06:13:17', '2026-03-24 06:13:17'),
(31, 14, 1, 'https://vip.opstream90.com/share/49cea6b66a1c9d9fcbba8946453c057b', 'active', '2026-03-24 08:50:33', '2026-03-24 08:50:33'),
(32, 15, 1, 'https://vip.opstream14.com/share/d82118376df344b0010f53909b961db3', 'active', '2026-03-24 10:17:27', '2026-03-24 10:17:27'),
(33, 16, 1, 'https://vip.opstream12.com/share/36e729ec173b94133d8fa552e4029f8b', 'active', '2026-03-24 10:28:48', '2026-03-24 10:28:48'),
(34, 16, 2, 'https://vip.opstream12.com/share/c57168a952f5d46724cf35dfc3d48a7f', 'active', '2026-03-24 10:29:07', '2026-03-24 10:29:07'),
(35, 16, 3, 'ttps://vip.opstream12.com/share/ef0917ea498b1665ad6c701057155abe', 'active', '2026-03-24 10:30:34', '2026-03-24 10:30:34'),
(36, 16, 4, 'https://vip.opstream12.com/share/7876acb66640bad41f1e1371ef30c180', 'active', '2026-03-25 00:25:24', '2026-03-25 00:25:24'),
(37, 16, 5, 'https://vip.opstream12.com/share/fb89fd138b104dcf8e2077ad2a23954d', 'active', '2026-03-25 00:25:34', '2026-03-25 00:25:34'),
(38, 16, 6, 'https://vip.opstream12.com/share/743c41a921516b04afde48bb48e28ce6', 'active', '2026-03-25 00:25:41', '2026-03-25 00:25:41'),
(39, 16, 7, 'https://vip.opstream12.com/share/978fce5bcc4eccc88ad48ce3914124a2', 'active', '2026-03-25 00:25:49', '2026-03-25 00:25:49'),
(40, 16, 8, 'https://vip.opstream12.com/share/18bb68e2b38e4a8ce7cf4f6b2625768c', 'active', '2026-03-25 00:25:58', '2026-03-25 00:25:58'),
(41, 16, 9, 'https://vip.opstream12.com/share/453fadbd8a1a3af50a9df4df899537b5', 'active', '2026-03-25 00:26:07', '2026-03-25 00:26:07'),
(42, 16, 10, 'https://vip.opstream12.com/share/ce758408f6ef98d7c7a7b786eca7b3a8', 'active', '2026-03-25 00:26:15', '2026-03-25 00:26:15'),
(43, 16, 11, 'https://vip.opstream12.com/share/026a39ae63343c68b5223a95f3e17616', 'active', '2026-03-25 00:26:23', '2026-03-25 00:26:23'),
(44, 16, 12, 'https://vip.opstream12.com/share/4ebccfb3e317c7789f04f7a558df4537', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(45, 16, 13, 'https://vip.opstream12.com/share/bd70364a8fcba02366697df66f50b4d4', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(46, 16, 14, 'https://vip.opstream12.com/share/ed57844fa5e051809ead5aa7e3e1d555', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(47, 16, 15, 'https://vip.opstream12.com/share/50abc3e730e36b387ca8e02c26dc0a22', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(48, 16, 16, 'https://vip.opstream12.com/share/32b991e5d77ad140559ffb95522992d0', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(49, 16, 17, 'https://vip.opstream12.com/share/e02e27e04fdff967ba7d76fb24b8069d', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(50, 16, 18, 'https://vip.opstream12.com/share/92f54963fc39a9d87c2253186808ea61', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(51, 16, 19, 'https://vip.opstream12.com/share/6403675579f6114559c90de0014cd3d6', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(52, 16, 20, 'https://vip.opstream12.com/share/880610aa9f9de9ea7c545169c716f477', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(53, 16, 21, 'https://vip.opstream12.com/share/a431d70133ef6cf688bc4f6093922b48', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(54, 16, 22, 'https://vip.opstream12.com/share/d3fad7d3634dbfb61018813546edbccb', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(55, 16, 23, 'https://vip.opstream12.com/share/d756d3d2b9dac72449a6a6926534558a', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35'),
(56, 16, 24, 'https://vip.opstream12.com/share/53c6de78244e9f528eb3e1cda69699bb', 'active', '2026-03-25 07:29:35', '2026-03-25 07:29:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `job_batches`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_16_000003_create_categories_table', 1),
(5, '2026_03_16_000004_create_countries_table', 1),
(6, '2026_03_16_172554_create_movies_table', 1),
(7, '2026_03_16_172658_create_episodes_table', 1),
(8, '2026_03_16_172801_create_ratings_table', 1),
(9, '2026_03_16_172818_create_watch_histories_table', 1),
(10, '2026_03_17_051127_add_flags_to_movies_table', 2),
(11, '2026_03_20_070130_add_status_to_movies_table', 3),
(12, '2026_03_20_070143_add_status_to_movies_table', 3),
(13, '2026_03_24_080546_add_status_to_episodes_table', 4),
(14, '2026_03_24_170310_add_type_to_movies_table', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

CREATE TABLE `movies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('single','series') NOT NULL DEFAULT 'single',
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `resolution` varchar(255) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `subtitle_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_upcoming` tinyint(1) NOT NULL DEFAULT 0,
  `is_top_rated` tinyint(1) NOT NULL DEFAULT 0,
  `is_trending` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`id`, `title`, `type`, `slug`, `description`, `image`, `year`, `category_id`, `country_id`, `resolution`, `status`, `subtitle_type`, `created_at`, `updated_at`, `is_upcoming`, `is_top_rated`, `is_trending`, `deleted_at`) VALUES
(1, 'Doctor Strange in the Multiverse of Madness', 'single', 'doctor-strange-multiverse-of-madness', 'Doctor Strange travels through the multiverse with the help of mystical allies to face a powerful new adversary.', 'images/movies/doctor_strange.png', '2022', 3, 1, 'HD', 'active', 'Vietsub', '2026-03-17 03:54:14', '2026-03-22 09:14:49', 1, 0, 1, NULL),
(2, 'Memory', 'single', 'memory-2022', 'An assassin with memory problems refuses a contract and becomes a target himself.', 'images/movies/memory.png', '2022', 6, 1, 'HD', 'active', 'Vietsub', '2026-03-17 03:54:14', '2026-03-17 03:54:14', 1, 0, 1, NULL),
(3, 'The Northman', 'single', 'the-northman', 'A Viking prince embarks on a quest to avenge his father.', 'images/movies/the_northman.png', '2022', 1, 1, 'HD', 'active', 'Vietsub', '2026-03-17 03:54:14', '2026-03-17 03:54:14', 1, 0, 1, NULL),
(4, 'The Unbearable Weight of Massive Talent', 'single', 'unbearable-weight-of-massive-talent', 'Nicolas Cage accepts a million-dollar offer to attend a wealthy fan birthday party.', 'images/movies/unberaable_weight.png', '2022', 5, 1, 'HD', 'active', 'Vietsub', '2026-03-17 03:54:14', '2026-03-17 03:54:14', 1, 0, 1, NULL),
(5, 'Sonic the Hedgehog 2', 'single', 'sonic-the-hedgehog-2', 'Sonic teams up with Tails to stop Dr. Robotnik and Knuckles from finding a powerful emerald.', 'images/movies/sonic2.png', '2022', 2, 1, 'HD', 'active', 'Vietsub', '2026-03-17 03:54:14', '2026-03-17 03:54:14', 1, 0, 1, NULL),
(6, 'Morbius', 'single', 'morbius', 'Biochemist Michael Morbius tries to cure himself of a rare blood disease but becomes a living vampire.', 'images/movies/morbius.png', '2022', 4, 1, 'HD', 'active', 'Vietsub', '2026-03-17 03:54:14', '2026-03-20 22:25:42', 1, 0, 1, '0000-00-00 00:00:00'),
(7, 'The Adam Project', 'single', 'the-adam-project', 'A time-traveling pilot teams up with his younger self to save the future.', 'images/movies/adam_project.png', '2022', 4, 1, 'HD', 'active', 'Vietsub', '2026-03-17 03:54:14', '2026-03-17 03:54:14', 0, 0, 1, NULL),
(8, 'Free Guy', 'single', 'free-guy', 'A bank teller discovers he is actually a background character in an open-world video game.', 'images/movies/free_guy.png', '2021', 5, 1, 'HD', 'active', 'Vietsub', '2026-03-17 03:54:14', '2026-03-17 03:54:14', 0, 0, 1, NULL),
(9, 'Khi Cuộc Đời Cho Bạn Quả Quýt', 'series', 'khi-cuoc-doi-cho-ban-qua-quyt', 'Lấy bối cảnh đảo Jeju mộng mơ những năm 1950, bộ phim kể về cuộc đời đầy thăng trầm của Ae-sun (IU) - một cô gái rực rỡ, nổi loạn nhưng đầy nghị lực, và Gwan-sik (Park Bo-gum) - một chàng trai ít nói, chân thành và luôn kiên định bảo vệ cô.', 'images/movies/khi-cuoc-doi-cho-ban-qua-quyt-thumb.webp', '2025', 3, 3, 'HD', 'active', 'Vietsub', '2026-03-20 08:17:40', '2026-03-24 10:13:16', 0, 1, 1, NULL),
(10, 'Mắt Biếc', 'single', 'mat-biec', 'Được chuyển thể từ tiểu thuyết cùng tên của nhà văn Nguyễn Nhật Ánh, Mắt Biếc kể về tình yêu đơn phương đầy day dứt của Ngạn dành cho cô bạn thanh mai trúc mã Hà Lan - người sở hữu đôi mắt tuyệt đẹp nhưng lại bị cuốn vào vòng xoáy phồn hoa đô thị.', 'images/movies/mat-biec-thumb.webp', '2019', 5, 1, 'FHD', 'active', 'Bản gốc', '2026-03-20 08:33:17', '2026-03-22 09:15:15', 0, 1, 1, NULL),
(11, 'Em chưa 18', 'single', 'em-chua-18', 'Không muốn bị pháp luật sờ gáy, anh chàng huấn luyện viên yoga lăng nhăng đồng ý giả làm bạn trai của nữ sinh cấp 3 đầy nhiệt huyết đang muốn chọc tức bồ cũ.', 'images/movies/1774032100.webp', '2017', 1, 5, 'HD', 'active', 'Bản gốc', '2026-03-20 11:41:40', '2026-03-20 11:41:40', 0, 0, 1, NULL),
(12, 'MAI', 'single', 'mai', 'MAI xoay quanh câu chuyện về cuộc đời của một người phụ nữ cùng tên với bộ phim. Trên First-look Poster, Phương Anh Đào tạo ấn tượng mạnh với cái nhìn tĩnh lặng, xuyên thấu, đặc biệt, trên bờ môi nữ diễn viên là hình ảnh cô đang nằm nghiêng trên mặt nước. Được phủ một màn sương mờ ảo, poster đậm chất nghệ thuật của Mai gây tò mò với lời tựa: “Quá khứ chưa ngủ yên, ngày mai liệu sẽ đến?”.', 'images/movies/1774065511.webp', '2024', 7, 5, 'HD', 'active', 'Vietsub', '2026-03-20 20:58:31', '2026-03-22 09:22:04', 0, 1, 1, NULL),
(13, 'Bố Già', 'single', 'bo-gia-2024', 'Câu chuyện về Ba Sang - con thứ hai trong 4 anh em ồn ào: Giàu, Sang, Phú, Quý. Ba Sang là một người ga lăng, “quá” tốt bụng và luôn hy sinh vì người khác dù họ có muốn hay không. Quân - Ba Sang’s son là một Youtuber trẻ hiện đại.', 'images/movies/1774357948.webp', '2024', 7, 5, 'HD', 'active', 'Bản gốc', '2026-03-24 06:12:28', '2026-03-24 06:12:52', 0, 0, 1, NULL),
(14, 'Truy Tìm Long Diên Hương', 'single', 'truy-tim-long-dien-huong', 'Một hành trình tìm lại bảo vật Long Diên Hương siêu quậy và siêu lầy lội đang chờ bạn ở phía trước. Quang Tuấn, Ma Ran Đô, Nguyên Thảo, Hoàng Tóc Dài, Doãn Quốc Đam,... đã sẵn sàng lên đường Truy Tìm Long Diên Hương.', 'images/movies/1774367410.webp', '2025', 1, 5, 'HD', 'active', 'Vietsub', '2026-03-24 08:50:10', '2026-03-24 08:50:10', 0, 0, 1, NULL),
(15, 'Naruto: Huyết Ngục', 'single', 'naruto-huyet-nguc', 'Naruto Uzumaki được đóng khung và gửi đến một nhà tù không thể cưỡng lại nơi anh ta phải trốn thoát bằng mọi cách cần thiết.', 'images/movies/1774372627.webp', '2011', 8, 4, 'HD', 'active', 'Vietsub', '2026-03-24 10:17:07', '2026-03-24 10:17:07', 0, 0, 1, NULL),
(16, 'Tuổi Trẻ Của Tháng Năm', 'series', 'tuoi-tre-cua-thang-nam', 'Tuổi Trẻ Của Tháng Năm - Youth of May kể về cuộc sống của hai nhân vật trẻ tuổi đã bị cuốn vào cuộc nổi dậy Gwangju xảy ra vào tháng 5, năm 1980. Hwang Hee Tae là một kẻ gây rối, người luôn ghét những gì được sắp đặt trước. Cuộc đời của anh đã được mô tả bằng cum từ :\"Cuộc chiến chống lại định kiến\". Nhờ phá vỡ định kiến đối với những con được nuôi dưỡng bởi những người mẹ đơn thân, anh đã được tuyển tại đại học Seul. Tuy nhiên, do những sự kiện bất ngờ xảy ra, anh đã phải trải qua những năm tháng khắc nhiệt nhất trong cuộc đời. Kim Myung Hee là một nữ y tá, luôn làm việc chăm chỉ và hết lòng cho các bệnh nhân của mình.', 'images/movies/1774373307.webp', '2021', 7, 3, 'HD', 'active', 'Vietsub', '2026-03-24 10:28:27', '2026-03-24 10:28:34', 0, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ratings`
--

CREATE TABLE `ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('W1eHKQ37uvNwKm17r34Zti3Ut3PJptzj1v4o2iQB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYll4TUtrRklDbFJONXV0RlhEanJFQjlZbVhmallkOGdobFdLS0xFYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1774423812);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `watch_histories`
--

CREATE TABLE `watch_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `watched_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `episodes_movie_id_foreign` (`movie_id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `movies_slug_unique` (`slug`),
  ADD KEY `movies_category_id_foreign` (`category_id`),
  ADD KEY `movies_country_id_foreign` (`country_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ratings_user_id_foreign` (`user_id`),
  ADD KEY `ratings_movie_id_foreign` (`movie_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `watch_histories`
--
ALTER TABLE `watch_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `watch_histories_user_id_foreign` (`user_id`),
  ADD KEY `watch_histories_movie_id_foreign` (`movie_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `movies`
--
ALTER TABLE `movies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `watch_histories`
--
ALTER TABLE `watch_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `movies_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ratings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `watch_histories`
--
ALTER TABLE `watch_histories`
  ADD CONSTRAINT `watch_histories_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `watch_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
