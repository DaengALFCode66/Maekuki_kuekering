<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserAdminModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }
        return view('admin/login');
    }

    public function login()
    {
        $session = session();
        $model = new UserAdminModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->getUserByEmail($email);

        if (!$user) {
            $session->setFlashdata('error', 'Email atau Password salah.');
            return redirect()->back();
        }

        // Catatan: CI4 tidak menggunakan password_hash, ia menggunakan string biasa di database
        // Jika password di database Anda adalah plain text (seperti admin123):
        if ($user['password_hash'] === $password) {
            $session->set([
                'id_user' => $user['id'],
                'email' => $user['email'],
                'isLoggedIn' => TRUE,
            ]);
            return redirect()->to('/admin/dashboard');
        }
        
        // Jika Anda menggunakan enkripsi password_hash yang benar:
        // if (password_verify($password, $user['password_hash'])) { /* ... kode login success */ }


        $session->setFlashdata('error', 'Email atau Password salah.');
        return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin');
    }
}