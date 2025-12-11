<?php ob_start(); ?>

<h1>Kelola Pengguna</h1>

<?php if(!empty($_SESSION['admin_error'])): ?>
  <div style="background:#fee2e2;color:#7f1d1d;padding:10px;border-radius:8px;margin-bottom:12px;">
    <?= $_SESSION['admin_error']; unset($_SESSION['admin_error']); ?>
  </div>
<?php endif; ?>

<table width="100%" cellpadding="10" style="background:#fff;border-radius:10px;overflow:hidden">
  <tr style="background:#0f172a;color:#fff;">
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Role</th>
    <th>Aksi</th>
  </tr>

  <?php foreach($data as $u): ?>
  <tr>
    <td><?= $u['id'] ?></td>
    <td><?= htmlspecialchars($u['name']) ?></td>
    <td><?= htmlspecialchars($u['email']) ?></td>
    <td><?= ucfirst($u['role']) ?></td>
    <td>


      &nbsp;|&nbsp;
      <a href="<?= BASE_URL ?>/admin/deleteUser/<?= $u['id'] ?>" onclick="return confirm('Hapus user ini?')">Hapus</a>
    </td>
  </tr>
  <?php endforeach; ?>
</table>

<?php $content = ob_get_clean(); include __DIR__ . '/../layout/admin.php'; ?>
