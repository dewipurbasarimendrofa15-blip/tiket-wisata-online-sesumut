<?php
class TicketController extends Controller {

   public function show($id) {
    // wajib login
    Auth::check();

    // validasi id sebagai integer
    $id = (int)$id;
    if ($id <= 0) {
        die("Tiket tidak valid.");
    }

    // blokir admin agar tidak menggunakan halaman user untuk melihat/bertindak
    $role = $_SESSION['user']['role'] ?? 'user';
    if ($role === 'admin') {
        // arahkan admin ke halaman admin yang sesuai (mis: daftar booking)
        header("Location: " . BASE_URL . "/admin/booking");
        exit;
    }

    // ambil data tiket dengan prepared statement (aman dari SQL injection)
    $db = new Database();
    $stmt = $db->conn->prepare("
        SELECT 
            b.*,
            w.nama AS nama_wisata
        FROM booking b
        LEFT JOIN wisata w ON b.wisata_id = w.id
        WHERE b.id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $res = $stmt->get_result();

    if (!$res || $res->num_rows == 0) {
        die("Tiket tidak ditemukan");
    }

    $tiket = $res->fetch_assoc();

    // pastikan tiket milik user yang sedang login
    $currentUserId = $_SESSION['user']['id'] ?? null;
    if ($tiket['user_id'] != $currentUserId) {
        // tidak berhak melihat tiket orang lain
        die("Anda tidak berhak melihat tiket ini.");
    }

    $this->view("ticket/show", [
        "tiket" => $tiket
    ]);
}

}


