-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Giu 17, 2019 alle 16:51
-- Versione del server: 5.7.26-0ubuntu0.16.04.1
-- Versione PHP: 7.0.33-0ubuntu0.16.04.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `s259536`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `infodb`
--

DROP TABLE IF EXISTS `infodb`;
CREATE TABLE `infodb` (
  `id` int(1) DEFAULT NULL,
  `righe` int(11) NOT NULL,
  `colonne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `infodb`
--

INSERT INTO `infodb` (`id`, `righe`, `colonne`) VALUES
(1, 10, 6);

-- --------------------------------------------------------

--
-- Struttura della tabella `statoposti`
--

DROP TABLE IF EXISTS `statoposti`;
CREATE TABLE `statoposti` (
  `posto` varchar(10) NOT NULL,
  `utente` varchar(255) DEFAULT NULL,
  `stato` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `statoposti`
--

INSERT INTO `statoposti` (`posto`, `utente`, `stato`) VALUES
('A4', 'u1@p.it', 1),
('B2', 'u2@p.it', 2),
('B3', 'u2@p.it', 2),
('B4', 'u2@p.it', 2),
('D4', 'u1@p.it', 1),
('F4', 'u2@p.it', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE `utenti` (
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`EMAIL`, `PASSWORD`) VALUES
('u1@p.it', '2439a64be91a99151f6cf065c422d3a4253dd9d3684a5baf1552d35ab93ed348b5093df547202117310369867474a7b8aa4452b6fd278ec342204eaddfe01888'),
('u2@p.it', '6352f1fcc8610fde1d8eb5a3f46dd9daea28c5d46b268b11d2725ff965dfdb70a1d737d21bd61d1f93c4c811a4fdb57d6208e4a1a6c79e986ca54b85f56087a0');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `statoposti`
--
ALTER TABLE `statoposti`
  ADD PRIMARY KEY (`posto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`EMAIL`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
