-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Mar-2016 às 03:50
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalho`
--

CREATE TABLE IF NOT EXISTS `trabalho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nro` varchar(64) NOT NULL,
  `ident` varchar(64) NOT NULL,
  `data` varchar(10) NOT NULL,
  `TIME` decimal(2,2) NOT NULL,
  `SCATE` varchar(10) NOT NULL,
  `FICHEROS` varchar(20) NOT NULL,
  `DESTINO` varchar(20) NOT NULL,
  `CATEGORY` varchar(40) NOT NULL,
  `CLAVE` varchar(20) NOT NULL,
  `NUM` int(11) NOT NULL,
  `PRIORIDAD` char(5) NOT NULL,
  `TITLE` text NOT NULL,
  `TEXT` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
