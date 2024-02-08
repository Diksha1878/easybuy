@extends('layouts.frontend')
@section('meta')
<title>Signup | Easybuy Online Shopping Site In India</title>
<meta name="title" content="Signup | Easybuy Online Shopping Site In India">
<meta name="description" content="Easybuy: signup to india largest online shopping sites. Create your account and find low everyday prices and buy online and get fast delivery.">

<meta property="og:type" content="website">
<meta property="og:url" content="{{Url('/')}}">
<meta property="og:title" content="Login | Easybuy Online Shopping Site In India">
<meta property="og:description" content="Easybuy: signup to india largest online shopping sites. Create your account and find low everyday prices and buy online and get fast delivery.">
<meta property="og:image" content="{{Url('default/easybuy_logo.webp')}}">

<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{Url('/')}}">
<meta property="twitter:title" content="Login | Easybuy Online Shopping Site In India">
<meta property="twitter:description" content="Easybuy: signup to india largest online shopping sites. Create your account and find low everyday prices and buy online and get fast delivery.">
<meta property="twitter:image" content="{{Url('default/easybuy_logo.webp')}}">

<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
@endsection

@section('content')
    <!-- Start Register -->
    <section class="ec-page-content section-space-p" style="max-width: 40rem; margin: 0px auto;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h1 class="ec-bg-title">Sign Up</h1>
                        <h1 class="ec-title">Sign Up</h1>
                        <p class="sub-title mb-3">India's Largest Online Shopping Site</p>
                    </div>
                </div>
                <div class="ec-register-wrapper">
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            <form action="{{ route('frontend.auth.signup') }}" method="post"
                                novalidate>
                                @csrf
                                <div class="ec-register-wrap mb-4 px-0 px-md-3">
                                    <label class="">Full Name*</label>
                                    <input type="text" class="form-control mb-0" name="fullname"
                                        value="{{ old('fullname') }}" placeholder="Enter your first name" required />
                                        @error('fullname')
                                        <div class="text-danger">
                                            {{ $message }} 
                                        </div>
                                        @enderror
                                </div>
                                <div class="ec-register-wrap mb-4 px-0 px-md-3">
                                    <label>Email*</label>
                                    <input type="email" class="form-control mb-0" name="email"
                                        placeholder="Enter your email add..." value="{{ old('email') }}" required />
                                        @error('email')
                                        <div class="text-danger">
                                            {{ $message }} 
                                        </div>
                                        @enderror
                                   
                                </div>
                                <div class="ec-register-wrap mb-4 px-0 px-md-3">
                                    <label>Phone Number*</label>
                                    <input pattern=".{10,}" type="tel" class="form-control mb-0" name="mobile"
                                        placeholder="Enter your phone number" value="{{ old('mobile') }}" required />
                                        @error('mobile')
                                        <div class="text-danger">
                                            {{ $message }} 
                                        </div>
                                        @enderror
                                  
                                </div>
                                <div class="ec-register-wrap mb-4 px-0 px-md-3">
                                    <label>Password*</label>
                                    <input pattern=".{8,}" type="password" value="{{ old('password') }}" class="form-control mb-0" name="password"
                                        placeholder="Enter your passowrd" required />
                                        @error('password')
                                        <div class="text-danger">
                                            {{ $message }} 
                                        </div>
                                        @enderror
                                   
                                </div>
                                <div class="ec-register-wrap ec-register-btn">
                                    <button class="btn btn-primary" type="submit">Sign Up</button>
                                </div>
                                <div class="text-center w-100 mt-4">
                                    <span>already account?</span>
                                    <a href="{{ Url('login') }}">Login</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Register -->
@endsection
