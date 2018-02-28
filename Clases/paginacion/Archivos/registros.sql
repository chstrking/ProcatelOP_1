-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-07-2013 a las 06:24:10
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `paginacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE IF NOT EXISTS `registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(23) DEFAULT NULL,
  `apellido` varchar(23) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `nombre`, `apellido`) VALUES
(1, 'freddy', 'guerrero'),
(2, 'sa', 'lopez'),
(3, 'mariner', 'lopezssa'),
(4, 'rossset', 'megia'),
(5, 'laura', 'melchor'),
(6, 'cristhgin', 'sesara'),
(7, 'pilar', 'more'),
(8, 'paola', 'bazan'),
(9, 'pioul', 'sech'),
(10, 'ramiro', 'juases'),
(11, 'olleste', 'lolcssa'),
(12, 'fernando', 'orleagrio'),
(13, 'llanjo', 'llaatas'),
(14, 'Piiter', 'eintes'),
(15, 'sacramento', 'salvaje'),
(16, 'flor', 'salvaje'),
(17, 'linamaria', 'victorina'),
(18, 'juana', 'victorina'),
(19, 'seich', 'victorina'),
(20, 'julian', 'salam'),
(21, 'manuel', 'mohamet'),
(22, 'manuel', 'mohamet'),
(23, 'manuel', 'mohamet'),
(24, 'manuel', 'mohamet'),
(25, 'manuel', 'mohamet'),
(26, 'manuel', 'mohamet'),
(27, 'manuel', 'mohamet'),
(28, 'manuel', 'mohamet'),
(29, 'manuel', 'mohamet'),
(30, 'manuel', 'mohamet'),
(31, 'manuel', 'mohamet'),
(32, 'manuel', 'mohamet'),
(33, 'manuel', 'mohamet'),
(34, 'manuel', 'mohamet'),
(35, 'manuel', 'mohamet'),
(36, 'manuel', 'mohamet'),
(37, 'manuel', 'mohamet'),
(38, 'manuel', 'mohamet'),
(39, 'manuel', 'mohamet'),
(40, 'manuel', 'mohamet'),
(41, 'manuel', 'mohamet'),
(42, 'manuel', 'reyes'),
(43, 'freddy daniel', 'alcarazo ibañez'),
(44, 'samuel armando', 'alcarazo ibañez'),
(45, 'samuel armando', 'alcarazo ibanez'),
(46, 'freddy daniel', 'alcarazo ibanez'),
(47, 'freddy', 'alcarazo'),
(48, 'harry', 'tirofijo'),
(49, 'Julyai', 'noseque');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
