-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-07-2019 a las 06:33:57
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
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `descripcion`) VALUES
(1, 'Director(a)'),
(2, ' Subdirector(a)'),
(3, 'Docente'),
(4, 'Secretaria.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones`
--

CREATE TABLE `condiciones` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `condiciones`
--

INSERT INTO `condiciones` (`id`, `descripcion`) VALUES
(1, 'Sindrome de down'),
(2, 'Asperger'),
(3, 'Autismo'),
(5, 'Deficiencia Visual\r\n'),
(6, 'Deficiencia Auditiva\r\n'),
(7, 'Alto Riesgo'),
(8, 'Deficit de atencion\r\n'),
(9, 'Condiciones motoras');

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
(1, 'Calle Girardot', 4, 2),
(2, 'Calle Nueva', 4, 3),
(3, 'Calle Azcue', 1, 4),
(4, 'Urb Moriche', 4, 1),
(5, 'Urb Los Moriches III', 4, 5),
(6, 'Urb Los Moriches', 4, 6),
(8, 'Av. Principal', 8, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus`
--

CREATE TABLE `estatus` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estatus`
--

INSERT INTO `estatus` (`id`, `descripcion`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

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
(1, 'Maternal II', '2019-07-06', 3, 1, 2),
(2, 'Inicial', '2019-07-07', 6, 2, 1);

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
(1, 1, 5),
(2, 2, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nino_docente`
--

CREATE TABLE `nino_docente` (
  `id` int(11) NOT NULL,
  `nino_id` int(11) NOT NULL,
  `docente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nino_docente`
--

INSERT INTO `nino_docente` (`id`, `nino_id`, `docente_id`) VALUES
(1, 1, 4),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parentesco`
--

CREATE TABLE `parentesco` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `parentesco`
--

INSERT INTO `parentesco` (`id`, `descripcion`) VALUES
(1, 'Padre'),
(2, 'Madre'),
(3, 'Representante legal'),
(4, 'Otro');

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
(1, 1, '04249189923', 'TSU en Informática', 1, '2019-07-04', 1),
(2, 4, '02923311625', 'T.S.U. en Informatica', 3, '2019-07-06', 1),
(4, 8, '02923311625', 'Doctora en Leyes', 3, '2019-07-07', 2);

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
(1, 'Jesús', 'Rodríguez', NULL, '1998-04-10', 'Caicara', '26997629'),
(2, 'Carmen Luisa', 'Perez', '', '1998-03-20', '', '26157490'),
(3, 'Carlos Jose', 'Perez Jimenes', 'Masculino', '2018-12-12', 'Jusepin', '26157490-01'),
(4, 'Juan', 'Romero', 'N/A', '2019-07-05', 'CDI Usuario', '8989225'),
(5, 'María Milagro', 'Figuera Sotillo', '', '1968-11-27', '', '9898255'),
(6, 'Mariangela', 'Rodríguez', 'Femenino', '2018-02-12', 'Maturín', '9898255-01'),
(8, 'Marta', 'Cañaberal', 'N/A', '2019-07-05', 'CDI Usuario', '22708373');

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
  `nivel_acad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id`, `persona_id`, `parentesco_id`, `profesion`, `telefono`, `nivel_acad`) VALUES
(1, 2, 2, 'T.S.U. Gestión en Salud Publica', '02923311625', ''),
(2, 5, 2, 'Docente', '04249105993', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `descripcion`) VALUES
(1, 'Administrador'),
(2, 'Usuario');

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
(1, 26997629, 26997629, 1, 1),
(2, 8989225, 8989225, 2, 4),
(4, 22708373, 22708373, 2, 8);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `condiciones`
--
ALTER TABLE `condiciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parroquia_id` (`parroquia_id`),
  ADD KEY `persona_id` (`persona_id`);

--
-- Indices de la tabla `estatus`
--
ALTER TABLE `estatus`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `cargo_id` (`cargo_id`),
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
  ADD KEY `parentesco_id` (`parentesco_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `condiciones`
--
ALTER TABLE `condiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estatus`
--
ALTER TABLE `estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ninos`
--
ALTER TABLE `ninos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nino_condicion`
--
ALTER TABLE `nino_condicion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `nino_docente`
--
ALTER TABLE `nino_docente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parentesco`
--
ALTER TABLE `parentesco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Filtros para la tabla `ninos`
--
ALTER TABLE `ninos`
  ADD CONSTRAINT `ninos_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ninos_ibfk_2` FOREIGN KEY (`representante_id`) REFERENCES `representantes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ninos_ibfk_3` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `nino_condicion`
--
ALTER TABLE `nino_condicion`
  ADD CONSTRAINT `nino_condicion_ibfk_1` FOREIGN KEY (`nino_id`) REFERENCES `ninos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nino_condicion_ibfk_2` FOREIGN KEY (`condicion_id`) REFERENCES `condiciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `personal_ibfk_2` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personal_ibfk_3` FOREIGN KEY (`estatus_id`) REFERENCES `estatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `representantes_ibfk_1` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `representantes_ibfk_2` FOREIGN KEY (`parentesco_id`) REFERENCES `parentesco` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
