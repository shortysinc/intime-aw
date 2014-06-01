-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-06-2014 a las 23:46:21
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `intime`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(40) NOT NULL,
  `pass` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_admin` (`correo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `correo`, `pass`, `salt`) VALUES
(1, 'admin@admin.com', 'cffcede585c94a629ba29a5ce9be9de3728d413747fa0e333e353bd1fe09dea964a31cae7f99021db65e0f4f3df80c4c7ecbfc6a14117ef1bc2325adb236d42f', '438aff7512921a23f3a97d0705d62dc08758e5240568bf1d097eaa147ce7f6a0f7e788eac68178ea2f64962d4ef7ae36fa1cc780fe73c011380b0d5f680a7d5d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(20) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(3, 'Deportes'),
(4, 'Hogar'),
(2, 'Idiomas'),
(1, 'Jardineria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
  `id_favorito` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_favorito`),
  KEY `id_servicio` (`id_servicio`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `id_servicio` int(11) NOT NULL,
  `hora_inicio` datetime NOT NULL,
  `hora_fin` datetime NOT NULL,
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE IF NOT EXISTS `servicio` (
  `id_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre_servicio` varchar(50) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `horas` int(11) NOT NULL,
  `foto_servicio` blob,
  PRIMARY KEY (`id_servicio`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `id_usuario`, `id_categoria`, `nombre_servicio`, `descripcion`, `horas`, `foto_servicio`) VALUES
(1, 27, 2, 'Clase de alemán', 'Doy clases de alemán.', 1, NULL),
(2, 27, 3, 'Clases de pilates', 'Doy clases de pilates', 1, NULL),
(3, 27, 1, 'Corto césped', 'Corto el césped de tu jardín', 2, NULL),
(4, 40, 2, 'Clases de inglés', 'Clases de inglés del mejor profesor que puedas tener', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE IF NOT EXISTS `solicitud` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `vista` int(1) NOT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `id_usuario` (`id_usuario`,`id_servicio`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `id_usuario`, `id_servicio`, `estado`, `fecha`, `comentario`, `vista`) VALUES
(2, 40, 2, 0, '2014-05-13 15:00:00', 'Estoy interesado en las clases de pilates', 0),
(3, 27, 4, 0, '2014-05-30 23:00:00', 'Me interesaría recibir una clase de inglés', 0),
(4, 42, 2, 2, '2014-05-30 23:00:00', 'Me intersan tus clases de pilates. ¿Cuándo quedaríamos?', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(40) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `horas_usuario` int(11) NOT NULL,
  `foto_usuario` varchar(20) DEFAULT NULL,
  `pass` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `nombre`, `apellidos`, `direccion`, `horas_usuario`, `foto_usuario`, `pass`, `salt`) VALUES
(27, 'pepe@gmail.com', 'Pepe', '', 'domicilio', 1, '27.png', '56c2f3d20b0867820237bc2795066ff50c9752aa35eeac038514a6338ce03726f1d5e9303d4603abf8330f41db59bee23640e34cd755b193c6d4bff582a075ea', 'd866feb98913640d819915305ea2487caeccb9d8b3aba528c5f6adbdd0025fb056273a32fd8a7993b6625f1c25b830700dddb0bbf19455ad7529132b76b6dc00'),
(40, 'fede@gmail.com', 'Federico', '', 'domicilio', 0, NULL, '9c3e0cc29995e78efb45ccdddc29b58fb96f15c3619147bfbcac15be14b8547c8a22e7e309620e1647e070cdb5afbf8240ad8e994899af320dd1eaa9384170c1', '8a375802e50aae308ae0d539b62b4dcd259be13c8aab825c930511838b1e354c51665059db44d0aa6d0f44adf645c607d4a3da9d89ede539eed8633cde43b681'),
(42, 'cr7@gmail.com', 'cristiano ronaldo', '', 'Pozuelo', 0, NULL, '29049634bfb7b74f61782ea14e565a7d83439faab9ce5ac89fff416c9c21b143276989a3074acdeea943da9a380992a548781844bbdc29a5be95731e039044d4', '9bcd18417c5e633a30194565c4729f14ef1273a25212d557dd90934a4f6a5af1abbbff661a690505115bc0a8ff0826dab0e2437eb5ef85e6be13b8138768b31d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion_servicio`
--

CREATE TABLE IF NOT EXISTS `valoracion_servicio` (
  `id_valoracion` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `opinion` varchar(500) NOT NULL,
  PRIMARY KEY (`id_valoracion`),
  KEY `id_servicio` (`id_servicio`,`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `valoracion_servicio`
--

INSERT INTO `valoracion_servicio` (`id_valoracion`, `id_servicio`, `id_usuario`, `nota`, `opinion`) VALUES
(1, 2, 27, 6, 'que guay!');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicio_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoracion_servicio`
--
ALTER TABLE `valoracion_servicio`
  ADD CONSTRAINT `valoracion_servicio_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoracion_servicio_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
