<?php

namespace App\Http\Controllers;

use App\Models\PesertaUjian;
use App\Http\Requests\StorePesertaUjianRequest;
use App\Http\Requests\UpdatePesertaUjianRequest;
use App\Models\Ujian;
use App\Models\Siswa;
use Illuminate\Http\Request;

class PesertaUjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Ujian $ujian)
    {
         $ujian->load('peserta.siswa');

    $idSiswaSudahIkut = PesertaUjian::where('id_ujian', $ujian->id_ujian)
        ->pluck('nis');

    $siswaBelumIkut = Siswa::whereNotIn('nis', $idSiswaSudahIkut)->get();

    return view('peserta.index', [
        'ujian' => $ujian,
        'siswaBelumIkut' => $siswaBelumIkut
    ]);
    }


    public function store(Request $request, Ujian $ujian)
    {
        $request->validate([
            'nis' => 'required|exists:siswas,nis'
        ]);

        $duplikat = PesertaUjian::where('id_ujian', $ujian->id_ujian)
                                ->where('nis', $request->nis)
                                ->first();

        if (!$duplikat) {
            PesertaUjian::create([
                'id_ujian' => $ujian->id_ujian,
                'nis' => $request->nis,
                'nilai' => 0
            ]);
            return back()->with('success', 'Peserta berhasil ditambahkan.');
        }

        return back()->with('error', 'Siswa sudah terdaftar di ujian ini.');
    }

    /**
     * Mengupdate nilai seorang peserta.
     */
    public function updateNilai(Request $request, PesertaUjian $peserta)
    {
        $validated = $request->validate([
            'nilai' => 'required|integer|min:0|max:100'
        ]);

        $peserta->update($validated);

        return back()->with('success', 'Nilai berhasil diupdate.');
    }

    /**
     * Menghapus seorang peserta dari ujian.
     */
    public function destroy(PesertaUjian $peserta)
    {
        $peserta->delete();
        return back()->with('success', 'Peserta berhasil dihapus dari ujian.');
    }
}
