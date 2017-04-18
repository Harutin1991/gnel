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
-- Table structure for table `cities_t`
--

DROP TABLE IF EXISTS `cities_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cities_t` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `city_id` int(8) NOT NULL,
  `lang_code` varchar(4) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `fk_sities_t` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=160 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cities_t`
--

LOCK TABLES `cities_t` WRITE;
/*!40000 ALTER TABLE `cities_t` DISABLE KEYS */;
INSERT INTO `cities_t` VALUES (1,1,'am','Երևան'),(2,1,'ru','Ереван'),(3,1,'en','Yerevan'),(4,2,'am','Աբովյան'),(5,2,'ru','Абовян'),(6,2,'en','Abovyan'),(7,3,'am','Աղվերան'),(8,3,'ru','Агверан'),(9,3,'en','Aghveran'),(10,4,'am','Ալավերդի'),(11,4,'ru','Алаверди'),(12,4,'en','Alaverdi'),(13,5,'am','Ապարան'),(14,5,'ru','Апаран'),(15,5,'en','Aparan'),(16,6,'am','Արարատ'),(17,6,'ru','Арарат'),(18,6,'en','Ararat'),(19,7,'am','Արմավիր'),(20,7,'ru','Армавир'),(21,7,'en','Armavir'),(22,8,'am','Արզնի'),(23,8,'ru','Арзни'),(24,8,'en','Arzni'),(25,9,'am','Արթիկ'),(26,9,'ru','Артик'),(27,9,'en','Artik'),(28,10,'am','Արտաշատ'),(29,10,'ru','Арташат'),(30,10,'en','Artashat'),(31,11,'am','Աշտարակ'),(32,11,'ru','Аштарак'),(33,11,'en','Ashtarak'),(34,12,'am','Բջնի'),(35,12,'ru','Бжни'),(36,12,'en','Bjni'),(37,13,'am','Ճամբարակ'),(38,13,'ru','Чамбарак'),(39,13,'en','Chambarak'),(40,14,'am','Չարենցավան'),(41,14,'ru','Чаренцаван'),(42,14,'en','Charentsavan'),(43,15,'am','Դիլիջան'),(44,15,'ru','Дилижан'),(45,15,'en','Dilijan'),(46,16,'am','Ձորաղբյուր'),(47,16,'ru','Дзорахпюр'),(48,16,'en','Dzoraghbyur'),(49,17,'am','Էջմիածին'),(50,17,'ru','Эчмиадзин'),(51,17,'en','Echmiadzin'),(52,18,'am','Գառնի'),(53,18,'ru','Гарни'),(54,18,'en','Garni'),(55,19,'am','Գավառ'),(56,19,'ru','Гавар'),(57,19,'en','Gavar'),(58,20,'am','Գորիս'),(59,20,'ru','Горис'),(60,20,'en','Goris'),(61,21,'am','Գյումրի'),(62,21,'ru','Гюмри'),(63,21,'en','Gyumri'),(64,22,'am','Հանքավան'),(65,22,'ru','Анкаван'),(66,22,'en','Hankavan'),(67,23,'am','Հրազդան'),(68,23,'ru','Раздан'),(69,23,'en','Hrazdan'),(70,24,'am','Իջևան'),(71,24,'ru','Иджеван'),(72,24,'en','Ijevan'),(73,25,'am','Ջերմուկ'),(74,25,'ru','Джермук'),(75,25,'en','Jermuk'),(76,26,'am','Ջրվեժ'),(77,26,'ru','Джрвеж'),(78,26,'en','Jrvezh'),(79,27,'am','Կապան'),(80,27,'ru','Капан'),(81,27,'en','Kapan'),(82,28,'am','Խարբերդ'),(83,28,'ru','Харберд'),(84,28,'en','Kharberd'),(85,29,'am','Մարտունի'),(86,29,'ru','Мартуни'),(87,29,'en','Martuni'),(88,30,'am','Մասիս'),(89,30,'ru','Масис'),(90,30,'en','Masis'),(91,31,'am','Մեղրի'),(92,31,'ru','Мегри'),(93,31,'en','Meghri'),(94,32,'am','Մեծամոր'),(95,32,'ru','Мецамор'),(96,32,'en','Metsamor'),(97,33,'am','Նոր Հաճն'),(98,33,'ru','Нор Ачн'),(99,33,'en','Nor Hachn'),(100,34,'am','Նոյեմբերյան'),(101,34,'ru','Нойемберян'),(102,34,'en','Noyemberyan'),(103,35,'am','Պտղնի'),(104,35,'ru','Птгни'),(105,35,'en','Ptghni'),(106,36,'am','Սևան'),(107,36,'ru','Севан'),(108,36,'en','Sevan'),(109,37,'am','Սիսիան'),(110,37,'ru','Сисиан'),(111,37,'en','Sisian'),(112,38,'am','Սպիտակ'),(113,38,'ru','Спитак'),(114,38,'en','Spitak'),(115,39,'am','Ստեփանակերտ'),(116,39,'ru','Степанакерт'),(117,39,'en','Stepanakert'),(118,40,'am','Ստեփանավան'),(119,40,'ru','Степанаван'),(120,40,'en','Stepanavan'),(121,41,'am','Ծաղկաձոր'),(122,41,'ru','Цахкадзор'),(123,41,'en','Tsakhkadzor'),(124,42,'am','Վահագնի թաղամաս'),(125,42,'ru','Квартал “Ваагни”'),(126,42,'en','Vahagni neighborhood'),(127,43,'am','Վանաձոր'),(128,43,'ru','Ванадзор'),(129,43,'en','Vanadzor'),(130,44,'am','Վարդենիս'),(131,44,'ru','Варденис'),(132,44,'en','Vardenis'),(133,45,'am','Վայք'),(134,45,'ru','Вайк'),(135,45,'en','Vayk'),(136,46,'am','Վեդի'),(137,46,'ru','Веди'),(138,46,'en','Vedi'),(139,47,'am','Եղեգնաձոր'),(140,47,'ru','Егегнадзор'),(141,47,'en','Yeghegnadzor'),(142,48,'am','Եղվարդ'),(143,48,'ru','Егвард'),(144,48,'en','Yeghvard'),(145,49,'am','Օդանավակայան «Զվարթնոց»'),(146,49,'ru','Аэропорт “Звартноц”'),(147,49,'en','“Zvartnots” Airport'),(148,50,'am','Նուբարաշեն'),(149,50,'ru','Нубарашен'),(150,50,'en','Nubarashen'),(151,51,'am','Թալին'),(152,51,'ru','Талин'),(153,51,'en','Talin'),(154,52,'am','Այնթապ'),(155,52,'ru','Айнтап'),(156,52,'en','Ayntap'),(157,53,'am','Զովունի'),(158,53,'ru','Зовуни'),(159,53,'en','Zovuni');
/*!40000 ALTER TABLE `cities_t` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:03:42
