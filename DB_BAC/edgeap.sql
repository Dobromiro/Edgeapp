-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 09 Mar 2023, 14:52
-- Wersja serwera: 10.4.19-MariaDB
-- Wersja PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `edgeap`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `data`
--

CREATE TABLE `data` (
  `DATE` date NOT NULL,
  `TIME` time NOT NULL,
  `DEFECT` varchar(100) NOT NULL,
  `CATEGORY` varchar(50) NOT NULL,
  `MODEL` varchar(50) NOT NULL,
  `OPERATOR` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `data`
--

INSERT INTO `data` (`DATE`, `TIME`, `DEFECT`, `CATEGORY`, `MODEL`, `OPERATOR`) VALUES
('0000-00-00', '00:00:00', 'RYSA', 'LGP', '28A', 'ANNA MODUŁOWA'),
('2023-03-08', '13:28:44', 'RYSA', 'LGP', '28A', 'SUPERMAN'),
('2023-03-08', '13:29:25', 'RYSA', 'LGP', '28A', 'SUPERMAN'),
('2023-03-08', '13:29:57', 'RYSA', 'LGP', '28A', 'SUPERMAN'),
('2023-03-09', '11:39:06', 'RYSA', 'LGP', '28A', 'SUPERMAN'),
('2023-03-09', '12:07:12', 'RYSA', 'LGP', '28A', 'SUPERMAN');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
