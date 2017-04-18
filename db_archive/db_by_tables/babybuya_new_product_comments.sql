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
-- Table structure for table `product_comments`
--

DROP TABLE IF EXISTS `product_comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(8) NOT NULL,
  `product_id` int(8) NOT NULL,
  `comment` text NOT NULL,
  `ip` varchar(32) NOT NULL,
  `comment_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `fk_product_comments_pr_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product_comments_us_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_comments`
--

LOCK TABLES `product_comments` WRITE;
/*!40000 ALTER TABLE `product_comments` DISABLE KEYS */;
INSERT INTO `product_comments` VALUES (47,1,42,'Շատ հարմար խաղալիք է և գնային և բոլոր առումներով: Մենք երեխայի հետ խաղում ենք, շատ է սիրում խաղալ բուրգերով:','95.140.192.81','2015-03-20 09:47:45',1),(48,14,260,'shat hetaqrqir xaxaliq e, hajeli ynker balikneri hamar :)','37.157.217.195','2015-04-21 12:54:12',1),(49,1,260,'Իսկապես մեր բալիկն էլ շատ սիրեց','95.140.192.81','2015-04-21 13:09:20',1),(50,14,56,'shat hetaqrqir sarq e  arje anpayman cerq berel )))','37.157.217.195','2015-04-21 13:31:12',1),(51,22,370,'Lamp@ shat lavn e menk unenk ev ashxatum  e arden  4 tari','95.140.192.81','2015-05-22 09:28:23',1),(52,23,419,'Hrashali xaxaliq e','95.140.192.81','2015-05-27 06:23:13',1),(53,24,331,'Մենք միշտ օգտվում ենք bubchenic և շատ գօհ ենք','95.140.192.81','2015-05-27 06:27:02',1),(54,24,442,'Ինչ հետաքրքիր և օգտակար ապրանք է անպայման ձեռք կբերենք:','95.140.192.81','2015-05-27 06:28:04',1),(55,28,451,'menq unenq u shat enq sirum','95.140.192.81','2015-05-28 05:21:24',1),(56,28,340,'kuzenai imanal inch takdirner en srank inchakan?','95.140.192.81','2015-05-28 05:23:51',1),(57,29,188,'Կներեք,  իսկ Ձեզ մոտ ապրանքների բրենդները իսկական են','95.140.192.81','2015-05-28 07:00:45',1),(58,31,188,'Հարգելի Սեդա մեզ մոտ ներկայացված ամբողջ տեսականին բրենդային  է և հանդիսանում են Հայաստանում տվյալ ապրանքատեսականու պաշտոնական ներկայացուցչի ապրանքը:  Ցանկանում ենք հաճելի գնումներ','95.140.192.81','2015-05-28 09:49:15',1),(59,31,340,'Սիրելի հաճախորդ  pingo տակդիրները արտադրվում են Շվեյցարիայում HYGA շվեյցարական ընկերության կողմից:','95.140.192.81','2015-05-29 05:50:19',1),(60,1,370,'testasdfasfasf','95.140.192.81','2015-05-29 10:03:37',0),(62,2,821,'testasdfasfasf465','95.140.192.82','2015-09-24 12:15:08',0),(63,2,821,'tttest2','95.140.192.82','2015-09-24 13:25:44',0),(64,2,976,'test1','95.140.192.82','2015-10-05 09:22:03',0),(65,2,976,'test2','95.140.192.82','2015-10-05 09:35:15',0),(66,2,799,'test1\\n','95.140.192.82','2015-10-08 11:44:59',0),(67,2,528,'testokmpokmpo','95.140.192.82','2015-10-08 14:18:18',0),(68,2,700,'test','95.140.192.82','2015-10-08 14:19:42',1);
/*!40000 ALTER TABLE `product_comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:02:42
