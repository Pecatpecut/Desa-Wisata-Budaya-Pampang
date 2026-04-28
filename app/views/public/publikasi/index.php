<?php
$pageTitle = 'Publikasi — Desa Budaya Pampang';
require ROOT . '/app/views/public/partials/header.php';
?>

<section class="hero-publikasi d-flex align-items-center justify-content-center text-center" data-parallax>
  <div class="overlay"></div>
  <div class="content text-white">
    <h1 class="title reveal fade-up">Publikasi</h1>
    <p class="subtitle reveal fade-up delay-1">Galeri foto dan postingan terbaru dari Desa Budaya Pampang</p>
  </div>
</section>

<section id="galeri" class="galeri-section py-5">
  <div class="container">
    <div class="section-header">
      <h2 class="fst-italic">Galeri</h2>
      <div class="line"></div>
    </div>

    <?php if (empty($galeri)): ?>
      <p class="text-center text-muted py-5">Belum ada foto di galeri.</p>
    <?php else: ?>
      <div class="masonry" id="galeri-grid">
        <?php foreach(array_slice($galeri, 0, 9) as $item): ?>
        <div class="item" onclick="openLb('<?= htmlspecialchars($item['image']) ?>','<?= htmlspecialchars($item['title']) ?>')">
          <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>" loading="lazy" />
          <div class="item-overlay"><span><?= htmlspecialchars($item['title']) ?></span></div>
        </div>
        <?php endforeach; ?>
      </div>

      <div class="d-flex justify-content-center align-items-center mt-4 gap-1" id="galeri-pagination"></div>
    <?php endif; ?>

  
    <div id="lightbox" style="display:none" onclick="closeLb()">
      <div class="lb-inner" onclick="event.stopPropagation()">
        <button class="lb-close" onclick="closeLb()"><i class="bi bi-x-lg"></i></button>
        <img id="lb-img" /><p id="lb-title" class="lb-title"></p>
      </div>
    </div>
  </div>
</section>

<section id="postingan" class="postingan-pub py-5">
  <div class="container">
    <div class="section-header">
      <h2 class="fst-italic">Postingan</h2>
      <div class="line"></div>
    </div>

    <?php if (empty($postingan)): ?>
      <p class="text-center text-muted py-5">Belum ada postingan.</p>
    <?php else: ?>

      <div class="postingan-list" id="postingan-list"></div>

    
      <div class="d-flex justify-content-center align-items-center gap-1 mt-4" id="postingan-pagination"></div>

    <?php endif; ?>
  </div>
</section>

<?php require ROOT . '/app/views/public/partials/footer.php'; ?>

<style>
.hero-publikasi { position:relative; height:70vh; background:url('<?= BASE_URL ?>/public/assets/images/tarian.svg') center/cover no-repeat; overflow:hidden; }
.hero-publikasi .overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(26,26,26,.7),rgba(26,26,26,.9)); }
.hero-publikasi .content { position:relative; z-index:2; }
.hero-publikasi .title { font-size:3rem; font-family:'Playfair Display',serif; letter-spacing:-1px; }
.hero-publikasi .subtitle { font-size:1rem; opacity:.9; }

.section-header { display:flex; align-items:center; gap:20px; margin-bottom:30px; font-family:'Playfair Display',serif; font-weight:500; }
.section-header .line { flex:1; height:2px; background:#c0392b; }

.masonry { column-count:3; column-gap:15px; }
.item { break-inside:avoid; margin-bottom:15px; cursor:pointer; position:relative; border-radius:10px; overflow:hidden; }
.item img { width:100%; display:block; border-radius:10px; transition:.25s; }
.item:hover img { transform:scale(1.04); }
.item-overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,.6),transparent); display:flex; align-items:flex-end; padding:10px; color:white; font-size:13px; font-weight:500; opacity:0; transition:.2s; border-radius:10px; }
.item:hover .item-overlay { opacity:1; }

