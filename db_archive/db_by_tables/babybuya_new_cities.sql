CREATE DATABASE  IF NOT EXISTS `babybuya_new` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `babybuya_new`;
-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (x86_64)
--
-- Host: ifastnet6.org    Database: babybuya_new
-- ------------------------------------------------------
-- Server version	5.5.45-cll-lve

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
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `country_id` int(4) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 NOT NULL,
  `price` int(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,8,'Yerevan',0),(2,8,'Abovyan',1700),(3,8,'Aghveran',4000),(4,8,'Alaverdi',14000),(5,8,'Aparan',5000),(6,8,'Ararat',5000),(7,8,'Armavir',4000),(8,8,'Arzni',3000),(9,8,'Artik',9000),(10,8,'Artashat',1700),(11,8,'Ashtarak',1700),(12,8,'Bjni',4000),(13,8,'Chambarak',12000),(14,8,'Charentsavan',3000),(15,8,'Dilijan',8000),(16,8,'Dzoraghbyur',1000),(17,8,'Echmiadzin',2000),(18,8,'Garni',3000),(19,8,'Gavar',8500),(20,8,'Goris',21000),(21,8,'Gyumri',11000),(22,8,'Hankavan',6000),(23,8,'Hrazdan',4000),(24,8,'Ijevan',11000),(25,8,'Jermuk',15000),(26,8,'Jrvezh',700),(27,8,'Kapan',31000),(28,8,'Kharberd',1300),(29,8,'Martuni',10000),(30,8,'Masis',1700),(31,8,'Meghri',36000),(32,8,'Metsamor',3000),(33,8,'Nor Hachn',2500),(34,8,'Noyemberyan',17000),(35,8,'Ptghni',1200),(36,8,'Sevan',5000),(37,8,'Sisian',17000),(38,8,'Spitak',8500),(39,8,'Stepanakert',31000),(40,8,'Stepanavan',12000),(41,8,'Tsakhkadzor',4000),(42,8,'Vahagni neighborhood',1000),(43,8,'Vanadzor',11000),(44,8,'Vardenis',13000),(45,8,'Vayk',11000),(46,8,'Vedi',5000),(47,8,'Yeghegnadzor',10000),(48,8,'Yeghvard',1700),(49,8,'“Zvartnots” Airport',1000),(50,8,'Nubarashen',1000),(51,8,'Talin',8500),(52,8,'Ayntap',1200),(53,8,'Zovuni',1000);
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:03:33
