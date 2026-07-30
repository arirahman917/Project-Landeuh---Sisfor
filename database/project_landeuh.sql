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

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '3111679e-fd81-11f0-8b19-9b064f7973d2:1-3969';

--
-- Table structure for table `accommodations`
--

DROP TABLE IF EXISTS `accommodations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `accommodations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasur` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `merokok` tinyint(1) NOT NULL DEFAULT '0',
  `fasilitas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `makanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `max_orang` int NOT NULL,
  `catatan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `slot` int NOT NULL,
  `harga_weekday` decimal(12,2) NOT NULL,
  `harga_weekend` decimal(12,2) NOT NULL,
  `harga_highseason` decimal(12,2) NOT NULL,
  `gambar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `blocked_dates` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accommodations`
--

LOCK TABLES `accommodations` WRITE;
/*!40000 ALTER TABLE `accommodations` DISABLE KEYS */;
INSERT INTO `accommodations` VALUES (1,'Cabin 1','Cabin','Double Bed (160x200)',0,'[\"2 Double Bed (160x200)\",\"1 Bean Bag\",\"2 Selimut\",\"4 Bantal\",\"Kamar Mandi (Private)\"]','[\"1 Teko Pemanas Listrik\",\"Teh, Gula, & Kopi\"]',4,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,1200000.00,1600000.00,1800000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071160\\/landeuh-akomodasi\\/w1ubhod0gl1mnuenp4h1.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071166\\/landeuh-akomodasi\\/jq13kftktuthskmucciv.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071169\\/landeuh-akomodasi\\/mkvshthdvrer21hjvz2i.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071173\\/landeuh-akomodasi\\/hsrcoamajxh5rpajskyv.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071178\\/landeuh-akomodasi\\/gayeazgge6tqv39vrwja.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071184\\/landeuh-akomodasi\\/k7zd4vigkvjwsleu1vas.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071187\\/landeuh-akomodasi\\/wye5opd3idjaups6ioba.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071191\\/landeuh-akomodasi\\/clkam1nqnngm5nhbtzes.jpg\"]','[{\"id\":\"6a69ea77b8226\",\"name\":\"Perbaikan AC\",\"dates\":\"2026-08-01, 2027-08-01, 2027-08-10\",\"created_at\":\"2026-07-29 18:56:39\"},{\"id\":\"6a69f40ad6650\",\"name\":\"tes 1\",\"dates\":\"2026-07-30, 2026-07-31\",\"created_at\":\"2026-07-29 19:37:30\"},{\"id\":\"6a6a384297b29\",\"name\":\"12 -13\",\"dates\":\"2026-10-12, 2026-10-13\",\"created_at\":\"2026-07-30 00:28:34\"},{\"id\":\"6a6a9a1ed7ad7\",\"name\":\"20 24\",\"dates\":\"2026-10-20, 2026-10-24\",\"created_at\":\"2026-07-30 07:26:06\"},{\"id\":\"6a6aa1e0b2a5c\",\"name\":\"2\",\"dates\":\"2026-08-18\",\"created_at\":\"2026-07-30 07:59:12\"},{\"id\":\"6a6aa3243acf4\",\"name\":\"18\",\"dates\":\"2026-10-18\",\"created_at\":\"2026-07-30 08:04:36\"},{\"id\":\"6a6aa35c62b2b\",\"name\":\"21 22\",\"dates\":\"2026-10-21, 2026-10-22\",\"created_at\":\"2026-07-30 08:05:32\"},{\"id\":\"6a6aa669a691c\",\"name\":\"26\",\"dates\":\"2026-08-26\",\"created_at\":\"2026-07-30 08:18:33\"}]','2026-05-27 19:41:39','2026-07-30 01:18:33'),(3,'Glamping VIP','Glamping','Tenda Arpenaz Quechua ukuran 4.1 (260×455×240)',0,'[\"1 Tenda Arpenaz Quechua ukuran 4.1 (260\\u00d7455\\u00d7240), 1 kamar tidur dan 1 ruang tengah\",\"2 matras kasur tebal 15 cm\",\"4 bantal tidur\",\"2 selimut\",\"1 lampu tenda\",\"1 meja lesehan\",\"1 kursi lipat outdoor VIP eksklusif\",\"rak gantung pakaian\",\"colokan listrik 3 cabang\",\"kamar mandi (private)\"]','[\"1 teko pemanas air listrik\",\"teh, gula dan kopi\",\"2 mineral botol 1.5 L\"]',4,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',7,750000.00,1100000.00,1200000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141479\\/landeuh-akomodasi\\/jllq7pstakxi8vedperl.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141482\\/landeuh-akomodasi\\/zi5xd4ey4xfli7bjifq6.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141488\\/landeuh-akomodasi\\/fm59zqk64wdhdy3u5brb.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141491\\/landeuh-akomodasi\\/baybwdpkajjienau8axf.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141494\\/landeuh-akomodasi\\/no9ktr3gb8mkl3yzngir.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141497\\/landeuh-akomodasi\\/hpwi42kauyvwivqaieuk.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141500\\/landeuh-akomodasi\\/moigzocj2jtnjr5hvpta.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141504\\/landeuh-akomodasi\\/lt5rfxevznabtnytnbim.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141507\\/landeuh-akomodasi\\/nnyfbnjkf8uczdnxclrh.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141511\\/landeuh-akomodasi\\/wzle3vkut758fbqt5jet.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:39:13'),(4,'Cabin 2','Cabin','Unit Queen Bed (140×200) dan Unit Twin Bed (100×200)',0,'[\"3 Unit Queen Bed (140\\u00d7200)\",\"1 Unit Twin Bed (100\\u00d7200)\",\"1 Sofa Bed\",\"4 Selimut\",\"8 Bantal\",\"AC\",\"TV\",\"1 Kamar Mandi (Private).\"]','[\"1 Teko Pemanas Listrik\",\"1 Rice Cooker\",\"Teh, Gula dan Kopi\",\"Mini Kitchen\",\"Alat makan & minum\"]',8,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,2250000.00,2800000.00,3000000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139260\\/landeuh-akomodasi\\/rdstvqdcbd6qfyml5kdr.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139265\\/landeuh-akomodasi\\/zwxprspnwf8mke1hi53w.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139272\\/landeuh-akomodasi\\/i9tv3xdz3zdlbh6oqo8n.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139279\\/landeuh-akomodasi\\/mwhf6xloeiv3vzntd9ej.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139284\\/landeuh-akomodasi\\/sem4dlmaaphnp76xx6mv.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139287\\/landeuh-akomodasi\\/gyzdiexmtkafxydif7ax.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139290\\/landeuh-akomodasi\\/qqtdopihogg1iisep0wf.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139293\\/landeuh-akomodasi\\/pl04i9l5dbpxomahgrat.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139298\\/landeuh-akomodasi\\/ljqnntmres4ybgbgwb9w.webp\"]','[{\"id\":\"6a69ea77ba615\",\"name\":\"Perbaikan AC\",\"dates\":\"2026-08-01, 2027-08-01, 2027-08-10\",\"created_at\":\"2026-07-29 18:56:39\"}]','2026-05-27 19:41:39','2026-07-29 11:56:39'),(5,'Cabin 3','Cabin','Double Bed (160×200)',0,'[\"2 Double Bed (160\\u00d7200)\",\"1 Bean Bag\",\"2 Selimut\",\"4 Bantal\",\"AC\",\"TV\",\"1 Kamar Mandi (Private).\"]','[\"1 Teko Pemanas Listrik\",\"Teh, Gula dan Kopi\"]',4,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,1200000.00,1600000.00,1800000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140400\\/landeuh-akomodasi\\/xmkyhyt9c8zrhjadcvok.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140403\\/landeuh-akomodasi\\/pygr9chcbkl0v0hrhkfw.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140406\\/landeuh-akomodasi\\/zi5vexsitvkujjovapnm.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140409\\/landeuh-akomodasi\\/ome6q8jcqhef147vthy0.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140412\\/landeuh-akomodasi\\/tp0gycfbryz0zirvenfy.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140415\\/landeuh-akomodasi\\/abzewq8fvw740exmttea.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140419\\/landeuh-akomodasi\\/ntxr3m7lstupgefbaem3.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140422\\/landeuh-akomodasi\\/mylaxajvifsbltmiw2bb.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:33:01'),(6,'Cabin 4','Cabin','Unit Bed Ukuran (140×200) & (120×200)',0,'[\"Tipe Mezzanine dengan Balcony\",\"3 Unit Bed Ukuran (140\\u00d7200)\",\"3 Unit Bed Ukuran (120\\u00d7200)\",\"1 Set Meja Kursi Mini Bar\",\"6 Selimut\",\"12 Bantal\",\"TV\",\"2 Kamar Mandi (Private)\",\"12 Tiket Masuk Curug Leuwi Asih\",\"Lantai 2 dengan Balcony Area.\"]','[\"1 Teko Pemanas Air Listrik\",\"1 Rice Cooker\",\"Teh, Gula dan Kopi\",\"Set Peralatan Makan (Sendok, Garpu, Piring)\"]',12,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,2900000.00,3600000.00,3900000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140561\\/landeuh-akomodasi\\/bah7ezzabtnqzeqlkulo.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140567\\/landeuh-akomodasi\\/pts2tnyozoyrsw9kucc6.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140576\\/landeuh-akomodasi\\/y5bsfo40igxxjbjxvvr7.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140584\\/landeuh-akomodasi\\/yiwu728avncv9hiyvxxe.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140588\\/landeuh-akomodasi\\/wv1zumjfdnwaekvkuphe.webp\"]','[{\"id\":\"6a69ea77bbeaf\",\"name\":\"Perbaikan AC\",\"dates\":\"2026-08-01, 2027-08-01, 2027-08-10\",\"created_at\":\"2026-07-29 18:56:39\"},{\"id\":\"6a69eab6d9ba7\",\"name\":\"Perbaikan TV\",\"dates\":\"2027-07-01, 2027-07-10, 2027-08-01, 2027-08-10\",\"created_at\":\"2026-07-29 18:57:42\"}]','2026-05-27 19:41:39','2026-07-29 11:57:42'),(7,'Cabin 5','Cabin','Unit Queen Bed (140×200) & Unit Single Bed (120×200)',0,'[\"2 Unit Queen Bed (140\\u00d7200)\",\"2 Unit Single Bed (120\\u00d7200)\",\"1 Set Meja dan Kursi\",\"4 Selimut\",\"6 Bantal\",\"TV\",\"AC\",\"Tiket Curug Leuwi Asih\",\"2 Kamar Mandi (Private).\"]','[\"1 Teko Pemanas Listrik\",\"1 Rice Cooker\",\"Teh, Gula dan Kopi\"]',6,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,2100000.00,2600000.00,2800000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140689\\/landeuh-akomodasi\\/td7j394eaamuttup4tdt.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140694\\/landeuh-akomodasi\\/ndgj1vrmdy8w1kioh6ou.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140698\\/landeuh-akomodasi\\/oycoyncre0n9xx1qe4gh.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140704\\/landeuh-akomodasi\\/ln27gy9f9rclehdrxwq8.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140709\\/landeuh-akomodasi\\/jqwcictkc8uosje6pjlm.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140712\\/landeuh-akomodasi\\/tczeaqla1jufqfx4cefw.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140714\\/landeuh-akomodasi\\/mogl6d8be24mynq12cqp.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:33:13'),(8,'Cabin 6','Cabin','Double Bed (160×200)',0,'[\"2 Double Bed (160\\u00d7200)\",\"1 Bean Bag\",\"2 Selimut\",\"4 Bantal\",\"AC\",\"TV\",\"1 Kamar Mandi (Private).\"]','[\"1 Teko Pemanas Listrik\",\"Teh, Gula dan Kopi\"]',4,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,1200000.00,1600000.00,1800000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140809\\/landeuh-akomodasi\\/grkrb74eput2al1mc1d6.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140813\\/landeuh-akomodasi\\/u0hnfpyy6dylcn5qlzji.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140817\\/landeuh-akomodasi\\/yerpy1bqyfedlvavfsxi.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140820\\/landeuh-akomodasi\\/cd0xb1tkwdjwlwyo5wd3.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140823\\/landeuh-akomodasi\\/xbylc42h39fj7qc9xn9g.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140826\\/landeuh-akomodasi\\/xwjmwwd24xceav61k4vc.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140830\\/landeuh-akomodasi\\/lwuh5icpfmvn0jgxsch2.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140834\\/landeuh-akomodasi\\/lglqrk6khyi5qeyxr1q0.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140837\\/landeuh-akomodasi\\/oadral5migrnm3priohv.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:32:43'),(9,'Cabin 7','Cabin','Twin Bed (140×200)',0,'[\"1 Twin Bed (140\\u00d7200\\/4 Orang)\",\"2 Selimut\",\"4 Bantal\",\"1 Set Meja Kursi\",\"AC\",\"TV\",\"1 Kamar Mandi (Private)\"]','[\"1 Teko Pemanas Listrik\",\"Teh, Gula dan Kopi\"]',4,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,1000000.00,1400000.00,1600000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140953\\/landeuh-akomodasi\\/qflmkjgytdgmdeiyvfeo.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140957\\/landeuh-akomodasi\\/yzghaeym5z7x4glvfcrh.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140963\\/landeuh-akomodasi\\/ww5j3xoztk7fvblk5pju.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140969\\/landeuh-akomodasi\\/mxbwc58vcjgltemimsd0.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140974\\/landeuh-akomodasi\\/rmga4kdesew7s03mxcip.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140980\\/landeuh-akomodasi\\/tspsdbkhqpqdmltd0dth.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140983\\/landeuh-akomodasi\\/vbnof7ookd0ixef7mddy.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:32:35'),(10,'Cabin 8','Cabin','Twin Bed (140×200)',0,'[\"1 Twin Bed (140\\u00d7200\\/4 Orang)\",\"2 Selimut\",\"4 Bantal\",\"1 Set Meja Kursi\",\"AC\",\"TV\",\"1 Kamar Mandi (Private)\"]','[\"1 Teko Pemanas Listrik\",\"Teh, Gula dan Kopi\"]',4,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,1000000.00,1400000.00,1600000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141097\\/landeuh-akomodasi\\/ulnwo2xfkwwbhwtmnezm.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141102\\/landeuh-akomodasi\\/ovhgv4fhgwwk597nmdnr.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141108\\/landeuh-akomodasi\\/da62d4ib2nwfwoonmyrl.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141113\\/landeuh-akomodasi\\/e9y3eepa7ain6pblstqc.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141118\\/landeuh-akomodasi\\/ict8x7unyhghvdaem9w7.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141124\\/landeuh-akomodasi\\/vfcoasciocyfrettnewg.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141130\\/landeuh-akomodasi\\/jpf4mipmvi5hpvpvrq97.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:32:25'),(11,'Rumah Industrial 2','Rumah Industrial','Queen Bed (140×200)',0,'[\"1 queen bed (140\\u00d7200)\",\"1 set kursi & meja\",\"1 selimut\",\"2 bantal\",\"1 AC\",\"Wi-Fi\",\"1 kamar mandi (private)\"]','[\"1 teko pemanas air listrik\",\"2 mineral Vit 1.5 L\",\"teh, gula dan kopi\"]',2,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,650000.00,1000000.00,1200000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141765\\/landeuh-akomodasi\\/g3zpi22mhcv02m3hsbyz.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141774\\/landeuh-akomodasi\\/igubpegl0mfutqttf0yk.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141777\\/landeuh-akomodasi\\/ifemxhzhuvvijhf18iue.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141783\\/landeuh-akomodasi\\/jxpprncm7uxl7cwtwezd.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141786\\/landeuh-akomodasi\\/wke3baglz7i7aah9gtan.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:43:07'),(12,'Glamping Reguler','Glamping','Tenda Arpenaz Quechua 4.1 (260×455×240)',0,'[\"1 Tenda Arpenaz Quechua 4.1 (260\\u00d7455\\u00d7240), 1 kamar tidur dan 1 ruang tengah\",\"2 matras kasur ukuran 120\\u00d7200\\u00d75 cm\",\"4 bantal tidur\",\"2 selimut\",\"1 lampu tenda\",\"1 meja lesehan\",\"colokan listrik 3 cabang\",\"kamar mandi (sharing)\"]','[\"1 teko pemanas air listrik\",\"2 gelas cangkir\"]',4,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',6,600000.00,850000.00,1.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141344\\/landeuh-akomodasi\\/wi608adozqxrysxrut35.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141349\\/landeuh-akomodasi\\/vxotzoahsxirqrcuudcn.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141354\\/landeuh-akomodasi\\/i1zfslyhy39zui1qrw5c.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141360\\/landeuh-akomodasi\\/wxb6gidvpklsoj4d0lqu.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141365\\/landeuh-akomodasi\\/ycelz7o7jdzvc3ibs02p.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141370\\/landeuh-akomodasi\\/doczs1uhfgl0mclh1hvd.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141372\\/landeuh-akomodasi\\/tuxfhqey0vbflh4dj2lp.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141375\\/landeuh-akomodasi\\/yj6xblcmt7r9c7j4ukeo.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:36:17'),(19,'Rumah Industrial 1','Rumah Industrial','Queen Bed (140×200)',0,'[\"1 queen bed (140\\u00d7200)\",\"1 set kursi & meja\",\"1 selimut\",\"2 bantal\",\"1 AC\",\"Wi-Fi\",\"1 kamar mandi (private)\"]','[\"1 teko pemanas air listrik\",\"2 mineral Vit 1.5 L\",\"teh, gula dan kopi\"]',2,'[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]',1,650000.00,1000000.00,1200000.00,'[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141681\\/landeuh-akomodasi\\/ne9junkopwrtrnugpqm8.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141685\\/landeuh-akomodasi\\/npqbfshpfptrlh7j7ht6.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141689\\/landeuh-akomodasi\\/ufbgexj6usucvntzatwv.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141695\\/landeuh-akomodasi\\/r8om1pn6x8uflt0s3kax.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141698\\/landeuh-akomodasi\\/k78n4ynv9wamjtgdlfto.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141701\\/landeuh-akomodasi\\/ra55o9opifpnrp2wqg6w.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141704\\/landeuh-akomodasi\\/daibarksuicxuhneqdns.webp\"]',NULL,'2026-05-27 19:41:39','2026-07-27 08:41:44');
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
  `accommodation_id` bigint unsigned DEFAULT NULL,
  `corporate_package_id` bigint unsigned DEFAULT NULL,
  `pemesan_nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemesan_telp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pemesan_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_tamu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `reschedule_check_in` date DEFAULT NULL,
  `reschedule_check_out` date DEFAULT NULL,
  `malam` int NOT NULL,
  `jumlah_pax` int DEFAULT NULL,
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
  KEY `bookings_corporate_package_id_foreign` (`corporate_package_id`),
  CONSTRAINT `bookings_accommodation_id_foreign` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`) ON DELETE CASCADE,
  CONSTRAINT `bookings_corporate_package_id_foreign` FOREIGN KEY (`corporate_package_id`) REFERENCES `corporate_packages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (67,'LDH-E3147092',NULL,2,'Raihan Alma Putra','08123456789','raihan160905@gmail.com','Raihan Alma Putra','2026-07-28','2026-07-29',NULL,NULL,1,25,0,0,12500000.00,'BCA Virtual Account','success','2026-07-28 06:09:34','2026-07-28 06:09:48'),(68,'LDH-F6DAB669',NULL,2,'Raihan Alma Putra','08123456789','raihan160905@gmail.com','Raihan Alma Putra','2026-08-22','2026-08-23',NULL,NULL,1,25,0,0,12500000.00,'BCA Virtual Account','success','2026-07-28 06:19:27','2026-07-30 00:56:51'),(83,'LDH-F6DAB665',1,NULL,'Raihan Alma Putra','08123456789','raihan160905@gmail.com','Raihan Alma Putra','2026-09-03','2026-09-04',NULL,NULL,1,25,0,0,12500000.00,'BCA Virtual Account','success','2026-07-31 06:19:27','2026-07-30 01:05:24'),(84,'LDH-1315EE67',NULL,2,'Raihan Alma Putra','08123456789','raihan160905@gmail.com','Raihan Alma Putra','2026-10-12','2026-10-13',NULL,NULL,1,25,0,0,12500000.00,'BCA Virtual Account','success','2026-07-28 08:40:33','2026-07-29 17:29:05'),(87,'LDH-14896A79',NULL,3,'Raihan Alma Putra','08123456789','raihan160905@gmail.com','Raihan Alma Putra','2026-07-28','2026-07-29',NULL,NULL,1,25,0,0,10000000.00,'BCA Virtual Account','success','2026-07-28 09:16:17','2026-07-28 09:16:44'),(88,'LDH-85077F36',NULL,3,'Raihan Alma Putra','08123456789','raihan160905@gmail.com','Raihan Alma Putra','2026-07-29','2026-07-30',NULL,NULL,1,25,0,0,10000000.00,'pending','failed','2026-07-28 09:23:04','2026-07-28 23:52:14'),(89,'LDH-E3053618',NULL,2,'Raihan Alma Putra','08123456789','raihan160905@gmail.com','Raihan Alma Putra','2026-07-30','2026-07-31',NULL,NULL,1,25,0,0,12500000.00,'pending','failed','2026-07-28 09:23:26','2026-07-28 23:52:14'),(90,'LDH-7BDE6792',NULL,3,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-23','2026-08-24',NULL,NULL,1,36,0,0,28800000.00,'BCA Virtual Account','success','2026-07-28 23:56:39','2026-07-30 00:57:03'),(91,'LDH-088F1E93',NULL,2,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-10-21','2026-10-22',NULL,NULL,1,25,0,0,12500000.00,'BCA Virtual Account','success','2026-07-29 00:08:32','2026-07-29 17:29:28'),(92,'LDH-FE045A86',1,NULL,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-10-28','2026-10-31',NULL,NULL,3,NULL,1,1,1375000.00,'BCA Virtual Account','success','2026-07-29 00:10:55','2026-07-30 00:25:33'),(93,'LDH-005A4C58',1,NULL,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-09-04','2026-09-05','2026-08-02','2026-08-03',1,NULL,0,0,1200000.00,'BCA Virtual Account','reschedule_rejected','2026-07-29 00:11:44','2026-07-30 01:05:31'),(94,'LDH-C855D020',NULL,3,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-05','2026-08-06','2026-08-06','2026-08-07',1,25,0,0,10000000.00,'BCA Virtual Account','reschedule_pending','2026-07-29 01:53:00','2026-07-29 01:57:26'),(95,'LDH-C24E7636',1,NULL,'ari','085795016378','arryrahmand11@gmail.com','melenoy','2026-11-02','2026-11-03',NULL,NULL,1,NULL,0,0,1200000.00,'BCA Virtual Account','success','2026-07-29 02:41:16','2026-07-30 00:26:05'),(96,'LDH-998A4852',NULL,2,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-24','2026-08-25',NULL,NULL,1,25,0,0,12500000.00,'BCA Virtual Account','success','2026-07-29 02:54:17','2026-07-30 01:06:21'),(97,'LDH-BD899B97',NULL,3,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-13','2026-08-14',NULL,NULL,1,150,0,0,60000000.00,'BCA Virtual Account','success','2026-07-29 02:55:23','2026-07-29 02:55:37'),(98,'LDH-E04F7130',NULL,2,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-23','2026-08-24',NULL,NULL,1,150,0,0,75000000.00,'BCA Virtual Account','success','2026-07-29 02:55:58','2026-07-30 00:57:41'),(99,'LDH-3BA15D76',NULL,3,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-29','2026-08-30','2026-08-25','2026-08-26',1,150,0,0,60000000.00,'BCA Virtual Account','reschedule_pending','2026-07-29 02:57:07','2026-07-29 04:47:22'),(100,'LDH-BA00A898',NULL,2,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-29','2026-08-30','2026-09-11','2026-09-12',1,150,0,0,75000000.00,'BCA Virtual Account','reschedule_pending','2026-07-29 02:58:03','2026-07-29 04:43:52'),(101,'LDH-2D905E13',1,NULL,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-10-19','2026-10-20',NULL,NULL,1,NULL,0,0,1200000.00,'BCA Virtual Account','success','2026-07-29 03:10:42','2026-07-29 17:12:43'),(102,'LDH-A4296B51',NULL,3,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-13','2026-08-14',NULL,NULL,1,150,0,0,60000000.00,'BCA Virtual Account','rescheduled','2026-07-29 04:48:26','2026-07-29 04:56:02'),(103,'LDH-4DE27D70',NULL,2,'ari','085795016378','arryrahmand11@gmail.com','ari','2026-08-25','2026-08-26',NULL,NULL,1,25,0,0,12500000.00,'BCA Virtual Account','rescheduled','2026-07-29 04:54:28','2026-07-30 01:06:26'),(104,'LDH-3C2D7D20',1,NULL,'Syabib Ibrahim Azkiya','082115314179','syabibibrahim@gmail.com','Syabib Ibrahim Azkiya','2026-08-27','2026-08-28',NULL,NULL,1,NULL,0,0,1200000.00,'BCA Virtual Account','success','2026-07-30 01:54:43','2026-07-30 01:55:22');
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
INSERT INTO `cache` VALUES ('landeuh-village-riverside-cache-booking_cleanup','b:1;',1785376666);
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
-- Table structure for table `corporate_packages`
--

DROP TABLE IF EXISTS `corporate_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `corporate_packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_akomodasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accommodation_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `fasilitas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `makanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `max_orang` int NOT NULL,
  `catatan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `slot` int NOT NULL,
  `harga_weekday` decimal(12,2) NOT NULL,
  `harga_weekend` decimal(12,2) NOT NULL,
  `harga_highseason` decimal(12,2) NOT NULL,
  `gambar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `blocked_dates` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `corporate_packages_chk_1` CHECK (json_valid(`accommodation_ids`)),
  CONSTRAINT `corporate_packages_chk_2` CHECK (json_valid(`fasilitas`)),
  CONSTRAINT `corporate_packages_chk_3` CHECK (json_valid(`makanan`)),
  CONSTRAINT `corporate_packages_chk_4` CHECK (json_valid(`catatan`)),
  CONSTRAINT `corporate_packages_chk_5` CHECK (json_valid(`gambar`))
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corporate_packages`
--

