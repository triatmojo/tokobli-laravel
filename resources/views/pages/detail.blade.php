@extends('layouts.app')

@section('title')
    tokobli - detail
@endsection

@section('content')
{{-- Detail --}}
    <div class="page-content page-details">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}l">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Product Detail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <section class="store-galleries" id="gallery" data-aos="fade-up">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8" data-aos="zoom-in">
                        <transition name="slide-fade" mode="out-in">
                            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image"
                                alt="">
                        </transition>
                    </div>
                    <div class="col-lg-2">
                        <div class="row">
                            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id"
                                data-aos="zoom-in" data-aos-delay="100">

                                <a href="#" @click="changeActive(index)">
                                    <img :src="photo.url" class="w-100 thumbnail-image"
                                        :class="{active: index == activePhoto}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="store-details-container mt-4" data-aos="fade-up" data-aos-delay="100">
            <section class="store-heading">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1>{{ $product->name }}</h1>
                            <div class="owner">By {{ $product->user->store_name }}</div>
                            <div class="price">{{ currency_IDR($product->price) }}</div>
                        </div>
                        <div class="col-lg-2" data-aos="zoom-in">
                            @auth
                                <form action="{{ route('product-detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <button type="submit" class="btn btn-success text-white px-4 btn-block">Add to Cart</button> 
                                </form>
                            @else   
                                <a href="{{ route('login') }}" class="btn btn-success text-white px-4 btn-block mb-3">Add to Cart</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </section>

            <section class="store-description">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
            </section>
            <section class="store-review" data-aos="fade-up">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-8 mt-3 mb-3">
                            <h5>Review Product (3)</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-8">
                            <ul class="list-unstyled">
                                <li class="media">
                                    <img src="/images/icons/pic.png" class="rounded-circle mr-3" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Anonymous</h5>
                                        Barang original dan sampai thx
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/icons/pic-1.png" class="rounded-circle mr-3" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Arif Hidayat</h5>
                                        Alhamdulillah toko Tidak mengecawakan
                                    </div>
                                </li>
                                <li class="media">
                                    <img src="/images/icons/pic-2.png" class="rounded-circle mr-3" alt="">
                                    <div class="media-body">
                                        <h5 class="mt-2 mb-1">Muthia Fadlan</h5>
                                        Seller cepet response dan tidak mengecewakan puass pokoknya
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
        var gallery = new Vue({
            el: "#gallery",
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach($product->galleries as $gallery) 
                    {   
                        id: {{ $gallery->id }},
                        url: "{{ Storage::url($gallery->photo) }}",
                    },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                }
            }

        });
    </script>
@endpush
 