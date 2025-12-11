<link rel="stylesheet" href="<?= BASE_URL ?>/public/css/style.css">

<div class="fb-container">
  <div class="fb-left">
    <h1>Reset Password</h1>
    <p>Masukkan email dan password baru</p>
  </div>

  <div class="fb-card">

    <?php if(isset($_SESSION['forgot_error'])): ?>
      <div style="background:#ffe3e3;color:#b00020;padding:12px;border-radius:6px;margin-bottom:12px;">
        <?= $_SESSION['forgot_error']; ?>
      </div>
      <?php unset($_SESSION['forgot_error']); ?>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/auth/resetProcess">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password Baru" required>
      <button class="fb-btn-login">Ubah Password</button>
    </form>

    <div class="fb-divider"></div>

    <a href="<?= BASE_URL ?>/auth/login" class="fb-link">Kembali ke Login</a>

  </div>
</div>
