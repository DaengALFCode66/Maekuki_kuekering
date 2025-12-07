<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    <h1>Tambah Produk Baru</h1>
    <a href="<?= base_url('admin/produk') ?>" style="margin-bottom: 15px; display: inline-block;">&larr; Kembali ke Daftar Produk</a>

    <form action="<?= base_url('admin/produk') ?>" method="post"> 
        <?= csrf_field() ?>

        <div style="margin-bottom: 15px;">
            <label for="nama" style="display: block; font-weight: bold;">Nama Produk:</label>
            <input type="text" id="nama" name="nama" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="deskripsi" style="display: block; font-weight: bold;">Deskripsi:</label>
            <textarea id="deskripsi" name="deskripsi" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="harga" style="display: block; font-weight: bold;">Harga (Rp):</label>
            <input type="number" id="harga" name="harga" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label for="status" style="display: block; font-weight: bold;">Status:</label>
            <select id="status" name="status" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="aktif">Aktif</option>
                <option value="non-aktif">Non-Aktif</option>
            </select>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="url_gambar" style="display: block; font-weight: bold;">Nama File Gambar (ex: nastar.png):</label>
            <input type="text" id="url_gambar" name="url_gambar" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <small style="color: #888;">Pastikan file gambar sudah ada di folder assets/Asset/</small>
        </div>

        <button type="submit" class="logout-btn" style="background: #8B4513;">Simpan Produk</button>
    </form>
<?= $this->endSection() ?>