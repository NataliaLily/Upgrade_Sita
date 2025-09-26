<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class LoginDosen extends Authenticatable
{
    protected $table = 'login_dosen';

    protected $fillable = [
        'id_dosen',
        'password',
    ];


    public function Dosen(){
        return $this->belongsTo(Dosen::class, 'id_dosen', 'id');
    
    }
    public static function checkAccount($username, $password)
    {
        $db = self::query()
            ->join("dosen", "dosen.id", "=", "login_dosen.id_dosen")
            ->where('dosen.no_dosen', $username)
            ->whereRaw('login_dosen.password = SHA1(UNHEX(SHA1("' . $password . '")))');
        return $db->first();
    }
}
