@extends('layouts.dashboard')

@section('title')
    tokobli - Setting Store
@endsection

@section('content')
     <!-- Section Content -->
                <div class="section-content section-dashboard-home" data-aos="fade-up">
                    <div class="container-fluid">
                        <div class="dashboard-heading">
                            <h2 class="dashboard-title">Store Settings</h2>
                            <p class="dashboard-subtitle">Make store that profitable</p>
                        </div>
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('dashboard-setting-update', 'dashboard-setting-store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="store_name">Store Name</label>
                                                            <input type="text" name="store_name" id="store_name"
                                                                class="form-control" value="{{ $users->store_name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select name="categories_id" class="form-control">
                                                                <option value="{{ $users->categories_id }}">
                                                                    Tidak diganti
                                                                </option>
                                                                @foreach ($categories as $category)
                                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Store Status</label>
                                                            <p class="text-muted">
                                                                Apakah saat ini Anda buka?
                                                            </p>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" class="custom-control-input"
                                                                    name="store_status" id="openStoreTrue" value="1" {{ $users->store_status == 1 ? 'checked' : '' }}>
                                                                <label for="openStoreTrue"
                                                                    class="custom-control-label">Buka</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" class="custom-control-input"
                                                                    name="store_status" id="openStoreFalse"
                                                                    value="0" {{ $users->store_status == 0 || $users->store_status == NULL ? 'checked' : '' }}>
                                                                <label for="openStoreFalse"
                                                                    class="custom-control-label">Tutup Sementara</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <button type="submit" class="btn btn-success px-5">Save Now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>   
@endsection
  