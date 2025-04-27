-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: biovision
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ave`
--

DROP TABLE IF EXISTS `ave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_comun` varchar(255) NOT NULL,
  `nombre_cientifico` varchar(255) NOT NULL,
  `descripcion` longtext DEFAULT NULL,
  `orden` varchar(100) NOT NULL,
  `familia` varchar(100) NOT NULL,
  `longitud_minima` double NOT NULL,
  `longitud_maxima` double NOT NULL,
  `envergadura_minima` double NOT NULL,
  `envergadura_maxima` double NOT NULL,
  `imagen_nombre` varchar(255) DEFAULT NULL,
  `estado_conservacion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F2E933A27E66E1BA` (`estado_conservacion_id`),
  CONSTRAINT `FK_F2E933A27E66E1BA` FOREIGN KEY (`estado_conservacion_id`) REFERENCES `estado_conservacion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ave`
--

LOCK TABLES `ave` WRITE;
/*!40000 ALTER TABLE `ave` DISABLE KEYS */;
INSERT INTO `ave` VALUES (3,'Abejaruco europeo','Merops apiaster','El abejaruco europeo es una de las aves más vistosas de nuestra fauna. Tal y como su nombre indica, se trata de un especialista en el consumo de abejas, aunque también se alimenta de otros insectos voladores. Aparte de por su colorido, uno de los más llamativos de las aves europeas, resulta muy fácil de reconocer por su característico reclamo, que emite constantemente mientras vuela y que puede ser oído desde largas distancias.','Coraciiformes','Meropidae',27,29,44,49,'abejaruco_europeo.jpg',1),(4,'Acentor común','Prunella modularis','Ave frecuente en zonas de montaña con abundancia de matorral y de sotobosque. En la mitad norte peninsular aparece en ambientes más diversos, pero en el sur se restringe a los sistemas montañosos. España alberga una población residente, a la que se unen en invierno acentores europeos pertenecientes a otra subespecie.','Passeriformes','Prunellidae',13,14,19,21,'acentor_comun.jpg',1);
/*!40000 ALTER TABLE `ave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ave_provincia`
--

DROP TABLE IF EXISTS `ave_provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ave_provincia` (
  `ave_id` int(11) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`ave_id`,`provincia_id`),
  KEY `IDX_4B69604F91007320` (`ave_id`),
  KEY `IDX_4B69604F4E7121AF` (`provincia_id`),
  CONSTRAINT `FK_4B69604F4E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4B69604F91007320` FOREIGN KEY (`ave_id`) REFERENCES `ave` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ave_provincia`
--

