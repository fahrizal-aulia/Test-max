@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Detail Siswa</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">Data Siswa</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            Data Lengkap: {{ $siswa->nama }}
        </div>
        <div class="card-body">

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>NIS:</strong>
                    <p>{{ $siswa->nis }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Nama Siswa:</strong>
                    <p>{{ $siswa->nama }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Alamat:</strong>
                    <p>{{ $siswa->alamat }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Data Dibuat:</strong>
                    <p>{{ $siswa->created_at->format('d F Y, H:i') }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Data Diupdate:</strong>
                    <p>{{ $siswa->updated_at->format('d F Y, H:i') }}</p>
                </li>
            </ul>

        </div>
        <div class="card-footer">
             <a href="{{ route('siswa.edit', $siswa->nis) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection