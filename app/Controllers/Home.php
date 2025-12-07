<?php namespace App\Controllers;

use App\Models\ProdukModel; // WAJIB: Import Model Produk agar bisa digunakan

class Home extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        
        // 1. Definisikan jumlah item per halaman (4x2 = 8 item)
        $perPage = 8; 

        // 2. Ambil data produk yang aktif menggunakan Query Builder
        $produkBuilder = $produkModel->where('status', 'aktif');
        
        // 3. Gunakan paginate() untuk membatasi hasil
        $data['produk'] = $produkBuilder->paginate($perPage);

        // 4. Kirim objek Pager ke View (penting untuk tautan halaman "1, 2, ...")
        $data['pager'] = $produkModel->pager; 
        
        // 5. Kirim data ke View 'index'
        return view('index', $data);
    }
}