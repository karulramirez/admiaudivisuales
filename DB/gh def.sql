-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-10-2021 a las 05:13:11
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gh`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `sn` int(11) NOT NULL,
  `serial` varchar(45) NOT NULL,
  `ct` varchar(45) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `disponible` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`sn`, `serial`, `ct`, `modelo`, `observaciones`, `disponible`) VALUES
(0, '123sadasd', 'asda', 'TUF504', 'Sin bateria', 'No'),
(1, 'HGH217892QER', 'AQWS', 'AFFZZ2', '', 'Si'),
(2, 'QASQWE12S124E7', 'CASD', 'ASQG456', 'Poco brillo', 'Si'),
(3, 'OPSQ134NAD1', 'QWSAR1', 'TTOOPQ', 'Recalentamiento', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `idmantenimiento` int(11) NOT NULL,
  `FechaInicioMant` datetime NOT NULL,
  `FechaReparacion` datetime DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL,
  `equipos_sn` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`idmantenimiento`, `FechaInicioMant`, `FechaReparacion`, `descripcion`, `equipos_sn`) VALUES
(0, '2021-10-30 05:06:05', '2021-10-30 05:06:08', 'Recalentamiento', 3),
(1, '2021-10-30 05:06:51', '2021-10-30 05:06:58', 'Recalentamiento masivo', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamo`
--

CREATE TABLE `prestamo` (
  `idprestamo` int(11) NOT NULL,
  `fechaHoraInicio` datetime NOT NULL,
  `fechaHoraFinal` date NOT NULL,
  `fechaDevolucion` datetime DEFAULT NULL,
  `equipos_sn` int(11) NOT NULL,
  `usuario_idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `prestamo`
--

INSERT INTO `prestamo` (`idprestamo`, `fechaHoraInicio`, `fechaHoraFinal`, `fechaDevolucion`, `equipos_sn`, `usuario_idUsuario`) VALUES
(0, '2021-10-29 05:35:13', '2021-10-30', NULL, 0, 1112),
(1, '2021-10-29 18:47:38', '2021-10-30', '2021-10-29 18:49:14', 1, 1111),
(3, '2021-10-01 00:00:00', '2021-10-28', NULL, 1, 1111),
(5, '2021-10-02 00:00:00', '2021-10-15', '2021-10-29 19:27:22', 2, 45678);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `cedula` bigint(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `facultad` varchar(45) NOT NULL,
  `rol` varchar(45) NOT NULL,
  `tel` bigint(20) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `tipoUsuario` varchar(45) NOT NULL,
  `clave` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `cedula`, `nombre`, `apellido`, `facultad`, `tel`, `correo`, `tipoUsuario`, `clave`) VALUES
(1111, 981103, 'admin', 'super', 'administrador', 5555, 'admin@admin.com', 'administrador', '1234'),
(1112, 981102, 'admin3', 'super', 'administrador', 3011241233, 'admin@admin.com', 'administrador', '1234'),
(45678, 981103, 'estudiante', 'flojo', 'Indusplay', 5555, 'indusplay@ingefake.com', 'estudiante', NULL),
(45679, 11231241, 'ALAVARO', 'PEREZ', 'Estudiante', 21134131, 'deino@gmail.com', 'Estudiante', NULL),
(45680, 898798, 'LORA', 'LOPEZ', 'Estudiante', 55634342, 'armando@gmail.com', 'Estudiante', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`sn`);

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`idmantenimiento`),
  ADD KEY `fk_mantenimiento_equipos1_idx` (`equipos_sn`);

--
-- Indices de la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD PRIMARY KEY (`idprestamo`),
  ADD KEY `fk_prestamo_equipos1_idx` (`equipos_sn`),
  ADD KEY `fk_prestamo_usuario1_idx` (`usuario_idUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD CONSTRAINT `fk_mantenimiento_equipos1` FOREIGN KEY (`equipos_sn`) REFERENCES `equipos` (`sn`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamo`
--
ALTER TABLE `prestamo`
  ADD CONSTRAINT `fk_prestamo_equipos1` FOREIGN KEY (`equipos_sn`) REFERENCES `equipos` (`sn`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prestamo_usuario1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
