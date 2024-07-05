@extends('layouts.template')
@section('judul', 'Form Material')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df;color:#fff">
                    <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">FORM DATA MATERIAL</h2>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ url($routes->save) }}" method="POST">
                        @csrf
                        @if ($routes->is_update)
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="kd_brg">Kode Material</label>
                            <input type="text" class="form-control @error('kd_brg') is-invalid  @enderror" id="kd_brg"
                                name="kd_brg" placeholder="Masukkan Nama"
                                value="{{ old('kd_brg') ? old('kd_brg') : @$materials->kd_brg }}">
                            @if ($errors->has('kd_brg'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('kd_brg') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nm_brg">Nama Material</label>
                            <input type="text" class="form-control @error('nm_brg') is-invalid  @enderror" id="nm_brg"
                                name="nm_brg" placeholder="Masukkan Nama Barang"
                                value="{{ old('nm_brg') ? old('nm_brg') : @$materials->nm_brg }}">
                            @if ($errors->has('nm_brg'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nm_brg') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="id_cat">Nama Kategori</label>
                            <select class="custom-select rounded-0 @error('id_cat') is-invalid @enderror" id="id_cat"
                                name="id_cat">
                                <option value="" selected disabled>- Pilih Kategori -</option>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('id_cat') ? old('id_cat') : @$materials->id_cat) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nm_cat }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('id_cat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_cat') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="id_subcat">Nama Sub Kategori</label>
                            <select class="custom-select rounded-0 @error('id_subcat') is-invalid @enderror" id="id_subcat"
                                name="id_subcat">
                                <option value="" selected disabled>- Pilih Sub Kategori -</option>
                                @foreach ($subkat as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('id_subcat') ? old('id_subcat') : @$materials->id_subcat) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nm_subcat }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('id_subcat'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('id_subcat') }}
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="size1">Size 1</label>
                                    <input type="text" class="form-control @error('size1') is-invalid  @enderror"
                                        id="size1" name="size1" placeholder="Masukkan Size 1"
                                        value="{{ old('size1') ? old('size1') : @$materials->size1 }}">
                                    @if ($errors->has('size1'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('size1') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="size2">Size 2</label>
                                    <input type="text" class="form-control @error('size2') is-invalid  @enderror"
                                        id="size2" name="size2" placeholder="Masukkan Size 2"
                                        value="{{ old('size2') ? old('size2') : @$materials->size2 }}">
                                    @if ($errors->has('size2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('size2') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="thickness1">Thickness 1</label>
                                    <input type="text" class="form-control @error('thickness1') is-invalid  @enderror"
                                        id="thickness1" name="thickness1" placeholder="Masukkan Thickness 1"
                                        value="{{ old('thickness1') ? old('thickness1') : @$materials->thickness1 }}">
                                    @if ($errors->has('thickness1'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('thickness1') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="thickness2">Thickness 2</label>
                                    <input type="text" class="form-control @error('thickness2') is-invalid  @enderror"
                                        id="thickness2" name="thickness2" placeholder="Masukkan Thickness 2"
                                        value="{{ old('thickness2') ? old('thickness2') : @$materials->thickness2 }}">
                                    @if ($errors->has('thickness2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('thickness2') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="SCH">SCH</label>
                                    <input type="text" class="form-control @error('SCH') is-invalid  @enderror"
                                        id="SCH" name="SCH" placeholder="Masukkan SCH"
                                        value="{{ old('SCH') ? old('SCH') : @$materials->SCH }}">
                                    @if ($errors->has('SCH'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('SCH') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type1">Type 1</label>
                                    <input type="text" class="form-control @error('type1') is-invalid  @enderror"
                                        id="type1" name="type1" placeholder="Masukkan Type 1"
                                        value="{{ old('type1') ? old('type1') : @$materials->type1 }}">
                                    @if ($errors->has('type1'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('type1') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type2">Type 2</label>
                                    <input type="text" class="form-control @error('type2') is-invalid  @enderror"
                                        id="type2" name="type2" placeholder="Masukkan Type 2"
                                        value="{{ old('type2') ? old('type2') : @$materials->type2 }}">
                                    @if ($errors->has('type2'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('type2') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control @error('satuan') is-invalid  @enderror"
                                        id="satuan" name="satuan" placeholder="Masukkan Satuan"
                                        value="{{ old('satuan') ? old('satuan') : @$materials->satuan }}">
                                    @if ($errors->has('satuan'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('satuan') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stok">Stok</label>
                                    <input type="text" class="form-control @error('stok') is-invalid  @enderror"
                                        id="stok" name="stok" placeholder="Masukkan Stok"
                                        value="{{ old('stok') ? old('stok') : @$materials->stok }}">
                                    @if ($errors->has('stok'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('stok') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="specification">Spesifikasi</label>
                            <textarea class="form-control" name="specification" id="specification" cols="30" rows="10">{{ @$materials->specification }}</textarea>
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
    </div>

    <script>
        $(document).ready(function() {
            // Select2 untuk Kategori
            $('#id_cat').select2({
                placeholder: 'Cari Kategori',
                width: '100%',
                ajax: {
                    url: '{{ route('material.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(kategori) {
                                return {
                                    id: kategori.id,
                                    text: kategori.nm_cat,
                                };
                            })
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;
                $('#id_cat').val(data.id).trigger('change'); // Set nilai hidden input
            });

            // Select2 untuk Subkategori
            $('#id_subcat').select2({
                placeholder: 'Cari Sub Kategori',
                width: '100%',
                ajax: {
                    url: '{{ route('material.search2') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(subkat) {
                                return {
                                    id: subkat.id,
                                    text: subkat.nm_subcat,
                                };
                            })
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function(e) {
                var data = e.params.data;
                $('#id_subcat').val(data.id).trigger('change'); // Set nilai hidden input
            });

            // Set nilai untuk Select2 Kategori dan Subkategori pada mode edit
            var id_cat = '{{ @$materials->id_cat }}';
            var id_subcat = '{{ @$materials->id_subcat }}';

            if (id_cat) {
                var option = new Option('{{ @$materials->category->nm_cat }}', id_cat, true, true);
                $('#id_cat').append(option).trigger('change'); // Trigger change untuk memastikan opsi terpilih
            }

            if (id_subcat) {
                var option = new Option('{{ @$materials->subcategories->nm_subcat }}', id_subcat, true, true);
                $('#id_subcat').append(option).trigger('change'); // Trigger change untuk memastikan opsi terpilih
            }
        });
    </script>
@endsection
