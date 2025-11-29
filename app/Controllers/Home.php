<?php

namespace App\Controllers;

// WAJIB: Import Model Produk agar bisa digunakan
use App\Models\ProdukModel;

class Home extends BaseController
{
    public function index()
    {
        // 1. Inisialisasi Model
        // CI4 akan otomatis mencari file app/Models/ProdukModel.php
        $produkModel = new ProdukModel();

        // 2. Ambil data produk yang berstatus 'aktif' dari database
        // Data yang diambil akan berupa array of objects/arrays
        $data['produk'] = $produkModel->getProdukAktif();

        // 3. Kirim data ($data) ke View
        // View 'index' (app/Views/index.php) kini memiliki variabel $produk
        return view('index', $data);
    }
}
