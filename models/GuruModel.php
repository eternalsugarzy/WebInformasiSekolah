<?php
require_once 'Database.php';

class GuruModel extends Database {

    // (Fungsi countGuru yang lama biarkan saja)
    public function countGuru() {
        $sql = "SELECT COUNT(*) as total FROM guru_staf";
        $query = $this->query($sql);
        $data = mysqli_fetch_assoc($query);
        return $data['total'];
    }

    // [BARU] Ambil Semua Guru
    public function getAllGuru() {
        $sql = "SELECT * FROM guru_staf ORDER BY nama_lengkap ASC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // [BARU] Ambil 1 Guru by ID
    public function getGuruById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM guru_staf WHERE id_guru = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }
}
?>