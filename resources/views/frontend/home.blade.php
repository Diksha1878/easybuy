@extends('layouts.frontend')
@section('meta')
    <title>Online Shopping Site In India | Shop Online For Electronics, Home Appliances, Bathware, Fashion, Sports & Used Products At Best Price</title>
    <meta name="title" content="Online Shopping Site In India | Shop Online For Electronics, Home Appliances, Bathware, Fashion, Sports & Used Products At Best Price">
    <meta name="description" content="Easybuy: India largest online electronic shopping store. Buy online electronics, home appliances, bathware, sports & used products. Free shipping and cash on delivery available on thousand of products.">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{Url('/')}}">
    <meta property="og:title" content="Online Shopping Site In India | Shop Online For Electronics, Home Appliances, Bathware, Fashion, Sports & Used Products At Best Price">
    <meta property="og:description" content="Easybuy: India largest online electronic shopping store. Buy online electronics, home appliances, bathware, sports & used products. Free shipping and cash on delivery available on thousand of products.">
    <meta property="og:image" content="{{Url('default/easybuy_logo.webp')}}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{Url('/')}}">
    <meta property="twitter:title" content="Online Shopping Site In India | Shop Online For Electronics, Home Appliances, Bathware, Fashion, Sports & Used Products At Best Price">
    <meta property="twitter:description" content="Easybuy: India largest online electronic shopping store. Buy online electronics, home appliances, bathware, sports & used products. Free shipping and cash on delivery available on thousand of products.">
    <meta property="twitter:image" content="{{Url('default/easybuy_logo.webp')}}">

    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />

    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "WebSite",
          "url": "{{Url('/')}}",
          "potentialAction": {
            "@type": "SearchAction",
            "target": {
              "@type": "EntryPoint",
              "urlTemplate": "{{Url('/')}}/products?search={search_term_string}"
            },
            "query-input": "required name=search_term_string"
          }
        }
    </script>
    <style>
        .ec-slide-item{
            height: 37.5rem !important;
        }
        .ec-slide-item img{
            object-fit: cover;
        } 

        @media only screen and (max-width: 1460px){
            .ec-slide-item{
            height: auto !important;
            position: relative;
            }

            .ec-slide-item img{
                object-fit: fill;
            } 
        }
    </style>
@endsection
@section('content')
<!-- Main Slider Start -->
<div class="sticky-header-next-sec ec-main-slider section section-space-pb">
    <div class="ec-slider swiper-container main-slider-nav main-slider-dot">
        <!-- Main slider -->
        <div class="swiper-wrapper">
            @if($sliders->count())
            @foreach($sliders as $key => $slider)
            <div class="ec-slide-item swiper-slide d-flex ec-slide-1"
                style="background-image: url('')">
                <img style="width:100%" src="{{ env('IMG_URL').'offers/'.$slider->image }}" alt="easybuy slider {{$key}}" />
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-xl-6 col-lg-7 col-md-7 col-sm-7 align-self-center">
                            <div class="ec-slide-content">
                                <h1 style="color: {{ $slider->text_color }}" class="ec-slide-title">{{ $slider->title }}</h1>
                                <span style="color: {{ $slider->text_color }}" class="ec-slide-stitle">{{ $slider->name }}</span>
                                <p style="color: {{ $slider->text_color }}">{{ $slider->desp }}</p>
                                <a style="background: #427c80;" href="{{ $slider->link }}" class="btn btn-lg btn-secondary">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <div class="swiper-pagination swiper-pagination-white"></div>
        <div class="swiper-buttons">
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
@php
// dd(collect(Common::getCategoryMenuList()))
@endphp
<!-- Main Slider End -->
<!--  Category Section Start -->
{{-- @if($categoryList) --}}
<section class="section ec-category-section section-space-p" id="categories">
    <div class="container">
        @foreach(Common::getCategoryMenuList() as $menu)
        @if(count((array) $menu['subcats']))
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title mt-5">
                    <h2 class="ec-bg-title">{{ $menu['name'] }}</h2>
                    <h2 class="ec-title">{{ $menu['name'] }}</h2>
                    {{-- <p class="sub-title">Browse The Collection of Top Categories</p> --}}
                </div>
            </div>
        </div>
        <!--Category Nav Start -->
        <ul class="container">
            <div class="row justify-content-center">
                @php 
                // dd(Common::getCategoryMenuList())
                @endphp
                @foreach ($menu['subcats'] as $key => $row)
                <div class="col-6 col-sm-6 col-md-4 col-xl-3 p-1">
                    <li class="cat-item h-100 position-relative">
                        <a href="{{Url('/')}}/products/{{Common::getSlugName($menu['name']).'/'.Common::getSlugName($row['name'])}}?categoryId={{ $menu['id'] }}&subCategoryId={{ $row['id'] }}" class="cat-link h-100 position-relative cats">
                            <div style="position:relative">
                                <div class="cat-icons overflow-hidden h-8">
                                    @if(!empty($row['image']))
                                    <img loading="lazy" class="cat-icon w-100 h-100 cats-img" style="object-fit: cover;"
                                        src="{{ env('IMG_URL') }}subcat_images/{{ $row['image'] }}" title="{{ $row['name'] }}" alt="{{ $row['name'] }}">
                                        @endif
                                </div>
                                <div class="" style="opacity: .4;background-color: #000;position: absolute;top: 0;left: 0;width: 100%;height: 100%;
                                display: flex;justify-content: center;align-items: center;text-align: center;padding: 12px 12px;">
                                </div>
                                <div style="line-height: 26px;position: absolute;font-size: 150%;text-transform: uppercase;top: 0;height: 100%;width: 100%;pointer-events: none;display: table;table-layout: fixed;color: #fff;cursor: pointer;display: flex;justify-content: center;align-items: center;text-align: center;font-weight:bold;padding: 12px 12px;">{{ $row['name']}}</div>
                            </div>
                        </a>
                    </li>
                </div>
                @endforeach
            </div>
        </ul>
        @endif
        <!-- Category Nav End -->
        @endforeach
    </div>
