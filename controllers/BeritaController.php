<?php
require_once __DIR__ . '/../models/BeritaModel.php';

class BeritaController {

    public function index() {

        $beritaModel = new BeritaModel();

        // ================= SETUP PAGINATION =================
        $limit = 4; // jumlah berita per halaman
        $page  = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $limit;

        // ================= PRIORITAS FILTER =================
        if (isset($_GET['q']) && $_GET['q'] !== '') {
            // SEARCH
            $keyword = $_GET['q'];
            $data_berita  = $beritaModel->searchBerita($keyword);
            $total_berita = count($data_berita); // pagination non aktif saat search

        } elseif (isset($_GET['kategori']) && $_GET['kategori'] !== '') {
            // KATEGORI
            $kategori = $_GET['kategori'];
            $data_berita  = $beritaModel->getBeritaByKategori($kategori);
            $total_berita = count($data_berita);

        } elseif (isset($_GET['tahun']) && $_GET['tahun'] !== '') {
            // ARCHIVE
            $tahun = $_GET['tahun'];
            $data_berita  = $beritaModel->getBeritaByYear($tahun);
            $total_berita = count($data_berita);

        } else {
            // ================= DEFAULT + PAGINATION =================
            $data_berita  = $beritaModel->getBeritaByPage($limit, $offset);
            $total_berita = $beritaModel->countBerita();
        }

        // Total halaman
        $total_page = ceil($total_berita / $limit);

        $title = "Semua Berita - SMA Maju Jaya";

        require_once 'views/template/header.php';
        require_once 'views/berita.php';
        require_once 'views/template/footer.php';
    }
}
?>
