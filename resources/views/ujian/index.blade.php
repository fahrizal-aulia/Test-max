@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Data Ujian</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Ujian</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <a href="{{ route('ujian.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Ujian Baru
            </a>
        </div>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-filter"></i> Filter Berdasarkan Tanggal
        </div>
        <div class="card-body">
            <form action="{{ route('ujian.index') }}" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                               value="{{ $tanggalDipilih ?? '' }}">
                    </div>
                    <div class="col-md-8 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('ujian.index') }}" class="btn btn-secondary">
                            <i class="fas fa-redo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ujian</th>
                        <th>Mata Pelajaran</th>
                        <th>Tanggal</th>
                        <th>Peserta</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ujians as $ujian)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ujian->nama }}</td>
                            <td>{{ $ujian->matpel->nama_matpel }}</td>
                            <td>{{ \Carbon\Carbon::parse($ujian->tanggal)->format('d F Y, H:i') }}</td>
                            <td>{{ $ujian->peserta_count }}</td>
                            <td>
                                <a href="{{ route('peserta.index', $ujian->id_ujian) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-users-cog"></i> Kelola Peserta
                                </a>

                                <a href="{{ route('ujian.edit', $ujian->id_ujian) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <a href="{{ route('ujian.show', $ujian->id_ujian) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>

                                <form action="{{ route('ujian.destroy', $ujian->id_ujian) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Menghapus ujian akan menghapus semua data peserta dan nilai terkait. Yakin?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Data ujian masih kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>


        </div>
    </div>
</div>
@endsection