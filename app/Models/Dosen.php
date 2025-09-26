<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';   // sesuai migration
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_dosen',
        'nidn',
        'gelar1',
        'nama_dosen',
        'gelar2',
        'rektor',
        'id_user',
        'is_active',
        'waktu'
    ];

    // 1 dosen punya banyak mahasiswa
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, 'id_dosen_wali', 'id');
    }
}
