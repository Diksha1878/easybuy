@extends('layouts.frontend')
@section('meta')
    <title>Order Details | Easybuy Online Shopping Site In India</title>
    <meta name="robots" content="noindex">
@endsection
@section('content')
<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb no-print">
    <div class="container">
        <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
            <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
            <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Order details</li>
        </ul>
    </div>
</div>
<!-- Ec breadcrumb end -->

<!-- User invoice section -->
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p no-print">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->
            <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12 no-print">
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
                    <div class="ec-vendor-card-header no-print">
                        <h5>
                            @if ($orderDetails->status == 'PENDING')
                            Pending
                            @elseif($orderDetails->status == 'PLACED')
                            Placed
                            @elseif($orderDetails->status == 'DISPATCHED')
                            Dispatched
                            @elseif($orderDetails->status == 'DELIVERED')
                            <span class="text-success">Delivered</span>
                            @elseif($orderDetails->status == 'CANCELLED')
                            <li class="fw-bold text-danger fs-5 ml-4">Cancelled</li>
                            @endif
                        </h5>
                        <div class="ec-header-btn">
                            @if($orderDetails->status == 'DELIVERED')
                            <button style="min-width:120px" class="btn btn-lg btn-primary" onclick="window.print()">Get Invoice</button>
                            @endif
                        </div>
                    </div>
                    <div class="ec-vendor-card-body padding-b-0 px-3 px-sm-5 printOrder">
                        <div class="page-content">
                            <div class="page-header text-blue-d2">
                                <img loading="lazy" src="assets/images/logo/logo.png" alt="easybuy">
                            </div>

                            <div class="container px-0">
                                <div class="row mt-4">
                                    <hr class="row brc-default-l1 mx-n1 mb-4" />
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="my-2">
                                                <span class="text-sm text-grey-m2 align-middle">To : </span>
                                                <span class="text-600 text-110 text-blue align-middle">{{$orderDetails->receiver_name}}</span>
                                            </div>
                                            <div class="text-grey-m2" style="max-width: 15rem">
                                                {{$orderDetails->shipping_address}}
                                                <div class="my-2">
                                                    <b class="text-600">Phone :
                                                    </b>{{$orderDetails->contact_no}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                            <hr class="d-sm-none" />
                                            <div class="text-grey-m2">
                                                <div class="my-2"><span class="text-600 text-90">Invoice
                                                        No :
                                                    </span>{{str_replace('OD',$orderDetails->id,$orderDetails->order_id)}}</div>
                                                <div class="my-2"><span class="text-600 text-90">Order ID :
                                                    </span>
                                                    {{$orderDetails->order_id}}
                                                </div>
                                                <div class="my-2"><span class="text-600 text-90">Order
                                                        Date :
                                                    </span> {{ date("d M Y h:i A", strtotime($orderDetails->created_at)) }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4">

                                        <div class="text-95 text-secondary-d3">
                                            <div class="ec-vendor-card-table">
                                                <table class="table ec-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">ID</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col" style="width:44px">
                                                                Qty</th>
                                                            <th scope="col" style="text-align: end">Price</th>
                                                            <th scope="col" style="text-align: end">GST</th>
                                                            <th scope="col" style="text-align: end">Tax Amount</th>
                                                            <th scope="col" style="text-align: end">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if ($orderItems->count() > 0)
                                                        @foreach ($orderItems as $key=>$orderItem)
                                                        <tr>
                                                            <th><span>{{$key+1}}</span></th>
                                                            <td><span style="padding: 0 0 !important;padding-top: 0.23rem !important;">
                                                                    <span style="padding: 0 0 !important;">{{$orderItem->pname}}</span>
                                                                    <span class="fw-light text-secondary" style="font-size:0.7rem;padding: 0 0 !important;">{{$orderItem->item_name}}</span>
                                                                    @if ($orderItem->size_name != 'none' || $orderItem->color_name != 'none')
                                                                    <span class="fw-light mt-1" style="font-size:0.7rem;padding: 0 0   !important;">
                                                                        @if ($orderItem->size_name != 'none')
                                                                        <span class="text-secondary mr-1">Size: <span class="text-dark">{{$orderItem->size_name}}</span></span>
                                                                        @endif
                                                                        @if ($orderItem->color_name != 'none')
                                                                        <span class="text-secondary">Color: <span class="text-dark">{{$orderItem->color_name}}</span></span>
                                                                        @endif
                                                                    </span>
                                                                    @endif
                                                                </span></td>
                                                            <td style="text-align: center"><span>{{$orderItem->qty}}</span></td>
                                                            <td style="text-align: end"><span>₹{{number_format($orderItem->price / $orderItem->qty,2)}}</span></td>
                                                            <td style="text-align: end"><span>{{number_format(($orderItem->tax_amt / $orderItem->qty)/($orderItem->price / $orderItem->qty)*100,2)}}%</span></td>
                                                            <td style="text-align: end"><span>₹{{number_format($orderItem->tax_amt / $orderItem->qty,2)}}</span></td>
                                                            <td style="text-align: end"><span>₹{{ number_format(($orderItem->price + $orderItem->tax_amt)) }}</span></td>
                                                        </tr>
                                                        @endforeach
                                                        @endif

                                                    </tbody>
                                                    <tfoot>
                                                        <tr></tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <div class="fw-bold mr-2">Payment Mode:

                                            </div>
                                            <span class="fo">{{$orderDetails->payment_method}}</span>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex ml-auto justify-content-between mb-2 mr-2" style="max-width:20rem;">
                                                <div>
                                                    <div class="fw-bold mb-2">Sub Total</div>
                                                    <div class="fw-bold mb-2">Delivery Charges</div>
                                                    <div class="fw-bold mb-2">Total</div>
                                                </div>
                                                <div>
                                                    <div class="mb-2">₹{{number_format($orderDetails->total_price,2)}}</div>
                                                    <div class="mb-2">₹{{number_format($orderDetails->shipping_charges,2)}}</div>
                                                    <div class="mb-2">₹{{number_format($orderDetails->grand_total,2)}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($orderDetails->payment_method == 'COD' && ($orderDetails->status == 'PLACED' || $orderDetails->status == 'DISPATCHED'))
                                    <div class="mb-3">
                                        @if (!empty($orderDetails->paid_amt))
                                        <p class="mb-0">You paid ₹{{number_format($orderDetails->paid_amt,2)}} as token amount.</p>
                                        @endif
                                        <h6 class="fw-bold mt-1 pt-1">Amount to be Paid: ₹{{number_format($orderDetails->collectable_amount,2)}}</h6>
                                    </div>
                                    @endif
                                    <div class="mb-3">
                                        <div>
                                            @if($orderDetails->status == 'PLACED')
                                            <a class="btn btn-lg btn-danger mr-2" href="javascript:void{}" onclick="cancelOrder(this,'{{$orderDetails->order_id}}')">Cancel Order</a>
                                            @endif

                                            <button class="btn border" style="border-color: #427c80 !important;" type="button" data-bs-toggle="collapse" data-bs-target="#need-help" aria-expanded="false" aria-controls="collapseExample">
                                                Need Help
                                            </button>
                                        </div>
                                        <div class="collapse" id="need-help">
                                            <div class="mt-3 mb-2">Need help in your order?</div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="border p-3 w-100">
                                                        <a class="d-block" href="mailto:support@easy-buy.in"> <span class="me-1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                </svg></span> Mail Support</a>
                                                    </div>

                                                </div>
                                                <div class="col-md-6">
                                                    <div class="border p-3 w-100">
                                                        <a class="d-block" target="_blank" href="https://api.whatsapp.com/send?phone=918447226676&text= Your Following Order Datails:%0a %0a Order id = {{$orderItem->order_id}}"> <span class="me-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                                                </svg></span> Whatsapp Support</a>
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
    </div>
</section>

<div class="ec-vendor-card-body padding-b-0 px-3 px-sm-5 mt-8 printOrder" style="position:fixed">
    <div class="page-content">
        <div class="page-header text-blue-d2 text-center">
            <img loading="lazy" src="assets/images/logo/logo.png" style="max-width: 10rem;" alt="easybuy">
        </div>

        <div class="container px-0">
            <div class="row mt-4">
                <hr class="row brc-default-l1 mx-n1 mb-4" />
                <div>
                    <table class="w-100">
                        <tbody>
                            <td>
                                <div class="my-2">
                                    <span class="text-sm text-grey-m2 align-middle">To : </span>
                                    <span class="text-600 text-110 text-blue align-middle fw-bold">{{$orderDetails->receiver_name}}</span>
                                </div>
                                <div class="text-grey" style="max-width:16rem">
                                    {{$orderDetails->shipping_address}}
                                    <div class="my-2">
                                        <b class="text-600">Phone :
                                        </b>{{$orderDetails->contact_no}}
                                    </div>
                            </td>
                            <td class="d-flex justify-content-end">
                                <div class="text-grey-m2">
                                    <div class="my-2"><span class="text-600 text-90 fw-bold">Invoice No :
                                        </span>
                                        {{str_replace('OD',$orderDetails->id,$orderDetails->order_id)}}
                                    </div>
                                    <div class="my-2"><span class="text-600 text-90 fw-bold">Order ID
                                            :
                                        </span> {{$orderDetails->order_id}}</div>
                                    <div class="my-2"><span class="text-600 text-90 fw-bold">Order
                                            Date :
                                        </span>{{ date("d M Y h:i A", strtotime($orderDetails->created_at)) }}</div>
                                </div>
                            </td>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    <div class="text-95 text-secondary-d3">
                        <div class="ec-vendor-card-table">
                            <table class="table ec-table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" style="width:44px">
                                            Qty</th>
                                        <th scope="col" style="text-align: end">Price</th>
                                        <th scope="col" style="text-align: end">GST</th>
                                        <th scope="col" style="text-align: end">Tax Amount</th>
                                        <th scope="col" style="text-align: end">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($orderItems->count() > 0)
                                    @foreach ($orderItems as $key=>$orderItem)
                                    <tr>
                                        <th><span>{{$key+1}}</span></th>
                                        <td><span style="padding: 0 0 !important;padding-top: 0.23rem !important;">
                                                <span class="d-flex flex-column" style="padding: 0 0 !important;width:100% !important">{{$orderItem->pname}}</span>
                                                <span class="fw-light text-secondary" style="font-size:0.7rem;padding: 0 0 !important;width:100% !important;">{{$orderItem->item_name}}</span>
                                                @if ($orderItem->size_name != 'none' || $orderItem->color_name != 'none')
                                                <span class="fw-light mt-1" style="font-size:0.7rem;padding: 0 0   !important;">
                                                    @if ($orderItem->size_name != 'none')
                                                    <span class="text-secondary mr-1">Size: <span class="text-dark">{{$orderItem->size_name}}</span></span>
                                                    @endif
                                                    @if ($orderItem->color_name != 'none')
                                                    <span class="text-secondary">Color: <span class="text-dark">{{$orderItem->color_name}}</span></span>
                                                    @endif
                                                </span>
                                                @endif
                                            </span></td>
                                        <td style="text-align: center"><span>{{$orderItem->qty}}</span></td>
                                        <td style="text-align: end"><span>₹{{number_format($orderItem->price / $orderItem->qty,2)}}</span></td>
                                        <td style="text-align: end"><span>{{number_format(($orderItem->tax_amt / $orderItem->qty)/($orderItem->price / $orderItem->qty)*100,2)}}%</span></td>
                                        <td style="text-align: end"><span>₹{{number_format($orderItem->tax_amt / $orderItem->qty,2)}}</span></td>
                                        <td style="text-align: end"><span>₹{{ number_format(($orderItem->price + $orderItem->tax_amt)) }}</span></td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                                <tfoot>
                                    <tr></tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div>
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td class="d-flex flex-column align-items-start">
                                    <div class="fw-bold mr-2">Payment Mode:
                                    </div>
                                    <span class="fo">{{$orderDetails->payment_method}}</span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between mb-2 mr-2 ml-auto" style="width:100%;max-width:20rem;">
                                        <div>
                                            <div class="fw-bold mb-2">Sub Total</div>
                                            <div class="fw-bold mb-2">Delivery Charge</div>
                                            <div class="fw-bold mb-2">Total</div>
                                        </div>
                                        <div>
                                            <div class="mb-2">₹{{number_format($orderDetails->total_price,2)}}</div>
                                            <div class="mb-2">₹{{number_format($orderDetails->shipping_charges,2)}}</div>
                                            <div class="mb-2">₹{{number_format($orderDetails->grand_total,2)}}</div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function cancelOrder(el, orderId) {
        const formData = new FormData();
        formData.append("_token", "{{csrf_token()}}");
        formData.append("order_id", orderId);
        Swal.fire({
            title: 'Warning',
            text: 'Do you want to cancel your order?',
            icon: 'warning',
            confirmButtonColor: '#427c80',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText:'No'
        }).then((result) => {
            if (result.isConfirmed) {
                $(el).css('opacity', '0.5');
                $.ajax({
                    type: 'post',
                    url: '{{Url("/cancel-order")}}',
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
                        $(el).css('opacity', '1')
                        setTimeout(() => {
                            window.location.reload()
                        }, 2000);
                    },
                    error: function(error) {
                        // console.log(error)
                        Toastify({
                            text: error.responseJSON?.message || 'Something went worng',
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
                })
            } else if (result.isDenied) {

            }
        })
    }
</script>
<!-- End User invoice section -->
@endsection