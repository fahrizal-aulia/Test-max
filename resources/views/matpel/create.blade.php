@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Tambah Matpel Baru</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('matpel.index') }}">Data Matpel</a></li>
        <li class="breadcrumb-item active">Tambah Baru</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            Form Tambah Data Matpel
        </div>
        <div class="card-body">

            <form action="{{ route('matpel.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_matpel" class="form-label">Nama Mata Pelajaran</label>
                    <input type="text" class="form-control @error('nama_matpel') is-invalid @enderror"
                           id="nama_matpel" name="nama_matpel" value="{{ old('nama_matpel') }}" required>

                    @error('nama_matpel')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="kkm" class="form-label">KKM (Kriteria Ketuntasan Minimal)</label>
                    <input type="number" class="form-control @error('kkm') is-invalid @enderror"
                           id="kkm" name="kkm" value="{{ old('kkm') }}" required min="0" max="100">

                    @error('kkm')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('matpel.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection