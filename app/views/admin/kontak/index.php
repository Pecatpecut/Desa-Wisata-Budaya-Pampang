<?php
$pageTitle = 'Pengaturan Kontak';
$active    = 'kontak';
require ROOT . '/app/views/admin/partials/header.php';
?>

<?php if ($success): ?>
<div class="toast-msg" id="toast-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if ($error): ?>
<div class="toast-msg error" id="toast-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="page-header">
  <h2 class="page-title">Pengaturan Kontak</h2>
  <p class="page-sub">Kelola informasi kontak & info beranda</p>
</div>

<form method="POST" action="<?= BASE_URL ?>/admin/kontak/simpan">

  <!-- KONTAK -->
  <div class="section-card">
    <h6 class="form-title"><i class="bi bi-person-lines-fill me-1"></i>Informasi Kontak</h6>

    <div class="mb-3">
      <label class="form-label"><i class="bi bi-geo-alt me-1"></i>Alamat</label>
      <div class="input-wrap">
        <textarea name="alamat" rows="3" style="resize:vertical"><?= htmlspecialchars($kontak['alamat']??'') ?></textarea>
      </div>
    </div>

    <div class="row-fields mb-3">
      <div>
        <label class="form-label"><i class="bi bi-envelope me-1"></i>Email</label>
        <div class="input-wrap">
          <input type="email" name="email" value="<?= htmlspecialchars($kontak['email']??'') ?>" />
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label"><i class="bi bi-whatsapp me-1"></i>WhatsApp</label>
      <div class="input-wrap">
        <input type="text" name="whatsapp1" value="<?= htmlspecialchars($kontak['whatsapp1']??'') ?>" placeholder="Nomor WA 1, contoh: 08123456789" />
      </div>
      <div class="input-wrap mt-2">
        <input type="text" name="whatsapp2" value="<?= htmlspecialchars($kontak['whatsapp2']??'') ?>" placeholder="Nomor WA 2 (opsional)" />
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label"><i class="bi bi-instagram me-1"></i>Instagram</label>
      <div class="input-wrap prefix">
        <span>@</span>
        <input type="text" name="instagram" value="<?= htmlspecialchars(ltrim($kontak['instagram']??'','@')) ?>" />
      </div>
    </div>

    <div class="form-footer-save">
      <button type="submit" class="btn-red"><i class="bi bi-save me-1"></i>Simpan Semua</button>
    </div>
  </div>

  <!-- INFO BERANDA -->
  <div class="section-card">
    <h6 class="form-title"><i class="bi bi-info-circle me-1"></i>Info Beranda</h6>

    <div class="group">
      <p class="group-title">Jam Operasional</p>
      <div class="row-fields">
        <div>
          <label class="form-label">Senin - Sabtu</label>
          <div class="input-wrap">
            <input type="text" name="jam_weekdays" value="<?= htmlspecialchars($kontak['jam_weekdays']??'') ?>" placeholder="08.00 - 17.00 WITA" />
          </div>
        </div>
        <div>
          <label class="form-label">Minggu (mulai)</label>
          <div class="input-wrap">
            <input type="text" name="jam_sunday" value="<?= htmlspecialchars($kontak['jam_sunday']??'') ?>" placeholder="14.00 WITA" />
          </div>
        </div>
      </div>
    </div>

    <div class="group">
      <p class="group-title">Tiket Parkir</p>
      <div class="row-fields">
        <?php foreach([['parkir_motor','Motor'],['parkir_mobil','Mobil'],['parkir_bus','Bus']] as [$n,$l]): ?>
        <div>
          <label class="form-label"><?= htmlspecialchars($l) ?></label>
          <div class="input-wrap prefix"><span>Rp</span>
            <input type="number" name="<?= htmlspecialchars($n) ?>" value="<?= htmlspecialchars($kontak[$n]??'') ?>" />
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="group">
      <p class="group-title">Tiket Wisata</p>
      <div class="row-fields">
        <?php foreach([['wisata_tarian','Tarian'],['wisata_lamin','Lamin'],['wisata_susur','Susur Sungai']] as [$n,$l]): ?>
        <div>
          <label class="form-label"><?= htmlspecialchars($l) ?></label>
          <div class="input-wrap prefix"><span>Rp</span>
            <input type="number" name="<?= htmlspecialchars($n) ?>" value="<?= htmlspecialchars($kontak[$n]??'') ?>" />
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="group">
      <p class="group-title">Biaya Opsional</p>
      <div class="row-fields">
        <div>
          <label class="form-label">Foto</label>
          <div class="input-wrap">
            <input type="text" name="biaya_foto" value="<?= htmlspecialchars($kontak['biaya_foto']??'') ?>" placeholder="25000 / 5 foto" />
          </div>
        </div>
        <div>
          <label class="form-label">Sewa</label>
          <div class="input-wrap">
            <input type="text" name="biaya_sewa" value="<?= htmlspecialchars($kontak['biaya_sewa']??'') ?>" placeholder="50000 - 100000" />
          </div>
        </div>
      </div>
    </div>
  </div>

</form>

<div class="section-card">
  <h6 class="form-title"><i class="bi bi-eye me-1"></i>Preview Kontak Publik</h6>
  <?php foreach([
    ['bi-geo-alt',  $kontak['alamat']    ?? '-'],
    ['bi-envelope', $kontak['email']     ?? '-'],
    ['bi-whatsapp', ($kontak['whatsapp1']??'-') . (($kontak['whatsapp2']??'') ? ' / '.($kontak['whatsapp2']) : '')],
    ['bi-instagram',$kontak['instagram'] ?? '-'],
  ] as [$icon, $val]): ?>
  <div style="display:flex;gap:10px;margin-bottom:10px;font-size:14px;color:#444">
    <i class="bi <?= htmlspecialchars($icon) ?>" style="color:#c0392b"></i>
    <?= htmlspecialchars($val) ?>
  </div>
  <?php endforeach; ?>
</div>

<style>
.form-footer-save { margin-top:24px; padding-top:16px; border-top:1px solid #f0f0f0; }
</style>

<div class="modal-overlay" id="confirm-modal" style="display:none">
  <div class="confirm-modal-box">
    <i class="bi bi-exclamation-triangle confirm-icon"></i>
    <p id="confirm-msg">Yakin ingin menghapus?</p>
    <div class="actions">
      <button class="btn-outline" id="confirm-cancel">Batal</button>
      <button class="btn-red"     id="confirm-ok">Ya, Hapus</button>
    </div>
  </div>
</div>

<?php require ROOT . '/app/views/admin/partials/footer.php'; ?>
