-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2014 a las 16:49:17
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `intime`
--

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `correo`, `pass`, `salt`) VALUES
(1, 'admin@admin.com', 'cffcede585c94a629ba29a5ce9be9de3728d413747fa0e333e353bd1fe09dea964a31cae7f99021db65e0f4f3df80c4c7ecbfc6a14117ef1bc2325adb236d42f', '438aff7512921a23f3a97d0705d62dc08758e5240568bf1d097eaa147ce7f6a0f7e788eac68178ea2f64962d4ef7ae36fa1cc780fe73c011380b0d5f680a7d5d');

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `categoria`) VALUES
(3, 'Deportes'),
(4, 'Hogar'),
(2, 'Idiomas'),
(1, 'Jardineria'),
(5, 'Otros');

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id_favorito`, `id_servicio`, `id_usuario`, `fecha`) VALUES
(10, 2, 43, '2014-06-21 16:47:31'),
(11, 8, 46, '2014-06-22 12:09:14'),
(12, 1, 44, '2014-06-22 12:25:17');

--
-- Volcado de datos para la tabla `respuesta`
--

INSERT INTO `respuesta` (`id_respuesta`, `id_usuario`, `id_solicitud`, `comentario`, `fecha`) VALUES
(1, 40, 3, 'Perfecto. ¿Que te parece si quedamos mañana?', '2014-05-31 09:19:00'),
(2, 27, 3, 'Vale, perfecto. Mañana pues.', '2014-05-31 10:22:00'),
(3, 27, 2, 'Esta semana nom puedo. ¿Qué te parece la semana que viene?', '2014-05-13 16:04:00'),
(9, 27, 2, 'mmmmm', '2014-06-08 21:04:46'),
(10, 47, 22, 'Me parece perfecto. entonces te parece bien hoy?', '2014-06-22 15:45:08'),
(11, 40, 22, 'si. si puedes.', '2014-06-22 15:45:31'),
(12, 43, 32, 'Ven a mi hijo.', '2014-06-22 16:30:12'),
(13, 27, 33, 'No puedo lo siento, no me funciona el cortacesped.', '2014-06-22 16:36:11');

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
(10, 46, 3, 'Ballet', 'Enseño a bailar ballet. Tengo experiencia en grandes ballets nacionales. Imprescindible traer tu propio tutu.', 2, NULL),
(14, 42, 3, 'Aprende el dribling de los campeones', 'Aprende de futbol conmigo. Resultados 100% garantizados en solo una clase. No te arrepentiras.', 1, '14.png'),
(15, 47, 1, 'Arreglo setos.', 'Arreglo cualquier tipo de seto o maceta. Tambien estaria dispuesto a podar arboles', 2, '15.png');

--
-- Volcado de datos para la tabla `servicio_realizado`
--

INSERT INTO `servicio_realizado` (`id_ser_realizado`, `id_solicitud`, `cobrado`) VALUES
(26, 3, 1),
(27, 6, 1),
(28, 8, 1),
(29, 11, 1),
(30, 9, 1),
(31, 20, 1),
(32, 21, 1),
(33, 7, 1),
(34, 22, 1),
(35, 25, 1),
(36, 26, 1),
(37, 12, 1),
(38, 27, 1),
(39, 29, 0),
(40, 30, 1),
(41, 31, 0),
(42, 32, 1);

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`id_solicitud`, `id_usuario`, `id_servicio`, `estado`, `fecha`, `inicio`, `fin`, `comentario`) VALUES
(2, 40, 2, 3, '2014-05-17 10:00:00', '2014-05-19 15:00:00', '2014-05-19 16:00:00', 'Estoy interesado en las clases de pilates'),
(3, 27, 4, 1, '2014-05-23 14:07:00', '2014-05-30 19:00:00', '2014-05-30 20:00:00', 'Me interesaría recibir una clase de inglés'),
(4, 42, 2, 2, '2014-05-13 17:23:00', '2014-05-15 18:00:00', '2014-05-15 19:00:00', 'Me intersan tus clases de pilates. ¿Cuándo quedaríamos?'),
(6, 27, 4, 1, '2014-06-11 21:30:00', '2014-06-15 16:05:00', '2014-06-15 17:05:00', 'Quiero una clase de inglés'),
(7, 44, 5, 1, '2014-06-22 11:52:58', '2014-06-22 13:00:00', '2014-06-22 15:00:00', 'Me gustaria recibir una clase de esto'),
(8, 44, 1, 1, '2014-06-22 11:56:48', '2014-06-22 12:00:00', '2014-06-22 13:00:00', 'Me gustaria aprender algo de aleman, Gracias'),
(9, 46, 8, 1, '2014-06-22 12:12:01', '2014-06-22 13:00:00', '2014-06-22 14:00:00', 'Estaría encantado de poder aprender a bailar.'),
(10, 46, 2, 2, '2014-06-22 12:20:30', '2014-06-22 13:00:00', '2014-06-22 14:00:00', 'Ultimamente he oido mucho acerca de este metodo/deporte, me gustaria una clase.'),
(11, 46, 6, 1, '2014-06-22 12:23:06', '2014-06-22 13:00:00', '2014-06-22 14:00:00', 'Me gustaria que me limparan las cañerias. Creo que las tengo atrancadas.'),
(12, 42, 7, 1, '2014-06-22 12:32:16', '2014-06-22 13:00:00', '2014-06-22 16:00:00', 'Me gustaria una clase de puesta a punto de karts. Gracias.'),
(20, 44, 8, 1, '2014-06-22 10:00:00', '2014-06-22 12:00:00', '2014-06-22 14:35:00', 'okidoki'),
(21, 44, 8, 1, '2014-06-21 00:00:00', '2014-06-22 00:00:00', '2014-06-22 14:41:00', 'Me gustaria otra clase de danza. gracias.'),
(22, 40, 15, 1, '2014-06-22 15:44:42', '2014-06-22 14:00:00', '2014-06-22 15:48:00', 'Me gustaria recibir sus servicios. Tengo los arbustos demasiado salvajes. '),
(25, 27, 15, 1, '2014-06-22 00:00:00', '2014-06-22 15:28:00', '2014-06-22 15:55:00', 'Necesito una buena poda a mis arbustos gracias'),
(26, 47, 7, 1, '2014-06-22 15:58:38', '2014-06-22 13:00:00', '2014-06-22 16:00:00', 'Me muero por una clase de estas.'),
(27, 27, 14, 1, '2014-06-22 15:06:29', '2014-06-22 15:09:00', '2014-06-22 16:10:00', 'Me vendria bien.'),
(28, 42, 6, 1, '2014-06-22 16:15:37', '2014-06-22 17:00:00', '2014-06-22 18:00:00', 'Necesito fontanero, urgente'),
(29, 44, 9, 1, '2014-06-22 16:16:57', '2014-06-22 11:00:00', '2014-06-22 16:00:00', 'No se que esperar de esto, pero me gustaria tomar una clase.'),
(30, 44, 2, 1, '2014-06-22 15:19:31', '2014-06-22 15:00:00', '2014-06-22 16:00:00', 'A ver que tal se me da esto, a ver si me puedes enseñar algo'),
(31, 43, 9, 1, '2014-06-22 08:26:57', '2014-06-22 08:00:00', '2014-06-22 13:00:00', 'Me gustaria una clase'),
(32, 45, 5, 2, '2014-06-22 13:29:47', '2014-06-22 14:00:00', '2014-06-22 16:00:00', 'Necesito algo asi, estoy perdido en la vida.'),
(33, 43, 3, 2, '2014-06-22 16:34:20', '2014-06-22 17:00:00', '2014-06-22 19:00:00', 'Cortame el cesped pepe. Por favor.');

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `correo`, `nombre`, `apellidos`, `direccion`, `horas_usuario`, `foto_usuario`, `pass`, `salt`, `vio_sol_recibidas`, `vio_sol_enviadas`) VALUES
(27, 'pepe@gmail.com', 'pepe', '', 'Calle de prueba', 1, '27.png', '56c2f3d20b0867820237bc2795066ff50c9752aa35eeac038514a6338ce03726f1d5e9303d4603abf8330f41db59bee23640e34cd755b193c6d4bff582a075ea', 'd866feb98913640d819915305ea2487caeccb9d8b3aba528c5f6adbdd0025fb056273a32fd8a7993b6625f1c25b830700dddb0bbf19455ad7529132b76b6dc00', '2014-06-22 16:36:28', '2014-06-22 16:10:22'),
(40, 'fede@gmail.com', 'Federico', '', 'domicilio', 3, '40.png', '9c3e0cc29995e78efb45ccdddc29b58fb96f15c3619147bfbcac15be14b8547c8a22e7e309620e1647e070cdb5afbf8240ad8e994899af320dd1eaa9384170c1', '8a375802e50aae308ae0d539b62b4dcd259be13c8aab825c930511838b1e354c51665059db44d0aa6d0f44adf645c607d4a3da9d89ede539eed8633cde43b681', '2014-06-22 15:46:52', '2014-06-22 15:46:53'),
(42, 'cr7@gmail.com', 'cristiano ronaldo', '', 'Pozuelo', 1, NULL, '29049634bfb7b74f61782ea14e565a7d83439faab9ce5ac89fff416c9c21b143276989a3074acdeea943da9a380992a548781844bbdc29a5be95731e039044d4', '9bcd18417c5e633a30194565c4729f14ef1273a25212d557dd90934a4f6a5af1abbbff661a690505115bc0a8ff0826dab0e2437eb5ef85e6be13b8138768b31d', '2014-06-22 16:10:25', '2014-06-22 16:15:38'),
(43, 'juan@mail.com', 'Juan', 'Perez Fernandez', 'av/ falsa 123 ', 2, '43.png', '572fdb3e5ce64e18844096bd1d0a036232b518ae6ddd2553847ab631320543292e8748b8288efa36b586baa0d9f96b78905db0f1c3fbb69347ee83f0502ca638', 'd2da9d445cbc1aefc4b8a4ffa045d761751e6f3dca6ad7980cafcdcfe0f675baade5c84a2a8cc25357c3335804af8baedcf94e39bb0a453526f85c0db8829b4c', '2014-06-22 16:30:15', '2014-06-22 16:34:21'),
(44, 'mario@mail.com', 'Mario', 'Mario', 'av/ tuberia nº3', 3, '44.png', '58913f7cc4145173719326f2b7677387c390df3da64cfd48b50f976b2e8cf6490e8a70864ea83f9a0c7910be5428b4eb451ba8c7fdca6c6f133e25a8dfa4b6f1', '98a1bc16ddd901572a4d08f4ac77ed86021e80d3983123fae27a429f00d8e0c67c714811973545ff50a9391d15650b3f9af9cd60176894fe8feafa316ec7d38e', '2014-06-22 16:15:59', '2014-06-22 16:20:18'),
(45, 'bobby@mail.com', 'Bobby', 'Raffell', 'c/ rasputin nº231', 2, '45.png', '5d6c0641c827a0c62d88e173c51b4e3e247f3a8c98ade7a7669b2c932d082adb7e39465ba8d435b4495909e2c834da2204c4e628b0d672e4b9abfc2c0e038a25', '42d01b2dc0f7b4e00220c362a787e85171c02521aac860e0becc2407efc7a54fd8a53803a420d3c0fda685c6e893a854f7863c6eed9f57433c90b2c4c02a79e2', '2014-06-22 12:19:29', '2014-06-22 16:31:01'),
(46, 'carlos@mail.com', 'Carlos', 'Navarro Hernandez', 'c/ fake 12345', 1, NULL, '65df7531f2e47ffad5525a37d4850b30a1b5345900ad38d8c77fc29e9df0d42cca1256f0d96b609d076773b9fc88c8f43ec8205f4c95ec516f58af9fc0e643c2', '4c81f10051923d34520a058722b3b7b11a856c1c8087103cfbdfba70c780f3262914e981feabdf30269b97a472360ffaabdc6dac4fbb96388c5931342f295ccd', '2014-06-22 12:21:43', '2014-06-22 12:23:07'),
(47, 'javi@mail.com', 'Javier', 'Jimenez Fernandez', 'c/ la dorada 1.', 1, NULL, '8be489e549a8c5391e839445a377c752fde1b9500260852abcd3027e8160f1b695b9816c5e8ceea6b87746dd75895112b834e3c5dcf95f6284acb942065344c0', 'b47487dd2e27525d5fc681b692be1b65c4b135d1707c6d1fb62154f9647c33bf161af44c07824a9876030b29821d5173649ee0768904b2f18e5c8288ca7f3ede', '2014-06-22 15:48:43', '2014-06-22 15:58:38');

--
-- Volcado de datos para la tabla `valoracion_servicio`
--

INSERT INTO `valoracion_servicio` (`id_valoracion`, `id_ser_realizado`, `id_usuario`, `nota`, `opinion`, `fecha`) VALUES
(1, 27, 27, 10, 'Clase excelente, ten por seguro que repetire.', '2014-06-22 11:58:19'),
(2, 26, 27, 6, 'Me gusto mucho mas la clase anterior. ', '2014-06-22 11:58:50'),
(3, 28, 44, 9, 'Das ist wunderbar!', '2014-06-22 13:12:59'),
(4, 32, 44, 10, 'Le dejo mis dies.', '2014-06-22 14:47:31'),
(5, 31, 44, 8, 'Bravo, clase magistral', '2014-06-22 14:47:50'),
(6, 33, 44, 4, 'Me esperaba otra cosa', '2014-06-22 15:36:53'),
(7, 34, 40, 7, 'Me los ha dejado como yo quería. Unica pega: podría ser mas puntual', '2014-06-22 15:49:28'),
(8, 35, 27, 5, 'Javier es buena gente, su servicio no es tan bueno...', '2014-06-22 15:56:30'),
(9, 36, 47, 7, 'Muy divertido y recomendable.', '2014-06-22 16:01:43'),
(10, 39, 44, 2, 'Perdida de tiempo, no tiene ni idea.', '2014-06-22 16:18:24'),
(11, 40, 44, 7, 'Me siento bastante mejor despues de esto', '2014-06-22 16:20:43'),
(12, 41, 43, 8, 'Apasionante, Este hombre vive por lo que mas le gusta, y eso es la pintura.', '2014-06-22 16:28:19'),
(13, 42, 45, 8, 'Justo lo que necesitaba. gracias', '2014-06-22 16:31:22');
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
