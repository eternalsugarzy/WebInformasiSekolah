<?php
// Mencegah error jika class Database sudah dipanggil di tempat lain
require_once 'Database.php';

class SawModel extends Database {

    // ==========================================
    // 1. BAGIAN PENGATURAN KRITERIA & BOBOT
    // ==========================================

    // Mengambil semua data kriteria SAW
    public function getKriteria() {
        $sql = "SELECT * FROM kriteria_saw ORDER BY id_kriteria ASC";
        $result = $this->query($sql);
        
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Mengupdate persentase bobot kriteria (Dinamis oleh Admin)
    public function updateBobotKriteria($id_kriteria, $bobot_baru) {
        $conn = $this->koneksi;
        $id = mysqli_real_escape_string($conn, $id_kriteria);
        $bobot = mysqli_real_escape_string($conn, $bobot_baru);

        $sql = "UPDATE kriteria_saw SET bobot = '$bobot' WHERE id_kriteria = '$id'";
        return $this->query($sql);
    }

    // ==========================================
    // 2. BAGIAN INPUT NILAI PENDAFTAR
    // ==========================================

    // Mengambil data pendaftar digabung (JOIN) dengan nilai tes-nya jika ada
    public function getPendaftarDanNilai() {
        // Hapus p.asal_sekolah dari daftar kolom di bawah ini
       $sql = "SELECT
            p.*,
            n.id_nilai_tes,
            n.nilai_raport,
            n.nilai_tes,
            n.nilai_prestasi,
            n.jarak_rumah,
            n.nilai_akhir_saw,
            n.peringkat
        FROM pendaftar_ppdb p
        LEFT JOIN nilai_tesmasuk n
        ON p.id_pendaftar = n.id_pendaftar
        ORDER BY n.peringkat ASC";
        
        $result = $this->query($sql);
        $data = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // Menyimpan atau Mengupdate nilai inputan dari Admin
    public function simpanNilaiPendaftar($id_pendaftar, $raport, $tes, $prestasi, $jarak) {
        $conn = $this->koneksi;
        
        // Sanitasi data untuk keamanan SQL Injection
        $id = mysqli_real_escape_string($conn, $id_pendaftar);
        $r = mysqli_real_escape_string($conn, $raport);
        $t = mysqli_real_escape_string($conn, $tes);
        $p = mysqli_real_escape_string($conn, $prestasi);
        $j = mysqli_real_escape_string($conn, $jarak);

        // Cek apakah pendaftar ini sudah pernah diinput nilainya?
        $cek_sql = "SELECT id_nilai_tes FROM nilai_tesmasuk WHERE id_pendaftar = '$id'";
        $cek_result = $this->query($cek_sql);

        if (mysqli_num_rows($cek_result) > 0) {
            // Jika sudah ada, lakukan UPDATE (Edit Nilai)
            $sql = "UPDATE nilai_tesmasuk 
                    SET nilai_raport = '$r', nilai_tes = '$t', nilai_prestasi = '$p', jarak_rumah = '$j' 
                    WHERE id_pendaftar = '$id'";
        } else {
            // Jika belum ada, lakukan INSERT (Tambah Nilai Baru)
            $sql = "INSERT INTO nilai_tesmasuk (id_pendaftar, nilai_raport, nilai_tes, nilai_prestasi, jarak_rumah) 
                    VALUES ('$id', '$r', '$t', '$p', '$j')";
        }

        return $this->query($sql);
    }

    // --- TAMBAHKAN FUNGSI INI KE DALAM CLASS SawModel ---

    // 1. Mengambil Nilai Max (Benefit) dan Min (Cost) untuk Normalisasi
    public function getMinMax() {
        $sql = "SELECT 
                    MAX(nilai_raport) as max_c1, 
                    MAX(nilai_tes) as max_c2, 
                    MAX(nilai_prestasi) as max_c3, 
                    MIN(jarak_rumah) as min_c4 
                FROM nilai_tesmasuk";
        return mysqli_fetch_assoc($this->query($sql));
    }

    // 2. Fungsi Utama Perhitungan SAW
    public function hitungDanUpdateSAW() {
        $mm = $this->getMinMax();
        $bobot = $this->getKriteria(); // Mengambil bobot dari DB (Dinamis)
        
        // Mapping bobot (Pastikan pembagian 100 karena input admin 40, 30, dsb)
        $w1 = $bobot[0]['bobot'] / 100;
        $w2 = $bobot[1]['bobot'] / 100;
        $w3 = $bobot[2]['bobot'] / 100;
        $w4 = $bobot[3]['bobot'] / 100;

        // Ambil semua data nilai
        $data = $this->getPendaftarDanNilai();

        foreach ($data as $row) {
            if ($row['id_nilai_tes']) {
                // Normalisasi (Hindari pembagian nol)
                $r1 = ($mm['max_c1'] > 0) ? $row['nilai_raport'] / $mm['max_c1'] : 0;
                $r2 = ($mm['max_c2'] > 0) ? $row['nilai_tes'] / $mm['max_c2'] : 0;
                $r3 = ($mm['max_c3'] > 0) ? $row['nilai_prestasi'] / $mm['max_c3'] : 0;
                $r4 = ($row['jarak_rumah'] > 0) ? $mm['min_c4'] / $row['jarak_rumah'] : 0;

                // Hitung Nilai Akhir Vi = (w1*r1) + (w2*r2) + (w3*r3) + (w4*r4)
                $vi = ($w1 * $r1) + ($w2 * $r2) + ($w3 * $r3) + ($w4 * $r4);

                // Update ke database
                $id_nilai = $row['id_nilai_tes'];
                $sql = "UPDATE nilai_tesmasuk SET nilai_akhir_saw = '$vi' WHERE id_nilai_tes = '$id_nilai'";
                $this->query($sql);
            }
        }
        
        // Update Ranking
        $this->updateRanking();
    }

    // 3. Fungsi Ranking Otomatis
    // 1. Perbaikan Fungsi Ranking: Pastikan urutan benar (terbesar ke terkecil)
    public function updateRanking() {
        // Reset rank ke 0
        $this->query("SET @rank=0");
        
        // Update peringkat berdasarkan nilai tertinggi
        $sql = "UPDATE nilai_tesmasuk 
                SET peringkat = (@rank:=@rank+1) 
                ORDER BY nilai_akhir_saw DESC";
        $this->query($sql);
    }

    // 2. Perbaikan Fungsi Status: Menggunakan inner join yang lebih ketat
    // Ambil setting berdasarkan nama
    // Ambil setting kuota dari DB
    public function getSetting($nama) {
        $sql = "SELECT nilai FROM setting_ppdb WHERE nama_setting = '$nama'";
        $res = $this->query($sql);
        $row = mysqli_fetch_assoc($res);
        return $row ? (int)$row['nilai'] : 0;
    }

    // Update setting (Admin)
    public function updateSetting($nama, $nilai) {
        $sql = "UPDATE setting_ppdb SET nilai = '$nilai' WHERE nama_setting = '$nama'";
        return $this->query($sql);
    }

    // Update Kelulusan (Sekarang tidak perlu parameter, otomatis baca dari DB)
    public function updateStatusKelulusan() {
        $k = $this->getSetting('kuota_diterima');
        $c = $this->getSetting('kuota_cadangan');
        $total_terima = $k + $c;

        $sql = "UPDATE pendaftar_ppdb p
                JOIN nilai_tesmasuk n ON p.id_pendaftar = n.id_pendaftar
                SET p.status_seleksi = CASE 
                    WHEN n.peringkat <= $k THEN 'Diterima'
                    WHEN n.peringkat > $k AND n.peringkat <= $total_terima THEN 'Cadangan'
                    ELSE 'Ditolak'
                END";
      return $this->query($sql);
    }

    // ==========================================
    // 4. LAPORAN RINCIAN PERHITUNGAN SAW (Transparansi)
    // ==========================================
    // Mengembalikan matriks keputusan, hasil normalisasi, nilai terbobot,
    // hingga nilai akhir (Vi) per pendaftar -- untuk keperluan laporan cetak.
    public function getRincianPerhitungan() {
        $mm = $this->getMinMax();
        $kriteria = $this->getKriteria(); // Bobot dinamis dari DB

        $w1 = $kriteria[0]['bobot'] / 100;
        $w2 = $kriteria[1]['bobot'] / 100;
        $w3 = $kriteria[2]['bobot'] / 100;
        $w4 = $kriteria[3]['bobot'] / 100;

        $data = $this->getPendaftarDanNilai();
        $rincian = [];

        foreach ($data as $row) {
            if (!$row['id_nilai_tes']) continue; // Lewati pendaftar yang belum diinput nilainya

            // Normalisasi (rij)
            $r1 = ($mm['max_c1'] > 0) ? $row['nilai_raport'] / $mm['max_c1'] : 0;
            $r2 = ($mm['max_c2'] > 0) ? $row['nilai_tes'] / $mm['max_c2'] : 0;
            $r3 = ($mm['max_c3'] > 0) ? $row['nilai_prestasi'] / $mm['max_c3'] : 0;
            $r4 = ($row['jarak_rumah'] > 0) ? $mm['min_c4'] / $row['jarak_rumah'] : 0;

            // Nilai Terbobot (wi x rij)
            $wt1 = $w1 * $r1;
            $wt2 = $w2 * $r2;
            $wt3 = $w3 * $r3;
            $wt4 = $w4 * $r4;

            $rincian[] = [
                'nama_lengkap'    => $row['nama_lengkap'],
                'no_registrasi'   => $row['no_registrasi'],
                'raw_c1'          => $row['nilai_raport'],
                'raw_c2'          => $row['nilai_tes'],
                'raw_c3'          => $row['nilai_prestasi'],
                'raw_c4'          => $row['jarak_rumah'],
                'r1' => $r1, 'r2' => $r2, 'r3' => $r3, 'r4' => $r4,
                'wt1' => $wt1, 'wt2' => $wt2, 'wt3' => $wt3, 'wt4' => $wt4,
                'nilai_akhir_saw' => $row['nilai_akhir_saw'],
                'peringkat'       => $row['peringkat'],
                'status_seleksi'  => $row['status_seleksi'] ?? 'Menunggu',
            ];
        }

        return [
            'kriteria' => $kriteria,
            'minmax'   => $mm,
            'data'     => $rincian,
        ];
    }

   // Ambil nilai akhir SAW & peringkat untuk 1 pendaftar (dipakai di Surat Keterangan Lulus)
    public function getNilaiByPendaftarId($id_pendaftar) {
        $id = intval($id_pendaftar);
        $sql = "SELECT nilai_akhir_saw, peringkat FROM nilai_tesmasuk WHERE id_pendaftar = $id";
        $res = $this->query($sql);
        return $res ? mysqli_fetch_assoc($res) : null;
    }

    // ==========================================
    // 5. LAPORAN STATISTIK NILAI RATA-RATA PENDAFTAR
    // ==========================================
    // $tahun = null artinya gabungan semua tahun (belum difilter)
    public function getStatistikNilai($tahun = null) {
        $where = "WHERE 1=1";
        if ($tahun) {
            $tahun = intval($tahun);
            $where .= " AND YEAR(p.tanggal_daftar) = $tahun";
        }

        // Rata-rata nilai per kriteria untuk periode terpilih
        $sql_rata = "SELECT 
                        AVG(n.nilai_raport) as avg_raport,
                        AVG(n.nilai_tes) as avg_tes,
                        AVG(n.nilai_prestasi) as avg_prestasi,
                        AVG(n.jarak_rumah) as avg_jarak,
                        AVG(n.nilai_akhir_saw) as avg_akhir,
                        COUNT(n.id_nilai_tes) as total_ternilai
                    FROM nilai_tesmasuk n
                    JOIN pendaftar_ppdb p ON p.id_pendaftar = n.id_pendaftar
                    $where";
        $rata = mysqli_fetch_assoc($this->query($sql_rata));

        // Tren rata-rata nilai akhir SAW per tahun ajaran (semua tahun yang tersedia)
        $sql_tren = "SELECT 
                        YEAR(p.tanggal_daftar) as tahun,
                        AVG(n.nilai_akhir_saw) as rata_akhir,
                        COUNT(n.id_nilai_tes) as jumlah
                    FROM nilai_tesmasuk n
                    JOIN pendaftar_ppdb p ON p.id_pendaftar = n.id_pendaftar
                    GROUP BY YEAR(p.tanggal_daftar)
                    ORDER BY tahun ASC";
        $res_tren = $this->query($sql_tren);
        $tren = [];
        while ($row = mysqli_fetch_assoc($res_tren)) {
            $tren[] = $row;
        }

        // Sebaran (distribusi) nilai akhir SAW dalam 5 rentang: 0.0-0.2 s/d 0.8-1.0
        $sql_sebaran = "SELECT n.nilai_akhir_saw 
                        FROM nilai_tesmasuk n
                        JOIN pendaftar_ppdb p ON p.id_pendaftar = n.id_pendaftar
                        $where AND n.nilai_akhir_saw IS NOT NULL";
        $res_sebaran = $this->query($sql_sebaran);
        $bins = ['0.0 - 0.2' => 0, '0.2 - 0.4' => 0, '0.4 - 0.6' => 0, '0.6 - 0.8' => 0, '0.8 - 1.0' => 0];
        while ($row = mysqli_fetch_assoc($res_sebaran)) {
            $v = (float) $row['nilai_akhir_saw'];
            if ($v < 0.2) $bins['0.0 - 0.2']++;
            elseif ($v < 0.4) $bins['0.2 - 0.4']++;
            elseif ($v < 0.6) $bins['0.4 - 0.6']++;
            elseif ($v < 0.8) $bins['0.6 - 0.8']++;
            else $bins['0.8 - 1.0']++;
        }

        // Daftar tahun yang tersedia (untuk dropdown filter)
        $sql_tahun = "SELECT DISTINCT YEAR(p.tanggal_daftar) as tahun 
                    FROM pendaftar_ppdb p
                    JOIN nilai_tesmasuk n ON p.id_pendaftar = n.id_pendaftar
                    ORDER BY tahun DESC";
        $res_tahun = $this->query($sql_tahun);
        $daftar_tahun = [];
        while ($row = mysqli_fetch_assoc($res_tahun)) {
            $daftar_tahun[] = $row['tahun'];
        }

        return [
            'rata_rata'    => $rata,
            'tren_tahunan' => $tren,
            'sebaran'      => $bins,
            'daftar_tahun' => $daftar_tahun,
        ];
    }

}
?>