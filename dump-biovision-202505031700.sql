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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ave`
--

LOCK TABLES `ave` WRITE;
/*!40000 ALTER TABLE `ave` DISABLE KEYS */;
INSERT INTO `ave` VALUES (3,'Abejaruco europeo','Merops apiaster','El abejaruco europeo es una de las aves más vistosas de nuestra fauna. Tal y como su nombre indica, se trata de un especialista en el consumo de abejas, aunque también se alimenta de otros insectos voladores. Aparte de por su colorido, uno de los más llamativos de las aves europeas, resulta muy fácil de reconocer por su característico reclamo, que emite constantemente mientras vuela y que puede ser oído desde largas distancias.','Coraciiformes','Meropidae',27,29,44,49,'abejaruco_europeo.jpg',1),(4,'Acentor común','Prunella modularis','Ave frecuente en zonas de montaña con abundancia de matorral y de sotobosque. En la mitad norte peninsular aparece en ambientes más diversos, pero en el sur se restringe a los sistemas montañosos. España alberga una población residente, a la que se unen en invierno acentores europeos pertenecientes a otra subespecie.','Passeriformes','Prunellidae',13,14,19,21,'acentor_comun.jpg',1),(5,'Abejero europeo','Pernis apivorus','Estrechamente ligado a áreas boscosas, el abejero es una rapaz estival en nuestro país, que realiza largas singladuras hasta alcanzar el continente africano, donde inverna, para lo que necesita antes canalizar su migración a través del estrecho de Gibraltar, donde se concentra en gran número. Las adaptaciones a sus curiosas preferencias alimentarias (avispas, abejorros) lo llevan a sincronizar su ciclo reproductor y migración con el periodo de mayor abundancia de estas singulares presas para una rapaz.','Accipitriformes','Accipitridae',52,59,113,135,'abejero_europeo.jpg',2),(6,'Abubilla común','Upupa epops','Se trata de una de las aves más populares de la España mediterránea, muy abundante en las dehesas de la mitad meridional. Su característico reclamo, su llamativo penacho de plumas y su vuelo errático y ondulante la hacen fácilmente reconocible. Pese a ser una especie migradora transahariana, parte de la población reside todo el año en las regiones peninsulares más cálidas, así como en Baleares y Canarias, territorios que también acogen individuos europeos invernantes.','Bucerotiformes','Upupidae',23,29,44,48,'acentor_comun.jpg',1),(7,'Acentor alpino','Prunella collaris','Este típico pájaro de alta montaña puede vivir hasta en las cumbres más elevadas de Pirineos o Sierra Nevada, altitudes a las que se aventuran muy pocas especies. Frecuenta los principales macizos montañosos, aunque es más abundante en Pirineos y Picos de Europa. Suele acercarse a refugios y estaciones de esquí, donde se muestra muy confiado ante la presencia humana.','Passeriformes','Prunellidae',15,17,30,32.5,'abejero_europeo.jpg',2),(8,'Agachadiza chica','Lymnocryptes minimus','Esta pequeña limícola, de críptico plumaje y hábitos muy recatados, es uno de los más esquivos y desconocidos habitantes de nuestros humedales y áreas encharcables, donde se instala a lo largo del invierno y durante los pasos migratorios.','Charadriiformes','Scolopacidae',17,19,38,42,'abejero_europeo.jpg',9),(9,'Agachadiza común','Gallinago gallinago','Ave limícola muy esquiva y discreta, y una de las pocas especies de este grupo que crían en nuestro país, aunque lo hace de forma muy escasa y en unos pocos enclaves. Mucho más numerosa y repartida aparece durante los pasos migratorios y la invernada, cuando puede encontrarse en una gran variedad de humedales, tanto costeros como del interior.','Charadriiformes','Scolopacidae',25,27,44,47,'abejero_europeo.jpg',3),(10,'Agateador euroasiático','Certhia familiaris','Pequeña ave insectívora, escasa y restringida a los bosques alpinos de las montañas de la mitad norte peninsular. Resulta esquiva y poco conspicua por su coloración críptica, difícil de apreciar contra la corteza de los troncos, sobre los que suele pasar gran parte del día.','Passeriformes','Certhiidae',12.5,15,17.5,21,'agateador_euroasiatico.jpg',9),(11,'Agateador europeo','Certhia brachydactyla','Se trata de un pajarillo frecuente en nuestros bosques e incluso en nuestros parques, aunque no resulta fácil de observar. Su plumaje, de tonalidades marrones, es muy críptico, y, como además permanece mucho tiempo recorriendo los troncos de los árboles en busca de alimento, donde se camufla muy bien entre las cortezas, pasa muy inadvertido. Es mucho más fácil de detectar por su reclamo, integrado por unos profundos piídos.','Passeriformes','Certhiidae',11,13,17.5,20,'agateador_europeo.jpg',1),(12,'Águila calzada','Hieraaetus pennatus','Las áreas forestales y parcialmente arboladas de nuestro país, en particular las regiones del centro y el oeste de la Península, cuentan con la mayor población europea de una rapaz viajera, de vuelo ágil y aspecto estilizado, que se alimenta sobre todo de aves medianas, conejos y lagartos. Se trata del águila calzada, un ave que puede presentar dos fases de coloración muy diferentes y que, al contrario que otras rapaces, parece mantener poblaciones estables o en ligero aumento.','Accipitriformes','Accipitridae',42,51,110,135,'aguila_calzada.jpg',1),(13,'Águila imperial ibérica','Aquila adalberti','Endémica de la Península, se trata de una de las aves más emblemáticas y amenazadas de nuestra fauna, que estuvo al borde de la extinción, aunque se ha venido recuperando en las últimas décadas. Habita en el centrosuroeste peninsular, fundamentalmente en sierras con extensas formaciones de monte mediterráneo y, en menor medida, en pinares del Sistema Central.','Accipitriformes','Accipitridae',68,83,180,220,'aguila_imperial_iberica.jpg',3),(14,'Águila perdicera','Aquila fasciata','Entre las grandes águilas, es la más ágil, lo que le permite cazar un gran número de aves de tamaño medio, y también la de coloración más pálida. Está muy asociada a ambientes mediterráneos, y por eso sus poblaciones más importantes se encuentran acantonadas en Extremadura, en las sierras del Levante y en la región oriental andaluza.','Accipitriformes','Accipitridae',60,70,150,170,'aguila_perdicera.jpg',4),(15,'Águila pescadora','Pandion haliaetus','Esta rapaz, estrictamente ligada al medio acuático y de alimentación exclusivamente piscívora, está muy extendida a nivel mundial, aunque en nuestro país es una de las aves de presa más escasas. En la segunda mitad del siglo XX la población reproductora en España sufrió una drástica disminución hasta casi la extinción, afortunadamente frenada gracias a las labores de conservación de la especie. En invierno nuestro territorio recibe numerosos contingentes procedentes de latitudes norteñas y durante los pasos migratorios es posible observarla también en humedales de interior.','Accipitriformes','Pandionidae',53,66,147,174,'aguila_pescadora.jpg',3),(16,'Águila real','Aquila chrysaetos','La real es la más poderosa de nuestras águilas y una de las aves de presa más extendidas a escala mundial. En España está extendida únicamente por la Península, donde ocupa la mayor parte de las áreas montañosas o de relieve quebrado y montuoso. Es una rapaz esencialmente rupícola, que instala casi siempre sus nidos en cantiles rocosos, aunque en ocasiones también lo hace en árboles. Su dieta es muy variada, e incluye una gran variedad de mamíferos, aves e incluso reptiles, y también carroña.','Accipitriformes','Accipitridae',76,96,180,230,'aguila_real.jpg',2),(17,'Aguilucho cenizo','Circus pygargus','Pocas rapaces hay tan ligadas a las actividades humanas como el grácil aguilucho cenizo, una especie que, en nuestro territorio, depende estrechamente de las grandes extensiones cultivadas de trigo y cebada, donde, a falta de los grandes herbazales que conforman en otros lugares su hábitat predilecto, instala los nidos. A cambio de alojarse en los cultivos del hombre, el aguilucho cenizo elimina ingentes cantidades de topillos, ratones, langostas y aves granívoras, que constituyen sus presas habituales.','Accipitriformes','Accipitridae',39,46,102,116,'aguilucho_cenizo.jpg',4),(18,'Aguilucho lagunero occidental','Circus aeruginosus','La figura ingrávida del aguilucho lagunero patrullando incansablemente sobre carrizales y marjales se convirtió en una imagen bastante poco frecuente hace algunas décadas, cuando la transformación de los humedales y la persecución directa redujeron a poco más de 200 las parejas de estas rapaces. Actualmente, la población española se recupera lentamente, aunque está lejos de alcanzar la de otros países europeos, donde este aguilucho resulta más abundante.','Accipitriformes','Accipitridae',43,55,115,140,'aguilucho_lagunero_occidental.jpg',1),(19,'Aguilucho pálido','Circus cyaneus','El aguilucho pálido es una rapaz propia de las latitudes templadas y frías del Holártico que, en nuestro país, se reproduce en espesos tojales, carrizales y brezales del norte peninsular, aunque, en invierno, su imagen liviana patrullando sobre los inmensos campos de cereales, vegas y humedales de numerosas localidades españolas es algo bastante habitual. Desde hace algunos años son numerosas las parejas de esta especie que se han asentado en las llanuras cerealistas del centro de la Península, donde comparten hábitat con su cercano pariente el aguilucho cenizo.','Accipitriformes','Accipitridae',45,55,97,118,'aguilucho_palido.jpg',3),(20,'Aguilucho papialbo','Circus macrourus','El aguilucho papialbo ha dejado de considerarse un ave ocasional en España, y cada vez es menos infrecuente verlo durante sus migraciones prenupciales surcar los cielos peninsulares, lo que sugiere el posible establecimiento de una nueva ruta migratoria para la especie. Existen registros de individuos que, de manera puntual, hacen aquí la invernada, así como de su hibridación ocasional con aguiluchos cenizos.','Accipitriformes','Accipitridae',40,50,100,120,'aguilucho_papialbo.jpg',8),(21,'Aguja colinegra','Limosa limosa','La aguja colinegra, con su considerable tamaño y su largo pico, es una de las limícolas más fácilmente identificables, salvo una posible confusión con la aguja colipinta. Se trata de una especie fundamentalmente invernante que también resulta bastante común durante la migración. Tanto en una época como en la otra, ocupa marismas, saladares, arrozales, humedales interiores y estuarios. Se han registrado algunas reproducciones esporádicas en diferentes regiones de la Península.','Charadriiformes','Scolopacidae',37,42,63,74,'aguja_colinegra.jpg',5),(22,'Aguja colipinta','Limosa lapponica','Más costera que su pariente la colinegra, la aguja colipinta es un ave migradora que en nuestro territorio aparece sobre todo a lo largo de los pasos migratorios y, con mucha menor frecuencia, durante el periodo invernal. Ocupa entonces playas, estuarios, marismas y aguazales costeros de la fachada cántabro-atlántica de la Península, en los que encuentra un abundante surtido de los gusanos, insectos, crustáceos y pequeños moluscos que habitualmente componen su dieta.','Charadriiformes','Scolopacidae',37,39,70,80,'aguja_colipinta.jpg',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=640 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ave_provincia_periodo`
--

