<?php namespace App\Models;

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
}