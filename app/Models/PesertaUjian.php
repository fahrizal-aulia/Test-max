<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    use HasFactory;
    // protected $table = 'peserta_ujian';
    protected $guarded = ['id'];
    // Relasi: Data nilai ini milik satu siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    // Relasi: Data nilai ini milik satu ujian
    public function ujian()
    {
        return $this->belongsTo(Ujian::class, 'id_ujian', 'id_ujian');
    }
}
