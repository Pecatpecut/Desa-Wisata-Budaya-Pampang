<?php
$pageTitle = 'Kontak — Desa Budaya Pampang';
require ROOT . '/app/views/public/partials/header.php';
?>

<section class="hero-kontak d-flex align-items-center justify-content-center text-center" data-parallax>
  <div class="overlay"></div>
  <div class="content text-white">
    <h1 class="title reveal fade-up">Kontak</h1>
    <p class="subtitle reveal fade-up delay-1">Temukan informasi dan hubungi kami dengan mudah</p>
  </div>
</section>

<section class="agenda-section py-5">
  <div class="container">
    <h2 class="ag-title"><span>Agenda</span> Terdekat</h2>
    <div class="row mt-4 align-items-start">
      <div class="col-lg-6">
        <div class="calendar">
          <div class="calendar-header">
            <button onclick="prevMonth()">‹</button>
            <h5 id="month-year"></h5>
            <button onclick="nextMonth()">›</button>
          </div>
          <div class="calendar-grid" id="calendar-grid">
            <div class="day-header">Min</div>
            <div class="day-header">Sen</div>
            <div class="day-header">Sel</div>
            <div class="day-header">Rab</div>
            <div class="day-header">Kam</div>
            <div class="day-header">Jum</div>
            <div class="day-header">Sab</div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div id="nearest-event"></div>
      </div>
    </div>

    <div id="agenda-modal" style="display:none" class="modal-bg" onclick="if(event.target===this)closeModal()">
      <div class="modal-content-ag">
        <button class="close-icon" onclick="closeModal()">✕</button>
        <h4 class="modal-title">Detail Agenda</h4>
        <div id="modal-events"></div>
      </div>
    </div>
  </div>
</section>

<section class="kontak-lokasi py-5">
  <div class="container">
    <h2 class="text-center mb-5">Temukan <span class="fst-italic" style="font-family: 'Playfair Display', serif; color: #c0392b;">Kami</span> Di</h2>
    <div class="row g-4 align-items-start">
      <div class="col-lg-4">
        <?php if($kontak): ?>
        <a href="mailto:<?= htmlspecialchars($kontak['email']??'') ?>" class="contact-card dark">
          <i class="bi bi-envelope"></i><span><?= htmlspecialchars($kontak['email']??'-') ?></span>
        </a>
        <a href="https://www.instagram.com/<?= htmlspecialchars(ltrim($kontak['instagram']??'','@')) ?>" target="_blank" class="contact-card dark">
          <i class="bi bi-instagram"></i><span><?= htmlspecialchars($kontak['instagram']??'-') ?></span>
        </a>
        <div class="contact-card dark">
          <i class="bi bi-whatsapp"></i>
          <div class="text-group">
            <?php if(!empty($kontak['whatsapp1'])): ?>
            <?php $wa1 = '62'.ltrim(preg_replace('/[^0-9]/','',$kontak['whatsapp1']),'0'); ?>
            <a href="https://wa.me/<?= $wa1 ?>" target="_blank"><?= htmlspecialchars($kontak['whatsapp1']) ?></a>
            <?php endif; ?>
            <?php if(!empty($kontak['whatsapp2'])): ?>
            <?php $wa2 = '62'.ltrim(preg_replace('/[^0-9]/','',$kontak['whatsapp2']),'0'); ?>
            <a href="https://wa.me/<?= $wa2 ?>" target="_blank"><?= htmlspecialchars($kontak['whatsapp2']) ?></a>
            <?php endif; ?>
          </div>
        </div>
        <div class="contact-card light">
          <i class="bi bi-geo-alt"></i>
          <p><?= htmlspecialchars($kontak['alamat']??'-') ?></p>
        </div>
        <?php endif; ?>
      </div>
      <div class="col-lg-8">
        <div class="map-wrapper">
          <iframe class="map" src="https://maps.google.com/maps?q=desa%20pampang&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
          <div class="map-overlay">
            <button onclick="window.open('https://www.google.com/maps?q=desa+pampang','_blank')">Buka di Google Maps →</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require ROOT . '/app/views/public/partials/footer.php'; ?>

<script>
const events = <?= json_encode($agenda, JSON_HEX_TAG | JSON_HEX_AMP) ?>;
let current = new Date();

