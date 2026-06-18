<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin SIORMA</title>
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body>
  <?= view('public/layouts/header') ?>

  <div class="login-container">
    <div class="login-card">
      <h2>Masuk Sebagai Admin</h2>
      <p>Kelola informasi yang ditampilkan di situs ini.</p>

      <?php if (session()->getFlashdata('error')): ?>
        <p style="color: var(--danger-color); font-size: 0.85rem; margin-bottom: 15px; font-weight: bold;"><?= session()->getFlashdata('error') ?></p>
      <?php endif; ?>

      <form action="<?= base_url('loginProcess') ?>" method="POST">
        <div class="admin-form-group">
          <label style="font-size: 0.85rem; font-weight: normal; margin-bottom: 5px;">Username</label>
          <input type="text" name="username" class="admin-form-control" style="padding: 8px 12px;" required>
        </div>

        <div class="admin-form-group" style="margin-bottom: 25px;">
          <label style="font-size: 0.85rem; font-weight: normal; margin-bottom: 5px;">Password</label>
          <input type="password" name="password" class="admin-form-control" style="padding: 8px 12px;" required>
        </div>

        <div style="display: flex; gap: 10px;">
          <a href="<?= base_url('/') ?>" class="btn-form cancel" style="flex: 1; text-align: center; text-decoration: none; font-size: 0.85rem; padding: 8px 0; line-height: 1.8;">Batal</a>
          <button type="submit" class="btn-form save" style="flex: 1; font-size: 0.85rem; padding: 8px 0;">Masuk</button>
        </div>
      </form>
    </div>
  </div>

  <?= view('public/layouts/footer') ?>
</body>

</html>