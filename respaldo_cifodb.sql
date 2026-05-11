-- MySQL dump 10.13  Distrib 8.4.8, for Linux (x86_64)
--
-- Host: localhost    Database: cifodb
-- ------------------------------------------------------
-- Server version	8.4.8

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
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `slug` json NOT NULL,
  `name` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'{\"ca\": \"programacio-i-desenvolupament\", \"es\": \"programacion-y-desarrollo\"}','{\"ca\": \"Programació i desenvolupament\", \"es\": \"Programación y desarrollo\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(2,'{\"ca\": \"ciberseguretat\", \"es\": \"ciberseguridad\"}','{\"ca\": \"Ciberseguretat\", \"es\": \"Ciberseguridad\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(3,'{\"ca\": \"tecnologies-emergents\", \"es\": \"tecnologias-emergentes\"}','{\"ca\": \"Tecnologies emergents\", \"es\": \"Tecnologías emergentes\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(4,'{\"ca\": \"competencies-digitals\", \"es\": \"competencias-digitales\"}','{\"ca\": \"Competències digitals\", \"es\": \"Competencias digitales\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_teacher`
--

DROP TABLE IF EXISTS `course_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `course_teacher` (
  `course_id` bigint unsigned NOT NULL,
  `teacher_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`course_id`,`teacher_id`),
  KEY `course_teacher_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `course_teacher_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  CONSTRAINT `course_teacher_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_teacher`
--

