<?php
class Router {

    public function dispatch() {
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        $scriptDir = trim(dirname($_SERVER['SCRIPT_NAME']), '/');
        if ($scriptDir && strpos($uri, $scriptDir) === 0) {
            $uri = trim(substr($uri, strlen($scriptDir)), '/');
        }

        $routes = [
            ''                       => ['PublicController',   'beranda'],
            'tentang'                => ['PublicController',   'tentang'],
            'publikasi'              => ['PublicController',   'publikasi'],
            'kontak'                 => ['PublicController',   'kontak'],

            'login'                  => ['AuthController',     'login'],
            'logout'                 => ['AuthController',     'logout'],

            'admin'                  => ['AdminController',    'dashboard'],
            'admin/agenda'           => ['AdminController',    'agenda'],
            'admin/galeri'           => ['AdminController',    'galeri'],
            'admin/postingan'        => ['AdminController',    'postingan'],
            'admin/kontak'           => ['AdminController',    'kontak'],

            'admin/agenda/tambah'    => ['AgendaController',   'tambah'],
            'admin/agenda/edit'      => ['AgendaController',   'edit'],
            'admin/agenda/hapus'     => ['AgendaController',   'hapus'],

            'admin/galeri/upload'    => ['GaleriController',   'upload'],
            'admin/galeri/edit'      => ['GaleriController',   'edit'],
            'admin/galeri/hapus'     => ['GaleriController',   'hapus'],

            'admin/postingan/tambah' => ['PostinganController','tambah'],
            'admin/postingan/edit'   => ['PostinganController','edit'],
            'admin/postingan/hapus'  => ['PostinganController','hapus'],

            'admin/kontak/simpan'    => ['KontakController',   'simpan'],
            'admin/password'         => ['AdminController',    'password'],
            'admin/password/ubah'    => ['PasswordController', 'ubah'],
        ];

        if (isset($routes[$uri])) {
            [$controllerName, $method] = $routes[$uri];
            $file = ROOT . '/app/controllers/' . $controllerName . '.php';
            if (file_exists($file)) {
                require_once $file;
                $controller = new $controllerName();
                $controller->$method();
            }
        } else {
            http_response_code(404);
            echo '<h1>404 - Halaman tidak ditemukan</h1>';
        }
    }
}
