-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-08-2022 a las 06:38:04
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
ALTER TABLE anuncios AUTO_INCREMENT = 0;
ALTER TABLE coordinador AUTO_INCREMENT = 0;
ALTER TABLE docente AUTO_INCREMENT = 0;
ALTER TABLE estudiante AUTO_INCREMENT = 0;
ALTER TABLE programas AUTO_INCREMENT = 0;
ALTER TABLE propuesta AUTO_INCREMENT = 0;
ALTER TABLE proyecto_grado AUTO_INCREMENT = 0;
ALTER TABLE roles AUTO_INCREMENT = 0;
ALTER TABLE usuarios AUTO_INCREMENT = 0;

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
  `contraseña` varchar(20) NOT NULL,
  `id_usuario` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `email`, `usuario`, `contraseña`, `id_usuario`) VALUES
(1, 'Juan', 'admin@gmail.com', 'admin_evaluer2021', 'admin123456', 0);

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
  `programa_id` varchar(100) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `remitente` varchar(50) NOT NULL,
  `estado` varchar(80) NOT NULL,
  `calificacion` varchar(10) NOT NULL,
  `observaciones` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `anteproyecto`
--

INSERT INTO `anteproyecto` (`id`, `titulo`, `nombre`, `documento`, `comentarios`, `programa`, `programa_id`, `fecha`, `remitente`, `estado`, `calificacion`, `observaciones`) VALUES
(1, 'sad', 'proyecto_inv_ing.pdf', '../files/anteproyectos/14-06-22-00-06-23-Guia_proyecto_inv_ing (1).pdf', 'Aspectos metodologicos', 'INGENIERÍA INFORMÁTICA', '010', '2022-06-14 00:35:17', '1143411235', 'APROBADO', '4.2', 'Plasmar mas referencias\n                                                                                                                                  '),
(2, 'sad', 'entrega_parcial.pdf', '../files/anteproyectos/15-06-22-00-06-50-firma.jpg', 'Entrega parcial con correciones de marco referencial', 'INGENIERÍA INFORMÁTICA', '010', '2022-06-15 00:42:40', '1143411235', 'EN REVISION', '--', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(20) NOT NULL,
  `contenido` varchar(400) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `programa_id` int(20) NOT NULL,
  `nombre_usuario` varchar(70) NOT NULL,
  `usuario` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `coordinador`
--

CREATE TABLE `coordinador` (
  `id` int(6) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `p_apellido` varchar(100) NOT NULL,
  `s_apellido` varchar(100) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `programa_id` varchar(10) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `id_usuario` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `coordinador`
--

INSERT INTO `coordinador` (`id`, `nombres`, `p_apellido`, `s_apellido`, `cedula`, `programa`, `programa_id`, `usuario`, `id_usuario`) VALUES
(0, 'asda', 'dasd', 'ewqe', 'dassa', 'COCINA INTERNACIONAL', '020', 'dassa', 16),
(1, 'Jorge', 'Perez ', 'Sarmiento ', '5555555554', 'INGENIERÍA INFORMÁTICA', '010', '5555555554', 5),
(2, 'Mauricio', 'Castro', 'Castro', '8888888888', 'COCINA INTERNACIONAL', '020', '8888888888', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `id` int(4) NOT NULL,
  `nombres` varchar(60) NOT NULL,
  `p_apellido` varchar(80) NOT NULL,
  `s_apellido` varchar(80) NOT NULL,
  `cedula` varchar(14) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `programa_id` varchar(4) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `id_usuario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`id`, `nombres`, `p_apellido`, `s_apellido`, `cedula`, `programa`, `programa_id`, `usuario`, `id_usuario`) VALUES
(1, 'Diana Lilena                                                ', 'Velasquez ', 'Romero ', '0001112345    ', 'INGENIERÍA INFORMÁTICA', '010', '0001112345                                        ', 2),
(2, 'Carlos                                                      ', 'Gomez       ', 'Pereira       ', '3333333334    ', 'CONTADURÍA PÚBLICA', '030', '3333333334                                        ', 6),
(3, 'Nestor', 'Suat', 'Rojas', '2222222222', 'INGENIERÍA INFORMÁTICA', '010', '2222222222', 7),
(4, 'Andres', 'Perez', 'Garcia', '0987654321', 'INGENIERIA INFORMATICA', '010', '0987654321', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `id` int(4) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `p_apellido` varchar(20) NOT NULL,
  `s_apellido` varchar(20) NOT NULL,
  `cedula` varchar(14) NOT NULL,
  `programa` varchar(60) NOT NULL,
  `programa_id` varchar(200) NOT NULL,
  `semestre` int(2) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `time_propuesta` int(11) NOT NULL,
  `time_anteproyecto` int(11) NOT NULL,
  `time_proyecto` int(11) NOT NULL,
  `id_usuario` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `nombre`, `p_apellido`, `s_apellido`, `cedula`, `programa`, `programa_id`, `semestre`, `usuario`, `time_propuesta`, `time_anteproyecto`, `time_proyecto`, `id_usuario`) VALUES
(1, 'Sergio', 'Mercado   ', 'Salazar    ', '1143411235 ', 'INGENIERÍA INFORMÁTICA', '010', 9, '1143411235 ', 1692914400, 0, 0, 3),
(2, 'Dager', 'Lopez', 'Estrada', '4444444444', 'CONTADURÍA PÚBLICA', '030', 7, '4444444444', 0, 0, 0, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas`
--

CREATE TABLE `programas` (
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `identificador` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programas`
--

INSERT INTO `programas` (`codigo`, `nombre`, `identificador`) VALUES
('CD010', 'INGENIERÍA INFORMÁTICA', '010'),
('CD030', 'CONTADURÍA PÚBLICA', '030'),
('CD050', 'ARQUITECTURA', '050'),
('CD020', 'COCINA INTERNACIONAL', '020'),
('CD130', 'ADMINISTRACIÓN DE EMPRESAS', '130');

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
  `programa_id` varchar(200) NOT NULL,
  `semestre` int(2) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `miembro1` varchar(200) NOT NULL,
  `miembro2` varchar(200) NOT NULL,
  `miembro3` varchar(200) NOT NULL,
  `grupo` varchar(500) NOT NULL,
  `fecha` varchar(40) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `id_estudiante` int(5) NOT NULL,
  `remitente` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `propuesta`
--

INSERT INTO `propuesta` (`id`, `titulo`, `linea`, `integrantes`, `tutor`, `lider`, `programa`, `programa_id`, `semestre`, `descripcion`, `miembro1`, `miembro2`, `miembro3`, `grupo`, `fecha`, `estado`, `id_estudiante`, `remitente`) VALUES
(1, 'plataforma de contabilidad', 'sistema web', 1, 'sad', 'asd', 'INGENIERÍA INFORMÁTICA', '010', 7, 'sad', '', '', '', 'asdasd', '2022-06-17 23:00:18', '', 2, '4444444444'),
(2, 'Desarrollo de una plataforma web para el ordenamiento de libros', 'Desarrollo de aplicaciones web', 2, 'Andres Perez', 'Sergio Mercado', 'INGENIERÍA INFORMÁTICA', '010', 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis eleifend leo. Etiam pharetra odio quis magna condimentum convallis. In hac habitasse platea dictumst. Cras et erat odio. ', 'Sergio Mercado', 'Martin Rodriguez', '', '', '2022-08-25 00:43:48', '', 1, '1143411235');

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
  `fecha` varchar(20) NOT NULL,
  `remitente` varchar(50) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `calificacion` varchar(5) NOT NULL,
  `calificacion_coordinador` varchar(10) NOT NULL,
  `observaciones` varchar(500) NOT NULL,
  `asesor_user` varchar(20) DEFAULT NULL,
  `nombre_asesor` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyecto_grado`
--

INSERT INTO `proyecto_grado` (`id`, `titulo`, `nombre`, `documento`, `programa`, `programa_id`, `fecha`, `remitente`, `estado`, `calificacion`, `calificacion_coordinador`, `observaciones`, `asesor_user`, `nombre_asesor`) VALUES
(1, 'dsadsa', 'PinzónSalgadoJuanLeonardo.pdf', '../files/proyectos_de_grado/08-05-22-18-05-42-PinzónSalgadoJuanLeonardo.pdf', 'INGENIERÍA INFORMÁTICA', '010', '2022-05-08 18:30:31', '1143411235', 'sdsad', 'dsd', '', 'dsdasdasdsasd', '0001112345          ', 'Diana Lilena                                                Velasquez '),
(3, '', 'Guia_proyecto_inv_ing (1).pdf', '../files/proyectos_de_grado/14-06-22-00-06-15-Guia_proyecto_inv_ing (1).pdf', '', '', '2022-06-14 00:49:11', '1143411235', '', '', '', '', '0001112345          ', 'Diana Lilena                                                Velasquez ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(1) NOT NULL,
  `rol_usuario` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol_usuario`) VALUES
(1, 'Administrador'),
(2, 'Coordinador'),
(3, 'Estudiante'),
(4, 'Docente'),
(5, 'Evaluador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `foto` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `usuario`, `contraseña`, `id_rol`, `foto`) VALUES
(1, 'Juan', 'admin@gmail.com', '1234567890', '$2y$10$p2HJq8dMMPW/nsJb..eg7eYIAkVKiJ5.jMZtBkLv/0eQ385SFJ2gG', 1, ''),
(2, 'Diana', 'diana@gmail.com', '0001112345    ', '$2y$10$aCROUJwt/0ch5nEebMcVUOueEOp43dzm0UXfX/efA2Mot3Yfh0gbG', 4, ''),
(3, 'Sergio', 'mercadosergio754@gmail.com', '1143411235 ', '$2y$10$UmBCM9Uk6n6Sw1Vt96vpY.8af/gRS7zd.xmRGR/v0OGTUjUijSZ72', 3, '19-06-22-05-06-36-once.JPG'),
(4, 'Mauricio', 'mauricio@gmail.com', '8888888888', '$2y$10$1v0K7eCLgmnprexC5y/lcOVmugSuNLxlvD/QarM7WmkmZcGzF9BqS', 2, ''),
(5, 'Jorge', 'jorge@gmail.com', '5555555554', '5555555555', 2, ''),
(6, 'Carlos', 'carlos@gmail.com', '3333333334    ', '$2y$10$PQz/q.OvzOy3JaCZ//OSj.ag61/h8gRnV853w82M3YHBT.7qRPs.S', 4, ''),
(7, 'Nestor', 'nestor@gmail.com', '2222222222', '2222222222', 4, ''),
(8, 'Dager', 'dager@gmail.com', '4444444444', '4444444444', 3, ''),
(9, 'Andres ', 'andres@gmail.com', '0987654321', '$2y$10$3Xw6El7c6n2MDK9Bw.an2O0vBf/PrJ0h9inQOUUld9wwZ0I.M8Df.', 4, ''),
(10, 'daniel', 'daniel@mail.com', '112092112', '$2y$10$j3K2hcomheBVACooopGOt.aCCrnyeoqe9Ls.JhYRhf9MXS5f0DCaW', 4, ''),
(16, 'asda', 'asdsadsa', 'dassa', '$2y$10$b3ff8nFqxcugcBKN0Cqt0.Q43gag8JVPd488eN0ZRRUGY01JhY9fC', 4, ''),
(17, 'asda', 'asdsadsa', 'dassa', '$2y$10$oonLwgPJ45w/8jgALIGRTepQG5OXHNSwznfDVd.F97ccav/sqtuMO', 4, ''),
(18, 'asda', 'asdsadsa', 'dassa', '$2y$10$7olAXYwELBSIXHnOsJhuwuV64azSxeoG2G1hEvWLtqoGP7B8ioPxO', 2, ''),
(19, 'dsad', 'sad', 'a1212', '$2y$10$unaKtQjl8IuaA/oUKpTDJ.qK7uAfbGUx1DXKS5Z1yeyduft0les7y', 4, '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_ibfk_1` (`id_usuario`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `llave_user` (`id_usuario`);

--
-- Indices de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_estudiante` (`id_estudiante`);

--
-- Indices de la tabla `proyecto_grado`
--
ALTER TABLE `proyecto_grado`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `id_rol` (`id_rol`);

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
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `proyecto_grado`
--
ALTER TABLE `proyecto_grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD CONSTRAINT `c_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD CONSTRAINT `llave_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
