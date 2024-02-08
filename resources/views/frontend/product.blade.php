@extends('layouts.frontend')
@section('meta')
    
    <title>{{$product->caption_name}}</title>
    <meta name="title" content="{{$product->caption_name}} | Easybuy">
    <meta name="description" content="{{$product->meta_desp}}">
    {{-- <meta name="keyword" content="{{$product->meta_keyword}}"> --}}

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Url('product/' . $productItem->id . '/' . Common::getSlugName($product->caption_name)) }}">
    <meta property="og:title" content="{{$product->caption_name}} | Easybuy">
    <meta property="og:description" content="{{$product->meta_desp}}">
    <meta property="og:image" content="{{ env('IMG_URL') }}product_images/{{ $productImages[0]->banner }}">

    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ Url('product/' . $productItem->id . '/' . Common::getSlugName($product->caption_name)) }}">
    <meta property="twitter:title" content="{{$product->caption_name}} | Easybuy">
    <meta property="twitter:description" content="{{$product->meta_desp}}">
    <meta property="twitter:image" content="{{ env('IMG_URL') }}product_images/{{ $productImages[0]->banner }}">
    <link rel="canonical" href="{{ 'https://easy-buy.in/product/' . $productItems[0]->id . '/' . Common::getSlugName($product->caption_name) }}" />
    @php
        $images = [];
        foreach($productImages as $pi){
            array_push($images,'"'.env('IMG_URL').'product_images/'.$pi->zoom.'"');
        }
    @endphp
    @if ($product->is_indexable == 1)
        <meta name="robots" content="index, follow" />
        <meta name="googlebot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
        <meta name="bingbot" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
        <script type="application/ld+json">
            {
            "@context": "https://schema.org/",
            "@type": "Product",
            "mpn": "{{$productItem->id}}97531",
            "image":[{!!join(",",$images)!!}],
            "name": "{{$product->caption_name}}",
            "description": "{{$product->meta_desp}}",
            "category": "{{Common::getCatNameById($product->cat_id) }}",
            "brand": {
                "@type": "Brand",
                "name": "{{Common::getBrandNameById($product->brand_id)}}"
            },
            "offers": {
                "@type": "Offer",
                "url": "{{ 'https://easy-buy.in/product/' . $productItem->id . '/' . Common::getSlugName($product->caption_name) }}",
                "itemCondition": "https://schema.org/NewCondition",
                "availability": "https://schema.org/InStock",
                "price": "{{$productItem->combo_price}}",
                "priceCurrency": "INR",
                "priceValidUntil": "",
                "shippingDetails": {
                "@type": "OfferShippingDetails",
                "shippingRate": {
                    "@type": "MonetaryAmount",
                    "value": "{{$product->shipping_charge}}",
                    "currency": "INR"
                },
                "shippingDestination": {
                    "@type": "DefinedRegion",
                    "addressCountry": "IN"
                  }
                }
              }
            }
        </script>
    @else
        <meta name="robots" content="noindex">
    @endif

