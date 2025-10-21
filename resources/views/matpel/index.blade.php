@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Data Mata Pelajaran</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Matpel</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <a href="{{ route('matpel.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Matpel Baru
            </a>
        </div>
        <div class="card-body">

            {{-- Menampilkan Pesan Sukses --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Mata Pelajaran</th>
                        <th>KKM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data matpel --}}
                    @forelse ($matpels as $matpel)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $matpel->nama_matpel }}</td>
                            <td>{{ $matpel->kkm }}</td>
                            <td>
                                {{-- Tombol Show (Detail) --}}
                                <a href="{{ route('matpel.show', $matpel->id_matpel) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('matpel.edit', $matpel->id_matpel) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                {{-- Tombol Hapus (DELETE) --}}
                                <form action="{{ route('matpel.destroy', $matpel->id_matpel) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Data mata pelajaran masih kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Link Paginasi --}}
            <div class="mt-3">
                {{ $matpels->links() }}
            </div>

        </div>
    </div>
</div>
@endsection