-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-06-2014 a las 18:55:09
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(3, 'Deportes'),
(4, 'Hogar'),
(2, 'Idiomas'),
(1, 'Jardineria'),
(5, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE IF NOT EXISTS `favoritos` (
  `id_favorito` int(11) NOT NULL AUTO_INCREMENT,
  `id_servicio` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_favorito`),
  KEY `id_servicio` (`id_servicio`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id_favorito`, `id_servicio`, `id_usuario`, `fecha`) VALUES
(10, 2, 43, '2014-06-21 16:47:31');

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
-- Estructura de tabla para la tabla `respuesta`
--

CREATE TABLE IF NOT EXISTS `respuesta` (
  `id_respuesta` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `comentario` varchar(300) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_respuesta`),
  KEY `id_usuario` (`id_usuario`,`id_solicitud`),
  KEY `id_solicitud` (`id_solicitud`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_respuesta`, `id_usuario`, `id_solicitud`, `comentario`, `fecha`) VALUES
(1, 40, 3, 'Perfecto. ¿Que te parece si quedamos mañana?', '2014-05-31 09:19:00'),
(2, 27, 3, 'Vale, perfecto. Mañana pues.', '2014-05-31 10:22:00'),
(3, 27, 2, 'Esta semana nom puedo. ¿Qué te parece la semana que viene?', '2014-05-13 16:04:00'),
(9, 27, 2, 'mmmmm', '2014-06-08 21:04:46');

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
  `foto_servicio` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_servicio`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id_servicio`, `id_usuario`, `id_categoria`, `nombre_servicio`, `descripcion`, `horas`, `foto_servicio`) VALUES
(1, 27, 2, 'Clase de alemán', 'Doy clases de alemán.', 1, '1.png'),
(2, 27, 3, 'Clases de pilates', 'Doy clases de pilates', 1, NULL),
(3, 27, 1, 'Corto césped', 'Corto el césped de tu jardín', 2, NULL),
(4, 40, 2, 'Clases de inglés', 'Clases de inglés del mejor profesor que puedas tener', 1, '4.png'),
(5, 43, 5, 'Catequesis', 'Doy catequesis a gente de cualquier edad, con la finalidad de vivir la fe de manera mas viva en nuestros corazones', 2, '5.png'),
(6, 44, 4, 'Fontanero', 'Me ofrezco para realizar pequeños apaños en lo referente a fontaneria,sanitarios y otros elementos relacionados', 1, '6.png'),
(7, 44, 3, 'Karting', 'Doy clases de uso y puesta a punto de karts para carreras. No es necesario tener tu propio Kart. ', 3, '7.png'),
(8, 45, 3, 'Baila como un torbellino', 'Aprende a bailar como si la vida te fuera en ello. Lo unico que necesitar es tiempo. Garantizo exprimirte el 100%, para conseguir todo el ritmo que hay en ti.', 1, NULL),
(9, 46, 5, 'Pintura barroca', 'Enseño a pintar. Domino la pintura barroca, pero estaria dispuesto a enseñar a pintar cualquier estilo.', 5, '9.png'),
(10, 46, 3, 'Ballet', 'Enseño a bailar ballet. Tengo experiencia en grandes ballets nacionales. Imprescindible traer tu propio tutu.', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio_realizado`
--

CREATE TABLE IF NOT EXISTS `servicio_realizado` (
  `id_ser_realizado` int(11) NOT NULL AUTO_INCREMENT,
  `id_solicitud` int(11) NOT NULL,
  `cobrado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_ser_realizado`),
  UNIQUE KEY `id_solicitud_2` (`id_solicitud`),
  KEY `id_solicitud` (`id_solicitud`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `servicio_realizado`
--

INSERT INTO `servicio_realizado` (`id_ser_realizado`, `id_solicitud`, `cobrado`) VALUES
(26, 3, 1),
(27, 6, 1);

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
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `comentario` varchar(500) NOT NULL,
  PRIMARY KEY (`id_solicitud`),
  KEY `id_usuario` (`id_usuario`,`id_servicio`),
  KEY `id_servicio` (`id_servicio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `id_usuario`, `id_servicio`, `estado`, `fecha`, `inicio`, `fin`, `comentario`) VALUES
(2, 40, 2, 0, '2014-05-17 10:00:00', '2014-05-19 15:00:00', '2014-05-19 16:00:00', 'Estoy interesado en las clases de pilates'),
(3, 27, 4, 1, '2014-05-23 14:07:00', '2014-05-30 19:00:00', '2014-05-30 20:00:00', 'Me interesaría recibir una clase de inglés'),
(4, 42, 2, 2, '2014-05-13 17:23:00', '2014-05-15 18:00:00', '2014-05-15 19:00:00', 'Me intersan tus clases de pilates. ¿Cuándo quedaríamos?'),
(6, 27, 4, 1, '2014-06-11 21:30:00', '2014-06-15 16:05:00', '2014-06-15 17:05:00', 'Quiero una clase de inglés');

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
  `vio_sol_recibidas` datetime NOT NULL,
  `vio_sol_enviadas` datetime NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `nombre`, `apellidos`, `direccion`, `horas_usuario`, `foto_usuario`, `pass`, `salt`, `vio_sol_recibidas`, `vio_sol_enviadas`) VALUES
