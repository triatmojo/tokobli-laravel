@extends('layouts.app')

@section('title')
    tokobli - categories
@endsection

@section('content')
 <!-- Page Content -->
    <div class="page-content page-home" data-aos="zoom-in">

        <!-- Categories -->
        <section class="store-trend-categories">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>All Categories</h5>
                    </div>
                </div>
                <div class="row">
                  @php $i = 0; @endphp
                  @forelse ($categories as $category)
                      <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{ $i += 100 }}">
                            <a href="{{ route('category-detail', $category->slug) }}" class="component-categories d-block">
                                <div class="categories-image">
                                    <img src="{{ Storage::url($category->photo) }}" alt="img-category" class="w-100" />
                                </div>
                                <p class="categories-text">{{ $category->name }}</p>
                            </a>
                    </div>
                  @empty
                      <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                          Not Found Categories
                      </div>
                  @endforelse
                </div>
            </div>
        </section>
        <!-- End Categories -->

        <!-- Products -->
        <section class="store-new-product">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>New Products</h5>
                    </div>
                </div>
                <div class="row">
                    @php $i = 0 @endphp
                    @forelse ($products as $product)
                          <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $i += 100 }}">
                            <a href="{{ route('product-detail-user', $product->slug) }}" class="component-new-product d-block">
                                <div class="product-thumbnail">
                                    <div class="product-image" style="
                                        @if($product->galleries->count())
                                            background-image: url(
                                                {{ Storage::url($product->galleries->first()->photo)}}
                                        @else 
                                            background-color: #eee;
                                        @endif 
                                    ">
                                    </div>
                                </div>
                                <div class="product-text">
                                    {{ $product->name }}
                                </div>
                                <div class="product-price-text">{{ currency_IDR($product->price) }}</div>
                            </a>
                         </div>

                         
                    @empty
                        <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
                            Not Found Product
                        </div>
                    @endforelse
                    <div class="col-12 mt-4">
                        {{ $products->links() }}
                    </div>
                </div>  
            </div>
        </section>
        <!-- End Products -->
    </div>
    <!-- End Content -->
@endsection
 