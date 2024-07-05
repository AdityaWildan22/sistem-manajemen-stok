@extends('layouts.template')

@section('judul', 'Form Stockout')

@section('content')
    <div class="container">
        <form action="{{ isset($stockout) ? route('stockouts.update', $stockout->id) : route('stockouts.store') }}"
            method="POST">
            @csrf
            @if (isset($stockout))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="no_trans">Nomor Transaksi</label>
                <input type="text" class="form-control @error('no_trans') is-invalid  @enderror" id="no_trans"
                    name="no_trans" value="{{ $stockout->no_trans ?? '' }}">
                @if ($errors->has('no_trans'))
                    <div class="invalid-feedback">
                        {{ $errors->first('no_trans') }}
                    </div>
                @endif

            </div>
            <div class="form-group">
                <label for="tgl_keluar">Tanggal Keluar</label>
                <input type="date" class="form-control @error('tgl_keluar') is-invalid  @enderror" id="tgl_input"
                    name="tgl_keluar" value="{{ $stockout->tgl_keluar ?? '' }}">
                @if ($errors->has('tgl_keluar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tgl_keluar') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <table class="table" id="details_table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Area</th>
                            <th>Line</th>
                            <th>Drawing</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stockout->details ?? [] as $index => $detail)
                            <tr>
                                <input type="hidden" name="details[{{ $index }}][id]" value="{{ $detail->id }}">
                                <input type="hidden" name="details[{{ $index }}][deleted]" value="false">
                                <td>
                                    <select class="form-control select2 @error('id_brg') is-invalid @enderror"
                                        name="details[{{ $index }}][id_barang]" required>
                                        <option value="" disabled selected>- Pilih Material -</option>
                                        @foreach ($materials as $material)
                                            <option value="{{ $material->id }}"
                                                {{ $material->id == $detail->id_barang ? 'selected' : '' }}>
                                                {{ $material->nm_brg }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_brg'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_brg') }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <select class="form-control @error('id_area') is-invalid @enderror"
                                        name="details[{{ $index }}][id_area]" required>
                                        <option value="" disabled selected>- Pilih Area -</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}"
                                                {{ $area->id == $detail->id_area ? 'selected' : '' }}>
                                                {{ $area->nm_area }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_area'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_area') }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <select class="form-control @error('id_line') is-invalid @enderror"
                                        name="details[{{ $index }}][id_line]" required>
                                        <option value="" disabled selected>- Pilih Line -</option>
                                        @foreach ($lines as $line)
                                            <option value="{{ $line->id }}"
                                                {{ $line->id == $detail->id_line ? 'selected' : '' }}>
                                                {{ $line->no_line }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_line'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_line') }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <select class="form-control @error('id_drawing') is-invalid @enderror"
                                        name="details[{{ $index }}][id_drawing]" required>
                                        <option value="" disabled selected>- Pilih Drawing -</option>
                                        @foreach ($drawings as $drawing)
                                            <option value="{{ $drawing->id }}"
                                                {{ $drawing->id == $detail->id_drawing ? 'selected' : '' }}>
                                                {{ $drawing->no_drw }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_drawing'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('id_drawing') }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]"
                                        value="{{ $detail->jumlah }}" required>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-detail"
                                        data-detail-id="{{ $detail->id }}"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <button type="button" class="btn btn-sm add-detail" style="background-color:#4e73df; color:#fff"><i
                            class="fas fa-plus"></i> Tambah
                        Detail</button>
                    <button type="submit" class="btn btn-sm" style="background-color:#4e73df; color:#fff; float: right;"><i
                            class="fas fa-save"></i>
                        Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2();

            // Tambahkan detail baru
            $(document).on('click', '.add-detail', function() {
                var rowCount = $('#details_table tbody tr').length;
                var html = '<tr>';
                html += '<input type="hidden" name="details[' + rowCount + '][new]" value="true">';
                html += '<td><select class="form-control select2" name="details[' + rowCount +
                    '][id_barang]" required> <option value="" selected disabled>- Pilih Material -</option>@foreach ($materials as $material)<option value="{{ $material->id }}">{{ $material->nm_brg }}</option>@endforeach</select></td>';
                html += '<td><select class="form-control" name="details[' + rowCount +
                    '][id_area]" required> <option value="" disabled selected>- Pilih Area -</option>@foreach ($areas as $area)<option value="{{ $area->id }}">{{ $area->nm_area }}</option>@endforeach</select></td>';
                html += '<td><select class="form-control" name="details[' + rowCount +
                    '][id_line]" required> <option value="" disabled selected>- Pilih Line -</option>@foreach ($lines as $line)<option value="{{ $line->id }}">{{ $line->no_line }}</option>@endforeach</select></td>';
                html += '<td><select class="form-control" name="details[' + rowCount +
                    '][id_drawing]" required> <option value="" disabled selected>- Pilih Drawing -</option>@foreach ($drawings as $drawing)<option value="{{ $drawing->id }}">{{ $drawing->no_drw }}</option>@endforeach</select></td>';
                html += '<td><input type="number" class="form-control" name="details[' + rowCount +
                    '][jumlah]" required></td>';
                html +=
                    '<td><button type="button" class="btn btn-danger btn-sm remove-detail"><i class="fas fa-trash"></i></button></td>';
                html += '</tr>';
                $('#details_table tbody').append(html);

                $('#details_table tbody tr:last-child .select2').select2();
            });

            // Hapus detail
            $(document).on('click', '.remove-detail', function() {
                var row = $(this).closest('tr');
                var detailId = $(this).data('detail-id');
                if (detailId !== undefined) {
                    row.find('input[name="details[' + row.index() + '][deleted]"]').val('true');
                    row.hide();
                } else {
                    row.remove();
                }
            });
        });
    </script>
@endsection
