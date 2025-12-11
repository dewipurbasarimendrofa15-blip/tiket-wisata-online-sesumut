<?php
// Buffer output supaya layout admin menerima $content
ob_start();

// data yang diharapkan dikirim dari controller
$w = $data ?? [];
?>

<style>
/* styling ringkas agar serasi dengan halaman tambah */
.form-card {
  max-width:760px;
  margin:18px auto;
  background:#fff;
  border-radius:12px;
  padding:18px;
  box-shadow:0 18px 50px rgba(2,6,23,0.06);
  font-family: "Segoe UI", Roboto, Arial, sans-serif;
}
.form-card h2{margin:0 0 12px;color:#0f172a}
.form-row{display:flex;gap:12px;flex-wrap:wrap;margin-bottom:10px}
.form-field{flex:1 1 250px;display:flex;flex-direction:column}
label{font-size:13px;color:#334155;margin-bottom:6px;font-weight:600}
.input, .textarea {padding:10px;border-radius:10px;border:1px solid #e6eef6;background:#fbfdff}
.input:focus, .textarea:focus{outline:none;box-shadow:0 8px 30px rgba(37,99,235,0.12);border-color:#2563eb}
.preview{width:200px;height:130px;border-radius:10px;object-fit:cover;border:1px solid #e6eef6;margin-top:6px}
.actions{display:flex;gap:12px;margin-top:14px;flex-wrap:wrap}
.btn-primary{background:linear-gradient(135deg,#06b6d4,#2563eb);color:#fff;padding:12px 18px;border-radius:10px;border:none;cursor:pointer;font-weight:700}
.btn-ghost{background:#f8fafc;color:#0f172a;border:1px solid #e6eef6;padding:12px 16px;border-radius:10px;text-decoration:none;display:inline-block}
@media (max-width:720px){.form-row{flex-direction:column}.preview{width:100%;height:220px}}
.error{background:#fee2e2;color:#7f1d1d;padding:10px;border-radius:10px;margin-bottom:10px}
.success{background:#dcfce7;color:#14532d;padding:10px;border-radius:10px;margin-bottom:10px}
</style>

<div class="form-card">
  <h2>✏️ Edit Wisata</h2>

  <?php if(!empty($_SESSION['form_error'])): ?>
    <div class="error"><?= $_SESSION['form_error']; unset($_SESSION['form_error']); ?></div>
  <?php endif; ?>

  <?php if(!empty($_SESSION['form_success'])): ?>
    <div class="success"><?= $_SESSION['form_success']; unset($_SESSION['form_success']); ?></div>
  <?php endif; ?>

  <form method="post" action="<?= BASE_URL ?>/Admin/updateWisata" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($w['id'] ?? '') ?>">
    <input type="hidden" name="gambar_lama" value="<?= htmlspecialchars($w['gambar'] ?? '') ?>">

    <div class="form-row">
      <div class="form-field" style="flex:2">
        <label for="nama">Nama Wisata</label>
        <input id="nama" name="nama" class="input" value="<?= htmlspecialchars($w['nama'] ?? '') ?>" required>
      </div>

      <div class="form-field">
        <label for="harga">Harga Tiket (Rp)</label>
        <input id="harga" name="harga" type="number" min="0" class="input" value="<?= htmlspecialchars($w['harga'] ?? '') ?>" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-field" style="flex:2">
        <label for="lokasi">Lokasi</label>
        <input id="lokasi" name="lokasi" class="input" value="<?= htmlspecialchars($w['lokasi'] ?? '') ?>" required>
      </div>

      <div class="form-field">
        <label for="kapasitas">Kapasitas (opsional)</label>
        <input id="kapasitas" name="kapasitas" type="number" class="input" value="<?= htmlspecialchars($w['kapasitas'] ?? '') ?>">
      </div>
    </div>

    <div style="margin-top:8px;">
      <label for="deskripsi">Deskripsi (opsional)</label>
      <textarea id="deskripsi" name="deskripsi" class="textarea"><?= htmlspecialchars($w['deskripsi'] ?? '') ?></textarea>
    </div>

    <div class="form-row" style="align-items:flex-start;margin-top:12px;">
      <div class="form-field" style="flex:1">
        <label for="gambar">Ganti Gambar Utama (kosongkan bila tidak ingin mengganti)</label>
        <input id="gambar" name="gambar" type="file" accept="image/*" class="input">
        <div style="font-size:12px;color:#64748b;margin-top:6px">Format: JPG/PNG. Ukuran ideal 1200x800 px.</div>
      </div>

      <div style="width:200px;text-align:center;">
        <label>Preview Gambar Saat Ini</label>
        <?php
          $img = $w['gambar'] ?? 'placeholder.jpg';
          $imgPath = rtrim(BASE_URL, '/') . "/public/uploads/" . $img;
        ?>
        <img id="imgPreview" src="<?= htmlspecialchars($imgPath) ?>" alt="Preview" class="preview">
        <div style="font-size:13px;color:#475569;margin-top:6px">Preview akan berubah saat memilih file baru.</div>
      </div>
    </div>

    <div class="actions">
      <button type="submit" class="btn-primary">Update Data</button>
      <a href="<?= BASE_URL ?>/Admin/wisata" class="btn-ghost">Batal</a>
    </div>
  </form>
</div>

<script>
// preview gambar saat dipilih
document.getElementById('gambar').addEventListener('change', function(e){
  const file = this.files[0];
  if(!file) return;
  if(!file.type.startsWith('image/')) return;
  const reader = new FileReader();
  reader.onload = function(ev){
    document.getElementById('imgPreview').src = ev.target.result;
  };
  reader.readAsDataURL(file);
});
</script>

<?php
$content = ob_get_clean();

// include layout admin via path yang pasti
$layout = __DIR__ . '/../layout/admin.php';
if (file_exists($layout)) {
    include $layout;
} else {
    // fallback: jika file layout admin tidak ditemukan, tampilkan konten langsung
    echo $content;
}
