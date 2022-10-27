-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2022 a las 21:23:47
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `evaluer`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `reset_increment` ()   BEGIN



ALTER TABLE administrador AUTO_INCREMENT = 0;

ALTER TABLE anteproyecto AUTO_INCREMENT = 0;

ALTER TABLE post AUTO_INCREMENT = 0;

ALTER TABLE coordinador AUTO_INCREMENT = 0;

ALTER TABLE asesor AUTO_INCREMENT = 0;

ALTER TABLE estudiante AUTO_INCREMENT = 0;

ALTER TABLE programa AUTO_INCREMENT = 0;

ALTER TABLE propuesta AUTO_INCREMENT = 0;

ALTER TABLE proyecto_grado AUTO_INCREMENT = 0;

ALTER TABLE rol AUTO_INCREMENT = 0;

ALTER TABLE usuario AUTO_INCREMENT = 0;

ALTER TABLE grupo AUTO_INCREMENT = 0;

ALTER TABLE linea_investigacion AUTO_INCREMENT = 0;

ALTER TABLE pqr AUTO_INCREMENT = 0;

ALTER TABLE material_academico AUTO_INCREMENT = 0;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(4) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `email`, `usuario`, `contraseña`, `usuario_id`) VALUES
(1, 'Administrador-Aunar', 'admin@aunar.edu.co', '1234567890', '$2y$10$p2HJq8dMMPW/nsJb..eg7eYIAkVKiJ5.jMZtBkLv/0eQ385SFJ2gG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anteproyecto`
--

CREATE TABLE `anteproyecto` (
  `id` int(6) NOT NULL,
  `titulo` varchar(500) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `documento` varchar(400) NOT NULL,
  `comentarios` varchar(500) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `programa_id` varchar(11) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `remitente` varchar(50) NOT NULL,
  `estado` varchar(80) NOT NULL,
  `calificacion` varchar(10) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor`
--

CREATE TABLE `asesor` (
  `id` int(4) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `p_apellido` varchar(80) NOT NULL,
  `s_apellido` varchar(80) NOT NULL,
  `cedula` varchar(14) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` int(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asesor`
--

INSERT INTO `asesor` (`id`, `nombres`, `p_apellido`, `s_apellido`, `cedula`, `programa`, `email`, `telefono`, `usuario`, `usuario_id`) VALUES
(1, 'Andres', 'Pérez', 'García', '0987654321', 'INGENIERÍA INFORMÁTICA', 'andres@gmail.com', 2147483647, '0987654321', 12),
(2, 'Carlos', 'Gomez', 'Pereira', '3333333334', 'CONTADURÍA PÚBLICA', 'carlos@gmail.com', 2147483647, '3333333334', 13),
(3, 'Justo', 'Alfaro', 'Vega', '4543663321', 'INGENIERÍA INFORMÁTICA', 'justoalfaro@gmail.com', 2147483647, '4543663321', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinador`
--

CREATE TABLE `coordinador` (
  `id` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `p_apellido` varchar(100) NOT NULL,
  `s_apellido` varchar(100) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` int(20) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `coordinador`
--

INSERT INTO `coordinador` (`id`, `nombres`, `p_apellido`, `s_apellido`, `cedula`, `programa`, `email`, `telefono`, `usuario`, `usuario_id`) VALUES
(1, 'Mauricio', 'Castro', 'Nuñez', '8888888888', 'INGENIERÍA INFORMÁTICA', 'mauricioc@gmail.com', 2147483647, '8888888888', 3),
(2, 'Manuel', 'Gomez', 'Madera', '1432498292', 'CONTADURÍA PÚBLICA', 'manuelgm@gmail.com', 2147483647, '1432498292', 4),
(3, 'Jorge', 'Perez', 'Madera', '5555555554', 'COCINA INTERNACIONAL', 'jorgeq@gmail.com', 2147483647, '5555555554', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(4) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `p_apellido` varchar(20) NOT NULL,
  `s_apellido` varchar(20) NOT NULL,
  `tipo_di` varchar(7) NOT NULL,
  `cedula` varchar(14) NOT NULL,
  `programa` varchar(60) NOT NULL,
  `semestre` int(2) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `asesor` varchar(100) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `nombre`, `p_apellido`, `s_apellido`, `tipo_di`, `cedula`, `programa`, `semestre`, `telefono`, `email`, `usuario`, `asesor`, `usuario_id`, `grupo_id`) VALUES
(1, 'Sergio', 'Mercado', 'Salazar', '', '1143411234', 'INGENIERÍA INFORMÁTICA', 9, '2147483647', 'mercadosergio@gmail.com', '1143411234', '', 2, 2),
(2, 'Oscar', 'Garces', 'Gomez', '', '1777777777', 'INGENIERÍA INFORMÁTICA', 9, '2147483647', 'oscargg@gmail.com', '1777777777', '', 6, 2),
(3, 'Juan', 'Llanos', 'Gaviria', '', '1010101010', 'CONTADURÍA PÚBLICA', 8, '3101923456', 'juanl1@gmail.com', '1010101010', '', 7, 1),
(4, 'Victor', 'Padilla', 'Zuñiga', '', '1878787878', 'INGENIERÍA INFORMÁTICA', 7, '3019478565', '', '1878787878', '', 8, 1),
(5, 'Daniel', 'Yepes', 'Garcia', '', '1209345555', 'CONTADURÍA PÚBLICA', 7, '3211234567', 'daniel@gmail.com', '1209345555', '', 9, 1),
(6, 'Maria', 'Bettin', 'Larios', '', '1244344347', 'CONTADURÍA PÚBLICA', 8, '3041234567', 'mariabet@gmail.com', '1244344347', '', 10, 1),
(7, 'Juan', 'Fernandez', 'Valdes', '', '1432543234', 'COCINA INTERNACIONAL', 6, '', '', '1432543234', '', 11, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `project_name` varchar(200) NOT NULL,
  `programa` varchar(50) NOT NULL,
  `semestre` int(11) NOT NULL,
  `periodo` varchar(11) NOT NULL,
  `n_integrantes` int(2) NOT NULL,
  `nombre_integrante1` varchar(100) NOT NULL,
  `di_integrante1` bigint(20) NOT NULL,
  `nombre_integrante2` varchar(100) NOT NULL,
  `di_integrante2` bigint(20) NOT NULL,
  `nombre_integrante3` varchar(100) NOT NULL,
  `di_integrante3` bigint(20) NOT NULL,
  `fecha_creado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `time_propuesta` int(11) NOT NULL,
  `time_anteproyecto` int(11) NOT NULL,
  `time_proyecto` int(11) NOT NULL,
  `nombre_asesor` varchar(100) NOT NULL,
  `asesor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `project_name`, `programa`, `semestre`, `periodo`, `n_integrantes`, `nombre_integrante1`, `di_integrante1`, `nombre_integrante2`, `di_integrante2`, `nombre_integrante3`, `di_integrante3`, `fecha_creado`, `time_propuesta`, `time_anteproyecto`, `time_proyecto`, `nombre_asesor`, `asesor_id`) VALUES
(1, '', '', 0, '', 0, '', 0, '', 0, '', 0, '2022-10-27 05:06:31', 0, 0, 0, '', 0),
(2, '', 'INGENIERÍA INFORMÁTICA', 9, '2022 - 2', 2, 'Sergio Mercado', 1143411234, 'Oscar Garces', 1777777777, ' ', 0, '2022-10-27 18:33:15', 0, 0, 0, 'Andres Pérez', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_investigacion`
--

CREATE TABLE `linea_investigacion` (
  `id` int(11) NOT NULL,
  `linea` varchar(200) NOT NULL,
  `objetivos` varchar(200) NOT NULL,
  `sublinea` varchar(200) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `coordinador_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `linea_investigacion`
--

INSERT INTO `linea_investigacion` (`id`, `linea`, `objetivos`, `sublinea`, `programa`, `created_at`, `coordinador_id`) VALUES
(1, 'ANÁLISIS, DISEÑO, DESARROLLO E IMPLEMENTACIÓN DE APLICACIONES MÓVILES', 'Implementar Aplicaciones Móviles que brinden solución a las necesidades de los usuarios.', 'Aplicaciones móviles hibridas', 'INGENIERIA INFORMATICA', '2022-10-22 01:11:17', 1),
(2, 'ANÁLISIS, DISEÑO, DESARROLLO E IMPLEMENTACIÓN DE APLICACIONES MÓVILES', 'Implementar Aplicaciones Móviles que brinden solución a las necesidades de los usuarios.', 'Aplicaciones móviles Nativas', 'INGENIERIA INFORMATICA', '2022-10-22 01:11:17', 1),
(3, 'ANÁLISIS, DISEÑO, DESARROLLO E IMPLEMENTACIÓN DE SOFTWARE WEB', 'Brindar soluciones informáticas, destinadas a automatizar procesos mediante software a la medida.', 'Análisis, diseño y desarrollo de aplicaciones Web', 'INGENIERÍA INFORMÁTICA', '2022-10-22 02:19:39', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_academico`
--

CREATE TABLE `material_academico` (
  `id` int(11) NOT NULL,
  `ruta` varchar(200) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `asesor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(20) NOT NULL,
  `contenido` varchar(400) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `programa_id` int(20) NOT NULL,
  `nombre_usuario` varchar(70) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `docente_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqr`
--

CREATE TABLE `pqr` (
  `id` int(11) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `contenido` varchar(300) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nombre_usuario` varchar(100) NOT NULL,
  `apellido_usuario` varchar(100) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `codigo_snies` varchar(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `modalidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id`, `codigo`, `nombre`, `codigo_snies`, `duracion`, `modalidad`) VALUES
(1, 'CD010', 'INGENIERÍA INFORMÁTICA', '109334', 9, 'Presencial'),
(2, 'CD030', 'CONTADURÍA PÚBLICA', '103461', 9, 'Presencial'),
(4, 'CD020', 'COCINA INTERNACIONAL', '', 3, 'Presencial'),
(6, 'CD110', 'DECORACIÓN DE INTERIORES', '', 6, 'Presencial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propuesta`
--

CREATE TABLE `propuesta` (
  `id` int(4) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `linea` varchar(250) NOT NULL,
  `integrantes` int(1) NOT NULL,
  `tutor` varchar(60) NOT NULL,
  `lider` varchar(60) NOT NULL,
  `programa` varchar(70) NOT NULL,
  `programa_id` varchar(20) NOT NULL,
  `semestre` int(2) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `miembro1` varchar(200) NOT NULL,
  `miembro2` varchar(200) DEFAULT NULL,
  `miembro3` varchar(200) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` varchar(40) NOT NULL,
  `remitente` varchar(40) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_grado`
--

CREATE TABLE `proyecto_grado` (
  `id` int(11) NOT NULL,
  `titulo` varchar(500) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `documento` varchar(500) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `programa_id` varchar(5) NOT NULL,
  `semestre` int(2) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `remitente` varchar(50) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `calificacion` varchar(5) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `asesor_id` int(11) DEFAULT NULL,
  `asesor` varchar(200) NOT NULL,
  `jurado1` varchar(100) NOT NULL,
  `jurado2` varchar(100) NOT NULL,
  `jurado3` varchar(100) NOT NULL,
  `grupo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rol_usuario` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol_usuario`) VALUES
(1, 'Administrador'),
(2, 'Coordinador'),
(3, 'Estudiante'),
(4, 'Docente'),
(5, 'Evaluador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `time_password_interval` int(11) NOT NULL,
  `foto` varchar(300) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `usuario`, `contraseña`, `time_password_interval`, `foto`, `rol_id`) VALUES
(1, 'Administrador-Aunar', '1234567890', '$2y$10$p2HJq8dMMPW/nsJb..eg7eYIAkVKiJ5.jMZtBkLv/0eQ385SFJ2gG', 0, '02-09-22-07-09-59-', 1),
(2, 'Sergio', '1143411234', '$2y$10$VLUQXYkxCmG2/SaMMOzQ4u8XUDJ9uGp48/A4aES1kNF6coCQQSfvC', 0, '', 3),
(3, 'Mauricio', '8888888888', '$2y$10$V/qi3prOi0OH2NSL6jaxAO5LUL7Z4gfcPCljNbYRR6TqQS.uLgJMi', 0, '', 2),
(4, 'Manuel', '1432498292', '$2y$10$cZrJ0AyXv3Awtr2a8Zt5uO.0UwzY.nIKPpf3k.0mcUxeQWYo9nI2y', 0, '', 2),
(5, 'Jorge', '5555555554', '$2y$10$EtXEoULy2VZmlc6fZHokC.dxQamkQxOvbNOu2Ltj.MFZwHI8hu19C', 0, '', 2),
(6, 'Oscar', '1777777777', '$2y$10$lBHf4cdYldBD7ex821bEQujEB2jk6U6Cl2sEZRDs8mhJQhZEngt6K', 0, '', 3),
(7, 'Juan', '1010101010', '$2y$10$kwEdBMtX3rcOp9NDQcpWqekAaB1aImYaOmw6Ioz7UYdQX7GiO9qfq', 0, '', 3),
(8, 'Victor', '1878787878', '$2y$10$7eJjBiuluzfXuchb/jdpPORwCpcPuN..mFyHPEL1yzjqiCWiv8u3m', 0, '', 3),
(9, 'Daniel', '1209345555', '$2y$10$iEOCGfWUPsMoomTN0Z1zO.oSY7eslNJbM.at4ZXHPFbNhg8e35RT.', 0, '', 3),
(10, 'Maria', '1244344347', '$2y$10$M5o9pObBnimAHJuXSMYcIus3eHmBXH26Rd21pnzfwU09r/DvCKsiW', 0, '', 3),
(11, 'Juan', '1432543234', '$2y$10$2LUSOpRSKMtUnyyUZQJ4cu.D5sbkm33OaQB1W3gMUBIrFpWZ4r5Ca', 0, '', 3),
(12, 'Andres', '0987654321', '$2y$10$Rk9A8BAw9yJxuVZwFskth.KB5nCf23UDl793hNE2NDll6hFPE6/HG', 0, '', 4),
(13, 'Carlos', '3333333334', '$2y$10$H0j1Pvf4YXAQdD7.WtZ0UezTIlDTXGz816rJfzbgC1sHKQOwmdTP2', 0, '', 4),
(14, 'Justo', '4543663321', '$2y$10$yjezU6U1iYibP2JbcBlXwe5zccWL8sg2UVvlDySEPLC/q4zRbEOwC', 0, '', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_administrador_usuarios1` (`usuario_id`);

--
-- Indices de la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gr_afk` (`grupo_id`);

--
-- Indices de la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_docente_usuarios1` (`usuario_id`);

--
-- Indices de la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_coordinador_usuarios1` (`usuario_id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estudiante_usuarios1` (`usuario_id`),
  ADD KEY `est_gr` (`grupo_id`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `linea_investigacion`
--
ALTER TABLE `linea_investigacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_linea_investigacion_coordinador1` (`coordinador_id`);

--
-- Indices de la tabla `material_academico`
--
ALTER TABLE `material_academico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `as_fk1` (`asesor_id`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anuncios_docente1` (`docente_id`);

--
-- Indices de la tabla `pqr`
--
ALTER TABLE `pqr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pqr_usuario1` (`usuario_id`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gr_pfk` (`grupo_id`);

--
-- Indices de la tabla `proyecto_grado`
--
ALTER TABLE `proyecto_grado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gr1fk` (`grupo_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usuario_rol1` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `asesor`
--
ALTER TABLE `asesor`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `coordinador`
--
ALTER TABLE `coordinador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `linea_investigacion`
--
ALTER TABLE `linea_investigacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `material_academico`
--
ALTER TABLE `material_academico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pqr`
--
ALTER TABLE `pqr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proyecto_grado`
--
ALTER TABLE `proyecto_grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `fk_administrador_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  ADD CONSTRAINT `gr_afk` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD CONSTRAINT `fk_docente_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD CONSTRAINT `fk_coordinador_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `est_gr` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiante_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `linea_investigacion`
--
ALTER TABLE `linea_investigacion`
  ADD CONSTRAINT `fk_linea_investigacion_coordinador1` FOREIGN KEY (`coordinador_id`) REFERENCES `coordinador` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `material_academico`
--
ALTER TABLE `material_academico`
  ADD CONSTRAINT `as_fk1` FOREIGN KEY (`asesor_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_anuncios_docente1` FOREIGN KEY (`docente_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pqr`
--
ALTER TABLE `pqr`
  ADD CONSTRAINT `fk_pqr_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `propuesta`
--
ALTER TABLE `propuesta`
  ADD CONSTRAINT `gr_pfk` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto_grado`
--
ALTER TABLE `proyecto_grado`
  ADD CONSTRAINT `gr1fk` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
