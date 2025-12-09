<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> | Maekuki</title>
    <link rel="stylesheet" href="<?= base_url('css/styleadmin.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* CSS Khusus Layout Admin Akan Disisipkan di Bawah */

        /* 1. VARIABEL WARNA BRANDING */
        :root {
            --color-primary: #8B4513;
            /* Coklat Tua */
            --color-secondary: #DAA520;
            /* Emas */
            --color-dark-bg: #6D4C41;
            /* Coklat Gelap Sidebar */
            --color-light-bg: #F8F9FA;
            /* Background Halaman */
        }

        body {
            font-family: 'Poppins', sans-serif;
            /* Asumsi font yang digunakan */
            background-color: var(--color-light-bg);
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        /* Wrapper Utama */
        .admin-wrapper {
            display: flex;
            width: 100%;
            
        }

        /* 2. SIDEBAR */
        .sidebar {
            width: 250px;
            background-color: var(--color-dark-bg);
            color: white;
            min-height: 100vh;
            flex-shrink: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.2);
        }

        .sidebar-header {
            padding: 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .admin-logo img {
            height: 100px;
            /* Ukuran logo yang lebih menonjol */
            width: auto;
          
        }

        /* Navigasi */
        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }

        .sidebar-nav li a {
            color: rgba(255, 255, 255, 0.85);
            padding: 12px 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 1rem;
        }

        .sidebar-nav li a:hover {
            background-color: rgba(0, 0, 0, 0.15);
            /* Efek gelap yang halus */
        }

        .sidebar-nav li.active a {
            /* Warna aktif Emas */
            background-color: var(--color-secondary);
            color: var(--color-primary);
            font-weight: 600;
            box-shadow: 3px 0 0 var(--color-primary) inset;
            /* Garis vertikal di kiri */
        }

        .sidebar-nav li i {
            font-size: 1.1rem;
        }

        /* 3. KONTEN UTAMA & HEADER */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .admin-header {
            background-color: #fff;
            padding: 15px 30px;
            box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            /* Penting agar tidak menyusut */
        }

        .header-greeting {
            margin: 0;
            color: #555;
            font-size: 1.1rem;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background-color 0.3s, transform 0.1s;
        }

        .btn-logout:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        /* Alert Messages */
        .alert {
            padding: 12px 20px;
            margin: 20px 20px 0 20px;
            /* Jarak dari header */
            border-radius: 6px;
            font-weight: 500;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Konten Body */
        .content-body {
            background: white;
            padding: 30px;
            /* Padding lebih besar */
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            flex-grow: 1;
        }

        /* ... */
    </style>
</head>

<body>

    <div class="admin-wrapper">

        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="<?= base_url('admin/dashboard') ?>" class="admin-logo">
                    <img src="<?= base_url('assets/Asset/maekukilogo.png') ?>" alt="Maekuki Logo">
                </a>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li class="<?= url_is('admin/dashboard') ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/dashboard') ?>">
                            <i class="fas fa-chart-line"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="<?= url_is('admin/produk') || url_is('admin/produk/*') ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/produk') ?>">
                            <i class="fas fa-box-open"></i> <span>Manajemen Produk</span>
                        </a>
                    </li>
                    <li class="<?= url_is('admin/pesanan') ? 'active' : '' ?>">
                        <a href="<?= base_url('admin/pesanan') ?>">
                            <i class="fas fa-shopping-cart"></i> <span>Manajemen Pesanan</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">

            <header class="admin-header">
                <h4 class="header-greeting">Selamat Datang, **<?= session()->get('email') ?>**</h4>
                <a href="<?= base_url('admin/logout') ?>" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </header>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert error"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <section class="content-body">
                <?= $this->renderSection('content') ?>
            </section>

        </main>
    </div>

</body>

</html>