
<!-- Filter Section -->
<form method="GET" style="margin-bottom:20px; display:flex; gap:10px;">

  <!-- Dropdown Lokasi -->
  <select name="lokasi" style="padding:10px; border-radius:8px;">
      <option value="">Semua Lokasi</option>

      <?php  
      // Ambil daftar lokasi unik dari data
      $lokasiList = array_unique(array_column($data, 'lokasi'));
      sort($lokasiList);

      foreach($lokasiList as $lok): 
      ?>
          <option value="<?= $lok ?>" 
              <?= (isset($_GET['lokasi']) && $_GET['lokasi'] == $lok ? 'selected' : '') ?>>
              <?= $lok ?>
          </option>
      <?php endforeach; ?>
  </select>

  <!-- Search Box -->
  <input 
      type="text" 
      name="search" 
      placeholder="Cari destinasi..." 
      value="<?= $_GET['search'] ?? '' ?>"
      style="padding:10px; flex:1; border-radius:8px;"
  >

  <button 
      type="submit" 
      style="padding:10px 18px; border-radius:8px; background:#2563eb; color:white;">
      Cari
  </button>
</form>

<h2 class="dest-title">Destinasi Wisata Populer</h2>

<div class="dest-grid-pro">
<?php 

// APPLY FILTER =============================================

// 1. Filter lokasi jika dipilih
if(isset($_GET['lokasi']) && $_GET['lokasi'] !== ""){
    $data = array_filter($data, function($w){
        return $w['lokasi'] == $_GET['lokasi'];
    });
}

// 2. Filter search jika diisi
if(isset($_GET['search']) && $_GET['search'] !== ""){
    $cari = strtolower($_GET['search']);
    $data = array_filter($data, function($w) use ($cari){
        return strpos(strtolower($w['nama']), $cari) !== false;
    });
}

?>

<?php foreach($data as $w): ?>
  <div class="dest-card-pro">
    <div class="dest-img-box">
      <img src="<?= BASE_URL ?>/public/uploads/<?= $w['gambar'] ?: 'placeholder.jpg' ?>">
      <div class="dest-price">Rp <?= number_format($w['harga']) ?></div>
    </div>

    <div class="dest-info">
      <span class="dest-location"><?= $w['lokasi'] ?></span>
      <h3><?= $w['nama'] ?></h3>
      <p><?= substr($w['deskripsi'],0,100) ?>...</p>

      <div class="dest-actions">
        <a href="<?= BASE_URL ?>/wisata/detail/<?= $w['id'] ?>" class="btn-detail">Lihat Detail</a>
      </div>
    </div>
  </div>
<?php endforeach ?>
</div>

