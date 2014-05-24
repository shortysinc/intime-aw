-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2014 a las 20:33:00
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(20) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  UNIQUE KEY `categoria` (`categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(3, 'Deportes'),
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
  `nombre_servicio` varchar(50) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `horas` int(11) NOT NULL,
  `foto` blob,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_servicio`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `id_usuario`, `nombre_servicio`, `descripcion`, `horas`, `foto`, `id_categoria`) VALUES
(1, 27, 'Clase de alemán', 'Doy clases de alemán.', 1, NULL, 2),
(2, 27, 'Clases de pilates', 'Doy clases de pilates', 1, NULL, 3),
(3, 27, 'Corto césped', 'Corto el césped de tu jardín', 2, NULL, 1),
(4, 40, 'Clases de inglés', 'Clases de inglés del mejor profesor que puedas tener', 1, NULL, 2);

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
  `foto` blob,
  `pass` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `nombre`, `apellidos`, `direccion`, `horas_usuario`, `foto`, `pass`, `salt`) VALUES
(27, 'pepe@gmail.com', 'Pepe', '', 'domicilio', 0, NULL, '56c2f3d20b0867820237bc2795066ff50c9752aa35eeac038514a6338ce03726f1d5e9303d4603abf8330f41db59bee23640e34cd755b193c6d4bff582a075ea', 'd866feb98913640d819915305ea2487caeccb9d8b3aba528c5f6adbdd0025fb056273a32fd8a7993b6625f1c25b830700dddb0bbf19455ad7529132b76b6dc00'),
(28, 'cr7@gmail.com', 'Cristiano Ronaldo', '', 'pozuelo', 0, NULL, 'ff8eb9c6568e680fe9c14484020f447bd9c344b7b2c6d26585d6ddc8c5bfa50deaaa60167d1e0f7856921536135c62989e742789984901ad8ae5c0c9feb6096e', 'a965216f1b7b4a39008facadfeeec3274ae8db7c134208d653d6767a4ae2dfb80dba6185c32fa29bada9e5c4a3d4ce2829587624ea1d0c1b322d90ad84c4f460'),
(40, 'fede@gmail.com', 'Federico', '', 'domicilio', 0, NULL, '9c3e0cc29995e78efb45ccdddc29b58fb96f15c3619147bfbcac15be14b8547c8a22e7e309620e1647e070cdb5afbf8240ad8e994899af320dd1eaa9384170c1', '8a375802e50aae308ae0d539b62b4dcd259be13c8aab825c930511838b1e354c51665059db44d0aa6d0f44adf645c607d4a3da9d89ede539eed8633cde43b681');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_solicita_servicio`
--

CREATE TABLE IF NOT EXISTS `usuario_solicita_servicio` (
  `id_solicitud` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `hora_inicio` datetime NOT NULL,
  `hora_fin` datetime NOT NULL,
  `comentario` varchar(500) NOT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `id_usuario` (`id_usuario`,`id_servicio`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuario_solicita_servicio`
--

INSERT INTO `usuario_solicita_servicio` (`id_solicitud`, `id_usuario`, `id_servicio`, `estado`, `hora_inicio`, `hora_fin`, `comentario`) VALUES
(1, 28, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Estoy interesado en tu servicio'),
(2, 40, 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Estoy interesado en las clases de pilates'),
(3, 27, 4, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Me interesaría recibir una clase de inglés');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Filtros para la tabla `usuario_solicita_servicio`
--
ALTER TABLE `usuario_solicita_servicio`
  ADD CONSTRAINT `usuario_solicita_servicio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuario_solicita_servicio_ibfk_2` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoracion_servicio`
--
ALTER TABLE `valoracion_servicio`
  ADD CONSTRAINT `valoracion_servicio_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoracion_servicio_ibfk_3` FOREIGN KEY (`id_servicio`) REFERENCES `servicio` (`id_servicio`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
