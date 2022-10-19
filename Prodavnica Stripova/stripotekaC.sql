-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2022 at 04:18 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stripoteka`
--
CREATE DATABASE IF NOT EXISTS `stripoteka` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `stripoteka`;

-- --------------------------------------------------------

--
-- Table structure for table `korpe`
--

CREATE TABLE `korpe` (
  `idArtikla` int(11) NOT NULL,
  `imeArtikla` varchar(50) NOT NULL,
  `cenaArtikla` int(11) NOT NULL,
  `korisnikMail` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korpe`
--

INSERT INTO `korpe` (`idArtikla`, `imeArtikla`, `cenaArtikla`, `korisnikMail`) VALUES
(384, 'Muž i Žena', 270, 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `listazelja`
--

CREATE TABLE `listazelja` (
  `idArtikla` int(11) NOT NULL,
  `imeArtikla` varchar(50) NOT NULL,
  `cenaArtikla` int(11) NOT NULL,
  `korisnikMail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `listazelja`
--

INSERT INTO `listazelja` (`idArtikla`, `imeArtikla`, `cenaArtikla`, `korisnikMail`) VALUES
(73, 'Put Zagonetki', 270, 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `poruke`
--

CREATE TABLE `poruke` (
  `porukaID` int(11) NOT NULL,
  `datumPoruke` date NOT NULL,
  `lokacijaPoruke` varchar(40) NOT NULL,
  `imePoruke` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `racuni`
--

CREATE TABLE `racuni` (
  `racunID` int(11) NOT NULL,
  `datumRacuna` date NOT NULL,
  `lokacijaRacuna` varchar(30) NOT NULL,
  `korisnikMail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `racuni`
--

INSERT INTO `racuni` (`racunID`, `datumRacuna`, `lokacijaRacuna`, `korisnikMail`) VALUES
(48, '2022-04-07', 'racuni/1.txt', 'admin@admin.com'),
(49, '2022-04-07', 'racuni/2.txt', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `stripovi`
--

CREATE TABLE `stripovi` (
  `id` int(11) NOT NULL,
  `brojStripa` int(11) NOT NULL,
  `imeStripa` varchar(100) NOT NULL,
  `cenaStripa` int(11) NOT NULL,
  `kategorijaStripa` varchar(20) NOT NULL,
  `slikaStripa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stripovi`
--

INSERT INTO `stripovi` (`id`, `brojStripa`, `imeStripa`, `cenaStripa`, `kategorijaStripa`, `slikaStripa`) VALUES
(44, 1, 'Knjiga I', 1990, 'knjiga', 'ProdavnicaSlike/knjiga1.jpg'),
(45, 1, 'Put Zagonetki', 270, 'redovno', 'ProdavnicaSlike/redovno1.jpg'),
(46, 2, 'Mračni Naslednik', 270, 'redovno', 'ProdavnicaSlike/redovno2.jpg'),
(47, 3, 'Muž i Žena', 270, 'redovno', 'ProdavnicaSlike/redovno3.jpg'),
(48, 5, 'Gavranova Presuda', 270, 'redovno', 'ProdavnicaSlike/redovno5.jpg'),
(50, 2, 'Knjiga II', 1990, 'knjiga', 'ProdavnicaSlike/knjiga2.jpg'),
(51, 3, 'Kuća Sećanja', 350, 'specijal', 'ProdavnicaSlike/specijal2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idKorisnika` int(11) NOT NULL,
  `ime` varchar(30) NOT NULL,
  `prezime` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `sifra` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idKorisnika`, `ime`, `prezime`, `email`, `sifra`, `status`) VALUES
(1, 'Filip', 'Djokovic', 'admin@admin.com', 'admin', 1),
(7, 'Petar', 'Petrovic', 'pera@gmail.com', '111', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korpe`
--
ALTER TABLE `korpe`
  ADD PRIMARY KEY (`idArtikla`);

--
-- Indexes for table `listazelja`
--
ALTER TABLE `listazelja`
  ADD PRIMARY KEY (`idArtikla`);

--
-- Indexes for table `poruke`
--
ALTER TABLE `poruke`
  ADD PRIMARY KEY (`porukaID`);

--
-- Indexes for table `racuni`
--
ALTER TABLE `racuni`
  ADD PRIMARY KEY (`racunID`);

--
-- Indexes for table `stripovi`
--
ALTER TABLE `stripovi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`),
  ADD KEY `idKorisnika` (`idKorisnika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korpe`
--
ALTER TABLE `korpe`
  MODIFY `idArtikla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `listazelja`
--
ALTER TABLE `listazelja`
  MODIFY `idArtikla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `poruke`
--
ALTER TABLE `poruke`
  MODIFY `porukaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `racuni`
--
ALTER TABLE `racuni`
  MODIFY `racunID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `stripovi`
--
ALTER TABLE `stripovi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idKorisnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
