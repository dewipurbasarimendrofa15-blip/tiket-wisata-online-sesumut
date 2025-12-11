<h2>🎟 Tiket Saya</h2>

<?php if(empty($tickets)): ?>
    <p>Belum ada tiket yang dipesan.</p>
<?php endif; ?>

<?php foreach($tickets as $t): ?>
<div style="background:#fff;padding:25px;border-radius:18px;box-shadow:0 10px 30px rgba(0,0,0,.1);margin-bottom:15px;">
    <strong>Kode Tiket:</strong> <?= $t['kode_tiket'] ?><br>
    <strong>Nama:</strong> <?= $t['nama_pengunjung'] ?><br>
    <strong>Tanggal:</strong> <?= $t['tanggal'] ?><br>
    <strong>Jumlah Tiket:</strong> <?= $t['jumlah_tiket'] ?><br>
    <strong>Total:</strong> Rp <?= number_format($t['total_harga']) ?>
</div>
<?php endforeach; ?>
