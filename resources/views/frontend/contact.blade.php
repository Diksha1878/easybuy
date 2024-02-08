@extends('layouts.frontend')
@section('meta')
    <title>Contact Easybuy - Phone Number, Address, Customer Service, Chat & Support</title>
    <meta name="title" content="Contact Easybuy - Phone Number, Address, Customer Service, Chat & Support">
    <meta name="description" content="Contact Easybuy customer service today for help with your account, orders & purchases, support, information and more.">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{Url('contact-us')}}">
    <meta property="og:title" content="Contact Easybuy - Phone Number, Address, Customer Service, Chat & Support">
    <meta property="og:description" content="Contact Easybuy customer service today for help with your account, orders & purchases, support, information and more.">
    <meta property="og:image" content="{{Url('default/easybuy_logo.webp')}}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{Url('contact-us')}}">
    <meta property="twitter:title" content="Contact Easybuy - Phone Number, Address, Customer Service, Chat & Support">
    <meta property="twitter:description" content="Contact Easybuy customer service today for help with your account, orders & purchases, support, information and more.">
    <meta property="twitter:image" content="{{Url('default/easybuy_logo.webp')}}">
    
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
@endsection
@section('content')
<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
            <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
            <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Contact Us</li>
        </ul>
    </div>
</div>
<!-- Ec breadcrumb end -->

<!-- Ec Contact Us page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-common-wrapper">
                <div class="ec-contact-leftside">
                    <div class="ec-contact-container">
                        <div class="ec-contact-form">
                            <h1 class="fs-4" style="font-weight: 600;margin-bottom:1rem">Send us a message</h1>
                            <form action="" method="post" onsubmit="userQueryMailHandler(event,this)" class="needs-validation" novalidate>
                                <span class="ec-contact-wrap">
                                    <label>First Name*</label>
                                    <input class="form-control" type="text" name="firstname" placeholder="Enter your first name" required />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Last Name*</label>
                                    <input class="form-control" type="text" name="lastname" placeholder="Enter your last name" required />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Email*</label>
                                    <input class="form-control" type="email" name="email" placeholder="Enter your email address" required />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Phone Number*</label>
                                    <input class="form-control" type="text" name="phonenumber" pattern="^(\+\d{1,3}[- ]?)?\d{10}$" placeholder="Enter your phone number" required />
                                </span>
                                <span class="ec-contact-wrap">
                                    <label>Comments/Questions*</label>
                                    <textarea class="form-control" name="message" placeholder="Please leave your comments here.." required></textarea>
                                </span>
                                <span class="ec-contact-wrap ec-contact-btn">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="ec-contact-rightside">
                    <div class="ec_contact_map">
                        <div class="ec_map_canvas">
                            {{-- <iframe id="ec_map_canvas" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d71263.65594328841!2d144.93151478652146!3d-37.8734290780509!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sus!4v1615963387757!5m2!1sen!2sus"></iframe>
                            <a href="https://sites.google.com/view/maps-api-v2/mapv2"> --}}
                                <div style="width: 100%"><iframe width="100%" height="800" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.0266003684696!2d77.10005281508316!3d28.658922182407494!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x737913621238f6ad!2zMjjCsDM5JzMyLjEiTiA3N8KwMDYnMDguMSJF!5e0!3m2!1sen!2sin!4v1658642535647!5m2!1sen!2sin"><a href="https://www.maps.ie/distance-area-calculator.html">area maps</a></iframe></div>
                        
                            </a>
                        </div>
                    </div>
                    <div class="ec_contact_info">
                        <h3 class="ec_contact_info_head">Contact us</h3>
                        <ul class="align-items-center">
                            <li class="ec-contact-item"><i class="ecicon eci-map-marker" aria-hidden="true"></i><span>Address :</span><address class="mb-0">{{Common::getAddress()}}</address></li>
                            <li class="ec-contact-item align-items-center"><i class="ecicon eci-phone" aria-hidden="true"></i><span>Call Us :</span><a href="tel:+918447226676">+91 8447226676</a></li>
                            <li class="ec-contact-item align-items-center"><i class="ecicon eci-envelope" aria-hidden="true"></i><span>Email :</span><a href="mailto:sales@easy-buy.in">sales@easy-buy.in</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
</script>
<script>
    function userQueryMailHandler(e, el) {
        e.preventDefault();
        $(el).find('button[type="submit"]').css('opacity', '0.5')
        const fname = $(el).find('input[name="firstname"]').val();
        const lname = $(el).find('input[name="lastname"]').val();
        const email = $(el).find('input[name="email"]').val();
        const phonenumber = $(el).find('input[name="phonenumber"]').val();
        const messgae = $(el).find('textarea[name="message"]').val();

        let p2 = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        let p1 = /^(\+\d{1,3}[- ]?)?\d{10}$/;

        let data = {
            name: `${fname} ${lname}`,
            email: email,
            mobile: phonenumber,
            desc: messgae
        }


        const content = `<div style="width: 100%; display: flex; justify-content: center;">
                <div style="max-width: 40rem">
                    <div style="padding:1rem;background: #eee;">
                        <img style="max-width: 8rem;"
                            src="https://easy-buy.in/assets/images/logo/logo.png" alt="easybuy">
                    </div>
                    <div style="padding: 1rem;border:1px solid #eee">
                        <table style="width:100%;text-align: left;" cellspacing="0">
                            <tr>
                                <th style="border: 1px solid #ccc; padding: 0.5rem;border-bottom: 0;">Customer Name</th>
                                <td style="border: 1px solid #ccc; padding: 0.5rem; border-bottom: 0;">${data.name}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #ccc; padding: 0.5rem;border-bottom: 0;">Customer Email</th>
                                <td style="border: 1px solid #ccc; padding: 0.5rem;border-bottom: 0;">${data.email}</td>
                            </tr>
                            <tr>
                                <th style="border: 1px solid #ccc; padding: 0.5rem">Customer Number</th>
                                <td style="border: 1px solid #ccc; padding: 0.5rem">${data.mobile}</td>
                            </tr>
                        </table>
                        <p style="text-align: justify;"><strong>Product Description:</strong>&nbsp;${data.desc}</p>
                        <div style="display: flex; justify-content: center;margin: 1rem 0rem;margin-top: 2rem;text-align:center;width:100%">
                            <a style="text-decoration: none;background: #31649d;padding: 0.5rem 1rem; border-radius: 16px; color: aliceblue"
                                href="tel:${data.mobile}">CALL TO CUSTOMER</a>
                        </div>
                        </div>
                    </div>
                </div>`;
        const formData = new FormData();
        formData.append("fromName", "Easybuy");
        formData.append("mailTo", "sales@easy-buy.in");
        formData.append("replyTo", data.email);
        formData.append("toName", data.name);
        formData.append("subject", `${data.name}'s Query`);
        formData.append("content", content);
        if (fname != '' && lname != '' && email != '' && phonenumber != '' && messgae != '' && p2.test(email) && p1.test(phonenumber)) {
            $.ajax({
                type: 'post',
                url: "{{env('MAILER_URL')}}",
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(response) {
                    console.log(response)
                    // $('.form-success-msg').text(response.message);
                    Toastify({
                        text: 'Mail sent successfully',
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
                },
                error: function(error) {
                    // console.log(error)
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
            })
        }

    }
</script>
@endsection