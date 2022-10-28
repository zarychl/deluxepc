-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Paź 2022, 14:29
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `dpc`
--

--
-- Zrzut danych tabeli `klienci`
--

INSERT INTO `klienci` (`id`, `nazwa`, `nip`, `ulica`, `kod`, `miasto`, `tel1`, `tel2`, `mail`, `uwagi`, `created_at`, `edited_at`, `deleted_at`) VALUES
(5, 'Jan Kowalski', NULL, 'ulica', '22312', 'Krosno', '123321123', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Zrzut danych tabeli `pracownicy`
--

INSERT INTO `pracownicy` (`id`, `nazwisko`, `imie`, `haslo`, `stanowisko`, `uwagi`, `mail`, `created_at`, `edited_at`, `deleted_at`) VALUES
(1, 'Zarych', 'Łukasz', '', 0, 'Szef wszystkich szefów :)', 'serwis_dpc@outlook.com', NULL, NULL, NULL);

--
-- Zrzut danych tabeli `uslugi`
--

INSERT INTO `uslugi` (`id`, `nazwa`, `jednostka`, `vat`, `cena_brutto`) VALUES
(1, 'Diagnoza', 'u.', 23, '20.00'),
(2, 'Aktualizacja BIOS', 'u.', 23, '30.00'),
(3, 'Archiwizacja danych', 'u.', 23, '20.00'),
(4, 'Czyszczenie, wymiana pasty termoprzewodzącej (Stacjonarny)', 'u.', 23, '20.00'),
(5, 'Wymiana pamięci RAM/Zasilacza/Dysku/Karty graficznej/Płyty głównej (Stacjonarny)', 'u.', 23, '10.00'),
(6, 'Instalacja systemu operacyjnego (bez archiwizacji)', 'u.', 23, '20.00'),
(7, 'Czyszczenie, wymiana pasty termoprzewodzącej/termopadów (Laptop)', 'u.', 23, '20.00'),
(8, 'Naprawa płyty głównej/Zasilacza (Laptop)', 'u.', 23, '20.00'),
(9, 'Naprawa/Wymiana gniazda zasilającego (Laptop)', 'u.', 23, '15.00'),
(10, 'Wymiana pamięci RAM/Zasilacza/Dysku (Laptop)', 'u.', 23, '20.00'),
(11, 'Wymiana płyty głównej', 'u.', 23, '40.00'),
(12, 'Wymiana klawiatury (Laptop)', 'u.', 23, '30.00'),
(13, 'Wymiana matrycy (Laptop)', 'u.', 23, '40.00'),
(14, 'Wymiana obudowy (Laptop)', 'u.', 23, '50.00');

--
-- Zrzut danych tabeli `zlecenia`
--

INSERT INTO `zlecenia` (`id`, `nazwa`, `serial`, `opis_usterki`, `data_przyjecia`, `dni_naprawy`, `czy_gwarancja`, `czy_ekspres`, `czy_zewn`, `czy_opak`, `czy_kable`, `czy_zasilacz`, `czy_plyty`, `wyp_inne`, `data_naprawy`, `uwagi`, `id_klient`, `id_serwisant`, `updated_at`, `deleted_at`, `status`, `opis_naprawy`, `data_odbioru`) VALUES
(7, '2', '3', '4', '2022-04-23 14:04:32', 0, 0, 0, 0, 0, 0, 0, 0, '', NULL, '', 5, 1, NULL, NULL, 1, NULL, NULL),
(8, 'ASUS R540LJ', '123DFDS1144', 'Nie działa :(', '2022-04-20 14:40:37', 7, 0, 1, 0, 0, 0, 1, 0, 'torba', '2022-04-22 14:42:54', '', 5, 1, NULL, NULL, 2, NULL, NULL),
(9, 'Komputer NOX', '', 'Wymiana RAM', '2022-04-24 14:42:50', 2, 0, 0, 0, 0, 1, 0, 0, 'nowe kości RAM', '2022-10-28 02:22:53', '', 5, 1, '2022-10-28 14:29:07', NULL, 3, 'super działa polecam', '2022-10-28 02:29:07');
COMMIT;
