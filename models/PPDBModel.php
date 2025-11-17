<?php
require_once 'Database.php';

class PPDBModel extends Database {

    // Ambil Semua Data PPDB
    public function getAllPPDB() {
        $sql = "SELECT * FROM info_ppdb ORDER BY id_info DESC";
        $query = $this->query($sql);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // Hapus Data
    public function hapusPPDB($id) {
        $id = intval($id);
        $sql = "DELETE FROM info_ppdb WHERE id_info = $id";
        return $this->query($sql);
    }
}
?>