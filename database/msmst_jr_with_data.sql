-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 13, 2021 at 03:14 PM
-- Server version: 5.7.20-log
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msmt`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instructions` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2020_12_25_164116_create_instructions_table', 1),
(5, '2020_12_26_071743_create_stories_table', 1),
(6, '2020_12_26_095156_create_words_table', 1),
(7, '2020_12_28_094746_create_overviews_table', 1),
(8, '2021_01_02_092337_create_trainee_journeys_table', 1),
(9, '2021_01_06_090630_create_trainees_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `overviews`
--

CREATE TABLE `overviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `overviews` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overviews`
--

INSERT INTO `overviews` (`id`, `overviews`, `created_at`, `updated_at`) VALUES
(1, 'For participants, the first four intervention sessions (sessions 1-4) consist of reading short stories displayed on a computer screen and remembering 20 target words embedded within the stories. During each session the participant reads a story that stays on the\r\nscreen for 100 seconds. The target words are capitalised within the story. The participant is instructed to use imagery to assist them in remembering target words. Once the story is read, there is a free recall for the target words. Following the free recall, a contextual cue, and if necessary a categorical cue, is given to facilitate recall for each of the target words. After this is completed, training is provided by the trainer, and the process is repeated with the same story', '2020-12-28 04:21:10', '2020-12-28 04:21:10'),
(2, 'Each of the next four intervention sessions (sessions 5-8) consist of a list of 20 target words displayed on a computer screen. The participant creates a story using all the words. Once the story is written, there is a free recall. Following the free recall, a contextual cue, and if necessary a categorical cue is given to facilitate recall of each of the target words. After this is completed, additional training is provided by the trainer and the process is repeated.', '2020-12-28 04:37:00', '2020-12-28 04:37:00'),
(3, 'Finally, in the last 2 sessions (sessions 9 and 10), the treatment session is focused on the application of the mSMT to everyday life. That is, memory-taxing situations that a given participant would be faced with are utilised during training. Such situations may involve\r\nremembering a list of shopping items, remembering a to-do list or remembering directions to a destination. Regardless, the last 2 session focus on specific situations such that the participant identified early in treatment important to their functional memory.', '2020-12-28 04:37:38', '2020-12-28 04:37:38');

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
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `story` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `story`, `created_at`, `updated_at`) VALUES
(1, 'Mr Jones pulled a fresh APPLE from a tree. This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE. Mr Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER. On Saturdays his mother would KISS him and send him to the MARKET. The goods there reminded him of a PALACE. On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row. One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought. Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER.', '2020-12-27 07:54:27', '2020-12-27 07:54:27'),
(2, 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING. As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN. As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL. He entered a room and saw a KING pig reading a Playboy MAGAZINE. The pig summoned an OFFICER who was peeling a POTATO in the SEA. A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT. Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial.', '2020-12-27 07:55:42', '2020-12-27 07:55:42'),
(3, 'Peter went to a PARTY at the COLLEGE near the LAKE. There he met a girl that was wearing a nice FUR and high-heeled SHOES. Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL. Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY. He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat. One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable. The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely.', '2020-12-27 07:57:00', '2020-12-27 07:57:00'),
(4, 'Cindy was a girl who went to PRISON to visit her FRIEND. While there she kept putting a COIN on the table in effort to buy a STONE. Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE. Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO. Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW. On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME.', '2020-12-27 07:57:54', '2020-12-27 07:57:54');

-- --------------------------------------------------------

--
-- Table structure for table `trainees_backup`
--

CREATE TABLE `trainees_backup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainee_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_pin` int(11) DEFAULT NULL,
  `recall_words` text COLLATE utf8mb4_unicode_ci,
  `ans_contextual_cue` text COLLATE utf8mb4_unicode_ci,
  `ans_categorical_cue` text COLLATE utf8mb4_unicode_ci,
  `dk_contextual_cue` text COLLATE utf8mb4_unicode_ci,
  `dk_categorical_cue` text COLLATE utf8mb4_unicode_ci,
  `correct_ans_contextual_cue` text COLLATE utf8mb4_unicode_ci,
  `correct_ans_categorical_cue` text COLLATE utf8mb4_unicode_ci,
  `incorrect_ans_contextual_cue` text COLLATE utf8mb4_unicode_ci,
  `incorrect_ans_categorical_cue` text COLLATE utf8mb4_unicode_ci,
  `num_correct_ans_contextual_cue` int(11) DEFAULT NULL,
  `num_correct_ans_categorical_cue` int(11) DEFAULT NULL,
  `num_incorrect_ans_contextual_cue` int(11) DEFAULT NULL,
  `num_incorrect_ans_categorical_cue` int(11) DEFAULT NULL,
  `num_dk_contextual_cue` int(11) DEFAULT NULL,
  `num_dk_categorical_cue` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL DEFAULT '20',
  `story` longtext COLLATE utf8mb4_unicode_ci,
  `round` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trainee_journeys`
--

CREATE TABLE `trainee_journeys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_pin` int(11) DEFAULT NULL,
  `trainee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_type` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_number` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainee_journeys`
--

INSERT INTO `trainee_journeys` (`id`, `session_pin`, `trainee_id`, `session_type`, `session_number`, `created_at`, `updated_at`) VALUES
(1, 182981, 'KF-01', 'A', 1, '2021-01-06 03:49:02', '2021-01-06 03:49:02'),
(2, 798308, 'KF-02', 'A', 2, '2021-01-07 03:38:56', '2021-01-07 03:38:56'),
(3, 936650, 'KF-03', 'A', 3, '2021-01-07 03:40:17', '2021-01-07 03:41:35'),
(4, 288325, 'KF-04', 'A', 4, '2021-01-07 03:40:27', '2021-01-07 03:40:27'),
(5, 631677, 'KF07', 'A', 3, '2021-01-08 01:41:36', '2021-01-08 01:41:36'),
(6, 293411, 'KF05', 'A', 1, '2021-01-08 01:42:07', '2021-01-08 01:42:07');

-- --------------------------------------------------------

--
-- Table structure for table `trainee_transactions`
--

CREATE TABLE `trainee_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainee_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_id` int(11) NOT NULL,
  `session_pin` int(11) DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_or_wrong` int(11) DEFAULT NULL,
  `time_taken` int(11) NOT NULL,
  `type` enum('Contextual','Categorical','Recall','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `round` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainee_transactions`
--

INSERT INTO `trainee_transactions` (`id`, `trainee_id`, `story_id`, `session_pin`, `answer`, `correct_or_wrong`, `time_taken`, `type`, `round`, `created_at`, `deleted_at`) VALUES
(1, 'KF05', 1, 293411, '{\"words\":\"Butter coffee\"}', NULL, 12, 'Recall', 1, '2021-01-13 14:07:31', NULL),
(2, 'KF05', 1, 293411, 'APPLE', 1, 8, 'Contextual', 1, '2021-01-13 14:07:50', NULL),
(3, 'KF05', 1, 293411, 'DK', 0, 5, 'Contextual', 1, '2021-01-13 14:07:56', NULL),
(4, 'KF05', 1, 293411, 'BOLOSSOM', 0, 16, 'Categorical', 1, '2021-01-13 14:08:12', NULL),
(5, 'KF05', 1, 293411, 'BUTTER', 1, 9, 'Contextual', 1, '2021-01-13 14:08:22', NULL),
(6, 'KF05', 1, 293411, 'CHAIT', 0, 8, 'Contextual', 1, '2021-01-13 14:08:30', NULL),
(7, 'KF05', 1, 293411, 'CHAIR', 1, 8, 'Categorical', 1, '2021-01-13 14:08:39', NULL),
(8, 'KF05', 1, 293411, 'COFFEE', 1, 6, 'Contextual', 1, '2021-01-13 14:08:46', NULL),
(9, 'KF05', 1, 293411, 'RUBY', 0, 11, 'Contextual', 1, '2021-01-13 14:08:58', NULL),
(10, 'KF05', 1, 293411, 'DIAMON', 0, 11, 'Categorical', 1, '2021-01-13 14:09:09', NULL),
(11, 'KF05', 1, 293411, 'FACTORY', 1, 14, 'Contextual', 1, '2021-01-13 14:09:24', NULL),
(12, 'KF05', 1, 293411, 'FORK', 1, 5, 'Contextual', 1, '2021-01-13 14:09:30', NULL),
(13, 'KF05', 1, 293411, 'HAMMER', 1, 3, 'Contextual', 1, '2021-01-13 14:09:33', NULL),
(14, 'KF05', 1, 293411, 'KISS', 1, 9, 'Contextual', 1, '2021-01-13 14:09:43', NULL),
(15, 'KF05', 1, 293411, 'DJJDJJ', 0, 5, 'Contextual', 1, '2021-01-13 14:09:49', NULL),
(16, 'KF05', 1, 293411, 'MARKET', 1, 6, 'Categorical', 1, '2021-01-13 14:09:56', NULL),
(17, 'KF05', 1, 293411, 'PALACE', 1, 9, 'Contextual', 1, '2021-01-13 14:10:06', NULL),
(18, 'KF05', 1, 293411, 'DK', 0, 11, 'Contextual', 1, '2021-01-13 14:10:18', NULL),
(19, 'KF05', 1, 293411, 'PRIEST', 1, 9, 'Categorical', 1, '2021-01-13 14:10:27', NULL),
(20, 'KF05', 1, 293411, 'SEAT', 1, 6, 'Contextual', 1, '2021-01-13 14:10:34', NULL),
(21, 'KF05', 1, 293411, 'STEAM', 1, 31, 'Contextual', 1, '2021-01-13 14:11:06', NULL),
(22, 'KF05', 1, 293411, 'TICKET', 1, 5, 'Contextual', 1, '2021-01-13 14:11:11', NULL),
(23, 'KF05', 1, 293411, 'WIFE', 1, 8, 'Contextual', 1, '2021-01-13 14:11:19', NULL),
(24, 'KF05', 1, 293411, 'BETDKDI', 0, 7, 'Contextual', 1, '2021-01-13 14:11:27', NULL),
(25, 'KF05', 1, 293411, 'BETRAYAL', 1, 6, 'Categorical', 1, '2021-01-13 14:11:34', NULL),
(26, 'KF05', 1, 293411, 'DISCERTION', 0, 6, 'Contextual', 1, '2021-01-13 14:11:40', NULL),
(27, 'KF05', 1, 293411, 'DESCEETIVE', 0, 10, 'Categorical', 1, '2021-01-13 14:11:51', NULL),
(28, 'KF05', 1, 293411, 'GENDER', 1, 5, 'Contextual', 1, '2021-01-13 14:11:57', NULL),
(29, 'KF05', 1, 293411, '{\"words\":\"Butter coffee\"}', NULL, 12, 'Recall', 1, '2021-01-13 14:14:48', NULL),
(30, 'KF05', 1, 293411, 'APPLE', 1, 5, 'Contextual', 1, '2021-01-13 14:14:55', NULL),
(31, 'KF05', 1, 293411, '{\"words\":\"Butter coffee\"}', NULL, 12, 'Recall', 1, '2021-01-13 14:17:30', NULL),
(32, 'KF05', 1, 293411, '{\"words\":\"Butter coffee\"}', NULL, 12, 'Recall', 1, '2021-01-13 14:20:34', NULL),
(33, 'KF05', 1, 293411, '{\"words\":\"butter coffee food\"}', NULL, 12, 'Recall', 1, '2021-01-13 14:22:23', NULL),
(34, 'KF05', 1, 293411, 'DK', 0, 22, 'Contextual', 1, '2021-01-13 14:23:14', NULL),
(35, 'KF05', 1, 293411, 'APPLE', 1, 11, 'Categorical', 1, '2021-01-13 14:23:27', NULL),
(36, 'KF05', 1, 293411, 'BLOSSOM', 1, 22, 'Contextual', 1, '2021-01-13 14:23:51', NULL),
(37, 'KF05', 1, 293411, 'BUTTER', 1, 57, 'Contextual', 1, '2021-01-13 14:24:50', NULL),
(38, 'KF05', 1, 293411, 'UPPER', 0, 89, 'Contextual', 1, '2021-01-13 14:26:21', NULL),
(39, 'KF05', 1, 293411, 'CHAIR', 1, 36, 'Categorical', 1, '2021-01-13 14:26:59', NULL),
(40, 'KF05', 1, 293411, 'TEA', 0, 8, 'Contextual', 1, '2021-01-13 14:27:07', NULL),
(41, 'KF05', 1, 293411, 'JUICE', 0, 379, 'Categorical', 1, '2021-01-13 14:33:28', NULL),
(42, 'KF05', 1, 293411, 'DIAMON', 0, 9, 'Contextual', 1, '2021-01-13 14:33:39', NULL),
(43, 'KF05', 1, 293411, 'DIAMOND', 1, 8, 'Categorical', 1, '2021-01-13 14:33:48', NULL),
(44, 'KF05', 1, 293411, 'FACTORY', 1, 9, 'Contextual', 1, '2021-01-13 14:33:58', NULL),
(45, 'KF05', 1, 293411, 'FORK', 1, 4, 'Contextual', 1, '2021-01-13 14:34:02', NULL),
(46, 'KF05', 1, 293411, 'HAMMER', 1, 3, 'Contextual', 1, '2021-01-13 14:34:07', NULL),
(47, 'KF05', 1, 293411, 'KISS', 1, 8, 'Contextual', 1, '2021-01-13 14:34:15', NULL),
(48, 'KF05', 1, 293411, 'PLACE', 0, 9, 'Contextual', 1, '2021-01-13 14:34:25', NULL),
(49, 'KF05', 1, 293411, 'MARKET', 1, 4, 'Categorical', 1, '2021-01-13 14:34:30', NULL),
(50, 'KF05', 1, 293411, 'PALACE', 1, 7, 'Contextual', 1, '2021-01-13 14:34:37', NULL),
(51, 'KF05', 1, 293411, 'FATHER', 0, 7, 'Contextual', 1, '2021-01-13 14:34:44', NULL),
(52, 'KF05', 1, 293411, 'PRIEST', 1, 5, 'Categorical', 1, '2021-01-13 14:34:50', NULL),
(53, 'KF05', 1, 293411, 'SEAT', 1, 5, 'Contextual', 1, '2021-01-13 14:34:56', NULL),
(54, 'KF05', 1, 293411, 'STEAM', 1, 6, 'Contextual', 1, '2021-01-13 14:35:02', NULL),
(55, 'KF05', 1, 293411, 'GUEST', 0, 38, 'Contextual', 1, '2021-01-13 14:35:43', NULL),
(56, 'KF05', 1, 293411, 'TICKET', 1, 5, 'Categorical', 1, '2021-01-13 14:35:49', NULL),
(57, 'KF05', 1, 293411, 'WIFE', 1, 4, 'Contextual', 1, '2021-01-13 14:35:54', NULL),
(58, 'KF05', 1, 293411, 'DISCERTION', 0, 8, 'Contextual', 1, '2021-01-13 14:36:02', NULL),
(59, 'KF05', 1, 293411, 'DISCRETION', 0, 9, 'Categorical', 1, '2021-01-13 14:36:12', NULL),
(60, 'KF05', 1, 293411, 'DISCRETION', 1, 7, 'Contextual', 1, '2021-01-13 14:36:20', NULL),
(61, 'KF05', 1, 293411, 'GENDER', 1, 5, 'Contextual', 1, '2021-01-13 14:36:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `speciality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `trainer_id`, `name`, `email`, `email_verified_at`, `password`, `role`, `location`, `address`, `phone_number`, `speciality`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `is_active`) VALUES
(1, NULL, 'Charu Prakash', 'charu@proisc.com', NULL, '$2y$10$z4NMVTSgsAUT4WYUGQPYh..6hDAjNw7wNPRszsan0.B1TLZNZfCPq', NULL, NULL, NULL, NULL, NULL, NULL, '2021-01-06 03:42:13', '2021-01-06 03:42:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE `words` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `story_id` int(11) NOT NULL,
  `word` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contextual_cue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorical_cue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `story_id`, `word`, `contextual_cue`, `question`, `categorical_cue`, `created_at`, `updated_at`) VALUES
(1, 1, 'APPLE', 'Mr. Jones pulled a fresh APPLE from a tree', 'Mr. Jones pulled a fresh APPLE from a tree', 'It is a type of fruit', '2020-12-27 02:45:36', '2020-12-27 02:45:36'),
(2, 1, 'BLOSSOM', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning $$ sitting on a $$ drinking $$', 'Flowers do this in the spring', '2020-12-27 02:46:34', '2020-12-27 02:46:34'),
(3, 1, 'BUTTER', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a $$ drinking $$', 'It is something you can spread on toast', '2020-12-27 02:47:08', '2020-12-27 02:47:08'),
(4, 1, 'CHAIR', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking $$', 'It is a piece of furniture', '2020-12-27 02:48:06', '2020-12-27 02:48:06'),
(5, 1, 'COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'It is a beverage', '2020-12-27 02:48:37', '2020-12-27 02:48:37'),
(6, 1, 'DIAMOND', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a $$ using a pitch $$ and a $$', 'It is a gem', '2020-12-27 02:49:21', '2020-12-27 02:49:21'),
(7, 1, 'FACTORY', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch $$ and a $$', 'A place where things are made', '2020-12-27 02:49:50', '2020-12-27 02:49:50'),
(8, 1, 'FORK', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a $$', 'It is a utensil', '2020-12-27 02:50:26', '2020-12-27 02:50:26'),
(9, 1, 'HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'It is a tool', '2020-12-27 02:50:59', '2020-12-27 02:50:59'),
(10, 1, 'KISS', 'On Saturdays his mother would KISS him and send him to the MARKET', 'On Saturdays his mother would KISS him and send him to the $$', 'It is something couples do', '2020-12-27 02:51:43', '2020-12-27 02:51:43'),
(11, 1, 'MARKET', 'On Saturdays his mother would KISS him and send him to the MARKET', 'On Saturdays his mother would KISS him and send him to the MARKET', 'A place to buy food', '2020-12-27 02:52:15', '2020-12-27 02:52:15'),
(12, 1, 'PALACE', 'The goods there reminded him of a PALACE', 'The goods there reminded him of a PALACE', 'A place where royalty live', '2020-12-27 02:53:11', '2020-12-27 02:53:11'),
(13, 1, 'PRIEST', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'On Sundays he went to church to visit his PRIEST making sure to get a $$ in the first row', 'A clergyman', '2020-12-27 02:53:52', '2020-12-27 02:53:52'),
(14, 1, 'SEAT', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'A place to sit', '2020-12-27 02:54:20', '2020-12-27 02:54:20'),
(15, 1, 'STEAM', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Jones’ father left boarding a STEAM boat with a $$ that his $$ had bought', 'It’s formed when water boils', '2020-12-27 02:55:10', '2020-12-27 02:55:10'),
(16, 1, 'TICKET', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his $$ had bought', 'A piece of paper', '2020-12-27 02:56:15', '2020-12-27 02:56:15'),
(17, 1, 'WIFE', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'A significant other', '2020-12-27 02:56:42', '2020-12-27 02:56:42'),
(18, 1, 'BETRAYAL', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using $$ in their personal lives led him to mistrust members of the opposite $$', 'Type of disloyalty', '2020-12-27 02:57:28', '2020-12-27 02:57:28'),
(19, 1, 'DISCRETION', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite $$', 'being secretive', '2020-12-27 02:58:11', '2020-12-27 02:58:11'),
(20, 1, 'GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'A classification of male or female', '2020-12-27 02:58:41', '2020-12-27 02:58:41'),
(21, 2, 'ANIMAL', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', '', 'Classification of a species', '2020-12-27 03:02:34', '2020-12-27 03:02:34'),
(22, 2, 'BLOOD', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', '', 'Liquid inside a body', '2020-12-27 03:03:16', '2020-12-27 03:03:16'),
(23, 2, 'BUILDING', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', '', 'An architectural structure', '2020-12-27 03:03:58', '2020-12-27 03:03:58'),
(24, 2, 'CELLAR', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', '', 'A floor in a house', '2020-12-27 03:04:49', '2020-12-27 03:04:49'),
(25, 2, 'COAST', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', '', 'Where water meets land', '2020-12-27 03:05:32', '2020-12-27 03:05:32'),
(26, 2, 'DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', '', 'A time of day', '2020-12-27 03:06:08', '2020-12-27 03:06:08'),
(27, 2, 'ENGINE', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', '', 'A part of a car', '2020-12-27 03:06:59', '2020-12-27 03:06:59'),
(28, 2, 'FOREST', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', '', 'Trees grow here', '2020-12-27 03:07:31', '2020-12-27 03:07:31'),
(29, 2, 'HALL', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', '', 'A passageway', '2020-12-27 03:08:17', '2020-12-27 03:08:17'),
(30, 2, 'KING', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', '', 'Royalty', '2020-12-27 03:09:00', '2020-12-27 03:09:00'),
(31, 2, 'MAGAZINE', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', '', 'A publication', '2020-12-27 03:09:33', '2020-12-27 03:09:33'),
(32, 2, 'OFFICER', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', '', 'An occupation', '2020-12-27 03:10:07', '2020-12-27 03:10:07'),
(33, 2, 'POTATO', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', '', 'A vegetable', '2020-12-27 03:10:38', '2020-12-27 03:10:38'),
(34, 2, 'SEA', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', '', 'A body of water', '2020-12-27 03:11:15', '2020-12-27 03:11:15'),
(35, 2, 'STAR', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', '', 'A body in the atmosphere', '2020-12-27 03:11:53', '2020-12-27 03:11:53'),
(36, 2, 'TEMPLE', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', '', 'A religious place', '2020-12-27 03:12:19', '2020-12-27 03:12:19'),
(37, 2, 'WHEAT', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', '', 'It is a crop', '2020-12-27 03:12:49', '2020-12-27 03:12:49'),
(38, 2, 'DISCLOSURE', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', '', 'A revelation', '2020-12-27 03:13:23', '2020-12-27 03:13:23'),
(39, 2, 'BEREAVEMENT', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', '', 'An emotional stage', '2020-12-27 03:13:54', '2020-12-27 03:13:54'),
(40, 2, 'OUTCOME', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', '', 'Results', '2020-12-27 03:14:25', '2020-12-27 03:14:25'),
(41, 3, 'PARTY', 'Peter went to a PARTY at the COLLEGE near the LAKE', '', 'A gathering', '2020-12-27 03:16:57', '2020-12-27 03:16:57'),
(42, 3, 'COLLEGE', 'Peter went to a PARTY at the COLLEGE near the LAKE', '', 'A learning institution', '2020-12-27 03:17:21', '2020-12-27 03:17:21'),
(43, 3, 'LAKE', 'Peter went to a PARTY at the COLLEGE near the LAKE', '', 'A body of water', '2020-12-27 03:17:49', '2020-12-27 03:17:49'),
(44, 3, 'FUR', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', '', 'A material', '2020-12-27 03:18:21', '2020-12-27 03:18:21'),
(45, 3, 'SHOES', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', '', 'Article of clothing', '2020-12-27 03:18:57', '2020-12-27 03:18:57'),
(46, 3, 'WINE', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', '', 'A beverage', '2020-12-27 03:19:44', '2020-12-27 03:19:44'),
(47, 3, 'BODY', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', '', 'Figure', '2020-12-27 03:20:10', '2020-12-27 03:20:10'),
(48, 3, 'CHILD', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', '', 'Type of human', '2020-12-27 03:20:40', '2020-12-27 03:20:40'),
(49, 3, 'DOLL', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', '', 'A child’s toy', '2020-12-27 03:21:07', '2020-12-27 03:21:07'),
(50, 3, 'ELABORATION', 'Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY', '', 'More information', '2020-12-27 03:21:34', '2020-12-27 03:21:34'),
(51, 3, 'ARMY', 'Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY', '', 'Military', '2020-12-27 03:22:00', '2020-12-27 03:22:00'),
(52, 3, 'PRISONER', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', '', 'form of hostage', '2020-12-27 03:22:36', '2020-12-27 03:22:36'),
(53, 3, 'CAMP', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', '', 'A place', '2020-12-27 03:23:06', '2020-12-27 03:23:06'),
(54, 3, 'MEAT', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', '', 'Food product', '2020-12-27 03:23:36', '2020-12-27 03:23:36'),
(55, 3, 'STORM', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', '', 'Weather condition', '2020-12-27 03:24:14', '2020-12-27 03:24:14'),
(56, 3, 'TOWER', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', '', 'An architectural structure', '2020-12-27 03:24:46', '2020-12-27 03:24:46'),
(57, 3, 'HANKERING', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', '', 'Yearning', '2020-12-27 03:25:13', '2020-12-27 03:25:13'),
(58, 3, 'HORSE', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', '', 'A type of animal', '2020-12-27 03:25:43', '2020-12-27 03:25:43'),
(59, 3, 'SUPPRESSION', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', '', 'To keep down', '2020-12-27 03:26:13', '2020-12-27 03:26:13'),
(60, 3, 'FLAG', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', '', 'A symbol', '2020-12-27 03:26:43', '2020-12-27 03:26:43'),
(61, 4, 'PRISON', 'Cindy was a girl who went to PRISON to visit her FRIEND', '', 'An architectural structure', '2020-12-27 03:27:59', '2020-12-27 03:27:59'),
(62, 4, 'FRIEND', 'Cindy was a girl who went to PRISON to visit her FRIEND', '', 'A type of relationship', '2020-12-27 03:28:26', '2020-12-27 03:28:26'),
(63, 4, 'COIN', 'While there she kept putting a COIN on the table in effort to buy a STONE.', '', 'A round object', '2020-12-27 03:28:53', '2020-12-27 03:28:53'),
(64, 4, 'STONE', 'While there she kept putting a COIN on the table in effort to buy a STONE', '', 'A hard material', '2020-12-27 03:29:19', '2020-12-27 03:29:19'),
(65, 4, 'TOBACCO', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', '', 'An agricultural product', '2020-12-27 03:29:51', '2020-12-27 03:29:51'),
(66, 4, 'ARM', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', '', 'A part of the body', '2020-12-27 03:30:23', '2020-12-27 03:30:23'),
(67, 4, 'FIRE', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', '', 'It is hot', '2020-12-27 03:30:51', '2020-12-27 03:30:51'),
(68, 4, 'BLANDNESS', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', '', 'Lacking flavor', '2020-12-27 03:31:18', '2020-12-27 03:31:18'),
(69, 4, 'DOCTOR', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', '', 'A profession', '2020-12-27 03:31:43', '2020-12-27 03:31:43'),
(70, 4, 'REPLACEMENT', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', '', 'Type of change', '2020-12-27 03:32:12', '2020-12-27 03:32:12'),
(71, 4, 'EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', '', 'Self esteem', '2020-12-27 03:32:34', '2020-12-27 03:32:34'),
(72, 4, 'LAD', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', '', 'male', '2020-12-27 03:33:28', '2020-12-27 03:33:28'),
(73, 4, 'CHIEF', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', '', 'A rank', '2020-12-27 03:33:57', '2020-12-27 03:33:57'),
(74, 4, 'BOARD', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', '', 'form of wood', '2020-12-27 03:34:24', '2020-12-27 03:34:24'),
(75, 4, 'SHIP', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', '', 'A form of transportation', '2020-12-27 03:34:51', '2020-12-27 03:34:51'),
(76, 4, 'MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', '', 'A place', '2020-12-27 03:35:24', '2020-12-27 03:35:24'),
(77, 4, 'CABIN', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', '', 'An architectural structure', '2020-12-27 03:35:56', '2020-12-27 03:35:56'),
(78, 4, 'PAPER', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', '', 'A material', '2020-12-27 03:36:21', '2020-12-27 03:36:21'),
(79, 4, 'WINDOWS', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', '', 'Openings', '2020-12-27 03:36:55', '2020-12-27 03:36:55'),
(80, 4, 'HOME', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', '', 'A place', '2020-12-27 03:37:19', '2020-12-27 03:37:52'),
(81, 5, 'BIRD', NULL, '', 'an animal', '2020-12-27 04:34:39', '2020-12-27 04:34:39'),
(82, 5, 'BEAST', NULL, '', 'an animal', '2020-12-27 04:35:48', '2020-12-27 04:35:48'),
(83, 5, 'CUE', NULL, '', 'type of ball / hint', '2020-12-27 04:36:12', '2020-12-27 04:36:12'),
(84, 5, 'CLOTHING', NULL, '', 'something you put on body', '2020-12-27 04:36:31', '2020-12-27 04:36:31'),
(85, 5, 'DAMSEL', NULL, '', 'person/ fish', '2020-12-27 04:36:58', '2020-12-27 04:36:58'),
(86, 5, 'ELEPHANT', NULL, '', 'an animal', '2020-12-27 04:37:24', '2020-12-27 04:37:24'),
(87, 5, 'GRASS', NULL, '', 'something that grows', '2020-12-27 04:37:41', '2020-12-27 04:37:41'),
(88, 5, 'GREEN', NULL, '', 'color', '2020-12-27 04:38:08', '2020-12-27 04:38:08'),
(89, 5, 'JUDGE', NULL, '', 'a profession', '2020-12-27 04:38:30', '2020-12-27 04:38:30'),
(90, 5, 'MACHINE', NULL, '', 'equipment', '2020-12-27 04:38:45', '2020-12-27 04:38:45'),
(91, 5, 'OCEAN', NULL, '', 'body of water', '2020-12-27 04:39:02', '2020-12-27 04:39:02'),
(92, 5, 'POLE', NULL, '', 'a stick', '2020-12-27 04:39:39', '2020-12-27 04:39:39'),
(93, 5, 'ROCK', NULL, '', 'part of nature', '2020-12-27 04:39:54', '2020-12-27 04:39:54'),
(94, 5, 'SQUARE', NULL, '', 'a shape', '2020-12-27 04:40:14', '2020-12-27 04:40:14'),
(95, 5, 'TABLE', NULL, '', 'furniture', '2020-12-27 04:40:29', '2020-12-27 04:40:29'),
(96, 5, 'WATER', NULL, '', 'liquid', '2020-12-27 04:40:43', '2020-12-27 04:40:43'),
(97, 5, 'UNREALITY', NULL, '', 'futility', '2020-12-27 04:40:57', '2020-12-27 04:40:57'),
(98, 5, 'ATROCITY', NULL, '', 'disaster', '2020-12-27 04:41:10', '2020-12-27 04:41:10'),
(99, 5, 'DEDUCTION', NULL, '', 'form of reasoning', '2020-12-27 04:41:34', '2020-12-27 04:41:34'),
(100, 5, 'FORETHOUGHT', NULL, '', 'planning', '2020-12-27 04:41:51', '2020-12-27 04:41:51'),
(101, 6, 'WINTER', NULL, '', 'a season', '2020-12-27 04:47:03', '2020-12-27 04:47:03'),
(102, 6, 'LAWN', NULL, '', 'property', '2020-12-27 04:47:17', '2020-12-27 04:47:17'),
(103, 6, 'STREET', NULL, '', 'roadway', '2020-12-27 04:47:31', '2020-12-27 04:47:31'),
(104, 6, 'SHORE', NULL, '', 'geographic region', '2020-12-27 04:47:47', '2020-12-27 04:47:47'),
(105, 6, 'CHRISTMAS', NULL, '', 'holiday', '2020-12-27 04:47:59', '2020-12-27 04:47:59'),
(106, 6, 'DOLLAR', NULL, '', 'currency', '2020-12-27 04:48:12', '2020-12-27 04:48:12'),
(107, 6, 'ARROW', NULL, '', 'weapon', '2020-12-27 04:48:25', '2020-12-27 04:48:25'),
(108, 6, 'BOOK', NULL, '', 'something you read', '2020-12-27 04:48:45', '2020-12-27 04:48:45'),
(109, 6, 'CANDY', NULL, '', 'food', '2020-12-27 04:49:01', '2020-12-27 04:49:01'),
(110, 6, 'PENCIL', NULL, '', 'something you write with', '2020-12-27 04:49:16', '2020-12-27 04:49:16'),
(111, 6, 'CORD', NULL, '', 'electric conductor/music element', '2020-12-27 04:49:33', '2020-12-27 04:49:33'),
(112, 6, 'FLESH', NULL, '', 'part of body', '2020-12-27 04:49:52', '2020-12-27 04:49:52'),
(113, 6, 'TOY', NULL, '', 'object', '2020-12-27 04:50:06', '2020-12-27 04:50:06'),
(114, 6, 'PROFESSOR', NULL, '', 'profession', '2020-12-27 04:50:22', '2020-12-27 04:50:22'),
(115, 6, 'HOSPITAL', NULL, '', 'a building', '2020-12-27 04:50:35', '2020-12-27 04:50:35'),
(116, 6, 'FURNITURE', NULL, '', 'household item', '2020-12-27 04:50:49', '2020-12-27 04:50:49'),
(117, 6, 'EQUAL', NULL, '', 'sweetener/ mathematics sign', '2020-12-27 04:51:08', '2020-12-27 04:51:08'),
(118, 6, 'STEPS', NULL, '', 'passageway', '2020-12-27 04:51:22', '2020-12-27 04:51:22'),
(119, 6, 'MONEY', NULL, '', 'currency', '2020-12-27 04:51:38', '2020-12-27 04:51:38'),
(120, 6, 'UNBELIEVER', NULL, '', 'skeptic', '2020-12-27 04:53:23', '2020-12-27 04:53:23'),
(121, 7, 'AUTOMOBILE', NULL, '', 'Transportation', '2020-12-27 04:55:51', '2020-12-27 04:55:51'),
(122, 7, 'BOTTLE', NULL, '', 'Container', '2020-12-27 04:56:04', '2020-12-27 04:56:04'),
(123, 7, 'CASH', NULL, '', 'currency', '2020-12-27 04:56:17', '2020-12-27 04:56:17'),
(124, 7, 'CHURCH', NULL, '', 'building', '2020-12-27 04:56:30', '2020-12-27 04:56:30'),
(125, 7, 'CORN', NULL, '', 'vegetable', '2020-12-27 04:56:45', '2020-12-27 04:56:45'),
(126, 7, 'DOOR', NULL, '', 'passageway', '2020-12-27 04:56:58', '2020-12-27 04:56:58'),
(127, 7, 'FLOOD', NULL, '', 'natural disaster', '2020-12-27 04:57:13', '2020-12-27 04:57:13'),
(128, 7, 'GARDEN', NULL, '', 'property', '2020-12-27 04:57:27', '2020-12-27 04:57:27'),
(129, 7, 'HOTEL', NULL, '', 'building', '2020-12-27 04:57:40', '2020-12-27 04:57:40'),
(130, 7, 'LETTER', NULL, '', 'symbol/ correspondence', '2020-12-27 04:57:59', '2020-12-27 04:57:59'),
(131, 7, 'MOTHER', NULL, '', 'person', '2020-12-27 04:58:13', '2020-12-27 04:58:13'),
(132, 7, 'PHYSICIAN', NULL, '', 'a profession', '2020-12-27 04:58:40', '2020-12-27 04:58:40'),
(133, 7, 'PUPIL', NULL, '', 'role/ part of body', '2020-12-27 04:58:57', '2020-12-27 04:58:57'),
(134, 7, 'SKIN', NULL, '', 'part of body', '2020-12-27 04:59:12', '2020-12-27 04:59:12'),
(135, 7, 'STRENGTH', NULL, '', 'characteristic', '2020-12-27 04:59:26', '2020-12-27 04:59:26'),
(136, 7, 'TREE', NULL, '', 'living thing', '2020-12-27 04:59:42', '2020-12-27 04:59:42'),
(137, 7, 'WOMEN', NULL, '', 'people', '2020-12-27 04:59:55', '2020-12-27 04:59:55'),
(138, 7, 'ADAGE', NULL, '', 'saying', '2020-12-27 05:00:12', '2020-12-27 05:00:12'),
(139, 7, 'COMPETENCE', NULL, '', 'quality', '2020-12-27 05:00:27', '2020-12-27 05:00:27'),
(140, 7, 'ESSENCE', NULL, '', 'quality', '2020-12-27 05:00:46', '2020-12-27 05:00:46'),
(141, 8, 'CIRCLE', NULL, '', 'Shape', '2020-12-27 05:02:14', '2020-12-27 05:02:14'),
(142, 8, 'AVENUE', NULL, '', 'roadway', '2020-12-27 05:02:27', '2020-12-27 05:02:27'),
(143, 8, 'BOULDER', NULL, '', 'part of nature', '2020-12-27 05:02:44', '2020-12-27 05:02:44'),
(144, 8, 'GENTLEMAN', NULL, '', 'person', '2020-12-27 05:02:59', '2020-12-27 05:02:59'),
(145, 8, 'CORNER', NULL, '', 'an edge', '2020-12-27 05:03:16', '2020-12-27 05:03:16'),
(146, 8, 'HOUSE', NULL, '', 'building', '2020-12-27 05:03:33', '2020-12-27 05:03:33'),
(147, 8, 'LIBRARY', NULL, '', 'a place', '2020-12-27 05:04:18', '2020-12-27 05:04:18'),
(148, 8, 'QUEEN', NULL, '', 'monarchy', '2020-12-27 05:04:33', '2020-12-27 05:04:33'),
(149, 8, 'DRESS', NULL, '', 'article of clothing/ an action', '2020-12-27 05:28:25', '2020-12-27 05:28:25'),
(150, 8, 'PICTURE', NULL, '', 'object', '2020-12-27 05:28:43', '2020-12-27 05:28:43'),
(151, 8, 'FLOWER', NULL, '', 'something that grows', '2020-12-27 05:29:26', '2020-12-27 05:29:26'),
(152, 8, 'MOUNTAIN', NULL, '', 'part of nature', '2020-12-27 05:29:42', '2020-12-27 05:29:42'),
(153, 8, 'STRING', NULL, '', 'material', '2020-12-27 05:29:59', '2020-12-27 05:29:59'),
(154, 8, 'TROOPS', NULL, '', 'military', '2020-12-27 05:30:14', '2020-12-27 05:30:14'),
(155, 8, 'WOODS', NULL, '', 'nature', '2020-12-27 05:30:28', '2020-12-27 05:30:28'),
(156, 8, 'EXCLUSION', NULL, '', 'omission', '2020-12-27 05:30:40', '2020-12-27 05:30:40'),
(157, 8, 'CONTEXT', NULL, '', 'environment', '2020-12-27 05:30:54', '2020-12-27 05:30:54'),
(158, 8, 'ADVERSITY', NULL, '', 'situation', '2020-12-27 05:31:06', '2020-12-27 05:31:06'),
(159, 8, 'SKY', NULL, '', 'nature', '2020-12-27 05:31:23', '2020-12-27 05:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `words_backup`
--

CREATE TABLE `words_backup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `story_id` int(11) NOT NULL,
  `word` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contextual_cue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorical_cue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `words_backup`
--

INSERT INTO `words_backup` (`id`, `story_id`, `word`, `contextual_cue`, `categorical_cue`, `created_at`, `updated_at`) VALUES
(1, 1, 'APPLE', 'Mr. Jones pulled a fresh APPLE from a tree', 'It is a type of fruit', '2020-12-27 08:15:36', '2020-12-27 08:15:36'),
(2, 1, 'BLOSSOM', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'Flowers do this in the spring', '2020-12-27 08:16:34', '2020-12-27 08:16:34'),
(3, 1, 'BUTTER', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'It is something you can spread on toast', '2020-12-27 08:17:08', '2020-12-27 08:17:08'),
(4, 1, 'CHAIR', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'It is a piece of furniture', '2020-12-27 08:18:06', '2020-12-27 08:18:06'),
(5, 1, 'COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'It is a beverage', '2020-12-27 08:18:37', '2020-12-27 08:18:37'),
(6, 1, 'DIAMOND', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'It is a gem', '2020-12-27 08:19:21', '2020-12-27 08:19:21'),
(7, 1, 'FACTORY', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'A place where things are made', '2020-12-27 08:19:50', '2020-12-27 08:19:50'),
(8, 1, 'FORK', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'It is a utensil', '2020-12-27 08:20:26', '2020-12-27 08:20:26'),
(9, 1, 'HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'It is a tool', '2020-12-27 08:20:59', '2020-12-27 08:20:59'),
(10, 1, 'KISS', 'On Saturdays his mother would KISS him and send him to the MARKET', 'It is something couples do', '2020-12-27 08:21:43', '2020-12-27 08:21:43'),
(11, 1, 'MARKET', 'On Saturdays his mother would KISS him and send him to the MARKET', 'A place to buy food', '2020-12-27 08:22:15', '2020-12-27 08:22:15'),
(12, 1, 'PALACE', 'The goods there reminded him of a PALACE', 'A place where royalty live', '2020-12-27 08:23:11', '2020-12-27 08:23:11'),
(13, 1, 'PRIEST', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'A clergyman', '2020-12-27 08:23:52', '2020-12-27 08:23:52'),
(14, 1, 'SEAT', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'A place to sit', '2020-12-27 08:24:20', '2020-12-27 08:24:20'),
(15, 1, 'STEAM', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'It’s formed when water boils', '2020-12-27 08:25:10', '2020-12-27 08:25:10'),
(16, 1, 'TICKET', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'A piece of paper', '2020-12-27 08:26:15', '2020-12-27 08:26:15'),
(17, 1, 'WIFE', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'A significant other', '2020-12-27 08:26:42', '2020-12-27 08:26:42'),
(18, 1, 'BETRAYAL', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Type of disloyalty', '2020-12-27 08:27:28', '2020-12-27 08:27:28'),
(19, 1, 'DISCRETION', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'being secretive', '2020-12-27 08:28:11', '2020-12-27 08:28:11'),
(20, 1, 'GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'A classification of male or female', '2020-12-27 08:28:41', '2020-12-27 08:28:41'),
(21, 2, 'ANIMAL', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', 'Classification of a species', '2020-12-27 08:32:34', '2020-12-27 08:32:34'),
(22, 2, 'BLOOD', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', 'Liquid inside a body', '2020-12-27 08:33:16', '2020-12-27 08:33:16'),
(23, 2, 'BUILDING', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', 'An architectural structure', '2020-12-27 08:33:58', '2020-12-27 08:33:58'),
(24, 2, 'CELLAR', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'A floor in a house', '2020-12-27 08:34:49', '2020-12-27 08:34:49'),
(25, 2, 'COAST', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'Where water meets land', '2020-12-27 08:35:32', '2020-12-27 08:35:32'),
(26, 2, 'DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'A time of day', '2020-12-27 08:36:08', '2020-12-27 08:36:08'),
(27, 2, 'ENGINE', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', 'A part of a car', '2020-12-27 08:36:59', '2020-12-27 08:36:59'),
(28, 2, 'FOREST', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', 'Trees grow here', '2020-12-27 08:37:31', '2020-12-27 08:37:31'),
(29, 2, 'HALL', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', 'A passageway', '2020-12-27 08:38:17', '2020-12-27 08:38:17'),
(30, 2, 'KING', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', 'Royalty', '2020-12-27 08:39:00', '2020-12-27 08:39:00'),
(31, 2, 'MAGAZINE', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', 'A publication', '2020-12-27 08:39:33', '2020-12-27 08:39:33'),
(32, 2, 'OFFICER', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'An occupation', '2020-12-27 08:40:07', '2020-12-27 08:40:07'),
(33, 2, 'POTATO', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'A vegetable', '2020-12-27 08:40:38', '2020-12-27 08:40:38'),
(34, 2, 'SEA', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'A body of water', '2020-12-27 08:41:15', '2020-12-27 08:41:15'),
(35, 2, 'STAR', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', 'A body in the atmosphere', '2020-12-27 08:41:53', '2020-12-27 08:41:53'),
(36, 2, 'TEMPLE', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', 'A religious place', '2020-12-27 08:42:19', '2020-12-27 08:42:19'),
(37, 2, 'WHEAT', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', 'It is a crop', '2020-12-27 08:42:49', '2020-12-27 08:42:49'),
(38, 2, 'DISCLOSURE', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'A revelation', '2020-12-27 08:43:23', '2020-12-27 08:43:23'),
(39, 2, 'BEREAVEMENT', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'An emotional stage', '2020-12-27 08:43:54', '2020-12-27 08:43:54'),
(40, 2, 'OUTCOME', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Results', '2020-12-27 08:44:25', '2020-12-27 08:44:25'),
(41, 3, 'PARTY', 'Peter went to a PARTY at the COLLEGE near the LAKE', 'A gathering', '2020-12-27 08:46:57', '2020-12-27 08:46:57'),
(42, 3, 'COLLEGE', 'Peter went to a PARTY at the COLLEGE near the LAKE', 'A learning institution', '2020-12-27 08:47:21', '2020-12-27 08:47:21'),
(43, 3, 'LAKE', 'Peter went to a PARTY at the COLLEGE near the LAKE', 'A body of water', '2020-12-27 08:47:49', '2020-12-27 08:47:49'),
(44, 3, 'FUR', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', 'A material', '2020-12-27 08:48:21', '2020-12-27 08:48:21'),
(45, 3, 'SHOES', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', 'Article of clothing', '2020-12-27 08:48:57', '2020-12-27 08:48:57'),
(46, 3, 'WINE', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'A beverage', '2020-12-27 08:49:44', '2020-12-27 08:49:44'),
(47, 3, 'BODY', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Figure', '2020-12-27 08:50:10', '2020-12-27 08:50:10'),
(48, 3, 'CHILD', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Type of human', '2020-12-27 08:50:40', '2020-12-27 08:50:40'),
(49, 3, 'DOLL', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'A child’s toy', '2020-12-27 08:51:07', '2020-12-27 08:51:07'),
(50, 3, 'ELABORATION', 'Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY', 'More information', '2020-12-27 08:51:34', '2020-12-27 08:51:34'),
(51, 3, 'ARMY', 'Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY', 'Military', '2020-12-27 08:52:00', '2020-12-27 08:52:00'),
(52, 3, 'PRISONER', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'form of hostage', '2020-12-27 08:52:36', '2020-12-27 08:52:36'),
(53, 3, 'CAMP', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'A place', '2020-12-27 08:53:06', '2020-12-27 08:53:06'),
(54, 3, 'MEAT', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'Food product', '2020-12-27 08:53:36', '2020-12-27 08:53:36'),
(55, 3, 'STORM', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'Weather condition', '2020-12-27 08:54:14', '2020-12-27 08:54:14'),
(56, 3, 'TOWER', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'An architectural structure', '2020-12-27 08:54:46', '2020-12-27 08:54:46'),
(57, 3, 'HANKERING', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'Yearning', '2020-12-27 08:55:13', '2020-12-27 08:55:13'),
(58, 3, 'HORSE', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'A type of animal', '2020-12-27 08:55:43', '2020-12-27 08:55:43'),
(59, 3, 'SUPPRESSION', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', 'To keep down', '2020-12-27 08:56:13', '2020-12-27 08:56:13'),
(60, 3, 'FLAG', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', 'A symbol', '2020-12-27 08:56:43', '2020-12-27 08:56:43'),
(61, 4, 'PRISON', 'Cindy was a girl who went to PRISON to visit her FRIEND', 'An architectural structure', '2020-12-27 08:57:59', '2020-12-27 08:57:59'),
(62, 4, 'FRIEND', 'Cindy was a girl who went to PRISON to visit her FRIEND', 'A type of relationship', '2020-12-27 08:58:26', '2020-12-27 08:58:26'),
(63, 4, 'COIN', 'While there she kept putting a COIN on the table in effort to buy a STONE.', 'A round object', '2020-12-27 08:58:53', '2020-12-27 08:58:53'),
(64, 4, 'STONE', 'While there she kept putting a COIN on the table in effort to buy a STONE', 'A hard material', '2020-12-27 08:59:19', '2020-12-27 08:59:19'),
(65, 4, 'TOBACCO', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'An agricultural product', '2020-12-27 08:59:51', '2020-12-27 08:59:51'),
(66, 4, 'ARM', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'A part of the body', '2020-12-27 09:00:23', '2020-12-27 09:00:23'),
(67, 4, 'FIRE', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'It is hot', '2020-12-27 09:00:51', '2020-12-27 09:00:51'),
(68, 4, 'BLANDNESS', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Lacking flavor', '2020-12-27 09:01:18', '2020-12-27 09:01:18'),
(69, 4, 'DOCTOR', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'A profession', '2020-12-27 09:01:43', '2020-12-27 09:01:43'),
(70, 4, 'REPLACEMENT', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Type of change', '2020-12-27 09:02:12', '2020-12-27 09:02:12'),
(71, 4, 'EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Self esteem', '2020-12-27 09:02:34', '2020-12-27 09:02:34'),
(72, 4, 'LAD', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'male', '2020-12-27 09:03:28', '2020-12-27 09:03:28'),
(73, 4, 'CHIEF', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'A rank', '2020-12-27 09:03:57', '2020-12-27 09:03:57'),
(74, 4, 'BOARD', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'form of wood', '2020-12-27 09:04:24', '2020-12-27 09:04:24'),
(75, 4, 'SHIP', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'A form of transportation', '2020-12-27 09:04:51', '2020-12-27 09:04:51'),
(76, 4, 'MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'A place', '2020-12-27 09:05:24', '2020-12-27 09:05:24'),
(77, 4, 'CABIN', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'An architectural structure', '2020-12-27 09:05:56', '2020-12-27 09:05:56'),
(78, 4, 'PAPER', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'A material', '2020-12-27 09:06:21', '2020-12-27 09:06:21'),
(79, 4, 'WINDOWS', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'Openings', '2020-12-27 09:06:55', '2020-12-27 09:06:55'),
(80, 4, 'HOME', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'A place', '2020-12-27 09:07:19', '2020-12-27 09:07:52'),
(81, 0, 'BIRD', NULL, 'an animal', '2020-12-27 10:04:39', '2020-12-27 10:04:39'),
(82, 0, 'BEAST', NULL, 'an animal', '2020-12-27 10:05:48', '2020-12-27 10:05:48'),
(83, 0, 'CUE', NULL, 'type of ball / hint', '2020-12-27 10:06:12', '2020-12-27 10:06:12'),
(84, 0, 'CLOTHING', NULL, 'something you put on body', '2020-12-27 10:06:31', '2020-12-27 10:06:31'),
(85, 0, 'DAMSEL', NULL, 'person/ fish', '2020-12-27 10:06:58', '2020-12-27 10:06:58'),
(86, 0, 'ELEPHANT', NULL, 'an animal', '2020-12-27 10:07:24', '2020-12-27 10:07:24'),
(87, 0, 'GRASS', NULL, 'something that grows', '2020-12-27 10:07:41', '2020-12-27 10:07:41'),
(88, 0, 'GREEN', NULL, 'color', '2020-12-27 10:08:08', '2020-12-27 10:08:08'),
(89, 0, 'JUDGE', NULL, 'a profession', '2020-12-27 10:08:30', '2020-12-27 10:08:30'),
(90, 0, 'MACHINE', NULL, 'equipment', '2020-12-27 10:08:45', '2020-12-27 10:08:45'),
(91, 0, 'OCEAN', NULL, 'body of water', '2020-12-27 10:09:02', '2020-12-27 10:09:02'),
(92, 0, 'POLE', NULL, 'a stick', '2020-12-27 10:09:39', '2020-12-27 10:09:39'),
(93, 0, 'ROCK', NULL, 'part of nature', '2020-12-27 10:09:54', '2020-12-27 10:09:54'),
(94, 0, 'SQUARE', NULL, 'a shape', '2020-12-27 10:10:14', '2020-12-27 10:10:14'),
(95, 0, 'TABLE', NULL, 'furniture', '2020-12-27 10:10:29', '2020-12-27 10:10:29'),
(96, 0, 'WATER', NULL, 'liquid', '2020-12-27 10:10:43', '2020-12-27 10:10:43'),
(97, 0, 'UNREALITY', NULL, 'futility', '2020-12-27 10:10:57', '2020-12-27 10:10:57'),
(98, 0, 'ATROCITY', NULL, 'disaster', '2020-12-27 10:11:10', '2020-12-27 10:11:10'),
(99, 0, 'DEDUCTION', NULL, 'form of reasoning', '2020-12-27 10:11:34', '2020-12-27 10:11:34'),
(100, 0, 'FORETHOUGHT', NULL, 'planning', '2020-12-27 10:11:51', '2020-12-27 10:11:51'),
(101, 0, 'WINTER', NULL, 'a season', '2020-12-27 10:17:03', '2020-12-27 10:17:03'),
(102, 0, 'LAWN', NULL, 'property', '2020-12-27 10:17:17', '2020-12-27 10:17:17'),
(103, 0, 'STREET', NULL, 'roadway', '2020-12-27 10:17:31', '2020-12-27 10:17:31'),
(104, 0, 'SHORE', NULL, 'geographic region', '2020-12-27 10:17:47', '2020-12-27 10:17:47'),
(105, 0, 'CHRISTMAS', NULL, 'holiday', '2020-12-27 10:17:59', '2020-12-27 10:17:59'),
(106, 0, 'DOLLAR', NULL, 'currency', '2020-12-27 10:18:12', '2020-12-27 10:18:12'),
(107, 0, 'ARROW', NULL, 'weapon', '2020-12-27 10:18:25', '2020-12-27 10:18:25'),
(108, 0, 'BOOK', NULL, 'something you read', '2020-12-27 10:18:45', '2020-12-27 10:18:45'),
(109, 0, 'CANDY', NULL, 'food', '2020-12-27 10:19:01', '2020-12-27 10:19:01'),
(110, 0, 'PENCIL', NULL, 'something you write with', '2020-12-27 10:19:16', '2020-12-27 10:19:16'),
(111, 0, 'CORD', NULL, 'electric conductor/music element', '2020-12-27 10:19:33', '2020-12-27 10:19:33'),
(112, 0, 'FLESH', NULL, 'part of body', '2020-12-27 10:19:52', '2020-12-27 10:19:52'),
(113, 0, 'TOY', NULL, 'object', '2020-12-27 10:20:06', '2020-12-27 10:20:06'),
(114, 0, 'PROFESSOR', NULL, 'profession', '2020-12-27 10:20:22', '2020-12-27 10:20:22'),
(115, 0, 'HOSPITAL', NULL, 'a building', '2020-12-27 10:20:35', '2020-12-27 10:20:35'),
(116, 0, 'FURNITURE', NULL, 'household item', '2020-12-27 10:20:49', '2020-12-27 10:20:49'),
(117, 0, 'EQUAL', NULL, 'sweetener/ mathematics sign', '2020-12-27 10:21:08', '2020-12-27 10:21:08'),
(118, 0, 'STEPS', NULL, 'passageway', '2020-12-27 10:21:22', '2020-12-27 10:21:22'),
(119, 0, 'MONEY', NULL, 'currency', '2020-12-27 10:21:38', '2020-12-27 10:21:38'),
(120, 0, 'UNBELIEVER', NULL, 'skeptic', '2020-12-27 10:23:23', '2020-12-27 10:23:23'),
(121, 0, 'AUTOMOBILE', NULL, 'Transportation', '2020-12-27 10:25:51', '2020-12-27 10:25:51'),
(122, 0, 'BOTTLE', NULL, 'Container', '2020-12-27 10:26:04', '2020-12-27 10:26:04'),
(123, 0, 'CASH', NULL, 'currency', '2020-12-27 10:26:17', '2020-12-27 10:26:17'),
(124, 0, 'CHURCH', NULL, 'building', '2020-12-27 10:26:30', '2020-12-27 10:26:30'),
(125, 0, 'CORN', NULL, 'vegetable', '2020-12-27 10:26:45', '2020-12-27 10:26:45'),
(126, 0, 'DOOR', NULL, 'passageway', '2020-12-27 10:26:58', '2020-12-27 10:26:58'),
(127, 0, 'FLOOD', NULL, 'natural disaster', '2020-12-27 10:27:13', '2020-12-27 10:27:13'),
(128, 0, 'GARDEN', NULL, 'property', '2020-12-27 10:27:27', '2020-12-27 10:27:27'),
(129, 0, 'HOTEL', NULL, 'building', '2020-12-27 10:27:40', '2020-12-27 10:27:40'),
(130, 0, 'LETTER', NULL, 'symbol/ correspondence', '2020-12-27 10:27:59', '2020-12-27 10:27:59'),
(131, 0, 'MOTHER', NULL, 'person', '2020-12-27 10:28:13', '2020-12-27 10:28:13'),
(132, 0, 'PHYSICIAN', NULL, 'a profession', '2020-12-27 10:28:40', '2020-12-27 10:28:40'),
(133, 0, 'PUPIL', NULL, 'role/ part of body', '2020-12-27 10:28:57', '2020-12-27 10:28:57'),
(134, 0, 'SKIN', NULL, 'part of body', '2020-12-27 10:29:12', '2020-12-27 10:29:12'),
(135, 0, 'STRENGTH', NULL, 'characteristic', '2020-12-27 10:29:26', '2020-12-27 10:29:26'),
(136, 0, 'TREE', NULL, 'living thing', '2020-12-27 10:29:42', '2020-12-27 10:29:42'),
(137, 0, 'WOMEN', NULL, 'people', '2020-12-27 10:29:55', '2020-12-27 10:29:55'),
(138, 0, 'ADAGE', NULL, 'saying', '2020-12-27 10:30:12', '2020-12-27 10:30:12'),
(139, 0, 'COMPETENCE', NULL, 'quality', '2020-12-27 10:30:27', '2020-12-27 10:30:27'),
(140, 0, 'ESSENCE', NULL, 'quality', '2020-12-27 10:30:46', '2020-12-27 10:30:46'),
(141, 0, 'CIRCLE', NULL, 'Shape', '2020-12-27 10:32:14', '2020-12-27 10:32:14'),
(142, 0, 'AVENUE', NULL, 'roadway', '2020-12-27 10:32:27', '2020-12-27 10:32:27'),
(143, 0, 'BOULDER', NULL, 'part of nature', '2020-12-27 10:32:44', '2020-12-27 10:32:44'),
(144, 0, 'GENTLEMAN', NULL, 'person', '2020-12-27 10:32:59', '2020-12-27 10:32:59'),
(145, 0, 'CORNER', NULL, 'an edge', '2020-12-27 10:33:16', '2020-12-27 10:33:16'),
(146, 0, 'HOUSE', NULL, 'building', '2020-12-27 10:33:33', '2020-12-27 10:33:33'),
(147, 0, 'LIBRARY', NULL, 'a place', '2020-12-27 10:34:18', '2020-12-27 10:34:18'),
(148, 0, 'QUEEN', NULL, 'monarchy', '2020-12-27 10:34:33', '2020-12-27 10:34:33'),
(149, 0, 'DRESS', NULL, 'article of clothing/ an action', '2020-12-27 10:58:25', '2020-12-27 10:58:25'),
(150, 0, 'PICTURE', NULL, 'object', '2020-12-27 10:58:43', '2020-12-27 10:58:43'),
(151, 0, 'FLOWER', NULL, 'something that grows', '2020-12-27 10:59:26', '2020-12-27 10:59:26'),
(152, 0, 'MOUNTAIN', NULL, 'part of nature', '2020-12-27 10:59:42', '2020-12-27 10:59:42'),
(153, 0, 'STRING', NULL, 'material', '2020-12-27 10:59:59', '2020-12-27 10:59:59'),
(154, 0, 'TROOPS', NULL, 'military', '2020-12-27 11:00:14', '2020-12-27 11:00:14'),
(155, 0, 'WOODS', NULL, 'nature', '2020-12-27 11:00:28', '2020-12-27 11:00:28'),
(156, 0, 'EXCLUSION', NULL, 'omission', '2020-12-27 11:00:40', '2020-12-27 11:00:40'),
(157, 0, 'CONTEXT', NULL, 'environment', '2020-12-27 11:00:54', '2020-12-27 11:00:54'),
(158, 0, 'ADVERSITY', NULL, 'situation', '2020-12-27 11:01:06', '2020-12-27 11:01:06'),
(159, 0, 'SKY', NULL, 'nature', '2020-12-27 11:01:23', '2020-12-27 11:01:23');

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
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overviews`
--
ALTER TABLE `overviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainees_backup`
--
ALTER TABLE `trainees_backup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainee_journeys`
--
ALTER TABLE `trainee_journeys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainee_transactions`
--
ALTER TABLE `trainee_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_trainer_id_unique` (`trainer_id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `words_words_unique` (`word`);

--
-- Indexes for table `words_backup`
--
ALTER TABLE `words_backup`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `words_words_unique` (`word`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `overviews`
--
ALTER TABLE `overviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trainees_backup`
--
ALTER TABLE `trainees_backup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trainee_journeys`
--
ALTER TABLE `trainee_journeys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `trainee_transactions`
--
ALTER TABLE `trainee_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `words_backup`
--
ALTER TABLE `words_backup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
