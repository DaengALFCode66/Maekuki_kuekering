<?php namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model {
    protected $table = 'orders'; // Pastikan nama tabel pesanan benar
    protected $primaryKey = 'id';
    protected $useTimestamps = true; // Asumsikan Anda menggunakan created_at

    public function countTodayOrders() {
        // Ambil waktu awal hari ini (Y-m-d 00:00:00)
        $today = date('Y-m-d 00:00:00');
        
        // Menghitung pesanan yang dibuat mulai hari ini
        return $this->where('created_at >=', $today)->countAllResults();
    }
    
    public function countOrdersByStatus($status) {
        // Menghitung pesanan berdasarkan nilai kolom status
        return $this->where('status', $status)->countAllResults();
    }
    
    public function countCompletedOrdersInPeriod($period = 'month') {
        // Logika untuk periode 'bulan ini' (Contoh: Menghitung pesanan Selesai)
        
        $start_date = date('Y-m-01 00:00:00'); // Awal bulan ini
        
        return $this->where('status', 'Selesai')
                    ->where('updated_at >=', $start_date) // Asumsi status selesai diupdate pada updated_at
                    ->countAllResults();
    }
}