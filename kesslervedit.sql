-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 21, 2022 at 01:38 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kesslerv0`
--

-- --------------------------------------------------------

--
-- Table structure for table `boosters`
--

CREATE TABLE `boosters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boosters`
--

INSERT INTO `boosters` (`id`, `category`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Directions', '2021-02-19 08:42:41', '2021-02-19 08:42:41', NULL),
(2, 'Shopping', '2021-02-19 08:42:50', '2021-02-19 08:44:01', NULL),
(3, 'To Do', '2021-02-19 08:42:56', '2021-02-19 08:42:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Story', NULL, NULL, NULL),
(2, 'Contextual', NULL, NULL, NULL),
(3, 'General', NULL, NULL, NULL),
(4, 'Booster', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contextuals`
--

CREATE TABLE `contextuals` (
  `id` bigint(20) NOT NULL,
  `story_id` int(11) NOT NULL,
  `word` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contextual_cue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorical_cue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `words` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('directions','shopping','to do') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contextuals`
--

INSERT INTO `contextuals` (`id`, `story_id`, `word`, `contextual_cue`, `question`, `categorical_cue`, `words`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'BIRD', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:34:39', '2020-12-26 23:34:39', NULL),
(2, 1, 'BEAST', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:35:48', '2020-12-26 23:35:48', NULL),
(3, 1, 'CUE', NULL, NULL, 'type of ball / hint', '', NULL, '2020-12-26 23:36:12', '2020-12-26 23:36:12', NULL),
(4, 1, 'CLOTHING', NULL, NULL, 'something you put on body', '', NULL, '2020-12-26 23:36:31', '2020-12-26 23:36:31', NULL),
(5, 1, 'DAMSEL', NULL, NULL, 'person/ fish', '', NULL, '2020-12-26 23:36:58', '2020-12-26 23:36:58', NULL),
(6, 1, 'ELEPHANT', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:37:24', '2020-12-26 23:37:24', NULL),
(7, 1, 'GRASS', NULL, NULL, 'something that grows', '', NULL, '2020-12-26 23:37:41', '2020-12-26 23:37:41', NULL),
(8, 1, 'GREEN', NULL, NULL, 'color', '', NULL, '2020-12-26 23:38:08', '2020-12-26 23:38:08', NULL),
(9, 1, 'JUDGE', NULL, NULL, 'a profession', '', NULL, '2020-12-26 23:38:30', '2020-12-26 23:38:30', NULL),
(10, 1, 'MACHINE', NULL, NULL, 'equipment', '', NULL, '2020-12-26 23:38:45', '2020-12-26 23:38:45', NULL),
(11, 1, 'OCEAN', NULL, NULL, 'body of water', '', NULL, '2020-12-26 23:39:02', '2020-12-26 23:39:02', NULL),
(12, 1, 'POLE', NULL, NULL, 'a stick', '', NULL, '2020-12-26 23:39:39', '2020-12-26 23:39:39', NULL),
(13, 1, 'ROCK', NULL, NULL, 'part of nature', '', NULL, '2020-12-26 23:39:54', '2020-12-26 23:39:54', NULL),
(14, 1, 'SQUARE', NULL, NULL, 'a shape', '', NULL, '2020-12-26 23:40:14', '2020-12-26 23:40:14', NULL),
(15, 1, 'TABLE', NULL, NULL, 'furniture', '', NULL, '2020-12-26 23:40:29', '2020-12-26 23:40:29', NULL),
(16, 1, 'WATER', NULL, NULL, 'liquid', '', NULL, '2020-12-26 23:40:43', '2020-12-26 23:40:43', NULL),
(17, 1, 'UNREALITY', NULL, NULL, 'futility', '', NULL, '2020-12-26 23:40:57', '2020-12-26 23:40:57', NULL),
(18, 1, 'ATROCITY', NULL, NULL, 'disaster', '', NULL, '2020-12-26 23:41:10', '2020-12-26 23:41:10', NULL),
(19, 1, 'DEDUCTION', NULL, NULL, 'form of reasoning', '', NULL, '2020-12-26 23:41:34', '2020-12-26 23:41:34', NULL),
(20, 1, 'FORETHOUGHT', NULL, NULL, 'planning', '', NULL, '2020-12-26 23:41:51', '2020-12-26 23:41:51', NULL),
(21, 2, 'WINTER', NULL, NULL, 'a season', '', NULL, '2020-12-26 23:47:03', '2020-12-26 23:47:03', NULL),
(22, 2, 'LAWN', NULL, NULL, 'property', '', NULL, '2020-12-26 23:47:17', '2020-12-26 23:47:17', NULL),
(23, 2, 'STREET', NULL, NULL, 'roadway', '', NULL, '2020-12-26 23:47:31', '2020-12-26 23:47:31', NULL),
(24, 2, 'SHORE', NULL, NULL, 'geographic region', '', NULL, '2020-12-26 23:47:47', '2020-12-26 23:47:47', NULL),
(25, 2, 'CHRISTMAS', NULL, NULL, 'holiday', '', NULL, '2020-12-26 23:47:59', '2020-12-26 23:47:59', NULL),
(26, 2, 'DOLLAR', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:48:12', '2020-12-26 23:48:12', NULL),
(27, 2, 'ARROW', NULL, NULL, 'weapon', '', NULL, '2020-12-26 23:48:25', '2020-12-26 23:48:25', NULL),
(28, 2, 'BOOK', NULL, NULL, 'something you read', '', NULL, '2020-12-26 23:48:45', '2020-12-26 23:48:45', NULL),
(29, 2, 'CANDY', NULL, NULL, 'food', '', NULL, '2020-12-26 23:49:01', '2020-12-26 23:49:01', NULL),
(30, 2, 'PENCIL', NULL, NULL, 'something you write with', '', NULL, '2020-12-26 23:49:16', '2020-12-26 23:49:16', NULL),
(31, 2, 'CORD', NULL, NULL, 'electric conductor/music element', '', NULL, '2020-12-26 23:49:33', '2020-12-26 23:49:33', NULL),
(32, 2, 'FLESH', NULL, NULL, 'part of body', '', NULL, '2020-12-26 23:49:52', '2020-12-26 23:49:52', NULL),
(33, 2, 'TOY', NULL, NULL, 'object', '', NULL, '2020-12-26 23:50:06', '2020-12-26 23:50:06', NULL),
(34, 2, 'PROFESSOR', NULL, NULL, 'profession', '', NULL, '2020-12-26 23:50:22', '2020-12-26 23:50:22', NULL),
(35, 2, 'HOSPITAL', NULL, NULL, 'a building', '', NULL, '2020-12-26 23:50:35', '2020-12-26 23:50:35', NULL),
(36, 2, 'FURNITURE', NULL, NULL, 'household item', '', NULL, '2020-12-26 23:50:49', '2020-12-26 23:50:49', NULL),
(37, 2, 'EQUAL', NULL, NULL, 'sweetener/ mathematics sign', '', NULL, '2020-12-26 23:51:08', '2020-12-26 23:51:08', NULL),
(38, 2, 'STEPS', NULL, NULL, 'passageway', '', NULL, '2020-12-26 23:51:22', '2020-12-26 23:51:22', NULL),
(39, 2, 'MONEY', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:51:38', '2020-12-26 23:51:38', NULL),
(40, 2, 'UNBELIEVER', NULL, NULL, 'skeptic', '', NULL, '2020-12-26 23:53:23', '2020-12-26 23:53:23', NULL),
(41, 3, 'AUTOMOBILE', NULL, NULL, 'Transportation', '', NULL, '2020-12-26 23:55:51', '2020-12-26 23:55:51', NULL),
(42, 3, 'BOTTLE', NULL, NULL, 'Container', '', NULL, '2020-12-26 23:56:04', '2020-12-26 23:56:04', NULL),
(43, 3, 'CASH', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:56:17', '2020-12-26 23:56:17', NULL),
(44, 3, 'CHURCH', NULL, NULL, 'building', '', NULL, '2020-12-26 23:56:30', '2020-12-26 23:56:30', NULL),
(45, 3, 'CORN', NULL, NULL, 'vegetable', '', NULL, '2020-12-26 23:56:45', '2020-12-26 23:56:45', NULL),
(46, 3, 'DOOR', NULL, NULL, 'passageway', '', NULL, '2020-12-26 23:56:58', '2020-12-26 23:56:58', NULL),
(47, 3, 'FLOOD', NULL, NULL, 'natural disaster', '', NULL, '2020-12-26 23:57:13', '2020-12-26 23:57:13', NULL),
(48, 3, 'GARDEN', NULL, NULL, 'property', '', NULL, '2020-12-26 23:57:27', '2020-12-26 23:57:27', NULL),
(49, 3, 'HOTEL', NULL, NULL, 'building', '', NULL, '2020-12-26 23:57:40', '2020-12-26 23:57:40', NULL),
(50, 3, 'LETTER', NULL, NULL, 'symbol/ correspondence', '', NULL, '2020-12-26 23:57:59', '2020-12-26 23:57:59', NULL),
(51, 3, 'MOTHER', NULL, NULL, 'person', '', NULL, '2020-12-26 23:58:13', '2020-12-26 23:58:13', NULL),
(52, 3, 'PHYSICIAN', NULL, NULL, 'a profession', '', NULL, '2020-12-26 23:58:40', '2020-12-26 23:58:40', NULL),
(53, 3, 'PUPIL', NULL, NULL, 'role/ part of body', '', NULL, '2020-12-26 23:58:57', '2020-12-26 23:58:57', NULL),
(54, 3, 'SKIN', NULL, NULL, 'part of body', '', NULL, '2020-12-26 23:59:12', '2020-12-26 23:59:12', NULL),
(55, 3, 'STRENGTH', NULL, NULL, 'characteristic', '', NULL, '2020-12-26 23:59:26', '2020-12-26 23:59:26', NULL),
(56, 3, 'TREE', NULL, NULL, 'living thing', '', NULL, '2020-12-26 23:59:42', '2020-12-26 23:59:42', NULL),
(57, 3, 'WOMEN', NULL, NULL, 'people', '', NULL, '2020-12-26 23:59:55', '2020-12-26 23:59:55', NULL),
(58, 3, 'ADAGE', NULL, NULL, 'saying', '', NULL, '2020-12-27 00:00:12', '2020-12-27 00:00:12', NULL),
(59, 3, 'COMPETENCE', NULL, NULL, 'quality', '', NULL, '2020-12-27 00:00:27', '2020-12-27 00:00:27', NULL),
(60, 3, 'ESSENCE', NULL, NULL, 'quality', '', NULL, '2020-12-27 00:00:46', '2020-12-27 00:00:46', NULL),
(61, 4, 'CIRCLE', NULL, NULL, 'Shape', '', NULL, '2020-12-27 00:02:14', '2020-12-27 00:02:14', NULL),
(62, 4, 'AVENUE', NULL, NULL, 'roadway', '', NULL, '2020-12-27 00:02:27', '2020-12-27 00:02:27', NULL),
(63, 4, 'BOULDER', NULL, NULL, 'part of nature', '', NULL, '2020-12-27 00:02:44', '2020-12-27 00:02:44', NULL),
(64, 4, 'GENTLEMAN', NULL, NULL, 'person', '', NULL, '2020-12-27 00:02:59', '2020-12-27 00:02:59', NULL),
(65, 4, 'CORNER', NULL, NULL, 'an edge', '', NULL, '2020-12-27 00:03:16', '2020-12-27 00:03:16', NULL),
(66, 4, 'HOUSE', NULL, NULL, 'building', '', NULL, '2020-12-27 00:03:33', '2020-12-27 00:03:33', NULL),
(67, 4, 'LIBRARY', NULL, NULL, 'a place', '', NULL, '2020-12-27 00:04:18', '2020-12-27 00:04:18', NULL),
(68, 4, 'QUEEN', NULL, NULL, 'monarchy', '', NULL, '2020-12-27 00:04:33', '2020-12-27 00:04:33', NULL),
(69, 4, 'DRESS', NULL, NULL, 'article of clothing/ an action', '', NULL, '2020-12-27 00:28:25', '2020-12-27 00:28:25', NULL),
(70, 4, 'PICTURE', NULL, NULL, 'object', '', NULL, '2020-12-27 00:28:43', '2020-12-27 00:28:43', NULL),
(71, 4, 'FLOWER', NULL, NULL, 'something that grows', '', NULL, '2020-12-27 00:29:26', '2020-12-27 00:29:26', NULL),
(72, 4, 'MOUNTAIN', NULL, NULL, 'part of nature', '', NULL, '2020-12-27 00:29:42', '2020-12-27 00:29:42', NULL),
(73, 4, 'STRING', NULL, NULL, 'material', '', NULL, '2020-12-27 00:29:59', '2020-12-27 00:29:59', NULL),
(74, 4, 'TROOPS', NULL, NULL, 'military', '', NULL, '2020-12-27 00:30:14', '2020-12-27 00:30:14', NULL),
(75, 4, 'WOODS', NULL, NULL, 'nature', '', NULL, '2020-12-27 00:30:28', '2020-12-27 00:30:28', NULL),
(76, 4, 'EXCLUSION', NULL, NULL, 'omission', '', NULL, '2020-12-27 00:30:40', '2020-12-27 00:30:40', NULL),
(77, 4, 'CONTEXT', NULL, NULL, 'environment', '', NULL, '2020-12-27 00:30:54', '2020-12-27 00:30:54', NULL),
(78, 4, 'ADVERSITY', NULL, NULL, 'situation', '', NULL, '2020-12-27 00:31:06', '2020-12-27 00:31:06', NULL),
(79, 4, 'SKY', NULL, NULL, 'nature', '', NULL, '2020-12-27 00:31:23', '2020-12-27 00:31:23', NULL),
(80, 5, 'BIRD', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:34:39', '2020-12-26 23:34:39', NULL),
(81, 5, 'BEAST', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:35:48', '2020-12-26 23:35:48', NULL),
(82, 5, 'CUE', NULL, NULL, 'type of ball / hint', '', NULL, '2020-12-26 23:36:12', '2020-12-26 23:36:12', NULL),
(83, 5, 'CLOTHING', NULL, NULL, 'something you put on body', '', NULL, '2020-12-26 23:36:31', '2020-12-26 23:36:31', NULL),
(84, 5, 'DAMSEL', NULL, NULL, 'person/ fish', '', NULL, '2020-12-26 23:36:58', '2020-12-26 23:36:58', NULL),
(85, 5, 'ELEPHANT', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:37:24', '2020-12-26 23:37:24', NULL),
(86, 5, 'GRASS', NULL, NULL, 'something that grows', '', NULL, '2020-12-26 23:37:41', '2020-12-26 23:37:41', NULL),
(87, 5, 'GREEN', NULL, NULL, 'color', '', NULL, '2020-12-26 23:38:08', '2020-12-26 23:38:08', NULL),
(88, 5, 'JUDGE', NULL, NULL, 'a profession', '', NULL, '2020-12-26 23:38:30', '2020-12-26 23:38:30', NULL),
(89, 5, 'MACHINE', NULL, NULL, 'equipment', '', NULL, '2020-12-26 23:38:45', '2020-12-26 23:38:45', NULL),
(90, 5, 'OCEAN', NULL, NULL, 'body of water', '', NULL, '2020-12-26 23:39:02', '2020-12-26 23:39:02', NULL),
(91, 5, 'POLE', NULL, NULL, 'a stick', '', NULL, '2020-12-26 23:39:39', '2020-12-26 23:39:39', NULL),
(92, 5, 'ROCK', NULL, NULL, 'part of nature', '', NULL, '2020-12-26 23:39:54', '2020-12-26 23:39:54', NULL),
(93, 5, 'SQUARE', NULL, NULL, 'a shape', '', NULL, '2020-12-26 23:40:14', '2020-12-26 23:40:14', NULL),
(94, 5, 'TABLE', NULL, NULL, 'furniture', '', NULL, '2020-12-26 23:40:29', '2020-12-26 23:40:29', NULL),
(95, 5, 'WATER', NULL, NULL, 'liquid', '', NULL, '2020-12-26 23:40:43', '2020-12-26 23:40:43', NULL),
(96, 5, 'UNREALITY', NULL, NULL, 'futility', '', NULL, '2020-12-26 23:40:57', '2020-12-26 23:40:57', NULL),
(97, 5, 'ATROCITY', NULL, NULL, 'disaster', '', NULL, '2020-12-26 23:41:10', '2020-12-26 23:41:10', NULL),
(98, 5, 'DEDUCTION', NULL, NULL, 'form of reasoning', '', NULL, '2020-12-26 23:41:34', '2020-12-26 23:41:34', NULL),
(99, 5, 'FORETHOUGHT', NULL, NULL, 'planning', '', NULL, '2020-12-26 23:41:51', '2020-12-26 23:41:51', NULL),
(100, 6, 'WINTER', NULL, NULL, 'a season', '', NULL, '2020-12-26 23:47:03', '2020-12-26 23:47:03', NULL),
(101, 6, 'LAWN', NULL, NULL, 'property', '', NULL, '2020-12-26 23:47:17', '2020-12-26 23:47:17', NULL),
(102, 6, 'STREET', NULL, NULL, 'roadway', '', NULL, '2020-12-26 23:47:31', '2020-12-26 23:47:31', NULL),
(103, 6, 'SHORE', NULL, NULL, 'geographic region', '', NULL, '2020-12-26 23:47:47', '2020-12-26 23:47:47', NULL),
(104, 6, 'CHRISTMAS', NULL, NULL, 'holiday', '', NULL, '2020-12-26 23:47:59', '2020-12-26 23:47:59', NULL),
(105, 6, 'DOLLAR', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:48:12', '2020-12-26 23:48:12', NULL),
(106, 6, 'ARROW', NULL, NULL, 'weapon', '', NULL, '2020-12-26 23:48:25', '2020-12-26 23:48:25', NULL),
(107, 6, 'BOOK', NULL, NULL, 'something you read', '', NULL, '2020-12-26 23:48:45', '2020-12-26 23:48:45', NULL),
(108, 6, 'CANDY', NULL, NULL, 'food', '', NULL, '2020-12-26 23:49:01', '2020-12-26 23:49:01', NULL),
(109, 6, 'PENCIL', NULL, NULL, 'something you write with', '', NULL, '2020-12-26 23:49:16', '2020-12-26 23:49:16', NULL),
(110, 6, 'CORD', NULL, NULL, 'electric conductor/music element', '', NULL, '2020-12-26 23:49:33', '2020-12-26 23:49:33', NULL),
(111, 6, 'FLESH', NULL, NULL, 'part of body', '', NULL, '2020-12-26 23:49:52', '2020-12-26 23:49:52', NULL),
(112, 6, 'TOY', NULL, NULL, 'object', '', NULL, '2020-12-26 23:50:06', '2020-12-26 23:50:06', NULL),
(113, 6, 'PROFESSOR', NULL, NULL, 'profession', '', NULL, '2020-12-26 23:50:22', '2020-12-26 23:50:22', NULL),
(114, 6, 'HOSPITAL', NULL, NULL, 'a building', '', NULL, '2020-12-26 23:50:35', '2020-12-26 23:50:35', NULL),
(115, 6, 'FURNITURE', NULL, NULL, 'household item', '', NULL, '2020-12-26 23:50:49', '2020-12-26 23:50:49', NULL),
(116, 6, 'EQUAL', NULL, NULL, 'sweetener/ mathematics sign', '', NULL, '2020-12-26 23:51:08', '2020-12-26 23:51:08', NULL),
(117, 6, 'STEPS', NULL, NULL, 'passageway', '', NULL, '2020-12-26 23:51:22', '2020-12-26 23:51:22', NULL),
(118, 6, 'MONEY', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:51:38', '2020-12-26 23:51:38', NULL),
(119, 6, 'UNBELIEVER', NULL, NULL, 'skeptic', '', NULL, '2020-12-26 23:53:23', '2020-12-26 23:53:23', NULL),
(120, 7, 'AUTOMOBILE', NULL, NULL, 'Transportation', '', NULL, '2020-12-26 23:55:51', '2020-12-26 23:55:51', NULL),
(121, 7, 'BOTTLE', NULL, NULL, 'Container', '', NULL, '2020-12-26 23:56:04', '2020-12-26 23:56:04', NULL),
(122, 7, 'CASH', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:56:17', '2020-12-26 23:56:17', NULL),
(123, 7, 'CHURCH', NULL, NULL, 'building', '', NULL, '2020-12-26 23:56:30', '2020-12-26 23:56:30', NULL),
(124, 7, 'CORN', NULL, NULL, 'vegetable', '', NULL, '2020-12-26 23:56:45', '2020-12-26 23:56:45', NULL),
(125, 7, 'DOOR', NULL, NULL, 'passageway', '', NULL, '2020-12-26 23:56:58', '2020-12-26 23:56:58', NULL),
(126, 7, 'FLOOD', NULL, NULL, 'natural disaster', '', NULL, '2020-12-26 23:57:13', '2020-12-26 23:57:13', NULL),
(127, 7, 'GARDEN', NULL, NULL, 'property', '', NULL, '2020-12-26 23:57:27', '2020-12-26 23:57:27', NULL),
(128, 7, 'HOTEL', NULL, NULL, 'building', '', NULL, '2020-12-26 23:57:40', '2020-12-26 23:57:40', NULL),
(129, 7, 'LETTER', NULL, NULL, 'symbol/ correspondence', '', NULL, '2020-12-26 23:57:59', '2020-12-26 23:57:59', NULL),
(130, 7, 'MOTHER', NULL, NULL, 'person', '', NULL, '2020-12-26 23:58:13', '2020-12-26 23:58:13', NULL),
(131, 7, 'PHYSICIAN', NULL, NULL, 'a profession', '', NULL, '2020-12-26 23:58:40', '2020-12-26 23:58:40', NULL),
(132, 7, 'PUPIL', NULL, NULL, 'role/ part of body', '', NULL, '2020-12-26 23:58:57', '2020-12-26 23:58:57', NULL),
(133, 7, 'SKIN', NULL, NULL, 'part of body', '', NULL, '2020-12-26 23:59:12', '2020-12-26 23:59:12', NULL),
(134, 7, 'STRENGTH', NULL, NULL, 'characteristic', '', NULL, '2020-12-26 23:59:26', '2020-12-26 23:59:26', NULL),
(135, 7, 'TREE', NULL, NULL, 'living thing', '', NULL, '2020-12-26 23:59:42', '2020-12-26 23:59:42', NULL),
(136, 7, 'WOMEN', NULL, NULL, 'people', '', NULL, '2020-12-26 23:59:55', '2020-12-26 23:59:55', NULL),
(137, 7, 'ADAGE', NULL, NULL, 'saying', '', NULL, '2020-12-27 00:00:12', '2020-12-27 00:00:12', NULL),
(138, 7, 'COMPETENCE', NULL, NULL, 'quality', '', NULL, '2020-12-27 00:00:27', '2020-12-27 00:00:27', NULL),
(139, 7, 'ESSENCE', NULL, NULL, 'quality', '', NULL, '2020-12-27 00:00:46', '2020-12-27 00:00:46', NULL),
(140, 8, 'CIRCLE', NULL, NULL, 'Shape', '', NULL, '2020-12-27 00:02:14', '2020-12-27 00:02:14', NULL),
(141, 8, 'AVENUE', NULL, NULL, 'roadway', '', NULL, '2020-12-27 00:02:27', '2020-12-27 00:02:27', NULL),
(142, 8, 'BOULDER', NULL, NULL, 'part of nature', '', NULL, '2020-12-27 00:02:44', '2020-12-27 00:02:44', NULL),
(143, 8, 'GENTLEMAN', NULL, NULL, 'person', '', NULL, '2020-12-27 00:02:59', '2020-12-27 00:02:59', NULL),
(144, 8, 'CORNER', NULL, NULL, 'an edge', '', NULL, '2020-12-27 00:03:16', '2020-12-27 00:03:16', NULL),
(145, 8, 'HOUSE', NULL, NULL, 'building', '', NULL, '2020-12-27 00:03:33', '2020-12-27 00:03:33', NULL),
(146, 8, 'LIBRARY', NULL, NULL, 'a place', '', NULL, '2020-12-27 00:04:18', '2020-12-27 00:04:18', NULL),
(147, 8, 'QUEEN', NULL, NULL, 'monarchy', '', NULL, '2020-12-27 00:04:33', '2020-12-27 00:04:33', NULL),
(148, 8, 'DRESS', NULL, NULL, 'article of clothing/ an action', '', NULL, '2020-12-27 00:28:25', '2020-12-27 00:28:25', NULL),
(149, 8, 'PICTURE', NULL, NULL, 'object', '', NULL, '2020-12-27 00:28:43', '2020-12-27 00:28:43', NULL),
(150, 8, 'FLOWER', NULL, NULL, 'something that grows', '', NULL, '2020-12-27 00:29:26', '2020-12-27 00:29:26', NULL),
(151, 8, 'MOUNTAIN', NULL, NULL, 'part of nature', '', NULL, '2020-12-27 00:29:42', '2020-12-27 00:29:42', NULL),
(152, 8, 'STRING', NULL, NULL, 'material', '', NULL, '2020-12-27 00:29:59', '2020-12-27 00:29:59', NULL),
(153, 8, 'TROOPS', NULL, NULL, 'military', '', NULL, '2020-12-27 00:30:14', '2020-12-27 00:30:14', NULL),
(154, 8, 'WOODS', NULL, NULL, 'nature', '', NULL, '2020-12-27 00:30:28', '2020-12-27 00:30:28', NULL),
(155, 8, 'EXCLUSION', NULL, NULL, 'omission', '', NULL, '2020-12-27 00:30:40', '2020-12-27 00:30:40', NULL),
(156, 8, 'CONTEXT', NULL, NULL, 'environment', '', NULL, '2020-12-27 00:30:54', '2020-12-27 00:30:54', NULL),
(157, 8, 'ADVERSITY', NULL, NULL, 'situation', '', NULL, '2020-12-27 00:31:06', '2020-12-27 00:31:06', NULL),
(158, 8, 'SKY', NULL, NULL, 'nature', '', NULL, '2020-12-27 00:31:23', '2020-12-27 00:31:23', NULL);

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
-- Table structure for table `generals`
--

CREATE TABLE `generals` (
  `id` bigint(20) NOT NULL,
  `story_id` int(11) NOT NULL,
  `word` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `contextual_cue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorical_cue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `words` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('directions','shopping','to do') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generals`
--

INSERT INTO `generals` (`id`, `story_id`, `word`, `contextual_cue`, `question`, `categorical_cue`, `words`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'MILK', NULL, NULL, NULL, 'MILK', 'shopping', '2020-12-27 00:31:23', '2020-12-27 00:31:23', NULL),
(2, 1, 'CAT-FOOD', NULL, NULL, NULL, 'CAT-FOOD', 'shopping', NULL, NULL, NULL),
(3, 1, 'EGGS', NULL, NULL, NULL, 'EGGS', 'shopping', NULL, NULL, NULL),
(4, 1, 'PAPER-TOWELS', NULL, NULL, NULL, 'PAPER-TOWELS', 'shopping', NULL, NULL, NULL),
(5, 1, 'SOUP', NULL, NULL, NULL, 'SOUP', 'shopping', NULL, NULL, NULL),
(6, 1, 'PEANUTS', NULL, NULL, NULL, 'PEANUTS', 'shopping', NULL, NULL, NULL),
(7, 1, 'RICE', NULL, NULL, NULL, 'RICE', 'shopping', NULL, NULL, NULL),
(8, 1, 'COOKIES', NULL, NULL, NULL, 'COOKIES', 'shopping', NULL, NULL, NULL),
(9, 1, 'LETTUCE', NULL, NULL, NULL, 'LETTUCE', 'shopping', NULL, NULL, NULL),
(10, 1, 'APPLES', NULL, NULL, NULL, 'APPLES', 'shopping', NULL, NULL, NULL),
(11, 1, 'CHEESE', NULL, NULL, NULL, 'CHEESE', 'shopping', NULL, NULL, NULL),
(12, 1, 'BREAD', NULL, NULL, NULL, 'BREAD', 'shopping', NULL, NULL, NULL),
(13, 1, 'SPINACH', NULL, NULL, NULL, 'SPINACH', 'shopping', NULL, NULL, NULL),
(14, 1, 'SOUR-CREAM', NULL, NULL, NULL, 'SOUR-CREAM', 'shopping', NULL, NULL, NULL),
(15, 1, 'PASTA', NULL, NULL, NULL, 'PASTA', 'shopping', NULL, NULL, NULL),
(16, 1, 'CHICKEN', NULL, NULL, NULL, 'CHICKEN', 'shopping', NULL, NULL, NULL),
(17, 1, 'GRAPES', NULL, NULL, NULL, 'GRAPES', 'shopping', NULL, NULL, NULL),
(18, 1, 'HOT-DOGS', NULL, NULL, NULL, 'HOT-DOGS', 'shopping', NULL, NULL, NULL),
(19, 1, 'CEREAL', NULL, NULL, NULL, 'CEREAL', 'shopping', NULL, NULL, NULL),
(20, 1, 'PRETZELS', NULL, NULL, NULL, 'PRETZELS', 'shopping', NULL, NULL, NULL),
(21, 1, 'Go to the BANK', NULL, NULL, NULL, 'BANK', 'to do', NULL, NULL, NULL),
(22, 1, 'Pick up the kids at SCHOOL', NULL, NULL, NULL, 'SCHOOL', 'to do', NULL, NULL, NULL),
(23, 1, 'Take the DOG for a walk', NULL, NULL, NULL, 'DOG', 'to do', NULL, NULL, NULL),
(24, 1, 'Pay the MORTGAGE', NULL, NULL, NULL, 'MORTGAGE', 'to do', NULL, NULL, NULL),
(25, 1, 'Buy STAMPS', NULL, NULL, NULL, 'STAMPS', 'to do', NULL, NULL, NULL),
(26, 1, 'Drop off the dry CLEANING', NULL, NULL, NULL, 'CLEANING', 'to do', NULL, NULL, NULL),
(27, 1, 'Meet Joe for LUNCH', NULL, NULL, NULL, 'LUNCH', 'to do', NULL, NULL, NULL),
(28, 1, 'Mow the LAWN', NULL, NULL, NULL, 'LAWN', 'to do', NULL, NULL, NULL),
(29, 1, 'Wrap Suzie\'s birthday GIFT', NULL, NULL, NULL, 'GIFT', 'to do', NULL, NULL, NULL),
(30, 1, 'Read the NEWSPAPER', NULL, NULL, NULL, 'NEWSPAPER', 'to do', NULL, NULL, NULL),
(31, 1, 'Make a LEFT onto MOUNTAINVIEW Road.', NULL, 'LEFT,MOUNTAINVIEW', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(32, 1, 'Make a LEFT onto MOUNTAINVIEW Road.', NULL, 'D', NULL, 'MOUNTAINVIEW', 'directions', NULL, NULL, NULL),
(33, 1, 'Travel ONE-MILE.', NULL, 'ONE-MILE', NULL, 'ONE-MILE', 'directions', NULL, NULL, NULL),
(34, 1, 'Make a RIGHT onto NORTH-58TH Street.', NULL, 'RIGHT,NORTH-58TH', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(35, 1, 'Make a RIGHT onto NORTH-58TH Street.', NULL, 'D', NULL, 'NORTH-58TH', 'directions', NULL, NULL, NULL),
(36, 1, 'Make a LEFT onto DOUBLETREE Road.', NULL, 'LEFT,DOUBLETREE', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(37, 1, 'Make a LEFT onto DOUBLETREE Road.', NULL, 'D', NULL, 'DOUBLETREE', 'directions', NULL, NULL, NULL),
(38, 1, 'Bear RIGHT onto route 101-SOUTH.', NULL, 'RIGHT,101-SOUTH', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(39, 1, 'Bear RIGHT onto route 101-SOUTH.', NULL, 'D', NULL, '101-SOUTH', 'directions', NULL, NULL, NULL),
(40, 1, 'Continue on ROUTE-101, taking EXIT-19.', NULL, 'ROUTE-101,EXIT-19', NULL, 'ROUTE-101', 'directions', NULL, NULL, NULL),
(41, 1, 'Continue on ROUTE-101, taking EXIT-19.', NULL, 'D', NULL, 'EXIT-19', 'directions', NULL, NULL, NULL),
(42, 1, 'At the end of the exit ramp, make LEFT onto CAMBELBACK Drive.', NULL, 'LEFT,CAMBELBACK', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(43, 1, 'At the end of the exit ramp, make LEFT onto CAMBELBACK Drive.', NULL, 'D', NULL, 'CAMBELBACK', 'directions', NULL, NULL, NULL),
(44, 1, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', NULL, '3RD-INTERSECTION,LEFT,SUNSHINE', NULL, '3RD-INTERSECTION', 'directions', NULL, NULL, NULL),
(45, 1, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', NULL, 'D', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(46, 1, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', NULL, 'D', NULL, 'SUNSHINE', 'directions', NULL, NULL, NULL),
(47, 1, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', NULL, '2-MILES,RIGHT,VAN-BUREN', NULL, '2-MILES', 'directions', NULL, NULL, NULL),
(48, 1, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', NULL, 'D', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(49, 1, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', NULL, 'D', NULL, 'VAN-BUREN', 'directions', NULL, NULL, NULL),
(50, 1, 'The restaurant will be 1.3-MILES ahead on your RIGHT.', NULL, '1.3-MILES,RIGHT', NULL, '1.3-MILES', 'directions', NULL, NULL, NULL),
(51, 1, 'The restaurant will be 1.3-MILES ahead on your RIGHT.', NULL, 'D', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(52, 2, 'YOGURT', NULL, NULL, NULL, 'YOGURT', 'shopping', NULL, NULL, NULL),
(53, 2, 'NAPKINS', NULL, NULL, NULL, 'NAPKINS', 'shopping', NULL, NULL, NULL),
(54, 2, 'DOG-FOOD', NULL, NULL, NULL, 'DOG-FOOD', 'shopping', NULL, NULL, NULL),
(55, 2, 'JELLY', NULL, NULL, NULL, 'JELLY', 'shopping', NULL, NULL, NULL),
(56, 2, 'PEACHES', NULL, NULL, NULL, 'PEACHES', 'shopping', NULL, NULL, NULL),
(57, 2, 'PLASTIC-WRAP', NULL, NULL, NULL, 'PLASTIC-WRAP', 'shopping', NULL, NULL, NULL),
(58, 2, 'TURKEY', NULL, NULL, NULL, 'TURKEY', 'shopping', NULL, NULL, NULL),
(59, 2, 'CASHEWS', NULL, NULL, NULL, 'CASHEWS', 'shopping', NULL, NULL, NULL),
(60, 2, 'HAMBURGER', NULL, NULL, NULL, 'HAMBURGER', 'shopping', NULL, NULL, NULL),
(61, 2, 'DANISHES', NULL, NULL, NULL, 'DANISHES', 'shopping', NULL, NULL, NULL),
(62, 2, 'CUCUMBERS', NULL, NULL, NULL, 'CUCUMBERS', 'shopping', NULL, NULL, NULL),
(63, 2, 'TORTILLAS', NULL, NULL, NULL, 'TORTILLAS', 'shopping', NULL, NULL, NULL),
(64, 2, 'SPAGHETTI', NULL, NULL, NULL, 'SPAGHETTI', 'shopping', NULL, NULL, NULL),
(65, 2, 'BUTTER', NULL, NULL, NULL, 'BUTTER', 'shopping', NULL, NULL, NULL),
(66, 2, 'PLUMS', NULL, NULL, NULL, 'PLUMS', 'shopping', NULL, NULL, NULL),
(67, 2, 'CRACKERS', NULL, NULL, NULL, 'CRACKERS', 'shopping', NULL, NULL, NULL),
(68, 2, 'ONION', NULL, NULL, NULL, 'ONION', 'shopping', NULL, NULL, NULL),
(69, 2, 'POTATOES', NULL, NULL, NULL, 'POTATOES', 'shopping', NULL, NULL, NULL),
(70, 2, 'OATMEAL', NULL, NULL, NULL, 'OATMEAL', 'shopping', NULL, NULL, NULL),
(71, 2, 'ORANGE-JUICE', NULL, NULL, NULL, 'ORANGE-JUICE', 'shopping', NULL, NULL, NULL),
(72, 2, 'Go to the POST-OFFICE', NULL, NULL, NULL, 'POST-OFFICE', 'to do', NULL, NULL, NULL),
(73, 2, 'Get the CAR washed', NULL, NULL, NULL, 'CAR', 'to do', NULL, NULL, NULL),
(74, 2, 'Buy new SHIRTS', NULL, NULL, NULL, 'SHIRTS', 'to do', NULL, NULL, NULL),
(75, 2, 'Meet Harry for BREAKFAST', NULL, NULL, NULL, 'BREAKFAST', 'to do', NULL, NULL, NULL),
(76, 2, 'Water the PLANTS', NULL, NULL, NULL, 'PLANTS', 'to do', NULL, NULL, NULL),
(77, 2, 'Make the BED', NULL, NULL, NULL, 'BED', 'to do', NULL, NULL, NULL),
(78, 2, 'Do LAUNDRY', NULL, NULL, NULL, 'LAUNDRY', 'to do', NULL, NULL, NULL),
(79, 2, 'Pay the ELECTRIC bill', NULL, NULL, NULL, 'ELECTRIC', 'to do', NULL, NULL, NULL),
(80, 2, 'Visit MOTHER', NULL, NULL, NULL, 'MOTHER', 'to do', NULL, NULL, NULL),
(81, 2, 'Go to the GROCERY store', NULL, NULL, NULL, 'GROCERY', 'to do', NULL, NULL, NULL),
(82, 2, 'Travel NORTH on ROUTE-805.', NULL, 'NORTH,ROUTE-805', NULL, 'NORTH', 'directions', NULL, NULL, NULL),
(83, 2, 'Travel NORTH on ROUTE-805.', NULL, 'D', NULL, 'ROUTE-805', 'directions', NULL, NULL, NULL),
(84, 2, 'Take the exit for OLIVE Street.', NULL, 'OLIVE', NULL, 'OLIVE', 'directions', NULL, NULL, NULL),
(85, 2, 'Travel 2-MILES.', NULL, '2-MILES', NULL, '2-MILES', 'directions', NULL, NULL, NULL),
(86, 2, 'Make a RIGHT onto OAK Avenue.', NULL, 'RIGHT,OAK', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(87, 2, 'Make a RIGHT onto OAK Avenue.', NULL, 'D', NULL, 'OAK', 'directions', NULL, NULL, NULL),
(88, 2, 'Follow for 3-MILES.', NULL, '3-MILES', NULL, '3-MILES', 'directions', NULL, NULL, NULL),
(89, 2, 'Bear LEFT onto EUGENE Place.', NULL, 'LEFT,EUGENE', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(90, 2, 'Bear LEFT onto EUGENE Place.', NULL, 'D', NULL, 'EUGENE', 'directions', NULL, NULL, NULL),
(91, 2, 'At the 4TH-TRAFFIC-LIGHT, make a RIGHT onto 63rd Street.', NULL, '4TH-TRAFFIC-LIGHT,RIGHT', NULL, '4TH-TRAFFIC-LIGHT', 'directions', NULL, NULL, NULL),
(92, 2, 'At the 4TH-TRAFFIC-LIGHT, make a RIGHT onto 63rd Street.', NULL, 'D', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(93, 2, 'At CLAY park, bear LEFT onto CORNELL Drive.', NULL, 'CLAY,LEFT,CORNELL', NULL, 'CLAY', 'directions', NULL, NULL, NULL),
(94, 2, 'At CLAY park, bear LEFT onto CORNELL Drive.', NULL, 'D', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(95, 2, 'At CLAY park, bear LEFT onto CORNELL Drive.', NULL, 'D', NULL, 'CORNELL', 'directions', NULL, NULL, NULL),
(96, 2, 'Travel 1-MILE, and arrive at 640 Cornell Drive.', NULL, '1-MILE,640', NULL, '1-MILE', 'directions', NULL, NULL, NULL),
(97, 2, 'Travel 1-MILE, and arrive at 640 Cornell Drive.', NULL, 'D', NULL, '640', 'directions', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instruction` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`id`, `instruction`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test', '2021-02-17 20:39:11', '2021-02-17 20:39:31', '2021-02-17 20:39:31'),
(2, 'test1', '2021-02-17 20:39:21', '2021-02-17 20:39:26', '2021-02-17 20:39:26');

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
  `overview` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overviews`
--

INSERT INTO `overviews` (`id`, `overview`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'For participants, the first four intervention sessions (sessions 1-4) consist of reading short stories displayed on a computer screen and remembering 20 target words embedded within the stories. During each session the participant reads a story that stays on the\r\nscreen for 100 seconds. The target words are capitalized within the story. The participant is instructed to use imagery to assist them in remembering target words. Once the story is read, there is free recall for the target words. Following the free recall, a contextual cue, and if necessary a categorical cue, is given to facilitate recall for each of the target words. After this is completed, training is provided by the trainer, and the process is repeated with the same story', '2020-12-28 04:21:10', '2021-07-19 05:17:36', NULL),
(2, 'Each of the next four intervention sessions (sessions 5-8) consist of a list of 20 target words displayed on a computer screen. The participant creates a story using all the words. Once the story is written, there is a free recall. Following the free recall, a contextual cue, and if necessary a categorical cue is given to facilitate recall of each of the target words. After this is completed, additional training is provided by the trainer and the process is repeated.', '2020-12-28 04:37:00', '2020-12-28 04:37:00', NULL),
(3, 'Finally, in the last 2 sessions (sessions 9 and 10), the treatment session is focused on the application of the mSMT to everyday life. That is, memory-taxing situations that a given participant would be faced with are utilized during training. Such situations may involve\r\nremembering a list of shopping items, remembering a to-do list or remembering directions to a destination. Regardless, the last 2 session focus on specific situations that the participant identified early in treatment as important to their functional memory.', '2020-12-28 04:37:38', '2021-07-19 05:18:54', NULL);

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
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booster_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(20) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `booster_id`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_number` int(11) DEFAULT NULL,
  `story` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `session_number`, `story`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Mr Jones pulled a fresh APPLE from a tree. This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE. Mr Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER. On Saturdays his mother would KISS him and send him to the MARKET. The goods there reminded him of a PALACE. On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row. One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought. Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER.', '2020-12-27 07:54:27', '2020-12-27 07:54:27', NULL),
(2, NULL, 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING. As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN. As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL. He entered a room and saw a KING pig reading a Playboy MAGAZINE. The pig summoned an OFFICER who was peeling a POTATO in the SEA. A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT. Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial.', '2020-12-27 07:55:42', '2020-12-27 07:55:42', NULL),
(3, NULL, 'Peter went to a PARTY at the COLLEGE near the LAKE. There he met a girl that was wearing a nice FUR and high-heeled SHOES. Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL. Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY. He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat. One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable. The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely.', '2020-12-27 07:57:00', '2020-12-27 07:57:00', NULL),
(4, NULL, 'Cindy was a girl who went to PRISON to visit her FRIEND. While there she kept putting a COIN on the table in effort to buy a STONE. Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE. Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO. Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW. On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME.', '2020-12-27 07:57:54', '2020-12-27 07:57:54', NULL),
(5, NULL, 'Mr Harris pulled a fresh APPLE from a tree. This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE. Mr Harris was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER. On Saturdays his mother would KISS him and send him to the MARKET. The goods there reminded him of a PALACE. On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row. One day Mr. Harris’ father left boarding a STEAM boat with a TICKET that his WIFE had bought. Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER.', NULL, NULL, NULL),
(6, NULL, 'Mr. David saw an ANIMAL painting BLOOD on a BUILDING. As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN. As the ENGINE pulled the train through the FOREST, Mr. David walked down a long HALL. He entered a room and saw a KING pig reading a Playboy MAGAZINE. The pig summoned an OFFICER who was peeling a POTATO in the SEA. A STAR witness sentenced Mr. David to spend the rest of his life in a TEMPLE growing WHEAT. Mrs. David heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial.', NULL, NULL, NULL),
(7, NULL, 'Franklin went to a PARTY at the COLLEGE near the LAKE. There he met a girl that was wearing a nice FUR and high-heeled SHOES. Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL. Since Franklin was a military man the girl asked for an ELABORATION of his days in the ARMY. He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat. One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable. The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely.', NULL, NULL, NULL),
(8, NULL, 'Nancy was a girl who went to PRISON to visit her FRIEND. While there she kept putting a COIN on the table in effort to buy a STONE. Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE. Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO. Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW. On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME.', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booster_id` int(20) DEFAULT NULL,
  `booster_range` int(11) NOT NULL,
  `task` text COLLATE utf8mb4_unicode_ci,
  `question` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorical_cue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `words` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `booster_id`, `booster_range`, `task`, `question`, `categorical_cue`, `words`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Make a LEFT onto MOUNTAINVIEW Road.', 'LEFT,MOUNTAINVIEW', NULL, 'LEFT', NULL, NULL, NULL),
(2, 1, 1, 'Make a LEFT onto MOUNTAINVIEW Road.', 'D', NULL, 'MOUNTAINVIEW', NULL, NULL, NULL),
(3, 1, 1, 'Travel ONE-MILE.', 'ONE-MILE', NULL, 'ONE-MILE', NULL, NULL, NULL),
(4, 1, 1, 'Make a RIGHT onto NORTH-58TH Street.', 'RIGHT,NORTH-58TH', NULL, 'RIGHT', NULL, NULL, NULL),
(5, 1, 1, 'Make a RIGHT onto NORTH-58TH Street.', 'D', NULL, 'NORTH-58TH', NULL, NULL, NULL),
(6, 1, 1, 'Make a LEFT onto DOUBLETREE Road.', 'LEFT,DOUBLETREE', NULL, 'LEFT', NULL, NULL, NULL),
(7, 1, 1, 'Make a LEFT onto DOUBLETREE Road.', 'D', NULL, 'DOUBLETREE', NULL, NULL, NULL),
(8, 1, 1, 'Bear RIGHT onto route 101-SOUTH.', 'RIGHT,101-SOUTH', NULL, 'RIGHT', NULL, NULL, NULL),
(9, 1, 1, 'Bear RIGHT onto route 101-SOUTH.', 'D', NULL, '101-SOUTH', NULL, NULL, NULL),
(10, 1, 1, 'Continue on ROUTE-101, taking EXIT-19.', 'ROUTE-101,EXIT-19', NULL, 'ROUTE-101', NULL, NULL, NULL),
(11, 1, 1, 'Continue on ROUTE-101, taking EXIT-19.', 'D', NULL, 'EXIT-19', NULL, NULL, NULL),
(12, 1, 1, 'At the end of the exit ramp, make LEFT onto CAMBELBACK Drive.', 'LEFT,CAMBELBACK', NULL, 'LEFT', NULL, NULL, NULL),
(13, 1, 1, 'At the end of the exit ramp, make LEFT onto CAMBELBACK Drive.', 'D', NULL, 'CAMBELBACK', NULL, NULL, NULL),
(14, 1, 1, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', '3RD-INTERSECTION,LEFT,SUNSHINE', NULL, '3RD-INTERSECTION', NULL, NULL, NULL),
(15, 1, 1, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', 'D', NULL, 'LEFT', NULL, NULL, NULL),
(16, 1, 1, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', 'D', NULL, 'SUNSHINE', NULL, NULL, NULL),
(17, 1, 1, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', '2-MILES,RIGHT,VAN-BUREN', NULL, '2-MILES', NULL, NULL, NULL),
(18, 1, 1, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', 'D', NULL, 'RIGHT', NULL, NULL, NULL),
(19, 1, 1, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', 'D', NULL, 'VAN-BUREN', NULL, NULL, NULL),
(20, 1, 1, 'The restaurant will be 1.3-MILES ahead on your RIGHT.', '1.3-MILES,RIGHT', NULL, '1.3-MILES', NULL, NULL, NULL),
(21, 1, 1, 'The restaurant will be 1.3-MILES ahead on your RIGHT.', 'D', NULL, 'RIGHT', NULL, NULL, NULL),
(22, 1, 2, 'Travel NORTH on ROUTE-805.', 'NORTH,ROUTE-805', NULL, 'NORTH', NULL, NULL, NULL),
(23, 1, 2, 'Travel NORTH on ROUTE-805.', 'D', NULL, 'ROUTE', NULL, NULL, NULL),
(24, 1, 2, 'Take the exit for OLIVE Street.', 'OLIVE', NULL, 'OLIVE', NULL, NULL, NULL),
(25, 1, 2, 'Travel 2-MILES.', '2-MILES', NULL, '2-MILES', NULL, NULL, NULL),
(26, 1, 2, 'Make a RIGHT onto OAK Avenue.', 'RIGHT,OAK', NULL, 'RIGHT', NULL, NULL, NULL),
(27, 1, 2, 'Make a RIGHT onto OAK Avenue.', 'D', NULL, 'OAK', NULL, NULL, NULL),
(28, 1, 2, 'Follow for 3-MILES.', '3-MILES', NULL, '3-MILES', NULL, NULL, NULL),
(29, 1, 2, 'Bear LEFT onto EUGENE Place.', 'LEFT,EUGENE', NULL, 'LEFT', NULL, NULL, NULL),
(30, 1, 2, 'Bear LEFT onto EUGENE Place.', 'D', NULL, 'EUGENE', NULL, NULL, NULL),
(31, 1, 2, 'At the 4TH-TRAFFIC-LIGHT, make a RIGHT onto 63rd Street.', '4TH-TRAFFIC-LIGHT,RIGHT', NULL, '4TH-TRAFFIC-LIGHT', NULL, NULL, NULL),
(32, 1, 2, 'At the 4TH-TRAFFIC-LIGHT, make a RIGHT onto 63rd Street.', 'D', NULL, 'RIGHT', NULL, NULL, NULL),
(33, 1, 2, 'At CLAY park, bear LEFT onto CORNELL Drive.', 'CLAY,LEFT,CORNELL', NULL, 'CLAY', NULL, NULL, NULL),
(34, 1, 2, 'At CLAY park, bear LEFT onto CORNELL Drive.', 'D', NULL, 'LEFT', NULL, NULL, NULL),
(35, 1, 2, 'At CLAY park, bear LEFT onto CORNELL Drive.', 'D', NULL, 'CORNELL', NULL, NULL, NULL),
(36, 1, 2, 'Travel 1-MILE, and arrive at 640 Cornell Drive.', '1-MILE,640', NULL, '1-MILE', NULL, NULL, NULL),
(37, 1, 2, 'Travel 1-MILE, and arrive at 640 Cornell Drive.', 'D', NULL, '640', NULL, NULL, NULL),
(38, 1, 3, 'Make a RIGHT onto CANAL Street.', 'RIGHT,CANAL', NULL, 'RIGHT', NULL, NULL, NULL),
(39, 1, 3, 'Make a RIGHT onto CANAL Street.', 'D', NULL, 'CANAL', NULL, NULL, NULL),
(40, 1, 3, 'At the FORK in the road, stay to the LEFT.', 'FORK,LEFT', NULL, 'FORK', NULL, NULL, NULL),
(41, 1, 3, 'At the FORK in the road, stay to the LEFT.', 'D', NULL, 'LEFT', NULL, NULL, NULL),
(42, 1, 3, 'Continue until you see the PARKWAY-ENTRANCE on your RIGHT.', 'PARKWAY-ENTRANCE,RIGHT', NULL, 'PARKWAY-ENTRANCE', NULL, NULL, NULL),
(43, 1, 3, 'Continue until you see the PARKWAY-ENTRANCE on your RIGHT.', 'D', NULL, 'RIGHT', NULL, NULL, NULL),
(44, 1, 3, 'Take the parkway SOUTH to EXIT-69. Merge onto ROUTE-47.', 'SOUTH,EXIT-69,ROUTE-47', NULL, 'SOUTH', NULL, NULL, NULL),
(45, 1, 3, 'Take the parkway SOUTH to EXIT-69. Merge onto ROUTE-47.', 'D', NULL, 'EXIT-69', NULL, NULL, NULL),
(46, 1, 3, 'Take the parkway SOUTH to EXIT-69. Merge onto ROUTE-47.', 'D', NULL, 'ROUTE-47', NULL, NULL, NULL),
(47, 1, 3, 'Continue straight through 3-LIGHTS and take the next JUGHANDLE.', '3-LIGHTS,JUGHANDLE', NULL, '3-LIGHTS', NULL, NULL, NULL),
(48, 1, 3, 'Continue straight through 3 LIGHTS and take the next JUGHANDLE.', 'D', NULL, 'JUGHANDLE', NULL, NULL, NULL),
(49, 1, 3, 'Cross Route 47 and continue down AVENUE-H.', 'AVENUE-H', NULL, 'AVENUE-H', NULL, NULL, NULL),
(50, 1, 3, 'After approximately 2.2-MILES make a LEFT onto INLET terrace.', '2.2-MILES,LEFT,INLET', NULL, '2.2-MILES', NULL, NULL, NULL),
(51, 1, 3, 'After approximately 2.2-MILES make a LEFT onto INLET terrace.', 'D', NULL, 'LEFT', NULL, NULL, NULL),
(52, 1, 3, 'After approximately 2.2-MILES make a LEFT onto INLET terrace.', 'D', NULL, 'INLET', NULL, NULL, NULL),
(53, 1, 3, 'Pass the HIGH-SCHOOL on the RIGHT and after the football FIELD, bear LEFT into PARKING-LOT-C.', 'HIGH-SCHOOL,RIGHT,FIELD,LEFT,PARKING-LOT-C', NULL, 'HIGH-SCHOOL', NULL, NULL, NULL),
(54, 1, 3, 'Pass the HIGH-SCHOOL on the RIGHT and after the football FIELD, bear LEFT into PARKING-LOT-C.', 'D', NULL, 'RIGHT', NULL, NULL, NULL),
(55, 1, 3, 'Pass the HIGH-SCHOOL on the RIGHT and after the football FIELD, bear LEFT into PARKING-LOT-C.', 'D', NULL, 'FIELD', NULL, NULL, NULL),
(56, 1, 3, 'Pass the HIGH-SCHOOL on the RIGHT and after the football FIELD, bear LEFT into PARKING-LOT-C.', 'D', NULL, 'LEFT', NULL, NULL, NULL),
(57, 1, 3, 'Pass the HIGH-SCHOOL on the RIGHT and after the football FIELD, bear LEFT into PARKING-LOT-C.', 'D', NULL, 'PARKING-LOT-C', NULL, NULL, NULL),
(58, 2, 1, 'MILK', NULL, NULL, 'MILK', NULL, NULL, NULL),
(59, 2, 1, 'CAT-FOOD', NULL, NULL, 'CAT-FOOD', NULL, NULL, NULL),
(60, 2, 1, 'EGGS', NULL, NULL, 'EGGS', NULL, NULL, NULL),
(61, 2, 1, 'PAPER-TOWELS', NULL, NULL, 'PAPER-TOWELS', NULL, NULL, NULL),
(62, 2, 1, 'SOUP', NULL, NULL, 'SOUP', NULL, NULL, NULL),
(63, 2, 1, 'PEANUTS', NULL, NULL, 'PEANUTS', NULL, NULL, NULL),
(64, 2, 1, 'RICE', NULL, NULL, 'RICE', NULL, NULL, NULL),
(65, 2, 1, 'COOKIES', NULL, NULL, 'COOKIES', NULL, NULL, NULL),
(66, 2, 1, 'LETTUCE', NULL, NULL, 'LETTUCE', NULL, NULL, NULL),
(67, 2, 1, 'APPLES', NULL, NULL, 'APPLES', NULL, NULL, NULL),
(68, 2, 1, 'CHEESE', NULL, NULL, 'CHEESE', NULL, NULL, NULL),
(69, 2, 1, 'BREAD', NULL, NULL, 'BREAD', NULL, NULL, NULL),
(70, 2, 1, 'SPINACH', NULL, NULL, 'SPINACH', NULL, NULL, NULL),
(71, 2, 1, 'SOUR-CREAM', NULL, NULL, 'SOUR-CREAM', NULL, NULL, NULL),
(72, 2, 1, 'PASTA', NULL, NULL, 'PASTA', NULL, NULL, NULL),
(73, 2, 1, 'CHICKEN', NULL, NULL, 'CHICKEN', NULL, NULL, NULL),
(74, 2, 1, 'GRAPES', NULL, NULL, 'GRAPES', NULL, NULL, NULL),
(75, 2, 1, 'HOT-DOGS', NULL, NULL, 'HOT-DOGS', NULL, NULL, NULL),
(76, 2, 1, 'CEREAL', NULL, NULL, 'CEREAL', NULL, NULL, NULL),
(77, 2, 1, 'PRETZELS', NULL, NULL, 'PRETZELS', NULL, NULL, NULL),
(78, 2, 2, 'YOGURT', NULL, NULL, 'YOGURT', NULL, NULL, NULL),
(79, 2, 2, 'NAPKINS', NULL, NULL, 'NAPKINS', NULL, NULL, NULL),
(80, 2, 2, 'DOG-FOOD', NULL, NULL, 'DOG-FOOD', NULL, NULL, NULL),
(81, 2, 2, 'JELLY', NULL, NULL, 'JELLY', NULL, NULL, NULL),
(82, 2, 2, 'PEACHES', NULL, NULL, 'PEACHES', NULL, NULL, NULL),
(83, 2, 2, 'PLASTIC-WRAP', NULL, NULL, 'PLASTIC-WRAP', NULL, NULL, NULL),
(84, 2, 2, 'TURKEY', NULL, NULL, 'TURKEY', NULL, NULL, NULL),
(85, 2, 2, 'CASHEWS', NULL, NULL, 'CASHEWS', NULL, NULL, NULL),
(86, 2, 2, 'HAMBURGER', NULL, NULL, 'HAMBURGER', NULL, NULL, NULL),
(87, 2, 2, 'DANISHES', NULL, NULL, 'DANISHES', NULL, NULL, NULL),
(88, 2, 2, 'CUCUMBERS', NULL, NULL, 'CUCUMBERS', NULL, NULL, NULL),
(89, 2, 2, 'TORTILLAS', NULL, NULL, 'TORTILLAS', NULL, NULL, NULL),
(90, 2, 2, 'SPAGHETTI', NULL, NULL, 'SPAGHETTI', NULL, NULL, NULL),
(91, 2, 2, 'BUTTER', NULL, NULL, 'BUTTER', NULL, NULL, NULL),
(92, 2, 2, 'PLUMS', NULL, NULL, 'PLUMS', NULL, NULL, NULL),
(93, 2, 2, 'CRACKERS', NULL, NULL, 'CRACKERS', NULL, NULL, NULL),
(94, 2, 2, 'ONION', NULL, NULL, 'ONION', NULL, NULL, NULL),
(95, 2, 2, 'POTATOES', NULL, NULL, 'POTATOES', NULL, NULL, NULL),
(96, 2, 2, 'OATMEAL', NULL, NULL, 'OATMEAL', NULL, NULL, NULL),
(97, 2, 2, 'ORANGE-JUICE', NULL, NULL, 'ORANGE-JUICE', NULL, NULL, NULL),
(98, 2, 3, 'CAT-LITTER', NULL, NULL, 'CAT-LITTER', NULL, NULL, NULL),
(99, 2, 3, 'BROCCOLI', NULL, NULL, 'BROCCOLI', NULL, NULL, NULL),
(100, 2, 3, 'APPLE-JUICE', NULL, NULL, 'APPLE-JUICE', NULL, NULL, NULL),
(101, 2, 3, 'CHICKEN', NULL, NULL, 'CHICKEN', NULL, NULL, NULL),
(102, 2, 3, 'DETERGENT', NULL, NULL, 'DETERGENT', NULL, NULL, NULL),
(103, 2, 3, 'SHAMPOO', NULL, NULL, 'SHAMPOO', NULL, NULL, NULL),
(104, 2, 3, 'RICE', NULL, NULL, 'RICE', NULL, NULL, NULL),
(105, 2, 3, 'FLOUR', NULL, NULL, 'FLOUR', NULL, NULL, NULL),
(106, 2, 3, 'TIN-FOIL', NULL, NULL, 'TIN-FOIL', NULL, NULL, NULL),
(107, 2, 3, 'SYRUP', NULL, NULL, 'SYRUP', NULL, NULL, NULL),
(108, 2, 3, 'GARLIC', NULL, NULL, 'GARLIC', NULL, NULL, NULL),
(109, 2, 3, 'DAISIES', NULL, NULL, 'DAISIES', NULL, NULL, NULL),
(110, 2, 3, 'CELERY', NULL, NULL, 'CELERY', NULL, NULL, NULL),
(111, 2, 3, 'SOAP', NULL, NULL, 'SOAP', NULL, NULL, NULL),
(112, 2, 3, 'PANCAKE-MIX', NULL, NULL, 'PANCAKE-MIX', NULL, NULL, NULL),
(113, 2, 3, 'TOMATOES', NULL, NULL, 'TOMATOES', NULL, NULL, NULL),
(114, 2, 3, 'ICE-CREAM', NULL, NULL, 'ICE-CREAM', NULL, NULL, NULL),
(115, 2, 3, 'WHIPPED-CREAM', NULL, NULL, 'WHIPPED-CREAM', NULL, NULL, NULL),
(116, 2, 3, 'PEANUT-BUTTER', NULL, NULL, 'PEANUT-BUTTER', NULL, NULL, NULL),
(117, 2, 3, 'TOOTH-PASTE', NULL, NULL, 'TOOTH-PASTE', NULL, NULL, NULL),
(118, 3, 1, 'Go to the BANK', NULL, NULL, 'BANK', NULL, NULL, NULL),
(119, 3, 1, 'Pick up the kids at SCHOOL', NULL, NULL, 'SCHOOL', NULL, NULL, NULL),
(120, 3, 1, 'Take the DOG for a walk', NULL, NULL, 'DOG', NULL, NULL, NULL),
(121, 3, 1, 'Pay the MORTGAGE', NULL, NULL, 'MORTGAGE', NULL, NULL, NULL),
(122, 3, 1, 'Buy STAMPS', NULL, NULL, 'STAMPS', NULL, NULL, NULL),
(123, 3, 1, 'Drop off the dry CLEANING', NULL, NULL, 'CLEANING', NULL, NULL, NULL),
(124, 3, 1, 'Meet Joe for LUNCH', NULL, NULL, 'LUNCH', NULL, NULL, NULL),
(125, 3, 1, 'Mow the LAWN', NULL, NULL, 'LAWN', NULL, NULL, NULL),
(126, 3, 1, 'Wrap Suzie\'s birthday GIFT', NULL, NULL, 'GIFT', NULL, NULL, NULL),
(127, 3, 1, 'Read the NEWSPAPER', NULL, NULL, 'NEWSPAPER', NULL, NULL, NULL),
(128, 3, 2, 'Go to the POST-OFFICE', NULL, NULL, 'POST-OFFICE', NULL, NULL, NULL),
(129, 3, 2, 'Get the CAR washed', NULL, NULL, 'CAR', NULL, NULL, NULL),
(130, 3, 2, 'Buy new SHIRTS', NULL, NULL, 'SHIRTS', NULL, NULL, NULL),
(131, 3, 2, 'Meet Harry for BREAKFAST', NULL, NULL, 'BREAKFAST', NULL, NULL, NULL),
(132, 3, 2, 'Water the PLANTS', NULL, NULL, 'PLANTS', NULL, NULL, NULL),
(133, 3, 2, 'Make the BED', NULL, NULL, 'BED', NULL, NULL, NULL),
(134, 3, 2, 'Do LAUNDRY', NULL, NULL, 'LAUNDRY', NULL, NULL, NULL),
(135, 3, 2, 'Pay the ELECTRIC bill', NULL, NULL, 'ELECTRIC', NULL, NULL, NULL),
(136, 3, 2, 'Visit MOTHER', NULL, NULL, 'MOTHER', NULL, NULL, NULL),
(137, 3, 2, 'Go to the GROCERY store', NULL, NULL, 'GROCERY', NULL, NULL, NULL),
(138, 3, 3, 'Go to the DRUG-STORE', NULL, NULL, 'DRUG-STORE', NULL, NULL, NULL),
(139, 3, 3, 'Clean out the REFRIDGERATOR', NULL, NULL, 'REFRIDGERATOR', NULL, NULL, NULL),
(140, 3, 3, 'Stop for GAS', NULL, NULL, 'GAS', NULL, NULL, NULL),
(141, 3, 3, 'Pay the CABLE-BILL', NULL, NULL, 'CABLE-BILL', NULL, NULL, NULL),
(142, 3, 3, 'Meet KELLY for coffee', NULL, NULL, 'KELLY', NULL, NULL, NULL),
(143, 3, 3, 'Pick up PRESCRIPTION from doctor', NULL, NULL, 'PRESCRIPTION', NULL, NULL, NULL),
(144, 3, 3, 'VACUUM the floors', NULL, NULL, 'VACUUM', NULL, NULL, NULL),
(145, 3, 3, 'Put PHOTOS in album', NULL, NULL, 'PHOTOS', NULL, NULL, NULL),
(146, 3, 3, 'SWEEP the patio', NULL, NULL, 'SWEEP', NULL, NULL, NULL),
(147, 3, 3, 'Take a SHOWER', NULL, NULL, 'SHOWER', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainees`
--

CREATE TABLE `trainees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_pin` int(11) DEFAULT NULL,
  `trainee_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `session_type` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `booster_id` int(11) DEFAULT NULL,
  `booster_range` int(11) DEFAULT NULL,
  `session_start_time` text COLLATE utf8mb4_unicode_ci,
  `session_end_time` text COLLATE utf8mb4_unicode_ci,
  `session_current_position` text COLLATE utf8mb4_unicode_ci,
  `session_state` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'continue',
  `round` int(11) NOT NULL DEFAULT '1',
  `completed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainees`
--

INSERT INTO `trainees` (`id`, `session_pin`, `trainee_id`, `trainer_id`, `session_type`, `session_number`, `booster_id`, `booster_range`, `session_start_time`, `session_end_time`, `session_current_position`, `session_state`, `round`, `completed`, `created_at`, `updated_at`, `deleted_at`) VALUES
(33, 620125, 'Test', 1, 'A', '1', NULL, NULL, '{\"roundOne\":\"2021-12-27T12:42:20.232196Z\",\"roundTwo\":\"2021-12-27T12:50:22.464778Z\"}', '{\"roundOne\":\"2021-12-27T12:49:02.291193Z\",\"roundTwo\":\"2021-12-27T12:59:10.973693Z\"}', NULL, 'completed', 2, 1, '2021-12-27 07:11:59', '2021-12-27 07:29:10', NULL),
(34, 762513, 'Test', 1, 'A', '7', NULL, NULL, '{\"roundOne\":\"2021-12-28T04:49:03.431260Z\",\"roundTwo\":\"2021-12-28T04:55:51.259587Z\"}', '{\"roundOne\":\"2021-12-28T04:54:33.289127Z\",\"roundTwo\":\"2021-12-28T05:06:37.043524Z\"}', NULL, 'completed', 2, 1, '2021-12-27 07:30:01', '2021-12-27 23:36:37', NULL),
(35, 898499, 'Test', 1, 'A', '10', NULL, NULL, '{\"roundOne\":\"2021-12-28T05:35:13.387868Z\",\"roundTwo\":\"2021-12-28T05:39:30.040555Z\"}', '{\"roundOne\":\"2021-12-28T05:39:13.104517Z\",\"roundTwo\":\"2021-12-28T06:18:37.277740Z\"}', NULL, 'completed', 2, 1, '2021-12-27 23:45:34', '2021-12-28 00:48:37', NULL),
(36, 228749, 'Test', 1, 'A', '18', 2, NULL, '{\"roundOne\":\"2022-01-19T09:35:35.266971Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2021-12-28 00:50:04', '2022-01-19 04:05:35', NULL),
(37, 471596, 'Test', 1, 'A', '18', 1, NULL, '{\"roundOne\":\"2021-12-28T07:13:53.260859Z\",\"roundTwo\":\"2021-12-28T09:08:20.269091Z\"}', '{\"roundOne\":\"2021-12-28T09:07:41.745887Z\",\"roundTwo\":\"2021-12-28T09:19:27.478253Z\"}', NULL, 'completed', 2, 1, '2021-12-28 00:57:37', '2021-12-28 03:49:27', NULL),
(38, 318458, 'Test', 1, 'A', '17', 1, NULL, '{\"roundOne\":\"2021-12-28T09:23:26.271911Z\",\"roundTwo\":\"\"}', '{\"roundOne\":\"2021-12-28T11:17:21.625596Z\",\"roundTwo\":\"\"}', NULL, 'continue', 2, 0, '2021-12-28 03:52:57', '2021-12-28 05:47:21', NULL),
(39, 680334, 'Test', 1, 'A', 'Booster', 3, 2, '{\"roundOne\":\"2021-12-28T11:20:52.800674Z\",\"roundTwo\":\"2021-12-28T11:30:44.378511Z\"}', '{\"roundOne\":\"2021-12-28T11:28:01.755209Z\",\"roundTwo\":\"2021-12-28T11:40:40.791624Z\"}', NULL, 'completed', 2, 1, '2021-12-28 05:50:39', '2021-12-28 06:10:40', NULL),
(40, 526190, 'Test', 1, 'A', '7', NULL, NULL, '{\"roundOne\":\"2021-12-29T04:44:31.115743Z\",\"roundTwo\":\"2022-01-19T09:36:18.187426Z\"}', '{\"roundOne\":\"2021-12-29T06:09:05.604248Z\",\"roundTwo\":\"\"}', NULL, 'continue', 2, 0, '2021-12-28 07:36:20', '2022-01-19 04:06:18', NULL),
(41, 284303, 'Test', 1, 'A', '10', NULL, NULL, '{\"roundOne\":\"2021-12-30T07:29:12.022135Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2021-12-30 01:56:46', '2021-12-30 01:59:12', NULL),
(42, 761807, 'tr1', 8, 'A', '3', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-06 06:04:26', '2022-01-06 06:04:26', NULL),
(43, 883715, 'test', 1, 'A', '7', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-06 23:46:30', '2022-01-06 23:46:30', NULL),
(44, 246165, 'test', 1, 'A', '9', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-07 00:21:14', '2022-01-07 00:21:14', NULL),
(45, 825016, 'test', 8, 'A', '1', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-10 05:36:34', '2022-01-10 05:36:34', NULL),
(46, 902890, 'test', 8, 'A', '1', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-10 05:41:08', '2022-01-10 05:41:08', NULL),
(47, 495090, 'test', 8, 'A', '1', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-10 05:42:31', '2022-01-10 05:42:31', NULL),
(48, 786436, 'test', 8, 'A', '3', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-10 05:48:12', '2022-01-10 05:48:12', NULL),
(49, 473106, 'test', 8, 'A', '4', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-10 05:54:54', '2022-01-10 05:54:54', NULL),
(50, 825616, 'test2', 8, '2', '15', NULL, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-10 06:32:55', '2022-01-10 06:32:55', NULL),
(51, 274884, 'test2', 8, '3', '17', 3, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-10 06:37:40', '2022-01-10 06:37:40', NULL),
(52, 296238, 'test', 8, '3', '17', 1, NULL, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-11 01:05:25', '2022-01-11 01:05:25', NULL),
(53, 402214, 'test1', 8, '3', '18', 3, NULL, '{\"roundOne\":\"2022-01-19T12:56:41.672865Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 01:07:42', '2022-01-19 07:26:41', NULL),
(55, 345710, 'test', 8, '2', '16', NULL, NULL, '{\"roundOne\":\"2022-01-19T12:59:14.196589Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 01:22:37', '2022-01-19 07:29:14', NULL),
(56, 882196, 'test', 8, '1', '3', NULL, NULL, '{\"roundOne\":\"2022-01-20T06:32:26.785154Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 01:54:52', '2022-01-20 01:02:26', NULL),
(57, 842575, 'test', 8, '2', '15', NULL, NULL, '{\"roundOne\":\"2022-01-19T12:39:15.945053Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 01:56:08', '2022-01-19 07:09:15', NULL),
(59, 134515, 'test', 8, '1', '3', NULL, NULL, '{\"roundOne\":\"2022-01-21T10:21:54.474570Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 02:05:53', '2022-01-21 04:51:54', NULL),
(61, 257859, 'test', 8, '1', '4', NULL, NULL, '{\"roundOne\":\"2022-01-11T09:58:26.816925Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 03:00:13', '2022-01-11 04:28:26', NULL),
(62, 150057, 'test', 8, '2', '12', NULL, NULL, '{\"roundOne\":\"2022-01-19T13:03:10.534107Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 03:01:11', '2022-01-19 07:33:10', NULL),
(63, 507125, 'test', 8, '4', 'Booster', 3, 3, '{\"roundOne\":\"2022-01-19T13:00:13.352972Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 03:43:03', '2022-01-19 07:30:13', NULL),
(64, 288873, 'test3', 8, '4', 'Booster', 1, 2, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-11 04:01:37', '2022-01-11 04:01:37', NULL),
(65, 725489, 'test3', 8, '2', '16', NULL, NULL, '{\"roundOne\":\"2022-01-11T09:57:49.234776Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 04:01:59', '2022-01-11 04:27:49', NULL),
(68, 577273, 'test', 8, '3', '18', 3, NULL, '{\"roundOne\":\"2022-01-11T11:05:20.946438Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 05:23:23', '2022-01-11 05:35:20', NULL),
(69, 260847, 'test3', 8, '4', 'Booster', 3, 1, '{\"roundOne\":\"2022-01-19T10:51:36.694481Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-11 05:24:24', '2022-01-19 05:21:36', NULL),
(71, 191207, 'tr-1', 8, '3', '17', 3, NULL, '{\"roundOne\":\"2022-01-21T09:49:34.763690Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-13 06:45:10', '2022-01-21 04:19:34', NULL),
(72, 814307, 'tr-1', 48, '2', '12', NULL, NULL, '{\"roundOne\":\"2022-01-19T11:16:31.250965Z\",\"roundTwo\":\"\"}', NULL, NULL, 'start', 1, 0, '2022-01-13 06:45:53', '2022-01-19 05:46:31', NULL),
(73, 416430, 'tr2', 8, '3', '17', 2, NULL, '{\"roundOne\":\"2022-01-19T12:37:56.842528Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-13 06:54:25', '2022-01-19 07:07:56', NULL),
(74, 562755, 'tr1', 8, '4', 'Booster', 1, 2, NULL, NULL, NULL, 'continue', 1, 0, '2022-01-13 06:55:55', '2022-01-13 06:55:55', NULL),
(75, 414946, 'tr3', 8, '4', 'Booster', 3, 2, '{\"roundOne\":\"2022-01-21T08:00:57.262059Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-13 07:00:08', '2022-01-21 02:30:57', NULL),
(76, 128886, 'te1', 8, '4', 'Booster', 2, 2, '{\"roundOne\":\"2022-01-21T07:59:02.574916Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-17 23:50:11', '2022-01-21 02:29:02', NULL),
(77, 984111, 'te1', 48, '1', '6', NULL, NULL, '{\"roundOne\":\"2022-01-21T07:21:05.943701Z\",\"roundTwo\":\"\"}', NULL, '{\"word_id\":101,\"position\":\"answer\",\"user_word_id\":\"\",\"sentence\":\"\"}', 'continue', 1, 0, '2022-01-19 05:24:19', '2022-01-21 01:51:06', NULL),
(78, 555436, 'te1', 48, '2', '15', NULL, NULL, '{\"roundOne\":\"2022-01-19T11:05:19.839562Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-19 05:25:42', '2022-01-19 05:35:19', NULL),
(80, 830508, 'te1', 8, '2', '15', NULL, NULL, '{\"roundOne\":\"2022-01-21T09:59:03.336011Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-19 06:39:37', '2022-01-21 04:29:03', NULL),
(81, 768124, 't1', 8, '3', '17', 3, NULL, '{\"roundOne\":\"2022-01-20T07:29:07.973691Z\",\"roundTwo\":\"2022-01-21T07:25:24.692500Z\"}', '{\"roundOne\":\"2022-01-20T08:09:50.950421Z\",\"roundTwo\":\"\"}', NULL, 'continue', 2, 0, '2022-01-19 06:39:55', '2022-01-21 01:55:24', NULL),
(82, 693483, 'te1', 8, '2', '16', NULL, NULL, '{\"roundOne\":\"2022-01-20T06:27:57.531753Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-19 06:45:28', '2022-01-20 00:57:57', NULL),
(83, 586600, 'tr2', 48, '2', '11', NULL, NULL, '{\"roundOne\":\"2022-01-21T07:52:20.223903Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-19 06:46:34', '2022-01-21 02:22:20', NULL),
(84, 854162, 'tr2', 48, '2', '14', NULL, NULL, '{\"roundOne\":\"2022-01-21T07:51:29.560005Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-19 06:47:46', '2022-01-21 02:21:29', NULL),
(85, 954733, 'te1', 48, '1', '4', NULL, NULL, '{\"roundOne\":\"2022-01-21T05:58:40.359829Z\",\"roundTwo\":\"2022-01-21T07:51:05.824648Z\"}', '{\"roundOne\":\"2022-01-21T06:21:59.748870Z\",\"roundTwo\":\"\"}', NULL, 'continue', 2, 0, '2022-01-21 00:28:13', '2022-01-21 02:21:05', NULL),
(86, 627638, 'te2', 8, '4', 'Booster', 2, 2, '{\"roundOne\":\"2022-01-21T09:46:39.613836Z\",\"roundTwo\":\"\"}', NULL, NULL, 'continue', 1, 0, '2022-01-21 02:32:40', '2022-01-21 04:16:39', NULL),
(87, 437974, 'tr1', 48, '2', '4', NULL, NULL, '{\"roundOne\":\"2022-01-21T11:50:09.673405Z\",\"roundTwo\":\"\"}', '{\"roundOne\":\"2022-01-21T12:18:29.040603Z\",\"roundTwo\":\"\"}', NULL, 'continue', 2, 0, '2022-01-21 05:55:34', '2022-01-21 06:48:29', NULL),
(88, 237577, 'tr2', 8, '3', '1', 3, NULL, '{\"roundOne\":\"2022-01-21T12:19:59.798795Z\",\"roundTwo\":\"\"}', '{\"roundOne\":\"2022-01-21T12:28:04.177499Z\",\"roundTwo\":\"\"}', NULL, 'continue', 2, 0, '2022-01-21 06:49:18', '2022-01-21 06:58:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainee_stories`
--

CREATE TABLE `trainee_stories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainee_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_id` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_pin` int(11) DEFAULT NULL,
  `original_story` longtext COLLATE utf8mb4_unicode_ci,
  `updated_story` longtext COLLATE utf8mb4_unicode_ci,
  `user_story_words` text COLLATE utf8mb4_unicode_ci,
  `reviewed` tinyint(4) NOT NULL DEFAULT '0',
  `round` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainee_stories`
--

INSERT INTO `trainee_stories` (`id`, `trainee_id`, `story_id`, `session_pin`, `original_story`, `updated_story`, `user_story_words`, `reviewed`, `round`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test', '10', 898499, 'Cold WINTER. Large LAWN to sleep. STREET cricket. Sea SHORE has cool breeze. Merry CHRISTMAS. United states DOLLAR. Bow and  ARROW. Text and story BOOK. Sweet CANDY. Pen and PENCIL stand. Long CORD to tie. Red FLESH. TOY to play for children. Math PROFESSOR. Near to HOSPITAL road. FURNITURE and wood work showroom. EQUAL way to success. STEPS to success. UNBELIEVER of reality. MONEY matters.', 'Cold WINTER.  Large LAWN to sleep.  STREET cricket.  Sea SHORE has cool breeze.  Merry CHRISTMAS.  United states DOLLAR.  Bow and ARROW.  Text and story BOOK.  Sweet CANDY.  Pen and PENCIL stand.  Long CORD to tie.  Red FLESH.  TOY to play for children.  Math PROFESSOR.  Near to HOSPITAL road.  FURNITURE and wood work showroom.  EQUAL way to success.  STEPS to success.  UNBELIEVER of reality.  MONEY matters.', '[\"WINTER\",\"LAWN\",\"STREET\",\"SHORE\",\"CHRISTMAS\",\"DOLLAR\",\"ARROW\",\"BOOK\",\"CANDY\",\"PENCIL\",\"CORD\",\"FLESH\",\"TOY\",\"PROFESSOR\",\"HOSPITAL\",\"FURNITURE\",\"EQUAL\",\"STEPS\",\"UNBELIEVER\",\"MONEY\"]', 1, 1, '2021-12-28 05:29:18', '2021-12-27 23:59:18', NULL),
(2, 'Test', '10', 898499, 'Cold WINTER. Large LAWN to sleep. STREET cricket. Sea SHORE. Merry CHRISTMAS. United states DOLLAR. Bow and ARROW. Story BOOK. CANDY crush. Pen and PENCIL. Long CORD to tie. Red and fresh FLESH. TOY train. Math PROFESSOR. Go to HOSPITAL road. FURNITURE and wood showroom. Right to EQUAL. STEPS to success. MONEY matters. UNBELIEVER of reality.', 'Cold WINTER.  Large LAWN to sleep.  STREET cricket.  Sea SHORE.  Merry CHRISTMAS.  United states DOLLAR.  Bow and ARROW.  Story BOOK.  CANDY crush.  Pen and PENCIL.  Long CORD to tie.  Red and fresh FLESH.  TOY train.  Math PROFESSOR.  Go to HOSPITAL road.  FURNITURE and wood showroom.  Right to EQUAL.  STEPS to success.  MONEY matters.  UNBELIEVER of reality.', '[\"WINTER\",\"LAWN\",\"STREET\",\"SHORE\",\"CHRISTMAS\",\"DOLLAR\",\"ARROW\",\"BOOK\",\"CANDY\",\"PENCIL\",\"CORD\",\"FLESH\",\"TOY\",\"PROFESSOR\",\"HOSPITAL\",\"FURNITURE\",\"EQUAL\",\"STEPS\",\"MONEY\",\"UNBELIEVER\"]', 1, 2, '2021-12-28 06:05:28', '2021-12-28 00:35:28', NULL),
(3, 'Test', '18', 471596, 'Go to NORTH through ROUTE-805. In OLIVE road, 2-MILES apart. Take RIGHT to OAK avenue. From there 3-MILES to the East. Take a LEFT turn onto EUGENE. 4TH-TRAFFIC-LIGHT , right onto 63rd street. You will reach CLAY park bear left onto CORNELL drive. Travel 1-MILE and arrive to 640.', 'Go to NORTH through ROUTE-805.  In OLIVE road, 2-MILES apart.  Take RIGHT to OAK avenue.  From there 3-MILES to the east.  Take a LEFT turn onto EUGENE.  4TH-TRAFFIC-LIGHT , RIGHT onto 63rd street.  You will reach CLAY park bear LEFT onto CORNELL drive.  Travel 1-MILE and arrive to 640', '[\"NORTH\",\"ROUTE-805\",\"OLIVE\",\"2-MILES\",\"RIGHT\",\"OAK\",\"3-MILES\",\"LEFT\",\"EUGENE\",\"4TH-TRAFFIC-LIGHT\",\"RIGHT\",\"CLAY\",\"LEFT\",\"CORNELL\",\"1-MILE\",\"640\"]', 1, 1, '2021-12-28 09:01:53', '2021-12-28 03:31:53', NULL),
(4, 'Test', '18', 471596, 'Go to NORTH through ROUTE-805. In OLIVE road, 2-MILES apart. Take RIGHT to OAK avenue. From there 3-MILES to the east. Take LEFT turn onto EUGENE. 4TH-TRAFFIC-LIGHT, right onto 63rd street. You will reach CLAY park bear left onto CORNELL drive. Travel 1-MILE and arrive to 640.', 'Go to NORTH through ROUTE-805.  In OLIVE road, 2-MILES apart.  Take RIGHT to OAK avenue.  From there 3-MILES to the east.  Take LEFT turn onto EUGENE.  4TH-TRAFFIC-LIGHT, RIGHT onto 63rd street.  You will reach CLAY park bear LEFT onto CORNELL drive.  Travel 1-MILE and arrive to 640', '[\"NORTH\",\"ROUTE-805\",\"OLIVE\",\"2-MILES\",\"RIGHT\",\"OAK\",\"3-MILES\",\"LEFT\",\"EUGENE\",\"4TH-TRAFFIC-LIGHT\",\"RIGHT\",\"CLAY\",\"LEFT\",\"CORNELL\",\"1-MILE\",\"640\"]', 1, 2, '2021-12-28 09:12:18', '2021-12-28 03:42:18', NULL),
(5, 'Test', '17', 318458, 'Make LEFT onto MOUNTAINVIEW road. Travel ONE-MILE. Make RIGHT onto NORTH-58TH street. Make left onto DOUBLETREE road. Bear right onto route 101-SOUTH. Continue ROUTE-101 take EXIT-19. At left onto CAMBELBACK drive. At 3RD-INTERSECTION make left onto SUNSHINE street. After 2-MILES bear right onto VAN-BUREN parkway. 1.3-MILES ahead on your right.', 'Make LEFT onto MOUNTAINVIEW road.  Travel ONE-MILE.  Make RIGHT onto NORTH-58TH street.  Make LEFT onto DOUBLETREE road.  Bear RIGHT onto route 101-SOUTH.  Continue ROUTE-101 take EXIT-19.  At LEFT onto CAMBELBACK drive.  At 3RD-INTERSECTION make LEFT onto SUNSHINE street.  After 2-MILES bear RIGHT onto VAN-BUREN parkway.  1.3-MILES ahead on your RIGHT', '[\"LEFT\",\"MOUNTAINVIEW\",\"ONE-MILE\",\"RIGHT\",\"NORTH-58TH\",\"LEFT\",\"DOUBLETREE\",\"RIGHT\",\"101-SOUTH\",\"ROUTE-101\",\"EXIT-19\",\"LEFT\",\"CAMBELBACK\",\"3RD-INTERSECTION\",\"LEFT\",\"SUNSHINE\",\"2-MILES\",\"RIGHT\",\"VAN-BUREN\",\"1.3-MILES\",\"RIGHT\"]', 1, 1, '2021-12-28 11:07:03', '2021-12-28 05:37:03', NULL),
(6, 'Test', 'Booster', 680334, 'Go to POST-OFFICE to post letter. Get CAR washed. Buy new SHIRTS. Meet for BREAKFAST. Water PLANTS. Make BED to sleep. Do LAUNDRY. Pay ELECTRIC bill. Visit MOTHER. Go to GROCERY store.', 'Go to POST-OFFICE to post letter.  Get CAR washed.  Buy new SHIRTS.  Meet for BREAKFAST.  Water PLANTS.  Make BED to sleep.  Do LAUNDRY.  Pay ELECTRIC bill.  Visit MOTHER.  Go to GROCERY store.', '[\"POST-OFFICE\",\"CAR\",\"SHIRTS\",\"BREAKFAST\",\"PLANTS\",\"BED\",\"LAUNDRY\",\"ELECTRIC\",\"MOTHER\",\"GROCERY\"]', 1, 1, '2021-12-28 11:23:46', '2021-12-28 05:53:46', NULL),
(7, 'Test', 'Booster', 680334, 'Go to POST-OFFICE to post letter. Get CAR washed. Buy new SHIRTS. Meet for BREAKFAST. Water PLANTS. Make BED to sleep. Do LAUNDRY. Pay ELECTRIC bill. Visit MOTHER. Go to GROCERY store.', 'Go to POST-OFFICE to post letter.  Get CAR washed.  Buy new SHIRTS.  Meet for BREAKFAST.  Water PLANTS.  Make BED to sleep.  Do LAUNDRY.  Pay ELECTRIC bill.  Visit MOTHER.  Go to GROCERY store.', '[\"POST-OFFICE\",\"CAR\",\"SHIRTS\",\"BREAKFAST\",\"PLANTS\",\"BED\",\"LAUNDRY\",\"ELECTRIC\",\"MOTHER\",\"GROCERY\"]', 1, 2, '2021-12-28 11:33:06', '2021-12-28 06:03:06', NULL),
(8, 't1', '17', 768124, 'Go to BANK. Pickup at SCHOOL. Take DOG for walk. Pay MORTGAGE. Buy STAMPS. Dry CLEANING. Meet for LUNCH. Leave LAWN. Wrap GIFT. Read NEWSPAPER.', 'Go to BANK.  Pickup at SCHOOL.  Take DOG for walk.  Pay MORTGAGE.  Buy STAMPS.  Dry CLEANING.  Meet for LUNCH.  Leave LAWN.  Wrap GIFT.  Read NEWSPAPER.', '[\"BANK\",\"SCHOOL\",\"DOG\",\"MORTGAGE\",\"STAMPS\",\"CLEANING\",\"LUNCH\",\"LAWN\",\"GIFT\",\"NEWSPAPER\"]', 1, 1, '2022-01-20 08:04:04', '2022-01-20 02:34:04', NULL),
(9, 'tr1', '4', 437974, 'CIRCLE and rectangle shaped toys. The cross and cross AVENUE. Big BOULDER and GENTLEMAN run. The CORNER place is his HOUSE. LIBRARY has pin drop silence. QUEEN bee. Fancy DRESS. PICTURE perfect. FLOWER garden. Everest MOUNTAIN. STRING and doll play. Soldier TROOPS. Into the WOODS. EXCLUSION from the list. CONTEXT and story. ADVERSITY of the effect. SKY fly high.', 'CIRCLE and rectangle shaped toys.  The cross and cross AVENUE.  Big BOULDER and GENTLEMAN run.  The CORNER place is his HOUSE.  LIBRARY has pin drop silence.  QUEEN bee.  Fancy DRESS.  PICTURE perfect.  FLOWER garden.  Everest MOUNTAIN.  STRING and doll play.  Soldier TROOPS.  Into the WOODS.  EXCLUSION from the list.  CONTEXT and story.  ADVERSITY of the effect.  SKY fly high.', '[\"CIRCLE\",\"AVENUE\",\"BOULDER\",\"GENTLEMAN\",\"CORNER\",\"HOUSE\",\"LIBRARY\",\"QUEEN\",\"DRESS\",\"PICTURE\",\"FLOWER\",\"MOUNTAIN\",\"STRING\",\"TROOPS\",\"WOODS\",\"EXCLUSION\",\"CONTEXT\",\"ADVERSITY\",\"SKY\"]', 1, 1, '2022-01-21 12:01:58', '2022-01-21 06:31:58', NULL),
(10, 'tr2', '1', 237577, 'BANK deposit. Kids SCHOOL. DOG for walk. Pay MORTGAGE. Buy STAMPS to post. Dry CLEANING. Meet for LUNCH. Leave LAWN. Wrap GIFT. Read NEWSPAPER.', 'BANK deposit.  Kids SCHOOL.  DOG for walk.  Pay MORTGAGE.  Buy STAMPS to post.  Dry CLEANING.  Meet for LUNCH.  Leave LAWN.  Wrap GIFT.  Read NEWSPAPER.', '[\"BANK\",\"SCHOOL\",\"DOG\",\"MORTGAGE\",\"STAMPS\",\"CLEANING\",\"LUNCH\",\"LAWN\",\"GIFT\",\"NEWSPAPER\"]', 1, 1, '2022-01-21 12:23:29', '2022-01-21 06:53:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trainee_transactions`
--

CREATE TABLE `trainee_transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainee_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `story_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `word_id` int(11) DEFAULT NULL,
  `session_pin` int(11) DEFAULT NULL,
  `category` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_or_wrong` int(11) DEFAULT NULL,
  `time_taken` int(11) NOT NULL,
  `type` enum('contextual','categorical','recall','') COLLATE utf8mb4_unicode_ci NOT NULL,
  `round` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trainee_transactions`
--

INSERT INTO `trainee_transactions` (`id`, `trainee_id`, `story_id`, `word_id`, `session_pin`, `category`, `answer`, `correct_or_wrong`, `time_taken`, `type`, `round`, `created_at`, `updated_at`, `deleted_at`) VALUES
(270, 'Test', '1', NULL, 620125, '', '{\"words\":\"BOAT TICKET WIFE BETRAYAL COFFEE CHAIR BAT\"}', NULL, 41, 'recall', 1, '2021-12-27 12:45:11', NULL, NULL),
(271, 'Test', '1', 1, 620125, '', 'APPLE', 1, 2, 'contextual', 1, '2021-12-27 12:45:15', NULL, NULL),
(272, 'Test', '1', 2, 620125, '', 'BLOSSOM', 1, 5, 'contextual', 1, '2021-12-27 12:45:23', NULL, NULL),
(273, 'Test', '1', 3, 620125, '', 'BUTTER', 1, 3, 'contextual', 1, '2021-12-27 12:45:28', NULL, NULL),
(274, 'Test', '1', 4, 620125, '', 'CHAIR', 1, 1, 'contextual', 1, '2021-12-27 12:45:32', NULL, NULL),
(275, 'Test', '1', 5, 620125, '', 'COFFEE', 1, 2, 'contextual', 1, '2021-12-27 12:45:36', NULL, NULL),
(276, 'Test', '1', 6, 620125, '', 'DIAMOND', 1, 5, 'contextual', 1, '2021-12-27 12:45:44', NULL, NULL),
(277, 'Test', '1', 7, 620125, '', 'FACTORY', 1, 4, 'contextual', 1, '2021-12-27 12:45:51', NULL, NULL),
(278, 'Test', '1', 8, 620125, '', 'FORK', 1, 4, 'contextual', 1, '2021-12-27 12:45:56', NULL, NULL),
(279, 'Test', '1', 9, 620125, '', 'HAMMER', 1, 1, 'contextual', 1, '2021-12-27 12:46:46', NULL, NULL),
(280, 'Test', '1', 10, 620125, '', 'KISS', 1, 4, 'contextual', 1, '2021-12-27 12:46:53', NULL, NULL),
(281, 'Test', '1', 11, 620125, '', 'PALACE', 0, 7, 'contextual', 1, '2021-12-27 12:47:02', NULL, NULL),
(282, 'Test', '1', 11, 620125, '', 'MARKET', 1, 4, 'categorical', 1, '2021-12-27 12:47:07', NULL, NULL),
(283, 'Test', '1', 12, 620125, '', 'PALACE', 1, 9, 'contextual', 1, '2021-12-27 12:47:18', NULL, NULL),
(284, 'Test', '1', 13, 620125, '', 'PREIST', 0, 11, 'contextual', 1, '2021-12-27 12:47:31', NULL, NULL),
(285, 'Test', '1', 13, 620125, '', 'PREIST', 0, 10, 'categorical', 1, '2021-12-27 12:47:42', NULL, NULL),
(286, 'Test', '1', 14, 620125, '', 'SEAT', 1, 3, 'contextual', 1, '2021-12-27 12:47:51', NULL, NULL),
(287, 'Test', '1', 15, 620125, '', 'STEAM', 1, 6, 'contextual', 1, '2021-12-27 12:47:59', NULL, NULL),
(288, 'Test', '1', 16, 620125, '', 'TICKET', 1, 6, 'contextual', 1, '2021-12-27 12:48:14', NULL, NULL),
(289, 'Test', '1', 17, 620125, '', 'WIFE', 1, 6, 'contextual', 1, '2021-12-27 12:48:26', NULL, NULL),
(290, 'Test', '1', 18, 620125, '', 'BETRAYAL', 1, 9, 'contextual', 1, '2021-12-27 12:48:37', NULL, NULL),
(291, 'Test', '1', 19, 620125, '', 'DISCLOSURE', 0, 7, 'contextual', 1, '2021-12-27 12:48:46', NULL, NULL),
(292, 'Test', '1', 19, 620125, '', 'DISCRETION', 1, 6, 'categorical', 1, '2021-12-27 12:49:48', '2021-12-27 07:19:48', NULL),
(293, 'Test', '1', 20, 620125, '', 'GENDER', 1, 3, 'contextual', 1, '2021-12-27 12:49:00', NULL, NULL),
(294, 'Test', '1', NULL, 620125, '', '{\"words\":\"STEAM PRIEST WIFE TICKET BUTTER COFFEE\"}', NULL, 102, 'recall', 2, '2021-12-27 12:54:18', NULL, NULL),
(295, 'Test', '1', 1, 620125, '', 'APPLE', 1, 3, 'contextual', 2, '2021-12-27 12:54:23', NULL, NULL),
(296, 'Test', '1', 2, 620125, '', 'BLOSSOM', 1, 5, 'contextual', 2, '2021-12-27 12:54:30', NULL, NULL),
(297, 'Test', '1', 3, 620125, '', 'BUTTER', 1, 2, 'contextual', 2, '2021-12-27 12:54:35', NULL, NULL),
(298, 'Test', '1', 4, 620125, '', 'CHAIR', 1, 1, 'contextual', 2, '2021-12-27 12:54:38', NULL, NULL),
(299, 'Test', '1', 5, 620125, '', 'COFFEE', 1, 3, 'contextual', 2, '2021-12-27 12:54:43', NULL, NULL),
(300, 'Test', '1', 6, 620125, '', 'DIAMOND', 1, 4, 'contextual', 2, '2021-12-27 12:54:48', NULL, NULL),
(301, 'Test', '1', 7, 620125, '', 'FACTORY', 1, 13, 'contextual', 2, '2021-12-27 12:55:04', NULL, NULL),
(302, 'Test', '1', 8, 620125, '', 'FORK', 1, 2, 'contextual', 2, '2021-12-27 12:55:08', NULL, NULL),
(303, 'Test', '1', 9, 620125, '', 'HAMMER', 1, 2, 'contextual', 2, '2021-12-27 12:55:12', NULL, NULL),
(304, 'Test', '1', 10, 620125, '', 'KISS', 1, 3, 'contextual', 2, '2021-12-27 12:55:17', NULL, NULL),
(305, 'Test', '1', 11, 620125, '', 'MARKET', 1, 2, 'contextual', 2, '2021-12-27 12:55:21', NULL, NULL),
(306, 'Test', '1', 12, 620125, '', 'PALACE', 1, 5, 'contextual', 2, '2021-12-27 12:55:28', NULL, NULL),
(307, 'Test', '1', 13, 620125, '', 'PRIEST', 1, 8, 'contextual', 2, '2021-12-27 12:55:38', NULL, NULL),
(308, 'Test', '1', 14, 620125, '', 'SEAT', 1, 2, 'contextual', 2, '2021-12-27 12:55:43', NULL, NULL),
(309, 'Test', '1', 15, 620125, '', 'STEAM', 1, 5, 'contextual', 2, '2021-12-27 12:55:50', NULL, NULL),
(310, 'Test', '1', 16, 620125, '', 'TICKET', 1, 28, 'contextual', 2, '2021-12-27 12:56:21', NULL, NULL),
(311, 'Test', '1', 17, 620125, '', 'WIFE', 1, 2, 'contextual', 2, '2021-12-27 12:56:24', NULL, NULL),
(312, 'Test', '1', 18, 620125, '', 'BETRAYAL', 1, 7, 'contextual', 2, '2021-12-27 12:56:33', NULL, NULL),
(313, 'Test', '1', 19, 620125, '', 'DISCRETION', 1, 7, 'contextual', 2, '2021-12-27 12:59:00', NULL, NULL),
(314, 'Test', '1', 20, 620125, '', 'GENDER', 1, 5, 'contextual', 2, '2021-12-27 12:59:09', NULL, NULL),
(315, 'Test', '7', NULL, 762513, '', '{\"words\":\"DOLL\"}', NULL, 13, 'recall', 1, '2021-12-27 13:02:37', NULL, NULL),
(316, 'Test', '7', 121, 762513, '', 'PARTY', 1, 8, 'contextual', 1, '2021-12-27 13:02:46', NULL, NULL),
(317, 'Test', '7', 122, 762513, '', 'COLLEGE', 1, 3, 'contextual', 1, '2021-12-29 06:06:28', '2021-12-29 00:36:28', '2021-12-29 00:36:28'),
(318, 'Test', '7', 123, 762513, '', 'LAKE', 1, 1, 'contextual', 1, '2021-12-27 13:02:55', NULL, NULL),
(319, 'Test', '7', 124, 762513, '', 'SHOE', 0, 4, 'contextual', 1, '2021-12-27 13:03:02', NULL, NULL),
(320, 'Test', '7', 124, 762513, '', 'SOCKS', 0, 8, 'categorical', 1, '2021-12-27 13:03:11', NULL, NULL),
(321, 'Test', '7', 125, 762513, '', 'SHOE', 0, 2, 'contextual', 1, '2021-12-27 13:03:17', NULL, NULL),
(322, 'Test', '7', 125, 762513, '', 'SHOES', 1, 4, 'categorical', 1, '2021-12-27 13:03:22', NULL, NULL),
(323, 'Test', '7', 126, 762513, '', 'BEER', 0, 13, 'contextual', 1, '2021-12-27 13:03:37', NULL, NULL),
(324, 'Test', '7', 126, 762513, '', 'WINE', 1, 3, 'categorical', 1, '2021-12-27 13:03:42', NULL, NULL),
(325, 'Test', '7', 127, 762513, '', 'BODY', 1, 3, 'contextual', 1, '2021-12-27 13:03:47', NULL, NULL),
(326, 'Test', '7', 128, 762513, '', 'BODY', 0, 3, 'contextual', 1, '2021-12-27 13:03:52', NULL, NULL),
(327, 'Test', '7', 128, 762513, '', 'GIRL', 0, 6, 'categorical', 1, '2021-12-27 13:03:59', NULL, NULL),
(328, 'Test', '7', 129, 762513, '', 'DOLL', 1, 2, 'contextual', 1, '2021-12-27 13:04:09', NULL, NULL),
(329, 'Test', '7', 130, 762513, '', 'ELABOARTION', 0, 21, 'contextual', 1, '2021-12-27 13:04:32', NULL, NULL),
(330, 'Test', '7', 130, 762513, '', 'ELABORATION', 1, 10, 'categorical', 1, '2021-12-27 13:04:44', NULL, NULL),
(331, 'Test', '7', 131, 762513, '', 'CAMP', 0, 3, 'contextual', 1, '2021-12-27 13:04:51', NULL, NULL),
(332, 'Test', '7', 131, 762513, '', 'CAMP', 0, 5, 'categorical', 1, '2021-12-27 13:04:57', NULL, NULL),
(333, 'Test', '7', 132, 762513, '', 'PRISONER', 1, 10, 'contextual', 1, '2021-12-27 13:05:10', NULL, NULL),
(334, 'Test', '7', 133, 762513, '', 'CAMP', 1, 2, 'contextual', 1, '2021-12-27 13:05:14', NULL, NULL),
(335, 'Test', '7', 134, 762513, '', 'FOOD', 0, 2, 'contextual', 1, '2021-12-27 13:05:19', NULL, NULL),
(336, 'Test', '7', 134, 762513, '', 'FOOD', 0, 6, 'categorical', 1, '2021-12-27 13:05:26', NULL, NULL),
(337, 'Test', '7', 135, 762513, '', 'STROAM', 0, 5, 'contextual', 1, '2021-12-27 13:05:34', NULL, NULL),
(338, 'Test', '7', 135, 762513, '', 'STROM', 0, 3, 'categorical', 1, '2021-12-27 13:05:38', NULL, NULL),
(339, 'Test', '7', 136, 762513, '', 'TOWER', 1, 4, 'contextual', 1, '2021-12-27 13:05:49', NULL, NULL),
(340, 'Test', '7', 137, 762513, '', 'VIGOUR', 0, 56, 'contextual', 1, '2021-12-28 04:49:04', '2021-12-27 23:19:04', '2021-12-27 23:19:04'),
(341, 'Test', '7', 137, 762513, '', 'DESIRE', 0, 42, 'contextual', 1, '2021-12-28 04:49:48', NULL, NULL),
(342, 'Test', '7', 137, 762513, '', 'MOTIVE', 0, 6, 'categorical', 1, '2021-12-28 04:49:56', NULL, NULL),
(343, 'Test', '7', 138, 762513, '', 'HORSE', 1, 3, 'contextual', 1, '2021-12-28 04:50:05', NULL, NULL),
(344, 'Test', '7', 139, 762513, '', 'EAGER', 0, 222, 'contextual', 1, '2021-12-28 04:53:50', NULL, NULL),
(345, 'Test', '7', 139, 762513, '', 'OPPRESS', 0, 28, 'categorical', 1, '2021-12-28 04:54:19', NULL, NULL),
(346, 'Test', '7', 140, 762513, '', 'FLAG', 1, 3, 'contextual', 1, '2021-12-28 04:54:25', NULL, NULL),
(347, 'Test', '7', NULL, 762513, '', '{\"words\":\"MEAT CAMP ARMY SHOES FUR WINE BAT\"}', NULL, 55, 'recall', 2, '2021-12-28 05:01:47', NULL, NULL),
(348, 'Test', '7', 121, 762513, '', 'PARTY', 1, 3, 'contextual', 2, '2021-12-28 05:01:52', NULL, NULL),
(349, 'Test', '7', 122, 762513, '', 'COLLEGE', 1, 7, 'contextual', 2, '2021-12-28 05:02:05', NULL, NULL),
(350, 'Test', '7', 123, 762513, '', 'LAKE', 1, 1, 'contextual', 2, '2021-12-28 05:02:09', NULL, NULL),
(351, 'Test', '7', 124, 762513, '', 'FUR', 1, 4, 'contextual', 2, '2021-12-28 05:02:15', NULL, NULL),
(352, 'Test', '7', 125, 762513, '', 'SHOES', 1, 2, 'contextual', 2, '2021-12-28 05:02:19', NULL, NULL),
(353, 'Test', '7', 126, 762513, '', 'WINE', 1, 2, 'contextual', 2, '2021-12-28 05:02:24', NULL, NULL),
(354, 'Test', '7', 127, 762513, '', 'BODY', 1, 3, 'contextual', 2, '2021-12-28 05:02:28', NULL, NULL),
(355, 'Test', '7', 128, 762513, '', 'CHILD', 1, 2, 'contextual', 2, '2021-12-28 05:02:32', NULL, NULL),
(356, 'Test', '7', 129, 762513, '', 'DOLL', 1, 1, 'contextual', 2, '2021-12-28 05:02:35', NULL, NULL),
(357, 'Test', '7', 130, 762513, '', 'ELABORATION', 1, 8, 'contextual', 2, '2021-12-28 05:04:20', NULL, NULL),
(358, 'Test', '7', 131, 762513, '', 'ARMY', 1, 2, 'contextual', 2, '2021-12-28 05:04:24', NULL, NULL),
(359, 'Test', '7', 132, 762513, '', 'PRISONER', 1, 7, 'contextual', 2, '2021-12-28 05:04:33', NULL, NULL),
(360, 'Test', '7', 133, 762513, '', 'CAMP', 1, 2, 'contextual', 2, '2021-12-28 05:04:38', NULL, NULL),
(361, 'Test', '7', 134, 762513, '', 'MEAT', 1, 2, 'contextual', 2, '2021-12-28 05:04:43', NULL, NULL),
(362, 'Test', '7', 135, 762513, '', 'STORM', 1, 12, 'contextual', 2, '2021-12-28 05:04:56', NULL, NULL),
(363, 'Test', '7', 136, 762513, '', 'PRISON', 0, 9, 'contextual', 2, '2021-12-28 05:05:18', NULL, NULL),
(364, 'Test', '7', 136, 762513, '', 'TOWER', 1, 5, 'categorical', 2, '2021-12-28 05:05:24', NULL, NULL),
(365, 'Test', '7', 137, 762513, '', 'YEARING', 0, 12, 'contextual', 2, '2021-12-28 05:05:38', NULL, NULL),
(366, 'Test', '7', 137, 762513, '', 'HANKERING', 1, 27, 'categorical', 2, '2021-12-28 05:06:07', NULL, NULL),
(367, 'Test', '7', 138, 762513, '', 'HORSE', 1, 2, 'contextual', 2, '2021-12-28 05:06:11', NULL, NULL),
(368, 'Test', '7', 139, 762513, '', 'SUPPRESSION', 1, 9, 'contextual', 2, '2021-12-28 05:06:22', NULL, NULL),
(369, 'Test', '7', 140, 762513, '', 'FLAG', 1, 9, 'contextual', 2, '2021-12-28 05:06:35', NULL, NULL),
(370, 'Test', '10', NULL, 898499, '', '{\"words\":\"WINTER SHORE SEA\"}', NULL, 101, 'recall', 1, '2021-12-28 05:34:45', NULL, NULL),
(371, 'Test', '10', 181, 898499, '', 'WINTER', 1, 3, 'contextual', 1, '2021-12-28 05:35:18', NULL, NULL),
(372, 'Test', '10', 182, 898499, '', 'LAWN', 1, 3, 'contextual', 1, '2021-12-28 05:35:24', NULL, NULL),
(373, 'Test', '10', 183, 898499, '', 'STREET', 1, 5, 'contextual', 1, '2021-12-28 05:35:31', NULL, NULL),
(374, 'Test', '10', 184, 898499, '', 'SHORE', 1, 8, 'contextual', 1, '2021-12-28 05:35:41', NULL, NULL),
(375, 'Test', '10', 185, 898499, '', 'CHRISTMAS', 1, 5, 'contextual', 1, '2021-12-28 05:35:49', NULL, NULL),
(376, 'Test', '10', 186, 898499, '', 'DOLLAR', 1, 3, 'contextual', 1, '2021-12-28 05:35:54', NULL, NULL),
(377, 'Test', '10', 187, 898499, '', 'ARROW', 1, 3, 'contextual', 1, '2021-12-28 05:35:59', NULL, NULL),
(378, 'Test', '10', 188, 898499, '', 'BOOKS', 0, 5, 'contextual', 1, '2021-12-28 05:36:06', NULL, NULL),
(379, 'Test', '10', 188, 898499, '', 'BOOK', 1, 2, 'categorical', 1, '2021-12-28 05:36:10', NULL, NULL),
(380, 'Test', '10', 189, 898499, '', 'SUGAR', 0, 12, 'contextual', 1, '2021-12-28 05:36:24', NULL, NULL),
(381, 'Test', '10', 189, 898499, '', 'FOOD', 0, 53, 'categorical', 1, '2021-12-28 05:37:18', NULL, NULL),
(382, 'Test', '10', 190, 898499, '', 'PENCIL', 1, 8, 'contextual', 1, '2021-12-28 05:37:29', NULL, NULL),
(383, 'Test', '10', 191, 898499, '', 'CORD', 1, 4, 'contextual', 1, '2021-12-28 05:37:35', NULL, NULL),
(384, 'Test', '10', 192, 898499, '', 'FLESH', 1, 5, 'contextual', 1, '2021-12-28 05:37:42', NULL, NULL),
(385, 'Test', '10', 193, 898499, '', 'TOY', 1, 4, 'contextual', 1, '2021-12-28 05:37:49', NULL, NULL),
(386, 'Test', '10', 194, 898499, '', 'PROFESSOR', 1, 6, 'contextual', 1, '2021-12-28 05:37:57', NULL, NULL),
(387, 'Test', '10', 195, 898499, '', 'HOSPITAL', 1, 9, 'contextual', 1, '2021-12-28 05:38:08', NULL, NULL),
(388, 'Test', '10', 196, 898499, '', 'FURNITURE', 1, 7, 'contextual', 1, '2021-12-28 05:38:17', NULL, NULL),
(389, 'Test', '10', 197, 898499, '', 'EQUAL', 1, 9, 'contextual', 1, '2021-12-28 05:38:28', NULL, NULL),
(390, 'Test', '10', 198, 898499, '', 'WAY', 0, 16, 'contextual', 1, '2021-12-28 05:38:47', NULL, NULL),
(391, 'Test', '10', 198, 898499, '', 'ROUTE', 0, 9, 'categorical', 1, '2021-12-28 05:38:57', NULL, NULL),
(392, 'Test', '10', 200, 898499, '', 'UNBELIEVER', 1, 7, 'contextual', 1, '2021-12-28 05:39:06', NULL, NULL),
(393, 'Test', '10', 199, 898499, '', 'MONEY', 1, 2, 'contextual', 1, '2021-12-28 05:39:11', NULL, NULL),
(394, 'Test', '10', NULL, 898499, '', '{\"words\":\"WINTER STREET SHORE LAWN CHRISTMAS\"}', NULL, 73, 'recall', 2, '2021-12-28 06:11:59', NULL, NULL),
(395, 'Test', '10', 181, 898499, '', 'WINTER', 1, 3, 'contextual', 2, '2021-12-28 06:12:04', NULL, NULL),
(396, 'Test', '10', 182, 898499, '', 'LAWN', 1, 2, 'contextual', 2, '2021-12-28 06:16:35', NULL, NULL),
(397, 'Test', '10', 183, 898499, '', 'STREET', 1, 6, 'contextual', 2, '2021-12-28 06:16:44', NULL, NULL),
(398, 'Test', '10', 184, 898499, '', 'SHORE', 1, 3, 'contextual', 2, '2021-12-28 06:16:49', NULL, NULL),
(399, 'Test', '10', 185, 898499, '', 'CHRISTMAS', 1, 4, 'contextual', 2, '2021-12-28 06:16:56', NULL, NULL),
(400, 'Test', '10', 186, 898499, '', 'DOLLAR', 1, 2, 'contextual', 2, '2021-12-28 06:17:00', NULL, NULL),
(401, 'Test', '10', 187, 898499, '', 'ARROW', 1, 2, 'contextual', 2, '2021-12-28 06:17:04', NULL, NULL),
(402, 'Test', '10', 188, 898499, '', 'BOOK', 1, 3, 'contextual', 2, '2021-12-28 06:17:10', NULL, NULL),
(403, 'Test', '10', 189, 898499, '', 'CANDY', 1, 3, 'contextual', 2, '2021-12-28 06:17:15', NULL, NULL),
(404, 'Test', '10', 190, 898499, '', 'PENCIL', 1, 3, 'contextual', 2, '2021-12-28 06:17:20', NULL, NULL),
(405, 'Test', '10', 191, 898499, '', 'CORD', 1, 2, 'contextual', 2, '2021-12-28 06:17:24', NULL, NULL),
(406, 'Test', '10', 192, 898499, '', 'FLESH', 1, 4, 'contextual', 2, '2021-12-28 06:17:31', NULL, NULL),
(407, 'Test', '10', 193, 898499, '', 'TOY', 1, 6, 'contextual', 2, '2021-12-28 06:17:39', NULL, NULL),
(408, 'Test', '10', 194, 898499, '', 'PROFESSOR', 1, 3, 'contextual', 2, '2021-12-28 06:17:44', NULL, NULL),
(409, 'Test', '10', 195, 898499, '', 'HOSPITAL', 1, 5, 'contextual', 2, '2021-12-28 06:17:51', NULL, NULL),
(410, 'Test', '10', 196, 898499, '', 'FURNITURE', 1, 5, 'contextual', 2, '2021-12-28 06:17:58', NULL, NULL),
(411, 'Test', '10', 197, 898499, '', 'EQUAL', 1, 11, 'contextual', 2, '2021-12-28 06:18:12', NULL, NULL),
(412, 'Test', '10', 198, 898499, '', 'STEPS', 1, 3, 'contextual', 2, '2021-12-28 06:18:18', NULL, NULL),
(413, 'Test', '10', 199, 898499, '', 'MONEY', 1, 2, 'contextual', 2, '2021-12-28 06:18:22', NULL, NULL),
(414, 'Test', '10', 200, 898499, '', 'UNBELIEVER', 1, 11, 'contextual', 2, '2021-12-28 06:18:35', NULL, NULL),
(415, 'Test', '18', NULL, 471596, '', '{\"words\":\"LEFT RIGHT NORTH 2-MILES 3-MILES EUGENE\"}', NULL, 56, 'recall', 1, '2021-12-28 09:05:12', NULL, NULL),
(416, 'Test', '18', 400, 471596, '', 'NORTH', 1, 7, 'contextual', 1, '2021-12-28 09:05:21', NULL, NULL),
(417, 'Test', '18', 401, 471596, '', 'ROUTE-805', 1, 5, 'contextual', 1, '2021-12-28 09:05:32', NULL, NULL),
(418, 'Test', '18', 402, 471596, '', 'OLIVE', 1, 5, 'contextual', 1, '2021-12-28 09:05:39', NULL, NULL),
(419, 'Test', '18', 403, 471596, '', '2-MILES', 1, 4, 'contextual', 1, '2021-12-28 09:05:45', NULL, NULL),
(420, 'Test', '18', 404, 471596, '', 'RIGHT', 1, 4, 'contextual', 1, '2021-12-28 09:05:52', NULL, NULL),
(421, 'Test', '18', 405, 471596, '', 'OAK', 1, 1, 'contextual', 1, '2021-12-28 09:05:55', NULL, NULL),
(422, 'Test', '18', 406, 471596, '', '3-MILES', 1, 5, 'contextual', 1, '2021-12-28 09:06:03', NULL, NULL),
(423, 'Test', '18', 407, 471596, '', 'LEFT', 1, 7, 'contextual', 1, '2021-12-28 09:06:12', NULL, NULL),
(424, 'Test', '18', 408, 471596, '', 'EUGENE', 1, 8, 'contextual', 1, '2021-12-28 09:06:22', NULL, NULL),
(425, 'Test', '18', 409, 471596, '', '4TH-TRAFFIC-LIGHT', 1, 12, 'contextual', 1, '2021-12-28 09:06:37', NULL, NULL),
(426, 'Test', '18', 410, 471596, '', 'RIGHT', 1, 2, 'contextual', 1, '2021-12-28 09:06:50', NULL, NULL),
(427, 'Test', '18', 411, 471596, '', 'CLAY', 1, 3, 'contextual', 1, '2021-12-28 09:06:56', NULL, NULL),
(428, 'Test', '18', 412, 471596, '', 'LEFT', 1, 5, 'contextual', 1, '2021-12-28 09:07:03', NULL, NULL),
(429, 'Test', '18', 413, 471596, '', 'CORONELL', 0, 3, 'contextual', 1, '2021-12-28 09:07:08', NULL, NULL),
(430, 'Test', '18', 413, 471596, '', 'CORNELL', 1, 6, 'categorical', 1, '2021-12-28 09:07:15', NULL, NULL),
(431, 'Test', '18', 414, 471596, '', '1-MILE', 1, 14, 'contextual', 1, '2021-12-28 09:07:31', NULL, NULL),
(432, 'Test', '18', 415, 471596, '', '640', 1, 4, 'contextual', 1, '2021-12-28 09:07:39', NULL, NULL),
(433, 'Test', '18', NULL, 471596, '', '{\"words\":\"LEFT RIGHT\"}', NULL, 12, 'recall', 2, '2021-12-28 09:17:17', NULL, NULL),
(434, 'Test', '18', 400, 471596, '', 'NORTH', 1, 3, 'contextual', 2, '2021-12-28 09:17:23', NULL, NULL),
(435, 'Test', '18', 401, 471596, '', 'ROUTE-805', 1, 9, 'contextual', 2, '2021-12-28 09:17:35', NULL, NULL),
(436, 'Test', '18', 402, 471596, '', 'OLIVE', 1, 4, 'contextual', 2, '2021-12-28 09:17:42', NULL, NULL),
(437, 'Test', '18', 403, 471596, '', '2-MILES', 1, 4, 'contextual', 2, '2021-12-28 09:17:48', NULL, NULL),
(438, 'Test', '18', 404, 471596, '', 'RIGHT', 1, 4, 'contextual', 2, '2021-12-28 09:17:54', NULL, NULL),
(439, 'Test', '18', 405, 471596, '', 'OAK', 1, 2, 'contextual', 2, '2021-12-28 09:17:58', NULL, NULL),
(440, 'Test', '18', 406, 471596, '', '3-MILES', 1, 5, 'contextual', 2, '2021-12-28 09:18:05', NULL, NULL),
(441, 'Test', '18', 407, 471596, '', 'LEFT', 1, 5, 'contextual', 2, '2021-12-28 09:18:12', NULL, NULL),
(442, 'Test', '18', 408, 471596, '', 'EUGENE', 1, 5, 'contextual', 2, '2021-12-28 09:18:18', NULL, NULL),
(443, 'Test', '18', 409, 471596, '', '4TH-TRAFFIC-LIGHT', 1, 17, 'contextual', 2, '2021-12-28 09:18:38', NULL, NULL),
(444, 'Test', '18', 410, 471596, '', 'RIGHT', 1, 4, 'contextual', 2, '2021-12-28 09:18:44', NULL, NULL),
(445, 'Test', '18', 411, 471596, '', 'CLAY', 1, 5, 'contextual', 2, '2021-12-28 09:18:51', NULL, NULL),
(446, 'Test', '18', 412, 471596, '', 'LEFT', 1, 8, 'contextual', 2, '2021-12-28 09:19:02', NULL, NULL),
(447, 'Test', '18', 413, 471596, '', 'CORNELL', 1, 4, 'contextual', 2, '2021-12-28 09:19:09', NULL, NULL),
(448, 'Test', '18', 414, 471596, '', '1-MILE', 1, 6, 'contextual', 2, '2021-12-28 09:19:17', NULL, NULL),
(449, 'Test', '18', 415, 471596, '', '640', 1, 2, 'contextual', 2, '2021-12-28 09:19:25', NULL, NULL),
(450, 'Test', '17', NULL, 318458, '', '{\"words\":null}', NULL, 5, 'recall', 1, '2021-12-28 11:13:33', NULL, NULL),
(451, 'Test', '17', 349, 318458, '', 'LEFT', 1, 10, 'contextual', 1, '2021-12-28 11:13:45', NULL, NULL),
(452, 'Test', '17', 350, 318458, '', 'MOUNTAINVIEW', 1, 8, 'contextual', 1, '2021-12-28 11:13:55', NULL, NULL),
(453, 'Test', '17', 351, 318458, '', 'ONE-MILE', 1, 6, 'contextual', 1, '2021-12-28 11:14:04', NULL, NULL),
(454, 'Test', '17', 352, 318458, '', 'RIGHT', 1, 9, 'contextual', 1, '2021-12-28 11:14:15', NULL, NULL),
(455, 'Test', '17', 353, 318458, '', 'NORTH-58', 0, 8, 'contextual', 1, '2021-12-28 11:14:25', NULL, NULL),
(456, 'Test', '17', 353, 318458, '', 'NORTH-58TH', 1, 10, 'categorical', 1, '2021-12-28 11:14:37', NULL, NULL),
(457, 'Test', '17', 354, 318458, '', 'LEFT', 1, 4, 'contextual', 1, '2021-12-28 11:14:43', NULL, NULL),
(458, 'Test', '17', 355, 318458, '', 'DOUBLETREE', 1, 6, 'contextual', 1, '2021-12-28 11:14:51', NULL, NULL),
(459, 'Test', '17', 356, 318458, '', 'RIGHT', 1, 3, 'contextual', 1, '2021-12-28 11:14:57', NULL, NULL),
(460, 'Test', '17', 357, 318458, '', '101-SOUTH', 1, 8, 'contextual', 1, '2021-12-28 11:15:07', NULL, NULL),
(461, 'Test', '17', 358, 318458, '', 'ROUTE-101', 1, 14, 'contextual', 1, '2021-12-28 11:15:23', NULL, NULL),
(462, 'Test', '17', 359, 318458, '', 'EXIT-19', 1, 5, 'contextual', 1, '2021-12-28 11:15:30', NULL, NULL),
(463, 'Test', '17', 360, 318458, '', '3RD-INTERSECTION', 0, 10, 'contextual', 1, '2021-12-28 11:15:42', NULL, NULL),
(464, 'Test', '17', 360, 318458, '', 'LEFT', 1, 13, 'categorical', 1, '2021-12-28 11:15:57', NULL, NULL),
(465, 'Test', '17', 361, 318458, '', 'CAMBELBACK', 1, 7, 'contextual', 1, '2021-12-28 11:16:05', NULL, NULL),
(466, 'Test', '17', 362, 318458, '', '3RD-INTERSECTION', 1, 11, 'contextual', 1, '2021-12-28 11:16:18', NULL, NULL),
(467, 'Test', '17', 363, 318458, '', 'LEFT', 1, 4, 'contextual', 1, '2021-12-28 11:16:24', NULL, NULL),
(468, 'Test', '17', 364, 318458, '', 'SUNSHINE', 1, 4, 'contextual', 1, '2021-12-28 11:16:30', NULL, NULL),
(469, 'Test', '17', 365, 318458, '', '2-MILES', 1, 5, 'contextual', 1, '2021-12-28 11:16:37', NULL, NULL),
(470, 'Test', '17', 366, 318458, '', 'RIGHT', 1, 5, 'contextual', 1, '2021-12-28 11:16:44', NULL, NULL),
(471, 'Test', '17', 367, 318458, '', 'VAN-BUREN', 1, 11, 'contextual', 1, '2021-12-28 11:16:57', NULL, NULL),
(472, 'Test', '17', 368, 318458, '', '1.3-MILES', 1, 14, 'contextual', 1, '2021-12-28 11:17:14', NULL, NULL),
(473, 'Test', '17', 369, 318458, '', 'RIGHT', 1, 3, 'contextual', 1, '2021-12-28 11:17:19', NULL, NULL),
(474, 'Test', 'Booster', NULL, 680334, '', '{\"words\":\"BREAKFAST GROCERY MOTHER CAR LAUNDRY\"}', NULL, 36, 'recall', 1, '2021-12-28 11:26:39', NULL, NULL),
(475, 'Test', 'Booster', 128, 680334, '', 'POST-OFFICE', 1, 5, 'contextual', 1, '2021-12-28 11:26:46', NULL, NULL),
(476, 'Test', 'Booster', 129, 680334, '', 'CAR', 1, 2, 'contextual', 1, '2021-12-28 11:26:50', NULL, NULL),
(477, 'Test', 'Booster', 130, 680334, '', 'SHIRTS', 1, 3, 'contextual', 1, '2021-12-28 11:26:56', NULL, NULL),
(478, 'Test', 'Booster', 131, 680334, '', 'LUNCH', 0, 7, 'contextual', 1, '2021-12-28 11:27:05', NULL, NULL),
(479, 'Test', 'Booster', 131, 680334, '', 'BREAK-FAST', 0, 5, 'categorical', 1, '2021-12-28 11:27:11', NULL, NULL),
(480, 'Test', 'Booster', 132, 680334, '', 'PLANTS', 1, 12, 'contextual', 1, '2021-12-28 11:27:25', NULL, NULL),
(481, 'Test', 'Booster', 133, 680334, '', 'BED', 1, 3, 'contextual', 1, '2021-12-28 11:27:30', NULL, NULL),
(482, 'Test', 'Booster', 134, 680334, '', 'LAUNDRY', 1, 3, 'contextual', 1, '2021-12-28 11:27:36', NULL, NULL),
(483, 'Test', 'Booster', 135, 680334, '', 'ELECTRICITY', 0, 5, 'contextual', 1, '2021-12-28 11:27:43', NULL, NULL),
(484, 'Test', 'Booster', 135, 680334, '', 'ELECTRIC', 1, 3, 'categorical', 1, '2021-12-28 11:27:48', NULL, NULL),
(485, 'Test', 'Booster', 136, 680334, '', 'MOTHER', 1, 5, 'contextual', 1, '2021-12-28 11:27:55', NULL, NULL),
(486, 'Test', 'Booster', 137, 680334, '', 'GROCERY', 1, 3, 'contextual', 1, '2021-12-28 11:28:00', NULL, NULL),
(487, 'Test', 'Booster', NULL, 680334, '', '{\"words\":\"POST-OFFICE BREAKFAST\"}', NULL, 29, 'recall', 2, '2021-12-28 11:35:52', NULL, NULL),
(488, 'Test', 'Booster', 128, 680334, '', 'POST-OFFICE', 1, 5, 'contextual', 2, '2021-12-28 11:36:00', NULL, NULL),
(489, 'Test', 'Booster', 129, 680334, '', 'CAR', 1, 2, 'contextual', 2, '2021-12-28 11:36:04', NULL, NULL),
(490, 'Test', 'Booster', 130, 680334, '', 'SHIRTS', 1, 3, 'contextual', 2, '2021-12-28 11:36:10', NULL, NULL),
(491, 'Test', 'Booster', 131, 680334, '', 'BREAKFAST', 1, 4, 'contextual', 2, '2021-12-28 11:36:16', NULL, NULL),
(492, 'Test', 'Booster', 132, 680334, '', 'PLANTS', 1, 3, 'contextual', 2, '2021-12-28 11:36:21', NULL, NULL),
(493, 'Test', 'Booster', 133, 680334, '', 'BED', 1, 9, 'contextual', 2, '2021-12-28 11:36:32', NULL, NULL),
(494, 'Test', 'Booster', 134, 680334, '', 'LAUNDRY', 1, 3, 'contextual', 2, '2021-12-28 11:36:38', NULL, NULL),
(495, 'Test', 'Booster', 135, 680334, '', 'ELECTRIC', 1, 5, 'contextual', 2, '2021-12-28 11:36:44', NULL, NULL),
(496, 'Test', 'Booster', 136, 680334, '', 'MOTHER', 1, 3, 'contextual', 2, '2021-12-28 11:36:49', NULL, NULL),
(497, 'Test', 'Booster', 137, 680334, '', 'GROCERY', 1, 227, 'contextual', 2, '2021-12-28 11:40:38', NULL, NULL),
(498, 'Test', '7', NULL, 526190, '', '{\"words\":null}', NULL, 9, 'recall', 1, '2021-12-29 04:46:54', NULL, NULL),
(499, 'Test', '7', 121, 526190, '', 'PARTY', 1, 16, 'contextual', 1, '2021-12-29 04:47:11', NULL, NULL),
(500, 'Test', '7', 122, 526190, '', 'COLLEGE', 1, 6, 'contextual', 1, '2021-12-29 06:06:35', NULL, NULL),
(501, 'Test', '7', 123, 526190, '', 'LAKE', 1, 1, 'contextual', 1, '2021-12-29 06:06:39', NULL, NULL),
(502, 'Test', '7', 124, 526190, '', 'FUR', 1, 5, 'contextual', 1, '2021-12-29 06:06:46', NULL, NULL),
(503, 'Test', '7', 125, 526190, '', 'SHOES', 1, 2, 'contextual', 1, '2021-12-29 06:06:50', NULL, NULL),
(504, 'Test', '7', 126, 526190, '', 'WINE', 1, 6, 'contextual', 1, '2021-12-29 06:07:11', NULL, NULL),
(505, 'Test', '7', 127, 526190, '', 'BODY', 1, 2, 'contextual', 1, '2021-12-29 06:07:15', NULL, NULL),
(506, 'Test', '7', 128, 526190, '', 'CHILD', 1, 2, 'contextual', 1, '2021-12-29 06:07:19', NULL, NULL),
(507, 'Test', '7', 129, 526190, '', 'DOLL', 1, 3, 'contextual', 1, '2021-12-29 06:07:24', NULL, NULL),
(508, 'Test', '7', 130, 526190, '', 'ELABORATION', 1, 7, 'contextual', 1, '2021-12-29 06:07:33', NULL, NULL),
(509, 'Test', '7', 131, 526190, '', 'ARMY', 1, 1, 'contextual', 1, '2021-12-29 06:07:36', NULL, NULL),
(510, 'Test', '7', 132, 526190, '', 'PRISONER', 1, 4, 'contextual', 1, '2021-12-29 06:07:43', NULL, NULL),
(511, 'Test', '7', 133, 526190, '', 'CAMP', 1, 1, 'contextual', 1, '2021-12-29 06:07:46', NULL, NULL),
(512, 'Test', '7', 134, 526190, '', 'FOOD', 0, 7, 'contextual', 1, '2021-12-29 06:07:55', NULL, NULL),
(513, 'Test', '7', 134, 526190, '', 'MEAT', 1, 2, 'categorical', 1, '2021-12-29 06:07:59', NULL, NULL),
(514, 'Test', '7', 135, 526190, '', 'STORM', 1, 6, 'contextual', 1, '2021-12-29 06:08:07', NULL, NULL),
(515, 'Test', '7', 136, 526190, '', 'TOWER', 1, 4, 'contextual', 1, '2021-12-29 06:08:37', NULL, NULL),
(516, 'Test', '7', 137, 526190, '', 'HANKERING', 1, 3, 'contextual', 1, '2021-12-29 06:08:43', NULL, NULL),
(517, 'Test', '7', 138, 526190, '', 'HORSE', 1, 2, 'contextual', 1, '2021-12-29 06:08:47', NULL, NULL),
(518, 'Test', '7', 139, 526190, '', 'SUPPRESSION', 1, 5, 'contextual', 1, '2021-12-29 06:08:55', NULL, NULL),
(519, 'Test', '7', 140, 526190, '', 'FLAG', 1, 5, 'contextual', 1, '2021-12-29 06:09:03', NULL, NULL),
(520, 'test3', 'booster', NULL, 474114, '', '{\"words\":null}', NULL, 4, 'recall', 1, '2022-01-11 10:29:41', NULL, NULL),
(521, 'test3', 'booster', NULL, 474114, '', '{\"words\":null}', NULL, 6, 'recall', 1, '2022-01-11 10:35:07', NULL, NULL),
(522, 'te1', '6', NULL, 984111, '', '{\"words\":null}', NULL, 7, 'recall', 1, '2022-01-19 11:03:14', NULL, NULL),
(523, 't1', '17', NULL, 768124, '', '{\"words\":\"BANK DOG STAMP CLEANING CLEAN LUNCH WORK MORTGAGE NEWSPAPER GIFT FIELD\"}', NULL, 95, 'recall', 1, '2022-01-20 08:07:54', NULL, NULL),
(524, 't1', '17', 21, 768124, '', 'BANK', 1, 4, 'contextual', 1, '2022-01-20 08:08:00', NULL, NULL),
(525, 't1', '17', 22, 768124, '', 'SCHOOL', 1, 5, 'contextual', 1, '2022-01-20 08:08:08', NULL, NULL),
(526, 't1', '17', 23, 768124, '', 'DOG', 1, 4, 'contextual', 1, '2022-01-20 08:08:16', NULL, NULL),
(527, 't1', '17', 24, 768124, '', 'BILL', 0, 3, 'contextual', 1, '2022-01-20 08:08:21', NULL, NULL),
(528, 't1', '17', 24, 768124, '', 'MORTGAGE', 1, 7, 'categorical', 1, '2022-01-20 08:08:29', NULL, NULL),
(529, 't1', '17', 25, 768124, '', 'GROCERY', 0, 13, 'contextual', 1, '2022-01-20 08:08:45', NULL, NULL),
(530, 't1', '17', 25, 768124, '', 'STAMPS', 1, 31, 'categorical', 1, '2022-01-20 08:09:17', NULL, NULL),
(531, 't1', '17', 26, 768124, '', 'CLEANING', 1, 5, 'contextual', 1, '2022-01-20 08:09:25', NULL, NULL),
(532, 't1', '17', 27, 768124, '', 'LUNCH', 1, 3, 'contextual', 1, '2022-01-20 08:09:33', NULL, NULL),
(533, 't1', '17', 28, 768124, '', 'LAWN', 1, 4, 'contextual', 1, '2022-01-20 08:09:38', NULL, NULL),
(534, 't1', '17', 29, 768124, '', 'GIFT', 1, 2, 'contextual', 1, '2022-01-20 08:09:43', NULL, NULL),
(535, 't1', '17', 30, 768124, '', 'NEWSPAPER', 1, 4, 'contextual', 1, '2022-01-20 08:09:49', NULL, NULL),
(537, 'te1', '4', NULL, 954733, NULL, '{\"words\":\"STONE COIN ARM FRIEND PRISON FIRE\"}', NULL, 32, 'recall', 1, '2022-01-21 06:17:50', NULL, NULL),
(538, 'te1', '4', 61, 954733, '1', 'PRISON', 1, 78, 'contextual', 1, '2022-01-21 06:19:09', NULL, NULL),
(539, 'te1', '4', 62, 954733, '1', 'FRIEND', 1, 4, 'contextual', 1, '2022-01-21 06:19:16', NULL, NULL),
(540, 'te1', '4', 63, 954733, '1', 'COIN', 1, 7, 'contextual', 1, '2022-01-21 06:19:25', NULL, NULL),
(541, 'te1', '4', 64, 954733, '1', 'STONE', 1, 3, 'contextual', 1, '2022-01-21 06:19:29', NULL, NULL),
(542, 'te1', '4', 65, 954733, '1', 'TOBACCO', 1, 8, 'contextual', 1, '2022-01-21 06:19:40', NULL, NULL),
(543, 'te1', '4', 66, 954733, '1', 'ARM', 1, 1, 'contextual', 1, '2022-01-21 06:19:46', NULL, NULL),
(544, 'te1', '4', 67, 954733, '1', 'FIRE', 1, 2, 'contextual', 1, '2022-01-21 06:19:54', NULL, NULL),
(545, 'te1', '4', 68, 954733, '1', 'BLANDNESS', 1, 12, 'contextual', 1, '2022-01-21 06:20:09', NULL, NULL),
(546, 'te1', '4', 69, 954733, '1', 'DOCTOR', 1, 8, 'contextual', 1, '2022-01-21 06:20:19', NULL, NULL),
(547, 'te1', '4', 70, 954733, '1', 'REPLACEMENT', 1, 6, 'contextual', 1, '2022-01-21 06:20:28', NULL, NULL),
(548, 'te1', '4', 71, 954733, '1', 'EGO', 1, 4, 'contextual', 1, '2022-01-21 06:20:36', NULL, NULL),
(549, 'te1', '4', 72, 954733, '1', 'LAD', 1, 13, 'contextual', 1, '2022-01-21 06:20:51', NULL, NULL),
(550, 'te1', '4', 73, 954733, '1', 'CHIEF', 1, 8, 'contextual', 1, '2022-01-21 06:21:01', NULL, NULL),
(551, 'te1', '4', 74, 954733, '1', 'SAIL', 0, 2, 'contextual', 1, '2022-01-21 06:21:04', NULL, NULL),
(552, 'te1', '4', 74, 954733, '1', 'BOARD', 1, 5, 'categorical', 1, '2022-01-21 06:21:11', NULL, NULL),
(553, 'te1', '4', 75, 954733, '1', 'SHIP', 1, 4, 'contextual', 1, '2022-01-21 06:21:17', NULL, NULL),
(554, 'te1', '4', 76, 954733, '1', 'MEADOW', 1, 2, 'contextual', 1, '2022-01-21 06:21:28', NULL, NULL),
(555, 'te1', '4', 77, 954733, '1', 'CABIN', 1, 7, 'contextual', 1, '2022-01-21 06:21:37', NULL, NULL),
(556, 'te1', '4', 78, 954733, '1', 'PAPER', 1, 4, 'contextual', 1, '2022-01-21 06:21:43', NULL, NULL),
(557, 'te1', '4', 79, 954733, '1', 'WINDOWS', 1, 5, 'contextual', 1, '2022-01-21 06:21:50', NULL, NULL),
(558, 'te1', '4', 80, 954733, '1', 'HOME', 1, 5, 'contextual', 1, '2022-01-21 06:21:58', NULL, NULL),
(559, 'tr1', '4', NULL, 437974, NULL, '{\"words\":\"CIRCLE AVENUE CONTEXT SKY TROOPS\"}', NULL, 35, 'recall', 1, '2022-01-21 12:16:10', NULL, NULL),
(560, 'tr1', '4', 61, 437974, '2', 'CIRCLE', 1, 3, 'contextual', 1, '2022-01-21 12:16:15', NULL, NULL),
(561, 'tr1', '4', 62, 437974, '2', 'AVENUE', 1, 3, 'contextual', 1, '2022-01-21 12:16:21', NULL, NULL),
(562, 'tr1', '4', 63, 437974, '2', 'BOULDER', 1, 4, 'contextual', 1, '2022-01-21 12:16:27', NULL, NULL),
(563, 'tr1', '4', 64, 437974, '2', 'GENTLEMAN', 1, 3, 'contextual', 1, '2022-01-21 12:16:34', NULL, NULL),
(564, 'tr1', '4', 65, 437974, '2', 'CORNER', 1, 7, 'contextual', 1, '2022-01-21 12:16:44', NULL, NULL),
(565, 'tr1', '4', 66, 437974, '2', 'HOUSE', 1, 4, 'contextual', 1, '2022-01-21 12:16:50', NULL, NULL),
(566, 'tr1', '4', 67, 437974, '2', 'LIBRARY', 1, 8, 'contextual', 1, '2022-01-21 12:16:59', NULL, NULL),
(567, 'tr1', '4', 68, 437974, '2', 'QUEEN', 1, 3, 'contextual', 1, '2022-01-21 12:17:04', NULL, NULL),
(568, 'tr1', '4', 69, 437974, '2', 'DRESS', 1, 2, 'contextual', 1, '2022-01-21 12:17:09', NULL, NULL),
(569, 'tr1', '4', 70, 437974, '2', 'PICTURE', 1, 4, 'contextual', 1, '2022-01-21 12:17:14', NULL, NULL),
(570, 'tr1', '4', 71, 437974, '2', 'FLOWER', 1, 8, 'contextual', 1, '2022-01-21 12:17:24', NULL, NULL),
(571, 'tr1', '4', 72, 437974, '2', 'MOUNTAIN', 1, 4, 'contextual', 1, '2022-01-21 12:17:30', NULL, NULL),
(572, 'tr1', '4', 73, 437974, '2', 'STRING', 1, 9, 'contextual', 1, '2022-01-21 12:17:42', NULL, NULL),
(573, 'tr1', '4', 74, 437974, '2', 'TROOPS', 1, 5, 'contextual', 1, '2022-01-21 12:17:49', NULL, NULL),
(574, 'tr1', '4', 75, 437974, '2', 'WOODS', 1, 4, 'contextual', 1, '2022-01-21 12:17:55', NULL, NULL),
(575, 'tr1', '4', 76, 437974, '2', 'EXCLUSION', 1, 8, 'contextual', 1, '2022-01-21 12:18:05', NULL, NULL),
(576, 'tr1', '4', 77, 437974, '2', 'CONTEXT', 1, 5, 'contextual', 1, '2022-01-21 12:18:12', NULL, NULL),
(577, 'tr1', '4', 78, 437974, '2', 'ADVERSITY', 1, 7, 'contextual', 1, '2022-01-21 12:18:21', NULL, NULL),
(578, 'tr1', '4', 79, 437974, '2', 'SKY', 1, 4, 'contextual', 1, '2022-01-21 12:18:27', NULL, NULL),
(579, 'tr2', '1', NULL, 237577, NULL, '{\"words\":\"BANK SCHOOL DOG WALK MORTGAGE STAMPS CLEANING LUNCH LAWN GIFT NEWSPAPER\"}', NULL, 80, 'recall', 1, '2022-01-21 12:27:02', NULL, NULL),
(580, 'tr2', '1', 21, 237577, '3', 'BANK', 1, 2, 'contextual', 1, '2022-01-21 12:27:07', NULL, NULL),
(581, 'tr2', '1', 22, 237577, '3', 'SCHOOL', 1, 3, 'contextual', 1, '2022-01-21 12:27:13', NULL, NULL),
(582, 'tr2', '1', 23, 237577, '3', 'DOG', 1, 2, 'contextual', 1, '2022-01-21 12:27:17', NULL, NULL),
(583, 'tr2', '1', 24, 237577, '3', 'MORTAGAGE', 0, 5, 'contextual', 1, '2022-01-21 12:27:25', NULL, NULL),
(584, 'tr2', '1', 24, 237577, '3', 'MORTGAGE', 1, 3, 'categorical', 1, '2022-01-21 12:27:29', NULL, NULL),
(585, 'tr2', '1', 25, 237577, '3', 'STAMPS', 1, 4, 'contextual', 1, '2022-01-21 12:27:35', NULL, NULL),
(586, 'tr2', '1', 26, 237577, '3', 'CLEANING', 1, 2, 'contextual', 1, '2022-01-21 12:27:40', NULL, NULL),
(587, 'tr2', '1', 27, 237577, '3', 'LUNCH', 1, 2, 'contextual', 1, '2022-01-21 12:27:45', NULL, NULL),
(588, 'tr2', '1', 28, 237577, '3', 'LAWN', 1, 3, 'contextual', 1, '2022-01-21 12:27:50', NULL, NULL),
(589, 'tr2', '1', 29, 237577, '3', 'GIFT', 1, 3, 'contextual', 1, '2022-01-21 12:27:55', NULL, NULL),
(590, 'tr2', '1', 30, 237577, '3', 'NEWSPAPER', 1, 4, 'contextual', 1, '2022-01-21 12:28:02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A', '2021-01-29 22:09:37', '2021-01-29 22:10:01', NULL),
(2, 'B', '2021-01-29 22:09:46', '2021-01-29 22:09:46', '2021-02-22 06:00:00'),
(3, 'test', '2021-02-17 20:40:10', '2021-02-17 20:40:17', '2021-02-17 20:40:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trainer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` text COLLATE utf8mb4_unicode_ci,
  `sessions` text COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('SA','TA','','') COLLATE utf8mb4_unicode_ci DEFAULT 'TA',
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `speciality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `trainer_id`, `name`, `email`, `category`, `sessions`, `email_verified_at`, `password`, `role`, `location`, `address`, `phone_number`, `speciality`, `remember_token`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(1, NULL, 'Admin', 'admin@pinpointt.com', NULL, '', NULL, '$2y$10$N7LqSTegjLX4l9J26BAnj.t02.SPjZHZkX.a2Q5.M71tmmZOfIIgy', 'SA', NULL, NULL, NULL, NULL, NULL, '2021-01-06 03:42:13', '2021-01-06 03:42:13', NULL, 1),
(2, NULL, 'Nancy Moore', 'nbmoore@kesslerfoundation.org', NULL, '', NULL, '$2y$10$NOF0wqZJNqLzkZMgs3aQguaxCzIAoJgZoKG7fIp9koApydQe2JlTm', 'TA', NULL, NULL, NULL, NULL, NULL, '2021-06-04 20:32:55', '2021-07-20 22:07:17', NULL, 1),
(3, NULL, 'Nancy Chiaravalloti', 'nchiaravalloti@kesslerfoundation.org', NULL, '', NULL, '$2y$10$Uyo58zAt0veyXRkc6/xlAu1mEJUfgJN80X/9HIDhg/LL8kbNVM3gy', 'TA', NULL, NULL, NULL, NULL, NULL, '2021-06-04 20:33:35', '2021-07-20 22:07:17', NULL, 1),
(4, NULL, 'Angela Smith', 'asmith@kesslerfoundation.org', NULL, '', NULL, '$2y$10$fRzfa/Ua5a3BOE5XvKfak.bOowzBVlsGv//v1QGoiqw73E2Snwk4.', 'TA', NULL, NULL, NULL, NULL, NULL, '2021-06-04 20:34:02', '2021-07-20 22:07:18', NULL, 1),
(5, NULL, 'nancyc home', 'nancyc72@gmail.com', '[\"1\",\"2\"]', '[{\"stories\":[\"1\",\"2\",\"3\",\"4\"],\"contextual\":[\"14\",\"15\",\"16\"],\"general\":null,\"booster\":null}]', NULL, '$2y$10$N7LqSTegjLX4l9J26BAnj.t02.SPjZHZkX.a2Q5.M71tmmZOfIIgy', 'TA', NULL, NULL, NULL, NULL, NULL, '2021-07-19 05:23:30', '2021-07-19 05:34:10', NULL, 1),
(6, NULL, 'Ally Edwards', 'aedwards@kesslerfoundation.org', NULL, '', NULL, '$2y$10$HMAbDjM73qhMvhijb1KQeut0eMmqk3ntVMHCX8ItbM8/tFvkSIoNe', 'TA', NULL, NULL, NULL, NULL, NULL, '2021-07-19 20:32:28', '2022-01-18 02:13:58', NULL, 1),
(7, NULL, 'Balaji Jayaraman', 'bala@pinpointt.com', NULL, '', NULL, '$2y$10$kISN7SIWjr.n1FFBaklCjuCtgXfdxP0NxwYg0EstAydH9etVO8MRG', 'TA', NULL, NULL, NULL, NULL, NULL, '2021-07-20 17:47:33', '2021-07-20 19:42:43', NULL, 1),
(8, NULL, 'Saipriya', 'saipriya@proisc.com', '[\"1\",\"2\",\"3\",\"4\"]', '[{\"stories\":[\"1\",\"2\",\"3\"],\"contextual\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\"],\"general\":[\"1\",\"2\"],\"booster\":[\"2\",\"3\"]}]', NULL, '$2y$10$N7LqSTegjLX4l9J26BAnj.t02.SPjZHZkX.a2Q5.M71tmmZOfIIgy', 'TA', NULL, NULL, NULL, NULL, NULL, '2021-12-29 04:30:15', '2022-01-19 00:53:47', NULL, 1),
(48, NULL, 'sai', 'sai@gmail.com', '[\"1\",\"2\"]', '[{\"stories\":[\"1\",\"2\",\"4\",\"5\",\"6\"],\"contextual\":[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\"],\"general\":null,\"booster\":null}]', NULL, '$2y$10$N7LqSTegjLX4l9J26BAnj.t02.SPjZHZkX.a2Q5.M71tmmZOfIIgy', 'TA', NULL, NULL, NULL, NULL, NULL, '2022-01-13 01:25:49', '2022-01-19 02:02:12', NULL, 1),
(62, NULL, 'new', 'newa@gmail.com', '[\"1\",\"2\",\"3\"]', '[{\"stories\":[\"5\",\"6\",\"7\"],\"contextual\":[\"9\",\"10\"],\"general\":[\"18\"],\"booster\":null}]', NULL, '$2y$10$MT7GUKAKF.7GG6MzPzHXCe0Es1zicR/ICz6qAItrFv6U8KKWEOBSC', 'TA', NULL, NULL, NULL, NULL, NULL, '2022-01-13 07:06:27', '2022-01-13 07:06:27', NULL, 1),
(65, NULL, 'test', 'test@gmail.com', '[\"1\",\"2\",\"3\"]', '[{\"stories\":[\"3\"],\"contextual\":[\"10\"],\"general\":[\"17\"],\"booster\":null}]', NULL, '$2y$10$Yq8mGGPznFN6OARM3zCW5OJ9YPrxySDl7ij5DtJTLyMsy0KtZe8CG', 'TA', NULL, NULL, NULL, NULL, NULL, '2022-01-18 01:46:09', '2022-01-18 01:46:09', NULL, 1),
(66, NULL, 'test3', 'test@test.com', '[\"1\"]', '[{\"stories\":[\"2\"],\"contextual\":null,\"general\":null,\"booster\":null}]', NULL, '$2y$10$tf.t7jeIobpmXOBVMXMiz.Q.pYjgNQmevPZwB8/gn4S6dTLtHEnBC', 'TA', NULL, NULL, NULL, NULL, NULL, '2022-01-18 01:46:42', '2022-01-18 01:46:42', NULL, 1),
(67, NULL, 'test3', 'test3@gmail.com', '[\"1\",\"3\"]', '[{\"stories\":[\"2\",\"3\"],\"contextual\":null,\"general\":[\"17\",\"18\"],\"booster\":null}]', NULL, '$2y$10$Ev9H5K3BYAIPx7XSxaptHuBzm0.XUiPCtpEeCJfRZYMQdw9b.nkjy', 'TA', NULL, NULL, NULL, NULL, NULL, '2022-01-18 02:06:06', '2022-01-18 02:06:06', NULL, 1),
(68, NULL, 'testnew', 'new@gmail.com', '[\"1\",\"2\",\"3\",\"4\"]', '[{\"stories\":[\"2\",\"3\",\"4\",\"5\",\"6\"],\"contextual\":[\"2\",\"3\",\"4\"],\"general\":[\"1\",\"2\"],\"booster\":[\"2\",\"3\"]}]', NULL, '$2y$10$4aaJs3OuFxrcw34XtowwY.gt38HEYdzPuL/ygzBW0A5RnjhZX7qlK', 'TA', NULL, NULL, NULL, NULL, NULL, '2022-01-21 05:59:50', '2022-01-21 05:59:50', NULL, 1);

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
  `categorical_cue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `words` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('directions','shopping','to do') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `story_id`, `word`, `contextual_cue`, `question`, `categorical_cue`, `words`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'APPLE', 'Mr. Jones pulled a fresh APPLE from a tree', 'Mr. Jones pulled a fresh APPLE from a tree', 'It is a type of fruit', '', NULL, '2020-12-27 03:15:36', '2020-12-27 03:15:36', NULL),
(2, 1, 'BLOSSOM', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning $$ sitting on a $$ drinking $$', 'Flowers do this in the spring', '', NULL, '2020-12-27 03:16:34', '2020-12-27 03:16:34', NULL),
(3, 1, 'BUTTER', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a $$ drinking $$', 'It is something you can spread on toast', '', NULL, '2020-12-27 03:17:08', '2020-12-27 03:17:08', NULL),
(4, 1, 'CHAIR', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking $$', 'It is a piece of furniture', '', NULL, '2020-12-27 03:18:06', '2020-12-27 03:18:06', NULL),
(5, 1, 'COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'It is a beverage', '', NULL, '2020-12-27 03:18:37', '2020-12-27 03:18:37', NULL),
(6, 1, 'DIAMOND', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a $$ using a pitch $$ and a $$', 'It is a gem', '', NULL, '2020-12-27 03:19:21', '2020-12-27 03:19:21', NULL),
(7, 1, 'FACTORY', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch $$ and a $$', 'A place where things are made', '', NULL, '2020-12-27 03:19:50', '2020-12-27 03:19:50', NULL),
(8, 1, 'FORK', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a $$', 'It is a utensil', '', NULL, '2020-12-27 03:20:26', '2020-12-27 03:20:26', NULL),
(9, 1, 'HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Jones was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'It is a tool', '', NULL, '2020-12-27 03:20:59', '2020-12-27 03:20:59', NULL),
(10, 1, 'KISS', 'On Saturdays his mother would KISS him and send him to the MARKET', 'On Saturdays his mother would KISS him and send him to the $$', 'It is something couples do', '', NULL, '2020-12-27 03:21:43', '2020-12-27 03:21:43', NULL),
(11, 1, 'MARKET', 'On Saturdays his mother would KISS him and send him to the MARKET', 'On Saturdays his mother would KISS him and send him to the MARKET', 'A place to buy food', '', NULL, '2020-12-27 03:22:15', '2020-12-27 03:22:15', NULL),
(12, 1, 'PALACE', 'The goods there reminded him of a PALACE', 'The goods there reminded him of a PALACE', 'A place where royalty live', '', NULL, '2020-12-27 03:23:11', '2020-12-27 03:23:11', NULL),
(13, 1, 'PRIEST', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'On Sundays he went to church to visit his PRIEST making sure to get a $$ in the first row', 'A clergyman', '', NULL, '2020-12-27 03:23:52', '2020-12-27 03:23:52', NULL),
(14, 1, 'SEAT', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'A place to sit', '', NULL, '2020-12-27 03:24:20', '2020-12-27 03:24:20', NULL),
(15, 1, 'STEAM', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Jones’ father left boarding a STEAM boat with a $$ that his $$ had bought', 'It’s formed when water boils', '', NULL, '2020-12-27 03:25:10', '2020-12-27 03:25:10', NULL),
(16, 1, 'TICKET', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his $$ had bought', 'A piece of paper', '', NULL, '2020-12-27 03:26:15', '2020-12-27 03:26:15', NULL),
(17, 1, 'WIFE', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Jones’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'A significant other', '', NULL, '2020-12-27 03:26:42', '2020-12-27 03:26:42', NULL),
(18, 1, 'BETRAYAL', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using $$ in their personal lives led him to mistrust members of the opposite $$', 'Type of disloyalty', '', NULL, '2020-12-27 03:27:28', '2020-12-27 03:27:28', NULL),
(19, 1, 'DISCRETION', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite $$', 'being secretive', '', NULL, '2020-12-27 03:28:11', '2020-12-27 03:28:11', NULL),
(20, 1, 'GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'A classification of male or female', '', NULL, '2020-12-27 03:28:41', '2020-12-27 03:28:41', NULL),
(21, 2, 'ANIMAL', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', 'Mr. Smith saw an ANIMAL painting $$ on a $$', 'Classification of a species', '', NULL, '2020-12-27 03:32:34', '2020-12-27 03:32:34', NULL),
(22, 2, 'BLOOD', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', 'Mr. Smith saw an ANIMAL painting BLOOD on a $$', 'Liquid inside a body', '', NULL, '2020-12-27 03:33:16', '2020-12-27 03:33:16', NULL),
(23, 2, 'BUILDING', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', 'Mr. Smith saw an ANIMAL painting BLOOD on a BUILDING', 'An architectural structure', '', NULL, '2020-12-27 03:33:58', '2020-12-27 03:33:58', NULL),
(24, 2, 'CELLAR', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west $$ leaving at $$', 'A floor in a house', '', NULL, '2020-12-27 03:34:49', '2020-12-27 03:34:49', NULL),
(25, 2, 'COAST', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at $$', 'Where water meets land', '', NULL, '2020-12-27 03:35:32', '2020-12-27 03:35:32', NULL),
(26, 2, 'DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'A time of day', '', NULL, '2020-12-27 03:36:08', '2020-12-27 03:36:08', NULL),
(27, 2, 'ENGINE', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', 'As the ENGINE pulled the train through the $$, Mr. Smith walked down a long $$', 'A part of a car', '', NULL, '2020-12-27 03:36:59', '2020-12-27 03:36:59', NULL),
(28, 2, 'FOREST', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long $$', 'Trees grow here', '', NULL, '2020-12-27 03:37:31', '2020-12-27 03:37:31', NULL),
(29, 2, 'HALL', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', 'As the ENGINE pulled the train through the FOREST, Mr. Smith walked down a long HALL', 'A passageway', '', NULL, '2020-12-27 03:38:17', '2020-12-27 03:38:17', NULL),
(30, 2, 'KING', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', 'He entered a room and saw a KING pig reading a Playboy $$', 'Royalty', '', NULL, '2020-12-27 03:39:00', '2020-12-27 03:39:00', NULL),
(31, 2, 'MAGAZINE', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', 'A publication', '', NULL, '2020-12-27 03:39:33', '2020-12-27 03:39:33', NULL),
(32, 2, 'OFFICER', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'The pig summoned an OFFICER who was peeling a $$ in the $$', 'An occupation', '', NULL, '2020-12-27 03:40:07', '2020-12-27 03:40:07', NULL),
(33, 2, 'POTATO', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'The pig summoned an OFFICER who was peeling a POTATO in the $$', 'A vegetable', '', NULL, '2020-12-27 03:40:38', '2020-12-27 03:40:38', NULL),
(34, 2, 'SEA', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'A body of water', '', NULL, '2020-12-27 03:41:15', '2020-12-27 03:41:15', NULL),
(35, 2, 'STAR', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a $$ growing $$', 'A body in the atmosphere', '', NULL, '2020-12-27 03:41:53', '2020-12-27 03:41:53', NULL),
(36, 2, 'TEMPLE', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing $$', 'A religious place', '', NULL, '2020-12-27 03:42:19', '2020-12-27 03:42:19', NULL),
(37, 2, 'WHEAT', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', 'A STAR witness sentenced Mr. Smith to spend the rest of his life in a TEMPLE growing WHEAT', 'It is a crop', '', NULL, '2020-12-27 03:42:49', '2020-12-27 03:42:49', NULL),
(38, 2, 'DISCLOSURE', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Mrs. Smith heard this DISCLOSURE and showed little $$ towards the $$ of the trial', 'A revelation', '', NULL, '2020-12-27 03:43:23', '2020-12-27 03:43:23', NULL),
(39, 2, 'BEREAVEMENT', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the $$ of the trial', 'An emotional stage', '', NULL, '2020-12-27 03:43:54', '2020-12-27 03:43:54', NULL),
(40, 2, 'OUTCOME', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Mrs. Smith heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Results', '', NULL, '2020-12-27 03:44:25', '2020-12-27 03:44:25', NULL),
(41, 3, 'PARTY', 'Peter went to a PARTY at the COLLEGE near the LAKE', 'Peter went to a PARTY at the $$ near the $$', 'A gathering', '', NULL, '2020-12-27 03:46:57', '2020-12-27 03:46:57', NULL),
(42, 3, 'COLLEGE', 'Peter went to a PARTY at the COLLEGE near the LAKE', 'Peter went to a PARTY at the COLLEGE near the $$', 'A learning institution', '', NULL, '2020-12-27 03:47:21', '2020-12-27 03:47:21', NULL),
(43, 3, 'LAKE', 'Peter went to a PARTY at the COLLEGE near the LAKE', 'Peter went to a PARTY at the COLLEGE near the LAKE', 'A body of water', '', NULL, '2020-12-27 03:47:49', '2020-12-27 03:47:49', NULL),
(44, 3, 'FUR', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', 'There he met a girl that was wearing a nice FUR and high-heeled $$', 'A material', '', NULL, '2020-12-27 03:48:21', '2020-12-27 03:48:21', NULL),
(45, 3, 'SHOES', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', 'Article of clothing', '', NULL, '2020-12-27 03:48:57', '2020-12-27 03:48:57', NULL),
(46, 3, 'WINE', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Although she was drinking WINE she had a $$ of a young $$ who should be at home playing with a $$', 'A beverage', '', NULL, '2020-12-27 03:49:44', '2020-12-27 03:49:44', NULL),
(47, 3, 'BODY', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Although she was drinking WINE she had a BODY of a young $$ who should be at home playing with a $$', 'Figure', '', NULL, '2020-12-27 03:50:10', '2020-12-27 03:50:10', NULL),
(48, 3, 'CHILD', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a $$', 'Type of human', '', NULL, '2020-12-27 03:50:40', '2020-12-27 03:50:40', NULL),
(49, 3, 'DOLL', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'A child’s toy', '', NULL, '2020-12-27 03:51:07', '2020-12-27 03:51:07', NULL),
(50, 3, 'ELABORATION', 'Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY', 'Since Peter was a military man the girl asked for an ELABORATION of his days in the $$', 'More information', '', NULL, '2020-12-27 03:51:34', '2020-12-27 03:51:34', NULL),
(51, 3, 'ARMY', 'Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY', 'Since Peter was a military man the girl asked for an ELABORATION of his days in the ARMY', 'Military', '', NULL, '2020-12-27 03:52:00', '2020-12-27 03:52:00', NULL),
(52, 3, 'PRISONER', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'He told her of his days as a PRISONER in a concentration $$ where there was very little $$ to eat', 'form of hostage', '', NULL, '2020-12-27 03:52:36', '2020-12-27 03:52:36', NULL),
(53, 3, 'CAMP', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little $$ to eat', 'A place', '', NULL, '2020-12-27 03:53:06', '2020-12-27 03:53:06', NULL),
(54, 3, 'MEAT', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'Food product', '', NULL, '2020-12-27 03:53:36', '2020-12-27 03:53:36', NULL),
(55, 3, 'STORM', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'One night as a STORM approached he noticed there was no guard in the $$ and had a $$ to escape on a $$ he could steal from the stable', 'Weather condition', '', NULL, '2020-12-27 03:54:14', '2020-12-27 03:54:14', NULL),
(56, 3, 'TOWER', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a $$ to escape on a $$ he could steal from the stable', 'An architectural structure', '', NULL, '2020-12-27 03:54:46', '2020-12-27 03:54:46', NULL),
(57, 3, 'HANKERING', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a $$ he could steal from the stable', 'Yearning', '', NULL, '2020-12-27 03:55:13', '2020-12-27 03:55:13', NULL),
(58, 3, 'HORSE', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'A type of animal', '', NULL, '2020-12-27 03:55:43', '2020-12-27 03:55:43', NULL),
(59, 3, 'SUPPRESSION', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the $$ flew freely', 'To keep down', '', NULL, '2020-12-27 03:56:13', '2020-12-27 03:56:13', NULL),
(60, 3, 'FLAG', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', 'A symbol', '', NULL, '2020-12-27 03:56:43', '2020-12-27 03:56:43', NULL),
(61, 4, 'PRISON', 'Cindy was a girl who went to PRISON to visit her FRIEND', 'Cindy was a girl who went to PRISON to visit her $$', 'An architectural structure', '', NULL, '2020-12-27 03:57:59', '2020-12-27 03:57:59', NULL),
(62, 4, 'FRIEND', 'Cindy was a girl who went to PRISON to visit her FRIEND', 'Cindy was a girl who went to PRISON to visit her FRIEND', 'A type of relationship', '', NULL, '2020-12-27 03:58:26', '2020-12-27 03:58:26', NULL),
(63, 4, 'COIN', 'While there she kept putting a COIN on the table in effort to buy a STONE.', 'While there she kept putting a COIN on the table in effort to buy a $$.', 'A round object', '', NULL, '2020-12-27 03:58:53', '2020-12-27 03:58:53', NULL),
(64, 4, 'STONE', 'While there she kept putting a COIN on the table in effort to buy a STONE', 'While there she kept putting a COIN on the table in effort to buy a STONE', 'A hard material', '', NULL, '2020-12-27 03:59:19', '2020-12-27 03:59:19', NULL),
(65, 4, 'TOBACCO', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'Using the TOBACCO at the end of her $$ she tried to start her hair on $$', 'An agricultural product', '', NULL, '2020-12-27 03:59:51', '2020-12-27 03:59:51', NULL),
(66, 4, 'ARM', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'Using the TOBACCO at the end of her ARM she tried to start her hair on $$', 'A part of the body', '', NULL, '2020-12-27 04:00:23', '2020-12-27 04:00:23', NULL),
(67, 4, 'FIRE', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'It is hot', '', NULL, '2020-12-27 04:00:51', '2020-12-27 04:00:51', NULL),
(68, 4, 'BLANDNESS', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a $$ would be the perfect $$ for her sagging $$', 'Lacking flavor', '', NULL, '2020-12-27 04:01:18', '2020-12-27 04:01:18', NULL),
(69, 4, 'DOCTOR', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect $$ for her sagging $$', 'A profession', '', NULL, '2020-12-27 04:01:43', '2020-12-27 04:01:43', NULL),
(70, 4, 'REPLACEMENT', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging $$', 'Type of change', '', NULL, '2020-12-27 04:02:12', '2020-12-27 04:02:12', NULL),
(71, 4, 'EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Self esteem', '', NULL, '2020-12-27 04:02:34', '2020-12-27 04:02:34', NULL),
(72, 4, 'LAD', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her $$ so they could $$ a $$ and sail through a $$', 'male', '', NULL, '2020-12-27 04:03:28', '2020-12-27 04:03:28', NULL),
(73, 4, 'CHIEF', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could $$ a $$ and sail through a $$', 'A rank', '', NULL, '2020-12-27 04:03:57', '2020-12-27 04:03:57', NULL),
(74, 4, 'BOARD', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a $$ and sail through a $$', 'form of wood', '', NULL, '2020-12-27 04:04:24', '2020-12-27 04:04:24', NULL),
(75, 4, 'SHIP', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a $$', 'A form of transportation', '', NULL, '2020-12-27 04:04:51', '2020-12-27 04:04:51', NULL),
(76, 4, 'MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'A place', '', NULL, '2020-12-27 04:05:24', '2020-12-27 04:05:24', NULL),
(77, 4, 'CABIN', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'On the other side they would find a CABIN made of $$ with $$ in the floor which would be their perfect $$', 'An architectural structure', '', NULL, '2020-12-27 04:05:56', '2020-12-27 04:05:56', NULL),
(78, 4, 'PAPER', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'On the other side they would find a CABIN made of PAPER with $$ in the floor which would be their perfect $$', 'A material', '', NULL, '2020-12-27 04:06:21', '2020-12-27 04:06:21', NULL),
(79, 4, 'WINDOWS', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect $$', 'Openings', '', NULL, '2020-12-27 04:06:55', '2020-12-27 04:06:55', NULL),
(80, 4, 'HOME', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'A place', '', NULL, '2020-12-27 04:07:19', '2020-12-27 04:07:52', NULL),
(81, 5, 'APPLE', 'Mr. Harris pulled a fresh APPLE from a tree', 'Mr. Harris pulled a fresh APPLE from a tree', 'It is a type of fruit', '', NULL, '2020-12-26 21:45:36', '2020-12-26 21:45:36', NULL),
(82, 5, 'BLOSSOM', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning $$ sitting on a $$ drinking $$', 'Flowers do this in the spring', '', NULL, '2020-12-26 21:46:34', '2020-12-26 21:46:34', NULL),
(83, 5, 'BUTTER', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a $$ drinking $$', 'It is something you can spread on toast', '', NULL, '2020-12-26 21:47:08', '2020-12-26 21:47:08', NULL),
(84, 5, 'CHAIR', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking $$', 'It is a piece of furniture', '', NULL, '2020-12-26 21:48:06', '2020-12-26 21:48:06', NULL),
(85, 5, 'COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'This made him think of his childhood summers with the flowers in BLOSSOM and his mother churning BUTTER sitting on a CHAIR drinking COFFEE', 'It is a beverage', '', NULL, '2020-12-26 21:48:37', '2020-12-26 21:48:37', NULL),
(86, 5, 'DIAMOND', 'Mr. Harris was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Harris was a DIAMOND salesman but his father worked in a $$ using a pitch $$ and a $$', 'It is a gem', '', NULL, '2020-12-26 21:49:21', '2020-12-26 21:49:21', NULL),
(87, 5, 'FACTORY', 'Mr. Harris was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Harris was a DIAMOND salesman but his father worked in a FACTORY using a pitch $$ and a $$', 'A place where things are made', '', NULL, '2020-12-26 21:49:50', '2020-12-26 21:49:50', NULL),
(88, 5, 'FORK', 'Mr. Harris was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Harris was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a $$', 'It is a utensil', '', NULL, '2020-12-26 21:50:26', '2020-12-26 21:50:26', NULL),
(89, 5, 'HAMMER', 'Mr. Harris was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'Mr. Harris was a DIAMOND salesman but his father worked in a FACTORY using a pitch FORK and a HAMMER', 'It is a tool', '', NULL, '2020-12-26 21:50:59', '2020-12-26 21:50:59', NULL),
(90, 5, 'KISS', 'On Saturdays his mother would KISS him and send him to the MARKET', 'On Saturdays his mother would KISS him and send him to the $$', 'It is something couples do', '', NULL, '2020-12-26 21:51:43', '2020-12-26 21:51:43', NULL),
(91, 5, 'MARKET', 'On Saturdays his mother would KISS him and send him to the MARKET', 'On Saturdays his mother would KISS him and send him to the MARKET', 'A place to buy food', '', NULL, '2020-12-26 21:52:15', '2020-12-26 21:52:15', NULL),
(92, 5, 'PALACE', 'The goods there reminded him of a PALACE', 'The goods there reminded him of a PALACE', 'A place where royalty live', '', NULL, '2020-12-26 21:53:11', '2020-12-26 21:53:11', NULL),
(93, 5, 'PRIEST', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'On Sundays he went to church to visit his PRIEST making sure to get a $$ in the first row', 'A clergyman', '', NULL, '2020-12-26 21:53:52', '2020-12-26 21:53:52', NULL),
(94, 5, 'SEAT', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'On Sundays he went to church to visit his PRIEST making sure to get a SEAT in the first row', 'A place to sit', '', NULL, '2020-12-26 21:54:20', '2020-12-26 21:54:20', NULL),
(95, 5, 'STEAM', 'One day Mr. Harris’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Harris’ father left boarding a STEAM boat with a $$ that his $$ had bought', 'It’s formed when water boils', '', NULL, '2020-12-26 21:55:10', '2020-12-26 21:55:10', NULL),
(96, 5, 'TICKET', 'One day Mr. Harris’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Harris’ father left boarding a STEAM boat with a TICKET that his $$ had bought', 'A piece of paper', '', NULL, '2020-12-26 21:56:15', '2020-12-26 21:56:15', NULL),
(97, 5, 'WIFE', 'One day Mr. Harris’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'One day Mr. Harris’ father left boarding a STEAM boat with a TICKET that his WIFE had bought', 'A significant other', '', NULL, '2020-12-26 21:56:42', '2020-12-26 21:56:42', NULL),
(98, 5, 'BETRAYAL', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using $$ in their personal lives led him to mistrust members of the opposite $$', 'Type of disloyalty', '', NULL, '2020-12-26 21:57:28', '2020-12-26 21:57:28', NULL),
(99, 5, 'DISCRETION', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite $$', 'being secretive', '', NULL, '2020-12-26 21:58:11', '2020-12-26 21:58:11', NULL),
(100, 5, 'GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'Her BETRAYAL by not using DISCRETION in their personal lives led him to mistrust members of the opposite GENDER', 'A classification of male or female', '', NULL, '2020-12-26 21:58:41', '2020-12-26 21:58:41', NULL),
(101, 6, 'ANIMAL', 'Mr. David saw an ANIMAL painting BLOOD on a BUILDING', 'Mr. David saw an ANIMAL painting $$ on a $$', 'Classification of a species', '', NULL, '2020-12-26 22:02:34', '2020-12-26 22:02:34', NULL),
(102, 6, 'BLOOD', 'Mr. David saw an ANIMAL painting BLOOD on a BUILDING', 'Mr. David saw an ANIMAL painting BLOOD on a $$', 'Liquid inside a body', '', NULL, '2020-12-26 22:03:16', '2020-12-26 22:03:16', NULL),
(103, 6, 'BUILDING', 'Mr. David saw an ANIMAL painting BLOOD on a BUILDING', 'Mr. David saw an ANIMAL painting BLOOD on a BUILDING', 'An architectural structure', '', NULL, '2020-12-26 22:03:58', '2020-12-26 22:03:58', NULL),
(104, 6, 'CELLAR', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west $$ leaving at $$', 'A floor in a house', '', NULL, '2020-12-26 22:04:49', '2020-12-26 22:04:49', NULL),
(105, 6, 'COAST', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at $$', 'Where water meets land', '', NULL, '2020-12-26 22:05:32', '2020-12-26 22:05:32', NULL),
(106, 6, 'DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'As he entered the CELLAR he saw pigs boarding a train for the west COAST leaving at DAWN', 'A time of day', '', NULL, '2020-12-26 22:06:08', '2020-12-26 22:06:08', NULL),
(107, 6, 'ENGINE', 'As the ENGINE pulled the train through the FOREST, Mr. David walked down a long HALL', 'As the ENGINE pulled the train through the $$, Mr. David walked down a long $$', 'A part of a car', '', NULL, '2020-12-26 22:06:59', '2020-12-26 22:06:59', NULL),
(108, 6, 'FOREST', 'As the ENGINE pulled the train through the FOREST, Mr. David walked down a long HALL', 'As the ENGINE pulled the train through the FOREST, Mr. David walked down a long $$', 'Trees grow here', '', NULL, '2020-12-26 22:07:31', '2020-12-26 22:07:31', NULL),
(109, 6, 'HALL', 'As the ENGINE pulled the train through the FOREST, Mr. David walked down a long HALL', 'As the ENGINE pulled the train through the FOREST, Mr. David walked down a long HALL', 'A passageway', '', NULL, '2020-12-26 22:08:17', '2020-12-26 22:08:17', NULL),
(110, 6, 'KING', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', 'He entered a room and saw a KING pig reading a Playboy $$', 'Royalty', '', NULL, '2020-12-26 22:09:00', '2020-12-26 22:09:00', NULL),
(111, 6, 'MAGAZINE', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', 'He entered a room and saw a KING pig reading a Playboy MAGAZINE', 'A publication', '', NULL, '2020-12-26 22:09:33', '2020-12-26 22:09:33', NULL),
(112, 6, 'OFFICER', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'The pig summoned an OFFICER who was peeling a $$ in the $$', 'An occupation', '', NULL, '2020-12-26 22:10:07', '2020-12-26 22:10:07', NULL),
(113, 6, 'POTATO', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'The pig summoned an OFFICER who was peeling a POTATO in the $$', 'A vegetable', '', NULL, '2020-12-26 22:10:38', '2020-12-26 22:10:38', NULL),
(114, 6, 'SEA', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'The pig summoned an OFFICER who was peeling a POTATO in the SEA', 'A body of water', '', NULL, '2020-12-26 22:11:15', '2020-12-26 22:11:15', NULL),
(115, 6, 'STAR', 'A STAR witness sentenced Mr. David to spend the rest of his life in a TEMPLE growing WHEAT', 'A STAR witness sentenced Mr. David to spend the rest of his life in a $$ growing $$', 'A body in the atmosphere', '', NULL, '2020-12-26 22:11:53', '2020-12-26 22:11:53', NULL),
(116, 6, 'TEMPLE', 'A STAR witness sentenced Mr. David to spend the rest of his life in a TEMPLE growing WHEAT', 'A STAR witness sentenced Mr. David to spend the rest of his life in a TEMPLE growing $$', 'A religious place', '', NULL, '2020-12-26 22:12:19', '2020-12-26 22:12:19', NULL),
(117, 6, 'WHEAT', 'A STAR witness sentenced Mr. David to spend the rest of his life in a TEMPLE growing WHEAT', 'A STAR witness sentenced Mr. David to spend the rest of his life in a TEMPLE growing WHEAT', 'It is a crop', '', NULL, '2020-12-26 22:12:49', '2020-12-26 22:12:49', NULL),
(118, 6, 'DISCLOSURE', 'Mrs. David heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Mrs. David heard this DISCLOSURE and showed little $$ towards the $$ of the trial', 'A revelation', '', NULL, '2020-12-26 22:13:23', '2020-12-26 22:13:23', NULL),
(119, 6, 'BEREAVEMENT', 'Mrs. David heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Mrs. David heard this DISCLOSURE and showed little BEREAVEMENT towards the $$ of the trial', 'An emotional stage', '', NULL, '2020-12-26 22:13:54', '2020-12-26 22:13:54', NULL),
(120, 6, 'OUTCOME', 'Mrs. David heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Mrs. David heard this DISCLOSURE and showed little BEREAVEMENT towards the OUTCOME of the trial', 'Results', '', NULL, '2020-12-26 22:14:25', '2020-12-26 22:14:25', NULL),
(121, 7, 'PARTY', 'Franklin went to a PARTY at the COLLEGE near the LAKE', 'Franklin went to a PARTY at the $$ near the $$', 'A gathering', '', NULL, '2020-12-26 22:16:57', '2020-12-26 22:16:57', NULL),
(122, 7, 'COLLEGE', 'Franklin went to a PARTY at the COLLEGE near the LAKE', 'Franklin went to a PARTY at the COLLEGE near the $$', 'A learning institution', '', NULL, '2020-12-26 22:17:21', '2020-12-26 22:17:21', NULL),
(123, 7, 'LAKE', 'Franklin went to a PARTY at the COLLEGE near the LAKE', 'Franklin went to a PARTY at the COLLEGE near the LAKE', 'A body of water', '', NULL, '2020-12-26 22:17:49', '2020-12-26 22:17:49', NULL),
(124, 7, 'FUR', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', 'There he met a girl that was wearing a nice FUR and high-heeled $$', 'A material', '', NULL, '2020-12-26 22:18:21', '2020-12-26 22:18:21', NULL),
(125, 7, 'SHOES', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', 'There he met a girl that was wearing a nice FUR and high-heeled SHOES', 'Article of clothing', '', NULL, '2020-12-26 22:18:57', '2020-12-26 22:18:57', NULL),
(126, 7, 'WINE', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Although she was drinking WINE she had a $$ of a young $$ who should be at home playing with a $$', 'A beverage', '', NULL, '2020-12-26 22:19:44', '2020-12-26 22:19:44', NULL),
(127, 7, 'BODY', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Although she was drinking WINE she had a BODY of a young $$ who should be at home playing with a $$', 'Figure', '', NULL, '2020-12-26 22:20:10', '2020-12-26 22:20:10', NULL),
(128, 7, 'CHILD', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a $$', 'Type of human', '', NULL, '2020-12-26 22:20:40', '2020-12-26 22:20:40', NULL),
(129, 7, 'DOLL', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'Although she was drinking WINE she had a BODY of a young CHILD who should be at home playing with a DOLL', 'A child’s toy', '', NULL, '2020-12-26 22:21:07', '2020-12-26 22:21:07', NULL),
(130, 7, 'ELABORATION', 'Since Franklin was a military man the girl asked for an ELABORATION of his days in the ARMY', 'Since Franklin was a military man the girl asked for an ELABORATION of his days in the $$', 'More information', '', NULL, '2020-12-26 22:21:34', '2020-12-26 22:21:34', NULL),
(131, 7, 'ARMY', 'Since Franklin was a military man the girl asked for an ELABORATION of his days in the ARMY', 'Since Franklin was a military man the girl asked for an ELABORATION of his days in the ARMY', 'Military', '', NULL, '2020-12-26 22:22:00', '2020-12-26 22:22:00', NULL),
(132, 7, 'PRISONER', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'He told her of his days as a PRISONER in a concentration $$ where there was very little $$ to eat', 'form of hostage', '', NULL, '2020-12-26 22:22:36', '2020-12-26 22:22:36', NULL),
(133, 7, 'CAMP', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little $$ to eat', 'A place', '', NULL, '2020-12-26 22:23:06', '2020-12-26 22:23:06', NULL),
(134, 7, 'MEAT', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'He told her of his days as a PRISONER in a concentration CAMP where there was very little MEAT to eat', 'Food product', '', NULL, '2020-12-26 22:23:36', '2020-12-26 22:23:36', NULL),
(135, 7, 'STORM', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'One night as a STORM approached he noticed there was no guard in the $$ and had a $$ to escape on a $$ he could steal from the stable', 'Weather condition', '', NULL, '2020-12-26 22:24:14', '2020-12-26 22:24:14', NULL),
(136, 7, 'TOWER', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a $$ to escape on a $$ he could steal from the stable', 'An architectural structure', '', NULL, '2020-12-26 22:24:46', '2020-12-26 22:24:46', NULL),
(137, 7, 'HANKERING', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a $$ he could steal from the stable', 'Yearning', '', NULL, '2020-12-26 22:25:13', '2020-12-26 22:25:13', NULL),
(138, 7, 'HORSE', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'One night as a STORM approached he noticed there was no guard in the TOWER and had a HANKERING to escape on a HORSE he could steal from the stable', 'A type of animal', '', NULL, '2020-12-26 22:25:43', '2020-12-26 22:25:43', NULL),
(139, 7, 'SUPPRESSION', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the $$ flew freely', 'To keep down', '', NULL, '2020-12-26 22:26:13', '2020-12-26 22:26:13', NULL),
(140, 7, 'FLAG', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', 'The SUPPRESSION of his freedom and dignity made him eager to be back in his country where the FLAG flew freely', 'A symbol', '', NULL, '2020-12-26 22:26:43', '2020-12-26 22:26:43', NULL),
(141, 8, 'PRISON', 'Nancy was a girl who went to PRISON to visit her FRIEND', 'Nancy was a girl who went to PRISON to visit her $$', 'An architectural structure', '', NULL, '2020-12-26 22:27:59', '2020-12-26 22:27:59', NULL),
(142, 8, 'FRIEND', 'Nancy was a girl who went to PRISON to visit her FRIEND', 'Nancy was a girl who went to PRISON to visit her FRIEND', 'A type of relationship', '', NULL, '2020-12-26 22:28:26', '2020-12-26 22:28:26', NULL),
(143, 8, 'COIN', 'While there she kept putting a COIN on the table in effort to buy a STONE.', 'While there she kept putting a COIN on the table in effort to buy a $$.', 'A round object', '', NULL, '2020-12-26 22:28:53', '2020-12-26 22:28:53', NULL),
(144, 8, 'STONE', 'While there she kept putting a COIN on the table in effort to buy a STONE', 'While there she kept putting a COIN on the table in effort to buy a STONE', 'A hard material', '', NULL, '2020-12-26 22:29:19', '2020-12-26 22:29:19', NULL),
(145, 8, 'TOBACCO', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'Using the TOBACCO at the end of her $$ she tried to start her hair on $$', 'An agricultural product', '', NULL, '2020-12-26 22:29:51', '2020-12-26 22:29:51', NULL),
(146, 8, 'ARM', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'Using the TOBACCO at the end of her ARM she tried to start her hair on $$', 'A part of the body', '', NULL, '2020-12-26 22:30:23', '2020-12-26 22:30:23', NULL),
(147, 8, 'FIRE', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'Using the TOBACCO at the end of her ARM she tried to start her hair on FIRE', 'It is hot', '', NULL, '2020-12-26 22:30:51', '2020-12-26 22:30:51', NULL),
(148, 8, 'BLANDNESS', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a $$ would be the perfect $$ for her sagging $$', 'Lacking flavor', '', NULL, '2020-12-26 22:31:18', '2020-12-26 22:31:18', NULL),
(149, 8, 'DOCTOR', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect $$ for her sagging $$', 'A profession', '', NULL, '2020-12-26 22:31:43', '2020-12-26 22:31:43', NULL),
(150, 8, 'REPLACEMENT', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging $$', 'Type of change', '', NULL, '2020-12-26 22:32:12', '2020-12-26 22:32:12', NULL),
(151, 8, 'EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Since this did not remove the BLANDNESS from her life she decided becoming a DOCTOR would be the perfect REPLACEMENT for her sagging EGO', 'Self esteem', '', NULL, '2020-12-26 22:32:34', '2020-12-26 22:32:34', NULL),
(152, 8, 'LAD', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her $$ so they could $$ a $$ and sail through a $$', 'male', '', NULL, '2020-12-26 22:33:28', '2020-12-26 22:33:28', NULL),
(153, 8, 'CHIEF', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could $$ a $$ and sail through a $$', 'A rank', '', NULL, '2020-12-26 22:33:57', '2020-12-26 22:33:57', NULL),
(154, 8, 'BOARD', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a $$ and sail through a $$', 'form of wood', '', NULL, '2020-12-26 22:34:24', '2020-12-26 22:34:24', NULL),
(155, 8, 'SHIP', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a $$', 'A form of transportation', '', NULL, '2020-12-26 22:34:51', '2020-12-26 22:34:51', NULL),
(156, 8, 'MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'Since this did not work she decided to find a good LAD to be her CHIEF so they could BOARD a SHIP and sail through a MEADOW', 'A place', '', NULL, '2020-12-26 22:35:24', '2020-12-26 22:35:24', NULL),
(157, 8, 'CABIN', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'On the other side they would find a CABIN made of $$ with $$ in the floor which would be their perfect $$', 'An architectural structure', '', NULL, '2020-12-26 22:35:56', '2020-12-26 22:35:56', NULL),
(158, 8, 'PAPER', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'On the other side they would find a CABIN made of PAPER with $$ in the floor which would be their perfect $$', 'A material', '', NULL, '2020-12-26 22:36:21', '2020-12-26 22:36:21', NULL),
(159, 8, 'WINDOWS', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect $$', 'Openings', '', NULL, '2020-12-26 22:36:55', '2020-12-26 22:36:55', NULL),
(160, 8, 'HOME', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'On the other side they would find a CABIN made of PAPER with WINDOWS in the floor which would be their perfect HOME', 'A place', '', NULL, '2020-12-26 22:37:19', '2020-12-26 22:37:52', NULL),
(161, 9, 'BIRD', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:34:39', '2020-12-26 23:34:39', NULL),
(162, 9, 'BEAST', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:35:48', '2020-12-26 23:35:48', NULL),
(163, 9, 'CUE', NULL, NULL, 'type of ball / hint', '', NULL, '2020-12-26 23:36:12', '2020-12-26 23:36:12', NULL),
(164, 9, 'CLOTHING', NULL, NULL, 'something you put on body', '', NULL, '2020-12-26 23:36:31', '2020-12-26 23:36:31', NULL),
(165, 9, 'DAMSEL', NULL, NULL, 'person/ fish', '', NULL, '2020-12-26 23:36:58', '2020-12-26 23:36:58', NULL),
(166, 9, 'ELEPHANT', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:37:24', '2020-12-26 23:37:24', NULL),
(167, 9, 'GRASS', NULL, NULL, 'something that grows', '', NULL, '2020-12-26 23:37:41', '2020-12-26 23:37:41', NULL),
(168, 9, 'GREEN', NULL, NULL, 'color', '', NULL, '2020-12-26 23:38:08', '2020-12-26 23:38:08', NULL),
(169, 9, 'JUDGE', NULL, NULL, 'a profession', '', NULL, '2020-12-26 23:38:30', '2020-12-26 23:38:30', NULL),
(170, 9, 'MACHINE', NULL, NULL, 'equipment', '', NULL, '2020-12-26 23:38:45', '2020-12-26 23:38:45', NULL),
(171, 9, 'OCEAN', NULL, NULL, 'body of water', '', NULL, '2020-12-26 23:39:02', '2020-12-26 23:39:02', NULL),
(172, 9, 'POLE', NULL, NULL, 'a stick', '', NULL, '2020-12-26 23:39:39', '2020-12-26 23:39:39', NULL),
(173, 9, 'ROCK', NULL, NULL, 'part of nature', '', NULL, '2020-12-26 23:39:54', '2020-12-26 23:39:54', NULL),
(174, 9, 'SQUARE', NULL, NULL, 'a shape', '', NULL, '2020-12-26 23:40:14', '2020-12-26 23:40:14', NULL),
(175, 9, 'TABLE', NULL, NULL, 'furniture', '', NULL, '2020-12-26 23:40:29', '2020-12-26 23:40:29', NULL),
(176, 9, 'WATER', NULL, NULL, 'liquid', '', NULL, '2020-12-26 23:40:43', '2020-12-26 23:40:43', NULL),
(177, 9, 'UNREALITY', NULL, NULL, 'futility', '', NULL, '2020-12-26 23:40:57', '2020-12-26 23:40:57', NULL),
(178, 9, 'ATROCITY', NULL, NULL, 'disaster', '', NULL, '2020-12-26 23:41:10', '2020-12-26 23:41:10', NULL),
(179, 9, 'DEDUCTION', NULL, NULL, 'form of reasoning', '', NULL, '2020-12-26 23:41:34', '2020-12-26 23:41:34', NULL),
(180, 9, 'FORETHOUGHT', NULL, NULL, 'planning', '', NULL, '2020-12-26 23:41:51', '2020-12-26 23:41:51', NULL),
(181, 10, 'WINTER', NULL, NULL, 'a season', '', NULL, '2020-12-26 23:47:03', '2020-12-26 23:47:03', NULL),
(182, 10, 'LAWN', NULL, NULL, 'property', '', NULL, '2020-12-26 23:47:17', '2020-12-26 23:47:17', NULL),
(183, 10, 'STREET', NULL, NULL, 'roadway', '', NULL, '2020-12-26 23:47:31', '2020-12-26 23:47:31', NULL),
(184, 10, 'SHORE', NULL, NULL, 'geographic region', '', NULL, '2020-12-26 23:47:47', '2020-12-26 23:47:47', NULL),
(185, 10, 'CHRISTMAS', NULL, NULL, 'holiday', '', NULL, '2020-12-26 23:47:59', '2020-12-26 23:47:59', NULL),
(186, 10, 'DOLLAR', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:48:12', '2020-12-26 23:48:12', NULL),
(187, 10, 'ARROW', NULL, NULL, 'weapon', '', NULL, '2020-12-26 23:48:25', '2020-12-26 23:48:25', NULL);
INSERT INTO `words` (`id`, `story_id`, `word`, `contextual_cue`, `question`, `categorical_cue`, `words`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(188, 10, 'BOOK', NULL, NULL, 'something you read', '', NULL, '2020-12-26 23:48:45', '2020-12-26 23:48:45', NULL),
(189, 10, 'CANDY', NULL, NULL, 'food', '', NULL, '2020-12-26 23:49:01', '2020-12-26 23:49:01', NULL),
(190, 10, 'PENCIL', NULL, NULL, 'something you write with', '', NULL, '2020-12-26 23:49:16', '2020-12-26 23:49:16', NULL),
(191, 10, 'CORD', NULL, NULL, 'electric conductor/music element', '', NULL, '2020-12-26 23:49:33', '2020-12-26 23:49:33', NULL),
(192, 10, 'FLESH', NULL, NULL, 'part of body', '', NULL, '2020-12-26 23:49:52', '2020-12-26 23:49:52', NULL),
(193, 10, 'TOY', NULL, NULL, 'object', '', NULL, '2020-12-26 23:50:06', '2020-12-26 23:50:06', NULL),
(194, 10, 'PROFESSOR', NULL, NULL, 'profession', '', NULL, '2020-12-26 23:50:22', '2020-12-26 23:50:22', NULL),
(195, 10, 'HOSPITAL', NULL, NULL, 'a building', '', NULL, '2020-12-26 23:50:35', '2020-12-26 23:50:35', NULL),
(196, 10, 'FURNITURE', NULL, NULL, 'household item', '', NULL, '2020-12-26 23:50:49', '2020-12-26 23:50:49', NULL),
(197, 10, 'EQUAL', NULL, NULL, 'sweetener/ mathematics sign', '', NULL, '2020-12-26 23:51:08', '2020-12-26 23:51:08', NULL),
(198, 10, 'STEPS', NULL, NULL, 'passageway', '', NULL, '2020-12-26 23:51:22', '2020-12-26 23:51:22', NULL),
(199, 10, 'MONEY', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:51:38', '2020-12-26 23:51:38', NULL),
(200, 10, 'UNBELIEVER', NULL, NULL, 'skeptic', '', NULL, '2020-12-26 23:53:23', '2020-12-26 23:53:23', NULL),
(201, 11, 'AUTOMOBILE', NULL, NULL, 'Transportation', '', NULL, '2020-12-26 23:55:51', '2020-12-26 23:55:51', NULL),
(202, 11, 'BOTTLE', NULL, NULL, 'Container', '', NULL, '2020-12-26 23:56:04', '2020-12-26 23:56:04', NULL),
(203, 11, 'CASH', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:56:17', '2020-12-26 23:56:17', NULL),
(204, 11, 'CHURCH', NULL, NULL, 'building', '', NULL, '2020-12-26 23:56:30', '2020-12-26 23:56:30', NULL),
(205, 11, 'CORN', NULL, NULL, 'vegetable', '', NULL, '2020-12-26 23:56:45', '2020-12-26 23:56:45', NULL),
(206, 11, 'DOOR', NULL, NULL, 'passageway', '', NULL, '2020-12-26 23:56:58', '2020-12-26 23:56:58', NULL),
(207, 11, 'FLOOD', NULL, NULL, 'natural disaster', '', NULL, '2020-12-26 23:57:13', '2020-12-26 23:57:13', NULL),
(208, 11, 'GARDEN', NULL, NULL, 'property', '', NULL, '2020-12-26 23:57:27', '2020-12-26 23:57:27', NULL),
(209, 11, 'HOTEL', NULL, NULL, 'building', '', NULL, '2020-12-26 23:57:40', '2020-12-26 23:57:40', NULL),
(210, 11, 'LETTER', NULL, NULL, 'symbol/ correspondence', '', NULL, '2020-12-26 23:57:59', '2020-12-26 23:57:59', NULL),
(211, 11, 'MOTHER', NULL, NULL, 'person', '', NULL, '2020-12-26 23:58:13', '2020-12-26 23:58:13', NULL),
(212, 11, 'PHYSICIAN', NULL, NULL, 'a profession', '', NULL, '2020-12-26 23:58:40', '2020-12-26 23:58:40', NULL),
(213, 11, 'PUPIL', NULL, NULL, 'role/ part of body', '', NULL, '2020-12-26 23:58:57', '2020-12-26 23:58:57', NULL),
(214, 11, 'SKIN', NULL, NULL, 'part of body', '', NULL, '2020-12-26 23:59:12', '2020-12-26 23:59:12', NULL),
(215, 11, 'STRENGTH', NULL, NULL, 'characteristic', '', NULL, '2020-12-26 23:59:26', '2020-12-26 23:59:26', NULL),
(216, 11, 'TREE', NULL, NULL, 'living thing', '', NULL, '2020-12-26 23:59:42', '2020-12-26 23:59:42', NULL),
(217, 11, 'WOMEN', NULL, NULL, 'people', '', NULL, '2020-12-26 23:59:55', '2020-12-26 23:59:55', NULL),
(218, 11, 'ADAGE', NULL, NULL, 'saying', '', NULL, '2020-12-27 00:00:12', '2020-12-27 00:00:12', NULL),
(219, 11, 'COMPETENCE', NULL, NULL, 'quality', '', NULL, '2020-12-27 00:00:27', '2020-12-27 00:00:27', NULL),
(220, 11, 'ESSENCE', NULL, NULL, 'quality', '', NULL, '2020-12-27 00:00:46', '2020-12-27 00:00:46', NULL),
(221, 12, 'CIRCLE', NULL, NULL, 'Shape', '', NULL, '2020-12-27 00:02:14', '2020-12-27 00:02:14', NULL),
(222, 12, 'AVENUE', NULL, NULL, 'roadway', '', NULL, '2020-12-27 00:02:27', '2020-12-27 00:02:27', NULL),
(223, 12, 'BOULDER', NULL, NULL, 'part of nature', '', NULL, '2020-12-27 00:02:44', '2020-12-27 00:02:44', NULL),
(224, 12, 'GENTLEMAN', NULL, NULL, 'person', '', NULL, '2020-12-27 00:02:59', '2020-12-27 00:02:59', NULL),
(225, 12, 'CORNER', NULL, NULL, 'an edge', '', NULL, '2020-12-27 00:03:16', '2020-12-27 00:03:16', NULL),
(226, 12, 'HOUSE', NULL, NULL, 'building', '', NULL, '2020-12-27 00:03:33', '2020-12-27 00:03:33', NULL),
(227, 12, 'LIBRARY', NULL, NULL, 'a place', '', NULL, '2020-12-27 00:04:18', '2020-12-27 00:04:18', NULL),
(228, 12, 'QUEEN', NULL, NULL, 'monarchy', '', NULL, '2020-12-27 00:04:33', '2020-12-27 00:04:33', NULL),
(229, 12, 'DRESS', NULL, NULL, 'article of clothing/ an action', '', NULL, '2020-12-27 00:28:25', '2020-12-27 00:28:25', NULL),
(230, 12, 'PICTURE', NULL, NULL, 'object', '', NULL, '2020-12-27 00:28:43', '2020-12-27 00:28:43', NULL),
(231, 12, 'FLOWER', NULL, NULL, 'something that grows', '', NULL, '2020-12-27 00:29:26', '2020-12-27 00:29:26', NULL),
(232, 12, 'MOUNTAIN', NULL, NULL, 'part of nature', '', NULL, '2020-12-27 00:29:42', '2020-12-27 00:29:42', NULL),
(233, 12, 'STRING', NULL, NULL, 'material', '', NULL, '2020-12-27 00:29:59', '2020-12-27 00:29:59', NULL),
(234, 12, 'TROOPS', NULL, NULL, 'military', '', NULL, '2020-12-27 00:30:14', '2020-12-27 00:30:14', NULL),
(235, 12, 'WOODS', NULL, NULL, 'nature', '', NULL, '2020-12-27 00:30:28', '2020-12-27 00:30:28', NULL),
(236, 12, 'EXCLUSION', NULL, NULL, 'omission', '', NULL, '2020-12-27 00:30:40', '2020-12-27 00:30:40', NULL),
(237, 12, 'CONTEXT', NULL, NULL, 'environment', '', NULL, '2020-12-27 00:30:54', '2020-12-27 00:30:54', NULL),
(238, 12, 'ADVERSITY', NULL, NULL, 'situation', '', NULL, '2020-12-27 00:31:06', '2020-12-27 00:31:06', NULL),
(239, 12, 'SKY', NULL, NULL, 'nature', '', NULL, '2020-12-27 00:31:23', '2020-12-27 00:31:23', NULL),
(240, 13, 'BIRD', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:34:39', '2020-12-26 23:34:39', NULL),
(241, 13, 'BEAST', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:35:48', '2020-12-26 23:35:48', NULL),
(242, 13, 'CUE', NULL, NULL, 'type of ball / hint', '', NULL, '2020-12-26 23:36:12', '2020-12-26 23:36:12', NULL),
(243, 13, 'CLOTHING', NULL, NULL, 'something you put on body', '', NULL, '2020-12-26 23:36:31', '2020-12-26 23:36:31', NULL),
(244, 13, 'DAMSEL', NULL, NULL, 'person/ fish', '', NULL, '2020-12-26 23:36:58', '2020-12-26 23:36:58', NULL),
(245, 13, 'ELEPHANT', NULL, NULL, 'an animal', '', NULL, '2020-12-26 23:37:24', '2020-12-26 23:37:24', NULL),
(246, 13, 'GRASS', NULL, NULL, 'something that grows', '', NULL, '2020-12-26 23:37:41', '2020-12-26 23:37:41', NULL),
(247, 13, 'GREEN', NULL, NULL, 'color', '', NULL, '2020-12-26 23:38:08', '2020-12-26 23:38:08', NULL),
(248, 13, 'JUDGE', NULL, NULL, 'a profession', '', NULL, '2020-12-26 23:38:30', '2020-12-26 23:38:30', NULL),
(249, 13, 'MACHINE', NULL, NULL, 'equipment', '', NULL, '2020-12-26 23:38:45', '2020-12-26 23:38:45', NULL),
(250, 13, 'OCEAN', NULL, NULL, 'body of water', '', NULL, '2020-12-26 23:39:02', '2020-12-26 23:39:02', NULL),
(251, 13, 'POLE', NULL, NULL, 'a stick', '', NULL, '2020-12-26 23:39:39', '2020-12-26 23:39:39', NULL),
(252, 13, 'ROCK', NULL, NULL, 'part of nature', '', NULL, '2020-12-26 23:39:54', '2020-12-26 23:39:54', NULL),
(253, 13, 'SQUARE', NULL, NULL, 'a shape', '', NULL, '2020-12-26 23:40:14', '2020-12-26 23:40:14', NULL),
(254, 13, 'TABLE', NULL, NULL, 'furniture', '', NULL, '2020-12-26 23:40:29', '2020-12-26 23:40:29', NULL),
(255, 13, 'WATER', NULL, NULL, 'liquid', '', NULL, '2020-12-26 23:40:43', '2020-12-26 23:40:43', NULL),
(256, 13, 'UNREALITY', NULL, NULL, 'futility', '', NULL, '2020-12-26 23:40:57', '2020-12-26 23:40:57', NULL),
(257, 13, 'ATROCITY', NULL, NULL, 'disaster', '', NULL, '2020-12-26 23:41:10', '2020-12-26 23:41:10', NULL),
(258, 13, 'DEDUCTION', NULL, NULL, 'form of reasoning', '', NULL, '2020-12-26 23:41:34', '2020-12-26 23:41:34', NULL),
(259, 13, 'FORETHOUGHT', NULL, NULL, 'planning', '', NULL, '2020-12-26 23:41:51', '2020-12-26 23:41:51', NULL),
(260, 14, 'WINTER', NULL, NULL, 'a season', '', NULL, '2020-12-26 23:47:03', '2020-12-26 23:47:03', NULL),
(261, 14, 'LAWN', NULL, NULL, 'property', '', NULL, '2020-12-26 23:47:17', '2020-12-26 23:47:17', NULL),
(262, 14, 'STREET', NULL, NULL, 'roadway', '', NULL, '2020-12-26 23:47:31', '2020-12-26 23:47:31', NULL),
(263, 14, 'SHORE', NULL, NULL, 'geographic region', '', NULL, '2020-12-26 23:47:47', '2020-12-26 23:47:47', NULL),
(264, 14, 'CHRISTMAS', NULL, NULL, 'holiday', '', NULL, '2020-12-26 23:47:59', '2020-12-26 23:47:59', NULL),
(265, 14, 'DOLLAR', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:48:12', '2020-12-26 23:48:12', NULL),
(266, 14, 'ARROW', NULL, NULL, 'weapon', '', NULL, '2020-12-26 23:48:25', '2020-12-26 23:48:25', NULL),
(267, 14, 'BOOK', NULL, NULL, 'something you read', '', NULL, '2020-12-26 23:48:45', '2020-12-26 23:48:45', NULL),
(268, 14, 'CANDY', NULL, NULL, 'food', '', NULL, '2020-12-26 23:49:01', '2020-12-26 23:49:01', NULL),
(269, 14, 'PENCIL', NULL, NULL, 'something you write with', '', NULL, '2020-12-26 23:49:16', '2020-12-26 23:49:16', NULL),
(270, 14, 'CORD', NULL, NULL, 'electric conductor/music element', '', NULL, '2020-12-26 23:49:33', '2020-12-26 23:49:33', NULL),
(271, 14, 'FLESH', NULL, NULL, 'part of body', '', NULL, '2020-12-26 23:49:52', '2020-12-26 23:49:52', NULL),
(272, 14, 'TOY', NULL, NULL, 'object', '', NULL, '2020-12-26 23:50:06', '2020-12-26 23:50:06', NULL),
(273, 14, 'PROFESSOR', NULL, NULL, 'profession', '', NULL, '2020-12-26 23:50:22', '2020-12-26 23:50:22', NULL),
(274, 14, 'HOSPITAL', NULL, NULL, 'a building', '', NULL, '2020-12-26 23:50:35', '2020-12-26 23:50:35', NULL),
(275, 14, 'FURNITURE', NULL, NULL, 'household item', '', NULL, '2020-12-26 23:50:49', '2020-12-26 23:50:49', NULL),
(276, 14, 'EQUAL', NULL, NULL, 'sweetener/ mathematics sign', '', NULL, '2020-12-26 23:51:08', '2020-12-26 23:51:08', NULL),
(277, 14, 'STEPS', NULL, NULL, 'passageway', '', NULL, '2020-12-26 23:51:22', '2020-12-26 23:51:22', NULL),
(278, 14, 'MONEY', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:51:38', '2020-12-26 23:51:38', NULL),
(279, 14, 'UNBELIEVER', NULL, NULL, 'skeptic', '', NULL, '2020-12-26 23:53:23', '2020-12-26 23:53:23', NULL),
(280, 15, 'AUTOMOBILE', NULL, NULL, 'Transportation', '', NULL, '2020-12-26 23:55:51', '2020-12-26 23:55:51', NULL),
(281, 15, 'BOTTLE', NULL, NULL, 'Container', '', NULL, '2020-12-26 23:56:04', '2020-12-26 23:56:04', NULL),
(282, 15, 'CASH', NULL, NULL, 'currency', '', NULL, '2020-12-26 23:56:17', '2020-12-26 23:56:17', NULL),
(283, 15, 'CHURCH', NULL, NULL, 'building', '', NULL, '2020-12-26 23:56:30', '2020-12-26 23:56:30', NULL),
(284, 15, 'CORN', NULL, NULL, 'vegetable', '', NULL, '2020-12-26 23:56:45', '2020-12-26 23:56:45', NULL),
(285, 15, 'DOOR', NULL, NULL, 'passageway', '', NULL, '2020-12-26 23:56:58', '2020-12-26 23:56:58', NULL),
(286, 15, 'FLOOD', NULL, NULL, 'natural disaster', '', NULL, '2020-12-26 23:57:13', '2020-12-26 23:57:13', NULL),
(287, 15, 'GARDEN', NULL, NULL, 'property', '', NULL, '2020-12-26 23:57:27', '2020-12-26 23:57:27', NULL),
(288, 15, 'HOTEL', NULL, NULL, 'building', '', NULL, '2020-12-26 23:57:40', '2020-12-26 23:57:40', NULL),
(289, 15, 'LETTER', NULL, NULL, 'symbol/ correspondence', '', NULL, '2020-12-26 23:57:59', '2020-12-26 23:57:59', NULL),
(290, 15, 'MOTHER', NULL, NULL, 'person', '', NULL, '2020-12-26 23:58:13', '2020-12-26 23:58:13', NULL),
(291, 15, 'PHYSICIAN', NULL, NULL, 'a profession', '', NULL, '2020-12-26 23:58:40', '2020-12-26 23:58:40', NULL),
(292, 15, 'PUPIL', NULL, NULL, 'role/ part of body', '', NULL, '2020-12-26 23:58:57', '2020-12-26 23:58:57', NULL),
(293, 15, 'SKIN', NULL, NULL, 'part of body', '', NULL, '2020-12-26 23:59:12', '2020-12-26 23:59:12', NULL),
(294, 15, 'STRENGTH', NULL, NULL, 'characteristic', '', NULL, '2020-12-26 23:59:26', '2020-12-26 23:59:26', NULL),
(295, 15, 'TREE', NULL, NULL, 'living thing', '', NULL, '2020-12-26 23:59:42', '2020-12-26 23:59:42', NULL),
(296, 15, 'WOMEN', NULL, NULL, 'people', '', NULL, '2020-12-26 23:59:55', '2020-12-26 23:59:55', NULL),
(297, 15, 'ADAGE', NULL, NULL, 'saying', '', NULL, '2020-12-27 00:00:12', '2020-12-27 00:00:12', NULL),
(298, 15, 'COMPETENCE', NULL, NULL, 'quality', '', NULL, '2020-12-27 00:00:27', '2020-12-27 00:00:27', NULL),
(299, 15, 'ESSENCE', NULL, NULL, 'quality', '', NULL, '2020-12-27 00:00:46', '2020-12-27 00:00:46', NULL),
(300, 16, 'CIRCLE', NULL, NULL, 'Shape', '', NULL, '2020-12-27 00:02:14', '2020-12-27 00:02:14', NULL),
(301, 16, 'AVENUE', NULL, NULL, 'roadway', '', NULL, '2020-12-27 00:02:27', '2020-12-27 00:02:27', NULL),
(302, 16, 'BOULDER', NULL, NULL, 'part of nature', '', NULL, '2020-12-27 00:02:44', '2020-12-27 00:02:44', NULL),
(303, 16, 'GENTLEMAN', NULL, NULL, 'person', '', NULL, '2020-12-27 00:02:59', '2020-12-27 00:02:59', NULL),
(304, 16, 'CORNER', NULL, NULL, 'an edge', '', NULL, '2020-12-27 00:03:16', '2020-12-27 00:03:16', NULL),
(305, 16, 'HOUSE', NULL, NULL, 'building', '', NULL, '2020-12-27 00:03:33', '2020-12-27 00:03:33', NULL),
(306, 16, 'LIBRARY', NULL, NULL, 'a place', '', NULL, '2020-12-27 00:04:18', '2020-12-27 00:04:18', NULL),
(307, 16, 'QUEEN', NULL, NULL, 'monarchy', '', NULL, '2020-12-27 00:04:33', '2020-12-27 00:04:33', NULL),
(308, 16, 'DRESS', NULL, NULL, 'article of clothing/ an action', '', NULL, '2020-12-27 00:28:25', '2020-12-27 00:28:25', NULL),
(309, 16, 'PICTURE', NULL, NULL, 'object', '', NULL, '2020-12-27 00:28:43', '2020-12-27 00:28:43', NULL),
(310, 16, 'FLOWER', NULL, NULL, 'something that grows', '', NULL, '2020-12-27 00:29:26', '2020-12-27 00:29:26', NULL),
(311, 16, 'MOUNTAIN', NULL, NULL, 'part of nature', '', NULL, '2020-12-27 00:29:42', '2020-12-27 00:29:42', NULL),
(312, 16, 'STRING', NULL, NULL, 'material', '', NULL, '2020-12-27 00:29:59', '2020-12-27 00:29:59', NULL),
(313, 16, 'TROOPS', NULL, NULL, 'military', '', NULL, '2020-12-27 00:30:14', '2020-12-27 00:30:14', NULL),
(314, 16, 'WOODS', NULL, NULL, 'nature', '', NULL, '2020-12-27 00:30:28', '2020-12-27 00:30:28', NULL),
(315, 16, 'EXCLUSION', NULL, NULL, 'omission', '', NULL, '2020-12-27 00:30:40', '2020-12-27 00:30:40', NULL),
(316, 16, 'CONTEXT', NULL, NULL, 'environment', '', NULL, '2020-12-27 00:30:54', '2020-12-27 00:30:54', NULL),
(317, 16, 'ADVERSITY', NULL, NULL, 'situation', '', NULL, '2020-12-27 00:31:06', '2020-12-27 00:31:06', NULL),
(318, 16, 'SKY', NULL, NULL, 'nature', '', NULL, '2020-12-27 00:31:23', '2020-12-27 00:31:23', NULL),
(319, 17, 'MILK', NULL, NULL, NULL, 'MILK', 'shopping', '2020-12-27 00:31:23', '2020-12-27 00:31:23', NULL),
(320, 17, 'CAT-FOOD', NULL, NULL, NULL, 'CAT-FOOD', 'shopping', NULL, NULL, NULL),
(321, 17, 'EGGS', NULL, NULL, NULL, 'EGGS', 'shopping', NULL, NULL, NULL),
(322, 17, 'PAPER-TOWELS', NULL, NULL, NULL, 'PAPER-TOWELS', 'shopping', NULL, NULL, NULL),
(323, 17, 'SOUP', NULL, NULL, NULL, 'SOUP', 'shopping', NULL, NULL, NULL),
(324, 17, 'PEANUTS', NULL, NULL, NULL, 'PEANUTS', 'shopping', NULL, NULL, NULL),
(325, 17, 'RICE', NULL, NULL, NULL, 'RICE', 'shopping', NULL, NULL, NULL),
(326, 17, 'COOKIES', NULL, NULL, NULL, 'COOKIES', 'shopping', NULL, NULL, NULL),
(327, 17, 'LETTUCE', NULL, NULL, NULL, 'LETTUCE', 'shopping', NULL, NULL, NULL),
(328, 17, 'APPLES', NULL, NULL, NULL, 'APPLES', 'shopping', NULL, NULL, NULL),
(329, 17, 'CHEESE', NULL, NULL, NULL, 'CHEESE', 'shopping', NULL, NULL, NULL),
(330, 17, 'BREAD', NULL, NULL, NULL, 'BREAD', 'shopping', NULL, NULL, NULL),
(331, 17, 'SPINACH', NULL, NULL, NULL, 'SPINACH', 'shopping', NULL, NULL, NULL),
(332, 17, 'SOUR-CREAM', NULL, NULL, NULL, 'SOUR-CREAM', 'shopping', NULL, NULL, NULL),
(333, 17, 'PASTA', NULL, NULL, NULL, 'PASTA', 'shopping', NULL, NULL, NULL),
(334, 17, 'CHICKEN', NULL, NULL, NULL, 'CHICKEN', 'shopping', NULL, NULL, NULL),
(335, 17, 'GRAPES', NULL, NULL, NULL, 'GRAPES', 'shopping', NULL, NULL, NULL),
(336, 17, 'HOT-DOGS', NULL, NULL, NULL, 'HOT-DOGS', 'shopping', NULL, NULL, NULL),
(337, 17, 'CEREAL', NULL, NULL, NULL, 'CEREAL', 'shopping', NULL, NULL, NULL),
(338, 17, 'PRETZELS', NULL, NULL, NULL, 'PRETZELS', 'shopping', NULL, NULL, NULL),
(339, 17, 'Go to the BANK', NULL, NULL, NULL, 'BANK', 'to do', NULL, NULL, NULL),
(340, 17, 'Pick up the kids at SCHOOL', NULL, NULL, NULL, 'SCHOOL', 'to do', NULL, NULL, NULL),
(341, 17, 'Take the DOG for a walk', NULL, NULL, NULL, 'DOG', 'to do', NULL, NULL, NULL),
(342, 17, 'Pay the MORTGAGE', NULL, NULL, NULL, 'MORTGAGE', 'to do', NULL, NULL, NULL),
(343, 17, 'Buy STAMPS', NULL, NULL, NULL, 'STAMPS', 'to do', NULL, NULL, NULL),
(344, 17, 'Drop off the dry CLEANING', NULL, NULL, NULL, 'CLEANING', 'to do', NULL, NULL, NULL),
(345, 17, 'Meet Joe for LUNCH', NULL, NULL, NULL, 'LUNCH', 'to do', NULL, NULL, NULL),
(346, 17, 'Mow the LAWN', NULL, NULL, NULL, 'LAWN', 'to do', NULL, NULL, NULL),
(347, 17, 'Wrap Suzie\'s birthday GIFT', NULL, NULL, NULL, 'GIFT', 'to do', NULL, NULL, NULL),
(348, 17, 'Read the NEWSPAPER', NULL, NULL, NULL, 'NEWSPAPER', 'to do', NULL, NULL, NULL),
(349, 17, 'Make a LEFT onto MOUNTAINVIEW Road.', NULL, 'LEFT,MOUNTAINVIEW', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(350, 17, 'Make a LEFT onto MOUNTAINVIEW Road.', NULL, 'D', NULL, 'MOUNTAINVIEW', 'directions', NULL, NULL, NULL),
(351, 17, 'Travel ONE-MILE.', NULL, 'ONE-MILE', NULL, 'ONE-MILE', 'directions', NULL, NULL, NULL),
(352, 17, 'Make a RIGHT onto NORTH-58TH Street.', NULL, 'RIGHT,NORTH-58TH', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(353, 17, 'Make a RIGHT onto NORTH-58TH Street.', NULL, 'D', NULL, 'NORTH-58TH', 'directions', NULL, NULL, NULL),
(354, 17, 'Make a LEFT onto DOUBLETREE Road.', NULL, 'LEFT,DOUBLETREE', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(355, 17, 'Make a LEFT onto DOUBLETREE Road.', NULL, 'D', NULL, 'DOUBLETREE', 'directions', NULL, NULL, NULL),
(356, 17, 'Bear RIGHT onto route 101-SOUTH.', NULL, 'RIGHT,101-SOUTH', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(357, 17, 'Bear RIGHT onto route 101-SOUTH.', NULL, 'D', NULL, '101-SOUTH', 'directions', NULL, NULL, NULL),
(358, 17, 'Continue on ROUTE-101, taking EXIT-19.', NULL, 'ROUTE-101,EXIT-19', NULL, 'ROUTE-101', 'directions', NULL, NULL, NULL),
(359, 17, 'Continue on ROUTE-101, taking EXIT-19.', NULL, 'D', NULL, 'EXIT-19', 'directions', NULL, NULL, NULL),
(360, 17, 'At the end of the exit ramp, make LEFT onto CAMBELBACK Drive.', NULL, 'LEFT,CAMBELBACK', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(361, 17, 'At the end of the exit ramp, make LEFT onto CAMBELBACK Drive.', NULL, 'D', NULL, 'CAMBELBACK', 'directions', NULL, NULL, NULL),
(362, 17, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', NULL, '3RD-INTERSECTION,LEFT,SUNSHINE', NULL, '3RD-INTERSECTION', 'directions', NULL, NULL, NULL),
(363, 17, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', NULL, 'D', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(364, 17, 'At the 3RD-INTERSECTION, make a LEFT onto SUNSHINE Street.', NULL, 'D', NULL, 'SUNSHINE', 'directions', NULL, NULL, NULL),
(365, 17, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', NULL, '2-MILES,RIGHT,VAN-BUREN', NULL, '2-MILES', 'directions', NULL, NULL, NULL),
(366, 17, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', NULL, 'D', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(367, 17, 'After 2-MILES, bear RIGHT onto VAN-BUREN Parkway.', NULL, 'D', NULL, 'VAN-BUREN', 'directions', NULL, NULL, NULL),
(368, 17, 'The restaurant will be 1.3-MILES ahead on your RIGHT.', NULL, '1.3-MILES,RIGHT', NULL, '1.3-MILES', 'directions', NULL, NULL, NULL),
(369, 17, 'The restaurant will be 1.3-MILES ahead on your RIGHT.', NULL, 'D', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(370, 18, 'YOGURT', NULL, NULL, NULL, 'YOGURT', 'shopping', NULL, NULL, NULL),
(371, 18, 'NAPKINS', NULL, NULL, NULL, 'NAPKINS', 'shopping', NULL, NULL, NULL),
(372, 18, 'DOG-FOOD', NULL, NULL, NULL, 'DOG-FOOD', 'shopping', NULL, NULL, NULL),
(373, 18, 'JELLY', NULL, NULL, NULL, 'JELLY', 'shopping', NULL, NULL, NULL),
(374, 18, 'PEACHES', NULL, NULL, NULL, 'PEACHES', 'shopping', NULL, NULL, NULL),
(375, 18, 'PLASTIC-WRAP', NULL, NULL, NULL, 'PLASTIC-WRAP', 'shopping', NULL, NULL, NULL),
(376, 18, 'TURKEY', NULL, NULL, NULL, 'TURKEY', 'shopping', NULL, NULL, NULL),
(377, 18, 'CASHEWS', NULL, NULL, NULL, 'CASHEWS', 'shopping', NULL, NULL, NULL),
(378, 18, 'HAMBURGER', NULL, NULL, NULL, 'HAMBURGER', 'shopping', NULL, NULL, NULL),
(379, 18, 'DANISHES', NULL, NULL, NULL, 'DANISHES', 'shopping', NULL, NULL, NULL),
(380, 18, 'CUCUMBERS', NULL, NULL, NULL, 'CUCUMBERS', 'shopping', NULL, NULL, NULL),
(381, 18, 'TORTILLAS', NULL, NULL, NULL, 'TORTILLAS', 'shopping', NULL, NULL, NULL),
(382, 18, 'SPAGHETTI', NULL, NULL, NULL, 'SPAGHETTI', 'shopping', NULL, NULL, NULL),
(383, 18, 'BUTTER', NULL, NULL, NULL, 'BUTTER', 'shopping', NULL, NULL, NULL),
(384, 18, 'PLUMS', NULL, NULL, NULL, 'PLUMS', 'shopping', NULL, NULL, NULL),
(385, 18, 'CRACKERS', NULL, NULL, NULL, 'CRACKERS', 'shopping', NULL, NULL, NULL),
(386, 18, 'ONION', NULL, NULL, NULL, 'ONION', 'shopping', NULL, NULL, NULL),
(387, 18, 'POTATOES', NULL, NULL, NULL, 'POTATOES', 'shopping', NULL, NULL, NULL),
(388, 18, 'OATMEAL', NULL, NULL, NULL, 'OATMEAL', 'shopping', NULL, NULL, NULL),
(389, 18, 'ORANGE-JUICE', NULL, NULL, NULL, 'ORANGE-JUICE', 'shopping', NULL, NULL, NULL),
(390, 18, 'Go to the POST-OFFICE', NULL, NULL, NULL, 'POST-OFFICE', 'to do', NULL, NULL, NULL),
(391, 18, 'Get the CAR washed', NULL, NULL, NULL, 'CAR', 'to do', NULL, NULL, NULL),
(392, 18, 'Buy new SHIRTS', NULL, NULL, NULL, 'SHIRTS', 'to do', NULL, NULL, NULL),
(393, 18, 'Meet Harry for BREAKFAST', NULL, NULL, NULL, 'BREAKFAST', 'to do', NULL, NULL, NULL),
(394, 18, 'Water the PLANTS', NULL, NULL, NULL, 'PLANTS', 'to do', NULL, NULL, NULL),
(395, 18, 'Make the BED', NULL, NULL, NULL, 'BED', 'to do', NULL, NULL, NULL),
(396, 18, 'Do LAUNDRY', NULL, NULL, NULL, 'LAUNDRY', 'to do', NULL, NULL, NULL),
(397, 18, 'Pay the ELECTRIC bill', NULL, NULL, NULL, 'ELECTRIC', 'to do', NULL, NULL, NULL),
(398, 18, 'Visit MOTHER', NULL, NULL, NULL, 'MOTHER', 'to do', NULL, NULL, NULL),
(399, 18, 'Go to the GROCERY store', NULL, NULL, NULL, 'GROCERY', 'to do', NULL, NULL, NULL),
(400, 18, 'Travel NORTH on ROUTE-805.', NULL, 'NORTH,ROUTE-805', NULL, 'NORTH', 'directions', NULL, NULL, NULL),
(401, 18, 'Travel NORTH on ROUTE-805.', NULL, 'D', NULL, 'ROUTE-805', 'directions', NULL, NULL, NULL),
(402, 18, 'Take the exit for OLIVE Street.', NULL, 'OLIVE', NULL, 'OLIVE', 'directions', NULL, NULL, NULL),
(403, 18, 'Travel 2-MILES.', NULL, '2-MILES', NULL, '2-MILES', 'directions', NULL, NULL, NULL),
(404, 18, 'Make a RIGHT onto OAK Avenue.', NULL, 'RIGHT,OAK', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(405, 18, 'Make a RIGHT onto OAK Avenue.', NULL, 'D', NULL, 'OAK', 'directions', NULL, NULL, NULL),
(406, 18, 'Follow for 3-MILES.', NULL, '3-MILES', NULL, '3-MILES', 'directions', NULL, NULL, NULL),
(407, 18, 'Bear LEFT onto EUGENE Place.', NULL, 'LEFT,EUGENE', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(408, 18, 'Bear LEFT onto EUGENE Place.', NULL, 'D', NULL, 'EUGENE', 'directions', NULL, NULL, NULL),
(409, 18, 'At the 4TH-TRAFFIC-LIGHT, make a RIGHT onto 63rd Street.', NULL, '4TH-TRAFFIC-LIGHT,RIGHT', NULL, '4TH-TRAFFIC-LIGHT', 'directions', NULL, NULL, NULL),
(410, 18, 'At the 4TH-TRAFFIC-LIGHT, make a RIGHT onto 63rd Street.', NULL, 'D', NULL, 'RIGHT', 'directions', NULL, NULL, NULL),
(411, 18, 'At CLAY park, bear LEFT onto CORNELL Drive.', NULL, 'CLAY,LEFT,CORNELL', NULL, 'CLAY', 'directions', NULL, NULL, NULL),
(412, 18, 'At CLAY park, bear LEFT onto CORNELL Drive.', NULL, 'D', NULL, 'LEFT', 'directions', NULL, NULL, NULL),
(413, 18, 'At CLAY park, bear LEFT onto CORNELL Drive.', NULL, 'D', NULL, 'CORNELL', 'directions', NULL, NULL, NULL),
(414, 18, 'Travel 1-MILE, and arrive at 640 Cornell Drive.', NULL, '1-MILE,640', NULL, '1-MILE', 'directions', NULL, NULL, NULL),
(415, 18, 'Travel 1-MILE, and arrive at 640 Cornell Drive.', NULL, 'D', NULL, '640', 'directions', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `boosters`
--
ALTER TABLE `boosters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contextuals`
--
ALTER TABLE `contextuals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generals`
--
ALTER TABLE `generals`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainees`
--
ALTER TABLE `trainees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainee_stories`
--
ALTER TABLE `trainee_stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainee_transactions`
--
ALTER TABLE `trainee_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contextuals`
--
ALTER TABLE `contextuals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generals`
--
ALTER TABLE `generals`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `trainees`
--
ALTER TABLE `trainees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `trainee_stories`
--
ALTER TABLE `trainee_stories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trainee_transactions`
--
ALTER TABLE `trainee_transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=591;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
