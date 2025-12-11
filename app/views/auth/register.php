<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar - Pariwisata Sumut</title>

<style>
*{box-sizing:border-box;font-family:Segoe UI,system-ui}
body{
  margin:0;
  min-height:100vh;
  background:linear-gradient(135deg,#0ea5e9,#2563eb);
  display:flex;
  align-items:center;
  justify-content:center;
}

.container{
  width:920px;
  max-width:95%;
  display:grid;
  grid-template-columns:1.2fr 1fr;
  gap:40px;
  align-items:center;
}

.left{
  color:#fff;
}

.brand{
  font-size:55px;
  font-weight:900;
  margin-bottom:10px;
  letter-spacing:-1px;
}

.desc{
  font-size:22px;
  opacity:.95;
  line-height:1.4;
}

.card{
  background:#fff;
  padding:32px;
  border-radius:20px;
  box-shadow:0 40px 120px rgba(0,0,0,.4);
}

h2{
  margin:0 0 16px;
  text-align:center;
  color:#0f172a;
}

input{
  width:100%;
  padding:15px;
  margin-bottom:14px;
  border-radius:12px;
  border:1px solid #e5e7eb;
  font-size:15px;
  outline:none;
}

input:focus{
  border-color:#2563eb;
  box-shadow:0 0 0 4px rgba(37,99,235,.15);
}

.btn{
  width:100%;
  padding:15px;
  border:none;
  border-radius:12px;
  background:#22c55e;
  color:white;
  font-weight:700;
  font-size:16px;
  cursor:pointer;
}

.btn:hover{
  transform:translateY(-1px);
  box-shadow:0 20px 60px rgba(34,197,94,.6);
}

.link{
  text-align:center;
  margin-top:18px;
  font-size:14px;
}

.link a{
  color:#22c55e;
  font-weight:600;
  text-decoration:none;
}
</style>
</head>
<body>

<div class="container">

  <!-- LEFT -->
  <div class="left">
    <div class="brand">Pariwisata Sumut</div>
    <div class="desc">
      Buat akun untuk menikmati kemudahan pemesanan tiket wisata dan mengakses
      berbagai destinasi populer di Sumatera Utara.
    </div>
  </div>

  <!-- RIGHT -->
  <div class="card">
    <h2>Daftar Akun Baru</h2>
<?php if(!empty($_SESSION['register_error'])): ?>
  <div class="error"><?= $_SESSION['register_error']; unset($_SESSION['register_error']); ?></div>
<?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/auth/registerProcess">
      <input type="text" name="name" placeholder="Nama Lengkap" required>
      <input type="email" name="email" placeholder="Email Aktif" required>
      <input type="password" name="password" class="input" placeholder="Password" required>
      <input type="password" name="password_confirm" class="input" placeholder="Konfirmasi Password" required>

      <button class="btn">Daftar Sekarang</button>
    </form>

    <div class="link">
      Sudah punya akun? <a href="<?= BASE_URL ?>/auth/login">Masuk di sini</a>
    </div>
  </div>

</div>

</body>
</html>
