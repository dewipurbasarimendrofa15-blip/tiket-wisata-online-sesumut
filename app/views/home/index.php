<div class="home-hero">
    <div class="home-overlay">
        <h1>Pariwisata Sumatera Utara</h1>
        <p>Jelajahi keindahan alam dan budaya Sumatera Utara bersama kami</p>
        <a href="<?= BASE_URL ?>/wisata" class="home-btn">Lihat Destinasi</a>
    </div>
</div>

<section class="home-section">
    <h2>Kenapa Pilih Kami?</h2>
    <div class="home-grid">
        <div class="home-card">
            <h3>🌄 Destinasi Terbaik</h3>
            <p>Kami menyajikan berbagai pilihan destinasi wisata populer di Sumatera Utara dengan informasi terlengkap.</p>
        </div>

        <div class="home-card">
            <h3>⭐ Terpercaya</h3>
            <p>Platform pariwisata yang dirancang untuk memberikan pengalaman terbaik bagi wisatawan.</p>
        </div>

        <div class="home-card">
            <h3>📍 Info Akurat</h3>
            <p>Setiap destinasi dilengkapi dengan deskripsi detail dan informasi lokasi yang jelas.</p>
        </div>
    </div>
</section>

<!-- ===== Destinasi Populer (PERBAIKAN: hitung total unik di view) ===== -->
<?php
// Jika controller sudah mengirim $total_wisata (rekomendasi), gunakan itu.
// Jika tidak, hitung dari $data (menghindari duplikat karena JOIN).
if (!isset($total_wisata)) {
    if (!empty($data) && is_array($data)) {
        $ids = array_column($data, 'id');
        $total_wisata = count(array_unique($ids));
    } else {
        $total_wisata = 0;
    }
}
?>
<section class="home-section">
    <h2 class="dest-title">Destinasi Wisata Populer <small style="font-weight:600;color:#666;font-size:0.7em;">(<?= htmlspecialchars($total_wisata) ?> destinasi)</small></h2>

    <div class="dest-grid-pro">
    <?php if(!empty($data) && is_array($data)): ?>
      <?php foreach($data as $w): ?>
        <div class="dest-card-pro">
          <div class="dest-img-box">
            <img src="<?= BASE_URL ?>/public/uploads/<?= htmlspecialchars($w['gambar'] ?: 'placeholder.jpg') ?>">
            <div class="dest-price">Rp <?= number_format($w['harga']) ?></div>
          </div>

          <div class="dest-info">
            <span class="dest-location"><?= htmlspecialchars($w['lokasi']) ?></span>
            <h3><?= htmlspecialchars($w['nama']) ?></h3>
            <p><?= htmlspecialchars(substr($w['deskripsi'],0,100)) ?>...</p>

            <div class="dest-actions">
              <a href="<?= BASE_URL ?>/wisata/detail/<?= (int)$w['id'] ?>" class="btn-detail">Lihat Detail</a>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    <?php else: ?>
      <p>Tidak ada destinasi yang tersedia.</p>
    <?php endif ?>
    </div>
</section>
