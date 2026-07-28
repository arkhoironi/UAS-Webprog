<?php
require_once __DIR__ . '/includes/auth.php';

$pdo = getDB();
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$project = ['title' => '', 'description' => '', 'tech_stack' => '', 'image' => '', 'project_url' => '', 'github_url' => '', 'sort_order' => 0];
$errors = [];

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM projects WHERE id = ?');
    $stmt->execute([$id]);
    $found = $stmt->fetch();
    if (!$found) {
        flash('error', 'Project tidak ditemukan.');
        redirect('projects.php');
    }
    $project = $found;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $project['title'] = trim($_POST['title'] ?? '');
    $project['description'] = trim($_POST['description'] ?? '');
    $project['tech_stack'] = trim($_POST['tech_stack'] ?? '');
    $project['project_url'] = trim($_POST['project_url'] ?? '');
    $project['github_url'] = trim($_POST['github_url'] ?? '');
    $project['sort_order'] = (int)($_POST['sort_order'] ?? 0);

    if ($project['title'] === '') {
        $errors[] = 'Judul wajib diisi.';
    }
    if ($project['description'] === '') {
        $errors[] = 'Deskripsi wajib diisi.';
    }

    $newImage = $project['image'] ?? null;
    if (empty($errors)) {
        try {
            $uploaded = handleImageUpload($_FILES['image'] ?? [], __DIR__ . '/../uploads/projects', $project['image'] ?? null);
            if ($uploaded) {
                $newImage = $uploaded;
            }
        } catch (RuntimeException $e) {
            $errors[] = $e->getMessage();
        }
    }

    if (empty($errors)) {
        if ($id) {
            $stmt = $pdo->prepare('UPDATE projects SET title=?, description=?, tech_stack=?, image=?, project_url=?, github_url=?, sort_order=? WHERE id=?');
            $stmt->execute([$project['title'], $project['description'], $project['tech_stack'], $newImage, $project['project_url'], $project['github_url'], $project['sort_order'], $id]);
            flash('success', 'Project berhasil diperbarui.');
        } else {
            $stmt = $pdo->prepare('INSERT INTO projects (title, description, tech_stack, image, project_url, github_url, sort_order) VALUES (?,?,?,?,?,?,?)');
            $stmt->execute([$project['title'], $project['description'], $project['tech_stack'], $newImage, $project['project_url'], $project['github_url'], $project['sort_order']]);
            flash('success', 'Project berhasil ditambahkan.');
        }
        redirect('projects.php');
    }

    $project['image'] = $newImage;
}

$pageTitle = $id ? 'Edit Project' : 'Tambah Project';
$activeMenu = 'projects';
require __DIR__ . '/includes/header.php';
?>

<a href="projects.php" class="text-decoration-none small text-muted d-inline-block mb-3">
  <i class="bi bi-arrow-left"></i> Kembali ke daftar project
</a>

<div class="admin-card" style="max-width: 720px;">
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger small">
      <ul class="mb-0 ps-3">
        <?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Judul Project</label>
      <input type="text" name="title" class="form-control" value="<?= e($project['title']) ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Deskripsi</label>
      <textarea name="description" class="form-control" rows="4" required><?= e($project['description']) ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Tech Stack <span class="text-muted">(pisahkan dengan koma)</span></label>
      <input type="text" name="tech_stack" class="form-control" placeholder="PHP, MySQL, Bootstrap" value="<?= e($project['tech_stack']) ?>">
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">URL Demo</label>
        <input type="url" name="project_url" class="form-control" placeholder="https://" value="<?= e($project['project_url']) ?>">
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">URL GitHub</label>
        <input type="url" name="github_url" class="form-control" placeholder="https://github.com/..." value="<?= e($project['github_url']) ?>">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">Urutan Tampil <span class="text-muted">(angka kecil tampil duluan)</span></label>
      <input type="number" name="sort_order" class="form-control" style="max-width:150px" value="<?= (int)$project['sort_order'] ?>">
    </div>

    <div class="mb-4">
      <label class="form-label">Gambar Project</label>
      <?php if (!empty($project['image'])): ?>
        <div class="mb-2">
          <img src="../uploads/projects/<?= e($project['image']) ?>" class="thumb-img" style="width:80px;height:80px;">
        </div>
      <?php endif; ?>
      <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
      <div class="form-text text-muted">Format jpg/png/webp, maksimal 3MB. Kosongkan jika tidak ingin mengganti gambar.</div>
    </div>

    <button type="submit" class="btn btn-primary">
      <i class="bi bi-check-lg"></i> Simpan
    </button>
    <a href="projects.php" class="btn btn-outline-light">Batal</a>
  </form>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
