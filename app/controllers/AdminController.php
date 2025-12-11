<?php
class AdminController extends Controller {

  private function checkAdmin(){
    if (!isset($_SESSION['user'])) {
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }

    if (($_SESSION['user']['role'] ?? 'user') !== 'admin') {
        header("Location: " . BASE_URL . "/home");
        exit;
    }
}


   public function index(){
    $this->checkAdmin();
    $db = new Database();

    // Hitung destinasi berdasarkan baris valid (32)
    $resWisata = $db->conn->query("SELECT id FROM wisata ORDER BY id ASC");
    $wisata = $resWisata->num_rows;

    $resBooking = $db->conn->query("SELECT * FROM booking");
    $resReview  = $db->conn->query("SELECT * FROM review");
    $resUsers   = $db->conn->query("SELECT * FROM users");

    $this->view("admin/dashboard",[
        "wisata"  => $wisata, 
        "booking" => $resBooking->num_rows,
        "review"  => $resReview->num_rows,
        "users"   => $resUsers->num_rows
    ]);
}

    // ===== WISATA CRUD =====

    public function wisata(){
        $this->checkAdmin();
        $data = $this->model('Wisata')->getAll();
        $this->view("admin/wisata", ["data" => $data]);
    }

    public function tambahWisata(){
        $this->checkAdmin();
        $this->view("admin/wisata_tambah");
    }

   public function simpanWisata(){
    $this->checkAdmin();

    $uploadDir = "public/uploads/";
    $fileName = "";

    if (!empty($_FILES['gambar']['name'])) {
        $fileName = time() . "_" . $_FILES['gambar']['name'];
       	move_uploaded_file(
            $_FILES['gambar']['tmp_name'],
            $uploadDir . $fileName
        );
    }

    $db = new Database();
    $stmt = $db->conn->prepare("
        INSERT INTO wisata (nama, lokasi, harga, gambar)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->bind_param("ssis",
        $_POST['nama'],
        $_POST['lokasi'],
        $_POST['harga'],
        $fileName
    );
    $stmt->execute();

    header("Location: " . BASE_URL . "/Admin/wisata");
    exit;
}


    public function editWisata($id){
        $this->checkAdmin();
        $db = new Database();
        $data = $db->conn->query("SELECT * FROM wisata WHERE id='$id'")->fetch_assoc();

        $this->view("admin/wisata_edit", ["data" => $data]);
    }

    public function updateWisata(){
    $this->checkAdmin();

    $db = new Database();
    $gambar = $_POST['gambar_lama'];

    if (!empty($_FILES['gambar']['name'])) {
        $fileName = time() . "_" . $_FILES['gambar']['name'];
        move_uploaded_file(
            $_FILES['gambar']['tmp_name'],
            "public/uploads/" . $fileName
        );
        $gambar = $fileName;
    }

    $stmt = $db->conn->prepare("
        UPDATE wisata 
        SET nama=?, lokasi=?, harga=?, gambar=? 
        WHERE id=?
    ");
    $stmt->bind_param("ssisi",
        $_POST['nama'],
        $_POST['lokasi'],
        $_POST['harga'],
        $gambar,
        $_POST['id']
    );
    $stmt->execute();

    header("Location: " . BASE_URL . "/Admin/wisata");
    exit;
}

    public function hapusWisata($id){
        $this->checkAdmin();
        $db = new Database();
        $db->conn->query("DELETE FROM wisata WHERE id='$id'");

        header("Location: " . BASE_URL . "/Admin/wisata");
        exit;
    }
  // === USER MANAGEMENT ===
public function user(){
    $this->checkAdmin();
    $db = new Database();
    $res = $db->conn->query("SELECT id, name, email, role FROM users ORDER BY id DESC");
    $this->view("admin/user", [
        "data" => $res->fetch_all(MYSQLI_ASSOC)
    ]);
}

public function setRole($id, $role = null){
    $this->checkAdmin();
    $id = (int)$id;
    $role = $role === 'admin' ? 'admin' : 'user'; // aman
    $db = new Database();
    $stmt = $db->conn->prepare("UPDATE users SET role=? WHERE id=?");
    $stmt->bind_param("si", $role, $id);
    $stmt->execute();
    header("Location: " . BASE_URL . "/admin/user");
    exit;
}

public function deleteUser($id){
    $this->checkAdmin();
    $id = (int)$id;
    // mencegah admin menghapus dirinya sendiri (opsional)
    $current = $_SESSION['user']['id'] ?? 0;
    if($id === (int)$current){
        $_SESSION['admin_error'] = "Anda tidak bisa menghapus akun sendiri.";
        header("Location: " . BASE_URL . "/admin/user");
        exit;
    }

    $db = new Database();
    $stmt = $db->conn->prepare("DELETE FROM users WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    header("Location: " . BASE_URL . "/admin/user");
    exit;
}

// === BOOKING MANAGEMENT ===
public function booking(){
    $this->checkAdmin();
    $db = new Database();

    $res = $db->conn->query("
        SELECT 
            b.id,
            b.user_id,
            u.name AS user_name,
            b.wisata_id,
            w.nama AS wisata_nama,
            b.tanggal_kunjungan,
            b.jumlah_tiket,
            b.total_bayar,
            b.status,
            b.nama_pengunjung
        FROM booking b
        LEFT JOIN users u ON b.user_id = u.id
        LEFT JOIN wisata w ON b.wisata_id = w.id
        ORDER BY b.id DESC
    ");

    $this->view("admin/booking",[
        "data" => $res->fetch_all(MYSQLI_ASSOC)
    ]);
}

public function viewBooking($id){
    $this->checkAdmin();
    $id = (int)$id;
    $db = new Database();
    $stmt = $db->conn->prepare("
        SELECT b.*, u.name AS user_name, w.nama AS wisata_nama 
        FROM booking b
        LEFT JOIN users u ON b.user_id = u.id
        LEFT JOIN wisata w ON b.wisata_id = w.id
        WHERE b.id = ? LIMIT 1
    ");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    $res = $stmt->get_result();
    $booking = $res->fetch_assoc();
    $this->view("admin/booking_view", ["b" => $booking]);
}

public function setBookingStatus($id, $status = null){
    $this->checkAdmin();
    
    $id = (int)$id;

    // Status yang boleh
    $allowed = ['pending', 'dibayar', 'selesai'];
    if(!in_array($status, $allowed)){
        $status = 'pending';
    }

    // Update ke database
    $db = new Database();
    $stmt = $db->conn->prepare("UPDATE booking SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    // Kembali ke halaman admin booking
    header("Location: " . BASE_URL . "/admin/booking");
    exit;
}


public function deleteBooking($id){
    $this->checkAdmin();
    $id = (int)$id;
    $db = new Database();
    $stmt = $db->conn->prepare("DELETE FROM booking WHERE id=?");
    $stmt->bind_param("i",$id);
    $stmt->execute();
    header("Location: " . BASE_URL . "/admin/booking");
    exit;
}


}
