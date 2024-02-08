@extends('layouts.frontend')
@section('meta')
    {{-- for category --}}
    @if (!empty(request()->input('categoryId')) && empty(request()->input('subCategoryId')) && empty(request()->input('brandId')))
        @if (!empty(Common::getCatNameById(request()->input('categoryId'))))
            <title>Buy {{Common::getCatNameById(request()->input('categoryId'))}} Online at Best Prices - Easybuy</title>
            <meta name="title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} Online at Best Prices - Easybuy">
            <meta name="description" content="Easybuy: Explore our amazing collection of {{Common::getCatNameById(request()->input('categoryId'))}} online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:type" content="website">
            <meta property="og:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}">
            <meta property="og:title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} Online at Best Prices - Easybuy">
            <meta property="og:description" content="Easybuy: Explore our amazing collection of {{Common::getCatNameById(request()->input('categoryId'))}} online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:image" content="{{ env('IMG_URL') }}cat_images/{{ Common::getCatImgById(request()->input('categoryId')) }}">
        
            <meta property="twitter:card" content="summary_large_image">
            <meta property="twitter:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}">
            <meta property="twitter:title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} Online at Best Prices - Easybuy">
            <meta property="twitter:description" content="Easybuy: Explore our amazing collection of {{Common::getCatNameById(request()->input('categoryId'))}} online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="twitter:image" content="{{ env('IMG_URL') }}cat_images/{{ Common::getCatImgById(request()->input('categoryId')) }}">
        @else
        <title>Not Found - Easybuy</title>
        <meta name="robots" content="noindex">
        @endif
    {{-- for sub category --}}
    @elseif (!empty(request()->input('subCategoryId')) && !empty(request()->input('categoryId')) && empty(request()->input('brandId')))
        @if (!empty(Common::getCatNameById(request()->input('categoryId'))) && !empty(Common::getSubCatNameById(request()->input('subCategoryId'))))
            <title>Buy {{Common::getCatNameById(request()->input('categoryId'))}} {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} Online at Best Prices - Easybuy</title>
            <meta name="title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} Online at Best Prices - Easybuy">
            <meta name="description" content="Easybuy: Explore our amazing collection of {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} {{Common::getCatNameById(request()->input('categoryId'))}} online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:type" content="website">
            <meta property="og:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}/{{Common::getSlugName(Common::getSubCatNameById(request()->input('subCategoryId')))}}?categoryId={{ request()->input('categoryId') }}&subCategoryId={{ request()->input('subCategoryId') }}">
            <meta property="og:title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} Online at Best Prices - Easybuy">
            <meta property="og:description" content="Easybuy: Explore our amazing collection of {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} {{Common::getCatNameById(request()->input('categoryId'))}} online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:image" content="{{ env('IMG_URL') }}subcat_images/{{ Common::getSubCatImgById(request()->input('subCategoryId')) }}">
        
            <meta property="twitter:card" content="summary_large_image">
            <meta property="twitter:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}/{{Common::getSlugName(Common::getSubCatNameById(request()->input('subCategoryId')))}}?categoryId={{ request()->input('categoryId') }}&subCategoryId={{ request()->input('subCategoryId') }}">
            <meta property="twitter:title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} Online at Best Prices - Easybuy">
            <meta property="twitter:description" content="Easybuy: Explore our amazing collection of {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} {{Common::getCatNameById(request()->input('categoryId'))}} online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="twitter:image" content="{{ env('IMG_URL') }}subcat_images/{{ Common::getSubCatImgById(request()->input('subCategoryId')) }}">
        @else
            <title>Not Found - Easybuy</title>
            <meta name="robots" content="noindex">
        @endif
    {{-- for sub category with brand --}}
    @elseif(!empty(request()->input('subCategoryId')) && !empty(request()->input('categoryId')) && !empty(request()->input('brandId')))
        @if (!empty(Common::getCatNameById(request()->input('categoryId'))) && !empty(Common::getSubCatNameById(request()->input('subCategoryId'))) && !empty(Common::getBrandNameById(request()->input('brandId'))))
            <title>Buy {{Common::getCatNameById(request()->input('categoryId'))}} {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} of {{Common::getBrandNameById(request()->input('brandId'))}} Online at Best Prices - Easybuy</title>
            <meta name="title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} of {{Common::getBrandNameById(request()->input('brandId'))}} Online at Best Prices - Easybuy">
            <meta name="description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getSubCatNameById(request()->input('subCategoryId')))}} {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} brand online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:type" content="website">
            <meta property="og:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}/{{Common::getSlugName(Common::getSubCatNameById(request()->input('subCategoryId')))}}?categoryId={{ request()->input('categoryId') }}&subCategoryId={{ request()->input('subCategoryId') }}&brandId={{ request()->input('brandId') }}">
            <meta property="og:title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} of {{Common::getBrandNameById(request()->input('brandId'))}} Online at Best Prices - Easybuy">
            <meta property="og:description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getSubCatNameById(request()->input('subCategoryId')))}} {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} brand online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:image" content="{{ env('IMG_URL') }}subcat_images/{{ Common::getSubCatImgById(request()->input('subCategoryId')) }}">
        
            <meta property="twitter:card" content="summary_large_image">
            <meta property="twitter:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}/{{Common::getSlugName(Common::getSubCatNameById(request()->input('subCategoryId')))}}?categoryId={{ request()->input('categoryId') }}&subCategoryId={{ request()->input('subCategoryId') }}&brandId={{ request()->input('brandId') }}">
            <meta property="twitter:title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} {{ucwords(Common::getSubCatNameById(request()->input('subCategoryId')))}} of {{Common::getBrandNameById(request()->input('brandId'))}} Online at Best Prices - Easybuy">
            <meta property="twitter:description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getSubCatNameById(request()->input('subCategoryId')))}} {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} brand online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="twitter:image" content="{{ env('IMG_URL') }}subcat_images/{{ Common::getSubCatImgById(request()->input('subCategoryId')) }}">
        @else
            <title>Not Found - Easybuy</title>
            <meta name="robots" content="noindex">
        @endif
    {{-- for brand --}}
    @elseif(!empty(request()->input('brandId')) && empty(request()->input('categoryId')) && empty(request()->input('subCategoryId')))
        @if (!empty(Common::getBrandNameById(request()->input('brandId'))))
            <title>Buy {{Common::getBrandNameById(request()->input('brandId'))}} Brand Products Online at Best Prices - Easybuy</title>
            <meta name="title" content="Buy {{Common::getBrandNameById(request()->input('brandId'))}} Brand Products Online at Best Prices - Easybuy">
            <meta name="description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} products online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:type" content="website">
            <meta property="og:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getBrandNameById(request()->input('brandId')))}}?brandId={{ request()->input('brandId') }}">
            <meta property="og:title" content="Buy {{Common::getBrandNameById(request()->input('brandId'))}} Brand Products Online at Best Prices - Easybuy">
            <meta property="og:description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} products online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:image" content="{{ env('IMG_URL') }}brands/{{ Common::getBrandImgById(request()->input('brandId')) }}">
            <meta property="twitter:card" content="summary_large_image">
            <meta property="twitter:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getBrandNameById(request()->input('brandId')))}}?brandId={{ request()->input('brandId') }}">
            <meta property="twitter:title" content="Buy {{Common::getBrandNameById(request()->input('brandId'))}} Brand Products Online at Best Prices - Easybuy">
            <meta property="twitter:description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} products online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="twitter:image" content="{{ env('IMG_URL') }}brands/{{ Common::getBrandImgById(request()->input('brandId')) }}">
        @else
            <title>Not Found - Easybuy</title>
            <meta name="robots" content="noindex">
        @endif
    {{-- for brand with category --}}
    @elseif(!empty(request()->input('brandId')) && !empty(request()->input('categoryId')) && empty(request()->input('subCategoryId')))
        @if (!empty(Common::getBrandNameById(request()->input('brandId'))) && !empty(Common::getCatNameById(request()->input('categoryId'))))
            <title>Buy {{Common::getCatNameById(request()->input('categoryId'))}} of {{Common::getBrandNameById(request()->input('brandId'))}} Online at Best Prices - Easybuy</title>
            <meta name="title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} of {{Common::getBrandNameById(request()->input('brandId'))}} Online at Best Prices - Easybuy">
            <meta name="description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} brand online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:type" content="website">
            <meta property="og:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}&brandId={{ request()->input('brandId') }}">
            <meta property="og:title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} of {{Common::getBrandNameById(request()->input('brandId'))}} Online at Best Prices - Easybuy">
            <meta property="og:description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} brand online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="og:image" content="{{ env('IMG_URL') }}cat_images/{{ Common::getCatImgById(request()->input('categoryId')) }}">
            <meta property="twitter:card" content="summary_large_image">
            <meta property="twitter:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}&brandId={{ request()->input('brandId') }}">
            <meta property="twitter:title" content="Buy {{Common::getCatNameById(request()->input('categoryId'))}} of {{Common::getBrandNameById(request()->input('brandId'))}} Online at Best Prices - Easybuy">
            <meta property="twitter:description" content="Easybuy: Explore our amazing collection of {{strtolower(Common::getCatNameById(request()->input('categoryId')))}} of {{strtolower(Common::getBrandNameById(request()->input('brandId')))}} brand online at lowest prices and with great deals, offers &amp; discounts.">
            <meta property="twitter:image" content="{{ env('IMG_URL') }}cat_images/{{ Common::getCatImgById(request()->input('categoryId')) }}">
        @else
            <title>Not Found - Easybuy</title>
            <meta name="robots" content="noindex">
        @endif
    {{-- for search --}}
    @elseif(!empty(request()->input('search')))
        <title>All Results Of Your Search - {{request()->input('search')}} | Easybuy</title>
        <meta name="title" content="All Results Of Your Search - {{request()->input('search')}} | Easybuy">
        <meta name="description" content="Easybuy: There are thousand of products of {{request()->input('search')}}. We have lowest prices and with great deals, offers &amp; discounts.">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}&brandId={{ request()->input('brandId') }}">
        <meta property="og:title" content="All Results Of Your Search - {{request()->input('search')}} | Easybuy">
        <meta property="og:description" content="Easybuy: There are thousand of products of {{request()->input('search')}}. We have lowest prices and with great deals, offers &amp; discounts.">
        <meta property="og:image" content="{{Url('default/easybuy_logo.webp')}}">
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{Url('/')}}/products?search={{ request()->input('search') }}">
        <meta property="twitter:title" content="All Results Of Your Search - {{request()->input('search')}} | Easybuy">
        <meta property="twitter:description" content="Easybuy: There are thousand of products of {{request()->input('search')}}. We have lowest prices and with great deals, offers &amp; discounts.">
        <meta property="twitter:image" content="{{Url('default/easybuy_logo.webp')}}">
    @else
        <title>Not Found - Easybuy</title>
        <meta name="robots" content="noindex">
    @endif
@endsection
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
                <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                {{-- for category --}}
                @if (!empty(request()->input('categoryId')) && empty(request()->input('subCategoryId')) && empty(request()->input('brandId')))
                    @if (!empty(Common::getCatNameById(request()->input('categoryId'))))
                    <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">  {{Common::getCatNameById(request()->input('categoryId'))}}</li>
                    @else
                    <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Not Found</li>
                    @endif
                {{-- for sub category --}}
                @elseif (!empty(request()->input('subCategoryId')) && !empty(request()->input('categoryId')) && empty(request()->input('brandId')))
                    @if (!empty(Common::getCatNameById(request()->input('categoryId'))) && empty(Common::getSubCatNameById(request()->input('subCategoryId'))))
                    <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}">{{Common::getCatNameById(request()->input('categoryId'))}}</a></li>
                    <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Not Found<li>
                    @elseif (!empty(Common::getCatNameById(request()->input('categoryId'))) && !empty(Common::getSubCatNameById(request()->input('subCategoryId'))))
                        <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}">{{Common::getCatNameById(request()->input('categoryId'))}}</a></li>
                        <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">{{Common::getSubCatNameById(request()->input('subCategoryId'))}}</li>
                    @else
                        <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Not Found</li>
                    @endif
                {{-- for sub category with brand --}}
                @elseif(!empty(request()->input('subCategoryId')) && !empty(request()->input('categoryId')) && !empty(request()->input('brandId')))
                    @if (!empty(Common::getCatNameById(request()->input('categoryId'))) && !empty(Common::getSubCatNameById(request()->input('subCategoryId'))) && !empty(Common::getBrandNameById(request()->input('brandId'))))
                        <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}">{{Common::getCatNameById(request()->input('categoryId'))}}</a></li>
                        <li class="ec-breadcrumb-item"><a href="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}/{{Common::getSlugName(Common::getSubCatNameById(request()->input('subCategoryId')))}}?categoryId={{ request()->input('categoryId') }}&subCategoryId={{ request()->input('subCategoryId') }}">{{Common::getSubCatNameById(request()->input('subCategoryId'))}}</a></li>
                        <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">{{Common::getBrandNameById(request()->input('brandId'))}}</li>
                    @else
                        <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Not Found</li>
                    @endif
                {{-- for brand --}}
                @elseif(!empty(request()->input('brandId')) && empty(request()->input('categoryId')) && empty(request()->input('subCategoryId')))
                    @if (!empty(Common::getBrandNameById(request()->input('brandId'))))
                    <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">{{Common::getBrandNameById(request()->input('brandId'))}}</li>
                    @else
                        <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Not Found</li>
                    @endif
                {{-- for brand with category --}}
                @elseif(!empty(request()->input('brandId')) && !empty(request()->input('categoryId')) && empty(request()->input('subCategoryId')))
                    @if (!empty(Common::getBrandNameById(request()->input('brandId'))) && !empty(Common::getCatNameById(request()->input('categoryId'))))
                    <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}/products/{{Common::getSlugName(Common::getCatNameById(request()->input('categoryId')))}}?categoryId={{ request()->input('categoryId') }}">{{Common::getCatNameById(request()->input('categoryId'))}}</a></li>
                    <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">{{Common::getBrandNameById(request()->input('brandId'))}}</li>
                    @else
                        <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Not Found</li>
                    @endif
                {{-- for search --}}
                @elseif(!empty(request()->input('search')))
                    <li class="ec-breadcrumb-item" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Search</li>
                    <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">{{request()->input('search')}}</li>
                @else
                    <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Not Found</li>
                @endif
            </ul>
        </div>
    </div>
    <!-- Ec breadcrumb end -->
{{-- @php
    dd($products->count() <= 0,$products->count());
@endphp --}}
    <!-- Ec Shop page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-shop-rightside col-lg-9 col-md-12 order-lg-last order-md-first margin-b-30">
                    <!-- Shop Top Start -->
                    <div class="ec-pro-list-top d-flex">
                        <div class="col-md-6 ec-grid-list">
                            <div class="ec-gl-btn">
                                <button class="btn btn-grid active d-lg-none" onclick="$('.categoryFilter').show()"> <svg xmlns="http://www.w3.org/2000/svg" shape-rendering="geometricPrecision" text-rendering="geometricPrecision" image-rendering="optimizeQuality" fill-rule="evenodd" clip-rule="evenodd" width="24" height="24" fill="#fff" viewBox="0 0 512 446.65"><path d="M250.18.1c26.9-.84 52.72 3.71 76.4 12.65 24.62 9.3 46.96 23.38 65.83 41.11 18.88 17.73 34.32 39.15 45.14 63.12 10.4 23.06 16.55 48.54 17.4 75.47.61 19.72-1.67 38.88-6.45 56.99a196.6 196.6 0 0 1-18.76 46.3l79.57 81.45c3.65 3.76 3.58 9.78-.18 13.43l-54.81 53.34c-3.76 3.66-9.78 3.58-13.43-.18l-76.08-78.62a198.236 198.236 0 0 1-44.97 21.82c-18.01 6.06-37.24 9.63-57.24 10.25-17.03.53-33.63-1.1-49.53-4.63l.07-2.32v-39.04c15.29 4.33 31.5 6.41 48.22 5.9 21.42-.67 41.78-5.6 60.22-13.92 19.13-8.63 36.23-20.95 50.38-36.02 14.15-15.06 25.38-32.89 32.8-52.51 7.15-18.92 10.77-39.55 10.11-61-.67-21.45-5.59-41.78-13.91-60.21-8.63-19.14-20.97-36.24-36.03-50.4a158.776 158.776 0 0 0-52.51-32.79c-18.92-7.15-39.54-10.78-60.99-10.11-21.46.66-41.79 5.59-60.22 13.9a158.799 158.799 0 0 0-50.39 36.03c-14.15 15.07-25.38 32.91-32.81 52.53l-.98 2.67H64.96c1.6-5.72 3.44-11.34 5.52-16.84 9.3-24.62 23.38-46.97 41.1-65.83 17.73-18.88 39.14-34.33 63.12-45.14C197.76 7.09 223.26.94 250.18.1zm-80.76 390.18H86.46v-83.67L5.55 209.92c-8.29-10.33-7.96-20.82 5.53-20.89h230.17c13.63-.69 18.91 9.19 9.13 22.01l-80.96 95.57v83.67z"/></svg>
                                <button class="btn btn-grid active d-none d-lg-flex"><img loading="lazy" src="assets/images/icons/grid.svg"
                                        class="svg_img gl_svg" alt="list icon" /></button>
                            </div>
                        </div>
                        <div class="col-md-6 ec-sort-select">
                            <span class="sort-by">Sort by</span>
                            <div class="ec-select-inner">
                                <select onchange="searchFilter('page', '', true);searchFilter('filter', this.value)" name="ec-select" id="ec-select">
                                    <option {{ request()->input('filter') === '' ? 'selected' : '' }} value="">Position</option>
                                    {{-- <option {{ request()->input('filter') === '1' ? 'selected' : '' }} value="1">Relevance</option> --}}
                                    <option {{ request()->input('filter') === '2' ? 'selected' : '' }} value="2">Name, A to Z</option>
                                    <option {{ request()->input('filter') === '3' ? 'selected' : '' }} value="3">Name, Z to A</option>
                                    <option {{ request()->input('filter') === '4' ? 'selected' : '' }} value="4">Price, low to high</option>
                                    <option {{ request()->input('filter') === '5' ? 'selected' : '' }} value="5">Price, high to low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Top End -->

                    <!-- Shop content Start -->
                    <div class="shop-pro-content">
                        <div class="shop-pro-inner">
                            <div class="row">
                                @if ($products->count())
                                    @foreach ($products as $product)
                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                                            <div class="ec-product-inner">
                                                <a href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}" class="ec-pro-image-outer">
                                                    <div class="ec-pro-image">
                                                        <div class="image">
                                                            <img loading="lazy" onerror="this.src = './default/no-image.png'"
                                                                class="main-image"
                                                                src="{{ env('IMG_URL') }}product_images/{{ $product->banner }}"
                                                                alt="{{$product->caption_name}}" />
                                                            <img loading="lazy" class="hover-image"
                                                                onerror="this.src = './default/no-image.png'"
                                                                src="{{ env('IMG_URL') }}product_images/{{ $product->zoom }}"
                                                                alt="{{$product->caption_name}}" />
                                                        </div>
                                                        <span
                                                            class="percentage">{{ (int) (((((int) $product->mrp) - (int) $product->combo_price) / (int) $product->mrp) * 100) }}%
                                                            off</span>
                                                        <span class="flags">
                                                            <span class="new">{{ $product->product_tag }}</span>
                                                        </span>
                                                        <a href="javascript:{}" onclick="addToWishlist('{{ $product->item_id }}', event, wishlistHandler)" class="quickview" 
                                                            title="Add to Wishlist">
                                                                
                                                                 <i style="display: {{ $product->wishlist_id ? 'block' : 'none' }}" class="icon-box-1 fa fa-heart text-danger"></i>
                                                                 <i style="display: {{ $product->wishlist_id ? 'none' : 'block' }}" class="icon-box-2 fa fa-heart-o"></i>
                                                                
                                                            </a>
                                                            <a  onclick="addToCart('{{ $product->id }}','{{ $product->item_id }}','1',event, addtocartHandler)" href="javascript:{}" class="quickview addtocart-st" title="Add to Cart">
                                                                     <i class="fa fa-shopping-cart"></i> 
                                                            </a>
                                                        <div class="ec-pro-actions">
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="ec-pro-content">
                                                    <h5 title="{{ $product->name }}" class="ec-pro-title"><a
                                                        href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}">{{ $product->name }}</a></h5>
                                                    <div class="ec-pro-rating">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            @if ($i < Common::getProductRating($product->id))
                                                                <i class="ecicon eci-star fill"></i>
                                                            @else
                                                                <i class="ecicon eci-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    {{-- <div class="ec-pro-list-desc">{{ $product->short_desp }}</div> --}}
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
                                                            class="btn btn-primary"
                                                            style="font-size: 0.7rem;
                                                        height: fit-content;
                                                        line-height: 2.5;">More</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                @if($products->count() === 0)
                                <div>
                                    <h2>Sorry, no results found!</h2>
                                    <div>Please check the spelling or try searching for something else</div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- Ec Pagination Start -->
                        <div class="ec-pro-pagination">
                            @if(!empty($products->total()))
                            <span>Showing {{ $products->perPage() * ($products->currentPage() - 1)+1 }}-{{ $products->count() < $products->perPage() ? $products->count() : $products->currentPage()*$products->perPage() }}  of {{ $products->total() }} item(s)</span>
                            @endif

                            @php
                            $pagination_config = array(
                                'start_tag' => '<ul class="ec-pro-pagination-inner">',
                                'link' => '<li><a href="javascript:{}" onclick="searchFilter(\'page\', \'{link}\')">{value}</a></li>',
                                'active_link' => '<li ><a class="active" href="javascript:{}">{value}</a></li>',
                                'end_tag' => '</ul>',
                                'link_limit' => 2,
                            );
                            Common::paginate($products->perPage(), $products->total(), $products->currentPage(),$pagination_config);
                            @endphp
                        </div>
                        <!-- Ec Pagination End -->
                    </div>
                    <!--Shop content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside col-lg-3 col-md-12 order-lg-first order-md-last categoryFilter">
                    <div id="shop_sidebar">
                        <div class="ec-sidebar-heading">
                            <p class="d-flex align-items-center justify-content-between">Filter Products By  <span class="float-right d-lg-none"  onclick="$('.categoryFilter').hide()" style="cursor: pointer"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                              </svg></span></p>
                        </div>
                        <div class="ec-sidebar-wrap">
                            <!-- Sidebar Category Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Category</h3>
                                </div>
                                
                                <div class="ec-sb-block-content">
                                    <ul>
                                        @php
                                            $catList = Common::getCategoryList();
                                        @endphp
                                        @for ($i = 0; $i < ($catList->count() >= 5 ? 5 : $catList->count()); $i++)
                                            <li>
                                                <div class="ec-sidebar-block-item" onclick="setProductsURL('{{Common::getSlugName($catList[$i]->name)}}');searchFilter('page', '', true);searchFilter('brandId', '', true);searchFilter('subCategoryId', '', true);searchFilter('categoryId', '{{ $catList[$i]->id }}')">
                                                    <input
                                                        
                                                        type="checkbox"
                                                        {{ $catList[$i]->id == request()->input('categoryId') ? 'checked' : '' }} />
                                                    <a href="javascript:{}">{{ $catList[$i]->name }}</a><span
                                                        class="checked"></span>
                                                </div>
                                            </li>
                                        @endfor
                                        @if ($catList->count() > 5)
                                            <li id="ec-more-toggle-content"
                                                style="padding: 0;{{ request()->input('categoryId') !== null && in_array(
                                                    request()->input('categoryId'),
                                                    array_map(function ($cat) {
                                                        static $index;
                                                        $index = $index + 1;
                                                        if ($index > 5) {
                                                            return $cat->id;
                                                        }
                                                    }, $catList->toArray()),
                                                )
                                                    ? ''
                                                    : 'display: none;' }}">
                                                <ul>
                                                    @for ($i = 5; $i < $catList->count(); $i++)
                                                        <li>
                                                            <div class="ec-sidebar-block-item" onclick="setProductsURL('{{Common::getSlugName($catList[$i]->name)}}');searchFilter('page', '', true);searchFilter('subCategoryId', '', true);searchFilter('categoryId', '{{ $catList[$i]->id }}')">
                                                                <input
                                                                    
                                                                    {{ $catList[$i]->id == request()->input('categoryId') ? 'checked' : '' }}
                                                                    type="checkbox" /> <a
                                                                    href="javascript:{}">{{ $catList[$i]->name }}</a><span
                                                                    class="checked"></span>
                                                            </div>
                                                        </li>
                                                    @endfor
                                                </ul>
                                            </li>

                                            <li>
                                                <div
                                                    class="ec-sidebar-block-item ec-more-toggle {{ request()->input('categoryId') !== null && in_array(
                                                        request()->input('categoryId'),
                                                        array_map(function ($cat) {
                                                            static $index;
                                                            $index = $index + 1;
                                                            if ($index > 5) {
                                                                return $cat->id;
                                                            }
                                                        }, $catList->toArray()),
                                                    )
                                                        ? 'active'
                                                        : '' }}">
                                                    <span class="checked"></span><span id="ec-more-toggle">More
                                                        Categories</span>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            @php
                                $subCatList = Common::getSubCategoryList(request()->input('categoryId'));
                            @endphp
                            @if ($subCatList->count())
                                <div class="ec-sidebar-block">
                                    <div class="ec-sb-title">
                                        <h3 class="ec-sidebar-title">Sub Category</h3>
                                    </div>
                                    <div class="ec-sb-block-content">
                                        <ul>

                                            @for ($i = 0; $i < ($subCatList->count() >= 5 ? 5 : $subCatList->count()); $i++)
                                                <li>
                                                    <div class="ec-sidebar-block-item" onclick="setProductsURL('{{Common::getSlugName($subCatList[$i]->id == request()->input('subCategoryId') ? '' : $subCatList[$i]->name)}}', 'subCategory');searchFilter('page', '', true);searchFilter('subCategoryId', '{{ $subCatList[$i]->id == request()->input('subCategoryId') ? '' : $subCatList[$i]->id }}')">
                                                        <input
                                                            type="checkbox"
                                                            {{ $subCatList[$i]->id == request()->input('subCategoryId') ? 'checked' : '' }} />
                                                        <a href="javascript:{}">{{ $subCatList[$i]->name }}</a><span
                                                            class="checked"></span>
                                                    </div>
                                                </li>
                                            @endfor
                                            @if ($subCatList->count() > 5)
                                                <li id="ec-more-toggle1-content"
                                                    style="padding: 0;{{ request()->input('subCategoryId') !== null && in_array(
                                                        request()->input('subCategoryId'),
                                                        array_map(function ($cat) {
                                                            static $index;
                                                            $index = $index + 1;
                                                            if ($index > 5) {
                                                                return $cat->id;
                                                            }
                                                        }, $subCatList->toArray()),
                                                    )
                                                        ? ''
                                                        : 'display: none;' }}">
                                                    <ul>
                                                        @for ($i = 5; $i < $subCatList->count(); $i++)
                                                            <li>
                                                                <div class="ec-sidebar-block-item" onclick="setProductsURL('{{Common::getSlugName($subCatList[$i]->id == request()->input('subCategoryId') ? '' : $subCatList[$i]->name)}}', 'subCategory');searchFilter('page', '', true);searchFilter('subCategoryId', '{{ $subCatList[$i]->id == request()->input('subCategoryId') ? '' : $subCatList[$i]->id }}')">
                                                                    <input
                                                                        
                                                                        {{ $subCatList[$i]->id == request()->input('subCategoryId') ? 'checked' : '' }}
                                                                        type="checkbox" /> <a
                                                                        href="javascript:{}">{{ $subCatList[$i]->name }}</a><span
                                                                        class="checked"></span>
                                                                </div>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </li>

                                                <li>
                                                    <div
                                                        class="ec-sidebar-block-item ec-more-toggle1 {{ request()->input('subCategoryId') !== null && in_array(
                                                            request()->input('subCategoryId'),
                                                            array_map(function ($cat) {
                                                                static $index;
                                                                $index = $index + 1;
                                                                if ($index > 5) {
                                                                    return $cat->id;
                                                                }
                                                            }, $subCatList->toArray()),
                                                        )
                                                            ? 'active'
                                                            : '' }}">
                                                        <span class="checked"></span><span id="ec-more-toggle1">More
                                                            Sub Categories</span>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            @php
                                $brandList = Common::getBrandList();
                            @endphp
                            @if ($brandList->count())
                                <div class="ec-sidebar-block">
                                    <div class="ec-sb-title">
                                        <h3 class="ec-sidebar-title">Brands</h3>
                                    </div>
                                    <div class="ec-sb-block-content">
                                        <ul>
                                            @for ($i = 0; $i < ($brandList->count() >= 5 ? 5 : $brandList->count()); $i++)
                                                <li>
                                                    <div class="ec-sidebar-block-item" onclick="setProductsURL('{{Common::getSlugName($brandList[$i]->id == request()->input('brandId') ? '' : $brandList[$i]->name)}}', 'brand');searchFilter('page', '', true);searchFilter('brandId', '{{ $brandList[$i]->id == request()->input('brandId') ? '' : $brandList[$i]->id }}')">
                                                        <input
                                                            
                                                            type="checkbox"
                                                            {{ $brandList[$i]->id == request()->input('brandId') ? 'checked' : '' }} />
                                                        <a href="javascript:{}">{{ $brandList[$i]->name }}</a><span
                                                            class="checked"></span>
                                                    </div>
                                                </li>
                                            @endfor
                                            @if ($brandList->count() > 5)
                                                <li id="ec-more-toggle2-content"
                                                    style="padding: 0;{{ request()->input('brandId') && in_array(
                                                        request()->input('brandId'),
                                                        array_map(function ($brand) {
                                                            static $index;
                                                            $index = $index + 1;
                                                            if ($index > 5) {
                                                                return $brand->id;
                                                            }
                                                        }, $brandList->toArray()),
                                                    )
                                                        ? ''
                                                        : 'display: none;' }}">
                                                    <ul>
                                                        @for ($i = 5; $i < $brandList->count(); $i++)
                                                            <li>
                                                                <div class="ec-sidebar-block-item"  onclick="setProductsURL('{{Common::getSlugName($brandList[$i]->id == request()->input('brandId') ? '' : $brandList[$i]->name)}}', 'brand');searchFilter('page', '', true);searchFilter('brandId', '{{ $brandList[$i]->id == request()->input('brandId') ? '' : $brandList[$i]->id }}')">
                                                                    <input
                                                                       
                                                                        {{ $brandList[$i]->id == request()->input('brandId') ? 'checked' : '' }}
                                                                        type="checkbox" /> <a
                                                                        href="javascript:{}">{{ $brandList[$i]->name }}</a><span
                                                                        class="checked"></span>
                                                                </div>
                                                            </li>
                                                        @endfor
                                                    </ul>
                                                </li>

                                                <li>
                                                    <div
                                                        class="ec-sidebar-block-item ec-more-toggle2 {{ request()->input('brandId') !== null &&in_array(
                                                            request()->input('brandId'),
                                                            array_map(function ($cat) {
                                                                static $index;
                                                                $index = $index + 1;
                                                                if ($index > 5) {
                                                                    return $cat->id;
                                                                }
                                                            }, $brandList->toArray()),
                                                        )
                                                            ? 'active'
                                                            : '' }}">
                                                        <span class="checked"></span><span id="ec-more-toggle2">More
                                                            Brands</span>
                                                    </div>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title">
                                    <h3 class="ec-sidebar-title">Price</h3>
                                </div>
                                <div class="ec-sb-block-content es-price-slider">
                                    <div class="ec-price-filter">
                                        <div id="ec-sliderPrice" class="filter__slider-price" data-min="0"
                                            data-max="500000" data-step="10"></div>
                                        <div class="ec-price-input">
                                            <label class="filter__label">
                                                <input type="text" class="filter__input minPrice">
                                            </label>
                                            <span class="ec-price-divider"></span>
                                            <label class="filter__label">
                                                <input type="text" class="filter__input maxPrice">
                                            </label>
                                            <button onclick="setPriceFilter()" class="btn btn-primary" style="font-size: 0.7rem;
                                            height: fit-content;
                                            line-height: 2.5;margin-left:4px;">SET</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function setPriceFilter(){
            searchFilter('page', '', true);
            searchFilter('minPrice', $('.minPrice').val(), true)
            searchFilter('maxPrice', $('.maxPrice').val())

        }
        </script>
    <!-- End Shop page -->
@endsection
