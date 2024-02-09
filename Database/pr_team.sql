-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: localhost    Database: pr_project
-- ------------------------------------------------------
-- Server version	8.0.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `pr_team`
--

DROP TABLE IF EXISTS `pr_team`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pr_team` (
  `pr_team_id` int NOT NULL AUTO_INCREMENT,
  `pr_team_name` varchar(255) DEFAULT NULL,
  `pr_team_email` varchar(255) DEFAULT NULL,
  `pr_team_con_1` varchar(255) DEFAULT NULL,
  `pr_team_con_2` varchar(255) DEFAULT NULL,
  `pr_team_image` varchar(255) DEFAULT NULL,
  `pr_team_dob` varchar(255) DEFAULT NULL,
  `pr_team_doj` varchar(255) DEFAULT NULL,
  `pr_team_address` varchar(255) DEFAULT NULL,
  `pr_team_desc` varchar(255) DEFAULT NULL,
  `pr_team_status` int DEFAULT NULL,
  PRIMARY KEY (`pr_team_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pr_team`
--

LOCK TABLES `pr_team` WRITE;
/*!40000 ALTER TABLE `pr_team` DISABLE KEYS */;
INSERT INTO `pr_team` VALUES (5,'abcd','anushkanaik74@gmail.com','con1','con2','banner5.jpg','abc','abc','abc','abcxyz',1);
/*!40000 ALTER TABLE `pr_team` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-09 18:43:33
