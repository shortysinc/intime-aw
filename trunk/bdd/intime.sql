-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2014 a las 12:48:32
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `id_usuario`, `nombre_servicio`, `descripcion`, `horas`, `foto`, `id_categoria`) VALUES
(1, 24, 'Corto el césped del jardín', 'Me ofrezco para cortar el césped de su jardín.Me ofrezco para cortar el césped de su jardín.Me ofrezco para cortar el césped de su jardín.Me ofrezco para cortar el césped de su jardín.Me ofrezco para cortar el césped de su jardín.Me ofrezco para cortar el césped de su jardín.Me ofrezco para cortar el césped de su jardín.', 1, NULL, 1),
(2, 24, 'Clases de inglés', 'Doy clases de inglés.', 1, NULL, 2),
(3, 24, 'Pilates', 'Doy clases de pilates', 1, NULL, 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `nombre`, `apellidos`, `direccion`, `horas_usuario`, `foto`, `pass`, `salt`) VALUES
(24, 'usr@gmail.com', 'usuario', '', 'calle usuario', 0, NULL, '4a9ce39cccfb77e781d290412fed0b77ce3495658ef88a760f2bd36a2c4089511f5c86b5851bbf2c6c6ce695235a6119634a5037f79245151fbdafdeaa6f1736', '6f9674f08bd82cd8d207ae04554912b1c1f7a804eac56779362939fd78f56f8c2a27bcd25a58c3dc7da2e9d0d491235004bdb8128ba86d30b1e730d5a81f091a'),
(25, '', '', '', '', 0, NULL, 'a25f2713731b559be7d47f2c27a13dbeb248844731fb61ea31cb48e3a278947df913218154e30ab72357be32c9b693d8dbd68b0c1f5d0ed48114b0b10d510b9a', '4addc934e224e15ba4bdd394185b85ebfb1393af495a0157536260587cc8a651ad2df3d9429eed13ffe64c21d329338ccaee087ded457442873891f76b37b247'),
(26, 'hola@a.com', 'aaa', '', '\\''antonio', 0, NULL, 'cf2df337770f6c72a7d9fbc556fa60281c6548864f06d94e8d9451b8898d0bab34ac3557d3e504a430925b9ff766844eed3a4e398513f7a85e3666c9daea6e53', '1fcbfb25ddded4e2d5afcde52dc72d8608349124d746a254cf556640ef750ab0f2d33bb53cdf4ae546302f468346604508d5456a0da8b2f5ff29d8a9513e72fb');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
