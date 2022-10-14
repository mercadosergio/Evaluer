-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-10-2022 a las 04:29:31
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
ALTER TABLE anuncio AUTO_INCREMENT = 0;
ALTER TABLE coordinador AUTO_INCREMENT = 0;
ALTER TABLE docente AUTO_INCREMENT = 0;
ALTER TABLE estudiante AUTO_INCREMENT = 0;
ALTER TABLE programa AUTO_INCREMENT = 0;
ALTER TABLE propuesta AUTO_INCREMENT = 0;
ALTER TABLE proyecto_grado AUTO_INCREMENT = 0;
ALTER TABLE rol AUTO_INCREMENT = 0;
ALTER TABLE usuario AUTO_INCREMENT = 0;

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
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `nombre`, `email`, `usuario`, `contraseña`, `usuario_id`) VALUES
(2, 'Juan', 'admin@gmail.com', 'admin_evaluer2021', 'admin123456', 1);

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
  `estudiante_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `anteproyecto`
--

INSERT INTO `anteproyecto` (`id`, `titulo`, `nombre`, `documento`, `comentarios`, `programa`, `programa_id`, `fecha`, `remitente`, `estado`, `calificacion`, `observaciones`, `estudiante_id`) VALUES
(1, 'Desarrollo de una plataforma web para el ordenamiento de libros', 'proyecto_inv_ing.pdf', '../files/anteproyectos/14-06-22-00-06-23-Guia_proyecto_inv_ing (1).pdf', 'Aspectos metodologicos', 'INGENIERÍA INFORMÁTICA', '010', '2022-06-14 00:35:17', '1143411235', 'APROBADO', '4.2', 'Plasmar mas referencias', 1),
(2, 'Desarrollo de una plataforma web para el ordenamiento de libros', 'entrega_parcial.pdf', '../files/anteproyectos/15-06-22-00-06-50-firma.jpg', 'Entrega parcial con correciones de marco referencial', 'INGENIERÍA INFORMÁTICA', '010', '2022-06-15 00:42:40', '1143411235', 'EN REVISION', '--', '', 1),
(5, 'Desarrollo de una plataforma web para el ordenamiento de libros', 'Diagrama de caso de uso (1).png', '../../files/anteproyectos/29-08-22-02-08-10-Diagrama de caso de uso (1).png', 'asdsadsad', 'INGENIERÍA INFORMÁTICA', '010', '2022-08-29 02:16:05', '114341123', '', '', '', 1),
(6, 'feeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'documento.pdf', '../../files/anteproyectos/05-09-22-01-09-07-documento.pdf', 'adddddddddddddddddddddddddddddddddd', 'INGENIERÍA INFORMÁTICA', '010', '2022-09-05 01:48:50', '7777777777', '', '', '', 3);

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
  `programa_id` varchar(4) NOT NULL,
  `semestres_asesoria` text NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asesor`
--

INSERT INTO `asesor` (`id`, `nombres`, `p_apellido`, `s_apellido`, `cedula`, `programa`, `programa_id`, `semestres_asesoria`, `usuario`, `usuario_id`) VALUES
(1, 'Diana Lilena', 'Velasquez ', 'Romero ', '0001112345', 'INGENIERÍA INFORMÁTICA', '010', '', '0001112345', 2),
(2, 'Carlos', 'Gomez', 'Pereira', '3333333334', 'CONTADURÍA PÚBLICA', '030', '', '3333333334', 6),
(3, 'Nestor', 'Suat', 'Rojas', '2222222222', 'INGENIERÍA INFORMÁTICA', '010', '', '2222222222', 7),
(4, 'Andres', 'Perez', 'Garcia', '0987654321', 'INGENIERÍA INFORMÁTICA', '010', '', '0987654321', 9);

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
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `coordinador`
--

