<?php

class Booking {

    private $db;

    public function __construct() {
        $this->db = new Database();  // Database kamu pasti punya ->conn
    }

    public function create($wisata_id, $tanggal, $jumlah_tiket) {

        $conn = $this->db->conn; // ambil koneksi mysqli

        $sql = "INSERT INTO booking (wisata_id, tanggal_kunjungan, jumlah_tiket)
                VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("isi", $wisata_id, $tanggal, $jumlah_tiket);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
    }
}
