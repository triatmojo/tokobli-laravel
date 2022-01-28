@extends('layouts.admin');

@section('title')
    Admin - User
@endsection

@section('content')
   <div class="content-wrapper container">
       <div class="page-heading">
           <h3>Users</h3>
       </div>
       <div class="page-content">
           <div class="row" data-aos="fade-up" data-aos-delay="100">
               <div class="col-12 col-lg-12">
                   <div class="card">
                       <div class="card-header">
                           <a href="{{ route('user.create') }}" class="btn btn-primary">
                             + Add New User
                           </a>
                       </div>
                       <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover w-100" id="crudTable">
                                  <thead>
                                      <tr>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Roles</th>
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
                url: '{!! route('user.index') !!}',
            },
            columns: [
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email'},
                {data: 'roles', name: 'roles'},
                {data: 'action', name: 'action', orderable:false, searcable: false, width: '15%'} 
            ]
        });
    </script>
@endpush
