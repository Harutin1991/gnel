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
-- Table structure for table `excel`
--

DROP TABLE IF EXISTS `excel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `excel` (
  `city_en` varchar(64) DEFAULT NULL,
  `city_am` varchar(64) DEFAULT NULL,
  `city_ru` varchar(64) DEFAULT NULL,
  `price` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `excel`
--

LOCK TABLES `excel` WRITE;
/*!40000 ALTER TABLE `excel` DISABLE KEYS */;
INSERT INTO `excel` VALUES ('Abovyan','Աբովյան','Абовян',1700),('Aghveran','Աղվերան','Агверан',4000),('Alaverdi','Ալավերդի','Алаверди',14000),('Aparan','Ապարան','Апаран',5000),('Ararat','Արարատ','Арарат',5000),('Armavir','Արմավիր','Армавир',4000),('Arzni','Արզնի','Арзни',3000),('Artik','Արթիկ','Артик',9000),('Artashat','Արտաշատ','Арташат',1700),('Ashtarak','Աշտարակ','Аштарак',1700),('Bjni','Բջնի','Бжни',4000),('Chambarak','Ճամբարակ','Чамбарак',12000),('Charentsavan','Չարենցավան','Чаренцаван',3000),('Dilijan','Դիլիջան','Дилижан',8000),('Dzoraghbyur','Ձորաղբյուր','Дзорахпюр',1000),('Echmiadzin','Էջմիածին','Эчмиадзин',2000),('Garni','Գառնի','Гарни',3000),('Gavar','Գավառ','Гавар',8500),('Goris','Գորիս','Горис',21000),('Gyumri','Գյումրի','Гюмри',11000),('Hankavan','Հանքավան','Анкаван',6000),('Hrazdan','Հրազդան','Раздан',4000),('Ijevan','Իջևան','Иджеван',11000),('Jermuk','Ջերմուկ','Джермук',15000),('Jrvezh','Ջրվեժ','Джрвеж',700),('Kapan','Կապան','Капан',31000),('Kharberd','Խարբերդ','Харберд',1300),('Martuni','Մարտունի','Мартуни',10000),('Masis','Մասիս','Масис',1700),('Meghri','Մեղրի','Мегри',36000),('Metsamor','Մեծամոր','Мецамор',3000),('Nor Hachn','Նոր Հաճն','Нор Ачн',2500),('Noyemberyan','Նոյեմբերյան','Нойемберян',17000),('Ptghni','Պտղնի','Птгни',1200),('Sevan','Սևան','Севан',5000),('Sisian','Սիսիան','Сисиан',17000),('Spitak','Սպիտակ','Спитак',8500),('Stepanakert','Ստեփանակերտ','Степанакерт',31000),('Stepanavan','Ստեփանավան','Степанаван',12000),('Tsakhkadzor','Ծաղկաձոր','Цахкадзор',4000),('Vahagni neighborhood','Վահագնի թաղամաս','Квартал “Ваагни”',1000),('Vanadzor','Վանաձոր','Ванадзор',11000),('Vardenis','Վարդենիս','Варденис',13000),('Vayk','Վայք','Вайк',11000),('Vedi','Վեդի','Веди',5000),('Yeghegnadzor','Եղեգնաձոր','Егегнадзор',10000),('Yeghvard','Եղվարդ','Егвард',1700),('“Zvartnots” Airport','«Զվարթնոց» օդանավակայան','Аэропорт “Звартноц”',800),('Nubarashen','Նուբարաշեն','Нубарашен',1000),('Talin','Թալին','Талин',8500),('Ayntap','Այնթապ','Айнтап',1200),('Zovuni','Զովունի','Зовуни',1000);
/*!40000 ALTER TABLE `excel` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:02:44
