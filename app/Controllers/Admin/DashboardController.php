<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\PesananModel;
use App\Models\StokModel;

class DashboardController extends BaseController
{
    protected $produkModel;
    protected $pesananModel;
    protected $stokModel;

    public function __construct()
    {
        // Cek Login 
        if (!session()->get('isLoggedIn')) {
            header("Location: " . base_url('admin'));
            exit();
        }
        $this->produkModel = new ProdukModel();
        $this->pesananModel = new PesananModel();
        $this->stokModel = new StokModel();
    }

    public function index()
    {
        // Inisialisasi Batasan Waktu
        $startOfDay = date('Y-m-d 00:00:00');
        $endOfDay = date('Y-m-d 23:59:59');
        $startOfMonth = date('Y-m-01 00:00:00');
        $endOfMonth = date('Y-m-t 23:59:59'); // Hari terakhir bulan ini

        // --- 1. METRIK CEPAT (QUICK STATS) ---

        // A. Total Produk Aktif
        $totalProdukAktif = $this->produkModel->where('status', 'aktif')->countAllResults();

        // B. Pendapatan Bulan Ini (Total Harga dari Pesanan Selesai bulan ini)
        $pendapatanBulanIni = $this->pesananModel
            ->selectSum('total_harga')
            ->where('status', 'selesai')
            ->where('tanggal_pesanan >=', $startOfMonth)
            ->where('tanggal_pesanan <=', $endOfMonth)
            ->first()['total_harga'] ?? 0;

        // C. Pesanan Baru Hari Ini
        $pesananBaruHariIni = $this->pesananModel
            ->where('tanggal_pesanan >=', $startOfDay)
            ->where('tanggal_pesanan <=', $endOfDay)
            ->countAllResults();

        // D. Pesanan Siap Kirim (Asumsi: Status 'proses')
        $pesananSiapKirim = $this->pesananModel
            ->where('status', 'proses')
            ->countAllResults();


        // --- 2. DATA TABEL & NOTIFIKASI ---

        // E. Pesanan Hari Ini (Menggunakan method JOIN/GROUP_CONCAT)
        $pesananHariIni = $this->pesananModel->getAllPesananDetail(
            $search = null,
            $filterStatus = null,
            $sortOrder = 'normal',
            $limit = 10,
            $startDate = $startOfDay,
            $endDate = $endOfDay
        );

        $stokKritis = $this->stokModel
            ->select('produk.nama, stok.jumlah_stok')
            ->join('produk', 'produk.id = stok.id_produk')
            ->where('stok.jumlah_stok <', 3) // Menghitung 0, 1, dan 2
            // ->where('stok.jumlah_stok >', 0) // <-- HAPUS BARIS INI!
            ->findAll();

        // Hitung jumlah produk yang kritis
        $jumlahStokKritis = count($stokKritis);


        // --- KIRIM DATA KE VIEW ---
        $data = [
            'totalProdukAktif' => $totalProdukAktif,
            'pendapatanBulanIni' => $pendapatanBulanIni,
            'pesananBaruHariIni' => $pesananBaruHariIni,
            'pesananSiapKirim' => $pesananSiapKirim,
            'pesananHariIni' => $pesananHariIni, // Digunakan untuk tabel
            'jumlahStokKritis' => $jumlahStokKritis,         // Digunakan untuk notif
        ];

        return view('admin/dashboard/index', $data);
    }
}
