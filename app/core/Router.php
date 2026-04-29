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

                try {
                    $controller->$method();
                } catch (Throwable $e) {
                    error_log('[Pampang Error] ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
                    self::renderError(500);
                }
            } else {
                self::renderError(500);
            }
        } else {
            self::renderError(404);
        }
    }

    /**
     * Render halaman error sesuai kode HTTP.
     *
     * @param int    $code    Kode HTTP (404, 403, 500, dst.)
     * @param string $message Pesan error opsional
     */
    public static function renderError(int $code, string $message = ''): void {
        http_response_code($code);

        $viewFile = ROOT . '/app/views/errors/' . $code . '.php';

        if (file_exists($viewFile)) {
            require $viewFile;
            return;
        }

        $genericView = ROOT . '/app/views/errors/generic.php';
        if (file_exists($genericView)) {
            $errorCode    = $code;
            $errorMessage = $message ?: self::defaultMessage($code);
            require $genericView;
            return;
        }

        echo '<h1>Error ' . $code . '</h1>';
        echo '<p>' . htmlspecialchars($message ?: self::defaultMessage($code)) . '</p>';
    }

    private static function defaultMessage(int $code): string {
        $messages = [
            400 => 'Permintaan tidak valid.',
            401 => 'Autentikasi diperlukan.',
            403 => 'Akses ditolak.',
            404 => 'Halaman tidak ditemukan.',
            405 => 'Metode tidak diizinkan.',
            408 => 'Waktu permintaan habis.',
            429 => 'Terlalu banyak permintaan.',
            500 => 'Kesalahan internal server.',
            502 => 'Bad gateway.',
            503 => 'Layanan tidak tersedia.',
        ];
        return $messages[$code] ?? 'Terjadi kesalahan.';
    }
}
