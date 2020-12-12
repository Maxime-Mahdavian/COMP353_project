-- MySQL dump 10.13  Distrib 5.6.43, for Linux (x86_64)
--
-- Host: aac353.encs.concordia.ca    Database: aac353_2
-- ------------------------------------------------------
-- Server version	8.0.22

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
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
                         `userID` int NOT NULL AUTO_INCREMENT,
                         `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `primary_address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `administrator` tinyint(1) DEFAULT NULL,
                         `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `condoAssociationID` int DEFAULT NULL,
                         `condoClassification` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         PRIMARY KEY (`userID`),
                         KEY `condoAssociationID` (`condoAssociationID`),
                         CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`condoAssociationID`) REFERENCES `condoAssociations` (`condoAssociationID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'Max','something6','maxime.mahdavian@gmail.com','301 street app 235 ',1,'resident',2,'4.5'),(2,'John Doe','password','john.doe2@gmail.com','301 street app 285',0,'resident',2,'3.5'),(3,'Jane Doe','password','jane.doe@gmail.com','301 street app 123',0,'resident',2,'5.5'),(30,'Andrew','abc123','andrew.email@gmail.com','301 street app 456',1,'resident',2,'3.5'),(31,'Aaron','password','aaron.email@gmail.com','301 street app 423',0,'resident',2,'3.5'),(32,'Abby','password','abby.email@gmail.com','301 street app 247',0,'resident',2,'5.5'),(33,'Gabrielle','password','gabrielle.email@gmail.com','301 street app 598',0,'resident',2,'2.5'),(34,'Gabriella','password','gabriella.email@gmail.com','301 street app 342',0,'resident',2,'3.5'),(35,'Mack','password','mack.email@gmail.com','301 street app 128',0,'resident',2,'2.5'),(36,'Thomas','password','thomas.tran@gmail.com','301 street app 110',0,'resident',2,'4.5'),(37,'Catherine','password','catherine.email@gmail.com','301 street app 276',0,'resident',2,'3.5'),(38,'Jack','password','jack.email@gmail.com','301 street app 543',0,'resident',2,'3.5'),(39,'Hailey','password','hailey.email@gmail.com','254 other-street app 323',0,'resident',3,'4.5'),(40,'Harry','password','harry.email@gmail.com','254 other-street app 541',0,'resident',3,'4.5'),(41,'Fiona','password','fiona.email@gmail.com','254 other-street app 126',0,'resident',3,'4.5'),(42,'Omar','password','omar.email@gmail.com','254 other-street app 296',0,'resident',3,'4.5'),(43,'Paige','password','paige.email@gmail.com','254 other-street app 421',0,'resident',3,'4.5'),(44,'Pierre','password','pierre.email@gmail.com','254 other-street app 287',0,'resident',3,'4.5'),(45,'Sabrina','password','sabrina.email@gmail.com','254 other-street app 142',0,'resident',3,'4.5'),(46,'Tania','password','tania.email@gmail.com','254 other-street app 321',1,'resident',3,'4.5'),(48,'Alex','password','alex.email@email.com','256 street app 231',0,'resident',2,'2.5');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `buildings`
--

DROP TABLE IF EXISTS `buildings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `buildings` (
                             `buildingID` int NOT NULL AUTO_INCREMENT,
                             `address` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             PRIMARY KEY (`buildingID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `buildings`
--

LOCK TABLES `buildings` WRITE;
/*!40000 ALTER TABLE `buildings` DISABLE KEYS */;
INSERT INTO `buildings` VALUES (1,'123 a_street road Quebec'),(3,'301 street'),(4,'254 other-street'),(5,'896 b_street road'),(6,'287 c_street road'),(7,'741 d_sreet road'),(8,'965 e_street road'),(9,'834 f_street road');
/*!40000 ALTER TABLE `buildings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
                            `comment_id` int NOT NULL AUTO_INCREMENT,
                            `reply_id` int DEFAULT NULL,
                            `post_id` int NOT NULL,
                            `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
                            `name` varchar(255) NOT NULL,
                            `message` text NOT NULL,
                            PRIMARY KEY (`comment_id`),
                            KEY `post_id` (`post_id`),
                            CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`postID`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,NULL,1,'2020-11-12 15:22:37','Max','This is a test comment'),(14,1,1,'2020-12-02 10:30:05','John Doe','This is a reply, hello Max'),(16,1,1,'2020-12-02 10:31:32','Andrew','This is another reply, they only go to a depth of two, because it\'s much easier that way, and avoids some really bad db anomalies'),(19,NULL,1,'2020-12-02 10:32:13','Andrew','This is another comment on this post'),(20,NULL,29,'2020-12-03 10:29:46','Tania','I completely agree with you! This is awesome'),(21,NULL,29,'2020-12-03 10:32:07','Aaron','YES! It is great'),(22,NULL,29,'2020-12-03 10:32:56','Mack','Thank you to everyone that worked on it'),(23,NULL,29,'2020-12-03 10:33:23','Yvonne','THANK YOU!'),(24,NULL,29,'2020-12-03 10:33:56','Hailey','Thank you'),(25,20,29,'2020-12-03 10:34:19','Max','Thank you very much for the kind words'),(26,20,29,'2020-12-03 10:35:06','Andrew','Yes, thank you to everyone for the kind words'),(27,NULL,28,'2020-12-03 10:36:10','Paige','How much for the couch?'),(28,NULL,35,'2020-12-06 20:44:46','Thomas','Also, come people forget to clean their station with their towel after they\'re done... Seriously?? We\'re going through a pandemic and you can\'t even wipe the bench after being done?'),(29,NULL,16,'2020-12-06 21:20:43','Max','Test Comment'),(30,29,16,'2020-12-06 21:20:54','Max','Test reply'),(34,29,16,'2020-12-07 08:31:53','Max','test reply 2'),(35,29,16,'2020-12-07 08:32:01','Max','again'),(36,NULL,36,'2020-12-07 10:13:04','Max','Sure no problem! When are you available'),(37,NULL,1,'2020-12-07 10:36:09','John Doe','Hello'),(38,19,1,'2020-12-07 10:36:19','John Doe','This is a reply');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condoAssociations`
--

DROP TABLE IF EXISTS `condoAssociations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `condoAssociations` (
                                     `condoAssociationID` int NOT NULL AUTO_INCREMENT,
                                     `budget` float DEFAULT NULL,
                                     `financialStatus` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                     PRIMARY KEY (`condoAssociationID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condoAssociations`
--

LOCK TABLES `condoAssociations` WRITE;
/*!40000 ALTER TABLE `condoAssociations` DISABLE KEYS */;
INSERT INTO `condoAssociations` VALUES (2,1462.31,'solvent'),(3,19630.8,'solvent');
/*!40000 ALTER TABLE `condoAssociations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condos`
--

DROP TABLE IF EXISTS `condos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `condos` (
                          `condoID` int unsigned NOT NULL AUTO_INCREMENT,
                          `ownerID` int DEFAULT NULL,
                          `buildingID` int DEFAULT NULL,
                          `floorspace` float DEFAULT NULL,
                          PRIMARY KEY (`condoID`),
                          KEY `buildingID` (`buildingID`),
                          KEY `ownerID` (`ownerID`),
                          CONSTRAINT `condos_ibfk_2` FOREIGN KEY (`buildingID`) REFERENCES `buildings` (`buildingID`) ON DELETE CASCADE,
                          CONSTRAINT `condos_ibfk_3` FOREIGN KEY (`ownerID`) REFERENCES `Users` (`userID`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condos`
--

LOCK TABLES `condos` WRITE;
/*!40000 ALTER TABLE `condos` DISABLE KEYS */;
INSERT INTO `condos` VALUES (1,30,3,20.5),(3,1,3,20.32),(4,2,3,22),(5,31,3,25.6),(6,32,3,19.2),(7,33,3,19),(8,34,3,20),(9,35,3,20.6),(10,36,3,22.6),(11,37,3,23.5),(12,38,3,22.5),(13,39,4,23.4),(14,40,4,22),(15,41,4,20.5),(16,42,4,20.5),(17,43,4,22),(18,44,4,19),(19,45,4,22),(20,46,4,20.5),(21,3,3,20.5);
/*!40000 ALTER TABLE `condos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
                             `contractID` int NOT NULL AUTO_INCREMENT,
                             `condoAssociationID` int DEFAULT NULL,
                             `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                             `awarded` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                             `status` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                             `price` decimal(18,2) DEFAULT NULL,
                             PRIMARY KEY (`contractID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` VALUES (1,2,'wash floor','Wash Floor Inc.','Active',25000.00),(2,2,'wash windows','Wash Windows Inc.','Active',30000.00),(3,3,'clean pool','Clean Pool Inc','Active',20000.00),(4,2,'Monthly clean carpets','Carpet Cleaner','Inactive',25000.00),(5,2,'Testing building security','Secu-building','Active',25630.00),(6,2,'Providing support for washing machine','Washer Inc','Active',2456.00),(7,3,'Providing support for washing machine','Washer Inc','Active',3000.00),(8,3,'Carpet cleaning','All Clean Inc','Active',1000.00),(9,3,'Wash windows ','Window washers','Active',2500.00),(10,2,'Electrician work required in the common room','John Electric','Active',2000.00);
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contribution`
--

DROP TABLE IF EXISTS `contribution`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contribution` (
                                `contractID` int NOT NULL,
                                `condoAssociationID` int DEFAULT NULL,
                                `userID` int DEFAULT NULL,
                                `date_payed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                `reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                                `price` decimal(18,2) DEFAULT NULL,
                                `contributionID` int NOT NULL AUTO_INCREMENT,
                                PRIMARY KEY (`contributionID`),
                                KEY `userID` (`userID`),
                                KEY `contractID` (`contractID`),
                                CONSTRAINT `contribution_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE,
                                CONSTRAINT `contribution_ibfk_3` FOREIGN KEY (`contractID`) REFERENCES `contracts` (`contractID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contribution`
--

LOCK TABLES `contribution` WRITE;
/*!40000 ALTER TABLE `contribution` DISABLE KEYS */;
INSERT INTO `contribution` VALUES (1,2,1,'2020-11-30 14:38:39','Needed to wash the floor',100.00,1),(2,2,2,'2020-11-30 14:38:39','Big stain on floor',500.00,2),(1,2,36,'2020-10-24 15:17:55','Stained my hardwood',63.00,4),(3,2,35,'2020-07-01 21:17:00','clean pools',25.00,5),(1,2,33,'2020-12-03 16:17:10','something',60.00,6),(9,3,44,'2020-09-03 14:50:32','fall cleaning',50.00,7),(10,2,31,'2020-12-03 16:13:27','need to fix an outlet',100.00,8),(4,2,35,'2020-04-28 15:00:00','need to clean the carpet right outside my door',50.00,9),(8,3,40,'2019-07-20 20:14:00','Spilled milk in the hallway',150.00,10),(3,3,45,'2020-06-18 22:00:27','I want to swin in the pool',200.00,11),(5,2,1,'2020-12-06 18:32:53','i was afraid  my alatm was broken',25.00,12),(1,2,1,'2020-12-06 18:33:13','test',25.00,13),(1,2,1,'2020-12-06 18:34:41','test',20.00,14),(1,2,2,'2020-12-07 15:45:08','demo',800.00,15);
/*!40000 ALTER TABLE `contribution` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees` (
                        `feeID` int NOT NULL AUTO_INCREMENT,
                        `condoID` int unsigned DEFAULT NULL,
                        `amountPaid` float DEFAULT NULL,
                        `payee` int NOT NULL,
                        `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        PRIMARY KEY (`feeID`),
                        KEY `condoID` (`condoID`),
                        KEY `payee` (`payee`),
                        CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`condoID`) REFERENCES `condos` (`condoID`) ON DELETE CASCADE,
                        CONSTRAINT `fees_ibfk_2` FOREIGN KEY (`payee`) REFERENCES `Users` (`userID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES (3,3,100,1,'2020-12-06 18:38:43'),(4,3,25,1,'2020-12-06 18:44:04'),(5,4,65,2,'2020-12-07 15:46:50');
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_membership`
--

DROP TABLE IF EXISTS `group_membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_membership` (
                                    `gID` int DEFAULT NULL,
                                    `uID` int DEFAULT NULL,
                                    KEY `userID` (`uID`),
                                    KEY `group_membership_ibfk_1` (`gID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_membership`
--

LOCK TABLES `group_membership` WRITE;
/*!40000 ALTER TABLE `group_membership` DISABLE KEYS */;
INSERT INTO `group_membership` VALUES (3,2),(1,1),(2,1),(1,2),(5,2),(5,30),(46,30),(3,34),(3,35),(3,36),(4,37),(4,38),(4,39),(5,40),(4,38),(4,39),(5,40),(5,1),(4,1),(2,30);
/*!40000 ALTER TABLE `group_membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_request`
--

DROP TABLE IF EXISTS `group_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_request` (
                                 `requested_groupID` int NOT NULL,
                                 `requested_userID` int NOT NULL,
                                 PRIMARY KEY (`requested_groupID`,`requested_userID`),
                                 KEY `requested_userID` (`requested_userID`),
                                 CONSTRAINT `group_request_ibfk_1` FOREIGN KEY (`requested_groupID`) REFERENCES `groups` (`groupID`),
                                 CONSTRAINT `group_request_ibfk_2` FOREIGN KEY (`requested_userID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_request`
--

LOCK TABLES `group_request` WRITE;
/*!40000 ALTER TABLE `group_request` DISABLE KEYS */;
INSERT INTO `group_request` VALUES (3,1),(2,33),(46,36);
/*!40000 ALTER TABLE `group_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
                          `groupID` int NOT NULL AUTO_INCREMENT,
                          `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                          `owner` int DEFAULT NULL,
                          PRIMARY KEY (`groupID`),
                          KEY `owner` (`owner`),
                          CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (2,'Administrator group','This is a group for every administrator to help each other',1),(3,'christmas group','organizing christmas events',34),(4,'Social club','Organizing various social events',36),(5,'Fitness club','For everyone wanting to share their fitness progress ',42),(46,'Cards club','To play cards with other people',30);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance`
--

DROP TABLE IF EXISTS `maintenance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `maintenance` (
                               `contractID` int NOT NULL,
                               `condoAssociationID` int DEFAULT NULL,
                               `contractor` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                               `cost` decimal(18,2) DEFAULT NULL,
                               `rationale` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                               `maintenanceID` int NOT NULL AUTO_INCREMENT,
                               `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               PRIMARY KEY (`maintenanceID`),
                               KEY `contractID` (`contractID`),
                               CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`contractID`) REFERENCES `contracts` (`contractID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance`
--

LOCK TABLES `maintenance` WRITE;
/*!40000 ALTER TABLE `maintenance` DISABLE KEYS */;
INSERT INTO `maintenance` VALUES (1,2,'Wash Floor Inc.',1000.00,'floors are dirty',1,'2020-11-28 19:06:22'),(2,3,'Wash Window Inc.',10.00,'monthly window washing',3,'2020-11-30 19:06:22'),(3,2,'Clean Pool Inc',256.00,'cleanning pool, almost summer',4,'2020-11-30 19:06:22'),(1,2,'Wash Floor Inc.',2569.00,'Take out stains after halloween party',5,'2020-11-30 19:07:17'),(4,2,'Carpet Cleaner',256.00,'Clean out carpet',6,'2020-12-03 19:02:49'),(5,2,'Secu-building',321.00,'Test security of the building',7,'2020-12-03 19:02:49'),(6,2,'Washer Inc',999.99,'Washing machine needed fixing',8,'2020-12-03 19:02:49'),(7,3,'Washer Inc',560.50,'Washing machine needs fixing',9,'2020-12-03 19:02:49'),(8,3,'All Clean Inc',1000.00,'Twice yearly carpet cleaning',10,'2020-12-03 19:02:49'),(9,3,'Window washers',900.00,'Windows are dirty',11,'2020-12-03 19:02:49'),(10,2,'John Electric',800.00,'Electric problems in some condos',12,'2020-12-03 19:02:49');
/*!40000 ALTER TABLE `maintenance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meeting`
--

DROP TABLE IF EXISTS `meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meeting` (
                           `meetingID` int NOT NULL AUTO_INCREMENT,
                           `condoAssociationID` int DEFAULT NULL,
                           `administratorMeeting` tinyint(1) DEFAULT NULL,
                           `agenda` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                           `time` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `minutes` int DEFAULT NULL,
                           `resolution` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                           `creator` int DEFAULT NULL,
                           PRIMARY KEY (`meetingID`),
                           KEY `creator` (`creator`),
                           CONSTRAINT `meeting_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meeting`
--

LOCK TABLES `meeting` WRITE;
/*!40000 ALTER TABLE `meeting` DISABLE KEYS */;
INSERT INTO `meeting` VALUES (2,2,0,'Meeting for the christmas party','2020-11-23 16:00:00',60,'Can\'t party because of COVID',1),(3,2,1,'Look into new features for the webiste','2020-12-03 16:00:00',60,'No new features decided, next meeting scheduled',2),(4,2,0,'10km run','2020-11-15 16:00:00',60,'No need for resolution',1),(5,2,1,'Still looking into new features','2020-12-07 16:00:00',30,'New cloud storage for posts',1),(6,2,0,'Meeting to decide future social activites','22-12-2020 16:00:00',60,'Some chosen, will keep the secret for now',1),(7,3,0,'Need to resolve some card drama','2020-11-23 16:00:00',30,'Some people were kicked from the group',2),(13,2,0,'demo','2020-12-07 12:00:00',45,'resolution ',2);
/*!40000 ALTER TABLE `meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
                           `messageID` int NOT NULL AUTO_INCREMENT,
                           `senderID` int NOT NULL,
                           `receiverID` int NOT NULL,
                           `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                           `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                           PRIMARY KEY (`messageID`),
                           KEY `senderID` (`senderID`),
                           KEY `receiverID` (`receiverID`),
                           CONSTRAINT `message_ibfk_1` FOREIGN KEY (`senderID`) REFERENCES `Users` (`userID`),
                           CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiverID`) REFERENCES `Users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (5,1,2,'This is a message','2020-11-25 18:30:42'),(6,2,1,'This is another message back','2020-11-25 18:32:42'),(7,3,1,'test','2020-11-25 18:33:42'),(8,30,1,'other test','2020-11-25 18:35:42'),(9,2,1,'This is a really really really really really long message, we shall see how this handles such a message of tremendous length','2020-11-25 18:38:42'),(12,1,2,'Hello, how\'s it going','2020-11-25 18:40:42'),(13,2,1,'Will you see this my friend i wonder','2020-11-25 19:02:58'),(14,1,2,'\r\nYes, i\'ve seen it, thank yoy very much my dear friend\r\n\r\n------------------------------------\r\nWill you see this my friend i wonder\r\n','2020-11-25 19:47:36'),(15,1,2,'\r\nIt is indeed a long message my friend\r\n\r\n------------------------------------\r\nJohn Doe:\r\nThis is a really really really really really long message, we shall see how this handles such a message of tremendous length\r\n','2020-11-25 20:00:47'),(16,2,1,'It seems to be working\r\n\r\n\r\n------------------------------------\r\nMax:\r\n\r\nIt is indeed a long message my friend\r\n\r\n------------------------------------\r\nJohn Doe:\r\nThis is a really really really really really long message, we shall see how this handles such a message of tremendous length\r\n\r\n','2020-11-25 20:01:26'),(17,1,38,'','2020-12-06 14:37:00'),(18,1,30,'Testing messages','2020-12-06 17:06:43'),(19,36,1,'Hey Max, your dog keeps knocking on my door at midnight every night, could you make it stop?','2020-12-07 01:10:45'),(20,36,30,'Hey Andrew, I am looking to purchase a new condo  of size 3-1/2 do you know anyone that is trying to sell theirs\'s?','2020-12-07 01:11:54'),(21,30,36,'Yeah! a dear friend of mine is selling his, he posted an ad on the CON system, go check it out, his name is John Doe\r\n\r\n\r\n------------------------------------\r\nThomas:\r\nHey Andrew, I am looking to purchase a new condo  of size 3-1/2 do you know anyone that is trying to sell theirs\r\n','2020-12-07 01:13:26'),(22,36,30,'Thanks a lot Andrew!\r\n\r\n\r\n------------------------------------\r\nAndrew:\r\nYeah! a dear friend of mine is selling his, he posted an ad on the CON system, go check it out, his name is John Doe\r\n\r\n\r\n------------------------------------\r\nThomas:\r\nHey Andrew, I am looking to purchase a new condo  of size 3-1/2 do you know anyone that is trying to sell theirs\r\n\r\n','2020-12-07 01:13:57'),(23,30,36,'yea, I know a guy who knows a guy, ill have him contact you\r\n\r\n\r\n------------------------------------\r\nThomas:\r\nHey Andrew, I am looking to purchase a new condo  of size 3-1/2 do you know anyone that is trying to sell theirs\r\n','2020-12-07 14:16:54'),(24,2,1,'Test message','2020-12-07 15:34:47');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parkingSpaces`
--

DROP TABLE IF EXISTS `parkingSpaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parkingSpaces` (
                                 `parkingSpaceID` int unsigned NOT NULL AUTO_INCREMENT,
                                 `condoID` int unsigned DEFAULT NULL,
                                 PRIMARY KEY (`parkingSpaceID`),
                                 KEY `condoID` (`condoID`),
                                 CONSTRAINT `parkingSpaces_ibfk_1` FOREIGN KEY (`condoID`) REFERENCES `condos` (`condoID`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parkingSpaces`
--

LOCK TABLES `parkingSpaces` WRITE;
/*!40000 ALTER TABLE `parkingSpaces` DISABLE KEYS */;
INSERT INTO `parkingSpaces` VALUES (1,1),(2,3),(3,4),(4,5),(5,6),(6,7),(7,8),(8,9),(9,10),(10,11),(12,18);
/*!40000 ALTER TABLE `parkingSpaces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `percentShare`
--

DROP TABLE IF EXISTS `percentShare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `percentShare` (
                                `userID` int DEFAULT NULL,
                                `buildingID` int DEFAULT NULL,
                                `percentShare` float DEFAULT NULL,
                                KEY `userID` (`userID`),
                                KEY `buildingID` (`buildingID`),
                                CONSTRAINT `percentShare_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`userID`) ON DELETE CASCADE,
                                CONSTRAINT `percentShare_ibfk_2` FOREIGN KEY (`buildingID`) REFERENCES `buildings` (`buildingID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `percentShare`
--

LOCK TABLES `percentShare` WRITE;
/*!40000 ALTER TABLE `percentShare` DISABLE KEYS */;
INSERT INTO `percentShare` VALUES (1,3,8.3),(2,3,8.3),(3,3,8.3),(31,3,8.3),(32,3,10),(33,3,8.3),(34,3,8.3),(35,3,8.3),(36,3,8.3),(39,4,12.5),(40,4,12.5),(41,4,12.5),(42,4,12.5),(43,4,12.5),(44,4,12.5),(45,4,12.5),(46,4,12.5),(1,5,54.7),(31,5,12.9);
/*!40000 ALTER TABLE `percentShare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_main`
--

DROP TABLE IF EXISTS `poll_main`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_main` (
                             `poll_id` int NOT NULL AUTO_INCREMENT,
                             `poll_question` text NOT NULL,
                             `close` tinyint(1) DEFAULT '0',
                             PRIMARY KEY (`poll_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_main`
--

LOCK TABLES `poll_main` WRITE;
/*!40000 ALTER TABLE `poll_main` DISABLE KEYS */;
INSERT INTO `poll_main` VALUES (1,'How much money do you want to spend on a pool',0),(4,'Who should be the next association president',0);
/*!40000 ALTER TABLE `poll_main` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_options`
--

DROP TABLE IF EXISTS `poll_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_options` (
                                `poll_id` int NOT NULL,
                                `option_id` int NOT NULL,
                                `option_text` varchar(255) NOT NULL,
                                PRIMARY KEY (`poll_id`,`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_options`
--

LOCK TABLES `poll_options` WRITE;
/*!40000 ALTER TABLE `poll_options` DISABLE KEYS */;
INSERT INTO `poll_options` VALUES (1,1,'300$'),(1,2,'500$'),(1,3,'700$'),(1,4,'1000$'),(4,1,'Max'),(4,2,'Andrew');
/*!40000 ALTER TABLE `poll_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poll_votes`
--

DROP TABLE IF EXISTS `poll_votes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poll_votes` (
                              `poll_id` int NOT NULL,
                              `option_id` int NOT NULL,
                              `user_id` int NOT NULL,
                              KEY `poll_id` (`poll_id`),
                              KEY `option_id` (`option_id`),
                              KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poll_votes`
--

LOCK TABLES `poll_votes` WRITE;
/*!40000 ALTER TABLE `poll_votes` DISABLE KEYS */;
INSERT INTO `poll_votes` VALUES (1,3,3),(1,2,4),(1,1,5),(1,3,6),(1,3,7),(1,2,8),(1,1,9),(1,3,10),(1,1,999),(1,2,420),(1,1,666),(1,2,963),(1,2,85),(1,2,1),(4,1,2),(4,2,3),(4,1,30),(4,2,31),(4,1,32),(4,2,33),(4,1,34),(4,1,35),(4,2,36),(4,1,37),(4,2,38),(1,2,36),(1,3,2);
/*!40000 ALTER TABLE `poll_votes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
                        `postID` int NOT NULL AUTO_INCREMENT,
                        `userID` int DEFAULT NULL,
                        `groupID` int DEFAULT NULL,
                        `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                        `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                        `perm` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                        PRIMARY KEY (`postID`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1,NULL,'../img/welcome.jpg','something','This is the first post on the system','2020-12-03 20:07:16','public'),(2,2,NULL,'../img/avatar-the-last-airbender-an.png','you should not see this','you should see this too','2020-12-03 19:57:27','public'),(15,1,NULL,'../img/test.png','I don\'t know','something','2020-11-16 15:49:48','public'),(16,1,NULL,'../img/Q2_2_final(1).png','title','body text','2020-11-16 15:49:48','public'),(17,3,1,'../img/','group perm test','this is a test','2020-12-03 19:56:54','group'),(18,1,NULL,'../img/','own private test','this is a test','2020-12-03 19:56:54','private'),(19,3,NULL,'../img/','other private test','this is a test','2020-12-03 19:56:54','private'),(20,6,3,'../img/','other group test','you should be able to see this','2020-12-03 19:56:54','group'),(24,1,2,'../img/','test for group on uplaod','test','2020-12-03 19:56:54','group'),(27,1,NULL,'../img/','no image','no image no error message','2020-11-16 16:22:32','public'),(28,1,NULL,'../img/couch.jpg','This is an Ad','I am looking to sell this couch, message me for details','2020-12-03 19:55:42','Ad'),(29,1,NULL,'../img/','The new website looks great!','I just want to thank all the nice and talented people that created this website','2020-12-03 15:28:54','public'),(30,1,NULL,'../img/','Test post on server','server','2020-12-06 16:52:15','public'),(31,36,NULL,'../img/christmas-cookies-go.jpg','Charity for the CHU Fondation','Hey guys, I will be organizing a cookie bake sale on Monday December 14th 2020 to raise funds for charity. The CHU foundation is looking to raise money to get the hospital kids some presents for their quarantined Christmas. It would mean the world to me if you could come by and say hi!\r\n\r\nCookies will go for 5$\r\nCakes will go for 20$\r\nAnd there will be a donation box for any perishable foods or extra money you could save for the CHU kids!\r\n\r\nCan\'t wait to see you guys there:)','2020-12-07 01:19:22','public'),(32,36,NULL,'../img/dogapartment.jpg','Who\'s at apartment 630??','This morning when I woke up I couldn\'t believe it. It was looking right at me! How cute... Guys help me find its owner, I want to pet it.','2020-12-07 01:22:36','private'),(33,36,3,'../img/download.jpg','Dog Christmas Costume Competition!','Hey guys, for Christmas this year, we\'re doing a dog costume with Christmas theme competition! Post a picture of your doggo and on the 25th of December we will choose the best costume! Winner will get a 30$ Amazon card,','2020-12-07 01:28:18','group'),(34,36,NULL,'../img/water-leak-scaled.jpg','Water leak escalates tremendously','Last week\'s small water leak has grown to submerge my whole kitchen! This is unacceptable, I am still waiting on the plumbers to arrive.','2020-12-07 01:31:04','public'),(35,36,NULL,'../img/k9kmvjqdxauifnlnr56j.webp','Remove the weights when you\'re done!','Someone always forgets to remove the weights when they\'re done with the bench press. Please do not continue doing this, think about the others and leave your station as you found it.','2020-12-07 01:36:04','public'),(36,36,2,'../img/finlandcoffeefeature.jpg','New administrator','Hello guys, I\'m a soon to be new administrator to a condo association. I have a few questions concerning this new role I will be taking in the coming weeks and was wondering if I could meet some of you before I start just to learn the ropes. I\'m open to take some coffee, and it\'s on me!','2020-12-07 01:41:20','group'),(37,2,5,'../img/couch.jpg','Demo post','demo','2020-12-07 15:38:40','group');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `storageSpaces`
--

DROP TABLE IF EXISTS `storageSpaces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `storageSpaces` (
                                 `storageSpaceID` int unsigned NOT NULL AUTO_INCREMENT,
                                 `condoID` int unsigned DEFAULT NULL,
                                 PRIMARY KEY (`storageSpaceID`),
                                 KEY `condoID` (`condoID`),
                                 CONSTRAINT `storageSpaces_ibfk_1` FOREIGN KEY (`condoID`) REFERENCES `condos` (`condoID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `storageSpaces`
--

LOCK TABLES `storageSpaces` WRITE;
/*!40000 ALTER TABLE `storageSpaces` DISABLE KEYS */;
/*!40000 ALTER TABLE `storageSpaces` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-10 15:37:37
