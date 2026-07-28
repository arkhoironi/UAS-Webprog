<?php
require_once __DIR__ . '/includes/auth.php';

$pdo = getDB();

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM education WHERE id = ?');
    $stmt->execute([$id]);
    flash('success', 'Data pendidikan berhasil dihapus.');
    redirect('education.php');
}

$rows = $pdo->query('SELECT * FROM education ORDER BY sort_order ASC, id DESC')->fetchAll();

$pageTitle = 'Education';
$activeMenu = 'education';
require __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <p class="text-muted mb-0">Kelola riwayat pendidikan yang tampil di halaman portofolio.</p>
  <a href="education_form.php" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg"></i> Tambah Pendidikan
  </a>
</div>

<div class="admin-card">
  <?php if (empty($rows)): ?>
    <p class="text-muted small mb-0">Belum ada data pendidikan.</p>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>Institusi</th>
            <th>Jurusan</th>
            <th>Periode</th>
            <th>Urutan</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= e($r['institution']) ?></td>
            <td class="text-muted small"><?= e($r['major']) ?></td>
            <td class="text-muted small"><?= e($r['period']) ?></td>
            <td><?= (int)$r['sort_order'] ?></td>
            <td class="text-end">
              <a href="education_form.php?id=<?= (int)$r['id'] ?>" class="btn btn-sm btn-outline-info">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="education.php?delete=<?= (int)$r['id'] ?>" class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('Yakin hapus data ini?');">
                <i class="bi bi-trash"></i>
              </a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
