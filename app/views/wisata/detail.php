<?php if(empty($data)): ?>
  <h2>Data wisata tidak ditemukan</h2>
<?php else: ?>

<div class="detail-container">

  <div class="detail-hero">
    <img src="<?= BASE_URL ?>/public/uploads/<?= $data['gambar'] ?? 'placeholder.jpg' ?>">
    <div class="detail-overlay">
      <h1><?= htmlspecialchars($data['nama'] ?? '') ?></h1>
      <span class="detail-location">📍 <?= htmlspecialchars($data['lokasi'] ?? '') ?></span>
    </div>
  </div>

  <div class="detail-content">
    <div class="detail-left">
      <h2>Deskripsi</h2>
      <p><?= nl2br(htmlspecialchars($data['deskripsi'] ?? '')) ?></p>
    </div>

    <div class="detail-right">
      <div class="price-card">
        <h3>Harga Mulai</h3>
        <div class="price-value">
          Rp <?= number_format($data['harga'] ?? 0) ?>
        </div>

        <!-- ❗ TOMBOL BOOKING HANYA MUNCUL JIKA BUKAN ADMIN -->
        <?php if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin'): ?>
            <a href="<?= BASE_URL ?>/booking/form/<?= $data['id'] ?? 0 ?>" class="btn-book-now">
              Pesan Sekarang
            </a>
        <?php else: ?>
            <div class="admin-notice">👮 Anda adalah Admin — Booking dinonaktifkan.</div>
        <?php endif; ?>

      </div>
    </div>
  </div>

</div>

<?php endif; ?>
