@extends('layouts.template')
@section('judul', 'Data Laporan')

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df">
                    <h2 class="card-title mb-0" style="font-size:18px; color:#fff">Laporan Data Stok Masuk Per Tanggal</h2>
                </div>
                <div class="card-body">
                    <form action="{{ url('/laporan/stockin/pertanggal') }}" method="post" target="_blank">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="tgl_awal">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tgl_awal" name="tgl_awal"
                                placeholder="Pilih Tanggal Awal">
                        </div>
                        <div class="form-group">
                            <label for="tgl_akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir"
                                placeholder="Pilih Tanggal Akhir">
                        </div>
                        <div class="form-group mb-0"
                            style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                            </div>
                            <button type="submit" class="btn btn-md" style="background-color:#4e73df; color:#fff">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df">
                    <h2 class="card-title mb-0" style="font-size:18px; color:#fff">Laporan Data Stok Keluar Per Tanggal</h2>
                </div>
                <div class="card-body">
                    <form action="{{ url('/laporan/stockout/pertanggal') }}" method="post" target="_blank">
                        @csrf
                        <div class="form-group mt-3">
                            <label for="tgl_awal">Tanggal Awal</label>
                            <input type="date" class="form-control" id="tgl_awal" name="tgl_awal"
                                placeholder="Pilih Tanggal Awal">
                        </div>
                        <div class="form-group">
                            <label for="tgl_akhir">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir"
                                placeholder="Pilih Tanggal Akhir">
                        </div>
                        <div class="form-group mb-0 text-right">
                            <button type="submit" class="btn btn-md" style="background-color:#4e73df;color:#fff">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df">
                    <h2 class="card-title mb-0" style="font-size:18px; color:#fff">Laporan Semua Data Material</h2>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between;">
                    <form action="{{ url('laporan/material') }}" method="get" target="_blank" style="width: 100%;">
                        @csrf
                        <div class="form-group mb-0" style="text-align: right;">
                            <button type="submit" class="btn btn-md mt-3" style="background-color:#4e73df; color:#fff">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df">
                    <h2 class="card-title mb-0" style="font-size:18px; color:#fff">Laporan Data Stok Masuk</h2>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between;">
                    <form action="{{ url('laporan/stockin') }}" method="get" target="_blank" style="width: 100%;">
                        @csrf
                        <div class="form-group mb-0" style="text-align: right;">
                            <button type="submit" class="btn btn-md mt-3" style="background-color:#4e73df; color:#fff">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df">
                    <h2 class="card-title mb-0" style="font-size:18px; color:#fff">Laporan Data Stok Keluar</h2>
                </div>
                <div class="card-body" style="display: flex; justify-content: space-between;">
                    <form action="{{ url('laporan/stockout') }}" method="get" target="_blank" style="width: 100%;">
                        @csrf
                        <div class="form-group mb-0" style="text-align: right;">
                            <button type="submit" class="btn btn-md mt-3" style="background-color:#4e73df; color:#fff">
                                <i class="fas fa-eye"></i> Lihat
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
