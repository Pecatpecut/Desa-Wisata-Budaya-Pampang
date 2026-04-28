<?php
class PostinganModel {
    private $db;
    public $uploadDir;
    public $uploadUrl;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->uploadDir = ROOT . '/public/uploads/postingan/';
        $this->uploadUrl = BASE_URL . '/public/uploads/postingan/';
    }

    public function getAll() {
        $result = $this->db->query("SELECT * FROM postingan ORDER BY date DESC, created_at DESC");
        if (!$result) return [];
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as &$row) {
            $row['thumbnail'] = $row['thumbnail_type'] === 'file'
                ? $this->uploadUrl . $row['thumbnail_path']
                : $row['thumbnail_path'];
        }
        return $rows;
    }

    public function tambah($title, $link, $source, $thumbPath, $thumbType) {
        $t  = $this->db->escape($title);
        $l  = $this->db->escape($link);
        $s  = $this->db->escape($source);
        $tp = $this->db->escape($thumbPath);
        $tt = $this->db->escape($thumbType);
        $d  = date('Y-m-d');
        $this->db->query("INSERT INTO postingan (title,link,source,thumbnail_path,thumbnail_type,date) VALUES ('$t','$l','$s','$tp','$tt','$d')");
        return $this->db->insertId();
    }

public function edit($id, $title, $link, $source) {
    $id = (int)$id;
    $t  = $this->db->escape($title);
    $l  = $this->db->escape($link);
    $s  = $this->db->escape($source);
    $this->db->query("UPDATE postingan SET title='$t', link='$l', source='$s' WHERE id=$id");
}

    // BUG FIX #10: Cek result sebelum fetch_assoc
    public function hapus($id) {
        $id  = (int)$id;
        $res = $this->db->query("SELECT * FROM postingan WHERE id=$id");
        if ($res) {
            $row = $res->fetch_assoc();
            if ($row && $row['thumbnail_type'] === 'file') {
                $fp = $this->uploadDir . $row['thumbnail_path'];
                if (file_exists($fp)) unlink($fp);
            }
        }
        $this->db->query("DELETE FROM postingan WHERE id=$id");
    }
}
