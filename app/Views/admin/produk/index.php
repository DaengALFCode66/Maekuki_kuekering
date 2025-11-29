<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h1>Manajemen Produk</h1>

<a href="<?= base_url('admin/produk/new') ?>" class="logout-btn" style="background: #25D366; margin-bottom: 20px; display: inline-block;">+ Tambah Produk Baru</a>

<div class="content-body">
    <?php if (empty($produk)): ?>
        <p>Belum ada produk terdaftar di database.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">ID</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Nama</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Harga</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Stok</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Status</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produk as $item): ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= esc($item['id']) ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= esc($item['nama']) ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;">Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= esc($item['jumlah_stok']) ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd;"><?= esc($item['status']) ?></td>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            <a href="<?= base_url('admin/produk/' . $item['id'] . '/edit') ?>" style="color: blue; margin-right: 10px;">Edit</a>

                            <form action="<?= base_url('admin/produk/' . $item['id']) ?>" method="post" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus produk <?= esc($item['nama']) ?>?');">
                                <input type="hidden" name="_method" value="DELETE">
                                <?= csrf_field() ?>
                                <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>