(27, 'pepe@gmail.com', 'pepe', '', 'Calle de prueba', 0, '27.png', '56c2f3d20b0867820237bc2795066ff50c9752aa35eeac038514a6338ce03726f1d5e9303d4603abf8330f41db59bee23640e34cd755b193c6d4bff582a075ea', 'd866feb98913640d819915305ea2487caeccb9d8b3aba528c5f6adbdd0025fb056273a32fd8a7993b6625f1c25b830700dddb0bbf19455ad7529132b76b6dc00', '2014-06-16 01:37:52', '2014-06-16 01:28:41'),
(40, 'fede@gmail.com', 'Federico', '', 'domicilio', 2, '40.png', '9c3e0cc29995e78efb45ccdddc29b58fb96f15c3619147bfbcac15be14b8547c8a22e7e309620e1647e070cdb5afbf8240ad8e994899af320dd1eaa9384170c1', '8a375802e50aae308ae0d539b62b4dcd259be13c8aab825c930511838b1e354c51665059db44d0aa6d0f44adf645c607d4a3da9d89ede539eed8633cde43b681', '2014-06-18 01:53:24', '2014-06-18 01:52:35'),
(42, 'cr7@gmail.com', 'cristiano ronaldo', '', 'Pozuelo', 0, NULL, '29049634bfb7b74f61782ea14e565a7d83439faab9ce5ac89fff416c9c21b143276989a3074acdeea943da9a380992a548781844bbdc29a5be95731e039044d4', '9bcd18417c5e633a30194565c4729f14ef1273a25212d557dd90934a4f6a5af1abbbff661a690505115bc0a8ff0826dab0e2437eb5ef85e6be13b8138768b31d', '0000-00-00 00:00:00', '2014-04-01 01:20:34'),
(43, 'juan@mail.com', 'Juan', 'Perez Fernandez', 'av/ falsa 123 ', 0, '43.png', '572fdb3e5ce64e18844096bd1d0a036232b518ae6ddd2553847ab631320543292e8748b8288efa36b586baa0d9f96b78905db0f1c3fbb69347ee83f0502ca638', 'd2da9d445cbc1aefc4b8a4ffa045d761751e6f3dca6ad7980cafcdcfe0f675baade5c84a2a8cc25357c3335804af8baedcf94e39bb0a453526f85c0db8829b4c', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'mario@mail.com', 'Mario', 'Mario', 'av/ tuberia nº3', 0, '44.png', '58913f7cc4145173719326f2b7677387c390df3da64cfd48b50f976b2e8cf6490e8a70864ea83f9a0c7910be5428b4eb451ba8c7fdca6c6f133e25a8dfa4b6f1', '98a1bc16ddd901572a4d08f4ac77ed86021e80d3983123fae27a429f00d8e0c67c714811973545ff50a9391d15650b3f9af9cd60176894fe8feafa316ec7d38e', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'bobby@mail.com', 'Bobby', 'Raffell', 'c/ rasputin nº231', 0, '45.png', '5d6c0641c827a0c62d88e173c51b4e3e247f3a8c98ade7a7669b2c932d082adb7e39465ba8d435b4495909e2c834da2204c4e628b0d672e4b9abfc2c0e038a25', '42d01b2dc0f7b4e00220c362a787e85171c02521aac860e0becc2407efc7a54fd8a53803a420d3c0fda685c6e893a854f7863c6eed9f57433c90b2c4c02a79e2', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'carlos@mail.com', 'Carlos', 'Navarro Hernandez', 'c/ fake 12345', 0, NULL, '65df7531f2e47ffad5525a37d4850b30a1b5345900ad38d8c77fc29e9df0d42cca1256f0d96b609d076773b9fc88c8f43ec8205f4c95ec516f58af9fc0e643c2', '4c81f10051923d34520a058722b3b7b11a856c1c8087103cfbdfba70c780f3262914e981feabdf30269b97a472360ffaabdc6dac4fbb96388c5931342f295ccd', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion_servicio`
--

CREATE TABLE IF NOT EXISTS `valoracion_servicio` (
  `id_valoracion` int(11) NOT NULL AUTO_INCREMENT,
  `id_ser_realizado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `opinion` varchar(500) NOT NULL,
  `fecha` datetime NOT NULL,
  PRIMARY KEY (`id_valoracion`),
  KEY `id_ser_realizado` (`id_ser_realizado`),
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
-- Filtros para la tabla `respuesta`
--
ALTER TABLE `respuesta`
  ADD CONSTRAINT `respuesta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respuesta_ibfk_2` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud` (`id_solicitud`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD CONSTRAINT `servicio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `servicio_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicio_realizado`
--
ALTER TABLE `servicio_realizado`
  ADD CONSTRAINT `servicio_realizado_ibfk_1` FOREIGN KEY (`id_solicitud`) REFERENCES `solicitud` (`id_solicitud`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `valoracion_servicio_ibfk_1` FOREIGN KEY (`id_ser_realizado`) REFERENCES `servicio_realizado` (`id_ser_realizado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoracion_servicio_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
