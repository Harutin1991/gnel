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
-- Table structure for table `rol_permission`
--

DROP TABLE IF EXISTS `rol_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) NOT NULL,
  `url` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol_permission`
--

LOCK TABLES `rol_permission` WRITE;
/*!40000 ALTER TABLE `rol_permission` DISABLE KEYS */;
INSERT INTO `rol_permission` VALUES (3,1,'a:23:{i:0;s:10:\"languages/\";i:1;s:13:\"languages/add\";i:2;s:14:\"languages/edit\";i:3;s:16:\"languages/delete\";i:4;s:5:\"menu/\";i:5;s:8:\"menu/add\";i:6;s:9:\"menu/edit\";i:7;s:12:\"menu/addItem\";i:8;s:13:\"menu/editItem\";i:9;s:11:\"menu/delete\";i:10;s:12:\"custom/index\";i:11;s:6:\"roles/\";i:12;s:9:\"roles/add\";i:13;s:10:\"roles/edit\";i:14;s:12:\"roles/delete\";i:15;s:6:\"users/\";i:16;s:9:\"users/add\";i:17;s:10:\"users/edit\";i:18;s:12:\"users/delete\";i:19;s:5:\"page/\";i:20;s:8:\"page/add\";i:21;s:9:\"page/edit\";i:22;s:11:\"page/delete\";}'),(24,2,'a:12:{s:5:\"brand\";s:6:\"brand/\";s:9:\"brand_add\";s:9:\"brand/add\";s:10:\"brand_edit\";s:10:\"brand/edit\";s:12:\"brand_delete\";s:12:\"brand/delete\";s:7:\"product\";s:8:\"product/\";s:11:\"product_add\";s:11:\"product/add\";s:12:\"product_edit\";s:12:\"product/edit\";s:14:\"product_delete\";s:14:\"product/delete\";s:15:\"product_options\";s:15:\"product/options\";s:17:\"product_addImages\";s:17:\"product/addImages\";s:16:\"product_comments\";s:17:\"product_comments/\";s:14:\"users_personal\";s:14:\"users/personal\";}'),(25,3,'a:15:{s:5:\"brand\";s:6:\"brand/\";s:9:\"brand_add\";s:9:\"brand/add\";s:10:\"brand_edit\";s:10:\"brand/edit\";s:12:\"brand_delete\";s:12:\"brand/delete\";s:8:\"category\";s:9:\"category/\";s:12:\"category_add\";s:12:\"category/add\";s:13:\"category_edit\";s:13:\"category/edit\";s:15:\"category_delete\";s:15:\"category/delete\";s:7:\"product\";s:8:\"product/\";s:11:\"product_add\";s:11:\"product/add\";s:12:\"product_edit\";s:12:\"product/edit\";s:14:\"product_delete\";s:14:\"product/delete\";s:15:\"product_options\";s:15:\"product/options\";s:17:\"product_addImages\";s:17:\"product/addImages\";s:16:\"product_comments\";s:16:\"product/comments\";}');
/*!40000 ALTER TABLE `rol_permission` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:04:01
