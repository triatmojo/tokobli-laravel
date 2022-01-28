@extends('layouts.admin')

@section('title')
    Admin - Product Gallery
@endsection

@section('content')
   <div class="content-wrapper container">
       <div class="page-heading">
           <h3>Product Gallery</h3>
       </div>
       <div class="page-content">
           <div class="row" data-aos="fade-up" data-aos-delay="100">
               <div class="col-12 col-lg-12">
                   <div class="card">
                       <div class="card-header">
                           <a href="{{ route('product-gallery.create') }}" class="btn btn-primary"> + Add New Product Gallery</a>
                       </div>
                       <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-hover w-100" id="crudTable">
                                  <thead>
                                      <tr>
                                          <th>Product</th>
                                          <th>Photos</th>
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
                url: '{!! route('product-gallery.index') !!}',
            },
            columns: [
                {data: 'product.name', name: 'product.name'},
                {data: 'photo', name: 'photo'},
                {data: 'action', name: 'action', orderable:false, searcable: false, width: '15%'} 
            ]
            
        });
    </script>
@endpush
