<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h1>Edit Produk: <?= esc($produk['nama']) ?></h1>
<p>ID Produk: <?= esc($produk['id']) ?></p>

<a href="<?= base_url('admin/produk') ?>" class="btn-back-link">&larr; Kembali ke Daftar Produk</a>

<div class="admin-form-container">
    <form action="<?= base_url('admin/produk/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="nama">Nama Produk:</label>
            <input type="text" id="nama" name="nama" value="<?= esc($produk['nama']) ?>" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi"><?= esc($produk['deskripsi']) ?></textarea>
        </div>

        <div class="form-group">
            <label for="harga">Harga (Rp):</label>
            <input type="number" id="harga" name="harga" value="<?= esc($produk['harga']) ?>" required>
        </div>

        <div class="form-group">
            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="aktif" <?= ($produk['status'] === 'aktif') ? 'selected' : '' ?>>Aktif</option>
                <option value="non-aktif" <?= ($produk['status'] === 'non-aktif') ? 'selected' : '' ?>>Non-Aktif</option>
            </select>
        </div>

        <div class="image-preview-box">
            <label for="gambar">Ganti Foto Produk:</label>

            <?php if (!empty($produk['url_gambar'])): ?>
                <p style="margin-top: 5px;">Gambar Saat Ini (<?= esc($produk['url_gambar']) ?>):</p>
                <img src="<?= base_url('assets/Asset/' . $produk['url_gambar']) ?>">
                <input type="hidden" name="gambar_lama" value="<?= esc($produk['url_gambar']) ?>">
            <?php endif; ?>

            <div class="custom-file-upload">
                <input type="file" id="gambar" name="gambar" accept="image/*" class="file-input-hidden">

                <label for="gambar" class="file-upload-label">
                    <i class="fas fa-upload"></i> Pilih File Baru
                </label>

                <span id="file-name-display" class="file-name-display">Belum ada file dipilih.</span>
            </div>

            <small style="color: #888; margin-top: 10px; display: block;">Biarkan kosong jika tidak ingin mengubah foto.</small>
        </div>

        <div class="form-group">
            <label for="jumlah_stok">Jumlah Stok Saat Ini:</label>
            <input type="number" id="jumlah_stok" name="jumlah_stok" value="<?= esc($produk['jumlah_stok'] ?? 0) ?>" required>
        </div>

        <button type="submit" class="btn-update-form">Update Produk</button>
    </form>
</div>
<?= $this->endSection() ?>