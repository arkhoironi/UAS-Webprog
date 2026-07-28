<?php
/** @var string $pageTitle */
/** @var string $activeMenu */
$pageTitle = $pageTitle ?? 'Dashboard';
$activeMenu = $activeMenu ?? '';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= e($pageTitle) ?> | Admin Portofolio</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/admin.css" />
</head>
<body>
<div class="admin-wrapper">
  <aside class="admin-sidebar">
    <div class="sidebar-brand">
      <i class="bi bi-speedometer2"></i> Admin Panel
    </div>
    <nav class="sidebar-nav">
      <a href="dashboard.php" class="<?= $activeMenu === 'dashboard' ? 'active' : '' ?>">
        <i class="bi bi-grid-1x2"></i> Dashboard
      </a>
      <a href="projects.php" class="<?= $activeMenu === 'projects' ? 'active' : '' ?>">
        <i class="bi bi-kanban"></i> Projects
      </a>
      <a href="education.php" class="<?= $activeMenu === 'education' ? 'active' : '' ?>">
        <i class="bi bi-mortarboard"></i> Education
      </a>
      <a href="experience.php" class="<?= $activeMenu === 'experience' ? 'active' : '' ?>">
        <i class="bi bi-briefcase"></i> Pengalaman
      </a>
      <a href="../index.php" target="_blank">
        <i class="bi bi-box-arrow-up-right"></i> Lihat Website
      </a>
      <a href="logout.php" class="text-danger">
        <i class="bi bi-box-arrow-right"></i> Logout
      </a>
    </nav>
  </aside>

  <main class="admin-content">
    <div class="admin-topbar d-flex justify-content-between align-items-center">
      <h4 class="mb-0"><?= e($pageTitle) ?></h4>
      <span class="text-muted small">
        <i class="bi bi-person-circle"></i> <?= e($_SESSION['admin_username'] ?? '') ?>
      </span>
    </div>
    <div class="admin-body">
      <?php
        if ($msg = flash('success')) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">' . e($msg) . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
        }
        if ($msg = flash('error')) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . e($msg) . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
        }
      ?>
