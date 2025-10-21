@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Data Siswa</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Data Siswa</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <a href="{{ route('siswa.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Siswa Baru
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
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data siswa --}}
                    @forelse ($dataSiswa as $siswa)
                        <tr>
                            {{-- Gunakan loop iteration untuk nomor urut --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $siswa->nis }}</td>
                            <td>{{ $siswa->nama }}</td>
                            <td>{{ $siswa->alamat }}</td>
                            <td>
                                {{-- Tombol Show (Detail) --}}
                                <a href="{{ route('siswa.show', $siswa->nis) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>

                                {{-- Tombol Edit --}}
                                <a href="{{ route('siswa.edit', $siswa->nis) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                {{-- Tombol Hapus (DELETE) --}}
                                <form action="{{ route('siswa.destroy', $siswa->nis) }}" method="POST" class="d-inline">
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
                            <td colspan="5" class="text-center">Data siswa masih kosong.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Link Paginasi --}}
            <div class="mt-3">
                {{ $dataSiswa->links() }}
            </div>

        </div>
    </div>
</div>
@endsection