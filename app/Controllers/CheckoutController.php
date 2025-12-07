<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use App\Models\UserModel;

class CheckoutController extends BaseController
{
    protected $produkModel;
    protected $pesananModel;
    protected $detailPesananModel;
    protected $userModel;

    protected $db; // Diinisialisasi di construct

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->pesananModel = new PesananModel();
        $this->detailPesananModel = new DetailPesananModel();
        $this->userModel = new UserModel();

        // PENTING: Inisialisasi DB di construct untuk runtime
        $this->db = \Config\Database::connect();

        helper('form');
    }

    public function process()
    {
        // Pengecekan Metode dihilangkan untuk mengatasi masalah CORS/Method Detection yang sensitif

        // Ambil data JSON dari body request
        $json = $this->request->getJSON();

        if (empty($json->user) || empty($json->items)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak lengkap.']);
        }

        // Mendeklarasikan data yang diterima
        $userData = $json->user;
        $items = $json->items;

        // KOREKSI: Gunakan objek db dari salah satu model untuk transaksi
        $db = $this->userModel->db; // <-- Ambil objek DB dari Model yang sudah terhubung

        $this->db->transBegin(); // Mulai transaksi database

        try {
            // --- 1. PROSES USER (Cek dan Simpan) ---

            // Cek apakah user sudah ada berdasarkan kunci 'phone' dari JS
            $existingUser = $this->userModel->where('no_telepon', $userData->phone)->first();

            if ($existingUser) {
                // Jika sudah ada, update data user yang sudah ada
                $userId = $existingUser['id'];
                $this->userModel->update($userId, [
                    'nama' => $userData->name,       // JS 'name' -> DB 'nama'
                    'alamat_pengiriman' => $userData->address // JS 'address' -> DB 'alamat_pengiriman'
                ]);
            } else {
                // Jika user baru, masukkan data baru
                $userDataArray = [ // Buat array data user
                    'nama' => $userData->name,
                    'no_telepon' => $userData->phone,
                    'alamat_pengiriman' => $userData->address
                ];

                // Panggil method baru untuk menjamin pengambilan ID
                $userId = $this->userModel->insertAndGetId($userDataArray);

                // Pastikan ID berhasil diambil sebelum melanjutkan
                if (!$userId) {
                    throw new \Exception("Gagal mendapatkan ID User baru.");
                }
            }

            // --- 2. PROSES PESANAN (Tabel pesanan) ---

            $this->pesananModel->insert([
                'id_user' => $userId,
                'total_harga' => 0.00 // Di-update oleh DB Trigger
            ]);
            $pesananId = $this->pesananModel->getInsertID();

            // --- 3. PROSES DETAIL PESANAN (Price Locking) ---

            $batchDetail = [];

            foreach ($items as $item) {
                // Ambil harga saat ini dari database untuk penguncian harga
                $currentProductData = $this->produkModel->find($item->id);

                if (!$currentProductData) {
                    throw new \Exception("Produk ID {$item->id} tidak ditemukan di database.");
                }

                $batchDetail[] = [
                    'id_pesanan' => $pesananId,
                    'id_produk' => $item->id,
                    'kuantitas' => $item->qty,
                    'harga_saat_pesan' => $currentProductData['harga'] // KUNCI HARGA
                ];
            }

            // Masukkan semua detail pesanan
            $this->detailPesananModel->insertBatch($batchDetail);

            $this->db->transCommit(); // Commit transaksi

            // Beri respon sukses ke Frontend
            return $this->response->setJSON(['status' => 'success', 'message' => 'Pesanan berhasil diproses.', 'id_pesanan' => $pesananId]);
        } catch (\Exception $e) {
            $this->db->transRollback(); // Rollback jika ada error

            // Mengembalikan pesan error penuh untuk debugging
            return $this->response->setJSON(['status' => 'error', 'message' => 'Transaksi gagal: ' . $e->getMessage()]);
        }
    }
}
