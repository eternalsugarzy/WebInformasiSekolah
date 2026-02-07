<?php
// Load Model
require_once __DIR__ . '/../models/PPDBModel.php';

header('Content-Type: application/json');

if (isset($_POST['type']) && isset($_POST['value'])) {
    
    try {
        $model = new PPDBModel();
        $type = $_POST['type'];
        $value = trim($_POST['value']);
        $id = isset($_POST['id']) && !empty($_POST['id']) ? $_POST['id'] : null;

        if (empty($value)) {
            echo json_encode(['status' => 'empty', 'message' => 'Kosong']);
            exit;
        }

        $allowed = ['nisn', 'nik', 'no_akte_lahir'];
        if (!in_array($type, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Tipe invalid']);
            exit;
        }

        // Cek duplikasi
        $duplikat = null;
        
        if ($type == 'nisn') {
            $duplikat = $model->cekDuplikasiData($value, '', '', $id);
        } elseif ($type == 'nik') {
            $duplikat = $model->cekDuplikasiData('', $value, '', $id);
        } elseif ($type == 'no_akte_lahir') {
            $duplikat = $model->cekDuplikasiData('', '', $value, $id);
        }

        if ($duplikat) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Sudah terdaftar a.n ' . $duplikat['nama_lengkap']
            ]);
        } else {
            echo json_encode([
                'status' => 'success',
                'message' => 'Tersedia'
            ]);
        }
        
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }

} else {
    echo json_encode(['status' => 'invalid_request', 'message' => 'Parameter kurang']);
}
?>