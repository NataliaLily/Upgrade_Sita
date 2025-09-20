<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    protected $table = 'tugas_akhirs';
    protected $primaryKey = 'id_tugas_akhir';

    protected $fillable = [
        'id_mhs',
        'judul_tugas_akhir',
        'akdsem',
        'id_dosen_pembimbing_1',
        'id_dosen_pembimbing_2',
        // 'jadwal_ujian',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs', 'id');
    }

    public function dosenPembimbing1()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_pembimbing_1', 'id');
    }

    public function dosenPembimbing2()
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_pembimbing_2', 'id');
    }
};
