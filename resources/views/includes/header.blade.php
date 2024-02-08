<!-- Header start  -->
<nav class="ec-header menu_fixed no-print">
    <!--Ec Header Top Start -->
    <div class="header-top d-lg-none">
        <div class="container">
            <div class="row align-items-center">
                <!-- Header Top social Start -->
                <div class="col text-left header-top-left d-none d-lg-block">
                    <div class="header-top-social">
                        <span class="social-text text-upper">Follow us on:</span>
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="https://www.facebook.com/easy-buyin-100146009487038" target="_blank"><i
                                class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="https://twitter.com/easybuy_19" target="_blank"><i
                                        class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="https://www.instagram.com/easybuy.in/" target="_blank"><i
                                        class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="https://www.youtube.com/channel/UCT1RfrX1JPm5n9Vfd__u7Ng" target="_blank"><i
                                        class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Header Top social End -->
                <!-- Header Top Language Currency -->

                <div class="col header-top-right d-none d-lg-block">
                    <div class="header-top-lan-curr d-flex justify-content-end">
                        <!-- Currency Start -->
                        <div class="header-top-curr dropdown">
                            <a href="{{ Url('signup') }}">Sign Up</a>
                        </div>
                        <div class="header-top-lan dropdown ml-3">
                            <a class="btn-primary btn px-3 py-1 d-flex align-items-center"
                                style="height: 26px;line-height: unset;font-size: 13px;font-weight:300"
                                href="{{ Url('login') }}">Login</a>
                        </div>
                    </div>
                </div>

                <!-- Header Top Language Currency -->
                <!-- Header Top responsive Action -->
                <div class="col d-lg-none ">
                    <div class="ec-header-bottons">
                        <!-- Header User Start -->
                        <div class="d-flex w-100 justify-content-between align-items-center ml-4 mx-md-0">
                            <div style="max-width: 6rem;">
                                <a href="{{ Url('/') }}"><img src="assets/images/logo/logo.png"
                                        alt="easybuy" /><img class="dark-logo" src="assets/images/logo/dark-logo.png"
                                        alt="easybuy" style="display: none;" /></a>
                            </div>
                            <div class="d-flex">
                                <div class="ec-header-user dropdown d-flex">
                                    <button class="dropdown-toggle mr-5 mr-sm-3" style="z-index: 50;"
                                        data-bs-toggle="dropdown"><img src="assets/images/icons/user.svg"
                                            class="svg_img header_svg" alt="dropdown icon" /></button>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if (!UserAuth::has('login'))
                                            <li><a class="dropdown-item" href="{{ Url('signup') }}">Signup</a></li>
                                            <li><a class="dropdown-item" href="{{ Url('login') }}">Login</a></li>
                                        @else
                                            <li><a class="dropdown-item" href="{{ Url('myaccount') }}">Account</a>
                                            </li>
                                            <li><a class="dropdown-item text-danger"
                                                    href="{{ Url('logout') }}">Logout</a></li>
                                        @endif

                                    </ul>
                                    <a href="{{ route('frontend.cart') }}" class="ec-header-btn pl-5 pl-sm-0">
                                        <div class="header-icon"><img src="assets/images/icons/cart.svg"
                                                class="svg_img header_svg" alt="cart icon" />
                                        </div>
                                        <span class="ec-header-count cart-count-lable cart-count">{{ CartUtil::cartCount() }}</span>
                                    </a>
                                    <a href="{{Url('wishlist')}}" class="ec-header-btn ec-header-wishlist pl-4 pl-sm-0">
                                        <div class="header-icon"><img src="assets/images/icons/wishlist.svg"
                                                class="svg_img header_svg" alt="wishlist icon" /></div>
                                        <span class="ec-header-count wishlist-count">{{ Common::getWishlist()->count() }}</span>
                                    </a>
                                </div>
                            </div>

                        </div>
                        <!-- Header Cart End -->
                        <!-- Header menu Start -->
                        <a href="#ec-mobile-menu" class="ec-header-btn ec-side-toggle d-lg-none">
                            <img src="assets/images/icons/menu.svg" class="svg_img header_svg" alt="menu icon" />
                        </a>
                        <!-- Header menu End -->
                    </div>
                </div>
                <!-- Header Top responsive Action -->
            </div>
        </div>
    </div>
    <!-- Ec Header Top  End -->
    <!-- Ec Header Bottom  Start -->
    <div class="ec-header-bottom d-none d-lg-block">
        <div class="container position-relative">
            <div class="row">
                <div class="ec-flex">
                    <!-- Ec Header Logo Start -->
                    <div class="align-self-center">
                        <div class="header-logo">
                            <a href="{{ Url('/') }}"><img src="assets/images/logo/logo.png" alt="easybuy" /><img
                                    class="dark-logo" src="assets/images/logo/dark-logo.png" alt="easybuy"
                                    style="display: none;" /></a>
                        </div>
                    </div>
                    <!-- Ec Header Logo End -->

                    <!-- Ec Header Search Start -->
                    <div class="align-self-center">
                        <div class="header-search">
                            <form class="ec-btn-group-form" action="{{ Url('products') }}">
                                <input name="search" class="form-control ec-search-bar search-key" placeholder="Search products..."
                                    type="text" value="{{ request()->input('search'); }}">
                                <button class="submit" type="submit"><img src="assets/images/icons/search.svg"
                                        class="svg_img header_svg" alt="search icon" /></button>
                            </form>
                        </div>
                    </div>
                    <!-- Ec Header Search End -->

                    <!-- Ec Header Button Start -->
                    <div class="align-self-center">
                        <div class="ec-header-bottons">

                            <!-- Header User Start -->
                            <div class="ec-header-user dropdown d-lg-none">
                                <button class="dropdown-toggle" data-bs-toggle="dropdown"><img
                                        src="assets/images/icons/user.svg" class="svg_img header_svg"
                                        alt="dropdown icon" /></button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="{{ Url('signup') }}">Signup</a></li>
                                    {{-- <li><a class="dropdown-item" href="checkout.html">Checkout</a></li> --}}
                                    <li><a class="dropdown-item" href="{{ Url('login') }}">Login</a></li>
                                </ul>
                            </div>
                            <!-- Header User End -->
                            <!-- Header wishlist Start -->
                            <a href="{{Url('wishlist')}}" class="ec-header-btn ec-header-wishlist">
                                <div class="header-icon"><img src="assets/images/icons/wishlist.svg"
                                        class="svg_img header_svg" alt="wishlist icon" /></div>
                                      
                                <span class="ec-header-count wishlist-count">{{ Common::getWishlist()->count() }}</span>
                               
                            </a>
                            <!-- Header wishlist End -->
                            <!-- Header Cart Start -->
                            {{-- toggle for cart-> ec-side-toggle --}}
                            <a href="{{ route('frontend.cart') }}" class="ec-header-btn">
                                <div class="header-icon"><img src="assets/images/icons/cart.svg"
                                        class="svg_img header_svg" alt="cart icon" /></div>
                                <span class="ec-header-count cart-count-lable cart-count">{{ CartUtil::cartCount() }}</span>
                            </a>
                            <!-- Header Cart End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Header Button End -->
    <!-- Header responsive Bottom  Start -->
    <div class="ec-header-bottom d-lg-none">
        <div class="container position-relative">
            <div class="row ">
                <div class="col">
                    <div class="header-search">
                        <form class="ec-btn-group-form" action="{{ Url('/products') }}">
                            <input name="search" class="form-control ec-search-bar" placeholder="Search products..."
                                type="text" value="{{ request()->input('search'); }}">
                            <button class="submit" type="submit"><img src="assets/images/icons/search.svg"
                                    class="svg_img header_svg" alt="search icon" /></button>
                        </form>
                    </div>
                </div>
                <!-- Ec Header Search End -->
            </div>
        </div>
    </div>
    <!-- Header responsive Bottom  End -->
    <!-- EC Main Menu Start -->
    <div id="ec-main-menu-desk" class="d-none d-lg-block sticky-nav">
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-12 align-self-center">
                    <div class="ec-main-menu">
                        <ul>
                            <li><a href="{{ Url('/') }}">Home</a></li>
                            <li class="dropdown"><a href="javascript:{}">Categories</a>
                                <ul class="sub-menu">
                                    @if (!empty($newCats) && count($newCats) > 0)
                                        @foreach ($newCats as $cat)
                                            @if (count($cat['subcats']) > 0)
                                                <li class="dropdown position-static"><a href="{{Url('/')}}/products/{{Common::getSlugName($cat['name'])}}?categoryId={{ $cat['id'] }}">{{ $cat['name'] }}
                                                        <i class="ecicon eci-angle-right"></i></a>
                                                    <ul class="sub-menu sub-menu-child">
                                                        @foreach ($cat['subcats'] as $subcat)
                                                            <li><a href="{{Url('/')}}/products/{{Common::getSlugName($cat['name']).'/'.Common::getSlugName($subcat['name'])}}?categoryId={{ $cat['id'] }}&subCategoryId={{ $subcat['id'] }}">{{ $subcat['name'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a
                                                        href="{{Url('/')}}/products/{{Common::getSlugName($cat['name'])}}?categoryId={{ $cat['id'] }}">{{ $cat['name'] }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    @endif
                                </ul>
                            </li>
                            <li>
                                <a href="{{ Url('about-us') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ Url('contact-us') }}">Contact Us</a>
                            </li>
                            <li class="dropdown scroll-to d-flex align-items-center">
                                @if (!UserAuth::has('login'))
                                    <div class="header-top-curr dropdown">
                                        <a href="{{ Url('signup') }}">Sign Up</a>
                                    </div>
                                    <div class="header-top-lan dropdown ml-4">
                                        <a class="btn-primary btn px-3 py-1 d-flex align-items-center text-white"
                                            style="height: 26px;line-height: unset;font-size: 13px;font-weight:300"
                                            href="{{ Url('login') }}">Login</a>
                                    </div>
                                @endif
                                @if (UserAuth::has('login'))
                                    <a class="ml-4" href="{{ Url('myaccount') }}"><img class="mr-1"
                                            style="width:22px" src="assets/images/icons/user.svg" alt="my account"/> My Account</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ec Main Menu End -->
    <!-- ekka Mobile Menu Start -->
    <div id="ec-mobile-menu" class="ec-side-cart ec-mobile-menu">
        <div class="ec-menu-title">
            <span class="menu_title">My Menu</span>
            <button class="ec-close">×</button>
        </div>
        <div class="ec-menu-inner">
            <div class="ec-menu-content">
                <ul>
                    <li><a href="{{ Url('/') }}">Home</a></li>
                    <li><a href="javascript:void(0)">Categories</a>
                        <ul class="sub-menu">
                            @if (!empty($newCats) && count($newCats) > 0)
                                @foreach ($newCats as $cat)
                                    @if (count($cat['subcats']) > 0)
                                        <li><a href="{{Url('/')}}/products/{{Common::getSlugName($cat['name'])}}?categoryId={{ $cat['id'] }}">{{ $cat['name'] }}
                                            </a>
                                            <ul class="sub-menu">
                                                @foreach ($cat['subcats'] as $subcat)
                                                    <li><a
                                                            href="{{Url('/')}}/products/{{Common::getSlugName($cat['name']).'/'.Common::getSlugName($subcat['name'])}}?categoryId={{ $cat['id'] }}&subCategoryId={{ $subcat['id'] }}">{{ $subcat['name'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li><a href="{{Url('/')}}/products/{{Common::getSlugName($cat['name'])}}?categoryId={{ $cat['id'] }}">{{ $cat['name'] }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </li>
                    <li>
                        <a href="{{ Url('myaccount') }}">My Account</a>
                    </li>
                    <li>
                        <a href="{{ Url('myorders') }}">My Orders</a>
                    </li>
                    <li>
                        <a href="{{ Url('cart') }}">Cart</a>
                    </li>
                </ul>
            </div>
            <div class="header-res-lan-curr">
                <!-- Social Start -->
                <div class="header-res-social">
                    <div class="header-top-social">
                        <ul class="mb-0">
                            <li class="list-inline-item"><a class="hdr-facebook" href="https://www.facebook.com/easy-buyin-100146009487038" target="_blank"><i
                                        class="ecicon eci-facebook"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-twitter" href="https://twitter.com/easybuy_19" target="_blank"><i
                                        class="ecicon eci-twitter"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-instagram" href="https://www.instagram.com/easybuy.in/" target="_blank"><i
                                        class="ecicon eci-instagram"></i></a></li>
                            <li class="list-inline-item"><a class="hdr-linkedin" href="https://www.youtube.com/channel/UCT1RfrX1JPm5n9Vfd__u7Ng" target="_blank"><i
                                        class="ecicon eci-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Social End -->
            </div>
        </div>
    </div>
    <!-- ekka mobile Menu End -->
</nav>
<!-- Header End  -->
