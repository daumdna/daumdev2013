-- MySQL dump 10.13  Distrib 5.1.66, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	5.1.66

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
-- Table structure for table `friend`
--

DROP TABLE IF EXISTS `friend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `friend` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `friend_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `friend`
--

LOCK TABLES `friend` WRITE;
/*!40000 ALTER TABLE `friend` DISABLE KEYS */;
INSERT INTO `friend` VALUES (1,1,2),(2,2,1);
/*!40000 ALTER TABLE `friend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manage_mission`
--

DROP TABLE IF EXISTS `manage_mission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `manage_mission` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `clear` tinyint(1) DEFAULT NULL,
  `mission_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `reward_point` int(11) NOT NULL,
  `reward_store_ID` int(11) NOT NULL,
  `reward_mission_ID` int(11) NOT NULL,
  `from_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_manage_mission_mission1_idx` (`mission_ID`),
  KEY `fk_manage_mission_user1_idx` (`user_ID`),
  KEY `fk_manage_mission_store1_idx` (`reward_store_ID`),
  CONSTRAINT `fk_manage_mission_mission1` FOREIGN KEY (`mission_ID`) REFERENCES `mission` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_manage_mission_user1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manage_mission`
--

LOCK TABLES `manage_mission` WRITE;
/*!40000 ALTER TABLE `manage_mission` DISABLE KEYS */;
INSERT INTO `manage_mission` VALUES (87,1,2,1,0,0,0,5),(88,1,2,2,50,1,1,1),(89,1,2,2,20,1,1,1);
/*!40000 ALTER TABLE `manage_mission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mission`
--

DROP TABLE IF EXISTS `mission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mission` (
  `ID` int(11) NOT NULL,
  `success_point` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `store_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_mission_store_idx` (`store_ID`),
  CONSTRAINT `fk_mission_store` FOREIGN KEY (`store_ID`) REFERENCES `store` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mission`
--

LOCK TABLES `mission` WRITE;
/*!40000 ALTER TABLE `mission` DISABLE KEYS */;
INSERT INTO `mission` VALUES (1,100,'ë‹­ 1ë§ˆë¦¬ ì‹œí‚¤ê¸°',1),(2,200,'ì˜· 2ë²Œ ì‚¬ê¸°',2),(3,300,'ìºì‰¬ë°± ë¬¼ê±´ 3ê°œ ì‚¬ê¸°',3);
/*!40000 ALTER TABLE `mission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point`
--

DROP TABLE IF EXISTS `point`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `current_point` int(11) DEFAULT NULL,
  `store_ID` int(11) NOT NULL,
  `mission_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fk_point_store1_idx` (`store_ID`),
  KEY `fk_point_mission1_idx` (`mission_ID`),
  KEY `fk_point_user1_idx` (`user_ID`),
  CONSTRAINT `fk_point_mission1` FOREIGN KEY (`mission_ID`) REFERENCES `mission` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_point_store1` FOREIGN KEY (`store_ID`) REFERENCES `store` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_point_user1` FOREIGN KEY (`user_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point`
--

LOCK TABLES `point` WRITE;
/*!40000 ALTER TABLE `point` DISABLE KEYS */;
INSERT INTO `point` VALUES (20,8460,2,2,1),(21,100,1,1,1),(22,1070,2,2,2),(23,770,1,1,2);
/*!40000 ALTER TABLE `point` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `store`
--

DROP TABLE IF EXISTS `store`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `store` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `store`
--

LOCK TABLES `store` WRITE;
/*!40000 ALTER TABLE `store` DISABLE KEYS */;
INSERT INTO `store` VALUES (1,'bbq'),(2,'zara'),(3,'ok');
/*!40000 ALTER TABLE `store` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `is_store` tinyint(4) NOT NULL,
  `store_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'kjlee','1234',0,0),(2,'jinhee','1234',0,0),(3,'jun','1234',0,0),(4,'bbq','1',1,1),(5,'zara','1',1,2),(6,'ok','1',1,3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-02  0:23:26
