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

        <div class="form-group image-preview-box">
            <label for="gambar">Ganti Foto Produk:</label>

            <?php if (!empty($produk['url_gambar'])): ?>
                <p style="margin-top: 5px;">Gambar Saat Ini (<?= esc($produk['url_gambar']) ?>):</p>
                <img src="<?= base_url('assets/Asset/' . $produk['url_gambar']) ?>" id="gambar-lama-preview" class="current-image-preview">
                <input type="hidden" name="gambar_lama" value="<?= esc($produk['url_gambar']) ?>">
            <?php endif; ?>

            <div id="new-image-preview-container" style="margin-top: 15px; margin-bottom: 15px; display: none; text-align: center;">
                <p style="font-weight: 600; color: green;">Preview Gambar Baru:</p>
                <img id="image-preview-edit" src="" alt="Preview Foto Baru" class="new-image-preview">
            </div>

            <div class="custom-file-upload-edit">
                <input type="file" id="new_gambar_file" name="new_gambar" accept="image/*" class="file-input-hidden">

                <label for="new_gambar_file" class="file-upload-label-edit" id="trigger-file-input-edit">
                    <i class="fas fa-upload"></i> Pilih File Baru
                </label>

                <span id="file-name-display-edit" class="file-name-display">Belum ada file dipilih.</span>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Target elemen yang baru diubah ID-nya
        const fileInput = document.getElementById('new_gambar_file');
        const fileNameDisplay = document.getElementById('file-name-display-edit');
        const imagePreview = document.getElementById('image-preview-edit');
        const previewContainer = document.getElementById('new-image-preview-container');

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    const file = this.files[0];
                    const fileName = file.name;

                    // A. Tampilkan Nama File
                    fileNameDisplay.textContent = `File baru dipilih: ${fileName}`;
                    fileNameDisplay.style.color = 'var(--color-primary)';
                    fileNameDisplay.style.fontWeight = '600';

                    // B. Tampilkan Preview Gambar
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        previewContainer.style.display = 'block'; // Tampilkan preview container

                        // Opsional: Sembunyikan gambar lama (jika ingin)
                        // const oldImage = document.getElementById('gambar-lama-preview');
                        // if (oldImage) { oldImage.style.opacity = '0.5'; }
                    };
                    reader.readAsDataURL(file);

                } else {
                    // C. Reset jika file dibatalkan
                    fileNameDisplay.textContent = 'Belum ada file dipilih.';
                    fileNameDisplay.style.color = '#888';
                    fileNameDisplay.style.fontWeight = 'normal';
                    imagePreview.src = '';
                    previewContainer.style.display = 'none';
                }
            });
        }
    });
</script>
<?= $this->endSection() ?>