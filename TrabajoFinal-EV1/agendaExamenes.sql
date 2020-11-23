-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2020 a las 15:14:41
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendaexamenes`
--
CREATE DATABASE IF NOT EXISTS `agendaexamenes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `agendaexamenes`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `tipoExamenId` int(11) DEFAULT NULL,
  `aprobado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`id`, `nombre`, `fecha`, `tipoExamenId`, `aprobado`) VALUES
(1, 'DAW', '2020-12-24', 3, 1),
(2, 'DWEC', '2020-12-17', 3, 0),
(3, 'EIE', '2020-12-18', 2, 0),
(4, 'DWES', '2021-02-02', 2, 0),
(5, 'DIW', '2020-12-26', 3, 1),
(6, 'DAW', '2021-01-10', 2, 0),
(7, 'EIE', '2021-02-14', 3, 1),
(14, 'EF', '2020-08-11', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoexamen`
--

CREATE TABLE `tipoexamen` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipoexamen`
--

INSERT INTO `tipoexamen` (`id`, `nombre`) VALUES
(1, 'Control'),
(2, 'Parcial'),
(3, 'Final'),
(4, 'Recuperacion');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tipoExamenId_idx` (`tipoExamenId`);

--
-- Indices de la tabla `tipoexamen`
--
ALTER TABLE `tipoexamen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tipoexamen`
--
ALTER TABLE `tipoexamen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `fk_tipoExamenId` FOREIGN KEY (`tipoExamenId`) REFERENCES `tipoexamen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

