-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Sty 2023, 18:13
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `dpc`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(255) NOT NULL,
  `nip` varchar(10) DEFAULT NULL,
  `ulica` varchar(128) NOT NULL,
  `kod` varchar(10) NOT NULL,
  `miasto` varchar(64) NOT NULL,
  `tel1` varchar(15) NOT NULL,
  `tel2` varchar(15) DEFAULT NULL,
  `mail` varchar(128) DEFAULT NULL,
  `uwagi` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `nazwa`, `nip`, `ulica`, `kod`, `miasto`, `tel1`, `tel2`, `mail`, `uwagi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(5, 'Jan Kowalski', NULL, 'ulica', '22312', 'Krosno', '123321123', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pracownicy`
--

CREATE TABLE `pracownicy` (
  `id` int(11) NOT NULL,
  `nazwisko` varchar(64) NOT NULL,
  `imie` varchar(64) NOT NULL,
  `haslo` varchar(128) NOT NULL,
  `stanowisko` int(11) NOT NULL DEFAULT 0,
  `uwagi` text DEFAULT NULL,
  `mail` varchar(256) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `edited_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`id`, `nazwisko`, `imie`, `haslo`, `stanowisko`, `uwagi`, `mail`, `created_at`, `edited_at`, `deleted_at`) VALUES
(1, 'Zarych', 'Łukasz', '$2y$10$.xp8iIUU3fFTCgAKvVvxWu1OgMkP2Vvdl3ClCwN/7TQR3.DRL1lta', 0, 'Szef :)', 'serwis_dpc@outlook.com', NULL, NULL, NULL),
(2, 'Kowalski', 'Jan', '$2y$10$gezzjc8KkRSEdE.2g5K1Gepr5NWvGbwCOsNRe5eaLy5OwHOq16vO2', 0, NULL, 'jank@example.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uslugi`
--

CREATE TABLE `uslugi` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(128) NOT NULL,
  `jednostka` varchar(10) NOT NULL,
  `vat` int(11) NOT NULL,
  `cena_brutto` decimal(6,2) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uslugi`
--

INSERT INTO `uslugi` (`id`, `nazwa`, `jednostka`, `vat`, `cena_brutto`, `updated_at`, `deleted_at`, `created_at`) VALUES
(1, 'Diagnoza', 'u.', 23, '20.00', NULL, NULL, NULL),
(2, 'Aktualizacja BIOS', 'u.', 23, '30.00', NULL, NULL, NULL),
(3, 'Archiwizacja danych', 'u.', 23, '20.00', NULL, NULL, NULL),
(4, 'Czyszczenie, wymiana pasty termoprzewodzącej (Stacjonarny)', 'u.', 23, '20.00', NULL, NULL, NULL),
(5, 'Wymiana pamięci RAM/Zasilacza/Dysku/Karty graficznej/Płyty głównej (Stacjonarny)', 'u.', 23, '10.00', NULL, NULL, NULL),
(6, 'Instalacja systemu operacyjnego (bez archiwizacji)', 'u.', 23, '20.00', NULL, NULL, NULL),
(7, 'Czyszczenie, wymiana pasty termoprzewodzącej/termopadów (Laptop)', 'u.', 23, '20.00', NULL, NULL, NULL),
(8, 'Naprawa płyty głównej/Zasilacza (Laptop)', 'u.', 23, '20.00', NULL, NULL, NULL),
(9, 'Naprawa/Wymiana gniazda zasilającego (Laptop)', 'u.', 23, '15.00', NULL, NULL, NULL),
(10, 'Wymiana pamięci RAM/Zasilacza/Dysku (Laptop)', 'u.', 23, '20.00', NULL, NULL, NULL),
(11, 'Wymiana płyty głównej', 'u.', 23, '40.00', NULL, NULL, NULL),
(12, 'Wymiana klawiatury (Laptop)', 'u.', 23, '30.00', NULL, NULL, NULL),
(13, 'Wymiana matrycy (Laptop)', 'u.', 23, '40.00', NULL, NULL, NULL),
(14, 'Wymiana obudowy (Laptop)', 'u.', 23, '50.00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zlecenia`
--

CREATE TABLE `zlecenia` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(128) DEFAULT NULL,
  `serial` varchar(128) DEFAULT NULL,
  `opis_usterki` text DEFAULT NULL,
  `data_przyjecia` datetime DEFAULT current_timestamp(),
  `dni_naprawy` int(11) DEFAULT NULL,
  `czy_gwarancja` tinyint(1) NOT NULL DEFAULT 0,
  `czy_ekspres` tinyint(1) NOT NULL DEFAULT 0,
  `czy_zewn` tinyint(1) NOT NULL DEFAULT 0,
  `czy_opak` tinyint(1) NOT NULL DEFAULT 0,
  `czy_kable` tinyint(1) NOT NULL DEFAULT 0,
  `czy_zasilacz` tinyint(1) NOT NULL DEFAULT 0,
  `czy_plyty` tinyint(1) NOT NULL DEFAULT 0,
  `wyp_inne` varchar(128) DEFAULT NULL,
  `data_naprawy` datetime DEFAULT NULL,
  `uwagi` text DEFAULT NULL,
  `id_klient` int(11) DEFAULT NULL,
  `id_serwisant` int(11) DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `opis_naprawy` text DEFAULT NULL,
  `data_odbioru` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zlecenia`
--

INSERT INTO `zlecenia` (`id`, `nazwa`, `serial`, `opis_usterki`, `data_przyjecia`, `dni_naprawy`, `czy_gwarancja`, `czy_ekspres`, `czy_zewn`, `czy_opak`, `czy_kable`, `czy_zasilacz`, `czy_plyty`, `wyp_inne`, `data_naprawy`, `uwagi`, `id_klient`, `id_serwisant`, `updated_at`, `deleted_at`, `status`, `opis_naprawy`, `data_odbioru`) VALUES
(8, 'ASUS R540LJ', '123DFDS1144', 'Nie działa :(', '2022-04-20 14:40:37', 7, 0, 1, 0, 0, 0, 1, 0, 'torba', NULL, '', 5, 1, '2022-11-17 11:13:57', NULL, 1, '', NULL),
(9, 'Komputer NOX', '', 'Wymiana RAM', '2022-04-24 14:42:50', 2, 0, 0, 0, 1, 0, 1, 0, 'nowe kości RAM', '2022-10-28 02:22:53', '', 5, 1, '2022-11-17 13:06:31', NULL, 3, 'super działa polecam', '2022-11-17 01:06:31'),
(22, 'HP EliteBook G5', '123321', 'Nie działa', '2022-11-03 11:55:35', 1, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', 5, 1, '2022-11-17 11:02:02', NULL, 1, NULL, NULL),
(23, 'Lenovo', '123321', 'dsadasd', '2022-11-17 08:02:32', 1, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', 5, 1, '2022-12-27 12:16:16', NULL, 1, NULL, NULL),
(24, 'HP EliteBook G5', 'asdasd', 'Już działa :)', '2023-01-06 10:35:30', 7, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', 5, 2, '2023-01-06 10:35:30', NULL, 0, NULL, NULL),
(25, 'asd', 'asd', 'asd', '2023-01-06 10:41:18', 7, 0, 0, 0, 0, 0, 0, 0, 'asd', NULL, 'asd', 5, 2, '2023-01-06 10:44:03', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zleceniauslugi`
--

CREATE TABLE `zleceniauslugi` (
  `id` int(11) NOT NULL,
  `id_zlecenia` int(11) NOT NULL,
  `id_uslugi` int(11) NOT NULL,
  `ilosc` decimal(4,2) NOT NULL,
  `customPrice` decimal(6,2) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `zleceniauslugi`
--

INSERT INTO `zleceniauslugi` (`id`, `id_zlecenia`, `id_uslugi`, `ilosc`, `customPrice`, `updated_at`, `created_at`, `deleted_at`) VALUES
(4, 8, 10, '2.00', NULL, NULL, NULL, '2022-12-27 11:06:30'),
(5, 8, 1, '1.00', NULL, NULL, NULL, '2022-12-27 11:03:04'),
(6, 8, 4, '1.00', '0.00', NULL, NULL, '2022-12-27 11:58:28'),
(7, 8, 3, '1.00', '0.00', NULL, NULL, '2022-12-27 11:59:50'),
(9, 8, 5, '1.00', NULL, NULL, NULL, '2022-12-27 11:59:59'),
(10, 8, 11, '1.00', '100.00', NULL, NULL, '2022-12-27 12:04:21'),
(12, 8, 11, '1.00', '100.00', NULL, NULL, '2022-12-27 12:06:34'),
(14, 8, 11, '1.00', '100.00', NULL, NULL, '2022-12-27 12:07:57'),
(15, 8, 11, '1.00', '100.00', NULL, NULL, '2022-12-27 12:12:12'),
(16, 8, 6, '1.00', NULL, NULL, NULL, '2022-12-27 12:12:37'),
(17, 25, 1, '1.00', NULL, NULL, NULL, '2023-01-06 10:49:00'),
(18, 8, 5, '1.00', NULL, NULL, NULL, '2023-01-19 13:34:06'),
(19, 8, 11, '1.00', '200.00', NULL, NULL, NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `zlecenia`
--
ALTER TABLE `zlecenia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klient` (`id_klient`,`id_serwisant`),
  ADD KEY `id_serwisant` (`id_serwisant`);

--
-- Indeksy dla tabeli `zleceniauslugi`
--
ALTER TABLE `zleceniauslugi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_uslugi` (`id_uslugi`),
  ADD KEY `id_zlecenia` (`id_zlecenia`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `pracownicy`
--
ALTER TABLE `pracownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `uslugi`
--
ALTER TABLE `uslugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `zlecenia`
--
ALTER TABLE `zlecenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `zleceniauslugi`
--
ALTER TABLE `zleceniauslugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `zlecenia`
--
ALTER TABLE `zlecenia`
  ADD CONSTRAINT `zlecenia_ibfk_2` FOREIGN KEY (`id_klient`) REFERENCES `klienci` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `zlecenia_ibfk_3` FOREIGN KEY (`id_serwisant`) REFERENCES `pracownicy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `zleceniauslugi`
--
ALTER TABLE `zleceniauslugi`
  ADD CONSTRAINT `zleceniauslugi_ibfk_3` FOREIGN KEY (`id_uslugi`) REFERENCES `uslugi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `zleceniauslugi_ibfk_4` FOREIGN KEY (`id_zlecenia`) REFERENCES `zlecenia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
