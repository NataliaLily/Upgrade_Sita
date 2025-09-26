<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendadaran extends Model
{
    protected $table = 'pendadaran';
    protected $primaryKey = 'id_pendadaran';
    protected $fillable = [
        'id_mhs',
        'id_tugas_akhir',
        'id_dosen_pembimbing_1',
        'id_dosen_pembimbing_2',
        'id_dosen_penguji',
    ];

    // Relasi ke Mahasiswa
    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mhs');
    }

    // Relasi ke Tugas Akhir
    public function tugasAkhir(): BelongsTo
    {
        return $this->belongsTo(TugasAkhir::class, 'id_tugas_akhir');
    }

    // Relasi ke dosen pembimbing 1
    public function dosenPembimbing1(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_pembimbing_1');
    }

    // Relasi ke dosen pembimbing 2
    public function dosenPembimbing2(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_pembimbing_2');
    }

    // Relasi ke dosen penguji
    public function dosenPenguji(): BelongsTo
    {
        return $this->belongsTo(Dosen::class, 'id_dosen_penguji');
    }
}
