<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController; // Kita panggil BaseController dari folder luar

class PengaturanController extends BaseController
{
    // 1. Method untuk menampilkan Form
    public function index()
    {
        // Cek data lama di file JSON
        $pathFile = WRITEPATH . 'data/setting_wa.json';
        $nomorLama = '';

        if (file_exists($pathFile)) {
            $jsonString = file_get_contents($pathFile);
            $data = json_decode($jsonString, true);
            $nomorLama = $data['nomor_admin'] ?? '';
        }

        $data = [
            'title'    => 'Pengaturan Nomor WhatsApp',
            'nomor_wa' => $nomorLama
        ];

        // Pastikan kamu punya file view ini nanti
        return view('admin/pengaturan', $data);
    }

    // 2. Method untuk Proses Update
    public function update()
    {
        $nomorBaru = $this->request->getPost('nomor_wa');

        // Validasi & Format (Ubah 08 jadi 62)
        $nomorBaru = preg_replace('/[^0-9]/', '', $nomorBaru);
        if (substr($nomorBaru, 0, 1) == '0') {
            $nomorBaru = '62' . substr($nomorBaru, 1);
        }

        // Simpan ke JSON
        $dataSimpan = [
            "nomor_admin" => $nomorBaru,
            "updated_at"  => date('Y-m-d H:i:s')
        ];

        // Cek folder data, buat jika belum ada
        if (!is_dir(WRITEPATH . 'data')) {
            mkdir(WRITEPATH . 'data', 0777, true);
        }

        $pathFile = WRITEPATH . 'data/setting_wa.json';
        file_put_contents($pathFile, json_encode($dataSimpan, JSON_PRETTY_PRINT));

        // Redirect kembali ke index pengaturan
        return redirect()->to('/admin/pengaturan')->with('sukses', 'Nomor berhasil disimpan!');
    }
}