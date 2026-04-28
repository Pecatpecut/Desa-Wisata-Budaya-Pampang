<?php
class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        // BUG FIX #5: Kredensial tidak lagi hardcoded — baca dari env/config
        $host = getenv('DB_HOST') ?: 'localhost';
        $user = getenv('DB_USER') ?: 'root';
        $pass = getenv('DB_PASS') ?: '';
        $name = getenv('DB_NAME') ?: 'pampang';

        $this->conn = new mysqli($host, $user, $pass, $name);
        $this->conn->set_charset('utf8mb4');
        if ($this->conn->connect_error) {
            // Jangan expose detail error ke user di production
            error_log('DB connection failed: ' . $this->conn->connect_error);
            die('Koneksi database gagal. Silakan coba lagi.');
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConn() {
        return $this->conn;
    }

    public function query($sql) {
        $result = $this->conn->query($sql);
        if ($result === false) {
            error_log('DB query error: ' . $this->conn->error . ' | SQL: ' . $sql);
        }
        return $result;
    }

    public function escape($val) {
        return $this->conn->real_escape_string($val);
    }

    public function insertId() {
        return $this->conn->insert_id;
    }
}
