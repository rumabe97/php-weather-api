-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-12-2021 a las 18:37:39
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `weather`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mstr_city`
--

CREATE TABLE `mstr_city` (
  `id` int(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `idActualWeather` int(11) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `idCoordinate` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mstr_coordinate`
--

CREATE TABLE `mstr_coordinate` (
  `id` int(11) NOT NULL,
  `idCity` int(11) NOT NULL,
  `latitude` int(50) NOT NULL,
  `longitude` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mstr_user`
--

CREATE TABLE `mstr_user` (
  `id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `rol` varchar(15) DEFAULT 'user',
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mstr_user`
--

INSERT INTO `mstr_user` (`id`, `email`, `name`, `surname`, `rol`, `password`) VALUES
(1, 'admin@admin.com', 'admin', NULL, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mstr_weather`
--

CREATE TABLE `mstr_weather` (
  `id` int(10) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_city_weather`
--

CREATE TABLE `rel_city_weather` (
  `id` int(11) NOT NULL,
  `idCity` int(11) NOT NULL,
  `idWeather` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mstr_city`
--
ALTER TABLE `mstr_city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_city_coordinate` (`idCoordinate`),
  ADD KEY `fk_city_weather` (`idActualWeather`) USING BTREE;

--
-- Indices de la tabla `mstr_coordinate`
--
ALTER TABLE `mstr_coordinate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_coordinate_city` (`idCity`);

--
-- Indices de la tabla `mstr_user`
--
ALTER TABLE `mstr_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `mstr_weather`
--
ALTER TABLE `mstr_weather`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rel_city_weather`
--
ALTER TABLE `rel_city_weather`
  ADD PRIMARY KEY (`id`,`idCity`,`idWeather`,`date`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mstr_coordinate`
--
ALTER TABLE `mstr_coordinate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mstr_user`
--
ALTER TABLE `mstr_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mstr_weather`
--
ALTER TABLE `mstr_weather`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mstr_city`
--
ALTER TABLE `mstr_city`
  ADD CONSTRAINT `fk_city_coordinate` FOREIGN KEY (`idCoordinate`) REFERENCES `mstr_coordinate` (`id`),
  ADD CONSTRAINT `fk_city_weather` FOREIGN KEY (`idActualWeather`) REFERENCES `mstr_weather` (`id`);

--
-- Filtros para la tabla `mstr_coordinate`
--
ALTER TABLE `mstr_coordinate`
  ADD CONSTRAINT `fk_coordinate_city` FOREIGN KEY (`idCity`) REFERENCES `mstr_city` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
