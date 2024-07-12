@extends('layouts.template')
@section('judul', 'Detail Stok Keluar')
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
        <a href="{{ route('stockouts.index') }}" class="btn btn-sm" style="background-color:#4e73df;color:#fff">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="detail mt-3 mb-3">
        <table class="table table-borderless detail-table">
            <tr>
                <td>Tanggal Keluar</td>
                <td>:</td>
                <td>{{ Carbon\Carbon::parse($stockout->tgl_keluar)->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td>Staff</td>
                <td>:</td>
                <td>{{ $stockout->user->name }}</td>
            </tr>
            <tr>
                <td>Supervisor</td>
                <td>:</td>
                <td>{{ $stockout->supervisor->name }}</td>
            </tr>
            <tr>
                <td>Request by Enginer</td>
                <td>:</td>
                <td>{{ $stockout->enginer->name }}</td>
            </tr>
            <tr>
                <td>Bukti Nota</td>
                <td>:</td>
                <td>
                    @if ($stockout->foto)
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
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA DETAIL STOK KELUAR</h2>
        </div>
        <div class="card-body">
            <table id="datadetail" class="table table-striped table-bordered mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Material</th>
                        <th>Area</th>
                        <th>Line</th>
                        <th>Drawing</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockout->details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->material->nm_brg }}</td>
                            <td>{{ $detail->area->nm_area }}</td>
                            <td>{{ $detail->line->no_line }}</td>
                            <td>{{ $detail->drawing->no_drw }}</td>
                            <td>{{ $detail->jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- The Modal -->
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
                    <img src="{{ asset($stockout->foto) }}" alt="Nota" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#notaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var notaImage = "{{ asset($stockout->foto) }}";
                var modal = $(this);
                modal.find('.modal-body img').attr('src', notaImage);
            });
        });
    </script>
@endsection
