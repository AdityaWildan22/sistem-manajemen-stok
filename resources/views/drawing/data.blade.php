@extends('layouts.template')
@section('judul', 'Data Drawing')

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
                <div class="card-header" style="background-color:#4e73df">
                    <h1 class="card-title mb-0" style="font-size:18px; color:#fff">FORM DATA DRAWING</h1>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ url($routes->save) }}" method="POST">
                        @csrf
                        @if ($routes->is_update)
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="id_area">Nama Area</label>
                            <select class="custom-select rounded-0 @error('id_area') is-invalid @enderror" id="id_area"
                                name="id_area">
                                <option value="" selected disabled>- Pilih Area -</option>
                                @foreach ($area as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('id_area') ?? ($routes->is_update ? $drawings->id_area : '')) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nm_area }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_area'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_area') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="no_drw">No Drawing</label>
                            <input type="text" class="form-control @error('no_drw') is-invalid  @enderror" id="no_drw"
                                name="no_drw" placeholder="No Drawing" value="{{ @$drawings->no_drw }}">
                            @error('no_drw')
                                @if ($errors->has('no_drw'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('no_drw') }}
                                    </div>
                                @endif
                            @enderror
                        </div>
                        <div class="form-group mb-0" style="display: flex; justify-content:end">
                            <button type="submit" class="btn btn-md" style="background-color:#4e73df; color:#fff">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df">
                    <h1 class="card-title mb-0" style="color: #fff; font-size:18px">DATA DRAWING</h1>
                </div>
                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <table id="data" class="table table-bordered show-data">
                            <thead>
                                <tr>
                                    <th width="10px">NO</th>
                                    <th>Nama Area</th>
                                    <th>No Drawing</th>
                                    <th width="21%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drawing as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->area->nm_area }}</td>
                                        <td>{{ $item->no_drw }}</td>
                                        <td>
                                            <a href="{{ url($routes->index . $item->id . '/edit') }}"
                                                class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fas fa-pen"></i></a>
                                            <form class="d-inline-block"
                                                action="{{ route('drawings.destroy', $item->id) }}" method="POST">
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
