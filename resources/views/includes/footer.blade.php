   <!-- Footer navigation panel for responsive display -->
   <div class="ec-nav-toolbar no-print">
       <div class="container">
           <div class="ec-nav-panel">
               <div class="ec-nav-panel-icons">
                   <a href="#ec-mobile-menu" class="navbar-toggler-btn ec-header-btn ec-side-toggle"><img
                           src="assets/images/icons/menu.svg" class="svg_img header_svg" alt="menu icon" /></a>
               </div>
               <div class="ec-nav-panel-icons">
                   <a href="{{ Url('cart') }}" class="ec-header-btn"><img src="assets/images/icons/cart.svg"
                           class="svg_img header_svg" alt="cart icon" /><span
                           class="ec-cart-noti ec-header-count cart-count-lable cart-count">{{ CartUtil::cartCount() }}</span></a>
               </div>
               <div class="ec-nav-panel-icons">
                   <a href="{{ Url('/') }}" class="ec-header-btn"><img src="assets/images/icons/home.svg"
                           class="svg_img header_svg" alt="home icon" /></a>
               </div>
               <div class="ec-nav-panel-icons">
                   <a href="{{Url('wishlist')}}" class="ec-header-btn"><img src="assets/images/icons/wishlist.svg"
                           class="svg_img header_svg" alt="wishlist icon" /><span class="ec-cart-noti wishlist-count">{{ Common::getWishlist()->count() }}</span></a>
               </div>
               <div class="ec-nav-panel-icons">
                   <a href="{{ Url('myaccount') }}" class="ec-header-btn"><img src="assets/images/icons/user.svg"
                           class="svg_img header_svg" alt="user profile icon" /></a>
               </div>
           </div>
       </div>
   </div>
   <!-- Footer navigation panel for responsive display end -->
   <!-- Footer Start -->
   <footer class="ec-footer section-space-mt no-print">
       <div class="footer-top section-space-footer-p">
           <div class="container">
               <div class="row">
                   <div class="col-sm-12 col-lg-3 ec-footer-contact">
                       <div class="ec-footer-widget">
                           <div class="ec-footer-logo">
                                <a href="{{Url('/')}}">
                                    <img loading="lazy" src="assets/images/logo/logo.png" alt="easybuy">
                                    <img loading="lazy" class="dark-footer-logo" src="assets/images/logo/dark-logo.png" alt="easybuy" style="display: none" />
                                </a>
                            </div>
                           <h4 class="ec-footer-heading">Contact us</h4>
                           <div class="ec-footer-links">
                               <ul class="align-items-center">
                                   <li class="ec-footer-link">{{Common::getAddress()}}</li>
                                   <li class="ec-footer-link"><span>Call Us:</span><a
                                           href="tel:+918447226676">+91-8447226676</a></li>
                                   <li class="ec-footer-link"><span>Email:</span><a
                                           href="mailto:sales@easy-buy.in">sales@easy-buy.in</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-12 col-lg-3 ec-footer-info">
                       <div class="ec-footer-widget">
                           <h4 class="ec-footer-heading">Information</h4>
                           <div class="ec-footer-links">
                               <ul class="align-items-center">
                                   <li class="ec-footer-link"><a href="{{Url('about-us')}}">About us</a></li>
                                   {{-- <li class="ec-footer-link"><a href="javascript:void()">FAQ</a></li> --}}
                                   {{-- <li class="ec-footer-link"><a href="javascript:void()">Delivery Information</a>
                                   </li> --}}
                                   <li class="ec-footer-link"><a href="{{Url('contact-us')}}">Contact us</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-12 col-lg-3 ec-footer-account">
                       <div class="ec-footer-widget">
                           <h4 class="ec-footer-heading">Account</h4>
                           <div class="ec-footer-links">
                               <ul class="align-items-center">
                                   <li class="ec-footer-link"><a href="{{Url('myaccount')}}">My Account</a></li>
                                   <li class="ec-footer-link"><a href="{{Url('myorders')}}">My Order</a></li>
                                   <li class="ec-footer-link"><a href="{{Url('myaddress')}}">My Address</a></li>
                                   <li class="ec-footer-link"><a href="{{Url('wishlist')}}">Wishlist</a></li>
                               </ul>
                           </div>
                       </div>
                   </div>
                   <div class="col-sm-12 col-lg-3 ec-footer-service">
                       <div class="ec-footer-widget">
                           <h4 class="ec-footer-heading">Services</h4>
                           <div class="ec-footer-links">
                               <ul class="align-items-center">
                                   <li class="ec-footer-link"><a href="{{Url('refund-return-policy')}}">Refund Policy</a></li>
                                   <li class="ec-footer-link"><a href="{{Url('privacy-policy')}}">Privacy & policy</a>
                                   </li>
                                    <li class="ec-footer-link"><a href="{{Url('shipping-policy')}}">Shipping Policy</a>
                                    </li>
                                   <li class="ec-footer-link"><a href="{{Url('terms-and-condition')}}">Term & condition</a>
                                   </li>
                               </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       <div class="footer-bottom">
           <div class="container">
               <div class="row align-items-center">
                   <!-- Footer social Start -->
                   <div class="col text-left footer-bottom-left">
                       <div class="footer-bottom-social">
                           <span class="social-text text-upper">Follow us on:</span>
                           <ul class="mb-0">
                               <li class="list-inline-item"><a class="hdr-facebook" href="https://www.facebook.com/easy-buyin-100146009487038" target="_blank"><i class="ecicon eci-facebook"></i></a></li>
                               <li class="list-inline-item"><a class="hdr-twitter" href="https://twitter.com/easybuy_19" target="_blank"><i
                                           class="ecicon eci-twitter"></i></a></li>
                               <li class="list-inline-item"><a class="hdr-instagram" href="https://www.instagram.com/easybuy.in" target="_blank"><i
                                           class="ecicon eci-instagram"></i></a></li>
                               <li class="list-inline-item youtube-play"><a href="https://www.youtube.com/channel/UCT1RfrX1JPm5n9Vfd__u7Ng" target="_blank"><i
                                           class="ecicon eci-youtube-play"></i></a></li>
                           </ul>
                       </div>
                   </div>
                   <!-- Footer social End -->
                   <!-- Footer Copyright Start -->
                   <div class="col text-center footer-copy">
                       <div class="footer-bottom-copy ">
                           <div class="ec-copy">Copyright ©2022<a href="{{ Url('/') }}"
                                   class="site-name text-upper" href="#">Easybuy<span>.</span></a>. All Rights Reserved
                           </div>
                       </div>
                   </div>
                   <!-- Footer Copyright End -->
                   <!-- Footer payment -->
                   <div class="col footer-bottom-right">
                       <div class="footer-bottom-payment d-flex justify-content-end">
                           <div class="payment-link d-flex gap-2">
                               <img loading="lazy" style="width: 2.5rem;" src="assets/images/payment/visa.svg" alt="visa card supported">
                               <img loading="lazy" style="width: 2.5rem;" src="assets/images/payment/master-card.svg" alt="mastercard supported">
                               <img loading="lazy" style="width: 2.5rem;" src="assets/images/payment/upi.svg" alt="upi payment supported">
                           </div>
                       </div>
                   </div>
                   <!-- Footer payment -->
               </div>
           </div>
       </div>
       </div>
   </footer>
   <!-- Footer Area End -->
