<?php namespace App\Models;

use CodeIgniter\Model;

class DetailPesananModel extends Model
{
    protected $table = 'detail_pesanan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_pesanan', 'id_produk', 'kuantitas', 'harga_saat_pesan'];
    protected $returnType = 'array';
}