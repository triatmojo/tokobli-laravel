@extends('layouts.dashboard')

@section('title')
    tokobli - Dashboard
@endsection

@section('content')
      <!-- Section Content -->
                <div class="section-content section-dashboard-home" data-aos="fade-up">
                    <div class="container-fluid">
                        <div class="dashboard-heading">
                            <h2 class="dashboard-title">Create New Product</h2>
                            <p class="dashboard-subtitle">Create your own product</p>
                        </div>
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('dashboard-products-store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="users_id" value="{{ Auth::user()->id }}">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Product Name</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control @error('name') is-invalid @enderror">
                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="price">Price</label>
                                                            <input type="number" name="price" id="price"
                                                                class="form-control @error('price') is-invalid @enderror">
                                                              @error('price')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Category</label>
                                                            <select name="categories_id" class="form-control @error('categories_id') is-invalid @enderror">
                                                                <option value="">Select Category</option>
                                                                @foreach ($categories as $category)
                                                                   <option value="{{ $category->id }}">{{ $category->name }}</option>     
                                                                @endforeach
                                                            </select>
                                                            @error('categories_id')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="description">Descriptions</label>
                                                            <textarea class="form-control @error('description') is-invalid @enderror"         
                                                                      name="description"
                                                                      id="description">
                                                            </textarea>
                                                            @error('description')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="photo">Thumbnail</label>
                                                            <input type="file" class="form-control" name="photo"
                                                                id="photo" multiple>
                                                            <p class="text-muted mt-2">
                                                                Kamu dapat memilih banyak lebih dari satu file
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <button type="submit" class="btn btn-success px-5">
                                                            Save Now
                                                        </button>
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

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description');

    </script>
@endpush