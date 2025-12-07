<?php

namespace App\Models;

use CodeIgniter\Model;

class PesananModel extends Model
{
    protected $table = 'pesanan'; // Tabel utama
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_user', 'tanggal_pesanan', 'total_harga', 'status'];
    protected $returnType = 'array';

    /**
     * Mengambil semua pesanan dengan detail pengguna, produk, dan kuantitas.
     * Menggunakan JOIN untuk menggabungkan data dari 4 tabel.
     */
    public function getAllPesananDetail($search = null, $sortBy = null)
    {
        // 1. Join tabel pesanan dengan user (mendapatkan nama, alamat, telepon)
        // 2. Join dengan detail_pesanan
        // 3. Join dengan produk (mendapatkan nama produk)

        $builder = $this->db->table('pesanan');
        $builder->select('
            pesanan.*,
            user.nama,
            user.no_telepon,
            user.alamat_pengiriman,
            GROUP_CONCAT(produk.nama ORDER BY detail_pesanan.id ASC SEPARATOR "|||") as nama_produk_list,
            GROUP_CONCAT(detail_pesanan.kuantitas ORDER BY detail_pesanan.id ASC SEPARATOR "|||") as kuantitas_list
        ');
        $builder->join('user', 'user.id = pesanan.id_user');
        $builder->join('detail_pesanan', 'detail_pesanan.id_pesanan = pesanan.id');
        $builder->join('produk', 'produk.id = detail_pesanan.id_produk');

        $builder->groupBy('pesanan.id'); // Kelompokkan berdasarkan ID Pesanan
        $builder->orderBy('pesanan.tanggal_pesanan', 'DESC');

        // --- FITUR SEARCH (CARI BERDASARKAN NAMA PELANGGAN) ---
        if ($search) {
            // Cari di kolom nama user
            $builder->like('user.nama', $search);
        }

        $builder->groupBy('pesanan.id');

        // --- FITUR SORT (URUTKAN BERDASARKAN STATUS) ---
        if ($sortBy && in_array($sortBy, ['proses', 'batal', 'selesai'])) {
            // Jika ada kriteria sort, filter berdasarkan status tersebut
            $builder->where('pesanan.status', $sortBy);
        }

        // Default sort: terbaru dulu, lalu urutkan status
        $builder->orderBy('pesanan.tanggal_pesanan', 'DESC');
        $builder->orderBy('pesanan.status', 'ASC');

        return $builder->get()->getResultArray();
    }

    // app/Models/PesananModel.php (Tambahkan method baru)

    public function getPesananById($id)
    {
        // Mengambil data pesanan utama dan detail user
        $pesanan = $this->select('pesanan.*, user.nama, user.no_telepon, user.alamat_pengiriman')
            ->join('user', 'user.id = pesanan.id_user')
            ->where('pesanan.id', $id)
            ->first();

        if ($pesanan) {
            // Mengambil detail produk untuk pesanan ini
            $detailModel = new \App\Models\DetailPesananModel();
            $produkModel = new \App\Models\ProdukModel();

            $details = $detailModel->where('id_pesanan', $id)->findAll();

            // Memuat nama produk untuk setiap detail
            foreach ($details as $key => $detail) {
                $product = $produkModel->find($detail['id_produk']);
                $details[$key]['nama_produk'] = $product['nama'] ?? 'Produk Dihapus';
            }

            $pesanan['details'] = $details;
        }

        return $pesanan;
    }
}
