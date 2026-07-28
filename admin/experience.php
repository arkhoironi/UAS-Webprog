<?php
require_once __DIR__ . '/includes/auth.php';

$pdo = getDB();

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM experience WHERE id = ?');
    $stmt->execute([$id]);
    flash('success', 'Data pengalaman berhasil dihapus.');
    redirect('experience.php');
}

$rows = $pdo->query('SELECT * FROM experience ORDER BY sort_order ASC, id DESC')->fetchAll();

$pageTitle = 'Pengalaman & Organisasi';
$activeMenu = 'experience';
require __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <p class="text-muted mb-0">Kelola pengalaman kerja/organisasi yang tampil di halaman portofolio.</p>
  <a href="experience_form.php" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg"></i> Tambah Pengalaman
  </a>
</div>

<div class="admin-card">
  <?php if (empty($rows)): ?>
    <p class="text-muted small mb-0">Belum ada data pengalaman.</p>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>Organisasi</th>
            <th>Peran</th>
            <th>Periode</th>
            <th>Urutan</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($rows as $r): ?>
          <tr>
            <td><?= e($r['organization']) ?></td>
            <td class="text-muted small"><?= e($r['role']) ?></td>
            <td class="text-muted small"><?= e($r['period']) ?></td>
            <td><?= (int)$r['sort_order'] ?></td>
            <td class="text-end">
              <a href="experience_form.php?id=<?= (int)$r['id'] ?>" class="btn btn-sm btn-outline-info">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="experience.php?delete=<?= (int)$r['id'] ?>" class="btn btn-sm btn-outline-danger"
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
