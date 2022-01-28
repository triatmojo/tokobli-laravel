@extends('layouts.dashboard')

@section('title')
tokobli - Transactions
@endsection

@section('content')
   <!-- Section Content -->
                <div class="section-content section-dashboard-home" data-aos="fade-up">
                    <div class="container-fluid">
                        <div class="dashboard-heading">
                            <h2 class="dashboard-title">Transactions</h2>
                            <p class="dashboard-subtitle">Big result start from the small one</p>
                        </div>
                        <div class="dashboard-content">
                            <div class="row mt-3">
                                <div class="col-12 mt-2">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="sell-product-tab" data-toggle="pill"
                                                href="#sell-product" role="tab" aria-controls="sell-product"
                                                aria-selected="true">Sell Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="buy-product-tab" data-toggle="pill"
                                                href="#buy-product" role="tab" aria-controls="buy-product"
                                                aria-selected="false">Buy Product</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="sell-product" role="tabpanel"
                                            aria-labelledby="sell-product-tab">
                                            @foreach ($sellTransactions as $transaction)
                                                  <a href="{{ route('dashboard-transactions-details', $transaction->id) }}"
                                                    class="card card-list d-block">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <img src="{{ Storage::url($transaction->product->galleries->first()->photo) ?? '' }}">
                                                            </div>
                                                            <div class="col-md-4">{{ $transaction->product->name }}</div>
                                                            <div class="col-md-3">{{ $transaction->product->user->store_name }}</div>
                                                            <div class="col-md-3">{{ $transaction->created_at->format('d F, Y') }}</div>
                                                            <div class="col-md-1 d-none d-md-block">
                                                                <img src="/images/icons/ic-row-right.svg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </a>                                                
                                            @endforeach

                                            <div class="row justfiy-content-center">
                                                <div class="col-md-4">
                                                    <div class="link text-center">
                                                        {{ $sellTransactions->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="buy-product" role="tabpanel"
                                            aria-labelledby="buy-product-tab">
                                            @foreach ($buyTransactions as $transaction)
                                                <a href="{{ route('dashboard-transactions-details', $transaction->id) }}"
                                                    class="card card-list d-block">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-1">
                                                                <img src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}">
                                                            </div>
                                                            <div class="col-md-4">{{ $transaction->product->name }}</div>
                                                            <div class="col-md-3">{{ $transaction->product->user->store_name }}</div>
                                                            <div class="col-md-3">{{ $transaction->created_at->format('d F, Y') }}</div>
                                                            <div class="col-md-1 d-none d-md-block">
                                                                <img src="/images/icons/ic-row-right.svg" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                 </a>         
                                            @endforeach         
                                        </div>
                                        <div class="row justfiy-content-center">
                                                <div class="col-md-4">
                                                    <div class="link text-center">
                                                        {{ $sellTransactions->links() }}
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row justfiy-content-center">
                                            <div class="col-md-4">
                                                <div class="link text-center">
                                                    {{ $buyTransactions->links() }}
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