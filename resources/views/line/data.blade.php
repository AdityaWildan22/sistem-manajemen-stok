@extends('layouts.template')
@section('judul', 'Data Lines')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df">
                    <h1 class="card-title mb-0" style="font-size:18px; color:#fff">FORM DATA LINE</h1>
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
                                        {{ (old('id_area') ?? ($routes->is_update ? $lines->id_area : '')) == $item->id ? 'selected' : '' }}>
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
                            <label for="id_drawing">No. Drawing</label>
                            <select class="custom-select rounded-0 @error('id_drawing') is-invalid @enderror"
                                id="id_drawing" name="id_drawing">
                                <option value="" selected disabled>- Pilih Drawing -</option>
                                @foreach ($drawing as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('id_drawing') ?? ($routes->is_update ? $lines->id_drawing : '')) == $item->id ? 'selected' : '' }}>
                                        {{ $item->no_drw }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback" id="id_drawing_error" style="display: none;">
                                Silakan pilih Nama Area terlebih dahulu.
                            </div>

                            @if ($errors->has('id_drawing'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_drawing') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="no_line">No Line</label>
                            <input type="text" class="form-control @error('no_line') is-invalid  @enderror"
                                id="no_line" name="no_line" placeholder="No Line" value="{{ @$lines->no_line }}">
                            @error('no_line')
                                @if ($errors->has('no_line'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('no_line') }}
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
                    <h1 class="card-title mb-0" style="color: #fff; font-size:18px">DATA LINE</h1>
                </div>
                <div class="card-body mt-3">
                    <div class="table-responsive">
                        <table id="data" class="table table-bordered show-data">
                            <thead>
                                <tr>
                                    <th width="10px">NO</th>
                                    <th>Nama Area</th>
                                    <th>No Drawing</th>
                                    <th>No Line</th>
                                    <th width="21%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($line as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->area->nm_area }}</td>
                                        <td>{{ $item->drawing->no_drw }}</td>
                                        <td>{{ $item->no_line }}</td>
                                        <td>
                                            <a href="{{ url($routes->index . $item->id . '/edit') }}"
                                                class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top"
                                                title="Edit"><i class="fas fa-pen"></i></a>
                                            <form class="d-inline-block" action="{{ route('lines.destroy', $item->id) }}"
                                                method="POST">
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
    <script>
        $(function() {
            @if (session('type'))
                showMessage('{{ session('type') }}', '{{ session('text') }}');
            @endif

            $('#id_drawing').prop('disabled', true);

            $('#id_area').change(function() {
                var areaId = $(this).val();
                if (areaId) {
                    $.ajax({
                        url: '/get-drawings/' + areaId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#id_drawing').empty();
                            $('#id_drawing').append(
                                '<option value="" selected disabled>- Pilih Drawing -</option>'
                            );
                            $.each(data, function(key, drawing) {
                                $('#id_drawing').append('<option value="' + drawing.id +
                                    '">' + drawing.no_drw + '</option>');
                            });
                            $('#id_drawing').prop('disabled', false);
                            $('#id_drawing_error').hide();
                        }
                    });
                } else {
                    $('#id_drawing').empty();
                    $('#id_drawing').append(
                        '<option value="" selected disabled>- Pilih Drawing -</option>');
                    $('#id_drawing').prop('disabled',
                        true);
                    $('#id_drawing_error').hide();
                }
            });

            $('#id_drawing').focus(function() {
                if ($('#id_area').val() === '') {
                    $('#id_drawing_error').show();
                    $('#id_area').focus();
                    $('#id_drawing').prop('disabled', true);
                } else {
                    $('#id_drawing_error').hide();
                }
            });
        });
    </script>
@endsection
