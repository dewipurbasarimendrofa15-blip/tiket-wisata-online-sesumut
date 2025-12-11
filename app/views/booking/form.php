<style>
.booking-page {
  background: #f4f6fb;
  padding: 40px 0;
}

/* Card */
.booking-card {
  max-width: 550px;
  margin: auto;
  background: white;
  padding: 40px;
  border-radius: 25px;
  box-shadow: 0 20px 45px rgba(0,0,0,.1);
  animation: fadeIn .8s ease;
}
.booking-card h2 {
  font-size: 32px;
  margin-bottom: 10px;
  color: #002f6c;
  text-align: center;
}
.booking-card p {
  text-align: center;
  color: #666;
  margin-bottom: 35px;
}
.form-group {
  margin-bottom: 25px;
}
.form-group label {
  font-weight: 600;
  margin-bottom: 8px;
  display: block;
  color: #002f6c;
}
.form-group input {
  width: 100%;
  padding: 14px;
  border-radius: 14px;
  border: 2px solid #dfe6f1;
  background: #f9fbff;
  font-size: 15px;
  transition: .2s;
}
.form-group input:focus {
  border-color: #0066ff;
  background: #fff;
  outline: none;
}
.btn-booking {
  width: 100%;
  padding: 15px;
  background: linear-gradient(135deg,#003c93,#0066ff);
  color: white;
  font-size: 18px;
  border-radius: 18px;
  border: none;
  cursor: pointer;
  font-weight: 600;
  transition: .25s ease;
  margin-top: 10px;
}
.btn-booking:hover {
  transform: translateY(-3px);
  box-shadow: 0 12px 25px rgba(0,110,255,.3);
}
@keyframes fadeIn { 
  from { opacity:0; transform:translateY(30px); }
  to   { opacity:1; transform:translateY(0); }
}
</style>
<style>
.price-box {
  background: linear-gradient(135deg,#0066ff,#003c93);
  padding: 18px 20px;
  border-radius: 18px;
  color: white;
  margin-bottom: 25px;
  box-shadow: 0 10px 25px rgba(0,0,0,.15);
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 18px;
  animation: fadeIn .8s ease;
}

.price-box .label {
  font-weight: 600;
  opacity: 0.9;
}

.price-box .value {
  font-size: 22px;
  font-weight: bold;
}
</style>

<div class="booking-wrapper">
  <div class="booking-card">
    <h2>🎫 Pesan Tiket Wisata</h2>
    <p>Isi detail pemesanan tiket wisata Anda</p>

    <form method="POST" action="<?= BASE_URL ?>/booking/process" class="booking-form">

     
     <input type="hidden" name="wisata_id" value="<?= $wisata['id'] ?>">
      <input type="hidden" name="harga_tiket" value="<?= $wisata['harga'] ?>">

    <div class="price-box">
    <div class="label">Harga Tiket</div>
    <div class="value">Rp <?= number_format($wisata['harga']) ?></div>
</div>


      <!-- Nama Pengunjung -->
      <div class="form-group">
        <label>Nama Pengunjung</label>
        <input type="text" name="nama_pengunjung" required placeholder="Masukkan nama lengkap">
      </div>

      <!-- Tanggal -->
      <div class="form-group">
        <label>Tanggal Kunjungan</label>
        <input type="date" name="tanggal" required>
      </div>

      <!-- Jumlah Tiket -->
      <div class="form-group">
        <label>Jumlah Tiket</label>
        <input type="number" name="jumlah_tiket" min="1" required>
      </div>

      <button type="submit" class="btn-booking">Lanjut ke Pembayaran →</button>


    </form>
  </div>
</div>