@endsection
@section('content')
    <!-- breadcrumb start -->
    <div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
        <div class="container">
            <ul class="ec-breadcrumb-list d-flex flex-nowrap" style="overflow:hidden">
                <li class="ec-breadcrumb-item"><a href="{{ Url('/') }}">Home</a></li>
                <li class="ec-breadcrumb-item" style="white-space: nowrap;"><a href="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById($product->cat_id ))}}?categoryId={{ $product->cat_id  }}">{{$product->cat_name}}</a></li>
                @if (!empty($product->sub_cat_name))
                <li class="ec-breadcrumb-item" style="white-space: nowrap;"><a href="{{Url('/')}}/products/{{Common::getSlugName(Common::getCatNameById($product->cat_id ))}}/{{Common::getSlugName(Common::getSubCatNameById($product->sub_cat_id))}}?categoryId={{ $product->cat_id  }}&subCategoryId={{ $product->sub_cat_id }}">{{$product->sub_cat_name}}</a></li>
                @endif
                <li class="ec-breadcrumb-item active" style="text-overflow: ellipsis;overflow: hidden;white-space: nowrap;max-width:40rem">{{$product->caption_name}}</li>
            </ul>
        </div>
    </div>
    <!-- breadcrumb end -->
    <!-- Sart Single product -->
    <section class="ec-page-content section-space-p">
        <div class="container">
            <div class="row">
                <div class="ec-pro-rightside ec-common-rightside col-lg-12 col-md-12">
                    <!-- Single product content Start -->
                    <div class="single-pro-block">
                        <div class="single-pro-inner">
                            <div class="row">
                                <div class="single-pro-img single-pro-img-no-sidebar">
                                    <div class="single-product-scroll">
                                        <div class="single-product-cover border">
                                            @foreach ($productImages as $productImage)
                                                <div class="single-slide zoom-image-hover">
                                                    <img loading="lazy" class="img-responsive"
                                                        onerror="this.src = './default/no-image.png'"
                                                        src="{{ env('IMG_URL') }}product_images/{{ $productImage->zoom }}"
                                                        alt="{{$product->caption_name}}" style="margin: 0 auto;">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="single-nav-thumb">
                                            @foreach ($productImages as $productImage)
                                                <div class="single-slide">
                                                    <img loading="lazy" class="img-responsive"
                                                        onerror="this.src = './default/no-image.png'"
                                                        src="{{ env('IMG_URL') }}product_images/{{ $productImage->thumb }}"
                                                        alt="{{$product->caption_name}}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="single-pro-desc single-pro-desc-no-sidebar">
                                    <div class="single-pro-content">
                                        <h1 class="ec-single-title mb-2">{{ $product->name }}</h1>
                                        <div class="ec-single-rating-wrap mb-1">
                                            @if (!empty($aggregate_rating))
                                                <div class="ec-single-rating" style="margin-right: 6px;padding-right: 6px;">
                                                    <span>Product rating: </span>
                                                    @for ($i = 0; $i < 5; $i++)
                                                        @if ($i < $aggregate_rating)
                                                            <i class="ecicon eci-star fill"></i>
                                                        @else
                                                            <i class="ecicon eci-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <button class="text-secondary fw-light text-decoration-underline" onclick="openReviewTab()">Write a review</button>
                                            @else
                                            <div>
                                                <div class="ec-ratting-star float-left mr-1">
                                                    <div class="ec-pro-rating" style="width: max-content;">
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                        <i class="ecicon eci-star-o"></i>
                                                    </div>
                                                </div>
                                                <span class="ec-read-review"><button class="text-secondary fw-light text-decoration-underline" onclick="openReviewTab()">Be the first to
                                                            review this product</button></span>
                                            </div>
                                            @endif

                                        </div>
                                        <div class="ec-pro-variation">
                                            <div class="ec-pro-variation-inner ec-pro-variation-size mb-1">
                                                <div class="ec-pro-variation-content">
                                                    <ul>
                                                        @foreach ($productItems as $key => $pItem)
                                                            @if ($pItem->id == Request::segment(2))
                                                                <a
                                                                    href="{{ Url('product/' . $pItem->id . '/' . Common::getSlugName($product->caption_name)) }}">
                                                                    <li class="active px-2 text-white"
                                                                        style="width:fit-content;background:#427c80;height: fit-content;">
                                                                        <span>{{ $pItem->item_name }}</span>
                                                                    </li>
                                                                </a>
                                                            @else
                                                                <a
                                                                    href="{{ Url('product/' . $pItem->id . '/' . Common::getSlugName($product->caption_name)) }}">
                                                                    <li class="px-2" style="width:fit-content;height: fit-content;">
                                                                        <span>{{ $pItem->item_name }}</span>
                                                                    </li>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="ec-single-price d-flex align-items-center">
                                                <span
                                                    class="fs-4 pr-1 text-danger">-{{ (int) (((((int) $productItem->mrp) - (int) $productItem->combo_price) / (int) $productItem->mrp) * 100) }}%</span>
                                                <span class="new-price"
                                                    style="font-size: 1.8rem;">₹{{ $productItem->combo_price }}
                                                </span>

                                            </div>

                                            <div>
                                                <span>M.R.P:</span>
                                                <strike class="fs-6">₹{{ $productItem->mrp }}</strike>
                                                @if ((int) $productItem->qty <= 0)
                                                    <span class="border border-danger text-danger px-2 py-0">Out of
                                                        Stock</span>
                                                @elseif((int) $productItem->qty < 5)
                                                    <span
                                                        class=" ml-1 border border-warning px-2 py-0 fw-normal text-warning">Few
                                                        Items Left</span>
                                                @else
                                                    <span
                                                        class=" ml-1 border border-secondary px-2 py-0 fw-normal text-secondary">In
                                                        Stock</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mb-2 mt-1">
                                            +{{ $product->shipping_charge }}₹ delivery charge
                                        </div>
                                        <h6 class="fw-bold">About the item</h6>
                                        @if (!empty(base64_decode($productItem->item_desp)))
                                            <div class="ec-single-desc" style="overflow-x: auto">{!! base64_decode($productItem->item_desp) !!}</div>
                                        @else
                                            <div class="ec-single-desc" style="overflow-x: auto">{!! base64_decode($product->short_desp) !!}</div>
                                        @endif
                                        <p class="pt-2 mb-1" style="font-weight: 500">Check delivery availability</p>
                                        <form style="max-width: 20rem" onsubmit="checkCODAvailability(this)">
                                            @csrf
                                            <div class="d-flex">
                                                <input class="form-control rounded-0 pr-3" style="height: 2.5rem !important" name="pincode" type="text" placeholder="Enter delivery pincode">
                                                <button class="btn btn-secondary btn-sm">Check</button>
                                               </div>
                                               <div class="mt-2 pincode-message">
                                               </div>
                                        </form>
                                        <div class="ec-pro-variation">
                                            @if ($productSizes->count() > 0)
                                                <div class="ec-pro-variation-inner ec-pro-variation-size">
                                                    <span>SIZE</span>
                                                    <div class="ec-pro-variation-content">
                                                        <ul>
                                                            @foreach ($productSizes as $productSize)
                                                                @if ($productSize->id == $pSize->id)
                                                                    <a
                                                                        href="{{ Url('product/' . $productSize->p_item_id . '/' . Common::getSlugName($product->name)) }}">
                                                                        <li class="active text-white"
                                                                            style="background:#427c80 !important;">
                                                                            <span>{{ $productSize->name }}</span>
                                                                        </li>
                                                                    </a>
                                                                @else
                                                                    <a
                                                                        href="{{ Url('product/' . $productSize->p_item_id . '/' . Common::getSlugName($product->name)) }}">
                                                                        <li><span>{{ $productSize->name }}</span>
                                                                        </li>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($productColors->count() > 0)
                                                <div class="ec-pro-variation-inner ec-pro-variation-color">
                                                    <span>Color</span>
                                                    <div class="ec-pro-variation-content">
                                                        <ul>
                                                            @foreach ($productColors as $productColor)
                                                                @if ($productColor->id == $pColor->id)
                                                                    <a
                                                                        href="{{ Url('product/' . $productColor->p_item_id . '/' . Common::getSlugName($product->name)) }}">
                                                                        <li class="active">
                                                                            <span
                                                                                style="background-color:{{ $productColor->code }}"></span>
                                                                        </li>
                                                                    </a>
                                                                @else
                                                                    <a
                                                                        href="{{ Url('product/' . $productColor->p_item_id . '/' . Common::getSlugName($product->name)) }}">
                                                                        <li><span
                                                                                style="background-color:{{ $productColor->code }}"></span>
                                                                        </li>
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ec-single-qty">
                                            <div class="qty-plus-minus">
                                                <input class="qty-input" type="text" name="ec_qtybtn" value="1" />
                                            </div>
                                            <div class="ec-single-cart ">
                                                @if ((int) $productItem->qty <= 0)
                                                    <button class="btn text-danger border border-danger">Out
                                                        of
                                                        Stock</button>
                                                @else
                                                <div class="d-flex">
                                                    <button class="btn btn-warning"
                                                    onclick="addToCart('{{ $productItem->pid }}','{{ $productItem->id }}',$('.qty-input').val(),event, addtocartHandler2)">Add To Cart</button>
                                                    <button class="btn btn-primary"
                                                    onclick="addToCart('{{ $productItem->pid }}','{{ $productItem->id }}',$('.qty-input').val(),event, addtocartHandler3)">Buy Now</button>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="ec-single-wishlist">
                                                <a class="ec-btn-group wishlist" title="Wishlist" onclick="addToWishlist('{{ $productItem->id }}', event, wishlistHandler1)">
                                                    <i style="display: {{ $wishList ? 'block' : 'none' }}" class="icon-box-1 fa fa-heart fa-2x text-danger"></i>
                                                    <i style="display: {{ $wishList ? 'none' : 'block' }}" class="icon-box-2 fa fa-heart-o fa-2x"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="p-3 mb-3" style="max-width:450px;border:1px solid #427c80;color:#427c80;background: #427c800d;">We want to inform you that while placing your order, you must submit the token amount / money or else your order won't be accepted or may get cancelled.</div>
                                        <div class="ec-single-social">
                                            <ul class="mb-0">
                                                <li class="list-inline-item facebook"><a href="https://www.facebook.com/sharer/sharer.php?u={{ Url('product/' . $productItem->id . '/' . Common::getSlugName($product->caption_name)) }}" target="_blank"><i class="ecicon eci-facebook"></i></a></li>
                                                <li class="list-inline-item twitter"><a href="http://twitter.com/share?text=Buy{{$product->caption_name}} at best price on easybuy&url={{ Url('product/' . $productItem->id . '/' . Common::getSlugName($product->caption_name)) }}"><i class="ecicon eci-twitter"></i></a></li>
                                                <li class="list-inline-item whatsapp"><a href="https://api.whatsapp.com/send?text=Buy at lowest price{{ Url('product/' . $productItem->id . '/' . Common::getSlugName($product->caption_name)) }}"><i
                                                            class="ecicon eci-whatsapp"></i></a></li>
                                                <li class="list-inline-item copy behance"><a href="javascript:void(0)" onclick="copyLink('{{ Url('product/' . $productItem->id . '/' . Common::getSlugName($product->caption_name)) }}')"><i
                                                    class="ecicon eci-copy"></i></a></li>
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Single product content End -->
                    <!-- Single product tab start -->
                    <div class="ec-single-pro-tab">
                        <div class="ec-single-pro-tab-wrapper">
                            <div class="ec-single-pro-tab-nav">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#ec-spt-nav-details" role="tablist">Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-info"
                                            role="tablist">More Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#ec-spt-nav-review"
                                            role="tablist">Reviews</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content  ec-single-pro-tab-content">
                                <div id="ec-spt-nav-details" class="tab-pane fade show active">
                                    <div class="ec-single-pro-tab-desc py-4" style="overflow-x: auto">
                                        {!! base64_decode($product->long_desp) !!}
                                    </div>
                                </div>
                                <div id="ec-spt-nav-info" class="tab-pane fade">
                                    <div class="ec-single-pro-tab-moreinfo">
                                        @php
                                            $newProductSpecs = [];
                                            foreach ($productSpecs as $row) {
                                                $temp = explode('@:', $row->specification);
                                                array_push($newProductSpecs, $temp);
                                            }
                                            // dd($newProductSpecs);
                                        @endphp
                                        <ul>
                                            @if ($productSpecs->count() > 0)
                                                @foreach ($newProductSpecs as $row)
                                                    <li><span>{{ trim($row[0]) }}</span>{{ trim($row[1]) }}</li>
                                                @endforeach
                                            @endif
                                            @if (!empty($productItem))
                                                @if (!empty($productItem->weight))
                                                    <li><span>Weight</span>{{ $productItem->weight . ' ' . $productItem->unit_type }}
                                                    </li>
                                                @endif
                                                @if (!empty($productItem->dimension))
                                                    <li><span>Dimension</span>{{ $productItem->dimension }}
                                                    </li>
                                                @endif
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <div id="ec-spt-nav-review" class="tab-pane fade">
                                    <div class="row">
                                        <div class="ec-t-review-wrapper review-container">
                                            @if ($reviews->count() > 0)
                                                @foreach ($reviews as $review)
                                                    <div class="ec-t-review-item">
                                                        <div class="ec-t-review-avtar">
                                                            <img loading="lazy" class="border border-muted"
                                                                onerror="this.src='{{ 'https://ui-avatars.com/api/?name=' . $review->fname . '&color=7F9CF5&background=EBF4FF' }}'"
                                                                src="{{ Url('data/profile_images/' . $review->profile_img) }}"
                                                                alt="{{$review->fname}}'s review" />
                                                        </div>
                                                        <div class="ec-t-review-content">
                                                            <div class="ec-t-review-top mb-1">
                                                                <div class="ec-t-review-name">{{ $review->fname }}</div>
                                                                <div class="ec-t-review-rating">
                                                                    @for ($i = 0; $i < 5; $i++)
                                                                        @if ($i < (int) $review->rating)
                                                                            <i class="ecicon eci-star fill"></i>
                                                                        @else
                                                                            <i class="ecicon eci-star-o"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                            </div>
                                                            <div class="ec-t-review-bottom">
                                                                <strong>{{ $review->title }}</strong>
                                                                <p>{{ $review->text }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-muted mb-3">There is no review.</p>
                                            @endif


                                        </div>
                                        <div class="ec-ratting-content">
                                            <h5>Add a Review</h5>
                                            @if (UserAuth::has('login'))
                                                <div class="ec-ratting-form">
                                                    <form class="add-review" onsubmit="submitReview(event, this)"
                                                        action="" method="post">
                                                        @csrf
                                                        <input type="hidden" name="p_item_id"
                                                            value="{{ $productItem->id }}">
                                                        <input type="hidden" name="pid"
                                                            value="{{ $productItem->pid }}">
                                                        <input type="hidden" name="star" value="">
                                                        <div class="mb-3">
                                                            <div class="ec-ratting-star mb-0">
                                                                <span>Your rating:</span>
                                                                <div class="ec-t-review-rating">
                                                                    <i class="ecicon eci-star-o"
                                                                        onclick="reviewStarHandler(this,1)"></i>
                                                                    <i class="ecicon eci-star-o"
                                                                        onclick="reviewStarHandler(this,2)"></i>
                                                                    <i class="ecicon eci-star-o"
                                                                        onclick="reviewStarHandler(this,3)"></i>
                                                                    <i class="ecicon eci-star-o"
                                                                        onclick="reviewStarHandler(this,4)"></i>
                                                                    <i class="ecicon eci-star-o"
                                                                        onclick="reviewStarHandler(this,5)"></i>
                                                                </div>
                                                            </div>
                                                            <div class="form-error err_star text-danger">

                                                            </div>
                                                        </div>
                                                        <div class="ec-ratting-input form-submit">
                                                            <div class="mb-3">
                                                                <input class="mb-0" type="text"
                                                                    placeholder="Enter Title" name="title">
                                                                <div class="mt-1 form-error err_title text-danger">

                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <textarea class="mb-0" name="review" placeholder="Write a review"></textarea>
                                                                <div class="mt-1 form-error err_review text-danger">

                                                                </div>
                                                            </div>
                                                            <button class="btn btn-primary" type="submit"
                                                                value="Submit">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                <a href="{{ Url('login') }}" class="btn border"
                                                    style="    border-color: #427c80 !important;" type="submit"
                                                    value="Submit">Please
                                                    login to write a review</a>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- product details description area end -->
                </div>

            </div>
        </div>
    </section>
    <!-- End Single product -->

    
    @if ($similarProducts->count())
    <!-- Related Product Start -->
    <section class="section ec-releted-product section-space-p">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="section-title">
                        <h2 class="ec-bg-title">Related products</h2>
                        <h2 class="ec-title">Related products</h2>
                        <p class="sub-title">Browse The Collection of Related Products</p>
                    </div>
                </div>
            </div>
            <div class="row margin-minus-b-30">
                <!-- Related Product Content -->
                @foreach ($similarProducts as $product)
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 mb-6 pro-gl-content">
                    <div class="ec-product-inner">
                        <div class="ec-pro-image-outer">
                            <div class="ec-pro-image">
                                <a href="product-left-sidebar.html" class="image">
                                    <img loading="lazy" onerror="this.src = './default/no-image.png'"
                                        class="main-image"
                                        src="{{ env('IMG_URL') }}product_images/{{ $product->banner }}"
                                        alt="{{$product->caption_name}}" />
                                    <img loading="lazy" class="hover-image"
                                        onerror="this.src = './default/no-image.png'"
                                        src="{{ env('IMG_URL') }}product_images/{{ $product->zoom }}"
                                        alt="{{$product->caption_name}}" />
                                </a>
                                <span
                                    class="percentage">{{ (int) (((((int) $product->mrp) - (int) $product->combo_price) / (int) $product->mrp) * 100) }}%
                                    off</span>
                                <span class="flags">
                                    <span class="new">{{ $product->product_tag }}</span>
                                </span>
                                <a href="javascript:{}" onclick="addToWishlist('{{ $product->item_id }}', event, wishlistHandler)" class="quickview" 
                                    title="Add to Wishlist">
                                        
                                         <i style="display: {{ $product->wishlist_id ? 'block' : 'none' }}" class="icon-box-1 fa fa-heart text-danger"></i>
                                         <i style="display: {{ $product->wishlist_id ? 'none' : 'block' }}" class="icon-box-2 fa fa-heart-o"></i>
                                        
                                    </a>
                                    <a  onclick="addToCart('{{ $product->id }}','{{ $product->item_id }}','1',event, addtocartHandler)" href="javascript:{}" class="quickview addtocart-st" title="Add to Cart">
                                             <i class="fa fa-shopping-cart"></i> 
                                    </a>
                                <div class="ec-pro-actions">
                                </div>
                            </div>
                        </div>
                        <div class="ec-pro-content">
                            <h3 title="{{ $product->name }}" class="ec-pro-title"><a
                                href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}">{{ $product->name }}</a></h3>
                            <div class="ec-pro-rating">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < Common::getProductRating($product->id))
                                        <i class="ecicon eci-star fill"></i>
                                    @else
                                        <i class="ecicon eci-star"></i>
                                    @endif
                                @endfor
                            </div>  
                            {{-- <div class="ec-pro-list-desc">{{ $product->short_desp }}</div> --}}
                            <span class="ec-price">
                                <span class="old-price">₹{{ $product->mrp }}</span>
                                <span class="new-price">₹{{ $product->combo_price }}</span>
                            </span>
                            <div class="ec-pro-option">

                                <button class="btn btn-warning"
                                    style="font-size: 0.7rem;
                                height: fit-content;
                                line-height: 2.5;">Buy</button>

                                <a href="{{ Url('product/' . $product->item_id . '/' . Common::getSlugName($product->caption_name)) }}"
                                    class="btn btn-primary"
                                    style="font-size: 0.7rem;
                                height: fit-content;
                                line-height: 2.5;">More</a>
                             
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </section>
    @endif

    <script>
        function reviewStarHandler(el, count) {
            $(el).parent().find('.ecicon').each((i, item) => {
                if (i < count) {
                    $(item).addClass('fill eci-star');
                    $(item).removeClass('eci-star-o');
                } else {
                    $(item).removeClass('fill eci-star');
                    $(item).addClass('eci-star-o');
                }
            })
            $('input[name="star"]').val(count);
        }

        function submitReview(e, el) {
            e.preventDefault()
            const formData = new FormData(el)
            $('.form-error').text('');
            $.ajax({
                type: 'post',
                url: "{{ route('frontend.review.store') }}",
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(response) {
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
                        onClick: function() {} // Callback after click
                    }).showToast();
                    $(el).find('.ecicon').each((i, item) => {
                        $(item).removeClass('fill eci-star');
                        $(item).addClass('eci-star-o');
                    })
                    $('input[name="star"]').val('');
                    $(el).trigger("reset");
                    let rating = ``;
                    for (i = 0; i < 5; i++) {
                        if (i < parseInt(response.form_data.rating)) {
                            rating += `<i class="ecicon eci-star fill"></i>`
                        } else {
                            rating += `<i class="ecicon eci-star-o"></i>`

                        }
                    }
                    $('.review-container').append(`
                    <div class="ec-t-review-item">
                        <div class="ec-t-review-avtar">
                            <img loading="lazy" class="border border-muted"
                                onerror="this.src='{{ 'https://ui-avatars.com/api/?name=${response.form_data.fname}&color=7F9CF5&background=EBF4FF' }}'"
                                src="{{ Url('data/profile_images') }}/${response.form_data.profile_img}"
                                alt="" />
                        </div>
                        <div class="ec-t-review-content">
                            <div class="ec-t-review-top mb-1">
                                <div class="ec-t-review-name">${response.form_data.fname}</div>
                                <div class="ec-t-review-rating">
                                    ${rating}
                                </div>
                            </div>
                            <div class="ec-t-review-bottom">
                                <strong>${response.form_data.title}</strong>
                                <p>${response.form_data.text}
                                </p>
                            </div>
                        </div>
                    </div>
                `);
                },
                error: function(error) {
                    const errors = error.responseJSON.form_errors
                    if (errors) {
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var val = errors[key];
                                $('.add-review').find(`.err_${key}`).text(val)
                            }
                        }
                    }
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

        function openReviewTab(){
            $('.ec-single-pro-tab-nav>.nav-tabs>.nav-item').each((i,item)=>{
                $(item).find('.nav-link').removeClass('active')
            });
            $('.ec-single-pro-tab-content > div').each((i,item)=>{
                $(item).removeClass('show active')
            })
            $('.ec-single-pro-tab-nav>.nav-tabs>.nav-item>.nav-link[data-bs-target="#ec-spt-nav-review"]').addClass('active');
            const tab = $('.ec-single-pro-tab-nav>.nav-tabs>.nav-item>.nav-link[data-bs-target="#ec-spt-nav-review"]').data('bs-target');
            $(tab).addClass('show active')
            $('html, body').animate({
                scrollTop: $('.ec-ratting-content').offset().top
            }, 300);
        }

        function checkCODAvailability(el){
            event.preventDefault();
            const pincode = $(el).find('input[name="pincode"]').val();
            const formData = new FormData(el);
            if(pincode != ''){
                $(el).find('input[name="pincode"]').removeClass('border border-danger')
                $(el).find('input[name="pincode"]').addClass('border border-success')
                $(el).find('.pincode-message').html(``);
                    $.ajax({
                    type: 'post',
                    url: "{{ route('check-cod-availability') }}",
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: formData,
                    success: function(response) {
                        $(el).find('input[name="pincode"]').removeClass('border border-danger')
                        $(el).find('input[name="pincode"]').addClass('border border-success')
                        $(el).find('.pincode-message').html(`<span class="text-success">${response.message}</span>`);
                    },
                    error: function(error) {
                        const errors = error.responseJSON?.form_errors || null;
                        $(el).find('input[name="pincode"]').removeClass('border border-success')
                        $(el).find('input[name="pincode"]').addClass('border border-danger')
                        if(errors != null){
                            $(el).find('.pincode-message').html(`<span class="text-danger">${errors.pincode}</span>`);
                        } 
                    }
                })
            }
            else{
                $(el).find('.pincode-message').html(`<span class="text-danger">Please enter pincode</span>`);
                $(el).find('input[name="pincode"]').removeClass('border border-success')
                $(el).find('input[name="pincode"]').addClass('border border-danger')
            }
        }
         
        function copyLink(url){
            navigator.clipboard.writeText(url);
        }
    </script>
    <!-- Related Product end -->
@endsection
