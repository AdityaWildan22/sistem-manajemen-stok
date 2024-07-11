@extends('layouts.template')
@section('judul', 'Detail Stok Masuk')
@section('content')
    <div class="card-shadow">
        <a href="{{ route('stockins.index') }}" class="btn" style="background-color:#4e73df;color:#fff"><i
                class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="detail mt-3 mb-3">
        <table>
            <tr>
                <td>Tanggal Masuk</td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($stockIn->tgl_masuk)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Staff</td>
                <td>:</td>
                <td>{{ $stockIn->user->name }}</td>
            </tr>
            <tr>
                <td>Request by Enginer</td>
                <td>:</td>
                <td>{{ $stockIn->enginer->name }}</td>
            </tr>
        </table>
    </div>
    <div class="card-shadow">
        <div class="card-header" style="background-color:#4e73df;color:#fff">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA DETAIL STOK MASUK</h2>
        </div>
        <div class="card-body">
            <table id="data" class="table mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Material</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockIn->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->material->nm_brg }}</td>
                            <td>{{ $detail->satuan }}</td>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
