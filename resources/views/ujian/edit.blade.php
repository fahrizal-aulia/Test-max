@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Edit Data Ujian</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ujian.index') }}">Data Ujian</a></li>
        <li class="breadcrumb-item active">Edit Data</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            Form Edit Data Ujian
        </div>
        <div class="card-body">

            <form action="{{ route('ujian.update', $ujian->id_ujian) }}" method="POST">
                @csrf
                @method('PUT') {{-- Penting untuk update --}}

                {{-- Input Nama Ujian --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Ujian</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                           id="nama" name="nama" value="{{ old('nama', $ujian->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Mata Pelajaran (Dropdown) --}}
                <div class="mb-3">
                    <label for="id_matpel" class="form-label">Mata Pelajaran</label>
                    <select class="form-select @error('id_matpel') is-invalid @enderror"
                            id="id_matpel" name="id_matpel" required>
                        <option value="" disabled>-- Pilih Mata Pelajaran --</option>
                        @foreach ($matpels as $matpel)
                            <option value="{{ $matpel->id_matpel }}"
                                    {{ old('id_matpel', $ujian->id_matpel) == $matpel->id_matpel ? 'selected' : '' }}>
                                {{ $matpel->nama_matpel }} (KKM: {{ $matpel->kkm }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_matpel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Input Tanggal --}}
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal Ujian</label>
                    {{-- Format tanggal agar bisa dibaca oleh input datetime-local --}}
                    <input type="datetime-local" class="form-control @error('tanggal') is-invalid @enderror"
                           id="tanggal" name="tanggal"
                           value="{{ old('tanggal', \Carbon\Carbon::parse($ujian->tanggal)->format('Y-m-d\TH:i')) }}" required>
                    @error('tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('ujian.index') }}" class="btn btn-secondary">Batal</a>
            </form>

        </div>
    </div>
</div>
@endsection