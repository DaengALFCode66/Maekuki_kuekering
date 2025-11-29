<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    <h1>Dashboard Utama</h1>
    <p>Ini adalah halaman ringkasan admin. Dari sini Anda dapat menavigasi ke bagian manajemen produk, pesanan, dan stok.</p>
    
    <div style="margin-top: 30px;">
        <h3>Statistik Cepat</h3>
        <div style="display: flex; gap: 20px; margin-top: 15px;">
            <div style="background: #e0f7fa; padding: 20px; border-radius: 6px; flex: 1;">
                <h4>Total Produk Aktif</h4>
                <p style="font-size: 1.5rem; font-weight: bold;">8</p> 
            </div>
            <div style="background: #fff3e0; padding: 20px; border-radius: 6px; flex: 1;">
                <h4>Pesanan Baru Hari Ini</h4>
                <p style="font-size: 1.5rem; font-weight: bold;">0</p>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>9 m 