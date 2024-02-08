@extends('layouts.frontend')
@section('meta')
    <title>Checkout | Easybuy Online Shopping Site In India</title>
    <meta name="robots" content="noindex">
@endsection
@section('content')

<!-- Ec breadcrumb start -->
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
            <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
            <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">Checkout</li>
        </ul>
    </div>
</div>
<!-- Ec breadcrumb end -->

<!-- Ec checkout page -->
<section class="ec-page-content section-space-p">
    <div class="container">
        <div class="row">
            <div class="ec-checkout-leftside col-lg-8 col-md-12">
                <!-- checkout content Start -->
                <div class="ec-checkout-wrap">
                    <div class="ec-checkout-rightside col-lg-12 col-md-12">
                        <div class="ec-sidebar-wrap ec-checkout-del-wrap mb-4 mt-2 pb-0">
                            <!-- Sidebar Summary Block -->
                            <div class="ec-sidebar-block">
                                <div class="ec-sb-title mb-3 position-relative">
                                    <h3 class="ec-sidebar-title">Select Address</h3>
                                    <a class="btn btn-primary position-absolute mr-6 mr-lg-0" style="line-height: unset;font-size: 12px;padding: 3px 12px;height: fit-content;top: -3px;right: 0;" href="#" data-bs-toggle="modal" data-bs-target="#addAddress">Add New</a>
                                </div>
                                <div class="ec-sb-block-content mb-0 border-bottom-0 pb-0">
                                    <div class="row addressContainer">
                                        @if (Common::getAddressbyUser()->count() > 0)
                                        @foreach (Common::getAddressbyUser() as $key=>$address)
                                        <div class="col-md-6 mb-4 addressContent">
                                            <div onclick="selectAddressHandler(this,'{{ $address->id }}')" class="border {{ $address_id == $address->id ? 'border-secondary' : '' }} p-3 p-sm-4 h-100 d-flex flex-column justify-content-between address-content">
                                                <div class="mb-3">
                                                    <a class="btn border {{ $address_id == $address->id ? 'bg-success text-white' : 'border-success text-success' }} mb-2 float-right Isaddress" style="line-height: unset;font-size: 9px;padding: 2px 6px;height: fit-content;" href="javascript:void(0)"> {{ $address_id == $address->id ?
                                                        'Selected': 'Select'}} </a>
                                                    <div class="fw-bold address1">{{ $address->address1 }}</div>
                                                    <div class="addressRemaining">{{ $address->address2}} {{ $address->town_city}} {{ Common::getStates()[(int)$address->state - 1]['name']}} - {{ $address->pincode }},</div>
                                                    <div class="landmark">{{ $address->landmark }}</div>
                                                    <div class="mt-1 fw-bold">Mobile: <span class="fw-normal mobileNumber">{{
                                                            $address->mobile }}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-3">
                                                    <button class="btn border" style="line-height: unset;font-size: 12px;padding: 8px 12px;height: fit-content;" type="button" data-bs-toggle="modal" data-bs-target="#updateAddress{{ $key }}">
                                                        Edit
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="updateAddress{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content p-3" style="overflow-y: auto;">
                                                        <div>
                                                            <h6 class="fw-bold">
                                                                Edit Address <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </h6>
                                                        </div>
                                                        <form onSubmit="addressHandler(event, this,'update')" action="" method="post" class=" my-4 mb-0 add-address" novalidate>
                                                            @csrf
                                                            <input type="hidden" name="address_id" value="{{ $address->id }}">
                                                            <input type="hidden" name="country" value="india">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Flat/House No/Building
                                                                    No</label>
                                                                <input type="text" class="form-control" name="address1" value="{{ $address->address1 }}" required>
                                                                <div class="text-danger form-error err-address1"></div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Road name/Area/Colony</label>
                                                                <input type="text" class="form-control" name="address2" value="{{ $address->address2 }}" required>
                                                                <div class="text-danger form-error err-address2"></div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Town/City</label>
                                                                <input type="text" class="form-control" name="town_city" value="{{ $address->town_city }}" required>
                                                                <div class="text-danger form-error err-town_city"></div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Pincode</label>
                                                                <input type="tel" class="form-control" name="pincode" value="{{ $address->pincode }}" required>
                                                                <div class="text-danger form-error err-pincode"></div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">State</label>
                                                                <select class="form-select border" name="state" required>
                                                                    @foreach (Common::getStates() as $key=>$state)
                                                                    @if ($state['id'] == $address->state)
                                                                    <option selected value="{{$state['id']}}">{{$state['name']}}</option>
                                                                    @else
                                                                        <option value="{{$state['id']}}">{{$state['name']}}</option>
                                                                    @endif
                                                                    @endforeach
                                                                </select>
                                                                <div class="text-danger form-error err-state"></div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Address type</label>
                                                                <select class="form-select border" name="address_type" required>
                                                                    <option value="">Select Address Type</option>
                                                                    <option {{ $address->address_type = 'home' ?
                                                                        'selected' : '' }} value="home">Home</option>
                                                                    <option {{ $address->address_type = 'office' ?
                                                                        'selected' : '' }} value="office">Office
                                                                    </option>
                                                                </select>
                                                                <div class="text-danger form-error err-address_type">
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Landmark</label>
                                                                <input type="text" class="form-control" name="landmark" value="{{ $address->landmark }}">
                                                                <div class="text-danger form-error err-landmark"></div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">Mobile Number</label>
                                                                <input type="tel" class="form-control" name="mobile" value="{{ $address->mobile }}" required>
                                                                <div class="text-danger form-error err-mobile"></div>
                                                            </div>
                                                            <div class="ec-header-btn">
                                                                <div class="text-success form-success-msg"></div>
                                                                <div class="text-danger form-error-msg"></div>
                                                                <button class="btn btn-primary">Update Address</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <p>There is no address added.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Sidebar Summary Block -->
                        </div>
                    </div>
                </div>
                <!--cart content End -->
            </div>
            <!-- Sidebar Area Start -->
            <div class="ec-checkout-rightside col-lg-4 col-md-12 mt-2">
                <div class="ec-sidebar-wrap">
                    <!-- Sidebar Summary Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title">
                            <h3 class="ec-sidebar-title">Products Summary</h3>
                        </div>
                        <div class="ec-sb-block-content">
                            <div class="ec-checkout-summary">
                                @if (CartUtil::getCartList()->count() > 0)
                                <div class="d-flex flex-column align-items-stretch">
                                    @foreach (CartUtil::getCartList() as $item)
                                    <div class="d-flex justify-content-between mb-2 summary-product-{{$item->item_id}}">
                                        <a href="{{ Url('product/' . $item->item_id . '/' . Common::getSlugName($item->caption_name)) }}">
                                            <span class="d-flex flex-column">
                                                <span>{{$item->name}}</span>
                                                <span class="fw-light text-secondary" style="font-size:0.7rem">{{$item->item_name}}</span>
                                                <span class="fw-light mt-1" style="font-size:0.7rem">
                                                    @if ($item->size_name != 'none')
                                                    <span class="text-secondary mr-1">Size: <span class="text-dark">{{$item->size_name}}</span></span>
                                                    @endif
                                                    @if ($item->color_name != 'none')
                                                    <span class="text-secondary">Color: <span class="text-dark">{{$item->color_name}}</span></span>
                                                    @endif
                                                </span>
                                            </span>
                                        </a>
                                        <span class="ml-3" style="font-weight: 500;white-space: nowrap;">
                                            <span class="summary-qty">{{$item->qty}}</span> x
                                            {{number_format($item->price,2)}}
                                        </span>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Summary Block -->
                    <div class="">
                        @php
                        $subTotal = 0;
                        $totalDelivaryCharge = 0;
                        $tokenAmount = 0;
                        if (CartUtil::getCartList()->count() > 0) {
                        foreach(CartUtil::getCartList() as $row){
                        $productTotal = (float)$row->price * (int)$row->qty;
                        $subTotal += $productTotal;
                        $tokenAmount += $row->token_amt_rate*(int)$row->qty;
                        $totalDelivaryCharge += (float)$row->shipping_charge;
                        }
                        }
                        @endphp
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-left text-dark">Sub-Total</span>
                            <span class="text-right subTotal" style="font-weight: 500">₹{{number_format($subTotal,2)}}</span>
                        </div>
                        <div class="d-flex justify-content-between py-1">
                            <span class="text-left text-dark">Delivery Charges</span>
                            <span class="text-right deliveryCharge" style="font-weight: 500">₹{{number_format($totalDelivaryCharge,2)}}</span>
                        </div>
                        {{-- <div class="d-flex justify-content-between py-1 pb-3 mb-2 border-bottom">
                            <span class="text-left text-dark">Tax Charges</span>
                            <span class="text-right taxAmount" style="font-weight: 500">₹0</span>
                        </div> --}}
                        <div class="ec-cart-summary-total d-flex justify-content-between">
                            <span class="text-left text-dark" style="font-weight: 500;font-size: 16px;">Total
                                Amount</span>
                            <span class="text-right totalAmount text-dark" style="font-weight: 500;font-size: 16px;">₹{{number_format($subTotal +
                                $totalDelivaryCharge,2)}}</span>
                        </div>
                    </div>
                </div>
                <div class="ec-sidebar-wrap ec-checkout-pay-wrap mb-2 pb-0 mt-3">
                    <!-- Sidebar Payment Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-sb-title mb-3">
                            <h3 class="ec-sidebar-title">Payment Method</h3>
                        </div>
                        <div class="ec-sb-block-content border-bottom-0">
                            <div class="ec-checkout-pay">
                                {{-- <div class="ec-pay-desc text-info"></div> --}}
                                
                                      <div class="alert alert-warning" role="alert" style="    color: #664d03;background-color: #fff3cd;border-color: #ffecb5;">
                                        Please select the preferred payment method to use on this order.
                                      </div>
                                <div class="ec-pay-option">
                                    {{-- <div class="ec-pay-agree">
                                        <input type="radio" value="" id="cashOnDelivery">
                                        <label class="mb-0 p-0 ml-5" for="cashOnDelivery">Cash on
                                            delivery</label>
                                        <div class="checked border-secondary" style="margin-top: 0.23rem"></div>
                                    </div> --}}
                                    @if(($subTotal + $totalDelivaryCharge) > 100000 || ($subTotal + $totalDelivaryCharge) < 1000)
                                    <div class="border p-3 mb-3">
                                        <svg width="28" height="28" fill="#ccc" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 105.94">
                                            <defs>
                                                <style>
                                                    .cls-1 {
                                                        fill-rule: evenodd;
                                                    }
                                                </style>
                                            </defs>
                                            <path class="cls-1" d="M0,76.68H58.63v5.25H0V76.68ZM98.51,7H91.6c-.3,0-.45.26-.53.55l-1,3.7c-.08.29.24.55.53.55h5.2A13.78,13.78,0,0,0,95.11,16,12.93,12.93,0,1,0,121,16,13.15,13.15,0,0,0,108,2.67,12.69,12.69,0,0,0,98.51,7Zm21.38,65.21,3,26.72c-.08,8.47-11.48,9.29-12.72,2.31L108,75.38,105,99.76c-2.69,9.47-13.78,5.93-12.72-1.28l1.9-11L95.8,69c-2.68-7.19-.33-12-.49-20.42C90.5,53.45,86.77,57,79.46,57.23c-2.31-.09-6-.26-8.31-.52-2.82-.32-4.8-.2-6.57-2.75-2.78-4,.89-8.65,4.47-7.9,4,.36,11.36,1.27,14.11-2.12,2.86-2.73,5.07-6.55,8.8-7.76,21-6.82,26.21-4.15,28,3.36.52,2.12,1.18,18.57,1,22.8s-.36,8-1,9.87ZM63.21,26.77V43.31a9.23,9.23,0,0,0-1.9,2,8.83,8.83,0,0,0-1.17,2.55l-5.49-3.28.16-23.15,8.4,5.3Zm3.52-7.52L75.07,24,64.22,25.37l-7.6-4.79,10.11-1.33Zm-1.79,23V27l11.31-1.44.37,10.8,4-2.7,4,2.24-.82-11.3,6.78-.77V32c-2.64,1.3-4.5,3.49-6.36,5.68a33.32,33.32,0,0,1-2.39,2.64l-.28.3C79.8,42.68,73.8,42.13,70,41.78c-1.54-.14,2,.16-.79-.08a7.43,7.43,0,0,0-4.28.57ZM82.68,23l-8.09-4.79L78,17.87l10.29,4.52L82.68,23ZM51.58,74.32V0H7.05V74.32ZM14.87,36l4.72-2.11V48.61l-4.72-1.32V36Z" />
                                        </svg>
                                        <span class="ml-2 fs-6" style="font-weight: 500; color: #ccc">Cash on delivery</span>
                                            <hr class="border-top"/>
                                            <p style="color:#ccc">COD option disabled due to price limit restriction</p>
                                            
                                    </div>
                                    <script>
                                        window.addEventListener('DOMContentLoaded', (event) => {
                                            $('.online-payment-mode').trigger('click');
                                        });
                                    </script>
                                    @else
                                    <div class="border p-3 pay-method mb-3" style="cursor: pointer" onclick="paymentOptionHandler(this, 'COD')">
                                        <svg style="color: #427c80" fill="currentColor" width="28" height="28" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 105.94">
                                            <defs>
                                                <style>
                                                    .cls-1 {
                                                        fill-rule: evenodd;
                                                    }
                                                </style>
                                            </defs>
                                            <path class="cls-1" d="M0,76.68H58.63v5.25H0V76.68ZM98.51,7H91.6c-.3,0-.45.26-.53.55l-1,3.7c-.08.29.24.55.53.55h5.2A13.78,13.78,0,0,0,95.11,16,12.93,12.93,0,1,0,121,16,13.15,13.15,0,0,0,108,2.67,12.69,12.69,0,0,0,98.51,7Zm21.38,65.21,3,26.72c-.08,8.47-11.48,9.29-12.72,2.31L108,75.38,105,99.76c-2.69,9.47-13.78,5.93-12.72-1.28l1.9-11L95.8,69c-2.68-7.19-.33-12-.49-20.42C90.5,53.45,86.77,57,79.46,57.23c-2.31-.09-6-.26-8.31-.52-2.82-.32-4.8-.2-6.57-2.75-2.78-4,.89-8.65,4.47-7.9,4,.36,11.36,1.27,14.11-2.12,2.86-2.73,5.07-6.55,8.8-7.76,21-6.82,26.21-4.15,28,3.36.52,2.12,1.18,18.57,1,22.8s-.36,8-1,9.87ZM63.21,26.77V43.31a9.23,9.23,0,0,0-1.9,2,8.83,8.83,0,0,0-1.17,2.55l-5.49-3.28.16-23.15,8.4,5.3Zm3.52-7.52L75.07,24,64.22,25.37l-7.6-4.79,10.11-1.33Zm-1.79,23V27l11.31-1.44.37,10.8,4-2.7,4,2.24-.82-11.3,6.78-.77V32c-2.64,1.3-4.5,3.49-6.36,5.68a33.32,33.32,0,0,1-2.39,2.64l-.28.3C79.8,42.68,73.8,42.13,70,41.78c-1.54-.14,2,.16-.79-.08a7.43,7.43,0,0,0-4.28.57ZM82.68,23l-8.09-4.79L78,17.87l10.29,4.52L82.68,23ZM51.58,74.32V0H7.05V74.32ZM14.87,36l4.72-2.11V48.61l-4.72-1.32V36Z" />
                                        </svg>
                                        <span class="ml-2 text-secondary fs-6" style="font-weight: 500">Cash on
                                            delivery</span>
                                            @if(!empty($tokenAmount))
                                            <hr class="border-top"/>
                                            <p>Pay only ₹{{ $tokenAmount }} as advance and balance amount as cash on delivery</p>
                                            @endif
                                    </div>
                                    @endif
                                    <div class="border p-3 pay-method mb-3 online-payment-mode" style="cursor: pointer" onclick="paymentOptionHandler(this, 'ONLINE');">
                                        <svg width="28" height="28" style="color: #427c80" fill="currentColor" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 106.93">
                                            <path d="M65.5,6.11A42.76,42.76,0,0,0,55.54,9a48,48,0,0,0-7.63,4.13,43.79,43.79,0,0,0-6.54,5.39h0a44.71,44.71,0,0,0-3.55,4H50.73A100,100,0,0,1,65.5,6.11ZM5.13,53.25H71a5.14,5.14,0,0,1,5.13,5.13V101.8A5.16,5.16,0,0,1,71,106.93H5.13A5.14,5.14,0,0,1,0,101.8V58.38a5.16,5.16,0,0,1,5.13-5.13Zm8,42a1.52,1.52,0,1,1,0-3H28.65a1.52,1.52,0,0,1,0,3Zm0-7.2a1.52,1.52,0,0,1,0-3H36.16a1.52,1.52,0,1,1,0,3Zm37.23-4.81a6.88,6.88,0,0,1,5.53,2.78,6.89,6.89,0,1,1,0,8.22,6.89,6.89,0,1,1-5.53-11ZM3.54,63.85h69V58.38a1.59,1.59,0,0,0-.47-1.12A1.61,1.61,0,0,0,71,56.79H5.13a1.57,1.57,0,0,0-1.59,1.59v5.47Zm69,13.61h-69V101.8A1.6,1.6,0,0,0,4,102.93a1.57,1.57,0,0,0,1.12.47H71a1.6,1.6,0,0,0,1.12-.48,1.52,1.52,0,0,0,.48-1.12V77.46ZM111.49,72h.11a49.14,49.14,0,0,0,2.29-4.66l.06-.13A42,42,0,0,0,116.48,59a43.46,43.46,0,0,0,.79-6.19H104.89A44.35,44.35,0,0,1,99.19,72Zm-3.57,5.53H95.75A82.09,82.09,0,0,1,85.6,89.31V81.39q1.75-1.94,3.29-3.88H85.6V72h7.21a40.34,40.34,0,0,0,6.56-19.2H85.6V50A6.74,6.74,0,0,0,85,47.25H99.25q-1-9.47-7.17-19.21H75.63v15.1H70.1V28H53.65a46.92,46.92,0,0,0-6.5,15.1H41.52A49.81,49.81,0,0,1,47.23,28H34.14a47.86,47.86,0,0,0-2.3,4.65l-.06.13a42.27,42.27,0,0,0-2.53,8.24c-.14.68-.26,1.38-.36,2.08H23.3c.15-1.07.32-2.12.53-3.16a48.73,48.73,0,0,1,2.87-9.32l.07-.15A52.16,52.16,0,0,1,31.39,22a48.9,48.9,0,0,1,6.08-7.38,48.34,48.34,0,0,1,7.38-6.07,52.2,52.2,0,0,1,8.52-4.63A49.11,49.11,0,0,1,72.87,0a50.92,50.92,0,0,1,10,1,47.56,47.56,0,0,1,9.32,2.87l.15.06a52.62,52.62,0,0,1,8.52,4.63A49.29,49.29,0,0,1,114.34,22,53,53,0,0,1,119,30.51,47.78,47.78,0,0,1,121.9,40a51.87,51.87,0,0,1,0,20.07A47.26,47.26,0,0,1,119,69.36l-.06.15A53,53,0,0,1,114.34,78a48.34,48.34,0,0,1-6.07,7.38,48.9,48.9,0,0,1-7.38,6.08,52.16,52.16,0,0,1-8.52,4.62,47.88,47.88,0,0,1-6.77,2.32V92.7A44.09,44.09,0,0,0,90.19,91a47.13,47.13,0,0,0,7.63-4.13,42.69,42.69,0,0,0,6.54-5.39h0a43.36,43.36,0,0,0,3.55-4Zm-3.14-30.26h12.49a43.27,43.27,0,0,0-.79-6.19,42.73,42.73,0,0,0-2.58-8.37A50.26,50.26,0,0,0,111.6,28H98.5a47.34,47.34,0,0,1,6.28,19.21ZM57.58,22.51H70.1V9.38A102.12,102.12,0,0,0,57.58,22.51Zm18,0H88.15A102.12,102.12,0,0,0,75.63,9.38V22.51Zm19.37,0h12.92a44.71,44.71,0,0,0-3.55-4h0a43.29,43.29,0,0,0-6.54-5.39A47.09,47.09,0,0,0,90.19,9l-.14-.06A42,42,0,0,0,81.82,6.4c-.52-.11-1-.2-1.59-.29A100,100,0,0,1,95,22.51Z" />
                                        </svg>
                                        <span class="ml-2 text-secondary fs-6" style="font-weight: 500">Pay Online</span>
                                    </div>
                                    
                                </div>
                                <div>
                                    <p>By clicking place order. You are accepting <a style="color:#427c80" href="#">terms & condition</a> and <a style="color:#427c80" href="#">privacy policy</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Sidebar Payment Block -->
                </div>
                <div class="ec-check-order-btn mt-4">
                    @if(@$form_errors)
                    <div class="alert" role="alert" style="background:#f8d7da;border-color: #f5c2c7;color: #842029;">
                        <h4 class="alert-heading">Oops!</h4>
                        <p>Select all required options</p>
                        <hr>
                       
                        @foreach($form_errors as $err)
                        <p class="mb-0">
                            {{ $err }}
                        </p>
                        @endforeach
                       
                      </div>
                      @endif
                    <form action="" method="post">
                        @csrf
                    <input id="address_id" type="hidden" name="address_id" value="{{ $address_id }}" /> 
                    <input id="payment_method" type="hidden" name="payment_method" /> 
                    <button id="order-btn" disabled class="btn btn-primary btn-block px-5">Place Order</button>
                    </form>
                    <script>
                        function setPaymentMethod(method){
                            $('#payment_method').val(method);
                        }

                        function setAddress(id){
                            $('#address_id').val(id);
                        }
                        </script>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- add address modal start -->
