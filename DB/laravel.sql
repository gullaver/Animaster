-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 06:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '361862797947269.jpg', 'test@test.com', NULL, '$2y$10$a4pZC/Zo5uS3f5NuDKorbOFaP6I1kkQ05zWkMvmB/aHF4rdmV9bXO', NULL, NULL, '2020-06-30 14:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `blockedips`
--

CREATE TABLE `blockedips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catedesc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catename`, `catedesc`, `created_at`, `updated_at`) VALUES
(406, 'Anime', 'Anime pronounced AHneemay is a term for a style of Japanese comic book and video cartoon animation in which the main characters have large doelike eyes', '2020-06-14 01:09:26', '2020-06-23 04:56:57'),
(421, 'Manga', 'Manga', '2020-06-21 01:25:22', '2020-06-21 01:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `value`, `created_at`, `updated_at`, `role`) VALUES
(12, 23, 1, 'hello', '2020-06-28 06:00:25', '2020-06-28 06:00:25', NULL),
(13, 23, 1, 'ok', '2020-06-28 06:02:00', '2020-06-28 06:02:00', 'admin'),
(14, 26, 1, 'Hello Im here', '2020-06-28 06:13:58', '2020-06-28 06:13:58', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Salim Saeed', 'yotval@gmail.com', 'This message is very important and you have to read', 'read', '2020-06-24 13:35:16', '2020-06-24 14:05:05'),
(4, 'Test', 'test@test.com', 'hello this is my message', 'read', '2020-07-04 09:49:19', '2020-07-06 07:48:23');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_04_20_110347_create_admins_table', 1),
(5, '2020_04_23_143600_create_categories_table', 1),
(6, '2020_06_06_070604_create_series_table', 1),
(7, '2020_06_08_025956_create_posts_table', 1),
(8, '2020_06_12_070603_create_posts_table', 2),
(9, '2020_06_13_021345_create_posts_table', 3),
(10, '2020_06_13_021524_create_posts_table', 4),
(11, '2020_06_14_044954_create_pages_table', 5),
(12, '2020_06_15_021552_create_pages_table', 6),
(13, '2020_06_17_074340_create_users_table', 7),
(14, '2020_06_17_074612_create_users_table', 8),
(15, '2020_06_17_104307_create_comments_table', 9),
(16, '2020_06_17_120529_create_sites_table', 9),
(17, '2020_06_17_145420_create_sites_table', 10),
(18, '2020_06_18_062220_create_series_table', 11),
(19, '2020_06_18_065232_create_series_table', 12),
(20, '2020_06_18_142213_create_messages_table', 13),
(21, '2020_06_27_082910_add_views_column_to_posts_table', 14),
(22, '2020_06_28_073739_add_roles_column_to_comments_table', 15),
(23, '2020_06_28_113217_create_sites_table', 16),
(24, '2020_07_01_093403_create_blockedips_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pagename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pagecontent` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pagesorder` int(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `pagename`, `pagecontent`, `pagesorder`, `created_at`, `updated_at`) VALUES
(2, 'About', '<p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><b>It is a long established </b></p><p style=\"text-align: left; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p><div><h2 style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><b>It is a long established </b></h2><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div><div><h1 style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><b>It is a long established f</b></h1><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\">act that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p></div>', 1, '2020-06-15 00:48:08', '2020-07-06 14:46:10'),
(3, 'Privacy policy', '<p>test</p>', 0, '2020-07-06 12:39:52', '2020-07-06 14:46:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `series_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `epn` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upvideo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `videxten` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watchserversname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `watchserverscode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `downserversname` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `downserverslink` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `downloadoption` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `views` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `series_id`, `title`, `epn`, `content`, `upvideo`, `videxten`, `watchserversname`, `watchserverscode`, `downserversname`, `downserverslink`, `downloadoption`, `image`, `image_src`, `tags`, `created_at`, `updated_at`, `views`) VALUES
(23, 406, 11, 'Dragon Ball super - Episoede 1', 1, NULL, '', '', '4shared*/-)917315^AniMaSTerSerViCE!8419zLwMstreamtape*/-)917315^AniMaSTerSerViCE!8419zLwMmp4upload*/-)917315^AniMaSTerSerViCE!8419zLwMMega*/-)917315^AniMaSTerSerViCE!8419zLwM', '<iframe src=\"https://www.4shared.com/web/embed/file/G13BpZAEea\" frameborder=\"0\" scrolling=\"no\" width=\"470\" height=\"320\" allowfullscreen=\"true\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe src=\"https://streamtape.com/e/3BKxmQ8LDvidZwl/\" width=\"800\" height=\"600\" allowfullscreen allowtransparency allow=\"autoplay\" scrolling=\"no\" frameborder=\"0\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM<IFRAME SRC=\"https://www.mp4upload.com/embed-ulaamlms54r4.html\" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=640 HEIGHT=360 allowfullscreen></IFRAME>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed/AtoRmbBb#nY8Bl4lRPGkz4ZKJUttVi8bBFLvqt4mEpzl-Q36LJ-4\" allowfullscreen ></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM', 'Mega*/-)917315^AniMaSTerSerViCE!8419zLwM4shared*/-)917315^AniMaSTerSerViCE!8419zLwM', 'https://mega.nz/file/AtoRmbBb#nY8Bl4lRPGkz4ZKJUttVi8bBFLvqt4mEpzl-Q36LJ-4*/-)917315^AniMaSTerSerViCE!8419zLwMhttps://www.4shared.com/video/G13BpZAEea/___.html?*/-)917315^AniMaSTerSerViCE!8419zLwM', 'Yes', 'images/posts_images/img_967802043398131.jpg', 'native', 'dragon,ball,super,episode,1', '2020-06-22 13:48:12', '2020-07-05 15:53:48', 123),
(24, 406, 11, 'Dragon Ball super  - Episode 2', 2, NULL, '', '', 'mp4upload*/-)917315^AniMaSTerSerViCE!8419zLwMstreamtape*/-)917315^AniMaSTerSerViCE!8419zLwMMega*/-)917315^AniMaSTerSerViCE!8419zLwM', '<IFRAME SRC=\"https://www.mp4upload.com/embed-ulaamlms54r4.html\" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=640 HEIGHT=360 allowfullscreen></IFRAME>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe src=\"https://streamtape.com/e/3BKxmQ8LDvidZwl/\" width=\"800\" height=\"600\" allowfullscreen allowtransparency allow=\"autoplay\" scrolling=\"no\" frameborder=\"0\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed/AtoRmbBb#nY8Bl4lRPGkz4ZKJUttVi8bBFLvqt4mEpzl-Q36LJ-4\" allowfullscreen ></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM', '4shared*/-)917315^AniMaSTerSerViCE!8419zLwMMega*/-)917315^AniMaSTerSerViCE!8419zLwM', 'https://www.4shared.com/video/G13BpZAEea/___.html?*/-)917315^AniMaSTerSerViCE!8419zLwMhttps://mega.nz/file/AtoRmbBb#nY8Bl4lRPGkz4ZKJUttVi8bBFLvqt4mEpzl-Q36LJ-4*/-)917315^AniMaSTerSerViCE!8419zLwM', 'Yes', 'images/posts_images/img_512384728766745.jpg', 'native', 'dragon,ball,super,episode,2', '2020-06-22 13:50:47', '2020-07-04 11:02:53', 9),
(25, 406, 11, 'Dragon Ball super 3 - Episode 3', 3, NULL, '', '', '4shared*/-)917315^AniMaSTerSerViCE!8419zLwMstreamtape*/-)917315^AniMaSTerSerViCE!8419zLwM', '<iframe src=\"https://www.4shared.com/web/embed/file/G13BpZAEea\" frameborder=\"0\" scrolling=\"no\" width=\"470\" height=\"320\" allowfullscreen=\"true\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe src=\"https://streamtape.com/e/3BKxmQ8LDvidZwl/\" width=\"800\" height=\"600\" allowfullscreen allowtransparency allow=\"autoplay\" scrolling=\"no\" frameborder=\"0\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM', '', '', 'No', 'images/posts_images/img_289018913588684.jpg', 'native', 'dragon,ball,super,episode,3', '2020-06-22 13:52:24', '2020-07-04 09:55:10', 3),
(26, 421, 12, 'Secret Champer - Episode 1', 1, NULL, '', '', 'Mega*/-)917315^AniMaSTerSerViCE!8419zLwM4shared*/-)917315^AniMaSTerSerViCE!8419zLwMstreamtape*/-)917315^AniMaSTerSerViCE!8419zLwMmp4upload*/-)917315^AniMaSTerSerViCE!8419zLwM', '<iframe width=\"640\" height=\"360\" frameborder=\"0\" src=\"https://mega.nz/embed/AtoRmbBb#nY8Bl4lRPGkz4ZKJUttVi8bBFLvqt4mEpzl-Q36LJ-4\" allowfullscreen ></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe src=\"https://www.4shared.com/web/embed/file/G13BpZAEea\" frameborder=\"0\" scrolling=\"no\" width=\"470\" height=\"320\" allowfullscreen=\"true\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe src=\"https://streamtape.com/e/3BKxmQ8LDvidZwl/\" width=\"800\" height=\"600\" allowfullscreen allowtransparency allow=\"autoplay\" scrolling=\"no\" frameborder=\"0\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM<IFRAME SRC=\"https://www.mp4upload.com/embed-ulaamlms54r4.html\" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=640 HEIGHT=360 allowfullscreen></IFRAME>*/-)917315^AniMaSTerSerViCE!8419zLwM', '4shared*/-)917315^AniMaSTerSerViCE!8419zLwMMega*/-)917315^AniMaSTerSerViCE!8419zLwM', 'https://www.4shared.com/video/G13BpZAEea/___.html?*/-)917315^AniMaSTerSerViCE!8419zLwMhttps://mega.nz/file/AtoRmbBb#nY8Bl4lRPGkz4ZKJUttVi8bBFLvqt4mEpzl-Q36LJ-4*/-)917315^AniMaSTerSerViCE!8419zLwM', 'Yes', 'images/posts_images/img_632195827795399.jpg', 'native', 'secret,champer,episode,1', '2020-06-22 13:55:14', '2020-07-05 15:38:48', 4),
(27, 421, 12, 'Secret Champer - Episode 2', 2, NULL, '', '', 'mp4upload*/-)917315^AniMaSTerSerViCE!8419zLwMstreamtape*/-)917315^AniMaSTerSerViCE!8419zLwM4shared*/-)917315^AniMaSTerSerViCE!8419zLwM', '<IFRAME SRC=\"https://www.mp4upload.com/embed-ulaamlms54r4.html\" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=640 HEIGHT=360 allowfullscreen></IFRAME>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe src=\"https://streamtape.com/e/3BKxmQ8LDvidZwl/\" width=\"800\" height=\"600\" allowfullscreen allowtransparency allow=\"autoplay\" scrolling=\"no\" frameborder=\"0\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe src=\"https://www.4shared.com/web/embed/file/G13BpZAEea\" frameborder=\"0\" scrolling=\"no\" width=\"470\" height=\"320\" allowfullscreen=\"true\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM', '4shared*/-)917315^AniMaSTerSerViCE!8419zLwMMega*/-)917315^AniMaSTerSerViCE!8419zLwM', 'https://www.4shared.com/video/G13BpZAEea/___.html?*/-)917315^AniMaSTerSerViCE!8419zLwMhttps://mega.nz/file/AtoRmbBb#nY8Bl4lRPGkz4ZKJUttVi8bBFLvqt4mEpzl-Q36LJ-4*/-)917315^AniMaSTerSerViCE!8419zLwM', 'Yes', 'images/posts_images/img_332656531732648.jpg', 'native', 'secret,champer,episode,2', '2020-06-22 13:56:31', '2020-07-03 10:48:42', 34),
(28, 421, 12, 'Secret Champer - Episode 3', 3, NULL, '', '', 'mp4upload*/-)917315^AniMaSTerSerViCE!8419zLwMstreamtape*/-)917315^AniMaSTerSerViCE!8419zLwM', '<IFRAME SRC=\"https://www.mp4upload.com/embed-ulaamlms54r4.html\" FRAMEBORDER=0 MARGINWIDTH=0 MARGINHEIGHT=0 SCROLLING=NO WIDTH=640 HEIGHT=360 allowfullscreen></IFRAME>*/-)917315^AniMaSTerSerViCE!8419zLwM<iframe src=\"https://streamtape.com/e/3BKxmQ8LDvidZwl/\" width=\"800\" height=\"600\" allowfullscreen allowtransparency allow=\"autoplay\" scrolling=\"no\" frameborder=\"0\"></iframe>*/-)917315^AniMaSTerSerViCE!8419zLwM', '', '', 'No', 'images/posts_images/img_873211609178935.jpg', 'native', 'secret,champer,episode,3', '2020-06-22 13:58:02', '2020-07-04 07:43:13', 25);

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE `series` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `seriesname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_src` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`id`, `category_id`, `seriesname`, `image`, `image_src`, `content`, `created_at`, `updated_at`) VALUES
(11, 406, 'Dragon Ball Super', 'images/series_images/simg_499037883971644.jpg', 'native', 'Sometime after the defeat of Majin Buu, peace has returned to Earth. Goku has settled down and works as a farmer to support his family. His family and friends live peaceful lives. However, a new threat appears in the form of the God of Destruction named Beerus, who is considered to be the most terrifying and the second most powerful being in Universe Seven. After awakening from decades of slumber, Beerus tells his Angel assistant and teacher named Whis that he is eager to fight the legendary warrior whom he had seen.', '2020-06-21 01:25:08', '2020-06-21 03:03:07'),
(12, 406, 'Death Note', 'images/series_images/simg_641196267322312.jpg', 'native', 'Manga Storm is a simple but powerful manga reader app that provides a great reading experience together with a lot of useful features. With Manga Storm, you will never want to read your manga using web browser ever again.', '2020-06-21 01:26:11', '2020-07-05 15:36:58'),
(13, 406, 'Captain Tsubasa', 'images/series_images/simg_587370049044151.jpg', 'native', NULL, '2020-06-30 17:47:34', '2020-07-05 15:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sitename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footerabout` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vimo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebookcomments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `localcomments` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facecomcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approvecom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `sitename`, `footerabout`, `facebook`, `twitter`, `youtube`, `vimo`, `facebookcomments`, `localcomments`, `facecomcode`, `favicon`, `approvecom`, `created_at`, `updated_at`) VALUES
(1, 'Animaster', 'Edited ipsum dolor sit amet consectetur adipisicing elit. Itaque ex, non sed vel aliquam, similique enim expedita dolor quis reiciendis beatae obcaecati totam fugiat magni at optio dolorem corrupti sapiente!', NULL, NULL, NULL, NULL, 'No', 'Yes', '<div id=\"fb-root\"></div>\r\n<script async defer crossorigin=\"anonymous\" src=\"https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0&appId=269671461118908&autoLogAppEvents=1\" nonce=\"nlyDXkYH\"></script>AniMasTER4g3t319edoc670a4g84AniMASTer<div class=\"fb-comments bg-white w-100\" data-href=\"http://127.0.0.1:8000\" data-numposts=\"5\" data-width=\"100%\"></div>', 'C:\\Users\\H.Riad\\Desktop\\animaster\\public\\images/favicons/fav_864429904661204.png', 'No', '2020-06-28 11:34:18', '2020-07-05 12:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `block` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `block`, `ip_address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Valentin Waelchi', 'winona.klein@fahey.net', NULL, NULL, NULL, '$2y$10$lgP282ObROiew5t2EF.h4O.iG4pyksJcf0m8eAX0mEDtdPBVSBMT.', NULL, NULL, '2020-07-02 10:43:26'),
(2, 'Ulices Reinger Sr.', 'kayla25@yahoo.com', NULL, NULL, NULL, '$2y$10$ub9mDJSsuEu9SWlbELCH1uGmp5HgxATLj.EgiDTuMSGQdkNd4uvcO', NULL, NULL, '2020-07-02 10:43:26'),
(3, 'Ewell Daniel', 'verona67@anderson.com', NULL, NULL, NULL, '$2y$10$oc4WxHv8go9DKPAyv2khOuZMjJMAonEnzocOqvepr3te5NPtN9zhq', NULL, NULL, '2020-07-02 10:43:26'),
(4, 'Joe Reichel', 'priscilla59@yahoo.com', NULL, NULL, NULL, '$2y$10$dDv/BfB/4WZYbDyQTcz7GeAoLhHRPTUleRvU7w9nwniigMwttPNey', NULL, NULL, '2020-07-02 10:43:26'),
(5, 'Otilia Nicolas', 'lbecker@hotmail.com', NULL, NULL, NULL, '$2y$10$AcqsOrIxqhh4OtvNu7yFoOKEvzGlFpPKyjI75mrRwo2vj7ZCWISZK', NULL, NULL, '2020-07-02 10:43:26'),
(6, 'Vicky Stoltenberg', 'elias73@yahoo.com', NULL, NULL, NULL, '$2y$10$mqkOIN143pZVNuUyY9orcOL6HoG0eaQ42dlPbeU3VZK/1j.AzZff6', NULL, NULL, '2020-07-02 10:43:26'),
(7, 'Mr. Arlo Quitzon', 'aaliyah.crist@yahoo.com', NULL, NULL, NULL, '$2y$10$mSr4v5z4Uov/x2X0AlkLi.ey5zO68OkexpM6hMK4OcO5B8fSNV/ea', NULL, NULL, '2020-07-02 10:43:26'),
(8, 'Fern Hand PhD', 'fay.frieda@raynor.com', NULL, NULL, NULL, '$2y$10$R49mMaVMfxUuHqbrUzv.0ut9GbY0y7aSHrN5OzxYlsXYB4MI482RW', NULL, NULL, '2020-07-02 10:43:26'),
(9, 'Kara Hill', 'vschmeler@gmail.com', NULL, NULL, NULL, '$2y$10$2CSJ/EH8PFXClkORzt68CuLw9ZMeANZAUbHV6Db/0/QemI0sZx1HC', NULL, NULL, '2020-07-02 10:43:26'),
(11, 'Ruben Johnson', 'lyric06@example.org', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qIkP2R0983', '2020-06-17 05:46:32', '2020-07-02 10:43:26'),
(12, 'Josianne Sanford', 'bonita.leannon@example.com', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '09bGdMV1JZ', '2020-06-17 05:46:32', '2020-07-02 10:43:26'),
(13, 'Trevion Dach PhD', 'malika.auer@example.com', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'G6NcgyOjvS', '2020-06-17 05:46:32', '2020-07-02 10:43:26'),
(14, 'Evie VonRueden', 'russel.dolly@example.net', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ZAwKxLaFc5', '2020-06-17 05:46:32', '2020-07-02 10:43:26'),
(15, 'Elody Dietrich', 'yaufderhar@example.com', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '8MFdi0pd4S', '2020-06-17 05:46:32', '2020-07-02 10:43:26'),
(16, 'Bruce Walter DVM', 'ksenger@example.org', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'qps2zZ9SUR', '2020-06-17 05:46:32', '2020-07-02 10:43:26'),
(17, 'Ms. Kyla Dickinson DDS', 'hilpert.luigi@example.org', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'jl2mawVssR', '2020-06-17 05:46:32', '2020-07-02 10:43:26'),
(18, 'Dr. Marcos Nolan IV', 'ledner.abel@example.net', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IANoXZV8EK', '2020-06-17 05:46:33', '2020-07-02 10:43:26'),
(19, 'Aisha Armstrong', 'gabe94@example.net', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'y4TQovRqvT', '2020-06-17 05:46:33', '2020-07-02 10:43:26'),
(20, 'Emmett Howe', 'caterina62@example.com', NULL, NULL, '2020-06-17 05:46:32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'WpAb3Jg0BG', '2020-06-17 05:46:33', '2020-07-02 10:43:26'),
(21, 'Kelton Wiegand PhD', 'cartwright.porter@gmail.com', NULL, NULL, NULL, '$2y$10$F0GdaOuFy.oEn09iw/IOk.pvGMi5e6NZU7PCZ6s0OP/V0XFovTNXO', NULL, NULL, '2020-07-02 10:43:26'),
(22, 'Prof. Palma Johnston', 'elsa.schmeler@yahoo.com', NULL, NULL, NULL, '$2y$10$UFUJe7xRhQ1uknq3xKMrqexHM898W/VdBpT.m5ZmJ3DcLc8KFUEzS', NULL, NULL, '2020-07-02 10:43:26'),
(23, 'Annetta Price', 'herbert.goodwin@gmail.com', NULL, NULL, NULL, '$2y$10$o7.Usrj1.21sh3zKA8JhJ.eCDhaRbhaE1Z5u7O6p5B4NRmbEF/9yC', NULL, NULL, '2020-07-02 10:43:26'),
(24, 'Maegan Ledner', 'wehner.vernice@hotmail.com', NULL, NULL, NULL, '$2y$10$cXfu3U.0sLAcNXVBbgeyqeqX9QS4CLtJLKVJIpu3IdiXZP4kx9lkS', NULL, NULL, '2020-07-02 10:43:26'),
(25, 'Madeline Beier', 'hailee.dare@hintz.com', NULL, NULL, NULL, '$2y$10$85O3jMJ1FzuNDiV.fXsKu.w3ac5/rbNaRcHHqanC9MzmbbIElaEe6', NULL, NULL, '2020-07-02 10:43:26'),
(26, 'Kian O\'Reilly', 'carlos25@collins.com', NULL, NULL, NULL, '$2y$10$zXtrp79brelyMpWPWLolB.MfCHppmaDHFxGfkR1AQOBYP8Vy6OZBu', NULL, NULL, '2020-07-02 10:43:26'),
(27, 'Mr. Trever Ernser IV', 'nella30@yahoo.com', NULL, NULL, NULL, '$2y$10$qAyLReiQIfXkafPSoAmvBulz27mrs63m6MJBapKsEh04KpaSXAHAS', NULL, NULL, '2020-07-02 10:43:26'),
(28, 'Shany Keeling PhD', 'arthur.thompson@yahoo.com', NULL, NULL, NULL, '$2y$10$PdUB.qD36.M9oCoTWewvGun9ISIhoXK.3Lqgr7yOimjPI8i4xvTsS', NULL, NULL, '2020-07-02 10:43:26'),
(29, 'Peter McLaughlin', 'felipa.lubowitz@yahoo.com', NULL, NULL, NULL, '$2y$10$.BgQIqAIJEYDXpWetyzgYe6N1XVtXkQPOGFBiTSduP3a/2UEXIuge', NULL, NULL, '2020-07-02 10:43:26'),
(30, 'Kristin Little', 'mills.daniela@pfannerstill.net', NULL, NULL, NULL, '$2y$10$OjITN7EEp2.hNH7nVOw.wu3ti5IFH7KhLjYd82zMx6cHpAq2QPxdm', NULL, NULL, '2020-07-02 10:43:26'),
(31, 'Adrien Gerhold', 'rahsaan37@example.org', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2IQlVnq57P', '2020-06-17 05:46:50', '2020-07-02 10:43:26'),
(32, 'Ms. Pamela Wyman', 'ondricka.johnson@example.com', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '85cO5hOS0w', '2020-06-17 05:46:50', '2020-07-02 10:43:26'),
(33, 'Pete Koss', 'koepp.carmelo@example.com', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'IiQwRNzTKs', '2020-06-17 05:46:50', '2020-07-02 10:43:26'),
(34, 'Prof. Sage Walsh IV', 'wyman50@example.com', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'uQLVzSHEbo', '2020-06-17 05:46:50', '2020-07-02 10:43:26'),
(35, 'Lyda Huel V', 'fshanahan@example.org', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Nf9Nohtbzn', '2020-06-17 05:46:50', '2020-07-02 10:43:26'),
(36, 'Mr. Waylon Wiza Jr.', 'nruecker@example.com', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'DEMaXpjvXB', '2020-06-17 05:46:50', '2020-07-02 10:43:26'),
(37, 'Sylvester Heidenreich', 'emmie47@example.org', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6uaGIjI6Bz', '2020-06-17 05:46:50', '2020-07-02 10:43:26'),
(38, 'Kenyon Lockman', 'xleuschke@example.net', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'ZFCCTzaFGF', '2020-06-17 05:46:51', '2020-07-02 10:43:26'),
(39, 'Daphne Fadel', 'smann@example.com', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Bp7g0xHd8a', '2020-06-17 05:46:51', '2020-07-02 10:43:26'),
(40, 'Aleen Ortiz', 'dominique80@example.net', NULL, NULL, '2020-06-17 05:46:50', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'FAGHWj1nAQ', '2020-06-17 05:46:51', '2020-07-02 10:43:26'),
(41, 'Ahmed Mohamed', 'yotval2019@gmail.com', NULL, NULL, NULL, '$2y$10$XrWvaqiu2orAYoKIpt3OXu3r32X84sCd7fVypZvRQImHIgf6ZatYS', 'Y99DqPLUSfwGeT4Co2uZIHDMnnJ5GThrYbdZ964Z7EhTKFaD3hIPPyQVIGQn', '2020-06-23 10:48:13', '2020-07-02 10:43:26'),
(42, 'Salim Saeed', 'sabahrashidad@gmail.com', NULL, NULL, NULL, '$2y$10$UAwdrivQWHanE1tZMvH4WuS9dUZsB25mq5c/zMB7NBmXgb2lTrS6W', 'WO5bb5AHiNt4Rn9B0J6u02sho6Tb9TFZJI9I8CyLUzNgtIkPRQUF7QpPM4f9', '2020-06-23 10:55:08', '2020-07-02 10:43:26'),
(43, 'test user', 't@t.com', NULL, '127.0.0.1', NULL, '$2y$10$K/h7Z7vuTARkV9qEutcSM.e3uk.qMSVPcfgSOvSGtZiC4MW6gip.W', NULL, '2020-06-28 15:04:42', '2020-07-02 10:44:02'),
(44, 'Sameh sahrkawy', 'sameh@sameh.com', NULL, '127.0.0.1', NULL, '$2y$10$OSOdSzNXDQGLIwfactShmefHJ30UCjACqVALestoBB.HHEjv/DpA.', NULL, '2020-07-04 09:50:21', '2020-07-04 09:50:21'),
(45, 'new user', 'teko@teko.com', NULL, '127.0.0.1', NULL, '$2y$10$kmA.M7Ihv/tfghX8J/Hlf.0VlyGDRpkbiENc1ZBj9y.Ki.pZYuigS', NULL, '2020-07-05 07:54:50', '2020-07-05 07:54:50'),
(46, 'Salman', 'salman@salman.com', NULL, '124.155.341.585', NULL, 'test', NULL, '2020-07-04 09:50:21', '2020-07-04 09:50:21'),
(47, 'salman', 'salman@test.test', NULL, '124.122.122.111', NULL, 'test', NULL, '2020-07-03 09:50:21', '2020-07-03 09:50:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `blockedips`
--
ALTER TABLE `blockedips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `series`
--
ALTER TABLE `series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blockedips`
--
ALTER TABLE `blockedips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=424;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `series`
--
ALTER TABLE `series`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
