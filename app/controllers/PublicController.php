<?php
require_once ROOT . '/app/models/AgendaModel.php';
require_once ROOT . '/app/models/GaleriModel.php';
require_once ROOT . '/app/models/PostinganModel.php';
require_once ROOT . '/app/models/KontakModel.php';

class PublicController extends Controller {

    public function beranda() {
        $agenda    = (new AgendaModel())->getAll();
        $galeri    = array_slice((new GaleriModel())->getAll(), 0, 6);
        $postingan = array_slice((new PostinganModel())->getAll(), 0, 3);
        $kontak    = (new KontakModel())->get();
        $this->view('public/beranda/index', compact('agenda','galeri','postingan','kontak'));
    }

    public function tentang() {
        $this->view('public/tentang/index');
    }

    public function publikasi() {
        $galeri    = (new GaleriModel())->getAll();
        $postingan = (new PostinganModel())->getAll();
        $this->view('public/publikasi/index', compact('galeri','postingan'));
    }

    public function kontak() {
        $agenda = (new AgendaModel())->getAll();
        $kontak = (new KontakModel())->get();
        $this->view('public/kontak/index', compact('agenda','kontak'));
    }
}
