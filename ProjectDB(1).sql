-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 12. Jun 2017 um 07:26
-- Server-Version: 10.1.16-MariaDB
-- PHP-Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `ProjectDB`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE `bestellung` (
  `BestellungID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Ausstellungsdatum` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Rechnungsnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `bestellung`
--

INSERT INTO `bestellung` (`BestellungID`, `UserID`, `Ausstellungsdatum`, `Rechnungsnummer`) VALUES
(6, 3, '2017-06-10 23:14:03', 5),
(7, 3, '2017-06-10 23:27:00', 5),
(8, 3, '2017-06-10 23:28:20', 5),
(9, 3, '2017-06-10 23:29:35', 5),
(10, 3, '2017-06-10 23:30:04', 5),
(11, 3, '2017-06-10 23:30:43', 5),
(12, 3, '2017-06-10 23:49:07', 5),
(13, 3, '2017-06-10 23:49:56', 5),
(14, 3, '2017-06-10 23:50:50', 5),
(15, 3, '2017-06-10 23:51:50', 5),
(16, 3, '2017-06-10 23:52:29', 5),
(17, 3, '2017-06-10 23:57:02', 5),
(18, 3, '2017-06-10 23:57:45', 5),
(19, 3, '2017-06-10 23:58:03', 5),
(20, 3, '2017-06-10 23:58:27', 5),
(21, 3, '2017-06-11 15:01:36', 0),
(22, 3, '2017-06-11 15:03:59', 0),
(23, 3, '2017-06-11 23:10:46', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bezahldaten`
--

CREATE TABLE `bezahldaten` (
  `UserID` int(11) NOT NULL,
  `BezahldatenID` int(11) NOT NULL,
  `Kontonummer` int(11) NOT NULL,
  `Kreditkartennummer` int(11) NOT NULL,
  `Ablaufdatum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `bezahldaten`
--

INSERT INTO `bezahldaten` (`UserID`, `BezahldatenID`, `Kontonummer`, `Kreditkartennummer`, `Ablaufdatum`) VALUES
(17, 1, 0, 0, '0000-00-00'),
(18, 2, 0, 0, '0000-00-00'),
(19, 3, 0, 0, '0000-00-00'),
(3, 4, 5332, 0, '0000-00-00'),
(3, 5, 0, 83200, '2017-06-15'),
(3, 6, 2147483647, 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gutscheine`
--

CREATE TABLE `gutscheine` (
  `GutscheinID` varchar(5) NOT NULL,
  `Wert` int(11) NOT NULL,
  `Gueltigkeit` date NOT NULL,
  `Eingeloest` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `gutscheine`
--

INSERT INTO `gutscheine` (`GutscheinID`, `Wert`, `Gueltigkeit`, `Eingeloest`) VALUES
('G1234', 50, '2017-06-24', 1),
('6DVii', 70, '0007-08-17', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `position`
--

CREATE TABLE `position` (
  `BestellungID` int(11) NOT NULL,
  `ProduktID` int(11) NOT NULL,
  `Anzahl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `position`
--

INSERT INTO `position` (`BestellungID`, `ProduktID`, `Anzahl`) VALUES
(7, 3, 2),
(7, 4, 2),
(11, 2, 1),
(12, 3, 2),
(15, 3, 2),
(15, 4, 2),
(17, 3, 4),
(17, 4, 10),
(17, 9, 2),
(17, 10, 1),
(20, 3, 1),
(20, 5, 3),
(21, 3, 2),
(22, 7, 2),
(22, 9, 1),
(23, 2, 5),
(23, 3, 2),
(23, 4, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE `produkte` (
  `ProduktID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Beschreibung` text CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `Bewertung` int(11) NOT NULL,
  `Preis` decimal(10,0) NOT NULL,
  `Foto` varchar(50) NOT NULL,
  `KategorieID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`ProduktID`, `Name`, `Beschreibung`, `Bewertung`, `Preis`, `Foto`, `KategorieID`) VALUES
(2, 'Venture Glow', 'Goldarmband 15 Karat\nmit roten oder grünen Perlen', 3, '290', '59365c0540ae3', 3),
(3, 'Bird on a Fence', 'Halskette mit Silberanhänger\nVogelabbildung auf einem Zaun', 5, '55', '59365e3ceea83', 1),
(4, 'Silver Hope', 'Halskette mit Hoffnungsymbol\r\nSilber', 3, '29', '59365e87ae4f2', 1),
(5, 'Simple Beauti', 'Armband mit türkisem Stein\nund Silber Emblem\nLeder', 5, '19', '59365f251e139', 3),
(6, 'Bird on a Fence 2', 'Ohrschmuck\nVogel auf einem Zaun\ntürkiser Stein\n10 Karat Gold', 4, '190', '59365f92bd8df', 4),
(7, 'Golden Balance', 'Ohrschmuck mit Ausgleichsymbol\ntürkieser Stein\n10 Karat Gold', 5, '150', '593661161fc17', 4),
(9, 'Trinity Color', 'Armband mit 3 silber Emblemen\nFarbige Bänder', 5, '22', '593683725d756', 3),
(10, 'Silver Honor', 'Halskette mit silberem Anhänger\nEhre Emblem', 4, '18', '593683ea212a8', 1),
(11, 'Golden Arm', 'Männer Armband\n10 Karat Gold', 5, '249', '5936843762275', 3),
(12, 'Infinite Balance', 'Silberner AnhÃ¤nger mit Emblem für Ausgeglichenheit', 4, '35', '593a5dddb682f', 2),
(13, 'Test', 'Test', 4, '23', '593ab1fa5af44', 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produktkategorie`
--

CREATE TABLE `produktkategorie` (
  `KategorieID` int(11) NOT NULL,
  `Bezeichnung` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `produktkategorie`
--

INSERT INTO `produktkategorie` (`KategorieID`, `Bezeichnung`) VALUES
(1, 'Halsketten'),
(2, 'Anhänger'),
(3, 'Armbänder'),
(4, 'Ohrschmuck');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Anrede` varchar(50) NOT NULL,
  `Vorname` varchar(200) NOT NULL,
  `Nachname` varchar(200) NOT NULL,
  `Adresse` varchar(200) NOT NULL,
  `PLZ` varchar(20) NOT NULL,
  `Ort` varchar(50) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Benutzername` varchar(20) NOT NULL,
  `Passwort` varchar(80) NOT NULL,
  `Admin` tinyint(1) NOT NULL,
  `Activ` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`UserID`, `Anrede`, `Vorname`, `Nachname`, `Adresse`, `PLZ`, `Ort`, `Email`, `Benutzername`, `Passwort`, `Admin`, `Activ`) VALUES
(3, 'Frau', 'Paula', 'Michi', 'Ardess', '1234', 'Örtchen', 'email@mail.at', 'user', '$2y$10$noNr.Wu5UqLq2Rpj8ahp5.g1nGbklnHhoD/TjPyDO0NvdvQCWTaDy', 0, 0),
(4, 'Mann', 'Admin', 'Tester', 'teststraße', '1234', 'testhausen', 'test@adin.at', 'testadmin', '$2y$10$3XKLAU4Z1JNJrgvk8FnlGO/kNs/61sjkURR//zcp6TFU.gQW.P2a2', 1, 0),
(5, 'Herr', 'max', 'muster', ' ', '0', ' ', 'max@muster.at', 'maxMa', '$2y$10$XATjBdudSYfWrhOIOzkXgeGqiIfy/58o35CUNziSsECLlsiEdfZ0e', 0, 0),
(6, 'Frau', 'Max', 'Muster', ' ', '0', ' ', 'muster@mail.de', 'MaxTest', '$2y$10$ktj4Ljsdx4vAUdcFUB5kXu8oh9GpJpTYivSuH2r7aPx1KnaPB4KuC', 0, 0),
(8, 'Frau', 'asd', 'sd', ' ', '0', ' ', 'a@a.at', 'sdcf', '$2y$10$Q5qtaEcf.L1crnhwQSBlJOhi2wBaFrsLPAqThPP6tV1tD.m0dAt1e', 0, 1),
(9, 'Frau', 'asd', 'asd', ' ', '0', ' ', 'a@a.at', 'asdf', '$2y$10$OSc2MxM4XFEl/1m/lue/Xu8L2.iuD3snDFuuVMxhye8lquaPYZU2m', 0, 0),
(10, 'Frau', 'asdf', 'asdf', ' ', '0', ' ', 'a@a.at', 'test', '$2y$10$I2OVEsFdwEU2FUaWfT7RPusSfqv1s9c2Nrgu3RHwo/lIw10hhNwsO', 0, 0),
(13, 'Frau', 'asd', 'asdf', ' ', '0', ' ', 'a@a.at', 'Meh', '$2y$10$KA1HYzM22l3ywfescnx7/eew.qH8LBv./Gu4.skBZINmEC8jvzW4q', 0, 0),
(14, 'Frau', 'sadf', 'asdf', ' ', '0', ' ', 'a@a.at', 'asdfff', '$2y$10$uSfuPWfkMn2k8Z1nvgtiPOynBEU/JvRzu0/h4EQ39G0ojRKJuulBS', 0, 0),
(15, 'Frau', 'fijndv', 'sjnfkvs', ' ', '0', ' ', 'a@a.at', 'fsgbsvc', '$2y$10$jH3IMkDkB2wDYVOYr8ItgerV7PzFDU1KdeCG47UTjgSrqtyfVef1S', 0, 1),
(16, 'Frau', 'jkfnv', 'wjnfv', ' ', '0', ' ', 'a@a.at', 'aökdjvna', '$2y$10$/gkd88MBef2XsWp7gQ9GbuVWNoiTTpD16yhm2GKrIfFTiomHkLndm', 0, 0),
(17, 'Frau', 'fdvsfbg', 'sdfbbs', ' ', '0', ' ', 'a@a.at', 'öjfknv', '$2y$10$8nJ0dhR9po1AGpjpzYpwxOEBpOiDZeiBLM7LVJImtE6l1Prvv4Uai', 0, 0),
(18, 'Frau', 'ökadvn', 'ökfvak', ' ', '0', ' ', 'a@a.at', 'majszd', '$2y$10$SkXd9WhlzfPThFE7WY2gxu62FexjUiXuKW1rKU.Ln/zTl.QdwE4BS', 0, 0),
(19, 'Frau', 'öjnfdv', 'kjfnv', ' ', '0', ' ', 'a@a.at', 'sdfijn', '$2y$10$SYHgmDnsmtUvnwSvAf4N4u0M0s.VkS6zazONzGiwe89vSsTmofXXi', 0, 0),
(20, 'Frau', 'adöflnv', 'svd', 'kjsdvk', '0', ' ', 'a@a.at', 'akdjba', '$2y$10$CDSQ5HyOiIBS6j7G6WHI4emAHUQtTdPTxF5dGmSMi9elZIfrDQXVy', 0, 0),
(21, 'Frau', 'alfdjv', 'kjsfnv', ' ', '0', ' ', 'a@a.at', 'oifvkn', '$2y$10$RUmO74IqSrwiXFIEjTyuFeKzwbzj8U5LllizyEAnVSNXj/tmNeXHm', 0, 0),
(22, 'Frau', 'adfv', 'sdc', ' ', '0', ' ', 'a@a.at', 'mlmlml', '$2y$10$rq3lKXANv4mYCBgnApOT1eEOTfC0E8TD0DOuNmrOb2zep5JIi0E2u', 0, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD PRIMARY KEY (`BestellungID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indizes für die Tabelle `bezahldaten`
--
ALTER TABLE `bezahldaten`
  ADD PRIMARY KEY (`BezahldatenID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indizes für die Tabelle `position`
--
ALTER TABLE `position`
  ADD KEY `BestellungID` (`BestellungID`),
  ADD KEY `ProduktID` (`ProduktID`);

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`ProduktID`),
  ADD KEY `KategorieID` (`KategorieID`);

--
-- Indizes für die Tabelle `produktkategorie`
--
ALTER TABLE `produktkategorie`
  ADD PRIMARY KEY (`KategorieID`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Benutzername` (`Benutzername`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  MODIFY `BestellungID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT für Tabelle `bezahldaten`
--
ALTER TABLE `bezahldaten`
  MODIFY `BezahldatenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `ProduktID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT für Tabelle `produktkategorie`
--
ALTER TABLE `produktkategorie`
  MODIFY `KategorieID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bestellung`
--
ALTER TABLE `bestellung`
  ADD CONSTRAINT `UserProdukt` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints der Tabelle `bezahldaten`
--
ALTER TABLE `bezahldaten`
  ADD CONSTRAINT `User` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints der Tabelle `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `Bestellung` FOREIGN KEY (`BestellungID`) REFERENCES `bestellung` (`BestellungID`),
  ADD CONSTRAINT `ProduktPosition` FOREIGN KEY (`ProduktID`) REFERENCES `produkte` (`ProduktID`);

--
-- Constraints der Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD CONSTRAINT `Kategorie` FOREIGN KEY (`KategorieID`) REFERENCES `produktkategorie` (`KategorieID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
