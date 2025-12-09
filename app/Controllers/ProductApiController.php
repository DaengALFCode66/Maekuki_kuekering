<?php namespace App\Controllers;

use App\Models\ProdukModel; // Gunakan Model yang sudah Anda miliki (ProdukModel)
use CodeIgniter\Controller;

class ProductApiController extends Controller
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        helper(['form', 'url']); // Pastikan helper diperlukan
    }

    public function index()
    {
        // 1. Ambil Parameter dari Request
        $keyword = $this->request->getGet('keyword');
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 8; // Atur jumlah produk per halaman

        // 2. Terapkan Filter Keyword
        if ($keyword) {
            // Filter LIKE pada kolom 'nama'
            $this->produkModel->like('nama', $keyword, 'both');
        }
        
        // 3. Ambil Data dengan Pagination
        // Jika Anda menggunakan CI4 Pagination:
        $produk = $this->produkModel->paginate($perPage, 'default', $page);
        $pager = $this->produkModel->pager;

        // 4. Muat View Katalog Produk (Hanya fragmen)
        // KUNCI: Render ulang hanya bagian HTML katalog yang dibutuhkan (fragment)
        
        // Asumsi Anda memiliki view fragment yang menangani looping produk, misalnya 'katalog_fragment.php'
        // Jika tidak, Anda harus render ulang index.php dan mengekstrak fragmennya (seperti yang dilakukan fungsi loadKatalogPage Anda)
        
        // --- Karena AJAX Anda mengambil seluruh HTML index.php, kita harus mengembalikan index.php ---
        // (Ini adalah cara kerja loadKatalogPage Anda saat ini)

        $data = [
            'produk' => $produk, // Data produk yang sudah difilter/dipaginasi
            'pager' => $pager,
            'title' => 'Katalog Produk',
            // Pastikan data lain yang dibutuhkan oleh index.php juga dimuat
        ];

        // CI4 akan merender view index.php, dan JavaScript akan mengekstrak kontennya.
        return view('index', $data); 
    }
}