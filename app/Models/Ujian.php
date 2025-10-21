<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_ujian';
    protected $guarded = ['id_ujian'];
    // Relasi: Satu ujian dimiliki oleh satu matpel
    public function matpel()
    {
        return $this->belongsTo(Matpel::class, 'id_matpel', 'id_matpel');
    }

    // Relasi: Satu ujian bisa diikuti banyak siswa
    public function siswa()
    {
        return $this->belongsToMany(Siswa::class, 'peserta_ujian', 'id_ujian', 'nis');
    }

    // Relasi: Satu ujian punya banyak data peserta/nilai
    public function peserta()
    {
        return $this->hasMany(PesertaUjian::class, 'id_ujian', 'id_ujian');
    }
}
