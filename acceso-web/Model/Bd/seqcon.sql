-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-02-2020 a las 14:12:57
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `seqcon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `access`
--

CREATE TABLE `access` (
  `intid_Access` int(11) NOT NULL,
  `intfk_Room` int(11) NOT NULL,
  `intfk_UidUsers` int(11) NOT NULL,
  `EstAccess` tinyint(1) NOT NULL,
  `EstAs` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_newcard`
--

CREATE TABLE `cat_newcard` (
  `intid_NewCard` int(11) NOT NULL,
  `intUidCard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_room`
--

CREATE TABLE `cat_room` (
  `intid_Room` int(11) NOT NULL,
  `strNameRoom` varchar(20) NOT NULL,
  `boolEstRoom` tinyint(1) NOT NULL,
  `boolEstR` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cat_room`
--

INSERT INTO `cat_room` (`intid_Room`, `strNameRoom`, `boolEstRoom`, `boolEstR`) VALUES
(1, 'lab-TTI', 1, 1),
(2, 'informatica', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_uidusers`
--

CREATE TABLE `cat_uidusers` (
  `intid_UidUser` int(11) NOT NULL,
  `strNameUser` varchar(50) NOT NULL,
  `strLastNameUser` varchar(50) NOT NULL,
  `intNumConUser` int(8) NOT NULL,
  `intfkUidUser` int(11) NOT NULL,
  `boolEstUser` tinyint(1) NOT NULL,
  `boolEstUs` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historyclose`
--

CREATE TABLE `historyclose` (
  `intid_Close` int(11) NOT NULL,
  `intfk_Access` int(11) NOT NULL,
  `dtm_DaTi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historyopen`
--

CREATE TABLE `historyopen` (
  `intid_Open` int(11) NOT NULL,
  `intfk_Access` int(11) NOT NULL,
  `dtm_DaTi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessionuser`
--

CREATE TABLE `sessionuser` (
  `intid_SesUser` int(11) NOT NULL,
  `intNumConSesUser` int(4) NOT NULL,
  `strPswSesUser` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`intid_Access`),
  ADD KEY `intfk_Room` (`intfk_Room`),
  ADD KEY `intfk_UidUsers` (`intfk_UidUsers`);

--
-- Indices de la tabla `cat_newcard`
--
ALTER TABLE `cat_newcard`
  ADD PRIMARY KEY (`intid_NewCard`),
  ADD UNIQUE KEY `intUidCard` (`intUidCard`);

--
-- Indices de la tabla `cat_room`
--
ALTER TABLE `cat_room`
  ADD PRIMARY KEY (`intid_Room`);

--
-- Indices de la tabla `cat_uidusers`
--
ALTER TABLE `cat_uidusers`
  ADD PRIMARY KEY (`intid_UidUser`),
  ADD UNIQUE KEY `intNumConUser` (`intNumConUser`,`intfkUidUser`);

--
-- Indices de la tabla `historyclose`
--
ALTER TABLE `historyclose`
  ADD PRIMARY KEY (`intid_Close`);

--
-- Indices de la tabla `historyopen`
--
ALTER TABLE `historyopen`
  ADD PRIMARY KEY (`intid_Open`);

--
-- Indices de la tabla `sessionuser`
--
ALTER TABLE `sessionuser`
  ADD PRIMARY KEY (`intid_SesUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `access`
--
ALTER TABLE `access`
  MODIFY `intid_Access` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cat_newcard`
--
ALTER TABLE `cat_newcard`
  MODIFY `intid_NewCard` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `cat_room`
--
ALTER TABLE `cat_room`
  MODIFY `intid_Room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cat_uidusers`
--
ALTER TABLE `cat_uidusers`
  MODIFY `intid_UidUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `historyclose`
--
ALTER TABLE `historyclose`
  MODIFY `intid_Close` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `historyopen`
--
ALTER TABLE `historyopen`
  MODIFY `intid_Open` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT de la tabla `sessionuser`
--
ALTER TABLE `sessionuser`
  MODIFY `intid_SesUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `access`
--
ALTER TABLE `access`
  ADD CONSTRAINT `access_ibfk_1` FOREIGN KEY (`intfk_Room`) REFERENCES `cat_room` (`intid_Room`),
  ADD CONSTRAINT `access_ibfk_2` FOREIGN KEY (`intfk_UidUsers`) REFERENCES `cat_uidusers` (`intid_UidUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
