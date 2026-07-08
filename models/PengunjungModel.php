<?php
require_once 'Database.php';

class PengunjungModel extends Database {

    // Catat 1 kunjungan untuk hari ini (dipanggil otomatis di setiap halaman publik)
    public function catatKunjungan() {
        $sql = "INSERT INTO statistik_pengunjung (tanggal, jumlah_kunjungan) 
                VALUES (CURDATE(), 1) 
                ON DUPLICATE KEY UPDATE jumlah_kunjungan = jumlah_kunjungan + 1";
        return $this->query($sql);
    }

    // Total kunjungan sepanjang waktu
    public function getTotalPengunjung() {
        $sql = "SELECT SUM(jumlah_kunjungan) as total FROM statistik_pengunjung";
        $row = mysqli_fetch_assoc($this->query($sql));
        return $row['total'] ? (int) $row['total'] : 0;
    }

    // Kunjungan hari ini
    public function getPengunjungHariIni() {
        $sql = "SELECT jumlah_kunjungan FROM statistik_pengunjung WHERE tanggal = CURDATE()";
        $row = mysqli_fetch_assoc($this->query($sql));
        return $row ? (int) $row['jumlah_kunjungan'] : 0;
    }

    // Tren kunjungan N hari terakhir (untuk grafik) -- hari tanpa kunjungan tetap tampil sbg 0
    public function getTrenPengunjung($hari = 14) {
        $hari = intval($hari);
        $sql = "SELECT tanggal, jumlah_kunjungan FROM statistik_pengunjung 
                WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL $hari DAY)
                ORDER BY tanggal ASC";
        $result = $this->query($sql);

        $data_db = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data_db[$row['tanggal']] = (int) $row['jumlah_kunjungan'];
        }

        // Bangun rentang tanggal lengkap biar hari tanpa kunjungan tetap muncul sbg 0
        $tren = [];
        for ($i = $hari; $i >= 0; $i--) {
            $tgl = date('Y-m-d', strtotime("-$i days"));
            $tren[] = [
                'tanggal' => $tgl,
                'jumlah'  => isset($data_db[$tgl]) ? $data_db[$tgl] : 0,
            ];
        }
        return $tren;
    }
}
?>