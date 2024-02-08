@extends('layouts.frontend')
@section('meta')
    @if(!empty(Common::getCatNameById(request()->input('categoryId'))) && !empty(Common::getSubCatNameById(request()->input('subCategoryId'))))
        <title>All Brands Of {{Common::getCatNameById(request()->input('categoryId'))}} {{Common::getSubCatNameById(request()->input('subCategoryId'))}} - Easybuy</title>
        <meta name="title" content="All Brands Of {{Common::getCatNameById(request()->input('categoryId'))}} {{Common::getSubCatNameById(request()->input('subCategoryId'))}} - Easybuy">
        <meta name="description" content="Easybuy: Explore our all brands of {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} {{strtolower(Common::getSubCatNameById(request()->input('subCategoryId')))}}. We have wide range collection in every category.">

        <meta property="og:type" content="website">
        <meta property="og:url" content="{{Url('about-us')}}">
        <meta property="og:title" content="All Brands Of {{Common::getCatNameById(request()->input('categoryId'))}} {{Common::getSubCatNameById(request()->input('subCategoryId'))}} - Easybuy">
        <meta property="og:description" content="Easybuy: Explore our all brands of {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} {{strtolower(Common::getSubCatNameById(request()->input('subCategoryId')))}}. We have wide range collection in every category.">
        <meta property="og:image" content="{{Url('default/easybuy_logo.webp')}}">

        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{Url('about-us')}}">
        <meta property="twitter:title" content="All Brands Of {{Common::getCatNameById(request()->input('categoryId'))}} {{Common::getSubCatNameById(request()->input('subCategoryId'))}} - Easybuy">
        <meta property="twitter:description" content="Easybuy: Explore our all brands of {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} {{strtolower(Common::getSubCatNameById(request()->input('subCategoryId')))}}. We have wide range collection in every category.">
        <meta property="twitter:image" content="{{Url('default/easybuy_logo.webp')}}">

        {{-- <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
        <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" /> --}}
    @else
    {{-- <meta name="robots" content="noindex"> --}}
    @endif
    <meta name="robots" content="noindex">
@endsection
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
                <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Brands</li>
            </ul>
        </div>
    </div>
    <!-- Ec breadcrumb end -->
    <section class="section ec-category-section section-space-p" id="categories">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title mt-5 d-flex justify-content-center">
                        <h2 class="ec-bg-title">All Brands Of {{Common::getCatNameById(request()->input('categoryId'))}} {{Common::getSubCatNameById(request()->input('subCategoryId'))}}</h2>
                        <h2 class="ec-title">All Brands Of {{Common::getCatNameById(request()->input('categoryId'))}} {{Common::getSubCatNameById(request()->input('subCategoryId'))}}</h2>
                        {{-- <p class="sub-title">Browse The Collection of Top Categories</p> --}}
                    </div>
                </div>
            </div>
            <!--Category Nav Start -->
            <ul class="container">
                <div class="row justify-content-center">
                    @if($brands->count() > 0)
                        @foreach ($brands as $key => $row)
                        <div class="col-6 col-sm-6 col-md-4 col-xl-3 p-1 mb-2">
                            <li class="cat-item h-100 position-relative px-1 px-sm-2">
                                <a href="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById($row->cat_id))}}/{{Common::getSlugName(Common::getSubCatNameById($row->sub_cat_id))}}?categoryId={{ $row->cat_id }}&subCategoryId={{ $row->sub_cat_id }}&brandId={{ $row->id }}" class="cat-link h-100 position-relative cats">
                                    <div class="p-1 rounded-3 h-8" style="background:#eee">
                                        @if(!empty($row->image))
                                        <img loading="lazy" class="cat-icon w-100 h-100" style="object-fit: cover;"
                                            src="{{ env('IMG_URL') }}brands/{{ $row->image }}" title="{{ $row->name }}" alt="{{ $row->name }}">
                                        @endif
                                    </div>
                                    <p class="pt-2 text-center fs-5 text-muted" style="font-weight:500">{{ $row->name}}</p>
                                </a>
                            </li>
                        </div>
                        {{-- <div class="col-6 col-sm-6 col-md-4 col-xl-3 p-1">
                            <li class="cat-item h-100 position-relative">
                                <a href="{{Url('/')}}/products/{{$row->name}}?brandId={{ $row->id }}" class="cat-link h-100 position-relative cats">
                                    <div style="position:relative">
                                        <div class="cat-icons overflow-hidden h-8">
                                            @if(!empty($row->image))
                                            <img loading="lazy" class="cat-icon w-100 h-100 cats-img" style="object-fit: cover;"
                                                src="{{ env('IMG_URL') }}brands/{{ $row->image }}" title="{{ $row->name }}" alt="{{ $row->name }}">
                                                @endif
                                        </div>
                                        <div class="" style="opacity: .25;background-color: #000;position: absolute;top: 0;left: 0;width: 100%;height: 100%;
                                        display: flex;justify-content: center;align-items: center;text-align: center;padding: 12px 12px;">
                                        </div>
                                        <div style="line-height: 26px;position: absolute;font-size: 140%;text-transform: uppercase;top: 0;height: 100%;width: 100%;pointer-events: none;display: table;table-layout: fixed;color: #fff;cursor: pointer;display: flex;justify-content: center;align-items: center;text-align: center;font-weight:400;padding: 12px 12px;">{{ $row->name}}</div>
                                    </div>
                                </a>
                            </li>
                        </div> --}}
                        @endforeach
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center" style="height:10rem">
                            <div class="fs-5" style="font-weight:500">Opps!</div>
                            <p>There is no brands in category.</p>
                        </div>
                    @endif
                </div>
            </ul>
        </div>
    </section>
@endsection
