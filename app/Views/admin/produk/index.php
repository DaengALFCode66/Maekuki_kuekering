<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- STYLE UNTUK TABEL (langsung di halaman) -->
<style>
    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        border-radius: 6px;
        overflow: hidden;
        font-family: Arial, sans-serif;
        font-size: 14px;
        background: #fff;
    }

    .table-custom thead {
        background: #d56c0a;
        color: white;
    }

    .table-custom th {
        padding: 12px;
        text-align: left;
        font-weight: bold;
        border-bottom: 2px solid #c25f08;
    }

    .table-custom td {
        padding: 12px;
        border-bottom: 1px solid #eeeeeeff;
    }

    .table-custom tr:hover {
        background: #c59970ff;
    }

    .action-edit {
        color: #1e88e5;
        margin-right: 10px;
        text-decoration: none;
        font-weight: bold;
    }

    .action-hapus {
        color: #d32f2f;
        background: none;
        border: none;
        cursor: pointer;
        font-weight: bold;
    }
</style>

<h1>Manajemen Produk</h1>

<a href="<?= base_url('admin/produk/new') ?>" class="logout-btn" style="background: #25D366; margin-bottom: 20px; display: inline-block;">+ Tambah Produk Baru</a>

<div style="margin-bottom: 20px;">
    <form action="<?= base_url('admin/produk') ?>" method="get" style="display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Cari berdasarkan nama produk..."
            value="<?= esc($searchQuery ?? '') ?>"
            style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 300px;">

        <button type="submit" style="background-color: #8B4513; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">
            Cari
        </button>
        <a href="<?= base_url('admin/produk') ?>" style="text-decoration: none; padding: 8px 15px; border: 1px solid #ccc; border-radius: 4px; color: #333;">Reset</a>
    </form>
</div>

<div class="content-body">
    <?php if (empty($produk)): ?>
        <p>Belum ada produk terdaftar di database.</p>
    <?php else: ?>

        <table class="table-custom">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
            <th style="text-align: center;">Aksi</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($produk as $item): ?>
            <tr>
                <td><?= esc($item['id']) ?></td>
                <td><?= esc($item['nama']) ?></td>
                <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                <td><?= esc($item['jumlah_stok']) ?></td>

                <!-- STATUS DROPDOWN -->
                <td>
                    <form action="<?= base_url('admin/produk/' . $item['id']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <select name="status" onchange="this.form.submit()" style="padding:5px; border-radius:4px;">
                            <option value="Aktif" <?= $item['status'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                            <option value="Tidak Aktif" <?= $item['status'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
                        </select>
                    </form>
                </td>

                <!-- AKSI -->
                <td style="text-align: center;">
                    <a href="<?= base_url('admin/produk/' . $item['id'] . '/edit') ?>" class="action-edit">
                        Edit
                    </a>

                    <!-- ICON TRASH -->
                    <form action="<?= base_url('admin/produk/' . $item['id']) ?>" method="post"
                          style="display: inline;"
                          onsubmit="return confirm('Yakin ingin menghapus produk <?= esc($item['nama']) ?>?');">
                        
                        <input type="hidden" name="_method" value="DELETE">
                        <?= csrf_field() ?>

                        <button type="submit" class="action-hapus" title="Hapus">
                            <i class="fas fa-trash"></i>
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
