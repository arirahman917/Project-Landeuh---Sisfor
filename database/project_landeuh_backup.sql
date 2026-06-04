-- MySQL dump 10.13  Distrib 9.6.0, for macos26.2 (arm64)
--
-- Host: localhost    Database: project_landeuh
-- ------------------------------------------------------
-- Server version	9.6.0

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
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

-- SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '3111679e-fd81-11f0-8b19-9b064f7973d2:1-1493';

--
-- Table structure for table `accommodations`
--

DROP TABLE IF EXISTS `accommodations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accommodations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merokok` tinyint(1) NOT NULL DEFAULT '0',
  `fasilitas` json NOT NULL,
  `makanan` json NOT NULL,
  `max_orang` int NOT NULL,
  `catatan` json NOT NULL,
  `slot` int NOT NULL,
  `harga_weekday` decimal(12,2) NOT NULL,
  `harga_weekend` decimal(12,2) NOT NULL,
  `harga_highseason` decimal(12,2) NOT NULL,
  `gambar` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accommodations`
--

LOCK TABLES `accommodations` WRITE;
/*!40000 ALTER TABLE `accommodations` DISABLE KEYS */;
INSERT INTO `accommodations` VALUES (1,'Cabin 1','Cabin','Queen Bed (140×200)',1,'[\"TV\", \"AC\", \"1 Bean Bag\", \"2 Selimut\", \"4 Bantal\", \"Teko Pemanas Listrik\", \"Kamar Mandi dalam\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 6 pax\"]',4,'[\"Anak di bawah umur 5 tahun Free, maksimal 2 anak.\", \"Tambahan anak di atas 5 tahun 75k/orang\", \"Tambahan dewasa di atas 17 tahun 100k/orang\"]',6,1200000.00,1600000.00,1800000.00,'[\"images/akomodasi/cabin1/a.png\"]','2026-05-27 19:41:39','2026-05-28 19:55:43'),(2,'Rumah Industrial 1','Rumah Industrial','Queen Bed (140×200)',1,'[\"TV kabel\", \"Meja\", \"Lemari es\", \"TV\", \"Ruang tamu\", \"Balkon\", \"Dapur\", \"Kipas angin\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 6 pax\"]',4,'[\"Anak di bawah umur 5 tahun Free, maksimal 2 anak.\", \"Tambahan anak di atas 5 tahun 75k/orang\", \"Tambahan dewasa di atas 17 tahun 100k/orang\"]',4,921609.00,1100000.00,1400000.00,'\"images/akomodasi/industrial1/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(3,'Glamping VIP','Glamping','1 Tenda Arpenaz Quechua',1,'[\"Matras kasur tebal 15cm\", \"1 lampu tenda\", \"1 meja lesehan\", \"VIP Eksklusif\", \"Colokan listrik 3 cabang\"]','[\"Teh, gula, dan kopi\", \"2 mineral botol 1.5 liter\"]',4,'[\"Anak di bawah umur 5 tahun Free, maksimal 2 anak.\", \"Tambahan anak di atas 5 tahun 75k/orang\"]',6,921609.00,1100000.00,1400000.00,'\"images/akomodasi/glamping_vip/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(4,'Cabin 2','Cabin','3 Unit Queen Bed (140x200), 1 Unit Twin Bed (100x200)',0,'[\"TV\", \"AC\", \"Mini Kitchen\", \"Kamar mandi dalam\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 4 pax\"]',8,'[\"Anak di bawah umur 5 tahun Free\"]',3,2250000.00,2800000.00,3000000.00,'[\"images/akomodasi/cabin2/a.png\"]','2026-05-27 19:41:39','2026-05-28 20:01:42'),(5,'Cabin 3','Cabin','Twin Bed (2×100×200)',1,'[\"TV kabel\", \"Meja\", \"Lemari es\", \"Balkon\", \"Kipas angin\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 4 pax\"]',4,'[\"Anak di bawah umur 5 tahun Free\"]',5,880000.00,1050000.00,1350000.00,'\"images/akomodasi/cabin3/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(6,'Cabin 4','Cabin','Queen Bed (140×200)',0,'[\"TV kabel\", \"Meja\", \"AC\", \"Balkon\", \"Dapur\"]','[\"Air Minum Gratis\", \"Sarapan 4 pax\"]',3,'[\"Anak di bawah umur 5 tahun Free\"]',4,870000.00,1020000.00,1300000.00,'\"images/akomodasi/cabin4/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(7,'Cabin 5','Cabin','King Bed (180×200)',1,'[\"TV kabel\", \"Meja\", \"Lemari es\", \"AC\", \"Ruang tamu\", \"Balkon\", \"Dapur\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 6 pax\"]',5,'[\"Anak di bawah umur 5 tahun Free\"]',3,1350000.00,1550000.00,1950000.00,'\"images/akomodasi/cabin5/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(8,'Cabin 6','Cabin','Queen Bed (140×200)',0,'[\"TV kabel\", \"Meja\", \"Kipas angin\", \"Balkon\"]','[\"Air Minum Gratis\", \"Sarapan 2 pax\"]',2,'[\"Anak di bawah umur 5 tahun Free\"]',5,750000.00,900000.00,1150000.00,'\"images/akomodasi/cabin6/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(9,'Cabin 7','Cabin','Twin Bed (2×100×200)',1,'[\"TV kabel\", \"Meja\", \"Lemari es\", \"Dapur\", \"Kipas angin\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 4 pax\"]',4,'[\"Anak di bawah umur 5 tahun Free\"]',4,900000.00,1080000.00,1380000.00,'\"images/akomodasi/cabin7/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(10,'Cabin 8','Cabin','Queen Bed (140×200)',0,'[\"TV kabel\", \"Meja\", \"AC\", \"Lemari es\", \"Balkon\", \"Dapur\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 4 pax\"]',3,'[\"Anak di bawah umur 5 tahun Free\"]',6,980000.00,1160000.00,1480000.00,'\"images/akomodasi/cabin8/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(11,'Rumah Industrial 2','Rumah Industrial','Queen Bed (140×200)',1,'[\"TV kabel\", \"Meja\", \"Lemari es\", \"Ruang tamu\", \"Balkon\", \"Dapur\", \"Kipas angin\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 6 pax\"]',4,'[\"Anak di bawah umur 5 tahun Free\"]',3,921609.00,1100000.00,1400000.00,'\"images/akomodasi/industrial2/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(12,'Glamping Reguler 1','Glamping','1 Tenda Arpenaz Quechua',0,'[\"Matras kasur tebal 10cm\", \"1 lampu tenda\", \"Colokan listrik 2 cabang\"]','[\"Teh, gula, dan kopi\", \"2 mineral botol 1.5 liter\"]',3,'[\"Anak di bawah umur 5 tahun Free\"]',8,650000.00,800000.00,1050000.00,'\"images/akomodasi/glamping_reguler/a.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(13,'Glamping Reguler 2','Glamping','1 Tenda Arpenaz Quechua',1,'[\"Matras kasur tebal 10cm\", \"1 lampu tenda\", \"Colokan listrik 2 cabang\"]','[\"Teh, gula, dan kopi\", \"2 mineral botol 1.5 liter\"]',3,'[\"Anak di bawah umur 5 tahun Free\"]',7,650000.00,800000.00,1050000.00,'\"images/akomodasi/glamping_reguler/b.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(14,'Glamping VIP 2','Glamping','1 Tenda Arpenaz Quechua',1,'[\"Matras kasur tebal 15cm\", \"1 lampu tenda\", \"VIP Eksklusif\", \"Colokan listrik 3 cabang\"]','[\"Teh, gula, dan kopi\", \"2 mineral botol 1.5 liter\"]',4,'[\"Anak di bawah umur 5 tahun Free\"]',5,921609.00,1100000.00,1400000.00,'\"images/akomodasi/glamping_vip/b.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(15,'Cabin Keluarga Deluxe','Cabin','King Bed (180×200) + Single Bed',0,'[\"TV kabel\", \"Meja\", \"AC\", \"Lemari es\", \"Ruang tamu\", \"Balkon\", \"Dapur\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 6 pax\"]',5,'[\"Anak di bawah umur 5 tahun Free\"]',2,1500000.00,1750000.00,2200000.00,'\"images/akomodasi/cabin1/b.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(16,'Rumah Industrial Premium','Rumah Industrial','Queen Bed (140×200)',0,'[\"TV kabel\", \"Meja\", \"AC\", \"Lemari es\", \"Ruang tamu\", \"Balkon\", \"Dapur\", \"Kipas angin\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 6 pax\"]',4,'[\"Anak di bawah umur 5 tahun Free\"]',3,1100000.00,1300000.00,1650000.00,'\"images/akomodasi/industrial2/b.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(17,'Glamping Family','Glamping','2 Tenda Arpenaz Quechua',1,'[\"Matras kasur tebal 15cm\", \"2 lampu tenda\", \"Colokan listrik 3 cabang\"]','[\"Teh, gula, dan kopi\", \"4 mineral botol 1.5 liter\"]',6,'[\"Anak di bawah umur 5 tahun Free\"]',4,1400000.00,1650000.00,2000000.00,'\"images/akomodasi/glamping_vip/c.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(18,'Cabin Riverside','Cabin','Queen Bed (140×200)',1,'[\"TV kabel\", \"Meja\", \"Kipas angin\", \"Balkon\", \"Dapur\", \"View sungai\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 4 pax\"]',3,'[\"Anak di bawah umur 5 tahun Free\"]',4,1050000.00,1250000.00,1600000.00,'\"images/akomodasi/cabin3/b.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(19,'Rumah Industrial Cozy','Rumah Industrial','Queen Bed (140×200)',0,'[\"TV kabel\", \"Meja\", \"Lemari es\", \"Kipas angin\", \"Dapur\"]','[\"Fasilitas Membuat Kopi/Teh\", \"Air Minum Gratis\", \"Sarapan 4 pax\"]',3,'[\"Anak di bawah umur 5 tahun Free\"]',5,850000.00,1000000.00,1280000.00,'\"images/akomodasi/industrial1/b.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39'),(20,'Glamping Sunset View','Glamping','1 Tenda Arpenaz Quechua',0,'[\"Matras kasur tebal 15cm\", \"1 lampu tenda\", \"Colokan listrik 3 cabang\"]','[\"Teh, gula, dan kopi\", \"2 mineral botol 1.5 liter\"]',4,'[\"Anak di bawah umur 5 tahun Free\"]',6,780000.00,950000.00,1200000.00,'\"images/akomodasi/glamping_reguler/c.png\"','2026-05-27 19:41:39','2026-05-27 19:41:39');
/*!40000 ALTER TABLE `accommodations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `no_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodation_id` bigint unsigned NOT NULL,
  `pemesan_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemesan_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemesan_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tamu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `malam` int NOT NULL,
  `tambahan_anak` int NOT NULL DEFAULT '0',
  `tambahan_dewasa` int NOT NULL DEFAULT '0',
  `total` decimal(12,2) NOT NULL,
  `metode_pembayaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `bookings_no_pesanan_unique` (`no_pesanan`),
  KEY `bookings_accommodation_id_foreign` (`accommodation_id`),
  CONSTRAINT `bookings_accommodation_id_foreign` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,'LDH-462A7076',1,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Syabib Ibrahim Azkiya','2026-04-28','2026-04-29',1,0,0,1200000.00,'QRIS','success','2026-05-27 19:50:28','2026-05-27 19:51:34'),(2,'LDH-137E7E75',2,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Syabib Ibrahim Azkiya','2026-04-28','2026-04-29',1,0,0,921609.00,'BCA Virtual Account','success','2026-05-27 19:59:45','2026-05-27 20:00:25'),(3,'LDH-81AEF880',3,'Syabib Ibrahim','082115314179','syabibibrahim@gmail.com','Syabib Ibrahim','2026-04-28','2026-04-29',1,1,1,1096609.00,'BCA Virtual Account','success','2026-05-27 20:02:16','2026-05-27 20:06:54'),(6,'LDH-13C3B655',20,'test2','082115314179','test2@gmail.com','test2','2026-04-28','2026-04-29',1,0,0,780000.00,'BSI Virtual Account','success','2026-05-27 20:22:25','2026-05-27 20:23:12'),(7,'LDH-5142F097',7,'test 3','021930481204','test3@gmail.com','test 3','2026-04-28','2026-04-29',1,0,0,1350000.00,'QRIS','success','2026-05-27 20:24:21','2026-05-27 20:26:53'),(8,'LDH-91900456',13,'test 4','0921048024','test4@gmail.com','test 4','2026-04-28','2026-04-29',1,0,0,650000.00,'QRIS','pending','2026-05-27 20:30:17','2026-05-27 20:30:29'),(9,'LDH-04732443',14,'test 5','01391028424','test5@gmail.com','test 5','2026-06-23','2026-06-24',1,0,0,921609.00,'BNI Virtual Account','pending','2026-05-27 20:45:20','2026-05-27 20:45:48'),(10,'LDH-53DC7821',1,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Syabib Ibrahim Azkiya','2026-06-02','2026-06-04',2,0,0,2400000.00,'QRIS','failed','2026-05-28 02:36:53','2026-05-28 02:49:14'),(11,'LDH-8BC6BC90',9,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Ghazy Firdaus','2026-06-28','2026-06-30',2,0,0,1800000.00,'Virtual Account','failed','2026-05-28 03:01:12','2026-05-28 03:03:21'),(12,'LDH-37024A92',11,'Syabib Ibrhim','0290292','syabibibrahim@gmail.com','Random guy','2026-06-28','2026-06-29',1,0,0,921609.00,'pending','failed','2026-05-28 03:05:07','2026-05-28 03:35:08'),(13,'LDH-42B9E791',1,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Syabib Ibrahim Azkiya','2026-05-28','2026-05-29',1,0,0,1200000.00,'BCA Virtual Account','failed','2026-05-28 03:18:44','2026-05-28 04:47:42'),(14,'LDH-39DF3593',15,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Adam','2026-06-28','2026-06-30',2,2,0,3300000.00,'BCA Virtual Account','refund_rejected','2026-05-28 03:26:27','2026-05-28 05:00:23'),(15,'LDH-A2EBFA14',15,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Sari','2026-06-28','2026-06-30',2,0,0,3000000.00,'BCA Virtual Account','refunded','2026-05-28 03:47:22','2026-05-28 05:01:07'),(16,'LDH-4484ED47',15,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Syabib Ibrahim Azkiya','2026-06-28','2026-06-30',2,0,0,3000000.00,'BCA Virtual Account','refund_rejected','2026-05-28 05:01:56','2026-05-28 19:25:30'),(17,'LDH-18B9AE44',2,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Syabib Ibrahim Azkiya','2026-06-28','2026-06-30',2,0,0,1843218.00,'BCA Virtual Account','refunded','2026-05-28 19:32:49','2026-05-28 19:34:56');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `date_settings`
--

DROP TABLE IF EXISTS `date_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `date_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dates` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_settings`
--

LOCK TABLES `date_settings` WRITE;
/*!40000 ALTER TABLE `date_settings` DISABLE KEYS */;
INSERT INTO `date_settings` VALUES (1,'weekday','Weekday','Minggu, Senin, Selasa, Rabu, Kamis','2026-05-27 19:41:39','2026-05-27 19:41:39'),(2,'weekend','Weekend','Jum\'at, Sabtu, 2026-01-01, 2026-01-16, 2026-02-16, 2026-02-17, 2026-03-18, 2026-03-19, 2026-03-20, 2026-03-21, 2026-03-22, 2026-03-23, 2026-03-24, 2026-04-03, 2026-04-05, 2026-05-01, 2026-05-12, 2026-05-14, 2026-05-15, 2026-05-27, 2026-06-01, 2026-06-16, 2026-08-17, 2026-08-25, 2026-12-25','2026-05-27 19:41:39','2026-05-27 19:41:39'),(3,'highseason','Tahun Baru & Semester Ganjil','2026-01-01, 2026-01-02, 2026-01-03, 2026-01-04','2026-05-27 19:41:39','2026-05-27 19:41:39'),(4,'highseason','Lebaran Idul Fitri','2026-03-16, 2026-03-17, 2026-03-18, 2026-03-19, 2026-03-20, 2026-03-21, 2026-03-22, 2026-03-23, 2026-03-24, 2026-03-25, 2026-03-26, 2026-03-27, 2026-03-28, 2026-03-29','2026-05-27 19:41:39','2026-05-27 19:41:39'),(5,'highseason','Lebaran Idul Adha','2026-05-27, 2026-05-28, 2026-05-29, 2026-05-30, 2026-05-31','2026-05-27 19:41:39','2026-05-27 19:41:39'),(6,'highseason','Kenaikan Kelas (Semester Genap)','2026-06-22, 2026-06-23, 2026-06-24, 2026-06-25, 2026-06-26, 2026-06-27, 2026-06-28, 2026-06-29, 2026-06-30, 2026-07-01, 2026-07-02, 2026-07-03, 2026-07-04, 2026-07-05, 2026-07-06, 2026-07-07, 2026-07-08, 2026-07-09, 2026-07-10, 2026-07-11','2026-05-27 19:41:39','2026-05-27 19:41:39'),(7,'highseason','Natal & Semester Ganjil','2026-12-21, 2026-12-22, 2026-12-23, 2026-12-24, 2026-12-25, 2026-12-26, 2026-12-27, 2026-12-28, 2026-12-29, 2026-12-30, 2026-12-31','2026-05-27 19:41:39','2026-05-27 19:41:39');
/*!40000 ALTER TABLE `date_settings` ENABLE KEYS */;
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
  `attempts` smallint unsigned NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_19_041410_create_accommodations_table',1),(5,'2026_05_19_041411_create_bookings_table',1),(6,'2026_05_22_082039_add_columns_to_users_table',1),(7,'2026_05_22_092538_add_role_to_users_table',1),(8,'2026_05_22_112954_change_gambar_column_type_to_json_in_accommodations_table',1),(9,'2026_05_22_120635_create_date_settings_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
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
INSERT INTO `sessions` VALUES ('9KtHKWbDrUnTy8tcOkQdzHnzkGpIbrmAc5C3Wroa',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15','eyJfdG9rZW4iOiJpSXB2TmNPSG5DUkFXYWxkSjA1NlJRNFBSS29yV041SFJndUlCVTQxIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2F1dGhcL2dvb2dsZSIsInJvdXRlIjoiYXV0aC5nb29nbGUifSwic3RhdGUiOiJycFl2dnJCdVRvd0xuS0FBSEowb0dBWTlyTHVZQnV0c1pEZVQzYldtIn0=',1780024417),('BTLrbzbBSNA2HxPpnhP9aEvVMTtv1n0G8Azq7mvp',NULL,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36','eyJfdG9rZW4iOiJ2eWJNWGVoMXNQRW5UdlJ4NWhWRlZFVTVSbXV1UjFWbGFvUEFWUXNkIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvYXBpXC9ub3RpZmljYXRpb25zIiwicm91dGUiOiJhZG1pbi5hcGkubm90aWZpY2F0aW9ucyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1780024600);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
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
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin 1','admin1@gmail.com','081234567890',NULL,'2026-05-27 19:41:38','$2y$12$dtoQlHPITMKi0CjF2DBTu.H8ddH/8FG0SqAoaKHE8LuzRzlG83hqW','admin','zSWpKxLrQd','2026-05-27 19:41:38','2026-05-27 19:41:38'),(2,'Admin 2','admin2@gmail.com','081234567890',NULL,'2026-05-27 19:41:38','$2y$12$VCdCPXmMwPV71cTxi71HsuGl7FjdB605IIAxN1/66kse4.0b4ATHa','admin','5FO32Uj1Qp','2026-05-27 19:41:38','2026-05-27 19:41:38'),(3,'Syabib Ibrahim Azkiya','syabibibrahim@gmail.com','082115314179',NULL,NULL,'$2y$12$2.Nb6Ut6oVZtb4qYEcH65.bL8YH3ljfq.rUV3rGNdwSrXCiqKAc8u','user',NULL,'2026-05-27 19:49:31','2026-05-27 19:49:31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-05-29 10:16:54
