<?php ob_start(); ?>

<h1>Data Booking</h1>

<table width="100%" cellpadding="10" style="background:#fff;border-radius:10px;overflow:hidden">
  <tr style="background:#0f172a;color:#fff;">
    <th>ID</th>
    <th>User</th>
    <th>Wisata</th>
    <th>Nama Pengunjung</th>
    <th>Tanggal</th>
    <th>Jumlah</th>
    <th>Total</th>
    <th>Status</th>
    <th>Aksi</th>
  </tr>

  <?php foreach($data as $b): ?>
  <tr>
    <td><?= $b['id'] ?></td>
    <td><?= htmlspecialchars($b['user_name'] ?? '—') ?> (ID: <?= $b['user_id'] ?>)</td>
    <td><?= htmlspecialchars($b['wisata_nama'] ?? '—') ?> (ID: <?= $b['wisata_id'] ?>)</td>
    <td><?= htmlspecialchars($b['nama_pengunjung'] ?? '-') ?></td>
    <td><?= htmlspecialchars($b['tanggal_kunjungan'] ?? '-') ?></td>
    <td><?= $b['jumlah_tiket'] ?></td>
    <td>Rp <?= number_format($b['total_bayar']) ?></td>
    <td><?= ucfirst($b['status']) ?></td>
   <td>
    <!-- Lihat detail -->
    <a href="<?= BASE_URL ?>/admin/viewBooking/<?= $b['id'] ?>">Lihat</a>
    &nbsp;|&nbsp;

    <!-- Status -->
    <?php if($b['status'] == 'pending'): ?>
        <a href="<?= BASE_URL ?>/admin/setBookingStatus/<?= $b['id'] ?>/dibayar"
           onclick="return confirm('Ubah status menjadi DIBAYAR?')">
           Set Dibayar
        </a>
        &nbsp;|&nbsp;

    <?php elseif($b['status'] == 'dibayar'): ?>
        <a href="<?= BASE_URL ?>/admin/setBookingStatus/<?= $b['id'] ?>/selesai"
           onclick="return confirm('Selesaikan booking ini?')">
           Set Selesai
        </a>
        &nbsp;|&nbsp;

    <?php else: ?>
        <span style="color:green">Selesai</span>
        &nbsp;|&nbsp;
    <?php endif; ?>

    <!-- Hapus -->
    <a href="<?= BASE_URL ?>/admin/deleteBooking/<?= $b['id'] ?>" onclick="return confirm('Hapus booking?')">Hapus</a>
</td>

  </tr>
  <?php endforeach; ?>
</table>

<?php $content = ob_get_clean(); include __DIR__ . '/../layout/admin.php'; ?>
