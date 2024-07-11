@extends('layouts.template')

@section('judul', 'Dashboard')

@section('content')
    <script>
        $(function() {
            @if (session('type'))
                showMessage('{{ session('type') }}', '{{ session('text') }}');
            @endif
        });
    </script>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Material</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $total_material }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons bx bx-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Stok Masuk</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $total_stockin }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons bx bx-log-in fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Stok Keluar</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $total_stockout }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons bx bx-log-out fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_user }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons bx bx-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Total Kategori</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_kategori }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons bx bx-category fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Area
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $total_area }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons bx bx-area fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Drawing</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $total_drawing }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons  bx bx-cube-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Line</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $total_line }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons  bx bx-line-chart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-shadow">
        <div class="card-header" style="background-color:#4e73df;color:#fff">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA STOK MASUK HARI INI</h2>
        </div>
        <div class="card-body">
            <table id="data-dashboard2" class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No Transaksi</th>
                        <th>Tanggal Masuk</th>
                        <th>Staff</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockin_today as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_trans }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tgl_masuk)->format('d-m-Y') }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                <a href="{{ url('stockins/' . $item->id) }}" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data"><i
                                        class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-shadow">
        <div class="card-header" style="background-color:#4e73df;color:#fff">
            <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">DATA STOK KELUAR HARI INI</h2>
        </div>
        <div class="card-body">
            <table id="data-dashboard" class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>No Transaksi</th>
                        <th>Tanggal Keluar</th>
                        <th>Staff</th>
                        <th>Supervisor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stockout_today as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->no_trans }}</td>
                            <td>{{ Carbon\Carbon::parse($item->tgl_keluar)->format('d-m-Y') }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->supervisor->name }}</td>
                            <td>
                                <a href="{{ url('stockouts/' . $item->id) }}" class="btn btn-success btn-sm"
                                    data-toggle="tooltip" data-placement="top" title="Lihat Data"><i
                                        class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
