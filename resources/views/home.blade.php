
@extends('layouts.main')

@section('container')
<div class="container-fluid px-4">
    <h2 class="mt-4">Dashboard Admin </h2>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h6>Jumlah Siswa </h6>
                    <h5>{{ $siswa }}</h5>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/siswa">More Info</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <h6>Jumlah Ujian </h6>
                    <h5>{{ $ujian }}</h5>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/ujian">More Info</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h6>Jumlah Matpel</h6>
                    <h5>{{ $matpel }}</h5>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/matpel">More Info</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection