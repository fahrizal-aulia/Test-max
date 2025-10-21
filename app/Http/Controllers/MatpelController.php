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
        $matpels = Matpel::all();
        return view('matpel.index', ['matpels' => $matpels]);
    }

    public function create()
    {
        return view('matpel.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_matpel' => 'required|string|max:100',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        Matpel::create($validated);

        return redirect("/matpel")->with('success', 'Mata pelajaran berhasil ditambah.');
    }

    public function show(Matpel $matpel)
    {
    }

    public function edit(Matpel $matpel)
    {
        return view('matpel.edit', ['matpel' => $matpel]);
    }

    public function update(Request $request, Matpel $matpel)
    {
        $validated = $request->validate([
            'nama_matpel' => 'required|string|max:100',
            'kkm' => 'required|integer|min:0|max:100',
        ]);

        $matpel->update($validated);

        return redirect("/matpel")->with('success', 'Mata pelajaran berhasil diupdate.');
    }

    public function destroy(Matpel $matpel)
    {
        $matpel->delete();

        return redirect("/matpel")->with('success', 'Mata pelajaran berhasil dihapus.');
    }
}
