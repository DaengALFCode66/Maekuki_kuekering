<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> | Maekuki</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; display: flex; }
        .sidebar { width: 250px; background-color: #8B4513; color: white; min-height: 100vh; padding-top: 20px; flex-shrink: 0; }
        .sidebar a { color: white; padding: 10px 20px; text-decoration: none; display: block; border-bottom: 1px solid #7a3c10; transition: background 0.2s; }
        .sidebar a:hover, .sidebar a.active { background-color: #DAA520; color: #8B4513; }
        .main-content { flex-grow: 1; padding: 20px; }
        .navbar-admin { display: flex; justify-content: space-between; align-items: center; background: white; padding: 15px 20px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .logout-btn { background: #E60023; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; text-decoration: none; }
        .content-body { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        h1 { color: #8B4513; }
        .alert { padding: 10px; margin-bottom: 15px; border-radius: 4px; }
        .alert.success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert.error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

    <div class="sidebar">
        <h3 style="text-align: center; color: #DAA520; margin-bottom: 30px;">Maekuki Admin</h3>
        <a href="<?= base_url('admin/dashboard') ?>" class="<?= url_is('admin/dashboard') ? 'active' : '' ?>">Dashboard</a>
        <a href="<?= base_url('admin/produk') ?>" class="<?= url_is('admin/produk') || url_is('admin/produk/*') ? 'active' : '' ?>">Manajemen Produk</a>
        <a href="#pesanan">Manajemen Pesanan</a>
        <a href="#stok">Manajemen Stok</a>
    </div>

    <div class="main-content">
        <div class="navbar-admin">
            <h4>Selamat Datang, <?= session()->get('email') ?></h4>
            <a href="<?= base_url('admin/logout') ?>" class="logout-btn">Logout</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert error"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div class="content-body">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

</body>
</html>