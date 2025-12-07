<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
<h1>Manajemen Pesanan</h1>

<div style="margin-bottom: 20px; display: flex; gap: 15px; align-items: center;">
    <form action="<?= base_url('admin/pesanan') ?>" method="get" style="display: flex; gap: 10px;">
        <input type="text" name="search" placeholder="Cari berdasarkan nama pelanggan..."
            value="<?= esc($searchQuery ?? '') ?>"
            style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 300px;">

        <button type="submit" style="background-color: #8B4513; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">
            Cari
        </button>
        <a href="<?= base_url('admin/pesanan') ?>" style="text-decoration: none; padding: 8px 15px; border: 1px solid #ccc; border-radius: 4px; color: #333;">Reset</a>
    </form>

    <form action="<?= base_url('admin/pesanan') ?>" method="get" style="display: flex; gap: 10px;">
        <input type="hidden" name="search" value="<?= esc($searchQuery ?? '') ?>">

        <label for="sort-status" style="font-weight: bold;">Filter Status:</label>
        <select name="sort" onchange="this.form.submit()" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">-- Tampilkan Semua --</option>
            <?php foreach (['proses', 'selesai', 'batal'] as $statusKey): ?>
                <option value="<?= $statusKey ?>"
                    <?= ($sortStatus == $statusKey) ? 'selected' : '' ?>>
                    <?= ucfirst($statusKey) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="content-body">
    <?php if (empty($pesanan)): ?>
        <p>Belum ada pesanan terdaftar.</p>
    <?php else: ?>
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px; font-size: 0.95rem;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">No</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Pelanggan</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Telepon / Alamat</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: left;">Detail Pesanan</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: right;">Total Harga</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Status</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Tgl. Pesanan</th>
                    <th style="padding: 10px; border: 1px solid #ddd; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($pesanan as $item): ?>
                    <tr>
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;"><?= $no++ ?></td>

                        <td style="padding: 10px; border: 1px solid #ddd;">

                            <a href="<?= base_url('admin/pesanan/' . $item['id'] . '/edit') ?>" style="color: #8B4513; text-decoration: none;">
                                <strong><?= esc($item['nama']) ?></strong>
                            </a>

                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd; font-size: 0.85rem;">
                            Telp: <?= esc($item['no_telepon']) ?><br>
                            Alamat: <?= esc($item['alamat_pengiriman']) ?>
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <?php
                            // Pisahkan nama produk dan kuantitas
                            $namaProduk = explode('|||', $item['nama_produk_list']);
                            $kuantitas = explode('|||', $item['kuantitas_list']);

                            echo "<ul>";
                            for ($i = 0; $i < count($namaProduk); $i++) {
                                echo "<li>" . esc($kuantitas[$i]) . "x " . esc($namaProduk[$i]) . "</li>";
                            }
                            echo "</ul>";
                            ?>
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd; text-align: right;">
                            <strong>Rp <?= number_format($item['total_harga'], 2, ',', '.') ?></strong>
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            <form action="<?= base_url('admin/pesanan/update/' . $item['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <select name="status_baru" onchange="this.form.submit()" style="padding: 5px; border-radius: 4px;">
                                    <?php foreach ($statusOptions as $key => $label): ?>
                                        <option value="<?= $key ?>" <?= ($item['status'] === $key) ? 'selected' : '' ?>>
                                            <?= ucfirst($label) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </form>
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            <?= date('d M Y H:i', strtotime($item['tanggal_pesanan'])) ?>
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">

                            <a href="<?= base_url('admin/pesanan/' . $item['id'] . '/edit') ?>"
                                style="color: blue; text-decoration: none; margin-right: 8px;">
                                Edit
                            </a>

                            <form action="<?= base_url('admin/pesanan/' . $item['id']) ?>" method="post" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pesanan #<?= esc($item['id']) ?>? Ini akan menghapus semua detail.');">
                                <input type="hidden" name="_method" value="DELETE">
                                <?= csrf_field() ?>
                                <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">
                                    Hapus
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