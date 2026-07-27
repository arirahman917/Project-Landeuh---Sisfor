-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2026 at 12:39 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jenis` varchar(100) NOT NULL,
  `kasur` varchar(255) NOT NULL,
  `merokok` tinyint(1) NOT NULL DEFAULT 0,
  `fasilitas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`fasilitas`)),
  `makanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`makanan`)),
  `max_orang` int(11) NOT NULL,
  `catatan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`catatan`)),
  `slot` int(11) NOT NULL,
  `harga_weekday` decimal(12,2) NOT NULL,
  `harga_weekend` decimal(12,2) NOT NULL,
  `harga_highseason` decimal(12,2) NOT NULL,
  `gambar` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`gambar`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_pesanan` varchar(255) NOT NULL,
  `accommodation_id` bigint(20) UNSIGNED NOT NULL,
  `pemesan_nama` varchar(255) NOT NULL,
  `pemesan_telp` varchar(255) NOT NULL,
  `pemesan_email` varchar(255) NOT NULL,
  `nama_tamu` varchar(255) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `reschedule_check_in` date DEFAULT NULL,
  `reschedule_check_out` date DEFAULT NULL,
  `malam` int(11) NOT NULL,
  `tambahan_anak` int(11) NOT NULL DEFAULT 0,
  `tambahan_dewasa` int(11) NOT NULL DEFAULT 0,
  `total` decimal(12,2) NOT NULL,
  `metode_pembayaran` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `no_pesanan`, `accommodation_id`, `pemesan_nama`, `pemesan_telp`, `pemesan_email`, `nama_tamu`, `check_in_date`, `check_out_date`, `reschedule_check_in`, `reschedule_check_out`, `malam`, `tambahan_anak`, `tambahan_dewasa`, `total`, `metode_pembayaran`, `status`, `created_at`, `updated_at`) VALUES
(1, 'LDH-462A7076', 1, 'Syabib Ibrahim Azkiya', '082115314179', 'syabibibrahim@gmail.com', 'Syabib Ibrahim Azkiya', '2026-04-28', '2026-04-29', NULL, NULL, 1, 0, 0, 1200000.00, 'QRIS', 'success', '2026-05-27 19:50:28', '2026-05-27 19:51:34'),
(3, 'LDH-81AEF880', 3, 'Syabib Ibrahim', '082115314179', 'syabibibrahim@gmail.com', 'Syabib Ibrahim', '2026-04-28', '2026-04-29', NULL, NULL, 1, 1, 1, 1096609.00, 'BCA Virtual Account', 'success', '2026-05-27 20:02:16', '2026-05-27 20:06:54'),
(7, 'LDH-5142F097', 7, 'test 3', '021930481204', 'test3@gmail.com', 'test 3', '2026-04-28', '2026-04-29', NULL, NULL, 1, 0, 0, 1350000.00, 'QRIS', 'success', '2026-05-27 20:24:21', '2026-05-27 20:26:53'),
(10, 'LDH-53DC7821', 1, 'Syabib Ibrahim Azkiya', '082115314179', 'syabibibrahim@gmail.com', 'Syabib Ibrahim Azkiya', '2026-06-02', '2026-06-04', NULL, NULL, 2, 0, 0, 2400000.00, 'QRIS', 'failed', '2026-05-28 02:36:53', '2026-05-28 02:49:14'),
(11, 'LDH-8BC6BC90', 9, 'Syabib Ibrahim Azkiya', '082115314179', 'syabibibrahim@gmail.com', 'Ghazy Firdaus', '2026-06-28', '2026-06-30', NULL, NULL, 2, 0, 0, 1800000.00, 'Virtual Account', 'failed', '2026-05-28 03:01:12', '2026-05-28 03:03:21'),
(12, 'LDH-37024A92', 11, 'Syabib Ibrhim', '0290292', 'syabibibrahim@gmail.com', 'Random guy', '2026-06-28', '2026-06-29', NULL, NULL, 1, 0, 0, 921609.00, 'pending', 'failed', '2026-05-28 03:05:07', '2026-05-28 03:35:08'),
(13, 'LDH-42B9E791', 1, 'Syabib Ibrahim Azkiya', '082115314179', 'syabibibrahim@gmail.com', 'Syabib Ibrahim Azkiya', '2026-05-28', '2026-05-29', NULL, NULL, 1, 0, 0, 1200000.00, 'BCA Virtual Account', 'failed', '2026-05-28 03:18:44', '2026-05-28 04:47:42'),
(18, 'LDH-B4447832', 1, 'Ari Rahman', '085795016378', 'arryrahmand5@gmail.com', 'Ari Rahman', '2026-04-28', '2026-04-29', NULL, NULL, 1, 3, 4, 625000.00, 'QRIS', 'success', '2026-06-01 04:25:47', '2026-06-01 04:33:28'),
(19, 'LDH-DEABBF86', 1, 'Ari Rahman', '088888888', 'arryrahmand5@gmail.com', 'Ari Rahman', '2026-06-03', '2026-06-04', NULL, NULL, 1, 2, 0, 1350000.00, 'BCA Virtual Account', 'failed', '2026-06-03 08:06:37', '2026-06-03 08:12:43'),
(20, 'LDH-97D50960', 1, 'Ari Rahman', '085795016378', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-04', '2026-06-05', NULL, NULL, 1, 2, 0, 1350000.00, 'BCA Virtual Account', 'failed', '2026-06-03 23:51:21', '2026-06-03 23:52:25'),
(21, 'LDH-8D9F6C33', 1, 'Ari Rahman', '085795016378', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-04', '2026-06-05', NULL, NULL, 1, 2, 0, 1350000.00, 'BCA Virtual Account', 'success', '2026-06-03 23:54:48', '2026-06-03 23:56:07'),
(22, 'LDH-65AF5C66', 1, 'Ari Rahman', '085795016378', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-04', '2026-06-05', NULL, NULL, 1, 0, 0, 1200000.00, 'pending', 'failed', '2026-06-04 00:09:10', '2026-06-17 01:11:21'),
(23, 'LDH-A2E0A197', 1, 'Ari Rahman', '085795016378', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-04', '2026-06-05', NULL, NULL, 1, 0, 0, 1200000.00, 'pending', 'failed', '2026-06-04 00:09:30', '2026-06-17 01:11:21'),
(24, 'LDH-2102DF92', 1, 'Ari Rahman', '081219656391', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-04-28', '2026-05-01', NULL, NULL, 3, 0, 0, 0.00, 'pending', 'failed', '2026-06-17 01:09:22', '2026-06-17 02:12:33'),
(25, 'LDH-283E9145', 1, 'Ari Rahman', '081219656391', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-20', NULL, NULL, 3, 5, 5, 6625000.00, 'pending', 'failed', '2026-06-17 01:28:50', '2026-06-17 02:12:32'),
(26, 'LDH-2EE68768', 1, 'Ari Rahman', '081219656391', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 1800000.00, 'BNI Virtual Account', 'refunded', '2026-06-17 02:35:30', '2026-06-17 02:53:40'),
(27, 'LDH-57BC8047', 1, 'Ari Rahman', '081219656391', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 1, 1900000.00, 'QRIS', 'refund_rejected', '2026-06-17 02:54:29', '2026-06-17 02:56:26'),
(28, 'LDH-BC0B6410', 1, 'Ari Rahman', '081219656391', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-20', NULL, NULL, 3, 4, 0, 6300000.00, 'Alfamart / Alfamidi', 'refunded', '2026-06-17 03:01:31', '2026-06-17 03:03:51'),
(29, 'LDH-F0EC5591', 1, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-20', NULL, NULL, 3, 0, 0, 4000000.00, 'QRIS', 'success', '2026-06-17 03:11:59', '2026-06-17 03:12:46'),
(30, 'LDH-3C2C6515', 1, 'Ari Rahman', '081219656391', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-19', '2026-06-23', NULL, NULL, 4, 0, 0, 6200000.00, 'BRI Virtual Account', 'success', '2026-06-17 03:38:59', '2026-06-17 03:39:29'),
(31, 'LDH-6EF09D45', 1, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 1200000.00, 'BCA Virtual Account', 'success', '2026-06-17 03:40:54', '2026-06-17 03:46:37'),
(32, 'LDH-C87DC382', 1, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-21', NULL, NULL, 4, 0, 2, 6400000.00, 'BCA Virtual Account', 'success', '2026-06-17 05:04:12', '2026-06-17 05:04:33'),
(33, 'LDH-B3367A88', 1, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-20', NULL, NULL, 3, 0, 5, 5500000.00, 'BCA Virtual Account', 'success', '2026-06-17 05:16:11', '2026-06-17 05:16:26'),
(34, 'LDH-8D621B19', 1, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 1200000.00, 'BCA Virtual Account', 'failed', '2026-06-17 05:21:44', '2026-06-17 05:21:57'),
(35, 'LDH-225FD811', 1, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 1200000.00, 'BCA Virtual Account', 'success', '2026-06-17 05:25:38', '2026-06-17 05:25:55'),
(36, 'LDH-78C01432', 3, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 921609.00, 'BCA Virtual Account', 'success', '2026-06-17 05:29:11', '2026-06-17 05:29:28'),
(37, 'LDH-21C3C064', 4, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 2250000.00, 'BCA Virtual Account', 'success', '2026-06-17 05:40:02', '2026-06-17 05:40:21'),
(38, 'LDH-D9573C50', 3, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 2, 3, 1371609.00, 'BCA Virtual Account', 'success', '2026-06-17 05:50:53', '2026-06-17 05:51:10'),
(39, 'LDH-8B1B5B10', 3, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 921609.00, 'BCA Virtual Account', 'success', '2026-06-17 05:58:16', '2026-06-17 05:58:34'),
(40, 'LDH-78F79366', 3, 'Ari Rahman', '081386325970', 'arirahman@apps.ipb.ac.id', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 921609.00, 'BCA Virtual Account', 'success', '2026-06-17 06:01:43', '2026-06-17 06:01:58'),
(41, 'LDH-18B59C38', 3, 'Ari Rahman', '081386325970', 'arryrahmand5@gmail.com', 'Ari Rahman', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 921609.00, 'BCA Virtual Account', 'success', '2026-06-17 06:35:45', '2026-06-17 06:36:01'),
(42, 'LDH-FB165596', 3, 'Test Learn', '081386325970', 'testppppoooo123@gmail.com', 'Test Learn', '2026-06-17', '2026-06-18', NULL, NULL, 1, 0, 0, 921609.00, 'BCA Virtual Account', 'success', '2026-06-17 13:52:31', '2026-06-17 13:52:50'),
(43, 'LDH-E0B22744', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-07-26', '2026-07-27', NULL, NULL, 1, 2, 1, 1450000.00, 'BCA Virtual Account', 'success', '2026-07-26 13:21:34', '2026-07-26 13:22:14'),
(44, 'LDH-D8E93582', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-07-26', '2026-07-27', NULL, NULL, 1, 1, 1, 1375000.00, 'BCA Virtual Account', 'success', '2026-07-26 13:39:57', '2026-07-26 13:40:17'),
(45, 'LDH-0C3C2520', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-07-31', '2026-08-02', NULL, NULL, 2, 1, 1, 3150000.00, 'BCA Virtual Account', 'rescheduled', '2026-07-26 14:46:40', '2026-07-26 15:25:35'),
(46, 'LDH-63799426', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-08-04', '2026-08-05', NULL, NULL, 1, 0, 0, 1200000.00, 'BCA Virtual Account', 'success', '2026-07-26 15:39:18', '2026-07-26 15:39:34'),
(47, 'LDH-DF061696', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'Mamah Ari', '2026-07-31', '2026-08-01', '2026-07-30', '2026-07-31', 1, 0, 0, 1600000.00, 'BCA Virtual Account', 'reschedule_rejected', '2026-07-27 02:04:13', '2026-07-27 03:47:08'),
(48, 'LDH-527FC692', 4, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-11-13', '2026-11-14', NULL, NULL, 1, 0, 0, 2800000.00, 'BCA Virtual Account', 'success', '2026-07-27 02:24:21', '2026-07-27 02:30:59'),
(49, 'LDH-E197C739', 5, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-08-30', '2026-08-31', '2026-07-30', '2026-07-31', 1, 0, 0, 880000.00, 'BCA Virtual Account', 'reschedule_pending', '2026-07-27 02:42:06', '2026-07-27 02:42:40'),
(50, 'LDH-77CF5750', 3, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-07-27', '2026-08-06', NULL, NULL, 10, 2, 1, 12072872.00, 'BCA Virtual Account', 'success', '2026-07-27 05:52:55', '2026-07-27 05:53:11'),
(51, 'LDH-2A453412', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-08-03', '2026-08-04', NULL, NULL, 1, 0, 0, 1200000.00, 'BCA Virtual Account', 'success', '2026-07-27 09:13:54', '2026-07-27 09:14:30'),
(52, 'LDH-9C106520', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-07-27', '2026-07-28', NULL, NULL, 1, 0, 0, 1200000.00, 'QRIS', 'failed', '2026-07-27 09:15:05', '2026-07-27 09:16:08'),
(53, 'LDH-3A1C9697', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-07-27', '2026-07-28', NULL, NULL, 1, 0, 0, 1200000.00, 'BSI Virtual Account', 'success', '2026-07-27 09:16:19', '2026-07-27 09:16:41'),
(54, 'LDH-BB781076', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-07-28', '2026-07-29', NULL, NULL, 1, 0, 0, 1200000.00, 'BCA Virtual Account', 'success', '2026-07-27 09:17:31', '2026-07-27 09:17:45'),
(55, 'LDH-3F404642', 1, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-12-24', '2026-12-26', NULL, NULL, 2, 0, 0, 3600000.00, 'BCA Virtual Account', 'rescheduled', '2026-07-27 10:30:12', '2026-07-27 10:33:25'),
(56, 'LDH-3E6B5158', 4, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-12-21', '2026-12-23', NULL, NULL, 2, 0, 0, 6000000.00, 'BCA Virtual Account', 'success', '2026-07-27 10:33:55', '2026-07-27 10:34:10'),
(57, 'LDH-564C7F86', 3, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-07-27', '2026-07-28', NULL, NULL, 1, 0, 0, 750000.00, 'BCA Virtual Account', 'success', '2026-07-27 10:37:09', '2026-07-27 10:37:27'),
(58, 'LDH-263D8D88', 3, 'ari', '085795016378', 'arryrahmand11@gmail.com', 'ari', '2026-08-18', '2026-08-24', '2026-08-16', '2026-08-22', 6, 0, 0, 5200000.00, 'BCA Virtual Account', 'reschedule_pending', '2026-07-27 10:38:10', '2026-07-27 10:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('landeuh-village-riverside-cache-booking_cleanup', 'b:1;', 1785148837);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `date_settings`
--

CREATE TABLE `date_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `dates` text NOT NULL,
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
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
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
(10, '2026_07_26_210430_add_reschedule_columns_to_bookings_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1GWMO8jkOgeXe0TcgZdHgLzsiislk6dg6mAtKdYi', 8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJkR3paNnRZSXJHdzBHc3BmVDJ5aVltM09RYThFSHhHcnlLNlE5aENwIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvYXBpXC9ub3RpZmljYXRpb25zIiwicm91dGUiOiJhZG1pbi5hcGkubm90aWZpY2F0aW9ucyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjEsImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo4fQ==', 1785148787);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
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
(8, 'ari', 'arryrahmand11@gmail.com', '085795016378', NULL, '2026-07-26 13:16:13', '$2y$12$A8V2xkYiKl.l61beYMK/B.ibI9BHmpV8MNfJqL/RgOwSCrjPK1G9e', 'user', NULL, '2026-07-26 13:16:13', '2026-07-26 13:16:13');

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
  ADD KEY `bookings_accommodation_id_foreign` (`accommodation_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `date_settings`
--
ALTER TABLE `date_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_accommodation_id_foreign` FOREIGN KEY (`accommodation_id`) REFERENCES `accommodations` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
