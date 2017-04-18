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
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `countries` (
  `id` bigint(10) unsigned NOT NULL AUTO_INCREMENT,
  `abbr` char(2) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `abbr` (`abbr`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'US','United States'),(2,'AD','Andorra'),(3,'AE','United Arab Emirates'),(4,'AF','Afghanistan'),(5,'AG','Antigua and Barbuda'),(6,'AI','Anguilla'),(7,'AL','Albania'),(8,'AM','Armenia'),(9,'AN','Netherlands Antilles'),(10,'AO','Angola'),(11,'AQ','Antarctica'),(12,'AR','Argentina'),(13,'AS','American Samoa'),(14,'AT','Austria'),(15,'AU','Australia'),(16,'AW','Aruba'),(18,'BA','Bosnia and Herzegovina'),(19,'BB','Barbados'),(20,'BD','Bangladesh'),(21,'BE','Belgium'),(22,'BF','Burkina Faso'),(23,'BG','Bulgaria'),(24,'BH','Bahrain'),(25,'BI','Burundi'),(26,'BJ','Benin'),(27,'BM','Bermuda'),(28,'BN','Brunei Darussalam'),(29,'BO','Bolivia'),(30,'BR','Brazil'),(31,'BS','Bahamas'),(32,'BT','Bhutan'),(33,'BV','Bouvet Island'),(34,'BW','Botswana'),(35,'BY','Belarus'),(36,'BZ','Belize'),(37,'CA','Canada'),(38,'CC','Cocos (Keeling Islands)'),(39,'CD','Congo (DRC)'),(40,'CF','Central African Republic'),(41,'CG','Congo'),(42,'CH','Switzerland'),(43,'CI','Cote D\'Ivoire (Ivory Coast)'),(44,'CK','Cook Islands'),(45,'CL','Chile'),(46,'CM','Cameroon'),(47,'CN','China'),(48,'CO','Colombia'),(49,'CR','Costa Rica'),(50,'CU','Cuba'),(51,'CV','Cape Verde'),(52,'CX','Christmas Island'),(53,'CY','Cyprus'),(54,'CZ','Czech Republic'),(55,'DE','Germany'),(56,'DJ','Djibouti'),(57,'DK','Denmark'),(58,'DM','Dominica'),(59,'DO','Dominican Republic'),(60,'DZ','Algeria'),(61,'EC','Ecuador'),(62,'EE','Estonia'),(63,'EG','Egypt'),(64,'EH','Western Sahara'),(65,'ER','Eritrea'),(66,'ES','Spain'),(67,'ET','Ethiopia'),(68,'FI','Finland'),(69,'FJ','Fiji'),(70,'FK','Falkland Islands (Malvinas)'),(71,'FM','Micronesia'),(72,'FO','Faroe Islands'),(73,'FR','France'),(74,'FX','France, Metropolitan'),(75,'GA','Gabon'),(76,'GB','United Kingdom'),(77,'GD','Grenada'),(78,'GE','Georgia'),(79,'GF','French Guiana'),(80,'GH','Ghana'),(81,'GI','Gibraltar'),(82,'GL','Greenland'),(83,'GM','Gambia'),(84,'GN','Guinea'),(85,'GP','Guadeloupe'),(86,'GQ','Equatorial Guinea'),(87,'GR','Greece'),(88,'GS','S. Georgia and S. Sandwich Isls.'),(89,'GT','Guatemala'),(90,'GU','Guam'),(91,'GW','Guinea-Bissau'),(92,'GY','Guyana'),(93,'HK','Hong Kong'),(94,'HM','Heard and McDonald Islands'),(95,'HN','Honduras'),(96,'HR','Croatia (Hrvatska)'),(97,'HT','Haiti'),(98,'HU','Hungary'),(99,'ID','Indonesia'),(100,'IE','Ireland'),(101,'IL','Israel'),(102,'IN','India'),(103,'IO','British Indian Ocean Territory'),(104,'IQ','Iraq'),(105,'IR','Iran'),(106,'IS','Iceland'),(107,'IT','Italy'),(108,'JM','Jamaica'),(109,'JO','Jordan'),(110,'JP','Japan'),(111,'KE','Kenya'),(112,'KG','Kyrgyzstan'),(113,'KH','Cambodia'),(114,'KI','Kiribati'),(115,'KM','Comoros'),(116,'KN','Saint Kitts and Nevis'),(117,'KP','Korea (North)'),(118,'KR','Korea (South)'),(119,'KW','Kuwait'),(120,'KY','Cayman Islands'),(121,'KZ','Kazakhstan'),(122,'LA','Laos'),(123,'LB','Lebanon'),(124,'LC','Saint Lucia'),(125,'LI','Liechtenstein'),(126,'LK','Sri Lanka'),(127,'LR','Liberia'),(128,'LS','Lesotho'),(129,'LT','Lithuania'),(130,'LU','Luxembourg'),(131,'LV','Latvia'),(132,'LY','Libya'),(133,'MA','Morocco'),(134,'MC','Monaco'),(135,'MD','Moldova'),(136,'MG','Madagascar'),(137,'MH','Marshall Islands'),(138,'MK','Macedonia'),(139,'ML','Mali'),(140,'MM','Myanmar'),(141,'MN','Mongolia'),(142,'MO','Macau'),(143,'MP','Northern Mariana Islands'),(144,'MQ','Martinique'),(145,'MR','Mauritania'),(146,'MS','Montserrat'),(147,'MT','Malta'),(148,'MU','Mauritius'),(149,'MV','Maldives'),(150,'MW','Malawi'),(151,'MX','Mexico'),(152,'MY','Malaysia'),(153,'MZ','Mozambique'),(154,'NA','Namibia'),(155,'NC','New Caledonia'),(156,'NE','Niger'),(157,'NF','Norfolk Island'),(158,'NG','Nigeria'),(159,'NI','Nicaragua'),(160,'NL','Netherlands'),(161,'NO','Norway'),(162,'NP','Nepal'),(163,'NR','Nauru'),(164,'NU','Niue'),(165,'NZ','New Zealand'),(166,'OM','Oman'),(167,'PA','Panama'),(168,'PE','Peru'),(169,'PF','French Polynesia'),(170,'PG','Papua New Guinea'),(171,'PH','Philippines'),(172,'PK','Pakistan'),(173,'PL','Poland'),(174,'PM','St. Pierre and Miquelon'),(175,'PN','Pitcairn'),(176,'PR','Puerto Rico'),(177,'PT','Portugal'),(178,'PW','Palau'),(179,'PY','Paraguay'),(180,'QA','Qatar'),(181,'RE','Reunion'),(182,'RO','Romania'),(183,'RU','Russian Federation'),(184,'RW','Rwanda'),(185,'SA','Saudi Arabia'),(186,'SB','Solomon Islands'),(187,'SC','Seychelles'),(188,'SD','Sudan'),(189,'SE','Sweden'),(190,'SG','Singapore'),(191,'SH','St. Helena'),(192,'SI','Slovenia'),(193,'SJ','Svalbard and Jan Mayen Islands'),(194,'SK','Slovak Republic'),(195,'SL','Sierra Leone'),(196,'SM','San Marino'),(197,'SN','Senegal'),(198,'SO','Somalia'),(199,'SR','Suriname'),(200,'ST','Sao Tome and Principe'),(201,'SV','El Salvador'),(202,'SY','Syria'),(203,'SZ','Swaziland'),(204,'TC','Turks and Caicos Islands'),(205,'TD','Chad'),(206,'TF','French Southern Territories'),(207,'TG','Togo'),(208,'TH','Thailand'),(209,'TJ','Tajikistan'),(210,'TK','Tokelau'),(211,'TM','Turkmenistan'),(212,'TN','Tunisia'),(213,'TO','Tonga'),(214,'TP','East Timor'),(215,'TR','Turkey'),(216,'TT','Trinidad and Tobago'),(217,'TV','Tuvalu'),(218,'TW','Taiwan'),(219,'TZ','Tanzania'),(220,'UA','Ukraine'),(221,'UG','Uganda'),(222,'UM','US Minor Outlying Islands'),(223,'UY','Uruguay'),(224,'UZ','Uzbekistan'),(225,'VA','Holy See (Vatican)'),(226,'VC','Saint Vincent and The Grenadines'),(227,'VE','Venezuela'),(228,'VG','Virgin Islands (British)'),(229,'VI','Virgin Islands (US)'),(230,'VN','Viet Nam'),(231,'VU','Vanuatu'),(232,'WF','Wallis and Futuna Islands'),(233,'WS','Samoa'),(234,'YE','Yemen'),(235,'YT','Mayotte'),(236,'YU','Yugoslavia'),(237,'ZA','South Africa'),(238,'ZM','Zambia'),(239,'ZW','Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:03:47
