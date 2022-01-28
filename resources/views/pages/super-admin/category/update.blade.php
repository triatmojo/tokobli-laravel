@extends('layouts.admin');

@section('title')
    Admin - Update Category
@endsection

@section('content')
   <div class="content-wrapper container">
       <div class="page-heading">
           <h3>Update Category</h3>
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
                           <h4>Form Categories</h4> 
                       </div>
                       <div class="card-body">
                           <form action="{{ route('category.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name">Name Category</label>
                                            <input type="text" name="name" id="name" class="form-control" value="{{ $item->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="photo">Photo</label>
                                            <input type="file" name="photo" id="photo" class="form-control">
                                        </div>
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

