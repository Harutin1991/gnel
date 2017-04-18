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
-- Table structure for table `blognews_categories_t`
--

DROP TABLE IF EXISTS `blognews_categories_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blognews_categories_t` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(11) NOT NULL,
  `lang_code` varchar(2) NOT NULL,
  `title` varchar(128) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Index blog_categories` (`blog_category_id`),
  CONSTRAINT `fk_blogcategories` FOREIGN KEY (`blog_category_id`) REFERENCES `blognews_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blognews_categories_t`
--

LOCK TABLES `blognews_categories_t` WRITE;
/*!40000 ALTER TABLE `blognews_categories_t` DISABLE KEYS */;
INSERT INTO `blognews_categories_t` VALUES (5,1,'am','Խորհուրդ մայրերին','Խորհուրդ մայրերին','Խորհուրդ մայրերին',''),(6,1,'ru','Советы матерей','Советы матерей','Советы матерей',''),(7,1,'en','Advices for mothers','Advices for mothers','Advices for mothers',''),(8,2,'am','Խաղեր','Խաղեր','Խաղեր','<p>bov</p>'),(9,2,'ru','Игры','Игры','Игры',''),(10,2,'en','Games','Games','Games','<p>bov enn</p>'),(11,3,'am','Առողջություն','Առողջություն','Առողջություն',''),(12,3,'ru','Здоровье','Здоровье','Здоровье',''),(13,3,'en','Health','Health','Health',''),(14,4,'am','Հեքիաթներ','Հեքիաթներ','Հեքիաթներ',''),(15,4,'ru','Сказки','Сказки','Сказки',''),(16,4,'en','Tales','Tales','Tales','');
/*!40000 ALTER TABLE `blognews_categories_t` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:03:21
