<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $pageTitle ?? 'Desa Budaya Pampang' ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/style.css" />
  <link rel="stylesheet" href="<?= BASE_URL ?>/public/assets/css/dayak-theme.css" />
  <?= $extraCss ?? '' ?>
  <script>const BASE_URL = '<?= BASE_URL ?>';</script>
</head>
<body>

<header class="navbar-wrapper">
  <div class="navbar-inner container">
    <a href="<?= BASE_URL ?>/" class="logo">
      Desa Budaya <span class="logo-accent">Pampang</span>
    </a>

    <nav class="menu">
      <div class="nav-indicator"></div>
      <a href="<?= BASE_URL ?>/"          class="nav-link">Beranda</a>
      <a href="<?= BASE_URL ?>/tentang"   class="nav-link">Tentang Kami</a>
      <a href="<?= BASE_URL ?>/publikasi" class="nav-link">Publikasi</a>
      <a href="<?= BASE_URL ?>/kontak"    class="nav-link">Kontak</a>
    </nav>

    <div class="nav-right">
      <div class="divider"></div>
      <div class="nav-icons">
        <i class="bi bi-headphones" id="audio-btn"></i>
      </div>
      <div class="hamburger">
        <span></span><span></span><span></span>
      </div>
    </div>
  </div>

  <div class="mobile-menu">
    <a href="<?= BASE_URL ?>/">Beranda</a>
    <a href="<?= BASE_URL ?>/tentang">Tentang Kami</a>
    <a href="<?= BASE_URL ?>/publikasi">Publikasi</a>
    <a href="<?= BASE_URL ?>/kontak">Kontak</a>
  </div>
</header>

<div class="page-content">
