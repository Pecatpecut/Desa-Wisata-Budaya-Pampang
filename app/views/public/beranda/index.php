<?php
$pageTitle = 'Beranda — Desa Budaya Pampang';
require ROOT . '/app/views/public/partials/header.php';
?>

<section class="hero-section d-flex align-items-center text-center text-white" id="hero">
  <div class="bg-layer" id="hero-bg"></div>
  <div class="overlay"></div>
  <div class="container position-relative content">
    <h1 class="hero-title reveal fade-up fst-italic">Desa Budaya Pampang</h1>
    <p class="hero-subtitle mt-3 reveal fade-up delay-1">
      Menyelami kekayaan budaya Dayak Kenyah melalui tarian, musik, dan kehidupan adat yang masih lestari hingga kini.
    </p>
    <button class="btn btn-danger mt-4 px-4 py-2 rounded-pill btn-jelajah reveal fade-up delay-2"
      onclick="document.getElementById('about').scrollIntoView({behavior:'smooth'})">
      Jelajahi ↓
    </button>
  </div>
</section>

<section id="about" class="about-section py-5">
  <div class="container">
    <div class="row align-items-center g-5 reveal-row">
      <div class="col-lg-6 image-wrapper" data-tilt>
        <img src="<?= BASE_URL ?>/public/assets/images/lamin.svg" class="img-fluid rounded about-img" />
      </div>
      <div class="col-lg-6">
        <h2 class="about-title mb-3">
          <span class="title-main">Sekilas</span>
          <span class="title-accent">Desa Budaya Pampang</span>
        </h2>
        <p class="about-text">
          Desa Budaya Pampang merupakan representasi hidup dari budaya suku Dayak Kenyah yang tetap terjaga di tengah perkembangan zaman. Di sini, tradisi bukan sekadar warisan, melainkan bagian dari kehidupan sehari-hari yang terus dilestarikan dari generasi ke generasi.
        </p>
        <a href="<?= BASE_URL ?>/tentang#sejarah-section" class="btn btn-danger mt-3 px-4 py-2 rounded-pill btn-selengkapnya">
          Selengkapnya →
        </a>
      </div>
    </div>
  </div>
</section>

<section class="wisata-section py-5">
  <div class="container">
    <h2 class="section-title mb-3">Wisata Yang Bisa <span>Kamu</span> Coba</h2>
    <p class="section-desc mb-5">Desa Budaya Pampang bukan sekadar tempat bersejarah, tapi juga menawarkan kekayaan budaya Suku Dayak terbesar di Pulau Kalimantan. Dengan rumah adat, tarian tradisional, serta foto bersama warga lokal, wisatawan dapat menikmati keindahan dan keramahan Desa Pampang.</p>
    <div class="row g-4">
      <?php
        $wisata = [
          ['title'=>'Pertunjukan Tarian','desc'=>'Saksikan tarian tradisional Dayak Kenyah setiap Minggu.','image'=>BASE_URL.'/public/assets/images/tarian.svg'],
          ['title'=>'Kunjungan ke Lamin','desc'=>'Jelajahi rumah adat khas Pampang dan kehidupan suku Dayak.','image'=>BASE_URL.'/public/assets/images/lamin-potrait.svg'],
          ['title'=>'Susur Sungai','desc'=>'Nikmati keindahan sungai alami dengan suasana segar.','image'=>BASE_URL.'/public/assets/images/susur-sungai.svg'],
        ];
      ?>
      <?php foreach($wisata as $w): ?>
      <div class="col-md-4">
        <div class="wisata-card">
          <img src="<?= htmlspecialchars($w['image']) ?>" class="card-img" />
          <div class="overlay"></div>
          <div class="card-content">
            <h5><?= htmlspecialchars($w['title']) ?></h5>
            <p><?= htmlspecialchars($w['desc']) ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<div class="dayak-section-divider">
  <div class="dayak-strip"></div>
  <div class="dayak-ornament"><span></span><span></span><span></span><span></span><span></span></div>
  <div class="dayak-strip reverse"></div>
