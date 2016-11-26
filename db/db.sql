-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2016 at 02:03 AM
-- Server version: 5.5.41-log
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `poliqa`
--

-- --------------------------------------------------------

--
-- Table structure for table `aprobaciones`
--

CREATE TABLE IF NOT EXISTS `aprobaciones` (
  `codigo` int(11) NOT NULL,
  `eslabon` int(11) NOT NULL,
  `entrada` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `comentario` varchar(45) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cadena_aprobacion`
--

CREATE TABLE IF NOT EXISTS `cadena_aprobacion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entrada`
--

CREATE TABLE IF NOT EXISTS `entrada` (
  `codigo` int(11) NOT NULL DEFAULT '0',
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(45) NOT NULL,
  `HTML` longtext NOT NULL,
  `JSON` longtext NOT NULL,
  `entrada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eslabon_aprobacion`
--

CREATE TABLE IF NOT EXISTS `eslabon_aprobacion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `cadena_aprobacion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `etiquetas`
--

CREATE TABLE IF NOT EXISTS `etiquetas` (
  `codigo` int(11) NOT NULL,
  `valor` varchar(45) NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `etiqueta_entrada`
--

CREATE TABLE IF NOT EXISTS `etiqueta_entrada` (
  `codigo` int(11) NOT NULL,
  `palabra_codigo` int(11) NOT NULL,
  `entrada_codigo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aprobaciones`
--
ALTER TABLE `aprobaciones`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `cadena_aprobacion`
--
ALTER TABLE `cadena_aprobacion`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `entrada`
--
ALTER TABLE `entrada`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `eslabon_aprobacion`
--
ALTER TABLE `eslabon_aprobacion`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `etiquetas`
--
ALTER TABLE `etiquetas`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `etiqueta_entrada`
--
ALTER TABLE `etiqueta_entrada`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`codigo`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
