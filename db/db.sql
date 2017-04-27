-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2017 at 04:09 AM
-- Server version: 5.5.49-log
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
CREATE SCHEMA IF NOT EXISTS `poliqa` DEFAULT CHARACTER SET latin1 ;
USE `poliqa` ;
--
-- Database: `poliqa`
--

-- --------------------------------------------------------

--
-- Table structure for table `aprobaciones`
--

CREATE TABLE IF NOT EXISTS `aprobaciones` (
  `codigo` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `comentario` varchar(45) NOT NULL,
  `eslabon_aprobacion` int(11) NOT NULL,
  `entrada` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aprobaciones`
--

INSERT INTO `aprobaciones` (`codigo`, `estado`, `comentario`, `eslabon_aprobacion`, `entrada`) VALUES
(1, 1, '', 5, 1),
(2, 0, '', 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cadena_aprobacion`
--

CREATE TABLE IF NOT EXISTS `cadena_aprobacion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cadena_aprobacion`
--

INSERT INTO `cadena_aprobacion` (`codigo`, `nombre`, `estado`) VALUES
(1, 'Check 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `entrada`
--

CREATE TABLE IF NOT EXISTS `entrada` (
  `codigo` int(11) NOT NULL,
  `titulo_listado` varchar(100) DEFAULT NULL,
  `descripcion_listado` varchar(450) DEFAULT NULL,
  `pregunta` longtext,
  `respuesta` longtext,
  `fecha_inicial` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `usuario` int(10) unsigned zerofill NOT NULL,
  `entrada` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entrada`
--

INSERT INTO `entrada` (`codigo`, `titulo_listado`, `descripcion_listado`, `pregunta`, `respuesta`, `fecha_inicial`, `fecha_final`, `estado`, `tipo`, `usuario`, `entrada`) VALUES
(1, '¿Por que las rosas son rojas?', ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '<h2>¿como crear una pregunta?</h2>\r\n<table>\r\n<tbody>\r\n<tr>\r\n <td><img src="http://localhost:81/PoliQa/poliQa/web/img/583bedfb0cf06.jpg" width="677" height="155" style="width: 677px; height: 155px;">\r\n </td>\r\n <td>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.<span class="redactor-invisible-space"><br></span>\r\n  </td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><br>\r\n</p>', '<p>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>\r\n<p>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n</p>\r\n<iframe width="560" height="315" src="https://www.youtube.com/embed/hQpHe4LM9FM" frameborder="0" allowfullscreen="" style="margin-bottom: 15px; font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif;">\r\n</iframe>\r\n<p><strong>orem ipsum dolor sit amet</strong>, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea <strong>commodoonsequat</strong>. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p>\r\n<h2>Anexos</h2>\r\n<p><a href="http://localhost:81/PoliQa/poliQa/web/files/583beefbcef46.docx">Archivo1</a><span class="redactor-invisible-space"> | <a href="http://localhost:81/PoliQa/poliQa/web/files/583bef16000b6.docx">Archivo 2</a></span>\r\n</p>', '2016-11-27', '2016-11-30', 1, 1, 0000000002, NULL),
(2, '¿como crear una pregunta?', 'orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '<h2>¿como crear una pregunta?</h2><table>\r\n<tbody>\r\n<tr>\r\n <td><img src="http://localhost:81/PoliQa/poliQa/web/img/583bedfb0cf06.jpg" width="677" height="155" style="width: 677px; height: 155px;">\r\n </td>\r\n <td>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.<span class="redactor-invisible-space"><br></span>\r\n  </td>\r\n</tr>\r\n</tbody>\r\n</table><p><br>\r\n</p>', '<p>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p><p>orem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodoonsequat. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum\r\n</p><iframe width="560" height="315" src="https://www.youtube.com/embed/hQpHe4LM9FM" frameborder="0" allowfullscreen="" style="margin-bottom: 15px; font-family: Arial, Helvetica, Verdana, Tahoma, sans-serif;">\r\n</iframe><p><strong>orem ipsum dolor sit amet</strong>, consectetur adipisicing elit, sed do eiusmodempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,uis nostrud exercitation ullamco laboris nisi ut aliquip ex ea <strong>commodoonsequat</strong>. Duis aute irure dolor in reprehenderit in voluptate velit esseillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat nonroident, sunt in culpa qui officia deserunt mollit anim id est laborum.\r\n</p><h2>Anexos</h2><p><a href="http://localhost:81/PoliQa/poliQa/web/files/583beefbcef46.docx">Archivo1</a><span class="redactor-invisible-space"> | <a href="http://localhost:81/PoliQa/poliQa/web/files/583bef16000b6.docx">Archivo 2</a></span>\r\n</p>', '2016-11-27', '2016-12-18', 0, 1, 0000000002, NULL),
(3, 'Titulo', NULL, '<p>¿Cuál es el título de esta película?</p><p><br></p><iframe width="560" height="315" src="https://www.youtube.com/embed/7shgsAkX-jI?rel=0&showinfo=0" frameborder="0" allowfullscreen=""></iframe>', '<p>Virgen a los cuarenta</p>', '2016-11-28', '2016-12-08', 0, 1, 0000000002, NULL),
(4, 'Titulo', NULL, '<p>¿Cómo se llama esta película?</p><p><img src="https://i.blogs.es/54dc60/the-sorcerers-apprentice-poster-2010-critica/original.jpg" width="425" height="279"><br></p>', '<p>El aprendiz del brujo.</p>', '2016-11-29', '2016-12-10', 0, 1, 0000000002, NULL),
(5, 'Titulo', NULL, '<p>Nombre que recibe la energía que nos brinda el sol</p>', '<p><img src="https://thumbs.dreamstime.com/z/word-solar-solar-energy-panels-white-background-66715844.jpg" alt="Imagen relacionada" width="296" height="170" style="width: 296px; height: 170px; margin: 0px 10px 10px 0px; float: left;"></p>', '2016-11-24', '2016-12-06', 0, 1, 0000000002, NULL),
(6, 'Titulo', NULL, '<p>¿Con quién vive la chica de la imagen? </p><p><img src="http://img.lum.dolimg.com/v1/images/open-uri20150422-20810-r1443i_baf1276f.jpeg?region=0,0,600,600&width=320"><br><br></p>', '<p>Col los 7 enanitos </p><p><img src="http://static.t13.cl/images/sizes/1200x675/1430233340_1440blancanieves.jpg" alt="Resultado de imagen para blanca nieves" style="width: 444px; height: 438px; display: block; margin: auto;" width="444" height="438"><br></p>', '2016-12-08', '2016-12-10', 0, 1, 0000000002, NULL),
(7, '¿Nombre de la cantante?', 'Pista: Tan solo son tres palabras ', '<p><iframe width="560" height="315" src="https://www.youtube.com/embed/31crA53Dgu0?rel=0&showinfo=0" frameborder="0" allowfullscreen=""></iframe><br></p>', '<p><img src="http://revistametronomo.com/wp-content/uploads/2016/05/Sia.jpg" alt="Resultado de imagen para sia" width="191" height="142" style="width: 191px; height: 142px;"><span class="redactor-invisible-space"></span></p><p><strong>SIA</strong></p>', '2016-11-01', '2016-11-11', 0, 1, 0000000002, NULL),
(8, '¿el porque de los comentarios?', 'lorem', 'lorem', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2016-11-29', '2016-11-29', 1, 2, 0000000002, 1);

-- --------------------------------------------------------

--
-- Table structure for table `eslabon_aprobacion`
--

CREATE TABLE IF NOT EXISTS `eslabon_aprobacion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `cadena_aprobacion` int(11) NOT NULL,
  `usuario` int(10) unsigned zerofill NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eslabon_aprobacion`
--

INSERT INTO `eslabon_aprobacion` (`codigo`, `nombre`, `cadena_aprobacion`, `usuario`) VALUES
(5, 'eslabon1', 1, 0000000002);

-- --------------------------------------------------------

--
-- Table structure for table `etiqueta`
--

CREATE TABLE IF NOT EXISTS `etiqueta` (
  `codigo` int(11) NOT NULL,
  `valor` varchar(45) NOT NULL,
  `tipo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etiqueta`
--

INSERT INTO `etiqueta` (`codigo`, `valor`, `tipo`) VALUES
(20, 'COMIDA', 1),
(21, 'MáS COMIDA', 1),
(22, 'COMIDA', 2),
(23, 'MáS COMIDA', 2);

-- --------------------------------------------------------

--
-- Table structure for table `etiqueta_entrada`
--

CREATE TABLE IF NOT EXISTS `etiqueta_entrada` (
  `codigo` int(11) NOT NULL,
  `entrada` int(11) NOT NULL,
  `etiqueta` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etiqueta_entrada`
--

INSERT INTO `etiqueta_entrada` (`codigo`, `entrada`, `etiqueta`) VALUES
(20, 1, 20),
(21, 1, 21),
(22, 1, 22),
(23, 1, 23),
(24, 2, 20),
(25, 2, 21),
(26, 2, 22),
(27, 2, 23);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`codigo`, `nombre`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'Editor', 1),
(3, 'Usuario', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `codigo` int(10) unsigned zerofill NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `usuario` varchar(45) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `rol` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`codigo`, `nombre`, `apellido`, `email`, `usuario`, `contrasena`, `rol`) VALUES
(0000000001, 'Diego', 'Gonzalez', 'Dgonzalezwk@gmail.com', 'digonzalez6', 'cGFzc3cwcmQ=', 1),
(0000000002, 'juan', 'rondon', 'juna.rondon@gmail.com', 'jurondon', 'cGFzc3cwcmQ=', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aprobaciones`
--
ALTER TABLE `aprobaciones`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_aprobaciones_eslabon_aprobacion1` (`eslabon_aprobacion`),
  ADD KEY `fk_aprobaciones_entrada1` (`entrada`);

--
-- Indexes for table `cadena_aprobacion`
--
ALTER TABLE `cadena_aprobacion`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `entrada`
--
ALTER TABLE `entrada`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_entrada_entrada1` (`entrada`),
  ADD KEY `fk_entrada_usuario1` (`usuario`);

--
-- Indexes for table `eslabon_aprobacion`
--
ALTER TABLE `eslabon_aprobacion`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_eslabon_aprobacion_cadena_aprobacion` (`cadena_aprobacion`),
  ADD KEY `fk_eslabon_aprobacion_usuario1` (`usuario`);

--
-- Indexes for table `etiqueta`
--
ALTER TABLE `etiqueta`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `etiqueta_entrada`
--
ALTER TABLE `etiqueta_entrada`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_etiqueta_entrada_entrada` (`entrada`),
  ADD KEY `fk_etiqueta_entrada_etiquetas1` (`etiqueta`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `fk_usuario_rol1` (`rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aprobaciones`
--
ALTER TABLE `aprobaciones`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `cadena_aprobacion`
--
ALTER TABLE `cadena_aprobacion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `entrada`
--
ALTER TABLE `entrada`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `eslabon_aprobacion`
--
ALTER TABLE `eslabon_aprobacion`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `etiqueta`
--
ALTER TABLE `etiqueta`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `etiqueta_entrada`
--
ALTER TABLE `etiqueta_entrada`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `aprobaciones`
--
ALTER TABLE `aprobaciones`
  ADD CONSTRAINT `fk_aprobaciones_entrada1` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aprobaciones_eslabon_aprobacion1` FOREIGN KEY (`eslabon_aprobacion`) REFERENCES `eslabon_aprobacion` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `entrada`
--
ALTER TABLE `entrada`
  ADD CONSTRAINT `fk_entrada_entrada1` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_entrada_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eslabon_aprobacion`
--
ALTER TABLE `eslabon_aprobacion`
  ADD CONSTRAINT `fk_eslabon_aprobacion_cadena_aprobacion` FOREIGN KEY (`cadena_aprobacion`) REFERENCES `cadena_aprobacion` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_eslabon_aprobacion_usuario1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etiqueta_entrada`
--
ALTER TABLE `etiqueta_entrada`
  ADD CONSTRAINT `fk_etiqueta_entrada_entrada` FOREIGN KEY (`entrada`) REFERENCES `entrada` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_etiqueta_entrada_etiquetas1` FOREIGN KEY (`etiqueta`) REFERENCES `etiqueta` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`rol`) REFERENCES `rol` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;