<?php
require_once 'Database.php';

// Modul Prestasi Siswa (akademik & non-akademik).
// "Siswa" = pendaftar PPDB yang sudah DITERIMA dan sudah DAFTAR ULANG, sehingga
// data prestasi tetap terhubung dengan riwayat penerimaannya (PPDB/SAW).
class PrestasiModel extends Database {

    const JENIS = ['Akademik', 'Non-Akademik'];
    const TINGKAT = ['Sekolah', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'Nasional', 'Internasional'];
    const KELAS = ['X', 'XI', 'XII'];
    const STATUS = ['Menunggu', 'Terverifikasi', 'Ditolak'];

    // Siswa aktif (untuk dropdown pilih siswa di form prestasi)
    public function getSiswaAktif() {
        $sql = "SELECT id_pendaftar, nama_lengkap, nisn, jalur_seleksi, YEAR(tanggal_daftar) AS angkatan
                FROM pendaftar_ppdb
                WHERE status_seleksi = 'Diterima' AND status_daftar_ulang = 'Daftar Ulang'
                ORDER BY nama_lengkap ASC";
        return $this->fetchAll($sql);
    }

    public function isSiswaAktif($id_pendaftar) {
        $id = intval($id_pendaftar);
        $res = $this->query("SELECT 1 FROM pendaftar_ppdb
                             WHERE id_pendaftar = $id AND status_seleksi = 'Diterima' AND status_daftar_ulang = 'Daftar Ulang'");
        return $res && mysqli_num_rows($res) > 0;
    }

    // Filter: tahun, jenis, tingkat, kelas, status, q (cari nama siswa / nama prestasi)
    private function buildWhere($filters) {
        $w = "WHERE 1=1";
        if (!empty($filters['tahun']))   $w .= " AND ps.tahun = " . intval($filters['tahun']);
        if (!empty($filters['jenis']) && in_array($filters['jenis'], self::JENIS, true))
            $w .= " AND ps.jenis = '" . $this->escape($filters['jenis']) . "'";
        if (!empty($filters['tingkat']) && in_array($filters['tingkat'], self::TINGKAT, true))
            $w .= " AND ps.tingkat = '" . $this->escape($filters['tingkat']) . "'";
        if (!empty($filters['kelas']) && in_array($filters['kelas'], self::KELAS, true))
            $w .= " AND ps.kelas = '" . $this->escape($filters['kelas']) . "'";
        if (!empty($filters['status']) && in_array($filters['status'], self::STATUS, true))
            $w .= " AND ps.status_verifikasi = '" . $this->escape($filters['status']) . "'";
        if (!empty($filters['q'])) {
            $q = $this->escape($filters['q']);
            $w .= " AND (p.nama_lengkap LIKE '%$q%' OR ps.nama_prestasi LIKE '%$q%' OR p.nisn LIKE '%$q%')";
        }
        return $w;
    }

    // Urutan tingkat dari tertinggi (Internasional) ke terendah (Sekolah)
    private function orderTingkat() {
        return "FIELD(ps.tingkat, 'Internasional', 'Nasional', 'Provinsi', 'Kabupaten/Kota', 'Kecamatan', 'Sekolah')";
    }

    public function getAll($filters = []) {
        $where = $this->buildWhere($filters);
        $sql = "SELECT ps.*, p.nama_lengkap, p.nisn, p.jalur_seleksi
                FROM prestasi_siswa ps
                JOIN pendaftar_ppdb p ON p.id_pendaftar = ps.id_pendaftar
                $where
                ORDER BY ps.tahun DESC, " . $this->orderTingkat() . ", p.nama_lengkap ASC";
        return $this->fetchAll($sql);
    }

    public function getById($id) {
        $id = intval($id);
        $res = $this->query("SELECT ps.*, p.nama_lengkap, p.nisn
                             FROM prestasi_siswa ps
                             JOIN pendaftar_ppdb p ON p.id_pendaftar = ps.id_pendaftar
                             WHERE ps.id_prestasi = $id");
        return $res ? mysqli_fetch_assoc($res) : null;
    }

    // Ringkasan jumlah prestasi per tingkat (mis. 5 Nasional, 10 Provinsi) dan per jenis
    public function getRingkasan($filters = []) {
        $where = $this->buildWhere($filters);
        $per_tingkat = array_fill_keys(array_reverse(self::TINGKAT), 0);
        $per_jenis = array_fill_keys(self::JENIS, 0);

        $res = $this->query("SELECT ps.tingkat, ps.jenis, COUNT(*) AS jumlah
                             FROM prestasi_siswa ps
                             JOIN pendaftar_ppdb p ON p.id_pendaftar = ps.id_pendaftar
                             $where
                             GROUP BY ps.tingkat, ps.jenis");
        $total = 0;
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $n = (int) $row['jumlah'];
                $per_tingkat[$row['tingkat']] += $n;
                $per_jenis[$row['jenis']] += $n;
                $total += $n;
            }
        }

        $res = $this->query("SELECT COUNT(DISTINCT ps.id_pendaftar) AS siswa
                             FROM prestasi_siswa ps
                             JOIN pendaftar_ppdb p ON p.id_pendaftar = ps.id_pendaftar
                             $where");
        $jumlah_siswa = $res ? (int) mysqli_fetch_assoc($res)['siswa'] : 0;

        return [
            'total'        => $total,
            'jumlah_siswa' => $jumlah_siswa,
            'per_tingkat'  => $per_tingkat,
            'per_jenis'    => $per_jenis,
        ];
    }

    public function getDaftarTahun() {
        $rows = $this->fetchAll("SELECT DISTINCT tahun FROM prestasi_siswa ORDER BY tahun DESC");
        return array_column($rows, 'tahun');
    }

    public function tambah($d) {
        $sql = "INSERT INTO prestasi_siswa
                    (id_pendaftar, kelas, nama_prestasi, jenis, tingkat, peringkat, penyelenggara, tahun,
                     bukti_sertifikat, status_verifikasi, catatan_verifikasi)
                VALUES (" . intval($d['id_pendaftar']) . ",
                    '" . $this->escape($d['kelas']) . "',
                    '" . $this->escape($d['nama_prestasi']) . "',
                    '" . $this->escape($d['jenis']) . "',
                    '" . $this->escape($d['tingkat']) . "',
                    '" . $this->escape($d['peringkat']) . "',
                    '" . $this->escape($d['penyelenggara']) . "',
                    " . intval($d['tahun']) . ",
                    " . ($d['bukti_sertifikat'] !== null ? "'" . $this->escape($d['bukti_sertifikat']) . "'" : "NULL") . ",
                    '" . $this->escape($d['status_verifikasi']) . "',
                    '" . $this->escape($d['catatan_verifikasi']) . "')";
        return $this->query($sql);
    }

    // $d['bukti_sertifikat'] = null artinya sertifikat tidak diganti
    public function update($id, $d) {
        $id = intval($id);
        $sql = "UPDATE prestasi_siswa SET
                    id_pendaftar = " . intval($d['id_pendaftar']) . ",
                    kelas = '" . $this->escape($d['kelas']) . "',
                    nama_prestasi = '" . $this->escape($d['nama_prestasi']) . "',
                    jenis = '" . $this->escape($d['jenis']) . "',
                    tingkat = '" . $this->escape($d['tingkat']) . "',
                    peringkat = '" . $this->escape($d['peringkat']) . "',
                    penyelenggara = '" . $this->escape($d['penyelenggara']) . "',
                    tahun = " . intval($d['tahun']) . ",
                    status_verifikasi = '" . $this->escape($d['status_verifikasi']) . "',
                    catatan_verifikasi = '" . $this->escape($d['catatan_verifikasi']) . "'";
        if ($d['bukti_sertifikat'] !== null) {
            $sql .= ", bukti_sertifikat = '" . $this->escape($d['bukti_sertifikat']) . "'";
        }
        $sql .= " WHERE id_prestasi = $id";
        return $this->query($sql);
    }

    public function verifikasi($id, $status, $catatan) {
        if (!in_array($status, self::STATUS, true)) return false;
        $id = intval($id);
        $sql = "UPDATE prestasi_siswa SET
                    status_verifikasi = '" . $this->escape($status) . "',
                    catatan_verifikasi = '" . $this->escape($catatan) . "'
                WHERE id_prestasi = $id";
        return $this->query($sql);
    }

    public function hapus($id) {
        $id = intval($id);
        return $this->query("DELETE FROM prestasi_siswa WHERE id_prestasi = $id");
    }

    private function fetchAll($sql) {
        $res = $this->query($sql);
        $data = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $data[] = $row;
            }
        }
        return $data;
    }
}
?>
