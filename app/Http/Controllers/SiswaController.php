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
        $dataSiswa = Siswa::all();

        return view('siswa.index', ['dataSiswa' => $dataSiswa]);
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|string|unique:siswas',
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
        ]);
        Siswa::create($validated);
        return redirect("/siswa")->with('success', 'Siswa berhasil ditambah.');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', ['siswa' => $siswa]);
    }

    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', ['siswa' => $siswa]);
    }

    public function update(Request $request, Siswa $siswa)
    {
        $rules =[
            'nama' => 'required|string|max:100',
            'alamat' => 'required|string',
        ];


        if ( $request->nis != $siswa->nis ) {
            $rules['nis'] = 'required|string|unique:siswas';
        }
        $validated = $request->validate($rules);

        $siswa->update($validated);

        return redirect('siswa')->with('success', 'Siswa berhasil diupdate.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect("/siswa")->with('success', 'Siswa berhasil dihapus.');
    }
}
