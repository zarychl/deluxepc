-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Lut 2023, 13:04
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
(5, 'Jan Kowalski', NULL, 'Krakowska 22', '38-400', 'Krosno', '123321123', NULL, 'kowal@example.com', NULL, NULL, NULL, NULL),
(6, 'Adam Nowak', NULL, 'Słoneczna 18', '38-422', 'Krościenko Wyżne', '123456341', NULL, 'nowaka@example.com', NULL, NULL, NULL, NULL),
(7, 'Jan Nowak', '4342345334', 'Kolejowa 22', '38-400', 'Krosno', '123634587', '', 'jn@example.com', '', NULL, NULL, NULL);

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
(26, 'HP Elitebook G5', '123ABC456', 'Nie uruchamia się, brak zasilania', '2023-02-07 13:56:55', 1, 0, 0, 0, 0, 0, 0, 0, 'Torba', NULL, '', 6, 2, '2023-02-09 04:53:42', NULL, 1, 'Wymieniono gniazdo zasilania', NULL),
(27, 'Komputer Dell', '123AAA321', 'Czyszczenie, wymiana pasty termoprzewodzącej', '2023-02-07 14:01:29', NULL, 0, 0, 0, 0, 1, 0, 0, NULL, NULL, NULL, 5, 1, NULL, NULL, 0, NULL, NULL),
(28, 'Komputer SPC', NULL, 'Dołożenie pamięci RAM', '2023-02-07 14:03:34', NULL, 0, 1, 0, 0, 0, 0, 0, 'Pamięć RAM 8GB DDR3 do zamontowania', '2023-02-07 07:04:24', NULL, 6, 1, '2023-02-07 07:04:24', NULL, 2, '', NULL);

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
(22, 26, 9, '1.00', '30.00', NULL, NULL, NULL),
(23, 28, 5, '1.00', '20.00', NULL, NULL, NULL),
(24, 27, 7, '2.00', '15.00', NULL, NULL, '2023-02-07 07:08:39'),
(25, 27, 4, '2.00', NULL, NULL, NULL, '2023-02-09 05:11:22'),
(26, 26, 1, '1.00', NULL, NULL, NULL, '2023-02-09 04:54:53'),
(27, 26, 1, '1.00', '1.00', NULL, NULL, NULL),
(28, 26, 1, '1.00', NULL, NULL, NULL, '2023-02-09 04:57:43');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT dla tabeli `zleceniauslugi`
--
ALTER TABLE `zleceniauslugi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
