-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2025 at 08:19 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
(4, 'Tim Basket Putra SMAS Frater Don Bosco Banjarmasin Raih Juara 2 Don Bosco Cup 2025', '\r\nBanjarmasin, Senin (20/10/2025) - Tim basket putra (A) SMAS Frater Don Bosco Banjarmasin berhasil meraih juara 2 pada turnamen Don Bosco Cup 2025 yang diselenggarakan oleh OSIS SMAS Frater Don Bosco Banjarmasin. Turnamen ini berlangsung pada tanggal 29 September - 10 Oktober 2025 di Don Bosco Arena Banjarmasin.\r\n\r\nHari ini, tim basket putra SMAS Frater Don Bosco Banjarmasin menyerahkan piala secara simbolis kepada pihak sekolah yang diterima oleh Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM. Prestasi ini menunjukkan kemampuan dan semangat tim basket putra (A) SMAS Frater Don Bosco Banjarmasin.', '2025-11-17 13:51:17', 'Administrator Utama', 'Prestasi', '1763383877_353.png');

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
(19, 3, 'album_3_1764250688_2.png');

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
(3, 'Tim Dance SMAS Frater Don Bosco Banjarmasin Raih Juara 2 Youth Fest Banjarmasin 2025', 'Banjarmasin, Senin (10/11/2025) - Tim Dance SMAS Frater Don Bosco Banjarmasin, Donbosco Crew, kembali menunjukkan prestasi gemilang dengan meraih juara 2 dalam perlombaan dance Youth Fest Banjarmasin 2025, yang diadakan pada hari Jumat, 7/11/2025 oleh Pemerintah Kota Banjarmasin. Donbosco Crew kembali membuktikan kemampuan mereka, dan ini merupakan buah dari kerja keras dan dedikasi mereka. Terus berkarya Don Bosco Crew!!', '2025-11-10', NULL, 'Foto');

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
(1, 'SMA Frater Don Bosco Banjarmasin didirikan pada tahun 1958, berdasarkan SK Pendirian U.P. 15/1958/P.N.B, dengan tujuan untuk memberikan pendidikan yang berkualitas, berbasis kasih persaudaraan, dan berlandaskan nilai-nilai keimanan. Sekolah ini dikelola oleh ordo Frater Don Bosco dan telah berperan penting dalam mencetak generasi muda yang berkarakter, berilmu, dan berbudi pekerti. Sebagai sekolah swasta, SMA Frater Don Bosco memiliki akreditasi A dan dikenal dengan komitmennya dalam mengembangkan potensi siswa baik secara akademis maupun non-akademis. Dalam perjalanan sejarahnya, sekolah ini terus berusaha untuk memberikan pendidikan yang menyentuh aspek spiritual, moral, dan intelektual, melalui berbagai program pendidikan yang efektif dan menyenangkan. Sekolah ini juga aktif dalam mempererat kerjasama dengan berbagai pihak terkait, termasuk orang tua, masyarakat, dan lembaga pendidikan lainnya.', 'BERIMAN, BERILMU, BERLANDASKAN KASIH PERSAUDARAAN MENUJU PRIBADI \r\nMANUSIA SEUTUHNYA', 'Dengan penuh rasa syukur, kami menyampaikan terima kasih kepada seluruh warga sekolah serta masyarakat yang telah mendukung terbangunnya lingkungan pendidikan yang semakin maju. Berkat kerja sama dan komitmen bersama, Website sekolah ini\r\n dapat kami perbarui dan kembangkan sehingga mampu menjadi sarana informasi yang lebih lengkap, transparan, dan mudah diakses oleh seluruh pemangku kepentingan.\r\n\r\nDi tengah perkembangan era globalisasi serta kemajuan teknologi informasi yang semakin cepat, keberadaan website sekolah menjadi kebutuhan penting dalam dunia pendidikan. Website ini menjadi ruang publik untuk menyampaikan informasi, perkembangan kegiatan sekolah, prestasi peserta didik, serta berbagai program yang kami jalankan. Dengan demikian, masyarakat dapat mengikuti secara langsung dinamika dan kemajuan yang dicapai oleh SMA Frater Don Bosco Banjarmasin.\r\n\r\nKami mengucapkan apresiasi kepada tim penyusun dan pengelola website yang telah bekerja keras menghadirkan platform ini dengan sebaik-baiknya. Kami menyadari bahwa masih ada banyak hal yang perlu ditingkatkan. Oleh karena itu, kami sangat terbuka terhadap kritik dan saran yang konstruktif dari seluruh civitas akademika maupun masyarakat demi penyempurnaan website sekolah ke depan.\r\n\r\nHarapan kami, website ini dapat menjadi ruang interaksi positif yang menghubungkan sekolah dengan masyarakat luas, mempererat komunikasi, serta menghadirkan manfaat bagi semua pihak yang membutuhkan informasi tentang sekolah. Semoga segala upaya yang kita lakukan bersama membawa kebaikan, kemajuan, dan masa depan yang lebih cerah bagi generasi muda.\r\n\r\nTerima kasih.\r\n\r\nHormat saya,\r\nKepala SMA Frater Don Bosco Banjarmasin', '1. Meningkatkan toleransi hidup beragama.\r\n2. Menyelenggarakan kegiatan keagamaan secara lebih efektif.\r\n3. Meningkatkan budaya disiplin dalam bekerja.\r\n4. Menjalin kerjasama yang erat dengan stakeholders.\r\n5. Melaksanakan kegiatan pembelajaran yang efektif dan menyenangkan.\r\n6. Melakukan supervisi untuk meningkatkan kualitas pembelajaran.\r\n7. Meningkatkan prestasi akademik dan non‑akademik peserta didik.\r\n8. Menghasilkan lulusan yang berkompetisi secara global.\r\n9. Mengembangkan nilai‑nilai kasih dan persaudaraan secara konkret.', 'Kami memiliki Laboratorium Komputer, Perpustakaan Digital, dan Lapangan Olahraga yang luas.', 'poster_1764151376.jpg', 'https://youtu.be/AWyrBXIUE7M?si=3IQhJ2ET-Sdu50uv');

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
(1, 'admin', '$2y$10$QAlLo2MTOmzh0wqKS0W6Pu9I9CFRuSdegddfe9694gzlaFNj67vrO', 'Administrator Utama', 'Super Admin');

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
  ADD PRIMARY KEY (`id_foto`);

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
  MODIFY `id_berita` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galeri_fotos`
--
ALTER TABLE `galeri_fotos`
  MODIFY `id_foto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `galeri_media`
--
ALTER TABLE `galeri_media`
  MODIFY `id_album` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
