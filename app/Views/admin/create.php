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

  <div class="admin-wrapper">
    <?= view('admin/layouts/sidebar') ?>

    <main class="admin-main-content">
      <div class="admin-form-container">
        <form action="<?= base_url('/admin/store') ?>" method="POST" enctype="multipart/form-data">

          <div class="upload-logo-section">
            <div class="logo-preview-box" id="logoPreview"><i class="fa-sharp fa-regular fa-image"></i></div>
            <label class="btn-link-upload">
              Unggah logo
              <input type="file" name="logo" id="inputLogo" accept="image/*" style="display: none;" required>
            </label>
          </div>

          <div class="admin-form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="admin-form-control" required>
          </div>

          <div class="admin-form-group">
            <label>Kategori</label>
            <select name="id_kategori" class="admin-form-control" style="height: 45px;" required>
              <?php foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id_kategori'] ?>"><?= esc($kat['nama_kategori']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="admin-form-group">
            <label>Deskripsi</label>
            <textarea name="deskripsi" rows="5" class="admin-form-control" required></textarea>
          </div>

          <div class="admin-form-group">
            <label>Visi</label>
            <textarea name="visi" rows="4" class="admin-form-control" required></textarea>
          </div>

          <div class="admin-form-group">
            <label>Misi</label>
            <textarea name="misi" rows="4" class="admin-form-control" required></textarea>
          </div>

          <div class="admin-form-group">
            <label>Program Kerja</label>
            <textarea name="program_kerja" rows="5" class="admin-form-control" placeholder="- Pelatihan coding (Mei 2026)&#10;- Mengikuti turnamen skala kota" required></textarea>
          </div>

          <div class="admin-form-group">
            <label>Struktur Kepengurusan</label>
            <textarea name="struktur_kepengurusan" rows="5" class="admin-form-control" placeholder="- Ketua: Kaajak&#10;- Sekretaris: Juli" required></textarea>
          </div>

          <div class="admin-form-group">
            <label>Dokumentasi Kegiatan</label>
            <div class="doc-preview-row" id="docPreviewRow">
              <?php for ($i = 0; $i < 5; $i++): ?>
                <div class="doc-preview-box">
                  <span><?= $i + 1 ?></span>
                </div>
              <?php endfor; ?>
            </div>
            <label class="btn-link-upload" style="display: inline-block; margin-top: 10px; cursor: pointer;">
              Unggah (unggah hingga 5 gambar)
              <input type="file" id="inputDocsCicil" accept="image/*" style="display: none;">
            </label>
            <div id="hiddenInputsContainer"></div>
            <p id="errDoc" style="color: #a30000; font-size: 0.85rem; margin-top: 5px; display: none; font-weight: bold;"></p>
          </div>

          <div class="form-actions-row">
            <a href="<?= base_url('/admin') ?>" class="btn-form cancel" style="text-decoration: none;">Batal</a>
            <button type="submit" id="btnSubmit" class="btn-form save">Simpan</button>
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

    // --- LOGIKA ANTREAN CICIL GAMBAR BIAR TIDAK TERTIMPA ---
    let wadahGambarGlobal = []; // Array untuk menampung maksimal 5 file gambar

    document.getElementById('inputDocsCicil').addEventListener('change', function() {
      const kotakPreview = document.querySelectorAll('.doc-preview-box');
      const pesanError = document.getElementById('errDoc');
      const hiddenContainer = document.getElementById('hiddenInputsContainer');

      // Ambil file yang baru dipilih
      const fileDipilih = this.files;

      // Masukkan file baru ke dalam antrean global selama totalnya belum lewat dari 5
      Array.from(fileDipilih).forEach(file => {
        if (wadahGambarGlobal.length < 5) {
          wadahGambarGlobal.push(file);
        } else {
          pesanError.textContent = `❌ Maksimal 5 foto dokumentasi. Gambar selebihnya otomatis diabaikan.`;
          pesanError.style.display = 'block';
        }
      });

      // Reset visual tampilan kotak ke nomor default dahulu sebelum dirender ulang
      kotakPreview.forEach((box, index) => {
        box.innerHTML = `<span>${index + 1}</span>`;
      });

      // Bersihkan isi input data bayangan lama
      hiddenContainer.innerHTML = '';

      // Render ulang gambar yang ada di dalam antrean global ke kotak masing-masing
      wadahGambarGlobal.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
          kotakPreview[index].innerHTML = `<img src="${e.target.result}">`;
        };
        reader.readAsDataURL(file);

        // Membuat data transfer bayangan agar filenya tetap lolos terbaca di $_FILES['dokumentasi'] PHP
        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);

        const inputBayangan = document.createElement('input');
        inputBayangan.type = 'file';
        inputBayangan.name = 'dokumentasi[]';
        inputBayangan.files = dataTransfer.files;
        inputBayangan.style.display = 'none';
        hiddenContainer.appendChild(inputBayangan);
      });

      // Reset nilai input file mentah agar tombolnya bisa diklik ulang untuk file yang sama
      this.value = '';
    });
  </script>


</body>

</html>