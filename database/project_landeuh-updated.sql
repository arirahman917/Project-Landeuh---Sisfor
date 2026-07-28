-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 28, 2026 at 10:02 AM
-- Server version: 8.4.3
-- PHP Version: 8.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_landeuh`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodations`
--

CREATE TABLE `accommodations` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kasur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `accommodations`
--

INSERT INTO `accommodations` (`id`, `judul`, `jenis`, `kasur`, `merokok`, `fasilitas`, `makanan`, `max_orang`, `catatan`, `slot`, `harga_weekday`, `harga_weekend`, `harga_highseason`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Cabin 1', 'Cabin', 'Double Bed (160x200)', 0, '[\"2 Double Bed (160x200)\",\"1 Bean Bag\",\"2 Selimut\",\"4 Bantal\",\"Kamar Mandi (Private)\"]', '[\"1 Teko Pemanas Listrik\",\"Teh, Gula, & Kopi\"]', 4, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 1200000.00, 1600000.00, 1800000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071160\\/landeuh-akomodasi\\/w1ubhod0gl1mnuenp4h1.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071166\\/landeuh-akomodasi\\/jq13kftktuthskmucciv.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071169\\/landeuh-akomodasi\\/mkvshthdvrer21hjvz2i.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071173\\/landeuh-akomodasi\\/hsrcoamajxh5rpajskyv.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071178\\/landeuh-akomodasi\\/gayeazgge6tqv39vrwja.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071184\\/landeuh-akomodasi\\/k7zd4vigkvjwsleu1vas.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071187\\/landeuh-akomodasi\\/wye5opd3idjaups6ioba.jpg\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785071191\\/landeuh-akomodasi\\/clkam1nqnngm5nhbtzes.jpg\"]', '2026-05-27 19:41:39', '2026-07-27 07:58:56'),
(3, 'Glamping VIP', 'Glamping', 'Tenda Arpenaz Quechua ukuran 4.1 (260×455×240)', 0, '[\"1 Tenda Arpenaz Quechua ukuran 4.1 (260\\u00d7455\\u00d7240), 1 kamar tidur dan 1 ruang tengah\",\"2 matras kasur tebal 15 cm\",\"4 bantal tidur\",\"2 selimut\",\"1 lampu tenda\",\"1 meja lesehan\",\"1 kursi lipat outdoor VIP eksklusif\",\"rak gantung pakaian\",\"colokan listrik 3 cabang\",\"kamar mandi (private)\"]', '[\"1 teko pemanas air listrik\",\"teh, gula dan kopi\",\"2 mineral botol 1.5 L\"]', 4, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 7, 750000.00, 1100000.00, 1200000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141479\\/landeuh-akomodasi\\/jllq7pstakxi8vedperl.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141482\\/landeuh-akomodasi\\/zi5xd4ey4xfli7bjifq6.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141488\\/landeuh-akomodasi\\/fm59zqk64wdhdy3u5brb.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141491\\/landeuh-akomodasi\\/baybwdpkajjienau8axf.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141494\\/landeuh-akomodasi\\/no9ktr3gb8mkl3yzngir.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141497\\/landeuh-akomodasi\\/hpwi42kauyvwivqaieuk.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141500\\/landeuh-akomodasi\\/moigzocj2jtnjr5hvpta.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141504\\/landeuh-akomodasi\\/lt5rfxevznabtnytnbim.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141507\\/landeuh-akomodasi\\/nnyfbnjkf8uczdnxclrh.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141511\\/landeuh-akomodasi\\/wzle3vkut758fbqt5jet.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:39:13'),
(4, 'Cabin 2', 'Cabin', 'Unit Queen Bed (140×200) dan Unit Twin Bed (100×200)', 0, '[\"3 Unit Queen Bed (140\\u00d7200)\",\"1 Unit Twin Bed (100\\u00d7200)\",\"1 Sofa Bed\",\"4 Selimut\",\"8 Bantal\",\"AC\",\"TV\",\"1 Kamar Mandi (Private).\"]', '[\"1 Teko Pemanas Listrik\",\"1 Rice Cooker\",\"Teh, Gula dan Kopi\",\"Mini Kitchen\",\"Alat makan & minum\"]', 8, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 2250000.00, 2800000.00, 3000000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139260\\/landeuh-akomodasi\\/rdstvqdcbd6qfyml5kdr.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139265\\/landeuh-akomodasi\\/zwxprspnwf8mke1hi53w.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139272\\/landeuh-akomodasi\\/i9tv3xdz3zdlbh6oqo8n.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139279\\/landeuh-akomodasi\\/mwhf6xloeiv3vzntd9ej.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139284\\/landeuh-akomodasi\\/sem4dlmaaphnp76xx6mv.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139287\\/landeuh-akomodasi\\/gyzdiexmtkafxydif7ax.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139290\\/landeuh-akomodasi\\/qqtdopihogg1iisep0wf.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139293\\/landeuh-akomodasi\\/pl04i9l5dbpxomahgrat.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785139298\\/landeuh-akomodasi\\/ljqnntmres4ybgbgwb9w.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:02:20'),
(5, 'Cabin 3', 'Cabin', 'Double Bed (160×200)', 0, '[\"2 Double Bed (160\\u00d7200)\",\"1 Bean Bag\",\"2 Selimut\",\"4 Bantal\",\"AC\",\"TV\",\"1 Kamar Mandi (Private).\"]', '[\"1 Teko Pemanas Listrik\",\"Teh, Gula dan Kopi\"]', 4, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 1200000.00, 1600000.00, 1800000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140400\\/landeuh-akomodasi\\/xmkyhyt9c8zrhjadcvok.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140403\\/landeuh-akomodasi\\/pygr9chcbkl0v0hrhkfw.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140406\\/landeuh-akomodasi\\/zi5vexsitvkujjovapnm.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140409\\/landeuh-akomodasi\\/ome6q8jcqhef147vthy0.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140412\\/landeuh-akomodasi\\/tp0gycfbryz0zirvenfy.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140415\\/landeuh-akomodasi\\/abzewq8fvw740exmttea.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140419\\/landeuh-akomodasi\\/ntxr3m7lstupgefbaem3.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140422\\/landeuh-akomodasi\\/mylaxajvifsbltmiw2bb.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:33:01'),
(6, 'Cabin 4', 'Cabin', 'Unit Bed Ukuran (140×200) & (120×200)', 0, '[\"Tipe Mezzanine dengan Balcony\",\"3 Unit Bed Ukuran (140\\u00d7200)\",\"3 Unit Bed Ukuran (120\\u00d7200)\",\"1 Set Meja Kursi Mini Bar\",\"6 Selimut\",\"12 Bantal\",\"TV\",\"2 Kamar Mandi (Private)\",\"12 Tiket Masuk Curug Leuwi Asih\",\"Lantai 2 dengan Balcony Area.\"]', '[\"1 Teko Pemanas Air Listrik\",\"1 Rice Cooker\",\"Teh, Gula dan Kopi\",\"Set Peralatan Makan (Sendok, Garpu, Piring)\"]', 12, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 2900000.00, 3600000.00, 3900000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140561\\/landeuh-akomodasi\\/bah7ezzabtnqzeqlkulo.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140567\\/landeuh-akomodasi\\/pts2tnyozoyrsw9kucc6.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140576\\/landeuh-akomodasi\\/y5bsfo40igxxjbjxvvr7.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140584\\/landeuh-akomodasi\\/yiwu728avncv9hiyvxxe.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140588\\/landeuh-akomodasi\\/wv1zumjfdnwaekvkuphe.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:33:07'),
(7, 'Cabin 5', 'Cabin', 'Unit Queen Bed (140×200) & Unit Single Bed (120×200)', 0, '[\"2 Unit Queen Bed (140\\u00d7200)\",\"2 Unit Single Bed (120\\u00d7200)\",\"1 Set Meja dan Kursi\",\"4 Selimut\",\"6 Bantal\",\"TV\",\"AC\",\"Tiket Curug Leuwi Asih\",\"2 Kamar Mandi (Private).\"]', '[\"1 Teko Pemanas Listrik\",\"1 Rice Cooker\",\"Teh, Gula dan Kopi\"]', 6, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 2100000.00, 2600000.00, 2800000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140689\\/landeuh-akomodasi\\/td7j394eaamuttup4tdt.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140694\\/landeuh-akomodasi\\/ndgj1vrmdy8w1kioh6ou.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140698\\/landeuh-akomodasi\\/oycoyncre0n9xx1qe4gh.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140704\\/landeuh-akomodasi\\/ln27gy9f9rclehdrxwq8.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140709\\/landeuh-akomodasi\\/jqwcictkc8uosje6pjlm.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140712\\/landeuh-akomodasi\\/tczeaqla1jufqfx4cefw.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140714\\/landeuh-akomodasi\\/mogl6d8be24mynq12cqp.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:33:13'),
(8, 'Cabin 6', 'Cabin', 'Double Bed (160×200)', 0, '[\"2 Double Bed (160\\u00d7200)\",\"1 Bean Bag\",\"2 Selimut\",\"4 Bantal\",\"AC\",\"TV\",\"1 Kamar Mandi (Private).\"]', '[\"1 Teko Pemanas Listrik\",\"Teh, Gula dan Kopi\"]', 4, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 1200000.00, 1600000.00, 1800000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140809\\/landeuh-akomodasi\\/grkrb74eput2al1mc1d6.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140813\\/landeuh-akomodasi\\/u0hnfpyy6dylcn5qlzji.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140817\\/landeuh-akomodasi\\/yerpy1bqyfedlvavfsxi.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140820\\/landeuh-akomodasi\\/cd0xb1tkwdjwlwyo5wd3.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140823\\/landeuh-akomodasi\\/xbylc42h39fj7qc9xn9g.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140826\\/landeuh-akomodasi\\/xwjmwwd24xceav61k4vc.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140830\\/landeuh-akomodasi\\/lwuh5icpfmvn0jgxsch2.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140834\\/landeuh-akomodasi\\/lglqrk6khyi5qeyxr1q0.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140837\\/landeuh-akomodasi\\/oadral5migrnm3priohv.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:32:43'),
(9, 'Cabin 7', 'Cabin', 'Twin Bed (140×200)', 0, '[\"1 Twin Bed (140\\u00d7200\\/4 Orang)\",\"2 Selimut\",\"4 Bantal\",\"1 Set Meja Kursi\",\"AC\",\"TV\",\"1 Kamar Mandi (Private)\"]', '[\"1 Teko Pemanas Listrik\",\"Teh, Gula dan Kopi\"]', 4, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 1000000.00, 1400000.00, 1600000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140953\\/landeuh-akomodasi\\/qflmkjgytdgmdeiyvfeo.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140957\\/landeuh-akomodasi\\/yzghaeym5z7x4glvfcrh.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140963\\/landeuh-akomodasi\\/ww5j3xoztk7fvblk5pju.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140969\\/landeuh-akomodasi\\/mxbwc58vcjgltemimsd0.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140974\\/landeuh-akomodasi\\/rmga4kdesew7s03mxcip.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140980\\/landeuh-akomodasi\\/tspsdbkhqpqdmltd0dth.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785140983\\/landeuh-akomodasi\\/vbnof7ookd0ixef7mddy.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:32:35'),
(10, 'Cabin 8', 'Cabin', 'Twin Bed (140×200)', 0, '[\"1 Twin Bed (140\\u00d7200\\/4 Orang)\",\"2 Selimut\",\"4 Bantal\",\"1 Set Meja Kursi\",\"AC\",\"TV\",\"1 Kamar Mandi (Private)\"]', '[\"1 Teko Pemanas Listrik\",\"Teh, Gula dan Kopi\"]', 4, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 1000000.00, 1400000.00, 1600000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141097\\/landeuh-akomodasi\\/ulnwo2xfkwwbhwtmnezm.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141102\\/landeuh-akomodasi\\/ovhgv4fhgwwk597nmdnr.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141108\\/landeuh-akomodasi\\/da62d4ib2nwfwoonmyrl.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141113\\/landeuh-akomodasi\\/e9y3eepa7ain6pblstqc.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141118\\/landeuh-akomodasi\\/ict8x7unyhghvdaem9w7.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141124\\/landeuh-akomodasi\\/vfcoasciocyfrettnewg.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141130\\/landeuh-akomodasi\\/jpf4mipmvi5hpvpvrq97.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:32:25'),
(11, 'Rumah Industrial 2', 'Rumah Industrial', 'Queen Bed (140×200)', 0, '[\"1 queen bed (140\\u00d7200)\",\"1 set kursi & meja\",\"1 selimut\",\"2 bantal\",\"1 AC\",\"Wi-Fi\",\"1 kamar mandi (private)\"]', '[\"1 teko pemanas air listrik\",\"2 mineral Vit 1.5 L\",\"teh, gula dan kopi\"]', 2, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 650000.00, 1000000.00, 1200000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141765\\/landeuh-akomodasi\\/g3zpi22mhcv02m3hsbyz.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141774\\/landeuh-akomodasi\\/igubpegl0mfutqttf0yk.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141777\\/landeuh-akomodasi\\/ifemxhzhuvvijhf18iue.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141783\\/landeuh-akomodasi\\/jxpprncm7uxl7cwtwezd.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141786\\/landeuh-akomodasi\\/wke3baglz7i7aah9gtan.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:43:07'),
(12, 'Glamping Reguler', 'Glamping', 'Tenda Arpenaz Quechua 4.1 (260×455×240)', 0, '[\"1 Tenda Arpenaz Quechua 4.1 (260\\u00d7455\\u00d7240), 1 kamar tidur dan 1 ruang tengah\",\"2 matras kasur ukuran 120\\u00d7200\\u00d75 cm\",\"4 bantal tidur\",\"2 selimut\",\"1 lampu tenda\",\"1 meja lesehan\",\"colokan listrik 3 cabang\",\"kamar mandi (sharing)\"]', '[\"1 teko pemanas air listrik\",\"2 gelas cangkir\"]', 4, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 6, 600000.00, 850000.00, 1.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141344\\/landeuh-akomodasi\\/wi608adozqxrysxrut35.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141349\\/landeuh-akomodasi\\/vxotzoahsxirqrcuudcn.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141354\\/landeuh-akomodasi\\/i1zfslyhy39zui1qrw5c.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141360\\/landeuh-akomodasi\\/wxb6gidvpklsoj4d0lqu.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141365\\/landeuh-akomodasi\\/ycelz7o7jdzvc3ibs02p.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141370\\/landeuh-akomodasi\\/doczs1uhfgl0mclh1hvd.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141372\\/landeuh-akomodasi\\/tuxfhqey0vbflh4dj2lp.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141375\\/landeuh-akomodasi\\/yj6xblcmt7r9c7j4ukeo.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:36:17'),
(19, 'Rumah Industrial 1', 'Rumah Industrial', 'Queen Bed (140×200)', 0, '[\"1 queen bed (140\\u00d7200)\",\"1 set kursi & meja\",\"1 selimut\",\"2 bantal\",\"1 AC\",\"Wi-Fi\",\"1 kamar mandi (private)\"]', '[\"1 teko pemanas air listrik\",\"2 mineral Vit 1.5 L\",\"teh, gula dan kopi\"]', 2, '[\"Anak di bawah umur 5 tahun Free (maksimal 2 anak). Jika lebih dari 2 anak di bawah usia 5 tahun akan dihitung sebagai tamu tambahan.\",\"Tambahan anak di atas 5 tahun dikenakan biaya Rp75.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Tambahan dewasa di atas 17 tahun dikenakan biaya Rp100.000\\/orang (termasuk extra matras lantai ketebalan 5 cm).\",\"Kelebihan jumlah tamu tanpa konfirmasi sebelumnya akan dikenakan biaya tambahan sesuai ketentuan.\"]', 1, 650000.00, 1000000.00, 1200000.00, '[\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141681\\/landeuh-akomodasi\\/ne9junkopwrtrnugpqm8.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141685\\/landeuh-akomodasi\\/npqbfshpfptrlh7j7ht6.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141689\\/landeuh-akomodasi\\/ufbgexj6usucvntzatwv.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141695\\/landeuh-akomodasi\\/r8om1pn6x8uflt0s3kax.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141698\\/landeuh-akomodasi\\/k78n4ynv9wamjtgdlfto.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141701\\/landeuh-akomodasi\\/ra55o9opifpnrp2wqg6w.webp\",\"https:\\/\\/res.cloudinary.com\\/dj6ckubpl\\/image\\/upload\\/v1785141704\\/landeuh-akomodasi\\/daibarksuicxuhneqdns.webp\"]', '2026-05-27 19:41:39', '2026-07-27 08:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `no_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accommodation_id` bigint UNSIGNED DEFAULT NULL,
  `corporate_package_id` bigint UNSIGNED DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `no_pesanan`, `accommodation_id`, `corporate_package_id`, `pemesan_nama`, `pemesan_telp`, `pemesan_email`, `nama_tamu`, `check_in_date`, `check_out_date`, `reschedule_check_in`, `reschedule_check_out`, `malam`, `jumlah_pax`, `tambahan_anak`, `tambahan_dewasa`, `total`, `metode_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(67, 'LDH-E3147092', NULL, 2, 'Raihan Alma Putra', '08123456789', 'raihan160905@gmail.com', 'Raihan Alma Putra', '2026-07-28', '2026-07-29', NULL, NULL, 1, 25, 0, 0, 12500000.00, 'BCA Virtual Account', 'success', '2026-07-28 06:09:34', '2026-07-28 06:09:48'),
(68, 'LDH-F6DAB669', NULL, 2, 'Raihan Alma Putra', '08123456789', 'raihan160905@gmail.com', 'Raihan Alma Putra', '2026-07-29', '2026-07-30', NULL, NULL, 1, 25, 0, 0, 12500000.00, 'BCA Virtual Account', 'success', '2026-07-28 06:19:27', '2026-07-28 06:19:50'),
(83, 'LDH-F6DAB665', 1, NULL, 'Raihan Alma Putra', '08123456789', 'raihan160905@gmail.com', 'Raihan Alma Putra', '2026-07-31', '2026-08-01', NULL, NULL, 1, 25, 0, 0, 12500000.00, 'BCA Virtual Account', 'success', '2026-07-31 06:19:27', '2026-07-31 06:19:50'),
(84, 'LDH-1315EE67', NULL, 2, 'Raihan Alma Putra', '08123456789', 'raihan160905@gmail.com', 'Raihan Alma Putra', '2026-08-06', '2026-08-07', NULL, NULL, 1, 25, 0, 0, 12500000.00, 'BCA Virtual Account', 'success', '2026-07-28 08:40:33', '2026-07-28 08:41:18'),
(86, 'LDH-43C6E735', NULL, 2, 'Raihan Alma Putra', '08123456789', 'raihan160905@gmail.com', 'Raihan Alma Putra', '2026-07-31', '2026-08-01', NULL, NULL, 1, 25, 0, 0, 12500000.00, 'BCA Virtual Account', 'success', '2026-07-28 09:11:16', '2026-07-28 09:15:47'),
(87, 'LDH-14896A79', NULL, 3, 'Raihan Alma Putra', '08123456789', 'raihan160905@gmail.com', 'Raihan Alma Putra', '2026-07-28', '2026-07-29', NULL, NULL, 1, 25, 0, 0, 10000000.00, 'BCA Virtual Account', 'success', '2026-07-28 09:16:17', '2026-07-28 09:16:44'),
(88, 'LDH-85077F36', NULL, 3, 'Raihan Alma Putra', '08123456789', 'raihan160905@gmail.com', 'Raihan Alma Putra', '2026-07-29', '2026-07-30', NULL, NULL, 1, 25, 0, 0, 10000000.00, 'pending', 'pending', '2026-07-28 09:23:04', '2026-07-28 09:23:04'),
(89, 'LDH-E3053618', NULL, 2, 'Raihan Alma Putra', '08123456789', 'raihan160905@gmail.com', 'Raihan Alma Putra', '2026-07-30', '2026-07-31', NULL, NULL, 1, 25, 0, 0, 12500000.00, 'pending', 'pending', '2026-07-28 09:23:26', '2026-07-28 09:23:26');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('landeuh-village-riverside-cache-booking_cleanup', 'b:1;', 1785230822);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corporate_packages`
--

CREATE TABLE `corporate_packages` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_akomodasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accommodation_ids` json DEFAULT NULL,
  `fasilitas` json NOT NULL,
  `makanan` json NOT NULL,
  `max_orang` int NOT NULL,
  `catatan` json NOT NULL,
  `slot` int NOT NULL,
  `harga_weekday` decimal(12,2) NOT NULL,
  `harga_weekend` decimal(12,2) NOT NULL,
  `harga_highseason` decimal(12,2) NOT NULL,
  `gambar` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `corporate_packages`
--

INSERT INTO `corporate_packages` (`id`, `judul`, `jenis`, `jenis_akomodasi`, `accommodation_ids`, `fasilitas`, `makanan`, `max_orang`, `catatan`, `slot`, `harga_weekday`, `harga_weekend`, `harga_highseason`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'Paket Corporate Cabin', 'Corporate Cabin', 'Cabin', '[\"1\", \"4\", \"5\", \"6\", \"7\", \"8\", \"9\", \"10\"]', '[\"Menginap di area Cabin\", \"Penggunaan seluruh unit Cabin yang tersedia\"]', '[\"Makan 3 kali per malam\"]', 150, '[\"Minimal pemesanan 25 pax. Maksimal 150 pax.\", \"Harga dihitung per peserta (per pax).\", \"Check-in pukul 14.00–21.00 WIB.\", \"Check-out pukul 12.00 WIB.\"]', 8, 500000.00, 500000.00, 500000.00, '[\"https://res.cloudinary.com/dj6ckubpl/image/upload/v1785229717/landeuh-corporate/g1h4suvikwflh7docx5e.webp\"]', '2026-07-28 03:32:48', '2026-07-28 09:10:26'),
(3, 'Paket Corporate Glamping', 'Corporate Glamping', 'Glamping', '[\"12\", \"3\"]', '[\"Menginap di area Glamping\", \"Penggunaan seluruh unit Glamping Reguler dan VIP\"]', '[\"Makan 3 kali per malam\"]', 150, '[\"Minimal pemesanan 25 pax. Maksimal 150 pax.\", \"Harga dihitung per peserta (per pax).\", \"Check-in pukul 14.00–21.00 WIB.\", \"Check-out pukul 12.00 WIB.\"]', 2, 400000.00, 400000.00, 400000.00, '[\"https://res.cloudinary.com/dj6ckubpl/image/upload/v1785229767/landeuh-corporate/gqewkttsizwvamdqqtxu.webp\"]', '2026-07-28 09:00:19', '2026-07-28 09:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `date_settings`
--

CREATE TABLE `date_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dates` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `date_settings`
--

INSERT INTO `date_settings` (`id`, `type`, `name`, `dates`, `created_at`, `updated_at`) VALUES
(1, 'weekday', 'Weekday', 'Minggu, Senin, Selasa, Rabu, Kamis', '2026-05-27 19:41:39', '2026-05-27 19:41:39'),
(2, 'weekend', 'Weekend', 'Jum\'at, Sabtu, 2026-01-01, 2026-01-16, 2026-02-16, 2026-02-17, 2026-03-18, 2026-03-19, 2026-03-20, 2026-03-21, 2026-03-22, 2026-03-23, 2026-03-24, 2026-04-03, 2026-04-05, 2026-05-01, 2026-05-12, 2026-05-14, 2026-05-15, 2026-05-27, 2026-06-01, 2026-06-16, 2026-08-17, 2026-08-25, 2026-12-25', '2026-05-27 19:41:39', '2026-05-27 19:41:39'),
(43, 'highseason', 'Tahun Baru & Libur Semester Ganjil', '2026-01-01, 2026-01-02, 2026-01-03, 2026-01-04', '2026-06-17 03:11:11', '2026-06-17 03:11:11'),
(44, 'highseason', 'Lebaran Idul Fitri', '2026-03-16, 2026-03-17, 2026-03-18, 2026-03-19, 2026-03-20, 2026-03-21, 2026-03-22, 2026-03-23, 2026-03-24, 2026-03-25, 2026-03-26, 2026-03-27, 2026-03-28, 2026-03-29', '2026-06-17 03:11:11', '2026-06-17 03:11:11'),
(45, 'highseason', 'Lebaran Idul Adha', '2026-05-27, 2026-05-28, 2026-05-29, 2026-05-30, 2026-05-31', '2026-06-17 03:11:11', '2026-06-17 03:11:11'),
(46, 'highseason', 'Kenaikan Kelas (Semester Genap)', '2026-06-22, 2026-06-23, 2026-06-24, 2026-06-25, 2026-06-26, 2026-06-27, 2026-06-28, 2026-06-29, 2026-06-30, 2026-07-01, 2026-07-02, 2026-07-03, 2026-07-04, 2026-07-05, 2026-07-06, 2026-07-07, 2026-07-08, 2026-07-09, 2026-07-10, 2026-07-11', '2026-06-17 03:11:11', '2026-06-17 03:11:11'),
(47, 'highseason', 'Natal & Semester Ganjil', '2026-12-21, 2026-12-22, 2026-12-23, 2026-12-24, 2026-12-25, 2026-12-26, 2026-12-27, 2026-12-28, 2026-12-29, 2026-12-30, 2026-12-31', '2026-06-17 03:11:11', '2026-06-17 03:11:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_19_041410_create_accommodations_table', 1),
(5, '2026_05_19_041411_create_bookings_table', 1),
(6, '2026_05_22_082039_add_columns_to_users_table', 1),
(7, '2026_05_22_092538_add_role_to_users_table', 1),
(8, '2026_05_22_112954_change_gambar_column_type_to_json_in_accommodations_table', 1),
(9, '2026_05_22_120635_create_date_settings_table', 1),
(10, '2026_07_26_210430_add_reschedule_columns_to_bookings_table', 2),
(11, '2026_07_27_181425_add_jumlah_pax_to_bookings_table', 3),
(12, '2026_07_28_102547_create_corporate_packages_table', 4),
(13, '2026_07_28_102555_add_corporate_package_id_to_bookings_table', 4),
(14, '2026_07_28_110707_update_corporate_packages_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5DR83w6WGjaYsKdvubt4wjufTOiyrAvbOzZptEL8', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'eyJfdG9rZW4iOiJsbEpneTZxT3k0cUJ6ejlKZkFkTlRwTFUxQlVyNGpJaWNLV3loVXlvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9yZXNlcnZhc2lcL21ldG9kZS1wZW1iYXlhcmFuXC8yIiwicm91dGUiOiJyZXNlcnZhc2kubWV0b2RlIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwidXJsIjpbXSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEwfQ==', 1785224406),
('xoyLo74KBXoQkyhcZ45QiDKSyT91qDONtb5hp6ZP', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJwV215MWplZlRqN0lJWmRGRWcyRVZ2cklIWG5IWkR6ZWpkUGp3dGpYIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvYXBpXC9ub3RpZmljYXRpb25zIiwicm91dGUiOiJhZG1pbi5hcGkubm90aWZpY2F0aW9ucyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsInVybCI6W10sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo5fQ==', 1785230762);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `google_id`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin 1', 'admin1@gmail.com', '081234567890', NULL, '2026-05-27 19:41:38', '$2y$12$dtoQlHPITMKi0CjF2DBTu.H8ddH/8FG0SqAoaKHE8LuzRzlG83hqW', 'admin', 'zSWpKxLrQd', '2026-05-27 19:41:38', '2026-05-27 19:41:38'),
(2, 'Admin 2', 'admin2@gmail.com', '081234567890', NULL, '2026-05-27 19:41:38', '$2y$12$VCdCPXmMwPV71cTxi71HsuGl7FjdB605IIAxN1/66kse4.0b4ATHa', 'admin', '5FO32Uj1Qp', '2026-05-27 19:41:38', '2026-05-27 19:41:38'),
(3, 'Syabib Ibrahim Azkiya', 'syabibibrahim@gmail.com', '082115314179', NULL, NULL, '$2y$12$2.Nb6Ut6oVZtb4qYEcH65.bL8YH3ljfq.rUV3rGNdwSrXCiqKAc8u', 'user', NULL, '2026-05-27 19:49:31', '2026-05-27 19:49:31'),
(4, 'Ari Rahman', 'arryrahmand5@gmail.com', NULL, '118407388651576308338', '2026-06-17 06:35:10', NULL, 'user', NULL, '2026-06-01 04:24:38', '2026-06-17 06:35:10'),
(5, 'Ari Rahman', 'arirahman@apps.ipb.ac.id', NULL, '111001602328490234011', '2026-06-17 00:46:37', NULL, 'user', NULL, '2026-06-03 23:50:26', '2026-06-17 00:46:37'),
(6, 'YPPA', 'yppa2005@gmail.com', NULL, '103520907642598576192', '2026-06-17 00:49:56', '$2y$12$C.RetHOC7i1d5hf9DiUGWuPA.bnXIzeJugdInekjQBYWGskO2cwZy', 'user', NULL, '2026-06-17 00:49:56', '2026-06-17 00:49:56'),
(7, 'Test Learn', 'testppppoooo123@gmail.com', NULL, '102609481159459500164', '2026-06-17 13:52:16', '$2y$12$Y4FZqh1IOXdNl6XkgyJZFuYtuXFnYebhb2vbpWytpe/ZNQIoQCJ4q', 'user', NULL, '2026-06-17 13:52:16', '2026-06-17 13:52:16'),
(8, 'ari', 'arryrahmand11@gmail.com', '085795016378', NULL, '2026-07-26 13:16:13', '$2y$12$A8V2xkYiKl.l61beYMK/B.ibI9BHmpV8MNfJqL/RgOwSCrjPK1G9e', 'user', NULL, '2026-07-26 13:16:13', '2026-07-26 13:16:13'),
(9, 'Raihan Alma Putra', 'raihan160905@gmail.com', NULL, '110462567503230008773', '2026-07-27 11:27:20', '$2y$12$Ll9V5J9HVL.bGgNMkozu/OZHspyrlyfupi9oMPTPMEdZfpoRe1JgW', 'user', NULL, '2026-07-27 11:27:20', '2026-07-27 11:27:20'),
(10, 'Raihan Alma Putra', 'raihanalma@apps.ipb.ac.id', NULL, '115663687035248631439', '2026-07-28 07:39:07', '$2y$12$0/Q/6mBrE24yRnpFjPRuxe5MINHONuonlkjMKRhvkNWuEFJakb25S', 'user', NULL, '2026-07-28 07:39:07', '2026-07-28 07:39:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_no_pesanan_unique` (`no_pesanan`),
  ADD KEY `bookings_accommodation_id_foreign` (`accommodation_id`),
  ADD KEY `bookings_corporate_package_id_foreign` (`corporate_package_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `corporate_packages`
--
ALTER TABLE `corporate_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `date_settings`
--
ALTER TABLE `date_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `corporate_packages`
--
ALTER TABLE `corporate_packages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `date_settings`
--
ALTER TABLE `date_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_accommodation_id_foreign` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_corporate_package_id_foreign` FOREIGN KEY (`corporate_package_id`) REFERENCES `corporate_packages` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
