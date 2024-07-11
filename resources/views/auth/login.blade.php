@extends('layouts.template_login')
@section('content')
    <style>
        .col-lg-6 img {
            max-width: 80%;
            max-height: 100%;
            display: block;
            margin: auto;
        }

        .login-page {
            overflow: hidden;
            background-image: url('{{ asset('img/backgrounds/bg-login.jpg') }}');
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center top;
            z-index: 30;
            background-color: rgba(0, 0, 0, 1);
            /* Menggeser background ke atas */
            /* padding: 10px; */
        }
    </style>
    <div class="login-page">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-8">
                <div class="card o-hidden border-0 shadow-lg my-5" style="background-color:rgba(255, 255, 255, 0.6)">
                    <script>
                        $(function() {
                            @if (session('type'))
                                showMessage('{{ session('type') }}', '{{ session('text') }}');
                            @endif
                        });
                    </script>
                    <div class="card-body p-0">
                        <div class="teks mt-3">
                            <h5
                                style="text-align: center; margin-top:10px; font-family: Verdana, Geneva, Tahoma, sans-serif;color:#000">
                                Sistem Management Stok <br> StockMat</h5>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('img/backgrounds/logo.png') }}" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username">{{ __('Username') }}</label>
                                            <input id="username" type="text"
                                                class="form-control @error('username') is-invalid @enderror" name="username"
                                                value="{{ old('username') }}" required autocomplete="username" autofocus>

                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">{{ __('Password') }}</label>
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror" name="password"
                                                required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-user btn-block"
                                            style="font-size: 17px; background-color:#4e73df; color:#fff">
                                            {{ __('Login') }}
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
