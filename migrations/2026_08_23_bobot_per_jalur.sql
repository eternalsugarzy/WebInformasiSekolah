-- Migrasi: Bobot Kriteria SAW per Jalur Seleksi
-- Tujuan: agar setiap jalur (Zonasi, Prestasi, Afirmasi) bisa punya bobot kriteria
-- sendiri-sendiri, sehingga pemilihan jalur benar-benar memengaruhi hasil
-- perhitungan SAW (tidak sekadar label kosmetik).
--
-- Tabel kriteria_saw tetap dipakai sebagai definisi kriteria (kode, nama, tipe)
-- dan sebagai bobot fallback/default jika suatu jalur belum dikonfigurasi.

CREATE TABLE IF NOT EXISTS `bobot_jalur` (
  `id_bobot_jalur` int NOT NULL AUTO_INCREMENT,
  `jalur_seleksi` enum('Prestasi','Zonasi','Afirmasi') NOT NULL,
  `id_kriteria` int NOT NULL,
  `bobot` float NOT NULL,
  PRIMARY KEY (`id_bobot_jalur`),
  UNIQUE KEY `uniq_jalur_kriteria` (`jalur_seleksi`, `id_kriteria`),
  KEY `fk_bobot_jalur_kriteria` (`id_kriteria`),
  CONSTRAINT `fk_bobot_jalur_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria_saw` (`id_kriteria`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Seed bobot awal per jalur (Admin bisa mengubahnya lagi lewat menu Bobot Kriteria SAW):
--  - Zonasi   : Jarak Rumah (C4) diprioritaskan 80%
--  - Prestasi : Prestasi/Sertifikat (C3) diprioritaskan 80%
--  - Afirmasi : bobot seimbang di semua kriteria (25% masing-masing)
INSERT INTO `bobot_jalur` (`jalur_seleksi`, `id_kriteria`, `bobot`) VALUES
('Zonasi',   1, 10), ('Zonasi',   2, 5),  ('Zonasi',   3, 5),  ('Zonasi',   4, 80),
('Prestasi', 1, 10), ('Prestasi', 2, 5),  ('Prestasi', 3, 80), ('Prestasi', 4, 5),
('Afirmasi', 1, 25), ('Afirmasi', 2, 25), ('Afirmasi', 3, 25), ('Afirmasi', 4, 25)
ON DUPLICATE KEY UPDATE bobot = VALUES(bobot);
