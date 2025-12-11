<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Pariwisata Sumut</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">
</head>
<body>

<?php if(isset($_SESSION['user'])): ?>
<header class="ultra-navbar">
  <div class="nav-left">
    <div class="logo-box">
      <div class="logo-icon">🌎</div>
      <div class="logo-text">
        <span>Pariwisata</span> Sumut
      </div>
    </div>
  </div>

  <nav class="nav-center">
    <a href="<?= BASE_URL ?>/home" class="nav-link">Home</a>
    <a href="<?= BASE_URL ?>/home/about" class="nav-link">About Us</a>
    <a href="<?= BASE_URL ?>/wisata" class="nav-link">Destinasi</a>
  </nav>

 <div class="nav-right">
    <a href="<?= BASE_URL ?>/auth/logout" class="nav-logout">Logout</a>
</div>

</header>
<?php endif; ?>

<main class="main-wrapper">
  <?= $content ?? '' ?>
</main>

</body>
</html>
