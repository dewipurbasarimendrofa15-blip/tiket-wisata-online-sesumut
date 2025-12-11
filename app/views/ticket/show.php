<style>
body {
    background: linear-gradient(135deg, #0f2027, #2c5364);
    font-family: 'Segoe UI', sans-serif;
}

.ticket {
    max-width: 420px;
    background: white;
    margin: 100px auto;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 15px 40px rgba(0,0,0,.25);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.ticket:before {
    content:"";
    position:absolute;
    top:0;
    left:0;
    right:0;
    height:8px;
    background:linear-gradient(90deg,#00c6ff,#0072ff);
}

.ticket h2 {
    margin-bottom:10px;
    color:#2980b9;
}

.ticket .row {
    margin:10px 0;
    font-size:15px;
    color:#444;
}

.qr-box {
    margin:15px 0;
    font-size: 70px;
}

.back-btn {
    display:block;
    margin-top:20px;
    padding:12px;
    background:linear-gradient(135deg,#2ecc71,#27ae60);
    color:white;
    text-decoration:none;
    border-radius:50px;
    font-weight:bold;
}
</style>

<div class="ticket">
    <h2>🎫 Tiket Wisata</h2>

    <div class="qr-box">📱✅</div>

    <div class="row"><b>Nama Wisata:</b> <?= $tiket['nama_wisata'] ?></div>
    <div class="row"><b>Nama Pengunjung:</b> <?= $tiket['nama_pengunjung'] ?></div>
    <div class="row"><b>Tanggal Kunjungan:</b> <?= $tiket['tanggal_kunjungan'] ?></div>
    <div class="row"><b>Jumlah Tiket:</b> <?= $tiket['jumlah_tiket'] ?></div>
    <div class="row"><b>Total Bayar:</b> Rp <?= number_format($tiket['total_bayar']) ?></div>

    <a href="<?= BASE_URL ?>/home" class="back-btn">🏠 Kembali ke Beranda</a>
</div>
