<?php ob_start(); ?>

<h2>Detail Booking #<?= $b['id'] ?></h2>

<div style="display:flex;gap:20px">
  <div style="flex:1;background:#fff;padding:16px;border-radius:10px">
    <p><strong>User:</strong> <?= htmlspecialchars($b['user_name'] ?? '-') ?> (ID <?= $b['user_id'] ?>)</p>
    <p><strong>Wisata:</strong> <?= htmlspecialchars($b['wisata_nama'] ?? '-') ?> (ID <?= $b['wisata_id'] ?>)</p>
    <p><strong>Nama Pengunjung:</strong> <?= htmlspecialchars($b['nama_pengunjung'] ?? '-') ?></p>
    <p><strong>Tanggal:</strong> <?= htmlspecialchars($b['tanggal_kunjungan'] ?? '-') ?></p>
    <p><strong>Jumlah tiket:</strong> <?= $b['jumlah_tiket'] ?></p>
    <p><strong>Total bayar:</strong> Rp <?= number_format($b['total_bayar']) ?></p>
    <p><strong>Status:</strong> <?= ucfirst($b['status']) ?></p>
  </div>
</div>

<p style="margin-top:12px;">
  <a href="<?= BASE_URL ?>/admin/booking" class="btn-ghost">Kembali</a>
  <a href="<?= BASE_URL ?>/admin/setBookingStatus/<?= $b['id'] ?>/dibayar" class="btn-primary" onclick="return confirm('Set Dibayar?')">Set Dibayar</a>
  <a href="<?= BASE_URL ?>/admin/setBookingStatus/<?= $b['id'] ?>/selesai" class="btn-primary" onclick="return confirm('Set Selesai?')">Set Selesai</a>
</p>
<p>
    <?php if($b['status'] == 'pending'): ?>
        <a href="<?= BASE_URL ?>/admin/setBookingStatus/<?= $b['id'] ?>/dibayar"
           class="btn-primary"
           onclick="return confirm('Set status ke DIBAYAR?')">
           Set Dibayar
        </a>

    <?php elseif($b['status'] == 'dibayar'): ?>
        <a href="<?= BASE_URL ?>/admin/setBookingStatus/<?= $b['id'] ?>/selesai"
           class="btn-primary"
           onclick="return confirm('Set status ke SELESAI?')">
           Set Selesai
        </a>

    <?php else: ?>
        <span style="color:green;font-weight:bold;">Booking Selesai</span>
    <?php endif; ?>
</p>

<?php $content = ob_get_clean(); include __DIR__ . '/../layout/admin.php'; ?>