LOCK TABLES `corporate_packages` WRITE;
/*!40000 ALTER TABLE `corporate_packages` DISABLE KEYS */;
INSERT INTO `corporate_packages` VALUES (2,'Paket Corporate Cabin','Corporate Cabin','Cabin','[\"1\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\"]','[\"Menginap di area Cabin\", \"Penggunaan seluruh unit Cabin yang tersedia\"]','[\"Makan 3 kali per malam\"]',150,'[\"Minimal pemesanan 25 pax. Maksimal 150 pax.\", \"Harga dihitung per peserta (per pax).\", \"Check-in pukul 14.00–21.00 WIB.\", \"Check-out pukul 12.00 WIB.\"]',8,500000.00,500000.00,500000.00,'[\"https://res.cloudinary.com/dj6ckubpl/image/upload/v1785229717/landeuh-corporate/g1h4suvikwflh7docx5e.webp\"]','[{\"id\":\"6a6a00d0404bf\",\"name\":\"tess\",\"dates\":\"2026-10-11\",\"created_at\":\"2026-07-29 20:32:00\"},{\"id\":\"6a6a348c8c10f\",\"name\":\"tes 7 - 10\",\"dates\":\"2026-10-07, 2026-10-10, 2026-10-08, 2026-10-09\",\"created_at\":\"2026-07-30 00:12:44\"},{\"id\":\"6a6a9a95b231d\",\"name\":\"12 13\",\"dates\":\"2026-08-12, 2026-08-13\",\"created_at\":\"2026-07-30 07:28:05\"},{\"id\":\"6a6a9ad568f4f\",\"name\":\"14 15\",\"dates\":\"2026-08-14, 2026-08-15\",\"created_at\":\"2026-07-30 07:29:09\"},{\"id\":\"6a6a9c26dd5ba\",\"name\":\"16\",\"dates\":\"2026-08-16\",\"created_at\":\"2026-07-30 07:34:46\"},{\"id\":\"6a6aa39370125\",\"name\":\"17 18\",\"dates\":\"2026-08-17, 2026-08-18\",\"created_at\":\"2026-07-30 08:06:27\"}]','2026-07-28 03:32:48','2026-07-30 01:06:27'),(3,'Paket Corporate Glamping','Corporate Glamping','Glamping','[\"12\", \"3\"]','[\"Menginap di area Glamping\", \"Penggunaan seluruh unit Glamping Reguler dan VIP\"]','[\"Makan 3 kali per malam\"]',150,'[\"Minimal pemesanan 25 pax. Maksimal 150 pax.\", \"Harga dihitung per peserta (per pax).\", \"Check-in pukul 14.00–21.00 WIB.\", \"Check-out pukul 12.00 WIB.\"]',2,400000.00,400000.00,400000.00,'[\"https://res.cloudinary.com/dj6ckubpl/image/upload/v1785229767/landeuh-corporate/gqewkttsizwvamdqqtxu.webp\"]',NULL,'2026-07-28 09:00:19','2026-07-28 09:10:47');
/*!40000 ALTER TABLE `corporate_packages` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `date_settings`
--

LOCK TABLES `date_settings` WRITE;
/*!40000 ALTER TABLE `date_settings` DISABLE KEYS */;
INSERT INTO `date_settings` VALUES (1,'weekday','Weekday','Minggu, Senin, Selasa, Rabu, Kamis','2026-05-27 19:41:39','2026-05-27 19:41:39'),(2,'weekend','Weekend','Jum\'at, Sabtu, 2026-01-01, 2026-01-16, 2026-02-16, 2026-02-17, 2026-03-18, 2026-03-19, 2026-03-20, 2026-03-21, 2026-03-22, 2026-03-23, 2026-03-24, 2026-04-03, 2026-04-05, 2026-05-01, 2026-05-12, 2026-05-14, 2026-05-15, 2026-05-27, 2026-06-01, 2026-06-16, 2026-08-17, 2026-08-25, 2026-12-25','2026-05-27 19:41:39','2026-05-27 19:41:39'),(138,'highseason','Tahun Baru & Libur Semester Ganjil','2026-01-01, 2026-01-02, 2026-01-03, 2026-01-04','2026-07-30 00:57:42','2026-07-30 00:57:42'),(139,'highseason','Lebaran Idul Fitri','2026-03-16, 2026-03-17, 2026-03-18, 2026-03-19, 2026-03-20, 2026-03-21, 2026-03-22, 2026-03-23, 2026-03-24, 2026-03-25, 2026-03-26, 2026-03-27, 2026-03-28, 2026-03-29','2026-07-30 00:57:42','2026-07-30 00:57:42'),(140,'highseason','Lebaran Idul Adha','2026-05-27, 2026-05-28, 2026-05-29, 2026-05-30, 2026-05-31','2026-07-30 00:57:42','2026-07-30 00:57:42'),(141,'highseason','Kenaikan Kelas (Semester Genap)','2026-06-22, 2026-06-23, 2026-06-24, 2026-06-25, 2026-06-26, 2026-06-27, 2026-06-28, 2026-06-29, 2026-06-30, 2026-07-01, 2026-07-02, 2026-07-03, 2026-07-04, 2026-07-05, 2026-07-06, 2026-07-07, 2026-07-08, 2026-07-09, 2026-07-10, 2026-07-11','2026-07-30 00:57:42','2026-07-30 00:57:42'),(142,'highseason','Natal & Semester Ganjil','2026-12-21, 2026-12-22, 2026-12-23, 2026-12-24, 2026-12-25, 2026-12-26, 2026-12-27, 2026-12-28, 2026-12-29, 2026-12-30, 2026-12-31','2026-07-30 00:57:42','2026-07-30 00:57:42'),(143,'libur_landeuh','Libur Lebaran/Tahun Baru','2027-07-01, 2027-07-31','2026-07-30 00:57:42','2026-07-30 00:57:42'),(144,'libur_landeuh','Libur tes tabrakan','2026-08-06, 2026-08-07, 2026-09-01, 2026-09-02','2026-07-30 00:57:42','2026-07-30 00:57:42'),(145,'libur_landeuh','Libur Lebaran/Tahun Baru','2026-10-16, 2026-10-17','2026-07-30 00:57:42','2026-07-30 00:57:42'),(146,'libur_landeuh','3 21','2026-08-03, 2026-08-21','2026-07-30 00:57:42','2026-07-30 00:57:42');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_05_19_041410_create_accommodations_table',1),(5,'2026_05_19_041411_create_bookings_table',1),(6,'2026_05_22_082039_add_columns_to_users_table',1),(7,'2026_05_22_092538_add_role_to_users_table',1),(8,'2026_05_22_112954_change_gambar_column_type_to_json_in_accommodations_table',1),(9,'2026_05_22_120635_create_date_settings_table',1),(10,'2026_07_26_210430_add_reschedule_columns_to_bookings_table',2),(11,'2026_07_27_181425_add_jumlah_pax_to_bookings_table',3),(12,'2026_07_28_102547_create_corporate_packages_table',4),(13,'2026_07_28_102555_add_corporate_package_id_to_bookings_table',4),(14,'2026_07_28_110707_update_corporate_packages_table',5),(15,'2026_07_29_180000_add_blocked_dates_to_accommodations_and_corporate_packages_tables',6);
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
INSERT INTO `sessions` VALUES ('58c1dKzKU8hCXIcyGxaLZ5Vknj0nR0dB5ATR9TN4',3,'127.0.0.1','Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.0 Safari/605.1.15','eyJfdG9rZW4iOiI2SzZlbnRHWW44MWRjcGNQRjBoVk1OZTAwbHphN0ZheXBoTEM0UXhEIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvYXBpXC9ub3RpZmljYXRpb25zIiwicm91dGUiOiJhZG1pbi5hcGkubm90aWZpY2F0aW9ucyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sInVybCI6eyJpbnRlbmRlZCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wYWtldC1jb3Jwb3JhdGUifSwic3RhdGUiOiJYSlFJMDBWaHA1cFRFTFVOVUdFZXNSU09KWUFwTkpkUDJ5MUVUd0lHIiwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjMsImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjF9',1785376606);
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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin 1','admin1@gmail.com','081234567890',NULL,'2026-05-27 19:41:38','$2y$12$dtoQlHPITMKi0CjF2DBTu.H8ddH/8FG0SqAoaKHE8LuzRzlG83hqW','admin','zSWpKxLrQd','2026-05-27 19:41:38','2026-05-27 19:41:38'),(2,'Admin 2','admin2@gmail.com','081234567890',NULL,'2026-05-27 19:41:38','$2y$12$VCdCPXmMwPV71cTxi71HsuGl7FjdB605IIAxN1/66kse4.0b4ATHa','admin','5FO32Uj1Qp','2026-05-27 19:41:38','2026-05-27 19:41:38'),(3,'Syabib Ibrahim Azkiya','syabibibrahim@gmail.com','082115314179',NULL,NULL,'$2y$12$2.Nb6Ut6oVZtb4qYEcH65.bL8YH3ljfq.rUV3rGNdwSrXCiqKAc8u','user',NULL,'2026-05-27 19:49:31','2026-05-27 19:49:31'),(4,'Ari Rahman','arryrahmand5@gmail.com',NULL,'118407388651576308338','2026-06-17 06:35:10',NULL,'user',NULL,'2026-06-01 04:24:38','2026-06-17 06:35:10'),(5,'Ari Rahman','arirahman@apps.ipb.ac.id',NULL,'111001602328490234011','2026-06-17 00:46:37',NULL,'user',NULL,'2026-06-03 23:50:26','2026-06-17 00:46:37'),(6,'YPPA','yppa2005@gmail.com',NULL,'103520907642598576192','2026-06-17 00:49:56','$2y$12$C.RetHOC7i1d5hf9DiUGWuPA.bnXIzeJugdInekjQBYWGskO2cwZy','user',NULL,'2026-06-17 00:49:56','2026-06-17 00:49:56'),(7,'Test Learn','testppppoooo123@gmail.com',NULL,'102609481159459500164','2026-06-17 13:52:16','$2y$12$Y4FZqh1IOXdNl6XkgyJZFuYtuXFnYebhb2vbpWytpe/ZNQIoQCJ4q','user',NULL,'2026-06-17 13:52:16','2026-06-17 13:52:16'),(8,'ari','arryrahmand11@gmail.com','085795016378',NULL,'2026-07-26 13:16:13','$2y$12$A8V2xkYiKl.l61beYMK/B.ibI9BHmpV8MNfJqL/RgOwSCrjPK1G9e','user',NULL,'2026-07-26 13:16:13','2026-07-26 13:16:13'),(9,'Raihan Alma Putra','raihan160905@gmail.com',NULL,'110462567503230008773','2026-07-27 11:27:20','$2y$12$Ll9V5J9HVL.bGgNMkozu/OZHspyrlyfupi9oMPTPMEdZfpoRe1JgW','user',NULL,'2026-07-27 11:27:20','2026-07-27 11:27:20'),(10,'Raihan Alma Putra','raihanalma@apps.ipb.ac.id',NULL,'115663687035248631439','2026-07-28 07:39:07','$2y$12$0/Q/6mBrE24yRnpFjPRuxe5MINHONuonlkjMKRhvkNWuEFJakb25S','user',NULL,'2026-07-28 07:39:07','2026-07-28 07:39:07');
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

-- Dump completed on 2026-07-30  8:56:59
