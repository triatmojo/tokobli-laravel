@extends('layouts.admin');

@section('title')
    Admin - Category
@endsection

@section('content')
   <div class="content-wrapper container">
       <div class="page-heading">
           <h3>Categories</h3>
       </div>
       <div class="page-content">
           <div class="row" data-aos="fade-up" data-aos-delay="100">
               <div class="col-12 col-lg-12">
                   <div class="card">
                       <div class="card-header">
                           <a href="{{ route('category.create') }}" class="btn btn-primary"> + Add New Category</a>
                       </div>
                       <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover w-100" id="crudTable">
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Photo</th>
                                          <th>Slug</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      
                                  </tbody>
                              </table>
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
        var datatable = $('#crudTable').DataTable({
            proccesing:true,
            serverSide:true,
            ordering:true,
            ajax:{
                url: '{!! route('category.index') !!}',
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'photo', name: 'photo'},
                {data: 'slug', name: 'slug'},
                {data: 'action', name: 'action', orderable:false, searcable: false, width: '15%'} 
            ]
        });
    </script>
@endpush
