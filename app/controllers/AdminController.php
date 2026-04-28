<?php
require_once ROOT . '/app/models/AgendaModel.php';
require_once ROOT . '/app/models/GaleriModel.php';
require_once ROOT . '/app/models/PostinganModel.php';
require_once ROOT . '/app/models/KontakModel.php';

class AdminController extends Controller {

    public function dashboard() {
        $this->requireLogin();
        $agenda    = (new AgendaModel())->getAll();
        $galeri    = (new GaleriModel())->getAll();
        $postingan = (new PostinganModel())->getAll();
        $this->view('admin/dashboard', compact('agenda','galeri','postingan'));
    }

    public function agenda() {
        $this->requireLogin();
        $agenda  = (new AgendaModel())->getAll();
        $success = $_SESSION['success'] ?? ''; unset($_SESSION['success']);
        $error   = $_SESSION['error']   ?? ''; unset($_SESSION['error']);
        $this->view('admin/agenda/index', compact('agenda','success','error'));
    }

    public function galeri() {
        $this->requireLogin();
        $galeri  = (new GaleriModel())->getAll();
        $success = $_SESSION['success'] ?? ''; unset($_SESSION['success']);
        $error   = $_SESSION['error']   ?? ''; unset($_SESSION['error']);
        $this->view('admin/galeri/index', compact('galeri','success','error'));
    }

    public function postingan() {
        $this->requireLogin();
        $postingan = (new PostinganModel())->getAll();
        $success   = $_SESSION['success'] ?? ''; unset($_SESSION['success']);
        $error     = $_SESSION['error']   ?? ''; unset($_SESSION['error']);
        $this->view('admin/postingan/index', compact('postingan','success','error'));
    }

    public function kontak() {
        $this->requireLogin();
        $kontak  = (new KontakModel())->get();
        $success = $_SESSION['success'] ?? ''; unset($_SESSION['success']);
        $error   = $_SESSION['error']   ?? ''; unset($_SESSION['error']);
        $this->view('admin/kontak/index', compact('kontak','success','error'));
    }

    public function password() {
        $this->requireLogin();
        $success = $_SESSION['success'] ?? ''; unset($_SESSION['success']);
        $error   = $_SESSION['error']   ?? ''; unset($_SESSION['error']);
        $this->view('admin/password', compact('success','error'));
    }
}
