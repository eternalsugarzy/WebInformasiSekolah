-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2025 at 03:39 AM
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
(1, 'Tim Futsal SMA Maju Jaya Raih Juara 1 Tingkat Kota', 'Tim futsal kebanggaan sekolah kita kembali menorehkan prestasi gemilang dengan menjadi juara pertama dalam turnamen antar SMA se-Kota tahun ini. Pertandingan final yang berlangsung sengit melawan SMA Harapan Bangsa berakhir dengan skor 3-1. Kepala sekolah menyampaikan apresiasi setinggi-tingginya kepada para atlet dan pelatih atas kerja keras mereka.', '2025-10-15 08:30:00', 'Admin Olahraga', 'Prestasi', 'juara_futsal.jpg'),
(2, 'Peringatan Hari Batik Nasional Berlangsung Meriah', 'Seluruh warga sekolah, mulai dari siswa, guru, hingga staf tata usaha kompak mengenakan batik dalam rangka memperingati Hari Batik Nasional. Acara dimeriahkan dengan lomba peragaan busana batik antar kelas dan pameran seni membatik hasil karya siswa kelas XI. Kegiatan ini bertujuan untuk menanamkan rasa cinta terhadap warisan budaya bangsa.', '2025-10-02 09:00:00', 'Humas Sekolah', 'Kegiatan Sekolah', 'hari_batik.jpg'),
(3, 'Jadwal Ujian Tengah Semester Ganjil Tahun Ajaran 2025/2026', 'Diberitahukan kepada seluruh siswa kelas X, XI, dan XII bahwa Ujian Tengah Semester (UTS) Ganjil akan dilaksanakan mulai tanggal 20 Oktober hingga 25 Oktober 2025. Diharapkan seluruh siswa mempersiapkan diri dengan baik, menjaga kesehatan, dan melengkapi persyaratan administrasi sebelum ujian berlangsung. Jadwal lengkap mata pelajaran dapat dilihat di papan pengumuman.', '2025-10-01 10:15:00', 'Kurikulum', 'Akademik', 'ujian_sekolah.jpg');

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
  MODIFY `id_berita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeri_media`
--
ALTER TABLE `galeri_media`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guru_staf`
--
ALTER TABLE `guru_staf`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `info_ppdb`
--
ALTER TABLE `info_ppdb`
  MODIFY `id_info` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
