<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mhs';   // sesuai migration
    protected $primaryKey = 'id';

    protected $fillable = [
        'no_mhs',
        'nama',
        'almt',
        'tmp_lahir',
        'tgl_lahir',
        'j_kelamin',
        'id_user',
        'waktu',
        'id_dosen_wali',
        'no_cama',
        'lulus',
        'is_do',
        'is_transfered',
        'email_utama',
        'email_universitas',
        'nomer_whatsapp'
    ];

    // relasi ke dosen wali
    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_wali', 'id');
    }
}