<div class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <div>
                <h6 class="fw-bold">
                    Add Address <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                </h6>
            </div>
            <form onSubmit="addressHandler(event, this,'add')" action="" method="post" class=" my-4 mb-0 add-address" novalidate>
                @csrf
                <input type="hidden" name="country" value="india">
                <div class="form-group mb-3">
                    <label class="form-label">Flat/House No/Building No</label>
                    <input type="text" class="form-control" name="address1" required>
                    <div class="text-danger form-error err-address1"></div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Road name/Area/Colony</label>
                    <input type="text" class="form-control" name="address2" required>
                    <div class="text-danger form-error err-address2"></div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Town/City</label>
                    <input type="text" class="form-control" name="town_city" required>
                    <div class="text-danger form-error err-town_city"></div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Pincode</label>
                    <input type="tel" class="form-control" name="pincode" required>
                    <div class="text-danger form-error err-pincode"></div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">State</label>
                    <select class="form-select border" name="state" required>
                        <option value="">Select state</option>
                        @foreach (Common::getStates() as $key=>$state)
                            <option value="{{$state['id']}}">{{$state['name']}}</option>
                        @endforeach
                    </select>
                    <div class="text-danger form-error err-state"></div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Address type</label>
                    <select class="form-select border" name="address_type" required>
                        <option value="">Select Address Type</option>
                        <option value="home">Home</option>
                        <option value="office">Office</option>
                    </select>
                    <div class="text-danger form-error err-address_type"></div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Landmark</label>
                    <input type="text" class="form-control" name="landmark">
                    <div class="text-danger form-error err-landmark"></div>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Mobile Number</label>
                    <input type="tel" class="form-control" name="mobile" required>
                    <div class="text-danger form-error err-mobile"></div>
                </div>
                <div class="ec-header-btn">
                    <div class="text-success form-success-msg"></div>
                    <div class="text-danger form-error-msg"></div>
                    <button class="btn btn-primary">Add Address</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- add address modal end -->
