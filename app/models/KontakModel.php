<?php
class KontakModel {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    // BUG FIX #10: Cek result tidak null sebelum fetch_assoc
    public function get() {
        $result = $this->db->query("SELECT * FROM kontak LIMIT 1");
        if (!$result) return null;
        return $result->fetch_assoc();
    }

    public function update($data) {
        $fields = ['alamat','email','whatsapp1','whatsapp2','instagram','jam_weekdays','jam_sunday',
                   'parkir_motor','parkir_mobil','parkir_bus','wisata_tarian',
                   'wisata_lamin','wisata_susur','biaya_foto','biaya_sewa'];
        $sets = [];
        foreach ($fields as $f) {
            $v = $this->db->escape($data[$f] ?? '');
            $sets[] = "`$f`='$v'";
        }
        $this->db->query("UPDATE kontak SET " . implode(',', $sets) . " WHERE id=1");
    }
}
