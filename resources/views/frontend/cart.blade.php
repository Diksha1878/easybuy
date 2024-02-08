@extends('layouts.frontend')
@section('meta')
    <title>Cart | Easybuy Online Shopping Site In India</title>
    <meta name="robots" content="noindex">
@endsection

@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
                <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Cart</li>
            </ul>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- Ec cart page -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row cart-container">
                <div class="ec-cart-leftside col-lg-8 col-md-12 ">
                    <!-- cart content Start -->
                    <div class="ec-cart-content">
                        <div class="ec-cart-inner">
                            <div class="row">
                                <div class="table-content cart-table-content">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th style="text-align: center;">Quantity</th>
                                                <th>Total</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (CartUtil::getCartList()->count() > 0)
                                            @foreach (CartUtil::getCartList() as $cartItem)
                                            <tr>
                                                <td data-label="Product" class="ec-cart-pro-name"><a
                                                        href="{{ Url('product/' . $cartItem->item_id . '/' . Common::getSlugName($cartItem->caption_name)) }}"><img loading="lazy" class="ec-cart-pro-img mr-4"
                                                        onerror="this.src = './default/no-image.png'"
                                                        src="{{ env('IMG_URL') }}product_images/{{ $cartItem->product_image }}" alt="{{$cartItem->caption_name}}" />
                                                        <div class="d-flex flex-column">
                                                            <span>{{$cartItem->name}}</span>
                                                            <span class="fw-light text-secondary" style="font-size:0.7rem">{{$cartItem->item_name}}</span>
                                                            <span class="fw-light mt-1" style="font-size:0.7rem">
                                                               @if ($cartItem->size_name != 'none')
                                                               <span class="text-secondary mr-1">Size: <span class="text-dark">{{$cartItem->size_name}}</span></span>
                                                               @endif
                                                               @if ($cartItem->color_name != 'none')
                                                               <span  class="text-secondary">Color: <span class="text-dark">{{$cartItem->color_name}}</span></span>
                                                               @endif
                                                            </span>
                                                            <span style="font-size: 0.7rem;color: #616365fa;">₹{{$cartItem->shipping_charge}} delivery charge</span>
                                                        </div>
                                                        </a>
                                                       </td>
                                                <td data-label="Price" class="ec-cart-pro-price"><span
                                                        class="amount">₹{{ number_format((float)$cartItem->price,2) }}</span></td>
                                                <td data-label="Quantity" class="ec-cart-pro-qty"
                                                    style="text-align: center;">
                                                    {{-- <div class="cart-qty-plus-minus">
                                                        <input class="cart-plus-minus" type="text" name="cartqtybutton"
                                                            value="1" />
                                                    </div> --}}
                                                    <div class="d-flex justify-content-between p-2 mx-0 mx-md-5 border">
                                                        <span class="pr-2 pl-1 border-right"  style="cursor: pointer" onclick="cartProductQty($(this).parent().find('.p-qty'),'sub',event,'{{$cartItem->item_id}}','{{$cartItem->pid}}')">-</span>
                                                        <div class="fw-bold px-3 px-md-2 p-qty" style="min-width: 3rem;">{{$cartItem->qty}}</div>
                                                        <span  class="pr-1 pl-2 border-left" style="cursor: pointer" onclick="cartProductQty($(this).parent().find('.p-qty'),'add',event,'{{$cartItem->item_id}}','{{$cartItem->pid}}')">+</span>
                                                    </div>
                                                </td>
                                                <td data-label="Total" class="ec-cart-pro-subtotal product-total-price">₹{{ number_format((float)$cartItem->price * (int)$cartItem->qty,2)}}</td>
                                                <td data-label="Remove" class="ec-cart-pro-remove">
                                                    <a href="javascript:void(0)" onclick="deleteCartItem(event,'{{$cartItem->item_id}}')" ><i class="ecicon eci-trash-o text-danger"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                           
                                            @else
                                                <tr>
                                                    <td colspan="4" class="text-center">There is no product addded on cart.</td>
                                                </tr>
                                            @endif
                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--cart content End -->
                </div>
                <!-- Sidebar Area Start -->
                <div class="ec-cart-rightside col-lg-4 col-md-12">
                    <div class="ec-sidebar-wrap">
                        <!-- Sidebar Summary Block -->
                        <div class="ec-sidebar-block">
                            <div class="ec-sb-title">
                                <h3 class="ec-sidebar-title">Summary</h3>
                            </div>
                            @if (CartUtil::getCartList()->count() > 0)
                            <div class="border-bottom mb-3 mt-3 mt-md-0">
                                @foreach (CartUtil::getCartList() as $item)
                                <div class="d-flex justify-content-between mb-2 summary-product-{{$item->item_id}}">
                                    <span>
                                        <span class="d-flex flex-column">
                                            <span>{{$item->name}}</span>
                                            <span class="fw-light text-secondary" style="font-size:0.7rem">{{$item->item_name}}</span>
                                            <span class="fw-light mt-1" style="font-size:0.7rem">
                                               @if ($item->size_name != 'none')
                                               <span class="text-secondary mr-1">Size: <span class="text-dark">{{$item->size_name}}</span></span>
                                               @endif
                                               @if ($item->color_name != 'none')
                                               <span  class="text-secondary">Color: <span class="text-dark">{{$item->color_name}}</span></span>
                                               @endif
                                            </span>
                                        </span>
                                       
                                    </span>
                                    <span class="ml-3" style="font-weight: 500;white-space: nowrap;">
                                        <span class="summary-qty">{{$item->qty}}</span> x {{number_format($item->price,2)}}
                                    </span>
                                </div>
                                @endforeach
                            </div>
                            @endif
                            <div class="ec-sb-block-content mb-2 mb-md-4">
                                <div class="ec-cart-summary-bottom">
                                    <div class="ec-cart-summary">
                                        @php
                                            $subTotal = 0;
                                            $totalDelivaryCharge = 0;
                                            if (CartUtil::getCartList()->count() > 0) {
                                                foreach(CartUtil::getCartList() as $row){
                                                    $productTotal = (float)$row->price * (int)$row->qty;
                                                    $subTotal += $productTotal;
                                                    $totalDelivaryCharge += (float)$row->shipping_charge;   
                                                }
                                            }
                                        @endphp
                                        <div>
                                            <span class="text-left">Sub-Total</span>
                                            <span class="text-right subTotal">₹{{number_format($subTotal,2)}}</span>
                                        </div>
                                        <div>
                                            <span class="text-left">Delivery Charges</span>
                                            <span class="text-right deliveryCharge">₹{{number_format($totalDelivaryCharge,2)}}</span>
                                        </div>
                                        <div class="ec-cart-summary-total mb-1">
                                            <span class="text-left">Total Amount</span>
                                            <span class="text-right totalAmount">₹{{number_format($subTotal + $totalDelivaryCharge,2)}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ec-cart-update-bottom">
                                <a href="{{ route('frontend.checkout') }}"
                                    class="btn btn-primary text-white text-decoration-none">Check
                                    Out</a>
                            </div>
                        </div>
                        <!-- Sidebar Summary Block -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function cartProductQty(target, type, event, pItemId,pId){
            // $(target).html()
            if(type === 'add'){
                $(target).html( parseInt($(target).html())+ 1);
            }
            if(type === 'sub'){
                if($(target).html() > 1){
                    $(target).html( parseInt($(target).html())- 1);
                }
            }
            addToCart(pId,pItemId,$(target).html(),event, addtocartHandler1);
        }

        function deleteCartItem(event, pItemId){
            $(event.target).css('opacity', '0.5');
            const formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('item_id', pItemId);
            $.ajax({
                type: 'post',
                url: "{{ route('frontend.delete-cart-item') }}",
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(response) {
                    $(event.target).css('opacity', '1');
                    Toastify({
                        text: response.message,
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
                $(event.target).parents('tr').fadeOut();
                $(event.target).parents('.cart-container').find(`.summary-product-${pItemId}`).remove();
                $(event.target).parents('.cart-container').find(`.deliveryCharge`).html(`₹${response.totalDelivaryCharge.toLocaleString('hi-IN', {minimumFractionDigits: 2})}`);
                $(event.target).parents('.cart-container').find(`.subTotal`).html(`₹${response.subTotal.toLocaleString('hi-IN', {minimumFractionDigits: 2})}`);
                $(event.target).parents('.cart-container').find(`.totalAmount`).html(`₹${(response.subTotal+response.totalDelivaryCharge).toLocaleString('hi-IN', {minimumFractionDigits: 2})}`);
                $('.cart-count').text(response.count || 0);
                },
                error: function(error) {
                    $(event.target).css('opacity', '1');
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
            })   
        }
    </script>
    <!-- New Product end -->
@endsection
