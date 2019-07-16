-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-07-2019 a las 00:51:42
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cdi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `parroquia_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `descripcion`, `parroquia_id`, `persona_id`) VALUES
(1, 'Urb. Los Moriches', 4, 1),
(29, 'Urb Los Moriches', 4, 2),
(39, 'Urb. Los Moriches', 4, 3),
(44, 'Calle Bolívar', 1, 4),
(45, 'Calle Bolívar', 1, 5),
(56, 'Calle Bolívar', 1, 6),
(57, 'Calle Bolívar', 1, 7),
(58, 'Calle Bolívar', 1, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eav`
--

CREATE TABLE `eav` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `tipo` varchar(25) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `categoria` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eav`
--

INSERT INTO `eav` (`id`, `descripcion`, `tipo_id`, `tipo`, `cat_id`, `categoria`) VALUES
(1, 'No tiene', 1, 'No tiene', 1, 'No tiene'),
(2, 'Datos personal', 1, 'No tiene', 1, 'No tiene'),
(3, 'Cargos', 2, 'Datos personal', 1, 'No tiene'),
(4, 'Director(a)', 3, 'Cargos', 2, 'Datos personal'),
(5, 'Subdirector(a)', 3, 'Cargos', 2, 'Datos personal'),
(6, 'Docente Especialista', 3, 'Cargos', 2, 'Datos personal'),
(7, 'Secretaria(a)', 3, 'Cargos', 2, 'Datos personal'),
(8, 'Datos del niño', 1, 'No tiene', 1, 'No tiene'),
(9, 'Condiciones', 8, 'Datos del niño', 1, 'No tiene'),
(10, 'Alto Riesgo', 9, 'Condiciones', 8, 'Datos del niño'),
(11, 'Autismo', 9, 'Condiciones', 8, 'Datos del niño'),
(12, 'Ciego', 9, 'Condiciones', 8, 'Datos del niño'),
(13, 'Compromiso Cognitivo', 9, 'Condiciones', 8, 'Datos del niño'),
(14, 'Conductas Disruptivas', 9, 'Condiciones', 8, 'Datos del niño'),
(15, 'Def. Auditivo', 9, 'Condiciones', 8, 'Datos del niño'),
(16, 'Def. Visual', 9, 'Condiciones', 8, 'Datos del niño'),
(17, 'Deformidad Craneal Pariet', 9, 'Condiciones', 8, 'Datos del niño'),
(18, 'Dif. Concentración', 9, 'Condiciones', 8, 'Datos del niño'),
(19, 'Disfunción Motora', 9, 'Condiciones', 8, 'Datos del niño'),
(20, 'Hemiplejia', 9, 'Condiciones', 8, 'Datos del niño'),
(21, 'Hiperactividad', 9, 'Condiciones', 8, 'Datos del niño'),
(22, 'Hipoxia Ebcefalopatía', 9, 'Condiciones', 8, 'Datos del niño'),
(23, 'Imp. Físico', 9, 'Condiciones', 8, 'Datos del niño'),
(24, 'Lesión del Plano Raquial', 9, 'Condiciones', 8, 'Datos del niño'),
(25, 'Leucoma - Microftalmica', 9, 'Condiciones', 8, 'Datos del niño'),
(26, 'Microcefalia', 9, 'Condiciones', 8, 'Datos del niño'),
(27, 'Prob. Ámbito Familiar', 9, 'Condiciones', 8, 'Datos del niño'),
(28, 'Prob. Emocionales', 9, 'Condiciones', 8, 'Datos del niño'),
(29, 'Prob. Neurológico', 9, 'Condiciones', 8, 'Datos del niño'),
(30, 'Retardo del Desarrollo Ps', 9, 'Condiciones', 8, 'Datos del niño'),
(31, 'Retardo Global del Desarr', 9, 'Condiciones', 8, 'Datos del niño'),
(32, 'Síndrome Dandy Warker', 9, 'Condiciones', 8, 'Datos del niño'),
(33, 'SÍndrome de Down', 9, 'Condiciones', 8, 'Datos del niño'),
(34, 'Sordo', 9, 'Condiciones', 8, 'Datos del niño'),
(35, 'Trastorno de lenguaje.', 9, 'Condiciones', 8, 'Datos del niño'),
(36, 'T.D.A.H.', 9, 'Condiciones', 8, 'Datos del niño'),
(37, 'Datos de ingreso', 1, 'No tiene', 1, 'No tiene'),
(38, 'Estatus', 37, 'Datos de ingreso', 1, 'No tiene'),
(39, 'Activo', 38, 'Estatus', 37, 'Datos de ingreso'),
(40, 'Inactivo', 38, 'Estatus', 37, 'Datos de ingreso'),
(41, 'Datos de representante', 1, 'No tiene', 1, 'No tiene'),
(42, 'Parentesco', 41, 'Datos de representante', 1, 'No tiene'),
(43, 'Madre', 42, 'Parentesco', 41, 'Datos de representante'),
(44, 'Padre', 42, 'Parentesco', 41, 'Datos de representante'),
(45, 'Otros', 42, 'Parentesco', 41, 'Datos de representante'),
(46, 'Datos de usuario', 1, 'No tiene', 1, 'No tiene'),
(47, 'Roles', 46, 'Datos de usuario', 1, 'No tiene'),
(48, 'Administrador', 47, 'Roles', 46, 'Datos de usuario'),
(49, 'Usuario', 47, 'Roles', 46, 'Datos de usuario'),
(50, 'Datos socioeconomicos', 1, 'No tiene', 1, 'No tiene'),
(51, 'Vivienda', 50, 'Datos socioeconomicos', 1, 'No tiene'),
(52, 'Casa', 51, 'Vivienda', 50, 'Datos socioeconomicos'),
(53, 'Quinta', 51, 'Vivienda', 50, 'Datos socioeconomicos'),
(54, 'Apto', 51, 'Vivienda', 50, 'Datos socioeconomicos'),
(55, 'Rural', 51, 'Vivienda', 50, 'Datos socioeconomicos'),
(56, 'Rancho', 51, 'Vivienda', 50, 'Datos socioeconomicos'),
(57, 'Pertenencia', 50, 'Datos socioeconomicos', 1, 'No tiene'),
(58, 'Propia', 57, 'Pertenencia', 50, 'Datos socioeconomicos'),
(59, 'Alquilada', 57, 'Pertenencia', 50, 'Datos socioeconomicos'),
(60, 'Familiar', 57, 'Pertenencia', 50, 'Datos socioeconomicos'),
(61, 'Condicion', 50, 'Datos socioeconomicos', 1, 'No tiene'),
(62, 'Buena', 61, 'Condicion', 50, 'Datos socioeconomicos'),
(63, 'Regular', 61, 'Condicion', 50, 'Datos socioeconomicos'),
(64, 'Mala', 61, 'Condicion', 50, 'Datos socioeconomicos'),
(65, 'Servicios', 50, 'Datos socioeconomicos', 1, 'No tiene'),
(66, 'Agua', 65, 'Servicios', 50, 'Datos socioeconomicos'),
(67, 'Luz', 65, 'Servicios', 50, 'Datos socioeconomicos'),
(68, 'Aseo', 65, 'Servicios', 50, 'Datos socioeconomicos'),
(69, 'Posesiones', 50, 'Datos socioeconomicos', 1, 'No tiene'),
(70, 'Radio', 69, 'Posesiones', 50, 'Datos socioeconomicos'),
(71, 'TV', 69, 'Posesiones', 50, 'Datos socioeconomicos'),
(72, 'Computadora', 69, 'Posesiones', 50, 'Datos socioeconomicos'),
(73, 'Pediatra', 3, 'Cargos', 2, 'Datos personal'),
(74, 'Fisioterapeuta', 3, 'Cargos', 2, 'Datos personal'),
(75, 'Terapista de Lenguaje', 3, 'Cargos', 2, 'Datos personal'),
(76, 'Psicólogo', 3, 'Cargos', 2, 'Datos personal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedientes`
--

