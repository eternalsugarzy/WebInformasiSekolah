<?php
// Mencegah error jika class Database sudah dipanggil di tempat lain
require_once 'Database.php';

class SawModel extends Database {

    // Batas bawah jarak rumah ke sekolah (km) yang boleh dipakai dalam kalkulasi SAW.
    // Jarak 0 (atau mendekati 0) berbahaya untuk kriteria Cost C4: selain rawan
    // dibagi nyaris-nol, nilai itu juga bisa menjadi MIN(jarak) global sehingga
    // kriteria Jarak jadi tidak berpengaruh bagi SEMUA pendaftar. 0.01 km = 10 meter.
    const MIN_JARAK_KM = 0.01;

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
    // 1b. BAGIAN BOBOT KRITERIA PER JALUR SELEKSI
    // ==========================================
    // Setiap jalur (Zonasi, Prestasi, Afirmasi) bisa punya prioritas kriteria
    // yang berbeda, mis. Zonasi menitikberatkan Jarak Rumah, Prestasi
    // menitikberatkan nilai Prestasi. Ini yang membuat pemilihan jalur benar-benar
    // memengaruhi hasil SAW, bukan sekadar label.

    // Daftar jalur seleksi yang didukung sistem (harus sinkron dengan enum jalur_seleksi)
    public function getJalurList() {
        return ['Zonasi', 'Prestasi', 'Afirmasi'];
    }

