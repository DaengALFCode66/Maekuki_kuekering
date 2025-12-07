<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h1>Edit Produk: <?= esc($produk['nama']) ?></h1>
<p>ID Produk: <?= esc($produk['id']) ?></p>

<a href="<?= base_url('admin/produk') ?>" style="margin-bottom: 15px; display: inline-block; text-decoration: none; color: blue;">&larr; Kembali ke Daftar Produk</a>

<div class="content-body" style="padding: 20px;">
    <form action="<?= base_url('admin/produk/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
        <?= csrf_field() ?>

        <div style="margin-bottom: 15px;">
            <label for="nama" style="display: block; font-weight: bold;">Nama Produk:</label>
            <input type="text" id="nama" name="nama" value="<?= esc($produk['nama']) ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="deskripsi" style="display: block; font-weight: bold;">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"><?= esc($produk['deskripsi']) ?></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="harga" style="display: block; font-weight: bold;">Harga (Rp):</label>
            <input type="number" id="harga" name="harga" value="<?= esc($produk['harga']) ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="status" style="display: block; font-weight: bold;">Status:</label>
            <select id="status" name="status" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="aktif" <?= ($produk['status'] === 'aktif') ? 'selected' : '' ?>>Aktif</option>
                <option value="non-aktif" <?= ($produk['status'] === 'non-aktif') ? 'selected' : '' ?>>Non-Aktif</option>
            </select>
        </div>

        <div style="margin-bottom: 20px; border: 1px dashed #ccc; padding: 15px; border-radius: 4px;">
            <label for="gambar" style="display: block; font-weight: bold; margin-bottom: 10px;">Ganti Foto Produk:</label>

            <?php if (!empty($produk['url_gambar'])): ?>
                <p style="margin-bottom: 5px;">Gambar Saat Ini (<?= esc($produk['url_gambar']) ?>):</p>
                <img src="<?= base_url('assets/Asset/' . $produk['url_gambar']) ?>" style="max-width: 150px; height: auto; margin-bottom: 15px; border: 1px solid #ddd;">

                <input type="hidden" name="gambar_lama" value="<?= esc($produk['url_gambar']) ?>">
            <?php endif; ?>

            <input type="file" id="gambar" name="gambar" accept="image/*" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <small style="color: #888;">Biarkan kosong jika tidak ingin mengubah foto.</small>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="jumlah_stok" style="display: block; font-weight: bold;">Jumlah Stok Saat Ini:</label>
            <input type="number" id="jumlah_stok" name="jumlah_stok" value="<?= esc($produk['jumlah_stok'] ?? 0) ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
</div>

<button type="submit" class="logout-btn" style="background: #8B4513;">Update Produk</button>
</form>
</div>
<?= $this->endSection() ?>