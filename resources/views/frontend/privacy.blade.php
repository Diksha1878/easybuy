@extends('layouts.frontend')
@section('meta')
<title>Privacy Policy | Easybuy Online Shopping Site In India</title>
<meta name="title" content="Privacy Policy | Easybuy Online Shopping Site In India">
<meta name="description" content="Easybuy: Know more about our terms and condition.">

<meta property="og:type" content="website">
<meta property="og:url" content="{{Url('privacy-policy')}}">
<meta property="og:title" content="Privacy Policy | Easybuy Online Shopping Site In India">
<meta property="og:description" content="Easybuy: Know more about our privacy policy.">
<meta property="og:image" content="{{Url('default/easybuy_logo.webp')}}">

<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{Url('privacy-policy')}}">
<meta property="twitter:title" content="Privacy Policy | Easybuy Online Shopping Site In India">
<meta property="twitter:description" content="Easybuy: Know more about our privacy policy.">
<meta property="twitter:image" content="{{Url('default/easybuy_logo.webp')}}">

<meta name="robots" content="index, follow" />
<meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
@endsection
@section('content')
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
            <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
            <li class="ec-breadcrumb-item active"
                style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Privacy Policy
            </li>
        </ul>
    </div>
</div>
<!-- Ec breadcrumb end -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <h1 class="fs-3 text-center mb-4 fw-bold" style="color: #555555;">Privacy Policy </h1>
        <p>This Privacy Policy describes how easy-buy.in (the “Site” or “we”) collects, uses, and discloses your
            Personal Information when you visit or make a purchase from the Site.</p>
        <strong class="text-dark fs-6">About Your Personal Information –</strong>
        <p>When you visit the Site, we collect certain information about your device, your interaction with the Site,
            and information necessary to process your purchases. We may also collect additional information if you
            contact us for customer support. In this Privacy Policy, we refer to any information that can uniquely
            identify an individual (including the information below) as “Personal Information”. See the list below for
            more information about what Personal Information we collect and why.</p>
        <strong class="text-dark fs-6">Information of Your Purchase –</strong>
        <ul class="mb-3">
            <li class="mb-1"><strong class="text-dark">• Examples of Personal Information collected:</strong> Name,
                billing address,
                shipping address,
                payment
                information (including credit card numbers), email address, and phone number.</li>
            <li class="mb-1"><strong class="text-dark">• Purpose of collection:</strong> to provide products or services
                to you to fulfill
                our contract, to
                process your
                payment information, arrange for shipping, and provide you with invoices and/or order confirmations,
                communicate with you, screen our orders for potential risk or fraud, and when in line with the
                preferences you have shared with us, provide you with information or advertising relating to our
                products or services.</li>
            <li><strong class="text-dark">• Source of collection:</strong> collected from you.</li>
        </ul>
        <strong class="text-dark fs-6">Why We Need Personal Information –</strong>
        <p>We use your personal Information to provide our services to you, which includes: offering products for sale,
            processing payments, shipping and fulfillment of your order, and keeping you up to date on new products,
            services, and offers.</p>
        <strong class="text-dark fs-6">About Changes – </strong>
        <p>We may update this Privacy Policy from time to time in order to reflect, for example, changes to our
            practices or for other operational, legal, or regulatory reasons.</p>
        <p><strong class="text-dark">Contact With Us –</strong>For more information about our privacy practices, if you
            have questions,
            or if you would
            like to make a complaint, please contact us by e-mail at easybuysales5@gmail.com .in or by mail using the
            details provided below:</p>
    </div>
</section>
@endsection