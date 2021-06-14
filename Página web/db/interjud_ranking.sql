-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 10.0.10.8:3306
-- Tiempo de generación: 01-02-2021 a las 23:26:26
-- Versión del servidor: 10.3.21-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `interjudo_ranking`
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
('admin', 'int3rJud0');

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
('PABLO MARCELO', 'ELISII', 'MASCULINO', '14/10/1971', 'DIRECCION@EMPRESA.EXTENSIONES2', 0, '(12) 34567890', 'img/Competidores/PABLO MARCELOELISII.jpeg', 'INTERCOLEGIAL', 'MARIANO MORENO', 92, 'SENIOR'),
('SANTIAGO', 'FRAGA', 'MASCULINO', '28/12/1993', 'DIRECCION@EMPRESA.EXTENSIONES12', 1, '(12) 34567890', 'img/Competidores/SANTIAGOFRAGA.jpeg', 'METROPOLITANA', 'CENTRO OKINAWENSE ARGENTINO', 66, 'SENIOR'),
('CHO', 'GUHAM', 'MASCULINO', '30/06/1992', 'G@G.COM', 2, '(1) 2', 'img/Competidores/CHOGUHAM.png', 'IJF', 'COREA', 100, 'SENIOR'),
('LUKAS', 'KRPALEK', 'MASCULINO', '15/11/1990', 'GG@GG.COM', 3, '(1) 2', 'img/Competidores/LUKASKRPALEK.png', 'IJF', 'REPUBLICA CHECA', 110, 'SENIOR'),
('DARIA', 'BILODID', 'FEMENINO', '10/08/2000', 'HH@HH.COM', 4, '(1) 02', 'img/Competidores/DARIABILODID.png', 'IJF', 'UCRANIA', 48, 'SENIOR'),
('UTA', 'ABE', 'FEMENINO', '14/06/2000', 'II@II.COM', 5, '(01) 03', 'img/Competidores/UTAABE.png', 'IJF', 'JAPON', 52, 'SENIOR'),
('CHRISTA', 'DEGUCHI', 'FEMENINO', '29/08/1995', '1@1.COM', 6, '(02) 81', 'img/Competidores/CHRISTADEGUCHI.jpeg', 'IJF', 'CANADA', 57, 'SENIOR'),
('CLARISSE', 'AGBEGNENOU', 'FEMENINO', '05/08/1992', '1@2.COM', 7, '(03) 4', 'img/Competidores/CLARISSEAGBEGNENOU.jpeg', 'IJF', 'FRANCIA', 63, 'SENIOR'),
('MARIE EVE', 'GAHIE', 'FEMENINO', '27/11/1996', 'B@B.COM', 8, '(4) 2', 'img/Competidores/MARIE EVEGAHIE.jpeg', 'IJF', 'FRANCIA', 70, 'SENIOR'),
('SHORI', 'HAMADA', 'FEMENINO', '25/08/1990', '2@3.COM', 9, '(04) 02', 'img/Competidores/SHORIHAMADA.jpeg', 'IJF', 'JAPON', 78, 'SENIOR'),
('IDALYS', 'ORTIZ', 'FEMENINO', '27/09/1989', '5@5.COM', 10, '(6) 7', 'img/Competidores/IDALYSORTIZ.jpeg', 'IJF', 'CUBA', 79, 'SENIOR'),
('SOI', 'HASHIMOTO', 'MASCULINO', '28/08/1981', 'CCCCC@CCC.COM', 3333, '(33) 3333', 'img/Competidores/SOIHASHIMOTO.jpeg', 'IJF', 'JAPON', 73, 'SENIOR'),
('CASSE', 'MATTHIAS', 'MASCULINO', '19/02/1997', 'D@D.COM', 5555, '(01) 1', 'img/Competidores/CASSEMATTHIAS.jpeg', 'IJF', 'BELGICA', 81, 'SENIOR'),
('JUAN', 'GARAVENTA', 'MASCULINO', '31/10/1992', 'DIRECCIO@EMPRESAS.COM', 11111, '(11) 23126664', 'img/Competidores/JUANGARAVENTA.jpeg', 'METROPOLITANA', 'CENTRO OKINAWENSE ARGENTINO', 115, 'KYU GRADUADO'),
('NIKOLOZ', 'SHERAZADISHVILI', 'MASCULINO', '19/02/1996', 'FF@FF.COM', 55555, '(1) 1', 'img/Competidores/NIKOLOZSHERAZADISHVILI.jpeg', 'IJF', 'ESPAÑA', 90, 'SENIOR'),
('HUGO', 'GIMENEZ', 'MASCULINO', '29/08/1969', 'GIMENEZHUGO@HOTMAIL.COM', 20994036, '(11) 23126664', 'img/Competidores/HUGOGIMENEZ.jpeg', 'METROPOLITANA', 'CENTRO OKINAWENSE ARGENTINO', 98, 'SENIOR'),
('MANU', 'LOMBARDO', 'MASCULINO', '04/12/1998', 'BBBBBBB@NNNNN.COM', 22222222, '(222) 22222222', 'img/Competidores/MANULOMBARDO.jpeg', 'IJF', 'ITALIA', 66, 'SENIOR'),
('LUCAS', 'GIMENEZ', 'MASCULINO', '03/11/2000', 'LUQUIGIMENE@GMAIL.COM', 42934846, '(11) 22835906', 'img/Competidores/LUCASGIMENEZ.jpeg', 'METROPOLITANA', 'CENTRO OKINAWENSE ARGENTINO', 66, 'KYU GRADUADO'),
('RIUJU', 'NAGAYAMA', 'MASCULINO', '15/03/1996', 'LALALALA@LALALA.COM', 111111111, '(011) 88888888', 'img/Competidores/RIUJUNAGAYAMA.jpeg', 'IJF', 'JAPON', 60, 'SENIOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas-torneo`
--

CREATE TABLE `fechas-torneo` (
  `torneo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` varchar(10) NOT NULL,
  `direccion` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `fechas-torneo`
--

INSERT INTO `fechas-torneo` (`torneo`, `fecha`, `hora`, `direccion`) VALUES
(23, '2021-03-17', '09:00', 'POLIDEPORTIVO GATICA. AV MITRE 500, AVELLANEDA'),
(23, '2021-03-20', '09:00', 'POLIDEPORTIVO GATICA AV MITRE 500, AVELLANEDA, BSAS '),
(24, '2020-05-29', '12:30', 'UNA DIR'),
(24, '2020-05-31', '19:30', 'AVENIDA KARATEKA'),
(24, '2020-06-03', '07:00', 'AVENIDA BOKITA PASION'),
(24, '2021-04-14', '09:00', 'PARQUE OLIMPICO, AV ROCA 5252. CABA'),
(32, '2021-05-14', '09:00', 'FRAY JUSTO SANTA MARÍA DE ORO 3530 CASTELLAR, BUENOS AIRES'),
(33, '2021-08-05', '09:00', 'SARMIENTO Y ESCALADA. SAN FERNANDO, BUENOS AIRES'),
(34, '2021-09-05', '09:00', 'ORTIZ DE ROSAS 11 ENSENADA BS AS'),
(34, '2021-09-05', '09:00', 'POLIDEPORTIVO ENSENADA, ORTIZ DE ROZAS 11. BUENOS AIRES'),
(35, '2021-11-05', '09:00', 'LISANDRO DE LA TORRE 3855. CASEROS, BUENOS AIRES'),
(36, '2021-02-11', '12:30', 'UNA DIR'),
(36, '2021-12-04', '09:00', 'TECNOPOLIS, AVENIDA CONSTITUYENTES Y GRAL PAZ. BUENOS AIRES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones-torneo`
--

CREATE TABLE `inscripciones-torneo` (
  `torneo` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `apellido` varchar(60) NOT NULL,
  `club` varchar(60) NOT NULL,
  `email_club` varchar(60) DEFAULT NULL,
  `telefono_club` varchar(60) DEFAULT NULL,
  `peso` int(11) NOT NULL,
  `categoria` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos-competidor`
--

CREATE TABLE `puntos-competidor` (
  `torneo` int(11) NOT NULL,
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

INSERT INTO `puntos-competidor` (`torneo`, `usuario`, `puntos_senior`, `puntos_cadete`, `puntos_kyu_graduado`, `puntos_kyu_novicio`, `puntos_infantil_b`) VALUES
(24, 0, 2, 1, 0, 0, 0),
(24, 1, 1, 0, 2, 0, 0),
(24, 2, 1, 0, 0, 3, 0),
(24, 3, 1, 0, 0, 0, 1),
(24, 4, 1, 1, 0, 0, 0),
(24, 5, 1, 0, 1, 0, 0),
(24, 6, 1, 0, 0, 1, 0),
(24, 7, 1, 0, 0, 0, 1),
(24, 8, 1, 1, 0, 0, 0),
(24, 9, 1, 1, 0, 0, 0),
(24, 10, 1, 0, 1, 0, 0),
(24, 3333, 1, 0, 0, 0, 1),
(24, 5555, 1, 1, 0, 0, 0),
(24, 11111, 1, 1, 1, 0, 0),
(24, 55555, 1, 0, 1, 0, 0),
(24, 20994036, 1, 0, 0, 0, 0),
(24, 22222222, 3, 1, 2, 2, 1),
(24, 42934846, 0, 0, 1, 0, 0),
(24, 111111111, 2, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE `torneos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `categorias` varchar(80) NOT NULL,
  `reglas` longtext NOT NULL,
  `imagen` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`id`, `nombre`, `categorias`, `reglas`, `imagen`) VALUES
(23, 'TORNEO BONAERENSE', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', 'reglas/PRUEBA DE TORNEO.pdf', 'img/Torneos/TORNEO BONAERENSE.jpeg'),
(24, 'ABIERTO DE LA CIUDAD', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', 'reglas/PRUEBA DE TORNEO 1.pdf', 'img/Torneos/ABIERTO DE LA CIUDAD.jpeg'),
(32, 'TORNEO KAWAKITA', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', 'reglas/TORNEO KAWAKITA.docx', 'img/Torneos/TORNEO KAWAKITA.jpeg'),
(33, 'TORNEO SAN FERNANDO', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', 'reglas/TORNEO SAN FERNANDO.docx', 'img/Torneos/TORNEO SAN FERNANDO.jpeg'),
(34, 'TORNEO ENSENADA', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', 'reglas/TORNEO ENSENADA.docx', 'img/Torneos/TORNEO ENSENADA.jpeg'),
(35, 'TORNEO CEF', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', 'reglas/TORNEO CEF.docx', 'img/Torneos/TORNEO CEF.jpeg'),
(36, 'GRAN FINAL', '{SENIOR, CADETE, KYU GRADUADO, KYU NOVICIO, INFANTIL B}', 'reglas/GRAN FINAL.docx', 'img/Torneos/GRAN FINAL.jpeg');

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
  ADD PRIMARY KEY (`torneo`,`fecha`,`hora`,`direccion`),
  ADD KEY `torneo` (`torneo`);

--
-- Indices de la tabla `inscripciones-torneo`
--
ALTER TABLE `inscripciones-torneo`
  ADD PRIMARY KEY (`torneo`,`nombre`,`apellido`,`club`,`peso`,`categoria`);

--
-- Indices de la tabla `puntos-competidor`
--
ALTER TABLE `puntos-competidor`
  ADD PRIMARY KEY (`torneo`,`usuario`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `torneo` (`torneo`);

--
-- Indices de la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `torneos`
--
ALTER TABLE `torneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  ADD CONSTRAINT `puntos-competidor_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `competidores` (`dni`),
  ADD CONSTRAINT `puntos-competidor_ibfk_2` FOREIGN KEY (`torneo`) REFERENCES `torneos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
