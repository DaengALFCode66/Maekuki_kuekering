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
            <label>Tambah Foto Produk:</label>

            <input type="file" id="gambar_file" name="gambar" accept="image/*" required style="display: none;">

            <div id="image-preview-container" style="margin-bottom: 15px; display: none; text-align: center;">
                <img id="image-preview" src="" alt="Preview Foto Produk" style="max-width: 200px; max-height: 200px; border: 1px solid #ddd; border-radius: 8px; object-fit: cover;">
            </div>

            <button type="button" class="btn-warning" id="trigger-file-input" style="padding: 10px 15px;">
                <i class="fas fa-upload"></i> Pilih File Gambar
            </button>

            <span id="file-name-display" style="display: block; margin-top: 10px; font-style: italic; color: #888;">Belum ada file dipilih.</span>

            <small class="form-help-text">Pilih file gambar (JPG/PNG). File akan otomatis disimpan ke folder aset.</small>
        </div>

        <div class="form-action">
            <button type="submit" class="btn-submit-product">Simpan Produk</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('gambar_file');
        const triggerButton = document.getElementById('trigger-file-input');
        const fileNameDisplay = document.getElementById('file-name-display');
        const imagePreview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('image-preview-container');

        // 1. Memicu Klik Input File: Saat tombol custom diklik
        if (triggerButton && fileInput) {
            triggerButton.addEventListener('click', function() {
                fileInput.click();
            });
        }

        // 2. Event 'change': Saat file berhasil dipilih
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    const file = this.files[0];
                    const fileName = file.name;

                    // A. Update Nama File
                    fileNameDisplay.textContent = `File dipilih: ${fileName}`;
                    fileNameDisplay.style.color = 'var(--color-primary)'; // Coklat Tua
                    fileNameDisplay.style.fontWeight = '600';

                    // B. Tampilkan Preview Gambar
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        previewContainer.style.display = 'block';
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