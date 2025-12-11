<?php ob_start(); ?>

<?php
// Safety: pastikan $data tersedia dan berupa array
if (!isset($data) || !is_array($data)) {
    $data = [];
}

// Hitung total destinasi unik berdasarkan id (menghindari duplikat akibat JOIN)
$ids = array_column($data, 'id');
$total_unique = count(array_unique($ids));
?>

<h1>Kelola Wisata</h1>

<p style="margin:8px 0 18px;color:#374151;">
  <strong>Total destinasi:</strong>
  <span style="font-weight:700;color:#0f172a;"><?= htmlspecialchars($total_unique) ?></span>
</p>

<a href="<?= BASE_URL ?>/admin/tambahWisata" 
   style="display:inline-block;margin-bottom:15px;background:#22c55e;color:#fff;padding:12px 20px;border-radius:12px;text-decoration:none;">
   + Tambah Wisata
</a>

<table width="100%" cellpadding="12" style="background:white;border-radius:16px;overflow:hidden;">
<tr style="background:#0f172a;color:white;">
  <th>ID</th>
  <th>Nama</th>
  <th>Lokasi</th>
  <th>Harga</th>
  <th>Aksi</th>
</tr>

<?php if (empty($data)): ?>
<tr>
  <td colspan="5" style="text-align:center;padding:24px;color:#6b7280;">Belum ada data wisata.</td>
</tr>
<?php else: ?>
  <?php foreach($data as $w): ?>
  <tr>
    <td><?= (int)($w['id'] ?? 0) ?></td>
    <td><?= htmlspecialchars($w['nama'] ?? '-') ?></td>
    <td><?= htmlspecialchars($w['lokasi'] ?? '-') ?></td>
    <td>Rp <?= number_format((float)($w['harga'] ?? 0)) ?></td>
    <td>
      <a href="<?= BASE_URL ?>/admin/editWisata/<?= (int)($w['id'] ?? 0) ?>">Edit</a> |
      <a href="<?= BASE_URL ?>/admin/hapusWisata/<?= (int)($w['id'] ?? 0) ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
    </td>
  </tr>
  <?php endforeach; ?>
<?php endif; ?>

</table>

<?php $content = ob_get_clean(); include "app/views/layout/admin.php"; ?>