#lightbox { position:fixed; inset:0; background:rgba(0,0,0,.9); display:flex; justify-content:center; align-items:center; z-index:9999; }
.lb-inner { position:relative; display:flex; flex-direction:column; align-items:center; }
.lb-close { position:absolute; top:-40px; right:0; background:rgba(255,255,255,.15); border:none; color:white; width:34px; height:34px; border-radius:50%; cursor:pointer; font-size:14px; display:flex; align-items:center; justify-content:center; }
.lb-close:hover { background:rgba(255,255,255,.3); }
#lb-img { max-width:90vw; max-height:80vh; border-radius:10px; }
.lb-title { color:white; font-size:14px; margin-top:12px; opacity:.8; }

.pg-num { width:34px;height:34px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:13px;transition:.2s; }
.pg-num:hover:not(:disabled) { background:#f0f0f0;color:#c0392b;border-color:#c0392b; }
.pg-num:disabled { opacity:.4;cursor:default; }
.pg-num.active { background:#c0392b;color:white;border-color:#c0392b; }
.pg-btn-pub { width:34px;height:34px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:15px;transition:.2s; }
.pg-btn-pub:hover:not(:disabled) { border-color:#c0392b;color:#c0392b; }
.pg-btn-pub:disabled { opacity:.4;cursor:default; }
.pg-num-pub { width:34px;height:34px;border-radius:6px;border:1px solid #e0e0e0;background:white;cursor:pointer;font-size:13px;transition:.2s; }
.pg-num-pub:hover { background:#f0f0f0;color:#c0392b;border-color:#c0392b; }
.pg-num-pub.active { background:#c0392b;color:white;border-color:#c0392b; }
.pg-ellipsis-pub { display:flex;align-items:center;justify-content:center;width:34px;height:34px;font-size:13px;color:#888; }

.postingan-list { display:flex; flex-direction:column; gap:20px; }
.postingan-item { display:flex; gap:20px; padding:15px; border-radius:10px; cursor:pointer; transition:all .25s; text-decoration:none; color:inherit; }
.postingan-item:hover { background:#f9f9f9; }
.img-wrapper { flex-shrink:0; width:140px; height:100px; border-radius:8px; overflow:hidden; }
.img-wrapper img { width:100%; height:100%; object-fit:cover; transition:.3s; }
.postingan-item:hover .img-wrapper img { transform:scale(1.04); }
.postingan-item .text { display:flex; flex-direction:column; justify-content:center; gap:6px; }
.postingan-item .title { font-size:1rem; font-weight:600; margin:0; color:#1a1a1a; }
.postingan-item .meta { font-size:.82rem; color:#888; }
.read-more { color:#c0392b; font-size:.85rem; font-weight:500; }

@media(max-width:768px){ .masonry{column-count:2} .postingan-item{flex-direction:column} .img-wrapper{width:100%;height:160px} }
</style>

<script>
// ── Galeri pagination (existing logic) ──────────────────────────────────────
const galeriData = <?= json_encode(array_map(fn($g)=>['id'=>$g['id'],'title'=>$g['title'],'image'=>$g['image']],$galeri)) ?>;
const galeriPerPage = 9;
let currentGaleriPage = 1;

function galeriPage(page) {
  const total = galeriData.length;
  const pages = Math.ceil(total / galeriPerPage) || 1;
  currentGaleriPage = Math.min(Math.max(page, 1), pages);

  const grid = document.getElementById('galeri-grid');
  const pg   = document.getElementById('galeri-pagination');
  if (!grid) return;

  const start = (currentGaleriPage - 1) * galeriPerPage;
  const items = galeriData.slice(start, start + galeriPerPage);

  grid.innerHTML = items.map(g => `
    <div class="item" onclick="openLb('${g.image.replace(/'/g,"\\'")}','${g.title.replace(/'/g,"\\'")}')">
      <img src="${g.image}" alt="${g.title}" loading="lazy"/>
      <div class="item-overlay"><span>${g.title}</span></div>
    </div>
  `).join('');

  if (pg && pages > 1) {
    let html = '';
    const prevDis = currentGaleriPage === 1;
    const nextDis = currentGaleriPage === pages;
    html += `<button class="pg-num" ${prevDis ? 'disabled' : ''} onclick="galeriPage(${currentGaleriPage-1})">&lsaquo;</button>`;
    buildRange(currentGaleriPage, pages).forEach(p => {
      if (p === '...') html += `<span class="pg-ellipsis-pub">…</span>`;
      else html += `<button class="pg-num ${p===currentGaleriPage?'active':''}" onclick="galeriPage(${p})">${p}</button>`;
    });
    html += `<button class="pg-num" ${nextDis ? 'disabled' : ''} onclick="galeriPage(${currentGaleriPage+1})">&rsaquo;</button>`;
    pg.innerHTML = html;
  } else if (pg) {
    pg.innerHTML = '';
  }

  if (page !== 1) document.getElementById('galeri')?.scrollIntoView({behavior:'smooth',block:'start'});
}

window.addEventListener('DOMContentLoaded', () => { galeriPage(1); });

function openLb(src, title) {
  document.getElementById('lb-img').src = src;
  document.getElementById('lb-title').textContent = title;
  document.getElementById('lightbox').style.display = 'flex';
}
function closeLb() { document.getElementById('lightbox').style.display = 'none'; }

// ── Postingan pagination ─────────────────────────────────────────────────────
const postinganData = <?= json_encode(array_map(fn($p)=>[
    'title'     => $p['title'],
    'link'      => $p['link'],
    'source'    => $p['source'],
    'thumbnail' => $p['thumbnail'],
    'date'      => $p['date'] ?? '',
], $postingan)) ?>;
const POST_PER_PAGE = 10;
let currentPostPage = 1;

function renderPostingan() {
  const list = document.getElementById('postingan-list');
  const pg   = document.getElementById('postingan-pagination');
  if (!list) return;

  const total = postinganData.length;
  const pages = Math.ceil(total / POST_PER_PAGE) || 1;
  currentPostPage = Math.min(currentPostPage, pages);

  const start = (currentPostPage - 1) * POST_PER_PAGE;
  const items = postinganData.slice(start, start + POST_PER_PAGE);

  list.innerHTML = items.map(p => {
    const dateStr = p.date ? formatDatePub(p.date) : '';
    return `
    <a href="${escH(p.link)}" target="_blank" rel="noopener noreferrer" class="postingan-item">
      <div class="img-wrapper">
        <img src="${escH(p.thumbnail)}" alt="${escH(p.title)}" />
      </div>
      <div class="text">
        <h5 class="title">${escH(p.title)}</h5>
        <small class="meta"><i class="bi bi-link-45deg me-1"></i>${escH(p.source)} &bull; ${dateStr}</small>
        <span class="read-more">Baca selengkapnya →</span>
      </div>
    </a>`;
  }).join('');

  renderPostPagination(pg, currentPostPage, pages);
}

function renderPostPagination(container, current, total) {
  if (total <= 1) { container.innerHTML = ''; return; }
  let html = '';
  html += `<button class="pg-btn-pub" ${current===1?'disabled':''} onclick="gotoPostPage(${current-1})">&lsaquo;</button>`;
  buildRange(current, total).forEach(p => {
    if (p === '...') html += `<span class="pg-ellipsis-pub">…</span>`;
    else html += `<button class="pg-num-pub ${p===current?'active':''}" onclick="gotoPostPage(${p})">${p}</button>`;
  });
  html += `<button class="pg-btn-pub" ${current===total?'disabled':''} onclick="gotoPostPage(${current+1})">&rsaquo;</button>`;
  container.innerHTML = html;
}

function gotoPostPage(p) {
  currentPostPage = p;
  renderPostingan();
  document.getElementById('postingan')?.scrollIntoView({behavior:'smooth',block:'start'});
}

function buildRange(current, total) {
  if (total <= 7) return Array.from({length:total},(_,i)=>i+1);
  const pages = [];
  if (current <= 4) {
    for(let i=1;i<=5;i++) pages.push(i);
    pages.push('...'); pages.push(total);
  } else if (current >= total - 3) {
    pages.push(1); pages.push('...');
    for(let i=total-4;i<=total;i++) pages.push(i);
  } else {
    pages.push(1); pages.push('...');
    for(let i=current-1;i<=current+1;i++) pages.push(i);
    pages.push('...'); pages.push(total);
  }
  return pages;
}

function formatDatePub(str) {
  if (!str) return '';
  const d = new Date(str);
  if (isNaN(d)) return str;
  const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
}

function escH(s) {
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// Init
renderPostingan();
</script>