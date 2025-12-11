<?php
class User {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    // Login – cari user berdasarkan email
    public function find($email){
        $stmt = $this->db->conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    function create($n,$e,$p){

  // cek apakah email sudah ada
  $check = $this->db->conn->prepare("SELECT id FROM users WHERE email=?");
  $check->bind_param('s',$e);
  $check->execute();
  $check->store_result();

  if($check->num_rows > 0){
    return "DUPLICATE";
  }

  // jika belum ada → insert
  $s = $this->db->conn->prepare("INSERT INTO users(name,email,password,role) VALUES(?,?,?,'user')");
  $s->bind_param('sss',$n,$e,$p);
  return $s->execute();
}

    // ✅ Ambil semua user (untuk admin panel)
    public function getAll(){
        $result = $this->db->conn->query("
            SELECT id, name, email, role
            FROM users
            ORDER BY id DESC
        ");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // ✅ Update role user (user <-> admin)
    public function updateRole($id, $role){
        $stmt = $this->db->conn->prepare("UPDATE users SET role=? WHERE id=?");
        $stmt->bind_param("si", $role, $id);
        return $stmt->execute();
    }
}
