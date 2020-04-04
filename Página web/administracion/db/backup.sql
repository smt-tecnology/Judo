-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-04-2020 a las 08:45:37
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `judo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `usuario` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`usuario`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competidores`
--

CREATE TABLE `competidores` (
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `nacimiento` varchar(10) NOT NULL,
  `email` varchar(60) NOT NULL,
  `dni` int(11) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `federacion` varchar(30) NOT NULL,
  `club` varchar(30) NOT NULL,
  `peso` int(11) NOT NULL,
  `categoria` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `competidores`
--

INSERT INTO `competidores` (`nombre`, `apellido`, `genero`, `nacimiento`, `email`, `dni`, `telefono`, `foto`, `federacion`, `club`, `peso`, `categoria`) VALUES
('JUANA', 'ALGO', 'FEMENINO', '08/04/2000', 'JUANISEIJASadad00@GMAIL.COM', 21321312, '(11) 22223333', 'img/Competidores/JUAN IGNACIOSEIJAS KARATEKA.png', 'AFA', 'INDEPENDIENTE', 52, 'CADETE'),
('JUAN IGNACIO', 'SEIJAS KARATEKA', 'MASCULINO', '08/04/2000', 'JUANISEIJAS00@GMAIL.COM', 28888288, '(11) 22223333', 'img/Competidores/JUAN IGNACIOSEIJAS KARATEKA.png', 'AFA', 'INDEPENDIENTE', 52, 'CADETE'),
('AGUSTIN ARIEL', 'TAMBORINI CRISCUELI', 'MASCULINO', '03/06/2000', 'TAMBORINIAGUSTIN00@GMAIL.COM', 42587717, '(11) 40850504', 'img/Competidores/AGUSTIN ARIELTAMBORINI CRISCUELI.jpeg', 'AFA', 'BOCA JUNIORS', 48, 'SENIOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas-torneo`
--

CREATE TABLE `fechas-torneo` (
  `torneo` int(11) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `direccion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechas-torneo`
--

INSERT INTO `fechas-torneo` (`torneo`, `fecha`, `hora`, `direccion`) VALUES
(1, '04/04/2020', '21:00', ''),
(1, '22/12/2020', '22:30', 'probando una dire'),
(7, '28/04/2020', '18:00', 'AV CORDOBA 3000'),
(1, '30/04/2020', '19:00', 'AV CORDOBA 2032'),
(7, '02/04/2020', '22:00', 'Av cordoba'),
(7, '03/04/2020', '21:00', 'Av cordoba 3333'),
(8, '03/04/2020', '15:00', 'AV CABILDO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos-competidor`
--

CREATE TABLE `puntos-competidor` (
  `usuario` int(11) NOT NULL,
  `puntos_senior` int(11) NOT NULL,
  `puntos_cadete` int(11) NOT NULL,
  `puntos_kyu_graduado` int(11) NOT NULL,
  `puntos_kyu_novicio` int(11) NOT NULL,
  `puntos_infantil_b` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `puntos-competidor`
--

INSERT INTO `puntos-competidor` (`usuario`, `puntos_senior`, `puntos_cadete`, `puntos_kyu_graduado`, `puntos_kyu_novicio`, `puntos_infantil_b`) VALUES
(28888288, 10, 7, 3, 9, 10),
(42587717, 11, 7, 14, 10, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `categorias` varchar(80) NOT NULL,
  `reglas` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`id`, `nombre`, `categorias`, `reglas`) VALUES
(1, 'TORNEO INTERFEDERATIVO 2020', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', '* EL PRIMER LUGAR SUMARÁ 3 PUNTOS\r\n* EL SEGUNDO LUGAR SUMARÁ 2 PUNTOS\r\n* EL TERCER LUGAR SUMARÁ 1 PUNTO\r\n* LOS DEMÁS PARTICIPANTES NO SUMARÁN PUNTOS'),
(7, 'TORNEO INTERFEDERATIVO 2021', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', '* EL PRIMER LUGAR SUMARÁ 3 PUNTOS\r\n* EL SEGUNDO LUGAR SUMARÁ 2 PUNTOS\r\n* EL TERCER LUGAR SUMARÁ 1 PUNTO\r\n* LOS DEMÁS PARTICIPANTES NO SUMARÁN PUNTOS\r\n* BREVE MODIFICACIÓN'),
(8, 'TORNEO INTERFEDERATIVO 2022', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', '* EL PRIMER LUGAR SUMARÁ 3 PUNTOS\r\n* EL SEGUNDO LUGAR SUMARÁ 2 PUNTOS\r\n* EL TERCER LUGAR SUMARÁ 1 PUNTO\r\n* LOS DEMÁS PARTICIPANTES NO SUMARÁN PUNTOS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `competidores`
--
ALTER TABLE `competidores`
  ADD PRIMARY KEY (`dni`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `fechas-torneo`
--
ALTER TABLE `fechas-torneo`
  ADD KEY `torneo` (`torneo`);

--
-- Indices de la tabla `puntos-competidor`
--
ALTER TABLE `puntos-competidor`
  ADD PRIMARY KEY (`usuario`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fechas-torneo`
--
ALTER TABLE `fechas-torneo`
  ADD CONSTRAINT `fechas-torneo_ibfk_1` FOREIGN KEY (`torneo`) REFERENCES `torneos` (`id`);

--
-- Filtros para la tabla `puntos-competidor`
--
ALTER TABLE `puntos-competidor`
  ADD CONSTRAINT `puntos-competidor_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `competidores` (`dni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
