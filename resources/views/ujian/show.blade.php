@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Detail Ujian</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('ujian.index') }}">Data Ujian</a></li>
        <li class="breadcrumb-item active">Detail</li>
    </ol>

    {{-- Kartu Detail Ujian --}}
    <div class="card mb-4">
        <div class="card-header">
            Data Ujian: {{ $ujian->nama }}
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Nama Ujian:</strong>
                    <p>{{ $ujian->nama }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Mata Pelajaran:</strong>
                    <p>{{ $ujian->matpel->nama_matpel }}</p>
                </li>
                <li class="list-group-item">
                    <strong>KKM:</strong>
                    <p>{{ $ujian->matpel->kkm }}</p>
                </li>
                <li class="list-group-item">
                    <strong>Tanggal:</strong>
                    <p>{{ \Carbon\Carbon::parse($ujian->tanggal)->format('d F Y, H:i') }}</p>
                </li>
            </ul>
        </div>
        <div class="card-footer">
             <a href="{{ route('ujian.edit', $ujian->id_ujian) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Ujian
            </a>
            <a href="{{ route('ujian.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
        </div>
    </div>

    {{-- Kartu Daftar Peserta --}}
    <div class="card mb-4">
        <div class="card-header">
            Daftar Peserta Ujian (Total: {{ $ujian->peserta->count() }} siswa)
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Nilai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ujian->peserta as $peserta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peserta->siswa->nis }}</td>
                            <td>{{ $peserta->siswa->nama }}</td>
                            <td>{{ $peserta->nilai }}</td>
                            <td>
                                {{-- Menggunakan Accessor 'status_lulus' dari Model PesertaUjian --}}
                                @if ($peserta->status_lulus)
                                    <span class="badge bg-success">Lulus</span>
                                @else
                                    <span class="badge bg-danger">Tidak Lulus</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada siswa yang terdaftar di ujian ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('peserta.index', $ujian->id_ujian) }}" class="btn btn-success">
                <i class="fas fa-users-cog"></i> Kelola Peserta & Nilai
            </a>
        </div>
    </div>

</div>
@endsection