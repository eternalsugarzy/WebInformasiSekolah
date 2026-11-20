<?php
require_once 'Database.php';

// Gelombang pendaftaran PPDB: periode pendaftaran dalam satu tahun ajaran
// (mis. Gelombang 1 Jan-Mar, Gelombang 2 Apr-Jun). Pendaftar selalu dipetakan ke
// gelombang berdasarkan tanggal_daftar-nya, sehingga rentang tanggal antar
// gelombang tidak boleh saling tumpang tindih. Gelombang hanya dipakai untuk
// pengelompokan & laporan -- tidak memengaruhi perhitungan SAW.
class GelombangModel extends Database {

    // Semua gelombang beserta jumlah pendaftarnya, terbaru di atas
    public function getAll() {
        $sql = "SELECT g.*, YEAR(g.tanggal_mulai) AS tahun, COUNT(p.id_pendaftar) AS jumlah_pendaftar
                FROM gelombang_ppdb g
                LEFT JOIN pendaftar_ppdb p ON p.id_gelombang = g.id_gelombang
                GROUP BY g.id_gelombang
                ORDER BY g.tanggal_mulai DESC";
        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Gelombang pada tahun tertentu (untuk dropdown filter laporan). null = semua tahun.
    public function getByTahun($tahun = null) {
        $where = "";
        if ($tahun) {
            $where = "WHERE YEAR(tanggal_mulai) = " . intval($tahun);
        }
        $sql = "SELECT *, YEAR(tanggal_mulai) AS tahun FROM gelombang_ppdb $where ORDER BY tanggal_mulai ASC";
        $result = $this->query($sql);
        $data = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getById($id) {
        $id = intval($id);
        $result = $this->query("SELECT * FROM gelombang_ppdb WHERE id_gelombang = $id");
        return $result ? mysqli_fetch_assoc($result) : null;
    }

    // Gelombang yang sedang dibuka hari ini (untuk info di form pendaftaran publik)
    public function getGelombangAktif() {
        $sql = "SELECT * FROM gelombang_ppdb
                WHERE CURDATE() BETWEEN tanggal_mulai AND tanggal_akhir
                ORDER BY tanggal_mulai ASC LIMIT 1";
        $result = $this->query($sql);
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    // Cari gelombang lain yang rentang tanggalnya bertabrakan dengan [mulai, akhir]
    public function cariBentrok($mulai, $akhir, $id_exclude = null) {
        $mulai = $this->escape($mulai);
        $akhir = $this->escape($akhir);
        $sql = "SELECT * FROM gelombang_ppdb
                WHERE tanggal_mulai <= '$akhir' AND tanggal_akhir >= '$mulai'";
        if ($id_exclude) {
            $sql .= " AND id_gelombang <> " . intval($id_exclude);
        }
        $sql .= " LIMIT 1";
        $result = $this->query($sql);
        return ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;
    }

    public function tambah($nama, $mulai, $akhir, $keterangan) {
        $nama = $this->escape($nama);
        $mulai = $this->escape($mulai);
        $akhir = $this->escape($akhir);
        $ket = $this->escape($keterangan);
        $sql = "INSERT INTO gelombang_ppdb (nama_gelombang, tanggal_mulai, tanggal_akhir, keterangan)
                VALUES ('$nama', '$mulai', '$akhir', '$ket')";
        $ok = $this->query($sql);
        if ($ok) $this->sinkronkanPendaftar();
        return $ok;
    }

    public function update($id, $nama, $mulai, $akhir, $keterangan) {
        $id = intval($id);
        $nama = $this->escape($nama);
        $mulai = $this->escape($mulai);
        $akhir = $this->escape($akhir);
        $ket = $this->escape($keterangan);
        $sql = "UPDATE gelombang_ppdb SET
                    nama_gelombang = '$nama', tanggal_mulai = '$mulai',
                    tanggal_akhir = '$akhir', keterangan = '$ket'
                WHERE id_gelombang = $id";
        $ok = $this->query($sql);
        if ($ok) $this->sinkronkanPendaftar();
        return $ok;
    }

    public function hapus($id) {
        $id = intval($id);
        $ok = $this->query("DELETE FROM gelombang_ppdb WHERE id_gelombang = $id");
        if ($ok) $this->sinkronkanPendaftar();
        return $ok;
    }

    // Petakan ulang SEMUA pendaftar ke gelombang sesuai tanggal_daftar-nya.
    // Dipanggil setiap kali data gelombang berubah, supaya pengelompokan selalu
    // konsisten dengan rentang tanggal yang berlaku (pendaftar di luar semua
    // rentang gelombang -> NULL / "Tanpa Gelombang").
    public function sinkronkanPendaftar() {
        $sql = "UPDATE pendaftar_ppdb p
                LEFT JOIN gelombang_ppdb g
                    ON DATE(p.tanggal_daftar) BETWEEN g.tanggal_mulai AND g.tanggal_akhir
                SET p.id_gelombang = g.id_gelombang";
        return $this->query($sql);
    }
}
?>
