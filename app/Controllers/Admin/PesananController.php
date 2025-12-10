<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PesananModel;
use App\Models\ProdukModel; // <-- TAMBAHKAN INI
use App\Models\UserModel;   // <-- TA

class pesananController extends BaseController
{
    protected $pesananModel;

    public function __construct()
    {
        // Cek Login
        if (!session()->get('isLoggedIn')) {
            header("Location: " . base_url('admin'));
            exit();
        }
        $this->pesananModel = new PesananModel();
    }

    // LIST SEMUA PESANAN (URL: /admin/pesanan)
    public function index()
    {
        // Tangkap input dari URL (GET Request)
        $searchQuery = $this->request->getGet('search');

        // 1. Filter Status (diganti namanya dari 'sort' menjadi 'filter_status' di URL)
        $filterStatus = $this->request->getGet('filter_status');

        // 2. Sorting Harga (menggunakan 'sort' di URL, seperti yang dibuat di link header tabel)
        $sortOrder = $this->request->getGet('sort');

        // --- KUNCI: Pemanggilan Model Diperbarui ---
        // Model harus diupdate agar menerima parameter sorting harga ($sortOrder)
        $data['pesanan'] = $this->pesananModel->getAllPesananDetail(
            $searchQuery,
            $filterStatus, // Parameter 2: Filter Status
            $sortOrder     // Parameter 3: Sorting Harga (BARU)
        );

        // Kirim kembali nilai yang dicari/diurutkan ke View
        $data['searchQuery'] = $searchQuery;
        $data['sortStatus'] = $filterStatus; // Kirim nilai filter status kembali ke View
        $data['sortOrder'] = $sortOrder;     // Kirim nilai sort harga kembali ke View

        // Daftar Status yang Tersedia (untuk dropdown/data di View)
        $data['statusOptions'] = [
            'proses' => 'Proses',
            'batal' => 'Batal',
            'selesai' => 'Selesai',
        ];

        return view('admin/pesanan/index', $data);
    }

    // UPDATE STATUS PESANAN
    public function update($id = null)
    {
        $db = $this->pesananModel->db; // Ambil koneksi DB dari Model
        $db->transBegin();

        try {
            // 1. Ambil data dari form
            $input = $this->request->getPost();

            // 2. UPDATE DATA USER
            $userModel = new UserModel();
            $userModel->update($input['id_user'], [
                'nama' => $input['nama'],
                'no_telepon' => $input['no_telepon'],
                'alamat_pengiriman' => $input['alamat_pengiriman']
            ]);

            // 3. HAPUS DAN MASUKKAN ULANG DETAIL PESANAN

            $detailModel = new \App\Models\DetailPesananModel();
            $produkModel = new ProdukModel();

            // Hapus detail lama
            $detailModel->where('id_pesanan', $id)->delete();

            $batchDetail = [];
            $totalPesananBaru = 0;

            foreach ($input['produk_id'] as $key => $produkId) {
                $qty = (int) $input['kuantitas'][$key];

                if ($qty > 0) {
                    $produk = $produkModel->find($produkId);

                    if (!$produk) throw new \Exception("Produk ID {$produkId} tidak valid.");

                    $harga_satuan = $produk['harga'];
                    $totalPesananBaru += $harga_satuan * $qty;

                    $batchDetail[] = [
                        'id_pesanan' => $id,
                        'id_produk' => $produkId,
                        'kuantitas' => $qty,
                        'harga_saat_pesan' => $harga_satuan // Mengunci harga saat ini
                    ];
                }
            }

            // Masukkan detail baru
            if (!empty($batchDetail)) {
                $detailModel->insertBatch($batchDetail);
            }

            // 4. UPDATE PESANAN UTAMA (Status dan Total Harga)
            $this->pesananModel->update($id, [
                'status' => $input['status'],
                'total_harga' => $totalPesananBaru // Update total harga
            ]);

            $db->transCommit();
            return redirect()->to('/admin/pesanan')->with('success', 'Pesanan berhasil diupdate.');
        } catch (\Exception $e) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal update pesanan: ' . $e->getMessage());
        }
    }

    public function edit($id = null)
    {
        $data['pesanan'] = $this->pesananModel->getPesananById($id);
        $data['semuaProduk'] = (new ProdukModel())->findAll(); // Ambil semua produk untuk dropdown
        $data['statusOptions'] = ['proses', 'batal', 'selesai']; // Untuk status

        if (!$data['pesanan']) {
            session()->setFlashdata('error', 'Pesanan tidak ditemukan.');
            return redirect()->to('/admin/pesanan');
        }

        return view('admin/pesanan/edit', $data);
    }

    public function updateStatus($id = null)
    {
        // Pastikan hanya POST request yang diterima
        if (!$this->request->is('post') || is_null($id)) {
            return redirect()->back();
        }

        // Ambil nilai status dari input form (yang diberi nama 'status_baru' di view index)
        $statusBaru = $this->request->getPost('status_baru');
        
        if (is_null($statusBaru)) {
            return redirect()->back()->with('error', 'Status baru tidak ditemukan dalam permintaan.');
        }

        try {
            // 1. Ambil data pesanan lama (Opsional, untuk validasi)
            // $pesananLama = $this->pesananModel->find($id);

            // 2. Lakukan update status saja
            $this->pesananModel->update($id, [
                'status' => $statusBaru,
            ]);

            return redirect()->to('/admin/pesanan')->with('success', 'Status pesanan #' . $id . ' berhasil diubah menjadi ' . ucfirst($statusBaru) . '.');

        } catch (\Exception $e) {
            // Tangani error database
            return redirect()->back()->with('error', 'Gagal update status: ' . $e->getMessage());
        }
    }

    // app/Controllers/Admin/PesananController.php (Tambahkan fungsi ini)

    public function delete($id = null)
    {
        try {
            // Hapus pesanan. Karena ada ON DELETE CASCADE pada fk_detail_pesanan_pesanan,
            // semua detail pesanan akan otomatis terhapus.
            $this->pesananModel->delete($id);

            return redirect()->to('/admin/pesanan')->with('success', 'Pesanan #' . $id . ' berhasil dihapus.');
        } catch (\Exception $e) {
            // FK constraint mungkin gagal (misal jika ada entri di tabel lain yang merujuk)
            return redirect()->back()->with('error', 'Gagal menghapus pesanan. Error: ' . $e->getMessage());
        }
    }
}
