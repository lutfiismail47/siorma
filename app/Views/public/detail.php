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
    background-color: rgba(27, 77, 34, 0.7);
    /* Overlay hijau transparan serasi banner */
  }

  .profile-overlap-container {
    position: relative;
    display: flex;
    align-items: flex-end;
    gap: 25px;
    margin-top: -60px;
    /* Menjaga logo memotong spanduk tepat di tengah */
    z-index: 5;
    margin-bottom: 50px;
    /* Memberi jarak aman ke teks deskripsi di bawah */
  }

  .title-meta {
    position: relative;
    height: 70px;
    /* Mengunci tinggi ruang teks setinggi sisa potongan logo bawah */
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
    bottom: 74px;
    /* Mendorong nama naik tepat bersandar di atas garis perbatasan */
    left: 0;
    white-space: nowrap;
    text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    /* Dimensi halus agar teks putih terbaca tajam */
  }

  .title-meta p {
    font-size: 1rem;
    color: #1a1a1a;
    font-weight: bold;
    margin: 0;
    position: absolute;
    top: 6px;
    /* Menurunkan kategori tepat berada di bawah garis perbatasan */
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

<?= view('public/layouts/footer') ?>