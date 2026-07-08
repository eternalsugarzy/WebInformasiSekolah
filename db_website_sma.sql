-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 08, 2026 at 08:30 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_website_sma`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita_artikel`
--

CREATE TABLE `berita_artikel` (
  `id_berita` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten_lengkap` text NOT NULL,
  `tanggal_publikasi` datetime NOT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `gambar_utama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita_artikel`
--

INSERT INTO `berita_artikel` (`id_berita`, `judul`, `konten_lengkap`, `tanggal_publikasi`, `penulis`, `kategori`, `gambar_utama`) VALUES
(1, 'Tim basket putra SMAS Frater Don Bosco Banjarmasin  juara 3 pada Kanaan Basketball Competition', 'Banjarmasin, Selasa (26/10/2025) - Tim basket putra SMAS Frater Don Bosco Banjarmasin kembali menunjukkan prestasi gemilang dengan meraih juara 3 pada Kanaan Basketball Competition, perebutan juara 3 diselenggarakan pada hari Minggu, 26 Oktober 2025. Pada hari ini, piala diserahkan secara simbolis kepada pihak sekolah, yang diserahakan kepada Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM, selaku kepala sekolah. SMAS Frater Don Bosco Banjarmasin bangga dengan prestasi yang telah diraih.', '2025-10-15 08:30:00', 'Admin Olahraga', 'Prestasi', '1763378812_654.png'),
(2, 'Tim Dance SMAS Frater Don Bosco Banjarmasin Raih Juara 1 Final Honda School Talent', 'Banjarmasin, Selasa (28/10/2025) - Tim Dance SMAS Frater Don Bosco Banjarmasin, Don Bosco Crew, berhasil meraih juara 1 Final Honda School Talent 2025 seKalsel-Teng yang diselenggarakan oleh Honda di halaman Setda Provinsi Kalimantan Selatan, pada hari Minggu, 26/10/2025.\r\n\r\nPada hari ini, bertepatan dengan peringatan Hari Sumpah Pemuda, piala diserahkan kepada pihak sekolah, diterima oleh Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM. Teruslah bergerak untuk berprestasi.', '2025-10-02 09:00:00', 'Humas Sekolah', 'Prestasi', '1763378866_718.png'),
(4, 'Tim Basket Putra SMAS Frater Don Bosco Banjarmasin Raih Juara 2 Don Bosco Cup 2025', '\r\nBanjarmasin, Senin (20/10/2025) - Tim basket putra (A) SMAS Frater Don Bosco Banjarmasin berhasil meraih juara 2 pada turnamen Don Bosco Cup 2025 yang diselenggarakan oleh OSIS SMAS Frater Don Bosco Banjarmasin. Turnamen ini berlangsung pada tanggal 29 September - 10 Oktober 2025 di Don Bosco Arena Banjarmasin.\r\n\r\nHari ini, tim basket putra SMAS Frater Don Bosco Banjarmasin menyerahkan piala secara simbolis kepada pihak sekolah yang diterima oleh Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM. Prestasi ini menunjukkan kemampuan dan semangat tim basket putra (A) SMAS Frater Don Bosco Banjarmasin.', '2025-11-17 13:51:17', 'Administrator Utama', 'Prestasi', '1763383877_353.png'),
(7, 'TESTING', 'TESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTIN\\r\\nGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGT\\r\\nESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGT\\r\\nESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTEST\\r\\nINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGT\\r\\nESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTINGTESTING\\\\r\\\\n\\\\r\\\\n\\r\\nhttps://youtu.be/NBi1Hu9FwPg?si=g3yj8B8H90S9ejjM', '2026-01-07 10:55:59', 'Admin Don Bosco\r\n', 'Kegiatan Sekolah', '1767783359_358.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_fotos`
--

CREATE TABLE `galeri_fotos` (
  `id_foto` int NOT NULL,
  `id_album` int NOT NULL,
  `file_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri_fotos`
--

INSERT INTO `galeri_fotos` (`id_foto`, `id_album`, `file_foto`) VALUES
(6, 2, 'album_2_1764249568_0.png'),
(7, 2, 'album_2_1764249578_0.png'),
(8, 2, 'album_2_1764249588_0.png'),
(9, 1, 'album_1_1764249745_0.png'),
(10, 1, 'album_1_1764249755_0.png'),
(11, 1, 'album_1_1764249760_0.png'),
(12, 1, 'album_1_1764249767_0.png'),
(13, 1, 'album_1_1764249790_0.png'),
(14, 1, 'album_1_1764249798_0.png'),
(15, 1, 'album_1_1764249804_0.png'),
(16, 3, 'album_3_1764250675_0.png'),
(17, 3, 'album_3_1764250688_0.png'),
(18, 3, 'album_3_1764250688_1.png'),
(19, 3, 'album_3_1764250688_2.png'),
(20, 4, 'album_4_1771435365_0.png');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_media`
--

CREATE TABLE `galeri_media` (
  `id_album` int NOT NULL,
  `judul_album` varchar(255) NOT NULL,
  `deskripsi` text,
  `tanggal_event` date NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `tipe_media` enum('Foto','Video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri_media`
--

INSERT INTO `galeri_media` (`id_album`, `judul_album`, `deskripsi`, `tanggal_event`, `file_path`, `tipe_media`) VALUES
(1, 'Paduan suara SMAS Frater Don Bosco Banjarmasin (Don Bosco Choir) Bertugas dalam Misa.', 'Banjarmasin, Selasa (26/10/2025) - Tim basket putra SMAS Frater Don Bosco Banjarmasin kembali menunjukkan prestasi gemilang dengan meraih juara 3 pada Kanaan Basketball Competition, perebutan juara 3 diselenggarakan pada hari Minggu, 26 Oktober 2025. Pada hari ini, piala diserahkan secara simbolis kepada pihak sekolah, yang diserahakan kepada Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM, selaku kepala sekolah. SMAS Frater Don Bosco Banjarmasin bangga dengan prestasi yang telah diraih.', '2025-11-25', '1763379679_715.png', 'Foto'),
(2, 'Dalam rangka peringatan Hari Guru Nasional', ' Fr. Martinus Max Mangundap, S.Pd., CMM., bersama para pegawai yayasan Don Bosco Manado perwakilan Banjarmasin turut bersuka-cita dalam perayaan HGN 2025. Pengurus OSIS juga menyampaikan bingkisan sederhana sebagai ungkapan syukur atas segala dukungan yayasan untuk para guru, sekaligus ungkapan terima kasih atas perhatian yayasan kepada sekolah dan para murid dalam menunjang keberlangsungan aktivitas pendidikan.', '2025-11-26', '', 'Foto'),
(3, 'Tim Dance SMAS Frater Don Bosco Banjarmasin Raih Juara 2 Youth Fest Banjarmasin 2025', 'Banjarmasin, Senin (10/11/2025) - Tim Dance SMAS Frater Don Bosco Banjarmasin, Donbosco Crew, kembali menunjukkan prestasi gemilang dengan meraih juara 2 dalam perlombaan dance Youth Fest Banjarmasin 2025, yang diadakan pada hari Jumat, 7/11/2025 oleh Pemerintah Kota Banjarmasin. Donbosco Crew kembali membuktikan kemampuan mereka, dan ini merupakan buah dari kerja keras dan dedikasi mereka. Terus berkarya Don Bosco Crew!!', '2025-11-10', NULL, 'Foto'),
(4, 'TESTING', 'TESTING', '2026-02-18', NULL, 'Foto');

-- --------------------------------------------------------

--
-- Table structure for table `guru_staf`
--

CREATE TABLE `guru_staf` (
  `id_guru` int NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `bidang_studi` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `guru_staf`
--

INSERT INTO `guru_staf` (`id_guru`, `nip`, `nama_lengkap`, `jabatan`, `bidang_studi`, `email`, `foto`) VALUES
(9, '0101 171175 001', 'Fr. Danny Arifin D. Latumahina, S.Ag., M.Pd., CMM.', 'Kepala Sekolah', '', '', '1764600874_401.jpg'),
(10, '0195 191269 002', 'Dra. Angelina Sri Widiyati.', 'Guru Mapel', 'Bahasa Indonesia', '', '1764248924_460.png'),
(11, '0197 180171  003', 'Anastasia Endah Purnawati, S. Pd.', 'Guru Mapel', 'Fisika', '', '1764248954_917.png'),
(12, '0199  251270 005', 'Maria Trihariani Krismihastuti, S.Pd', 'Guru Mapel', 'Sejarah', '', '1764248998_379.png'),
(13, '0102 111167 006', 'Kusuma Wardani, S.Pd', 'Guru Mapel', 'Kimia', '', '1764249026_241.png'),
(14, '0104 110873 007', 'Katarina Dewi Wisatawati, S.Pd', 'Guru Mapel', 'Biologi', '', '1764249062_586.png'),
(15, '0105 071267 010', 'Maria Imaculata Setya Adviyanti, S P', 'Guru Mapel', 'BK-Mulok', '', '1764249126_788.png'),
(16, '0105 070282 011', 'Martinus, S.Pd', 'Guru Mapel', 'Matematika', '', '1764249155_802.png');

-- --------------------------------------------------------

--
-- Table structure for table `identitas_sekolah`
--

CREATE TABLE `identitas_sekolah` (
  `id_identitas` int NOT NULL,
  `sejarah` text,
  `visi` text,
  `sambutan_kepsek` text,
  `misi` text,
  `fasilitas` text,
  `file_poster` varchar(255) DEFAULT NULL,
  `link_video` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `identitas_sekolah`
--

INSERT INTO `identitas_sekolah` (`id_identitas`, `sejarah`, `visi`, `sambutan_kepsek`, `misi`, `fasilitas`, `file_poster`, `link_video`) VALUES
(1, 'SMA Frater Don Bosco Banjarmasin didirikan pada tahun 1958, berdasarkan SK Pendirian U.P. 15/1958/P.N.B, dengan tujuan untuk memberikan pendidikan yang berkualitas, berbasis kasih persaudaraan, dan berlandaskan nilai-nilai keimanan. Sekolah ini dikelola oleh ordo Frater Don Bosco dan telah berperan penting dalam mencetak generasi muda yang berkarakter, berilmu, dan berbudi pekerti. Sebagai sekolah swasta, SMA Frater Don Bosco memiliki akreditasi A dan dikenal dengan komitmennya dalam mengembangkan potensi siswa baik secara akademis maupun non-akademis. Dalam perjalanan sejarahnya, sekolah ini terus berusaha untuk memberikan pendidikan yang menyentuh aspek spiritual, moral, dan intelektual, melalui berbagai program pendidikan yang efektif dan menyenangkan. Sekolah ini juga aktif dalam mempererat kerjasama dengan berbagai pihak terkait, termasuk orang tua, masyarakat, dan lembaga pendidikan lainnya.', 'BERIMAN, BERILMU, BERLANDASKAN KASIH PERSAUDARAAN MENUJU PRIBADI \r\nMANUSIA SEUTUHNYA', '                                                                                                            Dengan penuh rasa syukur, kami menyampaikan terima kasih kepada seluruh warga sekolah serta masyarakat yang telah mendukung terbangunnya lingkungan pendidikan yang semakin maju. Berkat kerja sama dan komitmen bersama, Website sekolah ini\r\n dapat kami perbarui dan kembangkan sehingga mampu menjadi sarana informasi yang lebih lengkap, transparan, dan mudah diakses oleh seluruh pemangku kepentingan.\r\n\r\nDi tengah perkembangan era globalisasi serta kemajuan teknologi informasi yang semakin cepat, keberadaan website sekolah menjadi kebutuhan penting dalam dunia pendidikan. Website ini menjadi ruang publik untuk menyampaikan informasi, perkembangan kegiatan sekolah, prestasi peserta didik, serta berbagai program yang kami jalankan. Dengan demikian, masyarakat dapat mengikuti secara langsung dinamika dan kemajuan yang dicapai oleh SMA Frater Don Bosco Banjarmasin.\r\n\r\nKami mengucapkan apresiasi kepada tim penyusun dan pengelola website yang telah bekerja keras menghadirkan platform ini dengan sebaik-baiknya. Kami menyadari bahwa masih ada banyak hal yang perlu ditingkatkan. Oleh karena itu, kami sangat terbuka terhadap kritik dan saran yang konstruktif dari seluruh civitas akademika maupun masyarakat demi penyempurnaan website sekolah ke depan.\r\n\r\nHarapan kami, website ini dapat menjadi ruang interaksi positif yang menghubungkan sekolah dengan masyarakat luas, mempererat komunikasi, serta menghadirkan manfaat bagi semua pihak yang membutuhkan informasi tentang sekolah. Semoga segala upaya yang kita lakukan bersama membawa kebaikan, kemajuan, dan masa depan yang lebih cerah bagi generasi muda.\r\n\r\nTerima kasih.\r\n\r\nHormat saya,\r\nKepala SMA Frater Don Bosco Banjarmasin                                                                                                ', '1. Meningkatkan toleransi hidup beragama.\r\n2. Menyelenggarakan kegiatan keagamaan secara lebih efektif.\r\n3. Meningkatkan budaya disiplin dalam bekerja.\r\n4. Menjalin kerjasama yang erat dengan stakeholders.\r\n5. Melaksanakan kegiatan pembelajaran yang efektif dan menyenangkan.\r\n6. Melakukan supervisi untuk meningkatkan kualitas pembelajaran.\r\n7. Meningkatkan prestasi akademik dan non‑akademik peserta didik.\r\n8. Menghasilkan lulusan yang berkompetisi secara global.\r\n9. Mengembangkan nilai‑nilai kasih dan persaudaraan secara konkret.', 'Kami memiliki Laboratorium Komputer, Perpustakaan Digital, dan Lapangan Olahraga yang luas.', 'poster_1764151376.jpg', 'https://youtu.be/SKJM9ZMaOrc?si=aLas8XOHN-TmD-l0');

-- --------------------------------------------------------

--
-- Table structure for table `info_ppdb`
--

CREATE TABLE `info_ppdb` (
  `id_info` int NOT NULL,
  `jenis_informasi` varchar(100) NOT NULL,
  `isi_detail` text NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `tautan_formulir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `info_ppdb`
--

INSERT INTO `info_ppdb` (`id_info`, `jenis_informasi`, `isi_detail`, `tanggal_mulai`, `tanggal_akhir`, `tautan_formulir`) VALUES
(1, 'Link Informasi Peneriamaan Peserta Didik Baru (PPDB) :', 'Kami Tunggu Kehadiranyyaaaa', '2025-11-17', '2025-11-30', 'https://docs.google.com/forms/d/e/1FAIpQLSeGL9uDEfnDKoo8NjElfOKxJ7IUEUC6WSsVt3PDTB4KqF9IAg/viewform');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria_saw`
--

CREATE TABLE `kriteria_saw` (
  `id_kriteria` int NOT NULL,
  `kode_kriteria` varchar(5) NOT NULL,
  `nama_kriteria` varchar(100) NOT NULL,
  `tipe` enum('Benefit','Cost') NOT NULL,
  `bobot` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kriteria_saw`
--

INSERT INTO `kriteria_saw` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `tipe`, `bobot`) VALUES
(1, 'C1', 'Rata-rata Raport (Sem 1-5)', 'Benefit', 40),
(2, 'C2', 'Nilai Tes Tertulis', 'Benefit', 30),
(3, 'C3', 'Prestasi / Sertifikat', 'Benefit', 20),
(4, 'C4', 'Jarak Rumah ke Sekolah', 'Cost', 10);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_tesmasuk`
--

CREATE TABLE `nilai_tesmasuk` (
  `id_nilai_tes` int NOT NULL,
  `id_pendaftar` int NOT NULL,
  `nilai_raport` float DEFAULT '0',
  `nilai_tes` float DEFAULT '0',
  `nilai_prestasi` float DEFAULT '0',
  `jarak_rumah` float DEFAULT '0',
  `nilai_akhir_saw` float DEFAULT NULL,
  `peringkat` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nilai_tesmasuk`
--

INSERT INTO `nilai_tesmasuk` (`id_nilai_tes`, `id_pendaftar`, `nilai_raport`, `nilai_tes`, `nilai_prestasi`, `jarak_rumah`, `nilai_akhir_saw`, `peringkat`, `created_at`) VALUES
(1, 9, 80, 75, 70, 15, 0.715681, 5, '2026-06-07 08:19:12'),
(2, 10, 90, 55, 0, 5, 0.592004, 8, '2026-06-07 08:26:29'),
(3, 11, 78, 81, 0, 21, 0.577396, 10, '2026-06-07 08:26:43'),
(4, 8, 98, 98, 98, 100, 0.89896, 2, '2026-06-07 08:37:26'),
(5, 7, 74, 60, 30, 5, 0.603888, 7, '2026-06-07 08:37:38'),
(6, 6, 99, 96, 88, 5.2, 0.931162, 1, '2026-06-07 08:38:00'),
(7, 5, 85, 80, 45, 25, 0.692169, 6, '2026-06-07 08:38:13'),
(8, 4, 89, 74, 50, 3, 0.788167, 3, '2026-06-07 08:38:27'),
(9, 3, 87, 65, 0, 9, 0.583828, 9, '2026-06-07 08:38:42'),
(10, 12, 87, 80, 50, 5, 0.758454, 4, '2026-06-11 09:40:42');

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar_ppdb`
--

CREATE TABLE `pendaftar_ppdb` (
  `id_pendaftar` int NOT NULL,
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
  `jalur_seleksi` enum('Prestasi','Zonasi','Afirmasi') NOT NULL DEFAULT 'Zonasi'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pendaftar_ppdb`
--

INSERT INTO `pendaftar_ppdb` (`id_pendaftar`, `no_registrasi`, `nisn`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat_lengkap`, `no_hp_siswa`, `email_siswa`, `no_kk`, `nik`, `no_akte_lahir`, `npsn_smp`, `nama_sekolah_asal`, `provinsi_smp`, `kabupaten_smp`, `kecamatan_smp`, `foto_siswa`, `tanggal_daftar`, `status_seleksi`, `jalur_seleksi`) VALUES
(3, 'REG-260116065532', '019309302392', 'Muhammad Rizki', 'Tanah Laut', '2026-01-08', 'Laki-Laki', 'Islam', 'Jl Karang Rejo RT 04 RW 02 Kelurahan Karang Rejo, Jorong, Tanah Laut', '0845422126', 'rizki@mail.com', '02809025807494', '9485263596969', '992748594039', '45163152352', 'SMP Negeri 1 Jorong', 'Kalimantan Selatan', 'Tanah Laut', 'Jorong', 'MuhammadRizki_019309302392.png', '2026-01-16 14:55:32', 'Ditolak', 'Zonasi'),
(4, 'REG-260204023928', '461435153165787988', 'Almas Syauqannanda', 'Palangkaraya', '2003-06-23', 'Laki-Laki', 'Islam', 'Jl Rajawali Palangkaraya', '085462332959', 'alamas@mail.co.id', '784165156487845', '456465123123148979', '121315464657989', '011233654', 'SMP JayaPalangkaraya', 'Kalimantan Tengah', 'Palangkaraya', 'Rajawali', '1770172768_968.webp', '2026-02-04 10:39:28', 'Diterima', 'Zonasi'),
(5, 'REG-260204024304', '1546987320', 'Putra Juna', 'Sei Danau', '1995-02-22', 'Laki-Laki', 'Islam', 'Jl Sei Danau', '0863124403229', 'juna@mail.co.id', '123658977452', '0321454578210365', '0389664720016589', '0123684455', 'SMP Sei Gardu', 'Kalimantan Selatan', 'Tanah Laut', 'Jorong', 'PutraJuna_1546987320.jpg', '2026-02-04 10:43:04', 'Cadangan', 'Zonasi'),
(6, 'REG-260204025647', '0413513346548', 'Sugarzy Jago', 'Tala ', '2026-02-01', 'Laki-Laki', 'Islam', 'Jl nin aja dulu', '06455521213', 'sugart@mail.co.id', '4614345699632001', '0214552300178990', '0623298965232326', '467892532', 'SMP 1 Jorong Jaya', 'Kalimantan Selatan', 'Tanah Laut', 'Jorong', '1770173807_603.jpg', '2026-02-04 10:56:47', 'Diterima', 'Zonasi'),
(7, 'REG-260207132957', '00153156468446', 'Almas Almas', 'PKY', '2026-02-07', 'Laki-Laki', 'Islam', 'Jlawndlandaw', '06546465498', 'alams@mail.com', '54657864135354578', '7863485313546578', '135486797865131', '0830183024820', 'SMP JayaPalangka', 'Kalimantan Selatan', 'Palangkaraya', 'Jorong', '1770470997_370.png', '2026-02-07 21:29:57', 'Ditolak', 'Zonasi'),
(8, 'REG-260207133328', '12345', 'Muhammad Irwan Firmanto 1', 'Jawa', '2026-02-07', 'Laki-Laki', 'Islam', 'wdhaohdaidbalwfba', '0845422126', 'saiduns@mail.co.id', '4614345699632001', '0214552300178990', '121315464657989', '0830183024820', 'SMP Sei Gardu 2', 'Kalimantan Selatan', 'Palangkaraya', 'Jorong', '1770471208_968.png', '2026-02-07 21:33:28', 'Diterima', 'Zonasi'),
(9, 'REG-260207133449', '12345', 'Almas Syauqannanda', 'Jawa', '2026-02-17', 'Laki-Laki', 'Islam', 'ajfoaflnawfanflaf', '06546465498', 'alamas@mail.co.id', '76858745376', '63301091293212129', '992748594039', '0830183024820', 'SMP Sei Gardu', 'Kalimantan Selatan', 'Palangkaraya', 'Rajawali', '1770471289_778.png', '2026-02-07 21:34:49', 'Diterima', 'Zonasi'),
(10, 'REG-260207135052', '123456', 'Leonardo Di Caprio', 'Jawa', '2026-02-03', 'Laki-Laki', 'Kristen', 'NDkwndkandkawf', '0845422126', 'alamas@mail.co.id', '56164879863135', '1213665400054546', '0031794113134897', '23802802840248', 'SMP Sei Gardu 2', 'Kalimantan Tengah', 'Palangkaraya', 'Jorong', '', '2026-02-07 21:50:52', 'Ditolak', 'Zonasi'),
(11, 'REG-260207135209', '135468463', 'Manja Bnge', 'Sei Gardu', '2026-02-07', 'Perempuan', 'Islam', 'Daiwdlajdoaldw', '97946464', 'saiduns@mail.co.id', '4614345699632001', '12136654000545464', '2323164651212', '0830183024820', 'SMP Sei Gardu', 'Kalimantan Selatan', 'Palangkaraya', 'Jorong', '1770472329_469.png', '2026-02-07 21:52:09', 'Ditolak', 'Zonasi'),
(12, 'REG-260611094023', '28949269256259', 'TEsting 01', 'Jawa', '2011-06-22', 'Laki-Laki', 'Kristen', 'Jlaniin', '084546464479', 'testing@mail.com', '464134687965464', '64468784613154679', '6468786153167', '083018302482055', 'SMP 1 Jorong', 'Kalimantan Selatan', 'Tanah Laut', 'Rajawali', '1781170823_123.png', '2026-06-11 17:40:23', 'Diterima', 'Zonasi');

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id_pengumuman` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `tanggal_penting` date DEFAULT NULL,
  `status` enum('Aktif','Arsip') NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul`, `isi_pengumuman`, `tanggal_penting`, `status`) VALUES
(2, 'Bayar SPP Jangan Telat', 'SPP', '2025-11-17', 'Aktif'),
(3, 'Pelaksanaan Tes Kemampuan Akademik (TKA)', 'TKA ini akan berlangsung selama 4 hari, dari tanggal 3 s.d. 6 November 2025. Terbagi menjadi dua gelombang, masing-masing gelombang terdiri 3 sesi. Gelombang 1 dilaksanakan pada tanggal 3 dan 4 sedangkan gelombang 2 dilaksanakan pada tanggal 5 dan 6. Pada hari pertama diujikan mata pelajaran wajib, Bahasa Indonesia, Matematika, dan Bahasa Inggris. Sedangkan di hari kedua diujikan mata pelajaran pilihan.', '2025-11-17', 'Aktif'),
(4, 'Pemilihan Ketua OSIS SMAS Frater Don Bosco Banjarmasin Periode 2025-2026', 'Banjarmasin, Selasa (11/11/2025) - Pada hari ini, SMAS Frater Don Bosco Banjarmasin melaksanakan pemilihan Ketua OSIS periode 2025-2026. Dua pasangan calon (Paslon) ketua dan wakil ketua OSIS yang maju dalam pemilihan ini adalah Paslon 1 yaitu Fatricia Lou Wey (11-B) dan Samuel Agustino (11-C) kemudian Paslon 2 yaitu Ajeng Tri Yusanti (11-B) sebagai calon Ketua OSIS dan Aulia N. Nguwung (11-D)\r\n\r\nPemilihan dimulai dengan debat yang dilaksanakan di lapangan SMAS Frater Don Bosco Banjarmasin, yang dihadiri oleh Ibu Katarina Dewi Wisatawati, S.Pd., Bapak Martinus, S.Pd., dan Ibu Dra. Angelina Sri Widiyati sebagai panelis. Debat ini menjadi ajang bagi kedua paslon untuk menyampaikan visi dan misi mereka.\r\n\r\nSetelah proses debat, pemilihan berlangsung secara tertib dan hasilnya adalah Paslon 2, Ajeng Tri Yusanti dan Aulia N. Nguwung, terpilih menjadi Ketua OSIS dan Wakil Ketua OSIS periode 2025-2026 dengan total 318 suara. Sementara itu, Paslon 1, Fatricia Lou Wey dan Samuel Agustino, memperoleh 163 suara.\r\n\r\nSelamat kepada Ajeng Tri Yusanti dan Aulia N. Nguwung atas terpilihnya sebagai Ketua OSIS dan Wakil Ketua OSIS periode 2025-2026! Semoga dapat menjalankan tugas dengan baik dan membawa OSIS SMAS Frater Don Bosco Banjarmasin terus berkembang, bergerak dan berdampak.', '2025-11-17', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `posters`
--

CREATE TABLE `posters` (
  `id_poster` int NOT NULL,
  `file_poster` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`id_poster`, `file_poster`, `created_at`) VALUES
(6, 'slider_1764251539333.png', '2025-11-27 13:52:19'),
(7, 'slider_1764251550643.png', '2025-11-27 13:52:30'),
(8, 'slider_1764251559547.png', '2025-11-27 13:52:39');

-- --------------------------------------------------------

--
-- Table structure for table `setting_ppdb`
--

CREATE TABLE `setting_ppdb` (
  `id` int NOT NULL,
  `nama_setting` varchar(50) NOT NULL,
  `nilai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `setting_ppdb`
--

INSERT INTO `setting_ppdb` (`id`, `nama_setting`, `nilai`) VALUES
(1, 'kuota_diterima', 5),
(2, 'kuota_cadangan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `statistik_pengunjung`
--

CREATE TABLE `statistik_pengunjung` (
  `id` int NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_kunjungan` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `statistik_pengunjung`
--

INSERT INTO `statistik_pengunjung` (`id`, `tanggal`, `jumlah_kunjungan`) VALUES
(1, '2026-07-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `level` enum('Super Admin','Content Writer') NOT NULL DEFAULT 'Content Writer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama_admin`, `level`) VALUES
(1, 'admin', '$2y$10$QAlLo2MTOmzh0wqKS0W6Pu9I9CFRuSdegddfe9694gzlaFNj67vrO', 'Admin Don Bosco\r\n', 'Super Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita_artikel`
--
ALTER TABLE `berita_artikel`
  ADD PRIMARY KEY (`id_berita`);

--
-- Indexes for table `galeri_fotos`
--
ALTER TABLE `galeri_fotos`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `fk_galeri_media` (`id_album`);

--
-- Indexes for table `galeri_media`
--
ALTER TABLE `galeri_media`
  ADD PRIMARY KEY (`id_album`);

--
-- Indexes for table `guru_staf`
--
ALTER TABLE `guru_staf`
  ADD PRIMARY KEY (`id_guru`),
  ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `identitas_sekolah`
--
ALTER TABLE `identitas_sekolah`
  ADD PRIMARY KEY (`id_identitas`);

--
-- Indexes for table `info_ppdb`
--
ALTER TABLE `info_ppdb`
  ADD PRIMARY KEY (`id_info`);

--
-- Indexes for table `kriteria_saw`
--
ALTER TABLE `kriteria_saw`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilai_tesmasuk`
--
ALTER TABLE `nilai_tesmasuk`
  ADD PRIMARY KEY (`id_nilai_tes`),
  ADD KEY `fk_nilai_pendaftar` (`id_pendaftar`);

--
-- Indexes for table `pendaftar_ppdb`
--
ALTER TABLE `pendaftar_ppdb`
  ADD PRIMARY KEY (`id_pendaftar`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id_pengumuman`);

--
-- Indexes for table `posters`
--
ALTER TABLE `posters`
  ADD PRIMARY KEY (`id_poster`);

--
-- Indexes for table `setting_ppdb`
--
ALTER TABLE `setting_ppdb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statistik_pengunjung`
--
ALTER TABLE `statistik_pengunjung`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_tanggal` (`tanggal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita_artikel`
--
ALTER TABLE `berita_artikel`
  MODIFY `id_berita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `galeri_fotos`
--
ALTER TABLE `galeri_fotos`
  MODIFY `id_foto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `galeri_media`
--
ALTER TABLE `galeri_media`
  MODIFY `id_album` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `guru_staf`
--
ALTER TABLE `guru_staf`
  MODIFY `id_guru` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `info_ppdb`
--
ALTER TABLE `info_ppdb`
  MODIFY `id_info` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kriteria_saw`
--
ALTER TABLE `kriteria_saw`
  MODIFY `id_kriteria` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nilai_tesmasuk`
--
ALTER TABLE `nilai_tesmasuk`
  MODIFY `id_nilai_tes` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pendaftar_ppdb`
--
ALTER TABLE `pendaftar_ppdb`
  MODIFY `id_pendaftar` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posters`
--
ALTER TABLE `posters`
  MODIFY `id_poster` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `setting_ppdb`
--
ALTER TABLE `setting_ppdb`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `statistik_pengunjung`
--
ALTER TABLE `statistik_pengunjung`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `galeri_fotos`
--
ALTER TABLE `galeri_fotos`
  ADD CONSTRAINT `fk_galeri_media` FOREIGN KEY (`id_album`) REFERENCES `galeri_media` (`id_album`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai_tesmasuk`
--
ALTER TABLE `nilai_tesmasuk`
  ADD CONSTRAINT `fk_nilai_pendaftar` FOREIGN KEY (`id_pendaftar`) REFERENCES `pendaftar_ppdb` (`id_pendaftar`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
