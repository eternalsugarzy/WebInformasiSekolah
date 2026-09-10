-- Migrasi: Histori Perubahan Parameter Seleksi SAW
-- Tujuan: saat sidang kelulusan, panitia kadang perlu mengubah bobot kriteria,
-- nilai pendaftar, kuota, atau status kelulusan secara manual. Tabel ini mencatat
-- SIAPA yang mengubah, KAPAN, APA yang diubah, dan nilai lama -> nilai baru --
-- supaya sekolah punya jejak audit yang bisa dipertanggungjawabkan.

CREATE TABLE IF NOT EXISTS `histori_seleksi_saw` (
  `id_histori` int NOT NULL AUTO_INCREMENT,
  `id_admin` int DEFAULT NULL,
  `nama_admin` varchar(100) NOT NULL,
  `jenis_perubahan` enum('Bobot SAW','Nilai Pendaftar','Kuota Kelulusan','Status Manual') NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `data_lama` text,
  `data_baru` text,
  `waktu_perubahan` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_histori`),
  KEY `idx_histori_admin` (`id_admin`),
  KEY `idx_histori_waktu` (`waktu_perubahan`),
  KEY `idx_histori_jenis` (`jenis_perubahan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
