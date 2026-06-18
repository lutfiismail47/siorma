<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin - SIORMA</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('favicon.png') ?>">
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
  <div class="admin-wrapper" style="min-height: 100vh; display: flex; align-items: stretch;">
    <?= view('admin/layouts/sidebar') ?>

    <main class="admin-main-content">
      <h2 style="font-size: 1.8rem; font-weight: bold; margin-bottom: 30px;">Daftar Ormawa</h2>

      <?php if (!empty($ormawa)): ?>
        <div class="ormawa-grid">
          <?php foreach ($ormawa as $row): ?>
            <div class="ormawa-card admin-ormawa-card">

              <div class="card-action-overlay">
                <a href="<?= base_url('admin/edit/' . $row['id_ormawa']) ?>" class="btn-action-icon edit" title="Ubah Info"><i class="fa-sharp fa-solid fa-pencil"></i></a>
                <button type="button" class="btn-action-icon delete" title="Hapus Ormawa"
                  onclick="bukaDialogHapus('<?= base_url('admin/delete/' . $row['id_ormawa']) ?>')"><i class="fa-sharp fa-solid fa-trash"></i></button>
              </div>

              <div class="card-image-wrapper">
                <img src="<?= isset($row['foto_utama']) && $row['foto_utama'] ? base_url('uploads/dokumentasi/' . $row['foto_utama']) : base_url('css/default-cover.jpg') ?>" alt="Sampul">
              </div>

              <div class="card-info">
                <div class="card-logo-placeholder">
                  <img src="<?= isset($row['logo']) && $row['logo'] ? base_url('uploads/logo/' . $row['logo']) : base_url('css/default-logo.png') ?>" alt="Logo">
                </div>
                <div class="card-text">
                  <h3><?= esc($row['nama']) ?></h3>
                  <p><?= esc($row['nama_kategori']) ?></p>
                </div>
              </div>

            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <p style="color: var(--text-muted);">Belum ada data Ormawa yang tersimpan.</p>
      <?php endif; ?>
    </main>
  </div>

  <div id="modalHapus" class="custom-modal-backdrop">
    <div class="custom-modal-box">
      <span class="modal-icon-emoji">&#129327;</span>
      <p>Yakin ingin menghapus data ormawa ini?</p>
      <div class="modal-actions">
        <button type="button" class="btn-modal no" onclick="tutupDialogHapus()">Tidak</button>
        <a href="#" id="linkEksekusiHapus" class="btn-modal yes" style="text-align: center; text-decoration: none; line-height: 1.8;">Ya</a>
      </div>
    </div>
  </div>

  <script>
    const modal = document.getElementById('modalHapus');
    const linkHapus = document.getElementById('linkEksekusiHapus');

    function bukaDialogHapus(urlTujuan) {
      linkHapus.setAttribute('href', urlTujuan);
      modal.style.display = 'flex';
    }

    function tutupDialogHapus() {
      modal.style.display = 'none';
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        tutupDialogHapus();
      }
    }
  </script>
</body>

</html>