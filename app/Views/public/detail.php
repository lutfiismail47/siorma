<?= view('public/layouts/header') ?>

<style>
  .detail-banner {
    position: relative;
    background-image: url('<?= !empty($dokumentasi) ? base_url('uploads/dokumentasi/' . $dokumentasi[0]['nama_file']) : base_url('css/default-cover.jpg') ?>');
    background-size: cover;
    background-position: center;
    height: 220px;
    width: 100%;
  }

  .detail-banner::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* Overlay hijau transparan serasi banner */
    background-color: rgba(27, 77, 34, 0.7);
  }

  .profile-overlap-container {
    position: relative;
    display: flex;
    align-items: flex-end;
    gap: 25px;
    /* Menjaga logo memotong spanduk tepat di tengah */
    margin-top: -60px;
    z-index: 5;
    /* Memberi jarak aman ke teks deskripsi di bawah */
    margin-bottom: 50px;
  }

  .title-meta {
    position: relative;
    /* Mengunci tinggi ruang teks setinggi sisa potongan logo bawah */
    height: 70px;
    display: flex;
    flex-direction: column;
  }

  .title-meta h1 {
    font-size: 2.2rem;
    font-weight: bold;
    text-transform: uppercase;
    color: #ffffff !important;
    margin: 0;
    line-height: 1;
    position: absolute;
    /* Mendorong nama naik tepat bersandar di atas garis perbatasan */
    bottom: 74px;
    left: 0;
    white-space: nowrap;
    /* Dimensi halus agar teks putih terbaca tajam */
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
  }

  .title-meta p {
    font-size: 1rem;
    color: #1a1a1a;
    font-weight: bold;
    margin: 0;
    position: absolute;
    /* Menurunkan kategori tepat berada di bawah garis perbatasan */
    top: 6px;
    left: 0;
  }

  .large-logo-box {
    width: 130px;
    height: 130px;
    background: white;
    border: 1px solid #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  .large-logo-box img {
    max-width: 85%;
    max-height: 85%;
    object-fit: contain;
  }

  .title-meta h1 {
    font-size: 2.2rem;
    font-weight: bold;
    text-transform: uppercase;
    color: #000;
    margin-bottom: 5px;
  }

  .title-meta p {
    font-size: 1rem;
    color: var(--text-muted);
    font-weight: 500;
  }

  .detail-body-text h2 {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 35px 0 12px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .detail-body-text p,
  .detail-body-text ul {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #1a1a1a;
    text-align: justify;
  }

  .detail-body-text ul {
    padding-left: 20px;
  }

  /* Grid Galeri Foto Dokumentasi */
  .gallery-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 15px;
    margin-top: 15px;
  }

  .gallery-item {
    width: 100%;
    height: 220px;
    overflow: hidden;
  }

  .gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  @media (max-width: 768px) {

    /* --- TAMBAHKAN DUA ATURAN BARU INI DI DALAM MEDIA QUERY YANG SUDAH ADA --- */

    /* 1. Reset grid agar tidak mengunci ukuran minimal 320px di HP */
    .gallery-masonry {
      /* Dipaksa menjadi 1 kolom penuh */
      grid-template-columns: 1fr !important;
      /* Memperkecil jarak antar gambar agar proporsional */
      gap: 12px !important;
      width: 100% !important;
    }

    /* 2. Pastikan kontainer pembungkus gambar tidak meluap */
    .gallery-item {
      width: 100% !important;
      max-width: 100% !important;
      /* Sedikit memperkecil tinggi gambar di HP agar estetik */
      height: 200px !important;
    }
  }

  /* --- TOMBOL WHATSAPP MELAYANG POJOK KANAN BAWAH --- */
  .floating-whatsapp-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #25d366;
    /* Warna hijau resmi WhatsApp */
    color: #ffffff !important;
    padding: 14px 24px;
    font-size: 0.95rem;
    font-weight: bold;
    text-decoration: none;
    border-radius: 50px;
    /* Membuat tombol berbentuk elips membulat sempurna */
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.25);
    z-index: 9999;
    /* Memastikan tombol mengapung di lapisan paling atas */
    transition: transform 0.2s ease, background-color 0.2s ease;
  }

  .floating-whatsapp-btn i {
    font-size: 1.3rem;
  }

  /* Efek sedikit membesar saat disorot kursor (hover) */
  .floating-whatsapp-btn:hover {
    background-color: #128c7e;
    /* Hijau WhatsApp tua */
    transform: scale(1.05);
  }

  /* Responsif: Sedikit menggeser posisi di layar HP agar tidak tertutup bar navigasi bawah bawaan HP */
  @media (max-width: 768px) {
    .floating-whatsapp-btn {
      bottom: 20px;
      right: 20px;
      padding: 12px 18px;
      font-size: 0.85rem;
    }
  }

  /* Responsif: Mengubah tombol menjadi bulat ikon saja saat dibuka di HP */
  /* Perbaikan posisi ikon di layar HP */
  /* Perbaikan Total Posisi Ikon di HP */
  @media (max-width: 768px) {
    .floating-whatsapp-btn {
      bottom: 20px;
      right: 20px;

      /* Membuat kotak lingkaran sempurna */
      width: 50px;
      height: 50px;
      padding: 0 !important;
      border-radius: 50% !important;

      /* Gunakan flexbox murni untuk mengunci posisi di tengah */
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
    }

    /* 1. Lenyapkan teks "Hubungi Ormawa" sepenuhnya dari kalkulasi layout HP */
    .floating-whatsapp-btn span {
      display: none !important;
    }

    /* 2. Pastikan ukuran ikon pas dan tidak membawa margin bawaan desktop */
    .floating-whatsapp-btn i {
      font-size: 1.6rem !important;
      margin: 0 !important;
      padding: 0 !important;
      line-height: 1 !important;
    }
  }
