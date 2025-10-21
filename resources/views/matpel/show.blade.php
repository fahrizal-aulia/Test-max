@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Detail Mata Pelajaran</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('matpel.index') }}">Data Matpel</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            Data Lengkap: {{ $matpel->nama_matpel }}
        </div>
        <div class="card-body">

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>ID Matpel:</strong>
                    <p>{{ $matpel->id_matpel }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Nama Mata Pelajaran:</strong>
                    <p>{{ $matpel->nama_matpel }}</p>
                </li>
                <li class="list-group-item">
                    <strong>KKM:</strong>
                    <p>{{ $matpel->kkm }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Data Dibuat:</strong>
                    <p>{{ $matpel->created_at->format('d F Y, H:i') }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Data Diupdate:</strong>
                    <p>{{ $matpel->updated_at->format('d F Y, H:i') }}</p>
                </li>
            </ul>

        </div>
        <div class="card-footer">
             <a href="{{ route('matpel.edit', $matpel->id_matpel) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('matpel.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>
</div>
@endsection