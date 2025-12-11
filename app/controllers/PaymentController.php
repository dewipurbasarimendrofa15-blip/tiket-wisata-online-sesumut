<?php
class PaymentController extends Controller {

    public function index() {
    if (!isset($_SESSION['user'])) {
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }

    $total = $_SESSION['last_price'] ?? 0;

    $this->view("payment/index", [
        "total" => $total
    ]);
}

public function process() {
    if (!isset($_SESSION['user'])) {
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Invalid request!");
    }

    $metode = $_POST['metode'] ?? null;
    if (!$metode) {
        die("Metode pembayaran belum dipilih!");
    }

    $total = $_SESSION['last_price'] ?? 0;

    $_SESSION['payment_done']  = "Pembayaran berhasil menggunakan metode " . strtoupper($metode);
    $_SESSION['payment_total'] = $total;

    header("Location: " . BASE_URL . "/payment/success");
    exit;
}

function success() {
    if (!isset($_SESSION['user'])) {
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }

    $message    = $_SESSION['payment_done'] ?? "Pembayaran berhasil!";
    $total      = $_SESSION['payment_total'] ?? 0;
    $booking_id = $_SESSION['last_booking_id'] ?? null;

    $this->view("payment/success", [
        "message"    => $message,
        "total"      => $total,
        "booking_id" => $booking_id
    ]);
}
}