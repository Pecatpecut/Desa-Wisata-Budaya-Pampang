<?php
class GaleriModel {
    private $db;
    public $uploadDir;
    public $uploadUrl;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->uploadDir = ROOT . '/public/uploads/galeri/';
        $this->uploadUrl = BASE_URL . '/public/uploads/galeri/';
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM galeri ORDER BY created_at DESC");
        if (!$result) return [];
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as &$row) {
            $row['image'] = $row['image_type'] === 'file'
                ? $this->uploadUrl . $row['image_path']
                : $row['image_path'];
        }
        return $rows;
    }

    public function tambah($title, $imagePath, $imageType) {
        $t  = $this->db->escape($title);
        $p  = $this->db->escape($imagePath);
        $ty = $this->db->escape($imageType);
        $this->db->query("INSERT INTO galeri (title,image_path,image_type) VALUES ('$t','$p','$ty')");
        return $this->db->insertId();
    }

    public function editJudul($id, $title) {
        $id = (int)$id;
        $t  = $this->db->escape($title);
        $this->db->query("UPDATE galeri SET title='$t' WHERE id=$id");
    }

    // BUG FIX #10: Cek result tidak null sebelum fetch_assoc
    public function hapus($id) {
        $id  = (int)$id;
        $res = $this->db->query("SELECT * FROM galeri WHERE id=$id");
        if ($res) {
            $row = $res->fetch_assoc();
            if ($row && $row['image_type'] === 'file') {
                $fp = $this->uploadDir . $row['image_path'];
                if (file_exists($fp)) unlink($fp);
            }
        }
        $this->db->query("DELETE FROM galeri WHERE id=$id");
    }

    public function getById($id) {
        $id    = (int)$id;
        $result = $this->db->query("SELECT * FROM galeri WHERE id=$id");
        if (!$result) return null;
        return $result->fetch_assoc();
    }
}
