@extends('layouts.template')
@section('judul', 'Data User')

@section('content')
    <script>
        $(function() {
            @if (session('type'))
                showMessage('{{ session('type') }}', '{{ session('text') }}');
            @endif
        });
    </script>
    <div class="card-shadow">
        <a href="{{ url($routes->add) }}" class="btn h-20 mb-3" style="background-color:#4e73df; margin-left:25px; color:#fff">
            <i class="fas fa-plus"> Tambah Data</i><br>
        </a>
    </div>
    <div class="card shadow mb-3">
        <div class="card-header" style="background-color:#4e73df;color:#fff">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA USER</h2>
        </div>
        <div class="card-body mt-3">
            <div class="table-responsive">
                <table id="data" class="table table-bordered show-data">
                    <thead>
                        <tr>
                            <th width="8%">No</th>
                            <th>Nama</th>
                            <th>Divisi</th>
                            <th>Username</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ ucwords(strtolower($item->divisi)) }}</td>
                                <td>{{ $item->username }}</td>
                                <td>
                                    <a href="{{ url($routes->index . $item->id . '/edit') }}" class="btn btn-warning btn-sm"
                                        data-toggle="tooltip" data-placement="top" title="Edit"><i
                                            class="fas fa-pen"></i></a>
                                    <form class="d-inline-block" action="{{ url($routes->index . $item->id) }}"
                                        method="POST">
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
    </div>
@endsection
