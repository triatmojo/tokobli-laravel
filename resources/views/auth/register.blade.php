@extends('layouts.auth')

@section('title')
    tokobli - register
@endsection

@section('content')
  <!-- Page Content -->
    <div class="page-content page-auth mt-5" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center justify-content-center row-register">
                    <div class="col-lg-4">
                        <h2>Memulai untuk jual beli dengan cara terbaru</h2>
                        <form method="POST" action="{{ route('register') }}" class="mt-3">
                             @csrf
                            <div class="form-group">
                                <label>Full Name</label>
                                <input 
                                type="text" 
                                name="name"
                                autofocus 
                                v-model="name" 
                                class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name') }}" 
                                autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                               <input 
                               type="email" 
                               name="email"
                               @change="checkForEmail()"  
                               autofocus 
                               v-model="email" 
                               :class="{'is-invalid' : this.email_unavailable}"
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email') }}" 
                               autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                 <input type="password" name="password" autofocus v-model="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" autocomplete="password">
                                @error('password')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                 <input type="password" name="password_confirmation" autofocus v-model="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}" autocomplete="password_confirmation">
                                @error('password_confirmation')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Store</label>
                                <p class="text-muted">Apakah anda juga ingin membuka toko?</p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="is_store_open"
                                        id="openStoreTrue" v-model="is_store_open" :value="true">
                                    <label for="openStoreTrue" class="custom-control-label">Iya, boleh</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="is_store_open"
                                        id="openStoreFalse" v-model="is_store_open" :value="false">
                                    <label for="openStoreFalse" class="custom-control-label">Tidak, makasih</label>
                                </div>
                            </div>
                            <div class="form-group" v-if="is_store_open" data-aos="fade-up">
                                <label>Nama Toko</label>
                                <input type="text" name="store_name" autofocus v-model="store_name" class="form-control @error('store_name') is-invalid @enderror" value="{{ old('store_name') }}" autocomplete="store_name">
                                @error('store_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group" v-if="is_store_open" data-aos="fade-up">
                                <label>Category</label>
                                <select name="categories_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" :disabled="this.email_unavailable"  class="btn btn-success btn-block mt-4">
                                    Sign Up Now
                                </button>
                                <a href="{{ url('login') }}" class="btn btn-signup btn-block">Back Sign In</a>
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
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        AOS.init();
    </script>
    <script>
        Vue.use(Toasted);

        var register = new Vue({
            el: "#register",
            mounted() {
                AOS.init();
            },
            methods: {
                checkForEmail: function() {
                    var self = this;
                    axios.get('{{ route('api-register-check') }}', {
                        params: {
                            email: self.email
                        }
                    })
                    .then(function(response){
                        // Handle success
                        if(response.data == 'Available') {
                             self.$toasted.show(
                                "Email anda tersedia, Silahkan lanjutkan langkah pendaftaran.", {
                                 position: "top-center",
                                 className: "rounded",
                                 duration: 2000,
                                }
                             );
                             self.email_unavailable = false;
                        } else {
                            self.$toasted.error(
                                "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
                                 position: "top-center",
                                 className: "rounded",
                                 duration: 2000,
                                }
                             );
                             self.email_unavailable = true;
                        }
                        // console.log(response);
                    })
                    
                }
            },
            data() {
                return {
                    name: "",
                    email: "",
                    is_store_open: true,
                    store_name: "",
                    email_unavailable: true,
                }
            }
        })
    </script>
@endpush
