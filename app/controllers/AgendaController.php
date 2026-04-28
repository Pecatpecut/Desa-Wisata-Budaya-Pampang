<?php
require_once ROOT . '/app/models/AgendaModel.php';

class AgendaController extends Controller {

    public function tambah() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/agenda');

        $title    = trim($_POST['title']    ?? '');
        $date     = trim($_POST['date']     ?? '');
        $time     = trim($_POST['time']     ?? '');
        $location = trim($_POST['location'] ?? '');

        if (!$title || !$date || !$time || !$location) {
            $_SESSION['error'] = 'Semua field wajib diisi';
        } else {
            (new AgendaModel())->tambah($title, $date, $time, $location);
            $_SESSION['success'] = 'Agenda berhasil ditambahkan!';
        }
        $this->redirect('admin/agenda');
    }

    public function edit() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/agenda');


        $id       = (int)($_POST['id']       ?? 0);
        $title    = trim($_POST['title']    ?? '');
        $date     = trim($_POST['date']     ?? '');
        $time     = trim($_POST['time']     ?? '');
        $location = trim($_POST['location'] ?? '');

        if (!$id || !$title || !$date || !$time || !$location) {
            $_SESSION['error'] = 'Semua field wajib diisi';
        } else {
            (new AgendaModel())->edit($id, $title, $date, $time, $location);
            $_SESSION['success'] = 'Agenda berhasil diperbarui!';
        }
        $this->redirect('admin/agenda');
    }

    public function hapus() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/agenda');

        $id = (int)($_POST['id'] ?? 0);
        if ($id) {
            (new AgendaModel())->hapus($id);
            $_SESSION['success'] = 'Agenda berhasil dihapus';
        }
        $this->redirect('admin/agenda');
    }
}
