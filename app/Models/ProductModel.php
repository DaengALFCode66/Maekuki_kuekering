<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model {
    protected $table = 'products'; // Pastikan nama tabel benar

    public function countActiveProducts() {
        // Menghitung baris di mana kolom 'is_active' bernilai 1
        return $this->where('is_active', 1)->countAllResults();
    }
}