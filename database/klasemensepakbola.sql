-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Agu 2023 pada 12.53
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klasemensepakbola`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `klasemen`
--

CREATE TABLE `klasemen` (
  `id` int(11) NOT NULL,
  `club_name` varchar(100) DEFAULT NULL,
  `club_city` varchar(100) DEFAULT NULL,
  `played` int(5) DEFAULT 0,
  `win` int(5) DEFAULT 0,
  `lose` int(5) DEFAULT 0,
  `draw` int(5) DEFAULT 0,
  `goals_for` int(5) DEFAULT 0,
  `goals_against` int(5) DEFAULT 0,
  `points` int(5) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `klasemen`
--

INSERT INTO `klasemen` (`id`, `club_name`, `club_city`, `played`, `win`, `lose`, `draw`, `goals_for`, `goals_against`, `points`) VALUES
(5, 'Sriwijaya Fc', 'Palembang', 3, 1, 0, 2, 5, 2, 5),
(6, 'Kalteng Putra', 'Kalimantan', 4, 2, 1, 1, 7, 8, 7),
(7, 'Madura United', 'Madura', 1, 0, 1, 0, 2, 3, 0),
(8, 'Rans Fc', 'Andara', 2, 0, 1, 1, 3, 4, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `score`
--

CREATE TABLE `score` (
  `id` int(11) NOT NULL,
  `club1_id` int(11) NOT NULL,
  `club2_id` int(11) NOT NULL,
  `score1` int(11) DEFAULT 0,
  `score2` int(11) DEFAULT 0,
  `match_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `score`
--

INSERT INTO `score` (`id`, `club1_id`, `club2_id`, `score1`, `score2`, `match_date`) VALUES
(5, 5, 6, 3, 0, '2023-08-05 12:12:31'),
(6, 6, 7, 3, 2, '2023-08-05 12:12:31'),
(7, 8, 5, 1, 1, '2023-08-05 12:12:31'),
(8, 6, 8, 3, 2, '2023-08-05 12:12:31'),
(9, 6, 5, 1, 1, '2023-08-05 12:13:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `klasemen`
--
ALTER TABLE `klasemen`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `score`
--
ALTER TABLE `score`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `klasemen`
--
ALTER TABLE `klasemen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `score`
--
ALTER TABLE `score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
