<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> | Maekuki</title>
    <link rel="stylesheet" href="<?= base_url('css/styleadmin.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>

    <div class="admin-wrapper">

        <aside id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <a href="<?= base_url('admin/dashboard') ?>" class="admin-logo">
                    <img src="<?= base_url('assets/Asset/maekukilogocream.png') ?>" alt="Maekuki Logo">

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
                    <li class="logout-sidebar-item">
                        <a href="<?= base_url('admin/logout') ?>">
                            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <div id="sidebar-overlay" class="sidebar-overlay"></div>

        <main class="main-content">

            <header class="admin-header">

                <button id="menu-toggle-btn" class="menu-toggle" aria-label="Toggle Sidebar">
                    <i class="fas fa-bars"></i>
                </button>

                <h4 class="header-greeting">Selamat Datang, <strong><?= session()->get('email') ?></strong></h4>
               
            </header>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert success">
                    <i class="fas fa-check-circle"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert error"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <section class="content-body">
                <?= $this->renderSection('content') ?>
            </section>

        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('menu-toggle-btn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const successAlert = document.querySelector('.alert.success');

            // Fungsi untuk membuka/menutup sidebar
            function toggleSidebar() {
                // Periksa apakah elemen ditemukan sebelum mencoba mengubah kelasnya
                if (sidebar && overlay) {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                }
            }

            // 1. Klik Tombol Hamburger
            if (toggleBtn) {
                toggleBtn.addEventListener('click', toggleSidebar);
            }

            // 2. Klik Overlay untuk Menutup
            if (overlay) {
                overlay.addEventListener('click', toggleSidebar);
            }

            // 3. Menutup Sidebar saat Link Navigasi Diklik di Mobile
            document.querySelectorAll('.sidebar-nav a').forEach(link => {
                link.addEventListener('click', function() {
                    // Hanya tutup jika layar kecil (di bawah 768px)
                    if (window.innerWidth <= 768) {
                        // Cek apakah sidebar terbuka
                        if (sidebar && sidebar.classList.contains('active')) {
                            // Beri sedikit delay untuk memastikan navigasi selesai sebelum menutup
                            setTimeout(toggleSidebar, 100);
                        }
                    }
                });
            });

            if (successAlert) {
                // Hapus alert setelah 5 detik
                setTimeout(() => {
                    // Aktifkan transisi opacity
                    successAlert.style.opacity = '0';
                    successAlert.style.transform = 'translateY(-10px)'; // Geser sedikit ke atas

                    // Hapus elemen dari DOM setelah transisi selesai (500ms atau 0.5s)
                    setTimeout(() => {
                        successAlert.remove();
                    }, 500);

                }, 5000); // 5000ms = 5 detik
            }
        });
    </script>

</body>

</html>