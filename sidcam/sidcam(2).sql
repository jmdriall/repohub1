-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2015 a las 02:08:58
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sidcam`
--
CREATE DATABASE IF NOT EXISTS `sidcam` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `sidcam`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accidente`
--

CREATE TABLE IF NOT EXISTS `accidente` (
  `accidente_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_ocurrida` date NOT NULL,
  `dias_perdidos` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `hhrt` int(11) NOT NULL,
  PRIMARY KEY (`accidente_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `accidente`
--

INSERT INTO `accidente` (`accidente_id`, `user_id`, `titulo`, `observacion`, `fecha_ocurrida`, `dias_perdidos`, `area_id`, `hhrt`) VALUES
(2, 10, 'jojojo', '<p>sdfasdf</p>', '2015-01-15', 21, 4, 0),
(3, 10, 'jejejej', '<p>sdfgsdfg</p>', '2015-01-04', 8, 3, 0),
(8, 10, 'Patio de Maniobras', '<p>El SR. Juan Manuel Ruiz esrtab askdjasdasd</p>', '2015-01-23', 100, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accidente_trabajador`
--

CREATE TABLE IF NOT EXISTS `accidente_trabajador` (
  `accidente_trabajador_id` int(11) NOT NULL AUTO_INCREMENT,
  `accidente_id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `trabajador_id` int(11) NOT NULL,
  `body_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`accidente_trabajador_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `accidente_trabajador`
--

INSERT INTO `accidente_trabajador` (`accidente_trabajador_id`, `accidente_id`, `nombre`, `trabajador_id`, `body_id`, `user_id`) VALUES
(1, 2, 'Andres Mn', 3, 1, 10),
(6, 2, 'Jeh asdasdasd', 1, 1, 10),
(8, 3, 'Jeh asdasdasd', 1, 2, 10),
(9, 3, 'Jorge Kjk', 2, 2, 10),
(10, 3, 'Andres Mn', 3, 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad`
--

CREATE TABLE IF NOT EXISTS `actividad` (
  `actividad_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `especifico_id` int(11) NOT NULL,
  `requisito_legal` varchar(255) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`actividad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `actividad`
--

INSERT INTO `actividad` (`actividad_id`, `nombre`, `especifico_id`, `requisito_legal`, `prioridad`, `user_id`) VALUES
(15, 'Listar', 10, 'alsjkh', 3, 10),
(16, 'Buscar', 11, 'sldkjfhaslkdfj', 2, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE IF NOT EXISTS `archivo` (
  `archivo_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `codigo` varchar(150) NOT NULL,
  `revision` varchar(150) NOT NULL,
  `fecha_aprobacion` varchar(150) NOT NULL,
  `picture` varchar(150) NOT NULL DEFAULT '0',
  `tipo_id` int(11) NOT NULL,
  PRIMARY KEY (`archivo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `archivo`
--

INSERT INTO `archivo` (`archivo_id`, `user_id`, `title`, `codigo`, `revision`, `fecha_aprobacion`, `picture`, `tipo_id`) VALUES
(9, 13, 'Garde', 'hgjm', 'fjhgfjhgf', '2015-01-16', 'Report.pdf', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE IF NOT EXISTS `area` (
  `area_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`area_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`area_id`, `nombre`, `user_id`) VALUES
(2, 'Almacenes', 10),
(3, 'Limpieza', 10),
(4, 'Comedor', 10),
(6, 'drfghjkl', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `body`
--

CREATE TABLE IF NOT EXISTS `body` (
  `body_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`body_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `body`
--

INSERT INTO `body` (`body_id`, `nombre`, `user_id`) VALUES
(1, 'Cuello', 10),
(2, 'cabeza', 10),
(3, 'Cabeza', 13),
(4, 'Cuello', 13),
(5, 'Brazos', 13),
(6, 'Manos', 13),
(7, 'Espalda', 13),
(8, 'Abdomen', 13),
(9, 'Muslo', 13),
(10, 'Piernas', 13),
(11, 'Pies', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitacion`
--

CREATE TABLE IF NOT EXISTS `capacitacion` (
  `capacitacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`capacitacion_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `capacitacion`
--

INSERT INTO `capacitacion` (`capacitacion_id`, `title`, `user_id`, `descripcion`) VALUES
(1, 'Archivos', 10, ''),
(2, 'Conductos', 10, ''),
(3, 'OTROS', 10, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capacitacion_work`
--

CREATE TABLE IF NOT EXISTS `capacitacion_work` (
  `capacitacion_work_id` int(11) NOT NULL AUTO_INCREMENT,
  `capacitacion_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `trabajador_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`capacitacion_work_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `capacitacion_work`
--

INSERT INTO `capacitacion_work` (`capacitacion_work_id`, `capacitacion_id`, `title`, `trabajador_id`, `fecha`, `codigo`, `user_id`) VALUES
(8, 1, 'Archivos', 3, '2014-12-04', 'asdasd', 10),
(9, 2, 'Conductos', 3, '2014-12-20', '2tyrtdyh', 10),
(17, 1, 'Archivos', 2, '2014-12-03', 'gfsdgsdfg', 10),
(18, 3, 'OTROS', 2, '2012-06-12', 'jajajaj', 10),
(19, 3, 'OTROS', 3, '2012-06-12', 'gsdfgsdfg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE IF NOT EXISTS `cargo` (
  `cargo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`cargo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`cargo_id`, `nombre`, `user_id`) VALUES
(1, 'Cobranzas', 10),
(3, 'sdfgbhnmh', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `picture` varchar(150) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control`
--

CREATE TABLE IF NOT EXISTS `control` (
  `control_id` int(11) NOT NULL AUTO_INCREMENT,
  `seguimiento_id` int(11) NOT NULL,
  `fecha_control` date NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `evidencia` text NOT NULL,
  `conformidad` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `medida` varchar(100) NOT NULL,
  PRIMARY KEY (`control_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `c_inspeccion`
--

CREATE TABLE IF NOT EXISTS `c_inspeccion` (
  `c_inspeccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `inspeccion_id` int(11) NOT NULL,
  `fecha_c_inspeccion` date NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `evidencia` text NOT NULL,
  `conformidad` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `medida` varchar(100) NOT NULL,
  PRIMARY KEY (`c_inspeccion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `c_inspeccion`
--

INSERT INTO `c_inspeccion` (`c_inspeccion_id`, `inspeccion_id`, `fecha_c_inspeccion`, `responsable`, `evidencia`, `conformidad`, `user_id`, `medida`) VALUES
(12, 6, '2015-01-04', 'SDFSDF', '<p>SAD</p>', 0, 10, 'enchufar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epp`
--

CREATE TABLE IF NOT EXISTS `epp` (
  `epp_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`epp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `epp`
--

INSERT INTO `epp` (`epp_id`, `title`, `user_id`, `descripcion`) VALUES
(1, 'fghj', 10, ''),
(2, 'Garde', 10, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `epp_work`
--

CREATE TABLE IF NOT EXISTS `epp_work` (
  `epp_work_id` int(11) NOT NULL AUTO_INCREMENT,
  `epp_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `trabajador_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `codigo` varchar(100) NOT NULL,
  PRIMARY KEY (`epp_work_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `epp_work`
--

INSERT INTO `epp_work` (`epp_work_id`, `epp_id`, `title`, `trabajador_id`, `user_id`, `fecha`, `codigo`) VALUES
(5, 1, 'fghj', 3, 10, '2012-06-12', '125fdfg'),
(11, 1, 'fghj', 2, 10, '2012-06-12', 'gsdfgsdfg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especifico`
--

CREATE TABLE IF NOT EXISTS `especifico` (
  `especifico_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `objetivo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`especifico_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `especifico`
--

INSERT INTO `especifico` (`especifico_id`, `nombre`, `objetivo_id`, `user_id`) VALUES
(11, 'Aprender', 8, 10),
(10, 'Enseniar', 8, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inspeccion`
--

CREATE TABLE IF NOT EXISTS `inspeccion` (
  `inspeccion_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_ocurrida` date NOT NULL,
  PRIMARY KEY (`inspeccion_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `inspeccion`
--

INSERT INTO `inspeccion` (`inspeccion_id`, `user_id`, `titulo`, `observacion`, `fecha_ocurrida`) VALUES
(6, 10, 'DSFGSDFGDF', '<p>EWRSAR</p>', '2015-01-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medida_correctiva`
--

CREATE TABLE IF NOT EXISTS `medida_correctiva` (
  `medida_correctiva_id` int(11) NOT NULL AUTO_INCREMENT,
  `accidente_id` int(11) NOT NULL,
  `fecha_medida_correctiva` date NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `evidencia` text NOT NULL,
  `conformidad` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `medida` varchar(150) NOT NULL,
  PRIMARY KEY (`medida_correctiva_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `medida_correctiva`
--

INSERT INTO `medida_correctiva` (`medida_correctiva_id`, `accidente_id`, `fecha_medida_correctiva`, `responsable`, `evidencia`, `conformidad`, `user_id`, `medida`) VALUES
(1, 2, '2014-12-09', 'SDFSDF', '<p>erwet</p>', 0, 10, 'tres'),
(2, 2, '2014-12-17', 'SDFSDF', '<p>asdfasdf</p>', 0, 10, 'jajajaja'),
(5, 3, '2014-12-25', 'SDFSDF', '<p>edfg</p>', 0, 10, ''),
(7, 8, '2014-12-25', 'Supervisor de Produccion', '<p>Implementar Equipos de proteccion para manos</p>\r\n<p>Implementar senaletica</p>\r\n<p>Capacitar al personal en el uso de Guantes de seguridad</p>', 0, 10, 'Comprar EPP'),
(9, 3, '2015-01-09', 'aSDAsd', '<p>asdasd</p>', 0, 10, '0'),
(13, 8, '2015-01-15', 'Jose SUA', '', 0, 10, 'other'),
(14, 2, '2015-01-30', 'SDFSDF', '', 0, 10, 'enchufar'),
(15, 3, '2015-01-22', 'Joa', '', 0, 10, 'Reparar'),
(16, 8, '2015-01-17', 'Supervisor de Produccion', '', 0, 10, 'asdasdasd'),
(17, 8, '2015-01-24', 'goz', '', 0, 10, 'asadsd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `objetivo`
--

CREATE TABLE IF NOT EXISTS `objetivo` (
  `objetivo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`objetivo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `objetivo`
--

INSERT INTO `objetivo` (`objetivo_id`, `nombre`, `user_id`) VALUES
(8, 'Clases', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion`
--

CREATE TABLE IF NOT EXISTS `planificacion` (
  `planificacion_id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `evidencia` text NOT NULL,
  `responsable` varchar(255) NOT NULL,
  `actividad_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`planificacion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `planificacion`
--

INSERT INTO `planificacion` (`planificacion_id`, `fecha_ini`, `fecha_fin`, `evidencia`, `responsable`, `actividad_id`, `user_id`) VALUES
(1, '2014-11-11', '2014-12-28', '<p>dfgsdgf</p>', 'ko', 0, 10),
(20, '2015-01-07', '2015-01-16', '<p>asdfasdf</p>', 'Alfonzo', 15, 10),
(21, '2015-01-01', '2015-01-23', '<p>hgjk.fghj</p>', 'Supervisor de Produccion', 16, 10),
(22, '2015-01-01', '2015-01-08', '<p>fghjfghj</p>', 'Supervisor de Produccion', 16, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proceso`
--

CREATE TABLE IF NOT EXISTS `proceso` (
  `proceso_id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad_id` int(11) NOT NULL,
  `fecha_ini` datetime NOT NULL,
  `fecha_fin` datetime NOT NULL,
  `evidencia` varchar(255) NOT NULL,
  `responsable` varchar(255) NOT NULL,
  PRIMARY KEY (`proceso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE IF NOT EXISTS `seguimiento` (
  `seguimiento_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_ocurrida` date NOT NULL,
  PRIMARY KEY (`seguimiento_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_description` text NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_title`, `slider_image`, `slider_description`) VALUES
(1, 'slide1', 'Banner_1.jpg', ''),
(2, 'slide2', 'Banner_2.jpg', ''),
(3, 'slide3', 'Banner_3.jpg', ''),
(4, 'slide4', 'Banner_4.jpg', ''),
(5, 'slide5', 'Banner_5.jpg', ''),
(6, 'slide6', 'Banner_6.jpg', ''),
(7, 'slide7', 'Banner_7.jpg', ''),
(8, 'slide8', 'Banner_8.jpg', ''),
(9, 'slide9', 'Banner_9.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
  `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `picture` varchar(150) NOT NULL,
  `visit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sub_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `tipo_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`tipo_id`, `nombre`, `user_id`) VALUES
(1, 'politica', 10),
(2, 'operacion', 10),
(3, 'evaluacion', 10),
(4, 'planificacion', 10),
(5, 'indicadores de gestion', 10),
(11, 'politica', 13),
(12, 'operacion', 13),
(13, 'evaluacion', 13),
(14, 'planificacion', 13),
(15, 'indicadores de gestion', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE IF NOT EXISTS `trabajador` (
  `trabajador_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `capacitacion` int(11) NOT NULL,
  `regla_recomendaciones` int(11) NOT NULL,
  `epp` int(11) NOT NULL,
  `examen_medico` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`trabajador_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`trabajador_id`, `nombre`, `apellidos`, `cargo_id`, `dni`, `capacitacion`, `regla_recomendaciones`, `epp`, `examen_medico`, `user_id`) VALUES
(2, 'Jorge', 'Kjk', 1, 321654654, 0, 1, 0, 1, 10),
(3, 'Andres', 'Mn', 1, 3216546, 0, 1, 0, 1, 10),
(6, 'Carlos', 'Antezana', 3, 234567, 0, 1, 0, 1, 10),
(7, 'Bigote', 'Almendrilllo', 3, 234567, 0, 1, 0, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_level_id` int(11) DEFAULT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `user_level_id`, `login`, `password`, `firstname`, `lastname`, `email`) VALUES
(1, 1, 'admin', 'dbox', 'SICAMB', 'SICAMB', 'sicamb@gmail.com'),
(10, 2, 'ko', 'ko', 'ko', 'ko', 'jmdriall@hotmail.es'),
(13, 2, 'gt', 'gt', 'gt', 'gt', 'jmdriall@hotmail.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_level`
--

CREATE TABLE IF NOT EXISTS `user_level` (
  `user_level_id` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(50) NOT NULL,
  PRIMARY KEY (`user_level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_logged`
--

CREATE TABLE IF NOT EXISTS `user_logged` (
  `user_logged_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `log_date_time` datetime NOT NULL,
  PRIMARY KEY (`user_logged_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=155 ;

--
-- Volcado de datos para la tabla `user_logged`
--

INSERT INTO `user_logged` (`user_logged_id`, `login`, `log_date_time`) VALUES
(1, 'admin', '2014-12-16 00:45:27'),
(2, 'admin', '2014-12-16 01:41:23'),
(3, 'admin', '2014-12-16 15:40:00'),
(4, 'jo', '2014-12-16 15:42:14'),
(5, 'admin', '2014-12-16 16:16:19'),
(6, 'admin', '2014-12-16 19:52:59'),
(7, 'admin', '2014-12-17 04:00:48'),
(8, 'admin', '2014-12-17 04:34:45'),
(9, 'jo', '2014-12-17 04:35:14'),
(10, 'admin', '2014-12-17 04:49:38'),
(11, 'jo', '2014-12-17 04:51:43'),
(12, 'admin', '2014-12-17 04:54:02'),
(13, 'je', '2014-12-17 04:55:27'),
(14, 'je', '2014-12-17 16:10:17'),
(15, 'admin', '2014-12-17 16:39:45'),
(16, 'jo', '2014-12-17 16:53:21'),
(17, 'jo', '2014-12-17 17:08:49'),
(18, 'jo', '2014-12-17 17:09:58'),
(19, 'jo', '2014-12-17 21:35:48'),
(20, 'admin', '2014-12-17 22:53:25'),
(21, 'admin', '2014-12-17 22:59:56'),
(22, 'jo', '2014-12-17 23:02:31'),
(23, 'jo', '2014-12-17 23:19:55'),
(24, 'jo', '2014-12-18 02:25:20'),
(25, 'je', '2014-12-18 02:38:14'),
(26, 'jo', '2014-12-18 02:56:43'),
(27, 'je', '2014-12-18 02:57:10'),
(28, 'admin', '2014-12-18 02:57:47'),
(29, 'admin', '2014-12-18 17:07:52'),
(30, 'jo', '2014-12-18 18:07:44'),
(31, 'jo', '2014-12-18 21:48:47'),
(32, 'admin', '2014-12-18 22:01:04'),
(33, 'ko', '2014-12-18 22:10:40'),
(34, 'ko', '2014-12-19 02:12:40'),
(35, 'admin', '2014-12-19 02:13:14'),
(36, 'ko', '2014-12-19 15:50:00'),
(37, 'admin', '2014-12-19 18:14:37'),
(38, 'ko', '2014-12-19 22:51:03'),
(39, 'ko', '2014-12-21 03:27:32'),
(40, 'ko', '2014-12-21 03:42:35'),
(41, 'ko', '2014-12-21 15:33:46'),
(42, 'ko', '2014-12-21 17:21:34'),
(43, 'ko', '2014-12-21 17:22:43'),
(44, 'ko', '2014-12-21 17:24:06'),
(45, 'ko', '2014-12-21 17:24:28'),
(46, 'ko', '2014-12-21 17:25:33'),
(47, 'ko', '2014-12-21 17:36:49'),
(48, 'ko', '2014-12-21 17:37:16'),
(49, 'ko', '2014-12-21 17:38:44'),
(50, 'ko', '2014-12-21 17:40:14'),
(51, 'ko', '2014-12-21 17:56:55'),
(52, 'ko', '2014-12-21 17:56:58'),
(53, 'ko', '2014-12-21 17:57:01'),
(54, 'ko', '2014-12-21 17:57:05'),
(55, 'ko', '2014-12-21 17:57:08'),
(56, 'ko', '2014-12-21 17:57:12'),
(57, 'ko', '2014-12-21 17:57:16'),
(58, 'admin', '2014-12-21 17:57:50'),
(59, 'admin', '2014-12-22 13:03:59'),
(60, 'ko', '2014-12-22 13:04:51'),
(61, 'ko', '2014-12-22 13:59:39'),
(62, 'ko', '2014-12-22 14:00:07'),
(63, 'ko', '2014-12-22 14:00:17'),
(64, 'ko', '2014-12-22 14:00:33'),
(65, 'ko', '2014-12-22 14:00:40'),
(66, 'ko', '2014-12-22 14:00:54'),
(67, 'admin', '2014-12-22 16:05:51'),
(68, 'ko', '2014-12-22 16:19:34'),
(69, 'admin', '2014-12-23 02:19:57'),
(70, 'ko', '2014-12-23 03:23:48'),
(71, 'ko', '2014-12-23 13:41:18'),
(72, 'ko', '2014-12-23 15:56:42'),
(73, 'admin', '2014-12-23 18:12:25'),
(74, 'ko', '2014-12-23 20:42:33'),
(75, 'admin', '2014-12-23 21:36:43'),
(76, 'ko', '2014-12-24 00:40:04'),
(77, 'ko', '2014-12-24 01:21:38'),
(78, 'ko', '2014-12-24 01:22:43'),
(79, 'ko', '2014-12-24 13:07:59'),
(80, 'ko', '2014-12-24 13:22:45'),
(81, 'admin', '2014-12-24 13:29:26'),
(82, 'ko', '2014-12-24 13:36:40'),
(83, 'admin', '2014-12-24 15:26:53'),
(84, 'ko', '2014-12-24 16:31:02'),
(85, 'admin', '2014-12-24 16:40:02'),
(86, 'admin', '2014-12-24 19:02:49'),
(87, 'admin', '2014-12-24 23:17:11'),
(88, 'ko', '2014-12-25 03:07:15'),
(89, 'admin', '2014-12-25 04:27:47'),
(90, 'ko', '2014-12-25 13:39:46'),
(91, 'admin', '2014-12-25 16:27:56'),
(92, 'ko', '2014-12-25 17:38:42'),
(93, 'admin', '2014-12-25 19:29:05'),
(94, 'admin', '2014-12-25 21:51:28'),
(95, 'admin', '2014-12-25 23:05:36'),
(96, 'ko', '2014-12-25 23:05:42'),
(97, 'ko', '2014-12-25 23:36:18'),
(98, 'ko', '2014-12-26 13:15:40'),
(99, 'admin', '2014-12-26 13:38:29'),
(100, 'ka', '2014-12-26 22:04:34'),
(101, 'admin', '2014-12-26 22:05:13'),
(102, 'ko', '2014-12-26 23:02:18'),
(103, 'ka', '2014-12-26 23:06:02'),
(104, 'ka', '2014-12-28 02:12:31'),
(105, 'admin', '2014-12-28 02:13:48'),
(106, 'ko', '2014-12-28 02:16:25'),
(107, 'ka', '2014-12-28 02:29:27'),
(108, 'admin', '2014-12-28 16:38:18'),
(109, 'admin', '2014-12-28 21:44:45'),
(110, 'ko', '2014-12-28 21:49:36'),
(111, 'ko', '2014-12-28 22:31:14'),
(112, 'ko', '2014-12-29 13:33:01'),
(113, 'admin', '2014-12-29 13:34:35'),
(114, 'admin', '2014-12-29 18:08:03'),
(115, 'ka', '2014-12-29 18:09:32'),
(116, 'ko', '2014-12-29 18:14:38'),
(117, 'ko', '2014-12-29 23:07:21'),
(118, 'ko', '2014-12-30 02:51:26'),
(119, 'admin', '2014-12-30 03:20:15'),
(120, 'ko', '2014-12-31 03:33:32'),
(121, 'admin', '2014-12-30 15:46:24'),
(122, 'ka', '2014-12-30 16:08:10'),
(123, 'ko', '2014-12-30 16:41:26'),
(124, 'ko', '2014-12-30 20:34:08'),
(125, 'ko', '2014-12-31 04:59:28'),
(126, 'admin', '2014-12-31 05:06:05'),
(127, 'ko', '2014-12-31 17:33:46'),
(128, 'admin', '2014-12-31 18:03:40'),
(129, 'ko', '2015-01-02 17:48:18'),
(130, 'admin', '2015-01-02 17:52:30'),
(131, 'admin', '2015-01-04 12:36:13'),
(132, 'ko', '2015-01-04 12:38:33'),
(133, 'admin', '2015-01-04 20:34:00'),
(134, 'admin', '2015-01-05 02:42:20'),
(135, 'ko', '2015-01-05 12:54:58'),
(136, 'admin', '2015-01-05 16:45:34'),
(137, 'ko', '2015-01-06 00:08:53'),
(138, 'ko', '2015-01-06 02:48:24'),
(139, 'ko', '2015-01-06 14:16:46'),
(140, 'ko', '2015-01-07 01:09:04'),
(141, 'ko', '2015-08-02 05:09:12'),
(142, 'ko', '2015-08-02 05:09:22'),
(143, 'ko', '2015-08-02 13:52:54'),
(144, 'ko', '2015-09-18 18:26:24'),
(145, 'ko', '2015-09-18 18:28:13'),
(146, 'admin', '2015-01-07 22:11:30'),
(147, 'ko', '2015-01-08 03:14:55'),
(148, 'admin', '2015-01-08 03:47:13'),
(149, 'ko', '2015-01-08 03:47:55'),
(150, 'ko', '2015-01-08 04:51:35'),
(151, 'ko', '2015-01-08 12:37:22'),
(152, 'admin', '2015-01-08 12:38:05'),
(153, 'ko', '2015-01-14 02:06:13'),
(154, 'ko', '2015-01-14 02:06:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
