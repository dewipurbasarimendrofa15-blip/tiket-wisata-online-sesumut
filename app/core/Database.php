<?php
class Database{
  public $conn;
  function __construct(){
    $this->conn=new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  }
}
