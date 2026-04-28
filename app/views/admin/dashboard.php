<?php
$pageTitle = 'Dashboard';
$active    = 'dashboard';
require ROOT . '/app/views/admin/partials/header.php';
?>

<div class="page-header">
  <h2 class="page-title">Dashboard</h2>
  <p class="page-sub">Selamat datang, <?= htmlspecialchars($_SESSION['admin_email']??'Admin') ?></p>
</div>

<div id="dashboard-app">
<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-num">{{ counts.agenda }}</div>
    <div class="stat-label"><i class="bi bi-calendar3 me-1"></i>Total Agenda</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">{{ counts.galeri }}</div>
    <div class="stat-label"><i class="bi bi-images me-1"></i>Total Foto Galeri</div>
  </div>
  <div class="stat-card">
    <div class="stat-num">{{ counts.postingan }}</div>
    <div class="stat-label"><i class="bi bi-newspaper me-1"></i>Total Postingan</div>
  </div>
</div>
</div>

<script>
const { createApp, ref, onMounted } = Vue;
createApp({
  setup() {
    const targets = {
      agenda:     <?= count($agenda) ?>,
      galeri:     <?= count($galeri) ?>,
      postingan:  <?= count($postingan) ?>,
    };
    const counts = ref({ agenda: 0, galeri: 0, postingan: 0 });

    function animateCount(key, target) {
      const duration = 900;
      const start = performance.now();
      function step(now) {
        const elapsed = now - start;
        const progress = Math.min(elapsed / duration, 1);
        const ease = 1 - Math.pow(1 - progress, 3);
        counts.value[key] = Math.round(ease * target);
        if (progress < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
    }

    onMounted(() => {
      Object.entries(targets).forEach(([key, val]) => animateCount(key, val));
    });

    return { counts };
  }
}).mount('#dashboard-app');
</script>

<?php if (!empty($agenda)): ?>
<?php
  $upcoming = array_filter($agenda, fn($a) => strtotime($a['date']) >= strtotime(date('Y-m-d')));
  $upcoming = array_slice(array_values($upcoming), 0, 5);
?>
<div class="form-card">
  <h5 class="form-title"><i class="bi bi-calendar3 me-2"></i>Agenda Mendatang</h5>


  <div class="table-card dash-agenda-desktop" style="border:none;margin:0">
    <table>
      <thead><tr><th>Kegiatan</th><th>Tanggal</th><th>Waktu</th><th>Lokasi</th></tr></thead>
      <tbody>
        <?php foreach($upcoming as $ag): ?>
        <tr>
          <td><?= htmlspecialchars($ag['title']) ?></td>
          <td><?= date('d M Y', strtotime($ag['date'])) ?></td>
          <td><?= substr($ag['time'],0,5) ?></td>
          <td><?= htmlspecialchars($ag['location']) ?></td>
        </tr>
        <?php endforeach; ?>
        <?php if(empty($upcoming)): ?>
        <tr><td colspan="4" class="text-center text-muted py-3">Tidak ada agenda mendatang</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>


  <div class="dash-agenda-mobile">
    <?php if(empty($upcoming)): ?>
    <p class="text-center text-muted py-3">Tidak ada agenda mendatang</p>
    <?php endif; ?>
    <?php foreach($upcoming as $ag): ?>
    <div class="agenda-card">
      <div class="agenda-card-top">
        <div class="agenda-card-info">
          <div class="agenda-card-title"><?= htmlspecialchars($ag['title']) ?></div>
          <div class="agenda-card-meta"><i class="bi bi-calendar3"></i> <?= date('d M Y', strtotime($ag['date'])) ?> &bull; <i class="bi bi-clock"></i> <?= substr($ag['time'],0,5) ?></div>
          <div class="agenda-card-meta"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($ag['location']) ?></div>
        </div>
        <span class="badge-upcoming" style="flex-shrink:0;align-self:flex-start">Mendatang</span>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<?php if (!empty($galeri)): ?>
<div class="form-card">
  <h5 class="form-title"><i class="bi bi-images me-2"></i>Foto Galeri Terbaru</h5>
  <div class="galeri-grid">
    <?php foreach(array_slice($galeri,0,6) as $g): ?>
    <div class="galeri-card">
      <div class="galeri-img-wrap">
        <img src="<?= htmlspecialchars($g['image']) ?>" alt="<?= htmlspecialchars($g['title']) ?>" />
      </div>
      <div class="galeri-info"><?= htmlspecialchars($g['title']) ?></div>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<style>
.quick-link { display:flex; align-items:center; gap:12px; background:white; border:1px solid #f0f0f0; border-radius:12px; padding:16px 20px; text-decoration:none; color:#333; transition:.2s; font-size:14px; font-weight:500; }
.quick-link:hover { border-color:#c0392b; color:#c0392b; transform:translateY(-2px); box-shadow:0 8px 20px rgba(0,0,0,.06); }
.quick-link i { font-size:1.2rem; }

.dash-agenda-desktop { display:block; }
.dash-agenda-mobile  { display:none; }

.agenda-card { background:#fafafa; border-radius:12px; border:1px solid #f0f0f0; padding:12px 14px; margin-bottom:8px; }
.agenda-card-top { display:flex; justify-content:space-between; align-items:flex-start; gap:12px; }
.agenda-card-info { flex:1; min-width:0; }
.agenda-card-title { font-size:14px; font-weight:600; margin-bottom:4px; }
.agenda-card-meta  { font-size:12px; color:#888; margin-bottom:2px; }
.agenda-card-meta i { margin-right:4px; }

@media (max-width: 768px) {
  .dash-agenda-desktop { display:none; }
  .dash-agenda-mobile  { display:block; }
}
</style>

<?php if (!empty($postingan)): ?>
<div class="form-card">
  <h5 class="form-title"><i class="bi bi-newspaper me-2"></i>Postingan Terbaru</h5>
  <div class="post-list">
    <?php foreach(array_slice($postingan,0,5) as $p): ?>
    <div class="post-card">
      <div class="thumb-wrap">
        <img src="<?= htmlspecialchars($p['thumbnail']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" />
      </div>
      <div class="post-body">
        <h5><?= htmlspecialchars($p['title']) ?></h5>
        <p class="source"><i class="bi bi-link-45deg me-1"></i><?= htmlspecialchars($p['source']) ?></p>
        <p class="date"><?= date('d M Y', strtotime($p['date'])) ?></p>
      </div>
      <a href="<?= htmlspecialchars($p['link']) ?>" target="_blank" class="btn-open">
        <i class="bi bi-box-arrow-up-right me-1"></i>Buka
      </a>
    </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>

<style>
.post-list { display:flex; flex-direction:column; gap:10px; }
.post-card { display:flex; align-items:center; gap:16px; padding:14px 16px; background:#fafafa; border-radius:12px; border:1px solid #f0f0f0; }
.thumb-wrap { width:80px; height:60px; border-radius:8px; overflow:hidden; flex-shrink:0; }
.thumb-wrap img { width:100%; height:100%; object-fit:cover; }
.post-body { flex:1; min-width:0; }
.post-body h5 { margin:0 0 4px; font-size:14px; font-weight:600; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.source, .date { font-size:12px; color:#888; margin:0; }
.btn-open { padding:6px 12px; border-radius:8px; background:#f0f0f0; color:#333; text-decoration:none; font-size:13px; white-space:nowrap; transition:.2s; }
.btn-open:hover { background:#c0392b; color:white; }
</style>
<?php require ROOT . '/app/views/admin/partials/footer.php'; ?>
