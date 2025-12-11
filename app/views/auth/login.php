<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Masuk - Pariwisata Sumut</title>

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
  width:900px;
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
  margin:0 0 14px;
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
  background:#2563eb;
  color:#fff;
  font-weight:700;
  font-size:16px;
  cursor:pointer;
}

.btn:hover{
  transform:translateY(-1px);
  box-shadow:0 20px 60px rgba(37,99,235,.6);
}

.link{
  text-align:center;
  margin:14px 0;
}

.link a{
  color:#2563eb;
  font-size:14px;
  text-decoration:none;
  font-weight:600;
}

.hr{
  height:1px;
  background:#e5e7eb;
  margin:18px 0;
}

.create-btn{
  display:block;
  width:100%;
  text-align:center;
  padding:14px;
  background:#22c55e;
  color:#fff;
  font-weight:700;
  border-radius:12px;
  text-decoration:none;
}

.error{
  background:#fee2e2;
  color:#b91c1c;
  padding:12px;
  border-radius:12px;
  margin-bottom:15px;
  text-align:center;
}
</style>
</head>
<body>

<div class="container">

  <!-- LEFT SIDE -->
  <div class="left">
    <div class="brand">Pariwisata Sumut</div>
    <div class="desc">
      Website pemesanan tiket wisata online yang memudahkan Anda menjelajahi
      destinasi terbaik di Sumatera Utara.
    </div>
  </div>

  <!-- RIGHT SIDE -->
  <div class="card">

    <h2>Masuk ke Akun</h2>

    <?php if(!empty($_SESSION['login_error'])): ?>
      <div class="error"><?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/auth/loginProcess">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button class="btn">Masuk</button>
    </form>

    <div class="link">
      <a href="<?= BASE_URL ?>/auth/forgot">Lupa Password?</a>
    </div>

    <div class="hr"></div>

    <a href="<?= BASE_URL ?>/auth/register" class="create-btn">
      Buat Akun Baru
    </a>
<?php if(!empty($_SESSION['register_success'])): ?>
  <div class="success"><?= $_SESSION['register_success']; unset($_SESSION['register_success']); ?></div>
<?php endif; ?>

  </div>

</div>

</body>
</html>
