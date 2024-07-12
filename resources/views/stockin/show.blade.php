@extends('layouts.template')
@section('judul', 'Detail Stok Masuk')
@section('content')
    <style>
        .detail-table td {
            padding: 2px 10px;
        }

        .table-borderless th,
        .table-borderless td {
            border: 0;
        }
    </style>
    <div class="card-shadow">
        <a href="{{ route('stockins.index') }}" class="btn btn-sm" style="background-color:#4e73df;color:#fff">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="detail mt-3 mb-3">
        <table class="table table-borderless detail-table">
            <tr>
                <td>Tanggal Masuk</td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($stockIn->tgl_masuk)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Staff</td>
                <td>:</td>
                <td>{{ $stockIn->user->name }}</td>
            </tr>
            <tr>
                <td>Request by Enginer</td>
                <td>:</td>
                <td>{{ $stockIn->enginer->name }}</td>
            </tr>
            <tr>
                <td>Bukti Nota</td>
                <td>:</td>
                <td>
                    @if ($stockIn->foto)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#notaModal"
                            data-toggle="tooltip" data-placement="top" title="Lihat Nota">
                            <i class="fas fa-eye"></i>
                        </button>
                    @else
                        <span class="text-muted">Tidak ada nota</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div class="card-shadow">
        <div class="card-header" style="background-color:#4e73df;color:#fff">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA DETAIL STOK MASUK</h2>
        </div>
        <div class="card-body">
            <table id="data" class="table table-striped table-bordered mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Material</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockIn->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->material->nm_brg }}</td>
                            <td>{{ $detail->satuan }}</td>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="notaModal" tabindex="-1" role="dialog" aria-labelledby="notaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notaModalLabel">Foto Nota</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ asset($stockIn->foto) }}" alt="Nota" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i
                            class="fas fa-xmark"></i>
                        Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#notaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var notaImage = "{{ asset($stockIn->foto) }}";
                var modal = $(this);
                modal.find('.modal-body img').attr('src', notaImage);
            });
        });
    </script>
@endsection
