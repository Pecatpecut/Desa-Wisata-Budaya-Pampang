<?php
class UserModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function findByEmail($email) {
        $e = $this->db->escape($email);
        return $this->db->query("SELECT * FROM users WHERE email='$e' LIMIT 1")->fetch_assoc();
    }

    public function findById($id) {
        $id = (int)$id;
        $r  = $this->db->query("SELECT * FROM users WHERE id=$id LIMIT 1");
        return $r ? $r->fetch_assoc() : null;
    }

    public function changePassword($id, $hash) {
        $id   = (int)$id;
        $hash = $this->db->escape($hash);
        $this->db->query("UPDATE users SET password='$hash' WHERE id=$id");
    }
}
