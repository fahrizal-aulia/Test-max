<?php

namespace App\Http\Controllers;

use App\Models\Ujian;
use App\Http\Requests\StoreUjianRequest;
use App\Http\Requests\UpdateUjianRequest;
use App\Models\Matpel;
use App\Models\Siswa;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Ujian::with('matpel')->withCount('peserta');

        if ($request->filled('tanggal')) {
        $query->whereDate('tanggal', $request->tanggal);
        }

        $ujians = $query->get();
        return view('ujian.index', ['ujians' => $ujians]);
    }

    public function create()
    {
        $matpels = Matpel::all();
        $siswas = Siswa::get();
        return view('ujian.create', ['matpels' => $matpels, 'siswas' => $siswas]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:150',
            'id_matpel' => 'required|exists:matpels,id_matpel',
            'tanggal' => 'required|date',
        ]);

        Ujian::create($validated);

        return redirect()->route('ujian.index')->with('success', 'Ujian berhasil ditambah.');
    }

    public function show(Ujian $ujian)
    {
        $ujian->load('matpel', 'peserta.siswa');
        return view('ujian.show', ['ujian' => $ujian]);
    }

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
