<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    <h1>Edit Pesanan #<?= esc($pesanan['id']) ?></h1>
    <a href="<?= base_url('admin/pesanan') ?>" style="margin-bottom: 15px; display: inline-block; color: blue;">&larr; Kembali ke Daftar Pesanan</a>

    <form action="<?= base_url('admin/pesanan/update/' . $pesanan['id']) ?>" method="post">
        <input type="hidden" name="_method" value="POST"> 
        <input type="hidden" name="id_user" value="<?= esc($pesanan['id_user']) ?>">
        <?= csrf_field() ?>

        <div style="display: flex; gap: 40px;">
            <div style="flex: 1; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
                <h2>Data Pelanggan</h2>
                <div style="margin-bottom: 15px;">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?= esc($pesanan['nama']) ?>" required style="width: 100%; padding: 8px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="no_telepon">Telepon:</label>
                    <input type="text" id="no_telepon" name="no_telepon" value="<?= esc($pesanan['no_telepon']) ?>" required style="width: 100%; padding: 8px;">
                </div>
                <div style="margin-bottom: 15px;">
                    <label for="alamat_pengiriman">Alamat:</label>
                    <textarea id="alamat_pengiriman" name="alamat_pengiriman" required style="width: 100%; padding: 8px;"><?= esc($pesanan['alamat_pengiriman']) ?></textarea>
                </div>
                
                <div style="margin-top: 20px;">
                    <label for="status">Status Pesanan:</label>
                    <select id="status" name="status" style="padding: 8px;">
                        <?php foreach ($statusOptions as $status): ?>
                            <option value="<?= $status ?>" <?= ($pesanan['status'] === $status) ? 'selected' : '' ?>>
                                <?= ucfirst($status) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div style="flex: 2; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
                <h2>Detail Pesanan</h2>
                
                <div id="detail-items-container">
                    <?php foreach ($pesanan['details'] as $key => $detail): ?>
                        <div class="detail-item" style="display: flex; gap: 10px; margin-bottom: 15px; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                            
                            <select name="produk_id[]" style="padding: 8px; flex: 2; border: 1px solid #ccc;">
                                <?php foreach ($semuaProduk as $produk): ?>
                                    <option value="<?= esc($produk['id']) ?>" 
                                            <?= ($detail['id_produk'] == $produk['id']) ? 'selected' : '' ?>>
                                        <?= esc($produk['nama']) ?> (Rp <?= number_format($produk['harga'], 0, ',', '.') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <input type="number" name="kuantitas[]" value="<?= esc($detail['kuantitas']) ?>" min="1" required style="padding: 8px; width: 80px; text-align: center; border: 1px solid #ccc;">

                            <button type="button" onclick="this.closest('.detail-item').remove()" style="background: red; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Hapus</button>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="button" id="add-product-btn" style="margin-top: 10px; background: blue; color: white; border: none; padding: 8px 15px; border-radius: 4px;">+ Tambah Produk</button>
                
                <h3 style="margin-top: 20px;">Total Saat Ini: Rp <?= number_format($pesanan['total_harga'], 2, ',', '.') ?></h3>
            </div>
        </div>

        <button type="submit" class="logout-btn" style="background: green; margin-top: 30px;">Simpan Perubahan Pesanan</button>
    </form>

    <script>
        document.getElementById('add-product-btn').addEventListener('click', function() {
            const container = document.getElementById('detail-items-container');
            const template = `
                <div class="detail-item" style="display: flex; gap: 10px; margin-bottom: 15px; border-bottom: 1px dashed #eee; padding-bottom: 10px;">
                    <select name="produk_id[]" style="padding: 8px; flex: 2; border: 1px solid #ccc;">
                        <?php foreach ($semuaProduk as $produk): ?>
                            <option value="<?= esc($produk['id']) ?>">
                                <?= esc($produk['nama']) ?> (Rp <?= number_format($produk['harga'], 0, ',', '.') ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <input type="number" name="kuantitas[]" value="1" min="1" required style="padding: 8px; width: 80px; text-align: center; border: 1px solid #ccc;">
                    <button type="button" onclick="this.closest('.detail-item').remove()" style="background: red; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Hapus</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', template);
        });
    </script>
<?= $this->endSection() ?>