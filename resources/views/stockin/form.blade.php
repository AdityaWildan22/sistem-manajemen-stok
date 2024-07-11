@extends('layouts.template')
@section('judul', 'Form Stok Masuk')

@section('content')
    <style>
        #avatar {
            width: 100%;
            height: auto;
            max-width: 100%;
            display: block;
            margin: auto;
        }
    </style>
    <div class="container">
        <form action="{{ isset($stockin) ? route('stockins.update', $stockin->id) : route('stockins.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @if (isset($stockin))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-4">
                    <img id="avatar"
                        src="{{ @$stockin->foto ? asset(@$stockin->foto) : asset('img/backgrounds/no-images.jpg') }}"
                        alt="Transaction Photo" class="img-thumbnail">
                    <input type="file" class="file" name="file" id="file" style="display:none">
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="no_trans">Nomor Transaksi</label>
                        <input type="text" class="form-control @error('no_trans') is-invalid  @enderror" id="no_trans"
                            name="no_trans" value="{{ $stockin->no_trans ?? '' }}">
                        @if ($errors->has('no_trans'))
                            <div class="invalid-feedback">
                                {{ $errors->first('no_trans') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal Masuk</label>
                        <input type="date" class="form-control @error('tgl_masuk') is-invalid  @enderror" id="tgl_input"
                            name="tgl_masuk" value="{{ $stockin->tgl_masuk ?? '' }}">
                        @if ($errors->has('tgl_masuk'))
                            <div class="invalid-feedback">
                                {{ $errors->first('tgl_masuk') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="engineer">Request by Engineer</label>
                        <select class="form-control select2 @error('id_enginer') is-invalid @enderror" id="engineer"
                            name="id_enginer">
                            <option value="" disabled selected>- Pilih Engineer -</option>
                            @foreach ($enginer as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($stockin) && $stockin->id_enginer == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_enginer'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_enginer') }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
            <div class="form-group">
                <table class="table" id="details_table">
                    <thead>
                        <tr>
                            <th>Nama Material</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($stockin->details)
                            @foreach ($stockin->details as $index => $detail)
                                <tr>
                                    <input type="hidden" name="details[{{ $index }}][id]" value="{{ $detail->id }}">
                                    <input type="hidden" name="details[{{ $index }}][deleted]" value="false">
                                    <td>
                                        <select class="form-control select2 @error('id_brg') is-invalid @enderror"
                                            name="details[{{ $index }}][id_barang]">
                                            <option value="" disabled>- Pilih Material -</option>
                                            @foreach ($material as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $detail->id_barang ? 'selected' : '' }}>
                                                    {{ $item->nm_brg }}
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
                                        <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                            name="details[{{ $index }}][jumlah]" value="{{ $detail->jumlah }}">
                                        @if ($errors->has('jumlah'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('jumlah') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" class="form-control @error('satuan') is-invalid @enderror"
                                            name="details[{{ $index }}][satuan]" value="{{ $detail->satuan }}">
                                        @if ($errors->has('satuan'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('satuan') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-detail"
                                            data-detail-id="{{ $detail->id }}"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
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
            $('.select2').select2();

            // Tambahkan detail baru
            $(document).on('click', '.add-detail', function() {
                var rowCount = $('#details_table tbody tr').length;
                var html = '<tr>';
                html += '<input type="hidden" name="details[' + rowCount + '][new]" value="true">';
                html += '<td><select class="form-control select2" name="details[' + rowCount +
                    '][id_barang]"> <option value="" selected disabled>- Pilih Material -</option>@foreach ($material as $item)<option value="{{ $item->id }}">{{ $item->nm_brg }}</option>@endforeach</select></td>';
                html += '<td><input type="number" class="form-control" name="details[' + rowCount +
                    '][jumlah]"></td>';
                html += '<td><input type="text" class="form-control" name="details[' + rowCount +
                    '][satuan]"></td>';
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
    <script>
        $(document).ready(function() {
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}');
                @endforeach
            @endif
        });
    </script>
@endsection
