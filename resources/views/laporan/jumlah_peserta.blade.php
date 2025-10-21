@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Laporan Rekap Peserta Ujian</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Rekap Peserta</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table"></i> Daftar Ujian, Matpel, dan Jumlah Peserta
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ujian</th>
                        <th>Nama Matpel</th>
                        <th>Tanggal</th>
                        <th>Jumlah Peserta</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($hasil as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['nama_ujian'] }}</td>
                            <td>{{ $item['nama_matpel'] }}</td>
                            <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d F Y') }}</td>
                            <td class="text-center">{{ $item['jumlah_peserta'] }} Siswa</td>
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