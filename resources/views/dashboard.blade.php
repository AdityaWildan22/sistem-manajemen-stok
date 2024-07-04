@extends('layouts.template')

@section('judul', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Material</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_material }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_stockin }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_stockout }}</div>
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_user }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="menu-icon tf-icons bx bx-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
