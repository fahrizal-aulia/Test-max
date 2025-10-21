<?php

namespace App\Http\Controllers;

use App\Models\Matpel;
use App\Http\Requests\StoreMatpelRequest;
use App\Http\Requests\UpdateMatpelRequest;
use Illuminate\Http\Request;

class MatpelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matpels = Matpel::latest()->paginate(10);
        return view('matpel.index', ['matpels' => $matpels]);
    }

    /**
     * Menampilkan form untuk membuat matpel baru.
     */
    public function create()
    {
        return view('matpel.create');
    }

    /**
     * Menyimpan matpel baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_matpel' => 'required|string|max:100',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        Matpel::create($validated);

        return redirect()->route('matpel.index')->with('success', 'Mata pelajaran berhasil ditambah.');
    }

    /**
     * Menampilkan detail satu matpel.
     */
    public function show(Matpel $matpel)
    {
        return view('matpel.show', ['matpel' => $matpel]);
    }

    /**
     * Menampilkan form untuk edit matpel.
     */
    public function edit(Matpel $matpel)
    {
        return view('matpel.edit', ['matpel' => $matpel]);
    }

    /**
     * Mengupdate data matpel di database.
     */
    public function update(Request $request, Matpel $matpel)
    {
        $validated = $request->validate([
            'nama_matpel' => 'required|string|max:100',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        $matpel->update($validated);

        return redirect()->route('matpel.index')->with('success', 'Mata pelajaran berhasil diupdate.');
    }

    /**
     * Menghapus matpel dari database.
     */
    public function destroy(Matpel $matpel)
    {
        $matpel->delete();

        return redirect()->route('matpel.index')->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
