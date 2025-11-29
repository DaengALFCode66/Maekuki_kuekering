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
        // 1. Ambil semua data produk
        $produkList = $this->produkModel->findAll(); // <-- GUNAKAN NAMA INI

        // 2. Ambil semua data stok
        $stokList = $this->stokModel->findAll();
        $stokMap = [];
        foreach ($stokList as $stok) {
            // Gunakan id_produk sebagai kunci (key)
            $stokMap[$stok['id_produk']] = $stok['jumlah_stok'];
        }

        // 3. Gabungkan data
        $dataProdukGabungan = [];
        foreach ($produkList as $produk) { // <-- SEKARANG INI BENAR
            $id = $produk['id'];

            // Tambahkan jumlah_stok ke array produk
            $produk['jumlah_stok'] = $stokMap[$id] ?? 0; // Default 0 jika stok tidak ditemukan

            $dataProdukGabungan[] = $produk;
        }

        $data['produk'] = $dataProdukGabungan;

        return view('admin/produk/index', $data);
    }

    // BUAT PRODUK BARU (URL: /admin/produk/new)
    public function new()
    {
        // Tampilkan form tambah
        return view('admin/produk/create');
    }

    // SIMPAN PRODUK BARU
    public function create()
    {
        // Logika validasi dan penyimpanan

        // Ambil semua data dari form POST
        $data_baru = [
            'nama'       => $this->request->getPost('nama'),
            'deskripsi'  => $this->request->getPost('deskripsi'),
            'harga'      => $this->request->getPost('harga'),       // <-- DITAMBAHKAN
            'url_gambar' => $this->request->getPost('url_gambar'),  // <-- DITAMBAHKAN
            'status'     => $this->request->getPost('status'),
        ];

        // Simpan data ke database melalui Model
        $this->produkModel->save($data_baru);

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil ditambahkan.');
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
    public function update($id = null)
    {
        // Cek apakah data form diterima dengan benar
        $data_update = [
            'nama' => $this->request->getPost('nama'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'harga' => $this->request->getPost('harga'), // FOKUS DI SINI
            'status' => $this->request->getPost('status'),
            'url_gambar' => $this->request->getPost('url_gambar'),
        ];

        // DEBUGGING SEMENTARA: Hapus baris di bawah ini setelah tes
        // die(print_r($data_update, true)); 

        // Panggil Model untuk update
        $this->produkModel->update($id, $data_update);

        // --- 2. PROSES UPDATE TABEL STOK ---
        $newStok = $this->request->getPost('jumlah_stok');
        $currentDateTime = date('Y-m-d H:i:s');

        // Cek apakah entri stok sudah ada
        $stokEntry = $this->stokModel->where('id_produk', $id)->first();

        if ($stokEntry) {
            // Jika sudah ada, lakukan UPDATE
            $this->stokModel->update($stokEntry['id'], [
                'jumlah_stok' => $newStok,
                'tanggal_update' => $currentDateTime
            ]);
        } else {
            // Jika belum ada, lakukan INSERT (entri baru)
            $this->stokModel->insert([
                'id_produk' => $id,
                'jumlah_stok' => $newStok,
                'tanggal_update' => $currentDateTime
            ]);
        }

        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil diupdate.');
    }

    // HAPUS PRODUK
    public function delete($id = null)
    {
        $this->produkModel->delete($id);
        return redirect()->to('/admin/produk')->with('success', 'Produk berhasil dihapus.');
    }
}
