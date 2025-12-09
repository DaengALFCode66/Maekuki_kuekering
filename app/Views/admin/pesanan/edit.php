<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<div class="edit-pesanan-wrapper">

    <h1 class="page-title">Edit Pesanan #<?= esc($pesanan['id']) ?></h1>

    <a href="<?= base_url('admin/pesanan') ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan</a>

    <form action="<?= base_url('admin/pesanan/update/' . $pesanan['id']) ?>" method="POST" class="edit-pesanan-form">
        <?= csrf_field() ?>

        <input type="hidden" name="id_user" value="<?= esc($pesanan['id_user']) ?>">

        <div class="form-grid-container">

            <div class="card-box data-pelanggan-card">
                <h3 class="card-title"><i class="fas fa-user-alt"></i> Data Pelanggan</h3>

                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?= esc($pesanan['nama']) ?>" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="no_telepon">Telepon:</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="<?= esc($pesanan['no_telepon']) ?>" required class="form-input">
                </div>

                <div class="form-group">
                    <label for="alamat_pengiriman">Alamat:</label>
                    <textarea id="alamat_pengiriman" name="alamat_pengiriman" rows="3" required class="form-input"><?= esc($pesanan['alamat_pengiriman']) ?></textarea>
                </div>

                <div class="form-group status-select-group">
                    <label for="status">Status Pesanan:</label>
                    <select id="status" name="status" class="status-select status-<?= strtolower($pesanan['status']) ?>">
                        <?php
                        // Status Options (didefinisikan ulang untuk konsistensi di View)
                        $statusOptions = ['proses', 'batal', 'selesai'];
                        foreach ($statusOptions as $status): ?>
                            <option value="<?= $status ?>"
                                <?= (strtolower($pesanan['status']) === $status) ? 'selected' : '' ?>>
                                <?= ucfirst($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="card-box detail-pesanan-card">
                <h3 class="card-title"><i class="fas fa-shopping-basket"></i> Detail Pesanan</h3>

                <div id="detail-items-container" class="detail-items-container-scroll">
                    <?php
                    // Looping Item Detail Pesanan
                    foreach ($pesanan['details'] as $key => $detail):
                    ?>
                        <div class="item-row" data-index="<?= $key ?>">

                            <select name="produk_id[]" class="item-produk-select form-input">
                                <?php foreach ($semuaProduk as $produk): ?>
                                    <option value="<?= esc($produk['id']) ?>"
                                        <?= ($detail['id_produk'] == $produk['id']) ? 'selected' : '' ?>>
                                        <?= esc($produk['nama']) ?> (Rp <?= number_format($produk['harga'], 0, ',', '.') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <input type="number" name="kuantitas[]" value="<?= esc($detail['kuantitas']) ?>" min="1" required class="item-kuantitas form-input">

                            <button type="button" onclick="this.closest('.item-row').remove()" class="btn-remove-item">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    <?php endforeach; ?>
                </div> <button type="button" id="add-product-btn" class="btn-tambah-produk">
                    <i class="fas fa-plus"></i> Tambah Produk
                </button>

                <hr class="total-divider">

                <div class="total-harga-display">
                    <p>Total Saat Ini:</p>
                    <p class="total-amount">Rp <?= number_format($pesanan['total_harga'], 0, ',', '.') ?></p>
                </div>

            </div>
        </div>
        <div class="form-submit-row">
            <button type="submit" class="btn-simpan-perubahan"><i class="fas fa-save"></i> Simpan Perubahan Pesanan</button>
        </div>

    </form>
</div>
<script>
    document.getElementById('add-product-btn').addEventListener('click', function() {
        const container = document.getElementById('detail-items-container');
        const template = `
            <div class="item-row" style="display: flex; gap: 10px; margin-bottom: 15px; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                <select name="produk_id[]" class="item-produk-select form-input">
                    <?php foreach ($semuaProduk as $produk): ?>
                        <option value="<?= esc($produk['id']) ?>">
                            <?= esc($produk['nama']) ?> (Rp <?= number_format($produk['harga'], 0, ',', '.') ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <input type="number" name="kuantitas[]" value="1" min="1" required class="item-kuantitas form-input">
                <button type="button" onclick="this.closest('.item-row').remove()" class="btn-remove-item">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', template);
        // Scroll ke bawah agar item baru terlihat
        container.scrollTop = container.scrollHeight;
    });
</script>
<?= $this->endSection() ?>