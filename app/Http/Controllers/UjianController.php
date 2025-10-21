<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Http\Requests\StoreUjianRequest;
use App\Http\Requests\UpdateUjianRequest;
use App\Models\Matpel;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ujians = Ujian::with('matpel')->latest()->paginate(10);
        return view('ujian.index', ['ujians' => $ujians]);
    }

    /**
     * Menampilkan form untuk membuat ujian baru.
     * Kita kirim data matpel untuk dropdown pilihan.
     */
    public function create()
    {
        $matpels = Matpel::all();
        return view('ujian.create', ['matpels' => $matpels]);
    }

    /**
     * Menyimpan ujian baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'id_matpel' => 'required|exists:matpels,id_matpel', // Pastikan id_matpel ada di tabel matpels
            'tanggal' => 'required|date',
        ]);

        Ujian::create($validated);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil ditambah.');
    }

    /**
     * Menampilkan detail satu ujian.
     * Di sini kita bisa juga menampilkan daftar peserta.
     */
    public function show(Ujian $ujian)
    {
        // Load relasi matpel dan peserta (beserta relasi siswanya)
        $ujian->load('matpel', 'peserta.siswa');
        return view('ujian.show', ['ujian' => $ujian]);
    }

    /**
     * Menampilkan form untuk edit ujian.
     */
    public function edit(Ujian $ujian)
    {
        $matpels = Matpel::all();
        return view('ujian.edit', [
            'ujian' => $ujian,
            'matpels' => $matpels
        ]);
    }

    /**
     * Mengupdate data ujian di database.
     */
    public function update(Request $request, Ujian $ujian)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'id_matpel' => 'required|exists:matpels,id_matpel',
            'tanggal' => 'required|date',
        ]);

        $ujian->update($validated);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil diupdate.');
    }

    /**
     * Menghapus ujian dari database.
     */
    public function destroy(Ujian $ujian)
    {
        $ujian->delete();

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil dihapus.');
    }
}
