@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Edit Data Siswa</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
        <li class="breadcrumb-item active">Edit Data</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            Form Edit Data Siswa
        </div>
        <div class="card-body">

            <form action="{{ route('siswa.update', $siswa->nis) }}" method="POST">
                @csrf
                @method('PUT') {{-- Penting untuk update --}}

                {{-- Input NIS (Readonly) --}}
                <div class="mb-3">
                    <label for="nis" class="form-label">NIS (Tidak bisa diubah)</label>
                    <input type="text" class="form-control"
                           id="nis" name="nis" value="{{ $siswa->nis }}" readonly>
                </div>

                {{-- Input Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Siswa</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                           id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" required>

                    @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Input Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('alamat') is-invalid @enderror"
                              id="alamat" name="alamat" rows="3" required>{{ old('alamat', $siswa->alamat) }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection