-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-09-2020 a las 22:21:05
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `solucionprueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `infobultos`
--

CREATE TABLE `infobultos` (
  `kilo` int(255) NOT NULL,
  `valor` int(255) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `infobultos`
--

INSERT INTO `infobultos` (`kilo`, `valor`, `id`) VALUES
(25, 0, 1),
(46, 69000, 2),
(55, 82500, 3),
(100, 150000, 4),
(148, 222000, 5),
(250, 375000, 6),
(180, 270000, 7),
(200, 300000, 8),
(499, 1247500, 9),
(66, 99000, 10),
(5, 0, 11),
(25, 0, 12),
(30, 45000, 13),
(50, 75000, 14),
(40, 60000, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `infobultos`
--
ALTER TABLE `infobultos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `infobultos`
--
ALTER TABLE `infobultos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