</div>

<?php if ($kontak): ?>
<section class="info-section">
  <div class="container">
    <div class="row justify-content-center text-center">
      <?php
        $infoList = [
          ['title'=>'Jam Operasional','icon'=>'bi bi-clock','data'=>[
            'Senin s/d Sabtu', $kontak['jam_weekdays']??'-', '',
            'Minggu', $kontak['jam_sunday']??'-'
          ]],
          ['title'=>'Tiket Parkir','icon'=>'bi bi-truck','data'=>[
            'Motor','Rp '.($kontak['parkir_motor']??'-'),
            'Mobil','Rp '.($kontak['parkir_mobil']??'-'),
            'Bus','Rp '.($kontak['parkir_bus']??'-'),
          ]],
          ['title'=>'Tiket Wisata','icon'=>'bi bi-person','data'=>[
            'Pertunjukan Tarian','Rp '.($kontak['wisata_tarian']??'-'),
            'Kunjungan ke Lamin','Rp '.($kontak['wisata_lamin']??'-'),
            'Susur Sungai (min 10 org)','Rp '.($kontak['wisata_susur']??'-'),
          ]],
          ['title'=>'Biaya Opsional','icon'=>'bi bi-camera','data'=>[
            'Foto bersama penari','Rp '.($kontak['biaya_foto']??'-'),
            'Sewa pakaian adat','Rp '.($kontak['biaya_sewa']??'-'),
          ]],
        ];
      ?>
      <?php foreach($infoList as $item): ?>
      <div class="col-md-6 col-lg-3 mb-4">
        <div class="info-card">
          <div class="icon-wrapper"><i class="<?= htmlspecialchars($item['icon']) ?>"></i></div>
          <h5 class="title"><?= htmlspecialchars($item['title']) ?></h5>
          <div class="content">
            <?php foreach($item['data'] as $j => $text): ?>
              <div class="<?= $j%2===1 ? 'price' : 'label' ?>"><?= htmlspecialchars($text) ?></div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<div class="dayak-section-divider">
  <div class="dayak-strip"></div>
  <div class="dayak-ornament"><span></span><span></span><span></span><span></span><span></span></div>
  <div class="dayak-strip reverse"></div>
</div>

<?php if (!empty($galeri)): ?>
<section class="gallery-section pt-5 pb-1">
  <div class="container">
    <h2 class="section-title mb-5 text-center"><span>Cerita</span> dalam Gambar</h2>
    <div class="gallery-grid">
      <?php foreach(array_slice($galeri,0,6) as $i => $item): ?>
        <?php
          $classes = ['tall','','','','tall',''];
        ?>
        <div class="gallery-item <?= $classes[$i] ?? '' ?>" onclick="openLightbox('<?= htmlspecialchars($item['image']) ?>')">
          <img src="<?= htmlspecialchars($item['image']) ?>" loading="lazy" />
          <div class="overlay"><div class="caption"><h6><?= htmlspecialchars($item['title']) ?></h6></div></div>
        </div>
      <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-end mt-4">
      <a href="<?= BASE_URL ?>/publikasi#galeri" class="btn-more">Lebih Banyak →</a>
    </div>
    <div id="lightbox" style="display:none" onclick="closeLightbox()">
      <img id="lightbox-img" />
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!empty($postingan)): ?>
<section class="postingan-section py-5">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title fst-italic">Postingan</h2>
      <div class="line"></div>
    </div>
    <div class="row g-4">
      <?php foreach($postingan as $post): ?>
      <div class="col-md-4">
        <div class="postingan-card" onclick="window.open('<?= htmlspecialchars($post['link']) ?>','_blank')">
          <div class="image-wrapper">
            <img src="<?= htmlspecialchars($post['thumbnail']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" />
          </div>
          <div class="content">
            <h6 class="title"><?= htmlspecialchars($post['title']) ?></h6>
            <small class="meta"><?= htmlspecialchars($post['source']) ?> • <?= date('d M Y', strtotime($post['date'])) ?></small>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-end mt-4">
      <a href="<?= BASE_URL ?>/publikasi#postingan" class="btn-more">Lebih Banyak →</a>
    </div>
  </div>
