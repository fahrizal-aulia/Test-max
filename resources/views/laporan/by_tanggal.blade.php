@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Laporan Ujian per Tanggal</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Ujian per Tanggal</li>
    </ol>

    {{-- Form Pencarian Tanggal --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-search"></i> Pilih Tanggal Ujian
        </div>
        <div class="card-body">
            <form action="{{ route('laporan.byTanggal') }}" method="GET">
                <div class="row">
                    <div class="col-md-5">
                        <label for="tanggal" class="form-label">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                               value="{{ $tanggalDipilih ?? '' }}" required>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Cari Ujian</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Tabel Hasil Pencarian --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table"></i> Hasil Pencarian
        </div>
        <div class="card-body">

            @if(isset($tanggalDipilih) && $tanggalDipilih)
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ujian</th>
                            <th>Mata Pelajaran</th>
                            <th>KKM</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ujian as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $u->nama }}</td>
                                <td>{{ $u->matpel?->nama_matpel ?? 'N/A' }}</td>
                                <td>{{ $u->matpel?->kkm ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($u->tanggal)->format('H:i') }} WIB</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">
                                    Tidak ada ujian yang dilaksanakan pada tanggal {{ \Carbon\Carbon::parse($tanggalDipilih)->format('d F Y') }}.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <p class="text-center">Silakan pilih tanggal untuk menampilkan data ujian.</p>
            @endif

        </div>
    </div>
</div>
@endsection