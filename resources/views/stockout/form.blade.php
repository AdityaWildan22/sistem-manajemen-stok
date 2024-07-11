@extends('layouts.template')

@section('judul', 'Form Stockout')

@section('content')
    <style>
        .custom-select2-dropdown .select2-container--default .select2-selection--single {
            width: 100% !important;
            max-width: 100% !important;
        }

        .custom-select2-dropdown .select2-container--default .select2-dropdown {
            width: 100% !important;
            max-width: 100% !important;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            table-layout: fixed;
        }

        .table th,
        .table td {
            white-space: nowrap;
        }
    </style>

    <div class="container">
        <form action="{{ isset($stockout) ? route('stockouts.update', $stockout->id) : route('stockouts.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($stockout))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-4">
                    <img id="avatar"
                        src="{{ @$stockout->foto ? asset(@$stockout->foto) : asset('img/backgrounds/no-images.jpg') }}"
                        alt="Transaction Photo" class="img-thumbnail">
                    <input type="file" class="file" name="file" id="file" style="display:none">
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="no_trans">Nomor Transaksi</label>
                        <input type="text" class="form-control @error('no_trans') is-invalid @enderror" id="no_trans"
                            name="no_trans" value="{{ $stockout->no_trans ?? '' }}">
                        @error('no_trans')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tgl_keluar">Tanggal Keluar</label>
                        <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" id="tgl_input"
                            name="tgl_keluar" value="{{ $stockout->tgl_keluar ?? '' }}">
                        @error('tgl_keluar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_supervisor">Supervisor</label>
                        <select class="form-control select2 @error('id_supervisor') is-invalid @enderror" id="supervisor"
                            name="id_supervisor">
                            <option value="" disabled selected>- Pilih Supervisor -</option>
                            @foreach ($supervisor as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($stockout) && $stockout->id_supervisor == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_supervisor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="engineer">Request by Engineer</label>
                        <select class="form-control select2 @error('id_enginer') is-invalid @enderror" id="engineer"
                            name="id_enginer">
                            <option value="" disabled selected>- Pilih Engineer -</option>
                            @foreach ($enginer as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($stockout) && $stockout->id_enginer == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_enginer')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <table class="table" id="details_table">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Area</th>
                            <th>Drawing</th>
                            <th>Line</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
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
                                    @error('id_brg')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control select2 @error('id_area') is-invalid @enderror"
                                        name="details[{{ $index }}][id_area]" required>
                                        <option value="" disabled selected>- Pilih Area -</option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}"
                                                {{ $area->id == $detail->id_area ? 'selected' : '' }}>
                                                {{ $area->nm_area }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_area')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control select2 @error('id_drawing') is-invalid @enderror"
                                        name="details[{{ $index }}][id_drawing]" required disabled>
                                        <option value="" disabled selected>- Pilih Drawing -</option>
                                        @foreach ($drawings as $drawing)
                                            <option value="{{ $drawing->id }}"
                                                {{ $drawing->id == $detail->id_drawing ? 'selected' : '' }}>
                                                {{ $drawing->no_drw }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_drawing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <select class="form-control select2 @error('id_line') is-invalid @enderror"
                                        name="details[{{ $index }}][id_line]" required disabled>
                                        <option value="" disabled selected>- Pilih Line -</option>
                                        @foreach ($lines as $line)
                                            <option value="{{ $line->id }}"
                                                {{ $line->id == $detail->id_line ? 'selected' : '' }}>
                                                {{ $line->no_line }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_line')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="details[{{ $index }}][jumlah]"
                                        value="{{ $detail->jumlah }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="details[{{ $index }}][satuan]"
                                        value="{{ $detail->satuan }}" required>
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
                            class="fas fa-plus"></i> Tambah Detail</button>
                    <button type="submit" class="btn btn-sm" style="background-color:#4e73df; color:#fff; float: right;"><i
                            class="fas fa-save"></i> Simpan</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%',
                dropdownAutoWidth: false,
                containerCssClass: 'custom-select2-dropdown',
                dropdownCssClass: 'custom-select2-dropdown'
            });

            $('#supervisor').select2({
                width: '100%',
                dropdownAutoWidth: false,
                containerCssClass: 'custom-select2-dropdown',
                dropdownCssClass: 'custom-select2-dropdown'
            });

            $('#engineer').select2({
                width: '100%',
                dropdownAutoWidth: false,
                containerCssClass: 'custom-select2-dropdown',
                dropdownCssClass: 'custom-select2-dropdown'
            });

            // Event untuk meng-handle perubahan pada select area
            $('body').on('change', '[name^="details["][name$="][id_area]"]', function() {
                var areaId = $(this).val();
                var row = $(this).closest('tr');
                var drawingSelect = row.find('[name^="details["][name$="][id_drawing]"]');
                var lineSelect = row.find('[name^="details["][name$="][id_line]"]');

                // Mengatur kondisi disable pada dropdown Drawing dan Line
                if (areaId) {
                    drawingSelect.prop('disabled', false); // Enable dropdown Drawing
                    drawingSelect.empty();
                    drawingSelect.append('<option value="" disabled selected>- Pilih Drawing -</option>');
                    // Lakukan pengambilan data Drawing sesuai dengan area yang dipilih
                    $.ajax({
                        url: '{{ url('/get-drawings') }}/' + areaId,
                        type: 'GET',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                drawingSelect.append('<option value="' + value.id +
                                    '">' + value.no_drw + '</option>');
                            });
                        }
                    });
                } else {
                    // Disable dropdown Drawing dan Line jika Area belum dipilih
                    drawingSelect.empty().append(
                        '<option value="" disabled selected>- Pilih Drawing -</option>');
                    drawingSelect.prop('disabled', true);
                    lineSelect.empty().append('<option value="" disabled selected>- Pilih Line -</option>');
                    lineSelect.prop('disabled', true);
                }

                // Reset nilai pada Drawing dan Line ketika Area diubah
                lineSelect.val('').trigger('change');
            });

            // Event untuk meng-handle perubahan pada select drawing
            $('body').on('change', '[name^="details["][name$="][id_drawing]"]', function() {
                var drawingId = $(this).val();
                var row = $(this).closest('tr');
                var lineSelect = row.find('[name^="details["][name$="][id_line]"]');

                // Mengatur kondisi disable pada dropdown Line
                if (drawingId) {
                    lineSelect.prop('disabled', false); // Enable dropdown Line
                    lineSelect.empty();
                    lineSelect.append('<option value="" disabled selected>- Pilih Line -</option>');
                    // Lakukan pengambilan data Line sesuai dengan drawing yang dipilih
                    $.ajax({
                        url: '{{ url('/get-lines') }}/' + drawingId,
                        type: 'GET',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                lineSelect.append('<option value="' + value.id + '">' +
                                    value.no_line + '</option>');
                            });
                        }
                    });
                } else {
                    // Disable dropdown Line jika Drawing belum dipilih
                    lineSelect.empty().append('<option value="" disabled selected>- Pilih Line -</option>');
                    lineSelect.prop('disabled', true);
                }
            });

            $(document).on('click', '.add-detail', function() {
                var rowCount = $('#details_table tbody tr').length;
                var html = '<tr>';
                html += '<input type="hidden" name="details[' + rowCount + '][new]" value="true">';
                html += '<td><select class="form-control select2" name="details[' + rowCount +
                    '][id_barang]" required> <option value="" selected disabled>- Pilih Material -</option>@foreach ($materials as $material)<option value="{{ $material->id }}">{{ $material->nm_brg }}</option>@endforeach</select></td>';
                html += '<td><select class="form-control select2" name="details[' + rowCount +
                    '][id_area]" required> <option value="" disabled selected>- Pilih Area -</option>@foreach ($areas as $area)<option value="{{ $area->id }}">{{ $area->nm_area }}</option>@endforeach</select></td>';
                html += '<td><select class="form-control select2" name="details[' + rowCount +
                    '][id_drawing]" required disabled> <option value="" disabled selected>- Pilih Drawing -</option>@foreach ($drawings as $drawing)<option value="{{ $drawing->id }}">{{ $drawing->no_drw }}</option>@endforeach</select></td>';
                html += '<td><select class="form-control select2" name="details[' + rowCount +
                    '][id_line]" required disabled> <option value="" disabled selected>- Pilih Line -</option>@foreach ($lines as $line)<option value="{{ $line->id }}">{{ $line->no_line }}</option>@endforeach</select></td>';
                html += '<td><input type="number" class="form-control" name="details[' + rowCount +
                    '][jumlah]" required></td>';
                html += '<td><input type="text" class="form-control" name="details[' + rowCount +
                    '][satuan]" required></td>';
                html +=
                    '<td><button type="button" class="btn btn-danger btn-sm remove-detail"><i class="fas fa-trash"></i></button></td>';
                html += '</tr>';
                $('#details_table tbody').append(html);
                $('.select2').select2(); // Reinitialize Select2 after adding new row
            });

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

            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            @endif
        });
    </script>
@endsection
