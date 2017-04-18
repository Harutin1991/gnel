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
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `last_name` varchar(64) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(64) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `country_id` int(4) NOT NULL DEFAULT '8',
  `city_id` int(8) NOT NULL DEFAULT '1',
  `city` varchar(64) NOT NULL,
  `address` varchar(256) NOT NULL,
  `image` varchar(64) NOT NULL,
  `same_shipping` tinyint(4) NOT NULL DEFAULT '1',
  `ship_first_name` varchar(64) NOT NULL,
  `ship_last_name` varchar(64) NOT NULL,
  `ship_phone` varchar(16) NOT NULL,
  `ship_country_id` int(4) NOT NULL DEFAULT '8',
  `ship_city_id` int(8) NOT NULL DEFAULT '1',
  `ship_city` varchar(64) NOT NULL,
  `ship_address` varchar(256) NOT NULL,
  `additional` varchar(512) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Արմեն','Ադամյան','armen-ia@mail.ru','3d4f2bf07dc1be38b20cd6e46949a1071f9d0e3d','093665305',8,1,'','Լյուքսեմբուրգի 2նրբ. 4շ 33բն','312696439ef4ae62a1e38c768865922f.jpg',1,'Արմեն','Ադամյան','093665305',8,1,'test5','Լյուքսեմբուրգի 2նրբ. 4շ 33բն','',1,'2015-02-25 12:31:06','2015-09-29 07:17:22'),(2,'Պողոս','Ադամյան','adpox@mail.ru','a277aa8920dd1c09f6668815700c958d4d5b36b6','099665305',8,1,'սֆսդֆ','Նոր նորք 6 զ Լյուքսեմբուրգի 2րդ նրբ 4շ 33 բն','1cb28de4783a93c61b2ea38de2204c22.jpg',0,'Պողոս2','Ադամյան','099665305',8,1,'','Նոր նորք 6 զ Լյուքսեմբուրգի 2րդ նրբ 4շ 33 բն','',1,'2015-02-25 13:51:48','2015-09-29 09:08:36'),(14,'Hermine','Sargsyan','hemul.sargsyan@mail.ru','a4ad4438db5f2e4170a947cee87fd7a97d1816be','+37477248977',8,1,'','','2b54f63182adf25a75ea2d7183bb3ca0.jpg',1,'','','',8,1,'','','',1,'2015-04-21 10:12:43','2015-04-21 13:08:30'),(15,'Հերմինե','Ադամյան','herminedarbinyan@mail.ru','900881b58c40dd610421efd754338481fb506cfa','094665305',8,1,'','','',1,'','','',8,1,'','','',1,'2015-04-21 18:54:30','2015-06-14 12:37:14'),(16,'Marusya       ','Mnatsakanyan','hrashushan@mail.ru','53ab287d91f39980cf27fe84e4cbe0f4100806ef','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-14 13:19:15','2015-05-14 13:19:15'),(17,'Marusya','Mnatsakanyan','mnatsakanyan.marusya@mail.ru','53ab287d91f39980cf27fe84e4cbe0f4100806ef','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-15 09:44:24','2015-05-15 09:47:50'),(18,'Narine','ghazaryan','narineghazaryan@yahoo.com','b49fe2b818f6ff2ba65ea627187025258dfa636b','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-17 05:10:07','2015-05-17 05:10:07'),(19,'Meri','Gyurjyan','merigyurjyan@mail.ru','e5ed7ebbf5e83af6a9602ca0406f46821862d29c','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-17 20:40:12','2015-05-17 20:40:12'),(20,'Gohar','Petrosyan','pgohar@list.ru','a9792cf482ad29d3ef056f7cd3aebe951558fcb0','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-21 10:35:43','2015-06-14 10:39:04'),(22,'Սիմոն','Սիմոնյան','simonyansimon@mail.ru','b874602d25fa9929f1fd1ba7161878c0842ccc34','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-22 09:19:57','2015-05-22 09:19:57'),(23,'Կարեն ','Դարբինյան','adpox@rambler.ru','52bdbbcb15097305c094a9235a5f99af2d68d9d5','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-27 06:20:02','2015-05-27 06:20:02'),(24,'Armine','Nahapetyan','poghosadamyan@gmail.com','fdd541efdaa635c25389e08c1d1c99c8d00c02f0','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-27 06:25:03','2015-05-27 06:25:03'),(28,'Lilit','','babyblog.am@gmail.com','70dea2b826de23a0a1c234da4eb666c176e99cf9','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-05-28 05:19:15','2015-05-28 05:19:15'),(29,'Sedul ','','norshen.am@gmail.com','a46e7e5ad98ee85af2236edda5360162113b9231','',8,1,'','','392bc540e742d05f86594c41c25f10cd.jpg',1,'','','',8,1,'','','',1,'2015-05-28 05:25:10','2015-05-28 05:58:35'),(31,'babybuy.am','','babybuy.am@gmail.com','dc34fc2f98454c4286ac3a724c02047160020fb4','',8,1,'','','a9971a74f050c96c8ce8a1edab8817f3.png',1,'','','',8,1,'','','',1,'2015-05-28 09:44:17','2015-05-28 09:46:00'),(32,'Marli ','Toys','sofi.abgaryan@marlitoys.com','914dd2aec66e507832a2f5cff49bb21a4e90ee49','',8,1,'','','c8b8135b90e847031f5a656a68cf92b9.jpg',1,'','','',8,1,'','','',1,'2015-05-29 06:39:23','2015-07-01 08:33:46'),(33,'Orange','Elephant','orange.elephant.hayastan@gmail.com','3c5ee919f0d5465db2cc0b406a071e30b310229f','',8,1,'','','8497a50c4fccb4a22a35c27919d81b83.jpg',1,'','','',8,1,'','','',1,'2015-05-29 07:25:09','2015-05-29 07:27:28'),(34,'Baby ','Sim','baby-sim@mail.ru','0cc59dc9a194e7ac2789688c5d34f0189d0a3b01','',8,1,'','','c1e89061ec8a9e1e4d58bd870a585c00.jpg',1,'','','',8,1,'','','',1,'2015-05-29 11:45:09','2015-05-29 12:02:20'),(35,'Mankan','','mankan@mankan.am','8b1a5584728708ce1168896d70bda2414797c1a4','',8,1,'','','2430670d788482b4eeec3ca84d581604.jpg',1,'','','',8,1,'','','',1,'2015-05-29 12:14:01','2015-05-29 13:21:56'),(36,'Lansinoh','','curatio.llc@gmail.com','789b8ec74aef5a0dfc49c414420595c0c68ed707','',8,1,'','','16537ec85a6624ce2a2ed1cea02014ad.png',1,'','','',8,1,'','','',1,'2015-06-01 05:52:02','2015-06-01 05:54:09'),(37,'lpjyobpe','cancxgub','sample@email.tst','cff8adadc181dd7626329c3bdf46eef4ca79146c','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-06-01 11:42:18','2015-06-01 11:42:18'),(38,'vika','karapetyan','nver_m@mail.ru','d2b09cc86405cce40c0002eef1b9c68d818cf6f9','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-06-03 08:42:19','2015-06-03 08:42:19'),(39,'olbenyosamue','vigorda','carr36879@tom.com','3eba6eaa8559d7880989aa27a216df8a30599a32','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-06-09 10:49:00','2015-06-09 10:49:00'),(40,'cyerchas','ken','lmrrzqelcicy@qq.com','f06e7c72122f4566af56fefa50392c9298d2aa3a','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-06-21 00:56:18','2015-06-21 00:56:18'),(41,'Varsik','Zohrabya','varsik.zohrabyan@mail.ru','c1db299c8a044c988c0ae70a9993eb43ee4a55eb','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-06-26 20:32:11','2015-06-26 20:32:11'),(42,'Armine','Markosyan','armine.markosyan.2013@mail.ru','7bad600c793638d5ec6b1862acfc44a5b2abac46','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-01 11:13:30','2015-07-01 11:13:30'),(43,'inna','aramyan','inkaelhm24@gmail.com','227e195486a7163e4579459144948dc4f36f4504','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-03 07:51:51','2015-07-03 07:51:51'),(44,'Արաքսյա','Համբարձումյան ','allahetq@rambler.ru','6967ed2c01a0bc0058e67c960d11f60b55f52723','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-06 08:18:17','2015-07-06 08:18:17'),(45,'Araks','Gev','gevaraks@mail.ru','8fdf0aa72a836e073a31d3641e9eacceed258c18','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-12 10:42:37','2015-07-12 10:42:37'),(46,'mralmand','Holland','tjzhduym365@hotmail.com','8f5bf01ac3f312113369a2b51245d1d710349a8d','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-13 17:27:51','2015-07-13 17:27:51'),(47,'ieskovichroyc','vigorda','haoyan08072668130@163.com','b8cb7b7652c83fe0af66bb11bb19ac600007ab37','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-13 19:32:37','2015-07-13 19:32:37'),(48,'mariam','pilafyan','alizyan21@gmail.com','02cfb6a9792a6b98d848cf4bb27f81f5c9af9ba9','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-13 21:13:00','2015-07-13 21:13:00'),(49,'mariam','pilafyan','hayaznuhi1103@gmail.com','900fa8ede8d4d2dfabe19d1996cb3745f617bd9a','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-13 21:14:36','2015-07-13 21:14:36'),(50,'elen','kakosyan','mrs717@mail.ru','087bcee59c5ddfdb70b416309646530db4a17b86','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-15 07:11:28','2015-07-15 07:11:28'),(51,'Tatevik','Margaryan','tatevikmargaryanarm@gmail.com','a49129137515679f5054a8fb4784b092331fb891','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-20 07:33:15','2015-07-20 07:33:15'),(52,'meline','gabrielyan  ','gabrielyan-meline@mail.ru','4f1ede64be3dd082196babf8c0b3e1ea1e0f8da2','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-20 12:27:29','2015-07-20 12:27:29'),(53,'cthelocations','ken','yangyancje@eyou.com','0ea1dacbd62d6b838c8e48e674eca0bb0aadd030','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-21 07:21:13','2015-07-21 07:21:13'),(54,'Araqsya','Torosyan','araqsya.torosyan@mail.ru','100cd88fdec05ea9fd7155540c3dca03ae622eea','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-24 05:25:03','2015-07-24 05:25:03'),(55,'Նորայր ','Հայրապետյան','noro09041991@yandex.ru','ac1e123d41698f9ad59f36022605ac8b0d132653','+37498457429',8,1,'','Ք. Երևան,  Գաբրիել  Սունդուկյան 15, բն. 34,   9_րդ հարկ','85b83faa4b99cb2bd14e00b93cdfb599.jpg',1,'','','',8,1,'','','Բնակարանի դոմոֆոնի կոդը  34B',1,'2015-07-27 17:34:51','2015-08-09 10:56:13'),(56,'Julya','Avetisyan','e.avetisyan89@gmail.com','52524476d0eab8ed081769c2bcccbc1a4e89fc48','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-29 12:58:24','2015-07-29 12:58:24'),(57,'Liana','Zaqarian','zaqarian@mail.ru','7b282e36da9e837a355ad0c6e73e793a51643980','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-30 12:47:43','2015-07-30 12:47:43'),(58,'AREN','VANYAN','aren.vanyan@mail.ru','9464ad6d2d2e38554b0d775c0c69092b4f7b4c7c','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-31 10:35:51','2015-07-31 10:35:51'),(59,'Marina','Melikyan','melikyan.marina@gmail.com','2b07728edbd7b48c7b1a2fd02044f99be6b44f39','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-07-31 14:17:48','2015-07-31 14:17:48'),(60,'harut','stepanyan','mr2016harut@mayl.ru','93076ffe82fd0feb40393196a0cb7f29adb02e45','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-07-31 17:47:00','2015-07-31 17:47:00'),(61,'aleamaumind','vigorda','woshiheting990@163.com','d52f01c60ae51a0282e3ef3b6005cc3b425666cf','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-04 15:59:09','2015-08-04 15:59:09'),(62,'oslonm','vigorda','zhangxiuzmp@eyou.com','94e4dca4fa74455c84b511a75d126f7827e30dd8','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-05 02:22:46','2015-08-05 02:22:46'),(63,'Shushanik','Baboyan','Shushan_b@mail.ru','cd69b7bc5c4a4545098702fe1a84bc267a34e848','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-08-05 07:09:21','2015-08-05 07:09:21'),(64,'Vika','Grigorian','viktoriya.grigorian@mail.ru','50991e52699ee171766f42bf3e5b23cf99f302f8','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-08 15:14:22','2015-08-08 15:14:22'),(65,'vachik','dallaqyan','artur.dallaqyan.800@mail.ru','dfc36eaecba2d468d16e1f1cde9bf851ae7b0ae5','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-09 05:59:37','2015-08-09 05:59:37'),(66,'Անահիտ','Սարգսյան','sargsiananahit@gmail.com','3f9ac08ad13257275ab28fbf80280bcb048f0777','+374665997',8,1,'','','',1,'Անահիտ','Սարգսյան','+374665997',8,1,'','Ռայնիսի 5, բնակարան 32','',0,'2015-08-11 05:19:04','2015-08-11 05:19:04'),(67,'Tatev','Harutyunyan','tatevharutyunyan@mail.am','e9e513719b51061c6a923af071311c41e6171947','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-13 09:29:56','2015-08-13 09:29:56'),(68,'MARIAM','VOSKANYAN','nar87mimi@mail.ru','00472606da4e511d92fb784e85ffd4986b022700','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-13 17:57:51','2015-08-13 17:57:51'),(69,'MARIAM','VOSKANYAN','nar87mimi@mail.ua','00472606da4e511d92fb784e85ffd4986b022700','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-13 18:05:12','2015-08-13 18:05:12'),(70,'Samvelina','Buduryan','sem.buduryan@mail.ru','1f34f866c680a81dfd15506b8e58ef0ae2b03551','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-08-16 11:31:04','2015-08-16 11:31:04'),(71,'Hripsime','Tadevosyan','tadevosyanhripsime@bk.ru','d0c410f7e4e142ba0673ff3fe32ca03c0da8b8f1','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-08-18 10:12:14','2015-08-18 10:12:14'),(72,'Bella','aleksanyan','bellka8989@mail.ru','5c6b34ac0ef7db722b0d43cae4c92fe3a3d75d2b','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-18 16:07:25','2015-08-18 16:07:25'),(73,'assensatoLO','assensatoLO','aikfirel@aim.com','3a3cc6a91f3718e02f7c65ceb8440f5e09df63a2','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-21 22:09:14','2015-08-21 22:09:14'),(74,'beganibebrig','Holland','losfalsetta@sohu.com','e2029333a4e61dfc5241367f75141dfd9e6099f1','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-23 12:38:31','2015-08-23 12:38:31'),(75,'Elen','Apoyan','hapoyan@yahoo.com','25abc72f1ce0c5e2ae8225885687114db0da5afd','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-08-26 18:18:49','2015-08-26 18:18:49'),(76,'ARMINE','SAHAKYAN','xachikxachik.89@mail.ru','6d41cc2fc6a740ebd5942d6770cb8a37e73744ec','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-08-27 09:12:41','2015-08-27 09:12:41'),(77,'Tina','Hovhannisyan','hovhannisyan.1985@mail.ru','88ddebd46971f8917cdc83ccae8a09e994575904','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-27 22:57:11','2015-08-27 22:57:11'),(78,'Tina','Hovhannisyan','zatikyan1981@mail.ru','b9ed5d61e604bf85552f2f12e872622022f312a0','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-08-27 23:20:51','2015-08-27 23:20:51'),(79,'Eliza ','Brutyan','elizik@yandex.ru','1f063295c2787f8b02cbeabccd3c9cab96e43df7','055676825',8,1,'','','',1,'Eliza ','Brutyan','055676825',8,1,'','Գ.Մահարի 39ա, 12բն','',0,'2015-09-07 08:06:50','2015-09-07 08:06:50'),(80,'RandallThepEE','RandallThepEE','cggq@gmail.com','25f3e4cdf80350d71c1b76e166c4947d05ebc79a','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-09-07 17:11:53','2015-09-07 17:11:53'),(81,'Gohar','Avetisyan','goharavet@gmail.com','61e9b09a8fe831cb51d35a7cd01c75d62b16e50e','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-09 18:00:29','2015-09-09 18:00:29'),(82,'shushanna','dallakyan','darbinyan.anait@yandex.ru','f4dcbcf218a52751881da7be8d7724a0836619e8','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-09-12 09:36:43','2015-09-12 09:36:43'),(83,'CurtissHefAI','CurtissHefAI','smusenko83@mail.ru','c38f2c270486bfd57394912e4061a012eb8c9540','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-14 02:57:32','2015-09-14 02:57:32'),(84,'KarinaKHatOU','KarinaKHatOU','post2@hotel-les-chardons.com','09bc92d1a4f90f60ef09e59498fc336c98bc8417','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-16 10:40:12','2015-09-16 10:40:12'),(85,'Լիլիթ','Առաքելյան','lilit.araqelyan.k@gmail.com','7ae9335821f58707c9903f770f3c111d66ce44e8','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-20 08:59:57','2015-09-20 08:59:57'),(86,'JosephshixSU','JosephshixSU','honey.triputen@mail.ru','0445836c2d3db7374d13b663e1080340c047e107','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-21 13:04:24','2015-09-21 13:04:24'),(87,'Tatev','Lazaryan','tlazaryan@gmail.com','7d30fb2b8d1640a8415bfffb99510a1db6e6e58a','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-22 19:30:54','2015-09-22 19:30:54'),(88,'sirik','nahapetyan','siriknahapetyan@mail.am','54a78ba80bc786c48987ec8e6eafb74c45aeb1e6','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-09-25 14:36:30','2015-09-25 14:36:30'),(89,'GloriaerYL','GloriaerYL','gloriaPamN@mailgui.pw','813b06862628281c516fd7a1025b4d7ccc79bc69','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-26 06:06:06','2015-09-26 06:06:06'),(90,'ANI','MAKARYAN','mkrtich2014@mail.ru','f1db04b4d8b12e32571bcb5bdbe87ea8ec4f7bf0','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-26 15:22:52','2015-09-26 15:22:52'),(91,'Lilit','Harutyunyan','l.harutyunyan91@gmail.com','b94221b7bb02bd765585aa69105931d5767b1633','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-09-27 10:13:54','2015-09-27 10:13:54'),(92,'Seda','Hakobyan','adamyan.seda@mail.ru','a78b149bc01c756f89397d2b264160a00fb8067f','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-09-28 09:25:50','2015-09-28 09:25:50'),(93,'AAA','VVV','RAFO.RAFO59@MAIL.RU','98f57549905ddbd01c88766918d256dc2cd0c9bc','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-09-29 14:16:52','2015-09-29 14:16:52'),(94,'Marina','Harutyunyan','marina-edo@mail.ru','a5ac20691e18ff366bd4d0d4c59cbad948371bf8','099 94-94-02',8,1,'','','e1930fd454625184a71b1935aea79213.jpg',1,'Marina','Harutyunyan','099 94-94-02',8,1,'','Tigran Meci poxota 58, tun 6','',1,'2015-09-30 11:13:03','2015-09-30 11:24:32'),(95,'ANNA','GASPARYAN','anna-ann1986@mail.ru','0a4e6665f0514a66efffa5b5c72bde13853fe099','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-10-03 14:48:12','2015-10-03 14:48:12'),(96,'ARMEN','POGHOSYAN','ARMEN.PYAN@MAIL.RU','c5c90e60526e250720c8b675c512537a294cee63','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-10-05 07:25:51','2015-10-05 07:25:51'),(97,'Astghik','Grigoryan','grigoryan-a@yandex.ru','ded74d669ad3ac3ee61472627a25e01b411219ae','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-10-10 18:07:19','2015-10-10 18:07:19'),(98,'Test','Test','kamo.harutyunyan.93@mail.ru','0b4fa4d5c669f1dcb6149957b8ceba9c94fd76c7','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-10-12 07:22:32','2015-10-12 07:25:43'),(99,'Qnarik','Mkrtchyan','vardansaribekyan31@mail.ru','800ffdc52257acababaa9bf6d102efe88d61aa40','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-10-14 14:15:29','2015-10-14 14:15:29'),(100,'VARD','VARDANYAN','ti.ko.92@mail.ru','17adad7b0379dc38d70d697e88cf897e8da52a4d','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-10-14 16:34:47','2015-10-14 16:34:47'),(101,'Varsik','Avanesyan','varsmin@mail.ru','a9aa2ecbd1737b553cda778aa95ba366accf7288','091965545',8,1,'','','',1,'Varsik','Avanesyan','091965545',8,1,'','Khorenaci 47/7 bn1','',0,'2015-10-15 11:21:18','2015-10-15 11:22:17'),(102,'Varsik','Avanesyan','varsmin@mail.ru','a9aa2ecbd1737b553cda778aa95ba366accf7288','091965545',8,1,'','','',1,'Varsik','Avanesyan','091965545',8,1,'','Khorenaci 47/7   bn.1 ','',0,'2015-10-15 11:21:26','2015-10-15 11:21:26'),(103,'Levon','Khachaturyan','levon-30@mail.ru','11a551274ee8f77969aa657025978ca563fa7a96','',8,1,'','','',1,'','','',8,1,'','','',0,'2015-10-16 16:47:29','2015-10-16 16:47:29'),(104,'Nun','Stepanyan','nune.stepanyan.95@mail.ru','9e54226bd20b8db973e797e5a24d1faaa7c82a29','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-10-17 22:40:57','2015-10-17 22:40:57'),(105,'JosebouhUG','JosebouhUG','email@newmedicforum.com','9bec2b9b3df2547f691a661788edddafb17bccaa','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-10-19 23:34:57','2015-10-19 23:34:57'),(106,'StepItereXV','StepItereXV','mailinfo@newmedicforum.com','f56be20477552825189dda8aae768973e993ce7c','',8,1,'','','',1,'','','',8,1,'','','',1,'2015-10-20 17:04:09','2015-10-20 17:04:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:03:13