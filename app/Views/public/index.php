<?= view('public/layouts/header') ?>

<?php if (empty($search) && empty($kategori_aktif)): ?>
  <section class="container hero-section">
    <div class="hero-image-container">
      <img src="<?= base_url('images/mhs-sttc.png') ?>" alt="Hero Image">
    </div>
    <div class="hero-text-container">
      <h1>Sistem Informasi Organisasi Mahasiswa</h1>
      <p>Sumber informasi resmi semua organisasi mahasiswa di Sekolah Tinggi Teknologi Cipasung. Lengkap, up-to-date, dan terorganisir.</p>
      <a href="https://sttcipasung.ac.id/" class="btn-cta" target="_blank">
        Kunjungi website resmi STTC <i class="fa-sharp fa-solid fa-arrow-right"></i>
      </a>
    </div>
  </section>
<?php endif; ?>

<main class="content-section">
  <div class="container">

    <?php if (!empty($search)): ?>
      <h2 class="section-title" style="text-align: left;">Hasil Pencarian</h2>
    <?php else: ?>
      <h2 class="section-title">Ormawa STTC</h2>
    <?php endif; ?>

    <?php if (!empty($ormawa)): ?>
      <div class="ormawa-grid">
        <?php foreach ($ormawa as $row): ?>

          <a href="<?= base_url('ormawa/' . $row['id_ormawa']) ?>" class="ormawa-card-link" style="text-decoration: none; color: inherit; display: block;">

            <div class="ormawa-card">
              <div class="card-image-wrapper" style="background-image: url('<?= isset($row['foto_utama']) && $row['foto_utama'] ? base_url('uploads/dokumentasi/' . $row['foto_utama']) : base_url('css/default-cover.jpg') ?>'); background-size: cover; background-position: center; height: 180px; position: relative;">
              </div>

              <div class="card-info" style="background-color: #1a1a1a; color: #fff; padding: 15px; display: flex; align-items: center; gap: 15px;">
                <div class="card-logo-placeholder" style="width: 50px; height: 50px; background: #fff; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                  <img src="<?= isset($row['logo']) && $row['logo'] ? base_url('uploads/logo/' . $row['logo']) : base_url('css/default-logo.png') ?>" alt="Logo" style="width: 100%; height: 100%; object-fit: contain;">
                </div>

                <div class="card-text">
                  <h3 style="margin: 0; font-size: 1.1rem; font-weight: bold;"><?= esc($row['nama']) ?></h3>
                  <p style="margin: 5px 0 0 0; font-size: 0.85rem; color: #ccc;"><?= esc($row['nama_kategori']) ?></p>
                </div>
              </div>
            </div>

          </a> <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div style="text-align: center; padding: 60px 0; color: var(--text-muted);">
        <p style="font-size: 1.2rem; font-weight: bold;">Belum ada data ormawa.</p>
      </div>
    <?php endif; ?>

  </div>
</main>

<?= view('public/layouts/footer') ?>