<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($pageTitle ?? 'Admin') ?> — Desa Budaya Pampang</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/bootstrap-icons.min.css"/>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css"/>
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/admin.css"/>
  <script src="<?= BASE_URL ?>/public/assets/js/vue.global.prod.js"></script>
  <script>const BASE_URL = '<?= BASE_URL ?>';</script>
</head>
<body class="admin-body">

<div class="admin-wrapper">

  <aside class="sidebar" id="sidebar">
    <div class="sidebar-logo">
      <span>Desa Budaya</span> <span class="accent">Pampang</span>
    </div>
    <nav class="sidebar-nav">
      <a href="<?= BASE_URL ?>/admin"            class="sidebar-link <?= ($active??'')==='dashboard' ?'active':'' ?>"><i class="bi bi-grid"></i> Dashboard</a>
      <a href="<?= BASE_URL ?>/admin/agenda"     class="sidebar-link <?= ($active??'')==='agenda'    ?'active':'' ?>"><i class="bi bi-calendar3"></i> Agenda</a>
      <a href="<?= BASE_URL ?>/admin/galeri"     class="sidebar-link <?= ($active??'')==='galeri'    ?'active':'' ?>"><i class="bi bi-images"></i> Galeri</a>
      <a href="<?= BASE_URL ?>/admin/postingan"  class="sidebar-link <?= ($active??'')==='postingan' ?'active':'' ?>"><i class="bi bi-newspaper"></i> Postingan</a>
      <a href="<?= BASE_URL ?>/admin/kontak"     class="sidebar-link <?= ($active??'')==='kontak'    ?'active':'' ?>"><i class="bi bi-person"></i> Kontak</a>
      <a href="<?= BASE_URL ?>/admin/password"   class="sidebar-link <?= ($active??'')=='password'  ?'active':'' ?>"><i class="bi bi-shield-lock"></i> Ubah Password</a>
    </nav>
    <div class="sidebar-footer">
      <a href="<?= BASE_URL ?>/logout" class="sidebar-link logout"><i class="bi bi-box-arrow-left"></i> Logout</a>
    </div>
  </aside>

  <div class="sidebar-backdrop" id="sidebar-backdrop" onclick="closeSidebar()"></div>

  <div class="admin-main">
    <div class="admin-topbar">
      <button class="sidebar-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
      </button>
      <span class="topbar-title"><?= htmlspecialchars($pageTitle ?? '') ?></span>
      <div class="topbar-user">
        <i class="bi bi-person-circle me-1"></i>
        <?= htmlspecialchars($_SESSION['admin_email'] ?? 'Admin') ?>
      </div>
    </div>

    <div class="admin-content">