</section>
{{-- @endif --}}
<!-- Category Section End -->
<!-- New Product Start -->
{{-- @if ($arrival_products->count())
<section class="section ec-new-product section-space-p" id="arrivals">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h3 class="ec-bg-title">New Arrivals</h3>
                    <h3 class="ec-title">New Arrivals</h3>
                    <p class="sub-title">Browse The Collection of Top Products</p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- New Product Content -->
            @foreach ($arrival_products as $product)
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                <div class="ec-product-inner">
                    <div class="ec-pro-image-outer">
                        <div class="ec-pro-image">
                            <a href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}" class="image">
                                <img loading="lazy" onerror="this.src = './default/no-image.png'" class="main-image"
                                    src="{{ env('IMG_URL') }}product_images/{{ $product->banner }}" alt="{{$product->caption_name}}" />
                                <img loading="lazy" class="hover-image" onerror="this.src = './default/no-image.png'"
                                    src="{{ env('IMG_URL') }}product_images/{{ $product->zoom }}" alt="{{$product->caption_name}}" />
                            </a>
                            <span class="percentage">{{ (int) (((((int) $product->mrp) - (int) $product->combo_price) /
                                (int) $product->mrp) * 100) }}%
                                off</span>
                            <span class="flags">
                                <span class="new">{{ $product->product_tag }}</span>
                            </span>
                            <button
                                onclick="addToWishlist('{{ $product->item_id }}', event, wishlistHandler)"
                                class="quickview" title="Add to Wishlist">
                                <i style="display: {{ $product->wishlist_id ? 'block' : 'none' }}"
                                    class="icon-box-1 fa fa-heart text-danger"></i>
                                <i style="display: {{ $product->wishlist_id ? 'none' : 'block' }}"
                                    class="icon-box-2 fa fa-heart-o"></i>

                            </button>
                            <button onclick="addToCart('{{ $product->id }}','{{ $product->item_id }}','1',event, addtocartHandler)"
                                class="quickview addtocart-st" title="Add to Cart">
                                <i class="fa fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                    <div class="ec-pro-content">
                        <h5 title="{{ $product->name }}" class="ec-pro-title"><a
                                href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}">{{
                                $product->name }}</a></h5>
                        <div class="ec-pro-rating">
                            @for ($i = 0; $i < 5; $i++) @if ($i < Common::getProductRating($product->id))
                                <i class="ecicon eci-star fill"></i>
                                @else
                                <i class="ecicon eci-star"></i>
                                @endif
                            @endfor
                        </div>
                        <span class="ec-price">
                            <span class="old-price">₹{{ $product->mrp }}</span>
                            <span class="new-price">₹{{ $product->combo_price }}</span>
                        </span>
                        <div class="ec-pro-option">
                            <button type="button" onclick="addToCart('{{ $product->id }}','{{ $product->item_id }}','1',event, addtocartHandler2)" class="btn btn-warning"
                                style="font-size: 0.7rem;
                            height: fit-content;
                            line-height: 2.5;">Add to Cart</button>
                            <a href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}"
                                class="btn btn-primary" style="font-size: 0.7rem;height: fit-content;line-height: 2.5;">More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-sm-12 shop-all-btn"><a href="{{ Url('products?arrivalProduct=1') }}">Shop All Collection</a>
            </div>
        </div>
    </div>
