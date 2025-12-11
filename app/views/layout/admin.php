<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Admin Panel – Pariwisata Sumut</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/admin.css">
</head>
<body>

<header class="admin-navbar">
  <div class="admin-logo">⚙ Admin Panel</div>

  <nav class="admin-menu">
    <a href="<?= BASE_URL ?>/admin" class="admin-link">Dashboard</a>
    <a href="<?= BASE_URL ?>/admin/wisata" class="admin-link">Kelola Wisata</a>
    <a href="<?= BASE_URL ?>/admin/booking" class="admin-link">Kelola Booking</a>
    <a href="<?= BASE_URL ?>/admin/user" class="admin-link">Kelola User</a>
  </nav>

  <div class="admin-right">
    <a href="<?= BASE_URL ?>/auth/logout" class="admin-logout">Logout</a>
  </div>
</header>

<main class="admin-content">
  <?= $content ?? '' ?>
</main>

</body>
</html>
