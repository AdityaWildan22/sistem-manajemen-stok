@extends('layouts.template')
@section('judul', 'Data Kategori')

@section('content')
    <script>
        $(function() {
            @if (session('type'))
                showMessage('{{ session('type') }}', '{{ session('text') }}');
            @endif
        });
    </script>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="card-title mb-0" style="font-size:18px; color:#fff">FORM DATA KATEGORI</h1>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ url($routes->save) }}" method="POST">
                        @csrf
                        @if ($routes->is_update)
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="nm_cat">Nama Kategori</label>
                            <input type="text" class="form-control @error('nm_cat') is-invalid  @enderror" id="nm_cat"
                                name="nm_cat" placeholder="Nama Kategori" value="{{ @$kat->nm_cat }}">
                            @error('nm_cat')
                                @if ($errors->has('nm_cat'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nm_cat') }}
                                    </div>
                                @endif
                            @enderror
                        </div>
                        <div class="form-group mb-0" style="display: flex; justify-content:end">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="card-title mb-0" style="color: #fff; font-size:18px">DATA KATEGORI</h1>
                </div>
                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <table id="data" class="table table-bordered show-data">
                            <thead>
                                <tr>
                                    <th width="10px">NO</th>
                                    <th>Nama Kategori</th>
                                    <th width="21%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nm_cat }}</td>
                                        <td>
                                            <a href="{{ url($routes->index . $item->id . '/edit') }}"
                                                class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fas fa-pen"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('kategoris.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                                    data-placement="top" title="Hapus"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
