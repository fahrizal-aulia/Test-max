<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matpel extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_matpel';
    protected $guarded = ['id_matpel'];

    // Relasi: Satu matpel bisa dipakai di banyak ujian
    public function ujian()
    {
        return $this->hasMany(Ujian::class, 'id_matpel', 'id_matpel');
    }
}