CREATE TABLE `expedientes` (
  `id` int(11) NOT NULL,
  `fecha_expediente` datetime DEFAULT NULL,
  `descripcion` longtext,
  `nino_id` int(11) DEFAULT NULL,
  `docente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ninos`
--

CREATE TABLE `ninos` (
  `id` int(11) NOT NULL,
  `nivel_educ` varchar(100) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `persona_id` int(11) NOT NULL,
  `representante_id` int(11) NOT NULL,
  `estatus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ninos`
--

INSERT INTO `ninos` (`id`, `nivel_educ`, `fecha_ingreso`, `persona_id`, `representante_id`, `estatus_id`) VALUES
(1, 'Inicial', '2019-07-16', 6, 4, 39),
(2, 'Inicial', '2019-07-01', 7, 4, 39),
(3, 'Inicial', '2019-07-03', 8, 4, 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nino_condicion`
--

CREATE TABLE `nino_condicion` (
  `id` int(11) NOT NULL,
  `nino_id` int(11) NOT NULL,
  `condicion_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nino_condicion`
--

INSERT INTO `nino_condicion` (`id`, `nino_id`, `condicion_id`) VALUES
(1, 1, 18),
(2, 2, 16),
(3, 3, 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nino_docente`
--

CREATE TABLE `nino_docente` (
  `id` int(11) NOT NULL,
  `nino_id` int(11) NOT NULL,
  `docente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nino_docente`
--

INSERT INTO `nino_docente` (`id`, `nino_id`, `docente_id`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parroquias`
--

INSERT INTO `parroquias` (`id`, `descripcion`) VALUES
(1, 'Alto de los Godos'),
(2, 'Boquerón'),
(3, 'Las Cocuizas'),
(4, 'La Cruz'),
(5, 'San Simón'),
(6, 'El Corozo'),
(7, 'El Furrial'),
(8, 'Jusepín'),
(9, 'La Pica'),
(10, 'San Vicente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `profesion` varchar(100) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estatus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id`, `persona_id`, `telefono`, `profesion`, `cargo_id`, `fecha_ingreso`, `estatus_id`) VALUES
(1, 1, '04249189923', 'TSU en Informática', 4, '2019-07-04', 39),
(2, 2, '02923311644', 'Profesora lengua y literatura', 6, '2017-12-04', 39),
(3, 3, '02923311644', 'Lcda en Educación', 6, '2015-02-04', 39);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `sexo` varchar(100) DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `lugar_nac` varchar(100) DEFAULT NULL,
  `cedula` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id`, `nombre`, `apellido`, `sexo`, `fecha_nac`, `lugar_nac`, `cedula`) VALUES
(1, 'Jesús', 'Rodríguez', 'Masculino', '1998-04-10', 'Caicara', '26997629'),
(2, 'Mariángela', 'Rodriguez', 'N/A', '2019-07-05', 'CDI Usuario', '22708373'),
(3, 'Maria', 'Figuera', 'N/A', '2019-07-05', 'CDI Usuario', '9898255'),
(4, 'Karla', 'Moza', '', '1989-07-01', '', '8989552'),
(5, 'Victor', 'Alfonzo', '', '1989-07-01', '', '8989551'),
(6, 'Jose Alejandro', 'Alfonzo', 'Masculino', '2017-04-10', 'Maturín', '8989552-01'),
(7, 'Alberto', 'Moza', 'Masculino', '2017-02-21', 'Maturín', '8989552-02'),
(8, 'Andrea', 'Moza', 'Femenino', '2017-06-26', 'Maturín', '8989552-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL,
  `parentesco_id` int(100) DEFAULT NULL,
  `profesion` varchar(100) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `legal` varchar(2) DEFAULT NULL,
  `depende_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `persona_id`, `parentesco_id`, `profesion`, `telefono`, `legal`, `depende_id`) VALUES
(4, 4, 43, 'Ambientalista', '04241122333', 'Si', NULL),
(5, 5, 44, 'Albañil', '04242233444', 'No', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socioeconomico`
--

CREATE TABLE `socioeconomico` (
  `id` int(11) NOT NULL,
  `vivienda` int(11) NOT NULL,
  `pertenece` int(11) NOT NULL,
  `condicion` int(11) NOT NULL,
  `agua` int(11) NOT NULL,
  `luz` int(11) NOT NULL,
  `aseo` int(11) NOT NULL,
  `otroServicio` mediumtext,
  `radio` int(11) NOT NULL,
  `tv` int(11) NOT NULL,
  `pc` int(11) NOT NULL,
  `otroBien` mediumtext,
  `nino_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `socioeconomico`
--

INSERT INTO `socioeconomico` (`id`, `vivienda`, `pertenece`, `condicion`, `agua`, `luz`, `aseo`, `otroServicio`, `radio`, `tv`, `pc`, `otroBien`, `nino_id`) VALUES
(1, 52, 58, 62, 1, 1, 68, 'DirecTV', 70, 1, 1, 'PlayStation 4', 1),
(2, 52, 60, 62, 66, 67, 68, '', 70, 71, 72, '', 2),
(3, 52, 59, 62, 66, 67, 1, 'Netflix', 1, 71, 72, '', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` int(8) NOT NULL,
  `clave` int(16) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `persona_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `clave`, `rol_id`, `persona_id`) VALUES
(1, 26997629, 26997629, 48, 1),
(7, 22708373, 22708373, 49, 2),
(8, 9898255, 9898255, 49, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `persona_id_2` (`persona_id`),
  ADD KEY `parroquia_id` (`parroquia_id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `eav`
--
ALTER TABLE `eav`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `tipo_id` (`tipo_id`);

--
-- Indices de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_personas` (`nino_id`),
  ADD KEY `docente_id` (`docente_id`);

--
-- Indices de la tabla `ninos`
--
ALTER TABLE `ninos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `representante_id` (`representante_id`),
  ADD KEY `estatus_id` (`estatus_id`);

--
-- Indices de la tabla `nino_condicion`
--
ALTER TABLE `nino_condicion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nino_id` (`nino_id`),
  ADD KEY `condicion_id` (`condicion_id`);

--
-- Indices de la tabla `nino_docente`
--
ALTER TABLE `nino_docente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nino_id` (`nino_id`),
  ADD KEY `docente_id` (`docente_id`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `personal_ibfk_2` (`cargo_id`),
  ADD KEY `estatus_id` (`estatus_id`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persona_id` (`persona_id`),
  ADD KEY `parentesco_id` (`parentesco_id`),
  ADD KEY `depende_id` (`depende_id`);

--
-- Indices de la tabla `socioeconomico`
--
ALTER TABLE `socioeconomico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vivienda` (`vivienda`),
  ADD KEY `pertenece` (`pertenece`),
  ADD KEY `condicion` (`condicion`),
  ADD KEY `agua` (`agua`),
  ADD KEY `aseo` (`aseo`),
  ADD KEY `luz` (`luz`),
  ADD KEY `radio` (`radio`),
  ADD KEY `tv` (`tv`),
  ADD KEY `pc` (`pc`),
  ADD KEY `nino_id` (`nino_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_id` (`rol_id`),
  ADD KEY `personal_id` (`persona_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `eav`
--
ALTER TABLE `eav`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `ninos`
--
ALTER TABLE `ninos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nino_condicion`
--
ALTER TABLE `nino_condicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `nino_docente`
--
ALTER TABLE `nino_docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `socioeconomico`
--
ALTER TABLE `socioeconomico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `direcciones_ibfk_1` FOREIGN KEY (`parroquia_id`) REFERENCES `parroquias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `direcciones_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `eav`
--
ALTER TABLE `eav`
  ADD CONSTRAINT `eav_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eav_ibfk_2` FOREIGN KEY (`tipo_id`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD CONSTRAINT `expedientes_ibfk_1` FOREIGN KEY (`nino_id`) REFERENCES `ninos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expedientes_ibfk_2` FOREIGN KEY (`docente_id`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ninos`
--
ALTER TABLE `ninos`
  ADD CONSTRAINT `ninos_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ninos_ibfk_2` FOREIGN KEY (`representante_id`) REFERENCES `representantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ninos_ibfk_3` FOREIGN KEY (`estatus_id`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nino_condicion`
--
ALTER TABLE `nino_condicion`
  ADD CONSTRAINT `nino_condicion_ibfk_1` FOREIGN KEY (`nino_id`) REFERENCES `ninos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nino_condicion_ibfk_2` FOREIGN KEY (`condicion_id`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nino_docente`
--
ALTER TABLE `nino_docente`
  ADD CONSTRAINT `nino_docente_ibfk_1` FOREIGN KEY (`nino_id`) REFERENCES `ninos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nino_docente_ibfk_2` FOREIGN KEY (`docente_id`) REFERENCES `personal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_ibfk_3` FOREIGN KEY (`estatus_id`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `representantes_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `representantes_ibfk_2` FOREIGN KEY (`parentesco_id`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `representantes_ibfk_3` FOREIGN KEY (`depende_id`) REFERENCES `representantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `socioeconomico`
--
ALTER TABLE `socioeconomico`
  ADD CONSTRAINT `socioeconomico_ibfk_1` FOREIGN KEY (`agua`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_10` FOREIGN KEY (`nino_id`) REFERENCES `ninos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_2` FOREIGN KEY (`aseo`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_3` FOREIGN KEY (`condicion`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_4` FOREIGN KEY (`luz`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_5` FOREIGN KEY (`pc`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_6` FOREIGN KEY (`pertenece`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_7` FOREIGN KEY (`radio`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_8` FOREIGN KEY (`tv`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `socioeconomico_ibfk_9` FOREIGN KEY (`vivienda`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `eav` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