    // Mengambil kriteria beserta bobot khusus untuk 1 jalur tertentu.
    // Jika suatu kriteria belum dikonfigurasi untuk jalur tsb, fallback ke kriteria_saw.bobot.
    public function getKriteriaByJalur($jalur) {
        $conn = $this->koneksi;
        $j = mysqli_real_escape_string($conn, $jalur);

        $sql = "SELECT
                    k.id_kriteria, k.kode_kriteria, k.nama_kriteria, k.tipe,
                    COALESCE(bj.bobot, k.bobot) as bobot
                FROM kriteria_saw k
                LEFT JOIN bobot_jalur bj ON bj.id_kriteria = k.id_kriteria AND bj.jalur_seleksi = '$j'
                ORDER BY k.id_kriteria ASC";
        $result = $this->query($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Mengambil bobot semua jalur sekaligus, dikelompokkan per jalur.
    // Bentuk: ['Zonasi' => [id_kriteria => bobot, ...], 'Prestasi' => [...], ...]
    public function getBobotSemuaJalur() {
        $map = [];
        foreach ($this->getJalurList() as $jalur) {
            $map[$jalur] = [];
            foreach ($this->getKriteriaByJalur($jalur) as $k) {
                $map[$jalur][$k['id_kriteria']] = $k['bobot'] / 100;
            }
        }
        return $map;
    }

    // Upsert bobot 1 kriteria untuk 1 jalur tertentu
    public function updateBobotJalur($jalur, $id_kriteria, $bobot_baru) {
        $conn = $this->koneksi;
        $j = mysqli_real_escape_string($conn, $jalur);
        $id = mysqli_real_escape_string($conn, $id_kriteria);
        $bobot = mysqli_real_escape_string($conn, $bobot_baru);

        $sql = "INSERT INTO bobot_jalur (jalur_seleksi, id_kriteria, bobot)
                VALUES ('$j', '$id', '$bobot')
                ON DUPLICATE KEY UPDATE bobot = '$bobot'";
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
        // Validasi batas bawah jarak SEBELUM data masuk ke DB, supaya tidak pernah
        // ada nilai jarak 0/negatif/tidak valid yang bisa merusak kalkulasi SAW nantinya.
        if (!is_numeric($jarak) || (float) $jarak < self::MIN_JARAK_KM) {
            return false;
        }

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
        // GREATEST(jarak_rumah, MIN_JARAK_KM) menjaga agar data lama yang masih
        // bernilai 0/di bawah batas tidak menjadikan MIN(jarak) global = 0
        // (yang akan membuat kriteria Jarak hilang dari perhitungan semua pendaftar).
        $min_jarak = self::MIN_JARAK_KM;
        $sql = "SELECT
                    MAX(nilai_raport) as max_c1,
                    MAX(nilai_tes) as max_c2,
                    MAX(nilai_prestasi) as max_c3,
                    MIN(GREATEST(jarak_rumah, $min_jarak)) as min_c4
                FROM nilai_tesmasuk";
        return mysqli_fetch_assoc($this->query($sql));
    }

    // Jaga-jaga terhadap data lama/tidak valid (jarak 0, negatif, atau kosong) yang mungkin
    // masih lolos ke tabel nilai_tesmasuk sebelum validasi input ini ada. Dipanggil tepat
    // sebelum jarak dipakai dalam kalkulasi SAW, supaya kalkulasi tidak pernah membagi
    // dengan angka nyaris nol.
    private function clampJarak($jarak) {
        $jarak = (float) $jarak;
        return ($jarak < self::MIN_JARAK_KM) ? self::MIN_JARAK_KM : $jarak;
    }

    // 2. Fungsi Utama Perhitungan SAW
    public function hitungDanUpdateSAW() {
        $mm = $this->getMinMax();
        // Bobot per jalur (Dinamis oleh Admin, beda tiap jalur seleksi)
        $bobotPerJalur = $this->getBobotSemuaJalur();

        // Ambil semua data nilai
        $data = $this->getPendaftarDanNilai();

        foreach ($data as $row) {
            if ($row['id_nilai_tes']) {
                // Pakai bobot sesuai jalur seleksi pendaftar ybs (fallback ke Zonasi jika jalur tak dikenal)
                $jalur = $row['jalur_seleksi'] ?? 'Zonasi';
                $w = $bobotPerJalur[$jalur] ?? reset($bobotPerJalur);
                $w1 = $w[1] ?? 0;
                $w2 = $w[2] ?? 0;
                $w3 = $w[3] ?? 0;
                $w4 = $w[4] ?? 0;

                // Normalisasi (Hindari pembagian nol). Jarak divalidasi ke batas bawah
                // MIN_JARAK_KM sebelum dipakai, sehingga data 0/tidak wajar tidak merusak Vi.
                $r1 = ($mm['max_c1'] > 0) ? $row['nilai_raport'] / $mm['max_c1'] : 0;
                $r2 = ($mm['max_c2'] > 0) ? $row['nilai_tes'] / $mm['max_c2'] : 0;
                $r3 = ($mm['max_c3'] > 0) ? $row['nilai_prestasi'] / $mm['max_c3'] : 0;
                $jarak = $this->clampJarak($row['jarak_rumah']);
                $r4 = $mm['min_c4'] / $jarak;

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
        $kriteria = $this->getKriteria(); // Definisi kriteria (kode/nama/tipe) + bobot default
        $bobotPerJalur = $this->getBobotSemuaJalur(); // Bobot dinamis per jalur seleksi

        $data = $this->getPendaftarDanNilai();
        $rincian = [];

        foreach ($data as $row) {
            if (!$row['id_nilai_tes']) continue; // Lewati pendaftar yang belum diinput nilainya

            // Bobot mengikuti jalur seleksi pendaftar ybs
            $jalur = $row['jalur_seleksi'] ?? 'Zonasi';
            $w = $bobotPerJalur[$jalur] ?? reset($bobotPerJalur);
            $w1 = $w[1] ?? 0;
            $w2 = $w[2] ?? 0;
            $w3 = $w[3] ?? 0;
            $w4 = $w[4] ?? 0;

            // Normalisasi (rij). Jarak divalidasi ke batas bawah MIN_JARAK_KM sebelum dipakai.
            $r1 = ($mm['max_c1'] > 0) ? $row['nilai_raport'] / $mm['max_c1'] : 0;
            $r2 = ($mm['max_c2'] > 0) ? $row['nilai_tes'] / $mm['max_c2'] : 0;
            $r3 = ($mm['max_c3'] > 0) ? $row['nilai_prestasi'] / $mm['max_c3'] : 0;
            $jarak = $this->clampJarak($row['jarak_rumah']);
            $r4 = $mm['min_c4'] / $jarak;

            // Nilai Terbobot (wi x rij)
            $wt1 = $w1 * $r1;
            $wt2 = $w2 * $r2;
            $wt3 = $w3 * $r3;
            $wt4 = $w4 * $r4;

            $rincian[] = [
                'nama_lengkap'    => $row['nama_lengkap'],
                'no_registrasi'   => $row['no_registrasi'],
                'jalur_seleksi'   => $jalur,
                'raw_c1'          => $row['nilai_raport'],
                'raw_c2'          => $row['nilai_tes'],
                'raw_c3'          => $row['nilai_prestasi'],
                'raw_c4'          => $row['jarak_rumah'],
                'bobot_w1' => $w1 * 100, 'bobot_w2' => $w2 * 100, 'bobot_w3' => $w3 * 100, 'bobot_w4' => $w4 * 100,
                'r1' => $r1, 'r2' => $r2, 'r3' => $r3, 'r4' => $r4,
                'wt1' => $wt1, 'wt2' => $wt2, 'wt3' => $wt3, 'wt4' => $wt4,
                'nilai_akhir_saw' => $row['nilai_akhir_saw'],
                'peringkat'       => $row['peringkat'],
                'status_seleksi'  => $row['status_seleksi'] ?? 'Menunggu',
            ];
        }

        return [
            'kriteria'       => $kriteria,
            'bobot_per_jalur'=> $bobotPerJalur,
            'minmax'         => $mm,
            'data'           => $rincian,
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