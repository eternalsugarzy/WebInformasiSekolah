-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: db_website_sma
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `berita_artikel`
--

DROP TABLE IF EXISTS `berita_artikel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `berita_artikel` (
  `id_berita` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `konten_lengkap` text NOT NULL,
  `tanggal_publikasi` datetime NOT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `gambar_utama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_berita`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `berita_artikel`
--

LOCK TABLES `berita_artikel` WRITE;
/*!40000 ALTER TABLE `berita_artikel` DISABLE KEYS */;
INSERT INTO `berita_artikel` VALUES (1,'Tim basket putra SMAS Frater Don Bosco Banjarmasin  juara 3 pada Kanaan Basketball Competition','Banjarmasin, Selasa (26/10/2025) - Tim basket putra SMAS Frater Don Bosco Banjarmasin kembali menunjukkan prestasi gemilang dengan meraih juara 3 pada Kanaan Basketball Competition, perebutan juara 3 diselenggarakan pada hari Minggu, 26 Oktober 2025. Pada hari ini, piala diserahkan secara simbolis kepada pihak sekolah, yang diserahakan kepada Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM, selaku kepala sekolah. SMAS Frater Don Bosco Banjarmasin bangga dengan prestasi yang telah diraih.','2025-10-15 08:30:00','Admin Olahraga','Prestasi','1763378812_654.png'),(2,'Tim Dance SMAS Frater Don Bosco Banjarmasin Raih Juara 1 Final Honda School Talent','Banjarmasin, Selasa (28/10/2025) - Tim Dance SMAS Frater Don Bosco Banjarmasin, Don Bosco Crew, berhasil meraih juara 1 Final Honda School Talent 2025 seKalsel-Teng yang diselenggarakan oleh Honda di halaman Setda Provinsi Kalimantan Selatan, pada hari Minggu, 26/10/2025.\r\n\r\nPada hari ini, bertepatan dengan peringatan Hari Sumpah Pemuda, piala diserahkan kepada pihak sekolah, diterima oleh Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM. Teruslah bergerak untuk berprestasi.','2025-10-02 09:00:00','Humas Sekolah','Prestasi','1763378866_718.png'),(4,'Tim Basket Putra SMAS Frater Don Bosco Banjarmasin Raih Juara 2 Don Bosco Cup 2025','\r\nBanjarmasin, Senin (20/10/2025) - Tim basket putra (A) SMAS Frater Don Bosco Banjarmasin berhasil meraih juara 2 pada turnamen Don Bosco Cup 2025 yang diselenggarakan oleh OSIS SMAS Frater Don Bosco Banjarmasin. Turnamen ini berlangsung pada tanggal 29 September - 10 Oktober 2025 di Don Bosco Arena Banjarmasin.\r\n\r\nHari ini, tim basket putra SMAS Frater Don Bosco Banjarmasin menyerahkan piala secara simbolis kepada pihak sekolah yang diterima oleh Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM. Prestasi ini menunjukkan kemampuan dan semangat tim basket putra (A) SMAS Frater Don Bosco Banjarmasin.','2025-11-17 13:51:17','Administrator Utama','Prestasi','1763383877_353.png'),(7,'TESTING','TESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTIN\\r\\nGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGT\\r\\nESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGT\\r\\nESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTEST\\r\\nINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGT\\r\\nESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTING\\\\r\\\\n\\\\r\\\\n\\r\\nhttps://youtu.be/NBi1Hu9FwPg?si=g3yj8B8H90S9ejjM','2026-01-07 10:55:59','Admin Don Bosco\r\n','Kegiatan Sekolah','1767783359_358.jpg');
/*!40000 ALTER TABLE `berita_artikel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bobot_jalur`
--

DROP TABLE IF EXISTS `bobot_jalur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bobot_jalur` (
  `id_bobot_jalur` int NOT NULL AUTO_INCREMENT,
  `jalur_seleksi` enum('Prestasi','Zonasi','Afirmasi') NOT NULL,
  `id_kriteria` int NOT NULL,
  `bobot` float NOT NULL,
  PRIMARY KEY (`id_bobot_jalur`),
  UNIQUE KEY `uniq_jalur_kriteria` (`jalur_seleksi`,`id_kriteria`),
  KEY `fk_bobot_jalur_kriteria` (`id_kriteria`),
  CONSTRAINT `fk_bobot_jalur_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria_saw` (`id_kriteria`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bobot_jalur`
--

