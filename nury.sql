-- MySQL dump 10.16  Distrib 10.1.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: nury
-- ------------------------------------------------------
-- Server version	10.1.23-MariaDB-8

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
-- Table structure for table `encounters`
--

DROP TABLE IF EXISTS `encounters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encounters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encounters`
--

LOCK TABLES `encounters` WRITE;
/*!40000 ALTER TABLE `encounters` DISABLE KEYS */;
INSERT INTO `encounters` VALUES (1,112540139,'2017-05-17 19:21:10'),(2,112540139,'2017-05-17 19:21:10'),(3,112540139,'2017-05-17 19:21:10'),(4,112540139,'2017-05-17 19:21:10'),(5,112540139,'2017-05-17 19:21:10'),(6,112540139,'2017-05-17 19:21:10'),(7,112540139,'2017-05-17 19:21:10'),(8,112540139,'2017-05-17 21:13:39');
/*!40000 ALTER TABLE `encounters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `encounters_data`
--

DROP TABLE IF EXISTS `encounters_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `encounters_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `encounter_id` int(11) DEFAULT NULL,
  `encounter_details` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `encounters_data`
--

LOCK TABLES `encounters_data` WRITE;
/*!40000 ALTER TABLE `encounters_data` DISABLE KEYS */;
INSERT INTO `encounters_data` VALUES (1,7,'sdafas'),(2,7,'sfda'),(3,7,'dsfa'),(4,8,'Dolor de cabeza'),(5,8,'Resfriado'),(6,8,'Muesa');
/*!40000 ALTER TABLE `encounters_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `items_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,'Diabetes',1,1,1),(2,'Hipertensión arterial',1,2,1),(3,'Cardiopatías',1,3,1),(4,'Bronquitis crónicas',1,4,1),(5,'Dislipidemias',1,5,1),(6,'Asma',1,6,1),(7,'TB',1,7,1),(8,'Cáncer',1,8,1),(9,'Enfermedad Tiroidea',1,9,1),(10,'Enfermedades Gastrointestinales',1,10,1),(11,'Gastroscopías',1,11,1),(12,'Colonoscopías',1,12,1),(13,'Enfermedades Infecciosas',1,13,1),(14,'Transtornos Neurológicos',1,14,1),(15,'Transtornos Psicológicos',1,15,1),(16,'Enfermedad Renal',1,16,1),(17,'Transtornos Hepáticos',1,17,1),(18,'Enfermedades Articulares',1,18,1),(19,'Accidentes/Intoxicaciones',1,19,1),(20,'Otros',1,20,1),(21,'Hospitalizaciones',1,21,1),(22,'Tabaco',2,1,1),(23,'Etilismo',2,2,1),(24,'Otras drogas',2,3,1),(25,'Alergias',2,4,1),(26,'Alimentación',2,5,1),(27,'Recreación',2,6,1),(28,'Menarca',4,1,1),(29,'F.U.R.',4,2,1),(30,'Ciclos',4,3,1),(31,'Dismenorrea',4,4,1),(32,'Flujos/ITS',4,5,1),(33,'Anticoncepción',4,6,1),(34,'G.P.A.C.V.',4,7,1),(35,'Complicaciones',4,8,1),(36,'P.A.P.',4,9,1),(37,'Automexamen mamas',4,10,1),(38,'Menopausia',4,11,1),(39,'T.S.H.',4,12,1),(40,'Mamografía/U.S.',4,13,1),(41,'Prostatismo',4,14,1),(42,'A.P.E.',4,15,1),(43,'Tacto Rectal',4,16,1),(44,'Densitometría ósea',4,17,1);
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `updated` date NOT NULL,
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `fphone` int(11) NOT NULL,
  `sphone` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `height` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `civilstate` varchar(255) DEFAULT NULL,
  `imc` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES ('2017-05-17',112540139,'Esteban','Monge','Marín','1985-08-28',22906573,86609111,'San Miguel','El creador',123,213,'Divorciado',123);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients_data`
--

DROP TABLE IF EXISTS `patients_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_details` varchar(255) DEFAULT NULL,
  `item_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients_data`
--

LOCK TABLES `patients_data` WRITE;
/*!40000 ALTER TABLE `patients_data` DISABLE KEYS */;
INSERT INTO `patients_data` VALUES (89,112540139,1,'prueba','yes'),(90,112540139,2,'1','no'),(91,112540139,3,'ninguna','yes');
/*!40000 ALTER TABLE `patients_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sections`
--

DROP TABLE IF EXISTS `sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sections`
--

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;
INSERT INTO `sections` VALUES (1,'Antecedentes patológicos',1,1),(2,'Antecedentes no patológicos',2,1),(3,'Antecedentes quirúrgicos',3,1),(4,'Antecedentes ginecoobstétricos',4,1);
/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-17 20:17:12