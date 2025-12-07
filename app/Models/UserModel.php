<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user'; 
    protected $primaryKey = 'id';
    
    // HATI-HATI: 'created_at' HARUS ada di sini.
    // Tambahkan 'created_at' karena skema Anda memilikinya, dan CI4 perlu mengelolanya.
    protected $allowedFields = ['nama', 'no_telepon', 'alamat_pengiriman', 'created_at']; 
    
    protected $returnType = 'array';
    
    // PENTING: Set useTimestamps ke FALSE karena Anda tidak punya updated_at.
    // Jika Anda ingin CI4 mengelola created_at, biarkan TRUE, tetapi pastikan updated_at diabaikan.
    protected $useTimestamps = true; 
    
    protected $createdField  = 'created_at';
    protected $updatedField  = null; // <-- KARENA TIDAK ADA updated_at di DB, set ke null

    // =======================================================
    // BARIS INI YANG ANDA TAMBAHKAN (untuk menjamin Foreign Key)
    // =======================================================
    public function insertAndGetId(array $data)
    {
        // 1. Menggunakan Query Builder langsung dari DB untuk INSERT
        $this->db->table($this->table)->insert($data); 
        
        // 2. Mengambil ID yang baru saja dimasukkan (PALING AMAN dalam transaksi)
        return $this->db->insertID(); 
    }
}

