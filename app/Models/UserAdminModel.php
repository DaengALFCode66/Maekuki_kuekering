<?php namespace App\Models;

use CodeIgniter\Model;

class UserAdminModel extends Model
{
    protected $table = 'admin'; // Sesuai dengan nama tabel di phpMyAdmin
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'password_hash']; // Kolom yang diizinkan
    protected $returnType = 'array';

    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}