LOCK TABLES `bobot_jalur` WRITE;
/*!40000 ALTER TABLE `bobot_jalur` DISABLE KEYS */;
INSERT INTO `bobot_jalur` VALUES (1,'Zonasi',1,5),(2,'Zonasi',2,5),(3,'Zonasi',3,5),(4,'Zonasi',4,85),(5,'Prestasi',1,10),(6,'Prestasi',2,5),(7,'Prestasi',3,80),(8,'Prestasi',4,5),(9,'Afirmasi',1,25),(10,'Afirmasi',2,25),(11,'Afirmasi',3,25),(12,'Afirmasi',4,25);
/*!40000 ALTER TABLE `bobot_jalur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeri_fotos`
--

DROP TABLE IF EXISTS `galeri_fotos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galeri_fotos` (
  `id_foto` int NOT NULL AUTO_INCREMENT,
  `id_album` int NOT NULL,
  `file_foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id_foto`),
  KEY `fk_galeri_media` (`id_album`),
  CONSTRAINT `fk_galeri_media` FOREIGN KEY (`id_album`) REFERENCES `galeri_media` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeri_fotos`
--

LOCK TABLES `galeri_fotos` WRITE;
/*!40000 ALTER TABLE `galeri_fotos` DISABLE KEYS */;
INSERT INTO `galeri_fotos` VALUES (6,2,'album_2_1764249568_0.png'),(7,2,'album_2_1764249578_0.png'),(8,2,'album_2_1764249588_0.png'),(9,1,'album_1_1764249745_0.png'),(10,1,'album_1_1764249755_0.png'),(11,1,'album_1_1764249760_0.png'),(12,1,'album_1_1764249767_0.png'),(13,1,'album_1_1764249790_0.png'),(14,1,'album_1_1764249798_0.png'),(15,1,'album_1_1764249804_0.png'),(16,3,'album_3_1764250675_0.png'),(17,3,'album_3_1764250688_0.png'),(18,3,'album_3_1764250688_1.png'),(19,3,'album_3_1764250688_2.png'),(20,4,'album_4_1771435365_0.png');
/*!40000 ALTER TABLE `galeri_fotos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galeri_media`
--

DROP TABLE IF EXISTS `galeri_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galeri_media` (
  `id_album` int NOT NULL AUTO_INCREMENT,
  `judul_album` varchar(255) NOT NULL,
  `deskripsi` text,
  `tanggal_event` date NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `tipe_media` enum('Foto','Video') NOT NULL,
  PRIMARY KEY (`id_album`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeri_media`
--

LOCK TABLES `galeri_media` WRITE;
/*!40000 ALTER TABLE `galeri_media` DISABLE KEYS */;
INSERT INTO `galeri_media` VALUES (1,'Paduan suara SMAS Frater Don Bosco Banjarmasin (Don Bosco Choir) Bertugas dalam Misa.','Banjarmasin, Selasa (26/10/2025) - Tim basket putra SMAS Frater Don Bosco Banjarmasin kembali menunjukkan prestasi gemilang dengan meraih juara 3 pada Kanaan Basketball Competition, perebutan juara 3 diselenggarakan pada hari Minggu, 26 Oktober 2025. Pada hari ini, piala diserahkan secara simbolis kepada pihak sekolah, yang diserahakan kepada Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM, selaku kepala sekolah. SMAS Frater Don Bosco Banjarmasin bangga dengan prestasi yang telah diraih.','2025-11-25','1763379679_715.png','Foto'),(2,'Dalam rangka peringatan Hari Guru Nasional',' Fr. Martinus Max Mangundap, S.Pd., CMM., bersama para pegawai yayasan Don Bosco Manado perwakilan Banjarmasin turut bersuka-cita dalam perayaan HGN 2025. Pengurus OSIS juga menyampaikan bingkisan sederhana sebagai ungkapan syukur atas segala dukungan yayasan untuk para guru, sekaligus ungkapan terima kasih atas perhatian yayasan kepada sekolah dan para murid dalam menunjang keberlangsungan aktivitas pendidikan.','2025-11-26','','Foto'),(3,'Tim Dance SMAS Frater Don Bosco Banjarmasin Raih Juara 2 Youth Fest Banjarmasin 2025','Banjarmasin, Senin (10/11/2025) - Tim Dance SMAS Frater Don Bosco Banjarmasin, Donbosco Crew, kembali menunjukkan prestasi gemilang dengan meraih juara 2 dalam perlombaan dance Youth Fest Banjarmasin 2025, yang diadakan pada hari Jumat, 7/11/2025 oleh Pemerintah Kota Banjarmasin. Donbosco Crew kembali membuktikan kemampuan mereka, dan ini merupakan buah dari kerja keras dan dedikasi mereka. Terus berkarya Don Bosco Crew!!','2025-11-10',NULL,'Foto'),(4,'TESTING','TESTING','2026-02-18',NULL,'Foto');
/*!40000 ALTER TABLE `galeri_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gelombang_ppdb`
--

DROP TABLE IF EXISTS `gelombang_ppdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gelombang_ppdb` (
  `id_gelombang` int NOT NULL AUTO_INCREMENT,
  `nama_gelombang` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_gelombang`),
  KEY `idx_gelombang_periode` (`tanggal_mulai`,`tanggal_akhir`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gelombang_ppdb`
--

LOCK TABLES `gelombang_ppdb` WRITE;
/*!40000 ALTER TABLE `gelombang_ppdb` DISABLE KEYS */;
INSERT INTO `gelombang_ppdb` VALUES (1,'Gelombang 1','2026-01-01','2026-03-31','Pendaftaran awal'),(2,'Gelombang 2','2026-04-01','2026-06-30','Pendaftaran lanjutan / pemenuhan sisa kuota');
/*!40000 ALTER TABLE `gelombang_ppdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guru_staf`
--

DROP TABLE IF EXISTS `guru_staf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guru_staf` (
  `id_guru` int NOT NULL AUTO_INCREMENT,
  `nip` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `bidang_studi` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_guru`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guru_staf`
--

LOCK TABLES `guru_staf` WRITE;
/*!40000 ALTER TABLE `guru_staf` DISABLE KEYS */;
INSERT INTO `guru_staf` VALUES (9,'0101 171175 001','Fr. Danny Arifin D. Latumahina, S.Ag., M.Pd., CMM.','Kepala Sekolah','','','1764600874_401.jpg'),(10,'0195 191269 002','Dra. Angelina Sri Widiyati.','Guru Mapel','Bahasa Indonesia','','1764248924_460.png'),(11,'0197 180171  003','Anastasia Endah Purnawati, S. Pd.','Guru Mapel','Fisika','','1764248954_917.png'),(12,'0199  251270 005','Maria Trihariani Krismihastuti, S.Pd','Guru Mapel','Sejarah','','1764248998_379.png'),(13,'0102 111167 006','Kusuma Wardani, S.Pd','Guru Mapel','Kimia','','1764249026_241.png'),(14,'0104 110873 007','Katarina Dewi Wisatawati, S.Pd','Guru Mapel','Biologi','','1764249062_586.png'),(15,'0105 071267 010','Maria Imaculata Setya Adviyanti, S P','Guru Mapel','BK-Mulok','','1764249126_788.png'),(16,'0105 070282 011','Martinus, S.Pd','Guru Mapel','Matematika','','1764249155_802.png');
/*!40000 ALTER TABLE `guru_staf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histori_seleksi_saw`
--

DROP TABLE IF EXISTS `histori_seleksi_saw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `histori_seleksi_saw` (
  `id_histori` int NOT NULL AUTO_INCREMENT,
  `id_admin` int DEFAULT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `jenis_perubahan` enum('Bobot SAW','Nilai Pendaftar','Kuota Kelulusan','Status Manual','Daftar Ulang') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `data_lama` text,
  `data_baru` text,
  `waktu_perubahan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_histori`),
  KEY `idx_histori_admin` (`id_admin`),
  KEY `idx_histori_waktu` (`waktu_perubahan`),
  KEY `idx_histori_jenis` (`jenis_perubahan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histori_seleksi_saw`
--

LOCK TABLES `histori_seleksi_saw` WRITE;
/*!40000 ALTER TABLE `histori_seleksi_saw` DISABLE KEYS */;
INSERT INTO `histori_seleksi_saw` VALUES (1,1,'Admin Don Bosco\r\n','Bobot SAW','Ubah bobot kriteria SAW untuk jalur seleksi Zonasi','{\"Rata-rata Raport (Sem 1-5)\":10,\"Nilai Tes Tertulis\":5,\"Prestasi \\/ Sertifikat\":5,\"Jarak Rumah ke Sekolah\":80}','{\"Rata-rata Raport (Sem 1-5)\":5,\"Nilai Tes Tertulis\":5,\"Prestasi \\/ Sertifikat\":5,\"Jarak Rumah ke Sekolah\":85}','2026-09-09 19:36:34');
/*!40000 ALTER TABLE `histori_seleksi_saw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identitas_sekolah`
--

DROP TABLE IF EXISTS `identitas_sekolah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `identitas_sekolah` (
  `id_identitas` int NOT NULL,
  `sejarah` text,
  `visi` text,
  `sambutan_kepsek` text,
  `misi` text,
  `fasilitas` text,
  `file_poster` varchar(255) DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_identitas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identitas_sekolah`
--

LOCK TABLES `identitas_sekolah` WRITE;
/*!40000 ALTER TABLE `identitas_sekolah` DISABLE KEYS */;
INSERT INTO `identitas_sekolah` VALUES (1,'SMA Frater Don Bosco Banjarmasin didirikan pada tahun 1958, berdasarkan SK Pendirian U.P. 15/1958/P.N.B, dengan tujuan untuk memberikan pendidikan yang berkualitas, berbasis kasih persaudaraan, dan berlandaskan nilai-nilai keimanan. Sekolah ini dikelola oleh ordo Frater Don Bosco dan telah berperan penting dalam mencetak generasi muda yang berkarakter, berilmu, dan berbudi pekerti. Sebagai sekolah swasta, SMA Frater Don Bosco memiliki akreditasi A dan dikenal dengan komitmennya dalam mengembangkan potensi siswa baik secara akademis maupun non-akademis. Dalam perjalanan sejarahnya, sekolah ini terus berusaha untuk memberikan pendidikan yang menyentuh aspek spiritual, moral, dan intelektual, melalui berbagai program pendidikan yang efektif dan menyenangkan. Sekolah ini juga aktif dalam mempererat kerjasama dengan berbagai pihak terkait, termasuk orang tua, masyarakat, dan lembaga pendidikan lainnya.','BERIMAN, BERILMU, BERLANDASKAN KASIH PERSAUDARAAN MENUJU PRIBADI \r\nMANUSIA SEUTUHNYA','                                                                                                            Dengan penuh rasa syukur, kami menyampaikan terima kasih kepada seluruh warga sekolah serta masyarakat yang telah mendukung terbangunnya lingkungan pendidikan yang semakin maju. Berkat kerja sama dan komitmen bersama, Website sekolah ini\r\n dapat kami perbarui dan kembangkan sehingga mampu menjadi sarana informasi yang lebih lengkap, transparan, dan mudah diakses oleh seluruh pemangku kepentingan.\r\n\r\nDi tengah perkembangan era globalisasi serta kemajuan teknologi informasi yang semakin cepat, keberadaan website sekolah menjadi kebutuhan penting dalam dunia pendidikan. Website ini menjadi ruang publik untuk menyampaikan informasi, perkembangan kegiatan sekolah, prestasi peserta didik, serta berbagai program yang kami jalankan. Dengan demikian, masyarakat dapat mengikuti secara langsung dinamika dan kemajuan yang dicapai oleh SMA Frater Don Bosco Banjarmasin.\r\n\r\nKami mengucapkan apresiasi kepada tim penyusun dan pengelola website yang telah bekerja keras menghadirkan platform ini dengan sebaik-baiknya. Kami menyadari bahwa masih ada banyak hal yang perlu ditingkatkan. Oleh karena itu, kami sangat terbuka terhadap kritik dan saran yang konstruktif dari seluruh civitas akademika maupun masyarakat demi penyempurnaan website sekolah ke depan.\r\n\r\nHarapan kami, website ini dapat menjadi ruang interaksi positif yang menghubungkan sekolah dengan masyarakat luas, mempererat komunikasi, serta menghadirkan manfaat bagi semua pihak yang membutuhkan informasi tentang sekolah. Semoga segala upaya yang kita lakukan bersama membawa kebaikan, kemajuan, dan masa depan yang lebih cerah bagi generasi muda.\r\n\r\nTerima kasih.\r\n\r\nHormat saya,\r\nKepala SMA Frater Don Bosco Banjarmasin                                                                                                ','1. Meningkatkan toleransi hidup beragama.\r\n2. Menyelenggarakan kegiatan keagamaan secara lebih efektif.\r\n3. Meningkatkan budaya disiplin dalam bekerja.\r\n4. Menjalin kerjasama yang erat dengan stakeholders.\r\n5. Melaksanakan kegiatan pembelajaran yang efektif dan menyenangkan.\r\n6. Melakukan supervisi untuk meningkatkan kualitas pembelajaran.\r\n7. Meningkatkan prestasi akademik dan non‑akademik peserta didik.\r\n8. Menghasilkan lulusan yang berkompetisi secara global.\r\n9. Mengembangkan nilai‑nilai kasih dan persaudaraan secara konkret.','Kami memiliki Laboratorium Komputer, Perpustakaan Digital, dan Lapangan Olahraga yang luas.','poster_1764151376.jpg','https://youtu.be/SKJM9ZMaOrc?si=aLas8XOHN-TmD-l0');
/*!40000 ALTER TABLE `identitas_sekolah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_ppdb`
--

DROP TABLE IF EXISTS `info_ppdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `info_ppdb` (
  `id_info` int NOT NULL AUTO_INCREMENT,
  `jenis_informasi` varchar(100) NOT NULL,
  `isi_detail` text NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `tautan_formulir` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_info`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_ppdb`
--

LOCK TABLES `info_ppdb` WRITE;
/*!40000 ALTER TABLE `info_ppdb` DISABLE KEYS */;
INSERT INTO `info_ppdb` VALUES (1,'Link Informasi Peneriamaan Peserta Didik Baru (PPDB) :','Kami Tunggu Kehadiranyyaaaa','2025-11-17','2025-11-30','https://docs.google.com/forms/d/e/1FAIpQLSeGL9uDEfnDKoo8NjElfOKxJ7IUEUC6WSsVt3PDTB4KqF9IAg/viewform');
/*!40000 ALTER TABLE `info_ppdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kriteria_saw`
--

DROP TABLE IF EXISTS `kriteria_saw`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kriteria_saw` (
  `id_kriteria` int NOT NULL AUTO_INCREMENT,
  `kode_kriteria` varchar(5) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `tipe` enum('Benefit','Cost') NOT NULL,
  `bobot` float NOT NULL,
  PRIMARY KEY (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kriteria_saw`
--

LOCK TABLES `kriteria_saw` WRITE;
/*!40000 ALTER TABLE `kriteria_saw` DISABLE KEYS */;
INSERT INTO `kriteria_saw` VALUES (1,'C1','Rata-rata Raport (Sem 1-5)','Benefit',40),(2,'C2','Nilai Tes Tertulis','Benefit',30),(3,'C3','Prestasi / Sertifikat','Benefit',20),(4,'C4','Jarak Rumah ke Sekolah','Cost',10);
/*!40000 ALTER TABLE `kriteria_saw` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kuota_jalur`
--

DROP TABLE IF EXISTS `kuota_jalur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kuota_jalur` (
  `jalur_seleksi` enum('Prestasi','Zonasi','Afirmasi') NOT NULL,
  `kuota_diterima` int NOT NULL DEFAULT '0',
  `kuota_cadangan` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`jalur_seleksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kuota_jalur`
--

LOCK TABLES `kuota_jalur` WRITE;
/*!40000 ALTER TABLE `kuota_jalur` DISABLE KEYS */;
INSERT INTO `kuota_jalur` VALUES ('Prestasi',3,1),('Zonasi',5,1),('Afirmasi',2,1);
/*!40000 ALTER TABLE `kuota_jalur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_notifikasi_email`
--

DROP TABLE IF EXISTS `log_notifikasi_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_notifikasi_email` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int NOT NULL,
  `email_tujuan` varchar(100) NOT NULL,
  `status` enum('Terkirim','Gagal') NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `dikirim_pada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `fk_log_notifikasi_pendaftar` (`id_pendaftar`),
  CONSTRAINT `fk_log_notifikasi_pendaftar` FOREIGN KEY (`id_pendaftar`) REFERENCES `pendaftar_ppdb` (`id_pendaftar`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_notifikasi_email`
--

LOCK TABLES `log_notifikasi_email` WRITE;
/*!40000 ALTER TABLE `log_notifikasi_email` DISABLE KEYS */;
INSERT INTO `log_notifikasi_email` VALUES (1,13,'irwanfrozen@gmail.com','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:12:40'),(2,13,'irwanfrozen@gmail.com','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:19'),(3,13,'irwanfrozen@gmail.com','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(4,6,'sugart@mail.co.id','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(5,8,'saiduns@mail.co.id','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(6,4,'alamas@mail.co.id','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(7,12,'testing@mail.com','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(8,9,'alamas@mail.co.id','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(9,5,'juna@mail.co.id','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(10,7,'alams@mail.com','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(11,10,'alamas@mail.co.id','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(12,3,'rizki@mail.com','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(13,11,'saiduns@mail.co.id','Gagal','Konfigurasi SMTP di \'Koneksi Database/mail_config.php\' belum diisi dengan kredensial asli.','2026-08-23 15:33:30'),(14,3,'rizki@mail.com','Terkirim','Berhasil dikirim.','2026-08-23 15:35:18'),(15,13,'irwanfrozen@gmail.com','Terkirim','Berhasil dikirim.','2026-08-23 15:36:04'),(16,13,'irwanfrozen@gmail.com','Terkirim','Berhasil dikirim.','2026-08-23 15:43:19');
/*!40000 ALTER TABLE `log_notifikasi_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nilai_tesmasuk`
--

DROP TABLE IF EXISTS `nilai_tesmasuk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nilai_tesmasuk` (
  `id_nilai_tes` int NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int NOT NULL,
  `nilai_raport` float DEFAULT '0',
  `nilai_tes` float DEFAULT '0',
  `nilai_prestasi` float DEFAULT '0',
  `jarak_rumah` float DEFAULT '0',
  `nilai_akhir_saw` float DEFAULT NULL,
  `peringkat` int DEFAULT NULL,
  `peringkat_jalur` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_nilai_tes`),
  KEY `fk_nilai_pendaftar` (`id_pendaftar`),
  CONSTRAINT `fk_nilai_pendaftar` FOREIGN KEY (`id_pendaftar`) REFERENCES `pendaftar_ppdb` (`id_pendaftar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nilai_tesmasuk`
--

LOCK TABLES `nilai_tesmasuk` WRITE;
/*!40000 ALTER TABLE `nilai_tesmasuk` DISABLE KEYS */;
INSERT INTO `nilai_tesmasuk` VALUES (1,9,80,75,70,15,0.715681,5,5,'2026-06-07 08:19:12'),(2,10,90,55,0,5,0.592004,8,8,'2026-06-07 08:26:29'),(3,11,78,81,0,21,0.577396,10,10,'2026-06-07 08:26:43'),(4,8,98,98,98,100,0.89896,2,2,'2026-06-07 08:37:26'),(5,7,74,60,30,5,0.603888,7,7,'2026-06-07 08:37:38'),(6,6,99,96,88,5.2,0.931162,1,1,'2026-06-07 08:38:00'),(7,5,85,80,45,25,0.692169,6,6,'2026-06-07 08:38:13'),(8,4,89,74,50,3,0.788167,3,3,'2026-06-07 08:38:27'),(9,3,87,65,0,9,0.583828,9,9,'2026-06-07 08:38:42'),(10,12,87,80,50,5,0.758454,4,4,'2026-06-11 09:40:42');
/*!40000 ALTER TABLE `nilai_tesmasuk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendaftar_ppdb`
--

DROP TABLE IF EXISTS `pendaftar_ppdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pendaftar_ppdb` (
  `id_pendaftar` int NOT NULL AUTO_INCREMENT,
  `no_registrasi` varchar(20) DEFAULT NULL,
  `nisn` varchar(20) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama` varchar(20) NOT NULL,
  `alamat_lengkap` text NOT NULL,
  `no_hp_siswa` varchar(20) NOT NULL,
  `email_siswa` varchar(100) NOT NULL,
  `no_kk` varchar(20) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_akte_lahir` varchar(50) NOT NULL,
  `npsn_smp` varchar(20) NOT NULL,
  `nama_sekolah_asal` varchar(100) NOT NULL,
  `provinsi_smp` varchar(50) NOT NULL,
  `kabupaten_smp` varchar(50) NOT NULL,
  `kecamatan_smp` varchar(50) NOT NULL,
  `foto_siswa` varchar(255) DEFAULT NULL,
  `tanggal_daftar` datetime DEFAULT CURRENT_TIMESTAMP,
  `status_seleksi` enum('Menunggu','Diterima','Ditolak','Cadangan') DEFAULT 'Menunggu',
  `status_daftar_ulang` enum('Belum Konfirmasi','Daftar Ulang','Mengundurkan Diri') NOT NULL DEFAULT 'Belum Konfirmasi',
  `tanggal_daftar_ulang` datetime DEFAULT NULL,
  `catatan_daftar_ulang` varchar(255) DEFAULT NULL,
  `status_email_notifikasi` enum('Belum Terkirim','Terkirim','Gagal') NOT NULL DEFAULT 'Belum Terkirim',
  `status_seleksi_saat_email` enum('Menunggu','Diterima','Ditolak','Cadangan') DEFAULT NULL,
  `email_terkirim_at` datetime DEFAULT NULL,
  `jalur_seleksi` enum('Prestasi','Zonasi','Afirmasi') NOT NULL DEFAULT 'Zonasi',
  `id_gelombang` int DEFAULT NULL,
  PRIMARY KEY (`id_pendaftar`),
  KEY `fk_pendaftar_gelombang` (`id_gelombang`),
  CONSTRAINT `fk_pendaftar_gelombang` FOREIGN KEY (`id_gelombang`) REFERENCES `gelombang_ppdb` (`id_gelombang`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendaftar_ppdb`
--

LOCK TABLES `pendaftar_ppdb` WRITE;
/*!40000 ALTER TABLE `pendaftar_ppdb` DISABLE KEYS */;
INSERT INTO `pendaftar_ppdb` VALUES (3,'REG-260116065532','019309302392','Muhammad Rizki','Tanah Laut','2026-01-08','Laki-Laki','Islam','Jl Karang Rejo RT 04 RW 02 Kelurahan Karang Rejo, Jorong, Tanah Laut','0845422126','rizki@mail.com','02809025807494','9485263596969','992748594039','45163152352','SMP Negeri 1 Jorong','Kalimantan Selatan','Tanah Laut','Jorong','MuhammadRizki_019309302392.png','2026-01-16 14:55:32','Ditolak','Belum Konfirmasi',NULL,NULL,'Terkirim','Ditolak','2026-08-23 15:35:18','Zonasi',1),(4,'REG-260204023928','461435153165787988','Almas Syauqannanda','Palangkaraya','2003-06-23','Laki-Laki','Islam','Jl Rajawali Palangkaraya','085462332959','alamas@mail.co.id','784165156487845','456465123123148979','121315464657989','011233654','SMP JayaPalangkaraya','Kalimantan Tengah','Palangkaraya','Rajawali','1770172768_968.webp','2026-02-04 10:39:28','Diterima','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',1),(5,'REG-260204024304','1546987320','Putra Juna','Sei Danau','1995-02-22','Laki-Laki','Islam','Jl Sei Danau','0863124403229','juna@mail.co.id','123658977452','0321454578210365','0389664720016589','0123684455','SMP Sei Gardu','Kalimantan Selatan','Tanah Laut','Jorong','PutraJuna_1546987320.jpg','2026-02-04 10:43:04','Cadangan','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',1),(6,'REG-260204025647','0413513346548','Sugarzy Jago','Tala ','2026-02-01','Laki-Laki','Islam','Jl nin aja dulu','06455521213','sugart@mail.co.id','4614345699632001','0214552300178990','0623298965232326','467892532','SMP 1 Jorong Jaya','Kalimantan Selatan','Tanah Laut','Jorong','1770173807_603.jpg','2026-02-04 10:56:47','Diterima','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',1),(7,'REG-260207132957','00153156468446','Almas Almas','PKY','2026-02-07','Laki-Laki','Islam','Jlawndlandaw','06546465498','alams@mail.com','54657864135354578','7863485313546578','135486797865131','0830183024820','SMP JayaPalangka','Kalimantan Selatan','Palangkaraya','Jorong','1770470997_370.png','2026-02-07 21:29:57','Ditolak','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',1),(8,'REG-260207133328','12345','Muhammad Irwan Firmanto 1','Jawa','2026-02-07','Laki-Laki','Islam','wdhaohdaidbalwfba','0845422126','saiduns@mail.co.id','4614345699632001','0214552300178990','121315464657989','0830183024820','SMP Sei Gardu 2','Kalimantan Selatan','Palangkaraya','Jorong','1770471208_968.png','2026-02-07 21:33:28','Diterima','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',1),(9,'REG-260207133449','12345','Almas Syauqannanda','Jawa','2026-02-17','Laki-Laki','Islam','ajfoaflnawfanflaf','06546465498','alamas@mail.co.id','76858745376','63301091293212129','992748594039','0830183024820','SMP Sei Gardu','Kalimantan Selatan','Palangkaraya','Rajawali','1770471289_778.png','2026-02-07 21:34:49','Diterima','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',1),(10,'REG-260207135052','123456','Leonardo Di Caprio','Jawa','2026-02-03','Laki-Laki','Kristen','NDkwndkandkawf','0845422126','alamas@mail.co.id','56164879863135','1213665400054546','0031794113134897','23802802840248','SMP Sei Gardu 2','Kalimantan Tengah','Palangkaraya','Jorong','','2026-02-07 21:50:52','Ditolak','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',1),(11,'REG-260207135209','135468463','Manja Bnge','Sei Gardu','2026-02-07','Perempuan','Islam','Daiwdlajdoaldw','97946464','saiduns@mail.co.id','4614345699632001','12136654000545464','2323164651212','0830183024820','SMP Sei Gardu','Kalimantan Selatan','Palangkaraya','Jorong','1770472329_469.png','2026-02-07 21:52:09','Ditolak','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',1),(12,'REG-260611094023','28949269256259','TEsting 01','Jawa','2011-06-22','Laki-Laki','Kristen','Jlaniin','084546464479','testing@mail.com','464134687965464','64468784613154679','6468786153167','083018302482055','SMP 1 Jorong','Kalimantan Selatan','Tanah Laut','Rajawali','1781170823_123.png','2026-06-11 17:40:23','Diterima','Belum Konfirmasi',NULL,NULL,'Gagal',NULL,NULL,'Zonasi',2),(13,'REG-260823071103','2210010264','Ahmad Said','Gardu','2004-08-23','Laki-Laki','Kristen Protestan','Sungai Gardu','0855669978555','irwanfrozen@gmail.com','6969696966969673','1236547898745632','9874563256985631','30304267','SMK Bina Banua Banjarmasin','Kalimantan Selatan','Banjarmasin','Banjarmasin Timur','AhmadSaid_2210010264.jpeg','2026-08-23 15:11:03','Ditolak','Belum Konfirmasi',NULL,NULL,'Terkirim','Ditolak','2026-08-23 15:43:19','Zonasi',NULL);
/*!40000 ALTER TABLE `pendaftar_ppdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengumuman`
--

DROP TABLE IF EXISTS `pengumuman`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengumuman` (
  `id_pengumuman` int NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `tanggal_penting` date DEFAULT NULL,
  `status` enum('Aktif','Arsip') NOT NULL DEFAULT 'Aktif',
  PRIMARY KEY (`id_pengumuman`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengumuman`
--

LOCK TABLES `pengumuman` WRITE;
/*!40000 ALTER TABLE `pengumuman` DISABLE KEYS */;
INSERT INTO `pengumuman` VALUES (2,'Bayar SPP Jangan Telat','SPP','2025-11-17','Aktif'),(3,'Pelaksanaan Tes Kemampuan Akademik (TKA)','TKA ini akan berlangsung selama 4 hari, dari tanggal 3 s.d. 6 November 2025. Terbagi menjadi dua gelombang, masing-masing gelombang terdiri 3 sesi. Gelombang 1 dilaksanakan pada tanggal 3 dan 4 sedangkan gelombang 2 dilaksanakan pada tanggal 5 dan 6. Pada hari pertama diujikan mata pelajaran wajib, Bahasa Indonesia, Matematika, dan Bahasa Inggris. Sedangkan di hari kedua diujikan mata pelajaran pilihan.','2025-11-17','Aktif'),(4,'Pemilihan Ketua OSIS SMAS Frater Don Bosco Banjarmasin Periode 2025-2026','Banjarmasin, Selasa (11/11/2025) - Pada hari ini, SMAS Frater Don Bosco Banjarmasin melaksanakan pemilihan Ketua OSIS periode 2025-2026. Dua pasangan calon (Paslon) ketua dan wakil ketua OSIS yang maju dalam pemilihan ini adalah Paslon 1 yaitu Fatricia Lou Wey (11-B) dan Samuel Agustino (11-C) kemudian Paslon 2 yaitu Ajeng Tri Yusanti (11-B) sebagai calon Ketua OSIS dan Aulia N. Nguwung (11-D)\r\n\r\nPemilihan dimulai dengan debat yang dilaksanakan di lapangan SMAS Frater Don Bosco Banjarmasin, yang dihadiri oleh Ibu Katarina Dewi Wisatawati, S.Pd., Bapak Martinus, S.Pd., dan Ibu Dra. Angelina Sri Widiyati sebagai panelis. Debat ini menjadi ajang bagi kedua paslon untuk menyampaikan visi dan misi mereka.\r\n\r\nSetelah proses debat, pemilihan berlangsung secara tertib dan hasilnya adalah Paslon 2, Ajeng Tri Yusanti dan Aulia N. Nguwung, terpilih menjadi Ketua OSIS dan Wakil Ketua OSIS periode 2025-2026 dengan total 318 suara. Sementara itu, Paslon 1, Fatricia Lou Wey dan Samuel Agustino, memperoleh 163 suara.\r\n\r\nSelamat kepada Ajeng Tri Yusanti dan Aulia N. Nguwung atas terpilihnya sebagai Ketua OSIS dan Wakil Ketua OSIS periode 2025-2026! Semoga dapat menjalankan tugas dengan baik dan membawa OSIS SMAS Frater Don Bosco Banjarmasin terus berkembang, bergerak dan berdampak.','2025-11-17','Aktif');
/*!40000 ALTER TABLE `pengumuman` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posters`
--

DROP TABLE IF EXISTS `posters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `posters` (
  `id_poster` int NOT NULL AUTO_INCREMENT,
  `file_poster` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_poster`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posters`
--

LOCK TABLES `posters` WRITE;
/*!40000 ALTER TABLE `posters` DISABLE KEYS */;
INSERT INTO `posters` VALUES (6,'slider_1764251539333.png','2025-11-27 13:52:19'),(7,'slider_1764251550643.png','2025-11-27 13:52:30'),(8,'slider_1764251559547.png','2025-11-27 13:52:39');
/*!40000 ALTER TABLE `posters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestasi_siswa`
--

DROP TABLE IF EXISTS `prestasi_siswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestasi_siswa` (
  `id_prestasi` int NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int NOT NULL,
  `kelas` enum('X','XI','XII') NOT NULL DEFAULT 'X',
  `nama_prestasi` varchar(150) NOT NULL,
  `jenis` enum('Akademik','Non-Akademik') NOT NULL,
  `tingkat` enum('Sekolah','Kecamatan','Kabupaten/Kota','Provinsi','Nasional','Internasional') NOT NULL,
  `peringkat` varchar(50) NOT NULL,
  `penyelenggara` varchar(150) NOT NULL,
  `tahun` year NOT NULL,
  `bukti_sertifikat` varchar(255) DEFAULT NULL,
  `status_verifikasi` enum('Menunggu','Terverifikasi','Ditolak') NOT NULL DEFAULT 'Menunggu',
  `catatan_verifikasi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_prestasi`),
  KEY `fk_prestasi_pendaftar` (`id_pendaftar`),
  KEY `idx_prestasi_filter` (`tahun`,`jenis`,`tingkat`),
  CONSTRAINT `fk_prestasi_pendaftar` FOREIGN KEY (`id_pendaftar`) REFERENCES `pendaftar_ppdb` (`id_pendaftar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestasi_siswa`
--

LOCK TABLES `prestasi_siswa` WRITE;
/*!40000 ALTER TABLE `prestasi_siswa` DISABLE KEYS */;
/*!40000 ALTER TABLE `prestasi_siswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting_ppdb`
--

DROP TABLE IF EXISTS `setting_ppdb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setting_ppdb` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_setting` varchar(50) NOT NULL,
  `nilai` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting_ppdb`
--

LOCK TABLES `setting_ppdb` WRITE;
/*!40000 ALTER TABLE `setting_ppdb` DISABLE KEYS */;
INSERT INTO `setting_ppdb` VALUES (1,'kuota_diterima',5),(2,'kuota_cadangan',1);
/*!40000 ALTER TABLE `setting_ppdb` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statistik_pengunjung`
--

DROP TABLE IF EXISTS `statistik_pengunjung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `statistik_pengunjung` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `jumlah_kunjungan` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_tanggal` (`tanggal`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statistik_pengunjung`
--

LOCK TABLES `statistik_pengunjung` WRITE;
/*!40000 ALTER TABLE `statistik_pengunjung` DISABLE KEYS */;
INSERT INTO `statistik_pengunjung` VALUES (1,'2026-07-08',1),(2,'2026-09-09',2);
/*!40000 ALTER TABLE `statistik_pengunjung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `level` enum('Super Admin','Content Writer') NOT NULL DEFAULT 'Content Writer',
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$QAlLo2MTOmzh0wqKS0W6Pu9I9CFRuSdegddfe9694gzlaFNj67vrO','Admin Don Bosco\r\n','Super Admin');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_website_sma'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
