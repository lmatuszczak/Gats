-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Gru 2022, 20:33
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `forum`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(8) NOT NULL,
  `comment_content` text NOT NULL,
  `threads_id` int(8) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `threads_id`, `comment_by`, `comment_time`) VALUES
(70, 'Jeśli to Garfield to wszystko w porządku, w innym wypadku proponuję dla kota dietę MŻ i serię brzuszków 3 x 10 powtórzeń co 3 dni.', 1, 4, '2022-12-04 20:26:02'),
(71, 'Nie wiem. Pozdrawiam', 28, 4, '2022-12-04 20:26:23'),
(72, 'Można jak najbardziej.', 30, 4, '2022-12-04 20:29:08'),
(73, 'Prędkość lotu bielika w locie nurkowym może wynieść nawet 240 km/h.', 43, 4, '2022-12-04 20:30:38'),
(74, 'Polecam dietę wegańską. Stosuje u mojego kocura i jest chudziutki jak palec', 1, 5, '2022-12-04 20:32:46');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategorie`
--

CREATE TABLE `kategorie` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kategorie`
--

INSERT INTO `kategorie` (`category_id`, `category_name`, `category_description`, `created`) VALUES
(1, 'Kot', 'Kot to udomowiony gatunek małego ssaka mięsożernego. Jest to jedyny udomowiony gatunek w rodzinie Felidae i jest powszechnie określany jako kot domowy lub kot domowy, aby odróżnić go od dzikich członków rodziny.', '2022-11-10 13:40:17'),
(2, 'Pies', 'Pies jest udomowionym potomkiem wilka. Nazywany również psem domowym, pochodzi od wymarłego wilka plejstoceńskiego, a współczesny wilk jest najbliższym żyjącym krewnym psa. Pies był pierwszym gatunkiem udomowionym przez łowców-zbieraczy ponad 15 000 lat', '2022-11-10 13:41:26'),
(3, 'Ryby', 'tradycyjna nazwa zmiennocieplnych, pierwotnie wodnych kręgowców, oddychających skrzelami i poruszających się za pomocą płetw. Obejmuje bezżuchwowce krągłouste (Cyclostomata) oraz mające szczęki ryby właściwe (Pisces).', '2022-11-10 15:55:33'),
(9, 'Orzeł biały', 'Gatunek dużego ptaka drapieżnego z rodziny jastrzębiowatych (Accipitridae). Występuje w centralnej i północnej Palearktyce, od Islandii po Japonię; najbardziej na zachód wysunięta populacja zasiedla Grenlandię.', '2022-12-04 00:21:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `threads`
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
-- Zrzut danych tabeli `threads`
--

INSERT INTO `threads` (`threads_id`, `thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES
(1, 'Kot je za dużo', 'Mój kot za dużo je, waży już 15kg nie wiem co robić POMOCY !!', 1, 4, '2022-11-10 17:37:22'),
(28, 'Wędzisko pod Sandacza', 'Gdzie w Poznaniu można legalnie łowić duże sandacze?', 3, 4, '2022-12-02 18:37:34'),
(30, 'Imię dla psa', 'Czy psa można nazwać Franek', 2, 5, '2022-12-03 03:07:51'),
(43, 'Prędkość Bielika', 'Czy ktoś może wie jaką prędkość osiągają Bieliki?', 9, 4, '2022-12-04 20:11:56');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL,
  `actor` varchar(255) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `actor`) VALUES
(1, 'Tomasz123', '$2y$10$KvJ0L9gEbwEuwy0cjz3EKuwfe8xXxUNmrIfCNYecKUOMdWlg8M9..', 't.bieniek2001@gmail.com', 'user'),
(2, 'TomaszAdmin', '$2y$10$KvJ0L9gEbwEuwy0cjz3EKuwfe8xXxUNmrIfCNYecKUOMdWlg8M9..', 'Tomaszadmin@gmail.com', 'admin'),
(4, 'Krzysztof', '$2y$10$rszM4rRrMC8/FbzdY51mR.2iGtZtPkFtkAuENLu5N13mFpyDn4022', 'krzysztof.jezyna@gmail.com', 'admin'),
(5, 'Franek', '$2y$10$d/h.FglTamL0vgommM3RA.OrwAaX9mW3VzcwJ.THpGfT7zozxCU.y', 'franek.kimono@gmail.com', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indeksy dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksy dla tabeli `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`threads_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT dla tabeli `kategorie`
--
ALTER TABLE `kategorie`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `threads`
--
ALTER TABLE `threads`
  MODIFY `threads_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
