@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Laporan Status Kelulusan Siswa</h2>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
        <li class="breadcrumb-item active">Laporan Kelulusan</li>
    </ol>

    {{-- Fitur 3.c: Jumlah Siswa Lulus --}}
    <div class="card bg-success text-white mb-4">
        <div class="card-body">
            <h6>Jumlah Siswa yang Lulus dalam Semua Ujian yang Diikuti</h6>
            <h1 class="display-4">{{ $jumlahLulusSemua }}</h1>
            <p class="mb-0">Siswa</p>
        </div>
    </div>

    {{-- Fitur 3.d: Daftar Siswa Gagal --}}
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table"></i> Daftar Detail Siswa yang Tidak Lulus
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Gagal di Matpel</th>
                        <th>Pada Ujian</th>
                        <th>Nilai</th>
                        <th>KKM</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($siswaGagalList as $gagal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gagal['nama_siswa'] }}</td>
                            <td>{{ $gagal['nis'] }}</td>
                            <td>{{ $gagal['gagal_di_matpel'] }}</td>
                            <td>{{ $gagal['pada_ujian'] }}</td>
                            <td>{{ $gagal['nilai'] }}</td>
                            <td>{{ $gagal['kkm'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                <div class="alert alert-success mb-0">
                                    Luar biasa! Tidak ada siswa yang gagal dalam ujian.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection