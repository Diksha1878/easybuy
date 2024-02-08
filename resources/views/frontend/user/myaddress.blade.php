@extends('layouts.frontend')
@section('meta')
    <title>My Addresses | Easybuy Online Shopping Site In India</title>
    <meta name="robots" content="noindex">
@endsection
@section('content')
    <!-- Ec breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="text-align: left !important;overflow:hidden">
                <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow-x: hidden;white-space: nowrap;overflow:hidden;">My Addresses</li>
            </ul>
        </div>
    </div>
    <!-- Ec breadcrumb end -->

    <!-- User history section -->
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
                                        <li><a href="{{ Url('myaccount') }}">My Profile</a></li>
                                        <li><a href="{{ Url('myorders') }}">My Orders</a></li>
                                        <li><a href="{{ Url('wishlist') }}">My Wishlist</a></li>
                                        <li><a class="text-success" href="{{ Url('myaddress') }}">My Addresses</a></li>
                                        <li><a class="text-danger" href="{{ Url('/logout') }}">Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ec-shop-rightside col-lg-9 col-md-12">
                    <div class="ec-vendor-dashboard-card">
                        <div class="ec-vendor-card-header">
                            <h5>Addresses</h5>
                            <div class="ec-header-btn">
                                <a class="btn btn-lg btn-primary" href="#" data-bs-toggle="modal"
                                data-bs-target="#addAddress">Add New</a>
                            </div>
                        </div>
                        <div class="row p-3 addressContainer">
                            @if ($addresses->count() > 0)
                                @foreach ($addresses as $key=>$address)
                                <div class="col-md-6 mb-4 addressContent">
                                    <div class="border p-3 p-sm-4 h-100 d-flex flex-column justify-content-between">
                                        <div class="mb-3">
                                            <a onclick="makeDefaultAddress(this,'{{ $address->id }}')" class="btn border {{ $address->is_default == '1' ? 'bg-success text-white' : 'border-success text-success' }} mb-2 float-right Isaddress"
                                                style="line-height: unset;font-size: 9px;padding: 2px 6px;height: fit-content;"
                                                href="javascript:void(0)"> {{ $address->is_default == '1' ? 'Set as default': 'Make default'}} </a>  
                                            <div class="fw-bold address1">{{ $address->address1 }}</div>
                                            <div class="addressRemaining">{{ $address->address2}} {{ $address->town_city}} {{ Common::getStates()[(int)$address->state - 1]['name']}} - {{ $address->pincode }},</div>
                                            <div class="landmark">{{ $address->landmark }}</div>
                                            <div class="mt-1 fw-bold">Mobile: <span
                                                    class="fw-normal mobileNumber">{{ $address->mobile }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-3">
                                            <button class="btn border"
                                                style="line-height: unset;font-size: 12px;padding: 8px 12px;height: fit-content;"
                                                type="button" data-bs-toggle="modal"
                                                data-bs-target="#updateAddress{{ $key }}">
                                                Edit
                                            </button>
                                            <button class="btn bg-danger text-white"
                                            style="line-height: unset;font-size: 12px;padding: 8px 12px;height: fit-content;"
                                            type="button" onclick="deleteAddress(this,'{{ $address->id }}')">
                                            Delete
                                        </button>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="updateAddress{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-3" style="overflow-y: auto;">
                                                <div>
                                                    <h6 class="fw-bold">
                                                        Edit Address <button type="button" class="btn-close float-right"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </h6>
                                                </div>
                                                <form onSubmit="addressHandler(event, this,'update')" action="" method="post" class=" my-4 mb-0 add-address" novalidate>
                                                    @csrf
                                                    <input type="hidden" name="address_id" value="{{ $address->id }}">
                                                    <input type="hidden" name="country" value="india">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Flat/House No/Building No</label>
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
                                                        <input type="tel" class="form-control" name="pincode"  value="{{ $address->pincode }}" required>
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
                                                            <option {{ $address->address_type = 'home' ? 'selected' : '' }} value="home">Home</option>
                                                            <option {{ $address->address_type = 'office' ? 'selected' : '' }} value="office">Office</option>
                                                        </select>
                                                        <div class="text-danger form-error err-address_type"></div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Landmark</label>
                                                        <input type="text" class="form-control" name="landmark"  value="{{ $address->landmark }}">
                                                        <div class="text-danger form-error err-landmark"></div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Mobile Number</label>
                                                        <input type="tel" class="form-control" name="mobile"  value="{{ $address->mobile }}" required>
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
            </div>
        </div>
    </section>
    <script>

function addressHandler(e, el, action){
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
		processData:false,
        data: formData,
        success: function(response){
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
                onClick: function(){}
            }).showToast();
            if(action === 'add'){
                $(el).trigger("reset");
                $(el).parents('.modal').modal('hide');
                renderAddressContainer($('.addressContainer'),response.form_data,response.states);
            }
            if(action === 'update'){
                const data = response.form_data;
                $(el).parents('.modal').modal('hide');
                $(el).parents('.addressContent').find('.address1').html(`${data.address1}`);
                $(el).parents('.addressContent').find('.addressRemaining').html(`${data.address2} ${data.town_city} ${data.stateName} - ${data.pincode},`);
                $(el).parents('.addressContent').find('.landmark').html(`${data.landmark}`);
                $(el).parents('.addressContent').find('.mobileNumber').html(`${data.mobile}`);
            }
        },
        error: function(error){
            const errors = error.responseJSON.form_errors
            if(errors){
                for (var key in errors) {
                    if (errors.hasOwnProperty(key)) {
                    var val = errors[key];
                    $('.add-address').find(`.err-${key}`).text(val)
                    }
                }
            }
            else{
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
                    onClick: function(){} // Callback after click
                }).showToast();   
            }
        }
    })
}
let addressCount = 1;
function renderAddressContainer(target,data,states){
    let statesString = ``;
    states.map((state,i)=>{
        statesString += ` <option  ${state.id == data.state ? 'selected' : '' } value="${state.id}">${state.name}</option>`
    })
    $(target).append(`
        <div class="col-md-6 mb-4 addressContent">
            <div class="border p-3 p-sm-4 h-100 d-flex flex-column justify-content-between">
                <div class="mb-3">
                    <a onclick="makeDefaultAddress(this,'${data.id}')" class="btn border ${data.is_default == '1' ? 'bg-success text-white' : 'border-success text-success'} mb-2 float-right Isaddress"
                style="line-height: unset;font-size: 9px;padding: 2px 6px;height: fit-content;"
                href="javascript:void{0}">${ data.is_default == '1' ? 'Set as default': 'Make default'} </a>  
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
                    <button class="btn bg-danger text-white"
                    style="line-height: unset;font-size: 12px;padding: 8px 12px;height: fit-content;"
                    type="button" onclick="deleteAddress(this,'${ data.id }')">
                    Delete
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

function deleteAddress(el,id){
    const formData = new FormData();
    formData.append('_token',"{{ csrf_token() }}");
    formData.append('id',id);
    Swal.fire({
                title: 'Warning',
                text:'Do you want to delete?',
                icon: 'warning',
                confirmButtonColor: '#427c80',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
        type: 'post',
        url: "{{ route('frontend.user.delete-address') }}",
        data: formData,
        contentType: false,
		 cache: false,
		 processData:false,
        success: function(response){
            console.log(response)
            Toastify({
            text: response.message,
            duration: 3000,
            // destination: "https://github.com/apvarun/toastify-js",
            // newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){} // Callback after click
            }).showToast();
            // setTimeout(() => {
            //     window.location.reload();
            // }, 2000);
            $(el).parent().parent().parent().fadeOut('300',function(){
                $(this).remove();
            })
        },
        error: function(error){
            console.log(error)
            if(error.status == 405){
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
                    onClick: function(){} // Callback after click
                }).showToast();
            }
            else{
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
            onClick: function(){} // Callback after click
            }).showToast();
          }
        }
    })
                } else if (result.isDenied) {
                    
                }
            })
  
}
function makeDefaultAddress(el,id){
    const formData = new FormData();
    formData.append('_token',"{{ csrf_token() }}");
    formData.append('id',id);
    $.ajax({
        type: 'post',
        url: "{{ route('frontend.user.set-default-address') }}",
        data: formData,
        contentType: false,
		 cache: false,
		 processData:false,
        success: function(response){
            $(el).parent().parent().parent().parent().find('.Isaddress').each((i,item)=>{
                $(item).html('Make Default');
                $(item).removeClass('bg-success text-white');
                $(item).addClass('border-success text-success');
            })
            $(el).html('Set as default');
            $(el).addClass('bg-success text-white');
            Toastify({
            text: response.message,
            duration: 3000,
            // destination: "https://github.com/apvarun/toastify-js",
            // newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "center", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)",
            },
            onClick: function(){} // Callback after click
            }).showToast();
            // setTimeout(() => {
            //     window.location.reload();
            // }, 2000);
        },
        error: function(error){
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
            onClick: function(){} // Callback after click
            }).showToast();
        }
    })
}
</script>
    <div class="modal fade" id="addAddress" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <div>
                    <h6 class="fw-bold">
                        Add Address <button type="button" class="btn-close float-right"
                            data-bs-dismiss="modal" aria-label="Close"></button>
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
    <!-- End User history section -->
@endsection
