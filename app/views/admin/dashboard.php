<?php ob_start(); ?>

<h1>Dashboard Admin</h1>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:20px;">
  <div class="card">
    <h3>Total Wisata</h3>
    <h1><?= $wisata ?></h1>
  </div>

  <div class="card">
    <h3>Total Booking</h3>
    <h1><?= $booking ?></h1>
  </div>

  <div class="card">
    <h3>Total User</h3>
    <h1><?= $users ?></h1>
  </div>
</div>

<?php $content = ob_get_clean(); include "app/views/layout/admin.php"; ?>
