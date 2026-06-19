<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
  /* --- STYLING UTAMA LAYOUT FOOTER SIORMA --- */
  footer {
    background-color: #1a1a1a;
    color: #ffffff;
    padding: 60px 0 30px 0;
    font-family: system-ui, -apple-system, sans-serif;
    border-top: 1px solid #333333;
  }

  .footer-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 40px;
  }

  /* Kolom Kiri: Branding SIORMA */
  .footer-brand-column {
    flex: 1;
    min-width: 250px;
  }

  .footer-brand-column h3 {
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0 0 15px 0;
    letter-spacing: 1px;
    color: #ffffff;
  }

  .footer-brand-column p {
    color: #aaaaaa;
    font-size: 0.95rem;
    line-height: 1.6;
    margin: 0;
    max-width: 300px;
  }

  /* Kolom Kanan: Media Sosial */
  .footer-social-column {
    min-width: 200px;
  }

  .footer-social-column h4 {
    color: #ffffff;
    font-size: 1.1rem;
    font-weight: bold;
    margin: 0 0 20px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .footer-social-list {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 14px;
    /* Jarak vertikal yang rapi antar baris medsos */
  }

  .footer-social-item a {
    color: #cccccc;
    text-decoration: none;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    gap: 12px;
    transition: color 0.2s ease-in-out, transform 0.2s ease-in-out;
  }

  /* Efek Animasi Hover Interaktif Hijau Khas STTC */
  .footer-social-item a:hover {
    color: #2e7d32;
    transform: translateX(6px);
    /* Geser ke kanan dengan mulus saat didekati kursor */
  }

  /* Baris Hak Cipta Bawah */
  .footer-bottom-bar {
    max-width: 1200px;
    margin: 40px auto 0 auto;
    padding: 25px 20px 0 20px;
    border-top: 1px solid #2d2d2d;
    text-align: center;
  }

  .footer-bottom-bar p {
    color: #777777;
    font-size: 0.85rem;
    margin: 0;
  }
</style>

<footer>
  <div class="footer-container">

    <div class="footer-brand-column">
      <h3>SIORMA</h3>
      <p>Sistem Informasi Organisasi Mahasiswa Sekolah Tinggi Teknologi Cipasung.</p>
    </div>

    <div class="footer-social-column">
      <h4>Media Sosial</h4>
      <ul class="footer-social-list">
        <li class="footer-social-item">
          <a href="https://www.instagram.com/sttcipasung_official" target="_blank">
            <i class="fab fa-instagram" style="font-size: 1.15rem; color: #e1306c;"></i> Instagram
          </a>
        </li>
        <li class="footer-social-item">
          <a href="https://web.facebook.com/sttcipasung" target="_blank">
            <i class="fab fa-facebook-f" style="font-size: 1.15rem; width: 16px; text-align: center; color: #1877f2;"></i> Facebook
          </a>
        </li>
        <li class="footer-social-item">
          <a href="https://www.youtube.com/@sttcipasung" target="_blank">
            <i class="fab fa-youtube" style="font-size: 1.15rem; color: #ff0000;"></i> YouTube
          </a>
        </li>
        <li class="footer-social-item">
          <a href="https://www.tiktok.com/@sttcipasung" target="_blank">
            <i class="fab fa-tiktok" style="font-size: 1.15rem; color: #ffffff;"></i> TikTok
          </a>
        </li>
      </ul>
    </div>

  </div>

  <div class="footer-bottom-bar">
    <p>Copyright &copy; 2026 SIORMA STTC. All rights reserved.</p>
  </div>
</footer>

<script>
  // 1. Memblokir fungsi Klik Kanan (Context Menu)
  document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
  });

  // 2. Memblokir kombinasi tombol Inspect Element & Shortcut salin
  document.addEventListener('keydown', function(e) {
    // Blokir F12
    if (e.key === "F12") {
      e.preventDefault();
    }

    // Blokir Ctrl+Shift+I (Inspect) dan Ctrl+Shift+J (Console)
    if (e.ctrlKey && e.shiftKey && (e.key === 'I' || e.key === 'J' || e.key === 'i' || e.key === 'j')) {
      e.preventDefault();
    }

    // Blokir Ctrl+U (View Source kode mentah HTML)
    if (e.ctrlKey && (e.key === 'U' || e.key === 'u')) {
      e.preventDefault();
    }

    // Blokir Ctrl+S (Menyimpan halaman/gambar secara instan)
    if (e.ctrlKey && (e.key === 'S' || e.key === 's')) {
      e.preventDefault();
    }
  });

  // Cegah gambar di-drag
  document.querySelectorAll("img").forEach(function(img) {
    img.draggable = false;
  });
</script>