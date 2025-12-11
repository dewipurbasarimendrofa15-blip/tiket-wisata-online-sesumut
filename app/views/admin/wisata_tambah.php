<?php
// gunakan pattern ob_start agar layout admin menerima $content
ob_start();
?>

<style>
/* tampilan form admin yang bersih & responsif */
.form-card {
  max-width:720px;
  margin:20px auto;
  background:#fff;
  border-radius:14px;
  padding:22px;
  box-shadow:0 20px 50px rgba(2,6,23,0.08);
  font-family: "Segoe UI", Roboto, Arial, sans-serif;
}

.form-card h2{
  margin:0 0 16px;
  font-size:20px;
  color:#0f172a;
}

.form-row{
  display:flex;
  gap:14px;
  margin-bottom:12px;
  flex-wrap:wrap;
}

.form-field{
  flex:1 1 250px;
  display:flex;
  flex-direction:column;
}

label{
  font-size:13px;
  color:#334155;
  margin-bottom:6px;
  font-weight:600;
}

.input, .textarea, .select {
  padding:12px 14px;
  border-radius:10px;
  border:1px solid #e6eef6;
  background:#fbfdff;
  font-size:14px;
  outline:none;
  transition:box-shadow .12s, border-color .12s;
}

.input:focus, .textarea:focus, .select:focus {
  box-shadow:0 6px 20px rgba(37,99,235,0.12);
  border-color:#2563eb;
}

.textarea{
  min-height:120px;
  resize:vertical;
}

.help { font-size:12px;color:#64748b;margin-top:6px; }

.preview {
  width:180px;
  height:120px;
  border-radius:10px;
  object-fit:cover;
  border:1px solid #e6eef6;
  display:block;
  margin-top:6px;
  box-shadow:0 6px 20px rgba(2,6,23,0.04);
}

.actions{
  display:flex;
  gap:12px;
  margin-top:16px;
  flex-wrap:wrap;
}

.btn-primary{
  background:linear-gradient(135deg,#06b6d4,#2563eb);
  color:#fff;
  border:none;
  padding:12px 18px;
  border-radius:10px;
  font-weight:700;
  cursor:pointer;
  box-shadow:0 12px 30px rgba(37,99,235,0.18);
}

.btn-ghost{
  background:#f8fafc;
  color:#0f172a;
  border:1px solid #e6eef6;
  padding:12px 16px;
  border-radius:10px;
  cursor:pointer;
}

.note { font-size:13px;color:#475569;margin-top:8px; }

@media (max-width:720px){
  .form-row{flex-direction:column;}
  .preview{width:100%;height:200px;}
}
</style>

<div class="form-card">
  <h2>➕ Tambah Wisata Baru</h2>

  <form method="post" action="<?= BASE_URL ?>/Admin/simpanWisata" enctype="multipart/form-data" id="formTambah">
    <div class="form-row">
      <div class="form-field" style="flex:2">
        <label for="nama">Nama Wisata</label>
        <input id="nama" name="nama" class="input" placeholder="Contoh: Air Terjun Sipiso-piso" required>
        <div class="help">Nama destinasi yang akan tampil pada halaman publik.</div>
      </div>

      <div class="form-field">
        <label for="harga">Harga Tiket (Rp)</label>
        <input id="harga" name="harga" type="number" min="0" class="input" placeholder="50000" required>
        <div class="help">Masukkan angka tanpa tanda pemisah (contoh 50000).</div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-field" style="flex:2">
        <label for="lokasi">Lokasi</label>
        <input id="lokasi" name="lokasi" class="input" placeholder="Kabupaten / Kota - Provinsi" required>
      </div>

    <div style="margin-top:8px;">
      <label for="deskripsi">Deskripsi</label>
      <textarea id="deskripsi" name="deskripsi" class="textarea" placeholder="Tuliskan deskripsi singkat destinasi..."></textarea>
      <div class="help">Deskripsi singkat membantu pengunjung memahami daya tarik destinasi.</div>
    </div>

    <div class="form-row" style="align-items:flex-start;margin-top:12px;">
      <div class="form-field" style="flex:1">
        <label for="gambar">Upload Gambar Utama</label>
        <input id="gambar" name="gambar" type="file" accept="image/*" class="input" required>
        <div class="help">Format: JPG/PNG. Ukuran ideal: 1200x800 px.</div>
      </div>

      <div style="width:200px;text-align:center;">
        <label>Preview Gambar</label>
        <img id="imgPreview" src="<?= BASE_URL ?>/public/uploads/placeholder.jpg" alt="Preview" class="preview">
        <div class="note">Gambar akan muncul di sini saat dipilih.</div>
      </div>
    </div>

    <div class="actions">
      <button type="submit" class="btn-primary">Simpan Wisata</button>
      <a href="<?= BASE_URL ?>/Admin/wisata" class="btn-ghost">Batal</a>
    </div>
  </form>
</div>

<script>
// preview gambar saat upload
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
// sertakan layout admin (pastikan path benar)
include __DIR__ . '/../layout/admin.php';
