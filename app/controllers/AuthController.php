<?php
require_once ROOT . '/app/models/UserModel.php';

class AuthController extends Controller {

    public function login() {
        if ($this->isLoggedIn()) {
            $this->redirect('admin');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email    = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (!$email || !$password) {
                $error = 'Semua field harus diisi';
            } else {
                $model = new UserModel();
                $user  = $model->findByEmail($email);

                if ($user && password_verify($password, $user['password'])) {
                    // BUG FIX #8: Regenerate session ID setelah login (cegah session fixation)
                    session_regenerate_id(true);
                    $_SESSION['admin_id']    = $user['id'];
                    $_SESSION['admin_email'] = $user['email'];
                    $this->redirect('admin');
                } else {
                    $error = 'Email atau password salah';
                }
            }
        }

        $this->view('admin/login', ['error' => $error]);
    }

    public function logout() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(), '',
                time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']
            );
        }
        session_destroy();
        $this->redirect('login');
    }
}
