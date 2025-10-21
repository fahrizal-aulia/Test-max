<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang boleh diisi
    protected $fillable = ['nis', 'nama', 'alamat'];

    // Relasi: Satu siswa bisa punya banyak hasil ujian
    public function hasilUjian()
    {
        return $this->hasMany(PesertaUjian::class, 'nis');
    }

    // Relasi: Satu siswa bisa ikut banyak ujian
    public function ujian()
    {
        return $this->belongsToMany(Ujian::class, 'peserta_ujian', 'nis', 'id_ujian');
    }
}