LOCK TABLES `ave_provincia_periodo` WRITE;
/*!40000 ALTER TABLE `ave_provincia_periodo` DISABLE KEYS */;
INSERT INTO `ave_provincia_periodo` VALUES (1,4,15,1),(2,4,36,1),(3,4,27,1),(4,4,32,1),(5,4,33,1),(6,4,39,1),(7,4,24,1),(8,4,9,1),(9,4,48,1),(10,4,20,1),(11,4,1,1),(12,4,22,1),(13,4,25,1),(14,4,8,1),(15,4,44,1),(16,4,12,1),(17,4,40,1),(18,4,5,1),(19,4,10,1),(20,4,18,1),(21,4,2,2),(22,4,3,2),(23,4,4,2),(24,4,6,2),(25,4,7,2),(26,4,11,2),(27,4,13,2),(28,4,14,2),(29,4,16,2),(30,4,17,2),(31,4,19,2),(32,4,21,2),(33,4,23,2),(34,4,26,2),(35,4,28,2),(36,4,29,2),(37,4,30,2),(38,4,31,2),(39,4,34,2),(40,4,35,2),(41,4,37,2),(42,4,38,2),(43,4,41,2),(44,4,42,2),(45,4,43,2),(46,4,45,2),(47,4,46,2),(48,4,47,2),(49,4,49,2),(50,4,50,2),(51,4,51,2),(52,4,52,2),(53,3,2,3),(54,3,3,3),(55,3,4,3),(56,3,5,3),(57,3,6,3),(58,3,7,3),(59,3,8,3),(60,3,9,3),(61,3,10,3),(62,3,11,3),(63,3,12,3),(64,3,13,3),(65,3,14,3),(66,3,16,3),(67,3,17,3),(68,3,18,3),(69,3,19,3),(70,3,21,3),(71,3,22,3),(72,3,23,3),(73,3,24,3),(74,3,25,3),(75,3,26,3),(76,3,28,3),(77,3,29,3),(78,3,30,3),(79,3,31,3),(80,3,34,3),(81,3,35,3),(82,3,37,3),(83,3,38,3),(84,3,40,3),(85,3,41,3),(86,3,42,3),(87,3,43,3),(88,3,44,3),(89,3,45,3),(90,3,46,3),(91,3,47,3),(92,3,49,3),(93,3,50,3),(94,3,51,3),(95,3,52,3),(96,6,3,1),(97,6,4,1),(98,6,6,1),(99,6,7,1),(100,6,11,1),(101,6,12,1),(102,6,18,1),(103,6,21,1),(104,6,29,1),(105,6,30,1),(106,6,35,1),(107,6,38,1),(108,6,41,1),(109,6,43,1),(110,6,45,1),(111,6,46,1),(112,6,51,1),(113,6,52,1),(114,6,1,3),(115,6,2,3),(116,6,5,3),(117,6,8,3),(118,6,9,3),(119,6,10,3),(120,6,13,3),(121,6,14,3),(122,6,15,3),(123,6,16,3),(124,6,17,3),(125,6,19,3),(126,6,22,3),(127,6,23,3),(128,6,24,3),(129,6,25,3),(130,6,26,3),(131,6,27,3),(132,6,28,3),(133,6,31,3),(134,6,32,3),(135,6,34,3),(136,6,36,3),(137,6,37,3),(138,6,40,3),(139,6,42,3),(140,6,44,3),(141,6,47,3),(142,6,49,3),(143,6,50,3),(144,5,1,3),(145,5,5,3),(146,5,10,3),(147,5,15,3),(148,5,17,3),(149,5,20,3),(150,5,22,3),(151,5,25,3),(152,5,26,3),(153,5,27,3),(154,5,31,3),(155,5,32,3),(156,5,33,3),(157,5,36,3),(158,5,37,3),(159,5,39,3),(160,5,40,3),(161,5,48,3),(162,5,50,3),(163,7,1,1),(164,7,5,1),(165,7,10,1),(166,7,18,1),(167,7,20,1),(168,7,22,1),(169,7,24,1),(170,7,25,1),(171,7,26,1),(172,7,33,1),(173,7,34,1),(174,7,39,1),(175,7,41,1),(176,7,42,1),(177,7,48,1),(178,7,49,1),(179,7,1,2),(180,7,2,2),(181,7,5,2),(182,7,9,2),(183,7,12,2),(184,7,15,2),(185,7,17,2),(186,7,18,2),(187,7,19,2),(188,7,22,2),(189,7,24,2),(190,7,25,2),(191,7,28,2),(192,7,31,2),(193,7,33,2),(194,7,34,2),(195,7,37,2),(196,7,39,2),(197,7,40,2),(198,7,42,2),(199,7,44,2),(200,7,49,2),(201,7,50,2),(202,7,51,2),(203,8,3,2),(204,8,6,2),(205,8,7,2),(206,8,8,2),(207,8,11,2),(208,8,15,2),(209,8,16,2),(210,8,17,2),(211,8,21,2),(212,8,22,2),(213,8,24,2),(214,8,28,2),(215,8,29,2),(216,8,31,2),(217,8,32,2),(218,8,33,2),(219,8,34,2),(220,8,36,2),(221,8,39,2),(222,8,43,2),(223,8,45,2),(224,8,46,2),(225,8,47,2),(226,8,48,2),(227,8,49,2),(228,8,50,2),(229,8,51,2),(230,8,52,2),(231,9,5,1),(232,9,32,1),(233,9,49,1),(234,9,1,2),(235,9,2,2),(236,9,3,2),(237,9,4,2),(238,9,6,2),(239,9,7,2),(240,9,8,2),(241,9,9,2),(242,9,10,2),(243,9,11,2),(244,9,12,2),(245,9,13,2),(246,9,14,2),(247,9,15,2),(248,9,16,2),(249,9,17,2),(250,9,18,2),(251,9,19,2),(252,9,20,2),(253,9,21,2),(254,9,22,2),(255,9,23,2),(256,9,24,2),(257,9,25,2),(258,9,26,2),(259,9,27,2),(260,9,28,2),(261,9,29,2),(262,9,30,2),(263,9,31,2),(264,9,33,2),(265,9,34,2),(266,9,35,2),(267,9,36,2),(268,9,37,2),(269,9,38,2),(270,9,40,2),(271,9,41,2),(272,9,42,2),(273,9,43,2),(274,9,44,2),(275,9,45,2),(276,9,46,2),(277,9,47,2),(278,9,48,2),(279,9,50,2),(280,9,51,2),(281,9,52,2),(282,10,22,1),(283,10,24,1),(284,10,25,1),(285,10,26,1),(286,10,31,1),(287,10,33,1),(288,10,34,1),(289,10,39,1),(290,11,1,1),(291,11,2,1),(292,11,3,1),(293,11,4,1),(294,11,5,1),(295,11,6,1),(296,11,8,1),(297,11,9,1),(298,11,10,1),(299,11,11,1),(300,11,12,1),(301,11,13,1),(302,11,14,1),(303,11,15,1),(304,11,16,1),(305,11,17,1),(306,11,18,1),(307,11,19,1),(308,11,20,1),(309,11,21,1),(310,11,22,1),(311,11,23,1),(312,11,24,1),(313,11,25,1),(314,11,26,1),(315,11,27,1),(316,11,28,1),(317,11,29,1),(318,11,30,1),(319,11,31,1),(320,11,32,1),(321,11,33,1),(322,11,34,1),(323,11,36,1),(324,11,37,1),(325,11,39,1),(326,11,40,1),(327,11,41,1),(328,11,42,1),(329,11,43,1),(330,11,44,1),(331,11,45,1),(332,11,46,1),(333,11,47,1),(334,11,48,1),(335,11,49,1),(336,11,50,1),(337,11,51,1),(338,12,7,1),(339,12,11,1),(340,12,21,1),(341,12,29,1),(342,12,3,2),(343,12,4,2),(344,12,8,2),(345,12,12,2),(346,12,30,2),(347,12,43,2),(348,12,46,2),(349,12,1,3),(350,12,2,3),(351,12,5,3),(352,12,9,3),(353,12,10,3),(354,12,16,3),(355,12,18,3),(356,12,19,3),(357,12,20,3),(358,12,22,3),(359,12,23,3),(360,12,24,3),(361,12,25,3),(362,12,26,3),(363,12,27,3),(364,12,28,3),(365,12,31,3),(366,12,34,3),(367,12,37,3),(368,12,40,3),(369,12,42,3),(370,12,44,3),(371,12,45,3),(372,12,47,3),(373,12,49,3),(374,12,51,3),(375,13,2,1),(376,13,5,1),(377,13,6,1),(378,13,10,1),(379,13,11,1),(380,13,13,1),(381,13,14,1),(382,13,19,1),(383,13,21,1),(384,13,23,1),(385,13,28,1),(386,13,40,1),(387,13,41,1),(388,13,45,1),(389,14,2,1),(390,14,3,1),(391,14,4,1),(392,14,6,1),(393,14,7,1),(394,14,8,1),(395,14,10,1),(396,14,11,1),(397,14,12,1),(398,14,13,1),(399,14,14,1),(400,14,16,1),(401,14,17,1),(402,14,18,1),(403,14,19,1),(404,14,21,1),(405,14,23,1),(406,14,25,1),(407,14,26,1),(408,14,29,1),(409,14,30,1),(410,14,37,1),(411,14,41,1),(412,14,43,1),(413,14,44,1),(414,14,45,1),(415,14,46,1),(416,14,49,1),(417,14,50,1),(418,15,7,1),(419,15,35,1),(420,15,38,1),(421,15,11,2),(422,15,17,2),(423,15,21,2),(424,15,43,2),(425,15,51,2),(426,16,1,1),(427,16,2,1),(428,16,3,1),(429,16,4,1),(430,16,6,1),(431,16,8,1),(432,16,9,1),(433,16,10,1),(434,16,11,1),(435,16,12,1),(436,16,13,1),(437,16,14,1),(438,16,16,1),(439,16,17,1),(440,16,18,1),(441,16,19,1),(442,16,21,1),(443,16,22,1),(444,16,23,1),(445,16,24,1),(446,16,25,1),(447,16,26,1),(448,16,28,1),(449,16,29,1),(450,16,30,1),(451,16,31,1),(452,16,32,1),(453,16,33,1),(454,16,34,1),(455,16,37,1),(456,16,39,1),(457,16,40,1),(458,16,41,1),(459,16,42,1),(460,16,43,1),(461,16,44,1),(462,16,45,1),(463,16,46,1),(464,16,49,1),(465,16,50,1),(466,17,1,3),(467,17,2,3),(468,17,3,3),(469,17,5,3),(470,17,6,3),(471,17,7,3),(472,17,9,3),(473,17,10,3),(474,17,11,3),(475,17,12,3),(476,17,13,3),(477,17,14,3),(478,17,15,3),(479,17,16,3),(480,17,17,3),(481,17,18,3),(482,17,19,3),(483,17,21,3),(484,17,22,3),(485,17,23,3),(486,17,24,3),(487,17,25,3),(488,17,26,3),(489,17,27,3),(490,17,28,3),(491,17,29,3),(492,17,30,3),(493,17,31,3),(494,17,32,3),(495,17,33,3),(496,17,34,3),(497,17,36,3),(498,17,37,3),(499,17,39,3),(500,17,40,3),(501,17,41,3),(502,17,42,3),(503,17,43,3),(504,17,44,3),(505,17,45,3),(506,17,47,3),(507,17,49,3),(508,17,50,3),(509,18,1,1),(510,18,2,1),(511,18,7,1),(512,18,11,1),(513,18,13,1),(514,18,14,1),(515,18,16,1),(516,18,17,1),(517,18,18,1),(518,18,19,1),(519,18,21,1),(520,18,22,1),(521,18,23,1),(522,18,24,1),(523,18,25,1),(524,18,29,1),(525,18,31,1),(526,18,34,1),(527,18,40,1),(528,18,42,1),(529,18,45,1),(530,18,47,1),(531,18,49,1),(532,18,50,1),(533,18,3,2),(534,18,4,2),(535,18,5,2),(536,18,6,2),(537,18,8,2),(538,18,9,2),(539,18,10,2),(540,18,12,2),(541,18,15,2),(542,18,20,2),(543,18,26,2),(544,18,28,2),(545,18,30,2),(546,18,33,2),(547,18,36,2),(548,18,37,2),(549,18,39,2),(550,18,41,2),(551,18,43,2),(552,18,44,2),(553,18,46,2),(554,18,51,2),(555,18,52,2),(556,19,1,1),(557,19,9,1),(558,19,13,1),(559,19,15,1),(560,19,17,1),(561,19,19,1),(562,19,20,1),(563,19,24,1),(564,19,26,1),(565,19,27,1),(566,19,28,1),(567,19,31,1),(568,19,32,1),(569,19,33,1),(570,19,34,1),(571,19,36,1),(572,19,37,1),(573,19,39,1),(574,19,40,1),(575,19,45,1),(576,19,48,1),(577,19,49,1),(578,19,2,2),(579,19,3,2),(580,19,4,2),(581,19,5,2),(582,19,6,2),(583,19,7,2),(584,19,8,2),(585,19,10,2),(586,19,11,2),(587,19,12,2),(588,19,14,2),(589,19,16,2),(590,19,18,2),(591,19,21,2),(592,19,22,2),(593,19,23,2),(594,19,25,2),(595,19,29,2),(596,19,30,2),(597,19,41,2),(598,19,42,2),(599,19,43,2),(600,19,44,2),(601,19,46,2),(602,19,47,2),(603,19,50,2),(604,19,51,2),(605,20,2,2),(606,20,6,2),(607,20,10,2),(608,20,11,2),(609,20,12,2),(610,20,13,2),(611,20,30,2),(612,20,45,2),(613,20,46,2),(614,20,50,2),(615,21,3,2),(616,21,4,2),(617,21,6,2),(618,21,10,2),(619,21,11,2),(620,21,15,2),(621,21,21,2),(622,21,27,2),(623,21,36,2),(624,21,39,2),(625,21,41,2),(626,21,43,2),(627,21,45,2),(628,21,46,2),(629,22,3,2),(630,22,11,2),(631,22,15,2),(632,22,21,2),(633,22,27,2),(634,22,35,2),(635,22,36,2),(636,22,38,2),(637,22,39,2),(638,22,41,2),(639,22,43,2);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `foto`
--

