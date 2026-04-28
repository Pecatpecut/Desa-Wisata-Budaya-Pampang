<?php
$pageTitle = 'Tentang Kami — Desa Budaya Pampang';
require ROOT . '/app/views/public/partials/header.php';
?>

<section class="hero-tentang d-flex align-items-center justify-content-center text-center" data-parallax>
  <div class="overlay"></div>
  <div class="content text-white">
    <h1 class="title reveal fade-up">Tentang Kami</h1>
    <p class="subtitle reveal fade-up delay-1">Tradisi yang hidup dalam setiap gerakan dan cerita</p>
  </div>
</section>

<section id="sejarah-section" class="sejarah-section py-4">
  <div class="container">
    <div class="text-center mb-4 reveal fade-up">
      <h2 class="title"><span class="fst-italic">Sejarah</span> Turun Temurun</h2>
    </div>
    <div class="row g-4 align-items-center">
      <div class="col-lg-6 reveal fade-left">
        <div class="text-content">
          <p>Di tengah perkembangan zaman yang terus bergerak cepat, Desa Budaya Pampang berdiri sebagai ruang hidup yang menjaga jejak tradisi. Desa ini dihuni oleh masyarakat suku Dayak Kenyah, yang dahulu berasal dari wilayah pedalaman seperti Kutai Barat dan Malinau.</p>
          <p>Pada sekitar tahun 1960-an, mereka melakukan perjalanan panjang meninggalkan tanah asalnya. Bukan sekadar perpindahan tempat, tetapi sebuah langkah besar untuk masa depan—mendekatkan diri ke wilayah yang lebih mudah mengakses pendidikan dan layanan kesehatan.</p>
        </div>
      </div>
      <div class="col-lg-6 reveal fade-right">
        <div class="image-wrapper" data-tilt>
          <img src="<?= BASE_URL ?>/public/assets/images/lamin.svg" class="img-fluid sejarah-img" />
        </div>
      </div>
    </div>
    <div class="row mt-4">
      <div class="col-12 reveal fade-up">
        <div class="text-content">
          <p>Di tanah baru ini, masyarakat mulai membangun kehidupan tanpa melepaskan identitasnya. Tradisi tetap dijaga, nilai-nilai adat terus dihidupkan, dan kebersamaan menjadi fondasi utama dalam kehidupan sehari-hari. Kegiatan seperti gotong royong, perayaan keagamaan, hingga panen raya menjadi bagian yang tidak terpisahkan dari kehidupan mereka.</p>
          <p>Waktu terus berjalan, namun semangat menjaga budaya tidak pernah pudar. Desa Pampang tumbuh bukan hanya sebagai tempat tinggal, tetapi sebagai ruang pelestarian warisan leluhur yang tetap hidup di tengah modernitas. Hingga akhirnya, pada tahun 1991, Pemerintah Provinsi Kalimantan Timur secara resmi menetapkan Desa Pampang sebagai desa budaya. Sejak saat itu, Pampang dikenal sebagai salah satu pusat pelestarian budaya Dayak Kenyah—tempat di mana tradisi tidak hanya dikenang, tetapi terus dijalani.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="fasilitas-section py-5">
  <div class="container">
    <div class="row align-items-start">
      <div class="col-lg-6 fasilitas-box reveal fade-left">
        <h3 class="title"><span>Fasilitas</span> Yang Tersedia</h3>
        <div class="row">
          <div class="col-6">
            <ul class="list">
              <?php foreach([['bi bi-p-circle','Areal Parkir'],['bi bi-building','Balai Pertemuan'],['bi bi-tree','Jungle Tracking'],['bi bi-droplet','Kamar Mandi Umum']] as $f): ?>
              <li><i class="<?= $f[0] ?>"></i><span><?= $f[1] ?></span></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <div class="col-6">
            <ul class="list">
              <?php foreach([['bi bi-bag','Kios Souvenir'],['bi bi-cup-hot','Kuliner'],['bi bi-moon-stars','Musholla'],['bi bi-camera','Spot Foto']] as $f): ?>
              <li><i class="<?= $f[0] ?>"></i><span><?= $f[1] ?></span></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-6 tips-box reveal fade-right">
        <h3 class="title"><span>Tips</span> Berkunjung</h3>
        <ul class="list tips">
          <?php foreach(['Datang di hari Minggu untuk melihat pertunjukan','Gunakan pakaian nyaman','Datang lebih awal untuk mendapatkan tempat terbaik','Siapkan uang tunai untuk tiket dan aktivitas'] as $tip): ?>
          <li><span class="check">✔</span><span><?= $tip ?></span></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<section class="highlight-section py-5">
  <div class="container">
    <?php
      $highlights = [
        ['img'=>'tarian.svg','title'=>'Pertunjukan Tarian','texts'=>[
          'Pertunjukan tari tradisional menjadi daya tarik utama Desa Budaya Pampang yang tidak boleh dilewatkan. Setiap hari Minggu siang, pengunjung dapat menyaksikan penampilan Tari Tradisional Suku Dayak Kenyah yang sarat akan makna budaya. Tarian ini bukan sekadar hiburan, melainkan representasi nilai kehidupan, keberanian, serta penghormatan terhadap leluhur yang diwariskan secara turun-temurun.',
          'Menariknya, pengunjung tidak hanya menjadi penonton, tetapi juga dapat ikut berinteraksi langsung dengan para penari. Dalam beberapa kesempatan, wisatawan diperbolehkan untuk turut menari bersama, menciptakan pengalaman yang lebih dekat dan berkesan. Pertunjukan ini berlangsung di Rumah Lamin sebagai pusat kegiatan budaya.',
        ],'reverse'=>false],
        ['img'=>'lamin.svg','title'=>'Rumah Lamin','texts'=>[
          'Rumah Lamin merupakan rumah adat khas Dayak yang menjadi pusat kehidupan sosial dan budaya masyarakat di Desa Pampang. Bangunan ini memiliki bentuk memanjang dan dihuni oleh beberapa keluarga, mencerminkan nilai kebersamaan dan gotong royong yang kuat. Di dalamnya, pengunjung dapat melihat berbagai ukiran khas, peralatan tradisional, serta elemen arsitektur yang sarat makna filosofis.',
          'Kunjungan ke Rumah Lamin memberikan pengalaman yang tidak hanya bersifat wisata, tetapi juga edukatif. Pengunjung dapat memahami lebih dekat bagaimana masyarakat Dayak menjaga tradisi dan menjalani kehidupan yang selaras dengan alam dan nilai leluhur. Suasana yang hangat dan autentik menjadikan Lamin sebagai simbol penting dalam pelestarian budaya di Desa Pampang.',
        ],'reverse'=>true],
        ['img'=>'susur-sungai.svg','title'=>'Susur Sungai','texts'=>[
          'Selain budaya, Desa Pampang juga menawarkan keindahan alam melalui pengalaman menyusuri Sungai Pampang yang masih asri. Perjalanan menuju kawasan sungai dapat ditempuh sekitar 1,5 jam, dengan pemandangan hutan alami yang terjaga sepanjang perjalanan. Suasana yang tenang dan udara yang segar menjadikan aktivitas ini cocok untuk melepas penat.',
          'Sungai Pampang memiliki daya tarik berupa air terjun dan sumber mata air alami yang jernih, serta kolam alami yang aman untuk dinikmati bersama keluarga. Anak-anak maupun orang dewasa dapat merasakan kesegaran air sekaligus menikmati panorama alam yang eksotis. Aktivitas susur sungai ini menjadi pelengkap sempurna bagi wisata budaya, menghadirkan keseimbangan antara pengalaman budaya dan keindahan alam.',
        ],'reverse'=>false],
      ];
    ?>
    <?php foreach($highlights as $h): ?>
    <div class="row mb-2 align-items-start <?= $h['reverse'] ? 'flex-md-row-reverse' : '' ?>">
      <div class="col-md-4 reveal <?= $h['reverse'] ? 'fade-right' : 'fade-left' ?>">
        <div class="image-wrapper" data-tilt>
          <img src="<?= BASE_URL ?>/public/assets/images/<?= $h['img'] ?>" class="highlight-img" />
        </div>
      </div>
      <div class="col-md-8 reveal <?= $h['reverse'] ? 'fade-left' : 'fade-right' ?>">
        <?php foreach($h['texts'] as $t): ?>
          <p class="text reveal fade-up"><?= $t ?></p>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>


