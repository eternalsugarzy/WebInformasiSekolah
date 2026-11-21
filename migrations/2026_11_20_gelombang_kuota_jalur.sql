-- Migrasi: Gelombang Pendaftaran & Kuota Kelulusan per Jalur Seleksi
-- (Revisi Dosen Penguji 3 - Laporan Penerimaan PPDB)
--
-- 1. Gelombang pendaftaran: periode pendaftaran dalam satu tahun ajaran
--    (mis. Gelombang 1 Jan-Mar, Gelombang 2 Apr-Jun). Pendaftar otomatis masuk
--    gelombang yang rentang tanggalnya mencakup tanggal_daftar. Gelombang hanya
--    dipakai untuk pengelompokan & laporan -- proses seleksi SAW tidak berubah.
-- 2. Kuota per jalur: kuota Diterima/Cadangan kini diatur per jalur seleksi
--    (Zonasi/Prestasi/Afirmasi), sehingga laporan dapat menunjukkan apakah kuota
--    tiap jalur terpenuhi atau masih tersisa. Kelulusan ditentukan dari peringkat
--    SAW DI DALAM jalurnya masing-masing (kolom nilai_tesmasuk.peringkat_jalur).

-- ---------- 1. Gelombang Pendaftaran ----------
CREATE TABLE IF NOT EXISTS `gelombang_ppdb` (
  `id_gelombang` int NOT NULL AUTO_INCREMENT,
  `nama_gelombang` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_akhir` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_gelombang`),
  KEY `idx_gelombang_periode` (`tanggal_mulai`, `tanggal_akhir`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

ALTER TABLE `pendaftar_ppdb`
  ADD COLUMN `id_gelombang` int DEFAULT NULL AFTER `jalur_seleksi`,
  ADD KEY `fk_pendaftar_gelombang` (`id_gelombang`),
  ADD CONSTRAINT `fk_pendaftar_gelombang` FOREIGN KEY (`id_gelombang`) REFERENCES `gelombang_ppdb` (`id_gelombang`) ON DELETE SET NULL ON UPDATE CASCADE;

-- Seed gelombang awal tahun 2026 (Admin bisa mengubahnya lewat menu Gelombang PPDB)
INSERT INTO `gelombang_ppdb` (`nama_gelombang`, `tanggal_mulai`, `tanggal_akhir`, `keterangan`) VALUES
('Gelombang 1', '2026-01-01', '2026-03-31', 'Pendaftaran awal'),
('Gelombang 2', '2026-04-01', '2026-06-30', 'Pendaftaran lanjutan / pemenuhan sisa kuota');

-- Isi gelombang untuk pendaftar lama berdasarkan tanggal_daftar-nya
UPDATE `pendaftar_ppdb` p
JOIN `gelombang_ppdb` g ON DATE(p.tanggal_daftar) BETWEEN g.tanggal_mulai AND g.tanggal_akhir
SET p.id_gelombang = g.id_gelombang
WHERE p.id_gelombang IS NULL;

-- ---------- 2. Kuota Kelulusan per Jalur ----------
CREATE TABLE IF NOT EXISTS `kuota_jalur` (
  `jalur_seleksi` enum('Prestasi','Zonasi','Afirmasi') NOT NULL,
  `kuota_diterima` int NOT NULL DEFAULT '0',
  `kuota_cadangan` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`jalur_seleksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Zonasi memakai kuota lama (setting_ppdb) supaya hasil seleksi data yang sudah ada
-- (semuanya jalur Zonasi) tetap sama. Prestasi & Afirmasi diberi kuota awal.
INSERT INTO `kuota_jalur` (`jalur_seleksi`, `kuota_diterima`, `kuota_cadangan`) VALUES
('Zonasi', 5, 1),
('Prestasi', 3, 1),
('Afirmasi', 2, 1)
ON DUPLICATE KEY UPDATE kuota_diterima = VALUES(kuota_diterima), kuota_cadangan = VALUES(kuota_cadangan);

-- Peringkat SAW di dalam jalur seleksi masing-masing (dasar penentuan kelulusan per jalur).
-- Kolom `peringkat` yang lama tetap ada sebagai peringkat keseluruhan.
ALTER TABLE `nilai_tesmasuk`
  ADD COLUMN `peringkat_jalur` int DEFAULT NULL AFTER `peringkat`;

UPDATE `nilai_tesmasuk` n
JOIN (
    SELECT n2.id_nilai_tes,
           ROW_NUMBER() OVER (PARTITION BY p.jalur_seleksi ORDER BY n2.nilai_akhir_saw DESC) AS rk
    FROM `nilai_tesmasuk` n2
    JOIN `pendaftar_ppdb` p ON p.id_pendaftar = n2.id_pendaftar
    WHERE n2.nilai_akhir_saw IS NOT NULL
) r ON r.id_nilai_tes = n.id_nilai_tes
SET n.peringkat_jalur = r.rk;
