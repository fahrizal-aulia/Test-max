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
        // Ambil data ujian beserta peserta dan siswanya
        $ujian->load('peserta.siswa');

        // Ambil daftar siswa yang BELUM ikut ujian ini
        $siswaBelumIkut = Siswa::whereDoesntHave('hasilUjian', function ($query) use ($ujian) {
            $query->where('id_ujian', $ujian->id_ujian);
        })->get();

        return view('peserta.index', [
            'ujian' => $ujian,
            'siswaBelumIkut' => $siswaBelumIkut
        ]);
    }

    /**
     * Menyimpan/menambahkan siswa ke dalam ujian.
     */
    public function store(Request $request, Ujian $ujian)
    {
        $request->validate([
            'nis' => 'required|exists:siswas,nis'
        ]);

        // Cek agar tidak duplikat
        $existing = PesertaUjian::where('id_ujian', $ujian->id_ujian)
                                ->where('nis', $request->nis)
                                ->first();

        if (!$existing) {
            PesertaUjian::create([
                'id_ujian' => $ujian->id_ujian,
                'nis' => $request->nis,
                'nilai' => 0 // Nilai default
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
