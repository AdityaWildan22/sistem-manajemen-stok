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
@endsection
