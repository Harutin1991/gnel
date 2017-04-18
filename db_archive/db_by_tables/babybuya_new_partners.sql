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
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partners` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `image` varchar(128) NOT NULL,
  `link` varchar(512) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (1,'\"ԱՄԼ\" ՍՊԸ','<p>Ընկերությունը զբաղվում է NUK գերմանական ապրանքանիշի ներկրմամբ: NUK-ը իր մեջ ներառում է մանկական ապրանքների լայն տեսականի:</p>','b2e0cda0febd7cfd743e072d07db745a.png','#','2015-03-25 14:07:26','2015-05-07 12:25:04',1),(2,'«ԴԵՐԺԱՎԱ-Ս» ՓԲԸ','<p class=\"company_name\">&laquo;ԴԵՐԺԱՎԱ-Ս&raquo; փակ բաժնետիրական ընկերությունը զբաղվում է Huggies և մի շարք այլ ֆիրմաների ապրանքների ներկրմամբ:</p>','7de5f0b1a71fce04c244ae3b8f43e7a9.png','#','2015-03-25 15:40:15','2015-05-07 12:24:34',1),(3,'Մանկան','<p>&laquo;Մանկան&raquo; ՍՊԸ հանդիսանում է Հայաստանում մանկական փափուկ խաղալիքների առաջին և միակ արտադրողը, որն առաջարկում է խայտաբղետ խաղալիքների հարուստ տեսականի ՀՀ Տեխնիկական կանոնակարգի պահանջներին համապատասխան:</p>','db9d0a256777fead37a6fe8c5528ff0a.png','#','2015-05-07 11:50:40','2015-05-07 12:07:38',1),(4,'Կուրացիո ՍՊԸ','<p><span >&laquo;ԿՈՒՐԱՑԻՈ&raquo; սահմանափակ պատասխանատվությամբ ընկերություն</span></p>','682b062c62e809340929405b177b492d.png','#','2015-05-07 12:13:37','2015-05-07 12:13:37',1),(5,'MARLI TOYS','<p>&laquo;MARLI&raquo; ընկերությունը համաշխարհային ճանաչում ունեցող &laquo;MATTEL&raquo; ընկերության պաշտոնական ներկայացուցիչն է Հայաստանում: Ներկայացնում է Fisher Price, Barbie, Hot Wheels, Crayola և այլ հանրահայտ ապրանքանիշեր:</p>','ac1d79c2b633e29723bff9195033bf8c.jpg','#','2015-05-07 12:36:01','2015-05-07 12:48:41',1),(6,'«ԳՐԻՆ ՖԱՐՄ» ՍՊԸ','<p>&laquo;ԳՐԻՆ ՖԱՐՄ&raquo; ՍՊԸ ներկայացնում է Bubchen հանրահայտ ֆիրմայի տեսականին:</p>','69d083bd99ec70d67909dbd98135ef9f.png','https://www.facebook.com/bubchen.am','2015-05-07 13:11:42','2015-05-13 09:16:27',1),(7,'«Մակոն» ՍՊԸ','<p>&laquo;Մակոն&raquo; ՍՊԸ ներկայացնում է Philips Avent&nbsp;հանրահայտ ֆիրմայի տեսականին:</p>','a85bee81ae46d5d99614675e09590111.png','https://www.facebook.com/Philips.AVENT.Armenia','2015-05-13 09:15:08','2015-05-13 09:15:08',1);
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:02:35
