<?php
class HomeController extends Controller {
  public function index(){
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user'])) {
      header("Location: " . BASE_URL . "/auth/login");
      exit;
    }

    $wisataModel = $this->model("Wisata");

    // Ambil daftar wisata — method ini aman: jika tabel wisata_images tidak ada,
    // model akan fallback ke getAll().
    $data = $wisataModel->getAllWithImages();

    // Ambil total destinasi yang akurat
    $total_wisata = $wisataModel->getTotalDestinasi();

    // render view (pattern include manual seperti proyekmu)
    ob_start();
    // view dapat memakai $data dan $total_wisata
    include "app/views/home/index.php";
    $content = ob_get_clean();
    include "app/views/layout/main.php";
  }

  public function about() {
    if (session_status() === PHP_SESSION_NONE) session_start();

    if (!isset($_SESSION['user'])) {
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }

    ob_start();
    include "app/views/home/about.php";
    $content = ob_get_clean();

    include "app/views/layout/main.php";
  }
}
