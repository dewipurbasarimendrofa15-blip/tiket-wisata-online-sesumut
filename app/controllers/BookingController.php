<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class BookingController extends Controller
{
    // helper: blokir admin dari melakukan aksi booking
    private function blockAdminIfNeeded() {
        if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin') {
            header("Location: " . BASE_URL . "/admin");
            exit;
        }
    }

    public function index($id)
    {
        // wajib login
        Auth::check();

        // admin tidak boleh pesan
        $this->blockAdminIfNeeded();

        // validasi id wisata
        $id = (int)$id;
        if ($id <= 0) {
            $_SESSION['booking_error'] = "ID destinasi tidak valid.";
            header("Location: " . BASE_URL . "/home");
            exit;
        }

        $wisata = $this->model("Wisata")->getById($id);
        if (empty($wisata)) {
            $_SESSION['booking_error'] = "Destinasi tidak ditemukan.";
            header("Location: " . BASE_URL . "/home");
            exit;
        }

        $this->view("booking/form", ["wisata" => $wisata]);
    }

    public function process()
    {
        // wajib login
        Auth::check();

        // admin tidak boleh pesan
        $this->blockAdminIfNeeded();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $_SESSION['booking_error'] = "Akses tidak valid.";
            header("Location: " . BASE_URL . "/home");
            exit;
        }

        $db = new Database();

        // ambil dan sanitasi input
        $user_id   = (int)($_SESSION['user']['id'] ?? 0);
        $wisata_id = (int)($_POST['wisata_id'] ?? 0);
        $nama      = trim($_POST['nama_pengunjung'] ?? 'Pengunjung');
        $tanggal   = $_POST['tanggal_kunjungan'] ?? date('Y-m-d');
        $jumlah    = (int)($_POST['jumlah_tiket'] ?? 1);
        $harga     = (int)($_POST['harga_tiket'] ?? 0);

        // validasi dasar
        if ($user_id <= 0) {
            $_SESSION['booking_error'] = "Silakan login terlebih dahulu.";
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        }

        if ($wisata_id <= 0) {
            $_SESSION['booking_error'] = "Destinasi tidak valid.";
            header("Location: " . BASE_URL . "/home");
            exit;
        }

        if ($jumlah <= 0) $jumlah = 1;
        if ($harga < 0) $harga = 0;

        // validasi tanggal format (YYYY-MM-DD) — jika tidak valid, pakai hari ini
        $d = date_parse($tanggal);
        if (!checkdate($d['month'] ?? 0, $d['day'] ?? 0, $d['year'] ?? 0)) {
            $tanggal = date('Y-m-d');
        }

        // hitung total
        $total = $jumlah * $harga;

        // simpan booking secara aman menggunakan prepared statement
        $stmt = $db->conn->prepare("
            INSERT INTO booking 
                (user_id, wisata_id, nama_pengunjung, tanggal_kunjungan, jumlah_tiket, total_bayar)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        if (!$stmt) {
            $_SESSION['booking_error'] = "Gagal menyiapkan query: " . $db->conn->error;
            header("Location: " . BASE_URL . "/home");
            exit;
        }

        $stmt->bind_param(
            "iissii",
            $user_id,
            $wisata_id,
            $nama,
            $tanggal,
            $jumlah,
            $total
        );

        $ok = $stmt->execute();

        if (!$ok) {
            $_SESSION['booking_error'] = "Gagal menyimpan booking: " . $stmt->error;
            $stmt->close();
            header("Location: " . BASE_URL . "/home");
            exit;
        }

        // ambil ID booking terakhir
        $booking_id = $db->conn->insert_id;
        $stmt->close();

        // simpan ke session supaya bisa dipakai di halaman payment
        $_SESSION['last_booking_id'] = $booking_id;
        $_SESSION['last_price'] = $total;

        // redirect ke halaman payment (kamu punya route payment/index/{id})
        header("Location: " . BASE_URL . "/payment/index/" . $booking_id);
        exit;
    }

}
