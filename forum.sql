-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 06:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `threads_id` int(8) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `threads_id`, `comment_by`, `comment_time`) VALUES
(1, 'pierwszy komentarz', 1, 0, '2022-11-10 21:10:05'),
(2, 'ddd', 19, 0, '2022-11-10 21:20:11'),
(3, 'dupa\r\n', 19, 0, '2022-11-10 21:20:15'),
(4, 'dupa\r\n', 19, 0, '2022-11-10 21:26:44'),
(5, 'dupa\r\n', 19, 0, '2022-11-10 21:28:24'),
(6, 'dupa\r\n', 19, 0, '2022-11-10 21:28:47'),
(7, 'dupa\r\n', 19, 0, '2022-11-10 21:29:24'),
(8, 'zupa\r\n', 1, 0, '2022-11-10 21:45:07'),
(9, 'test', 23, 0, '2022-12-02 18:04:40'),
(10, 'test', 23, 0, '2022-12-02 18:05:11'),
(11, 'test', 23, 0, '2022-12-02 18:07:53'),
(12, 'testse', 27, 0, '2022-12-02 18:20:40'),
(13, 'testse', 27, 0, '2022-12-02 18:21:06'),
(14, 'testest', 27, 0, '2022-12-02 18:21:10');

-- --------------------------------------------------------

--
-- Table structure for table `kategorie`
--

CREATE TABLE `kategorie` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategorie`
--

INSERT INTO `kategorie` (`category_id`, `category_name`, `category_description`, `created`) VALUES
(1, 'Kot', 'Kot to udomowiony gatunek małego ssaka mięsożernego. Jest to jedyny udomowiony gatunek w rodzinie Felidae i jest powszechnie określany jako kot domowy lub kot domowy, aby odróżnić go od dzikich członków rodziny.', '2022-11-10 13:40:17'),
(2, 'Pies', 'Pies jest udomowionym potomkiem wilka. Nazywany również psem domowym, pochodzi od wymarłego wilka plejstoceńskiego, a współczesny wilk jest najbliższym żyjącym krewnym psa. Pies był pierwszym gatunkiem udomowionym przez łowców-zbieraczy ponad 15 000 lat t', '2022-11-10 13:41:26'),
(3, 'Emu', 'Emu jest drugim co do wysokości żyjącym ptakiem po bezgrzebieniowych krewniakach strusia. Występuje endemicznie w Australii, gdzie jest największym rodzimym ptakiem i jedynym zachowanym przedstawicielem rodzaju Dromaius.', '2022-11-10 15:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE `threads` (
  `threads_id` int(8) NOT NULL,
  `thread_title` varchar(255) NOT NULL,
  `thread_description` text NOT NULL,
  `thread_cat_id` int(8) NOT NULL,
  `thread_user_id` int(8) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`threads_id`, `thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES
(1, 'Kot je za dużo', 'Mój kot za dużo je, waży już 15kg nie wiem co robić POMOCY !!11111jedenjeden', 1, 0, '2022-11-10 17:37:22'),
(19, '11111111111111111111111', '22222222222222222222222222', 2, 0, '2022-11-10 20:51:21'),
(20, 'ddd', 'dd', 2, 0, '2022-11-10 20:51:23'),
(21, 'ddd', 'dd', 2, 0, '2022-11-10 20:51:35'),
(22, 'ddd', 'dd', 2, 0, '2022-11-10 21:00:44'),
(23, '123', '123123123', 1, 0, '2022-11-29 11:48:24'),
(24, 'test', 'test', 1, 0, '2022-12-02 17:54:43'),
(26, 'test', 'tsetestse', 1, 1, '2022-12-02 17:57:37'),
(27, 'test', 'test', 1, 1, '2022-12-02 18:02:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `actor` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `actor`) VALUES
(1, 'Tomasz123', '$2y$10$KvJ0L9gEbwEuwy0cjz3EKuwfe8xXxUNmrIfCNYecKUOMdWlg8M9..', 't.bieniek2001@gmail.com', 'user'),
(2, 'TomaszAdmin', '$2y$10$KvJ0L9gEbwEuwy0cjz3EKuwfe8xXxUNmrIfCNYecKUOMdWlg8M9..', 'Tomaszadmin@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`threads_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `threads_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