</section>
@endif --}}
<!-- New Product end -->
<!-- Product tab Area Start -->
{{-- @if ($top_products->count())
<section class="section ec-product-tab section-space-p" id="collection">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section-title">
                    <h3 class="ec-bg-title">Our Top Collection</h3>
                    <h3 class="ec-title">Our Top Collection</h3>
                    <p class="sub-title">Browse The Collection of Top Products</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="tab-content">
                    <!-- 1st Product tab start -->
                    <div class="tab-pane fade show active" id="tab-pro-for-all">
                        <div class="row">
                            <!-- Product Content --> 
                            @foreach ($top_products as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                <div class="ec-product-inner">
                                    <div class="ec-pro-image-outer">
                                        <div class="ec-pro-image">
                                            <a href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}" class="image">
                                                <img loading="lazy" onerror="this.src = './default/no-image.png'" class="main-image"
                                                    src="{{ env('IMG_URL') }}product_images/{{ $product->banner }}"
                                                    alt="{{$product->caption_name}}" />
                                                <img loading="lazy" class="hover-image" onerror="this.src = './default/no-image.png'"
                                                    src="{{ env('IMG_URL') }}product_images/{{ $product->zoom }}"
                                                    alt="{{$product->caption_name}}" />
                                            </a>
                                            <span class="percentage">{{ (int) (((((int) $product->mrp) - (int)
                                                $product->combo_price) / (int) $product->mrp) * 100) }}%
                                                off</span>
                                            <span class="flags">
                                                <span class="new">{{ $product->product_tag }}</span>
                                            </span>
                                            <button
                                                onclick="addToWishlist('{{ $product->item_id }}', event, wishlistHandler)"
                                                class="quickview" title="Add to Wishlist">
                                                <i style="display: {{ $product->wishlist_id ? 'block' : 'none' }}"
                                                    class="icon-box-1 fa fa-heart text-danger"></i>
                                                <i style="display: {{ $product->wishlist_id ? 'none' : 'block' }}"
                                                    class="icon-box-2 fa fa-heart-o"></i>
                                            </button>
                                            <button onclick="addToCart('{{ $product->id }}','{{ $product->item_id }}','1',event, addtocartHandler)"
                                                 class="quickview addtocart-st" title="Add to Cart">
                                                <i class="fa fa-shopping-cart"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="ec-pro-content">
                                        <h5 title="{{ $product->name }}" class="ec-pro-title"><a
                                                href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}">{{
                                                $product->name }}</a></h5>
                                        <div class="ec-pro-rating">
                                            @for ($i = 0; $i < 5; $i++) @if ($i < Common::getProductRating($product->
                                                id))
                                                <i class="ecicon eci-star fill"></i>
                                                @else
                                                <i class="ecicon eci-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="ec-price">
                                            <span class="old-price">₹{{ $product->mrp }}</span>
                                            <span class="new-price">₹{{ $product->combo_price }}</span>
                                        </span>
                                        <div class="ec-pro-option">
                                            <button type="button" onclick="addToCart('{{ $product->id }}','{{ $product->item_id }}','1',event, addtocartHandler2)" class="btn btn-warning"
                                                style="font-size: 0.7rem;
                                            height: fit-content;
                                            line-height: 2.5;">Add to Cart</button>
                                            <a href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}"
                                                class="btn btn-primary" style="font-size: 0.7rem;height: fit-content;line-height: 2.5;">More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-sm-12 shop-all-btn">
                                <a href="{{ Url('products?topProducts=1') }}">Shop All Collection</a>
                            </div>
                        </div>
                    </div>
                    <!-- ec 1st Product tab end -->
                </div>
            </div>
        </div>
    </div>
</section>
@endif --}}
<!-- ec Product tab Area End -->
<!-- Ec Brand Section Start -->
@if($brands->count())
<section class="section ec-brand-area section-space-p">
    <h2 class="d-none">Brand</h2>
    <div class="container">
        <div class="row">
            <div class="ec-brand-outer">
                <ul id="ec-brand-slider">
                    @foreach($brands as $brand)
                    <li class="ec-brand-item">
                        <div class="ec-brand-img">
                            <a href="{{ Url('products/'.strtolower($brand->name).'?brandId='.$brand->id) }}">
                                <img loading="lazy" style="height: 106px;" alt="brand" title="{{$brand->name}}" src="{{ env('IMG_URL')."brands/".$brand->image }}" alt="{{$brand->name}}" />
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
@endif
<!-- Ec Brand Section End -->
@endsection