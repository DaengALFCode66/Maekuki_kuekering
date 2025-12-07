<?php namespace App\Controllers;

class Transaksi extends BaseController
{
    public function prosesCheckout()
    {
        // 1. Ambil Data Inputan User dari Form Modal
        $nama    = $this->request->getPost('nama');
        $noHp    = $this->request->getPost('no_hp');
        $alamat  = $this->request->getPost('alamat');
        
        // Contoh data keranjang (biasanya dari session/cart)
        $detailPesanan = "Nastar (2 Toples), Kastengel (1 Toples)"; 

        // 2. BACA NOMOR ADMIN DARI FILE JSON
        // WRITEPATH adalah konstanta bawaan CI4 yang mengarah ke folder 'writable/'
        $pathFile = WRITEPATH . 'data/setting_wa.json';
        
        if (file_exists($pathFile)) {
            $jsonString = file_get_contents($pathFile);
            $dataSetting = json_decode($jsonString, true);
            $nomorAdmin = $dataSetting['nomor_admin'];
        } else {
            // Fallback jika file hilang/terhapus
            $nomorAdmin = "628000000000"; 
        }

        // 3. Rakit Pesan WhatsApp
        $pesan  = "Halo Admin Maekuki, order baru masuk!%0a";
        $pesan .= "----------------------------------%0a";
        $pesan .= "*Data Pemesan:*%0a";
        $pesan .= "Nama: $nama%0a";
        $pesan .= "No HP: $noHp%0a"; // Nomor pembeli tercatat di pesan chat
        $pesan .= "Alamat: $alamat%0a";
        $pesan .= "----------------------------------%0a";
        $pesan .= "*Pesanan:*%0a";
        $pesan .= $detailPesanan . "%0a";
        $pesan .= "----------------------------------%0a";
        $pesan .= "Mohon info total bayarnya kak.";

        // 4. Redirect ke WA Admin
        return redirect()->to("https://wa.me/{$nomorAdmin}?text={$pesan}");
    }
}