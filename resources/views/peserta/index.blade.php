@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Kelola Peserta & Nilai</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ujian.index') }}">Data Ujian</a></li>
        <li class="breadcrumb-item active">Kelola Peserta</li>
    </ol>

    {{-- Menampilkan Pesan Sukses/Error --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Informasi Ujian --}}
    <div class="card mb-4">
        <div class="card-header">
            Detail Ujian
        </div>
        <div class="card-body">
            <h5>{{ $ujian->nama }}</h5>
            <p>
                <strong>Matpel:</strong> {{ $ujian->matpel->nama_matpel }} <br>
                <strong>KKM:</strong> {{ $ujian->matpel->kkm }} <br>
                <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($ujian->tanggal)->format('d F Y') }}
            </p>
        </div>
    </div>

    <div class="row">
        {{-- Kolom Kiri: Tambah Peserta Baru (CREATE) --}}
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-plus-circle"></i> Tambah Peserta Baru
                </div>
                <div class="card-body">
                    <form action="{{ route('peserta.store', $ujian->id_ujian) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nis" class="form-label">Pilih Siswa</label>
                            <select class="form-select @error('nis') is-invalid @enderror"
                                    id="nis" name="nis" required>
                                <option value="" disabled selected>-- Pilih Siswa --</option>
                                {{-- Loop siswa yang BELUM ikut ujian ini --}}
                                @forelse ($siswaBelumIkut as $siswa)
                                    <option value="{{ $siswa->nis }}">
                                        {{ $siswa->nis }} - {{ $siswa->nama }}
                                    </option>
                                @empty
                                    <option value="" disabled>Semua siswa sudah terdaftar.</option>
                                @endforelse
                            </select>
                            @error('nis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Daftar Peserta (READ, UPDATE, DELETE) --}}
        <div class="col-md-7">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-users"></i> Daftar Peserta Terdaftar
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama Siswa</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ujian->peserta as $peserta)
                                <tr>
                                    {{-- Kolom Nama & NIS --}}
                                    <td>
                                        {{ $peserta->siswa->nama }}
                                        <small class="d-block">{{ $peserta->siswa->nis }}</small>
                                    </td>

                                    {{-- Kolom Update Nilai (UPDATE) --}}
                                    <td style="width: 150px;">
                                        <form action="{{ route('peserta.updateNilai', $peserta->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="input-group">
                                                <input type="number" name="nilai" class="form-control"
                                                       value="{{ $peserta->nilai }}" min="0" max="100">
                                                <button type="submit" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>

                                    {{-- Kolom Status Lulus --}}
                                    <td class="text-center">
                                        @if ($peserta->nilai > $peserta->ujian->matpel->kkm)
                                            <span class="badge bg-success">Lulus</span>
                                        @else
                                            <span class="badge bg-danger">Gagal</span>
                                        @endif
                                    </td>

                                    {{-- Kolom Hapus Peserta (DELETE) --}}
                                    <td class="text-center">
                                        <form action="{{ route('peserta.destroy', $peserta->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Yakin ingin mengeluarkan siswa ini dari ujian?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada peserta.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection