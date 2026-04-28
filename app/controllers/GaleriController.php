<?php
require_once ROOT . '/app/models/GaleriModel.php';

class GaleriController extends Controller {

    
    private $allowedExts = ['jpg','jpeg','png','webp','gif'];
    private $maxSize = 5242880; 

    public function upload() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/galeri');

        $title = trim($_POST['title'] ?? '');
        if (!$title) {
            $_SESSION['error'] = 'Judul wajib diisi';
            $this->redirect('admin/galeri');
        }

        $model = new GaleriModel();

        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image'];

            $finfo    = finfo_open(FILEINFO_MIME_TYPE);
            $realMime = finfo_file($finfo, $file['tmp_name']);

            $allowedMimes = ['image/jpeg','image/png','image/webp','image/gif'];
            if (!in_array($realMime, $allowedMimes)) {
                $_SESSION['error'] = 'Format harus JPG, PNG, WEBP, atau GIF';
                $this->redirect('admin/galeri');
            }

            if ($file['size'] > $this->maxSize) {
                $_SESSION['error'] = 'Ukuran file maksimal 5MB';
                $this->redirect('admin/galeri');
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $this->allowedExts)) {
                $_SESSION['error'] = 'Ekstensi file tidak diizinkan';
                $this->redirect('admin/galeri');
            }

            $filename = uniqid('galeri_') . '.' . $ext;

            
            if (!is_dir($model->uploadDir)) {
                mkdir($model->uploadDir, 0755, true);
            }

            if (!move_uploaded_file($file['tmp_name'], $model->uploadDir . $filename)) {
                $_SESSION['error'] = 'Gagal menyimpan file';
                $this->redirect('admin/galeri');
            }
            $model->tambah($title, $filename, 'file');

        } elseif (!empty($_POST['image_url'])) {
            $url = trim($_POST['image_url']);
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $_SESSION['error'] = 'URL tidak valid';
                $this->redirect('admin/galeri');
            }
            
            $parsed = parse_url($url);
            if (!in_array($parsed['scheme'] ?? '', ['http','https'])) {
                $_SESSION['error'] = 'URL hanya boleh http/https';
                $this->redirect('admin/galeri');
            }
            $model->tambah($title, $url, 'url');
        } else {
            $_SESSION['error'] = 'Gambar wajib diisi';
            $this->redirect('admin/galeri');
        }

        $_SESSION['success'] = 'Foto berhasil diupload!';
        $this->redirect('admin/galeri');
    }

    public function edit() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/galeri');


        $id    = (int)($_POST['id']    ?? 0);
        $title = trim($_POST['title'] ?? '');

        if (!$id || !$title) {
            $_SESSION['error'] = 'Data tidak lengkap';
        } else {
            (new GaleriModel())->editJudul($id, $title);
            $_SESSION['success'] = 'Judul berhasil diperbarui!';
        }
        $this->redirect('admin/galeri');
    }

    public function hapus() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/galeri');

        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            (new GaleriModel())->hapus($id);
            $_SESSION['success'] = 'Foto berhasil dihapus';
        }
        $this->redirect('admin/galeri');
    }
}
