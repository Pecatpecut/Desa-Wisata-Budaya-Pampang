<?php ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login — Admin Desa Budaya Pampang</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
  <style>
    @font-face {
      font-family: 'Playfair Display';
      src: url('<?= BASE_URL ?>/public/assets/fonts/Playfair_Display/PlayfairDisplay-VariableFont_wght.ttf') format('truetype');
      font-weight: 400 900;
    }
    @font-face {
      font-family: 'Playfair Display';
      src: url('<?= BASE_URL ?>/public/assets/fonts/Playfair_Display/PlayfairDisplay-Italic-VariableFont_wght.ttf') format('truetype');
      font-weight: 400 900;
      font-style: italic;
    }
    @font-face {
      font-family: 'Inter';
      src: url('<?= BASE_URL ?>/public/assets/fonts/Inter/Inter-VariableFont_opsz,wght.ttf') format('truetype');
      font-weight: 100 900;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html, body { height: 100%; }

    body {
      font-family: 'Inter', sans-serif;
      background: #0F0A05;
      display: flex;
      -webkit-font-smoothing: antialiased;
    }

    .panel-left {
      flex: 1.15;
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 52px;
    }

    .panel-left .bg {
      position: absolute; inset: 0;
      background: url('<?= BASE_URL ?>/public/assets/images/tarian.svg') center/cover no-repeat;
      transform: scale(1.04);
      transition: transform 8s ease;
    }

    .panel-left .overlay {
      position: absolute; inset: 0;
      background: linear-gradient(
        170deg,
        rgba(15,10,5,0.45) 0%,
        rgba(15,10,5,0.6)  40%,
        rgba(15,10,5,0.88) 100%
      );
    }

    .panel-left::after {
      content: '';
      position: absolute; bottom: 0; left: 0; right: 0;
      height: 5px;
      background: repeating-linear-gradient(
        90deg,
        #B8860B  0, #B8860B  8px,
        #8B1A1A  8px, #8B1A1A 16px,
        #D4A017 16px, #D4A017 24px,
        #1C1007 24px, #1C1007 32px
      );
      z-index: 3;
    }

    .left-content { position: relative; z-index: 2; }

    .ornament {
      display: flex; gap: 8px; align-items: center;
      margin-bottom: 20px;
    }
    .ornament span {
      display: inline-block;
      background: #B8860B;
      transform: rotate(45deg);
    }
    .ornament span:nth-child(1) { width: 7px; height: 7px; }
    .ornament span:nth-child(2) { width: 12px; height: 12px; background: #A82020; }
    .ornament span:nth-child(3) { width: 7px; height: 7px; }

    .left-heading {
      font-family: 'Playfair Display', serif;
      font-size: clamp(2rem, 4vw, 3.2rem);
      font-weight: 800;
      color: #FAF6EC;
      line-height: 1.1;
      letter-spacing: -0.03em;
      margin-bottom: 12px;
    }
    .left-heading em { color: #E2AC1A; font-style: italic; }

    .left-sub {
      font-size: 14px;
      color: rgba(250,246,236,0.6);
      line-height: 1.7;
      max-width: 380px;
      font-weight: 300;
    }

    .left-divider {
      width: 48px; height: 2px;
      background: linear-gradient(90deg, #B8860B, transparent);
      margin: 20px 0;
    }

    .left-badge {
      display: inline-flex;
      align-items: center;
      gap: 7px;
      background: rgba(184,134,11,0.14);
      border: 1px solid rgba(184,134,11,0.3);
      color: #E2AC1A;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 7px 14px;
      border-radius: 3px;
      margin-top: 28px;
    }
    .left-badge i { font-size: 12px; }

    .panel-right {
      width: 460px;
      background: #FAF6EC;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 48px;
      position: relative;
      flex-shrink: 0;
    }

    .panel-right::before {
      content: '';
      position: absolute; inset: 0;
      background-image: repeating-linear-gradient(
        -45deg, transparent 0, transparent 10px,
        rgba(184,134,11,0.025) 10px, rgba(184,134,11,0.025) 11px
      );
      pointer-events: none;
    }

    .panel-right::after {
      content: '';
      position: absolute; left: 0; top: 0; bottom: 0;
      width: 3px;
      background: linear-gradient(180deg, #B8860B 0%, #A82020 50%, #B8860B 100%);
      opacity: 0.6;
    }

    .form-wrap { width: 100%; position: relative; }

    .form-logo {
      font-family: 'Playfair Display', serif;
      font-size: 1.1rem;
      font-weight: 700;
      color: #180E06;
      margin-bottom: 32px;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .form-logo::before {
      content: '◆';
      font-size: 0.5rem;
      color: #B8860B;
    }
    .form-logo em { color: #C0392B; font-style: italic; }

    .form-heading {
      font-family: 'Playfair Display', serif;
      font-size: 2rem;
      font-weight: 800;
      color: #180E06;
      letter-spacing: -0.03em;
      margin-bottom: 4px;
    }
    .form-sub {
      font-size: 13px;
      color: #7A6248;
      margin-bottom: 32px;
    }

    .error-box {
      display: flex; align-items: center; gap: 10px;
      background: rgba(192,57,43,0.08);
      border: 1px solid rgba(192,57,43,0.22);
      border-left: 3px solid #C0392B;
      color: #8B1A1A;
      font-size: 13px; font-weight: 500;
      padding: 11px 14px;
      border-radius: 6px;
      margin-bottom: 24px;
    }
    .error-box i { color: #C0392B; font-size: 14px; }

    .field { margin-bottom: 18px; }
    .field label {
      display: block;
      font-size: 11px; font-weight: 700;
      letter-spacing: 0.1em; text-transform: uppercase;
      color: #7A6248; margin-bottom: 7px;
    }

    .input-row {
      display: flex; align-items: center;
      border: 1.5px solid #E6DED0;
      border-radius: 7px;
      background: white;
      padding: 0 14px;
      transition: all 0.22s;
      overflow: hidden;
    }
    .input-row:focus-within {
      border-color: #C0392B;
      box-shadow: 0 0 0 3px rgba(192,57,43,0.08);
    }
    .input-row i { color: #ADA090; font-size: 15px; flex-shrink: 0; }
    .input-row input {
      flex: 1; border: none; outline: none;
      background: transparent;
      font-size: 14px; font-family: 'Inter', sans-serif;
      color: #180E06; padding: 13px 10px;
    }
    .input-row input::placeholder { color: #ADA090; }
    .eye-btn {
      background: none; border: none;
      cursor: pointer; color: #ADA090;
      font-size: 15px; padding: 0; line-height: 1;
      transition: color 0.2s;
    }
    .eye-btn:hover { color: #C0392B; }

    .btn-login {
      width: 100%;
      padding: 14px;
      border: none; border-radius: 7px;
      background: #C0392B; color: white;
      font-family: 'Inter', sans-serif;
      font-size: 13px; font-weight: 700;
      letter-spacing: 0.08em; text-transform: uppercase;
      cursor: pointer;
      transition: all 0.28s cubic-bezier(0.22,1,0.36,1);
      box-shadow: 0 4px 18px rgba(139,26,26,0.3);
      margin-top: 10px;
      position: relative; overflow: hidden;
    }
    .btn-login::before {
      content: '';
      position: absolute; inset: 0;
      background: linear-gradient(135deg, rgba(212,160,23,0.2) 0%, transparent 55%);
    }
    .btn-login:hover {
      background: #8B1A1A;
      transform: translateY(-2px);
      box-shadow: 0 8px 28px rgba(139,26,26,0.4);
    }
    .btn-login:active { transform: translateY(0); }

    .form-footer {
      margin-top: 28px;
      padding-top: 22px;
      border-top: 1px solid rgba(184,134,11,0.15);
      text-align: center;
      font-size: 11.5px;
      color: #ADA090;
      letter-spacing: 0.02em;
    }

    @media (max-width: 900px) {
      .panel-left { display: none; }
      .panel-right {
        width: 100%;
        background: #FAF6EC;
        padding: 40px 32px;
      }
    }
  </style>
</head>
<body>

<!-- LEFT: Hero visual -->
<div class="panel-left">
  <div class="bg"></div>
  <div class="overlay"></div>
  <div class="left-content">
    <div class="ornament">
      <span></span><span></span><span></span>
    </div>
    <h1 class="left-heading">Desa Budaya<br><em>Pampang</em></h1>
    <div class="left-divider"></div>
    <p class="left-sub">
      Portal administratif untuk mengelola konten budaya, galeri, agenda, dan publikasi Desa Budaya Pampang.
    </p>
    <div class="left-badge">
      <i class="bi bi-shield-check"></i>
      Area Terbatas — Admin Only
    </div>
  </div>
</div>

<!-- RIGHT: Login form -->
<div class="panel-right">
  <div class="form-wrap">
    <div class="form-logo">Desa Budaya <em>Pampang</em></div>

    <h2 class="form-heading">Masuk</h2>
    <p class="form-sub">Silakan masukkan kredensial akun admin Anda</p>

    <?php if ($error): ?>
    <div class="error-box">
      <i class="bi bi-exclamation-triangle-fill"></i>
      <?= htmlspecialchars($error) ?>
    </div>
    <?php endif; ?>

    <form method="POST" action="<?= BASE_URL ?>/login">
      <div class="field">
        <label for="email">Email</label>
        <div class="input-row">
          <i class="bi bi-envelope"></i>
          <input type="email" id="email" name="email"
            placeholder="admin@gmail.com"
            value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
            autocomplete="email" required />
        </div>
      </div>

      <div class="field">
        <label for="pwd">Password</label>
        <div class="input-row">
          <i class="bi bi-lock"></i>
          <input type="password" id="pwd" name="password"
            placeholder="••••••••"
            autocomplete="current-password" required />
          <button type="button" class="eye-btn" onclick="togglePwd()" aria-label="Tampilkan password">
            <i class="bi bi-eye" id="eye-icon"></i>
          </button>
        </div>
      </div>

      <button type="submit" class="btn-login">
        Masuk ke Dashboard
      </button>
    </form>

    <div class="form-footer">
      © <?= date('Y') ?> Desa Budaya Pampang &mdash; Semua hak dilindungi
    </div>
  </div>
</div>

<script>
function togglePwd() {
  const p = document.getElementById('pwd');
  const i = document.getElementById('eye-icon');
  if (p.type === 'password') {
    p.type = 'text';
    i.className = 'bi bi-eye-slash';
  } else {
    p.type = 'password';
    i.className = 'bi bi-eye';
  }
}
</script>
</body>
</html>