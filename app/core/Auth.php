<?php
class Auth{
  static function check(){
    if(empty($_SESSION['user'])){
      header("Location: ".BASE_URL."/auth/login"); exit;
    }
  }
  static function admin(){
    self::check();
    if(($_SESSION['user']['role']??'user')!=='admin'){
      header("Location: ".BASE_URL."/home"); exit;
    }
  }
}
