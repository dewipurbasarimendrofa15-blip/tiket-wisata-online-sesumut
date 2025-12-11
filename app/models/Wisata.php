<?php

class Wisata {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Ambil semua baris (satu baris = satu destinasi)
    public function getAll(){
    $res = $this->db->conn->query("SELECT * FROM wisata ORDER BY id ASC");
        if(!$res) return [];
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    // Ambil semua wisata tapi gabungkan gambar (jika tabel wisata_images ada)
    public function getAllWithImages(){
        $check = $this->db->conn->query("SHOW TABLES LIKE 'wisata_images'");
        if($check && $check->num_rows > 0){
            $sql = "
                SELECT 
                    w.*,
                    GROUP_CONCAT(i.url SEPARATOR '||') AS images
                FROM wisata w
                LEFT JOIN wisata_images i ON i.wisata_id = w.id
                GROUP BY w.id
                ORDER BY w.id DESC
            ";
            $res = $this->db->conn->query($sql);
            if(!$res) return $this->getAll();
            $rows = $res->fetch_all(MYSQLI_ASSOC);
            foreach($rows as &$r){
                $r['images'] = $r['images'] ? explode('||', $r['images']) : [];
            }
            return $rows;
        } else {
            return $this->getAll();
        }
    }

    // Total mentah di DB (COUNT(*))
    public function getTotalFromDb(){
        $res = $this->db->conn->query("SELECT COUNT(*) AS total FROM wisata");
        if(!$res) return 0;
        $row = $res->fetch_assoc();
        return (int) ($row['total'] ?? 0);
    }

    // Total "aktif" — jika onlyActive true, gunakan deleted_at/is_active bila ada.
   public function getTotalDestinasi(){
    $sql = "SELECT COUNT(*) AS total FROM wisata";
    $res = $this->db->conn->query($sql);
    if(!$res) return 0;
    $row = $res->fetch_assoc();
    return (int) ($row['total'] ?? 0);
}


    // Ambil satu wisata by id
    public function getById($id){
        $stmt = $this->db->conn->prepare("SELECT * FROM wisata WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // Helper: cek apakah kolom ada di tabel
    private function columnExists($table, $column){
        $t = $this->db->conn->real_escape_string($table);
        $c = $this->db->conn->real_escape_string($column);
        $sql = "SHOW COLUMNS FROM `{$t}` LIKE '{$c}'";
        $res = $this->db->conn->query($sql);
        return ($res && $res->num_rows > 0);
    }
}
