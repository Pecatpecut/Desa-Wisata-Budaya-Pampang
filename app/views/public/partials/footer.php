</div>
<div style="background:var(--dayak-dark); padding:16px 0 0; overflow:hidden;">
  <div style="height:6px; background: repeating-linear-gradient(90deg,
    var(--dayak-gold) 0px, var(--dayak-gold) 8px,
    var(--dayak-dark) 8px, var(--dayak-dark) 16px,
    var(--dayak-red-light) 16px, var(--dayak-red-light) 24px,
    var(--dayak-dark) 24px, var(--dayak-dark) 32px,
    var(--dayak-gold-light) 32px, var(--dayak-gold-light) 40px,
    var(--dayak-dark) 40px, var(--dayak-dark) 48px
  ); opacity:0.8; margin-bottom:8px;"></div>

  <div class="dayak-ornament">
    <span></span>
    <span></span>
    <span></span>
    <span></span>
    <span></span>
  </div>

  <div style="height:4px; background: repeating-linear-gradient(90deg,
    var(--dayak-red-light) 0px, var(--dayak-red-light) 6px,
    var(--dayak-gold) 6px, var(--dayak-gold) 12px,
    var(--dayak-dark) 12px, var(--dayak-dark) 18px,
    var(--dayak-gold) 18px, var(--dayak-gold) 24px
  ); opacity:0.6; margin-top:8px;"></div>
</div>
<footer class="footer-section">
  <div class="container">
    <div class="row footer-row">
      <div class="col-md-2 logo-col">
        <img src="<?= BASE_URL ?>/public/assets/images/logo-pesona-indonesia-putih.svg" alt="Pesona Indonesia" class="footer-logo" />
      </div>
      <div class="col-md-4 footer-col">
        <h5 class="title">Desa Budaya Pampang</h5>
        <p class="desc">Destinasi wisata budaya di Samarinda yang menampilkan tradisi Suku Dayak Kenyah yang autentik.</p>

    
        <div style="display:flex;gap:6px;margin-top:16px;align-items:center">
          <div style="width:6px;height:6px;background:var(--dayak-gold);transform:rotate(45deg)"></div>
          <div style="flex:1;height:1px;background:rgba(212,160,23,0.3)"></div>
          <div style="width:10px;height:10px;background:var(--dayak-red-light);transform:rotate(45deg)"></div>
          <div style="flex:1;height:1px;background:rgba(212,160,23,0.3)"></div>
          <div style="width:6px;height:6px;background:var(--dayak-gold);transform:rotate(45deg)"></div>
        </div>
      </div>
      <div class="col-md-3 footer-col">
        <h5 class="title">Navigasi</h5>
        <ul class="nav-list">
          <li><a href="<?= BASE_URL ?>/">Beranda</a></li>
          <li><a href="<?= BASE_URL ?>/tentang">Tentang Kami</a></li>
          <li><a href="<?= BASE_URL ?>/publikasi">Publikasi</a></li>
          <li><a href="<?= BASE_URL ?>/kontak">Kontak</a></li>
        </ul>
      </div>
      <div class="col-md-3 footer-col">
        <h5 class="title">Temukan Kami</h5>
        <?php
          // Load kontak jika belum tersedia
          if (!isset($kontak)) {
            require_once ROOT . '/app/models/KontakModel.php';
            $kontak = (new KontakModel())->get();
          }
          $wa1 = !empty($kontak['whatsapp1']) ? '62'.ltrim(preg_replace('/[^0-9]/','',$kontak['whatsapp1']),'0') : '';
        ?>
        <p class="desc small"><?= htmlspecialchars($kontak['alamat'] ?? '-') ?></p>
        <div class="socials">
          <a href="https://www.instagram.com/<?= htmlspecialchars(ltrim($kontak['instagram']??'','@')) ?>" target="_blank" class="social-icon"><i class="bi bi-instagram"></i></a>
          <?php if($wa1): ?>
          <a href="https://wa.me/<?= $wa1 ?>" target="_blank" class="social-icon"><i class="bi bi-whatsapp"></i></a>
          <?php endif; ?>
          <a href="mailto:<?= htmlspecialchars($kontak['email']??'') ?>" class="social-icon"><i class="bi bi-envelope"></i></a>
        </div>
      </div>
    </div>
  </div>

  <div style="height:3px; background: repeating-linear-gradient(90deg,
    var(--dayak-dark) 0px, var(--dayak-dark) 8px,
    var(--dayak-gold) 8px, var(--dayak-gold) 16px,
    var(--dayak-red-light) 16px, var(--dayak-red-light) 20px,
    var(--dayak-gold) 20px, var(--dayak-gold) 28px,
    var(--dayak-dark) 28px, var(--dayak-dark) 36px
  ); margin-top:50px; opacity:0.5;"></div>

  <div class="copyright">
    <p>© <?= date('Y') ?> Desa Budaya Pampang — All rights reserved</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/public/assets/js/main.js"></script>
<?= $extraJs ?? '' ?>
</body>
</html>
