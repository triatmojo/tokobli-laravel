@extends('layouts.success')

@section('title')
    tokobli - success page
@endsection

@section('content')
<!-- Page Content -->
    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/images/icons/success.svg" alt="success-image">
                        <h2>Welcome to tokobli</h2>
                        <p>
                           Kamu sudah berhasil terdaftar<br>
                           bersama kami. Let's grow up now.
                            
                        </p>
                        <div>
                            <a href="#" class="btn btn-success w-50 mt-4">My Dashboard</a>
                            <a href="{{ route('home') }}" class="btn btn-signup w-50 mt-2">Go To Shooping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection