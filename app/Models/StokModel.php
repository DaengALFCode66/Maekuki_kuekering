<?php namespace App\Models;

use CodeIgniter\Model;

class StokModel extends Model
{
    protected $table = 'stok'; // Sesuai nama tabel Anda
    protected $primaryKey = 'id';
    
    // Kolom yang diizinkan untuk diubah: id_produk, jumlah_stok, tanggal_update
    protected $allowedFields = ['id_produk', 'jumlah_stok', 'tanggal_update']; 
    protected $returnType = 'array';
    
    // Opsional: Atur agar tanggal_update otomatis terisi
    protected $useTimestamps = false; // Kita akan set manual di controller
}