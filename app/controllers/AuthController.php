<?php
class AuthController extends Controller{

  function login(){ $this->view("auth/login"); }
  function register(){ $this->view("auth/register"); }

  public function loginProcess(){
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = $this->model("User")->find($email);

    if($user && password_verify($password, $user['password'])){

        // Simpan hanya data penting ke session
        $_SESSION['user'] = [
            'id'    => $user['id'],
            'name'  => $user['name'],
            'email' => $user['email'],
            'role'  => $user['role'] ?? 'user' // ⬅️ penting untuk admin
        ];

        // Redirect berbeda untuk admin
        if ($_SESSION['user']['role'] === 'admin') {
            header("Location: " . BASE_URL . "/Admin");
        } else {
            header("Location: " . BASE_URL . "/home");
        }
        exit;

    } else {
        $_SESSION['login_error'] = "Email atau password salah";
        header("Location: " . BASE_URL . "/auth/login");
        exit;
    }
  }

  public function forgot(){
    $this->view("auth/forgot");
  }

  public function resetProcess(){
    $email = $_POST['email'] ?? '';
    $newPassword = $_POST['password'] ?? '';

    $user = $this->model("User")->find($email);

    if(!$user){
        $_SESSION['forgot_error'] = "Email tidak ditemukan";
        header("Location: " . BASE_URL . "/auth/forgot");
        exit;
    }

    $hashed = password_hash($newPassword, PASSWORD_DEFAULT);

    $db = new Database();
    $stmt = $db->conn->prepare("UPDATE users SET password=? WHERE email=?");
    $stmt->bind_param("ss", $hashed, $email);
    $stmt->execute();

    $_SESSION['forgot_success'] = "Password berhasil diubah!";
    header("Location: " . BASE_URL . "/auth/login");
    exit;
  }

 function registerProcess(){

    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $pass     = $_POST['password'] ?? '';
    $confirm  = $_POST['password_confirm'] ?? '';

    // validasi panjang password
    if(strlen($pass) < 8){
        $_SESSION['register_error'] = "Password minimal 8 karakter.";
        header("Location: " . BASE_URL . "/auth/register");
        exit;
    }

    // validasi kecocokan password
    if($pass !== $confirm){
        $_SESSION['register_error'] = "Konfirmasi password tidak cocok.";
        header("Location: " . BASE_URL . "/auth/register");
        exit;
    }

    $result = $this->model("User")->create(
        $name,
        $email,
        password_hash($pass, PASSWORD_DEFAULT)
    );

    if($result === "DUPLICATE"){
        $_SESSION['register_error'] = "Email sudah terdaftar. Gunakan email lain.";
        header("Location: " . BASE_URL . "/auth/register");
        exit;
    }

    $_SESSION['register_success'] = "Registrasi berhasil. Silakan login.";
    header("Location: " . BASE_URL . "/auth/login");
    exit;
}



  function logout(){
    session_destroy();
    header("Location: ".BASE_URL."/auth/login");
  }
  public function makeAdmin($id){
    $this->guard();
    $this->model("User")->updateRole($id, 'admin');
    header("Location: " . BASE_URL . "/Admin/users");
    exit;
}

public function makeUser($id){
    $this->guard();
    $this->model("User")->updateRole($id, 'user');
    header("Location: " . BASE_URL . "/Admin/users");
    exit;
}

}
