-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: evaluer
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrador` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contraseña` varchar(20) NOT NULL,
  `id_usuario` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES (1,'Juan','admin@gmail.com','admin_evaluer2021','admin123456',0);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anteproyecto`
--

DROP TABLE IF EXISTS `anteproyecto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anteproyecto` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
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
  `observaciones` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anteproyecto`
--

LOCK TABLES `anteproyecto` WRITE;
/*!40000 ALTER TABLE `anteproyecto` DISABLE KEYS */;
INSERT INTO `anteproyecto` VALUES (3,'sad','Guia_proyecto_inv_ing (1).pdf','../files/anteproyectos/14-06-22-00-06-23-Guia_proyecto_inv_ing (1).pdf','edsadsadsadasd','INGENIERÍA INFORMÁTICA','010','2022-06-14 00:35:17','1143411235','dsad','dsd','asdasdasd\r\n                                                                                                                                  '),(4,'sad','firma.jpg','../files/anteproyectos/15-06-22-00-06-50-firma.jpg','sadsadssdaa','INGENIERÍA INFORMÁTICA','010','2022-06-15 00:42:40','1143411235','','','');
/*!40000 ALTER TABLE `anteproyecto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `anuncios`
--

DROP TABLE IF EXISTS `anuncios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anuncios` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `contenido` varchar(400) NOT NULL,
  `fecha` varchar(20) NOT NULL,
  `programa_id` int(20) NOT NULL,
  `nombre_user` varchar(70) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anuncios`
--

LOCK TABLES `anuncios` WRITE;
/*!40000 ALTER TABLE `anuncios` DISABLE KEYS */;
/*!40000 ALTER TABLE `anuncios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordinador`
--

DROP TABLE IF EXISTS `coordinador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coordinador` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) NOT NULL,
  `p_apellido` varchar(100) NOT NULL,
  `s_apellido` varchar(100) NOT NULL,
  `cedula` varchar(15) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `programa_id` int(10) NOT NULL,
  `usuario` varchar(80) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `coordinador_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordinador`
--

LOCK TABLES `coordinador` WRITE;
/*!40000 ALTER TABLE `coordinador` DISABLE KEYS */;
INSERT INTO `coordinador` VALUES (1,'Jorge                                                ','Perez ','Sarmiento ','5555555554','',0,'5555555554',18),(2,'Mauricio','Castro','Castro','8888888888','',0,'8888888888',21);
/*!40000 ALTER TABLE `coordinador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docente`
--

DROP TABLE IF EXISTS `docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(60) NOT NULL,
  `p_apellido` varchar(80) NOT NULL,
  `s_apellido` varchar(80) NOT NULL,
  `cedula` varchar(14) NOT NULL,
  `programa` varchar(100) NOT NULL,
  `programa_id` varchar(200) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `id_usuario` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `docente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente`
--

LOCK TABLES `docente` WRITE;
/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
INSERT INTO `docente` VALUES (1,'Diana Lilena                                                ','Velasquez ','Romero ','0001112345    ','INGENIERÍA INFORMÁTICA','010','0001112345                                        ',2),(2,'Carlos                                                      ','Gomez       ','Pereira       ','3333333334    ','CONTADURÍA PÚBLICA','030','3333333334                                        ',8),(3,'Nestor','Suat','Rojas','2222222222','INGENIERÍA INFORMÁTICA','010','2222222222',20);
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estudiante`
--

DROP TABLE IF EXISTS `estudiante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estudiante` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
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
  `id_usuario` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estudiante`
--

LOCK TABLES `estudiante` WRITE;
/*!40000 ALTER TABLE `estudiante` DISABLE KEYS */;
INSERT INTO `estudiante` VALUES (1,'Sergio','Mercado   ','Salazar    ','1143411235 ','INGENIERÍA INFORMÁTICA','010',9,'1143411235 ',0,0,0,4),(2,'Dager','Lopez','Estrada','4444444444','CONTADURÍA PÚBLICA','030',7,'4444444444',0,0,0,19),(9,'Oscar','Garces','Gomez','7777777777','INGENIERÍA INFORMÁTICA','010',7,'7777777777',0,100000000,100000000,44);
/*!40000 ALTER TABLE `estudiante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `programas`
--

DROP TABLE IF EXISTS `programas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `programas` (
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `identificador` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `programas`
--

LOCK TABLES `programas` WRITE;
/*!40000 ALTER TABLE `programas` DISABLE KEYS */;
INSERT INTO `programas` VALUES ('CD010','INGENIERÍA INFORMÁTICA','010'),('CD030','CONTADURÍA PÚBLICA','030'),('CD050','ARQUITECTURA','050'),('CD020','COCINA INTERNACIONAL','020'),('CD130','ADMINISTRACIÓN DE EMPRESAS','130');
/*!40000 ALTER TABLE `programas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propuesta`
--

DROP TABLE IF EXISTS `propuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propuesta` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL,
  `linea` varchar(250) NOT NULL,
  `integrantes` int(1) NOT NULL,
  `tutor` varchar(60) NOT NULL,
  `lider` varchar(60) NOT NULL,
  `programa` varchar(70) NOT NULL,
  `programa_id` varchar(200) NOT NULL,
  `semestre` int(2) NOT NULL,
  `descripcion` varchar(500) NOT NULL,
  `grupo` varchar(500) NOT NULL,
  `fecha` varchar(40) NOT NULL,
  `estado` varchar(40) NOT NULL,
  `id_estudiante` int(5) NOT NULL,
  `remitente` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estudiante` (`id_estudiante`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propuesta`
--

LOCK TABLES `propuesta` WRITE;
/*!40000 ALTER TABLE `propuesta` DISABLE KEYS */;
INSERT INTO `propuesta` VALUES (33,'sdas','dsad',0,'sad','asd','CONTADURÍA PÚBLICA','030',7,'sad','asdasd','2022-06-17 23:00:18','',2,'4444444444');
/*!40000 ALTER TABLE `propuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyecto_grado`
--

DROP TABLE IF EXISTS `proyecto_grado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyecto_grado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `nombre_asesor` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto_grado`
--

LOCK TABLES `proyecto_grado` WRITE;
/*!40000 ALTER TABLE `proyecto_grado` DISABLE KEYS */;
INSERT INTO `proyecto_grado` VALUES (1,'dsadsa','PinzónSalgadoJuanLeonardo.pdf','../files/proyectos_de_grado/08-05-22-18-05-42-PinzónSalgadoJuanLeonardo.pdf','INGENIERÍA INFORMÁTICA','010','2022-05-08 18:30:31','1143411235','sdsad','dsd','','dsdasdasdsasd','0001112345          ','Diana Lilena                                                Velasquez '),(3,'','Guia_proyecto_inv_ing (1).pdf','../files/proyectos_de_grado/14-06-22-00-06-15-Guia_proyecto_inv_ing (1).pdf','','','2022-06-14 00:49:11','1143411235','','','','','0001112345          ','Diana Lilena                                                Velasquez ');
/*!40000 ALTER TABLE `proyecto_grado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `rol_usuario` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrador'),(2,'Coordinador'),(3,'Estudiante'),(4,'Docente'),(5,'Evaluador');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `email` varchar(200) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `contraseña` varchar(250) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `foto` varchar(300) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Juan','admin@gmail.com','admin_evaluer2021','admin123456',1,''),(2,'Diana','diana@gmail.com','0001112345    ','0001112345',4,''),(4,'Sergio','mercadosergio754@gmail.com','1143411235 ','salazarg11',3,'19-06-22-05-06-36-once.JPG'),(8,'Carlos','carlos@gmail.com','3333333334    ','3333333333',4,''),(18,'Jorge','jorge@gmail.com','5555555554','5555555555',2,''),(19,'Dager','dager@gmail.com','4444444444','4444444444',3,''),(20,'Nestor','nestor@gmail.com','2222222222','2222222222',4,''),(21,'Mauricio','mauricio@gmail.com','8888888888','8888888888',2,''),(44,'Oscar','oscar@gmail.com','7777777777','7777777777',3,'');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-27 20:04:57
