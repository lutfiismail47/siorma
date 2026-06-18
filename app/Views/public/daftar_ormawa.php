<?= view('public/layouts/header') ?>

<main class="content-section" style="min-height: 60vh; background-color: #e1e1e1; padding: 40px 0;">
  <div class="container">

    <?php if (!empty($search)): ?>
      <h2 class="section-title" style="text-align: left; margin-bottom: 30px; font-weight: bold; font-size: 2rem;">Hasil Pencarian</h2>
    <?php else: ?>
      <h2 class="section-title" style="text-align: center; margin-bottom: 30px; font-weight: bold; font-size: 2rem;">Ormawa STTC</h2>
    <?php endif; ?>

    <?php if (!empty($ormawa)): ?>
      <div class="ormawa-grid">
        <?php foreach ($ormawa as $row): ?>
          <a href="<?= base_url('ormawa/' . $row['id_ormawa']) ?>" class="ormawa-card">
            <div class="card-image-wrapper">
              <img src="<?= $row['foto_utama'] ? base_url('uploads/dokumentasi/' . $row['foto_utama']) : base_url('css/default-cover.jpg') ?>" alt="Dokumentasi">
            </div>
            <div class="card-info">
              <div class="card-logo-placeholder">
                <img src="<?= $row['logo'] ? base_url('uploads/logo/' . $row['logo']) : base_url('css/default-logo.png') ?>" alt="Logo">
              </div>
              <div class="card-text">
                <h3><?= esc($row['nama']) ?></h3>
                <p><?= esc($row['nama_kategori']) ?></p>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <div style="text-align: center; padding: 80px 0; background: white; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <p style="font-size: 1.3rem; font-weight: bold; color: #000000;">Data ormawa belum ada.</p>
      </div>
    <?php endif; ?>

  </div>
</main>

<?= view('public/layouts/footer') ?>