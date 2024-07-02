@extends('layouts.template')
@section('judul', 'Detail Stok Keluar')
@section('content')
    <div class="card-shadow">
        <a href="{{ route('stockouts.index') }}" class="btn" style="background-color:#4e73df;color:#fff"><i
                class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="detail mt-3 mb-3">
        <table>
            <tr>
                <td>Tanggal Keluar</td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($stockout->tgl_keluar)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Supervisor</td>
                <td>:</td>
                <td>{{ $stockout->user->name }}</td>
            </tr>
        </table>
    </div>
    <div class="card-shadow">
        <div class="card-header" style="background-color:#4e73df;color:#fff">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA DETAIL STOK MASUK</h2>
        </div>
        <div class="card-body">
            <table id="datadetail" class="table mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Material</th>
                        <th>Area</th>
                        <th>Line</th>
                        <th>Drawing</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockout->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->material->nm_brg }}</td>
                            <td>{{ $detail->area->nm_area }}</td>
                            <td>{{ $detail->line->no_line }}</td>
                            <td>{{ $detail->drawing->no_drw }}</td>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
