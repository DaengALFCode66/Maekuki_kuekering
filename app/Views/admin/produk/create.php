<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    <div class="admin-form-container"> 
        <h1 class="form-title">Tambah Produk Baru</h1>
        <a href="<?= base_url('admin/produk') ?>" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Daftar Produk</a>

        <form action="<?= base_url('admin/produk/create') ?>" method="post" class="product-form" enctype="multipart/form-data"> 
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="nama">Nama Produk:</label>
                <input type="text" id="nama" name="nama" required class="form-input">
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" rows="4" class="form-input"></textarea>
            </div>
            
            <div class="form-group">
                <label for="harga">Harga (Rp):</label>
                <input type="number" id="harga" name="harga" required class="form-input" step="0.01">
            </div>

            <div class="form-group">
                <label for="jumlah_stok">Jumlah Stok Awal:</label>
                <input type="number" id="jumlah_stok" name="jumlah_stok" value="0" min="0" required class="form-input">
            </div>
            
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" class="form-input">
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Non-Aktif</option>
                </select>
            </div>
            
            <div class="form-group file-upload-group">
                <label for="gambar_file">Tambah Foto Produk:</label>
                <input type="file" id="gambar_file" name="gambar" accept="image/*" required> 
                <small class="form-help-text">Pilih file gambar (JPG/PNG). File akan otomatis disimpan ke folder aset.</small>
            </div>

            <div class="form-action">
                <button type="submit" class="btn-submit-product">Simpan Produk</button>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>