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
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20250227193939','2025-02-27 20:39:59',20),('DoctrineMigrations\\Version20250228153458','2025-02-28 16:35:09',44);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
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
  `is_verified` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2265B05DF85E0677` (`username`),
  UNIQUE KEY `UNIQ_2265B05DE7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin','admin@example.com','$2y$13$/GQOiumfVTpMe8xHtiD/j.7xnUkF/eGdFNgiELBZN0h741tuZJPuC','[\"ROLE_USER\"]','2025-02-28 00:18:09',NULL,0),(2,'example','example1@example.com','$2y$13$wxW.DKSoPqoU46dv.5FXF.9frJ7texXMshJ/vnRJr9MrllYAcLms.','[\"ROLE_USER\"]','2025-02-28 21:33:04',NULL,1),(3,'example2','example2@example2.com','$2y$13$qOplfpqi0VAtrK.UHnIaoeyjmqz/yo2J6Y5kNXMkBcl8xwlD8QYmO','[\"ROLE_USER\"]','2025-02-28 23:18:44',NULL,1),(4,'example3','example3@example.com','$2y$13$ZMENY6sVhdsJ2A2MEw0N8eFyNiC4Sjqz3Ze68y7DRRHWGLPesHTiC','[\"ROLE_USER\"]','2025-03-02 15:05:59',NULL,0),(5,'example4','example4@example.com','$2y$13$wBZnrGB2ZpBYHFVUS3HBH.iPj7ALmXaf9S5hZxNmx6kLBc3F..kXy','[\"ROLE_USER\"]','2025-03-02 15:14:59',NULL,1),(6,'example5','example5@example.com','$2y$13$N89GC/cnh8pKXnlj74DMD.f2ULDBv.h/J0Gq4Mz/wR3Os87SHeYPa','[\"ROLE_USER\"]','2025-03-02 15:19:12',NULL,1),(7,'example6','example6@example.com','$2y$13$l8dcLzvuvhw7D4UWEpOvduClw3taj2kJDYGbS2lY6o6FEtY.Embh6','[\"ROLE_USER\"]','2025-03-02 16:00:28',NULL,1),(8,'example7','example7@gmail.com','$2y$13$AcA6LQopeQzd10CX7xDJs.I8w0CMvjrM7E5GWv21oRdl9B/8UzEba','[\"ROLE_USER\"]','2025-03-29 18:57:32',NULL,1),(9,'example8','example8@example8','$2y$13$3Lm7VoX9cPKDCsM.a36b.uAMKN4m8um9TsfE.wvcWjW6wMibVa2bK','[\"ROLE_USER\"]','2025-03-30 16:22:16',NULL,0);
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

-- Dump completed on 2025-03-30 19:43:14
