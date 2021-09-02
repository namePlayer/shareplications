-- MySQL dump 10.19  Distrib 10.3.30-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db
-- ------------------------------------------------------
-- Server version	10.3.30-MariaDB-1:10.3.30+maria~focal-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `shortlinks`
--

DROP TABLE IF EXISTS `shortlinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shortlinks` (
  `link_id` int(11) NOT NULL AUTO_INCREMENT,
  `link_redirect` text NOT NULL,
  `link_shortcode` varchar(50) NOT NULL,
  `link_created` int(11) NOT NULL DEFAULT 0,
  `link_expires` int(11) DEFAULT NULL,
  `link_password` text DEFAULT NULL,
  `link_telemetry` enum('true','false') NOT NULL DEFAULT 'true',
  `link_maxuse` int(11) DEFAULT NULL,
  PRIMARY KEY (`link_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shortlinks`
--

LOCK TABLES `shortlinks` WRITE;
/*!40000 ALTER TABLE `shortlinks` DISABLE KEYS */;
INSERT INTO `shortlinks` VALUES (54,'https://www.php.net/manual/de/language.variables.variable.php','IrKiXWE7',1630157197,NULL,'','true',NULL),(55,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','Zb99A3qU',1630429833,NULL,'','true',NULL),(56,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','Q9QXrQEM',1630429855,NULL,'','true',NULL),(57,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','nmJMAHpW',1630429869,NULL,'','true',NULL),(58,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','2WnR4YDH',1630429906,NULL,'','true',NULL),(59,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','5GixmC4z',1630430055,NULL,'','true',NULL),(60,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','2LY9qpco',1630430294,NULL,'','true',NULL),(61,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','cWeycnqU',1630430314,NULL,'','true',NULL),(62,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','fg7urCeB',1630430593,NULL,'','true',NULL),(63,'https://www.youtube.com/watch?v=bM-jZNM-Wcg','F4Hzlc6t',1630430617,NULL,'','true',NULL),(64,'https://stackoverflow.com/questions/113829/how-to-convert-date-to-timestamp-in-php','bLGKgxQo',1630430689,NULL,'','true',NULL),(65,'https://stackoverflow.com/questions/113829/how-to-convert-date-to-timestamp-in-php','2YpAg8SA',1630430700,NULL,'','true',NULL),(66,'https://www.youtube.com/watch?v=6xQ8Lf0X7l0','w82jNYtg',1630604223,1630697700,'','true',NULL),(67,'https://www.youtube.com/watch?v=6xQ8Lf0X7l0','QDWzRirk',1630604628,NULL,'','true',NULL),(68,'https://www.youtube.com/watch?v=CQh3-ONH5f4','KUWyPxPd',1630604754,1630710000,'','true',NULL),(69,'https://www.youtube.com/watch?v=CQh3-ONH5f4','d529IKor',1630604779,1630472400,'','true',NULL),(70,'https://www.youtube.com/watch?v=CQh3-ONH5f4','bbylch4h',1630604859,1631937600,'','true',NULL),(71,'https://www.youtube.com/watch?v=CQh3-ONH5f4','wOPsE5Bz',1630604887,1631250000,'','true',NULL);
/*!40000 ALTER TABLE `shortlinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `telemetry`
--

DROP TABLE IF EXISTS `telemetry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `telemetry` (
  `telemetry_id` int(11) NOT NULL AUTO_INCREMENT,
  `telemetry_link` int(11) NOT NULL,
  `telemetry_useragent` varchar(255) NOT NULL,
  `telemetry_date` int(11) NOT NULL,
  `telemetry_refferer` varchar(255) NOT NULL,
  PRIMARY KEY (`telemetry_id`),
  KEY `DB_LINK` (`telemetry_link`),
  CONSTRAINT `DB_LINK` FOREIGN KEY (`telemetry_link`) REFERENCES `shortlinks` (`link_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `telemetry`
--

LOCK TABLES `telemetry` WRITE;
/*!40000 ALTER TABLE `telemetry` DISABLE KEYS */;
INSERT INTO `telemetry` VALUES (1,66,'Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',1630604230,''),(2,69,'Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',1630604817,''),(3,71,'Mozilla/5.0 (X11; Linux x86_64; rv:91.0) Gecko/20100101 Firefox/91.0',1630604893,'');
/*!40000 ALTER TABLE `telemetry` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-02 17:56:18
