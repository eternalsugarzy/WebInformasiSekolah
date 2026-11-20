-- Migrasi: Modul Prestasi Siswa (Revisi Dosen Penguji 3 - Laporan Data Siswa Berprestasi)
--
-- "Siswa" pada sistem ini adalah pendaftar PPDB yang sudah DITERIMA dan sudah
-- melakukan DAFTAR ULANG (status_seleksi = 'Diterima' AND status_daftar_ulang =
-- 'Daftar Ulang'). Karena itu prestasi direlasikan ke pendaftar_ppdb, sehingga
-- data akademik siswa tetap terhubung dengan riwayat penerimaannya (PPDB/SAW).

CREATE TABLE IF NOT EXISTS `prestasi_siswa` (
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
  KEY `idx_prestasi_filter` (`tahun`, `jenis`, `tingkat`),
  CONSTRAINT `fk_prestasi_pendaftar` FOREIGN KEY (`id_pendaftar`) REFERENCES `pendaftar_ppdb` (`id_pendaftar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
