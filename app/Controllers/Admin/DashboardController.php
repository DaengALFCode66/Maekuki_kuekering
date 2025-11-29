<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController
{
    // Cek apakah user sudah login sebelum mengakses
    public function __construct()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/admin')->send();
        }
    }

    public function index()
    {
        return view('admin/dashboard');
    }
}