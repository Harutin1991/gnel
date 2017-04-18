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
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `rol_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rol_id` (`rol_id`),
  CONSTRAINT `admin_users_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `admin_roles` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'babybuy','babybuy.am@gmail.com','e7dee022184a505f1706ff5d790d28495cf26bc7',1),(2,'marlitoys','sofi.abgaryan@marlitoys.com','ed58928c0ffa1e41a19ab136aecd64b183749a5e',2),(3,'greenpharm','greenpharm_am@yahoo.com','ac2bf25eacbb19d987d67fa4a15a01d917642e1c',2),(4,'nuk','medtur@netsys.am','e4d5175bb0de10dfc2897c356677e20ffd6aee5d',2),(5,'babyland','baby_land@ymail.com','3dfc23837757e71707bc9289adac091167cbe706',2),(6,'avent','','3ab1f01601ecd8941c3c55d8deddb2ba3abed0b4',2),(7,'mankan',' mankan@mankan.am','141375b155926407748a9dbf5cdacfc6137943de',2),(8,'curatio','curatio.llc@gmail.com','789b8ec74aef5a0dfc49c414420595c0c68ed707',2),(9,'stellar','','2fb167c3477092773c204442b69f4ffdea734471',2),(10,'byking','','a987805d69751611b3d82f657bab120c734135c2',2),(11,'huggies','huggies','1355d2f597af178f0c547ae7567d292b7220781f',2),(12,'friso','','f498f4841a99c370ae0ad2b241c11886a1142628',2),(13,'orangeelephant','orange.elephant.hayastan@gmail.com','3c5ee919f0d5465db2cc0b406a071e30b310229f',2),(14,'babysim','baby-sim@mail.ru','0cc59dc9a194e7ac2789688c5d34f0189d0a3b01',2),(15,'pingo','','06bdeed87be906ece606c906ded6d5a8a75b9ddd',2),(16,'chicco','babybuy.am@gmail.com','019e437b9909fcb09910c6111a9f071aba83de9b',2),(17,'humana','','b8cc356fca4d7b4475efbde50039d3557b11b761',2),(18,'pampers','','2736c4df048110c73ffc21f48269cb284eaaf212',2),(19,'libero','','298668c0f3c25c8afd5b3b1ba3a7b87ffdc03d47',2),(20,'creartive','karnahp@mail.ru','b56c2f5e97d7bff1280c1a7779e09976877b98bc',2),(21,'operator','','25e14b883dffe23db4495fcdf4538658aaa81841',3),(22,'admin','','e37e7731fbbaf52eb5dd670ff972a6f3161f357c',2),(23,'wwt','','c46dd3d5b948eeaf0691b9e9a713f14933b7e2b0',2);
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:03:28
