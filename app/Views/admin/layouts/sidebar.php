<aside class="admin-sidebar">
  <ul class="sidebar-menu">
    <li class="sidebar-item <?= url_is('admin') ? 'active' : '' ?>">
      <a href="<?= base_url('/admin') ?>">Dashboard</a>
    </li>
    <li class="sidebar-item <?= url_is('admin/create') ? 'active' : '' ?>">
      <a href="<?= base_url('/admin/create') ?>">Tambah Ormawa</a>
    </li>
    <li class="sidebar-item">
      <a href="<?= base_url('logout') ?>" class="btn-logout">Keluar</a>
    </li>
  </ul>
</aside>