function renderCalendar() {
  const year  = current.getFullYear();
  const month = current.getMonth();
  const today = new Date();

  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  document.getElementById('month-year').textContent = months[month] + ' ' + year;

  const firstDay    = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  const grid = document.getElementById('calendar-grid');

  grid.querySelectorAll('.date, .empty-date').forEach(el => el.remove());
  for (let i = 0; i < firstDay; i++) {
    const el = document.createElement('div');
    el.className = 'empty-date';
    grid.appendChild(el);
  }
  for (let d = 1; d <= daysInMonth; d++) {
    const dateStr  = year + '-' + String(month + 1).padStart(2, '0') + '-' + String(d).padStart(2, '0');
    const isToday  = today.getFullYear() === year && today.getMonth() === month && today.getDate() === d;
    const hasEvent = events.some(e => e.date === dateStr);

    const el = document.createElement('div');
    el.className = 'date' + (isToday ? ' today' : '') + (hasEvent ? ' has-event' : '');
    el.onclick   = () => openDate(dateStr);

    const num = document.createElement('span');
    num.textContent = d;
    el.appendChild(num);

    if (hasEvent) {
      const dot = document.createElement('span');
      dot.className = 'dot';
      el.appendChild(dot);
    }

    grid.appendChild(el);
  }

  renderNearest();
}

function renderNearest() {
  const today = new Date(); today.setHours(0,0,0,0);
  const upcoming = events
    .filter(e => new Date(e.date + 'T00:00:00') >= today)
    .sort((a, b) => new Date(a.date) - new Date(b.date));
  const el = document.getElementById('nearest-event');
  if (upcoming.length) {
    const ev = upcoming[0];
    const card = document.createElement('div');
    card.className = 'agenda-card';
    card.onclick = () => openCard(ev.date);
    card.innerHTML = `
      <h4></h4>
      <div class="meta-row"><span></span><span></span></div>
      <div class="location"></div>
      <span class="detail-link">Lihat detail →</span>
    `;
    card.querySelector('h4').textContent = ev.title;
    card.querySelectorAll('.meta-row span')[0].textContent = '📅 ' + formatDate(ev.date);
    card.querySelectorAll('.meta-row span')[1].textContent = '⏰ ' + ev.time.substring(0,5);
    card.querySelector('.location').textContent = '📍 ' + ev.location;
    el.innerHTML = '';
    el.appendChild(card);
  } else {
    el.innerHTML = `<div class="no-event"><i class="bi bi-calendar-check"></i><p>Tidak ada agenda mendatang saat ini</p></div>`;
  }
}

function openDate(dateStr) {
  const evs = events.filter(e => e.date === dateStr);
  if (!evs.length) return;
  showModal(evs);
}

function openCard(dateStr) {
  const evs = events.filter(e => e.date === dateStr);
  showModal(evs);
}

function showModal(evs) {
  const container = document.getElementById('modal-events');
  container.innerHTML = '';
  evs.forEach(ev => {
    const item = document.createElement('div');
    item.className = 'modal-item';
    const h5 = document.createElement('h5');
    h5.textContent = ev.title;
    const meta = document.createElement('div');
    meta.className = 'meta';
    const s1 = document.createElement('span'); s1.textContent = '📅 ' + formatDate(ev.date);
    const s2 = document.createElement('span'); s2.textContent = '⏰ ' + ev.time.substring(0,5);
    meta.appendChild(s1); meta.appendChild(s2);
    const loc = document.createElement('div');
    loc.className = 'location';
    loc.textContent = '📍 ' + ev.location;
    item.appendChild(h5); item.appendChild(meta); item.appendChild(loc);
    container.appendChild(item);
  });
  document.getElementById('agenda-modal').style.display = 'flex';
}

function closeModal() { document.getElementById('agenda-modal').style.display = 'none'; }
function prevMonth()  { current.setMonth(current.getMonth() - 1); renderCalendar(); }
function nextMonth()  { current.setMonth(current.getMonth() + 1); renderCalendar(); }

function formatDate(d) {
  const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  const dt = new Date(d + 'T00:00:00');
  return dt.getDate() + ' ' + months[dt.getMonth()] + ' ' + dt.getFullYear();
}

renderCalendar();
</script>

<style>
.hero-kontak { position:relative; height:70vh; background:url('<?= BASE_URL ?>/public/assets/images/lamin.svg') center/cover no-repeat; overflow:hidden; }
.hero-kontak .overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(26,26,26,.7),rgba(26,26,26,.9)); }
.hero-kontak .content { position:relative; z-index:2; }
.hero-kontak .title { font-size:3rem; font-family:'Playfair Display',serif; letter-spacing:-1px; }
.hero-kontak .subtitle { opacity:.9; font-size:1rem; }

