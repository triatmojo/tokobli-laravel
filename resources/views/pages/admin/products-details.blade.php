@extends('layouts.dashboard')

@section('title')
    tokobli - Dashboard
@endsection

@section('content')
     <!-- Section Content -->
                <div class="section-content section-dashboard-home" data-aos="fade-up">
                    <div class="container-fluid">
                        <div class="dashboard-heading">
                            <h2 class="dashboard-title">{{ $products->name}}</h2>
                            <p class="dashboard-subtitle">Product Details</p>
                        </div>
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('dashboard-products-update', $products->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Product Name</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control" value="{{ $products->name }}">
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="price">Price</label>
                                                            <input type="number" name="price" id="price"
                                                                class="form-control" value={{ $products->price }}>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select name="categories_id" class="form-control">
                                                                <option value="{{ $products->category->id }}">{{  $products->category->name}}</option>
                                                                @foreach ($categories as $category)
                                                                   <option value="{{ $category->id }}">{{ $category->name }}</option>     
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="description">Descriptions</label>
                                                            <textarea class="form-control" name="description"
                                                                id="description">{!!  $products->description  !!}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-success btn-block px-5">
                                                            Save Now
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                @foreach ($products->galleries as $gallery)
                                                    <div class="col-md-4 mb-3">
                                                        <div class="gallery-container">
                                                            <img src="{{ Storage::url($gallery->photo ?? '') }}" alt="product-image" class="w-100">
                                                            <a href="{{ route('dashboard-products-delete-gallery', $gallery->id) }}" class="delete-gallery">
                                                                <img src="/images/icons/ic-delete.svg" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-12 mt-3">
                                                <form action="{{ route('dashboard-products-upload-gallery') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="products_id" id="products_id" value="{{ $products->id }}">

                                                    <input type="file" name="photo" id="file" style="display: none;" onchange="form.submit()">

                                                    <button class="btn btn-secondary btn-block" type="button" onclick="thisFileUpload()">
                                                        Add Photo
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

@push('addon-script')
    <script>
        function thisFileUpload() {
            document.getElementById('file').click();
        }

    </script>
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');
    </script>
@endpush
  