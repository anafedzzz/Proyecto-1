CREATE DATABASE  IF NOT EXISTS `restaurant` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `restaurant`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: restaurant
-- ------------------------------------------------------
-- Server version	9.0.1

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
-- Table structure for table `ACTIONS_LOG`
--

DROP TABLE IF EXISTS `ACTIONS_LOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ACTIONS_LOG` (
  `id` int NOT NULL AUTO_INCREMENT,
  `action` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `item` varchar(25) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `item_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ACTIONS_LOG`
--

LOCK TABLES `ACTIONS_LOG` WRITE;
/*!40000 ALTER TABLE `ACTIONS_LOG` DISABLE KEYS */;
INSERT INTO `ACTIONS_LOG` VALUES (1,'UPDATE','ORDER',12),(2,'CREATE','ARTICLE',28),(3,'DELETE','USER',12),(4,'DELETE','USER',11),(5,'UPDATE','USER',9),(6,'UPDATE','USER',9),(7,'UPDATE','USER',10),(8,'UPDATE','USER',10),(9,'DELETE','USER',9);
/*!40000 ALTER TABLE `ACTIONS_LOG` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ALLERGY`
--

DROP TABLE IF EXISTS `ALLERGY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ALLERGY` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `description` text COLLATE utf8mb3_spanish2_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ALLERGY`
--

LOCK TABLES `ALLERGY` WRITE;
/*!40000 ALTER TABLE `ALLERGY` DISABLE KEYS */;
INSERT INTO `ALLERGY` VALUES (1,'Gluten','Presente en productos de trigo'),(2,'Lactosa','Presente en productos lácteos'),(3,'Frutos secos','Presente en alimentos con nueces, almendras, etc.');
/*!40000 ALTER TABLE `ALLERGY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ARTICLE`
--

DROP TABLE IF EXISTS `ARTICLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ARTICLE` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `description` text COLLATE utf8mb3_spanish2_ci,
  `price` decimal(10,2) NOT NULL,
  `type` enum('product','complement') COLLATE utf8mb3_spanish2_ci NOT NULL,
  `IMG` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `novedad` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `ARTICLE_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `CATEGORY` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ARTICLE`
--

LOCK TABLES `ARTICLE` WRITE;
/*!40000 ALTER TABLE `ARTICLE` DISABLE KEYS */;
INSERT INTO `ARTICLE` VALUES (1,1,'Vichy Catalan - Cupra','Agua Mineral Natural Carbonatada con sabor a Jengibre y Lima',3.50,'product','vichy-catalan-cupra.jpg',1),(2,1,'Smoothy','Smoothy de manzana y zanahoria',3.50,'product','smoothy.jpg',0),(3,3,'Snacking Cucumbers','Pequeños pepinos perfectos para un snack',11.82,'product','cucumber.jpg',0),(4,3,'Pecan Nuts','Bolsa de nueces pecanas 20gr',2.80,'product','pecans.jfif',0),(5,3,'Arándanos frescos','Bandeja de arándanos orgánicos',4.20,'product','blueberry.jpg',0),(6,2,'Falafel con salsa','Falafel con un toque especial de hierbas y salsa',5.50,'product','falafel.jpg',0),(7,1,'Cold Brew - CAFÉ DE FINCA X CUPRA','Bebida energética edición especial',2.50,'product','CUPRA cold brew.jpg',0),(8,2,'Oreo Cheesecake','Delicioso postre de galletas Oreo©',5.50,'product','oreo.jpg',1),(9,2,'Hummus','Hummus de aceitunas negras con un toque de aceite de oliva, acompañado de crujientes nachos de carbón activo.',10.30,'product','hummus-olivas-negras.jpg',1),(10,1,'Nut Milk','Leche de frutos secos',3.50,'product','milk.jpg',0),(28,3,'Selecta Potato Chips Black Truffle','Selecta Potato Chips Black Truffle',3.00,'product','Patatas-Torres-Trufa-Negra1.jpg',0),(29,1,'Ice','Ice',0.00,'complement',NULL,NULL),(30,1,'Straw','Straw',0.00,'complement',NULL,NULL),(31,1,'Cup','Cup',0.00,'complement',NULL,NULL);
/*!40000 ALTER TABLE `ARTICLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ARTICLE_ALLERGY`
--

DROP TABLE IF EXISTS `ARTICLE_ALLERGY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ARTICLE_ALLERGY` (
  `article_id` int NOT NULL,
  `allergy_id` int NOT NULL,
  PRIMARY KEY (`article_id`,`allergy_id`),
  KEY `allergy_id` (`allergy_id`),
  CONSTRAINT `ARTICLE_ALLERGY_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `ARTICLE` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ARTICLE_ALLERGY_ibfk_2` FOREIGN KEY (`allergy_id`) REFERENCES `ALLERGY` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ARTICLE_ALLERGY`
--

LOCK TABLES `ARTICLE_ALLERGY` WRITE;
/*!40000 ALTER TABLE `ARTICLE_ALLERGY` DISABLE KEYS */;
INSERT INTO `ARTICLE_ALLERGY` VALUES (4,1),(6,1),(6,3);
/*!40000 ALTER TABLE `ARTICLE_ALLERGY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATEGORY`
--

DROP TABLE IF EXISTS `CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CATEGORY` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `description` text COLLATE utf8mb3_spanish2_ci,
  `IMG` varchar(50) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORY`
--

LOCK TABLES `CATEGORY` WRITE;
/*!40000 ALTER TABLE `CATEGORY` DISABLE KEYS */;
INSERT INTO `CATEGORY` VALUES (1,'Drinks','Bebidas únicas para refrescar y disfrutar','drinks.jfif'),(2,'Meals','Platos deliciosos para cualquier ocasión','meals.jfif'),(3,'Snacks','Caprichos rápidos y llenos de sabor','snacks.jfif');
/*!40000 ALTER TABLE `CATEGORY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ORDER`
--

DROP TABLE IF EXISTS `ORDER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ORDER` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('Pending','Completed','Cancelled') COLLATE utf8mb3_spanish2_ci NOT NULL,
  `promo_code_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `promo_code_id` (`promo_code_id`),
  CONSTRAINT `ORDER_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `USER` (`id`),
  CONSTRAINT `ORDER_ibfk_2` FOREIGN KEY (`promo_code_id`) REFERENCES `PROMO_CODE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ORDER`
--

LOCK TABLES `ORDER` WRITE;
/*!40000 ALTER TABLE `ORDER` DISABLE KEYS */;
INSERT INTO `ORDER` VALUES (2,3,'2024-11-21 10:00:00','Pending',NULL),(12,2,'2024-05-09 00:00:00','Completed',NULL),(16,3,'2025-01-05 00:00:00','Completed',NULL),(17,13,'2025-01-06 00:00:00','Completed',NULL),(18,13,'2025-01-06 00:00:00','Completed',NULL),(19,3,'2025-01-06 21:51:39','Completed',NULL),(20,3,'2025-01-06 22:22:30','Completed',NULL);
/*!40000 ALTER TABLE `ORDER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ORDER_LINE`
--

DROP TABLE IF EXISTS `ORDER_LINE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ORDER_LINE` (
  `order_id` int NOT NULL,
  `line_number` int NOT NULL,
  `article_id` int NOT NULL,
  `quantity` int NOT NULL,
  `special_offer_id` int DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_id`,`line_number`),
  KEY `article_id` (`article_id`),
  KEY `special_offer_id` (`special_offer_id`),
  CONSTRAINT `ORDER_LINE_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ORDER` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ORDER_LINE_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `ARTICLE` (`id`),
  CONSTRAINT `ORDER_LINE_ibfk_3` FOREIGN KEY (`special_offer_id`) REFERENCES `SPECIAL_OFFER` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ORDER_LINE`
--

LOCK TABLES `ORDER_LINE` WRITE;
/*!40000 ALTER TABLE `ORDER_LINE` DISABLE KEYS */;
INSERT INTO `ORDER_LINE` VALUES (2,1,7,5,2,10.00,0.00),(16,1,8,2,NULL,11.00,5.50),(17,1,2,4,NULL,14.00,3.50),(18,1,2,4,NULL,14.00,3.50),(18,2,7,1,NULL,2.50,2.50),(18,3,8,1,NULL,5.50,5.50),(19,1,2,1,NULL,3.50,3.50),(19,2,7,1,NULL,2.50,2.50),(19,3,29,1,NULL,0.00,0.00),(19,4,1,1,NULL,3.50,3.50),(19,5,30,1,NULL,0.00,0.00),(20,1,2,1,NULL,3.50,3.50),(20,2,30,1,NULL,0.00,0.00),(20,3,3,4,NULL,47.28,11.82);
/*!40000 ALTER TABLE `ORDER_LINE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PROMO_CODE`
--

DROP TABLE IF EXISTS `PROMO_CODE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PROMO_CODE` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `discount_percentage` int NOT NULL,
  `expiration_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PROMO_CODE`
--

LOCK TABLES `PROMO_CODE` WRITE;
/*!40000 ALTER TABLE `PROMO_CODE` DISABLE KEYS */;
INSERT INTO `PROMO_CODE` VALUES (1,'DESCUENTO10',10,'2024-12-31'),(2,'ENVIOGRATIS',100,'2024-11-30');
/*!40000 ALTER TABLE `PROMO_CODE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ROLE`
--

DROP TABLE IF EXISTS `ROLE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ROLE` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `description` text COLLATE utf8mb3_spanish2_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ROLE`
--

LOCK TABLES `ROLE` WRITE;
/*!40000 ALTER TABLE `ROLE` DISABLE KEYS */;
INSERT INTO `ROLE` VALUES (1,'Admin','Gestiona toda la aplicación'),(2,'Customer','Usuario que realiza compras en la aplicación');
/*!40000 ALTER TABLE `ROLE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SPECIAL_OFFER`
--

DROP TABLE IF EXISTS `SPECIAL_OFFER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `SPECIAL_OFFER` (
  `id` int NOT NULL AUTO_INCREMENT,
  `article_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `value` decimal(5,2) NOT NULL,
  `description` text COLLATE utf8mb3_spanish2_ci,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `SPECIAL_OFFER_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `ARTICLE` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SPECIAL_OFFER`
--

LOCK TABLES `SPECIAL_OFFER` WRITE;
/*!40000 ALTER TABLE `SPECIAL_OFFER` DISABLE KEYS */;
INSERT INTO `SPECIAL_OFFER` VALUES (1,3,2,'2024-11-01','2024-11-30',20.00,'Descuento en la segunda bolsa de café'),(2,7,5,'2024-11-01','2024-12-15',10.00,'Pack ahorro de bebidas energéticas');
/*!40000 ALTER TABLE `SPECIAL_OFFER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USER`
--

DROP TABLE IF EXISTS `USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `USER` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb3_spanish2_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `USER_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `ROLE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USER`
--

LOCK TABLES `USER` WRITE;
/*!40000 ALTER TABLE `USER` DISABLE KEYS */;
INSERT INTO `USER` VALUES (2,'Admin','Master','admin@example.com','hola','987654321','Oficinas centrales',1),(3,'Ana','Admin','ana@admin.com','$2y$10$rwGfN7oHLubbjtQ91IA9TerPFn8umSouOsdjKtXIMtw.cPp7ccP7W','555','',1),(10,'Joel','Perez','joel@gmail.com','$2y$10$sUuqqhoU4hilDWqS.I0DROqng02BVJR9pkEAK6wb33tRF/XRp.TdW','','',2),(13,'1','1','2@2','$2y$10$0YGAJnxIW.R8aMJR6FAtzOjL6M0GvtXxMTSJKlELFTr2Ot7GiU5mi',NULL,NULL,NULL);
/*!40000 ALTER TABLE `USER` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-06 23:28:20
