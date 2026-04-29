<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>403 – Akses Ditolak | Desa Budaya Pampang</title>
  <style>
    :root {
      --dayak-red:        #8B1A1A;
      --dayak-red-light:  #B22222;
      --dayak-gold:       #D4A017;
      --dayak-gold-light: #F0C040;
      --dayak-dark:       #1A0A00;
      --dayak-dark-soft:  #2C1810;
      --dayak-cream:      #FAF3E0;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'Inter', sans-serif;
      background: var(--dayak-dark);
      color: var(--dayak-cream);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      overflow-x: hidden;
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
      position: relative;
    }

    .error-main::before {
      content: '';
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(45deg, rgba(212,160,23,0.03) 25%, transparent 25%),
        linear-gradient(-45deg, rgba(212,160,23,0.03) 25%, transparent 25%),
        linear-gradient(45deg, transparent 75%, rgba(212,160,23,0.03) 75%),
        linear-gradient(-45deg, transparent 75%, rgba(212,160,23,0.03) 75%);
      background-size: 20px 20px;
      pointer-events: none;
    }

    .error-card {
      position: relative;
      max-width: 620px;
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
      background: linear-gradient(90deg,
        transparent 0%,
        var(--dayak-gold) 30%,
        var(--dayak-red-light) 50%,
        var(--dayak-gold) 70%,
        transparent 100%
      );
      border-radius: 16px 16px 0 0;
    }

    .ornament {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 10px;
      margin-bottom: 28px;
    }
    .ornament-line { width: 50px; height: 1px; background: linear-gradient(90deg, transparent, var(--dayak-gold)); }
    .ornament-line.right { background: linear-gradient(90deg, var(--dayak-gold), transparent); }
    .ornament-diamond { width: 10px; height: 10px; background: var(--dayak-gold); transform: rotate(45deg); }
    .ornament-dot { width: 5px; height: 5px; background: var(--dayak-red-light); transform: rotate(45deg); }

    /* Lock shield icon */
    .error-icon-wrap { margin-bottom: 20px; }
    .error-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: rgba(212,160,23,0.08);
      border: 2px solid rgba(212,160,23,0.25);
      font-size: 2rem;
      color: var(--dayak-gold);
    }

    .error-code {
      font-family: 'Playfair Display', serif;
      font-size: clamp(80px, 14vw, 120px);
      font-weight: 900;
      line-height: 1;
      color: transparent;
      -webkit-text-stroke: 2px var(--dayak-gold);
      letter-spacing: -4px;
      margin-bottom: 4px;
    }

    .error-label {
      display: inline-block;
      background: rgba(212,160,23,0.1);
      border: 1px solid rgba(212,160,23,0.3);
      color: var(--dayak-gold-light);
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 3px;
      text-transform: uppercase;
      padding: 4px 16px;
      border-radius: 100px;
      margin-bottom: 24px;
    }

    .error-title {
      font-family: 'Playfair Display', serif;
      font-size: clamp(1.4rem, 4vw, 1.9rem);
      font-weight: 700;
      color: var(--dayak-cream);
      margin-bottom: 14px;
    }
    .error-title span { color: var(--dayak-gold); }

    .error-desc {
      font-size: 0.95rem;
      color: rgba(250,243,224,0.6);
      line-height: 1.7;
      margin-bottom: 36px;
    }

    .dayak-divider {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 36px;
    }
    .dayak-divider hr { flex: 1; border: none; border-top: 1px solid rgba(212,160,23,0.1); }
    .dayak-divider .mid { display: flex; gap: 6px; align-items: center; }
    .dayak-divider .mid span { display: block; width: 6px; height: 6px; background: var(--dayak-gold); transform: rotate(45deg); }
    .dayak-divider .mid span:nth-child(2) { width: 8px; height: 8px; background: var(--dayak-red-light); }

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
      transition: all 0.25s ease;
      margin: 0 6px;
    }
    .btn-back-home:hover {
      background: var(--dayak-red);
      color: #fff;
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(139,26,26,0.45);
    }

    .btn-login {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: transparent;
      color: var(--dayak-gold);
      border: 1px solid rgba(212,160,23,0.4);
      border-radius: 8px;
      padding: 12px 28px;
      font-size: 0.9rem;
      font-weight: 500;
      text-decoration: none;
      transition: all 0.25s ease;
      margin: 0 6px;
    }
    .btn-login:hover {
      border-color: var(--dayak-gold);
      background: rgba(212,160,23,0.08);
      color: var(--dayak-gold);
    }

    .btn-wrap { display: flex; flex-wrap: wrap; gap: 10px; justify-content: center; }

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

    @media (max-width: 576px) {
      .error-card { padding: 40px 24px; }
      .btn-back-home, .btn-login { width: 100%; justify-content: center; margin: 0; }
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

    <div class="ornament">
      <div class="ornament-line"></div>
      <div class="ornament-dot"></div>
      <div class="ornament-diamond"></div>
      <div class="ornament-dot"></div>
      <div class="ornament-line right"></div>
    </div>

    <div class="error-icon-wrap">
      <div class="error-icon">
        <i class="bi bi-shield-lock-fill"></i>
      </div>
    </div>

    <div class="error-code">403</div>
    <div class="error-label">Akses Ditolak</div>

    <h1 class="error-title">
      Anda tidak memiliki<br><span>izin untuk mengakses halaman ini</span>
    </h1>

    <p class="error-desc">
      Halaman ini memerlukan autentikasi atau hak akses khusus. Silakan masuk dengan
      akun yang memiliki izin, atau kembali ke halaman utama.
    </p>

    <div class="dayak-divider">
      <hr>
      <div class="mid">
        <span></span><span></span><span></span>
      </div>
      <hr>
    </div>

    <div class="btn-wrap">
      <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>/login" class="btn-login">
        <i class="bi bi-box-arrow-in-right"></i> Masuk
      </a>
      <a href="<?= defined('BASE_URL') ? BASE_URL : '/' ?>" class="btn-back-home">
        <i class="bi bi-house-fill"></i> Ke Beranda
      </a>
    </div>

  </div>
</main>

<div class="bottom-strip"></div>

</body>
</html>