</style>

<div class="detail-banner"></div>

<div class="container" style="padding-bottom: 80px;">

  <div class="profile-overlap-container">
    <div class="large-logo-box">
      <img src="<?= $ormawa['logo'] ? base_url('uploads/logo/' . $ormawa['logo']) : base_url('css/default-logo.png') ?>" alt="Logo">
    </div>
    <div class="title-meta">
      <h1><?= esc($ormawa['nama']) ?></h1>
      <p><?= esc($ormawa['nama_kategori']) ?></p>
    </div>
  </div>

  <article class="detail-body-text">

    <h2>Deskripsi</h2>
    <p><?= nl2br(esc($ormawa['deskripsi'])) ?></p>

    <h2>Visi</h2>
    <p><?= nl2br(esc($ormawa['visi'])) ?></p>

    <h2>Misi</h2>
    <p><?= nl2br(esc($ormawa['misi'])) ?></p>

    <h2>Program Kerja</h2>
    <p><?= nl2br(esc($ormawa['program_kerja'])) ?></p>

    <h2>Struktur Kepengurusan</h2>
    <p><?= nl2br(esc($ormawa['struktur_kepengurusan'])) ?></p>

    <?php if (!empty($dokumentasi)): ?>
      <h2>Dokumentasi Kegiatan</h2>
      <div class="gallery-masonry">
        <?php foreach ($dokumentasi as $img): ?>
          <div class="gallery-item">
            <img src="<?= base_url('uploads/dokumentasi/' . $img['nama_file']) ?>" alt="Kegiatan">
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </article>
</div>

<?php if (!empty($ormawa['no_whatsapp'])): ?>
  <a href="https://wa.me/<?= esc($ormawa['no_whatsapp']) ?>?text=Halo%20Pengurus%20<?= rawurlencode($ormawa['nama']) ?>.%20Saya%20ingin%20bertanya%20mengenai%20organisasi%20ini."
    class="floating-whatsapp-btn"
    target="_blank"
    rel="noopener noreferrer"
    title="Hubungi Ormawa">
    <i class="fab fa-whatsapp"></i>
    <span>Hubungi Ormawa</span> </a>
<?php endif; ?>

<?= view('public/layouts/footer') ?>