<?php
require_once __DIR__ . '/includes/auth.php';

$pdo = getDB();
$totalProjects = $pdo->query('SELECT COUNT(*) FROM projects')->fetchColumn();
$totalEducation = $pdo->query('SELECT COUNT(*) FROM education')->fetchColumn();
$totalExperience = $pdo->query('SELECT COUNT(*) FROM experience')->fetchColumn();

$recentProjects = $pdo->query('SELECT id, title, created_at FROM projects ORDER BY id DESC LIMIT 5')->fetchAll();

$pageTitle = 'Dashboard';
$activeMenu = 'dashboard';
require __DIR__ . '/includes/header.php';
?>

<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="stat-card d-flex justify-content-between align-items-center">
      <div>
        <div class="text-muted small mb-1">Total Projects</div>
        <div class="stat-number"><?= (int)$totalProjects ?></div>
      </div>
      <i class="bi bi-kanban"></i>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card d-flex justify-content-between align-items-center">
      <div>
        <div class="text-muted small mb-1">Riwayat Pendidikan</div>
        <div class="stat-number"><?= (int)$totalEducation ?></div>
      </div>
      <i class="bi bi-mortarboard"></i>
    </div>
  </div>
  <div class="col-md-4">
    <div class="stat-card d-flex justify-content-between align-items-center">
      <div>
        <div class="text-muted small mb-1">Pengalaman/Organisasi</div>
        <div class="stat-number"><?= (int)$totalExperience ?></div>
      </div>
      <i class="bi bi-briefcase"></i>
    </div>
  </div>
</div>

<div class="admin-card">
  <h6 class="mb-3">Project Terbaru</h6>
  <?php if (empty($recentProjects)): ?>
    <p class="text-muted small mb-0">Belum ada project. <a href="project_form.php">Tambah project baru</a>.</p>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr><th>Judul</th><th>Ditambahkan</th><th></th></tr>
        </thead>
        <tbody>
          <?php foreach ($recentProjects as $p): ?>
          <tr>
            <td><?= e($p['title']) ?></td>
            <td class="text-muted small"><?= e($p['created_at']) ?></td>
            <td class="text-end">
              <a href="project_form.php?id=<?= (int)$p['id'] ?>" class="btn btn-sm btn-outline-info">Edit</a>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
