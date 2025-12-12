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
    public function getAllPesananDetail($search = null, $filterStatus = null, $sortOrder = 'normal', $limit = null, $startDate = null, $endDate = null)
    {
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
        $builder->join('produk', 'produk.id = detail_pesanan.id_produk', 'left');

        // 🔑 KUNCI PERBAIKAN: LOGIKA FILTER TANGGAL HARI INI
        if ($startDate) {
            // Filter tanggal lebih besar atau sama dengan (>=) tanggal mulai (00:00:00)
            $builder->where('pesanan.tanggal_pesanan >=', $startDate);
        }
        if ($endDate) {
            // Filter tanggal lebih kecil atau sama dengan (<=) tanggal akhir (23:59:59)
            $builder->where('pesanan.tanggal_pesanan <=', $endDate);
        }
        
        // --- FILTERING ---
        if ($search) {
            $builder->like('user.nama', $search);
            $builder->orLike('user.no_telepon', $search); // Cari juga di no_telepon user
        }

        // KUNCI: FILTER STATUS (Mengganti nama parameter lama $sortBy menjadi $filterStatus)
        if ($filterStatus && in_array($filterStatus, ['proses', 'batal', 'selesai'])) {
            $builder->where('pesanan.status', $filterStatus);
        }

        $builder->groupBy('pesanan.id');

        // --- SORTING HARGA (FITUR BARU) ---
        if ($sortOrder === 'asc') {
            $builder->orderBy('pesanan.total_harga', 'ASC'); // Termurah
        } elseif ($sortOrder === 'desc') {
            $builder->orderBy('pesanan.total_harga', 'DESC'); // Termahal
        } else {
            // Urutan default (Normal): Berdasarkan Tanggal Terbaru
            $builder->orderBy('pesanan.tanggal_pesanan', 'DESC');
        }

        // Urutan sekunder (agar pesanan dengan status sama tertata rapi)
        // Order by Status harus diletakkan setelah order utama (harga/tanggal)
        if ($sortOrder === 'normal') {
            $builder->orderBy('pesanan.status', 'ASC');
        }

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
