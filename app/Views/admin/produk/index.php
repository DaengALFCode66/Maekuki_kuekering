<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<?php
// (Logika Sorting Stok Dibiarkan di sini tapi tidak digunakan di TH)
$currentSort = $_GET['sort'] ?? 'normal'; 
$nextSort = 'stok_asc'; // Default berikutnya

// 2. Tentukan arah sorting selanjutnya
if ($currentSort === 'stok_asc') {
    // Jika saat ini ASC, klik berikutnya harus DESC
    $nextSort = 'stok_desc';
} elseif ($currentSort === 'stok_desc') {
    // Jika saat ini DESC, klik berikutnya harus NORMAL (Urutan semula)
    $nextSort = 'normal';
} else {
    // Jika saat ini NORMAL, klik berikutnya harus ASC
    $nextSort = 'stok_asc';
}
$sortUrlStok = base_url('admin/produk') . '?search=' . esc($searchQuery);
?>

<h1 class="dashboard-title">Manajemen Produk</h1>

<a href="<?= base_url('admin/produk/new') ?>" class="btn-tambah btn-success-primary"><i class="fas fa-plus"></i> Tambah Produk Baru</a>


<div class="pesanan-controls search-only-control">
    <form action="<?= base_url('admin/produk') ?>" method="get" class="search-form-control">
        <input type="text" name="search" placeholder="Cari berdasarkan nama produk..."
            value="<?= esc($searchQuery) ?>" class="input-search-pesanan">

        <button type="submit" class="btn-cari"><i class="fas fa-search"></i> Cari</button>
        <a href="<?= base_url('admin/produk') ?>" class="btn-reset"><i class="fas fa-redo-alt"></i> Reset</a>
    </form>
</div>

<div class="content-table-wrapper">
    <?php if (empty($produk)): ?>
        <div class="alert alert-info">
            <p><i class="fas fa-info-circle"></i> Belum ada produk terdaftar di database.</p>
        </div>
    <?php else: ?>
        <table class="order-table">
            <table class="order-table">
            <thead>
                <tr>
                    <th style="width: 30px;">ID</th>
                    <th>Nama</th>
                    <th style="width: 120px;">Harga</th>
                    <th style="width: 90px;" class="sortable-header">
                    <a href="<?= $sortUrlStok ?>&sort=<?= $nextSort ?>" class="sort-link">
                            Stok
                        <?php if ($currentSort === 'stok_asc'): ?>
                                <i class="fas fa-sort-up ml-1"></i>
                        <?php elseif ($currentSort === 'stok_desc'): ?>
                            <i class="fas fa-sort-down ml-1"></i>
                        <?php endif; ?> 
                    </a>
                </th>
                <th style="width: 120px; text-align: center;">Status</th>
                    <th style="width: 80px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $item): ?>
                    <tr>
                        <td><?= esc($item['id']) ?></td>
                        <td><strong><?= esc($item['nama']) ?></strong></td>
                        <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td style="text-align: center;"><?= esc($item['jumlah_stok']) ?></td>
                        <td class="status-cell">
                            <?php
                            $dbStatus = strtolower(trim($item['status']));

                            if ($dbStatus === 'aktif') {
                                $statusClass = 'aktif';
                                $statusLabel = 'AKTIF';
                            } else {
                                $statusClass = 'nonaktif';
                                $statusLabel = 'NON-AKTIF';
                            }
                            ?>
                            <span class="status-badge status-<?= $statusClass ?>">
                                <?= $statusLabel ?>
                            </span>
                        </td>
                        <td class="action-cell">
                            <a href="<?= base_url('admin/produk/' . $item['id'] . '/edit') ?>" class="btn-action btn-edit" title="Edit Produk">
                              <i class="fas fa-edit"></i>
                             </a>

                            <form action="<?= base_url('admin/produk/' . $item['id']) ?>" method="post" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus produk <?= esc($item['nama']) ?>?');">
                            <input type="hidden" name="_method" value="DELETE">
                            <?= csrf_field() ?>
                                <button type="submit" class="btn-action btn-delete" title="Hapus Produk">
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