INSERT INTO `coordinador` (`id`, `nombres`, `p_apellido`, `s_apellido`, `cedula`, `programa`, `programa_id`, `usuario`, `usuario_id`) VALUES
(1, 'Jorge', 'Perez ', 'Sarmiento ', '5555555554', 'INGENIERÍA INFORMÁTICA', '010', '5555555554', 5),
(2, 'Mauricio', 'Castro', 'Castro', '8888888888', 'INGENIERÍA INFORMÁTICA', '010', '8888888888', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `duración` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `programa_id` varchar(11) NOT NULL,
  `semestre` int(2) NOT NULL,
  `telefono` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `time_propuesta` int(11) DEFAULT NULL,
  `time_anteproyecto` int(11) DEFAULT NULL,
  `time_proyecto` int(11) DEFAULT NULL,
  `asesor` varchar(100) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `asesor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`id`, `nombre`, `p_apellido`, `s_apellido`, `tipo_di`, `cedula`, `programa`, `programa_id`, `semestre`, `telefono`, `email`, `usuario`, `time_propuesta`, `time_anteproyecto`, `time_proyecto`, `asesor`, `usuario_id`, `asesor_id`) VALUES
(1, 'Sergio', 'Mercado', 'Salazar', '', '1143411235', 'INGENIERÍA INFORMÁTICA', '010', 9, 0, '', '1143411235', 0, 0, 1663020000, 'Andres Perez', 3, 4),
(2, 'Dager', 'Lopez', 'Estrada', '', '4444444444', 'CONTADURÍA PÚBLICA', '030', 7, 0, '', '4444444444', 0, 0, 0, '', 8, 0),
(3, 'Oscar', 'Garces', 'Gomez', '', '7777777777', 'INGENIERÍA INFORMÁTICA', '010', 9, 0, '', '7777777777', 1693864800, 1663624800, 1663624800, 'Diana Lilena Velasquez ', 11, 1),
(4, 'ffff', 'ffffff', 'fffff', '', '121239912', 'INGENIERÍA INFORMÁTICA', '', 9, 0, '', '121239912', 100000000, 100000000, 100000000, '', 13, 0);

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

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`id`, `contenido`, `fecha`, `programa_id`, `nombre_usuario`, `usuario`, `docente_id`) VALUES
(3, '<h3>Bienvenidos a este curso</h3>\r\n                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam accusantium quam quidem, quasi eos\r\n                        eveniet id tempore laudantium quos, ut, ducimus alias aperiam enim et at. Nam veniam ipsam\r\n                        facere, voluptatibus hic exercitationem dolore sapiente ducimus doloremque amet, rem consectetur\r\n      ', '2022-09-29 17:20:12', 10, 'Andres Perez', '0987654321', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id` int(11) NOT NULL,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `identificador` varchar(11) NOT NULL,
  `codigo_snies` varchar(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `modalidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id`, `codigo`, `nombre`, `identificador`, `codigo_snies`, `duracion`, `modalidad`) VALUES
(1, 'CD010', 'INGENIERÍA INFORMÁTICA', '010', '', 0, ''),
(2, 'CD030', 'CONTADURÍA PÚBLICA', '030', '', 0, ''),
(3, 'CD050', 'ARQUITECTURA', '050', '', 0, ''),
(4, 'CD020', 'COCINA INTERNACIONAL', '020', '', 0, ''),
(5, 'CD130', 'ADMINISTRACIÓN DE EMPRESAS', '130', '', 0, '');

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
  `fecha` varchar(40) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `remitente` varchar(40) NOT NULL,
  `estudiante_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `propuesta`
--

INSERT INTO `propuesta` (`id`, `titulo`, `linea`, `integrantes`, `tutor`, `lider`, `programa`, `programa_id`, `semestre`, `descripcion`, `miembro1`, `miembro2`, `miembro3`, `fecha`, `estado`, `remitente`, `estudiante_id`) VALUES
(2, 'Desarrollo de una plataforma web para el ordenamiento de libros', 'Desarrollo de aplicaciones web', 2, 'Andres Perez', 'Sergio Mercado', 'INGENIERÍA INFORMÁTICA', '010', 9, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed quis eleifend leo. Etiam pharetra odio quis magna condimentum convallis. In hac habitasse platea dictumst. Cras et erat odio. ', 'Sergio Mercado', 'Martin Rodriguez', '', '2022-08-25 00:43:48', 'en revision', '1143411235', 1);

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
  `estudiante_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proyecto_grado`
--

INSERT INTO `proyecto_grado` (`id`, `titulo`, `nombre`, `documento`, `programa`, `programa_id`, `semestre`, `fecha`, `remitente`, `estado`, `calificacion`, `observaciones`, `asesor_id`, `asesor`, `jurado1`, `jurado2`, `jurado3`, `estudiante_id`) VALUES
(1, 'Desarrollo de una plataforma web para el ordenamiento de libros', 'Proyecto-grado-libros.pdf', '../../files/proyectos_de_grado/05-09-22-01-09-07-documento.pdf', 'INGENIERÍA INFORMÁTICA', '010', 9, '2022-05-08 18:30:31', '1143411235', 'APROBADO', '4.3', 'Implementar normas APA', 1, 'Diana Lilena Velasquez ', 'Andres Perez', 'Diana Lilena Velasquez ', 'Nestor Suat', 1),
(2, 'Sistema de gestión de contabilidad para procesos de compra', 'proyecto_contabilidad.pdf', '../files/proyectos_de_grado/14-06-22-00-06-15-Guia_proyecto_inv_ing (1).pdf', 'INGENIERÍA INFORMÁTICA', '010', 8, '2022-06-14 00:49:11', '1143411235', 'en revisión', '', '', 1, 'Diana Lilena Velasquez ', '', '', '', 1),
(4, '', 'Diagrama de caso de uso.png', '../../files/proyectos_de_grado/29-08-22-21-08-26-Diagrama de caso de uso.png', '', '', 0, '2022-08-29 21:30:18', '1143411235', '', '', '', NULL, '', '', '', '', 1),
(5, 'feeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee', 'documento.pdf', '../../files/proyectos_de_grado/05-09-22-01-09-07-documento.pdf', '', '<br /', 9, '2022-09-05 01:50:05', '7777777777', '', '', '', NULL, '', '', '', '', 3);

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
  `email` varchar(200) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `time_password_interval` int(11) NOT NULL,
  `foto` varchar(300) NOT NULL,
  `rol_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `usuario`, `contraseña`, `time_password_interval`, `foto`, `rol_id`) VALUES
