-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2025 at 05:25 AM
-- Server version: 10.4.25-MariaDB
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
  `id_berita` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten_lengkap` text NOT NULL,
  `tanggal_publikasi` datetime NOT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `kategori` varchar(50) NOT NULL,
  `gambar_utama` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_foto` int(11) NOT NULL,
  `id_album` int(11) NOT NULL,
  `file_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri_fotos`
--

INSERT INTO `galeri_fotos` (`id_foto`, `id_album`, `file_foto`) VALUES
(1, 2, 'album_2_1763525006_0.jpg'),
(2, 2, 'album_2_1763525006_1.jpg'),
(3, 2, 'album_2_1763525006_2.jpg'),
(4, 2, 'album_2_1763525006_3.jpg'),
(5, 2, 'album_2_1763525006_4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `galeri_media`
--

CREATE TABLE `galeri_media` (
  `id_album` int(11) NOT NULL,
  `judul_album` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_event` date NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `tipe_media` enum('Foto','Video') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `galeri_media`
--

INSERT INTO `galeri_media` (`id_album`, `judul_album`, `deskripsi`, `tanggal_event`, `file_path`, `tipe_media`) VALUES
(1, 'Tim basket putra SMAS Frater Don Bosco Banjarmasin  juara 3 pada Kanaan Basketball Competition', 'Banjarmasin, Selasa (26/10/2025) - Tim basket putra SMAS Frater Don Bosco Banjarmasin kembali menunjukkan prestasi gemilang dengan meraih juara 3 pada Kanaan Basketball Competition, perebutan juara 3 diselenggarakan pada hari Minggu, 26 Oktober 2025. Pada hari ini, piala diserahkan secara simbolis kepada pihak sekolah, yang diserahakan kepada Fr. Danny Arifin D. L., S. Ag., M. Pd., CMM, selaku kepala sekolah. SMAS Frater Don Bosco Banjarmasin bangga dengan prestasi yang telah diraih.', '2025-11-17', '1763379679_715.png', 'Foto'),
(2, 'Testing Azzah', 'Testing', '2025-11-19', '', 'Foto');

-- --------------------------------------------------------

--
-- Table structure for table `guru_staf`
--

CREATE TABLE `guru_staf` (
  `id_guru` int(11) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `bidang_studi` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru_staf`
--

INSERT INTO `guru_staf` (`id_guru`, `nip`, `nama_lengkap`, `jabatan`, `bidang_studi`, `email`, `foto`) VALUES
(1, '212021212102', 'Saids', 'Guru Mapel', 'Penjaskes', 'said@mail.com', '1763386379_741.jpg'),
(2, '2210010582', 'DR. Prof Muhammad Irwan Firmanto, S.Kom., M.Kom', 'Guru Mapel', 'Cyber Security', 'muhammadirwan@mail.com', '1763435608_943.jpg'),
(3, '198702212010012029', 'Almas', 'Guru Mapel', 'Matematika', 'almas@mail.com', '1763386267_931.jpg'),
(4, '197910181999121001', 'Ikiits', 'Guru Mapel', 'Bahasa Jorongs', 'ikits@mail.com', '1763386363_603.jpg'),
(5, '2210010300', 'Muhammad Saputra Arjunaidy, S.Kom', 'Guru Mapel', 'Teknik Informatika', 'putra@mail.com', '1763389244_269.jpg'),
(7, '51515151555551', 'nur', 'Kepala Sekolah', '', 'nur@mail.com', '1763389944_546.jpg'),
(8, '41414141414444', 'raihan', 'Wali Kelas', '', 'raihan@mail.com', '1763390082_457.png');

-- --------------------------------------------------------

--
-- Table structure for table `info_ppdb`
--

CREATE TABLE `info_ppdb` (
  `id_info` int(11) NOT NULL,
  `jenis_informasi` varchar(100) NOT NULL,
  `isi_detail` text NOT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `tautan_formulir` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `id_pengumuman` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `isi_pengumuman` text NOT NULL,
  `tanggal_penting` date DEFAULT NULL,
  `status` enum('Aktif','Arsip') NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id_pengumuman`, `judul`, `isi_pengumuman`, `tanggal_penting`, `status`) VALUES
(2, 'Bayar SPP Jangan Telat', 'SPP', '2025-11-17', 'Aktif'),
(3, 'Pelaksanaan Tes Kemampuan Akademik (TKA)', 'TKA ini akan berlangsung selama 4 hari, dari tanggal 3 s.d. 6 November 2025. Terbagi menjadi dua gelombang, masing-masing gelombang terdiri 3 sesi. Gelombang 1 dilaksanakan pada tanggal 3 dan 4 sedangkan gelombang 2 dilaksanakan pada tanggal 5 dan 6. Pada hari pertama diujikan mata pelajaran wajib, Bahasa Indonesia, Matematika, dan Bahasa Inggris. Sedangkan di hari kedua diujikan mata pelajaran pilihan.', '2025-11-17', 'Aktif'),
(4, 'Pemilihan Ketua OSIS SMAS Frater Don Bosco Banjarmasin Periode 2025-2026', 'Banjarmasin, Selasa (11/11/2025) - Pada hari ini, SMAS Frater Don Bosco Banjarmasin melaksanakan pemilihan Ketua OSIS periode 2025-2026. Dua pasangan calon (Paslon) ketua dan wakil ketua OSIS yang maju dalam pemilihan ini adalah Paslon 1 yaitu Fatricia Lou Wey (11-B) dan Samuel Agustino (11-C) kemudian Paslon 2 yaitu Ajeng Tri Yusanti (11-B) sebagai calon Ketua OSIS dan Aulia N. Nguwung (11-D)\r\n\r\nPemilihan dimulai dengan debat yang dilaksanakan di lapangan SMAS Frater Don Bosco Banjarmasin, yang dihadiri oleh Ibu Katarina Dewi Wisatawati, S.Pd., Bapak Martinus, S.Pd., dan Ibu Dra. Angelina Sri Widiyati sebagai panelis. Debat ini menjadi ajang bagi kedua paslon untuk menyampaikan visi dan misi mereka.\r\n\r\nSetelah proses debat, pemilihan berlangsung secara tertib dan hasilnya adalah Paslon 2, Ajeng Tri Yusanti dan Aulia N. Nguwung, terpilih menjadi Ketua OSIS dan Wakil Ketua OSIS periode 2025-2026 dengan total 318 suara. Sementara itu, Paslon 1, Fatricia Lou Wey dan Samuel Agustino, memperoleh 163 suara.\r\n\r\nSelamat kepada Ajeng Tri Yusanti dan Aulia N. Nguwung atas terpilihnya sebagai Ketua OSIS dan Wakil Ketua OSIS periode 2025-2026! Semoga dapat menjalankan tugas dengan baik dan membawa OSIS SMAS Frater Don Bosco Banjarmasin terus berkembang, bergerak dan berdampak.', '2025-11-17', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `level` enum('Super Admin','Content Writer') NOT NULL DEFAULT 'Content Writer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `galeri_fotos`
--
ALTER TABLE `galeri_fotos`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galeri_media`
--
ALTER TABLE `galeri_media`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guru_staf`
--
ALTER TABLE `guru_staf`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `info_ppdb`
--
ALTER TABLE `info_ppdb`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
