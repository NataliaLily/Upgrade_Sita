<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class LoginMhs extends Authenticatable
{
    protected $table = 'login_mhs';


    public static function checkAccount($username,$password)
    {
        return self::join("mhs as m", "m.id", "=", "login_mhs.id_mhs")
            ->where('m.no_mhs', $username)
            ->whereRaw('login_mhs.password = SHA1(UNHEX(SHA1("' . $password . '")))')
            ->first();
    }
}
