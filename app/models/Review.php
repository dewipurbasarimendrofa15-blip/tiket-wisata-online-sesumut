<?php
class Review {
  private $db;

  public function __construct(){
    $this->db = new Database();
  }

  // Ambil review berdasarkan wisata
  public function getByWisata($id){
    $stmt = $this->db->conn->prepare("
      SELECT 
        r.isi,
        r.rating,
        COALESCE(u.name,'Pengunjung') AS name
      FROM review r
      LEFT JOIN users u ON r.user_id = u.id
      WHERE r.wisata_id = ?
    ");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  // ✅ TAMBAHAN: simpan review
  public function create($data){
    $stmt = $this->db->conn->prepare("
      INSERT INTO review (user_id, wisata_id, rating, isi)
      VALUES (?, ?, ?, ?)
    ");

    $stmt->bind_param(
      "iiis",
      $data['user_id'],
      $data['wisata_id'],
      $data['rating'],
      $data['isi']
    );

    return $stmt->execute();
}

}
