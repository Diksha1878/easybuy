@extends('layouts.frontend')
@section('meta')
    <title>Order Status | Easybuy Online Shopping Site In India</title>
    <meta name="robots" content="noindex">
@endsection
@section('content')
{{-- order success --}}
@if($order->txn_status === 'SUCCESS' || $order->txn_status === 'OFFLINE')
<section class="ec-page-content section-space-p" style="margin-bottom:3rem;margin-top:3rem">
    <div class="container">
        <div class="text-center">
            <svg class="order-status-icon text-success mb-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z"/></svg>
            <h3 class="fw-bold">Thank you for your order!</h3>
            <p>The order confirmation email with details of your order and a link to track its progress has been sent to youyr email address.</p>

            <div class="mb-3">
               <span class="p-2" style="background:#eee"> Your Order ID: <span class="fw-bold">{{ $order->order_id }}</span></span> 
            </div>
            <p>Order Date: {{ date("d M Y h:i A", strtotime($order->created_at)) }}</p>
            <a class="btn btn-primary" href="{{Url('order'.'/'.$order->order_id)}}">View Order Details</a>
        </div>
    </div>
</section>
@endif

@if($order->txn_status !== 'SUCCESS' && $order->txn_status !=='OFFLINE')
{{-- order failed --}}
<section class="ec-page-content section-space-p" style="margin-bottom:3rem;margin-top:3rem">
    <div class="container">
        <div class="text-center">
            <svg class="order-status-icon text-danger mb-3" clip-rule="evenodd" fill="currentColor" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 8.933-2.721-2.722c-.146-.146-.339-.219-.531-.219-.404 0-.75.324-.75.749 0 .193.073.384.219.531l2.722 2.722-2.728 2.728c-.147.147-.22.34-.22.531 0 .427.35.75.751.75.192 0 .384-.073.53-.219l2.728-2.728 2.729 2.728c.146.146.338.219.53.219.401 0 .75-.323.75-.75 0-.191-.073-.384-.22-.531l-2.727-2.728 2.717-2.717c.146-.147.219-.338.219-.531 0-.425-.346-.75-.75-.75-.192 0-.385.073-.531.22z" fill-rule="nonzero"/></svg>
            <h3 class="fw-bold">Payment {{ ucwords(strtolower($order->txn_status)) }}!</h3>
            <p>This order has {{ ucwords(strtolower($order->txn_status)) }} to complete. If you having issues please contact at <a style="color:#427c80" href="mailto:support@easybuy.in">support@easybuy.in</a></p>

            <div class="mb-3">
               <span class="p-2" style="background:#eee"> Your Order ID: <span class="fw-bold">{{ $order->order_id }}</span></span> 
            </div>
            <p>Order Date: {{ date("d M Y h:i A", strtotime($order->created_at)) }}</p>
            <a class="btn btn-primary" href="">View Order Details</a>
        </div>
    </div>
</section>
@endif
@endsection