<section class="cta-section d-flex align-items-center justify-content-center text-center" data-parallax>
  <div class="overlay"></div>
  <div class="content text-white reveal fade-up">
    <h2 class="cta-title"><span>Rencanakan</span> Kunjunganmu Sekarang</h2>
    <a href="<?= BASE_URL ?>/kontak" class="cta-btn">Hubungi Kami →</a>
  </div>
</section>

<?php require ROOT . '/app/views/public/partials/footer.php'; ?>

<style>
.hero-tentang { position:relative; height:70vh; background:url('<?= BASE_URL ?>/public/assets/images/lamin.svg') center/cover no-repeat; overflow:hidden; transition:background-position .2s ease-out; }
.hero-tentang .overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(26,26,26,.7),rgba(26,26,26,.9)); }
.hero-tentang .content { position:relative; z-index:2; }
.hero-tentang .title { font-size:3rem; font-family:'Playfair Display',serif; margin-bottom:10px; letter-spacing:-1px; }
.hero-tentang .subtitle { font-size:1rem; opacity:.9; }

.sejarah-section { background:#f8f9fa; }
.sejarah-section .title { font-size:2.3rem; font-family:'Inter',sans-serif; font-weight:600; }
.sejarah-section .title span { font-family:'Playfair Display',serif; font-weight:500; }
.text-content p { font-size:1rem; line-height:1.9; color:#444; text-align:justify; }
.image-wrapper { perspective:1000px; display:flex; justify-content:flex-end; }
.sejarah-img { width:100%; max-width:100%; border-radius:6px; transition:transform .2s; box-shadow:0 15px 35px rgba(0,0,0,.15); }

.highlight-section { background:#f8f9fa; }
.text { font-size:.95rem; line-height:1.85; color:#444; text-align:justify; margin-bottom:14px; }
.highlight-img { width:100%; height:240px; object-fit:cover; border-radius:8px; box-shadow:0 10px 25px rgba(0,0,0,.1); transition:transform .2s; }

.fasilitas-section { background:linear-gradient(90deg,#1A0A00 50%,#2C1810 50%); color:#fff; }
.fasilitas-box, .tips-box { padding:20px 40px; }
.fasilitas-section .title { font-size:1.6rem; margin-bottom:20px; font-weight:600; }
.fasilitas-section .title span { font-family:'Playfair Display',serif; font-weight:500; }
.list { list-style:none; padding:0; }
.list li { display:flex; align-items:center; gap:10px; margin-bottom:12px; font-size:.95rem; color:#ddd; transition:all .3s; cursor:pointer; }
.list i { font-size:1rem; color:#c0392b; transition:.3s; }
.list li:hover { transform:translateX(6px); color:#fff; }
.list li:hover i { transform:scale(1.2); color:#e74c3c; }
.tips li { align-items:flex-start; }
.check { color:#e74c3c; font-weight:bold; margin-top:2px; }

.cta-section { position:relative; height:45vh; background:url('<?= BASE_URL ?>/public/assets/images/lamin.svg') center/cover no-repeat; overflow:hidden; transition:background-position .2s ease-out; }
.cta-section .overlay { position:absolute; inset:0; background:linear-gradient(to bottom,rgba(0,0,0,.65),rgba(0,0,0,.85)); }
.cta-section .content { position:relative; z-index:2; }
.cta-title { font-size:2.3rem; margin-bottom:20px; letter-spacing:-1px; font-family:'Inter',sans-serif; font-weight:600; }
.cta-title span { font-family:'Playfair Display',serif; font-style:italic; font-weight:500; }
.cta-btn { background:#e74c3c; color:white; border:none; padding:12px 28px; border-radius:999px; font-size:.95rem; transition:all .3s; box-shadow:0 6px 20px rgba(231,76,60,.4); text-decoration:none; display:inline-block; }
.cta-btn:hover { transform:translateY(-3px) scale(1.03); background:#c0392b; color:white; }

@media(max-width:992px){ .fasilitas-section{background:#1A0A00} .fasilitas-box,.tips-box{padding:20px} }
@media(max-width:768px){ 
  .hero-tentang .title{font-size:2.2rem}
  .hero-tentang .subtitle{font-size:.9rem;padding:0 16px}
  .fasilitas-section{
    background:linear-gradient(180deg, #1A0A00 50%, #2C1810 50%) !important;
    padding:0 !important;
  }
  .fasilitas-box,.tips-box{padding:28px 20px}
  .fasilitas-section .row{margin:0}
  .fasilitas-section .col-lg-6{width:100%}
  .cta-title{font-size:1.7rem}
  .highlight-img{height:180px}
  .text{font-size:.9rem}
}
@media(max-width:480px){
  .hero-tentang .title{font-size:1.8rem}
  .sejarah-section .title{font-size:1.8rem}
}
</style>
