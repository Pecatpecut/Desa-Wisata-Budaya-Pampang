<?php
$pageTitle = 'Ubah Password';
$active    = 'password';
require ROOT . '/app/views/admin/partials/header.php';
?>

<?php if ($success): ?>
<div class="toast-msg" id="toast-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>
<?php if ($error): ?>
<div class="toast-msg error" id="toast-error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<div class="page-header">
  <h2 class="page-title">Ubah Password</h2>
  <p class="page-sub">Perbarui kata sandi akun admin</p>
</div>

<div class="form-card" style="max-width:480px">
  <h5 class="form-title"><i class="bi bi-shield-lock me-2"></i>Ganti Password</h5>
  <form method="POST" action="<?= BASE_URL ?>/admin/password/ubah">
    <div class="mb-3">
      <label class="form-label">Password Saat Ini <span class="req">*</span></label>
      <div style="position:relative">
        <input type="password" name="current_password" id="pwd-curr" class="form-input" style="padding-right:42px" placeholder="Password lama..." required />
        <button type="button" onclick="togglePwd('pwd-curr','eye-curr')" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#aaa"><i class="bi bi-eye" id="eye-curr"></i></button>
      </div>
    </div>
    <div class="mb-3">
      <label class="form-label">Password Baru <span class="req">*</span></label>
      <div style="position:relative">
        <input type="password" name="new_password" id="pwd-new" class="form-input" style="padding-right:42px" placeholder="Min. 8 karakter" required oninput="checkStr(this.value)" />
        <button type="button" onclick="togglePwd('pwd-new','eye-new')" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#aaa"><i class="bi bi-eye" id="eye-new"></i></button>
      </div>
      <div id="pwd-bar" style="height:4px;border-radius:2px;margin-top:6px;background:#eee;transition:all .3s"></div>
      <small id="pwd-hint" style="font-size:11.5px;color:#aaa">Minimal 8 karakter</small>
    </div>
    <div class="mb-4">
      <label class="form-label">Konfirmasi Password Baru <span class="req">*</span></label>
      <div style="position:relative">
        <input type="password" name="confirm_password" id="pwd-conf" class="form-input" style="padding-right:42px" placeholder="Ulangi password baru..." required oninput="checkMatch()" />
        <button type="button" onclick="togglePwd('pwd-conf','eye-conf')" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#aaa"><i class="bi bi-eye" id="eye-conf"></i></button>
      </div>
      <small id="match-hint" style="font-size:11.5px"></small>
    </div>
    <button type="submit" class="btn-red w-100"><i class="bi bi-check-lg me-1"></i>Simpan Password</button>
  </form>
</div>

<script>
function togglePwd(i,e){var x=document.getElementById(i),y=document.getElementById(e);x.type=x.type==='password'?'text':'password';y.className=x.type==='password'?'bi bi-eye':'bi bi-eye-slash';}
function checkStr(v){var b=document.getElementById('pwd-bar'),h=document.getElementById('pwd-hint');if(!v){b.style.background='#eee';h.textContent='Minimal 8 karakter';return;}if(v.length>=12&&/[A-Z]/.test(v)&&/[0-9]/.test(v)){b.style.background='#27ae60';h.textContent='Kuat ✓';}else if(v.length>=8){b.style.background='#f39c12';h.textContent='Sedang';}else{b.style.background='#e74c3c';h.textContent='Terlalu pendek';}}
function checkMatch(){var n=document.getElementById('pwd-new').value,c=document.getElementById('pwd-conf').value,h=document.getElementById('match-hint');if(!c){h.textContent='';return;}h.textContent=n===c?'Cocok ✓':'Tidak cocok';h.style.color=n===c?'#27ae60':'#e74c3c';}
</script>

<?php require ROOT . '/app/views/admin/partials/footer.php'; ?>
