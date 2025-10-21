<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataSiswa = Siswa::latest()->paginate(10); // Menggunakan paginate untuk data yg banyak

        // Mengirim data ke view 'resources/views/siswa/index.blade.php'
        return view('siswa.index', ['dataSiswa' => $dataSiswa]);
    }

    /**
     * Menampilkan form untuk membuat siswa baru.
     */
    public function create()
    {
        // Menampilkan view 'resources/views/siswa/create.blade.php'
        return view('siswa.create');
    }

    /**
     * Menyimpan siswa baru ke database. (CREATE)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|unique:siswas,nis|max:10',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
        ]);

        Siswa::create($validated);

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil ditambah.');
    }

    /**
     * Menampilkan detail satu siswa. (READ)
     */
    public function show(Siswa $siswa) // Route Model Binding
    {
        // Menampilkan view 'resources/views/siswa/show.blade.php'
        return view('siswa.show', ['siswa' => $siswa]);
    }

    /**
     * Menampilkan form untuk edit siswa.
     */
    public function edit(Siswa $siswa)
    {
        // Menampilkan view 'resources/views/siswa/edit.blade.php'
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    /**
     * Mengupdate data siswa di database. (UPDATE)
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
        ]);

        $siswa->update($validated);

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil diupdate.');
    }

    /**
     * Menghapus siswa dari database. (DELETE)
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
