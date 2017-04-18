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
-- Table structure for table `partners_t`
--

DROP TABLE IF EXISTS `partners_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `partner_id` int(11) NOT NULL,
  `lang_code` varchar(2) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brand_id` (`partner_id`,`lang_code`),
  CONSTRAINT `fk_partners` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners_t`
--

LOCK TABLES `partners_t` WRITE;
/*!40000 ALTER TABLE `partners_t` DISABLE KEYS */;
INSERT INTO `partners_t` VALUES (1,1,'am','\"ԱՄԼ\" ՍՊԸ','<p>Ընկերությունը զբաղվում է NUK գերմանական ապրանքանիշի ներկրմամբ: NUK-ը իր մեջ ներառում է մանկական ապրանքների լայն տեսականի:</p>','',''),(2,1,'ru','\"АМЛ\" ООО','<p>Компания занимается марки NUK немецких импорта: NUK- включает в себя широкий спектр детских товаров.</p>','',''),(3,1,'en','\"AML\" LLC','<p>The company is engaged in the NUK brand of German imports: NUK- includes a wide range of children\'s products.</p>','',''),(4,2,'am','«ԴԵՐԺԱՎԱ-Ս» ՓԲԸ','<p class=\"company_name\">&laquo;ԴԵՐԺԱՎԱ-Ս&raquo; փակ բաժնետիրական ընկերությունը զբաղվում է Huggies և մի շարք այլ ֆիրմաների ապրանքների ներկրմամբ:</p>','',''),(5,2,'ru','','','',''),(6,2,'en','','','',''),(7,3,'am','Մանկան','<p>&laquo;Մանկան&raquo; ՍՊԸ հանդիսանում է Հայաստանում մանկական փափուկ խաղալիքների առաջին և միակ արտադրողը, որն առաջարկում է խայտաբղետ խաղալիքների հարուստ տեսականի ՀՀ Տեխնիկական կանոնակարգի պահանջներին համապատասխան:</p>','',''),(8,3,'ru','','','',''),(9,3,'en','','','',''),(10,4,'am','Կուրացիո ՍՊԸ','<p><span >&laquo;ԿՈՒՐԱՑԻՈ&raquo; սահմանափակ պատասխանատվությամբ ընկերություն</span></p>','',''),(11,4,'ru','','','',''),(12,4,'en','','','',''),(13,5,'am','MARLI TOYS','<p>&laquo;MARLI&raquo; ընկերությունը համաշխարհային ճանաչում ունեցող &laquo;MATTEL&raquo; ընկերության պաշտոնական ներկայացուցիչն է Հայաստանում: Ներկայացնում է Fisher Price, Barbie, Hot Wheels, Crayola և այլ հանրահայտ ապրանքանիշեր:</p>','',''),(14,5,'ru','','','',''),(15,5,'en','','','',''),(16,6,'am','«ԳՐԻՆ ՖԱՐՄ» ՍՊԸ','<p>&laquo;ԳՐԻՆ ՖԱՐՄ&raquo; ՍՊԸ ներկայացնում է Bubchen հանրահայտ ֆիրմայի տեսականին:</p>','',''),(17,6,'ru','','','',''),(18,6,'en','','','',''),(19,7,'am','«Մակոն» ՍՊԸ','<p>&laquo;Մակոն&raquo; ՍՊԸ ներկայացնում է Philips Avent&nbsp;հանրահայտ ֆիրմայի տեսականին:</p>','',''),(20,7,'ru','\"МАКОН\" ООО','','',''),(21,7,'en','\"MAKON\" LLC','','','');
/*!40000 ALTER TABLE `partners_t` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:03:26
