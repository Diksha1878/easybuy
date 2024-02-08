<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\UserAuth;
use Illuminate\Support\Facades\Route;

use App\Libs\Payment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('frontend.home');
Route::get('/about-us', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/contact-us', [FrontendController::class, 'contact'])->name('frontend.contact');
Route::get('/cart', [CartController::class, 'index'])->name('frontend.cart');
Route::get('/product/{id}/{slug}', [ProductController::class, 'index'])->name('frontend.product');
Route::get('/products', [ProductController::class, 'productList'])->name('frontend.products');
Route::get('/products/{brand}', [ProductController::class, 'productList'])->name('frontend.products');
Route::get('/products/{cat}/{subcat}', [ProductController::class, 'productList'])->name('frontend.products');
Route::get('/brands/{cat}/{subcat}', [FrontendController::class, 'brandList'])->name('frontend.brands');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('frontend.add-to-cart');
Route::post('/delete-cart-item', [CartController::class, 'deleteCartItem'])->name('frontend.delete-cart-item');
Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->name('frontend.wishlist.add');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::get('/reset-password/{hash}', [AuthController::class, 'resetPassword'])->name('reset-password');
Route::post('/reset-password', [AuthController::class, 'resetPassword1'])->name('reset-password1');
Route::post('/check-cod-availability', [OrderController::class, 'checkCODAvailability'])->name('check-cod-availability');
Route::view('/privacy-policy', 'frontend.privacy');
Route::view('/terms-and-condition', 'frontend.terms');
Route::view('/refund-return-policy', 'frontend.return_refund');
Route::view('/shipping-policy', 'frontend.shipping_policy');


// Route::post('/debug', function () {
//     echo '<pre>'; 
//     $data = Payment::fetch();
//     print_r($data);
// });

Route::get('/debug', function () {
    echo '<pre>';
    print_r(session('error'));
});

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('frontend.auth.logout');

Route::get('/sitemap.xml', [FrontendController::class, 'sitemap']);

Route::group(['middleware' => ['user.auth']], function () {
    Route::get('/login', [AuthController::class, 'login'])->middleware('user.auth');
    Route::post('/login', [AuthController::class, 'login'])->name('frontend.auth.login');
    Route::get('/signup', [AuthController::class, 'signup']);
    Route::post('/signup', [AuthController::class, 'signup'])->name('frontend.auth.signup');
    Route::get('/myaccount', [UserController::class, 'myaccount'])->name('frontend.user.myaccount');
    Route::post('/myaccount', [UserController::class, 'myaccount'])->name('frontend.user.myaccount');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('frontend.user.change-password');
    Route::get('/myorders', [UserController::class, 'myorders'])->name('frontend.user.myorders');
    Route::get('/myaddress', [AddressController::class, 'index'])->name('frontend.user.myaddress');
    Route::post('/add-address', [AddressController::class, 'addAddress'])->name('frontend.user.add-address');
    Route::post('/delete-address', [AddressController::class, 'deleteAddress'])->name('frontend.user.delete-address');
    Route::post('/set-default-address', [AddressController::class, 'setDefaultAddress'])->name('frontend.user.set-default-address');
    Route::get('/order/{orderId}', [OrderController::class, 'index'])->name('frontend.order.details');
    Route::post('/cancel-order', [OrderController::class, 'cancelOrder'])->name('frontend.order.cancel');
    Route::post('/store-review', [ProductController::class, 'storeReview'])->name('frontend.review.store');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('frontend.user.wishlist');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('frontend.checkout');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('frontend.order.create');
    Route::get('/order-status/{orderId}', [OrderController::class, 'orderStatus'])->name('frontend.order-status');
    Route::post('/payment/fetch', [OrderController::class, 'paymentFetch'])->name('frontend.payment.fetch');
});