LOCK TABLES `ave_provincia` WRITE;
/*!40000 ALTER TABLE `ave_provincia` DISABLE KEYS */;
/*!40000 ALTER TABLE `ave_provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ave_provincia_periodo`
--

DROP TABLE IF EXISTS `ave_provincia_periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ave_provincia_periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ave_id` int(11) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7C8D8EFE91007320` (`ave_id`),
  KEY `IDX_7C8D8EFE4E7121AF` (`provincia_id`),
  KEY `IDX_7C8D8EFE9C3921AB` (`periodo_id`),
  CONSTRAINT `FK_7C8D8EFE4E7121AF` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`),
  CONSTRAINT `FK_7C8D8EFE91007320` FOREIGN KEY (`ave_id`) REFERENCES `ave` (`id`),
  CONSTRAINT `FK_7C8D8EFE9C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ave_provincia_periodo`
--

LOCK TABLES `ave_provincia_periodo` WRITE;
/*!40000 ALTER TABLE `ave_provincia_periodo` DISABLE KEYS */;
INSERT INTO `ave_provincia_periodo` VALUES (1,4,15,1),(2,4,36,1),(3,4,27,1),(4,4,32,1),(5,4,33,1),(6,4,39,1),(7,4,24,1),(8,4,9,1),(9,4,48,1),(10,4,20,1),(11,4,1,1),(12,4,22,1),(13,4,25,1),(14,4,8,1),(15,4,44,1),(16,4,12,1),(17,4,40,1),(18,4,5,1),(19,4,10,1),(20,4,18,1),(21,4,2,2),(22,4,3,2),(23,4,4,2),(24,4,6,2),(25,4,7,2),(26,4,11,2),(27,4,13,2),(28,4,14,2),(29,4,16,2),(30,4,17,2),(31,4,19,2),(32,4,21,2),(33,4,23,2),(34,4,26,2),(35,4,28,2),(36,4,29,2),(37,4,30,2),(38,4,31,2),(39,4,34,2),(40,4,35,2),(41,4,37,2),(42,4,38,2),(43,4,41,2),(44,4,42,2),(45,4,43,2),(46,4,45,2),(47,4,46,2),(48,4,47,2),(49,4,49,2),(50,4,50,2),(51,4,51,2),(52,4,52,2),(53,3,2,3),(54,3,3,3),(55,3,4,3),(56,3,5,3),(57,3,6,3),(58,3,7,3),(59,3,8,3),(60,3,9,3),(61,3,10,3),(62,3,11,3),(63,3,12,3),(64,3,13,3),(65,3,14,3),(66,3,16,3),(67,3,17,3),(68,3,18,3),(69,3,19,3),(70,3,21,3),(71,3,22,3),(72,3,23,3),(73,3,24,3),(74,3,25,3),(75,3,26,3),(76,3,28,3),(77,3,29,3),(78,3,30,3),(79,3,31,3),(80,3,34,3),(81,3,35,3),(82,3,37,3),(83,3,38,3),(84,3,40,3),(85,3,41,3),(86,3,42,3),(87,3,43,3),(88,3,44,3),(89,3,45,3),(90,3,46,3),(91,3,47,3),(92,3,49,3),(93,3,50,3),(94,3,51,3),(95,3,52,3);
/*!40000 ALTER TABLE `ave_provincia_periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20250227193939','2025-02-27 20:39:59',20),('DoctrineMigrations\\Version20250228153458','2025-02-28 16:35:09',44),('DoctrineMigrations\\Version20250406172557','2025-04-06 19:47:21',49),('DoctrineMigrations\\Version20250406235422','2025-04-07 01:54:29',45),('DoctrineMigrations\\Version20250407001630','2025-04-07 02:16:34',7),('DoctrineMigrations\\Version20250407225921','2025-04-08 00:59:34',48),('DoctrineMigrations\\Version20250418111745','2025-04-18 13:18:10',109),('DoctrineMigrations\\Version20250420091441','2025-04-20 11:15:54',174),('DoctrineMigrations\\Version20250420110619','2025-04-20 13:06:27',245),('DoctrineMigrations\\Version20250423190332','2025-04-23 21:07:32',171);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_conservacion`
--

DROP TABLE IF EXISTS `estado_conservacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `estado_conservacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_conservacion`
--

LOCK TABLES `estado_conservacion` WRITE;
/*!40000 ALTER TABLE `estado_conservacion` DISABLE KEYS */;
INSERT INTO `estado_conservacion` VALUES (1,'LC','Preocupación Menor','Especie abundante y de amplia distribución territorial que, una vez evaluada, se considera fuera de las categorías con mayor grado de amenaza.'),(2,'NT','Casi Amenazado','Especie que una vez evaluada, casi cumple los criterios para ser clasificada en una categoría con mayor grado de amenaza y debido a su tendencia, posiblemente los cumpla en un futuro próximo.'),(3,'EN','En Peligro','La especie se está enfrentando a un riesgo muy alto de extinción en estado silvestre.'),(4,'VU','Vulnerable','La especie se está enfrentando a un riesgo alto de extinción en estado silvestre.'),(5,'CR','En Peligro Crítico','La especie se está enfrentando a un riesgo extremadamente alto de extinción en estado silvestre.'),(6,'RE','Regionalmente Extinta','Especie extinta a nivel regional, no queda ninguna duda razonable de que el último individuo existente ha muerto, incluso en cautividad, en el ámbito territorial analizado, pudiendo evaluarse por separado la población reproductora y no reproductora.'),(7,'EX','Extinta','No queda ninguna duda razonable de que el último individuo existente ha muerto, incluso en cautividad. Para confirmar la extinción se han realizado prospecciones exhaustivas de sus hábitats en los momentos propicios, sin detectar ni un solo individuo.'),(8,'NE','No Evaluados','Especie aún no clasificada según los criterios de categorías en función del riesgo de extinción. Suelen ser especies no reproductoras, de aparición ocasional o rarezas que cuentan con información muy escasa y dispersa.'),(9,'DD','Datos Insuficientes','No hay información adecuada para hacer una evaluación, directa o indirecta, de su riesgo de extinción, basándose en la distribución o condición de la población, pero se considera la posibilidad de que investigaciones futuras impliquen la clasificación en alguna categoría de amenaza.');
/*!40000 ALTER TABLE `estado_conservacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `foto`
--

DROP TABLE IF EXISTS `foto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `ave_id` int(11) NOT NULL,
  `nombre_archivo` varchar(255) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `fecha_subida` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EADC3BE5DB38439E` (`usuario_id`),
  KEY `IDX_EADC3BE591007320` (`ave_id`),
  CONSTRAINT `FK_EADC3BE591007320` FOREIGN KEY (`ave_id`) REFERENCES `ave` (`id`),
  CONSTRAINT `FK_EADC3BE5DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto`
--

LOCK TABLES `foto` WRITE;
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
/*!40000 ALTER TABLE `foto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mes`
--

DROP TABLE IF EXISTS `mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mes`
--

LOCK TABLES `mes` WRITE;
/*!40000 ALTER TABLE `mes` DISABLE KEYS */;
INSERT INTO `mes` VALUES (1,'Enero'),(2,'Febrero'),(3,'Marzo'),(4,'Abril'),(5,'Mayo'),(6,'Junio'),(7,'Julio'),(8,'Agosto'),(9,'Septiembre'),(10,'Octubre'),(11,'Noviembre'),(12,'Diciembre');
/*!40000 ALTER TABLE `mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo`
--

DROP TABLE IF EXISTS `periodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo`
--

LOCK TABLES `periodo` WRITE;
/*!40000 ALTER TABLE `periodo` DISABLE KEYS */;
INSERT INTO `periodo` VALUES (1,'Residente'),(2,'Invernante'),(3,'Estival');
/*!40000 ALTER TABLE `periodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodo_mes`
--

DROP TABLE IF EXISTS `periodo_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `periodo_mes` (
  `periodo_id` int(11) NOT NULL,
  `mes_id` int(11) NOT NULL,
  PRIMARY KEY (`periodo_id`,`mes_id`),
  KEY `IDX_448415D79C3921AB` (`periodo_id`),
  KEY `IDX_448415D7B4F0564A` (`mes_id`),
  CONSTRAINT `FK_448415D79C3921AB` FOREIGN KEY (`periodo_id`) REFERENCES `periodo` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_448415D7B4F0564A` FOREIGN KEY (`mes_id`) REFERENCES `mes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodo_mes`
--

LOCK TABLES `periodo_mes` WRITE;
/*!40000 ALTER TABLE `periodo_mes` DISABLE KEYS */;
INSERT INTO `periodo_mes` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(2,1),(2,2),(2,3),(2,12),(3,6),(3,7),(3,8),(3,9);
/*!40000 ALTER TABLE `periodo_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provincia`
--

DROP TABLE IF EXISTS `provincia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `provincia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provincia`
--

LOCK TABLES `provincia` WRITE;
/*!40000 ALTER TABLE `provincia` DISABLE KEYS */;
INSERT INTO `provincia` VALUES (1,1,'Álava'),(2,2,'Albacete'),(3,3,'Alicante'),(4,4,'Almería'),(5,5,'Ávila'),(6,6,'Badajoz'),(7,7,'Baleares'),(8,8,'Barcelona'),(9,9,'Burgos'),(10,10,'Cáceres'),(11,11,'Cádiz'),(12,12,'Castellón'),(13,13,'Ciudad Real'),(14,14,'Córdoba'),(15,15,'La Coruña'),(16,16,'Cuenca'),(17,17,'Gerona'),(18,18,'Granada'),(19,19,'Guadalajara'),(20,20,'Guipúzcoa'),(21,21,'Huelva'),(22,22,'Huesca'),(23,23,'Jaén'),(24,24,'León'),(25,25,'Lérida'),(26,26,'La Rioja'),(27,27,'Lugo'),(28,28,'Madrid'),(29,29,'Málaga'),(30,30,'Murcia'),(31,31,'Navarra'),(32,32,'Orense'),(33,33,'Asturias'),(34,34,'Palencia'),(35,35,'Las Palmas de Gran Canaria'),(36,36,'Pontevedra'),(37,37,'Salamanca'),(38,38,'Santa Cruz de Tenerife'),(39,39,'Cantabria'),(40,40,'Segovia'),(41,41,'Sevilla'),(42,42,'Soria'),(43,43,'Tarragona'),(44,44,'Teruel'),(45,45,'Toledo'),(46,46,'Valencia'),(47,47,'Valladolid'),(48,48,'Bizkaia'),(49,49,'Zamora'),(50,50,'Zaragoza'),(51,51,'Ceuta'),(52,52,'Melilla');
/*!40000 ALTER TABLE `provincia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) NOT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2265B05DF85E0677` (`username`),
  UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin@example.com','$2y$13$/GQOiumfVTpMe8xHtiD/j.7xnUkF/eGdFNgiELBZN0h741tuZJPuC','[\"ROLE_USER\"]','2025-02-28 00:18:09',NULL,0),(2,'example','example1@example.com','$2y$13$wxW.DKSoPqoU46dv.5FXF.9frJ7texXMshJ/vnRJr9MrllYAcLms.','[\"ROLE_USER\"]','2025-02-28 21:33:04',NULL,1),(3,'example2','example2@example2.com','$2y$13$qOplfpqi0VAtrK.UHnIaoeyjmqz/yo2J6Y5kNXMkBcl8xwlD8QYmO','[\"ROLE_USER\"]','2025-02-28 23:18:44',NULL,1),(4,'example3','example3@example.com','$2y$13$ZMENY6sVhdsJ2A2MEw0N8eFyNiC4Sjqz3Ze68y7DRRHWGLPesHTiC','[\"ROLE_USER\"]','2025-03-02 15:05:59',NULL,0),(5,'example4','example4@example.com','$2y$13$wBZnrGB2ZpBYHFVUS3HBH.iPj7ALmXaf9S5hZxNmx6kLBc3F..kXy','[\"ROLE_USER\"]','2025-03-02 15:14:59',NULL,1),(6,'example5','example5@example.com','$2y$13$N89GC/cnh8pKXnlj74DMD.f2ULDBv.h/J0Gq4Mz/wR3Os87SHeYPa','[\"ROLE_USER\"]','2025-03-02 15:19:12',NULL,1),(7,'example6','example6@example.com','$2y$13$l8dcLzvuvhw7D4UWEpOvduClw3taj2kJDYGbS2lY6o6FEtY.Embh6','[\"ROLE_USER\"]','2025-03-02 16:00:28',NULL,1),(8,'example7','example7@gmail.com','$2y$13$AcA6LQopeQzd10CX7xDJs.I8w0CMvjrM7E5GWv21oRdl9B/8UzEba','[\"ROLE_USER\"]','2025-03-29 18:57:32',NULL,1),(9,'example8','example8@example8','$2y$13$3Lm7VoX9cPKDCsM.a36b.uAMKN4m8um9TsfE.wvcWjW6wMibVa2bK','[\"ROLE_USER\"]','2025-03-30 16:22:16',NULL,0),(10,'example9','example9@example.com','$2y$13$2AMU9tY6R5IQFe5wrGrkSOCO1mm0n2l8woLNbwDdPUjEUwQD8Fzl.','[\"ROLE_USER\"]','2025-03-30 19:49:16',NULL,0),(11,'example10','example10@example.com','$2y$13$uf2YyxNNYm7uGBdHW3SEcuW0Qx0dPnLxdJ./PF59DY.KMue0NrBSO','[\"ROLE_USER\"]','2025-03-30 20:42:44',NULL,0),(12,'nuevo1','nuevo1@nuevo.com','$2y$13$w4suSzMoQpkd5DeyfoidC.83vEwB.g6r7BN6GbhWAPDo48XbSoPYa','[\"ROLE_USER\"]','2025-03-30 21:03:49',NULL,1),(13,'nuevo2','nuevo2@nuevo.com','$2y$13$mpImcw2LLUC36kd99tP1u.wRk.kNR6npijgP95q5YY.gsWAVlkvIy','[\"ROLE_USER\"]','2025-03-30 21:16:58',NULL,1),(14,'nuevo3','nuevo3@nuevo.com','$2y$13$bB4JaJdN3DxO5wq4GISxJeDhliBdoHEwnSgsndxxFboGsbIXw02si','[\"ROLE_USER\"]','2025-04-10 16:35:40',NULL,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'biovision'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-26 21:07:07
