<?php
class Controller {

    protected function view($path, $data = []) {
        extract($data);
        $file = ROOT . '/app/views/' . $path . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            Router::renderError(500);
        }
    }

    protected function redirect($url) {
        header('Location: ' . BASE_URL . '/' . $url);
        exit();
    }

    protected function isLoggedIn() {
        return isset($_SESSION['admin_id']);
    }

    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect('login');
        }
    }

    protected function json($data, $code = 200) {
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
