<?php
require_once ROOT . '/app/models/KontakModel.php';

class KontakController extends Controller {

    public function simpan() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') $this->redirect('admin/kontak');

        (new KontakModel())->update($_POST);
        $_SESSION['success'] = 'Data berhasil disimpan!';
        $this->redirect('admin/kontak');
    }
}
