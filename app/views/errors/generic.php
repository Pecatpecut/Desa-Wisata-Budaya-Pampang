<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $errorCode ?? 'Error' ?> – <?= htmlspecialchars($errorMessage ?? 'Terjadi Kesalahan') ?> | Desa Budaya Pampang</title>
  <style>
    :root {
      --dayak-red:       #8B1A1A;
      --dayak-red-light: #B22222;
      --dayak-gold:      #D4A017;
      --dayak-gold-light:#F0C040;
      --dayak-dark:      #1A0A00;
      --dayak-dark-soft: #2C1810;
      --dayak-cream:     #FAF3E0;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Inter', sans-serif;
      background: var(--dayak-dark);
      color: var(--dayak-cream);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .top-strip {
      height: 6px;
      background: repeating-linear-gradient(90deg,
        var(--dayak-gold) 0px, var(--dayak-gold) 8px,
        var(--dayak-dark) 8px, var(--dayak-dark) 16px,
        var(--dayak-red-light) 16px, var(--dayak-red-light) 24px,
        var(--dayak-dark) 24px, var(--dayak-dark) 32px,
        var(--dayak-gold-light) 32px, var(--dayak-gold-light) 40px,
        var(--dayak-dark) 40px, var(--dayak-dark) 48px
      );
    }
    .error-navbar {
      background: var(--dayak-dark-soft);
      border-bottom: 1px solid rgba(212,160,23,0.15);
      padding: 14px 0;
    }
    .error-navbar .logo {
      font-family: 'Playfair Display', serif;
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--dayak-cream);
      text-decoration: none;
    }
    .error-navbar .logo span { color: var(--dayak-gold); }
    .error-main {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px 20px;
    }
    .error-card {
      position: relative;
      max-width: 580px;
      width: 100%;
      background: var(--dayak-dark-soft);
      border: 1px solid rgba(212,160,23,0.18);
      border-radius: 16px;
      padding: 56px 48px;
      text-align: center;
      box-shadow: 0 24px 60px rgba(0,0,0,0.5);
    }
    .error-card::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 3px;
      background: linear-gradient(90deg, transparent, var(--dayak-gold), var(--dayak-red-light), var(--dayak-gold), transparent);
      border-radius: 16px 16px 0 0;
    }
    .error-code {
      font-family: 'Playfair Display', serif;
      font-size: clamp(80px, 14vw, 120px);
      font-weight: 900;
      line-height: 1;
      color: transparent;
      -webkit-text-stroke: 2px var(--dayak-gold);
      letter-spacing: -4px;
      margin-bottom: 8px;
    }
    .error-title {
      font-family: 'Playfair Display', serif;
      font-size: 1.6rem;
      font-weight: 700;
      color: var(--dayak-cream);
      margin-bottom: 12px;
    }
    .error-desc {
      font-size: 0.95rem;
      color: rgba(250,243,224,0.6);
      line-height: 1.7;
      margin-bottom: 32px;
    }
    .btn-back-home {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--dayak-red-light);
      color: #fff;
      border: 2px solid var(--dayak-gold);
      border-radius: 8px;
      padding: 12px 28px;
      font-size: 0.9rem;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.25s;
    }
    .btn-back-home:hover { background: var(--dayak-red); color: #fff; }
    .bottom-strip {
      height: 4px;
      background: repeating-linear-gradient(90deg,
        var(--dayak-red-light) 0px, var(--dayak-red-light) 6px,
        var(--dayak-gold) 6px, var(--dayak-gold) 12px,
        var(--dayak-dark) 12px, var(--dayak-dark) 18px,
        var(--dayak-gold) 18px, var(--dayak-gold) 24px
      );
      opacity: 0.6;
    }
  </style>
</head>
<body>
<div class="top-strip"></div>
<nav class="error-navbar">
  <div class="container">
    <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>" class="logo">
      Desa Budaya <span>Pampang</span>
    </a>
  </div>
</nav>
<main class="error-main">
  <div class="error-card">
    <div class="error-code"><?= (int)($errorCode ?? 0) ?></div>
    <h1 class="error-title"><?= htmlspecialchars($errorMessage ?? 'Terjadi Kesalahan') ?></h1>
    <p class="error-desc">
      Maaf, terjadi masalah saat memproses permintaan Anda. Silakan kembali ke beranda.
    </p>
    <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>" class="btn-back-home">
      <i class="bi bi-house-fill"></i> Ke Beranda
    </a>
  </div>
</main>
<div class="bottom-strip"></div>
</body>
</html>
