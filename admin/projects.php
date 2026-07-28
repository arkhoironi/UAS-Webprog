<?php
require_once __DIR__ . '/includes/auth.php';

$pdo = getDB();

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare('SELECT image FROM projects WHERE id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if ($row) {
        $del = $pdo->prepare('DELETE FROM projects WHERE id = ?');
        $del->execute([$id]);

        if (!empty($row['image'])) {
            $path = __DIR__ . '/../uploads/projects/' . $row['image'];
            if (is_file($path)) {
                @unlink($path);
            }
        }
        flash('success', 'Project berhasil dihapus.');
    }
    redirect('projects.php');
}

$projects = $pdo->query('SELECT * FROM projects ORDER BY sort_order ASC, id DESC')->fetchAll();

$pageTitle = 'Projects';
$activeMenu = 'projects';
require __DIR__ . '/includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <p class="text-muted mb-0">Kelola data project yang tampil di halaman portofolio.</p>
  <a href="project_form.php" class="btn btn-primary btn-sm">
    <i class="bi bi-plus-lg"></i> Tambah Project
  </a>
</div>

<div class="admin-card">
  <?php if (empty($projects)): ?>
    <p class="text-muted small mb-0">Belum ada project.</p>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>Judul</th>
            <th>Tech Stack</th>
            <th>Urutan</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($projects as $p): ?>
          <tr>
            <td>
              <?php if (!empty($p['image'])): ?>
                <img src="../uploads/projects/<?= e($p['image']) ?>" class="thumb-img" alt="">
              <?php else: ?>
                <div class="thumb-img d-flex align-items-center justify-content-center bg-secondary bg-opacity-25">
                  <i class="bi bi-image text-muted"></i>
                </div>
              <?php endif; ?>
            </td>
            <td><?= e($p['title']) ?></td>
            <td class="text-muted small"><?= e($p['tech_stack']) ?></td>
            <td><?= (int)$p['sort_order'] ?></td>
            <td class="text-end">
              <a href="project_form.php?id=<?= (int)$p['id'] ?>" class="btn btn-sm btn-outline-info">
                <i class="bi bi-pencil"></i>
              </a>
              <a href="projects.php?delete=<?= (int)$p['id'] ?>" class="btn btn-sm btn-outline-danger"
                 onclick="return confirm('Yakin hapus project \'<?= e(addslashes($p['title'])) ?>\'?');">
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