.ag-title { font-size:2.2rem; margin-bottom:10px; }
.ag-title span { font-family:'Playfair Display',serif; font-style:italic; }
.ag-title::after { content:""; display:block; width:60px; height:3px; background:#c0392b; margin-top:10px; }

.calendar { background:white; padding:20px; border-radius:16px; box-shadow:0 10px 25px rgba(0,0,0,.05); }
.calendar-header { display:flex; justify-content:space-between; align-items:center; background:linear-gradient(135deg,#c0392b,#a93226); padding:10px 15px; border-radius:10px; color:white; margin-bottom:15px; }
.calendar-header button { background:rgba(255,255,255,.2); border:none; width:30px; height:30px; border-radius:6px; color:white; cursor:pointer; font-size:18px; }
.calendar-header h5 { margin:0; }

.calendar-grid { display:grid; grid-template-columns:repeat(7,1fr); gap:4px; }
.day-header { text-align:center; font-size:.75rem; font-weight:600; color:#777; padding:6px 0; }
.date { position:relative; display:flex; flex-direction:column; align-items:center; justify-content:center; padding:7px 2px; border-radius:8px; cursor:pointer; transition:.2s; font-size:13px; min-height:36px; }
.date:hover { background:rgba(192,57,43,.1); }
.date.today { border:2px solid #c0392b; font-weight:600; }
.date.has-event { background:rgba(192,57,43,.08); }
.empty-date { min-height:36px; }
.dot { display:block; width:5px; height:5px; background:#c0392b; border-radius:50%; margin-top:2px; }

.agenda-card { background:linear-gradient(135deg,#c0392b,#922b21); padding:30px; border-radius:18px; color:white; box-shadow:0 20px 40px rgba(192,57,43,.3); cursor:pointer; transition:.3s; position:relative; overflow:hidden; }
.agenda-card:hover { transform:translateY(-6px); }
.agenda-card h4 { font-size:1.2rem; margin-bottom:14px; }
.meta-row { display:flex; gap:15px; font-size:.85rem; color:rgba(255,255,255,.85); margin-bottom:10px; }
.location { font-size:.9rem; margin-bottom:14px; }
.detail-link { font-size:.85rem; opacity:.9; }
.no-event { text-align:center; padding:40px 20px; color:#aaa; }
.no-event i { font-size:48px; display:block; margin-bottom:12px; }

.modal-bg { position:fixed; inset:0; background:rgba(0,0,0,.4); backdrop-filter:blur(6px); display:flex; justify-content:center; align-items:center; z-index:999; }
.modal-content-ag { background:white; padding:28px; border-radius:16px; width:90%; max-width:400px; position:relative; }
.close-icon { position:absolute; right:15px; top:12px; border:none; background:none; cursor:pointer; font-size:16px; }
.modal-title { font-weight:700; margin-bottom:16px; }
.modal-item { padding:12px 0; border-bottom:1px solid #f0f0f0; }
.modal-item:last-child { border-bottom:none; }
.modal-item h5 { margin:0 0 8px; }
.modal-item .meta { font-size:.8rem; color:#777; display:flex; gap:10px; margin-bottom:6px; }

h2 em { font-family:'Playfair Display',serif; }
.contact-card { display:flex; align-items:center; gap:15px; padding:18px 20px; border-radius:14px; margin-bottom:15px; text-decoration:none; transition:all .3s; position:relative; overflow:hidden; }
.contact-card.dark { background:#0f0f0f; color:white; box-shadow:0 10px 25px rgba(0,0,0,.25); }
.contact-card.light { background:#f5f5f5; color:#333; }
.contact-card i { font-size:1.6rem; min-width:30px; transition:.3s; }
.text-group { display:flex; flex-direction:column; }
.text-group a { color:white; text-decoration:none; }
.text-group a:hover { text-decoration:underline; }
.contact-card:hover { transform:translateY(-6px) scale(1.02); }
.contact-card.dark::after { content:""; position:absolute; inset:0; background:radial-gradient(circle at top right,rgba(255,255,255,.1),transparent); opacity:0; transition:.3s; }
.contact-card.dark:hover::after { opacity:1; }

.map-wrapper { position:relative; border-radius:14px; overflow:hidden; }
.map { width:100%; height:420px; border:none; filter:grayscale(30%); transition:.4s; }
.map-wrapper:hover .map { filter:grayscale(0%); transform:scale(1.02); }
.map-overlay { position:absolute; inset:0; display:flex; justify-content:center; align-items:center; background:rgba(0,0,0,.4); opacity:0; transition:.3s; }
.map-wrapper:hover .map-overlay { opacity:1; }
.map-overlay button { background:#c0392b; color:white; border:none; padding:10px 20px; border-radius:999px; cursor:pointer; transition:.3s; }
.map-overlay button:hover { transform:scale(1.05); }

@media(max-width:768px){ .map{height:300px} }
</style>
