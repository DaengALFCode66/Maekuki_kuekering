<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php
// Tentukan arah sort saat ini dari URL (Controller seharusnya menyediakan $sortOrder)
$currentSort = $sortOrder ?? 'normal';
$nextSort = 'asc'; // Default berikutnya adalah Termurah
$sortIcon = '';

if ($currentSort === 'asc') {
    $nextSort = 'desc'; // Jika saat ini ASC, berikutnya DESC (Termahal)
    $sortIcon = '<i class="fas fa-sort-up ml-1"></i>'; // Ikon panah ke atas
} elseif ($currentSort === 'desc') {
    $nextSort = 'normal'; // Jika saat ini DESC, berikutnya Normal
    $sortIcon = '<i class="fas fa-sort-down ml-1"></i>'; // Ikon panah ke bawah
}

// URL dasar untuk sorting harga, sambil mempertahankan parameter pencarian
$sortUrl = base_url('admin/pesanan') . '?search=' . esc($searchQuery ?? '');
?>
<h1 class="dashboard-title">Manajemen Pesanan</h1>

<div class="pesanan-controls">

    <form action="<?= base_url('admin/pesanan') ?>" method="get" class="search-form-control">
        <input type="text" name="search" placeholder="Cari berdasarkan nama pelanggan..."
            value="<?= esc($searchQuery ?? '') ?>" class="input-search-pesanan">
        <button type="submit" class="btn-cari"><i class="fas fa-search"></i> Cari</button>
        <a href="<?= base_url('admin/pesanan') ?>" class="btn-reset"><i class="fas fa-redo-alt"></i> Reset</a>
    </form>

    <form action="<?= base_url('admin/pesanan') ?>" method="get" class="filter-form-control">
        <input type="hidden" name="search" value="<?= esc($searchQuery ?? '') ?>">

        <input type="hidden" name="sort" value="<?= esc($sortOrder ?? '') ?>">

        <label for="sort-status" class="label-filter">Filter Status:</label>

        <select name="filter_status" onchange="this.form.submit()" class="select-status-filter">
            <option value="">-- Tampilkan Semua --</option>
            <?php foreach (['proses', 'selesai', 'batal'] as $statusKey): ?>
                <option value="<?= $statusKey ?>"
                    <?= ($sortStatus == $statusKey) ? 'selected' : '' ?>>
                    <?= ucfirst($statusKey) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="content-table-wrapper">
    <?php if (empty($pesanan)): ?>
        <div class="alert alert-info">
            <p><i class="fas fa-info-circle"></i> Belum ada pesanan terdaftar.</p>
        </div>
    <?php else: ?>
        <table class="order-table">
            <thead>
                <tr>
                    <th style="width: 30px; text-align: center;">No</th>
                    <th style="width: 200px;">Pelanggan & Telepon</th>
                    <th>Alamat</th>
                    <th style="width: 250px;">Detail Pesanan</th>
                    <th style="width: 100px; text-align: right;" class="sortable-header">
                        <a href="<?= $sortUrl ?>&sort=<?= $nextSort ?>" class="sort-link" title="Urutkan Harga">
                            Total Harga
                            <?php if ($currentSort !== 'normal'): ?>
                                <?= $sortIcon ?>
                            <?php endif; ?>
                        </a>
                    </th>
                    <th style="width: 80px; text-align: center;">Status</th>
                    <th style="width: 110px; text-align: center;">Tgl. Pesanan</th>
                    <th style="width: 80px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($pesanan as $item): ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>

                        <td class="customer-info-cell">
                            <strong><?= esc($item['nama']) ?></strong>
                            <br><small class="text-telp">Telp: <?= esc($item['no_telepon']) ?></small>
                        </td>

                        <td><?= esc($item['alamat_pengiriman']) ?></td>

                        <td class="detail-pesanan-cell">
                            <ul class="order-details-list">
                                <?php
                                $namaProduk = explode('|||', $item['nama_produk_list']);
                                $kuantitas = explode('|||', $item['kuantitas_list']);
                                for ($i = 0; $i < count($namaProduk); $i++) {
                                    echo "<li><span class='qty-colored'>" . esc($kuantitas[$i]) . "x</span> <strong>" . esc($namaProduk[$i]) . "</strong></li>";
                                }
                                ?>
                            </ul>
                        </td>

                        <td>
                            <strong class="total-harga-amount">Rp <?= number_format($item['total_harga'], 0, ',', '.') ?></strong>
                        </td>

                        <td class="status-cell">
                            <form action="<?= base_url('admin/pesanan/update_status/' . $item['id']) ?>" method="post">
                            <?= csrf_field() ?>

                                <select name="status_baru" onchange="this.form.submit()" class="status-select status-<?= esc($item['status']) ?>">
                                    <?php
                                    // Definisikan label yang akan terlihat di dropdown
                                    $statusOptions = [
                                        'proses' => 'Proses',
                                        'batal' => 'Batal',
                                        'selesai' => 'Selesai',
                                    ];
                                    foreach ($statusOptions as $key => $label): ?>
                                        <option value="<?= $key ?>"
                                            <?= ($item['status'] === $key) ? 'selected' : '' ?>
                                            class="option-<?= $key ?>"> <?= ucfirst($label) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </td>

                        <td class="tgl-pesanan-cell">
                            <?php
                            $dateTime = strtotime($item['tanggal_pesanan']);
                            $datePart = date('d-m-Y', $dateTime);
                            $timePart = date('H:i', $dateTime);
                            ?>
                            <span class="date-display"><?= $datePart ?></span>
                            <span class="time-display"><?= $timePart ?> WIB</span>
                        </td>

                        <td class="action-cell">
                            <a href="<?= base_url('admin/pesanan/' . $item['id'] . '/edit') ?>" class="btn-action btn-edit" title="Edit Pesanan">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="<?= base_url('admin/pesanan/' . $item['id']) ?>" method="post" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pesanan #<?= esc($item['id']) ?>?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn-action btn-delete" title="Hapus Pesanan">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>