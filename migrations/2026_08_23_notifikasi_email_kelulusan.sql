-- Migrasi: Notifikasi Email Hasil Kelulusan PPDB
-- Tujuan: melacak status pengiriman email notifikasi kelulusan ke siswa,
-- memakai email_siswa yang diisi di formulir pendaftaran.

ALTER TABLE `pendaftar_ppdb`
  ADD COLUMN `status_email_notifikasi` enum('Belum Terkirim','Terkirim','Gagal') NOT NULL DEFAULT 'Belum Terkirim' AFTER `status_seleksi`,
  ADD COLUMN `status_seleksi_saat_email` enum('Menunggu','Diterima','Ditolak','Cadangan') DEFAULT NULL AFTER `status_email_notifikasi`,
  ADD COLUMN `email_terkirim_at` datetime DEFAULT NULL AFTER `status_seleksi_saat_email`;

CREATE TABLE IF NOT EXISTS `log_notifikasi_email` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `id_pendaftar` int NOT NULL,
  `email_tujuan` varchar(100) NOT NULL,
  `status` enum('Terkirim','Gagal') NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `dikirim_pada` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `fk_log_notifikasi_pendaftar` (`id_pendaftar`),
  CONSTRAINT `fk_log_notifikasi_pendaftar` FOREIGN KEY (`id_pendaftar`) REFERENCES `pendaftar_ppdb` (`id_pendaftar`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
