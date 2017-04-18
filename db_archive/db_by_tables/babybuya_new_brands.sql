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
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `image` varchar(128) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `user_id` int(5) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Nuk','<p>Նուկը գերմանական MAPA GmbH ընկերության ապրանքանիշերից է: Այն շուկայում գործում է ավելի քան 50 տարի: Նուկը մանկական ապրանքների տեսականի է, որը ապահովում է երեխայի ընդհանուր զարգացումը: Տարիների փորձն ու վստահությունը թույլ է տալիս ծննդյան օրից առողջ մեծացնել բալիկին:</p>','Nuk','Nuk','c7325b5abcbccd8941dbeba45d0db627.png','2015-02-10 10:47:56','2015-02-13 10:03:23',4,1),(2,'Փորձնական','','','','f08c98d6c48dd12fe08e332125d7160c.png','2015-02-16 09:20:15','2015-03-20 07:47:38',1,0),(3,'Fisher-Price','<p>Փոքրիկի ծննդյան հենց առաջին օրվանից ծնողի կյանքը լի է երջանիկ պահերով և նորանոր բացահայտումներով: Աշխարհահռչակ&nbsp;Fisher-Price&nbsp;ընկերությունն անում է ամեն ինչ, որպեսզի Ձեր փոքրիկի հետ անցկացրած յուրաքանչյուր ակնթարթը դառնա առավել հետաքրքիր և զվարճալի:&nbsp;Երեխան ակտիվ կերպով սովորում և զարգանում է: Մինչև երեք տարեկանը երեխայի մտավոր, սոցիալական, էմոցիոնալ, ֆիզիկական և ճանաչողական զարգացումներն առաջին հերթին տեղի են ունենում խաղի միջոցով, այդ պատճառով փոքրիկի խաղալիքների ընտրությունը շատ կարևոր է:<','Fisher Price','Fisher Price','dde9615ec6a6fc2c23a154053377257e.png','2015-02-19 07:58:30','2015-05-22 11:37:03',2,1),(4,'Nuby','','Nuby','Nuby','de3ce2f97c2dab48402e4e65c9f8ad79.png','2015-02-19 08:37:53','2015-02-19 13:45:54',5,1),(5,'Bubchen','','Bubchen','Bubchen','34d4663c35fa01b1d634bcabb9541151.png','2015-02-19 09:14:56','2015-05-01 07:07:33',3,1),(6,'Friso','','Friso','Friso','ef875f49f81ced753f631fbce0487907.png','2015-02-19 09:15:35','2015-02-24 08:13:57',12,1),(7,'Crayola','<p><br /><span>Crayola ապրանքանիշի հիմնադիր \"Binney &amp; Smith\" ընկերության պատմությունը սկսվում է 1885թ.-ից: Ընկերությունը զբաղվում էր փայտածուխի վերամշակմամբ: 1903թ.-ից ընկերությունը սկսեց արտադրել նկարչական կավիճներ: Առաջին տուփը ներառում էր 8 գույնի կավիճներ: Հետագայում ընկերությունը ստանում է Crayola (ֆրանսերենից &laquo;craie&raquo; &mdash; կավիճ и &laquo;oleaginous&raquo; &mdash; յուղոտ) անվանումը: 1920թ.-ից սկսում են արտադրել կավիճներ և ներկեր նկարչական հաստատություններում սովորողների համար, որը հայ','Crayola','Crayola','2d225e0cc77071b16a39e9db2cf7f4b3.png','2015-02-24 05:44:34','2015-02-24 08:20:05',2,1),(8,'Philips Avent','<p><span>AVENT ապրանքանիշը ստեղծվել է 1984թ.-ին անգլիական Cannon Rubber (հիմնված 1936թ.) ընկերության կողմից: Ընկերությունն իր առջև խնդիր էր դրել ստեղծել շշեր, որոնք կլինեն ավելի թեթև ու հարմար, իսկ ծծակը կլինի առանց համի ու հոտի և առավել մոտ մայրական կրծքին: Հետագայում արտադրվեցին առաջին կթիչներն ու գոլորշիով ստերիլիզատորները: 2006թ.-ին AVENT-ը ձեռք բերվեց PHILIPS-ի կողմից և վերանվանվեց PHILIPS AVENT. Այսօր էլ մանկական աշխարհում PHILIPS AVENT-ի արտադրանքը զբաղեցնում է առաջատար դիրքեր:</span></p>','avent','avent','c2a100e0001ac4275a9812485390f4c3.png','2015-03-03 11:16:41','2015-05-09 17:17:54',6,1),(9,'Mankan','','Մանկան','Մանկան','d0c2570da68020b35783aa1d6789fd4b.png','2015-03-06 10:45:01','2015-07-25 10:15:13',7,1),(10,'Lansinoh','','Lansinoh','Lansinoh','150f6084ce7daca4f4bcb21d25390f50.png','2015-03-09 06:07:21','2015-05-23 08:59:40',8,1),(11,'Stellar','','Stellar','Stellar','b5b3cc08fe2c25e88cbec900d867186f.png','2015-03-27 05:37:01','2015-03-27 05:37:01',9,1),(12,'Orange Elephant','','Orange Elephant','Orange Elephant','e447243fca852b8103dd6f624a351238.png','2015-03-27 06:00:55','2015-05-04 10:31:12',13,1),(13,'CAM','','CAM','CAM','34af7ca8778121529f0bd836700ead09.png','2015-04-21 06:08:48','2015-04-21 06:48:38',10,1),(14,'test brand','<p>testam</p>','','','8b495f0a93ac622f40c3e781ab8c1509.jpg','2015-04-21 06:23:42','2015-08-08 11:12:35',10,0),(15,'Huggies','','Huggies','Huggies','68ecba75cb8de300165165b1c6d17bc1.png','2015-04-21 12:08:52','2015-05-25 08:10:45',11,1),(16,'Bebi','','Bebi','Bebi','5285bbb31859cafc12d306578c36ca44.png','2015-05-07 13:28:48','2015-05-23 08:32:06',14,1),(17,'Similac','','Similac','Similac','e8ebcc48dc5b0530b33624460a9ddc48.png','2015-05-07 13:30:17','2015-05-23 08:39:13',14,1),(18,'Pingo','','Pingo','Pingo','e0be3105f2e67d0c13044daa953bf6ec.png','2015-05-08 08:11:01','2015-05-08 08:11:01',15,1),(19,'Chicco','','Chicco','Chicco','1e4e46ce5a476e3a56437663472e71de.png','2015-05-14 07:05:46','2015-07-30 13:21:24',16,0),(20,'Humana','','Humana','Humana','4119d17b16500a7f57c0df0b0bf97182.png','2015-05-14 10:00:11','2015-05-14 10:00:11',17,1),(21,'Pampers','','Pampers','Pampers','0e32ef567eecaf441b5f82301f8fc74c.png','2015-05-14 11:55:47','2015-05-14 11:55:47',18,1),(22,'Libero','','Libero','Libero','5d29dbe9d774f18f8f131001ac67857d.png','2015-05-14 13:59:23','2015-05-14 13:59:23',19,1),(24,'Barbie','<p>Ո՞վ չի լսել այս ամենանորաձև տիկնիկների մասին։ Դժվար է պատկերացնել այնպիսի մեկին, ում <strong>Barbie</strong> անունը անհայտ կլինի։ Իսկ եթե այդպիսիք կան, ուրեմն նրանք, անշուշտ, մեկ ուրիշ մոլորակից են։ <strong>Barbie</strong> տիկնիկները դարձել են ոչ միայն տիկնիկների, այլև ընդհանրապես խաղալիքների աշխարհի սիմվոլը։ Յուրաքանչյուր աղջիկ ուրախ կլինի նվեր ստանալ այնպիսի մի տիկնիկ, որը նրա կողքին կլինի յուրաքանչյուր պահի, կդառնա իր բարի խորհրդատուն և ընկերը, տիկնիկ, որը կկարողանա շարժել ձեռքերն ու ոտքերը, գլուխը։&a','Barbie','Barbie','e22e9b18eb21132732cafb95016abd65.png','2015-05-22 12:02:41','2015-05-25 12:06:16',2,1),(25,'Brevi','','Brevi','Brevi','ade3585b1f3d976e3c686f0a3aa8492d.png','2015-05-26 05:38:40','2015-05-26 05:38:40',20,1),(26,'Baby Art','','Baby Art','','2e304ba7551335d2eb6a3633244eb37a.png','2015-06-05 08:33:13','2015-06-05 08:33:13',5,1),(27,'BOOMco','','BOOMco','BOOMco','f36ca9e99f5fc1572ce3df6683f095b6.png','2015-07-01 10:03:31','2015-07-01 10:03:31',2,1),(28,'WWT','','WWT','WWT','71b188ed9c355e681986fbf7a21b31e2.png','2015-09-21 05:30:16','2015-09-24 07:11:57',23,0);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:03:30
