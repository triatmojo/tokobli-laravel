@extends('layouts.app')

@section('title')
    tokobli - cart
@endsection

@section('content')
    {{-- Cart --}}
    <div class="page-content page-carts">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-12 table-responsive">
                        <table class="table table-borderless table-cart">
                            <thead>
                                <th scope="col">Image</th>
                                <th scope="col">Name &amp; Seller</th>
                                <th scope="col">Price</th>
                                <th scope="col">Menu</th>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                @endphp
                                @forelse ($carts as $cart)
                                    <tr>
                                        <td style="width: 20%;">
                                            @if($cart->product->galleries)
                                                <img src="{{ Storage::url($cart->product->galleries->first()->photo) }}" alt="cart-image" class="cart-image">
                                            @endif
                                        </td>
                                        <td style="width:35%;">
                                            <div class="product-title">{{ $cart->product->name }}
                                            </div>
                                            <div class="product-subtitle">By {{ $cart->user->store_name }}</div>
                                        </td>
                                        <td style="width:35%;">
                                            <div class="product-title">{{ currency_IDR($cart->product->price) }}
                                            </div>
                                            <div class="product-subtitle">Rupiah</div>
                                        </td>
                                        <td style="width: 20%;">
                                            <form action="{{ route('delete-cart', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                                <button type="submit" class="btn btn-remove-cart">
                                                    Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @php $totalPrice = $totalPrice + $cart->product->price @endphp
                                @empty
                                     <tr class="text-center">
                                        <td colspan="4">Opzz keranjang belanjaanmu kosong!</td>
                                     </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Shipping Details</h2>
                    </div>
                </div>
                <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data" id="locations">
                    @csrf
                    <div class="row" data-aos="fade-up" data-aos-delay="200">
                        <input type="hidden" id="totalPrice" name="total_price" value="{{ $totalPrice }}">
                        <input type="hidden" id="totalPay" name="total_pay" value="{{ $totalPrice }}">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="addressOne">Address 1</label>
                                <input type="text" value="Gadens At Candi Sawangan" name="addressOne" id="addressOne"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="addressTwo">Address</label>
                                <input type="text" value="Block D3 No.28" name="addressTwo" id="addressTwo"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinces_id">Province</label>
                                <select name="provinces_id" id="provinces_id" v-if="provinces" v-model="provinces_id" class="form-control">
                                    <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                                <label for="regencies_id">City</label>
                                <select name="regencies_id" @change="getCourier()" id="regencies_id" v-if="regencies" v-model="city_id" class="form-control">
                                    <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                                </select>
                                <select v-else class="form-control"></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="postalCode">Postal Code</label>
                                <input type="number" value="16320" name="postalCode" id="postalCode" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" value="Indonesia" name="country" id="country" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="Mobile">Mobile</label>
                                <input type="number" value="08271212389" name="mobile" id="mobile" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" v-if="courier">
                                <label class="font-weight-bold">KURIR PENGIRIMAN</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input select-courier" name="courier" id="ongkos_kirim-jne" value="jne" @change="getOngkir()" v-model="courier_type">
                                    <label for="ongkos_kirim-jne" class="form-check-label font-weight bold mr-4">
                                        JNE
                                    </label>
                                    <input type="radio" class="form-check-input select-courier" name="courier" id="ongkos_kirim-tiki" value="tiki" @change="getOngkir()" v-model="courier_type">
                                    <label for="ongkos_kirim-tiki" class="form-check-label font-weight bold mr-4">
                                        TIKI
                                    </label>
                                    <input type="radio" class="form-check-input select-courier" name="courier" id="ongkos_kirim-pos" value="pos" @change="getOngkir()" v-model="courier_type">
                                    <label for="ongkos_kirim-pos" class="form-check-label font-weight bold mr-4">
                                        POS
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group" v-if="cost">
                                <label class="font-weight-bold">SERVICE KURIR</label>
                                <div 
                                v-for="value in costs"
                                class="form-check form-check-inline" 
                                :key="value.service">
                                    <input 
                                    type="radio" 
                                    name="cost" 
                                    class="form-check-input"
                                    :id="value.service"
                                    :value="value.cost[0].value + '|' + value.service" 
                                    v-model="costService" 
                                    @change="getCostService()">

                                    <label class="form-check-label font-weight-normal mr-5">
                                        @{{ value.service }} - Rp. @{{ value.cost[0].value }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <h2>Payment Informations</h2>
                        </div>
                    </div>
                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-4 col-md-2">
                            <div class="product-title">Rp.0</div>
                            <div class="product-subtitle">Country Tax</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="product-title">Rp.0</div>
                            <div class="product-subtitle">Product Insurance</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title" id="courier_cost">Rp.0</div>
                            <div class="product-subtitle">Shipping to <p id="tujuan"></p></div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="product-title text-success" id="totalPembayaran">{{ currency_IDR($totalPrice) }}</div>
                            <div class="product-subtitle">Total</div>
                        </div>
                        <div class="col-8 col-md-3">
                            <button type="submit" class="btn btn-success text-white mt-4 px-4 btn-block ">Checkout Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>


    </div>
@endsection
 

@push('addon-script')
   <script src="/vendor/vue/vue.js"></script>
   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
   <script>
        $(document).ready(function(){
            $('.provinces_id').select2();
        });   
    </script>  
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
                courier: false,
                courier_cost: 0,
                courier_service: "",
                cost: false,
                costs: [],
                costService: null,
                provinces: null,
                regencies: null,
                provinces_id: null,
                city_id: null,
                courier_type: null,
                checkout: null,
            }
        },
        // function
        methods: {
            getCourier() {
                var self = this;
                self.courier = true;
                
                axios.get('{{ url('api/city_id') }}/' + self.city_id)
                     .then(function(response){
                        self.city = response.data.name;
                        document.getElementById("tujuan").innerHTML = response.data.name;
                });
                console.log(self.city_id);
            },
            getOngkir() {
                var self = this;

                axios.post('{{ route('api-checkOngkir') }}', {
                    city_destination: self.city_id,
                    courier: self.courier_type,
                }).then((response) => {
                    self.cost = true;
                    self.costs = response.data.data[0].costs;
                    // console.log(response.data.data[0].costs);
                }).catch((error) => {
                    console.log(error);
                })
            },
            getCostService() {
                var self = this;

                let shipping = self.costService.split('|');

                self.checkout = true;

                self.courier_cost = shipping[0];
                self.courier_service = shipping[1];
                let total = document.getElementById('totalPay').value;

                let formatCost = new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 5 }).format(self.courier_cost);
                document.getElementById('courier_cost').innerHTML = `Rp ${formatCost}`;

                let totalPayment = parseInt(total) + parseInt(self.courier_cost);
                let formatPayment = new Intl.NumberFormat('id-ID', { maximumSignificantDigits: 6 }).format(totalPayment);
                // console.log("total " + totalPayment);
                document.getElementById('totalPembayaran').innerHTML = `Rp ${formatPayment}`;
            
                document.getElementById('totalPrice').value = totalPayment;
            },
            getProvinciesData() {
                var self = this;
                axios.get('{{ route('api-provinces') }}')
                    .then(function(response){
                        self.provinces = response.data;
                    });
            },
            getRegenciesData() {
                var self = this;
                axios.get('{{ url('api/city') }}/' + self.provinces_id)
                    .then(function(response){
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