<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'user_sita';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'username_user',
        'password_user',
        'nama_user',
        'email_user',
        'enabled',
        'no_prodi',
    ];

    protected $hidden = ['password_user']; // biar password gak ikut keluar

    // kolom untuk login
    public function getAuthIdentifierName()
    {
        return 'username_user';
    }

    // kolom password (Laravel pakai password_verify otomatis)
    public function getAuthPassword()
    {
        return $this->password_user;
    }
}
