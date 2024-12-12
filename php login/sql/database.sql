-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: user_management
-- ------------------------------------------------------
-- Server version	8.0.40

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'İdris Enes','Yiğit','ienes@gmail.com','05468975422','$2y$10$y7XfRvnu3D0rlvTrMsQ1heA6GCCjZRvkue4TcWvdBsg4Im6Xjo8/S','2024-12-11 18:09:02'),(9,'murat','ucar','mrt@gmail.com','05685962458','$2y$10$hpM1J6iwrDgo8Ka/V7SMIu.yE.l1vEtCzHVW26WWGfuryECBBiir6','2024-12-12 11:53:58'),(11,'Recep','Guzelbay','recep@example.com','05342561354','$2y$10$jtwiS/bRJy5UOZZ5W69InOhEKEu/1wUXuPbADJMg7.DIAAfoCTn76','2024-12-12 13:36:34'),(12,'Mehmet Şirin','AKIN','mehmetsirin@gmail.com','05373683549','$2y$10$kbrep9VTL9rI0zJ2h93Jsub3ifKgL6Cfm/zKqXnBJjGkoW5SMQYm.','2024-12-12 13:37:21'),(13,'bedirhan selim','yeşilyurt','bedirhanselim@gmail.com','05469587885','$2y$10$Q.zpWXT2JM2KwyM.0VMhQeuX9oYaFHUfUhXTFX.iNbJNpcDleMS.u','2024-12-12 13:43:51'),(14,'idris','yiğit','ienes01@gmail.com','5385463526','$2y$10$NjDwQGNhyjd76dcy7wv.mu/ncXIRBTigSnmyrS0j3RRLxvZ6TDe56','2024-12-12 15:30:02');
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

-- Dump completed on 2024-12-12 20:38:29
