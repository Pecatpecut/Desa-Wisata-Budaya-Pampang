<?php
require_once ROOT . '/app/models/PostinganModel.php';

class PostinganController extends Controller {
    private $allowedExts = ['jpg','jpeg','png','webp','gif'];
    private $maxSize = 5242880;

    public function tambah() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/postingan');

        $title  = trim($_POST['title']  ?? '');
        $link   = trim($_POST['link']   ?? '');
        $source = trim($_POST['source'] ?? '');

        if (!$title || !$link || !$source) {
            $_SESSION['error'] = 'Judul, link, dan sumber wajib diisi';
            $this->redirect('admin/postingan');
        }
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            $_SESSION['error'] = 'Link URL tidak valid';
            $this->redirect('admin/postingan');
        }
        $parsedLink = parse_url($link);
        if (!in_array($parsedLink['scheme'] ?? '', ['http','https'])) {
            $_SESSION['error'] = 'Link hanya boleh http/https';
            $this->redirect('admin/postingan');
        }

        $model = new PostinganModel();

        if (!empty($_FILES['thumbnail']['name'])) {
            $file = $_FILES['thumbnail'];

            $finfo    = finfo_open(FILEINFO_MIME_TYPE);
            $realMime = finfo_file($finfo, $file['tmp_name']);

            $allowedMimes = ['image/jpeg','image/png','image/webp','image/gif'];
            if (!in_array($realMime, $allowedMimes)) {
                $_SESSION['error'] = 'Format thumbnail harus JPG, PNG, atau WEBP';
                $this->redirect('admin/postingan');
            }

            if ($file['size'] > $this->maxSize) {
                $_SESSION['error'] = 'Ukuran thumbnail maksimal 5MB';
                $this->redirect('admin/postingan');
            }

            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $this->allowedExts)) {
                $_SESSION['error'] = 'Ekstensi file tidak diizinkan';
                $this->redirect('admin/postingan');
            }

            $filename = uniqid('post_') . '.' . $ext;

            if (!is_dir($model->uploadDir)) {
                mkdir($model->uploadDir, 0755, true);
            }

            if (!move_uploaded_file($file['tmp_name'], $model->uploadDir . $filename)) {
                $_SESSION['error'] = 'Gagal menyimpan thumbnail';
                $this->redirect('admin/postingan');
            }
            $model->tambah($title, $link, $source, $filename, 'file');

        } elseif (!empty($_POST['thumbnail_url'])) {
            $url = trim($_POST['thumbnail_url']);
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                $_SESSION['error'] = 'URL thumbnail tidak valid';
                $this->redirect('admin/postingan');
            }
            $parsed = parse_url($url);
            if (!in_array($parsed['scheme'] ?? '', ['http','https'])) {
                $_SESSION['error'] = 'URL hanya boleh http/https';
                $this->redirect('admin/postingan');
            }
            $model->tambah($title, $link, $source, $url, 'url');
        } else {
            $_SESSION['error'] = 'Thumbnail wajib diisi';
            $this->redirect('admin/postingan');
        }

        $_SESSION['success'] = 'Postingan berhasil ditambahkan!';
        $this->redirect('admin/postingan');
    }

    public function edit() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/postingan');

        $id     = (int)($_POST['id'] ?? 0);
        $title  = trim($_POST['title']  ?? '');
        $link   = trim($_POST['link']   ?? '');
        $source = trim($_POST['source'] ?? '');

        if (!$id || !$title || !$link || !$source) {
            $_SESSION['error'] = 'Semua field wajib diisi';
        } else {
            $model = new PostinganModel();
            $model->edit($id, $title, $link, $source);
            $_SESSION['success'] = 'Postingan berhasil diperbarui!';
        }
        $this->redirect('admin/postingan');
    }

    public function hapus() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/postingan');


        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            (new PostinganModel())->hapus($id);
            $_SESSION['success'] = 'Postingan berhasil dihapus';
        }
        $this->redirect('admin/postingan');
    }
}
