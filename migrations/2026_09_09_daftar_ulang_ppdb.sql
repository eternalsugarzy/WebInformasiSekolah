-- Migrasi: Fitur Daftar Ulang PPDB
-- Tujuan: menghubungkan hasil seleksi (status_seleksi = 'Diterima') dengan proses
-- penerimaan yang sesungguhnya. Status 'Diterima' dari SAW baru menandakan LOLOS
-- SELEKSI, belum tentu benar-benar akan bersekolah di sini -- siswa masih bisa
-- mengundurkan diri, dan sekolah butuh mencatat itu supaya kuota yang kosong bisa
-- diisi dari daftar Cadangan berikutnya.

ALTER TABLE `pendaftar_ppdb`
  ADD COLUMN `status_daftar_ulang` enum('Belum Konfirmasi','Daftar Ulang','Mengundurkan Diri') NOT NULL DEFAULT 'Belum Konfirmasi' AFTER `status_seleksi`,
  ADD COLUMN `tanggal_daftar_ulang` datetime DEFAULT NULL AFTER `status_daftar_ulang`,
  ADD COLUMN `catatan_daftar_ulang` varchar(255) DEFAULT NULL AFTER `tanggal_daftar_ulang`;

-- Tambah jenis histori baru khusus perubahan status Daftar Ulang / promosi Cadangan,
-- supaya jelas terpisah dari jenis 'Status Manual' yang sudah ada.
ALTER TABLE `histori_seleksi_saw`
  MODIFY COLUMN `jenis_perubahan` enum('Bobot SAW','Nilai Pendaftar','Kuota Kelulusan','Status Manual','Daftar Ulang') NOT NULL;
