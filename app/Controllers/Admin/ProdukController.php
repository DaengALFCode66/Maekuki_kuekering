<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\StokModel;

// Perlu Login untuk mengakses semua fungsi di controller ini
class ProdukController extends BaseController
{
    protected $produkModel;
    protected $stokModel;

    public function __construct()
    {
        // Cek Login (Bisa dipindah ke AdminController jika dibutuhkan)
        if (!session()->get('isLoggedIn')) {
            header("Location: " . base_url('admin'));
            exit();
        }
        $this->produkModel = new ProdukModel();
        $this->stokModel = new StokModel();
    }

    // LIST SEMUA PRODUK (URL: /admin/produk)
    public function index()
    {
        // 1. Tangkap input dari URL (GET Request)
        $searchQuery = $this->request->getGet('search');

        // 2. Ambil data produk, menerapkan filter pencarian
        // Catatan: getProdukBySearch sudah join dengan tabel stok
        $data['produk'] = $this->produkModel->getProdukBySearch($searchQuery);

        // 3. Kirim kembali nilai yang dicari ke View untuk mengisi form
        $data['searchQuery'] = $searchQuery;

        return view('admin/produk/index', $data);
    }

    // BUAT PRODUK BARU (URL: /admin/produk/new)
    public function new()
    {
        // Tampilkan form tambah
        return view('admin/produk/create');
    }

    // SIMPAN PRODUK BARU
    // app/Controllers/Admin/ProdukController.php

    public function create()
    {
        $fileGambar = $this->request->getFile('gambar');
        $newStok = $this->request->getPost('jumlah_stok');
        $currentDateTime = date('Y-m-d H:i:s');
        $db = $this->produkModel->db;
        $db->transBegin(); // Mulai Transaksi

        try {
            $namaGambarBaru = null;

            // 1. LOGIKA FILE UPLOAD
            if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
                $namaGambarBaru = $fileGambar->getRandomName();
                // Pindahkan file ke direktori target (public/assets/Asset)
                $fileGambar->move(ROOTPATH . 'public/assets/Asset', $namaGambarBaru);
            }

            // 2. SIMPAN DATA PRODUK UTAMA
            $data_baru = [
                'nama'       => $this->request->getPost('nama'),
                'deskripsi'  => $this->request->getPost('deskripsi'),
                'harga'      => $this->request->getPost('harga'),
                'status'     => $this->request->getPost('status'),
                'url_gambar' => $namaGambarBaru, // Simpan nama file
            ];

            // Simpan data produk dan dapatkan ID produk yang baru dibuat
            $this->produkModel->insert($data_baru);
            $newProductId = $this->produkModel->getInsertID();

            // 3. SIMPAN DATA STOK
            if ($newProductId && $newStok >= 0) {
                $this->stokModel->insert([
                    'id_produk'      => $newProductId,
                    'jumlah_stok'    => $newStok,
                    'tanggal_update' => $currentDateTime,
                ]);
            }

            $db->transCommit();
            return redirect()->to('/admin/produk')->with('success', 'Produk dan stok awal berhasil ditambahkan.');
        } catch (\Exception $e) {
            $db->transRollback();
            // Hapus file yang sudah diupload jika transaksi gagal
            if ($namaGambarBaru && file_exists(ROOTPATH . 'public/assets/Asset/' . $namaGambarBaru)) {
                unlink(ROOTPATH . 'public/assets/Asset/' . $namaGambarBaru);
            }
            return redirect()->back()->with('error', 'Gagal menambahkan produk: ' . $e->getMessage());
        }
    }



    // EDIT PRODUK (URL: /admin/produk/edit/ID)
    public function edit($id = null)
    {
        $data['produk'] = $this->produkModel->find($id);

        if (!$data['produk']) {
            // Jika produk tidak ditemukan, kirim pesan error.
            session()->setFlashdata('error', 'Produk tidak ditemukan!');
            return redirect()->to('/admin/produk');
        }

        // Ambil data stok yang sesuai dengan id_produk ini
        $stokData = $this->stokModel->where('id_produk', $id)->first();

        // Gabungkan data stok ke dalam array produk
        $data['produk']['jumlah_stok'] = $stokData ? $stokData['jumlah_stok'] : 0;

        // Cek data yang dikirim ke view (TEMPORARY CHECK)
        // die(print_r($data['produk'], true)); // <-- Hapus tanda komentar ini untuk tes

        return view('admin/produk/edit', $data);
    }

    // UPDATE PRODUK
    // app/Controllers/Admin/ProdukController.php

    public function update($id = null)
    {
        $fileGambar = $this->request->getFile('gambar');
        $gambarLama = $this->request->getPost('gambar_lama');

        $data_update = [
            'nama'       => $this->request->getPost('nama'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'harga'      => $this->request->getPost('harga'),
            'status'     => $this->request->getPost('status'),
            // url_gambar akan ditentukan di bawah
        ];

        // --- LOGIKA FILE UPLOAD ---
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {

            // 1. Validasi File (CI4 punya validasi bawaan yang kuat, tapi kita lewati untuk simplifikasi)

            // 2. Tentukan nama file baru yang unik
            $namaGambarBaru = $fileGambar->getRandomName();

            // 3. Pindahkan file ke direktori target
            // Direktori Target: ROOT_PROYEK/assets/Asset/
            $fileGambar->move(ROOTPATH . 'public/assets/Asset', $namaGambarBaru);

            // 4. Hapus gambar lama jika ada
            if ($gambarLama && file_exists(ROOTPATH . 'public/assets/Asset/' . $gambarLama)) {
                unlink(ROOTPATH . 'public/assets/Asset/' . $gambarLama);
            }

            // Simpan nama file baru ke database
            $data_update['url_gambar'] = $namaGambarBaru;
        } else {
            // Jika tidak ada file baru diupload, gunakan nama file yang lama
            $data_update['url_gambar'] = $gambarLama;
        }

        // --- Lanjutkan Proses Update ---

        // Pastikan Model mengizinkan kolom 'url_gambar'
        $this->produkModel->update($id, $data_update);

        // Update Stok
        // ... (Logika update stok Anda tetap dipertahankan) ...

        $newStok = $this->request->getPost('jumlah_stok');
        $currentDateTime = date('Y-m-d H:i:s');

        // Cek apakah entri stok sudah ada
        $stokEntry = $this->stokModel->where('id_produk', $id)->first();

        if ($stokEntry) {
            $this->stokModel->update($stokEntry['id'], [
                'jumlah_stok' => $newStok,
                'tanggal_update' => $currentDateTime
            ]);
        } else {
            $this->stokModel->insert([
                'id_produk' => $id,
                'jumlah_stok' => $newStok,
                'tanggal_update' => $currentDateTime
            ]);
        }

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil diupdate dan foto telah diganti.');
    }
    public function delete($id = null)
{
    try {
        $this->produkModel->delete($id);
        return redirect()->to('/admin/produk')->with('success', 'produk#' . $id . ' berhasil dihapus.');
    } catch (\Exception $e) {
        // FK constraint mungkin gagal (misal jika ada entri di tabel lain yang merujuk)
        return redirect()->back()->with('error', 'Gagal menghapus pesanan. Error: ' . $e->getMessage());
    }
}
    public function updateStatus($id)
{
    $status = $this->request->getPost('status');

    $model = new ProdukModel();
    $model->update($id, ['status' => $status]);

    return redirect()->back()->with('message', 'Status berhasil diperbarui');
}
}   
    