LOCK TABLES `foto` WRITE;
/*!40000 ALTER TABLE `foto` DISABLE KEYS */;
INSERT INTO `foto` VALUES (6,8,3,'68112c112708c_abejaruco.jpg',NULL,'2025-04-29 21:44:17'),(7,8,19,'681621749a622_F145_Foto_01.jpg',NULL,'2025-05-03 16:00:20'),(8,8,22,'681621867054c_F243_Foto_01.jpg',NULL,'2025-05-03 16:00:38'),(9,8,22,'681623202eb45_F243_Foto_03.jpg',NULL,'2025-05-03 16:07:28'),(10,7,13,'6816251f88b42_Aguila-imperial-iberica-©Ondrej-Prosicky-iStock-1294142583-scaled.jpg',NULL,'2025-05-03 16:15:59');
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
INSERT INTO `provincia` VALUES (1,1,'Álava'),(2,2,'Albacete'),(3,3,'Alicante'),(4,4,'Almería'),(5,5,'Ávila'),(6,6,'Badajoz'),(7,7,'Baleares'),(8,8,'Barcelona'),(9,9,'Burgos'),(10,10,'Cáceres'),(11,11,'Cádiz'),(12,12,'Castellón'),(13,13,'Ciudad Real'),(14,14,'Córdoba'),(15,15,'A Coruña'),(16,16,'Cuenca'),(17,17,'Gerona'),(18,18,'Granada'),(19,19,'Guadalajara'),(20,20,'Guipúzcoa'),(21,21,'Huelva'),(22,22,'Huesca'),(23,23,'Jaén'),(24,24,'León'),(25,25,'Lérida'),(26,26,'La Rioja'),(27,27,'Lugo'),(28,28,'Madrid'),(29,29,'Málaga'),(30,30,'Murcia'),(31,31,'Navarra'),(32,32,'Orense'),(33,33,'Asturias'),(34,34,'Palencia'),(35,35,'Las Palmas de Gran Canaria'),(36,36,'Pontevedra'),(37,37,'Salamanca'),(38,38,'Santa Cruz de Tenerife'),(39,39,'Cantabria'),(40,40,'Segovia'),(41,41,'Sevilla'),(42,42,'Soria'),(43,43,'Tarragona'),(44,44,'Teruel'),(45,45,'Toledo'),(46,46,'Valencia'),(47,47,'Valladolid'),(48,48,'Vizcaya'),(49,49,'Zamora'),(50,50,'Zaragoza'),(51,51,'Ceuta'),(52,52,'Melilla');
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

-- Dump completed on 2025-05-03 17:00:33
