@extends('layouts.template')
@section('judul', 'Data Stok Masuk')

@section('content')
    <script>
        $(function() {
            @if (session('type'))
                showMessage('{{ session('type') }}', '{{ session('text') }}');
            @endif
        });
    </script>
    <div class="card-shadow">
        <a href="{{ url($routes->add) }}" class="btn h-20 mb-3 btn-sm"
            style="background-color:#4e73df; margin-left:25px; color:#fff">
            <i class="fas fa-plus"> Tambah Data</i><br>
        </a>
        <a href="{{ url('stockin/export-excel') }}" class="btn h-20 mb-3 btn-sm"
            style="background-color:#4e73df; margin-left:25px; color:#fff">
            <i class="fas fa-file-excel"> Export Excel</i><br>
        </a>
        <a href="{{ url('stockin/export-pdf') }}" class="btn h-20 mb-3 btn-sm"
            style="background-color:#4e73df; margin-left:25px; color:#fff">
            <i class="fas fa-file-pdf"> Export PDF</i><br>
        </a>
    </div>
    <div class="card-shadow">
        <div class="card-header" style="background-color:#4e73df;color:#fff">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA STOK MASUK</h2>
        </div>
        <div class="card-body">
            <table id="data" class="table mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No Transaksi</th>
                        <th>Tanggal Masuk</th>
                        <th>Supervisor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockin as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_trans }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y') }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <a href="{{ url($routes->index . $item->id) }}" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ url($routes->index . $item->id . '/edit') }}" class="btn btn-warning btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pen"></i></a>
                                <form class="d-inline-block" action="{{ url($routes->index . $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                        data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
