<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Ormawa - SIORMA</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('favicon.png') ?>">
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

  <div class="admin-wrapper" style="min-height: 100vh; display: flex; align-items: stretch;">

    <?= view('admin/layouts/sidebar') ?>

    <main class="admin-main-content">
      <div class="admin-form-container">
        <form action="<?= base_url('admin/update/' . $ormawa['id_ormawa']) ?>" method="POST" enctype="multipart/form-data">

          <div class="upload-logo-section">
            <div class="logo-preview-box" id="logoPreview">
              <?php if (!empty($ormawa['logo'])): ?>
                <img src="<?= base_url('uploads/logo/' . $ormawa['logo']) ?>" alt="Logo">
              <?php else: ?>
                <i class="fa-sharp fa-regular fa-image"></i>
              <?php endif; ?>
            </div>
            <label class="btn-link-upload">
              Unggah logo baru
              <input type="file" name="logo" id="inputLogo" accept="image/*" style="display: none;">
            </label>
          </div>

          <div class="admin-form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="admin-form-control" value="<?= esc($ormawa['nama']) ?>" required>
          </div>

          <div class="admin-form-group">
            <label>Kategori</label>
            <select name="id_kategori" class="admin-form-control" style="height: 45px;" required>
              <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id_kategori'] ?>" <?= $ormawa['id_kategori'] == $kat['id_kategori'] ? 'selected' : '' ?>>
                  <?= esc($kat['nama_kategori']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="admin-form-group">
            <label for="no_whatsapp">Nomor WhatsApp Pengurus</label>
            <input type="text" name="no_whatsapp" id="no_whatsapp" class="admin-form-control"
              placeholder="Contoh: 628123456789 (Awali dengan kode negara 62)"
              value="<?= isset($ormawa['no_whatsapp']) ? esc($ormawa['no_whatsapp']) : '' ?>">
            <small style="color: #666; font-size: 0.8rem; display: block; margin-top: 5px;">
              *Penting: Gunakan format angka penuh diawali 62 (tanpa spasi/tanda strip) agar tombol integrasi WhatsApp bekerja.
            </small>
          </div>

          <div class="admin-form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="5" class="admin-form-control" required><?= esc($ormawa['deskripsi']) ?></textarea>
          </div>

          <div class="admin-form-group">
            <label>Visi</label>
            <textarea name="visi" rows="4" class="admin-form-control" required><?= esc($ormawa['visi']) ?></textarea>
          </div>

          <div class="admin-form-group">
            <label>Misi</label>
            <textarea name="misi" rows="4" class="admin-form-control" required><?= esc($ormawa['misi']) ?></textarea>
          </div>

          <div class="admin-form-group">
            <label>Program Kerja</label>
            <textarea name="program_kerja" rows="5" class="admin-form-control" required><?= esc($ormawa['program_kerja']) ?></textarea>
          </div>

          <div class="admin-form-group">
            <label>Struktur Kepengurusan</label>
            <textarea name="struktur_kepengurusan" rows="5" class="admin-form-control" required><?= esc($ormawa['struktur_kepengurusan']) ?></textarea>
          </div>

          <div class="admin-form-group">
            <label>Foto Dokumentasi (Maksimal 5 Foto)</label>
            <div class="doc-preview-row" id="docPreviewRow" style="display: flex; gap: 10px; margin-bottom: 10px;">
              <?php for ($i = 0; $i < 5; $i++): ?>
                <div class="doc-preview-box-item" style="width: 80px; height: 80px; background-color: #e0e0e0; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 1px solid #ccc; border-radius: 4px;">
                  <?php if (isset($dokumentasi[$i])): ?>
                    <img src="<?= base_url('uploads/dokumentasi/' . $dokumentasi[$i]['nama_file']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                  <?php else: ?>
                    <span class="placeholder-icon-text" style="color: #999; font-size: 1.2rem;"><i class="fa-sharp fa-regular fa-image"></i></span>
                  <?php endif; ?>
                </div>
              <?php endfor; ?>
            </div>
            <label class="btn-link-upload" style="display: inline-block; cursor: pointer; color: #0066cc; text-decoration: underline; font-weight: bold;">
              Unggah dokumentasi baru
              <input type="file" id="inputDocsCicilEdit" accept="image/*" style="display: none;">
            </label>
            <div id="hiddenInputsContainerEdit"></div>
            <p id="errDoc" style="color: #a30000; font-size: 0.85rem; margin-top: 5px; display: none; font-weight: bold;"></p>
          </div>

          <div class="form-actions-row">
            <a href="<?= base_url('/admin') ?>" class="btn-form cancel" style="text-decoration: none;">Batal</a>
            <button type="submit" id="btnSubmit" class="btn-form save">Simpan Data</button>
          </div>

        </form>
      </div>
    </main>
  </div>

  <script>
    // Logic Preview Logo Instan
    document.getElementById('inputLogo').addEventListener('change', function(e) {
      const preview = document.getElementById('logoPreview');
      if (this.files && this.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.innerHTML = `<img src="${e.target.result}">`;
        }
        reader.readAsDataURL(this.files[0]);
      }
    });

    // --- LOGIKA ANTREAN CICIL GAMBAR EDIT ---
    let wadahGambarEditGlobal = [];

    document.getElementById('inputDocsCicilEdit').addEventListener('change', function() {
      const previewBoxes = document.querySelectorAll('.doc-preview-box-item');
      const pesanError = document.getElementById('errDoc');
      const hiddenContainer = document.getElementById('hiddenInputsContainerEdit');

      const fileDipilih = this.files;

      Array.from(fileDipilih).forEach(file => {
        if (wadahGambarEditGlobal.length < 5) {
          wadahGambarEditGlobal.push(file);
        } else {
          pesanError.textContent = `❌ Batas maksimal adalah 5 foto dokumentasi!`;
          pesanError.style.display = 'block';
        }
      });

      // Reset preview lama ke ikon folder bawaan sebelum dirender ulang dari array global
      previewBoxes.forEach(box => {
        box.innerHTML = `<span class="placeholder-icon-text" style="color: #999; font-size: 1.2rem;"><i class="fa-sharp fa-regular fa-image"></i></span>`;
      });

      hiddenContainer.innerHTML = '';

      wadahGambarEditGlobal.forEach((file, index) => {
        const reader = new FileReader();
        const targetBox = previewBoxes[index];

        reader.onload = function(e) {
          targetBox.innerHTML = `<img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover;">`;
        };
        reader.readAsDataURL(file);

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);

        const inputBayangan = document.createElement('input');
        inputBayangan.type = 'file';
        inputBayangan.name = 'dokumentasi[]';
        inputBayangan.files = dataTransfer.files;
        inputBayangan.style.display = 'none';
        hiddenContainer.appendChild(inputBayangan);
      });

      this.value = '';
    });
  </script>
</body>

</html>