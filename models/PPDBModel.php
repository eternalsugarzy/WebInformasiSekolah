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

    // [BARU] Ambil 1 Data PPDB by ID
    public function getPPDBById($id) {
        $id = intval($id);
        $sql = "SELECT * FROM info_ppdb WHERE id_info = $id";
        $query = $this->query($sql);
        return mysqli_fetch_assoc($query);
    }

    // [BARU] Update Data PPDB
    public function updatePPDB($id, $jenis, $isi, $tgl_mulai, $tgl_akhir, $link) {
        $sql = "UPDATE info_ppdb SET 
                jenis_informasi = '$jenis', 
                isi_detail = '$isi', 
                tanggal_mulai = '$tgl_mulai', 
                tanggal_akhir = '$tgl_akhir', 
                tautan_formulir = '$link' 
                WHERE id_info = $id";
        return $this->query($sql);
    }
}
?>