(1, 'Juan', 'admin@gmail.com', '1234567890', '$2y$10$p2HJq8dMMPW/nsJb..eg7eYIAkVKiJ5.jMZtBkLv/0eQ385SFJ2gG', 0, '02-09-22-07-09-59-', 1),
(2, 'Diana', 'diana@gmail.com', '0001112345', '$2y$10$aCROUJwt/0ch5nEebMcVUOueEOp43dzm0UXfX/efA2Mot3Yfh0gbG', 0, '', 4),
(3, 'Sergio', 'mercadosergio754@gmail.com', '1143411235', '$2y$10$UmBCM9Uk6n6Sw1Vt96vpY.8af/gRS7zd.xmRGR/v0OGTUjUijSZ72', 0, '19-06-22-05-06-36-once.JPG', 3),
(4, 'Mauricio', 'mauricio@gmail.com', '8888888888', '$2y$10$1v0K7eCLgmnprexC5y/lcOVmugSuNLxlvD/QarM7WmkmZcGzF9BqS', 0, '', 2),
(5, 'Jorge', 'jorge@gmail.com', '5555555554', '$2y$10$xrEuPyXc1x2SXppusfR8mu7meBV1fvHb2wtXL54jrIvyL8CrYqquS', 0, '29-08-22-23-08-07-', 2),
(6, 'Carlos', 'carlos@gmail.com', '3333333334    ', '$2y$10$PQz/q.OvzOy3JaCZ//OSj.ag61/h8gRnV853w82M3YHBT.7qRPs.S', 0, '', 4),
(7, 'Nestor', 'nestor@gmail.com', '2222222222', '$2y$10$ohVU7xn3OaGZAKps42EXjuVAUmyU1qO6inusBFXER0R8bJPQHGErK', 0, '', 4),
(8, 'Dager', 'dager@gmail.com', '4444444444', '$2y$10$8.QWkjP3LRDFuwRxJOfwW.6hxYd2RetRF5LHFoDZu8yu7lTBZ6wVq', 0, '', 3),
(9, 'Andres ', 'andres@gmail.com', '0987654321', '$2y$10$3Xw6El7c6n2MDK9Bw.an2O0vBf/PrJ0h9inQOUUld9wwZ0I.M8Df.', 0, '', 4),
(10, 'daniel', 'daniel@mail.com', '112092112', '$2y$10$j3K2hcomheBVACooopGOt.aCCrnyeoqe9Ls.JhYRhf9MXS5f0DCaW', 0, '', 4),
(11, 'Oscar', 'oscar@gmail.com', '7777777777', '$2y$10$/t2FiD05YHslqnz.duLlS.DPyNmTy5360e.YknR4tu9dINmqc5BSK', 0, '', 3),
(12, 'asdasd', 'asdsa', 'asdsa', '$2y$10$sY8qH0fb0cVkLZoR8CkEZ.XOMkw171XUFSV9dFC8rJd2Oo1G/bGtC', 0, '', 3),
(13, 'ffff', 'asdasd', '121239912', '$2y$10$qBW1Xut501/qjBuT..7BYOk7c0luARf/NOxfnhzhINx4JeR0xGUoq', 0, '', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_administrador_usuarios1_idx` (`usuario_id`);

--
-- Indices de la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anteproyecto_estudiante1_idx` (`estudiante_id`);

--
-- Indices de la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_docente_usuarios1_idx` (`usuario_id`);

--
-- Indices de la tabla `coordinador`
--
ALTER TABLE `coordinador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_coordinador_usuarios1_idx` (`usuario_id`);

--
-- Indices de la tabla `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_estudiante_usuarios1_idx` (`usuario_id`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_anuncios_docente1_idx` (`docente_id`);

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
  ADD KEY `estudiante_id` (`estudiante_id`);

--
-- Indices de la tabla `proyecto_grado`
--
ALTER TABLE `proyecto_grado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_proyecto_grado_estudiante1_idx` (`estudiante_id`);

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
  ADD KEY `fk_usuario_rol1_idx` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `anteproyecto`
--
ALTER TABLE `anteproyecto`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asesor`
--
ALTER TABLE `asesor`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `propuesta`
--
ALTER TABLE `propuesta`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proyecto_grado`
--
ALTER TABLE `proyecto_grado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  ADD CONSTRAINT `fk_anteproyecto_estudiante1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_estudiante_usuarios1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_anuncios_docente1` FOREIGN KEY (`docente_id`) REFERENCES `asesor` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `propuesta`
--
ALTER TABLE `propuesta`
  ADD CONSTRAINT `propuesta_ibfk_1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proyecto_grado`
--
ALTER TABLE `proyecto_grado`
  ADD CONSTRAINT `fk_proyecto_grado_estudiante1` FOREIGN KEY (`estudiante_id`) REFERENCES `estudiante` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
