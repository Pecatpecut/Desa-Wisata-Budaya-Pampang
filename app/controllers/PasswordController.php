<?php
require_once ROOT . '/app/models/UserModel.php';

class PasswordController extends Controller {
    public function ubah() {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { $this->redirect('admin/password'); }
        $userId  = $_SESSION['admin_id'] ?? 0;
        $current = $_POST['current_password'] ?? '';
        $new     = $_POST['new_password']     ?? '';
        $confirm = $_POST['confirm_password'] ?? '';
        if (!$current || !$new || !$confirm) {
            $_SESSION['error'] = 'Semua field wajib diisi';
        } elseif (strlen($new) < 8) {
            $_SESSION['error'] = 'Password baru minimal 8 karakter';
        } elseif ($new !== $confirm) {
            $_SESSION['error'] = 'Konfirmasi password tidak cocok';
        } else {
            $model = new UserModel();
            $user  = $model->findById($userId);
            if (!$user || !password_verify($current, $user['password'])) {
                $_SESSION['error'] = 'Password saat ini salah';
            } else {
                $model->changePassword($userId, password_hash($new, PASSWORD_DEFAULT));
                $_SESSION['success'] = 'Password berhasil diubah!';
            }
        }
        $this->redirect('admin/password');
    }
}
