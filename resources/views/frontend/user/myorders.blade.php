@extends('layouts.frontend')
@section('meta')
<title>My Orders | Easybuy Online Shopping Site In India</title>
<meta name="robots" content="noindex">
@endsection
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
                <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">My Orders</li>
            </ul>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- User history section -->
    <section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
        <div class="container">
            <div class="row">
                <!-- Sidebar Area Start -->
                <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Category Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-vendor-block">
                                <div class="ec-vendor-block-items">
                                    <ul>
                                        <li><a href="{{ Url('myaccount') }}">My Profile</a></li>
                                        <li><a class="text-success" href="{{ Url('myorders') }}">My Orders</a></li>
                                        <li><a href="{{ Url('wishlist') }}">My Wishlist</a></li>
                                        <li><a href="{{ Url('myaddress') }}">My Addresses</a></li>
                                        <li><a class="text-danger" href="{{ Url('/logout') }}">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Orders</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="{{Url('/')}}">Shop Now</a>
                            </div>
                        </div>
                        @if ($orders->count() > 0)
                            @foreach ($orders as $key=>$order)
                            <div class="border m-3 m-sm-4 p-3 p-sm-4">
                                <div class="mb-2">Order ID: <span
                                        class="fw-bold">{{$order->order_id}}</span></div>
                                <div class="mt-2 mb-3">
                                    <div class="h4">
                                        @php
                                            $singleOrder = DB::table('order_items')->select('pname','product_id','item_id')->where('order_id',$order->order_id)->get();
                                            $singlePro = collect(DB::select('select thumb from products_images where p_item_id='. $singleOrder[0]->item_id .' and pid='. $singleOrder[0]->product_id .' limit 1'));
                                        @endphp
                                        {{ $singleOrder[0]->pname}}
                                        @if ($singleOrder->count() > 1)
                                            ..<span style="font-size: 1.3rem">+{{$singleOrder->count() - 1 }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <div class="mb-2">Order Date: <span class="fw-bold">{{date('d M Y',strtotime($order->created_at))}}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            Total: <span class="h5 fw-bold text-secondary ml-2">₹{{$order->grand_total}}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            Status: <span class="text-secondary text-dark ml-1">
                                                @if ($order->status == 'PENDING')
                                                <span>Order Pending</span>
                                            @elseif($order->status == 'PLACED')
                                                <span>Order Placed</span>
                                            @elseif($order->status == 'DISPATCHED')
                                                <span class="text-warning">Order Displaced</span>
                                            @elseif($order->status == 'DELIVERED')
                                                <span class="text-success">Order Delivered</span>
                                            @elseif($order->status == 'CANCELLED')
                                                <span class="text-danger">Order Cancelled</span>
                                            @endif
                                            </span>
                                        </div>
                                    </div>
    
                                    <div>
                                        <img loading="lazy" style="max-height:6rem"  onerror="this.src = './default/no-image.png'"
                                        src="{{ env('IMG_URL') }}product_images/{{ $singlePro[0]->thumb }}"
                                            alt="{{ implode(' ', array_slice(explode(' ', $singleOrder[0]->pname), 0, 10)) }}">
                                    </div>
                                </div>
                                <div class="pt-3 pt-sm-0">
                                    <a class="btn btn-primary mr-2 mb-2"
                                        style="line-height: unset;font-size: 12px;padding: 8px 12px;height: fit-content;"
                                        href="{{Url('order'.'/'.$order->order_id)}}">View Details</a>
                                    <button class="btn border mb-2"
                                        style="line-height: unset;font-size: 12px;padding: 8px 12px;height: fit-content;"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#trackOrder{{$key}}"
                                        aria-expanded="false" aria-controls="collapseExample">
                                        Track Order
                                    </button>
                                </div>
                                <div class="collapse" id="trackOrder{{$key}}">
                                    <div class="ec-trackorder-bottom px-0 px-sm-5">
                                        <div class="ec-progress-track">
                                            <ul id="ec-progressbar" class="mt-4">
                                                @if ($order->status == 'PENDING')
                                                    <li class="step0 active"><span class="ec-track-icon"></span><span
                                                        class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                        <br>pending</span></li>
                                                    <li class="step0"><span class="ec-track-icon"></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>placed</span></li>
                                                    <li class="step0"><span class="ec-track-icon"></span></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>dispatched</span></li>
                                                    <li class="step0"><span class="ec-track-icon"></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>delivered</span></li>
                                                @elseif($order->status == 'PLACED')
                                                    <li class="step0 active"><span class="ec-track-icon"></span><span
                                                        class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                        <br>pending</span></li>
                                                    <li class="step0 active"><span class="ec-track-icon"></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>placed</span></li>
                                                    <li class="step0"><span class="ec-track-icon"></span></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>dispatched</span></li>
                                                    <li class="step0"><span class="ec-track-icon"></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>delivered</span></li>
                                                @elseif($order->status == 'DISPATCHED')
                                                    <li class="step0 active"><span class="ec-track-icon"></span><span
                                                        class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                        <br>pending</span></li>
                                                    <li class="step0 active"><span class="ec-track-icon"></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>placed</span></li>
                                                    <li class="step0 active"><span class="ec-track-icon"></span></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>dispatched</span></li>
                                                    <li class="step0"><span class="ec-track-icon"></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>delivered</span></li>
                                                @elseif($order->status == 'DELIVERED')
                                                    <li class="step0 active"><span class="ec-track-icon"></span><span
                                                        class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                        <br>pending</span></li>
                                                    <li class="step0 active"><span class="ec-track-icon"></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>placed</span></li>
                                                    <li class="step0 active"><span class="ec-track-icon"></span></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>dispatched</span></li>
                                                    <li class="step0 active"><span class="ec-track-icon"></span><span
                                                            class="ec-progressbar-track"></span><span class="ec-track-title">order
                                                            <br>delivered</span></li>
                                                @elseif($order->status == 'CANCELLED')
                                                    <li class="fw-bold text-danger fs-5 ml-4">Order Cancelled</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
    
                            </div>
                            @endforeach
                        @else
                            <div>
                                <p class="text-center p-3">There is no order</p>
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End User history section -->
@endsection
