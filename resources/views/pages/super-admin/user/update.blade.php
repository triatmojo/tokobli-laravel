@extends('layouts.admin');

@section('title')
    Admin - Update User
@endsection

@section('content')
   <div class="content-wrapper container">
       <div class="page-heading">
           <h3>Update User</h3>
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
                           <h4>Form User</h4> 
                       </div>
                       <div class="card-body">
                           <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT');
                                @csrf
                              <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Your Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required value="{{ $item->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Your Email</label>
                                            <input type="email" name="email" id="email" class="form-control" required value="{{ $item->email }}">
                                        </div>
                                    </div>
                                     <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                            <span class="text-muted">Kosongkan jika tidak mengganti password</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="form-group">
                                            <label for="roles">Access</label>
                                            <select name="roles" id="roles" class="form-select">
                                                <option value="{{ $item->roles }}" selected>Tidak diganti</option>
                                                <option value="ADMIN">Admin</option>
                                                <option value="USER">User</option>
                                            </select>
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

