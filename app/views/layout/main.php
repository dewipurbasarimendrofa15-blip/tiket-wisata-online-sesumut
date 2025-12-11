<?php
// pastikan session dimulai sebelum output HTML apa pun
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Pariwisata Sumut</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">

  <style>
  /* ========== NAVBAR USER ========== */
  .user-navbar {
    background: white;
    padding: 12px 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    position: sticky; top: 0; z-index: 100;
  }
  .nav-link {
    margin: 0 15px;
    color: #333;
    font-weight: 600;
    text-decoration: none;
  }
  .nav-link:hover { color: #0099ff; }

  .nav-username {
    margin-right: 12px;
    font-weight: 700;
    color: #111;
  }

  .nav-logout {
    background: #ff4d4d;
    padding: 6px 14px;
    color: white !important;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    margin-left: 8px;
  }
  .nav-logout:hover { background: #cc0000; }

  /* ========== NAVBAR ADMIN ========== */
  .admin-navbar {
    background: #111827;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky; top: 0; z-index: 200;
  }
  .admin-logo {
    color: #38bdf8;
    font-size: 20px;
    font-weight: bold;
  }
  .admin-link {
    margin: 0 15px;
    color: #cbd5e1;
    font-weight: 600;
    text-decoration: none;
  }
  .admin-link:hover { color: white; }
  .admin-logout {
    background: #dc2626;
    padding: 8px 16px;
    border-radius: 6px;
    color: white;
    font-weight: bold;
    text-decoration: none;
  }
  .admin-logout:hover { background: #991b1b; }
  </style>
</head>
<body>

<?php
// ambil role & nama dengan safe fallback
$role = $_SESSION['user']['role'] ?? null;
$nama = $_SESSION['user']['nama'] ?? $_SESSION['user']['username'] ?? null;
?>

<?php if(isset($_SESSION['user']) && $role !== 'admin'): ?>
<header class="user-navbar">
  <div><strong style="font-size:20px;">🌎 Pariwisata Sumut</strong></div>

  <nav>
    <a href="<?= BASE_URL ?>/home" class="nav-link">Home</a>
    <a href="<?= BASE_URL ?>/home/about" class="nav-link">About Us</a>
    <a href="<?= BASE_URL ?>/wisata" class="nav-link">Destinasi</a>
  </nav>

  <div style="display:flex; align-items:center;">
    <!-- Tampilkan nama user (sanitize untuk keamanan) -->
    <span class="nav-username">
      <?= htmlspecialchars($nama ?? 'Pengguna') ?>
    </span>

    <a href="<?= BASE_URL ?>/auth/logout" class="nav-logout">Logout</a>
  </div>
</header>
<?php endif; ?>

<?php if(isset($_SESSION['user']) && $role == 'admin'): ?>
<header class="admin-navbar">
  <div class="admin-logo">🛠 Admin Panel</div>
  <nav>
    <a href="<?= BASE_URL ?>/admin" class="admin-link">Dashboard</a>
    <a href="<?= BASE_URL ?>/admin/wisata" class="admin-link">Wisata</a>
    <a href="<?= BASE_URL ?>/admin/user" class="admin-link">User</a>
    <a href="<?= BASE_URL ?>/admin/booking" class="admin-link">Booking</a>
  </nav>
  <div>
    <a href="<?= BASE_URL ?>/auth/logout" class="admin-logout">Logout</a>
  </div>
</header>
<?php endif; ?>

<main style="padding: 30px;">
  <?= $content ?>
</main>

</body>
</html>
