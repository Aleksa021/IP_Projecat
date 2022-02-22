-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2022 at 04:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `nekretnina`
--

CREATE TABLE `nekretnina` (
  `id_nekretnina` int(10) NOT NULL,
  `korisnicko_ime_n` varchar(20) COLLATE utf8_bin NOT NULL,
  `naziv` varchar(100) COLLATE utf8_bin NOT NULL,
  `id_grad` int(10) NOT NULL,
  `id_opstina` int(10) NOT NULL,
  `id_mikrolokacija` int(10) NOT NULL,
  `id_ulica` int(10) NOT NULL,
  `tip` varchar(10) COLLATE utf8_bin NOT NULL,
  `soba` float NOT NULL,
  `kvadratura` int(11) NOT NULL,
  `godina` int(11) NOT NULL,
  `stanje` varchar(10) COLLATE utf8_bin NOT NULL,
  `sprat` int(10) NOT NULL,
  `max_sprat` int(10) NOT NULL,
  `cena` int(15) NOT NULL,
  `opis` varchar(500) COLLATE utf8_bin NOT NULL,
  `prodato` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `nekretnina`
--

INSERT INTO `nekretnina` (`id_nekretnina`, `korisnicko_ime_n`, `naziv`, `id_grad`, `id_opstina`, `id_mikrolokacija`, `id_ulica`, `tip`, `soba`, `kvadratura`, `godina`, `stanje`, `sprat`, `max_sprat`, `cena`, `opis`, `prodato`) VALUES
(10, 'Aleksa212', 'Garsonjera na Paliluli', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 40000, 'Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(11, 'radekic321', 'Stan 8', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 240000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vel leo scelerisque, pellentesque mauris elementum, pharetra ex. Curabitur ornare dui in iaculis dictum. Proin nec accumsan nibh, id condimentum dolor. Donec sed leo ac tortor fermentum luctus. Praesent ut cursus metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nunc.', 1),
(12, 'radekic321', 'Stan 9', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 80000, 'Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(13, 'radekic321', 'Stan 10', 1, 7, 19, 30, 'stan', 1, 24, 1996, 'izvorno', 6, 6, 300000, '                                                                Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakulteta111a.                                                                                        ', 0),
(14, 'radekic321', 'Stan 11', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 50000, '                                                                                \r\n        Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(15, 'denja99', 'Stan 1', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 200000, '', 0),
(16, 'denja99', 'Stan 2', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 50000, '                                             Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(17, 'denja99', 'Stan 3', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 60000, '                                                                                \r\n        Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(18, 'kjankovic3', 'Stan 4', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 10000, '                                                                                \r\n        Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(19, 'kjankovic3', 'Stan 5', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 80000, '                                                                                \r\n        Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(20, 'kjankovic3', 'Stan 6', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 300000, '                                                                                \r\n        Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(21, 'kjankovic3', 'Stan 7', 1, 7, 19, 30, 'stan', 1, 241, 1996, 'izvorno', 6, 6, 150000, 'Garsonjera na Paliluli od 24 m2. Neposredno u blizini Pravnog fakultetaa.                                                    ', 0),
(22, 'selena123', 'Jednosoban stan u Zemunu', 1, 8, 17, 24, 'stan', 1, 29, 2013, 'izvorno', 2, 5, 100000, 'Jednosoban stan u Zemunu, grejanje na gas, PVC stolarija, izolacija ', 0),
(23, 'selena123', 'Trosoban stan na Vracaru', 1, 6, 18, 27, 'stan', 3, 100, 1986, 'renovirano', 1, 4, 500000, 'Stan je renoviran prošle godine, ima izolaciju i PVC stolariju i pogled na hram Svetog Save', 0),
(24, 'selena123', 'Jednospratna kuca u Zemunu', 1, 8, 17, 25, 'kuca', 3, 100, 1990, 'renovirano', 1, 1, 450000, 'Jednospratna kuca, ima dvoriste, grejanje na drva                \r\n            ', 0),
(25, 'selena123', 'Garsonjera - Zemun', 1, 8, 17, 26, 'stan', 1, 30, 1999, 'izvorno', 2, 7, 90000, 'Izolacija, PVC stolarija, grejanje na struju, mali troškovi            ', 0),
(26, 'selena123', 'Trosoban stan LUX Zemun', 1, 8, 17, 24, 'stan', 3, 120, 2018, 'izvorno', 4, 4, 350000, 'Nov stan zavrsen 2018. godine, u sklopu zgrade teretana, centralno grejanje    ', 0),
(27, 'd.nedaaa', 'Trosoban stan na Vracaru', 1, 6, 18, 27, 'stan', 3, 92, 1990, 'renovirano', 2, 5, 500000, 'Stan je renoviran, sadrzi PVC stolariju i izolaciju, centralno grejanje   ', 0),
(28, 'd.nedaaa', 'Garsonjera na Vračaru', 1, 6, 18, 28, 'stan', 1, 22, 1995, 'izvorno', 1, 5, 200000, 'Stan sadrzi centralno grejanje  ', 0),
(29, 'd.nedaaa', 'Dvosoban LUX stan na Vračaru', 1, 6, 18, 28, 'stan', 2, 61, 2020, 'LUX', 3, 3, 600000, 'Grejanje na struju, izolacija                \r\n            ', 0),
(30, 'andja123', 'Garsonjera na Paliluli', 1, 7, 19, 30, 'stan', 1, 26, 2002, 'izvorno', 5, 6, 200000, 'Stan sadrži izolaciju i podno grejanje', 0),
(31, 'andja123', 'Dvosoban LUX stan na Paliluli', 1, 7, 19, 31, 'stan', 2, 56, 2019, 'LUX', 4, 5, 500000, 'Internet, interfon, klima, parking garaža ', 0),
(32, 'andja123', 'Jednoiposoban stan - Palilula', 1, 7, 19, 31, 'stan', 1, 41, 1990, 'renovirano', 5, 5, 200000, ' Interfon, klima, PVC stolarija, izolacija, grejanje na struju    ', 0),
(33, 'andja123', 'Kuca na Paliluli', 1, 7, 19, 31, 'kuca', 3, 110, 1980, 'renovirano', 2, 2, 600000, 'Klima uredjaj na oba sprata, garaza i malo dvoriste, grejanje na gas   ', 0),
(34, 'milica123', 'Cetvorosobna kuca u Mladenovcu', 1, 5, 16, 21, 'kuca', 4, 170, 1975, 'renovirano', 2, 2, 600000, 'Izolacija, PVC stolarija, garaža i šupa, dvorište sa bazenom', 1),
(35, 'milica123', 'Garsonjera - Mladenovac', 1, 5, 16, 22, 'stan', 1, 30, 2006, 'izvorno', 1, 4, 200000, 'Klima, garaža, grejanje na struju ', 0),
(36, 'milica123', 'Jednoiposoban stan u Mladenovcu', 1, 5, 16, 23, 'stan', 1.5, 50, 2000, 'izvorno', 2, 3, 500000, 'Grejanje - TA peć, parking mesto ispred zgrade    \r\n            ', 0),
(37, 'milica123', 'Vikendica u Mladenovcu LUX', 1, 5, 16, 27, 'vikendica', 3, 120, 2019, 'izvorno', 2, 2, 550000, 'Izolacija,klima, garaža, dvorište,velika terasa i pogled na Kosmaj', 0),
(38, 'milica123', 'Vikendica u Mladenovcu LUX', 1, 5, 16, 22, 'vikendica', 3, 120, 2019, 'izvorno', 2, 2, 550000, 'Klima uređaj, garaža, dvorište, terasa sa pogledom na Kosmaj', 0),
(39, 'kj2004', 'Garsonjera - Crveni Krst', 1, 13, 33, 72, 'stan', 1, 26, 2004, 'izvorno', 3, 5, 120000, 'Centralno grejanje, klima uredjaj\r\n', 0),
(40, 'kj2004', 'Jednoiposoban stan - Crveni krst', 1, 13, 33, 72, 'stan', 1.5, 45, 1990, 'renovirano', 2, 4, 160000, 'Grejanje na gas, dobra povezanost sa gradskim prevozom ', 0),
(41, 'kj2004', 'Dvosoban stan na Crvenom Krstu', 1, 13, 33, 72, 'stan', 2, 56, 1994, 'renovirano', 1, 6, 300000, 'PVC stolarija, izolacija, potpuno opremljen stan', 0),
(42, 'kj2004', 'Kuca - Crveni Krst', 1, 13, 33, 72, 'kuca', 3, 100, 1990, 'renovirano', 2, 2, 600000, 'Odmah preko puta kuce nalazi se autobuska stanica, izolacija, klima uredjaj na svakom spratu    ', 0),
(43, 'kj2004', 'LUX stan - Crveni Krst', 1, 13, 33, 72, 'stan', 4, 150, 2017, 'izvorno', 5, 5, 800000, 'U sklopu zgrade teretana i bazen, parking mesto u garazi, klima uredjaj i izolacija, centralno grejanje         \r\n            ', 0),
(44, 'veljko', 'Garsonjera - Vojvode Stepe', 1, 3, 23, 61, 'stan', 1, 31, 1994, 'renovirano', 4, 5, 300000, 'Dobra povezanost linijama 33, 9, 10, 14', 0),
(45, 'veljko', 'Jednoiposoban stan - Autokomanda', 1, 3, 23, 60, 'stan', 1.5, 54, 2005, 'izvorno', 2, 5, 200000, 'Grejanje na gas, klima uredjaj           \r\n            ', 0),
(46, 'veljko', 'Garsonjera na Vozdovcu', 1, 3, 23, 60, 'stan', 1, 24, 2013, 'izvorno', 3, 3, 200000, 'Klima uredjaj, grejanje na gas, povezanost linijama 18, 25 i 39   ', 0),
(47, 'veljko', 'Trosoban stan Vozdovac', 1, 3, 23, 60, 'stan', 3, 87, 2004, 'izvorno', 6, 6, 500000, 'Parking mesto u garazi, dve terase sa prelepim pogledom, lift, interfon   ', 0),
(69, 'aleksa21', 'Sto', 1, 8, 22, 55, 'stan', 1, 1, 1, 'izvorno', 1, 10, 100000, '123', 0),
(70, 'aleksa21', 'STAN NOV', 1, 8, 22, 55, 'vikendica', 2, 100, 2000, 'LUX', 5, 10, 150000, 'opis', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD PRIMARY KEY (`id_nekretnina`),
  ADD KEY `korisnik_nekretnine` (`korisnicko_ime_n`),
  ADD KEY `id_grad` (`id_grad`),
  ADD KEY `id_opstina` (`id_opstina`),
  ADD KEY `id_mikrolokacija` (`id_mikrolokacija`),
  ADD KEY `id_ulica` (`id_ulica`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nekretnina`
--
ALTER TABLE `nekretnina`
  MODIFY `id_nekretnina` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD CONSTRAINT `nekretnina_ibfk_1` FOREIGN KEY (`id_ulica`) REFERENCES `ulica` (`id_ulica`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nekretnina_ibfk_2` FOREIGN KEY (`id_grad`) REFERENCES `grad` (`id_grad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nekretnina_ibfk_3` FOREIGN KEY (`id_mikrolokacija`) REFERENCES `mikrolokacija` (`id_mikrolokacija`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nekretnina_ibfk_4` FOREIGN KEY (`id_opstina`) REFERENCES `opstina` (`id_opstina`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nekretnina_ibfk_5` FOREIGN KEY (`korisnicko_ime_n`) REFERENCES `korisnik` (`korisnicko_ime`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
