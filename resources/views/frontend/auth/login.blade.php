@extends('layouts.frontend')
@section('meta')
    <title>Login | Easybuy Online Shopping Site In India</title>
    <meta name="title" content="Login | Easybuy Online Shopping Site In India">
    <meta name="description" content="Easybuy: login to india largest online shopping sites. Login your account and get best offers & lowest price ever.">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{Url('/')}}">
    <meta property="og:title" content="Login | Easybuy Online Shopping Site In India">
    <meta property="og:description" content="Easybuy: login to india largest online shopping sites. Login your account and get best offers & lowest price ever.">
    <meta property="og:image" content="{{Url('default/easybuy_logo.webp')}}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{Url('/')}}">
    <meta property="twitter:title" content="Login | Easybuy Online Shopping Site In India">
    <meta property="twitter:description" content="Easybuy: login to india largest online shopping sites. Login your account and get best offers & lowest price ever.">
    <meta property="twitter:image" content="{{Url('default/easybuy_logo.webp')}}">

    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
@endsection
@section('content')

    <!-- Ec login page -->
    <section class="ec-page-content section-space-p" style="max-width: 40rem; margin: 0px auto;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h1 class="ec-bg-title">Log In</h1>
                        <h1 class="ec-title">Log In</h1>
                        <p class="sub-title mb-3">India's Largest Online Shopping Site</p>
                    </div>
                </div>
                <div class="ec-login-wrapper">
                  
                    <div class="ec-login-container">
                        <div class="ec-login-form">
                            <form action="{{ route('frontend.auth.login') }}" method="post" novalidate>
                                @csrf
                                <span class="ec-login-wrap mb-4">
                                    <label>Email Address*</label>
                                    <input value="{{ old('email') }}" class="form-control mb-0" type="email" name="email"
                                        placeholder="Enter your email add..." required />
                                        @error('email')
                                        <div class="text-danger">
                                            {{ $message }} 
                                        </div>
                                        @enderror
                                </span>
                                <span class="ec-login-wrap mb-4">
                                    <label>Password*</label>
                                    <input class="form-control mb-0" type="password" name="password"
                                        placeholder="Enter your password" required />
                                        @error('password')
                                        <div class="text-danger">
                                            {{ $message }} 
                                        </div>
                                        @enderror
                                </span>
                                <span class="ec-login-wrap ec-login-fp d-flex justify-content-between mb-3">
                                    <span class="d-flex align-items-center gap-2">
                                        <input
                                            style="width:16px;height:16px;margin-bottom: 0px;accent-color: #427c80 !important;"
                                            type="checkbox" name="remember_me" id="remember_me">
                                        <label class="form-check-label" for="remember_me">Remember me</label>
                                    </span>
                                    <label><a href="javascript:void(0)" type=button data-bs-toggle="modal" data-bs-target="#resetPassword">Forgot Password?</a></label>
                                </span>
                                <span class="ec-login-wrap ec-login-btn">
                                    <button class="btn btn-primary" type="submit">Login</button>
                                </span>
                                <div class="text-center mt-4">
                                    <span>Don't have a account?</span>
                                    <a href="{{ Url('signup') }}">Sign Up</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
<div class="modal fade" id="resetPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Forgot Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" onsubmit="forgotPassword(this)" class="needs-validation" novalidate>
            <div class="modal-body">
                <div class="alertBox">

                </div>
                <span class="ec-login-wrap mb-4">
                    <label>Email Address*</label>
                    <input value="" class="form-control mb-0" type="email" name="email" placeholder="Enter your email add..." pattern='(.+)@(.+)\.(.+)' required>
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    function forgotPassword(el){
        event.preventDefault();
        const email = $(el).find('input[name="email"]').val();
        let p2 = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

        const formData = new FormData();
        formData.append('_token','{{ csrf_token() }}')
        formData.append('email',email)

        if(email != '' && p2.test(email)){
            $(el).find('button[type="submit"]').css('opacity', '0.5')
            $.ajax({
                type: 'post',
                url: "{{ Url('forgot-password') }}",
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(response) {
                    console.log(response)
                    Toastify({
                        text: response.message,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            background: "linear-gradient(to right, #00b09b, #96c93d)",
                        },
                        onClick: function() {}
                    }).showToast();
                    $(el).find('button[type="submit"]').css('opacity', '1')
                    $(el).trigger('reset');
                    $(el).removeClass('was-validated');
                    $('.alertBox').html(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Passowrd reset link has been successfully sent to <strong>${response.form_data.email}. Your password link will be expired in 10 minutes.</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                },
                error: function(error) {
                    console.log(error)
                    Toastify({
                        text: 'Something went wrong',
                        duration: 3000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "linear-gradient(to right, rgb(255, 95, 109), rgb(255, 195, 113))",
                        },
                        onClick: function() {} // Callback after click
                    }).showToast();
                    $(el).find('button[type="submit"]').css('opacity', '1')
                }
            });
        }
    }
</script>
@endsection
