<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<h1 class="dashboard-title">Dashboard Utama</h1>

<div class="quick-stats-grid">
    
    <div class="stat-card stat-blue">
        <p class="stat-label">Total Produk Aktif</p>
        <p class="stat-value"><?= number_format($totalProdukAktif, 0) ?></p>
    </div>
    
    <div class="stat-card stat-green">
        <p class="stat-label">Pendapatan Bulan Ini</p>
        <p class="stat-value">Rp <?= number_format($pendapatanBulanIni, 0, ',', '.') ?></p>
    </div>
    
    <div class="stat-card stat-orange">
        <p class="stat-label">Pesanan Baru Hari Ini</p>
        <p class="stat-value"><?= number_format($pesananBaruHariIni, 0) ?></p>
    </div>
    
    <div class="stat-card stat-yellow">
        <p class="stat-label">Pesanan Siap Kirim</p>
        <p class="stat-value"><?= number_format($pesananSiapKirim, 0) ?></p>
    </div>
</div>

<div class="dashboard-bottom-grid">
    
    <div class="card-box table-card pesanan-hari-ini-card">
        <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Pesanan Hari Ini</h3>
        <table class="simple-table full-width-table">
            <thead>
                <tr>
                    <th style="width: 80px;">NO.PESANAN</th>
                    <th>PRODUK</th>
                    <th style="width: 100px;">TOTAL HARGA</th>
                    <th style="width: 100px;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pesananHariIni)): ?>
                    <tr><td colspan="4">Tidak ada pesanan masuk hari ini.</td></tr>
                <?php else: ?>
                    <?php foreach ($pesananHariIni as $p): ?>
                    <tr>
                        <td>#<?= esc($p['id']) ?></td>
                        <td>
                            <ul class="product-list-compact">
                                <?php
                                // Menggunakan fallback ('??') untuk mengatasi error Undefined Key jika ada produk terhapus
                                $produkList = $p['nama_produk_list'] ?? ''; 
                                $kuantitasList = $p['kuantitas_list'] ?? ''; 
                                
                                $namaProduk = explode('|||', $produkList);
                                $kuantitas = explode('|||', $kuantitasList);
                                
                                for ($i = 0; $i < count($namaProduk); $i++):
                                    // Melewati item kosong yang mungkin dihasilkan oleh explode atau produk yang terhapus (NULL)
                                    if (empty(trim($namaProduk[$i]))) continue; 
                                ?>
                                    <li><?= esc($kuantitas[$i]) ?>x **<?= esc($namaProduk[$i]) ?>**</li>
                                <?php endfor; ?>
                                
                                <?php if (empty($produkList) && empty($kuantitasList)): ?>
                                    <li><span class="text-red">Detail produk tidak ditemukan.</span></li>
                                <?php endif; ?>
                            </ul>
                        </td>
                        <td>Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></td>
                        <td>
                            <?php 
                            $statusClass = strtolower($p['status']);
                            ?>
                            <span class="status-mini status-<?= $statusClass ?>"><?= ucfirst($p['status']) ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="card-footer">
            <a href="<?= base_url('admin/pesanan') ?>">Lihat Semua Pesanan &rarr;</a>
        </div>
    </div>
    
    <div class="card-box notification-card">
        <h3 class="card-title"><i class="fas fa-bell"></i> Notif Penting</h3>
        <ul class="notification-list">
            <?php if (empty($stokRendah)): ?>
                <li class="notif-safe"><i class="fas fa-check-circle text-green"></i> Semua stok dalam batas aman.</li>
            <?php else: ?>
                <?php foreach ($stokRendah as $stok): ?>
                    <li class="notif-warning"><i class="fas fa-exclamation-triangle text-red"></i> Stok Rendah: **<?= esc($stok['nama']) ?>** tinggal **<?= esc($stok['jumlah_stok']) ?>** toples.</li>
                <?php endforeach; ?>
            <?php endif; ?>
            <li class="notif-info"><i class="fas fa-info-circle text-blue"></i> Ada 5 ulasan baru yang belum dilihat.</li>
        </ul>
    </div>
    
</div>

<?= $this->endSection() ?>