<script>
    function selectAddressHandler(el, id) {
        setAddress(id)
        $(el).parent().parent().parent().find('.address-content').each((i, item) => {
            $(item).find('.Isaddress').html('Select');
            $(item).find('.Isaddress').removeClass('bg-success text-white');
            $(item).find('.Isaddress').addClass('border-success text-success');
            $(item).removeClass('border-secondary')
            $(item).removeClass('border-success')
        })
        $(el).find('.Isaddress').html('Selected');
        $(el).find('.Isaddress').addClass('bg-success text-white');
        $(el).addClass('border-secondary');
        // $(el).parent().parent().parent().parent().find('.Isaddress').each((i, item) => {
        //     $(item).html('Select');
        //     $(item).removeClass('bg-success text-white');
        //     $(item).addClass('border-success text-success');
        // })
        // $(el).html('Selected');
        // $(el).addClass('bg-success text-white');
        // $('.addressContent>div').each((i, item) => {
        //     $(item).removeClass('border-secondary')
        // })
        // $(el).parents('.addressContent>div').addClass('border-secondary');
        // const formData = new FormData();
        // formData.append('_token',"{{ csrf_token() }}");
        // formData.append('id',id);
        // $.ajax({
        //     type: 'post',
        //     url: "{{ route('frontend.user.set-default-address') }}",
        //     data: formData,
        //     contentType: false,
        //     cache: false,
        //     processData:false,
        //     success: function(response){
        //         $(el).parent().parent().parent().parent().find('.Isaddress').each((i,item)=>{
        //             $(item).html('Make Default');
        //             $(item).removeClass('bg-success text-white');
        //             $(item).addClass('border-success text-success');
        //         })
        //         $(el).html('Set as default');
        //         $(el).addClass('bg-success text-white');
        //         Toastify({
        //         text: response.message,
        //         duration: 3000,
        //         // destination: "https://github.com/apvarun/toastify-js",
        //         // newWindow: true,
        //         close: true,
        //         gravity: "top", // `top` or `bottom`
        //         position: "center", // `left`, `center` or `right`
        //         stopOnFocus: true, // Prevents dismissing of toast on hover
        //         style: {
        //             background: "linear-gradient(to right, #00b09b, #96c93d)",
        //         },
        //         onClick: function(){} // Callback after click
        //         }).showToast();
        //         // setTimeout(() => {
        //         //     window.location.reload();
        //         // }, 2000);
        //     },
        //     error: function(error){
        //         Toastify({
        //         text: 'Something went wrong',
        //         duration: 3000,
        //         close: true,
        //         gravity: "top", // `top` or `bottom`
        //         position: "center", // `left`, `center` or `right`
        //         stopOnFocus: true, // Prevents dismissing of toast on hover
        //         style: {
        //             background: "linear-gradient(to right, rgb(255, 95, 109), rgb(255, 195, 113))",
        //         },
        //         onClick: function(){} // Callback after click
        //         }).showToast();
        //     }
        // })
    }

    function addressHandler(e, el, action) {
        e.preventDefault()
        const formData = new FormData(el)
        $('.form-error').text('');
        $('.form-success-msg').text('');
        $('.form-error-msg').text('');
        $.ajax({
            type: 'post',
            url: "{{ route('frontend.user.add-address') }}",
            contentType: false,
            cache: false,
            processData: false,
            data: formData,
            success: function(response) {
                console.log(response)
                // $('.form-success-msg').text(response.message);
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
                if (action === 'add') {
                    $(el).trigger("reset");
                    $(el).parents('.modal').modal('hide');
                    renderAddressContainer($('.addressContainer'), response.form_data, response.states);
                }
                if (action === 'update') {
                    const data = response.form_data;
                    $(el).parents('.modal').modal('hide');
                    $(el).parents('.addressContent').find('.address1').html(`${data.address1}`);
                    $(el).parents('.addressContent').find('.addressRemaining').html(`${data.address2} ${data.town_city} ${data.stateName} - ${data.pincode}`);
                    $(el).parents('.addressContent').find('.landmark').html(`${data.landmark}`);
                    $(el).parents('.addressContent').find('.mobileNumber').html(`${data.mobile}`);
                }
            },
            error: function(error) {
                const errors = error.responseJSON.form_errors
                if (errors) {
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            var val = errors[key];
                            $('.add-address').find(`.err-${key}`).text(val)
                        }
                    }
                } else {
                    $('.form-error-msg').text('Something went wrong');
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
        })
    }
    let addressCount = 1;

    function renderAddressContainer(target, data, states) {
        let statesString = ``;
        states.map((state,i)=>{
            statesString += ` <option  ${state.id == data.state ? 'selected' : '' } value="${state.id}">${state.name}</option>`
        })
        $(target).append(`
        <div class="col-md-6 mb-4 addressContent">
            <div onclick="selectAddressHandler(this,'${data.id}')" class="border p-3 p-sm-4 h-100 d-flex flex-column justify-content-between address-content">
                <div class="mb-3">
                    <a class="btn border ${data.is_default == '1' ? 'bg-success text-white' : 'border-success text-success'} mb-2 float-right Isaddress"
                style="line-height: unset;font-size: 9px;padding: 2px 6px;height: fit-content;"
                href="javascript:void{0}">${ data.is_default == '1' ? 'Selected': 'Select'} </a>  
                    <div class="fw-bold address1">${ data.address1 }</div>
                    <div class="addressRemaining">${ data.address2} ${ data.town_city} ${ data.stateName} - ${ data.pincode }</div>
                    <div class="landmark">${data.landmark}</div>
                    <div class="mt-1 fw-bold">Mobile: <span
                            class="fw-normal mobileNumber">${ data.mobile }</span>
                    </div>
                </div>
                <div class="d-flex gap-3">
                    <button class="btn border"
                        style="line-height: unset;font-size: 12px;padding: 8px 12px;height: fit-content;"
                        type="button" data-bs-toggle="modal"
                        data-bs-target="#updateAddressjs${addressCount}">
                        Edit
                    </button>
                </div>
            </div>
            <div class="modal fade" id="updateAddressjs${addressCount++}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content p-3" style="overflow-y: auto;">
                        <div>
                            <h6 class="fw-bold">
                                Edit Address <button type="button" class="btn-close float-right"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                            </h6>
                        </div>
                        <form onSubmit="addressHandler(event, this, 'update')" action="" method="post" class=" my-4 mb-0 add-address" novalidate>
                            @csrf
                            <input type="hidden" name="address_id" value="${ data.id }">
                            <input type="hidden" name="country" value="india">
                            <div class="form-group mb-3">
                                <label class="form-label">Flat/House No/Building No</label>
                                <input type="text" class="form-control" name="address1" value="${ data.address1 }" required>
                                <div class="text-danger form-error err-address1"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Road name/Area/Colony</label>
                                <input type="text" class="form-control" name="address2" value="${ data.address2 }" required>
                                <div class="text-danger form-error err-address2"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Town/City</label>
                                <input type="text" class="form-control" name="town_city" value="${ data.town_city }" required>
                                <div class="text-danger form-error err-town_city"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Pincode</label>
                                <input type="tel" class="form-control" name="pincode"  value="${ data.pincode }" required>
                                <div class="text-danger form-error err-pincode"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">State</label>
                                <select class="form-select border" name="state" required>
                                    <option value="">Select State</option>
                                    ${statesString}
                                </select>
                                <div class="text-danger form-error err-state"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Address type</label>
                                <select class="form-select border" name="address_type" required>
                                    <option value="">Select Address Type</option>
                                    <option ${ data.address_type = 'home' ? 'selected' : '' } value="home">Home</option>
                                    <option ${ data.address_type = 'office' ? 'selected' : '' } value="office">Office</option>
                                </select>
                                <div class="text-danger form-error err-address_type"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Landmark</label>
                                <input type="text" class="form-control" name="landmark"  value="${ data.landmark }">
                                <div class="text-danger form-error err-landmark"></div>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Mobile Number</label>
                                <input type="tel" class="form-control" name="mobile"  value="${ data.mobile }" required>
                                <div class="text-danger form-error err-mobile"></div>
                            </div>
                            <div class="ec-header-btn">
                                <div class="text-success form-success-msg"></div>
                                <div class="text-danger form-error-msg"></div>
                                <button class="btn btn-primary">Update Address</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    `).children(':last')
            .hide()
            .fadeIn(1000);;
    }

    function paymentOptionHandler(el, method) {
        if(['COD', 'ONLINE'].includes(method)){
            $('#order-btn').prop('disabled', false)
        }
        setPaymentMethod(method)
        $(el).parent().find('.pay-method').each((i, item) => {
            $(item).removeClass('border-secondary')
            $(item).css('background','#fff');
            $(item).find('span').removeClass('text-white');
            $(item).find('svg').css('color','#427c80');
            $(item).find('p').removeClass('text-white');
        })
        $(el).addClass('border-secondary');
        $(el).css('background','#427c80');
        $(el).find('span').addClass('text-white');
        $(el).find('svg').css('color','#fff');
        $(el).find('p').addClass('text-white');
    }
</script>
@endsection