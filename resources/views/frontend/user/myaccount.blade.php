@extends('layouts.frontend')
@section('meta')
    <title>My Account | Easybuy Online Shopping Site In India</title>
    <meta name="robots" content="noindex">
@endsection
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
                <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">My Account</li>
            </ul>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- User profile section -->
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
                                        <li><a class="text-success" href="{{ Url('myaccount') }}">My Profile</a></li>
                                        <li><a href="{{ Url('myorders') }}">My Orders</a></li>
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
                    <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                        <div class="ec-vendor-card-body p-3 p-sm-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="ec-vendor-block-profile">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                    <h6>Account Information<a href="javasript:void(0)"><img loading="lazy"
                                                                src="assets/images/icons/edit.svg" class="svg_img pro_svg"
                                                                alt="edit icon" /></a></h6>

                                                    <div class="px-3">
                                                        <form action="{{ route('frontend.user.myaccount') }}"
                                                            method="post" enctype='multipart/form-data' novalidate>
                                                            @csrf
                                                            <div class="ec-vendor-block-detail mt-5"
                                                                style="padding-top:2.5rem">
                                                                <img loading="lazy" class="v-img" id="preview-profile"
                                                                    onerror="this.src='{{ 'https://ui-avatars.com/api/?name=' . $user->fname . '&color=7F9CF5&background=EBF4FF' }}'"
                                                                    src="{{ Url('data/profile_images/' . $user->profile_img) }}"
                                                                    alt="profile picture">
                                                                <div class="position-absolute text-center w-100 bottom-0">
                                                                    <span class="btn-primary px-2 py-1"
                                                                        onclick="profilePicHandler(this)">Choose</span>
                                                                </div>
                                                                <input onchange="previewProfile(this)" type="file"
                                                                    class="d-none" name="profile_pic"
                                                                    accept="image/png, image/jeg, image/jpeg">
                                                            </div>

                                                            <div class="ec-login-wrap mb-2">
                                                                <label class="form-label">Your Fullname</label>
                                                                <input
                                                                    value="{{ array_key_exists('fullname', (array) session('form_data')) ? session('form_data')['fullname'] : $user->fname }}"
                                                                    class="form-control mb-0" type="text" name="fullname"
                                                                    placeholder="Enter your fullname..." required />
                                                                @if (@session('form_errors')['fullname'])
                                                                    <div class="text-danger">
                                                                        {{ session('form_errors')['fullname'] }}
                                                                    </div>
                                                                @endif

                                                            </div>
                                                            <div class="ec-login-wrap mb-2">
                                                                <label class="form-label">Your Email</label>
                                                                <input class="form-control mb-0" type="email"
                                                                    name="email" placeholder="Enter your email..."
                                                                    value="{{ array_key_exists('email', (array) session('form_data')) ? session('form_data')['email'] : $user->email }}"
                                                                    required />
                                                                @if (@session('form_errors')['email'])
                                                                    <div class="text-danger">
                                                                        {{ session('form_errors')['email'] }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="ec-login-wrap mb-2">
                                                                <label class="form-label">Your Mobile Number</label>
                                                                <input class="form-control mb-0" type="tel"
                                                                    name="mobile" placeholder="Enter your mobile number..."
                                                                    value="{{ array_key_exists('mobile', (array) session('form_data')) ? session('form_data')['mobile'] : $user->phno }}"
                                                                    required />
                                                                @if (@session('form_errors')['mobile'])
                                                                    <div class="text-danger">
                                                                        {{ session('form_errors')['mobile'] }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <button class="btn btn-primary mt-2" style="font-size: 0.8rem"
                                                                type="submit">Update Profile</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($default_address)
                                                <div class="col-12 mb-3">
                                                    <div class="ec-vendor-detail-block ec-vendor-block-address">
                                                        <h6 class=" d-flex align-items-center">Default Address <a
                                                                href="{{ Url('myaddress') }}"
                                                                class="btn btn-lg btn-primary px-3 py-2"
                                                                style="font-size:0.7rem; height:fit-content;line-height:unset">All
                                                                Address</a></h6>
                                                        <ul class="px-3">
                                                            <div class="fw-bold">{{ $default_address->address1 }}</div>
                                                            <div>{{ $default_address->address2 }}
                                                                {{ $default_address->town_city }}
                                                                {{ $default_address->state }} -
                                                                {{ $default_address->pincode }},</div>
                                                            <div class="">{{ $default_address->landmark }}</div>
                                                            <div class="mt-1 fw-bold">Mobile: <span
                                                                    class="fw-normal">{{ $default_address->mobile }}</span>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                    <h6>Change Password<a href="javasript:void(0)"
                                                            data-link-action="editmodal" title="Edit Detail"
                                                            data-bs-toggle="modal" data-bs-target="#edit_modal"><img loading="lazy"
                                                                src="assets/images/icons/edit.svg" class="svg_img pro_svg"
                                                                alt="edit icon" /></a></h6>
                                                    <div class="px-3">
                                                        <form action="{{ route('frontend.user.change-password') }}"
                                                            method="post" novalidate>
                                                            @csrf

                                                            <div class="ec-login-wrap mb-2">
                                                                <label class="form-label">Current Password*</label>
                                                                <input
                                                                    value="{{ @session('form_data')['current_password'] }}"
                                                                    class="form-control mb-0" type="text"
                                                                    name="current_password"
                                                                    placeholder="Enter your current password..."
                                                                    required />

                                                                @if (@session('form_errors')['current_password'])
                                                                    <div class="text-danger">
                                                                        {{ session('form_errors')['current_password'] }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="ec-login-wrap mb-2">
                                                                <label class="form-label">New Password*</label>
                                                                <input
                                                                    value="{{ @session('form_data')['new_password'] }}"
                                                                    class="form-control mb-0" type="text"
                                                                    name="new_password"
                                                                    placeholder="Enter new password..." required />
                                                                @if (@session('form_errors')['new_password'])
                                                                    <div class="text-danger">
                                                                        {{ session('form_errors')['new_password'] }}
                                                                    </div>
                                                                @endif

                                                            </div>
                                                            <div class="ec-login-wrap mb-2">
                                                                <label class="form-label">Confirm Password*</label>
                                                                <input
                                                                    value="{{ @session('form_data')['confirm_password'] }}"
                                                                    class="form-control mb-0" type="text"
                                                                    name="confirm_password"
                                                                    placeholder="Enter confirm password..." required />
                                                                @if (@session('form_errors')['confirm_password'])
                                                                    <div class="text-danger">
                                                                        {{ session('form_errors')['confirm_password'] }}
                                                                    </div>
                                                                @endif
                                                                @if (session('password_error'))
                                                                    <div class="text-danger">
                                                                        {{ session('password_error') }}
                                                                    </div>
                                                                @endif
                                                                @if (session('password_success'))
                                                                    <div class="text-success">
                                                                        {{ session('password_success') }}
                                                                    </div>
                                                                @endif

                                                            </div>
                                                            <button class="btn btn-primary mt-2" style="font-size: 0.8rem"
                                                                type="submit">Change
                                                                Password</button>

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
            </div>
        </div>
    </section>

    <script>
        function profilePicHandler(el) {
            $(el).parent().parent().find('input[name="profile_pic"]').trigger('click');
        }

        function previewProfile(el) {
            const file = el.files[0]
            var reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById(`preview-profile`);
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <!-- End User profile section -->
@endsection
