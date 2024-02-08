<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{ Url('./') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="57x57" href="{{Url('apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{Url('apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{Url('apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{Url('apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{Url('apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{Url('apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{Url('apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{Url('apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{Url('apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{Url('android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{Url('favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{Url('favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{Url('favicon-16x16.png')}}">
    <link rel="manifest" href="{{Url('manifest.json')}}">
    <meta name="msapplication-TileColor" content="#427c80"> 
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#427c80">

    @yield('meta')
    
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Raleway:300,400,500,600,700|Crete+Round:400i" rel="stylesheet" type="text/css" as="font" />

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- css Icon Font -->
    <link rel="stylesheet" href="assets/css/vendor/ecicons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css All Plugins Files -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css" />
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/countdownTimer.css" />
    <link rel="stylesheet" href="assets/css/plugins/slick.min.css" />
    <link rel="stylesheet" href="assets/css/plugins/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/plugins/nouislider.css" />

    <!-- Main Style -->
    <link rel="stylesheet" href="assets/css/demo1.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/responsive.css" />

    <!-- Background css -->
    {{-- <link rel="stylesheet" id="bg-switcher-css" href="assets/css/backgrounds/bg-4.css"> --}}

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4K4TLWBNYH"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-4K4TLWBNYH');
    </script>
    
    <style>
        .form-select:focus {
            box-shadow: none !important;
        }

        .ec-slide-content {
            background: rgb(0 0 0 / 6%);
            padding: 15px;
        }

        .slick-slide {
            padding-bottom: 2px !important;
        }

        .addtocart-st {
            bottom: 50px !important;
            border-top-left-radius: 8px !important;
            border-top-right-radius: 8px !important;
            border-bottom-left-radius: 0px !important;
            border-bottom-right-radius: 0px !important;
        }

        .categoryFilter {
            position: relative;
        }

        .order-status-icon {
            width: 5rem;
            height: 5rem;
        }

        .cats:hover .cats-img {
            transform: scale(1.1);
            transition: 500ms ease-in-out;

            /* background: #00000090; */
            /* opacity: 0.5; */
        }

        .h-8 {
            height: 12rem;
        }

        @media only screen and (max-width: 991px) {
            .addtocart-st {
                bottom: 99px !important;
            }

            .categoryFilter {
                position: fixed;
                background: #fff;
                z-index: 100;
                top: 0;
                overflow-y: auto;
                overflow-x: hidden;
                height: 100%;
                padding: 1rem 0.8rem;
                display: none;
                max-width: 27rem;
            }

            /* .ec_qtybtn{
                padding: 0 1rem;
            } */
        }

        @media only screen and (max-width: 500px) {
            .h-8 {
                height: 8rem;
            }
        }

        @media print {

            .no-print,
            .no-print * {
                display: none !important;
            }
        }
    </style>
</head>

<body>
    @php
    $newCats = Common::getCategoryMenuList();
    @endphp
    {{-- <div id="ec-overlay"><span class="loader_img"></span></div> --}}
    @if (in_array(Request::segment('1'), ['login', 'signup','order-status']))
    @include('includes.auth-header')
    @else
    @include('includes.header')
    @endif


    @yield('content')
    @include('includes.services')
    @include('includes.footer')
    @include('includes.whatsappsupport')

    <!-- Vendor JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/jquery.notify.min.js"></script>
    <script src="assets/js/vendor/jquery.bundle.notify.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>

    <!--Plugins JS-->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/countdownTimer.min.js"></script>
    <script src="assets/js/plugins/scrollup.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/slick.min.js"></script>
    <script src="assets/js/plugins/infiniteslidev2.js"></script>
    <script src="assets/js/vendor/jquery.magnific-popup.min.js"></script>
    <script src="assets/js/plugins/jquery.sticky-sidebar.js"></script>
    <script src="assets/js/plugins/nouislider.js"></script>
    <!-- Main Js -->
    <script src="assets/js/libs.js"></script>
    <script src="assets/js/vendor/index.js"></script>
    <script src="assets/js/main.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            @if(session('error') || !empty(@$error))
            Toastify({
                text: "{{ session('error') ?? @$error }}",
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
            @endif
            @if(session('success') || !empty(@$success))
            Toastify({
                text: "{{ session('success') ?? @$success }}",
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function() {} // Callback after click
            }).showToast();
            @endif
        });
    </script>
    <script>
        //wishlist script
        let wishlistCall = true;

        function addToWishlist(id, e, callback) {
            $(e.target).css('opacity', '0.5')
            if (wishlistCall === true) {
                wishlistCall = false;
                $.ajax({
                    'type': 'post',
                    'url': '{{ route("frontend.wishlist.add") }}',
                    'data': {
                        _token: '{{ @csrf_token() }}',
                        id: id
                    },
                    'success': function(response) {

                        wishlistCall = true;
                        $(e.target).css('opacity', '1')

                        if (callback) {
                            callback(id, e, response, null)
                        }

                    },
                    'error': function(error) {
                        $(e.target).css('opacity', '1')
                        if (callback) {
                            callback(id, e, null, error)
                        }

                    }

                })
            }
        }

        function wishlistHandler1(id, e, response, error) {

            if (response) {
                $('.wishlist-count').text(response.count || 0)
                if (response.added === true) {
                    $(e.target).parents('.ec-single-wishlist').find('.icon-box-2').hide()
                    $(e.target).parents('.ec-single-wishlist').find('.icon-box-1').show()
                } else {
                    $(e.target).parents('.ec-single-wishlist').find('.icon-box-1').hide()
                    $(e.target).parents('.ec-single-wishlist').find('.icon-box-2').show()
                }

                // $(e.target).parents('.ec-pro-image').attr('class', 'icon-box fa-solid fa-heart')
                Toastify({
                    text: response.message,
                    destination: "{{Url('wishlist')}}",
                    duration: 3000,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            } else if (error) {
                Toastify({
                    text: error.responseJSON.message,
                    destination: "{{Url('login')}}",
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
            }
        }

        function wishlistHandler2(id, e, response, error) {

            if (response) {
                $('.wishlist-count').text(response.count || 0)
                Toastify({
                    text: response.message,
                    destination: "{{Url('wishlist')}}",
                    duration: 3000,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
                $(e.target).parents('tr .pro-gl-content').remove();
            } else if (error) {
                Toastify({
                    text: error.responseJSON.message,
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
            }
        }

        function wishlistHandler(id, e, response, error) {

            if (response) {
                $('.wishlist-count').text(response.count || 0)
                if (response.added === true) {
                    $(e.target).parents('.ec-pro-image').find('.icon-box-2').hide()
                    $(e.target).parents('.ec-pro-image').find('.icon-box-1').show()
                } else {
                    $(e.target).parents('.ec-pro-image').find('.icon-box-1').hide()
                    $(e.target).parents('.ec-pro-image').find('.icon-box-2').show()
                }

                // $(e.target).parents('.ec-pro-image').attr('class', 'icon-box fa-solid fa-heart')
                Toastify({
                    text: response.message,
                    destination: "{{Url('wishlist')}}",
                    duration: 3000,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            } else if (error) {
                Toastify({
                    text: error.responseJSON.message,
                    destination: "{{Url('login')}}",
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
            }
        }
    </script>
    <script>
        function addToCart(pid, item_id, qty, event, callback) {
            $(event.target).css('opacity', '0.5');
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('p_item_id', item_id);
            formData.append('pid', pid);
            formData.append('qty', qty);
            $.ajax({
                type: 'post',
                url: "{{ route('frontend.add-to-cart') }}",
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(response) {
                    $(event.target).css('opacity', '1');
                    if (callback) {
                        callback(pid, item_id, qty, event, response, null)
                    }

                },
                error: function(error) {
                    $(event.target).css('opacity', '1');
                    if (callback) {
                        callback(pid, item_id, qty, event, null, error)
                    }

                }
            })
        }

        function addtocartHandler(pid, item_id, qty, event, response, error) {
            if (response) {
                $('.cart-count').text(response.count || 0)
                $(event.target).css({
                    color: '#427c80'
                });
                Toastify({
                    text: response.message,
                    duration: 3000,
                    destination: "{{ Url('cart') }}",
                    // newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            } else if (error) {
                console.log(error)
                Toastify({
                    text: "Something went wrong, Please try again",
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
            }
        }

        function addtocartHandler2(pid, item_id, qty, event, response, error) {
            if (response) {
                $('.cart-count').text(response.count || 0)
                $(event.target).text('Added to Cart')
                Toastify({
                    text: response.message,
                    duration: 3000,
                    destination: "{{ Url('cart') }}",
                    // newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
            } else if (error) {
                console.log(error)
                Toastify({
                    text: "Something went wrong, Please try again",
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
            }
        }

        function addtocartHandler3(pid, item_id, qty, event, response, error) {
            if (response) {
                window.location = "{{Url('checkout')}}"
            } else if (error) {
                console.log(error)
                Toastify({
                    text: "Something went wrong, Please try again",
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
            }
        }

        function addtocartHandler1(pid, item_id, qty, event, response, error) {
            if (response) {
                $('.cart-count').text(response.count || 0)
                Toastify({
                    text: 'Item quantity updated successfully.',
                    duration: 3000,
                    // newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)",
                    },
                    onClick: function() {} // Callback after click
                }).showToast();
                $(event.target).parents('.cart-container').find(`.deliveryCharge`).html(`₹${response.totalDelivaryCharge.toLocaleString('hi-IN', {minimumFractionDigits: 2})}`);
                $(event.target).parents('.cart-container').find(`.subTotal`).html(`₹${response.subTotal.toLocaleString('hi-IN', {minimumFractionDigits: 2})}`);
                $(event.target).parents('.cart-container').find(`.totalAmount`).html(`₹${(response.subTotal+response.totalDelivaryCharge).toLocaleString('hi-IN', {minimumFractionDigits: 2})}`);
                $(event.target).parents('tr').find(`.product-total-price`).html(`₹${( parseFloat($(event.target).parents('tr').find('.amount').html().replace('₹',' ').replace(',','').trim())*parseInt(qty)).toLocaleString('hi-IN', {minimumFractionDigits: 2})}`);
                $(event.target).parents('.cart-container').find(`.totalAmount`).html(`₹${(response.subTotal+response.totalDelivaryCharge).toLocaleString('hi-IN', {minimumFractionDigits: 2})}`);
                $(event.target).parents('.cart-container').find(`.summary-product-${item_id}`).find('.summary-qty').html(qty);
            } else if (error) {
                console.log(error)
                Toastify({
                    text: "Something went wrong, Please try again",
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
            }
        }
      
        function setProductsURL(key, type){
            let url;
            const baseURL = '{{Url('/')}}'
            if(type === 'subCategory'){
                if(key === ''){
                    url = `${window.origin}${window.location.pathname.replace(window.location.pathname.split('/').pop(), '')}${window.location.search}`
                }
                else if(window.location.search.includes('subCategoryId')){
                    url = `${window.origin}${window.location.pathname.replace(window.location.pathname.split('/').pop(), key)}${window.location.search}`
                }
                else{
                    url = `${window.origin}${window.location.pathname}/${key}${window.location.search}`
                }
               
            }
            else if(type === 'brand'){
                console.log(new URL(window.location.href).searchParams.get('categoryId'))
                const categoryId = new URL(window.location.href).searchParams.get('categoryId')
                if(categoryId === null){
                    url = `${baseURL}/products/${key}${window.location.search}`
                }
            }
            else{
                url = `${baseURL}/products/${key}${window.location.search}`
            }
            // const 
                                        
            history.pushState({}, '', url)
                                      
        }
    </script>
</html>