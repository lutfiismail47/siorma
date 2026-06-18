<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIORMA STTC</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('favicon.png') ?>">
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
  <nav class="navbar">
    <div class="container nav-flex">
      <a href="<?= base_url('/') ?>" class="logo-brand">
        SIORMA
      </a>

      <button class="menu-toggle" id="hamburgerBtn" aria-label="Menu Navigasi">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <div class="nav-menu" id="navMenuContent">
        <form action="<?= base_url('daftar-ormawa') ?>" method="GET" class="search-box">
          <input type="text" name="search" placeholder="Cari" value="<?= isset($search) ? esc($search) : '' ?>">
          <button type="submit"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
        </form>

        <div class="dropdown">
          <a href="#" class="nav-link" id="btnDropdownKategori" style="display: flex; align-items: center; gap: 4px;">
            Kategori Ormawa <i class="fa-sharp fa-solid fa-angle-down"></i>
          </a>
          <div class="dropdown-content" id="dropdownKategoriMenu">
            <a href="<?= base_url('daftar-ormawa?kategori=1') ?>">BEM</a>
            <a href="<?= base_url('daftar-ormawa?kategori=2') ?>">Himpunan</a>
            <a href="<?= base_url('daftar-ormawa?kategori=3') ?>">UKM</a>
          </div>
        </div>

        <a href="<?= base_url('daftar-ormawa') ?>" class="nav-link">Daftar Ormawa</a>
        <a href="<?= base_url('login') ?>" class="nav-link">Login Admin</a>
      </div>
    </div>
  </nav>

  <script>
    const btnDropdown = document.getElementById('btnDropdownKategori');
    const menuDropdown = document.getElementById('dropdownKategoriMenu');
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const navMenuContent = document.getElementById('navMenuContent');

    // 1. Logika Hamburger Menu (Buka/Tutup menu utama di HP)
    hamburgerBtn.addEventListener('click', function() {
      navMenuContent.classList.toggle('active');
    });

    // 2. Logika Dropdown Kategori
    btnDropdown.addEventListener('click', function(e) {
      e.preventDefault();
      menuDropdown.classList.toggle('show-dropdown');
    });

    // 3. Menutup menu otomatis jika pengguna mengklik area luar navbar
    window.addEventListener('click', function(e) {
      if (!btnDropdown.contains(e.target) && !menuDropdown.contains(e.target)) {
        menuDropdown.classList.remove('show-dropdown');
      }
      if (!hamburgerBtn.contains(e.target) && !navMenuContent.contains(e.target)) {
        navMenuContent.classList.remove('active');
      }
    });
  </script>