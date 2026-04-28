<?php
class AgendaModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function getAll() {
        $res = $this->db->query("SELECT * FROM agenda ORDER BY date ASC, time ASC");
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function tambah($title, $date, $time, $location) {
        $t = $this->db->escape($title);
        $d = $this->db->escape($date);
        $ti = $this->db->escape($time);
        $l = $this->db->escape($location);
        $this->db->query("INSERT INTO agenda (title,date,time,location) VALUES ('$t','$d','$ti','$l')");
        return $this->db->insertId();
    }

    public function edit($id, $title, $date, $time, $location) {
        $id = (int)$id;
        $t = $this->db->escape($title);
        $d = $this->db->escape($date);
        $ti = $this->db->escape($time);
        $l = $this->db->escape($location);
        $this->db->query("UPDATE agenda SET title='$t',date='$d',time='$ti',location='$l' WHERE id=$id");
    }

    public function hapus($id) {
        $id = (int)$id;
        $this->db->query("DELETE FROM agenda WHERE id=$id");
    }
}
