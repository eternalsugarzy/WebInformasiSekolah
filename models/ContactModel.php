<?php
// Mewarisi dari kelas Database
require_once 'Database.php'; 

class ContactModel extends Database {

    /**
     * Mengambil data kontak sekolah dari database (atau data statis sementara).
     * @return array Data kontak sekolah.
     */
    public function getContactInfo() {
        // KARENA BELUM ADA TABELNYA, kita kembalikan data statis yang spesifik untuk SMA Frater Don Bosco Bjm:
        return [
            'alamat' => "Jl. Ahmad Yani No. 10, Banjarmasin, Kalimantan Selatan",
            'telepon' => "(0511) 335XXXX",
            'email' => "info@fraterdonbosco-bjm.sch.id",
            'jam_kerja' => "Senin - Jumat, 07:00 - 15:00 WITA",
            // Koordinat peta untuk Google Maps (Banjarmasin)
            'latitude' => "-3.3210", 
            'longitude' => "114.5937"
        ];
    }
    
    /* * FUNGSI TAMBAHAN: Logika untuk menyimpan pesan dari formulir kontak.
    * public function saveMessage($nama, $email, $subjek, $pesan) {
    * // Logika sanitasi input dan INSERT ke tabel 'pesan_kontak'
    * // return $this->query($sql);
    * }
    */
}
?>