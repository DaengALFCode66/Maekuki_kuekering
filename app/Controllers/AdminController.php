<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel; 
use App\Models\OrderModel; 

class AdminController extends BaseController
{
    protected $productModel;
    protected $orderModel;

    public function __construct()
    {
        // Inisialisasi Model di constructor
        // Jika Model tidak ada, beri nilai null untuk menghindari Fatal Error
        try {
            $this->productModel = new ProductModel();
            $this->orderModel = new OrderModel();
        } catch (\Throwable $th) {
            $this->productModel = null;
            $this->orderModel = null;
            // Penting: Pastikan Anda telah mengaktifkan database di CI4 dan membuat Model file
        }
    }

    public function dashboard()
    {
        // ----------------------------------------------------
        // PASTIKAN SEMUA VARIABEL PHP DIDEFINISIKAN
        // ----------------------------------------------------
        $totalProdukAktif      = 0;
        $pesananHariIni        = 0;
        $pesananMenungguBayar  = 0;
        $pesananDiproses       = 0;
        $pesananSelesaiPeriode = 0;
        
        // HANYA COBA AMBIL DATA JIKA MODEL BERHASIL DI INISIALISASI
        if ($this->productModel && $this->orderModel) {
            try {
                // 1. Ambil Data Metrik
                $totalProdukAktif      = $this->productModel->countActiveProducts();
                $pesananHariIni        = $this->orderModel->countTodayOrders();
    
                // 2. Status Pesanan
                $pesananMenungguBayar  = $this->orderModel->countOrdersByStatus('Menunggu Pembayaran');
                $pesananDiproses       = $this->orderModel->countOrdersByStatus('Diproses');
                $pesananSelesaiPeriode = $this->orderModel->countCompletedOrdersInPeriod('bulan ini');

            } catch (\Throwable $th) {
                // Jika terjadi error saat query, variabel tetap 0 (nilai default)
            }
        }

        // ----------------------------------------------------
        // KIRIM DATA KE VIEW (DIJAMIN TIDAK ADA UNDEFINED VARIABLE)
        // ----------------------------------------------------
        $data = [
            'menu' => 'dashboard', // <<< Tambahkan ini
            'totalProdukAktif'      => $totalProdukAktif,
            'pesananHariIni'        => $pesananHariIni,
            'pesananMenungguBayar'  => $pesananMenungguBayar,
            'pesananDiproses'       => $pesananDiproses,
            'pesananSelesaiPeriode' => $pesananSelesaiPeriode,
            'currentAdminEmail'     => 'admin@kuekering.com' 
        ];

        return view('admin/dashboard', $data); 
    }
}