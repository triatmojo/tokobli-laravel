@extends('layouts.success')

@section('title')
    tokobli - success checkout
@endsection

@section('content')
<!-- Page Content -->
    <div class="page-content page-success">
        <div class="section-success" data-aos="zoom-in">
            <div class="container">
                <div class="row align-items-center row-login justify-content-center">
                    <div class="col-lg-6 text-center">
                        <img src="/images/icons/success.svg" alt="success-image">
                        <h2>Transaction Processed!</h2>
                        <p>
                            Silahkan tunggu konfirmasi email dari kami dan <br>
                            kami akan menginformasikan resi secept mungkin!
                        </p>
                        <div>
                            <a href="{{ route('dashboard') }}" class="btn btn-success w-50 mt-4">My Dashboard</a>
                            <a href="{{ route('home') }}" class="btn btn-signup w-50 mt-2">Go To Shooping</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection