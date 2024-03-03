-- MariaDB dump 10.19  Distrib 10.11.4-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ciphershield
-- ------------------------------------------------------
-- Server version	10.11.4-MariaDB-1~deb12u1

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
-- Table structure for table `passwords`
--

DROP TABLE IF EXISTS `passwords`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passwords` (
  `password_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `application_name` varchar(100) NOT NULL,
  `app_user_id` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `security_question` varchar(255) DEFAULT NULL,
  `security_answer` varchar(255) DEFAULT NULL,
  `twofa_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`password_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `passwords_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passwords`
--

LOCK TABLES `passwords` WRITE;
/*!40000 ALTER TABLE `passwords` DISABLE KEYS */;
INSERT INTO `passwords` VALUES
(38,9,'Siddhartha Bank','9800076542','dArw0hOVCZONidNKNB438w==','banking',NULL,NULL,NULL,'2024-03-01 13:23:55'),
(39,9,'Discord','shel1ghost','7da1fbHAvo9zqqspe827gw==','social',NULL,NULL,'Samsung device pin approval','2024-03-03 02:11:18'),
(40,9,'Instagram','shel1ghost','6ELL8yg9BkB5E0LQe/JmOw==','social',NULL,NULL,'Samsung device pin approval','2024-03-03 02:12:02'),
(41,9,'Nabil Bank','9808085321','sBtTOp61ePOx++qZMyiQtg==','banking',NULL,NULL,'Samsung device pin approval','2024-03-03 02:13:14'),
(42,9,'Global Bank','9808085320','rGj+xb9JRkFLlPdGza7gVw==','banking',NULL,NULL,'Samsung device pin approval','2024-03-03 02:13:45'),
(43,9,'Gmail','astra@gmail.com','UVKV7Z0/vpeJ0816+yAt/g==','email',NULL,NULL,'Samsung device pin approval','2024-03-03 02:14:09'),
(44,9,'Outlook','astra@outlook.com','Wf51AYn+g6+o6cdiQhdlAA==','email',NULL,NULL,'Samsung device pin approval','2024-03-03 02:45:40'),
(45,9,'Codecamp','astra@gmail.com','aMOVgvmzEcQqMbMOESzVhw==','others',NULL,NULL,NULL,'2024-03-03 02:15:17'),
(46,9,'Great Learning','astra@gmail.com','ZTf9UeM4VMNxEqGW9FSG1w==','others',NULL,NULL,NULL,'2024-03-03 02:16:04'),
(47,9,'Facebook','miss.programmer','oJBvpxh/dxrdMRZd7kWIyA==','social','Which is your fav flower?','Rose',NULL,'2024-03-03 02:18:16'),
(48,9,'X','itsastra','r115I6JtxFAD7ganIQbgfA==','social',NULL,NULL,NULL,'2024-03-03 02:19:57'),
(49,9,'Whatsapp','9808084332','/e7LhERnCnVImnAiW97xzQ==','social',NULL,NULL,NULL,'2024-03-03 02:21:31'),
(50,9,'Coursera','astraparadox@gmail.com','CNwdySUaI0Kvd4ITANCnkw==','others',NULL,NULL,NULL,'2024-03-03 02:22:08'),
(51,9,'Yahoo Mail','astraparadox@yahoo.com','KxaWPs43I9+EuqzOe615+Q==','email',NULL,NULL,NULL,'2024-03-03 02:22:27');
/*!40000 ALTER TABLE `passwords` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,'Babi','itsbabi246@gmail.com','Astra@123'),
(2,'Astra','astra@gmail.com','Babi@123'),
(5,'New User','newuser@gmail.com','$2y$10$iSLpGOm64wzXy0OY2/4SlOGed.9hTEihTfRoog8vsQLTjUewH5MWe'),
(6,'Helpdesk','helpdesk@gmail.com','$2y$10$89cjKW5M8oSNwpNAu7Pbp.mZkD5IxwCYIsAerHgl6WIki1iFsvU8G'),
(7,'Miss Programmer','missprogrammer@gmail.com','$2y$10$hN0IhWPK3uJcxV1zVTUq9OMna09bIFoY1OsfhRN2ZKSawook80lWu'),
(9,'Astra','astraparadox@gmail.com','$2y$10$oI1ByaBBGHDXo2dNwb9R/O36WzV3oscHCr02C90uymk4AGPSijjSi');
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

-- Dump completed on 2024-03-03  8:35:30
