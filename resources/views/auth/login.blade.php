@extends('layouts.auth')

@section('content')
 <!-- Page Content -->
    <div class="page-content page-auth">
        <div class="section-store-register" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-6">
                        <img class="w-75 mb-4 mb-lg-none" src="/images/banner/auth-placeholder.jpg" alt="auth-image">
                    </div>
                    <div class="col-lg-5">
                        <h2>Belanja kebutuhan utama, menjadi lebih mudah</h2>
                        <form method="POST" action="{{ route('login') }}" class="mt-3">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input id="email" type="email" class="form-control w-75 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control w-75 @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block w-75 mt-4">
                                    Signin to My Account
                                </button>
                                <a href="{{ url('register') }}" class="btn btn-signup btn-block w-75">Sign Up</a>

                                <hr class="ml-0 mt-4 mb-4" style="width: 75%">

                                <a href="{{ url('auth/google') }}" class="btn btn-google text-white btn-block w-75">
                                   <img src="/images/icons/ic_google.svg" class="mr-2" alt="google"> Sign In / Register
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
