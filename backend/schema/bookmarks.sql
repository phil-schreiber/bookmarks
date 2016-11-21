-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 21. Nov 2016 um 17:46
-- Server-Version: 10.1.16-MariaDB
-- PHP-Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bookmarks`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookmarks`
--

DROP TABLE IF EXISTS `bookmarks`;
CREATE TABLE `bookmarks` (
  `uid` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `tstamp` int(11) NOT NULL,
  `crdate` int(11) NOT NULL,
  `url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bookmarks_hashtags_mm`
--

DROP TABLE IF EXISTS `bookmarks_hashtags_mm`;
CREATE TABLE `bookmarks_hashtags_mm` (
  `bookmarks_uid` int(11) NOT NULL,
  `hashtags_uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `hashtags`
--

DROP TABLE IF EXISTS `hashtags`;
CREATE TABLE `hashtags` (
  `uid` int(11) NOT NULL,
  `crdate` int(11) NOT NULL,
  `tstamp` int(11) NOT NULL,
  `title` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`uid`);

--
-- Indizes für die Tabelle `bookmarks_hashtags_mm`
--
ALTER TABLE `bookmarks_hashtags_mm`
  ADD PRIMARY KEY (`bookmarks_uid`,`hashtags_uid`),
  ADD KEY `hashtags_uid` (`hashtags_uid`);

--
-- Indizes für die Tabelle `hashtags`
--
ALTER TABLE `hashtags`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `hashtags`
--
ALTER TABLE `hashtags`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `bookmarks_hashtags_mm`
--
ALTER TABLE `bookmarks_hashtags_mm`
  ADD CONSTRAINT `bookmarks_hashtags_mm_ibfk_1` FOREIGN KEY (`bookmarks_uid`) REFERENCES `bookmarks` (`uid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmarks_hashtags_mm_ibfk_2` FOREIGN KEY (`hashtags_uid`) REFERENCES `hashtags` (`uid`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
