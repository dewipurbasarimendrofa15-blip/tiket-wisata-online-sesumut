<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class Controller {

    public function model($model){
        require_once "app/models/$model.php";
        return new $model();
    }

    public function view($view, $data = []){
        extract($data);

        // Tangkap isi view ke variabel
        $content = $this->loadView($view, $data);

        // Kirim ke layout
        require "app/views/layout/main.php";
    }

    private function loadView($view, $data){
        extract($data);
        ob_start();
        require "app/views/$view.php";
        return ob_get_clean();
    }
}
