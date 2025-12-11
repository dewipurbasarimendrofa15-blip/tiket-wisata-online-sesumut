<?php
class WisataController extends Controller {

    public function index(){
    Auth::check();
    $data = $this->model('Wisata')->getAll();
    $this->view('wisata/list', ['data'=>$data]);
}

public function detail($id){
    Auth::check();
    $wisata = $this->model('Wisata')->getById($id);
    $this->view('wisata/detail', ['data'=>$wisata]);
}

}
