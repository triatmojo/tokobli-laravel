@extends('layouts.dashboard')

@section('title')
    tokobli - Setting Account
@endsection

@section('content')
    <!-- Section Content -->
                <div class="section-content section-dashboard-home" data-aos="fade-up">
                    <div class="container-fluid">
                        <div class="dashboard-heading">
                            <h2 class="dashboard-title">My Account</h2>
                            <p class="dashboard-subtitle">Update your current profile</p>
                        </div>
                        <div class="dashboard-content">
                            <div class="row">
                                <div class="col-12">
                                    <form action="{{ route('dashboard-setting-update', 'dashboard-setting-account') }}" method="POST" enctype="multipart/form-data" id="locations">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="name">Your Name</label>
                                                            <input type="text" name="name" id="name"
                                                                class="form-control" value="{{ $users->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">Your Email</label>
                                                            <input type="email" name="email" id="email"
                                                                class="form-control" value="{{ $users->email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address_one">Address 1</label>
                                                            <input type="text" name="address_one" id="address_one"
                                                                class="form-control" value="{{ $users->address_one }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="address_two">Address 2</label>
                                                            <input type="text" name="address_two" id="address_two"
                                                                class="form-control" value="{{ $users->address_one }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="provinces_id">Province</label>
                                                            <select class="form-control" name="provinces_id" id="provinces_id" v-if="provinces" v-model="provinces_id">
                                                                <option value="{{ $province->id}}">
                                                                    {{ $province->name }}
                                                                </option>
                                                                <option v-for="province in provinces" :value="province.id">
                                                                    @{{ province.name }}
                                                                </option>
                                                            </select>
                                                            <select v-else class="form-control"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="regencies_id">City</label>
                                                            <select class="form-control" name="regencies_id" id="regencies_id" v-if="regencies" v-model="regencies_id">
                                                                <option value="{{ $regency->id }}"></option>
                                                                <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                                            </select>
                                                            <select v-else class="form-control"></select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="zip_code">Postal Code</label>
                                                            <input type="number" name="zip_code" id="zip_code"
                                                                class="form-control" value="{{ $users->zip_code }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="country">Country</label>
                                                            <input type="text" name="country" id="country"
                                                                class="form-control" value="{{ $users->country }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="phone_number">Phone</label>
                                                            <input type="number" name="phone_number" id="phone_number"
                                                                class="form-control" value="{{ $users->phone_number }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col text-right">
                                                        <button class="btn btn-success px-5">Save Now</button>
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
   <script src="/vendor/vue/vue.js"></script>
   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>  

   <script>
       var locations = new Vue({
        el: '#locations',
        // Run
        mounted() {
            this.getProvinciesData();
             AOS.init();
        },
        // Data
        data() {
            return {
                provinces: null,
                regencies: null,
                provinces_id: null,
                regencies_id: null
            }
        },
        // function
        methods: {
            getProvinciesData() {
                var self = this;
                axios.get('{{ route('api-provinces') }}')
                    .then(function(response){
                        self.provinces = response.data;
                    });
            },
            getRegenciesData() {
                var self = this;
                axios.get('{{ url('api/regencies') }}/' + self.provinces_id)
                    .then(function(response){
                        console.log(response.data)
                        self.regencies = response.data;
                });
            },
        },
        // Suatu reaksi terhadap perubahan data tertentu
        watch: {
            provinces_id: function(val, oldVal) {
                this.regencies_id = null;
                this.getRegenciesData();
            }
        },
       });
   </script>
@endpush
  