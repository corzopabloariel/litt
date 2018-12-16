-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-04-2018 a las 08:19:12
-- Versión del servidor: 5.5.59-0+deb8u1
-- Versión de PHP: 5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `litt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_comercio`
--

CREATE TABLE IF NOT EXISTS `categoria_comercio` (
`id` int(11) NOT NULL,
  `designacion` text NOT NULL,
  `porcentaje` float NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria_comercio`
--

INSERT INTO `categoria_comercio` (`id`, `designacion`, `porcentaje`, `descripcion`) VALUES
(1, 'Excelente', 2, 'Porcentaje de incobrables menor al 2%'),
(2, 'Buena', 6, 'Porcentaje de incobrables entre el 2% y el 6%'),
(3, 'Normal', 10, 'Porcentaje de incobrables entre el 6% y el 10%'),
(4, 'Mala', 14, 'Porcentaje de incobrables entre el 10% y el 14%'),
(5, 'Muy Mala', 17, 'Porcentaje de incobrables entre el 14% y el 17%'),
(6, 'Alerta Fraude', 18, 'Porcentaje de incobrables mayor al 18%, potencial fraude');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
`id` int(11) NOT NULL,
  `autofecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nombre` text,
  `apellido` text,
  `dni` int(11) NOT NULL,
  `fecha_nacimiento` text,
  `telefono_fijo` text,
  `telefono_celular` text,
  `mail` text,
  `domicilio_calle` text,
  `domicilio_altura` int(11) DEFAULT NULL,
  `domicilio_piso` text,
  `domicilio_depto` text,
  `domicilio_barrio` text,
  `domicilio_manzana` text,
  `domicilio_cpa` text,
  `domicilio_localidad` text,
  `domicilio_provincia` text,
  `referido_nombre` text,
  `referido_telefono_fijo` text,
  `referido_telefono_celular` text,
  `referido_parentesco` text,
  `empleo_empresa` text,
  `empleo_telefono` text,
  `empleo_sueldo` text,
  `empleo_calle` text,
  `empleo_altura` int(11) DEFAULT NULL,
  `empleo_piso` text,
  `empleo_depto` text,
  `empleo_barrio` text,
  `empleo_manzana` text,
  `empleo_cpa` text,
  `empleo_localidad` text,
  `empleo_provincia` text,
  `credito_vigente` text,
  `observaciones` text,
  `comercio_credito` int(11) NOT NULL,
  `estado_mora` int(11) NOT NULL,
  `atraso_historico` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `autofecha`, `nombre`, `apellido`, `dni`, `fecha_nacimiento`, `telefono_fijo`, `telefono_celular`, `mail`, `domicilio_calle`, `domicilio_altura`, `domicilio_piso`, `domicilio_depto`, `domicilio_barrio`, `domicilio_manzana`, `domicilio_cpa`, `domicilio_localidad`, `domicilio_provincia`, `referido_nombre`, `referido_telefono_fijo`, `referido_telefono_celular`, `referido_parentesco`, `empleo_empresa`, `empleo_telefono`, `empleo_sueldo`, `empleo_calle`, `empleo_altura`, `empleo_piso`, `empleo_depto`, `empleo_barrio`, `empleo_manzana`, `empleo_cpa`, `empleo_localidad`, `empleo_provincia`, `credito_vigente`, `observaciones`, `comercio_credito`, `estado_mora`, `atraso_historico`) VALUES
(1, '0000-00-00 00:00:00', 'JONSON', 'MARCOS', 33096420, '08/06/1987', '11111111', '2222222', 'CORZO.PABLOARIEL@GMAIL.COM', 'CALLE 105', 465, '1', '1', 'SAN CARLOS', 'A', '1884', 'BERAZATEGUI (BERAZATEGUI)', 'BUENOS AIRES', 'JUAN PEDRAZA', '333333', '4444444', 'PRIMO', 'YPF', '555555', '20500', 'CALLE 105', 400, '3', 'A', 'SAN CARLOS', 'B', '1884', 'BERAZATEGUI (BERAZATEGUI)', 'BUENOS AIRES', '1', '', 0, 3, 0),
(2, '0000-00-00 00:00:00', 'juan', 'perez', 22222222, '17/03/2000', '', '', '', '', NULL, '', '', '', '', '', '', 'Buenos Aires', '', '', '', '', '', '', '', '', NULL, '', NULL, NULL, NULL, '', '', 'Buenos Aires', '1', '', 0, 2, 0),
(3, '0000-00-00 00:00:00', 'julian', 'bongiorno', 39558133, '07/03/1996', '46993529', '0111558866409', 'julia@', 'dorrego ', NULL, '', '', '', '', '1752', 'Lomas del Mirador (Matanza)', 'Buenos Aires', 'alejandro bongiorno', '46993562', '1150030026', 'padre', 'nadia', '46554178', '15000', 'charcas ', NULL, '', NULL, NULL, NULL, '1752', 'Lomas del Mirador (Matanza)', 'Buenos Aires', '1', '', 0, 2, 0),
(6, '0000-00-00 00:00:00', 'Juancho', 'Perez', 33333333, '23/11/1980', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(7, '0000-00-00 00:00:00', 'lucas', 'gauna', 32720619, '09/03/1982', NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(8, '0000-00-00 00:00:00', 'PABLO', 'CORZO', 34275214, '03/12/1988', '1120828637', '1523885512', 'CORZO.PABLOARIEL@GMAIL.COM', '', 0, '', '', '', '', '', '', 'Buenos Aires', '', '111111', '2222', 'ALGO', 'VASO', '5555', '5555', '', 0, '', '', '', '', '', '', 'Buenos Aires', '1', '', 0, 2, 0),
(9, '0000-00-00 00:00:00', 'ADA QUILLEN', 'SCONZA', 37033833, '14/05/1994', '', '2226480292', 'ADISCONZA@GMAIL.COM', 'JUAN PABLO II', 69, '', '', 'MONTE', '', '7220', 'SAN MIGUEL DEL MONTE (MONTE)', 'BUENOS AIRES', 'MARIANA KORENA SCONZA', '', '2226540535', 'MADRE', 'NADIA', '2217000000', '10000', 'ALEM', 464, '', '', '', '', '7220', 'SAN MIGUEL DEL MONTE (MONTE)', 'BUENOS AIRES', '1', '', 0, 2, 0),
(10, '0000-00-00 00:00:00', 'JULIANA', 'MORENO', 41123964, '25/04/1996', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(11, '0000-00-00 00:00:00', 'JULIANA', 'MORENO', 41132964, '16/04/1996', '', '', 'JU@HOTMAIL.COM', 'LOPEZ', 900, '0', '0', '0', '0', '7220', 'SAN MIGUEL DEL MONTE (MONTE)', 'BUENOS AIRES', 'ADA SCONZA', '4444444', '00000000', 'AAAA', 'CAAAAAA', '4444444', '6200', 'ROJAS', 500, '0', '0', '0', '0', '7220', 'SAN MIGUEL DEL MONTE (MONTE)', 'BUENOS AIRES', '1', '', 0, 2, 0),
(12, '0000-00-00 00:00:00', 'PAULA', 'ACUñA', 13447577, '01/11/1959', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(13, '0000-00-00 00:00:00', 'CHRISTIAN', 'SOLANO', 33446852, '23/11/1987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(14, '0000-00-00 00:00:00', 'MARIANA', 'SCONZA', 23657897, '21/02/1974', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0),
(15, '2018-04-11 01:31:59', 'MARZO', 'PEREZ', 14242589, '02/12/1960', '1120205544', '1123888899', 'PEREZ@GMAIL.COM', '', 0, '', '', '', '', '', '', 'Buenos Aires', 'MARCOS', '11111111111', '2222222222', 'ALGO', 'EMPRESA', '33333333', '3333333', '', 0, '', '', '', '', '', '', 'Buenos Aires', '1', '', 0, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercios`
--

CREATE TABLE IF NOT EXISTS `comercios` (
`id` int(11) unsigned NOT NULL,
  `cuit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razon_social` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dni_titular` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_titular` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_fijo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono_celular` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_comercio` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comercio_provincia` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_real_calle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_real_altura` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_real_observacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_real_cpa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_real_provincia` tinyint(3) unsigned DEFAULT NULL,
  `domicilio_real_localidad` int(10) unsigned DEFAULT NULL,
  `rubro` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `convenio` int(191) DEFAULT NULL,
  `estado` tinyint(4) NOT NULL,
  `fecha_alta` int(11) NOT NULL,
  `habilitado` tinyint(4) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `domicilio_comercio_calle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_comercio_altura` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_comercio_observacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_comercio_cpa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_comercio_provincia` tinyint(1) unsigned DEFAULT NULL,
  `domicilio_comercio_localidad` int(11) unsigned DEFAULT NULL,
  `domicilio_legal_calle` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_legal_altura` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_legal_observacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_legal_cpa` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domicilio_legal_provincia` tinyint(1) unsigned DEFAULT NULL,
  `domicilio_legal_localidad` int(11) unsigned DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comercios`
--

INSERT INTO `comercios` (`id`, `cuit`, `razon_social`, `dni_titular`, `nombre_titular`, `mail`, `telefono_fijo`, `telefono_celular`, `domicilio_comercio`, `comercio_provincia`, `domicilio_real_calle`, `domicilio_real_altura`, `domicilio_real_observacion`, `domicilio_real_cpa`, `domicilio_real_provincia`, `domicilio_real_localidad`, `rubro`, `convenio`, `estado`, `fecha_alta`, `habilitado`, `id_categoria`, `domicilio_comercio_calle`, `domicilio_comercio_altura`, `domicilio_comercio_observacion`, `domicilio_comercio_cpa`, `domicilio_comercio_provincia`, `domicilio_comercio_localidad`, `domicilio_legal_calle`, `domicilio_legal_altura`, `domicilio_legal_observacion`, `domicilio_legal_cpa`, `domicilio_legal_provincia`, `domicilio_legal_localidad`, `nombre`, `observacion`) VALUES
(1, '20349051347', 'BONGIORNO FEDERICO JAVIER', '34905134', 'FEDERICO BONGIORNO', 'FEDERICO@CALZADOSNADIA.COM.AR', '01146993529', '1150030023', NULL, NULL, 'CHARCAS', '3625', '', '1752', 1, 1634, '19', 2, 0, 20180317, 1, 1, 'ALEM', '464', '', '7220', 1, 1634, 'CHARCAS', '3625', '', '1752', 1, 1634, 'NADIA BUENOS AIRES', ''),
(2, '20342752145', 'PRUEBA SA', '34275214', 'PABLO CORZO', 'CORZO.PABLOARIEL@GMAIL.COM', '11111111', '2222222', NULL, NULL, 'AV. DARDO ROCHA', '468', '', '1884', 1, 131, '2', 1, 1, 20180317, 1, 1, 'AV. DARDO ROCHA', '465', '', '1884', 1, 131, 'AV. DARDO ROCHA', '568', '', '1884', 1, 131, 'SUPER PRUEBA', ''),
(3, '20327206193', 'LUCAS SA', '32720619', 'LUCAS', 'lucas.damian.gauna@gmail.com', '1111', '2222', NULL, NULL, 'CALLE', '123', '', '123', 1, 1, '7', 1, 1, 20180326, 1, 1, 'CALLE ', '1234', '', '123', 1, 1, 'CALKE', '1234', '', '123', 1, 1, 'LUCAS FANTASIA', ''),
(4, '30707874259', 'DECREDITOS SA', '30707874259', 'CHRISTIAN SOLANO', 'christianarielsolano@gmail.com', '45249559', '1563762219', NULL, NULL, 'AV DE LOS INCAS', '5150', '', '1431', 1, 1, '18', 2, 1, 20180404, 1, 1, 'AV DE LOS INCAS', '5150', '', '1431', 1, 1634, 'AV DE LOS INCAS', '5150', '', '1431', 1, 1, 'DECREDITOS SA', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

CREATE TABLE IF NOT EXISTS `configuraciones` (
`id` int(11) NOT NULL,
  `variable` text NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `valor` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuraciones`
--

INSERT INTO `configuraciones` (`id`, `variable`, `nombre`, `valor`) VALUES
(1, 'score_veraz_minimo', 'Veraz Mínimo', '500'),
(2, 'dias_gracia', 'Días de Gracia', '3'),
(3, 'gastos_otorgamiento', 'Gastos de Otorgamiento', '20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenios`
--

CREATE TABLE IF NOT EXISTS `convenios` (
`id` int(11) NOT NULL,
  `comision` double NOT NULL,
  `nombre` text NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `convenios`
--

INSERT INTO `convenios` (`id`, `comision`, `nombre`, `id_grupo`) VALUES
(1, 5, 'CONVENIO PRUEBA', 0),
(2, 4, 'MICROCREDITOS REGULAR', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `convenios_grupos_habilitados`
--

CREATE TABLE IF NOT EXISTS `convenios_grupos_habilitados` (
`id` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `convenios_grupos_habilitados`
--

INSERT INTO `convenios_grupos_habilitados` (`id`, `id_convenio`, `id_grupo`) VALUES
(1, 1, 3),
(2, 2, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credito_instancia`
--

CREATE TABLE IF NOT EXISTS `credito_instancia` (
`id` int(11) NOT NULL,
  `autofecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dni_cliente` text NOT NULL,
  `id_plan` text NOT NULL,
  `producto_designacion` text NOT NULL,
  `monto` text NOT NULL,
  `cuotas` int(11) NOT NULL,
  `liquidado_litt` tinyint(11) NOT NULL,
  `rendida` int(11) NOT NULL,
  `fecha_creacion` varchar(12) NOT NULL,
  `estado_mora` int(11) NOT NULL,
  `id_comercio` int(11) NOT NULL,
  `estado_liquidacion` int(11) NOT NULL,
  `fecha_liquidacion` int(11) unsigned DEFAULT NULL,
  `id_rendicion` int(11) unsigned DEFAULT NULL,
  `score` int(11) unsigned DEFAULT NULL,
  `gasto_otorgamiento` int(1) NOT NULL DEFAULT '0' COMMENT '1: GO generado'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `credito_instancia`
--

INSERT INTO `credito_instancia` (`id`, `autofecha`, `dni_cliente`, `id_plan`, `producto_designacion`, `monto`, `cuotas`, `liquidado_litt`, `rendida`, `fecha_creacion`, `estado_mora`, `id_comercio`, `estado_liquidacion`, `fecha_liquidacion`, `id_rendicion`, `score`, `gasto_otorgamiento`) VALUES
(1, '0000-00-00 00:00:00', '33096420', '1', 'mesa', '5000', 2, 1, 1, '201803171123', 2, 2, 1, 20180317, 1, 800, 0),
(2, '0000-00-00 00:00:00', '22222222', '1', '', '1000', 2, 0, 0, '201803171217', 2, 1, 0, NULL, NULL, 700, 0),
(3, '0000-00-00 00:00:00', '33096420', '1', 'zapato', '2000', 6, 0, 0, '201803171429', 2, 2, 0, NULL, NULL, 500, 0),
(4, '0000-00-00 00:00:00', '33096420', '1', 'Algo', '5000', 2, 0, 0, '201803191403', 2, 2, 0, NULL, NULL, 600, 0),
(5, '0000-00-00 00:00:00', '39558133', '2', 'gorra', '1680', 2, 0, 0, '201803192212', 2, 1, 0, NULL, NULL, 600, 0),
(6, '0000-00-00 00:00:00', '33096420', '1', 'cosa', '4000', 3, 0, 0, '201803201407', 2, 2, 0, NULL, NULL, 600, 0),
(7, '0000-00-00 00:00:00', '33096420', '1', 'mesa', '5000', 3, 0, 0, '201803201726', 2, 2, 0, NULL, NULL, 600, 0),
(8, '0000-00-00 00:00:00', '33096420', '1', 'Mesa', '5000', 6, 0, 0, '201803202106', 2, 2, 0, NULL, NULL, 600, 0),
(9, '0000-00-00 00:00:00', '34275214', '1', 'vaso', '5000', 3, 0, 0, '201803262127', 2, 2, 0, NULL, NULL, 600, 0),
(10, '0000-00-00 00:00:00', '33096420', '1', 'tenedor', '5000', 3, 0, 0, '201803262132', 2, 2, 0, NULL, NULL, 500, 0),
(11, '0000-00-00 00:00:00', '37033833', '1', 'campera ', '1500', 4, 0, 0, '201804041031', 2, 1, 0, NULL, NULL, 500, 0),
(12, '0000-00-00 00:00:00', '41132964', '1', 'campera', '3000', 4, 0, 0, '201804060846', 2, 1, 0, NULL, NULL, 500, 0),
(13, '0000-00-00 00:00:00', '33096420', '1', 'frazada', '5000', 3, 0, 0, '201804101001', 2, 2, 0, NULL, NULL, 600, 0),
(14, '0000-00-00 00:00:00', '33096420', '1', 'zapatillas', '5000', 3, 0, 0, '201804101842', 2, 2, 0, NULL, NULL, 600, 0),
(15, '0000-00-00 00:00:00', '33096420', '1', 'libros', '5000', 3, 0, 0, '201804101917', 2, 2, 0, NULL, NULL, 600, 0),
(16, '0000-00-00 00:00:00', '33096420', '1', 'silla', '5000', 3, 0, 0, '201804101948', 2, 2, 0, NULL, NULL, 600, 0),
(17, '0000-00-00 00:00:00', '33096420', '1', 'zapatilla', '5000', 3, 0, 0, '201804101950', 2, 2, 0, NULL, NULL, 600, 0),
(18, '0000-00-00 00:00:00', '33096420', '1', 'almohadas', '5000', 3, 0, 0, '201804102105', 2, 2, 0, NULL, NULL, 600, 0),
(19, '2018-04-11 01:19:30', '33096420', '1', 'libros', '2000', 3, 0, 0, '201804102119', 3, 2, 0, NULL, NULL, 600, 0),
(20, '2018-04-11 01:21:12', '33096420', '1', 'colcha', '2000', 3, 0, 0, '201804102121', 2, 2, 0, NULL, NULL, 600, 1),
(21, '2018-04-11 01:42:38', '14242589', '1', 'reloj', '2000', 3, 0, 0, '201804102142', 2, 2, 0, NULL, NULL, 600, 0),
(22, '2018-04-11 01:52:09', '14242589', '1', 'reloj', '2500', 3, 0, 0, '201804102152', 2, 2, 0, NULL, NULL, 650, 1),
(23, '2018-04-11 02:01:16', '14242589', '1', 'mueble', '2000', 3, 0, 0, '201804102201', 2, 2, 0, NULL, NULL, 600, 1),
(24, '2018-04-11 02:03:02', '14242589', '1', 'cosa', '2000', 3, 0, 0, '201804102203', 2, 2, 0, NULL, NULL, 600, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuotas`
--

CREATE TABLE IF NOT EXISTS `cuotas` (
`id` int(11) NOT NULL,
  `id_credito` int(11) NOT NULL,
  `n_cuota` int(11) NOT NULL,
  `cuota_original` float NOT NULL,
  `punitorios` float NOT NULL,
  `vencimiento` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `dni_cliente` text NOT NULL,
  `n_operacion` int(11) NOT NULL,
  `abonado` int(11) NOT NULL,
  `rendida` int(11) NOT NULL,
  `id_rendicion` int(11) NOT NULL,
  `fecha_depago` int(11) NOT NULL,
  `estado_mora` int(11) NOT NULL,
  `id_comercio` int(11) unsigned DEFAULT NULL,
  `id_recibo` int(10) unsigned NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL,
  `interes` double DEFAULT NULL,
  `capital` double DEFAULT NULL,
  `resto` double DEFAULT NULL,
  `tem` double DEFAULT NULL,
  `tna` double DEFAULT NULL,
  `compensatorios` double DEFAULT NULL,
  `multa` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuotas`
--

INSERT INTO `cuotas` (`id`, `id_credito`, `n_cuota`, `cuota_original`, `punitorios`, `vencimiento`, `estado`, `dni_cliente`, `n_operacion`, `abonado`, `rendida`, `id_rendicion`, `fecha_depago`, `estado_mora`, `id_comercio`, `id_recibo`, `score`, `interes`, `capital`, `resto`, `tem`, `tna`, `compensatorios`, `multa`) VALUES
(1, 1, 1, 2904.28, 0, 20180417, 0, '33096420', 0, 1, 1, 3, 20180317, 2, 2, 2, 0, 530.14, 2374.14, 2625.86, 10.6, 129, 0, 0),
(2, 1, 2, 2904.28, 0, 20180517, 0, '33096420', 0, 1, 1, 3, 20180317, 2, 2, 2, 0, 278.41, 2625.87, -0.01, 10.6, 129, 0, 0),
(3, 2, 1, 580.855, 0, 20180417, 0, '22222222', 0, 1, 1, 2, 20180317, 2, 1, 1, 0, 106.03, 474.83, 525.17, 10.6, 129, 0, 0),
(4, 2, 2, 580.855, 0, 20180517, 0, '22222222', 0, 0, 0, 0, 0, 2, 1, 0, 0, 55.68, 525.18, -0.01, 10.6, 129, 0, 0),
(5, 3, 1, 467.356, 0, 20180417, 0, '33096420', 0, 1, 1, 3, 20180318, 2, 2, 3, 0, 212.05, 255.31, 1744.69, 10.6, 129, 0, 0),
(6, 3, 2, 467.356, 0, 20180517, 0, '33096420', 0, 1, 1, 3, 20180318, 2, 2, 3, 0, 184.98, 282.38, 1462.31, 10.6, 129, 0, 0),
(7, 3, 3, 467.356, 0, 20180617, 0, '33096420', 0, 1, 1, 3, 20180318, 2, 2, 3, 0, 155.04, 312.32, 1149.99, 10.6, 129, 0, 0),
(8, 3, 4, 467.356, 0, 20180717, 0, '33096420', 0, 1, 1, 3, 20180318, 2, 2, 3, 0, 121.93, 345.43, 804.56, 10.6, 129, 0, 0),
(9, 3, 5, 467.356, 0, 20180817, 0, '33096420', 0, 1, 1, 3, 20180318, 2, 2, 3, 0, 85.31, 382.05, 422.51, 10.6, 129, 0, 0),
(10, 3, 6, 467.356, 0, 20180917, 0, '33096420', 0, 1, 1, 3, 20180318, 2, 2, 3, 0, 44.8, 422.56, -0.05, 10.6, 129, 0, 0),
(11, 4, 1, 2904.28, 0, 20180419, 0, '33096420', 0, 1, 0, 0, 20180319, 2, 2, 4, 0, 530.14, 2374.14, 2625.86, 10.6, 129, 0, 0),
(12, 4, 2, 2904.28, 0, 20180519, 0, '33096420', 0, 1, 0, 0, 20180319, 2, 2, 0, 0, 278.41, 2625.87, -0.01, 10.6, 129, 0, 0),
(13, 5, 1, 929.018, 0, 20180319, 0, '39558133', 0, 1, 0, 0, 20180319, 2, 1, 8, 0, 117.37, 811.65, 868.35, 6.99, 85, 0, 0),
(14, 5, 2, 929.018, 0, 20180419, 0, '39558133', 0, 1, 0, 0, 20180319, 2, 1, 5, 0, 60.67, 868.35, 0, 6.99, 85, 0, 0),
(15, 6, 1, 1625.55, 0, 20180420, 0, '33096420', 0, 1, 0, 0, 20180320, 2, 2, 9, 0, 424.11, 1201.44, 2798.56, 10.6, 129, 0, 0),
(16, 6, 2, 1625.55, 0, 20180520, 0, '33096420', 0, 1, 0, 0, 20180320, 2, 2, 0, 0, 296.72, 1328.83, 1469.73, 10.6, 129, 0, 0),
(17, 6, 3, 1625.55, 0, 20180620, 0, '33096420', 0, 1, 0, 0, 20180320, 2, 2, 10, 0, 155.83, 1469.72, 0.01, 10.6, 129, 0, 0),
(18, 7, 1, 2031.94, 0, 20180420, 0, '33096420', 0, 1, 0, 0, 20180320, 2, 2, 11, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(19, 7, 2, 2031.94, 0, 20180520, 0, '33096420', 0, 1, 0, 0, 20180326, 2, 2, 12, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(20, 7, 3, 2031.94, 0, 20180620, 0, '33096420', 0, 1, 0, 0, 20180326, 2, 2, 12, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(21, 8, 1, 1168.39, 0, 20180420, 0, '33096420', 0, 1, 0, 0, 20180326, 2, 2, 13, 0, 530.14, 638.25, 4361.75, 10.6, 129, 0, 0),
(22, 8, 2, 1168.39, 0, 20180520, 0, '33096420', 0, 1, 0, 0, 20180326, 2, 2, 13, 0, 462.47, 705.92, 3655.83, 10.6, 129, 0, 0),
(23, 8, 3, 1168.39, 0, 20180620, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 20, 0, 387.62, 780.77, 2875.06, 10.6, 129, 0, 0),
(24, 8, 4, 1168.39, 0, 20180720, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 20, 0, 304.84, 863.55, 2011.51, 10.6, 129, 0, 0),
(25, 8, 5, 1168.39, 0, 20180820, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 20, 0, 213.28, 955.11, 1056.4, 10.6, 129, 0, 0),
(26, 8, 6, 1168.39, 0, 20180920, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 20, 0, 112.01, 1056.38, 0.02, 10.6, 129, 0, 0),
(27, 9, 1, 2031.94, 0, 20180426, 0, '34275214', 0, 1, 0, 0, 20180326, 2, 2, 14, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(28, 9, 2, 2031.94, 0, 20180526, 0, '34275214', 0, 1, 0, 0, 20180405, 2, 2, 16, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(29, 9, 3, 2031.94, 0, 20180626, 0, '34275214', 0, 1, 0, 0, 20180405, 2, 2, 17, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(30, 10, 1, 2031.94, 0, 20180426, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 21, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(31, 10, 2, 2031.94, 0, 20180526, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 21, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(32, 10, 3, 2031.94, 0, 20180626, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 21, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(33, 11, 1, 479.395, 0, 20180504, 0, '37033833', 0, 1, 0, 0, 20180404, 2, 1, 15, 0, 159.04, 320.35, 1179.65, 10.6, 129, 0, 0),
(34, 11, 2, 479.395, 0, 20180604, 0, '37033833', 0, 1, 0, 0, 20180404, 2, 1, 15, 0, 125.08, 354.31, 825.34, 10.6, 129, 0, 0),
(35, 11, 3, 479.395, 0, 20180704, 0, '37033833', 0, 1, 0, 0, 20180404, 2, 1, 15, 0, 87.51, 391.88, 433.46, 10.6, 129, 0, 0),
(36, 11, 4, 479.395, 0, 20180804, 0, '37033833', 0, 1, 0, 0, 20180404, 2, 1, 15, 0, 45.96, 433.43, 0.03, 10.6, 129, 0, 0),
(37, 12, 1, 958.79, 0, 20180506, 0, '41132964', 0, 1, 0, 0, 20180406, 2, 1, 18, 0, 318.08, 640.71, 2359.29, 10.6, 129, 0, 0),
(38, 12, 2, 958.79, 0, 20180606, 0, '41132964', 0, 1, 0, 0, 20180406, 2, 1, 19, 0, 250.15, 708.64, 1650.65, 10.6, 129, 0, 0),
(39, 12, 3, 958.79, 0, 20180706, 0, '41132964', 0, 1, 0, 0, 20180406, 2, 1, 19, 0, 175.01, 783.78, 866.87, 10.6, 129, 0, 0),
(40, 12, 4, 958.79, 0, 20180806, 0, '41132964', 0, 1, 0, 0, 20180406, 2, 1, 19, 0, 91.91, 866.88, -0.01, 10.6, 129, 0, 0),
(41, 13, 1, 2031.94, 0, 20180510, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 22, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(42, 13, 2, 2031.94, 0, 20180610, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 22, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(43, 13, 3, 2031.94, 0, 20180710, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 22, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(44, 14, 1, 2031.94, 0, 20180510, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 23, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(45, 14, 2, 2031.94, 0, 20180610, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 23, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(46, 14, 3, 2031.94, 0, 20180710, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 23, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(47, 15, 1, 2031.94, 0, 20180510, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 23, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(48, 15, 2, 2031.94, 0, 20180610, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 23, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(49, 15, 3, 2031.94, 0, 20180710, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 23, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(50, 16, 1, 2031.94, 0, 20180510, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 26, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(51, 16, 2, 2031.94, 0, 20180610, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 26, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(52, 16, 3, 2031.94, 0, 20180710, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 26, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(53, 17, 1, 2031.94, 0, 20180510, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 26, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(54, 17, 2, 2031.94, 0, 20180610, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 26, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(55, 17, 3, 2031.94, 0, 20180710, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 26, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(56, 18, 1, 2031.94, 0, 20180510, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 28, 0, 530.14, 1501.8, 3498.2, 10.6, 129, 0, 0),
(57, 18, 2, 2031.94, 0, 20180610, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 28, 0, 370.91, 1661.03, 1837.17, 10.6, 129, 0, 0),
(58, 18, 3, 2031.94, 0, 20180710, 0, '33096420', 0, 1, 0, 0, 20180410, 2, 2, 28, 0, 194.79, 1837.15, 0.02, 10.6, 129, 0, 0),
(59, 19, 1, 812.777, 7.18, 20180406, 1, '33096420', 0, 1, 0, 0, 20180410, 3, 2, 34, 0, 212.05, 600.73, 1399.27, 10.6, 129, 14.36, 0),
(60, 19, 2, 812.777, 0, 20180610, 0, '33096420', 0, 0, 0, 0, 0, 2, 2, 0, 0, 148.36, 664.42, 734.85, 10.6, 129, 0, 0),
(61, 19, 3, 812.777, 0, 20180710, 0, '33096420', 0, 0, 0, 0, 0, 2, 2, 0, 0, 77.91, 734.87, -0.02, 10.6, 129, 0, 0),
(62, 20, 1, 812.777, 0, 20180510, 0, '33096420', 0, 0, 0, 0, 0, 2, 2, 0, 0, 212.05, 600.73, 1399.27, 10.6, 129, 0, 0),
(63, 20, 2, 812.777, 0, 20180610, 0, '33096420', 0, 0, 0, 0, 0, 2, 2, 0, 0, 148.36, 664.42, 734.85, 10.6, 129, 0, 0),
(64, 20, 3, 812.777, 0, 20180710, 0, '33096420', 0, 0, 0, 0, 0, 2, 2, 0, 0, 77.91, 734.87, -0.02, 10.6, 129, 0, 0),
(65, 21, 1, 812.777, 0, 20180510, 0, '14242589', 0, 1, 0, 0, 20180410, 2, 2, 31, 0, 212.05, 600.73, 1399.27, 10.6, 129, 0, 0),
(66, 21, 2, 812.777, 0, 20180610, 0, '14242589', 0, 1, 0, 0, 20180410, 2, 2, 31, 0, 148.36, 664.42, 734.85, 10.6, 129, 0, 0),
(67, 21, 3, 812.777, 0, 20180710, 0, '14242589', 0, 1, 0, 0, 20180410, 2, 2, 31, 0, 77.91, 734.87, -0.02, 10.6, 129, 0, 0),
(68, 22, 1, 1015.97, 0, 20180510, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 265.07, 750.9, 1749.1, 10.6, 129, 0, 0),
(69, 22, 2, 1015.97, 0, 20180610, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 185.45, 830.52, 918.58, 10.6, 129, 0, 0),
(70, 22, 3, 1015.97, 0, 20180710, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 97.39, 918.58, 0, 10.6, 129, 0, 0),
(71, 23, 1, 812.777, 0, 20180510, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 212.05, 600.73, 1399.27, 10.6, 129, 0, 0),
(72, 23, 2, 812.777, 0, 20180610, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 148.36, 664.42, 734.85, 10.6, 129, 0, 0),
(73, 23, 3, 812.777, 0, 20180710, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 77.91, 734.87, -0.02, 10.6, 129, 0, 0),
(74, 24, 1, 812.777, 0, 20180510, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 212.05, 600.73, 1399.27, 10.6, 129, 0, 0),
(75, 24, 2, 812.777, 0, 20180610, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 148.36, 664.42, 734.85, 10.6, 129, 0, 0),
(76, 24, 3, 812.777, 0, 20180710, 0, '14242589', 0, 0, 0, 0, 0, 2, 2, 0, 0, 77.91, 734.87, -0.02, 10.6, 129, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entidades`
--

CREATE TABLE IF NOT EXISTS `entidades` (
`id` int(11) unsigned NOT NULL,
  `denominacion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `entidades`
--

INSERT INTO `entidades` (`id`, `denominacion`, `descripcion`) VALUES
(1, 'COMERCIOS', 'TODO ACTIVIDAD RELACIONADA CON COMERCIOS'),
(2, 'ADMINISTRACION', 'TODA ACTIVIDAD RELACIONADA CON LA ADMINISTRACION'),
(3, 'PROVEEDORES', 'SON LOS PROVEEDORES, OBVIAMENTE'),
(4, 'FINANCIERA', 'RELACIONADO CON FINANCIERA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_liquidacion`
--

CREATE TABLE IF NOT EXISTS `estado_liquidacion` (
`id` int(11) NOT NULL,
  `designacion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_liquidacion`
--

INSERT INTO `estado_liquidacion` (`id`, `designacion`) VALUES
(0, 'pendiente liquidacion'),
(1, 'liquidado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_modulo`
--

CREATE TABLE IF NOT EXISTS `estado_modulo` (
`id` int(11) NOT NULL,
  `designacion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_modulo`
--

INSERT INTO `estado_modulo` (`id`, `designacion`) VALUES
(1, 'normal'),
(2, 'mora');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_mora`
--

CREATE TABLE IF NOT EXISTS `estado_mora` (
`id` int(11) NOT NULL,
  `designacion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_mora`
--

INSERT INTO `estado_mora` (`id`, `designacion`) VALUES
(0, 'no asignado'),
(1, 'cancelado'),
(2, 'normal'),
(3, 'premora'),
(4, 'mora'),
(5, 'extrajudicial'),
(6, 'judicial'),
(7, 'incobrable');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
`id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `descripcion`) VALUES
(1, 'grupo A', 'Grupo inicial'),
(2, 'grupo B', 'otro Grupo'),
(3, 'GRUPO DE PRUEBA', ''),
(4, 'GRUPO NUEVO', ''),
(5, 'LUKAS', ''),
(6, 'GRUPO A - MICRO', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidades`
--

CREATE TABLE IF NOT EXISTS `localidades` (
`id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `id_provincia` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1635 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `localidades`
--

INSERT INTO `localidades` (`id`, `nombre`, `id_provincia`) VALUES
(1, '12 de Agosto (Pergamino)', 1),
(2, '12 de Octubre (9 de Julio)', 1),
(3, '16 de Julio (Azul)', 1),
(4, '2 Hermanos (Gral. Pinto)', 1),
(5, '2 Naciones (Lobería)', 1),
(6, 'Abasto (La Plata)', 1),
(7, 'Abbot  (Monte)', 1),
(8, 'Abel (Lincoln)', 1),
(9, 'Abra de la Ventana (Tornquist)', 1),
(10, 'Abra del Hinojo (Saavedra)', 1),
(11, 'Acassuso (San Isidro)', 1),
(12, 'Acevedo (Pergamino)', 1),
(13, 'Achupallas (Alberti)', 1),
(14, 'Acosta,Mariano (Merlo)', 1),
(15, 'Acosta,Pablo (Azul)', 1),
(16, 'Adela (Chascomús)', 1),
(17, 'Adrogué (Almirante Brown)', 1),
(18, 'Agote (Mercedes)', 1),
(19, 'Aguara (Bahía Blanca)', 1),
(20, 'Agustina (Junín)', 1),
(21, 'Alagón (Pehuajó)', 1),
(22, 'Alamos (Guaminí)', 1),
(23, 'Albariños (Pehuajó)', 1),
(24, 'Alberdi (Leandro N. Alem)', 1),
(25, 'Alberti (Alberti)', 1),
(26, 'Aldea Romana (Bahía Blanca)', 1),
(27, 'Alegre (General Paz)', 1),
(28, 'Alem,Leandro N (Leandro N. Alem)', 1),
(29, 'Alférez San Martín (Bahía Blanca)', 1),
(30, 'Alfonso (Pergamino)', 1),
(31, 'Algarrobo (Villarino)', 1),
(32, 'Alianza (San Martín)', 1),
(33, 'Almeyra (Navarro)', 1),
(34, 'Alsina (Baradero)', 1),
(35, 'Altamira (Mercedes)', 1),
(36, 'Altamirano (Coronel Brandsen)', 1),
(37, 'Altavista (Saavedra)', 1),
(38, 'Alte. Brown (Barrio) (Alte. Brown)', 1),
(39, 'Alte. Solier (Coronel Rosales)', 1),
(40, 'Alto Alegre (Alte. Brown)', 1),
(41, 'Altona (Tapalqué)', 1),
(42, 'Altos de Corimayo (Alte. Brown)', 1),
(43, 'Altos de la Ferrere (Matanza)', 1),
(44, 'Altos de Longchamps (Alte. Brown)', 1),
(45, 'Alvarez de Toledo (Saladillo)', 1),
(46, 'Alvarez Jonte (Magdalena)', 1),
(47, 'Alvarez,Eufrasio (Tres de Febrero)', 1),
(48, 'Alvarez,Francisco (Moreno)', 1),
(49, 'Alzaga (Gozález Chavez)', 1),
(50, 'América (Rivadavia)', 1),
(51, 'Amighino (General Pinto)', 1),
(52, 'Anasagasti (Navarro)', 1),
(53, 'Anchorena (San Isidro)', 1),
(54, 'Ancon (Lincoln)', 1),
(55, 'Andant (Caseros)', 1),
(56, 'Anderson (25 de Mayo)', 1),
(57, 'Angelita (General Arenales)', 1),
(58, 'Aparicio (Coronel Dorrego)', 1),
(59, 'Arana (La Plata)', 1),
(60, 'Arano (Adolfo Alsina)', 1),
(61, 'Araujo (25 de Mayo)', 1),
(62, 'Arboledas (Caseros)', 1),
(63, 'Arditi,Julio (Magdalena)', 1),
(64, 'Arenaza (Lincoln)', 1),
(65, 'Arévalo (Lobos)', 1),
(66, 'Argerich (Villarino)', 1),
(67, 'Ariel (Azul)', 1),
(68, 'Arin,Martín (Alte. Brown)', 1),
(69, 'Arrecifes (Bartolome Mitre)', 1),
(70, 'Arribeños (Gral. Arenales)', 1),
(71, 'Arroyo Burgos (Bmé. Mitre)', 1),
(72, 'Arroyo Corto (Saavedra)', 1),
(73, 'Arroyo de la Cruz (Exalt. de la Cruz)', 1),
(74, 'Arroyo del Medio (Pergamino)', 1),
(75, 'Arroyo Dulce (Salto)', 1),
(76, 'Arroyo Venado (Guaminí)', 1),
(77, 'Artalejos (Laprida)', 1),
(78, 'Asamblea (Bragado)', 1),
(79, 'Ascasubi, Hilario (Villarino)', 1),
(80, 'Ascensión (Gral. Arenales)', 1),
(81, 'Asturias (Pehuajó)', 1),
(82, 'Atalaya (Magdalena)', 1),
(83, 'Atalaya (Barrio Parque) (San Isidro)', 1),
(84, 'Atucha (Zárate)', 1),
(85, 'Atucha,Juan (Roque Pérez)', 1),
(86, 'Avellaneda (Avellaneda)', 1),
(87, 'Avestruz (Adolfo Alsina)', 1),
(88, 'Ayacucho (Ayacucho)', 1),
(89, 'Ayerza (Barrio Parque) (Morón)', 1),
(90, 'Ayerza,Francisco (Pergamino)', 1),
(91, 'Azcuénaga (San Antonio de Giles)', 1),
(92, 'Azopardo (Puán)', 1),
(93, 'Azucena (Tandil)', 1),
(94, 'Azul (Azul)', 1),
(95, 'Bacacay (9 de Julio)', 1),
(96, 'Badano (Rivadavia)', 1),
(97, 'Báez,Román (Suipacha)', 1),
(98, 'Bahía Blanca (Bahía Blanca)', 1),
(99, 'Bahía San Blas (Patagones)', 1),
(100, 'Baigorrita (Gral. Viamonte)', 1),
(101, 'Bajo Hondo (Coronel Rosales)', 1),
(102, 'Balcarce (Balcarce)', 1),
(103, 'Balneario (Vicente López)', 1),
(104, 'Balneario Reta (3 Arroyos)', 1),
(105, 'Balsa (Lincoln)', 1),
(106, 'Bancalari (San Fernando)', 1),
(107, 'Bancalari (Tigre)', 1),
(108, 'Bandelaró (Gral. Villegas)', 1),
(109, 'Banfield (Lomas de Zamora)', 1),
(110, 'Baradero (Baradero)', 1),
(111, 'Barcker (Juárez)', 1),
(112, 'Barra,Juan E. (González Chaves)', 1),
(113, 'Barrancosa (Saladillo)', 1),
(114, 'Barrio Nuevo (Merlo)', 1),
(115, 'Barrio Obrero Ferroviario (Merlo)', 1),
(116, 'Barrow (3 Arroyos)', 1),
(117, 'Bathurs (Coronel Suárez)', 1),
(118, 'Baudrix (Alberdi)', 1),
(119, 'Bavio,Bartolomé (Magdalena)', 1),
(120, 'Bayauca (Lincoln)', 1),
(121, 'Beccar (San Isidro)', 1),
(122, 'Beguerie,Carlos (Roque Pérez)', 1),
(123, 'Belén de Escobar (Escobar)', 1),
(124, 'Bell,Henry (Chivilcoy)', 1),
(125, 'Bellavista (Bahía Blanca)', 1),
(126, 'Bellavista (San Miguel)', 1),
(127, 'Bellocq (Carlos Tejedor)', 1),
(128, 'Benavidez (Tigre)', 1),
(129, 'Benítez (Chivilcoy)', 1),
(130, 'Benítez,Mariano (Pergamino)', 1),
(131, 'Berazategui (Berazategui)', 1),
(132, 'Berdier (Salto)', 1),
(133, 'Berisso (Berisso)', 1),
(134, 'Bermúdez (Lincoln)', 1),
(135, 'Bernal (Quilmes)', 1),
(136, 'Berra,Francisco (Monte)', 1),
(137, 'Berraondo (Tornquist)', 1),
(138, 'Berraondo,Martín (25 de Mayo)', 1),
(139, 'Beruti (Trenque Lauquen)', 1),
(140, 'Biaus,Ramón (Chivilcoy)', 1),
(141, 'Blanca Grande (Olavarría)', 1),
(142, 'Blandengues (Junín)', 1),
(143, 'Blaquier (Gral Pinto)', 1),
(144, 'Blaquier,Juan J (Saladillo)', 1),
(145, 'Boca Carabelas (San Fernando)', 1),
(146, 'Bocayuva (Pellegrini)', 1),
(147, 'Bolívar (Bolívar)', 1),
(148, 'Bonifacio (Guaminí)', 1),
(149, 'Bonnement (Gral. Belgrano)', 1),
(150, 'Bonzi,Aldo (La Matanza)', 1),
(151, 'Boquerón (Gral. Pueyrredón)', 1),
(152, 'Bordeau (Bahía Blanca)', 1),
(153, 'Bordenave (Puán)', 1),
(154, 'Borges (Vicente López)', 1),
(155, 'Bosch (Balcarce)', 1),
(156, 'Bosques (Florencio Varela)', 1),
(157, 'Boulogne (San Isidro)', 1),
(158, 'Bragado (Bragado)', 1),
(159, 'Buchanan (La Plata)', 1),
(160, 'Bullrich (Avellaneda)', 1),
(161, 'Bunge, Emilio B. (Gral. Villegas)', 1),
(162, 'Burzaco (Almirante Brown)', 1),
(163, 'Cabildo (Bahía Blanca)', 1),
(164, 'Cacharí (Azul)', 1),
(165, 'Cadret (Carlos Casares)', 1),
(166, 'Calderón (Bahía Blanca)', 1),
(167, 'Calfucurá (Mar Chiquita)', 1),
(168, 'Calomuta (Salliqueló)', 1),
(169, 'Calvo (Cnel. Dorrego)', 1),
(170, 'Cambaceres (Ensenada)', 1),
(171, 'Cambaceres (9 de Julio)', 1),
(172, 'Camet (Gral. Pueyrredón)', 1),
(173, 'Campana (Campana)', 1),
(174, 'Campo Requena (Tapalqué)', 1),
(175, 'Campo Salles (San Nicolás)', 1),
(176, 'Campodónico (Azul)', 1),
(177, 'Canal San Fernando (Tigre)', 1),
(178, 'Cangallo (Ayacucho)', 1),
(179, 'Canning (Esteban Echeverría)', 1),
(180, 'Cano, Roberto (Rojas)', 1),
(181, 'Cañada Mariano (Adolfo Alsina)', 1),
(182, 'Cañada Seca (Gral. Villegas)', 1),
(183, 'Cañuelas (Cañuelas)', 1),
(184, 'Capdepont (Suipacha)', 1),
(185, 'Capilla del Señor (Exaltación de la Cruz)', 1),
(186, 'Capitán Castro (Pehuajó)', 1),
(187, 'Capitán Sarmiento (Capitán Sarmiento)', 1),
(188, 'Carabelas (Rojas)', 1),
(189, 'Carapachay (Vicente López)', 1),
(190, 'Caraza (Lanús)', 1),
(191, 'Carboni (Lobos)', 1),
(192, 'Cardenal Cagliero (Patagones)', 1),
(193, 'Carhué (Adolfo Alsina)', 1),
(194, 'Carmen de Areco (Carmen de Areco)', 1),
(195, 'Carupá (San Fernando)', 1),
(196, 'Casalins (Pila)', 1),
(197, 'Casanovas, Isidro (Matanza)', 1),
(198, 'Casares, Carlos (Carlos Casares)', 1),
(199, 'Casares, Vicente (Cañuelas)', 1),
(200, 'Casas, José B. (Patagones)', 1),
(201, 'Casbas (Guaminí)', 1),
(202, 'Cascadas (Cnel. Suárez)', 1),
(203, 'Cascallares (Tres Arroyos)', 1),
(204, 'Caseros (Tres de Febrero)', 1),
(205, 'Casey (Guaminí)', 1),
(206, 'Castelar (Morón)', 1),
(207, 'Castelli (Castelli)', 1),
(208, 'Castilla (Chacabuco)', 1),
(209, 'Castillo, Rafael (Matanza)', 1),
(210, 'Cazón (Saladillo)', 1),
(211, 'Centenario (San Martín)', 1),
(212, 'Centenario (Carlos Casares)', 1),
(213, 'Centenario (Barrio) (Pergamino)', 1),
(214, 'Centro Guerrero (Castelli)', 1),
(215, 'Cerrito (Rivadavia)', 1),
(216, 'Cerro Leones (Tandil)', 1),
(217, 'Cerro Sotuyo (Olavarría)', 1),
(218, 'Cetrángolo, Doctor (Vicente López)', 1),
(219, 'Chacabuco (Chacabuco)', 1),
(220, 'Chacras (Lobos)', 1),
(221, 'Chancay (Gral. Viamonte)', 1),
(222, 'Chapadmalal (Gral. Pueyrredón)', 1),
(223, 'Chapaleofú (Rauch)', 1),
(224, 'Chapar (Gozález Chaves)', 1),
(225, 'Chas (Gral. Belgrano)', 1),
(226, 'Chascomús (Chascomús)', 1),
(227, 'Chasico (Tornquist)', 1),
(228, 'Chenaut (Exaltación de la Cruz)', 1),
(229, 'Chiclana (Pehuajó)', 1),
(230, 'Chilavert (San Martín)', 1),
(231, 'Chiliar (Azul)', 1),
(232, 'Chivilcoy (Chivilcoy)', 1),
(233, 'Choique (Tornquist)', 1),
(234, 'Circunvalación (La Plata)', 1),
(235, 'City Bell (La Plata)', 1),
(236, 'Ciudad Jardín El Libertador (San Martín)', 1),
(237, 'Ciudadela (Tres de Febrero)', 1),
(238, 'Claraz (Necochea)', 1),
(239, 'Claromecó (Tres Arroyos)', 1),
(240, 'Claypeló (Almirante Brown)', 1),
(241, 'Cobo (Mar Chiquita)', 1),
(242, 'Cobos, J. M. (Chascomús)', 1),
(243, 'Cockrane (Bahía Blanca)', 1),
(244, 'Coliqueo (Chacabuco)', 1),
(245, 'Colman (Rauch)', 1),
(246, 'Colón (Colón)', 1),
(247, 'Colonia Agrícola La Capilla (Florencio Varela)', 1),
(248, 'Colonia Agrícola Sarandí (Avellaneda)', 1),
(249, 'Colonia Alberti (Leandro N. Alem)', 1),
(250, 'Colonia Cagliero (Patagones)', 1),
(251, 'Colonia Casas (Patagones)', 1),
(252, 'Colonia Fortín Esperanza (Gral. Alvear)', 1),
(253, 'Colonia La Graciela (Patagones)', 1),
(254, 'Colonia Mauricio (Carlos Casares)', 1),
(255, 'Colonia Nieves (Olavarría)', 1),
(256, 'Colonia Nº 1 (Coronel Suárez)', 1),
(257, 'Colonia Nº 2 (Coronel Suárez)', 1),
(258, 'Colonia Nº 3 (Coronel Suárez)', 1),
(259, 'Colonia Nueva (Berisso)', 1),
(260, 'Colonia Presidente Rivadavia  (San Cayetano)', 1),
(261, 'Colonia San Miguel (Olavarría)', 1),
(262, 'Colonia San Pedro (Saavedra)', 1),
(263, 'Colonia Santa Mariana (Adolfo Alsina)', 1),
(264, 'Colonia Seré (Carlos Tejedor)', 1),
(265, 'Colonia Suiza (Baradero)', 1),
(266, 'Colonia Turca (Tigre)', 1),
(267, 'Colonia Velaz (San Pedro)', 1),
(268, 'Comodoro Py (Bragado)', 1),
(269, 'Condarco (Rivadavia)', 1),
(270, 'Conesa (San Nicolás)', 1),
(271, 'Copetonas (Tres Arroyos)', 1),
(272, 'Coraceros (Hipólito Yrigoyen)', 1),
(273, 'Corazzi (Trenque Lauquen)', 1),
(274, 'Corbett (9 de Julio)', 1),
(275, 'Corimayo (Barrio Parque) (Almirante Brown)', 1),
(276, 'Coronado, Martín+ (Tres de Febrero)', 1),
(277, 'Coronel Boerr (Las Flores)', 1),
(278, 'Coronel Brandsen (Coronel Brandsen)', 1),
(279, 'Coronel Bunge (Juárez)', 1),
(280, 'Coronel Charlone (Gral. Villegas)', 1),
(281, 'Coronel Dorrego  (Coronel Dorrego)', 1),
(282, 'Coronel Falcón (Coronel Pringles)', 1),
(283, 'Coronel Freyre (Caseros)', 1),
(284, 'Coronel Granada (Gral. Pinto)', 1),
(285, 'Coronel Isleño (Salto)', 1),
(286, 'Coronel Mom (Alberti)', 1),
(287, 'Coronel Pringles (Coronel Pringles)', 1),
(288, 'Coronel Seguí (Alberti)', 1),
(289, 'Coronel Suárez (Coronel Suárez)', 1),
(290, 'Coronel Vidal (Mar Chiquita)', 1),
(291, 'Coronel Zapiola(Barrio) (San Martín)', 1),
(292, 'Correa, Ignacio (La Plata)', 1),
(293, 'Corti,Adela (Bahía Blanca)', 1),
(294, 'Cortinez (Luján)', 1),
(295, 'Costa Brava (Ramallo)', 1),
(296, 'Costa, Eduardo (Gral. Pinto)', 1),
(297, 'Costa, Quirno (Gral. Viamonte)', 1),
(298, 'Covello (Tapalquén)', 1),
(299, 'Cristiano Muerto (San Cayetano)', 1),
(300, 'Crotto (Tapalquén)', 1),
(301, 'Cuatreros (Bahía Blanca)', 1),
(302, 'Cuatro de Noviembre (Rojas)', 1),
(303, 'Cucha Cucha (Chacabuco)', 1),
(304, 'Cuenca (Carlos Tejedor)', 1),
(305, 'Cuidad Evita (Morón)', 1),
(306, 'Curarú (Carlos Tejedor)', 1),
(307, 'Curumalán (Coronel Suárez)', 1),
(308, 'D Orbigny (Coronel Suárez)', 1),
(309, 'Daireaux (Caseros)', 1),
(310, 'Darió Rubén (Parada) (Morón)', 1),
(311, 'Darregueira (Puán)', 1),
(312, 'De Bruyn (Leandro N. Alem)', 1),
(313, 'De Bruyn (Pellegrini)', 1),
(314, 'De Escalada, Remedios (Lanús)', 1),
(315, 'De La Canal (Tandil)', 1),
(316, 'De La Garma (Gonzáles Chaves)', 1),
(317, 'De La Peña, J. A. (Pergamino)', 1),
(318, 'De La Plaza, Victorino (Guaminí)', 1),
(319, 'De La Riestra, Norberto (25 de Mayo)', 1),
(320, 'De Luca, Esteban (Carlos Tejedor)', 1),
(321, 'De Victoria, Francisco (Trenque Lauquen)', 1),
(322, 'Deferrari (San Cayetano)', 1),
(323, 'Del Carril (Saladillo)', 1),
(324, 'Del Valle (25 de Mayo)', 1),
(325, 'Del Valle, Aristóbulo (Vicente López)', 1),
(326, 'del Viso (Pilar)', 1),
(327, 'Delgado (Gral. Arenales)', 1),
(328, 'Delta (Est.) (Tigre)', 1),
(329, 'Dennehey (9 de Julio)', 1),
(330, 'Derqui (Pilar)', 1),
(331, 'Descalzo, Nicolás (Coronel Dorrego)', 1),
(332, 'Desvío Garbarini (25 de Mayo)', 1),
(333, 'Desvío Kilómetro 95 (Gral. Arenales)', 1),
(334, 'Desvío Querandí (Matanza)', 1),
(335, 'Diamante (Lanús)', 1),
(336, 'Dionisia (Gral. Alvarado)', 1),
(337, 'Dique Luján (Tigre)', 1),
(338, 'Dock Central (Ensenada)', 1),
(339, 'Dock Sud (Avellaneda)', 1),
(340, 'Doctor Cetrángolo (Vicente López)', 1),
(341, 'Dolores (Dolores)', 1),
(342, 'Domselaar (San Vicente)', 1),
(343, 'Don Bosco (Quilmes)', 1),
(344, 'Don Cipriano (Chascomús)', 1),
(345, 'Don Luis (Barrio) (Almirante Brown)', 1),
(346, 'Don Torcuato (Tigre)', 1),
(347, 'Drabble (Gral. Villegas)', 1),
(348, 'Drysdale (Carlos Tejedor)', 1),
(349, 'Ducos (Saavedra)', 1),
(350, 'Dudignac (9 de Julio)', 1),
(351, 'Dufaur (Saavedra)', 1),
(352, 'Duggan (San Antonio de Areco)', 1),
(353, 'Duhau (Trenque Lauquen)', 1),
(354, 'Durañona, Blas (25 de Mayo)', 1),
(355, 'Dusaud (Gral. Pinto)', 1),
(356, 'Echeverría (E. Echeverría)', 1),
(357, 'Egaña (Rauch)', 1),
(358, 'El 80 (Dolores)', 1),
(359, 'El Arbolito (Colón)', 1),
(360, 'El Bagual (Zárate)', 1),
(361, 'El Carmen (Barrio) (Berisso)', 1),
(362, 'El Chumbeau (Gral. Alvear)', 1),
(363, 'El Delta (San Fernando)', 1),
(364, 'El Despeñadero (Coronel Pringles)', 1),
(365, 'El Día (Gral. Villegas)', 1),
(366, 'El Dique (Ensenada)', 1),
(367, 'El Divisorio (Coronel Pringles)', 1),
(368, 'El Dorado (Leandro N. Alem)', 1),
(369, 'El Gaucho (Barrio) (Almirante Brown)', 1),
(370, 'El Gavilán (Coronel Pringles)', 1),
(371, 'El Gualicho (Las Flores)', 1),
(372, 'El Jabalí (9 de Julio)', 1),
(373, 'El Lenguaraz (Lobería)', 1),
(374, 'El Mataco (Bragado)', 1),
(375, 'El Matrero (Rauch)', 1),
(376, 'El Ombú (González Chavez)', 1),
(377, 'El Ombú (Barrio) (La Plata)', 1),
(378, 'El Palomar (Morón)', 1),
(379, 'El Paraíso (Ramallo)', 1),
(380, 'El Parche (Gral. Alvear)', 1),
(381, 'El Pato (Berazategui)', 1),
(382, 'El Peligro (La Plata)', 1),
(383, 'El Pensamiento (Coronel Pringles)', 1),
(384, 'El Peregrino (Gral. Pinto)', 1),
(385, 'El Pescado (La Plata)', 1),
(386, 'El Pino (Matanza)', 1),
(387, 'El Porvenir (Bolívar)', 1),
(388, 'El Quemao (Pergamino)', 1),
(389, 'El Recado (Pehuajó)', 1),
(390, 'El Rincón (La Plata)', 1),
(391, 'El Sauce (Tapalqué)', 1),
(392, 'El Sauce (Gral. Guido)', 1),
(393, 'El Sesenta (Dolores)', 1),
(394, 'El Siasgo (Monte)', 1),
(395, 'El Socorro (Pergamino)', 1),
(396, 'El Talar (Estación) (Tigre)', 1),
(397, 'El Talar de Pacheco (Tigre)', 1),
(398, 'El Tatú (Zárate)', 1),
(399, 'El Tejar (9 de Julio)', 1),
(400, 'El Tigre (Chascomús)', 1),
(401, 'El Toro (Las Flores)', 1),
(402, 'El Trébol (Barrio Parque) (Esteban Echeverría)', 1),
(403, 'El Trébol (Barrio) (Almirante Brown)', 1),
(404, 'El Trigo (Las Flores)', 1),
(405, 'El Triunfo (Lincoln)', 1),
(406, 'El Zorro (Coronel Dorrego)', 1),
(407, 'El Zorro (Pila)', 1),
(408, 'Elizalde (La Plata)', 1),
(409, 'Elordi (Gral. Villegas)', 1),
(410, 'Elvira (Lobos)', 1),
(411, 'Emita (Alberti)', 1),
(412, 'Emma (Gral. Alvear)', 1),
(413, 'Empalme F. G. Urquiza (Pilar)', 1),
(414, 'Empalme Lobos (Lobos)', 1),
(415, 'Empalme Magdalena (Magdalena)', 1),
(416, 'Empalme Querandí (Matanza)', 1),
(417, 'Empalme San Vicente (San Vicente)', 1),
(418, 'Encina (Carlos Tejedor)', 1),
(419, 'Energía (San Cayetano)', 1),
(420, 'Ensenada (Ensenada)', 1),
(421, 'Entre Vías (Avellaneda)', 1),
(422, 'Epecuén (Adolfo Alsina)', 1),
(423, 'Erezcano (San Nicolás)', 1),
(424, 'Erize (Puán)', 1),
(425, 'Ernestina (25 de Mayo)', 1),
(426, 'Escalada (Zárate)', 1),
(427, 'Escobar, Belén de (Escobar)', 1),
(428, 'Escribano (Chascomús)', 1),
(429, 'Espartillar (Saavedra)', 1),
(430, 'Esperanza (Matanza)', 1),
(431, 'Espigas (Olavarría)', 1),
(432, 'Espora (San Andrés de Giles)', 1),
(433, 'Esquina Berdiñas (Azul)', 1),
(434, 'Esquina Negra (La Plata)', 1),
(435, 'Estela (Puán)', 1),
(436, 'Esther (Saladillo)', 1),
(437, 'Estomba (Tornquist)', 1),
(438, 'Estrugamou (Las Flores)', 1),
(439, 'Etchegoyen (Exaltación de la Cruz)', 1),
(440, 'Etcheverry (La Plata)', 1),
(441, 'Ezeiza (Esteban Echeverría)', 1),
(442, 'Ezpeleta (Quilmes)', 1),
(443, 'Fábrica de Paños (San Nicolás)', 1),
(444, 'Fair (Ayacucho)', 1),
(445, 'Faro (Coronel Dorrego)', 1),
(446, 'Fatraló (Guaminí)', 1),
(447, 'Fauzón (9 de Julio)', 1),
(448, 'Fernández, Juan N. (Necochea)', 1),
(449, 'Fernández, Máximo (Bragado)', 1),
(450, 'Ferrari (Merlo)', 1),
(451, 'Ferrari, José (Magdalena)', 1),
(452, 'Ferre (Gral. Arenales)', 1),
(453, 'Fiorito (Lomas de Zamora)', 1),
(454, 'Florida (Vicente López)', 1),
(455, 'Fontezuela (Pergamino)', 1),
(456, 'Fortín Acha (Leandro N. Alem)', 1),
(457, 'Fortín Mercedes (Villarino)', 1),
(458, 'Fortín Olavarría (Rivadavia)', 1),
(459, 'Fortín Tiburcio (Junín)', 1),
(460, 'Fortín Viejo (Patagones)', 1),
(461, 'Franklin (San Andrés de Giles)', 1),
(462, 'French (9 de Julio)', 1),
(463, 'Fuerte Argentino (Tornquist)', 1),
(464, 'Fulton (Tandil)', 1),
(465, 'Funke (Tornquist)', 1),
(466, 'Fynn, Enrique (Gral. Las Heras)', 1),
(467, 'Gabiña, Ricardo (Juárez)', 1),
(468, 'Gahan (Salto)', 1),
(469, 'Gallo (Parada) (Morón)', 1),
(470, 'Galo Llorente (9 de Julio)', 1),
(471, 'Galván (Bahía Blanca)', 1),
(472, 'Gambier (La Plata)', 1),
(473, 'Gamen, Pedro (Pehuajó)', 1),
(474, 'Gándara (Chascomús)', 1),
(475, 'Gaona (Barrio Parque) (Moreno)', 1),
(476, 'García del Río (Tornquist)', 1),
(477, 'García, M. P. (Mercedes)', 1),
(478, 'Gardey (Tandil)', 1),
(479, 'Garín (Escobar)', 1),
(480, 'Garré (Guaminí)', 1),
(481, 'Garro (Bahía Blanca)', 1),
(482, 'Gascón, Esteban A. (Adolfo Alsina)', 1),
(483, 'Gaynor, Diego (Exaltación de la Cruz)', 1),
(484, 'Gerente Cilley (9 de Julio)', 1),
(485, 'Gerli (Avellaneda)', 1),
(486, 'Germania (Gral. Pinto)', 1),
(487, 'Gil (Coronel Dorrego)', 1),
(488, 'Giribone (Chascomús)', 1),
(489, 'Girodias (Trenque Lauquen)', 1),
(490, 'Girondo (Pehuajó)', 1),
(491, 'Glew (Almirante Brown)', 1),
(492, 'Gnecco (Pehuajó)', 1),
(493, 'Gobernador Andonaegui (Exaltación de la Cruz)', 1),
(494, 'Gobernador Arias (Carlos Casares)', 1),
(495, 'Gobernador Castro (San Pedro)', 1),
(496, 'Gobernador Monteverde (Florencio Varela)', 1),
(497, 'Gobernador Obligado (Coronel Brandsen)', 1),
(498, 'Gobernador Ortiz de Rosas (Saladillo)', 1),
(499, 'Gobernador Udaondo (Cañuelas)', 1),
(500, 'Gobernador Ugarte (25 de Mayo)', 1),
(501, 'Godney (Mercedes)', 1),
(502, 'Gómez (Coronel Brandsen)', 1),
(503, 'Gómez de la Vega (Coronel Brandsen)', 1),
(504, 'Gómez, M. (Apeadero) (Morón)', 1),
(505, 'Gómez, Valentín (Rivadavia)', 1),
(506, 'Gondra (Gral. Villegas)', 1),
(507, 'Gonnet, Manuel B (La Plata)', 1),
(508, 'González Catán (Matanza)', 1),
(509, 'González Chaves (González Chaves)', 1),
(510, 'González Risos (Navarro)', 1),
(511, 'Gorchs (Gral. Belgrano)', 1),
(512, 'Gorina, Joaquín (La Plata)', 1),
(513, 'Gorostiaga (Chivilcoy)', 1),
(514, 'Gorriti (Adolfo Alsina)', 1),
(515, 'Gorriti (Barrio) (Almirante Brown)', 1),
(516, 'Gouin (Carmen de Areco)', 1),
(517, 'Gowland (Mercedes)', 1),
(518, 'Goyena (Saavedra)', 1),
(519, 'Goyeneche (Monte)', 1),
(520, 'Graciarena (Salliqueló)', 1),
(521, 'Gral. Alvear (Gral. Alvear)', 1),
(522, 'Gral. Arenales (Gral. Arenales)', 1),
(523, 'Gral. Belgrano (Gral. Belgrano)', 1),
(524, 'Gral. Belgrano (Matanza)', 1),
(525, 'Gral. Cerri (Bahía Blanca)', 1),
(526, 'Gral. Conesa (Gral. Conesa)', 1),
(527, 'Gral. Guido (Gral. Guido)', 1),
(528, 'Gral. Lamadrid (Gral. Lamadrid)', 1),
(529, 'Gral. Las Heras (Gral. Las Heras)', 1),
(530, 'Gral. Lavalle (Gral. Lavalle)', 1),
(531, 'Gral. Madariaga (Gral. Madariaga)', 1),
(532, 'Gral. Pacheco (Tigre)', 1),
(533, 'Gral. Pinto (Gral. Pinto)', 1),
(534, 'Gral. Pirán (Mar Chiquita)', 1),
(535, 'Gral. Rivas (Suipacha)', 1),
(536, 'Gral. Rodriguez (Gral. Rodriguez)', 1),
(537, 'Gral. Rojo (San Nicolás)', 1),
(538, 'Gral. San Martín (San Martín)', 1),
(539, 'Gral. Villegas (Gral. Villegas)', 1),
(540, 'Grand Bour (Barrio) (Morón)', 1),
(541, 'Grand Bourg (Malvinas Argentinas)', 1),
(542, 'Grossville (Barrio) (Vicente López)', 1),
(543, 'Grumbein (Bahía Blanca)', 1),
(544, 'Guaminí (Guaminí)', 1),
(545, 'Guanaco (Pehuajó)', 1),
(546, 'Guernica (San Vicente)', 1),
(547, 'Guerrero (Castelli)', 1),
(548, 'Guerrico (Pergamino)', 1),
(549, 'Guido Spano (Rojas)', 1),
(550, 'Guillón (Esteban Echeverría)', 1),
(551, 'Guizasola, José A. (Coronel Dorrego)', 1),
(552, 'Gunther (Gral. Pinto)', 1),
(553, 'Gutiérrez, José M (Berazategui)', 1),
(554, 'Haedo (Morón)', 1),
(555, 'Hale (Bolívar)', 1),
(556, 'Ham (Gral. Arenales)', 1),
(557, 'Harding Green (Bahía Blanca)', 1),
(558, 'Harostegui, B. (Las Flores)', 1),
(559, 'Heavy (San Andrés de Giles)', 1),
(560, 'Henderson (Hipólito Yrigoyen)', 1),
(561, 'Hereford (Carlos Tejedor)', 1),
(562, 'Hermanas (Laprida)', 1),
(563, 'Hermoso (Barrio) (Gral. Rodríguez)', 1),
(564, 'Hernández (La Plata)', 1),
(565, 'Herreras Vega (Hipólito Yrigoyen)', 1),
(566, 'Hinojo (Olavarría)', 1),
(567, 'Hirsch, Mauricio (Carlos Casares)', 1),
(568, 'Hornos (Gral. Las Heras)', 1),
(569, 'Hortensia (Carlos Casares)', 1),
(570, 'Huanguelen (Coronel Suárez)', 1),
(571, 'Hudson, Guillermo E. (Berazategui)', 1),
(572, 'Hue (San Martín)', 1),
(573, 'Huergo (Adolfo Alsina)', 1),
(574, 'Huergo Palemón (Chivilcoy)', 1),
(575, 'Huetel (25 de Mayo)', 1),
(576, 'Hunter (Rojas)', 1),
(577, 'Hurlingham (Morón)', 1),
(578, 'Husares (Carlos Tejedor)', 1),
(579, 'Ibáñez (Gral. Belgrano)', 1),
(580, 'Ibarra (Bolívar)', 1),
(581, 'Igarzábal (Patagones)', 1),
(582, 'Indacochea (Chivilcoy)', 1),
(583, 'Indart, Inés (Salto)', 1),
(584, 'Indio Rico (Coronel Pringles)', 1),
(585, 'Ingeniero Allan (Florencio Varela)', 1),
(586, 'Ingeniero Balbín (Gral. Pinto)', 1),
(587, 'Ingeniero Beanguy (Carlos Tejedor)', 1),
(588, 'Ingeniero Budge (Lomas de Zamora)', 1),
(589, 'Ingeniero de Madrid (25 de Mayo)', 1),
(590, 'Ingeniero Machwitz (Escobar)', 1),
(591, 'Ingeniero Moneta (San Pedro)', 1),
(592, 'Ingeniero Nogués Pablo (Malvinas Argentinas)', 1),
(593, 'Ingeniero Silveyra (Chacabuco)', 1),
(594, 'Ingeniero Thompson (Salliqueló)', 1),
(595, 'Ingeniero White (Bahía Blanca)', 1),
(596, 'Ingeniero Williams (Navarro)', 1),
(597, 'Ingenieros, José (Matanza)', 1),
(598, 'Intendente Amato (Morón)', 1),
(599, 'Invernadas (Gral. Madariaga)', 1),
(600, 'Iraizos (Gral. Alvarado)', 1),
(601, 'Irala (Bragado)', 1),
(602, 'Iraola (Tandil)', 1),
(603, 'Irene (Coronel Dorrego)', 1),
(604, 'Iriarte (Gral. Pinto)', 1),
(605, 'Irmalo (Barrio) (La Plata)', 1),
(606, 'Isla Maciel (Avellaneda)', 1),
(607, 'Isla Paulino (Berisso)', 1),
(608, 'Isla Santiago (Ensenada)', 1),
(609, 'Islas (25 de Mayo)', 1),
(610, 'Isletas (Villarino)', 1),
(611, 'Iturregui (Olavarría)', 1),
(612, 'Ituzaingó (Morón)', 1),
(613, 'Jacarandá (Berazategui)', 1),
(614, 'Jáuregui (Luján)', 1),
(615, 'Jeppener (Coronel Brandsen)', 1),
(616, 'Jofré, Tomás (Mercedes)', 1),
(617, 'Johnston (Barrio Parque) (Morón)', 1),
(618, 'Juan de Garay (Barrio) (Morón)', 1),
(619, 'Juancho (Gral. Madariaga)', 1),
(620, 'Juárez (Juárez)', 1),
(621, 'Junín (Junín)', 1),
(622, 'Justo, Juan B (Vicente López)', 1),
(623, 'Justo, Juan B. (Barrio) (Bahía Blanca)', 1),
(624, 'Juventud Unida (Barrio) (3 de Febrero)', 1),
(625, 'Keen, Carlos (Luján)', 1),
(626, 'Kenney (Carmen de Areco)', 1),
(627, 'Kil.28 (Rta. San Justo-Cañuelas) (Matanza)', 1),
(628, 'Kilómetro 108 (San Andrés de Giles)', 1),
(629, 'Kilómetro 125 (San Andrés de Giles)', 1),
(630, 'Kilómetro 158 (San Pedro)', 1),
(631, 'Kilómetro 172 (L. G. Roca, parada) (San Pedro)', 1),
(632, 'Kilómetro 18 (Morón)', 1),
(633, 'Kilómetro 187 (L. G. Roca, parada) (Salto)', 1),
(634, 'Kilómetro 19 (Morón)', 1),
(635, 'Kilómetro 20 (L. G. Roca, parada) (La Plata)', 1),
(636, 'Kilómetro 212 (L. G. Roca, parada) (Dolores)', 1),
(637, 'Kilómetro 26 (apeadero) (Tigre)', 1),
(638, 'Kilómetro 26,7 (L. G. Roca, parada) (Florencio Varela)', 1),
(639, 'Kilómetro 30 (parada) (Malvinas Argentinas)', 1),
(640, 'Kilómetro 333 (L. G. Roca, parada) (Olavarría)', 1),
(641, 'Kilómetro 38 (parada) (Tigre)', 1),
(642, 'Kilómetro 4 (Parada) (Tigre)', 1),
(643, 'Kilómetro 58 (L. G. Sarm.) (Marcos Paz)', 1),
(644, 'Kilómetro 66 (Pilar)', 1),
(645, 'Kilómetro 95 (Gral. Arenales)', 1),
(646, 'Kilómetro 99 (L. G. Roca, parada) (Magdalena)', 1),
(647, 'Korn, Alejandro (San Vicente)', 1),
(648, 'Krabbe (Coronel Pringles)', 1),
(649, 'La Amalia (9 de Julio)', 1),
(650, 'La Angelita (Gral. Arenales)', 1),
(651, 'La Angelita (Rojas)', 1),
(652, 'La Aurora (Coronel Dorrego)', 1),
(653, 'La Beba (Rojas)', 1),
(654, 'La Brava (Gral. Pueyrredón)', 1),
(655, 'La Calera (Juárez)', 1),
(656, 'La Capilla (Florencio Varela)', 1),
(657, 'La Carreta (Trenque Lauquen)', 1),
(658, 'La Chumbeada (Gral. Belgrano)', 1),
(659, 'La Colina (Gral. Lamadrid)', 1),
(660, 'La Colonia (Quilmes)', 1),
(661, 'La Constancia (Ayacucho)', 1),
(662, 'La Copeta (Caseros)', 1),
(663, 'La Cotorra (Pehuajó)', 1),
(664, 'La Delfina (Gral. Viamonte)', 1),
(665, 'La Dorita (Carlos Casares)', 1),
(666, 'La Dulce (Necocha)', 1),
(667, 'La Emilia (San Nicolás)', 1),
(668, 'La Falda (Bahía Blanca)', 1),
(669, 'La Florida (San Andrés de Giles)', 1),
(670, 'La Foresta (Matanza)', 1),
(671, 'La Gloria (Roque Pérez)', 1),
(672, 'La Granja (La Plata)', 1),
(673, 'La Guiseña (Barrio) (La Plata)', 1),
(674, 'La Larga (Caseros)', 1),
(675, 'La Leonor (Cañuelas)', 1),
(676, 'La Limpia (Dolores)', 1),
(677, 'La Limpia (Bragado)', 1),
(678, 'La Loma (La Plata)', 1),
(679, 'La Loma (San Isidro)', 1),
(680, 'La Lucila (Vicente López)', 1),
(681, 'La Luisa (Capitán Sarmiento)', 1),
(682, 'La Mamita (Lobería)', 1),
(683, 'La Manuela (Caseros)', 1),
(684, 'La Merced (Roque Pérez)', 1),
(685, 'La Negra (Necochea)', 1),
(686, 'La Nevada (Guaminí)', 1),
(687, 'La Niña (9 de Julio)', 1),
(688, 'La Noria (Cañuelas)', 1),
(689, 'La Oriental (Junín)', 1),
(690, 'La Pastora (Tandil)', 1),
(691, 'La Paz (Roque Pérez)', 1),
(692, 'La Peregrina (Gral. Pueyrredón)', 1),
(693, 'La Perla (Bolívar)', 1),
(694, 'La Perlita (Moreno)', 1),
(695, 'La Pesquería (Zárate)', 1),
(696, 'La Pinta (Gral. Arenales)', 1),
(697, 'La Plata (La Plata)', 1),
(698, 'La Porteña (Castelli)', 1),
(699, 'La Porteña (Trenque Lauquen)', 1),
(700, 'La Protección (Gral. Guido)', 1),
(701, 'La Protegida (Tapalqué)', 1),
(702, 'La Providencia (Olavarría)', 1),
(703, 'La Rabia (25 de Mayo)', 1),
(704, 'La Razón (Saladillo)', 1),
(705, 'La Recoleta (La Matanza)', 1),
(706, 'La Reforma (Pila)', 1),
(707, 'La Reforma (Roque Pérez)', 1),
(708, 'La Reja (Moreno)', 1),
(709, 'La Rica (Chivilcoy)', 1),
(710, 'La Rosada (Tandil)', 1),
(711, 'La Rosalía (Puán)', 1),
(712, 'La Salada (Lomas de Zamora)', 1),
(713, 'La Soberana (Coronel Dorrego)', 1),
(714, 'La Sofía (Carlos Casares)', 1),
(715, 'La Suiza (Gral. Pinto)', 1),
(716, 'La Tradición (Barrio) (Moreno)', 1),
(717, 'La Tribu (Dolores)', 1),
(718, 'La Tribu (25 de Mayo)', 1),
(719, 'La Trinidad (Gral. Arenales)', 1),
(720, 'La Verde (Mercedes)', 1),
(721, 'La Villa (Gral. Belgrano)', 1),
(722, 'La Virginia (Coronel Pringles)', 1),
(723, 'La Vitícola (Bahía Blanca)', 1),
(724, 'La Zanja (Trenque Lauquen)', 1),
(725, 'Labardén (Gral. Guido)', 1),
(726, 'Laferrer (Matanza)', 1),
(727, 'Lago Epecuén (Adolfo Alsina)', 1),
(728, 'Laguna Grande (Patagones)', 1),
(729, 'Lamarca (Patagones)', 1),
(730, 'Langueyú (Ayacucho)', 1),
(731, 'Lanús (Lanús)', 1),
(732, 'Laplacete (Junín)', 1),
(733, 'Laprida (Laprida)', 1),
(734, 'Laprida (Barrio) (Lomas de Zamora)', 1),
(735, 'Larramendy (Pehuajó)', 1),
(736, 'Larre, Santiago (Roque Pérez)', 1),
(737, 'Larrea (Alberti)', 1),
(738, 'Lartigau (Coronel Pringles)', 1),
(739, 'Las Armas (Maipú)', 1),
(740, 'Las Bandurrias (Gral. Lamadrid)', 1),
(741, 'Las Barrancas (San Isidro)', 1),
(742, 'Las Campanillas (Barrio) (Merlo)', 1),
(743, 'Las Catonas (Moreno)', 1),
(744, 'Las Flores (Las Flores)', 1),
(745, 'Las Flores (San Pedro)', 1),
(746, 'Las Guasquitas (Trenque Lauquen)', 1),
(747, 'Las Heras (Gral. Las Heras)', 1),
(748, 'Las Hermanas (Laprida)', 1),
(749, 'Las Juanitas (Pehuajó)', 1),
(750, 'Las Malvinas (Barrio) (La Plata)', 1),
(751, 'Las Margaritas (Barrio) (La Plata)', 1),
(752, 'Las Marianas (Navarro)', 1),
(753, 'Las Martinetas (Gral. Lamadrid)', 1),
(754, 'Las Mostazas (Coronel Pringles)', 1),
(755, 'Las Naciones (Morón)', 1),
(756, 'Las Negras (Rauch)', 1),
(757, 'Las Nieves (Matanza)', 1),
(758, 'Las Nutrias (Lobería)', 1),
(759, 'Las Palmas (Zárate)', 1),
(760, 'Las Parvas (Junín)', 1),
(761, 'Las Quintas (La Plata)', 1),
(762, 'Las Sirenas (Barrio) (Florencio Varela)', 1),
(763, 'Las Sortijas (Coronel Pringles)', 1),
(764, 'Las Tahonas (Magdalena)', 1),
(765, 'Las Toninas (Gral. Lavalle)', 1),
(766, 'Las Toscas (Lincoln)', 1),
(767, 'Las Vaquerías (Tres Arroyos)', 1),
(768, 'Las Víboras (Dolores)', 1),
(769, 'Las Violetas (Pergamino)', 1),
(770, 'Lasalle, Pedro P. (González Chaves)', 1),
(771, 'Lastra (Gral. Lamadrid)', 1),
(772, 'Lavalle, Enrique (Caseros)', 1),
(773, 'Lazzarino, Félix (Azul)', 1),
(774, 'Leloir (Barrio Parque) (Morón)', 1),
(775, 'Leobuco (Adolfo Alsina)', 1),
(776, 'Lertora (Trenque Lauquen)', 1),
(777, 'Levalle, Nicolás (Villarino)', 1),
(778, 'Levene, Ricardo (parada) (Berazategui)', 1),
(779, 'Lezama (Chascomús)', 1),
(780, 'Líbano (Gral. Lamadrid)', 1),
(781, 'Libertad (Tres Arroyos)', 1),
(782, 'Libertad (Merlo)', 1),
(783, 'Libres del Sud (Chascomús)', 1),
(784, 'Licenciado Matienzo (Lobería)', 1),
(785, 'Lima (Zárate)', 1),
(786, 'Lincks (Esteban Echeverría)', 1),
(787, 'Lincoln (Lincoln)', 1),
(788, 'Lindo (Barrio) (Almirante Brown)', 1),
(789, 'Llavallol (Lomas de Zamora)', 1),
(790, 'Lobería (Lobería)', 1),
(791, 'Lobos (Lobos)', 1),
(792, 'Loma del Millón (Matanza)', 1),
(793, 'Loma Hermosa (3 de Febrero)', 1),
(794, 'Loma Mariló (Moreno)', 1),
(795, 'Loma Negra (Olavarría)', 1),
(796, 'Loma San Fernando (San Fernando)', 1),
(797, 'Loma Verde (Gral. Paz)', 1),
(798, 'Loma Verde (Almirante Brown)', 1),
(799, 'Loma Verde (o Rincón de Vivot) (Chascomús)', 1),
(800, 'Lomas de Burzaco (Almirante Brown)', 1),
(801, 'Lomas de Roldán (Dolores)', 1),
(802, 'Lomas de Salomón (Dolores)', 1),
(803, 'Lomas de San Javier (Almirante Brown)', 1),
(804, 'Lomas de Tavelli (Moreno)', 1),
(805, 'Lomas de Villa Transradio (Esteban Echeverría)', 1),
(806, 'Lomas de Zamora (Lomas de Zamora)', 1),
(807, 'Lomas del Mirador (Matanza)', 1),
(808, 'Lomas del Palomar (3 de Febrero)', 1),
(809, 'Longchamps (Almirante Brown)', 1),
(810, 'López (Juárez)', 1),
(811, 'López Camelo (San Vicente)', 1),
(812, 'López Lecube (Puán)', 1),
(813, 'López,Vicente (Vicente López)', 1),
(814, 'Los Alamos (Matanza)', 1),
(815, 'Los Alamos (Barrio) (Almirante Brown)', 1),
(816, 'Los Angeles (Salto)', 1),
(817, 'Los Callejones (Gral. Pinto)', 1),
(818, 'Los Cardales (Exaltación de la Cruz)', 1),
(819, 'Los Ceibos (Matanza)', 1),
(820, 'Los Eucaliptos (Monte)', 1),
(821, 'Los Fresnos (Quilmes)', 1),
(822, 'Los Gauchos (Adolfo Alsina)', 1),
(823, 'Los Hornos (La Plata)', 1),
(824, 'Los Huesos (Gral. Viamonte)', 1),
(825, 'Los Indios (Rojas)', 1),
(826, 'Los Laureles (Gral. Villegas)', 1),
(827, 'Los Manantiales (Coronel Pringles)', 1),
(828, 'Los Perales (San Isidro)', 1),
(829, 'Los Pinos (Balcarce)', 1),
(830, 'Los Polvorines (Malvinas Argentinas)', 1),
(831, 'Los Pozos (Patagones)', 1),
(832, 'Los Studs (San Isidro)', 1),
(833, 'Los Talas (Berisso)', 1),
(834, 'Los Toldos (Gral. Viamonte)', 1),
(835, 'Los Troncos del Talar (Tigre)', 1),
(836, 'Louge (3 de Febrero)', 1),
(837, 'Lozano (Gral. Las Heras)', 1),
(838, 'Luján (Luján)', 1),
(839, 'Lumb (Necochea)', 1),
(840, 'Luro (Caseros)', 1),
(841, 'Luro, Pedro (Villarino)', 1),
(842, 'Lynch (San Martín)', 1),
(843, 'Lynch Pueyrredón (Bolívar)', 1),
(844, 'Macedo (Gral. Madariaga)', 1),
(845, 'Macguirre (Pergamino)', 1),
(846, 'Macoco (9 de Julio)', 1),
(847, 'Madero, Francisco (Pehuajó)', 1),
(848, 'Magdala (Pehuajó)', 1),
(849, 'Magdalena (Magdalena)', 1),
(850, 'Magnano (Trenque Lauquen)', 1),
(851, 'Maipú (Maipú)', 1),
(852, 'Malaver (3 de Febrero)', 1),
(853, 'Maldonado (Bahía Blanca)', 1),
(854, 'Mamaguita (25 de Mayo)', 1),
(855, 'Mangrullo (Saladillo)', 1),
(856, 'Mansone (Pilar)', 1),
(857, 'Manzanares (Pilar)', 1),
(858, 'Mapis (Olavarría)', 1),
(859, 'Mar Azul (Gral. Madariaga)', 1),
(860, 'Mar Chiquita (Mar Chiquita)', 1),
(861, 'Mar del Plata (Gral. Pueyrredón)', 1),
(862, 'Mar del Sud (Gral. Alvarado)', 1),
(863, 'Mar del Tuyú (Gral. Lavalle)', 1),
(864, 'Mari Lauquen (Trenque Lauquen)', 1),
(865, 'María Lucia (Hipólito Yrigoyen)', 1),
(866, 'Mármol (Almirante Brown)', 1),
(867, 'Martín Fierro (Azul)', 1),
(868, 'Martín Fierro (Trenque Lauquen)', 1),
(869, 'Martínes de Hoz (Lincoln)', 1),
(870, 'Martínez (San Isidro)', 1),
(871, 'Marucha (Carlos Tejedor)', 1),
(872, 'Mascota (Villarino)', 1),
(873, 'Masurel (Caseros)', 1),
(874, 'Matheu (Escobar)', 1),
(875, 'Mayor Buratovich (Villarino)', 1),
(876, 'Maza (Adolfo Alsina)', 1),
(877, 'Mecha (Bragado)', 1),
(878, 'Mechita (Alberti)', 1),
(879, 'Mechongué (Gral. Alvarado)', 1),
(880, 'Médanos (Villarino)', 1),
(881, 'Meeck, Francisco (Azul)', 1),
(882, 'Membrillar (Chacabuco)', 1),
(883, 'Mendeville (Matanza)', 1),
(884, 'Mercado Victoria (Bahía Blanca)', 1),
(885, 'Mercedes (Mercedes)', 1),
(886, 'Meridiano V. (Rivadavia)', 1),
(887, 'Merlo (Merlo)', 1),
(888, 'Micheo, José M. (Gral. Alvear)', 1),
(889, 'Migueletes (San Martín)', 1),
(890, 'Mihanovich (Parque) (Morón)', 1),
(891, 'Ministro Rivadavia (Almirante Brown)', 1),
(892, 'Mira Pampa (Rivadavia)', 1),
(893, 'Miramar (Bolívar)', 1),
(894, 'Miramar (Gral. Alvarado)', 1),
(895, 'Miramonte (Azul)', 1),
(896, 'Mitre, Bartolomé (Vicente López)', 1),
(897, 'Molina Claudio (Tres Arroyos)', 1),
(898, 'Moll (Navarro)', 1),
(899, 'Monasterio (Chascomús)', 1),
(900, 'Mones Cazón (Pehuajó)', 1),
(901, 'Monroe (Salto)', 1),
(902, 'Monsalvo (Maipú)', 1),
(903, 'Montaraz (Florencio Varela)', 1),
(904, 'Monte (Monte)', 1),
(905, 'Monte Carlo (San Martín)', 1),
(906, 'Monte Chingolo (Lanús)', 1),
(907, 'Monte Grande (Esteban Echeverría)', 1),
(908, 'Monte La Plata (Villarino)', 1),
(909, 'Monte Veloz (Magdalena)', 1),
(910, 'Montes de Oca (Villarino)', 1),
(911, 'Monteverde (25 de Mayo)', 1),
(912, 'Moore (Gral. Villegas)', 1),
(913, 'Moquehuá (Chivilcoy)', 1),
(914, 'Morea (9 de Julio)', 1),
(915, 'Moreno (Moreno)', 1),
(916, 'Moreno, P. M. (Escobar)', 1),
(917, 'Moro (Lobería)', 1),
(918, 'Morón (Morón)', 1),
(919, 'Morris (Parada) (Morón)', 1),
(920, 'Morse (Junín)', 1),
(921, 'Mosconi (25 de Mayo)', 1),
(922, 'Mouras (Caseros)', 1),
(923, 'Mulcahy (9 de Julio)', 1),
(924, 'Munro (Vicente López)', 1),
(925, 'Muñiz (San Miguel)', 1),
(926, 'Muñoz (Olavarría)', 1),
(927, 'Murature (Adolfo Alsina)', 1),
(928, 'Mutti (Ramallo)', 1),
(929, 'Nahuel Ruca (Mar Chiquita)', 1),
(930, 'Naón, Carlos (9 de Julio)', 1),
(931, 'Napaleofú (Balcarce)', 1),
(932, 'Napostá (Bahía Blanca)', 1),
(933, 'Navarro (Navarro)', 1),
(934, 'Necochea (Necochea)', 1),
(935, 'Necol (Carlos Tejedor)', 1),
(936, 'Neild (9 de Julio)', 1),
(937, 'Newbery (Morón)', 1),
(938, 'Newton (General Belgrano)', 1),
(939, 'Nieves (Azul)', 1),
(940, 'Norumbega (9 de Julio)', 1),
(941, 'Nueva Plata (Pehuajó)', 1),
(942, 'Nueva Roma (Tornquist)', 1),
(943, 'Nueve de Julio (9 de Julio)', 1),
(944, 'Nutrias (Lobería)', 1),
(945, 'Obligado, Rafael (Rojas)', 1),
(946, 'O''Brien (Bragado)', 1),
(947, 'Ocampo, Manuel (Pergamino)', 1),
(948, 'Ochandio (San Cayetano)', 1),
(949, 'O''Higgins (Chacabuco)', 1),
(950, 'Olascoaga (Bragado)', 1),
(951, 'Olavarría (Olavarría)', 1),
(952, 'Oliden (Coronel Brandsen)', 1),
(953, 'Olivera (Luján)', 1),
(954, 'Olivos (Vicente López)', 1),
(955, 'Olmos, Lisandro (La Plata)', 1),
(956, 'Ombú (Coronel Suárez)', 1),
(957, 'Ombucta (Villarino)', 1),
(958, 'Once de Setiembre (Tres de Febrero)', 1),
(959, 'Open Door (Luján)', 1),
(960, 'Ordoqui (Carlos Casares)', 1),
(961, 'Orense (Tres Arroyos)', 1),
(962, 'Oriente (Coronel Dorrego)', 1),
(963, 'Oro Verde (Matanza)', 1),
(964, 'Ortiz Basualdo (Pergamino)', 1),
(965, 'Ortiz de Rosas (25 de Mayo)', 1),
(966, 'Otamendi (Campana)', 1),
(967, 'Otoño (Coronel Suárez)', 1),
(968, 'Padilla, Miguel M. (Vicente López)', 1),
(969, 'Palantelén (Alberti)', 1),
(970, 'Palemón Huergo (Chivilcoy)', 1),
(971, 'Palmitas (Cañuelas)', 1),
(972, 'Palo Blanco (Berisso)', 1),
(973, 'Parada Alastucy (Luján)', 1),
(974, 'Parada Kilómetro 336 (Moreno)', 1),
(975, 'Parada La Lata (Exaltación de la Cruz)', 1),
(976, 'Parada Orlando (Exaltación de la Cruz)', 1),
(977, 'Paraguil (Laprida)', 1),
(978, 'Pardo (Las Flores)', 1),
(979, 'Parish (Azul)', 1),
(980, 'Parque Aguirre (San Isidro)', 1),
(981, 'Parque Provincial (Tornquist)', 1),
(982, 'Parravicini (Dolores)', 1),
(983, 'Pasman (Coronel Suárez)', 1),
(984, 'Paso del Rey (Moreno)', 1),
(985, 'Paso Mayor (Coronel Rosales)', 1),
(986, 'Pasos Kanki (Gral. Pinto)', 1),
(987, 'Passo (Pehuajó)', 1),
(988, 'Pasteur (Lincoln)', 1),
(989, 'Patagones (Patagones)', 1),
(990, 'Patricios (9 de Julio)', 1),
(991, 'Paula (Bolívar)', 1),
(992, 'Pavón (Exaltación de la Cruz)', 1),
(993, 'Payró,Roberto J (Magdalena)', 1),
(994, 'Paz (Barrio) (Morón)', 1),
(995, 'Paz, J. M. (Barrio) (La Matanza)', 1),
(996, 'Paz, José C. (José C. Paz)', 1),
(997, 'Paz, Marcos (Marcos Paz)', 1),
(998, 'Paz, Máximo (Cañuelas)', 1),
(999, 'Pearson (Colón)', 1),
(1000, 'Pedernales (25 de Mayo)', 1),
(1001, 'Pehuajó (Pehuajó)', 1),
(1002, 'Pehuelches (Pellegrini)', 1),
(1003, 'Pelícura (Tornquist)', 1),
(1004, 'Pellegrini (Pellegrini)', 1),
(1005, 'Peralta (Coronel Suárez)', 1),
(1006, 'Peralta Ramos (Barrio) (Gral. Pueyrredón)', 1),
(1007, 'Pereda, Vicente (Azul)', 1),
(1008, 'Pereyra (Berazategui)', 1),
(1009, 'Pereyra (Estación) (Morón)', 1),
(1010, 'Pereyra Iraola (Barrio) (Morón)', 1),
(1011, 'Pérez Millán (Ramallo)', 1),
(1012, 'Pérez, Roque (Roque Pérez)', 1),
(1013, 'Pergamino (Pergamino)', 1),
(1014, 'Perkin, Edmundo (Leandro N. Alem)', 1),
(1015, 'Pessagno (Chascomús)', 1),
(1016, 'Pichincha (Gral. Villegas)', 1),
(1017, 'Piedritas (Gral. Villegas)', 1),
(1018, 'Pieres (Lobería)', 1),
(1019, 'Pigué (Saavedra)', 1),
(1020, 'Pila (Pila)', 1),
(1021, 'Pilar (Pilar)', 1),
(1022, 'Pillahuinco (Coronel Pringles)', 1),
(1023, 'Pinzón (Pergamino)', 1),
(1024, 'Piñeyro (Coronel Suárez)', 1),
(1025, 'Piñeyro (Avellaneda)', 1),
(1026, 'Pipinas (Magdalena)', 1),
(1027, 'Pirovano (Bolívar)', 1),
(1028, 'Plá (Alberti)', 1),
(1029, 'Plátanos (Berazategui)', 1),
(1030, 'Plaza Montero (Las Flores)', 1),
(1031, 'Plomer (Gral. Las Heras)', 1),
(1032, 'Poblet (González Chavez)', 1),
(1033, 'Poblet (La Plata)', 1),
(1034, 'Polvaredas (Saladillo)', 1),
(1035, 'Pontaut (Gral. Lamadrid)', 1),
(1036, 'Pontevedra (Merlo)', 1),
(1037, 'Portela, Irineo (Baradero)', 1),
(1038, 'Porvenir (Gral. Pinto)', 1),
(1039, 'Pourtale (Olavarría)', 1),
(1040, 'Pradere (Gral. Villegas)', 1),
(1041, 'Pradere, Juan A. (Patagones)', 1),
(1042, 'Presidente Quintana (Alberti)', 1),
(1043, 'Primavera (Coronel Suárez)', 1),
(1044, 'Primera Junta (Trenque Lauquen)', 1),
(1045, 'Provincias Unidas (B) (La Matanza)', 1),
(1046, 'Puán (Puán)', 1),
(1047, 'Pueblitos (25 de Mayo)', 1),
(1048, 'Pueblo Nuevo (Junín)', 1),
(1049, 'Pueblo Nuevo (Luján)', 1),
(1050, 'Pueblo Nuevo (Tigre)', 1),
(1051, 'Pueblo Viejo (Esteban Echeverría)', 1),
(1052, 'Puente Alsina (Lanús)', 1),
(1053, 'Puente Castex (San Antonio de Areco)', 1),
(1054, 'Puente Ezcurra (Barrio) (La Matanza)', 1),
(1055, 'Puerto Belgrano (Coronel Rosales)', 1),
(1056, 'Puerto Nuevo (San Nicolás)', 1),
(1057, 'Puerto Oliveira César (San Pedro)', 1),
(1058, 'Pujol (Pergamino)', 1),
(1059, 'Punta Alta (Coronel Rosales)', 1),
(1060, 'Punta Chica (San Isidro)', 1),
(1061, 'Punta Lara (Ensenada)', 1),
(1062, 'Quenomía (Pellegrini)', 1),
(1063, 'Quenumá (Salliqueló)', 1),
(1064, 'Quequén (Lobería)', 1),
(1065, 'Querandí (Matanza)', 1),
(1066, 'Quilco (Gral. Lamadrid)', 1),
(1067, 'Quilmes (Quilmes)', 1),
(1068, 'Quinihual (Coronel Suárez)', 1),
(1069, 'Quirno Costa (Gral. Viamonte)', 1),
(1070, 'Quiroga (9 de Julio)', 1),
(1071, 'Ramallo (Ramallo)', 1),
(1072, 'Ramos Mejía (Matanza)', 1),
(1073, 'Ramos Otero (Balcarce)', 1),
(1074, 'Rancagua (Pergamino)', 1),
(1075, 'Ranchos (Gral. Paz)', 1),
(1076, 'Ranelagh (Berazategui)', 1),
(1077, 'Rauch (Rauch)', 1),
(1078, 'Raulet (Gral. Lamadrid)', 1),
(1079, 'Rawson (Chacabuco)', 1),
(1080, 'Real Audiencia (Pila)', 1),
(1081, 'Recalde (Olavarría)', 1),
(1082, 'Remedios de Escalada (Lanús)', 1),
(1083, 'Reserva (Coronel Pringles)', 1),
(1084, 'Reynoso,Emiliano (Saladillo)', 1),
(1085, 'Rincón de López (Castelli)', 1),
(1086, 'Rincón de Milberg (Tigre)', 1),
(1087, 'Rincón de Vivot o Loma Verde (Chascomús)', 1),
(1088, 'Ringuelet (La Plata)', 1),
(1089, 'Río Lujan (Campana)', 1),
(1090, 'Río Santiago (Ensenada)', 1),
(1091, 'Río Tala (San Pedro)', 1),
(1092, 'Rivadeo (Puán)', 1),
(1093, 'Roberts (Lincoln)', 1),
(1094, 'Roca, Agustín (Junín)', 1),
(1095, 'Roca, Julio A.(Barrio) (Morón)', 1),
(1096, 'Rocha (Olavarría)', 1),
(1097, 'Rojas (Rojas)', 1),
(1098, 'Rojo (San Nicolás)', 1),
(1099, 'Roldán, Mariano (Juárez)', 1),
(1100, 'Rolito (Guaminí)', 1),
(1101, 'Romero Chico (La Plata)', 1),
(1102, 'Romero, Elías (Marcos Paz)', 1),
(1103, 'Romero, Melchor (La Plata)', 1),
(1104, 'Rondeau (Puán)', 1),
(1105, 'Roosevelt (Rivadavia)', 1),
(1106, 'Roque Pérez (Roque Pérez)', 1),
(1107, 'Rosas (Las Flores)', 1),
(1108, 'Rubén Dario (Parada) (Morón)', 1),
(1109, 'Ruiz (San A. de Giles)', 1),
(1110, 'Saavedra (Saavedra)', 1),
(1111, 'Sáenz Peña (San Martín)', 1),
(1112, 'Sáenz, Adela (Puán)', 1),
(1113, 'Saforcada (Junín)', 1),
(1114, 'Saladillo (Saladillo)', 1),
(1115, 'Salas, Carlos (Lincoln)', 1),
(1116, 'Salazar (Caseros)', 1),
(1117, 'Saldungaray (Tornquist)', 1),
(1118, 'Salliqueló (Salliqueló)', 1),
(1119, 'Salto (Salto)', 1),
(1120, 'Salvador María (Lobos)', 1),
(1121, 'Samborombón (Coronel Brandsen)', 1),
(1122, 'San Agustín (Balcarce)', 1),
(1123, 'San Alberto (Barrio) (Matanza)', 1),
(1124, 'San Andrés (Puán)', 1),
(1125, 'San Andrés (San Martín)', 1),
(1126, 'San Andrés de Giles (San A. de Giles)', 1),
(1127, 'San Antonio de Areco (San A. de Areco)', 1),
(1128, 'San Antonio de Padua (Merlo)', 1),
(1129, 'San Benito (Saladillo)', 1),
(1130, 'San Bernardo (Tapalqué)', 1),
(1131, 'San Bernardo (Baln.) (Gral. Lavalle)', 1),
(1132, 'San Cayetano (San Cayetano)', 1),
(1133, 'San Ciriaco (Tandil)', 1),
(1134, 'San Clemente del Tuyú (Gral. Lavalle)', 1),
(1135, 'San Eladio (Luján)', 1),
(1136, 'San Emilio (Gral. Viamonte)', 1),
(1137, 'San Enrique (25 de Mayo)', 1),
(1138, 'San Fermín (Guaminí)', 1),
(1139, 'San Fernando (San Fernando)', 1),
(1140, 'San Francisco de Bellocq (Tres Arroyos)', 1),
(1141, 'San Francisco Solano (Quilmes)', 1),
(1142, 'San Germán (Puán)', 1),
(1143, 'San Gervasio (Tapalqué)', 1),
(1144, 'San Ignacio (Ayacucho)', 1),
(1145, 'San Ignacio (Matanza)', 1),
(1146, 'San Isidro (San Isidro)', 1),
(1147, 'San Jacinto (Olavarría)', 1),
(1148, 'San Jacinto (Mercedes)', 1),
(1149, 'San Jorge (Barrio) (La Plata)', 1),
(1150, 'San José (Necochea)', 1),
(1151, 'San Juan (Barrio) (Berazategui)', 1),
(1152, 'San Justo (Dolores)', 1),
(1153, 'San Justo (Matanza)', 1),
(1154, 'San Lorenzo (Matanza)', 1),
(1155, 'San Lorenzo (Parque) (Tigre)', 1),
(1156, 'San Manuel (Lobería)', 1),
(1157, 'San Martín (Saavedra)', 1),
(1158, 'San Martín (San Martín)', 1),
(1159, 'San Martín (Bº Parque) (Matanza)', 1),
(1160, 'San Mauricio (Rivadavia)', 1),
(1161, 'San Mayol (Tres Arroyos)', 1),
(1162, 'San Miguel (San Miguel)', 1),
(1163, 'San Nicolás (San Nicolás)', 1),
(1164, 'San Patricio (Chacabuco)', 1),
(1165, 'San Pedro (Saavedra)', 1),
(1166, 'San Pedro (Matanza)', 1),
(1167, 'San Pedro (San Pedro)', 1),
(1168, 'San Román (Coronel Dorrego)', 1),
(1169, 'San Roque (Barrio) (Matanza)', 1),
(1170, 'San Sebastián (Chivilcoy)', 1),
(1171, 'San Sebastián (Bº Parque) (E. Echeverría)', 1),
(1172, 'San Serapio de la Loma (Moreno)', 1),
(1173, 'San Vicente (San Vicente)', 1),
(1174, 'Sánchez (Ramallo)', 1),
(1175, 'Sansinena (Rivadavia)', 1),
(1176, 'Santa Amelia (Matanza)', 1),
(1177, 'Santa Ana (Barrio) (La Plata)', 1),
(1178, 'Santa Catalina (Lomas de Zamora)', 1),
(1179, 'Santa Clara (Dolores)', 1),
(1180, 'Santa Clara del Mar (Mar Chiquita)', 1),
(1181, 'Santa Coloma (Pilar)', 1),
(1182, 'Santa Elena (Laprida)', 1),
(1183, 'Santa Eleodora (Gral. Villegas)', 1),
(1184, 'Santa Inés (Carlos Tejedor)', 1),
(1185, 'Santa Isabel (Gral. Alvear)', 1),
(1186, 'Santa Isabel (Gral. Pueyrredón)', 1),
(1187, 'Santa Lucía (San Pedro)', 1),
(1188, 'Santa Luisa (Olavarría)', 1),
(1189, 'Santa Regina (Gral. Villegas)', 1),
(1190, 'Santa Rita (San Isidro)', 1),
(1191, 'Santa Rosa (Puán)', 1),
(1192, 'Santa Rosa (Chascomús)', 1),
(1193, 'Santamarina, Ramón (Necochea)', 1),
(1194, 'Santo Domingo (Maipú)', 1),
(1195, 'Santo Tomás (Carlos Casares)', 1),
(1196, 'Santos Lugares (Tres de Febrero)', 1),
(1197, 'Sarandí (Avellaneda)', 1),
(1198, 'Saraza (Colón)', 1),
(1199, 'Saturno (Guaminí)', 1),
(1200, 'Seguí, Arturo (La Plata)', 1),
(1201, 'Segurola (Maipú)', 1),
(1202, 'Sevigné (Dolores)', 1),
(1203, 'Shaw (Azul)', 1),
(1204, 'Sierra Chica (Olavarría)', 1),
(1205, 'Sierra de la Ventana (Tornquist)', 1),
(1206, 'Sierras Bayas (Olavarría)', 1),
(1207, 'Smith (Carlos Casares)', 1),
(1208, 'Sojo, José Tomás (Saladillo)', 1),
(1209, 'Sol de Mayo (Rojas)', 1),
(1210, 'Sol de Mayo (Navarro)', 1),
(1211, 'Sola, Felipe (Puán)', 1),
(1212, 'Solanet (Ayacucho)', 1),
(1213, 'Solín (San A. de Giles)', 1),
(1214, 'Sosa, Inocencio (Pehuajó)', 1),
(1215, 'Sourigues, Carlos T. (Berazategui)', 1),
(1216, 'Spartillar (Chascomús)', 1),
(1217, 'Spegazzini, Carlos (E. Echeverría)', 1),
(1218, 'Spurr (Bahía Blanca)', 1),
(1219, 'Stegman (Coronel Pringles)', 1),
(1220, 'Stroeder (Patagones)', 1),
(1221, 'Suárez, José León (San Martín)', 1),
(1222, 'Suárez, Tristán (E. Echeverría)', 1),
(1223, 'Sucre (Luján)', 1),
(1224, 'Suipacha (Suipacha)', 1),
(1225, 'Sumapampa (Bº Parque) (Morón)', 1),
(1226, 'Sumbland (Rivadavia)', 1),
(1227, 'Tablada (Matanza)', 1),
(1228, 'Tablada Vieja (Alte. Brown)', 1),
(1229, 'Tacuari (Salto)', 1),
(1230, 'Tamangueyú (Lobería)', 1),
(1231, 'Tambo Nuevo (Pergamino)', 1),
(1232, 'Tandil (Tandil)', 1),
(1233, 'Tapalqué (Tapalqué)', 1),
(1234, 'Tapiales (Matanza)', 1),
(1235, 'Tatay (Carmen de Areco)', 1),
(1236, 'Tedín Uriburu (Juárez)', 1),
(1237, 'Tejedor, Carlos (Carlos Tejedor)', 1),
(1238, 'Temperley (Lomas de Zamora)', 1),
(1239, 'Teniente Balmaceda (Morón)', 1),
(1240, 'Teniente Coronel Miñana (Olavarría)', 1),
(1241, 'Teniente Origone (Villarino)', 1),
(1242, 'Thames (Adolfo Alsina)', 1),
(1243, 'Tigre C. (Tigre)', 1),
(1244, 'Timote (Carlos Tejedor)', 1),
(1245, 'Timote Chico (Carlos Tejedor)', 1),
(1246, 'Tiro Federal (Bahía Blanca)', 1),
(1247, 'Tiro Federal (Ensenada)', 1),
(1248, 'Tolosa (La Plata)', 1),
(1249, 'Tood (Bartolomé Mitre)', 1),
(1250, 'Tornquist (Tornquist)', 1),
(1251, 'Toro (Pilar)', 1),
(1252, 'Torres (Luján)', 1),
(1253, 'Tortugas (Pilar)', 1),
(1254, 'Tortuguitas (José C. Paz)', 1),
(1255, 'Treinta de Agosto (Trenque Lauquen)', 1),
(1256, 'Trenque Lauquen (Trenque Lauquen)', 1),
(1257, 'Tres Algarrobos (Carlos Tejedor)', 1),
(1258, 'Tres Arroyos (Tres Arroyos)', 1),
(1259, 'Tres Bonetes (Patagones)', 1),
(1260, 'Tres Lagunas (Adolfo Alsina)', 1),
(1261, 'Tres Leguas (Dolores)', 1),
(1262, 'Tres Lomas (Pellegrini)', 1),
(1263, 'Tres Picos (Tornquist)', 1),
(1264, 'Tres Sargentos (Carmen de Areco)', 1),
(1265, 'Trigales (Leandro N. Alem)', 1),
(1266, 'Triunfo (Lincoln)', 1),
(1267, 'Triunvirato (Lincoln)', 1),
(1268, 'Tronconi, Juan (Roque Pérez)', 1),
(1269, 'Tronge (Trenque Lauquen)', 1),
(1270, 'Tropezón (Tres de Febrero)', 1),
(1271, 'Turdera (Lomas de Zamora)', 1),
(1272, 'Tuyutí (San Andrés de Giles)', 1),
(1273, 'Udaondo (Cañuelas)', 1),
(1274, 'Udaquiola (Ayacucho)', 1),
(1275, 'Unión Ferroviaria (Par.) (E. Echeverría)', 1),
(1276, 'Unzué (Bolívar)', 1),
(1277, 'Unzué, Santos (9 de Julio)', 1),
(1278, 'Urdampilleta (Bolívar)', 1),
(1279, 'Uribelarrea (Cañuelas)', 1),
(1280, 'Urquiza (Pergamino)', 1),
(1281, 'Vagues (San Antonio de Areco)', 1),
(1282, 'Valdez (25 de Mayo)', 1),
(1283, 'Vallimanca (Bolívar)', 1),
(1284, 'Varela, Florencio (Florencio Varela)', 1),
(1285, 'Vateone, Arturo (Adolfo Alsina)', 1),
(1286, 'Vázquez (González Chaves )', 1),
(1287, 'Vedia (Leandro N. Alem)', 1),
(1288, 'Veinte de Junio (Matanza)', 1),
(1289, 'Veinticinco de Mayo (Veinticinco de Mayo)', 1),
(1290, 'Vela (Tandil)', 1),
(1291, 'Velloso (Tapalqué)', 1),
(1292, 'Vergara (Magdalena)', 1),
(1293, 'Verónica (Magdalena)', 1),
(1294, 'Víboras (Puán)', 1),
(1295, 'Victoria (San Fernando)', 1),
(1296, 'Victoria (Barrio) (Lomas de Zamora)', 1),
(1297, 'Vieytes (Magdalena)', 1),
(1298, 'Vigilancia (Lincoln)', 1),
(1299, 'Vilela (Las Flores)', 1),
(1300, 'Villa 1º de Mayo (Lanús)', 1),
(1301, 'Villa Adelina (San Isidro)', 1),
(1302, 'Villa Ader (San Martín)', 1),
(1303, 'Villa Aguado (San Martín)', 1),
(1304, 'Villa Albertina (Lomas de Zamora)', 1),
(1305, 'Villa Alegre (La Plata)', 1),
(1306, 'Villa Alemana (Morón)', 1),
(1307, 'Villa Alfonso XIII (Florencio Varela)', 1),
(1308, 'Villa Alianza (Tres de Febrero)', 1),
(1309, 'Villa Alida (Matanza)', 1),
(1310, 'Villa Alsina (Lanús)', 1),
(1311, 'Villa Amancay (Almirante Brown)', 1),
(1312, 'Villa Amato (Morón)', 1),
(1313, 'Villa Amelia (Merlo)', 1),
(1314, 'Villa Amianot (Tres de Febrero)', 1),
(1315, 'Villa Angélica (Lanús)', 1),
(1316, 'Villa Angus (Zárate)', 1),
(1317, 'Villa Ansaldi (San Martín)', 1),
(1318, 'Villa Ansaldo (Matanza)', 1),
(1319, 'Villa Argentina (Florencio Varela)', 1),
(1320, 'Villa Argentina (Quilmes)', 1),
(1321, 'Villa Argüello (Berisso)', 1),
(1322, 'Villa Arias (Coronel Rosales)', 1),
(1323, 'Villa Aristegui (Coronel Suárez)', 1),
(1324, 'Villa Ariza (Morón)', 1),
(1325, 'Villa Aurora (Lanús)', 1),
(1326, 'Villa Aurora (Florencio Varela)', 1),
(1327, 'Villa Ayacucho (Tres de Febrero)', 1),
(1328, 'Villa Ayarza (Chivilcoy)', 1),
(1329, 'Villa Baigorria (Tres de Febrero)', 1),
(1330, 'Villa Balcarce (Lanús)', 1),
(1331, 'Villa Balestra (Matanza)', 1),
(1332, 'Villa Ballester (San Martín)', 1),
(1333, 'Villa Banco Constructor (Berisso)', 1),
(1334, 'Villa Barboza (Tres de Febrero)', 1),
(1335, 'Villa Barceló (Avellaneda)', 1),
(1336, 'Villa Barilari (Avellaneda)', 1),
(1337, 'Villa Barrio Obrero (Berazategui)', 1),
(1338, 'Villa Barrio Parque (San Martín)', 1),
(1339, 'Villa Barrio U.T.A. (Tres de Febrero)', 1),
(1340, 'Villa Bartolomé Mitre (Avellaneda)', 1),
(1341, 'Villa Belgrano (Junín)', 1),
(1342, 'Villa Belgrano (Tres de Febrero)', 1),
(1343, 'Villa Beltrán (Tres de Febrero)', 1),
(1344, 'Villa Bengochea (Gral. Rodriguez)', 1),
(1345, 'Villa Bermúdez (Tres de Febrero)', 1),
(1346, 'Villa Bernasconi (Avellaneda)', 1),
(1347, 'Villa Billinghurst (San Martín)', 1),
(1348, 'Villa Bonich (SanMartín)', 1),
(1349, 'Villa Burgos (Rauch)', 1),
(1350, 'Villa Calzada (Almirante Brown)', 1),
(1351, 'Villa Cambiasso (Vicente López)', 1),
(1352, 'Villa Capdepont (Zárate)', 1),
(1353, 'Villa Carmen (Matanza)', 1),
(1354, 'Villa Casares (San Vicente)', 1),
(1355, 'Villa Castelino (Avellaneda)', 1),
(1356, 'Villa Catella (Ensenada)', 1),
(1357, 'Villa Celina (Matanza)', 1),
(1358, 'Villa Centenario (Laprida)', 1),
(1359, 'Villa Centenario (Lomas de Zamora)', 1),
(1360, 'Villa Churruca (Tres de febrero)', 1),
(1361, 'Villa Ciudad Jardín (Tres de Febrero)', 1),
(1362, 'Villa Coll (San Vicente)', 1);
INSERT INTO `localidades` (`id`, `nombre`, `id_provincia`) VALUES
(1363, 'Villa Concepción (San Martín)', 1),
(1364, 'Villa Constructora (Matanza)', 1),
(1365, 'Villa Corina (Avellaneda)', 1),
(1366, 'Villa Cramer (Quilmes)', 1),
(1367, 'Villa Cuarteles (Tres de Febrero)', 1),
(1368, 'Villa Da Fonte (Pergamino)', 1),
(1369, 'Villa Dálmine (Campana)', 1),
(1370, 'Villa Daza (Tandil)', 1),
(1371, 'Villa de los Granados (Tigre)', 1),
(1372, 'Villa de los Trabajadores (Lanús)', 1),
(1373, 'Villa de Mayo (Malvinas Argentinas)', 1),
(1374, 'Villa del Club (Morón)', 1),
(1375, 'Villa del Plata (Florencio Varela)', 1),
(1376, 'Villa del Valle (Lanús)', 1),
(1377, 'Villa del Vo (Coronel Suárez)', 1),
(1378, 'Villa Delfina (Bahía Blanca)', 1),
(1379, 'Villa Depietri (San Pedro)', 1),
(1380, 'Villa Derqui (Tres de Febrero)', 1),
(1381, 'Villa Dhiel (San Martín)', 1),
(1382, 'Villa Díaz Vélez (Necochea)', 1),
(1383, 'Villa Dolores (Berisso)', 1),
(1384, 'Villa Domínico (Avellaneda)', 1),
(1385, 'Villa Don Bosco (Matanza)', 1),
(1386, 'Villa Dufau (Tandil)', 1),
(1387, 'Villa Echenagucía (Avellaneda)', 1),
(1388, 'Villa Económica (Lomas de Zamora)', 1),
(1389, 'Villa Edén Argentino (Lomas de Zamora)', 1),
(1390, 'Villa El Rincón (Esteban Echeverría)', 1),
(1391, 'Villa Elisa (La Plata)', 1),
(1392, 'Villa Elsa (Quilmes)', 1),
(1393, 'Villa Elvira (La Plata)', 1),
(1394, 'Villa Elvira (Lomas de Zamora)', 1),
(1395, 'Villa Emma (Lomas de Zamora)', 1),
(1396, 'Villa Epumer (Adolfo Alsina)', 1),
(1397, 'Villa Eslovena (Lanús)', 1),
(1398, 'Villa Esmeralda (Quilmes)', 1),
(1399, 'Villa Esmeralda (San Martín)', 1),
(1400, 'Villa España (Berazategui)', 1),
(1401, 'Villa Esperanza (San Vicente)', 1),
(1402, 'Villa Esperanza (Almirante Brown)', 1),
(1403, 'Villa Esperanza (Morón)', 1),
(1404, 'Villa Espil (San Andrés de Giles)', 1),
(1405, 'Villa Estiú (Ensenada)', 1),
(1406, 'Villa Etchegaray (Coronel Suárez)', 1),
(1407, 'Villa Excelsior (Tres de Febrero)', 1),
(1408, 'Villa Fábricas (Matanza)', 1),
(1409, 'Villa Ficher (Lanús)', 1),
(1410, 'Villa Finca (Tres de Febrero)', 1),
(1411, 'Villa Florida (Zárate)', 1),
(1412, 'Villa Fortuna (San Vicente)', 1),
(1413, 'Villa Fortuna (Tres de Febrero)', 1),
(1414, 'Villa Fox (Zárate)', 1),
(1415, 'Villa Furts (San Martín)', 1),
(1416, 'Villa Galicia (Lomas de Zamora)', 1),
(1417, 'Villa Gallo (Morón)', 1),
(1418, 'Villa Gambaude (Gral. Rodriguez)', 1),
(1419, 'Villa Garibaldi (La Plata)', 1),
(1420, 'Villa Gattemeyer (Avellaneda)', 1),
(1421, 'Villa Gavarone (Lomas de Zamora)', 1),
(1422, 'Villa General Arias (Florencio Varela)', 1),
(1423, 'Villa General Belgano (Lanús)', 1),
(1424, 'Villa General Güemes (Lanús)', 1),
(1425, 'Villa General Necochea (San Martín)', 1),
(1426, 'Villa General Paz (Tres de Febrero)', 1),
(1427, 'Villa General San Martín (Florencio Varela)', 1),
(1428, 'Villa General Urquiza (Lanús)', 1),
(1429, 'Villa General Zapiola (Moreno)', 1),
(1430, 'Villa General Zapiola (San Martín)', 1),
(1431, 'Villa Giambruno (Berazategui)', 1),
(1432, 'Villa Giorello (Tres de Febrero)', 1),
(1433, 'Villa Gobernador Udaondo (Morón)', 1),
(1434, 'Villa Godoy (Pergamino)', 1),
(1435, 'Villa Godoy Cruz (San Martín)', 1),
(1436, 'Villa Gonnet (Avellaneda)', 1),
(1437, 'Villa Gonnet Bell (La Plata)', 1),
(1438, 'Villa Graciana (Quilmes)', 1),
(1439, 'Villa Granaderos (San Martín)', 1),
(1440, 'Villa Grassi (Matanza)', 1),
(1441, 'Villa Gregoria Matorras (San Martín)', 1),
(1442, 'Villa Griffero (Ensenada)', 1),
(1443, 'Villa Haydée (Avellaneda)', 1),
(1444, 'Villa Herminia (Tres de Febrero)', 1),
(1445, 'Villa Hidalgo (San Martín)', 1),
(1446, 'Villa Hipódromo (Lomas de Zamora)', 1),
(1447, 'Villa Humberto 1º (San Martín)', 1),
(1448, 'Villa Independencia (Berisso)', 1),
(1449, 'Villa Independencia (Lomas de Zamora)', 1),
(1450, 'Villa Independencia (Lanús)', 1),
(1451, 'Villa Industrial (Berisso)', 1),
(1452, 'Villa Industriales (Matanza)', 1),
(1453, 'Villa Industriales (Lanús)', 1),
(1454, 'Villa Insuperable (Matanza)', 1),
(1455, 'Villa Iparraguirre (San Martín)', 1),
(1456, 'Villa Iris (Puán)', 1),
(1457, 'Villa Italia (Bahía Blanca)', 1),
(1458, 'Villa Italia (Florencio Varela)', 1),
(1459, 'Villa José Ingenieros (Tres de Febrero)', 1),
(1460, 'Villa Kemmeter (Avellaneda)', 1),
(1461, 'Villa Klein (San Martín)', 1),
(1462, 'Villa La Crujía (San Martín)', 1),
(1463, 'Villa La Florida (Quilmes)', 1),
(1464, 'Villa La Loma (Rauch)', 1),
(1465, 'Villa La Noria (Lomas de Zamora)', 1),
(1466, 'Villa La Perla (Lomas de Zamora)', 1),
(1467, 'Villa La Perla (Quilmes)', 1),
(1468, 'Villa La Salada (Lomas de Zamora)', 1),
(1469, 'Villa La Tahona (San Isidro)', 1),
(1470, 'Villa Lacroze (San Martín)', 1),
(1471, 'Villa Las Fábricas (Matanza)', 1),
(1472, 'Villa Laura (Morón)', 1),
(1473, 'Villa Lavalle (Tres de Febrero)', 1),
(1474, 'Villa Laza (Tandil)', 1),
(1475, 'Villa Leoni (San Martín)', 1),
(1476, 'Villa Lía (San Antonio de Areco)', 1),
(1477, 'Villa Libertad (San Martín)', 1),
(1478, 'Villa Liniers (Tres de Febrero)', 1),
(1479, 'Villa Loma Verde (Matanza)', 1),
(1480, 'Villa López Romero (Florencio Varela)', 1),
(1481, 'Villa Los Tilos (La Plata)', 1),
(1482, 'Villa Luchetti (Tres de Febrero)', 1),
(1483, 'Villa Luzuriaga (Matanza)', 1),
(1484, 'Villa Lynch (San Martín)', 1),
(1485, 'Villa Lynch Pueyrredón (Bolívar)', 1),
(1486, 'Villa Madero (Matanza)', 1),
(1487, 'Villa Mafalda (Quilmes)', 1),
(1488, 'Villa Maipú (San Martín)', 1),
(1489, 'Villa Malaver (Moreno)', 1),
(1490, 'Villa Marconi (Lomas de Zamora)', 1),
(1491, 'Villa Marechal (San Martín)', 1),
(1492, 'Villa Margarita (Quilmes)', 1),
(1493, 'Villa Margarita (Adolfo Alsina)', 1),
(1494, 'Villa María (Ensenada)', 1),
(1495, 'Villa María (Alberti)', 1),
(1496, 'Villa María Irene (Tres de Febrero)', 1),
(1497, 'Villa Marta (Matanza)', 1),
(1498, 'Villa Martelli (Vicente López)', 1),
(1499, 'Villa Martín Fierro (Florencio Varela)', 1),
(1500, 'Villa Martínez de Hoz (Lanús)', 1),
(1501, 'Villa Massoni (Zárate)', 1),
(1502, 'Villa Matheu (Tres de Febrero)', 1),
(1503, 'Villa Matilde (Berazategui)', 1),
(1504, 'Villa Mauricio (Lanús)', 1),
(1505, 'Villa Mayo (Esteban Echeverría)', 1),
(1506, 'Villa Mitre (Bahía Blanca)', 1),
(1507, 'Villa Modelo (Avellaneda)', 1),
(1508, 'Villa Molino (Florencio Varela)', 1),
(1509, 'Villa Monroe (Tres de Febrero)', 1),
(1510, 'Villa Monteagudo (San Martín)', 1),
(1511, 'Villa Montecarlo (San Martín)', 1),
(1512, 'Villa Montero (Quilmes)', 1),
(1513, 'Villa Niza (Lomas de Zamora)', 1),
(1514, 'Villa Nocitc (Bahía Blanca)', 1),
(1515, 'Villa Nueva (Quilmes)', 1),
(1516, 'Villa Nueva Elisa (La Plata)', 1),
(1517, 'Villa Nueve de Julio (Tres de Febrero)', 1),
(1518, 'Villa Numancia (San Vicente)', 1),
(1519, 'Villa Obrera (Bahía Blanca)', 1),
(1520, 'Villa Obrera (Lanús)', 1),
(1521, 'Villa Olga (Bahía Blanca)', 1),
(1522, 'Villa París (Almirante Brown)', 1),
(1523, 'Villa Parque Roma (Almirante Brown)', 1),
(1524, 'Villa Paso Chico (Lanús)', 1),
(1525, 'Villa Patricio (Tres de Febrero)', 1),
(1526, 'Villa Paz (Lomas de Zamora)', 1),
(1527, 'Villa Peluffo (Matanza)', 1),
(1528, 'Villa Pergamino (Avellaneda)', 1),
(1529, 'Villa Piaggio (San Martín)', 1),
(1530, 'Villa Pineral (Tres de Febrero)', 1),
(1531, 'Villa Piñeyro (San Fernando)', 1),
(1532, 'Villa Pobladora (Avellaneda)', 1),
(1533, 'Villa Porteña (Berisso)', 1),
(1534, 'Villa Porvenir (Lomas de Zamora)', 1),
(1535, 'Villa Primavera (Quilmes)', 1),
(1536, 'Villa Progreso (San Martín)', 1),
(1537, 'Villa Pte. Quintana (Quilmes)', 1),
(1538, 'Villa Pte. Yrigoyen (Morón)', 1),
(1539, 'Villa Pueblo Nuevo (Laprida)', 1),
(1540, 'Villa Pueblo Nuevo (San Martín)', 1),
(1541, 'Villa Puente Alsina (Lanús)', 1),
(1542, 'Villa Puente Ezcurra (Matanza)', 1),
(1543, 'Villa Puerto Quequén (Necochea)', 1),
(1544, 'Villa Pueyrredón (San Martín)', 1),
(1545, 'Villa Raffo (Tres de Febrero)', 1),
(1546, 'Villa Ravazza (Matanza)', 1),
(1547, 'Villa Real (Tres de Febrero)', 1),
(1548, 'Villa Recondo (Matanza)', 1),
(1549, 'Villa Reconquista (Tres de Febrero)', 1),
(1550, 'Villa Recreo (Morón)', 1),
(1551, 'Villa Regina (Barrio) (Tigre)', 1),
(1552, 'Villa Reichembach (Morón)', 1),
(1553, 'Villa Revasa (Matanza)', 1),
(1554, 'Villa Riachuelo (Lomas de Zamora)', 1),
(1555, 'Villa Richmond (Tres de Febrero)', 1),
(1556, 'Villa Rico Tipo (Gral. Rodriguez)', 1),
(1557, 'Villa Risso (Tres de Febrero)', 1),
(1558, 'Villa Rivadavia (Quilmes)', 1),
(1559, 'Villa Rivera (La Plata)', 1),
(1560, 'Villa Rosa (Pilar)', 1),
(1561, 'Villa Rosario (Coronel Suárez)', 1),
(1562, 'Villa Rubencito (Ensenada)', 1),
(1563, 'Villa Saboya (Gral. Villagas)', 1),
(1564, 'Villa Sáenz Peña (Tres de Febrero)', 1),
(1565, 'Villa Sahores (Tres de Febrero)', 1),
(1566, 'Villa San Bernardo (Gral. Rodriguez)', 1),
(1567, 'Villa San Carlos (Berisso)', 1),
(1568, 'Villa San Francisco (Berazategui)', 1),
(1569, 'Villa San Martín (Lanús)', 1),
(1570, 'Villa San Pedro (Rauch)', 1),
(1571, 'Villa San Salvador (Berazategui)', 1),
(1572, 'Villa Sanguinetti (Moreno)', 1),
(1573, 'Villa Santa María de Oro (San Martín)', 1),
(1574, 'Villa Sanz (Bolívar)', 1),
(1575, 'Villa Sargento Cabral (Tes de Febrero)', 1),
(1576, 'Villa Sarina (Quilmes)', 1),
(1577, 'Villa Sarina (San Pedro)', 1),
(1578, 'Villa Sarmiento (Lanús)', 1),
(1579, 'Villa Sarmiento (Morón)', 1),
(1580, 'Villa Sauce (Gral. Villegas)', 1),
(1581, 'Villa Scasso (Matanza)', 1),
(1582, 'Villa Sena (Rivadavia)', 1),
(1583, 'Villa Siglo XX (San Isidro)', 1),
(1584, 'Villa Sobral (Quilmes)', 1),
(1585, 'Villa Sofía (San Vicente)', 1),
(1586, 'Villa Solferino (San Vicente)', 1),
(1587, 'Villa Spínola (Lanús)', 1),
(1588, 'Villa Stentor (Matanza)', 1),
(1589, 'Villa Susana (Florencio Varela)', 1),
(1590, 'Villa Talleres (Junín)', 1),
(1591, 'Villa Tessei (Morón)', 1),
(1592, 'Villa Toledo (Berazategui)', 1),
(1593, 'Villa Tranquila (Ensenada)', 1),
(1594, 'Villa Transradio (Esteban Echeverría)', 1),
(1595, 'Villa Udaondo (Morón)', 1),
(1596, 'Villa Urruti (Zárate)', 1),
(1597, 'Villa Vatteone (Florencio Varela)', 1),
(1598, 'Villa Vercelli (Quilmes)', 1),
(1599, 'Villa Versalles (San Vicente)', 1),
(1600, 'Villa Vetere (Lomas de Zamora)', 1),
(1601, 'Villa Vignart (Ensenada)', 1),
(1602, 'Villa Vitacal (Morón)', 1),
(1603, 'Villa Weigel (Tres de Febrero)', 1),
(1604, 'Villa Yapeyú (San Martín)', 1),
(1605, 'Villa Yuvone (Matanza)', 1),
(1606, 'Villa Zagala (San Martín)', 1),
(1607, 'Villa Zapiola (Moreno)', 1),
(1608, 'Villa Zula (Berisso)', 1),
(1609, 'Villafañe (Chacabuco)', 1),
(1610, 'VillaGaribaldi (Marcos Paz)', 1),
(1611, 'Villalonga (Patagones)', 1),
(1612, 'Villanueva (Gral. Paz)', 1),
(1613, 'Villarino Viejo (Villarino)', 1),
(1614, 'Villars (Gral. Las Heras)', 1),
(1615, 'Villegas (Gral. Villegas)', 1),
(1616, 'Villegas, J. (Matanza)', 1),
(1617, 'Viña (Bartolomé Mitre)', 1),
(1618, 'Virreyes (San Fernando)', 1),
(1619, 'Vitícola (Bahía Blanca)', 1),
(1620, 'Volta (Gral. Villegas)', 1),
(1621, 'Voluntad (Laprida)', 1),
(1622, 'Vuelta del Camino (San Nicolás)', 1),
(1623, 'Warnes (Bragado)', 1),
(1624, 'Wilde (Avellaneda)', 1),
(1625, 'Yerbas (Tapalqué)', 1),
(1626, 'Yutuyaco (Adolfo Alsina)', 1),
(1627, 'Zapiola (Lobos)', 1),
(1628, 'Zárate (Zárate)', 1),
(1629, 'Zavalía (Gral. Viamonte)', 1),
(1630, 'Zeballos, Estanislao (Florencio Varela)', 1),
(1631, 'Zelaya (Pilar)', 1),
(1632, 'Zentena (Coronel Suárez)', 1),
(1633, 'Zubiaurre (Coronel Dorrego)', 1),
(1634, 'San Miguel del Monte (Monte)', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
`id` int(11) NOT NULL,
  `contenido` varchar(200) DEFAULT NULL,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `autofecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mensaje` text
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mails`
--

INSERT INTO `mails` (`id`, `contenido`, `id_user`, `autofecha`, `mensaje`) VALUES
(3, 'MENSAJE', 22, '2018-03-25 18:10:23', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'),
(4, 'SUPER MENSAJE', 22, '2018-03-25 18:11:09', '<p><b>Lorem ipsum dolor sit amet</b>, <u>consectetur</u> adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>'),
(5, 'BIENVENIDA', 22, '2018-04-04 19:30:31', '<p>Estimado,</p><p><br></p><p>Le doy la Bienvenida al sistema de LITT creditos.</p><p>Es un placer poder comenzar a trabajar juntos.&nbsp;</p><p>Recuerde que ante cualquier duda puede contactarse conmigo o bien escribir directamente a comercios@litt.com.ar</p><p><br></p><p>Espero que su experiencia con nosotros sea de su agrado y mejore dia a dia.</p><p><br></p><p>Saludos cordiales,</p><p><br></p><p><b>Julian Bongiorno</b></p><p>Gerente Comercial</p><p>(011) 15-58866409&nbsp;<br></p><p>LITT Creditos.</p>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE IF NOT EXISTS `planes` (
`id` int(11) NOT NULL,
  `designacion` text NOT NULL,
  `interes_porcuota` float NOT NULL,
  `tna` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `designacion`, `interes_porcuota`, `tna`) VALUES
(1, 's/entrega', 0, 129),
(2, 'c/entrega', 3, 85);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
`id` int(11) NOT NULL,
  `designacion` text NOT NULL,
  `plan` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `monto_minimo` double NOT NULL,
  `monto_maximo` double NOT NULL,
  `plazo_minimo` int(11) NOT NULL,
  `plazo_maximo` int(11) NOT NULL,
  `tna` double NOT NULL,
  `habilitado` tinyint(4) NOT NULL,
  `nombre` varchar(191) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `designacion`, `plan`, `grupo`, `monto_minimo`, `monto_maximo`, `plazo_minimo`, `plazo_maximo`, `tna`, `habilitado`, `nombre`) VALUES
(1, 'PRODUCTO PRUEBA', 1, 1, 500, 6000, 5, 1, 85, 1, NULL),
(2, 'MICRO FEB-18', 1, 6, 300, 3000, 2, 4, 129, 1, NULL),
(3, 'MICRO FEB-18', 2, 6, 300, 3000, 2, 4, 85, 1, NULL),
(4, 'PRODUCTO', 1, 3, 500, 5000, 3, 6, 75, 1, NULL),
(5, 'PRODUCTO', 2, 3, 700, 8000, 4, 8, 120, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
`id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`) VALUES
(1, 'Buenos Aires');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibos`
--

CREATE TABLE IF NOT EXISTS `recibos` (
`id` int(11) NOT NULL,
  `autofecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `id_comercio` int(11) NOT NULL DEFAULT '0',
  `id_cliente` int(11) NOT NULL DEFAULT '0',
  `fecha` varchar(12) DEFAULT NULL,
  `monto` double NOT NULL,
  `cant_cuotas` int(11) NOT NULL DEFAULT '0',
  `gasto_otorgamiento` int(1) NOT NULL DEFAULT '0' COMMENT '1 es GO'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recibos`
--

INSERT INTO `recibos` (`id`, `autofecha`, `id_user`, `id_comercio`, `id_cliente`, `fecha`, `monto`, `cant_cuotas`, `gasto_otorgamiento`) VALUES
(1, '2018-03-17 16:22:03', 58, 1, 2, '20180317', 581, 1, 0),
(2, '2018-03-17 19:45:17', 59, 2, 1, '20180317', 5808, 2, 0),
(3, '2018-03-18 05:38:03', 59, 2, 1, '20180318', 2802, 6, 0),
(4, '2018-03-19 18:03:53', 59, 2, 1, '20180319', 2904, 1, 0),
(5, '2018-03-20 02:22:24', 58, 1, 5, '20180319', 929, 1, 0),
(6, '2018-03-20 02:23:15', 58, 0, 0, '20180319', 0, 0, 0),
(7, '2018-03-20 02:26:22', 58, 0, 0, '20180319', 0, 0, 0),
(8, '2018-03-20 02:27:01', 58, 1, 5, '20180319', 929, 1, 0),
(9, '2018-03-20 19:55:43', 59, 2, 1, '20180320', 1626, 1, 0),
(10, '2018-03-20 20:48:37', 59, 2, 1, '20180320', 1626, 1, 0),
(11, '2018-03-20 21:26:41', 59, 2, 1, '20180320', 2032, 1, 0),
(12, '2018-03-26 16:07:57', 59, 2, 1, '20180326', 4064, 2, 0),
(13, '2018-03-26 16:10:14', 59, 2, 1, '20180326', 2336, 2, 0),
(14, '2018-03-27 02:45:43', 59, 2, 8, '20180326', 2032, 1, 0),
(15, '2018-04-04 14:32:27', 58, 1, 9, '20180404', 1916, 4, 0),
(16, '2018-04-05 15:30:29', 59, 2, 8, '20180405', 2032, 1, 0),
(17, '2018-04-05 18:28:02', 59, 2, 8, '20180405', 2032, 1, 0),
(18, '2018-04-06 12:51:21', 58, 1, 11, '20180406', 959, 1, 0),
(19, '2018-04-06 12:52:04', 58, 1, 11, '20180406', 2877, 3, 0),
(20, '2018-04-10 22:41:29', 59, 2, 1, '20180410', 4672, 4, 0),
(21, '2018-04-10 23:16:32', 59, 2, 1, '20180410', 6096, 3, 0),
(22, '2018-04-10 23:47:20', 59, 2, 1, '20180410', 6096, 3, 0),
(23, '2018-04-10 23:49:13', 59, 2, 1, '20180410', 12192, 6, 0),
(24, '2018-04-10 23:50:08', 59, 2, 1, '20180410', 20, 0, 1),
(25, '2018-04-11 01:05:44', 59, 2, 1, '20180410', 20, 0, 1),
(26, '2018-04-11 01:15:34', 59, 2, 1, '20180410', 12192, 6, 0),
(27, '2018-04-11 01:21:13', 59, 2, 1, '20180410', 20, 0, 1),
(28, '2018-04-11 01:28:58', 59, 2, 1, '20180410', 6096, 3, 0),
(29, '2018-04-11 01:52:09', 59, 2, 15, '20180410', 20, 0, 1),
(30, '2018-04-11 02:01:17', 59, 2, 15, '20180410', 20, 0, 1),
(31, '2018-04-11 02:02:26', 59, 2, 15, '20180410', 2439, 3, 0),
(32, '2018-04-11 02:03:03', 59, 2, 15, '20180410', 20, 0, 1),
(33, '2018-04-11 03:07:37', 59, 2, 1, '20180411', 835, 1, 0),
(34, '2018-04-11 03:09:23', 59, 2, 1, '20180411', 835, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_pago`
--

CREATE TABLE IF NOT EXISTS `registro_pago` (
`id` int(11) unsigned NOT NULL,
  `ingreso_egreso` int(11) unsigned DEFAULT NULL,
  `id_movimiento` int(11) unsigned DEFAULT NULL,
  `id_entidad` int(11) unsigned DEFAULT NULL,
  `id_tipo_comprobante` int(11) unsigned DEFAULT NULL,
  `numero_comprobante` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monto` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iva` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_comprobante` tinyint(1) unsigned DEFAULT NULL,
  `fecha_hora` double DEFAULT NULL,
  `fecha_comprobante` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `registro_pago`
--

INSERT INTO `registro_pago` (`id`, `ingreso_egreso`, `id_movimiento`, `id_entidad`, `id_tipo_comprobante`, `numero_comprobante`, `monto`, `iva`, `file_comprobante`, `fecha_hora`, `fecha_comprobante`, `observaciones`) VALUES
(1, 0, 3, 2, 8, '1', '4750', NULL, NULL, 201803171539, '20180317', ''),
(2, 1, 3, 1, 8, '2', '580.855', NULL, NULL, 201803171835, '20180317', ''),
(3, 1, 3, 2, 8, '3', '2904.28', NULL, NULL, 201803180139, '20180318', ''),
(4, 1, 3, 2, 8, '3', '2904.28', NULL, NULL, 201803180139, '20180318', ''),
(5, 1, 3, 2, 8, '3', '467.356', NULL, NULL, 201803180139, '20180318', ''),
(6, 1, 3, 2, 8, '3', '467.356', NULL, NULL, 201803180139, '20180318', ''),
(7, 1, 3, 2, 8, '3', '467.356', NULL, NULL, 201803180139, '20180318', ''),
(8, 1, 3, 2, 8, '3', '467.356', NULL, NULL, 201803180139, '20180318', ''),
(9, 1, 3, 2, 8, '3', '467.356', NULL, NULL, 201803180139, '20180318', ''),
(10, 1, 3, 2, 8, '3', '467.356', NULL, NULL, 201803180139, '20180318', ''),
(11, 0, 9, 2, 7, '', '291', '', NULL, 201804051821, '2018/04/04', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reglas_litt`
--

CREATE TABLE IF NOT EXISTS `reglas_litt` (
`id` int(11) NOT NULL,
  `regla` text NOT NULL,
  `valor` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reglas_litt`
--

INSERT INTO `reglas_litt` (`id`, `regla`, `valor`) VALUES
(1, 'edad_minima', '18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rendiciones`
--

CREATE TABLE IF NOT EXISTS `rendiciones` (
`id` int(11) unsigned NOT NULL,
  `id_comercio` int(11) unsigned DEFAULT NULL,
  `fecha_limite_rendicion` int(11) unsigned DEFAULT NULL,
  `fecha_creacion` int(11) unsigned DEFAULT NULL,
  `monto_cuota` decimal(10,2) DEFAULT NULL,
  `monto_credito` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rendiciones`
--

INSERT INTO `rendiciones` (`id`, `id_comercio`, `fecha_limite_rendicion`, `fecha_creacion`, `monto_cuota`, `monto_credito`) VALUES
(1, 2, 20180317, 20180317, 0.00, 4750.00),
(2, 1, 20180317, 20180317, 580.86, 0.00),
(3, 2, 20180318, 20180318, 8612.70, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_comprobante`
--

CREATE TABLE IF NOT EXISTS `tipo_comprobante` (
`id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_comprobante`
--

INSERT INTO `tipo_comprobante` (`id`, `nombre`) VALUES
(1, 'FACTURA A'),
(2, 'FACTURA B'),
(3, 'FACTURA C'),
(4, 'NOTA DE CREDITO'),
(5, 'NOTA DE DEBITO'),
(6, 'NO TIENE'),
(7, 'RECIBO'),
(8, 'RENDICION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento`
--

CREATE TABLE IF NOT EXISTS `tipo_movimiento` (
`id` int(11) unsigned NOT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_padre` int(11) unsigned DEFAULT NULL,
  `observaciones` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_movimiento`
--

INSERT INTO `tipo_movimiento` (`id`, `nombre`, `id_padre`, `observaciones`) VALUES
(1, 'SUELDO', 1, 'NINGUNO'),
(2, 'INVERSIONES', 6, 'NIGNUNA'),
(3, 'RENDICION', 5, 'PROVIENE DE UNA RENDICION'),
(4, 'FLYER', 3, 'NIGUNA POR AHORA'),
(5, 'MUEBLES', 2, 'NIGUNA POR AHORA'),
(6, 'VARIOS', 4, 'NIGUNA POR AHORA'),
(7, 'SUELDOS', 1, 'GASTOS ASIGNADOS A SUELDOOS'),
(8, 'GESTION EXTRAJUDICIAL NO', 1, 'NATY ORTIZ'),
(9, 'HOSTING', 4, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_movimiento_padre`
--

CREATE TABLE IF NOT EXISTS `tipo_movimiento_padre` (
`id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `detalle` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_movimiento_padre`
--

INSERT INTO `tipo_movimiento_padre` (`id`, `nombre`, `detalle`) VALUES
(1, 'Gastos Sueldo', ''),
(2, 'Gastos Muebles', ''),
(3, 'Gastos Publicidad', ''),
(4, 'Gastos Varios', ''),
(5, 'Rendiciones', ''),
(6, 'Inversiones', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user` text NOT NULL,
  `pass` text NOT NULL,
  `level` int(11) NOT NULL,
`id` int(11) NOT NULL,
  `cuit` int(11) NOT NULL,
  `titular` text NOT NULL,
  `dni` text NOT NULL,
  `nombre_comercio` text NOT NULL,
  `id_comercio` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user`, `pass`, `level`, `id`, `cuit`, `titular`, `dni`, `nombre_comercio`, `id_comercio`) VALUES
('christian', '926e27eecdbc7a18858b3798ba99bddd', 1, 22, 0, 'Federico Bongiomo', '34777666', 'Nadia Buenos Aires', NULL),
('NADIABSAS', '5ade0f2629827f18ece0c5bc51ddf8ec', 3, 58, 0, 'FEDERICO BONGIORNO', '34905134', '', 1),
('PABLO', '81dc9bdb52d04dc20036dbd8313ed055', 3, 59, 0, 'PABLO CORZO', '34275214', '', 2),
('LUCAS', 'dc53fc4f621c80bdc2fa0329a6123708', 3, 60, 0, 'LUCAS', '32720619', '', 3),
('DECREDITOS', '81dc9bdb52d04dc20036dbd8313ed055', 3, 61, 0, 'CHRISTIAN SOLANO', '30707874259', '', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_comercio`
--
ALTER TABLE `categoria_comercio`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comercios`
--
ALTER TABLE `comercios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `convenios`
--
ALTER TABLE `convenios`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `convenios_grupos_habilitados`
--
ALTER TABLE `convenios_grupos_habilitados`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credito_instancia`
--
ALTER TABLE `credito_instancia`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuotas`
--
ALTER TABLE `cuotas`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entidades`
--
ALTER TABLE `entidades`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_liquidacion`
--
ALTER TABLE `estado_liquidacion`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_modulo`
--
ALTER TABLE `estado_modulo`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_mora`
--
ALTER TABLE `estado_mora`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `localidades`
--
ALTER TABLE `localidades`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mails`
--
ALTER TABLE `mails`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recibos`
--
ALTER TABLE `recibos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `registro_pago`
--
ALTER TABLE `registro_pago`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reglas_litt`
--
ALTER TABLE `reglas_litt`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rendiciones`
--
ALTER TABLE `rendiciones`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_movimiento_padre`
--
ALTER TABLE `tipo_movimiento_padre`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria_comercio`
--
ALTER TABLE `categoria_comercio`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `comercios`
--
ALTER TABLE `comercios`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `convenios`
--
ALTER TABLE `convenios`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `convenios_grupos_habilitados`
--
ALTER TABLE `convenios_grupos_habilitados`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `credito_instancia`
--
ALTER TABLE `credito_instancia`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `cuotas`
--
ALTER TABLE `cuotas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT de la tabla `entidades`
--
ALTER TABLE `entidades`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `estado_liquidacion`
--
ALTER TABLE `estado_liquidacion`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `estado_modulo`
--
ALTER TABLE `estado_modulo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estado_mora`
--
ALTER TABLE `estado_mora`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `localidades`
--
ALTER TABLE `localidades`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1635;
--
-- AUTO_INCREMENT de la tabla `mails`
--
ALTER TABLE `mails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `recibos`
--
ALTER TABLE `recibos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `registro_pago`
--
ALTER TABLE `registro_pago`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `reglas_litt`
--
ALTER TABLE `reglas_litt`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rendiciones`
--
ALTER TABLE `rendiciones`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_comprobante`
--
ALTER TABLE `tipo_comprobante`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tipo_movimiento`
--
ALTER TABLE `tipo_movimiento`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tipo_movimiento_padre`
--
ALTER TABLE `tipo_movimiento_padre`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
