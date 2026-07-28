<?php
require_once __DIR__ . '/includes/auth.php';

$pdo = getDB();
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$row = ['institution' => '', 'major' => '', 'period' => '', 'description' => '', 'sort_order' => 0];
$errors = [];

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM education WHERE id = ?');
    $stmt->execute([$id]);
    $found = $stmt->fetch();
    if (!$found) {
        flash('error', 'Data tidak ditemukan.');
        redirect('education.php');
    }
    $row = $found;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $row['institution'] = trim($_POST['institution'] ?? '');
    $row['major'] = trim($_POST['major'] ?? '');
    $row['period'] = trim($_POST['period'] ?? '');
    $row['description'] = trim($_POST['description'] ?? '');
    $row['sort_order'] = (int)($_POST['sort_order'] ?? 0);

    if ($row['institution'] === '') {
        $errors[] = 'Nama institusi wajib diisi.';
    }

    if (empty($errors)) {
        if ($id) {
            $stmt = $pdo->prepare('UPDATE education SET institution=?, major=?, period=?, description=?, sort_order=? WHERE id=?');
            $stmt->execute([$row['institution'], $row['major'], $row['period'], $row['description'], $row['sort_order'], $id]);
            flash('success', 'Data pendidikan berhasil diperbarui.');
        } else {
            $stmt = $pdo->prepare('INSERT INTO education (institution, major, period, description, sort_order) VALUES (?,?,?,?,?)');
            $stmt->execute([$row['institution'], $row['major'], $row['period'], $row['description'], $row['sort_order']]);
            flash('success', 'Data pendidikan berhasil ditambahkan.');
        }
        redirect('education.php');
    }
}

$pageTitle = $id ? 'Edit Pendidikan' : 'Tambah Pendidikan';
$activeMenu = 'education';
require __DIR__ . '/includes/header.php';
?>

<a href="education.php" class="text-decoration-none small text-muted d-inline-block mb-3">
  <i class="bi bi-arrow-left"></i> Kembali ke daftar pendidikan
</a>

<div class="admin-card" style="max-width: 680px;">
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger small">
      <ul class="mb-0 ps-3">
        <?php foreach ($errors as $err): ?><li><?= e($err) ?></li><?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <form method="post">
    <div class="mb-3">
      <label class="form-label">Nama Institusi / Sekolah</label>
      <input type="text" name="institution" class="form-control" value="<?= e($row['institution']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Jurusan</label>
      <input type="text" name="major" class="form-control" value="<?= e($row['major']) ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Periode</label>
      <input type="text" name="period" class="form-control" placeholder="2019 - 2022" value="<?= e($row['period']) ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Deskripsi (opsional)</label>
      <textarea name="description" class="form-control" rows="3"><?= e($row['description']) ?></textarea>
    </div>
    <div class="mb-4">
      <label class="form-label">Urutan Tampil</label>
      <input type="number" name="sort_order" class="form-control" style="max-width:150px" value="<?= (int)$row['sort_order'] ?>">
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Simpan</button>
    <a href="education.php" class="btn btn-outline-light">Batal</a>
  </form>
</div>

<?php require __DIR__ . '/includes/footer.php'; ?>