LOCK TABLES `course_teacher` WRITE;
/*!40000 ALTER TABLE `course_teacher` DISABLE KEYS */;
INSERT INTO `course_teacher` VALUES (1,1),(16,1),(2,2),(17,2),(3,3),(18,3),(4,4),(19,4),(5,5),(20,5),(6,6),(7,7),(8,8),(9,9),(10,10),(11,11),(12,12),(13,13),(14,14),(15,15);
/*!40000 ALTER TABLE `course_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `courses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `course_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_category_id_foreign` (`category_id`),
  CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,1,'20/CIFOFSE-PD/101/2457812/001','{\"ca\": \"Curs de Laravel Bàsic\", \"es\": \"Curso de Laravel Básico\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(2,1,'20/CIFOFSE-PD/102/2457813/002','{\"ca\": \"Fonaments de Java\", \"es\": \"Fundamentos de Java\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(3,1,'21/CIFOFSE-PD/103/2457814/003','{\"ca\": \"Desenvolupament Frontend amb React\", \"es\": \"Desarrollo Frontend con React\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(4,1,'21/CIFOFSE-PD/104/2457815/004','{\"ca\": \"Introducció a SQL\", \"es\": \"Introducción a SQL\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(5,1,'22/CIFOFSE-PD/105/2457816/005','{\"ca\": \"Node.js per a Principiants\", \"es\": \"Node.js para Principiantes\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(6,1,'22/CIFOFSE-PD/106/2457817/006','{\"ca\": \"Python i Automatització\", \"es\": \"Python y Automatización\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(7,1,'23/CIFOFSE-PD/107/2457818/007','{\"ca\": \"APIs REST amb Spring Boot\", \"es\": \"APIs REST con Spring Boot\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(8,1,'23/CIFOFSE-PD/108/2457819/008','{\"ca\": \"Bases de Dades Relacionals\", \"es\": \"Bases de Datos Relacionales\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(9,1,'24/CIFOFSE-PD/109/2457820/009','{\"ca\": \"Git i Control de Versions\", \"es\": \"Git y Control de Versiones\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(10,1,'24/CIFOFSE-PD/110/2457821/010','{\"ca\": \"Desenvolupament Web amb Vue\", \"es\": \"Desarrollo Web con Vue\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(11,1,'25/CIFOFSE-PD/111/2457822/011','{\"ca\": \"DevOps Inicial\", \"es\": \"DevOps Inicial\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(12,1,'25/CIFOFSE-PD/112/2457823/012','{\"ca\": \"Programació Orientada a Objectes\", \"es\": \"Programación Orientada a Objetos\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(13,1,'23/CIFOFSE-PD/113/2457824/013','{\"ca\": \"Docker i Contenidors\", \"es\": \"Docker y Contenedores\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(14,1,'24/CIFOFSE-PD/114/2457825/014','{\"ca\": \"Testing Automatitzat\", \"es\": \"Testing Automatizado\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(15,2,'22/CIFOFSE-CS/201/3457812/015','{\"ca\": \"Seguretat en Xarxes\", \"es\": \"Seguridad en Redes\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(16,2,'23/CIFOFSE-CS/202/3457813/016','{\"ca\": \"Hacking Ètic Bàsic\", \"es\": \"Hacking Ético Básico\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(17,3,'24/CIFOFSE-TE/301/4457812/017','{\"ca\": \"Introducció a la Intel·ligència Artificial\", \"es\": \"Introducción a Inteligencia Artificial\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(18,3,'25/CIFOFSE-TE/302/4457813/018','{\"ca\": \"IoT amb Sensors\", \"es\": \"IoT con Sensores\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(19,4,'24/CIFOFSE-CD/401/5457812/019','{\"ca\": \"UX UI per a Aplicacions\", \"es\": \"UX UI para Aplicaciones\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(20,4,'25/CIFOFSE-CD/402/5457813/020','{\"ca\": \"Eines Digitals Col·laboratives\", \"es\": \"Herramientas Digitales Colaborativas\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL);
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint unsigned NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'App\\Models\\Project',1,'d21a7a18-c37d-44e5-b4c2-a080603677bf','images','image-01','project-1-1.jpg','image/jpeg','media','media',111061,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:31','2026-05-11 17:57:31'),(2,'App\\Models\\Project',1,'c51c829e-ccdf-40ab-ae62-67883b870ad6','images','image-03','project-1-2.jpg','image/jpeg','media','media',114170,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:31','2026-05-11 17:57:31'),(3,'App\\Models\\Project',1,'229bfda7-0170-4dde-b404-82f2944744ad','images','image-04','project-1-3.jpg','image/jpeg','media','media',129620,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:31','2026-05-11 17:57:32'),(4,'App\\Models\\Project',2,'4c5433ed-5b8c-4fb9-933e-e46e941193ad','images','image-06','project-2-1.jpg','image/jpeg','media','media',297701,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:32','2026-05-11 17:57:32'),(5,'App\\Models\\Project',2,'0259cfec-d91d-4420-b2b6-c72f5d232fdc','images','image-07','project-2-2.jpg','image/jpeg','media','media',112137,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:32','2026-05-11 17:57:32'),(6,'App\\Models\\Project',2,'931b228a-506c-46eb-802c-14375ca9194a','images','image-08','project-2-3.jpg','image/jpeg','media','media',134844,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:32','2026-05-11 17:57:32'),(7,'App\\Models\\Project',2,'17a4844c-47f8-4f06-9326-d2f6e7cf3276','images','image-09','project-2-4.jpg','image/jpeg','media','media',201646,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:32','2026-05-11 17:57:32'),(8,'App\\Models\\Project',3,'f26d3302-1b4f-42b3-9292-089d3a9b0480','images','image-12','project-3-1.jpg','image/jpeg','media','media',230231,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:32','2026-05-11 17:57:33'),(9,'App\\Models\\Project',3,'172b7d0b-a1aa-452a-8667-59ac49571b75','images','image-02','project-3-2.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:33','2026-05-11 17:57:33'),(10,'App\\Models\\Project',3,'da22fa49-b593-435b-a640-4cb518a39676','images','image-01','project-3-3.jpg','image/jpeg','media','media',111061,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:33','2026-05-11 17:57:33'),(11,'App\\Models\\Project',3,'0ed0fedc-fe98-454e-9548-bde94ded9818','images','image-03','project-3-4.jpg','image/jpeg','media','media',114170,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:33','2026-05-11 17:57:33'),(12,'App\\Models\\Project',3,'78aeaa2a-1b58-4054-b9ef-3fcc3ff53d2b','images','image-04','project-3-5.jpg','image/jpeg','media','media',129620,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:33','2026-05-11 17:57:33'),(13,'App\\Models\\Project',4,'5bc444f3-cf86-4d06-8ad7-7d3b2c8c9274','images','image-11','project-4-1.jpg','image/jpeg','media','media',615922,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:33','2026-05-11 17:57:33'),(14,'App\\Models\\Project',4,'429f8b09-c53a-4c1c-add6-eb86455d7b84','images','image-12','project-4-2.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:33','2026-05-11 17:57:34'),(15,'App\\Models\\Project',4,'fd101a9a-939b-4d6c-8cd2-d9ed2bc3b516','images','image-02','project-4-3.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:34','2026-05-11 17:57:34'),(16,'App\\Models\\Project',5,'190b72c1-dfaf-4b09-963d-fda1f43cfbf4','images','image-06','project-5-1.jpg','image/jpeg','media','media',297701,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:34','2026-05-11 17:57:34'),(17,'App\\Models\\Project',5,'39915ab5-8e28-4863-9815-67c239b59a4b','images','image-07','project-5-2.jpg','image/jpeg','media','media',112137,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:34','2026-05-11 17:57:34'),(18,'App\\Models\\Project',5,'c241400f-437b-433d-8a01-d75cc8962a19','images','image-08','project-5-3.jpg','image/jpeg','media','media',134844,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:34','2026-05-11 17:57:34'),(19,'App\\Models\\Project',5,'2869e9d1-03c6-4849-9684-982c3a7eb474','images','image-09','project-5-4.jpg','image/jpeg','media','media',201646,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:34','2026-05-11 17:57:35'),(20,'App\\Models\\Project',6,'0a204232-83d3-4b96-94b4-6ac8ae06cf85','images','image-03','project-6-1.jpg','image/jpeg','media','media',114170,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:35','2026-05-11 17:57:35'),(21,'App\\Models\\Project',6,'34addde5-f937-4609-a049-c7cc40ea556e','images','image-04','project-6-2.jpg','image/jpeg','media','media',129620,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:35','2026-05-11 17:57:35'),(22,'App\\Models\\Project',6,'a2ec9996-bc87-473d-b070-acd3c3115ed0','images','image-05','project-6-3.jpg','image/jpeg','media','media',404467,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:35','2026-05-11 17:57:35'),(23,'App\\Models\\Project',6,'f1bdd03d-8fb2-47a6-a673-4912c31c9956','images','image-06','project-6-4.jpg','image/jpeg','media','media',297701,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:35','2026-05-11 17:57:35'),(24,'App\\Models\\Project',6,'6ea99b30-6117-498f-a708-0ceecdbce02e','images','image-07','project-6-5.jpg','image/jpeg','media','media',112137,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:35','2026-05-11 17:57:36'),(25,'App\\Models\\Project',7,'eff893cc-9f13-401a-b859-405ecfb3c067','images','image-08','project-7-1.jpg','image/jpeg','media','media',134844,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:36','2026-05-11 17:57:36'),(26,'App\\Models\\Project',7,'5f9b4fe4-1eb2-46c7-afab-f0784a628a7b','images','image-09','project-7-2.jpg','image/jpeg','media','media',201646,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:36','2026-05-11 17:57:36'),(27,'App\\Models\\Project',7,'c2752338-ec54-4de3-9948-992b85dfa552','images','image-10','project-7-3.jpg','image/jpeg','media','media',178956,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:36','2026-05-11 17:57:36'),(28,'App\\Models\\Project',7,'534b8474-467c-40b0-901f-e3c2ecb2701c','images','image-11','project-7-4.jpg','image/jpeg','media','media',615922,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:36','2026-05-11 17:57:36'),(29,'App\\Models\\Project',7,'c71db921-fd48-4a38-814f-b98254a1c5ea','images','image-12','project-7-5.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:36','2026-05-11 17:57:37'),(30,'App\\Models\\Project',8,'ef8be788-f3d0-4e82-9d8f-885c1e15f60c','images','image-02','project-8-1.png','image/png','media','media',70138,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:37','2026-05-11 17:57:37'),(31,'App\\Models\\Project',8,'222de39f-5e6f-4777-9e37-0da15431e0ef','images','image-01','project-8-2.jpg','image/jpeg','media','media',111061,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:37','2026-05-11 17:57:37'),(32,'App\\Models\\Project',8,'9f88c429-9908-4d73-95dc-73ae71b941c2','images','image-03','project-8-3.jpg','image/jpeg','media','media',114170,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:37','2026-05-11 17:57:37'),(33,'App\\Models\\Project',8,'6ce3f6d5-b79a-4179-a5b7-647391fc8d03','images','image-04','project-8-4.jpg','image/jpeg','media','media',129620,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:37','2026-05-11 17:57:37'),(34,'App\\Models\\Project',8,'c459143e-cad1-446b-a653-b4c0c5479d79','images','image-05','project-8-5.jpg','image/jpeg','media','media',404467,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:37','2026-05-11 17:57:38'),(35,'App\\Models\\Project',9,'5a314f16-3825-4583-9958-6cd2d02fa682','images','image-10','project-9-1.jpg','image/jpeg','media','media',178956,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:38','2026-05-11 17:57:38'),(36,'App\\Models\\Project',9,'ce97da63-2bfb-4f2e-92c5-80e4e9453130','images','image-11','project-9-2.jpg','image/jpeg','media','media',615922,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:38','2026-05-11 17:57:38'),(37,'App\\Models\\Project',9,'adf135bc-e0a2-4449-9fd9-7a52e39bf989','images','image-12','project-9-3.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:38','2026-05-11 17:57:38'),(38,'App\\Models\\Project',9,'23f17fa8-5664-4c54-a841-70b9854ff419','images','image-02','project-9-4.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:38','2026-05-11 17:57:38'),(39,'App\\Models\\Project',10,'1e8f6d6c-4a6f-4f3f-88d7-96f60dbdd345','images','image-01','project-10-1.jpg','image/jpeg','media','media',111061,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:38','2026-05-11 17:57:39'),(40,'App\\Models\\Project',10,'b8e6adb2-f34b-44e4-9b82-f5ccc31f451a','images','image-03','project-10-2.jpg','image/jpeg','media','media',114170,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:39','2026-05-11 17:57:39'),(41,'App\\Models\\Project',10,'15e40a27-73e6-4f6e-bca2-618b0c671436','images','image-04','project-10-3.jpg','image/jpeg','media','media',129620,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:39','2026-05-11 17:57:39'),(42,'App\\Models\\Project',10,'6cc403d9-fe8c-4f47-bfe6-3919a40c6ae2','images','image-05','project-10-4.jpg','image/jpeg','media','media',404467,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:39','2026-05-11 17:57:39'),(43,'App\\Models\\Project',11,'55ba4c5c-2867-40c5-aecc-5cddb6522566','images','image-06','project-11-1.jpg','image/jpeg','media','media',297701,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:39','2026-05-11 17:57:39'),(44,'App\\Models\\Project',11,'f8a057f1-6633-4de5-a21a-c1e1c2394870','images','image-07','project-11-2.jpg','image/jpeg','media','media',112137,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:39','2026-05-11 17:57:40'),(45,'App\\Models\\Project',11,'793221bb-00f4-40ba-85ea-7bfe8c45b5e6','images','image-08','project-11-3.jpg','image/jpeg','media','media',134844,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:40','2026-05-11 17:57:40'),(46,'App\\Models\\Project',11,'01c6214c-8296-4578-b5f1-3448d9ce3427','images','image-09','project-11-4.jpg','image/jpeg','media','media',201646,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:40','2026-05-11 17:57:40'),(47,'App\\Models\\Project',12,'12b4c20f-207d-4c19-89aa-fb0c88d9c391','images','image-11','project-12-1.jpg','image/jpeg','media','media',615922,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:40','2026-05-11 17:57:40'),(48,'App\\Models\\Project',12,'30b14047-1844-4e7a-a78f-9f821cc5958d','images','image-12','project-12-2.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:40','2026-05-11 17:57:40'),(49,'App\\Models\\Project',12,'3b12b0b9-f4a6-451f-87f5-4f623167a924','images','image-02','project-12-3.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:40','2026-05-11 17:57:41'),(50,'App\\Models\\Project',13,'9c5a03ce-2324-4b90-9e5f-9a0ca4ea0e1f','images','image-01','project-13-1.jpg','image/jpeg','media','media',111061,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:41','2026-05-11 17:57:41'),(51,'App\\Models\\Project',13,'970f2f2f-4ab9-4f01-b858-1ef2c7662473','images','image-03','project-13-2.jpg','image/jpeg','media','media',114170,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:41','2026-05-11 17:57:41'),(52,'App\\Models\\Project',13,'5665f5f3-2c93-4911-a992-a0f4b59e969d','images','image-04','project-13-3.jpg','image/jpeg','media','media',129620,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:41','2026-05-11 17:57:41'),(53,'App\\Models\\Project',13,'92eed3c3-34f8-4bbd-8d84-0bb64544de53','images','image-05','project-13-4.jpg','image/jpeg','media','media',404467,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:41','2026-05-11 17:57:41'),(54,'App\\Models\\Project',13,'022c7d7a-d0bb-4111-872d-fe188ff15c82','images','image-06','project-13-5.jpg','image/jpeg','media','media',297701,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:41','2026-05-11 17:57:42'),(55,'App\\Models\\Project',14,'1f95011b-9f09-4aeb-b167-1562c5f544c9','images','image-05','project-14-1.jpg','image/jpeg','media','media',404467,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:42','2026-05-11 17:57:42'),(56,'App\\Models\\Project',14,'f8f96991-6d21-4924-a9f0-5ba2f619ff1b','images','image-06','project-14-2.jpg','image/jpeg','media','media',297701,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:42','2026-05-11 17:57:42'),(57,'App\\Models\\Project',14,'ccc5edbd-fa2e-490a-a8d9-db831e358c8d','images','image-07','project-14-3.jpg','image/jpeg','media','media',112137,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:42','2026-05-11 17:57:42'),(58,'App\\Models\\Project',15,'fae7e0a6-e9ec-41d0-ba8d-f4d3b20fc35c','images','image-08','project-15-1.jpg','image/jpeg','media','media',134844,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:42','2026-05-11 17:57:42'),(59,'App\\Models\\Project',15,'02a8a7d6-ebb6-461f-bc61-3191ad2f407a','images','image-09','project-15-2.jpg','image/jpeg','media','media',201646,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:42','2026-05-11 17:57:42'),(60,'App\\Models\\Project',15,'17cb2753-0d46-4b96-860b-58924bfd34fc','images','image-10','project-15-3.jpg','image/jpeg','media','media',178956,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:43','2026-05-11 17:57:43'),(61,'App\\Models\\Project',16,'87b406d3-4f74-4ac8-9712-b7009f1c01a8','images','image-11','project-16-1.jpg','image/jpeg','media','media',615922,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:43','2026-05-11 17:57:43'),(62,'App\\Models\\Project',16,'25f5d952-d439-43b9-8eda-98a93b880e30','images','image-12','project-16-2.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:43','2026-05-11 17:57:43'),(63,'App\\Models\\Project',16,'adb83c5f-0e85-49d5-914e-7865b39c7d43','images','image-02','project-16-3.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:43','2026-05-11 17:57:43'),(64,'App\\Models\\Project',17,'11b1381f-d41d-4884-9a1b-8728e6e1f1e1','images','image-10','project-17-1.jpg','image/jpeg','media','media',178956,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:43','2026-05-11 17:57:44'),(65,'App\\Models\\Project',17,'aa5e1882-4afd-4c0d-a294-b53dafdfe90f','images','image-11','project-17-2.jpg','image/jpeg','media','media',615922,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:44','2026-05-11 17:57:44'),(66,'App\\Models\\Project',17,'3fd0c75f-9a57-49b6-89f4-bd5047cc0264','images','image-12','project-17-3.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:44','2026-05-11 17:57:44'),(67,'App\\Models\\Project',17,'1ad67fea-9652-41cf-8be4-efbf449b2ee6','images','image-02','project-17-4.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:44','2026-05-11 17:57:44'),(68,'App\\Models\\Project',17,'2a800a9c-69e2-4f7f-b48b-acc10e7e6044','images','image-01','project-17-5.jpg','image/jpeg','media','media',111061,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:44','2026-05-11 17:57:44'),(69,'App\\Models\\Project',18,'e77de857-f409-4c4a-8e11-b78129670909','images','image-10','project-18-1.jpg','image/jpeg','media','media',178956,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:44','2026-05-11 17:57:45'),(70,'App\\Models\\Project',18,'0a759145-69bb-4ec8-bb03-01ff61964854','images','image-11','project-18-2.jpg','image/jpeg','media','media',615922,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:45','2026-05-11 17:57:45'),(71,'App\\Models\\Project',18,'6f649cd9-7383-45fe-9a67-d46868822ec2','images','image-12','project-18-3.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:45','2026-05-11 17:57:45'),(72,'App\\Models\\Project',18,'b64bb65e-5c74-40fe-8b04-bf10a174270f','images','image-02','project-18-4.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:45','2026-05-11 17:57:45'),(73,'App\\Models\\Project',19,'f5595723-fb39-41d0-9d8d-9735a4ee9ddd','images','image-01','project-19-1.jpg','image/jpeg','media','media',111061,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:45','2026-05-11 17:57:45'),(74,'App\\Models\\Project',19,'5e56ca6d-11ad-4606-86d6-1da7eb1ae579','images','image-03','project-19-2.jpg','image/jpeg','media','media',114170,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:45','2026-05-11 17:57:46'),(75,'App\\Models\\Project',19,'9d850db5-2680-4649-8517-19b8bf250640','images','image-04','project-19-3.jpg','image/jpeg','media','media',129620,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:46','2026-05-11 17:57:46'),(76,'App\\Models\\Project',19,'07295238-4465-4bff-93f2-26b275e84686','images','image-05','project-19-4.jpg','image/jpeg','media','media',404467,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:46','2026-05-11 17:57:46'),(77,'App\\Models\\Project',20,'715f31a0-7923-4486-8e89-6ae97b4b89a9','images','image-06','project-20-1.jpg','image/jpeg','media','media',297701,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:46','2026-05-11 17:57:46'),(78,'App\\Models\\Project',20,'d3c6c824-837a-4ff0-badc-e5aca4496616','images','image-07','project-20-2.jpg','image/jpeg','media','media',112137,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:46','2026-05-11 17:57:46'),(79,'App\\Models\\Project',20,'bc850db8-921f-42fc-bc8d-08d9f3df004f','images','image-08','project-20-3.jpg','image/jpeg','media','media',134844,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:46','2026-05-11 17:57:46'),(80,'App\\Models\\Project',20,'434a5c88-80aa-489a-983a-a935838976a3','images','image-09','project-20-4.jpg','image/jpeg','media','media',201646,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:46','2026-05-11 17:57:47'),(81,'App\\Models\\Project',21,'9c00cecb-29e6-4c4b-896b-4c5b0e128245','images','image-06','project-21-1.jpg','image/jpeg','media','media',297701,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:47','2026-05-11 17:57:47'),(82,'App\\Models\\Project',21,'af8b8df2-1dbc-4d19-a895-27f79c06290d','images','image-07','project-21-2.jpg','image/jpeg','media','media',112137,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:47','2026-05-11 17:57:47'),(83,'App\\Models\\Project',21,'e2562ec3-4749-4343-a02a-2dd30e1d1efc','images','image-08','project-21-3.jpg','image/jpeg','media','media',134844,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:47','2026-05-11 17:57:47'),(84,'App\\Models\\Project',21,'a73a1876-91ad-4c4e-b204-d59787e7f32a','images','image-09','project-21-4.jpg','image/jpeg','media','media',201646,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:47','2026-05-11 17:57:47'),(85,'App\\Models\\Project',21,'09effc14-ab26-4618-9a8e-f4d6d89f2f06','images','image-10','project-21-5.jpg','image/jpeg','media','media',178956,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:47','2026-05-11 17:57:48'),(86,'App\\Models\\Project',22,'aece40d4-dceb-42ff-bebc-34dab0da847d','images','image-11','project-22-1.jpg','image/jpeg','media','media',615922,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:48','2026-05-11 17:57:48'),(87,'App\\Models\\Project',22,'684d7dea-3d5f-413e-94bb-027730eb0b0c','images','image-12','project-22-2.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:48','2026-05-11 17:57:48'),(88,'App\\Models\\Project',22,'2016c17f-346c-4756-a724-3393aab877fc','images','image-02','project-22-3.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:48','2026-05-11 17:57:48'),(89,'App\\Models\\Project',22,'7a87863f-25ab-48d4-aa48-a354e2ceb595','images','image-01','project-22-4.jpg','image/jpeg','media','media',111061,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:48','2026-05-11 17:57:48'),(90,'App\\Models\\Project',22,'27d43dea-fc38-4621-8590-291f83801700','images','image-03','project-22-5.jpg','image/jpeg','media','media',114170,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:48','2026-05-11 17:57:49'),(91,'App\\Models\\Project',23,'9105f1d2-e549-4036-aabd-658b86c0522c','images','image-04','project-23-1.jpg','image/jpeg','media','media',129620,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:49','2026-05-11 17:57:49'),(92,'App\\Models\\Project',23,'47577346-d120-4ff5-95f2-fd12267da944','images','image-05','project-23-2.jpg','image/jpeg','media','media',404467,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:49','2026-05-11 17:57:49'),(93,'App\\Models\\Project',23,'7ed8288a-31ac-4e4d-a539-44b6534ecb8c','images','image-06','project-23-3.jpg','image/jpeg','media','media',297701,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:49','2026-05-11 17:57:49'),(94,'App\\Models\\Project',23,'2ce9f786-bc0e-4f2b-8f85-11fd7effd134','images','image-07','project-23-4.jpg','image/jpeg','media','media',112137,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:49','2026-05-11 17:57:49'),(95,'App\\Models\\Project',23,'ff974ba2-4913-4649-8305-e7558b350796','images','image-08','project-23-5.jpg','image/jpeg','media','media',134844,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:49','2026-05-11 17:57:50'),(96,'App\\Models\\Project',24,'06467bea-41d7-4ff9-8f44-4db55101a14e','images','image-09','project-24-1.jpg','image/jpeg','media','media',201646,'[]','{\"is_featured\": true}','{\"card\": true, \"thumb\": true}','[]',1,'2026-05-11 17:57:50','2026-05-11 17:57:50'),(97,'App\\Models\\Project',24,'149f08e8-d688-499c-89fb-357a4c9b64ec','images','image-10','project-24-2.jpg','image/jpeg','media','media',178956,'[]','[]','{\"card\": true, \"thumb\": true}','[]',2,'2026-05-11 17:57:50','2026-05-11 17:57:50'),(98,'App\\Models\\Project',24,'67b9b87d-21ac-4657-b5d6-118a1a333ae0','images','image-11','project-24-3.jpg','image/jpeg','media','media',615922,'[]','[]','{\"card\": true, \"thumb\": true}','[]',3,'2026-05-11 17:57:50','2026-05-11 17:57:50'),(99,'App\\Models\\Project',24,'9146e806-e0e9-42c3-8952-6a19bfa5bf9c','images','image-12','project-24-4.jpg','image/jpeg','media','media',230231,'[]','[]','{\"card\": true, \"thumb\": true}','[]',4,'2026-05-11 17:57:50','2026-05-11 17:57:50'),(100,'App\\Models\\Project',24,'dee2f759-1285-41cf-9aad-c141bded31e2','images','image-02','project-24-5.png','image/png','media','media',70138,'[]','[]','{\"card\": true, \"thumb\": true}','[]',5,'2026-05-11 17:57:51','2026-05-11 17:57:51');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_04_17_092416_add_two_factor_columns_to_users_table',1),(5,'2026_04_17_100252_create_permission_tables',1),(6,'2026_04_17_140702_create_categories_table',1),(7,'2026_04_17_150656_create_courses_table',1),(8,'2026_04_17_150706_create_tags_table',1),(9,'2026_04_17_150710_create_students_table',1),(10,'2026_04_17_150714_create_projects_table',1),(11,'2026_04_17_150730_create_project_files_table',1),(12,'2026_04_17_150809_create_project_tag_table',1),(13,'2026_04_22_172154_create_project_student_table',1),(14,'2026_04_22_235115_create_teachers_table',1),(15,'2026_04_23_004450_create_course_teacher_table',1),(16,'2026_05_06_004807_create_media_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(2,'App\\Models\\User',2),(3,'App\\Models\\User',3),(3,'App\\Models\\User',4),(3,'App\\Models\\User',5),(3,'App\\Models\\User',6),(3,'App\\Models\\User',7),(3,'App\\Models\\User',8),(3,'App\\Models\\User',9),(3,'App\\Models\\User',10),(3,'App\\Models\\User',11),(3,'App\\Models\\User',12);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'roles.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(2,'roles.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(3,'roles.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(4,'roles.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(5,'permissions.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(6,'permissions.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(7,'permissions.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(8,'permissions.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(9,'dashboard.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(10,'users.assign-roles','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(11,'categories.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(12,'categories.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(13,'categories.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(14,'categories.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(15,'courses.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(16,'courses.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(17,'courses.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(18,'courses.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(19,'projects.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(20,'projects.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(21,'projects.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(22,'projects.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(23,'students.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(24,'students.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(25,'students.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(26,'students.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(27,'tags.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(28,'tags.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(29,'tags.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(30,'tags.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(31,'teachers.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(32,'teachers.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(33,'teachers.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(34,'teachers.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(35,'users.view','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(36,'users.create','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(37,'users.update','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(38,'users.delete','web','2026-05-11 17:57:29','2026-05-11 17:57:29');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_files`
--

DROP TABLE IF EXISTS `project_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint unsigned NOT NULL,
  `type` enum('pdf','document','spreadsheet','presentation','markdown','video') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pdf',
  `url` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` json DEFAULT NULL,
  `sort_order` int unsigned NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_files_project_id_index` (`project_id`),
  KEY `project_files_sort_order_index` (`sort_order`),
  CONSTRAINT `project_files_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_files`
--

LOCK TABLES `project_files` WRITE;
/*!40000 ALTER TABLE `project_files` DISABLE KEYS */;
INSERT INTO `project_files` VALUES (1,1,'pdf','http://cedillo.org/quis-ut-alias-consequatur-est','{\"es\": null}',7,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(2,1,'video','http://guillen.net/','{\"ca\": \"aliquam vel animi\", \"es\": \"reprehenderit ab blanditiis\"}',10,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(3,2,'pdf','http://tapia.es/non-quae-quia-debitis','{\"ca\": \"sit autem molestiae\", \"es\": \"quia autem ea\"}',9,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(4,2,'pdf','http://valladares.com/autem-et-totam-dolorem-exercitationem-iusto-repellat','{\"ca\": \"consequatur harum id\", \"es\": \"est ducimus molestiae\"}',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(5,2,'presentation','http://herrera.es/sunt-sit-quia-expedita-occaecati-quia','{\"ca\": \"deserunt quas alias\", \"es\": \"nesciunt quis at\"}',5,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(6,3,'spreadsheet','https://www.montez.org/et-qui-sint-aliquam','{\"ca\": \"soluta consequatur nostrum\", \"es\": \"inventore saepe aliquam\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(7,3,'presentation','http://www.verduzco.es/','{\"ca\": \"minus magni ea\", \"es\": \"velit rem laudantium\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(8,4,'spreadsheet','http://www.brito.com/','{\"es\": null}',0,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(9,4,'video','http://www.melgar.es/','{\"ca\": \"ut assumenda et\", \"es\": \"odio doloribus culpa\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(10,4,'markdown','http://www.olvera.com/nihil-nulla-sint-tempora-dolor-quo-fugit-reprehenderit.html','{\"ca\": \"cumque dolores laborum\", \"es\": \"laudantium suscipit est\"}',0,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(11,5,'presentation','http://herrero.org/ab-autem-voluptates-ut-reprehenderit','{\"ca\": \"ab earum cupiditate\", \"es\": \"facilis corporis eos\"}',10,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(12,5,'spreadsheet','http://www.nava.com/','{\"ca\": \"dolores mollitia voluptatem\", \"es\": \"ut laudantium doloremque\"}',3,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(13,5,'video','http://www.esparza.net/','{\"ca\": \"quisquam atque occaecati\", \"es\": \"sed hic est\"}',6,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(14,6,'spreadsheet','http://cisneros.com/illum-porro-totam-aut','{\"es\": null}',5,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(15,6,'pdf','http://padilla.es/est-deserunt-nulla-et-ut-ut-officia','{\"ca\": \"dolores minus libero\", \"es\": \"ipsam et accusantium\"}',3,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(16,7,'presentation','http://ortiz.net/ut-qui-eos-excepturi-occaecati-qui-eum','{\"ca\": \"veniam sit eum\", \"es\": \"nostrum nihil et\"}',0,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(17,7,'document','http://atencio.es/','{\"ca\": \"et officia minus\", \"es\": \"voluptatibus eaque velit\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(18,9,'spreadsheet','http://www.raya.com/provident-quis-tempore-et','{\"ca\": \"dolore quis qui\", \"es\": \"exercitationem error distinctio\"}',3,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(19,10,'pdf','https://www.florez.com.es/quia-sunt-ex-sit-dolorem-quas-quae','{\"es\": null}',6,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(20,11,'markdown','https://www.patino.com/aut-dolorem-est-et-tempora-ipsum-occaecati','{\"ca\": \"et consequatur aut\", \"es\": \"ut accusamus aperiam\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(21,12,'video','http://alaniz.es/sunt-laboriosam-ducimus-veritatis-eum-natus-cupiditate-molestiae.html','{\"ca\": \"facere perspiciatis voluptatem\", \"es\": \"a ratione incidunt\"}',7,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(22,12,'document','http://ulloa.es/mollitia-rerum-cupiditate-odio-fugit-ea-aut-ea.html','{\"ca\": \"sint laboriosam eius\", \"es\": \"repellat sequi aliquid\"}',9,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(23,12,'spreadsheet','http://caraballo.es/quaerat-ipsa-asperiores-numquam-omnis','{\"ca\": \"reprehenderit omnis corporis\", \"es\": \"vitae laboriosam aut\"}',6,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(24,13,'pdf','http://lebron.es/sint-quo-velit-consequatur-qui-aperiam-quas.html','{\"es\": null}',0,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(25,14,'spreadsheet','http://www.pena.com/magnam-est-quaerat-voluptate-vitae-repellat','{\"ca\": \"incidunt accusamus rerum\", \"es\": \"ut qui nam\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(26,14,'video','http://www.carretero.es/','{\"ca\": \"suscipit velit quo\", \"es\": \"ut est aut\"}',1,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(27,15,'document','http://www.frias.com/eveniet-totam-dolorem-libero','{\"ca\": \"accusantium labore et\", \"es\": \"sit ratione suscipit\"}',0,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(28,15,'document','http://www.zaragoza.com/et-delectus-vitae-natus-qui.html','{\"ca\": \"repudiandae soluta ut\", \"es\": \"ut natus aut\"}',9,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(29,15,'spreadsheet','http://vidal.com/ut-voluptas-sint-voluptate-provident-quia.html','{\"ca\": \"sit et et\", \"es\": \"et esse officiis\"}',2,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(30,16,'spreadsheet','http://www.tijerina.org/et-rem-explicabo-voluptatem-iusto','{\"ca\": \"nesciunt facere praesentium\", \"es\": \"et tempora maxime\"}',0,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(31,16,'pdf','http://www.conde.org/ut-eos-repellat-quia-voluptates.html','{\"es\": null}',7,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(32,17,'presentation','http://www.jurado.org/sed-quod-qui-nulla-maiores-temporibus-quia.html','{\"ca\": \"quibusdam dolor excepturi\", \"es\": \"dolore rerum ea\"}',4,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(33,18,'document','http://amador.net/ducimus-et-recusandae-consequuntur-ad-accusamus-id-ut','{\"ca\": \"sed pariatur et\", \"es\": \"nostrum sed reiciendis\"}',9,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(34,19,'markdown','http://www.aguirre.com.es/ex-doloremque-consequuntur-repudiandae-ratione-voluptatem-quas-perspiciatis.html','{\"ca\": \"ipsam doloribus et\", \"es\": \"suscipit maiores nihil\"}',3,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(35,20,'presentation','http://gaona.com/','{\"ca\": \"suscipit praesentium consequuntur\", \"es\": \"nemo numquam ratione\"}',1,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(36,20,'spreadsheet','https://www.almaraz.es/cumque-eius-facilis-quia-eligendi-velit-quaerat-est','{\"ca\": \"et praesentium dolor\", \"es\": \"autem debitis doloribus\"}',10,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(37,20,'pdf','http://pedraza.com.es/ab-ipsum-dolor-beatae-ullam-debitis-sit-perspiciatis-doloribus.html','{\"ca\": \"rerum sunt dolor\", \"es\": \"recusandae dolorum eos\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(38,21,'spreadsheet','http://esteve.com/molestias-error-at-quisquam-voluptates-quia-sint','{\"ca\": \"quas repellendus ipsum\", \"es\": \"facilis vitae corrupti\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(39,21,'markdown','http://www.cintron.com.es/odit-maiores-est-enim-est-est','{\"ca\": \"accusantium cumque dignissimos\", \"es\": \"omnis odit libero\"}',4,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(40,21,'spreadsheet','http://castillo.org/laboriosam-quos-adipisci-tempore-labore-consequatur-veniam.html','{\"ca\": \"temporibus ipsam et\", \"es\": \"dolorem aut porro\"}',5,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(41,22,'video','http://www.archuleta.net/reprehenderit-iure-soluta-tempore-praesentium-corporis-eos','{\"ca\": \"aut sit est\", \"es\": \"rerum rerum qui\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(42,23,'document','http://raya.es/','{\"ca\": \"et in et\", \"es\": \"blanditiis ut voluptas\"}',7,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(43,23,'video','http://melgar.es/aut-repudiandae-eum-occaecati-qui-expedita-quae-ratione','{\"ca\": \"sed similique aliquam\", \"es\": \"vitae ipsa ad\"}',4,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL),(44,23,'document','http://rolon.com/optio-quaerat-unde-est-totam-voluptates','{\"ca\": \"nisi in assumenda\", \"es\": \"praesentium ullam nam\"}',8,'2026-05-11 17:57:31','2026-05-11 17:57:31',NULL);
/*!40000 ALTER TABLE `project_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_student`
--

DROP TABLE IF EXISTS `project_student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_student` (
  `project_id` bigint unsigned NOT NULL,
  `student_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`project_id`,`student_id`),
  KEY `project_student_student_id_foreign` (`student_id`),
  CONSTRAINT `project_student_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_student_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_student`
--

LOCK TABLES `project_student` WRITE;
/*!40000 ALTER TABLE `project_student` DISABLE KEYS */;
INSERT INTO `project_student` VALUES (6,1),(3,2),(6,2),(20,2),(8,3),(9,3),(14,3),(19,3),(1,4),(11,4),(22,5),(2,6),(2,7),(5,7),(13,7),(19,7),(1,8),(12,8),(18,8),(23,9),(4,10),(6,10),(23,10),(19,11),(6,12),(13,12),(10,13),(9,15),(10,15),(11,16),(14,16),(21,16),(9,17),(12,17),(3,18),(19,18),(23,18),(1,19),(2,20),(18,20),(3,21),(4,22),(18,22),(16,23),(17,23),(22,24),(2,25),(7,25),(10,26),(20,26),(22,26),(23,26),(13,27),(7,28),(11,28),(12,28),(24,28),(3,29),(9,29),(15,29),(12,30);
/*!40000 ALTER TABLE `project_student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_tag`
--

DROP TABLE IF EXISTS `project_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_tag` (
  `project_id` bigint unsigned NOT NULL,
  `tag_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`project_id`,`tag_id`),
  KEY `project_tag_tag_id_foreign` (`tag_id`),
  CONSTRAINT `project_tag_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  CONSTRAINT `project_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_tag`
--

LOCK TABLES `project_tag` WRITE;
/*!40000 ALTER TABLE `project_tag` DISABLE KEYS */;
INSERT INTO `project_tag` VALUES (8,1),(20,2),(2,4),(23,6),(10,7),(15,8),(17,8),(5,9),(14,9),(18,9),(18,10),(10,11),(18,11),(20,11),(9,12),(12,13),(15,15),(5,18),(12,18),(18,18),(11,19),(3,20),(16,20),(4,21),(16,21),(21,21),(7,22),(16,22),(1,23),(4,23),(4,24),(5,25),(13,25),(23,26),(8,28),(18,28),(24,28),(15,29),(20,30),(11,31),(24,31),(9,32),(20,34),(22,34),(2,35),(6,35),(7,35),(12,35),(4,36),(13,36),(21,36),(11,37),(19,38),(23,38),(3,39),(7,40),(20,40);
/*!40000 ALTER TABLE `project_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `course_id` bigint unsigned NOT NULL,
  `project_date` date NOT NULL,
  `slug` json NOT NULL,
  `title` json NOT NULL,
  `description` json DEFAULT NULL,
  `repo_url` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `live_url` varchar(512) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('draft','pending','published','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_course_id_foreign` (`course_id`),
  KEY `projects_status_index` (`status`),
  KEY `projects_featured_index` (`featured`),
  KEY `projects_project_date_index` (`project_date`),
  CONSTRAINT `projects_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,7,'2024-08-19','{\"ca\": \"in-modi-nihil-sunt-ca\", \"es\": \"in-modi-nihil-sunt-es\"}','{\"ca\": \"In modi nihil sunt (CA)\", \"es\": \"In modi nihil sunt (ES)\"}','{\"ca\": \"Id tempore ut est voluptate. Voluptas earum sunt harum sequi consectetur ut natus. Quasi non laborum inventore eius et voluptates qui.\", \"es\": \"Aliquid neque modi unde numquam fugit. Sapiente et ut corporis voluptas. Adipisci est molestiae minus consequatur officiis deserunt necessitatibus. Rerum quibusdam perferendis dolorem dignissimos consequatur consequatur inventore maiores.\"}',NULL,'http://www.pagan.com/doloremque-qui-iure-et-voluptas-recusandae-voluptatum.html','published',1,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(2,10,'2025-09-13','{\"ca\": \"saepe-blanditiis-facilis-saepe-ca\", \"es\": \"saepe-blanditiis-facilis-saepe-es\"}','{\"ca\": \"Saepe blanditiis facilis saepe (CA)\", \"es\": \"Saepe blanditiis facilis saepe (ES)\"}','{\"ca\": \"Sint aliquid eligendi eius. Quod quis consequatur ea qui. Animi corporis qui excepturi ut doloremque est laborum. Consectetur rerum culpa eveniet nemo optio et blanditiis.\", \"es\": \"Eligendi aut consequatur maiores aspernatur. Ut minus tenetur ducimus iusto quo. Magnam impedit id saepe dolor repellat dignissimos ea. Quia qui iure nulla.\"}','http://limon.com/','http://www.bermudez.net/laboriosam-hic-sed-cum-est-doloremque.html','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(3,5,'2025-01-17','{\"ca\": \"eum-voluptatem-magnam-quia-ca\", \"es\": \"eum-voluptatem-magnam-quia-es\"}','{\"ca\": \"Eum voluptatem magnam quia (CA)\", \"es\": \"Eum voluptatem magnam quia (ES)\"}','{\"ca\": \"Ipsam doloribus nisi magnam doloribus. Corporis laborum non quasi assumenda. Quos aut beatae mollitia voluptas deleniti. Sit animi harum mollitia enim voluptas quam molestias.\", \"es\": \"Corporis aut illum recusandae officia et ea. Unde sit error vel dicta et. Aut ad quia est aspernatur dolorum. Ut dolores sint eveniet porro quam et.\"}',NULL,'http://www.longoria.net/ea-corrupti-consequatur-tempora','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(4,5,'2026-03-02','{\"ca\": \"deleniti-itaque-sapiente-omnis-ca\", \"es\": \"deleniti-itaque-sapiente-omnis-es\"}','{\"ca\": \"Deleniti itaque sapiente omnis (CA)\", \"es\": \"Deleniti itaque sapiente omnis (ES)\"}','{\"ca\": \"Quis animi cumque inventore quam et distinctio. Reprehenderit ex autem facilis non. Voluptates tenetur minima eaque aut. Autem ullam voluptatem quasi cupiditate et impedit nisi sequi.\", \"es\": \"Ut vero quaerat eveniet. At dignissimos sit aut perspiciatis eligendi. Qui quasi aut voluptate fugiat a ut reiciendis. Omnis sit error totam numquam et. Sapiente reprehenderit incidunt doloremque itaque.\"}','http://www.maestas.com/id-molestiae-molestiae-quam-eos-iusto-rerum-accusantium','https://garay.com/aut-eius-aspernatur-necessitatibus-vitae-est-molestiae.html','published',1,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(5,19,'2026-02-20','{\"ca\": \"consequatur-voluptatem-dignissimos-ex-ca\", \"es\": \"consequatur-voluptatem-dignissimos-ex-es\"}','{\"ca\": \"Consequatur voluptatem dignissimos ex (CA)\", \"es\": \"Consequatur voluptatem dignissimos ex (ES)\"}','{\"ca\": \"Mollitia et nostrum perferendis minus. Et consequatur recusandae dicta ut est nesciunt. Dolorem et eum doloremque quos mollitia non.\", \"es\": \"Expedita vero architecto impedit non harum eius. Illo sit sint distinctio et quibusdam. Placeat praesentium sit est voluptatum molestiae et inventore. Voluptatem aut et quae blanditiis enim animi et voluptate.\"}',NULL,NULL,'published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(6,13,'2024-08-26','{\"ca\": \"necessitatibus-laudantium-est-omnis-ca\", \"es\": \"necessitatibus-laudantium-est-omnis-es\"}','{\"ca\": \"Necessitatibus laudantium est omnis (CA)\", \"es\": \"Necessitatibus laudantium est omnis (ES)\"}','{\"ca\": \"Dolore id eveniet et optio eaque. Dolorum qui iusto facilis quia quod. Cumque iusto quia temporibus nostrum.\", \"es\": \"Quia repellendus aut voluptatem molestias nostrum. Vel tempore placeat hic enim eum fuga fuga vel. Cumque sed nobis est accusantium placeat. Error voluptates consequatur vel ipsam.\"}','http://jimenez.com/quibusdam-aut-quidem-quibusdam-eveniet-aut.html','http://www.campos.es/','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(7,2,'2024-12-26','{\"ca\": \"suscipit-alias-sit-enim-ca\", \"es\": \"suscipit-alias-sit-enim-es\"}','{\"ca\": \"Suscipit alias sit enim (CA)\", \"es\": \"Suscipit alias sit enim (ES)\"}','{\"ca\": \"Id similique aut voluptate suscipit quis sit doloremque. Ipsam et facilis dolorem suscipit vel. Tempora recusandae ut aliquid ut ut atque ducimus. Voluptatibus eveniet porro porro magnam excepturi.\", \"es\": \"Vero animi sit amet neque iusto quas nihil. Repellat similique voluptatem a omnis. Dignissimos voluptas dicta qui eius ducimus aut voluptatem sit.\"}',NULL,'http://www.gonzales.org/','published',1,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(8,12,'2026-01-19','{\"ca\": \"labore-cupiditate-repudiandae-exercitationem-ca\", \"es\": \"labore-cupiditate-repudiandae-exercitationem-es\"}','{\"ca\": \"Labore cupiditate repudiandae exercitationem (CA)\", \"es\": \"Labore cupiditate repudiandae exercitationem (ES)\"}','{\"ca\": \"Rerum rerum beatae ad dolores qui. Qui sunt et dignissimos harum. Aspernatur ut autem ex a.\", \"es\": \"Vel qui aut dolorem id eos autem sed. Incidunt dolor tempora porro voluptatum corrupti soluta quae. Dicta accusamus aliquam qui ducimus dolores sint. Ea architecto consequatur commodi adipisci. Iste voluptatum qui quas eligendi perspiciatis aut quia a.\"}',NULL,'http://benito.es/et-molestiae-rerum-distinctio-doloribus-a-error-a.html','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(9,4,'2024-11-22','{\"ca\": \"architecto-voluptatem-asperiores-quae-ca\", \"es\": \"architecto-voluptatem-asperiores-quae-es\"}','{\"ca\": \"Architecto voluptatem asperiores quae (CA)\", \"es\": \"Architecto voluptatem asperiores quae (ES)\"}','{\"ca\": \"Totam qui ducimus voluptas voluptas reprehenderit quis qui. Dolor sapiente saepe harum autem dolorum est molestias. Deleniti est fuga eum consequatur non reprehenderit omnis. Vero modi et quo enim id et est animi.\", \"es\": \"In perferendis vitae non incidunt illo. Quam facere sed hic blanditiis. Commodi rerum et sunt repudiandae praesentium. Ut aut beatae officiis est.\"}','https://hurtado.org/dignissimos-et-rem-voluptatibus-aliquam-totam-aut-excepturi-saepe.html',NULL,'published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(10,13,'2024-06-01','{\"ca\": \"quia-ullam-commodi-voluptates-ca\", \"es\": \"quia-ullam-commodi-voluptates-es\"}','{\"ca\": \"Quia ullam commodi voluptates (CA)\", \"es\": \"Quia ullam commodi voluptates (ES)\"}','{\"ca\": \"Facilis ut dolorum velit mollitia. Fugit aut dolore ut et eum. Quis deserunt consequuntur fuga ut alias numquam. Sed molestias nisi rerum architecto. Explicabo aut nihil tempore.\", \"es\": \"Vel minus aut harum rerum minus ut sed. Autem quod qui molestiae iusto aut et veritatis. Laboriosam aut labore iste quo incidunt officia eos fuga.\"}','http://urias.com/',NULL,'published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(11,1,'2025-11-28','{\"ca\": \"aut-rem-tenetur-ut-ca\", \"es\": \"aut-rem-tenetur-ut-es\"}','{\"ca\": \"Aut rem tenetur ut (CA)\", \"es\": \"Aut rem tenetur ut (ES)\"}','{\"ca\": \"Corrupti voluptates voluptas in saepe est qui ut. Quo eligendi esse fugiat non velit est molestiae.\", \"es\": \"Corporis qui eos nesciunt cum dolores. Enim corrupti non qui. Tempore fuga perspiciatis facilis est sequi dolores. Voluptate officiis architecto veritatis.\"}',NULL,NULL,'published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(12,12,'2026-03-13','{\"ca\": \"dolorum-ex-sit-veniam-ca\", \"es\": \"dolorum-ex-sit-veniam-es\"}','{\"ca\": \"Dolorum ex sit veniam (CA)\", \"es\": \"Dolorum ex sit veniam (ES)\"}','{\"ca\": \"Blanditiis dolorem dicta rerum qui fugit. Voluptatum harum voluptas consequuntur id aut qui. Est quaerat quos vitae iste.\", \"es\": \"Iste odio occaecati excepturi doloribus voluptatem. Dicta illo iusto id expedita. Quidem aut saepe non aut distinctio.\"}',NULL,NULL,'published',1,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(13,4,'2026-01-07','{\"ca\": \"repellat-dicta-quam-et-ca\", \"es\": \"repellat-dicta-quam-et-es\"}','{\"ca\": \"Repellat dicta quam et (CA)\", \"es\": \"Repellat dicta quam et (ES)\"}','{\"ca\": \"Quam quisquam mollitia enim id. Velit eaque est aut quo error quam impedit. Quibusdam commodi ut officiis ut. Illum non sunt nihil.\", \"es\": \"Maiores omnis fuga velit ad ratione tempore vel. Dolor ratione earum voluptatem. Cupiditate quisquam odit quia quis mollitia nobis. Corporis blanditiis quas corporis officiis dolorem.\"}','https://guardado.es/nisi-possimus-suscipit-dolorem-beatae.html','http://www.atencio.org/labore-hic-ducimus-dolorem-voluptas-aut-et-deleniti.html','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(14,12,'2026-05-08','{\"ca\": \"quia-sapiente-est-molestias-ca\", \"es\": \"quia-sapiente-est-molestias-es\"}','{\"ca\": \"Quia sapiente est molestias (CA)\", \"es\": \"Quia sapiente est molestias (ES)\"}','{\"ca\": \"Dolor corrupti nemo cum error voluptas. Ipsam sed distinctio ducimus a est. Qui accusantium quas aut.\", \"es\": \"Est ut earum et aut. Sit voluptatem amet dolor consequuntur architecto est qui. Quis est est eligendi illum exercitationem.\"}',NULL,'http://www.fonseca.com.es/assumenda-perspiciatis-voluptatem-quo-error.html','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(15,2,'2025-03-07','{\"ca\": \"est-est-labore-animi-ca\", \"es\": \"est-est-labore-animi-es\"}','{\"ca\": \"Est est labore animi (CA)\", \"es\": \"Est est labore animi (ES)\"}','{\"ca\": \"Quae quas rem a et quae voluptatem repudiandae omnis. Earum vel quas praesentium modi tempora molestiae consectetur. Eius ut placeat excepturi necessitatibus hic et culpa. Necessitatibus eligendi et quia maxime deleniti excepturi consequatur.\", \"es\": \"Aut et voluptas nostrum sint quisquam voluptas qui libero. Aut aut aut praesentium ratione. Ab rem corrupti unde itaque sit cupiditate. Dolorem cum amet doloribus id.\"}',NULL,NULL,'published',1,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(16,18,'2025-11-23','{\"ca\": \"reiciendis-dolorem-vel-earum-ca\", \"es\": \"reiciendis-dolorem-vel-earum-es\"}','{\"ca\": \"Reiciendis dolorem vel earum (CA)\", \"es\": \"Reiciendis dolorem vel earum (ES)\"}','{\"ca\": \"Alias eum esse consectetur eum impedit delectus natus aut. Et dolorem cupiditate earum doloribus. Qui vel eligendi alias velit deserunt consectetur. Illum sapiente voluptatum odio.\", \"es\": \"Aliquam earum omnis qui eligendi quis et commodi. Cum architecto voluptas rerum voluptatem hic sint voluptates. Maiores quis officia nobis totam quasi ad. Et at nesciunt odit.\"}',NULL,'http://www.sotelo.es/quia-ab-voluptas-ipsum-neque-repudiandae-facere-sit-qui.html','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(17,18,'2024-09-27','{\"ca\": \"saepe-est-quisquam-quae-ca\", \"es\": \"saepe-est-quisquam-quae-es\"}','{\"ca\": \"Saepe est quisquam quae (CA)\", \"es\": \"Saepe est quisquam quae (ES)\"}','{\"ca\": \"Rerum perferendis atque hic commodi natus fugit. Commodi iste totam laboriosam sit sunt. Perspiciatis quas optio a quas. Distinctio voluptas ut dignissimos quibusdam.\", \"es\": \"Eligendi molestiae libero aut quibusdam suscipit. Dolores recusandae id consequatur aut aut veritatis et voluptate. Est nihil incidunt error maxime.\"}','http://luna.com/labore-asperiores-odit-adipisci-id-ab-dolores-similique','http://www.polo.es/qui-quaerat-reiciendis-totam-vitae','published',1,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(18,13,'2024-06-26','{\"ca\": \"voluptatem-eligendi-consectetur-fuga-ca\", \"es\": \"voluptatem-eligendi-consectetur-fuga-es\"}','{\"ca\": \"Voluptatem eligendi consectetur fuga (CA)\", \"es\": \"Voluptatem eligendi consectetur fuga (ES)\"}','{\"ca\": \"Quisquam laborum molestias eius. Ipsum laboriosam tempora ut voluptatum dolor impedit sit.\", \"es\": \"Quas est sit vel. Laboriosam architecto omnis necessitatibus et est. Cumque odio impedit nesciunt. Molestiae laboriosam eum dolor quibusdam voluptatem.\"}',NULL,'http://www.godoy.com/et-quis-molestiae-ab-eum-rerum-quasi-laborum-ab','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(19,6,'2026-03-20','{\"ca\": \"asperiores-sed-quam-officiis-ca\", \"es\": \"asperiores-sed-quam-officiis-es\"}','{\"ca\": \"Asperiores sed quam officiis (CA)\", \"es\": \"Asperiores sed quam officiis (ES)\"}','{\"ca\": \"Ipsum expedita aut sed tempora qui quia. Perferendis vel quo laborum sit eveniet. Maiores sint vero fugit atque. Autem consequatur exercitationem sunt sed. Voluptatem in iusto sit ut.\", \"es\": \"Iusto enim molestiae quis beatae et fugiat ab. Non nulla non dignissimos voluptates enim autem voluptates. Dicta ipsam beatae repellendus.\"}',NULL,NULL,'published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(20,8,'2024-10-05','{\"ca\": \"quidem-maiores-totam-aut-ca\", \"es\": \"quidem-maiores-totam-aut-es\"}','{\"ca\": \"Quidem maiores totam aut (CA)\", \"es\": \"Quidem maiores totam aut (ES)\"}','{\"ca\": \"Tenetur sint expedita praesentium explicabo repellat officia consequatur. Autem soluta rerum qui. Repellat optio qui qui dolorem voluptas.\", \"es\": \"Est est autem quia. Pariatur rerum quibusdam libero enim dicta laudantium aperiam. Dolores ipsam repellendus dolores ipsa maiores ut.\"}','http://www.valenzuela.es/voluptas-consequuntur-ab-possimus-minus-quia-quaerat-sed','http://www.castro.com/','published',1,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(21,18,'2025-02-15','{\"ca\": \"voluptatibus-corporis-earum-quia-ca\", \"es\": \"voluptatibus-corporis-earum-quia-es\"}','{\"ca\": \"Voluptatibus corporis earum quia (CA)\", \"es\": \"Voluptatibus corporis earum quia (ES)\"}','{\"ca\": \"Laboriosam et voluptatibus accusamus et. Nobis ut placeat tempore aliquid non. Minus minus voluptas odio et. Est amet soluta unde et dolorum sed.\", \"es\": \"Repudiandae est est accusamus animi nisi. Consequuntur rerum doloribus provident sit est delectus earum. Maiores et officia occaecati velit tempore architecto.\"}',NULL,'http://www.ponce.com/','published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(22,1,'2025-04-30','{\"ca\": \"commodi-voluptates-error-quo-ca\", \"es\": \"commodi-voluptates-error-quo-es\"}','{\"ca\": \"Commodi voluptates error quo (CA)\", \"es\": \"Commodi voluptates error quo (ES)\"}','{\"ca\": \"Cupiditate dolorum similique harum eos vitae. Distinctio modi magni aut ipsam qui sint sint. Neque quasi quo sed iure. Modi sit non velit impedit dolores et voluptate.\", \"es\": \"Velit et aperiam dolorem ut vel. Dignissimos debitis nemo facilis eius adipisci in. Quia quos voluptatem quis perspiciatis. Quas ut repellendus necessitatibus quidem architecto.\"}',NULL,NULL,'published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(23,17,'2026-02-28','{\"ca\": \"nihil-distinctio-consectetur-odio-ca\", \"es\": \"nihil-distinctio-consectetur-odio-es\"}','{\"ca\": \"Nihil distinctio consectetur odio (CA)\", \"es\": \"Nihil distinctio consectetur odio (ES)\"}','{\"ca\": \"Aliquid animi accusamus quod est. Architecto laborum quis quisquam sit quibusdam. Fugit quam natus ipsa.\", \"es\": \"Vel rerum et maiores praesentium quo. Neque officia provident soluta hic ullam. Aliquid saepe in sed voluptatem occaecati eaque molestias. Minus aut culpa magni laborum.\"}',NULL,NULL,'published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(24,6,'2024-12-29','{\"ca\": \"quasi-quia-deleniti-et-ca\", \"es\": \"quasi-quia-deleniti-et-es\"}','{\"ca\": \"Quasi quia deleniti et (CA)\", \"es\": \"Quasi quia deleniti et (ES)\"}','{\"ca\": \"Quae id facilis voluptatum corporis ut facilis harum. Quia occaecati accusantium voluptatem temporibus fugiat minus excepturi. Deserunt ullam numquam quo ad explicabo. Odio asperiores enim praesentium sed tenetur et.\", \"es\": \"Porro et ea voluptatem harum quia error. Mollitia ipsam et ad doloremque. Veniam doloremque non quo illo sed eaque culpa facilis. Est quaerat omnis veritatis aut commodi.\"}','http://arana.es/et-aut-non-possimus-itaque-aperiam-exercitationem',NULL,'published',0,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(25,1),(26,1),(27,1),(28,1),(29,1),(30,1),(31,1),(32,1),(33,1),(34,1),(35,1),(36,1),(37,1),(38,1),(9,2),(11,2),(12,2),(13,2),(14,2),(15,2),(16,2),(17,2),(18,2),(19,2),(20,2),(21,2),(22,2),(23,2),(24,2),(25,2),(26,2),(27,2),(28,2),(29,2),(30,2),(31,2),(32,2),(33,2),(34,2),(1,3),(5,3),(9,3),(11,3),(15,3),(19,3),(23,3),(27,3),(31,3),(35,3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Admin','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(2,'Editor','web','2026-05-11 17:57:29','2026-05-11 17:57:29'),(3,'Viewer','web','2026-05-11 17:57:29','2026-05-11 17:57:29');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('yXTvWntu4PX7EvwVKiynavAYfYiqbHKNJ7OJeN73',NULL,'172.18.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJuZHd3emdzODNSRlB2ejZUelRWTEwxRzlyVzlWYUFOSkdWNTloVUg3IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdFwvZXMiLCJyb3V0ZSI6ImhvbWUifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==',1778515156);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `students` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_email_unique` (`email`),
  KEY `students_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Miguel Ángel Romo','estevez.rocio@example.org','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(2,'Eduardo Saldivar','elsa62@example.com','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(3,'Unai Sierra',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(4,'Irene Mateo',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(5,'Claudia Galindo','valentina.soria@example.org','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(6,'Roberto Puga','quiroz.ona@example.com','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(7,'Martina Villanueva',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(8,'Hugo De la Fuente','jimena86@example.org','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(9,'Beatriz Rosario','andres.pons@example.org','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(10,'Alba Cornejo','ramirez.saul@example.net','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(11,'Mario Trejo',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(12,'Miguel Ángel Bueno','vsandoval@example.com','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(13,'Rayan Pichardo','jechevarria@example.net','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(14,'Inés Tapia','gmojica@example.com','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(15,'Clara Henríquez',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(16,'Abril Cantú','raquel72@example.com','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(17,'Pedro Tello',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(18,'Salma Haro','druiz@example.org','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(19,'José Escudero',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(20,'Teresa Ocasio','sonia.acuna@example.com','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(21,'Josefa Fernández',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(22,'Yaiza Sáez','xalicea@example.net','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(23,'Yago De la Fuente',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(24,'Aina Echevarría','gcabello@example.net','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(25,'Rubén Cobo','lorena.barela@example.com','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(26,'Gonzalo Luque','qoliva@example.net','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(27,'Malak Rivas',NULL,'2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(28,'Mara Roque','unai33@example.com','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(29,'Dario Valenzuela','quiroz.cesar@example.net','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(30,'Alberto Casas','puente.lucas@example.org','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL);
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` json NOT NULL,
  `slug` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,'{\"ca\": \"Laravel\", \"es\": \"Laravel\"}','{\"ca\": \"laravel\", \"es\": \"laravel\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(2,'{\"ca\": \"PHP\", \"es\": \"PHP\"}','{\"ca\": \"php\", \"es\": \"php\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(3,'{\"ca\": \"Java\", \"es\": \"Java\"}','{\"ca\": \"java\", \"es\": \"java\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(4,'{\"ca\": \"Spring Boot\", \"es\": \"Spring Boot\"}','{\"ca\": \"spring-boot\", \"es\": \"spring-boot\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(5,'{\"ca\": \"React\", \"es\": \"React\"}','{\"ca\": \"react\", \"es\": \"react\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(6,'{\"ca\": \"Vue\", \"es\": \"Vue\"}','{\"ca\": \"vue\", \"es\": \"vue\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(7,'{\"ca\": \"Node.js\", \"es\": \"Node.js\"}','{\"ca\": \"nodejs\", \"es\": \"nodejs\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(8,'{\"ca\": \"MySQL\", \"es\": \"MySQL\"}','{\"ca\": \"mysql\", \"es\": \"mysql\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(9,'{\"ca\": \"PostgreSQL\", \"es\": \"PostgreSQL\"}','{\"ca\": \"postgresql\", \"es\": \"postgresql\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(10,'{\"ca\": \"Docker\", \"es\": \"Docker\"}','{\"ca\": \"docker\", \"es\": \"docker\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(11,'{\"ca\": \"Git\", \"es\": \"Git\"}','{\"ca\": \"git\", \"es\": \"git\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(12,'{\"ca\": \"GitHub\", \"es\": \"GitHub\"}','{\"ca\": \"github\", \"es\": \"github\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(13,'{\"ca\": \"API REST\", \"es\": \"API REST\"}','{\"ca\": \"api-rest\", \"es\": \"api-rest\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(14,'{\"ca\": \"Tailwind CSS\", \"es\": \"Tailwind CSS\"}','{\"ca\": \"tailwind-css\", \"es\": \"tailwind-css\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(15,'{\"ca\": \"Bootstrap\", \"es\": \"Bootstrap\"}','{\"ca\": \"bootstrap\", \"es\": \"bootstrap\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(16,'{\"ca\": \"Python\", \"es\": \"Python\"}','{\"ca\": \"python\", \"es\": \"python\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(17,'{\"ca\": \"FastAPI\", \"es\": \"FastAPI\"}','{\"ca\": \"fastapi\", \"es\": \"fastapi\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(18,'{\"ca\": \"Intel·ligència Artificial\", \"es\": \"Inteligencia Artificial\"}','{\"ca\": \"intelligencia-artificial\", \"es\": \"inteligencia-artificial\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(19,'{\"ca\": \"IoT\", \"es\": \"IoT\"}','{\"ca\": \"iot\", \"es\": \"iot\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(20,'{\"ca\": \"Arduino\", \"es\": \"Arduino\"}','{\"ca\": \"arduino\", \"es\": \"arduino\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(21,'{\"ca\": \"Ciberseguretat\", \"es\": \"Ciberseguridad\"}','{\"ca\": \"ciberseguretat\", \"es\": \"ciberseguridad\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(22,'{\"ca\": \"Kali Linux\", \"es\": \"Kali Linux\"}','{\"ca\": \"kali-linux\", \"es\": \"kali-linux\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(23,'{\"ca\": \"Linux\", \"es\": \"Linux\"}','{\"ca\": \"linux\", \"es\": \"linux\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(24,'{\"ca\": \"Firebase\", \"es\": \"Firebase\"}','{\"ca\": \"firebase\", \"es\": \"firebase\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(25,'{\"ca\": \"MongoDB\", \"es\": \"MongoDB\"}','{\"ca\": \"mongodb\", \"es\": \"mongodb\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(26,'{\"ca\": \"Redis\", \"es\": \"Redis\"}','{\"ca\": \"redis\", \"es\": \"redis\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(27,'{\"ca\": \"JWT\", \"es\": \"JWT\"}','{\"ca\": \"jwt\", \"es\": \"jwt\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(28,'{\"ca\": \"TypeScript\", \"es\": \"TypeScript\"}','{\"ca\": \"typescript\", \"es\": \"typescript\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(29,'{\"ca\": \"Angular\", \"es\": \"Angular\"}','{\"ca\": \"angular\", \"es\": \"angular\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(30,'{\"ca\": \"Figma\", \"es\": \"Figma\"}','{\"ca\": \"figma\", \"es\": \"figma\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(31,'{\"ca\": \"UX UI\", \"es\": \"UX UI\"}','{\"ca\": \"ux-ui\", \"es\": \"ux-ui\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(32,'{\"ca\": \"Photoshop\", \"es\": \"Photoshop\"}','{\"ca\": \"photoshop\", \"es\": \"photoshop\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(33,'{\"ca\": \"Canva\", \"es\": \"Canva\"}','{\"ca\": \"canva\", \"es\": \"canva\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(34,'{\"ca\": \"Machine Learning\", \"es\": \"Machine Learning\"}','{\"ca\": \"machine-learning\", \"es\": \"machine-learning\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(35,'{\"ca\": \"TensorFlow\", \"es\": \"TensorFlow\"}','{\"ca\": \"tensorflow\", \"es\": \"tensorflow\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(36,'{\"ca\": \"OpenCV\", \"es\": \"OpenCV\"}','{\"ca\": \"opencv\", \"es\": \"opencv\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(37,'{\"ca\": \"DevOps\", \"es\": \"DevOps\"}','{\"ca\": \"devops\", \"es\": \"devops\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(38,'{\"ca\": \"Kubernetes\", \"es\": \"Kubernetes\"}','{\"ca\": \"kubernetes\", \"es\": \"kubernetes\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(39,'{\"ca\": \"AWS\", \"es\": \"AWS\"}','{\"ca\": \"aws\", \"es\": \"aws\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(40,'{\"ca\": \"Azure\", \"es\": \"Azure\"}','{\"ca\": \"azure\", \"es\": \"azure\"}','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL);
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `teachers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_email_unique` (`email`),
  KEY `teachers_name_index` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teachers`
--

LOCK TABLES `teachers` WRITE;
/*!40000 ALTER TABLE `teachers` DISABLE KEYS */;
INSERT INTO `teachers` VALUES (1,'Carlos Mendoza','carlos.mendoza@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(2,'Laura Puig','laura.puig@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(3,'Marc Vidal','marc.vidal@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(4,'Ana Torres','ana.torres@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(5,'Jordi Serra','jordi.serra@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(6,'Lucia Navarro','lucia.navarro@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(7,'Pablo Ruiz','pablo.ruiz@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(8,'Marta Costa','marta.costa@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(9,'David León','david.leon@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(10,'Nuria Campos','nuria.campos@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(11,'Sergio Blanco','sergio.blanco@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(12,'Eva Soler','eva.soler@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(13,'Raul Peña','raul.pena@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(14,'Cristina Mora','cristina.mora@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL),(15,'Victor Roca','victor.roca@cifofse.edu','2026-05-11 17:57:30','2026-05-11 17:57:30',NULL);
/*!40000 ALTER TABLE `teachers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'es',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador','admin@cifo.com','es','2026-05-11 17:57:29','$2y$12$tAcNfz4zNQuHXCzcZ3WPme21eHOZiUgCrJEkrfDU9Cvc98beoiU1e',NULL,NULL,NULL,'HHTHVAnelZ','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(2,'Editor','editor@cifo.com','ca','2026-05-11 17:57:29','$2y$12$DCZkVgelAeS20eJXzWQy.us6XpP1zjWvLlpfOUK4sEd7tXrqkrNjK',NULL,NULL,NULL,'SHHBPFyMWJ','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(3,'Cassie Ernser MD','bettye86@example.net','ca','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'iOjZNwX4v4','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(4,'Everardo Dooley','dorothy.bergnaum@example.org','ca','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'IwXapGttbl','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(5,'Micheal Dickinson','rice.eulalia@example.com','ca','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'M34xV7CnEe','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(6,'Dr. Christelle Schoen Sr.','rolfson.jayme@example.com','ca','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'t694dMUIhJ','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(7,'Chester Altenwerth','amelia67@example.org','ca','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'ZpyCykwdGD','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(8,'Eleonore Ondricka IV','zachariah30@example.net','es','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'UhYCfjwS4c','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(9,'Orion Williamson','francisco31@example.org','es','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'tmKFV6xhJl','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(10,'Myriam Schmitt','wroberts@example.com','ca','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'UNMo187Q3g','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(11,'Miss Rosie Rutherford V','torn@example.net','ca','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'5EVfjfYmvX','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL),(12,'Oswaldo Rempel','lawson.johns@example.org','es','2026-05-11 17:57:29','$2y$12$O.RGtM2LEk7waG/x/IPht.sutZBMb6TKcKCnRnPW5J69lQWmw5Uom',NULL,NULL,NULL,'tKuWELLEuF','2026-05-11 17:57:29','2026-05-11 17:57:29',NULL);
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

-- Dump completed on 2026-05-11 16:20:10
