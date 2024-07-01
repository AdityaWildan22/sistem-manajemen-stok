@extends('layouts.template')
@section('judul', 'Form User')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header" style="background-color:#4e73df;color:#fff">
                    <h2 class="card-title mb-0" style="font-size: 20px; color:#fff">FORM DATA USER</h2>
                </div>
                <div class="card-body mt-3">
                    <form action="{{ url($routes->save) }}" method="POST">
                        @csrf
                        @if ($routes->is_update)
                            @method('PUT')
                        @endif
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid  @enderror" id="name"
                                name="name" placeholder="Masukkan Nama"
                                value="{{ old('name') ? old('name') : @$user->name }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="divisi">Divisi</label>
                            <input type="text" class="form-control @error('divisi') is-invalid  @enderror" id="divisi"
                                name="divisi" placeholder="Masukkan Divisi"
                                value="{{ old('divisi') ? old('divisi') : @$user->divisi }}">
                            @if ($errors->has('divisi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('divisi') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid  @enderror"
                                id="username" name="username" placeholder="Masukkan Username"
                                value="{{ old('username') ? old('username') : @$user->username }}">
                            @if ($errors->has('username'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid  @enderror"
                                id="password" name="password" placeholder="Masukkan Password" value="">
                            <input type="hidden" name="old_password" id="old_password" value="{{ @$user->password }}">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                        {{-- <div class="form-group">
                            <label for="role">Role</label>
                            <select class="custom-select rounded-0  @error('role') is-invalid  @enderror" id="role"
                                name="role">
                                <option value="" selected="true" disabled>- Pilih Role -</option>
                                <option {{ old('role', @$user->role) == 'SuperAdmin' ? 'selected' : '' }}
                                    value="SuperAdmin">SuperAdmin
                                </option>
                                <option {{ old('role', @$user->role) == 'Admin' ? 'selected' : '' }} value="Admin">
                                    Admin
                                </option>
                                <option {{ old('role', @$user->role) == 'Manager' ? 'selected' : '' }} value="Manager">
                                    Manager
                                </option>
                                <option {{ old('role', @$user->role) == 'SPV' ? 'selected' : '' }} value="SPV">
                                    SPV
                                </option>
                                <option {{ old('role', @$user->role) == 'Staff' ? 'selected' : '' }} value="Staff">
                                    Staff
                                </option>
                            </select>
                            @if ($errors->has('role'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('role') }}
                                </div>
                            @endif
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="custom-select rounded-0  @error('jenis_kelamin') is-invalid  @enderror"
                                id="jenis_kelamin" name="jenis_kelamin">
                                <option value="" selected="true" disabled>- Pilih Jenis Kelamin -</option>
                                <option
                                    {{ old('jenis_kelamin', @$user->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}
                                    value="Laki-laki">Laki-laki
                                </option>
                                <option
                                    {{ old('jenis_kelamin', @$user->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}
                                    value="Perempuan">Perempuan
                                </option>
                            </select>
                            @if ($errors->has('jenis_kelamin'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('jenis_kelamin') }}
                                </div>
                            @endif
                        </div> --}}
                        <div class="form-group mb-0" style="display: flex; justify-content:end">
                            <button type="submit" class="btn btn-md btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
