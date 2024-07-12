@extends('layouts.template')
@section('judul', 'Data Material')

@section('content')
    <script>
        $(function() {
            @if (session('type'))
                showMessage('{{ session('type') }}', '{{ session('text') }}');
            @endif
        });
    </script>
    @if (Auth::user()->divisi === 'MANAGER' || Auth::user()->divisi === 'ADMIN')
        <div class="card-shadow">
            <a href="{{ url($routes->add) }}" class="btn h-20 mb-3 btn-sm"
                style="background-color:#4e73df; margin-left:25px; color:#fff">
                <i class="fas fa-plus"> Tambah Data</i><br>
            </a>
            <a href="{{ url('material/export-excel') }}" class="btn h-20 mb-3 btn-sm"
                style="background-color:#4e73df; margin-left:25px; color:#fff">
                <i class="fas fa-file-excel"> Export Excel</i><br>
            </a>
            <a href="{{ url('material/export-pdf') }}" class="btn h-20 mb-3 btn-sm"
                style="background-color:#4e73df; margin-left:25px; color:#fff">
                <i class="fas fa-file-pdf"> Export PDF</i><br>
            </a>
        </div>
    @endif
    <div class="card shadow mb-3">
        <div class="card-header" style="background-color:#4e73df;color:#fff">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA MATERIAL</h2>
        </div>
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table id="data" class="table table-bordered show-data">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Sub Kategori</th>
                            <th>Size 1</th>
                            <th>Satuan</th>
                            <th>Stok</th>
                            @if (Auth::user()->divisi === 'MANAGER' || Auth::user()->divisi === 'ADMIN')
                                <th width="15%">Action</th>
                            @endif
                            @if (Auth::user()->divisi !== 'MANAGER' && Auth::user()->divisi !== 'ADMIN')
                                <th width="10%">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($material as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nm_brg }}</td>
                                <td>{{ $item->category->nm_cat }}</td>
                                <td>{{ $item->subcategories->nm_subcat }}</td>
                                <td>{{ $item->size1 }}</td>
                                <td>{{ $item->satuan }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>
                                    <a href="{{ url($routes->index . $item->id) }}" class="btn btn-success btn-sm"
                                        data-toggle="tooltip" data-placement="top" title="Lihat Data"><i
                                            class="fas fa-eye"></i></a>
                                    @if (Auth::user()->divisi === 'MANAGER' || Auth::user()->divisi === 'ADMIN')
                                        <a href="{{ url($routes->index . $item->id . '/edit') }}"
                                            class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                            title="Edit"><i class="fas fa-pen"></i></a>
                                        <form class="d-inline-block" action="{{ url($routes->index . $item->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
