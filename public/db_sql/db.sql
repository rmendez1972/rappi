-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: asesoresinm_db
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `asesor_curso`
--

DROP TABLE IF EXISTS `asesor_curso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asesor_curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asesor_id` int(11) NOT NULL,
  `curso_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesor_curso`
--

LOCK TABLES `asesor_curso` WRITE;
/*!40000 ALTER TABLE `asesor_curso` DISABLE KEYS */;
INSERT INTO `asesor_curso` VALUES (6,1,4),(7,1,3),(8,1,5),(10,1,6);
/*!40000 ALTER TABLE `asesor_curso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asesores`
--

DROP TABLE IF EXISTS `asesores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asesores` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_razon` varchar(65) DEFAULT '',
  `apellido_paterno` varchar(45) DEFAULT '',
  `apellido_materno` varchar(45) DEFAULT '',
  `rfc` varchar(15) DEFAULT '',
  `id_tipo_persona` int(2) NOT NULL,
  `cve_municipio` varchar(3) NOT NULL,
  `colonia_region` varchar(45) DEFAULT '',
  `calle` varchar(85) DEFAULT '',
  `manzana` varchar(12) DEFAULT '',
  `numero_interior` varchar(12) DEFAULT '',
  `numero_exterior_lote` varchar(12) DEFAULT '',
  `codigo_postal` varchar(8) DEFAULT '',
  `telefono` varchar(10) DEFAULT '',
  `celular` varchar(10) DEFAULT '',
  `email` varchar(65) DEFAULT '',
  `doctos_faltantes` text,
  `id_usuario_genero` int(11) DEFAULT '0',
  `id_usuario` int(11) NOT NULL,
  `referencia` varchar(20) NOT NULL,
  `matricula` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asesores`
--

LOCK TABLES `asesores` WRITE;
/*!40000 ALTER TABLE `asesores` DISABLE KEYS */;
INSERT INTO `asesores` VALUES (1,'Rafael ','Méndez','Asencio','MEAX7208072M2',2,'004','campestre','presa de la amistad','','','433','77030','8325014','','rmendez1972@hotmail.com','',0,2,'72010785845148220','MEAX7208072M2MR004000001'),(5,'juanito','cacahuate','romanov','JORT123456HQRMR',1,'003','dd','a','2','1','2','12345','','','','',0,2,'33333333333333333','JORT123456HQRMRFS003000005');
/*!40000 ALTER TABLE `asesores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_municipios`
--

DROP TABLE IF EXISTS `cat_municipios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_municipios` (
  `cve_municipio` varchar(3) NOT NULL DEFAULT '',
  `nombre_municipio` varchar(48) DEFAULT '',
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`cve_municipio`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_municipios`
--

LOCK TABLES `cat_municipios` WRITE;
/*!40000 ALTER TABLE `cat_municipios` DISABLE KEYS */;
INSERT INTO `cat_municipios` VALUES ('001','COZUMEL',0),('002','FELIPE CARRILLO PUERTO',0),('003','ISLA MUJERES',0),('004','OTHÓN P. BLANCO',0),('005','BENITO JUÁREZ',0),('006','JOSÉ MARÍA MORELOS',0),('007','LÁZARO CÁRDENAS',0),('008','SOLIDARIDAD',0),('009','TULUM',0),('010','BACALAR',0),('011','once',2),('012','doce',2),('013','trece',2),('014','catorce',2),('015','quince',2),('016','diez y seis',2),('017','diez y siete',2),('018','diez y ocho',2),('019','diez y',2),('021','veintiuno',2),('022','veintidos',2),('023','veintitres',2),('024','veinticuatro',2);
/*!40000 ALTER TABLE `cat_municipios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cat_tipo_personas`
--

DROP TABLE IF EXISTS `cat_tipo_personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cat_tipo_personas` (
  `id_tipo_persona` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `descripcion_tipo_persona` varchar(25) DEFAULT '',
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_tipo_persona`),
  UNIQUE KEY `id_tipo_persona` (`id_tipo_persona`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cat_tipo_personas`
--

LOCK TABLES `cat_tipo_personas` WRITE;
/*!40000 ALTER TABLE `cat_tipo_personas` DISABLE KEYS */;
INSERT INTO `cat_tipo_personas` VALUES (1,'FISICA',0),(2,'MORAL',0),(3,'ASESOR INMOBILIARIO',2);
/*!40000 ALTER TABLE `cat_tipo_personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cursos`
--

DROP TABLE IF EXISTS `cursos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `año` mediumint(4) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cursos`
--

LOCK TABLES `cursos` WRITE;
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` VALUES (3,'TERCER CURSO',2015,2),(4,'PRIMER CURSO',2015,2),(5,'CURSO TRES',2015,2),(6,'CURSO 4',2022,2),(7,'CURSO 5',2025,2),(8,'CURSO 6',2027,2);
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisito_asesor`
--

DROP TABLE IF EXISTS `requisito_asesor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisito_asesor` (
  `id_asesor` int(11) NOT NULL,
  `id_requisito` int(11) NOT NULL,
  PRIMARY KEY (`id_asesor`,`id_requisito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisito_asesor`
--

LOCK TABLES `requisito_asesor` WRITE;
/*!40000 ALTER TABLE `requisito_asesor` DISABLE KEYS */;
INSERT INTO `requisito_asesor` VALUES (1,2),(1,7),(1,10),(1,11);
/*!40000 ALTER TABLE `requisito_asesor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisito_tipo_persona`
--

DROP TABLE IF EXISTS `requisito_tipo_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisito_tipo_persona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_persona_id` int(11) NOT NULL,
  `requisito_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo_persona_id` (`tipo_persona_id`,`requisito_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisito_tipo_persona`
--

LOCK TABLES `requisito_tipo_persona` WRITE;
/*!40000 ALTER TABLE `requisito_tipo_persona` DISABLE KEYS */;
INSERT INTO `requisito_tipo_persona` VALUES (29,1,2),(33,1,3),(34,1,4),(36,1,5),(47,1,6),(43,1,7),(48,1,8),(49,1,9),(50,2,2),(56,2,7),(51,2,10),(52,2,11),(53,2,12),(54,2,13),(55,2,14),(60,2,16),(59,3,2);
/*!40000 ALTER TABLE `requisito_tipo_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requisitos`
--

DROP TABLE IF EXISTS `requisitos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requisitos` (
  `id_requisito` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_requisito`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requisitos`
--

LOCK TABLES `requisitos` WRITE;
/*!40000 ALTER TABLE `requisitos` DISABLE KEYS */;
INSERT INTO `requisitos` VALUES (2,'SOLICITUD POR ESCRITO DIRIGIDO AL TITULAR DE LA SECRETARIA.',2),(3,'IDENTIFICACION OFICIAL VIGENTE CON FOTOGRAFIA',2),(4,'COMPROBANTE DE DOMICILIO ANEXANDO CROQUIS DE UBICACION ACTUALIZADO.',2),(5,'CONSTANCIA DE ANTECEDENTES PENALES EN LA COMISIóN DE DELITOS PATRIMONIALES DOLOSOS.',2),(6,'ACREDITAR DOCUMENTALMENTE SUS CONOCIMIENTOS Y EXPERIENCIA EN MATERIA INMOBILIARIA.',2),(7,'ACREDITAR SU REGISTRO FISCAL',2),(8,'PARA PERSONAS EXTRANJERAS, ACREDITAR SITUACION MIGRATORIA REGULAR Y PERMISO PARA LLEVAR A CABO ACTIVIDADES REMUNERADAS.',2),(9,'ACEPTAR CUMPLIR CON LA CAPACITACION, MISMA QUE SERá INDISPENSABLE PARA RENOVACIONES POSTERIORES DE LA MATRíCULA Y ACREDITACION RESPECTIVA.',2),(10,'COPIA CERTIFICADA DEL DOCUMENTO CONSTITUTIVO DE LA SOCIEDAD.',2),(11,'IDENTIFICACION OFICIAL VIGENTE CON FOTOGRAFIA DEL REPRESENTANTE LEGAL.',2),(12,'COPIA CERTIFICADA DEL PODER NOTARIAL DEL REPRESENTANTE LEGAL.',2),(13,'COMPROBANTE DE DOMICILIO PRINCIPAL, Y EN SU CASO, DE LAS SUCURSALES ANEXANDO CROQUIS DE UBICACIóN.',2),(14,'PRESENTAR LISTADO DE PERSONAS FíSICAS QUE PRESTARáN SERVICIOS COMO ASESORES INMOBILIARIOS.',2),(15,'ACREDITAR SU REGISTRO FISCAL.HJHGGJGG',2),(16,'ACEPTAR QUE LOS ASESORES INMOBILIARIOS CUMPLIRáN CON LA CAPACITACIóN, MISMA QUE SERá INDISPENSABLE PARA RENOVACIONES POSTERIORES DE LA MATRíCULA Y ACREDITACIóN RESPECTIVA.',2);
/*!40000 ALTER TABLE `requisitos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(85) DEFAULT '',
  `usuario` varchar(45) DEFAULT '',
  `password` varchar(254) DEFAULT NULL,
  `nivel_acceso` int(1) DEFAULT '0',
  `remember_token` varchar(100) NOT NULL,
  `active` int(11) NOT NULL,
  `email` varchar(80) NOT NULL,
  `src` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_usuario` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 PACK_KEYS=0;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,'Rafael Mendez Asencio','rmendez1972','$2y$10$muFGhHh4fXeImvoYsmJ5rupVfcI0T/UX.WH7NySKCFb7N9Y9eNzpO',1,'kInVysDwEATilJSJpSoPizUJjmcKTcoCrM5Zov2tBxJhBxjNv5WfgXUAFbxS',1,'user@mail.com','assets/imagenes/avatars/Mexico.png'),(27,'Vero Torres Alonso','vero1972','$2y$10$aC0/KEj83yXD6KVA.fsFHeL1PImTvvSGlsKUXKkSlYrOsGV9wUkEu',1,'',1,'vero1972@hotmail.com','assets/imagenes/avatars/a4f90febc5b7b8f651b917e493e13951.jpg');
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

-- Dump completed on 2015-02-05 15:38:34
