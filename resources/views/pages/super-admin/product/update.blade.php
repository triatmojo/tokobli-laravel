@extends('layouts.admin')

@section('title')
    Admin - Update Product
@endsection

@section('content')
   <div class="content-wrapper container">
       <div class="page-heading">
           <h3>Update Product</h3>
       </div>
       <div class="page-content">
           <div class="row" data-aos="fade-up" data-aos-delay="100">
               <div class="col-12 col-lg-12">
                    @if ($errors->any())
                        <div class="aler alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                   @endif
                   <div class="card">
                       <div class="card-header">
                           <h4>Form Product</h4> 
                       </div>
                       <div class="card-body">
                           <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Please enter product name" value="{{ $product->name }}">
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">Product Price</label>
                                            <input type="text" name="price" id="price" class="form-control" placeholder="Please enter price"value="{{ $product->price }}">
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="users_id">Owner</label>
                                            <select name="users_id" id="users_id" class="form-select">
                                                <option value="{{ $product->users_id }}">{{ $product->user->name }}</option>
                                               @foreach ($users as $user)
                                                    <option value="{{ $user->id }}" selected>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="categories_id">Category</label>
                                            <select name="categories_id" id="categories_id" class="form-select">
                                                <option value="{{ $product->categories_id }}">
                                                    {{ $product->category->name }}
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">
                                                        {{ $category->name }}
                                                    </option>   
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                     <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" name="description" id="description">{!! $product->description !!}</textarea>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-success px-5">Save Now</button>
                                    </div>
                                </div>
                            </form>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
    <script>
     CKEDITOR.replace('description');
    </script>
@endpush

