@extends('layouts.dashboard')

@section('title')
    tokobli - Transactions Details
@endsection

@section('content')
       <!-- Section Content -->
                <div class="section-content section-dashboard-home" data-aos="fade-up">
                    <div class="container-fluid">
                        <div class="dashboard-heading">
                            <h2 class="dashboard-title">#{{ $transaction->transaction->code }}</h2>
                            <div class="store-breadcrumbs">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="/dashboard-transactions.html">
                                            Transactions
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Details</li>
                                </ol>
                            </div>
                        </div>
                        <div id="transactionDetails" class="dashboard-content">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 col-md-4">
                                                    <img src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}" class="w-100 mb-3" alt="">
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="transaction-detail-title">Customer</div>
                                                            <div class="transaction-detail-subtitle">{{ $transaction->transaction->user->name }}</div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="transaction-detail-title">Product Name</div>
                                                            <div class="transaction-detail-subtitle">{{ $transaction->product->name }}
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="transaction-detail-title">Date of Transactions
                                                            </div>
                                                            <div class="transaction-detail-subtitle">{{ $transaction->created_at->format('d F, Y') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="transaction-detail-title">Payment Status</div>
                                                            <div class="transaction-detail-subtitle text-danger">
                                                                {{ $transaction->transaction->transaction_status }}</div>

                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="transaction-detail-title">Total Amount</div>
                                                            <div class="transaction-detail-subtitle">{{ currency_IDR($transaction->transaction->total_price) }}
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="transaction-detail-title">Mobile</div>
                                                            <div class="transaction-detail-subtitle">{{ $transaction->transaction->user->phone_number }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 mt-4">
                                                    <div class="col-12">
                                                        <h5>Shipping Informations</h5>
                                                        <form action="{{ route('dashboard-transactions-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                            <div class="col-12 col-md-6">
                                                                <div class="transaction-detail-title">Address 1</div>
                                                                <div class="transaction-detail-subtitle">
                                                                    {{ $transaction->transaction->user->address_one }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="transaction-detail-title">Address 2</div>
                                                                <div class="transaction-detail-subtitle">
                                                                    {{ $transaction->transaction->user->address_two }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="transaction-detail-title">Province</div>
                                                                <div class="transaction-detail-subtitle">
                                                                    {{ App\Models\Province::find($transaction->transaction->user->provinces_id)->name ?? null  }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="transaction-detail-title">City</div>
                                                                <div class="transaction-detail-subtitle">
                                                                    {{ App\Models\Regency::find($transaction->transaction->user->regencies_id)->name ?? null  }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="transaction-detail-title">Postal Code</div>
                                                                <div class="transaction-detail-subtitle">
                                                                    {{ $transaction->transaction->user->zip_code }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-6">
                                                                <div class="transaction-detail-title">Country</div>
                                                                <div class="transaction-detail-subtitle">
                                                                    {{ $transaction->transaction->user->country }}
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-md-3">
                                                                <div class="transaction-detail-title">Shipping Status</div>
                                                                <select name="shipping_status" id="transactionDetails" class="form-control"
                                                                    v-model="status">
                                                                    <option value="PENDING">Pending</option>
                                                                    <option value="SHIPPING">Shipping</option>
                                                                    <option value="SUCCESS">Success</option>
                                                                </select>
                                                            </div>
                                                            <template v-if="status == 'SHIPPING'">
                                                                <div class="col-md-3">
                                                                    <div class="transaction-detail-title">Input Resi
                                                                    </div>
                                                                    <input type="text" name="resi" id="resi"
                                                                        class="form-control" v-model="resi">
                                                                </div>
                                                                {{-- <div class="col-md-2">
                                                                    <button type="submit"
                                                                        class="btn btn-success btn-block mt-4">Update
                                                                        Resi</button>
                                                                </div> --}}
                                                            </template>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-12 text-right">
                                                                <button class="btn btn-success mt-4">Save Now</button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var transactionDetails = new Vue({
            el: '#transactionDetails',
            data: {
                status: "{{ $transaction->shipping_status }}",
                resi: "{{ $transaction->resi }}"
            },
        });
    </script>
@endpush

