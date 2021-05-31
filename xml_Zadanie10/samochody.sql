SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;

CREATE TABLE IF NOT EXISTS `marki` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `marki` (`id`, `nazwa`) VALUES
(1, 'Fiat'),
(2, 'Volkswagen'),
(3, 'Mazda'),
(4, 'Skoda');

CREATE TABLE IF NOT EXISTS `modele` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nazwa` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `modele` (`id`, `nazwa`) VALUES
(1, 'Punto'),
(2, 'Passat'),
(3, '626'),
(4, 'Fabia');

CREATE TABLE IF NOT EXISTS `samochody` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marka` varchar(50) NOT NULL,
  `model` varchar(100) NOT NULL,
  `rok` int(11) NOT NULL,
  `pojemnosc` float NOT NULL,
  `typ_silnika` enum('benzyna','diesel') NOT NULL,
  `liczba_poduszek` int(11) NOT NULL,
  `abs` enum('tak','nie') NOT NULL,
  `esp` enum('tak','nie') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `samochody` (`id`, `marka`, `model`, `rok`, `pojemnosc`, `typ_silnika`, `liczba_poduszek`, `abs`, `esp`) VALUES
(1, '1', '1', 1995, 1.2, 'benzyna', 0, 'nie', 'nie'),
(2, '2', '2', 2002, 1.9, 'diesel', 4, 'tak', 'tak'),
(3, '3', '3', 1997, 2, 'diesel', 1, 'tak', 'nie'),
(4, '4', '4', 2000, 1.4, 'benzyna', 2, 'tak', 'nie');

CREATE TABLE IF NOT EXISTS `samochody2`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marka` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `rok` int(11) NOT NULL,
  `pojemnosc` float NOT NULL,
  `typ_silnika` enum('benzyna','diesel') NOT NULL,
  `liczba_poduszek` int(11) NOT NULL,
  `abs` enum('tak','nie') NOT NULL,
  `esp` enum('tak','nie') NOT NULL,
  PRIMARY KEY  (`id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `samochody2` (`id`, `marka`, `model`, `rok`, `pojemnosc`, `typ_silnika`, `liczba_poduszek`, `abs`, `esp`) VALUES
(1, '1', '1', 1995, 1.2, 'benzyna', 0, 'nie', 'nie'),
(2, '2', '2', 2002, 1.9, 'diesel', 4, 'tak', 'tak'),
(3, '3', '3', 1997, 2, 'diesel', 1, 'tak', 'nie'),
(4, '4', '4', 2000, 1.4, 'benzyna', 2, 'tak', 'nie');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
