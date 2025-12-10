<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    // Pastikan nama tabel adalah 'produk' (sesuai yang terlihat di phpMyAdmin Anda)
    protected $table      = 'produk';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    // Definisikan kolom yang boleh diisi/diupdate.
    // Nama-nama kolom harus sesuai dengan database Anda: id, nama, deskripsi, harga, url_gambar, status
    protected $allowedFields = ['nama', 'deskripsi', 'harga', 'url_gambar', 'status'];

    // Fungsi untuk mengambil semua produk yang aktif
    public function getProdukAktif()
    {
        return $this->where('status', 'aktif')
            ->findAll();
    }
    // app/Models/ProdukModel.php (Tambahkan method ini di dalam class ProdukModel)

    public function getProdukBySearch($search = null,$sortOrder = 'normal')
    {
        $builder = $this->builder(); // Membangun query dari model

        // Jika ada query pencarian, tambahkan kondisi WHERE
        if ($search) {
            $builder->like('nama', $search); // Cari di kolom 'nama' produk
        }

        // Gabungkan dengan data Stok (untuk kolom yang kita tampilkan di tabel)
        $builder->select('produk.*, stok.jumlah_stok')
            ->join('stok', 'stok.id_produk = produk.id', 'left'); // LEFT JOIN agar produk tanpa stok tetap tampil

        if ($sortOrder === 'stok_asc') {
        // Stok terendah ke tertinggi
        $builder->orderBy('stok.jumlah_stok', 'ASC'); 
    } elseif ($sortOrder === 'stok_desc') {
        // Stok tertinggi ke terendah
        $builder->orderBy('stok.jumlah_stok', 'DESC'); 
    } else {
        // Urutan default: Berdasarkan ID Produk Terbaru
        $builder->orderBy('produk.id', 'DESC');
    }

        // Urutkan berdasarkan ID terbaru
        $builder->orderBy('produk.id', 'ASC');

        return $builder->get()->getResultArray(); 
    }
}
