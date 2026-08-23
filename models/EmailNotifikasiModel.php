<?php
require_once 'Database.php';
require_once __DIR__ . '/../libs/PHPMailer/Exception.php';
require_once __DIR__ . '/../libs/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../libs/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
// Catatan: PHPMailer\PHPMailer\Exception meng-extend \Exception (global), jadi
// blok try/catch di bawah cukup menangkap \Exception biasa.

// Notifikasi email hasil kelulusan PPDB, dikirim ke email_siswa yang diisi
// pendaftar lewat formulir pendaftaran.
class EmailNotifikasiModel extends Database {

    // Status seleksi yang dianggap "final" dan layak dikirimi notifikasi.
    // 'Menunggu' sengaja tidak dikirim karena belum ada hasil untuk diberitahukan.
    private $statusFinal = ['Diterima', 'Ditolak', 'Cadangan'];

    // Membangun instance PHPMailer yang sudah dikonfigurasi SMTP.
    // Melempar Exception kalau file konfigurasi belum diisi.
    private function buatMailer() {
        $configFile = __DIR__ . '/../Koneksi Database/mail_config.php';
        if (!file_exists($configFile)) {
            throw new Exception("File konfigurasi SMTP belum ada. Salin 'Koneksi Database/mail_config.example.php' menjadi 'mail_config.php' lalu isi kredensialnya.");
        }
        $cfg = require $configFile;

        if (empty($cfg['username']) || strpos($cfg['username'], 'ganti_dengan') !== false) {
            throw new Exception("Konfigurasi SMTP di 'Koneksi Database/mail_config.php' belum diisi dengan kredensial asli.");
        }

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host       = $cfg['host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $cfg['username'];
        $mail->Password   = $cfg['password'];
        $mail->SMTPSecure = $cfg['encryption'];
        $mail->Port       = $cfg['port'];
        $mail->CharSet    = 'UTF-8';
        $mail->setFrom($cfg['from_email'], $cfg['from_name']);

        return $mail;
    }

    // Daftar pendaftar dengan status seleksi final (siap/​sudah dinotifikasi),
    // dipakai untuk halaman admin "Notifikasi Email Kelulusan".
    public function getDaftarNotifikasi() {
        $sql = "SELECT
                    p.id_pendaftar, p.nama_lengkap, p.no_registrasi, p.email_siswa,
                    p.jalur_seleksi, p.status_seleksi, p.status_email_notifikasi,
                    p.status_seleksi_saat_email, p.email_terkirim_at,
                    n.nilai_akhir_saw, n.peringkat
                FROM pendaftar_ppdb p
                LEFT JOIN nilai_tesmasuk n ON p.id_pendaftar = n.id_pendaftar
                WHERE p.status_seleksi IN ('" . implode("','", $this->statusFinal) . "')
                ORDER BY n.peringkat ASC";
        $result = $this->query($sql);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }

    // Menyusun subjek & isi email berdasarkan data 1 pendaftar.
    private function susunEmail($row) {
        $status = $row['status_seleksi'];
        $nama = htmlspecialchars($row['nama_lengkap']);
        $subjek = "Hasil Seleksi PPDB - " . $row['nama_lengkap'] . " (" . $status . ")";

        // Warna & label aksen per status, konsisten dengan badge di panel admin
        $tema = [
            'Diterima' => ['label' => 'DITERIMA',       'warna' => '#16a34a', 'bg' => '#ecfdf3'],
            'Cadangan' => ['label' => 'CADANGAN',        'warna' => '#d97706', 'bg' => '#fffbeb'],
            'Ditolak'  => ['label' => 'TIDAK DITERIMA',  'warna' => '#dc2626', 'bg' => '#fef2f2'],
        ][$status];

        $catatan = [
            'Diterima' => 'Selamat! Silakan tunggu informasi lebih lanjut mengenai jadwal dan tata cara daftar ulang dari panitia PPDB melalui website atau kontak resmi sekolah.',
            'Cadangan' => 'Anda saat ini berada di daftar cadangan. Kami akan menghubungi Anda apabila tersedia kuota tambahan dari peserta yang mengundurkan diri.',
            'Ditolak'  => 'Mohon maaf, Anda belum dapat diterima pada seleksi PPDB kali ini. Terima kasih atas partisipasi dan kepercayaan Anda kepada sekolah kami.',
        ][$status];

        $nilai = ($row['nilai_akhir_saw'] !== null) ? number_format((float) $row['nilai_akhir_saw'], 4) : '-';
        $peringkat = $row['peringkat'] ? '#' . $row['peringkat'] : '-';
        $noReg = htmlspecialchars($row['no_registrasi']);
        $jalur = htmlspecialchars($row['jalur_seleksi']);
        $tahun = date('Y');

        $baris = function ($label, $value, $terakhir = false) {
            $border = $terakhir ? '' : 'border-bottom:1px solid #eef0f3;';
            return "<tr>
                        <td style='padding:10px 0;{$border}color:#6b7280;font-size:13px;width:40%;'>{$label}</td>
                        <td style='padding:10px 0;{$border}color:#111827;font-size:13px;font-weight:600;'>{$value}</td>
                    </tr>";
        };

        $body = "<!DOCTYPE html>
<html lang='id'>
<head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1.0'></head>
<body style='margin:0;padding:0;background-color:#f2f3f5;font-family:Segoe UI,Arial,Helvetica,sans-serif;'>
    <table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='background-color:#f2f3f5;padding:32px 12px;'>
        <tr>
            <td align='center'>
                <table role='presentation' width='600' cellpadding='0' cellspacing='0' style='max-width:600px;width:100%;background-color:#ffffff;border-radius:10px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,0.06);'>

                    <!-- Header -->
                    <tr>
                        <td style='background-color:#FF6700;padding:28px 40px;'>
                            <p style='margin:0;color:#ffffff;font-size:12px;letter-spacing:1px;text-transform:uppercase;opacity:0.9;'>PPDB &mdash; SMA Frater Don Bosco</p>
                            <h1 style='margin:6px 0 0;color:#ffffff;font-size:20px;font-weight:700;'>Pengumuman Hasil Seleksi</h1>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style='padding:32px 40px 8px;'>
                            <p style='margin:0 0 4px;font-size:14px;color:#111827;'>Yth. <strong>{$nama}</strong>,</p>
                            <p style='margin:0 0 20px;font-size:14px;color:#4b5563;line-height:1.6;'>Berikut kami sampaikan hasil seleksi Penerimaan Peserta Didik Baru (PPDB) Anda:</p>

                            <!-- Status badge -->
                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='background-color:{$tema['bg']};border-radius:8px;margin-bottom:20px;'>
                                <tr>
                                    <td style='padding:16px 20px;text-align:center;'>
                                        <span style='display:inline-block;color:{$tema['warna']};font-size:18px;font-weight:800;letter-spacing:0.5px;'>{$tema['label']}</span>
                                    </td>
                                </tr>
                            </table>

                            <!-- Detail table -->
                            <table role='presentation' width='100%' cellpadding='0' cellspacing='0' style='margin-bottom:20px;'>
                                {$baris('No. Registrasi', $noReg)}
                                {$baris('Jalur Seleksi', $jalur)}
                                {$baris('Nilai Akhir (SAW)', $nilai)}
                                {$baris('Peringkat', $peringkat, true)}
                            </table>

                            <p style='margin:0 0 24px;font-size:14px;color:#4b5563;line-height:1.6;'>{$catatan}</p>

                            <p style='margin:0;font-size:14px;color:#111827;'>Hormat kami,<br><strong>Panitia PPDB SMA Frater Don Bosco</strong></p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style='padding:20px 40px;background-color:#f9fafb;border-top:1px solid #eef0f3;'>
                            <p style='margin:0;font-size:11px;color:#9ca3af;line-height:1.6;'>Email ini dikirim otomatis oleh sistem PPDB SMA Frater Don Bosco. Mohon tidak membalas langsung ke email ini.</p>
                            <p style='margin:4px 0 0;font-size:11px;color:#9ca3af;'>&copy; {$tahun} SMA Frater Don Bosco</p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>";

        $altBody = "Yth. {$row['nama_lengkap']},\n\n"
            . "Berikut hasil seleksi PPDB Anda:\n"
            . "- No. Registrasi   : {$row['no_registrasi']}\n"
            . "- Jalur Seleksi    : {$row['jalur_seleksi']}\n"
            . "- Nilai Akhir (SAW): {$nilai}\n"
            . "- Peringkat        : {$peringkat}\n"
            . "- Status           : {$tema['label']}\n\n"
            . "{$catatan}\n\n"
            . "Hormat kami,\nPanitia PPDB SMA Frater Don Bosco";

        return ['subjek' => $subjek, 'body' => $body, 'alt_body' => $altBody];
    }

    // Mencatat hasil pengiriman (sukses/gagal) ke log + update status ringkas di pendaftar_ppdb
    private function catatHasil($id_pendaftar, $email, $status, $pesan, $status_seleksi_terkirim) {
        $conn = $this->koneksi;
        $id = mysqli_real_escape_string($conn, $id_pendaftar);
        $email_esc = mysqli_real_escape_string($conn, $email);
        $status_esc = mysqli_real_escape_string($conn, $status);
        $pesan_esc = mysqli_real_escape_string($conn, mb_substr($pesan, 0, 250));

        $this->query("INSERT INTO log_notifikasi_email (id_pendaftar, email_tujuan, status, pesan)
                      VALUES ('$id', '$email_esc', '$status_esc', '$pesan_esc')");

        if ($status === 'Terkirim') {
            $status_seleksi_esc = mysqli_real_escape_string($conn, $status_seleksi_terkirim);
            $this->query("UPDATE pendaftar_ppdb
                          SET status_email_notifikasi = 'Terkirim',
                              status_seleksi_saat_email = '$status_seleksi_esc',
                              email_terkirim_at = NOW()
                          WHERE id_pendaftar = '$id'");
        } else {
            $this->query("UPDATE pendaftar_ppdb SET status_email_notifikasi = 'Gagal' WHERE id_pendaftar = '$id'");
        }
    }

    // Kirim notifikasi untuk 1 pendaftar. $paksa = true untuk tombol "Kirim Ulang" manual
    // (mengabaikan pengecekan "sudah terkirim & status belum berubah").
    public function kirimSatu($id_pendaftar, $paksa = false) {
        $id = intval($id_pendaftar);
        $sql = "SELECT p.*, n.nilai_akhir_saw, n.peringkat
                FROM pendaftar_ppdb p
                LEFT JOIN nilai_tesmasuk n ON p.id_pendaftar = n.id_pendaftar
                WHERE p.id_pendaftar = $id";
        $row = mysqli_fetch_assoc($this->query($sql));

        if (!$row) {
            return ['sukses' => false, 'pesan' => 'Pendaftar tidak ditemukan.'];
        }
        if (!in_array($row['status_seleksi'], $this->statusFinal)) {
            return ['sukses' => false, 'pesan' => 'Status seleksi belum final (masih Menunggu).'];
        }
        if (empty($row['email_siswa']) || !filter_var($row['email_siswa'], FILTER_VALIDATE_EMAIL)) {
            $this->catatHasil($id, $row['email_siswa'] ?? '', 'Gagal', 'Alamat email tidak valid/kosong.', $row['status_seleksi']);
            return ['sukses' => false, 'pesan' => 'Alamat email pendaftar tidak valid/kosong.'];
        }
        // Sudah terkirim untuk status yang sama & bukan kirim ulang paksa -> lewati (hindari spam saat proses seleksi diulang)
        if (!$paksa && $row['status_email_notifikasi'] === 'Terkirim' && $row['status_seleksi_saat_email'] === $row['status_seleksi']) {
            return ['sukses' => true, 'pesan' => 'Dilewati, sudah terkirim untuk status ini.', 'dilewati' => true];
        }

        $konten = $this->susunEmail($row);

        try {
            $mail = $this->buatMailer();
            $mail->addAddress($row['email_siswa'], $row['nama_lengkap']);
            $mail->isHTML(true);
            $mail->Subject = $konten['subjek'];
            $mail->Body    = $konten['body'];
            $mail->AltBody = $konten['alt_body'];

            $mail->send();

            $this->catatHasil($id, $row['email_siswa'], 'Terkirim', 'Berhasil dikirim.', $row['status_seleksi']);
            return ['sukses' => true, 'pesan' => 'Email berhasil dikirim ke ' . $row['email_siswa']];
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $this->catatHasil($id, $row['email_siswa'], 'Gagal', $errorMsg, $row['status_seleksi']);
            return ['sukses' => false, 'pesan' => 'Gagal mengirim email: ' . $errorMsg];
        }
    }

    // Kirim notifikasi massal untuk semua pendaftar berstatus final yang belum
    // dinotifikasi (atau status seleksinya berubah sejak terakhir dikirim).
    // Dipanggil otomatis setelah admin menjalankan Proses Seleksi SAW.
    public function kirimSemua() {
        $data = $this->getDaftarNotifikasi();
        $ringkasan = ['terkirim' => 0, 'gagal' => 0, 'dilewati' => 0];

        foreach ($data as $row) {
            $hasil = $this->kirimSatu($row['id_pendaftar'], false);
            if (!$hasil['sukses']) {
                $ringkasan['gagal']++;
            } elseif (!empty($hasil['dilewati'])) {
                $ringkasan['dilewati']++;
            } else {
                $ringkasan['terkirim']++;
            }
        }

        return $ringkasan;
    }
}
