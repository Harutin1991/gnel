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
-- Table structure for table `email_validate`
--

DROP TABLE IF EXISTS `email_validate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_validate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `code` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_validate`
--

LOCK TABLES `email_validate` WRITE;
/*!40000 ALTER TABLE `email_validate` DISABLE KEYS */;
INSERT INTO `email_validate` VALUES (7,'adpox@rambler.ru','bNSvrPHXyif7u64DMlBRFyTjxYruEfGP'),(8,'adpox@rambler.ru1','0jAUsHyByMrl74kuRmabjcaO0id6svZs'),(6,'adamyanarmen.ia@gmail.com','FscKAo2nZxjrZSkKO0iMxHNjQ16zyd3e'),(9,'armenadamyan30@gmail.com','5PuofNiARd73CS2yOeXtULQChSQXe79k'),(10,'armenadamyan30@gmail.com','lClTD1q56VYKWuEztjb4KGx3PSxYkuiF'),(12,'hemul.sargsyan@mail.ru','m0OauWlJ4KNOEpQHPu1MgQS11XLSEVd1'),(13,'herminedarbinyan@mail.ru','MiNWm2xGRELK6qprxnoryaqTAqOtkVR6'),(14,'hrashushan@mail.ru','2MZuacuGJgDqMoZFClSbeqnO9yvLSs4U'),(15,'mnatsakanyan.marusya@mail.ru','gZowRLUMj8T2dkRPJ63h9A7mLeUjCrBT'),(16,'narineghazaryan@yahoo.com','EvZIdGOKuUGoW97Bn8fqkxFBBWonpFn4'),(17,'merigyurjyan@mail.ru','etNrfe1CxHXhvXZk3lvYlwN6G8ULwSbK'),(18,'pgohar@list.ru','f9gCXP7GgjWsJkhDjpchWDTSe8Pul8yB'),(19,'maria-galstyan@yandex.ru','fu9gqpOysZJac6HbRA2mg3MtlOQlL681'),(20,'simonyansimon@mail.ru','6MNEgHCLdB5QEnngCba5nEfzo4Moih9o'),(21,'adpox@rambler.ru','ITdOmzbVJsLwXWFJn1p4jzLJjvvKLoSt'),(22,'poghosadamyan@gmail.com','eMHEaShxs3Wbjl1zmaq7ZCIVzIhiVvUa'),(23,'babyblog@gmail.com','qC8El9ZotUVKHNmjbI8FBJzqRkrxW4mn'),(24,'adamyanarmen.ia@gmail.com','dLzmHYYMFpfK9MzdJZmIZKKOg9cPec5s'),(25,'babyblog@gmail.com','tDIOsZH460zTglficqyz84bRJGc7EuZ7'),(26,'babyblog.am@gmail.com','FXWiJnepS5Zxg2DWb0VVShce6YC1XFfC'),(27,'norshen.am@gmail.com','zf72SWGCHWOdkAZWQR2AmYXwQqr26yoF'),(28,'adamyanarmen.ia@gmail.com','RzaO3Ckd24OF3LpY1RZ56UraNDr3fh56'),(29,'adamyanarmen.ia@gmail.com','Aq97r22pDxlS10D2Z11ySF5TX8My6X1G'),(30,'sofi.abgaryan@marlitoys.com','7FxsY7zFlfa4zOh7mttyCtjjnQZ0wSWD'),(31,'orange.elephant.hayastan@gmail.com','JeSngQM1yxThbzBKrLpRibAWc8wzvcDf'),(32,'baby-sim@mail.ru','aZ5JdD9NAFA22hTfA2NMZ6kR6NSMfnyp'),(33,'mankan@mankan.am','jIAbAzI8j4fjvEG2KtFQALFL57ImYvSi'),(34,'curatio.llc@gmail.com','8XN7uohWvD5cmfrYNX9C78wq6fltpk6y'),(35,'sample@email.tst','uVR9TxrukFbMH7yyh0xtc17pZasirORW'),(36,'nver_m@mail.ru','wHYtVwJortZuBS9jzO7tXByBL11ofTML'),(37,'carr36879@tom.com','1q8VpxOV61IjcEDw2z3NACyvXFTAvYGx'),(38,'lmrrzqelcicy@qq.com','GgP2cNYYgzfY7PxHPNUxxZcFgQ8C3lkJ'),(39,'varsik.zohrabyan@mail.ru','fW4NAZkFHghQA3Hg0WypzS3euex8zIZO'),(40,'armine.markosyan.2013@mail.ru','vQRlPkN0Twype9zCdYvIpt1yMGO7F6xb'),(41,'inkaelhm24@gmail.com','HDTGR0v15omXYJGTae8kzbCNpHG4qwY8'),(42,'allahetq@rambler.ru','03KwI30mQEBpkhVi3vs6QibviuyQ1YD2'),(43,'gevaraks@mail.ru','hfyNXyi8FzKLccdXUUbVZWAlezqpyC0P'),(44,'tjzhduym365@hotmail.com','ZQL19AdRb5P73qUXlh0LwVLpdIxPfZPf'),(45,'haoyan08072668130@163.com','yKEIQ4i4g9Oxbm1YoB907itRd4QEttH1'),(46,'alizyan21@gmail.com','OZ9PPyb9MfRHIqYoCP40SRLf6jf7adfY'),(47,'hayaznuhi1103@gmail.com','n6eOXhoBZVwlfAbXa07Nv03qrcUwA7EX'),(48,'mrs717@mail.ru','g8eUlDJA860SXxXLaqv4TYpMMxT1ohEF'),(49,'tatevikmargaryanarm@gmail.com','HATVzzOPNuI8uDpXFPhLAh0fnR4kTntB'),(50,'gabrielyan-meline@mail.ru','30oLQB5SZ7NxFLzyiBpieZWVfGkQCNXG'),(51,'yangyancje@eyou.com','X8fL99mGJ7AN7Imvx19egbUbsA1903tX'),(52,'araqsya.torosyan@mail.ru','Lo0dpvFBULogCUFUuwu2NxmjHptyVomG'),(53,'noro09041991@yandex.ru','bYCtcjvMPwis9YEOjtcKdtfy5tJ1321e'),(54,'e.avetisyan89@gmail.com','y086SXFdPGMKqrlXhowKZsVdwx1Y0rKz'),(55,'zaqarian@mail.ru','Bq4bv6osTJL5PwXn6Nir66cNvDP8TgMu'),(56,'aren.vanyan@mail.ru','dy4c1xetOmRp7nfT3TkKQhMPN5aO3yng'),(57,'melikyan.marina@gmail.com','b46CzFEu6YHNa2FuOgCe6SCV3Xv408gc'),(58,'mr2016harut@mayl.ru','iHU0gLQF97yy8aEaa3l0qI0hVJyKpMjI'),(59,'woshiheting990@163.com','eqV0xrIDEAh3Z45ebf47bN1u3LytAbTO'),(60,'zhangxiuzmp@eyou.com','6cHMa2UXNRe5XkRVWQr51HavgASRwM6C'),(61,'Shushan_b@mail.ru','wN0FOxFdvaoaRmqz9cW6OKup3KWZ2jZz'),(62,'viktoriya.grigorian@mail.ru','nT1xyz9bOPPfQAg2n3Usf4gWdy8WUkOh'),(63,'artur.dallaqyan.800@mail.ru','WCyYXrIGkQBTg00TgVhN8g8gxZKnXoGU'),(64,'tatevharutyunyan@mail.am','Ymcda4296cUxVjSqYxILSs3ymG2aD3gB'),(65,'nar87mimi@mail.ru','1y2LAzfRqLZ3KnU4gUBArLDmmQOx9MVb'),(66,'nar87mimi@mail.ua','dDwvoXpGqG6pHnAbizxuApeXZfoQUXk8'),(67,'sem.buduryan@mail.ru','54nMItEXF63ny2n0WO7wNvIiHnS5Hs2M'),(68,'tadevosyanhripsime@bk.ru','q0aI8okSlqhukRVtUw0U1AdcYFFtniqN'),(69,'bellka8989@mail.ru','4iwc7T2IFRclWTUWMwJYqPF1sQDaYXA3'),(70,'aikfirel@aim.com','6fg3QjoAyMbANxfIo1oNA4Dp8tYKyhPF'),(71,'losfalsetta@sohu.com','o3GJ0vzZ1zmDRpxF1pQKKHbFGPS7rHhP'),(72,'hapoyan@yahoo.com','DIlQ1qLl2A8rrMR8Ki3bdiElB854vxz8'),(73,'xachikxachik.89@mail.ru','3XyAAeTyERn3tFzCJoyL2AFVB3Q2KzjO'),(74,'hovhannisyan.1985@mail.ru','HZxD3M8u22x1M9iKmxJKK2fXlvtPy3Hg'),(75,'zatikyan1981@mail.ru','YyMTSK1GYzLHObBRg9MjNrq8kS5Yyu6x'),(76,'cggq@gmail.com','Ij9AUOvwDLRnNZ96VFPc3ebzfzdXKOVs'),(77,'goharavet@gmail.com','YhfQK01R8qx3553qvcrGtzp1qWcmCvaB'),(78,'darbinyan.anait@yandex.ru','qilXqROA6LasvnkHzYLBvt0KJWBElAzL'),(79,'smusenko83@mail.ru','xgLnqZAXyaIqKtkfa1zb5YurCskSn60V'),(80,'post2@hotel-les-chardons.com','6yOPgzi1OzYr0SajruYDh6vQWv95WUE2'),(81,'lilit.araqelyan.k@gmail.com','RZ5SttFAKmx3NXb3kGIFpWCcLSgSrgni'),(82,'honey.triputen@mail.ru','bX9Im72RfQwxRVsdtolp0vfXUarAF01R'),(83,'tlazaryan@gmail.com','KhcuHP7sBe0KBWx0bAUHjBPCRNslhTh2'),(84,'siriknahapetyan@mail.am','EQw8hbqPP9rTa0L3MiuLCN5mGdp7oWY2'),(85,'gloriaPamN@mailgui.pw','CCtK3facLnIaWcl6d9BsEKwFZLXYKt1n'),(86,'mkrtich2014@mail.ru','5YzH0Xmf6SzV9NKHYDwgnNtQyJht2Ri7'),(87,'l.harutyunyan91@gmail.com','T3heKVO4ngp4G4aWupV9EQ6KhFGowubp'),(88,'adamyan.seda@mail.ru','AT3A50vdXSNVZYzRJP8b2SbW5Y6Gw196'),(89,'RAFO.RAFO59@MAIL.RU','GaAPgrrE1FINo64J6VLN6sa682TgBDOi'),(90,'marina-edo@mail.ru','fas26rAjD7wjo1CdFbPKnXarVVsoNgv2'),(91,'anna-ann1986@mail.ru','CZKTDH2mZ7AioUs2G2OoBHmxZrMCNC9p'),(92,'ARMEN.PYAN@MAIL.RU','SVPempy3pamNEMsq02PeGWfpAJxwYFDQ'),(93,'grigoryan-a@yandex.ru','uupZGbseYTgzt4xJPn8uiIN86jqYcBKH'),(94,'kamo.harutyunyan.93@mail.ru','AXxQumvxeI7K3tf3uU26oAHNJdxnczHM'),(95,'vardansaribekyan31@mail.ru','h7Jn5YdrDavR6lUZewqIQxK5wIVlPFc6'),(96,'ti.ko.92@mail.ru','9WSVX4lfSv0gZHoVc1wrdASLzicpcoim'),(97,'levon-30@mail.ru','FbJmMBTkMSbjTqtxGh6XQ0LP2jlPkJW0'),(98,'nune.stepanyan.95@mail.ru','Z1WqXwf5qA9Yj52um64tiFxIxttVIL5H'),(99,'email@newmedicforum.com','l73pXyzdiNFUjorxSR1Osy2Z5fGk2k3n'),(100,'mailinfo@newmedicforum.com','TseotqMwnFjonxphiyrvyk9wuRKX6lT0');
/*!40000 ALTER TABLE `email_validate` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-23 12:02:24
