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
-- Table structure for table `menu_items_t`
--

DROP TABLE IF EXISTS `menu_items_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `lang_code` varchar(2) CHARACTER SET latin1 NOT NULL,
  `name` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `lang_code` (`lang_code`),
  CONSTRAINT `fk_menu_items` FOREIGN KEY (`item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items_t`
--

LOCK TABLES `menu_items_t` WRITE;
/*!40000 ALTER TABLE `menu_items_t` DISABLE KEYS */;
INSERT INTO `menu_items_t` VALUES (1,1,'am','Մեր Մասին'),(2,1,'ru','О Нас'),(3,1,'en','About Us'),(10,4,'am','Կազմակերպություններին'),(11,4,'ru','Организациям'),(12,4,'en','Organisations'),(13,5,'am','Կապ'),(14,5,'ru','Контакты'),(15,5,'en','CONTACT US'),(16,6,'am','Առաքում'),(17,6,'ru','Доставка'),(18,6,'en','Delivery'),(22,8,'am','Բրենդներ'),(23,8,'ru','Бренды'),(24,8,'en','Brands'),(25,9,'am','Գործընկերներ'),(26,9,'ru','Партнеры'),(27,9,'en','Partners'),(28,10,'am','Գրանցում'),(29,10,'ru','Регистрация'),(30,10,'en','Register'),(37,13,'am','Իմ Հաշիվը'),(38,13,'ru','Мой Аккаунт'),(39,13,'en','My Account'),(40,14,'am','Խմբագրել'),(41,14,'ru','Редактировать'),(42,14,'en','Edit'),(43,15,'am','Գաղտնաբառ'),(44,15,'ru','Пароль'),(45,15,'en','Password'),(46,16,'am','Հասցե'),(47,16,'ru','Адресные Книги'),(48,16,'en','Address Books'),(49,17,'am','Պատմություն'),(50,17,'ru','История Заказов'),(51,17,'en','Order History'),(52,18,'am','Ելք'),(53,18,'ru','Выход'),(54,18,'en','Logout'),(55,19,'am','Միավորներ'),(56,19,'ru','Очки'),(57,19,'en','Points');
/*!40000 ALTER TABLE `menu_items_t` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:02:17
