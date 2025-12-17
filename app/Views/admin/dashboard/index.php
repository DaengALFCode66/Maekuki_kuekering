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
        <p class="stat-label">Pesanan Sedang Diproses</p>
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
                    <th>NAMA PRODUK</th>
                    <th class="total-harga-cell" style="width: 100px; text-align: right;">TOTAL HARGA</th>
                    <th class="status-cell" style="width: 100px; text-align: center;">STATUS</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($pesananHariIni)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: #888;">Tidak ada pesanan masuk hari ini.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($pesananHariIni as $p): ?>
                        <tr>
                            <td><?= esc($p['id']) ?></td>

                            <td class="product-list-cell">
                                <ul class="product-list-compact">
                                    <?php
                                    $produkList = $p['nama_produk_list'] ?? '';
                                    $kuantitasList = $p['kuantitas_list'] ?? '';

                                    $namaProduk = explode('|||', $produkList);
                                    $kuantitas = explode('|||', $kuantitasList);

                                    for ($i = 0; $i < count($namaProduk); $i++):
                                        if (empty(trim($namaProduk[$i]))) continue;
                                    ?>
                                        <li>
                                            <span class="qty-colored"><?= esc($kuantitas[$i]) ?>x</span>
                                            <strong><?= esc($namaProduk[$i]) ?></strong>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if (empty($produkList) && empty($kuantitasList)): ?>
                                        <li><span class="text-red">Detail produk tidak ditemukan.</span></li>
                                    <?php endif; ?>
                                </ul>
                            </td>

                            <td style="text-align: right;">
                                <span class="total-harga-amount">Rp <?= number_format($p['total_harga'], 0, ',', '.') ?></span>
                            </td>

                            <td style="text-align: center;">
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

    <div class="notif-penting-wrapper">
        <div class="notif-penting-header">
            <i class="fas fa-bell"></i> Notif Penting
        </div>

        <div class="notif-penting-content">

            <?php if ($jumlahStokKritis > 0): ?>
                <div class="notif-item notif-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>
                        <span class="notif-count"><?= $jumlahStokKritis ?></span> produk memiliki stok kritis. Segera restock!
                    </p>
                    <a href="<?= base_url('admin/produk') ?>" class="action-link">Lihat Produk &rarr;</a>
                </div>
            <?php else: ?>
                <div class="notif-item notif-success">
                    <i class="fas fa-check-circle"></i>
                    <p>Semua stok dalam batas aman.</p>
                </div>
            <?php endif; ?>

            <div class="notif-item notif-info">
                <i class="fas fa-info-circle"></i>
                <p>Ada 5 ulasan baru yang belum dilihat.</p>
                <a href="#" class="action-link">Lihat Ulasan &rarr;</a>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>