</section>
<?php endif; ?>


<div class="dayak-section-divider">
  <div class="dayak-strip"></div>
  <div class="dayak-ornament"><span></span><span></span><span></span><span></span><span></span></div>
  <div class="dayak-strip reverse"></div>
</div>


<?php require ROOT . '/app/views/public/partials/footer.php'; ?>

<style>
.hero-section { height:100vh; position:relative; overflow:hidden; }
.bg-layer { position:absolute; inset:0; background:url('<?= BASE_URL ?>/public/assets/images/lamin.svg') center/cover no-repeat; transition:transform .3s ease; z-index:0; }
.hero-section .overlay { position:absolute; inset:0; background:black; opacity: 0.75; z-index:1; }
.hero-section .content { z-index:2; }
.hero-title { font-size:3.2rem; font-family:'Playfair Display',serif; letter-spacing:-2px; }
.hero-subtitle { font-family:'Inter'; max-width:600px; margin:auto; font-size:1rem; opacity:.9; }
.btn-jelajah { animation:bounce 2.2s infinite; }
@keyframes bounce { 0%,100%{transform:translateY(0)} 50%{transform:translateY(6px)} }

.about-section { padding:100px 0; }
.about-title { font-size:2.4rem; font-weight:600; display:flex; gap:8px; flex-wrap:wrap; letter-spacing:-1px; }
.title-main { font-family:'Inter'; font-weight:600; color:#111; }
.title-accent { font-family:'Playfair Display',serif; font-style:italic; font-weight:500; color:#111; }
.about-img { transition:transform .2s ease; box-shadow:0 10px 30px rgba(0,0,0,.15); }
.about-text { color:#555; line-height:1.7; max-width:500px; font-family:'Inter'; text-align:justify; }
.image-wrapper { perspective:1000px; }
.btn-selengkapnya:hover { transform:translateY(-2px); box-shadow:0 4px 8px rgba(0,0,0,.2); transition:all .3s; }

.gallery-section { background:#fff; }
.section-title span { font-family:'Playfair Display',serif; font-style:italic; font-weight:500; }
.gallery-grid { display:grid; grid-template-columns:repeat(3,1fr); grid-auto-rows:200px; gap:12px; }
.gallery-item { position:relative; overflow:hidden; border-radius:10px; cursor:pointer; }
.gallery-item.tall { grid-row:span 2; }
.gallery-item img { width:100%; height:100%; object-fit:cover; transition:.3s; }
.gallery-item:hover img { transform:scale(1.05); }
.gallery-item .overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,.6),transparent); display:flex; align-items:flex-end; padding:10px; opacity:0; transition:.2s; border-radius:10px; }
.gallery-item:hover .overlay { opacity:1; }
.caption h6 { color:white; font-size:13px; font-weight:500; }
.btn-more { background:none; border:1px solid #ccc; padding:8px 18px; border-radius:999px; font-size:14px; color:#333; cursor:pointer; transition:.2s; text-decoration:none; }
.btn-more:hover { border-color:#c0392b; color:#c0392b; }

#lightbox { position:fixed; inset:0; background:rgba(0,0,0,.9); display:flex; justify-content:center; align-items:center; z-index:9999; }
#lightbox img { max-width:90vw; max-height:80vh; border-radius:10px; }

.info-section { background:#0b0b0b; color:white; padding:110px 0; }
.info-card { padding:30px 20px; border-radius:16px; transition:all .4s; background:transparent; }
.info-card:hover { transform:translateY(-8px); background:rgba(255,255,255,.03); }
.icon-wrapper { width:70px; height:70px; margin:0 auto 20px; border-radius:50%; display:flex; align-items:center; justify-content:center; background:rgba(244,197,66,.08); border:1px solid rgba(244,197,66,.3); transition:.3s; }
.icon-wrapper i { font-size:1.8rem; color:#f4c542; }
.info-card:hover .icon-wrapper { transform:scale(1.1); background:rgba(244,197,66,.15); }
.info-card .title { font-weight:600; margin-bottom:20px; }
.info-card .content { font-size:.9rem; }
.info-card .label { color:#aaa; margin-top:8px; }
.info-card .price { font-weight:600; color:white; margin-bottom:5px; }
.info-card .content div:empty { height:10px; }

.postingan-section { background:#fff; }
.section-header { display:flex; align-items:center; gap:20px; margin-bottom:30px; font-family:'Playfair Display',serif; font-weight:500; }
.section-header .line { flex:1; height:2px; background:#c0392b; }
.postingan-card { cursor:pointer; transition:all .25s; border-radius:10px; overflow:hidden; border:1px solid #f0f0f0; }
.postingan-card:hover { transform:translateY(-3px); box-shadow:0 10px 25px rgba(0,0,0,.08); }
.postingan-card .image-wrapper { height:180px; overflow:hidden; }
.postingan-card .image-wrapper img { width:100%; height:100%; object-fit:cover; transition:.3s; }
.postingan-card:hover .image-wrapper img { transform:scale(1.04); }
.postingan-card .content { padding:16px; }
.postingan-card .title { font-size:14px; font-weight:600; margin-bottom:6px; color:#1a1a1a; }
.postingan-card .meta { font-size:.82rem; color:#888; }

.wisata-section { background:#fff; padding:100px 0; }
.wisata-section .section-title { font-size:2rem; font-weight:600; font-family:'Inter'; }
.wisata-section .section-title span { font-family:'Playfair Display',serif; font-style:italic; }
.wisata-section .section-desc { font-family:'Inter'; max-width:100%; color:#555; }
.wisata-card { position:relative; height:320px; border-radius:8px; overflow:hidden; cursor:pointer; opacity:0; transform:translateY(50px); transition:all .6s; }
.wisata-card.show { opacity:1; transform:translateY(0); }
.wisata-card .card-img { position:absolute; inset:0; width:100%; height:100%; object-fit:cover; transition:transform .5s; }
.wisata-card .overlay { position:absolute; inset:0; background:linear-gradient(to top,rgba(0,0,0,.8),rgba(0,0,0,.3)); transition:.3s; }
.wisata-card .card-content { position:absolute; bottom:0; padding:20px; color:white; z-index:2; transform:translateY(20px); opacity:.8; transition:.3s; }
.wisata-card:hover { transform:translateY(-8px); box-shadow:0 15px 40px rgba(0,0,0,.3); }
.wisata-card:hover .card-img { transform:scale(1.1); }
.wisata-card:hover .card-content { transform:translateY(0); opacity:1; }

@media(max-width:768px){
  .hero-title{font-size:2.3rem;letter-spacing:-1px}
  .hero-subtitle{font-size:.9rem;padding:0 16px}
  .gallery-grid{grid-template-columns:repeat(2,1fr)}
  .gallery-item.tall{grid-row:span 1}
  .info-section{padding:70px 0}
  .about-section{padding:60px 0}
  .wisata-section{padding:60px 0}
}
@media(max-width:480px){
  .hero-title{font-size:1.8rem}
  .gallery-grid{grid-template-columns:1fr}
}
</style>

<script>
const heroBg = document.getElementById('hero-bg');
const heroSection = document.getElementById('hero');
if (heroBg && heroSection) {
  heroSection.addEventListener('mousemove', e => {
    const x = (e.clientX/window.innerWidth - .5)*15;
    const y = (e.clientY/window.innerHeight - .5)*15;
    heroBg.style.transform = `scale(1.05) translate(${x}px,${y}px)`;
  });
  heroSection.addEventListener('mouseleave', () => {
    heroBg.style.transform = 'scale(1)';
  });
}

function openLightbox(src) {
  document.getElementById('lightbox-img').src = src;
  document.getElementById('lightbox').style.display = 'flex';
}
function closeLightbox() {
  document.getElementById('lightbox').style.display = 'none';
}
</script>
