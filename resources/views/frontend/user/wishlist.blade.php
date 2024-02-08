@extends('layouts.frontend')
@section('meta')
    <title>My Wishlist | Easybuy Online Shopping Site In India</title>
    <meta name="robots" content="noindex">
@endsection

@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
                <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">My Wishlist</li>
            </ul>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- User history section -->
    <section class="ec-page-content ec-vendor-uploads ec-user-account wishlist-2 section-space-p">
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
                                        <li><a href="{{ Url('myorders') }}">My Orders</a></li>
                                        <li><a class="text-success" href="{{ Url('wishlist') }}">My Wishlist</a></li>
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
                            <h5>Wishlist</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="{{ Url('/') }}">Shop Now</a>
                            </div>
                        </div>
                        <div class="ec-vendor-card-body">
                            <div class="ec-vendor-card-table">
                                <table class="table ec-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="wish-empt">
                                        @if (Common::getWishlist()->count() > 0)
                                            @foreach (Common::getWishlist() as $key => $item)
                                                <tr class="pro-gl-content">
                                                    <th scope="row"><span>{{ $key + 1 }}</span></th>
                                                    <td><img loading="lazy" class="prod-img border"
                                                            onerror="this.src = './default/no-image.png'"
                                                            src="{{ env('IMG_URL') }}product_images/{{ $item->product_image }}" alt="{{$item->caption_name}}">
                                                    </td>
                                                    <td>
                                                        <a
                                                            href="{{ Url('product/' . $item->item_id . '/' . Common::getSlugName($item->caption_name)) }}"><span
                                                                style="text-overflow: ellipsis;max-width: 15rem;overflow: hidden;white-space: nowrap;">{{ $item->name }}</span></a>
                                                    </td>
                                                    <td><span>{{ date('Y-M-d', strtotime($item->created_at)) }}</span>
                                                    </td>
                                                    <td><span>₹{{ $item->price }}</span></td>
                                                    <td>
                                                        @if ((int) $item->product_qty <= 0)
                                                            <span class="text-danger">Out
                                                                of
                                                                Stock</span>
                                                        @elseif((int) $item->product_qty < 5)
                                                            <span class="text-warning">Few
                                                                Items Left</span>
                                                        @else
                                                            <span class="text-secondary">In
                                                                Stock</span>
                                                        @endif
                                                        </span>
                                                    <td><span class="tbl-btn">
                                                            <a class="btn btn-lg btn-primary" href="javascript:void(0)" onclick="addToCart('{{ $item->pid }}','{{ $item->item_id }}','1',event, addtocartHandler)"
                                                                title="Add To Cart">
                                                                <img loading="lazy" src="assets/images/icons/pro_cart.svg"
                                                                    class="svg_img pro_svg" alt="cart icon" />
                                                            </a>
                                                            <a class="btn btn-lg btn-primary ec-com-remove ec-remove-wish"
                                                                href="javascript:void(0)"
                                                                onclick="addToWishlist('{{ $item->item_id }}', event, wishlistHandler2)"
                                                                title="Remove From List">×</a></span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td class="text-center" colspan="7">Your wishlist is empty!
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End User history section -->
@endsection
