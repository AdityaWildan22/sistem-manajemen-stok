@extends('layouts.template')
@section('judul', 'Data Detail Material')
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }

    tr {
        width: 100%;
    }
</style>
@section('content')
    <div class="card-shadow mb-3">
        <a href="{{ route('materials.index') }}" class="btn" style="background-color:#4e73df;color:#fff"><i
                class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <div class="card">
        <div class="card-header" style="background-color:#4e73df">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA DETAIL MATERIAL
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>Kode Barang</td>
                    <td>:</td>
                    <td>{{ $material->kd_brg }}</td>
                </tr>
                <tr>
                    <td>Nama Barang</td>
                    <td>:</td>
                    <td>{{ $material->nm_brg }}</td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td>:</td>
                    <td>{{ $material->category->nm_cat }}</td>
                </tr>
                <tr>
                    <td>Sub Kategori</td>
                    <td>:</td>
                    <td>{{ $material->subcategories->nm_subcat }}</td>
                </tr>
                <tr>
                    <td>Size 1</td>
                    <td>:</td>
                    <td>{{ $material->size1 }}</td>
                </tr>
                <tr>
                    <td>Size 2</td>
                    <td>:</td>
                    <td>{{ $material->size2 }}</td>
                </tr>
                <tr>
                    <td>Thickness 1</td>
                    <td>:</td>
                    <td>{{ $material->thickness1 }}</td>
                </tr>
                <tr>
                    <td>Thickness 2</td>
                    <td>:</td>
                    <td>{{ $material->thickness2 }}</td>
                </tr>
                <tr>
                    <td>SCH</td>
                    <td>:</td>
                    <td>{{ $material->SCH }}</td>
                </tr>
                <tr>
                    <td>Tipe 1</td>
                    <td>:</td>
                    <td>{{ $material->type1 }}</td>
                </tr>
                <tr>
                    <td>Tipe 2</td>
                    <td>:</td>
                    <td>{{ $material->type2 }}</td>
                </tr>
                <tr>
                    <td>Satuan</td>
                    <td>:</td>
                    <td>{{ $material->satuan }}</td>
                </tr>
                <tr>
                    <td>Stok</td>
                    <td>:</td>
                    <td>{{ $material->stok }}</td>
                </tr>
                <tr>
                    <td>Spesifikasi</td>
                    <td>:</td>
                    <td>{{ $material->specification }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection
