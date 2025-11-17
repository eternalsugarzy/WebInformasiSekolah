<?php
// Mewarisi dari kelas Database agar bisa menggunakan fungsi $this->query()
require_once 'Database.php';

class ProfilModel extends Database
{

    /**
     * Mengambil data profil utama (misalnya dari tabel setting/profil)
     * Untuk saat ini, kita akan mengembalikan array data statis/dummy.
     * @return array Data profil sekolah.
     */
    public function getProfilData()
    {
        // Asumsi: Jika ada tabel 'profil_sekolah' dengan ID 1
        // $sql = "SELECT * FROM profil_sekolah WHERE id = 1";
        // $query = $this->query($sql);
        // return mysqli_fetch_assoc($query);

        // KARENA BELUM ADA TABELNYA, kita kembalikan data statis untuk tampilan:
        return [
            'sejarah' => "SMA Frater Don Bosco Banjarmasin didirikan pada tahun 1958, berdasarkan SK Pendirian U.P. 15/1958/P.N.B, dengan tujuan untuk memberikan pendidikan yang berkualitas, berbasis kasih persaudaraan, dan berlandaskan nilai-nilai keimanan. Sekolah ini dikelola oleh ordo Frater Don Bosco dan telah berperan penting dalam mencetak generasi muda yang berkarakter, berilmu, dan berbudi pekerti. Sebagai sekolah swasta, SMA Frater Don Bosco memiliki akreditasi A dan dikenal dengan komitmennya dalam mengembangkan potensi siswa baik secara akademis maupun non-akademis. Dalam perjalanan sejarahnya, sekolah ini terus berusaha untuk memberikan pendidikan yang menyentuh aspek spiritual, moral, dan intelektual, melalui berbagai program pendidikan yang efektif dan menyenangkan. Sekolah ini juga aktif dalam mempererat kerjasama dengan berbagai pihak terkait, termasuk orang tua, masyarakat, dan lembaga pendidikan lainnya.",
            'visi' => "BERIMAN, BERILMU, BERLANDASKAN KASIH PERSAUDARAAN MENUJU PRIBADI MANUSIA SEUTUHNYA",
            'misi' => [
                "Meningkatkan toleransi hidup beragama.",
                "Menyelenggarakan kegiatan keagamaan secara lebih efektif.",
                "Meningkatkan budaya disiplin dalam bekerja.",
                "Menjalin kerjasama yang erat dengan stakeholders.",
                "Melaksanakan kegiatan pembelajaran yang efektif dan menyenangkan.",
                "Melakukan supervisi untuk meningkatkan kualitas pembelajaran.",
                "Meningkatkan prestasi akademik dan non‑akademik peserta didik.",
                "Menghasilkan lulusan yang berkompetisi secara global.",
                "Mengembangkan nilai‑nilai kasih dan persaudaraan secara konkret."
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