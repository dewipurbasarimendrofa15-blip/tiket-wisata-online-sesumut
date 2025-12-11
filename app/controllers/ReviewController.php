<?php
class ReviewController extends Controller {

  public function store(){
    if(!isset($_SESSION['user'])) {
      header("Location: ".BASE_URL."/auth/login");
      exit;
    }

    $data = [
      'user_id'   => $_SESSION['user']['id'],
      'wisata_id' => $_POST['wisata_id'] ?? 0,
      'isi'       => $_POST['isi'] ?? '',
      'rating'    => $_POST['rating'] ?? 0
    ];

    $this->model("Review")->create($data);

    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit;
  }
}
