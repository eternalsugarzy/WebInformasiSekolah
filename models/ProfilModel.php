<?php
// Mewarisi dari kelas Database agar bisa menggunakan fungsi $this->query()
require_once 'Database.php'; 

class ProfilModel extends Database {

    /**
     * Mengambil data profil utama (misalnya dari tabel setting/profil)
     * Untuk saat ini, kita akan mengembalikan array data statis/dummy.
     * @return array Data profil sekolah.
     */
    public function getProfilData() {
        // Asumsi: Jika ada tabel 'profil_sekolah' dengan ID 1
        // $sql = "SELECT * FROM profil_sekolah WHERE id = 1";
        // $query = $this->query($sql);
        // return mysqli_fetch_assoc($query);

        // KARENA BELUM ADA TABELNYA, kita kembalikan data statis untuk tampilan:
        return [
            'sejarah' => "SMA Frater Don Bosco Bjm didirikan pada tahun 1985 dengan visi untuk menjadi sekolah unggulan yang melahirkan pemimpin masa depan. Sekolah ini telah mencetak ribuan alumni berprestasi di berbagai bidang.",
            'visi' => "Menjadi pusat pendidikan yang berkarakter, berbudaya, dan berwawasan global.",
            'misi' => [
                "Menciptakan lingkungan belajar yang kondusif.",
                "Mengembangkan potensi akademik dan non-akademik siswa secara optimal.",
                "Menanamkan nilai-nilai keagamaan dan moral yang kuat."
            ],
            'fasilitas' => [
                "Perpustakaan Digital", 
                "Laboratorium IPA & Komputer Lengkap", 
                "Sarana Olahraga Standar", 
                "Ruang Kelas Ber-AC"
            ]
        ];
    }
}
?>