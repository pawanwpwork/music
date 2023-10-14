<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SongController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BandDjEventTypeController;
use App\Http\Controllers\Backend\BandDjAgeGroupController;
use App\Http\Controllers\Backend\BandDjBookController;
use App\Http\Controllers\Backend\MusicGenreController;
use App\Http\Controllers\Backend\MemberController;
use App\Http\Controllers\Backend\MemberSettingController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\RateSettingController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\MemberLoginController;
use App\Http\Controllers\Auth\MemberRegisterController;
use App\Http\Controllers\Backend\MusicCategoryController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SliderImageController;
use App\Http\Controllers\Frotend\MemberDashboardController;
use App\Http\Controllers\Auth\MemberForgotPasswordController;
use App\Http\Controllers\Frotend\CartController;
use App\Http\Controllers\Frotend\CheckoutController;
use App\Http\Controllers\Frotend\ProductReviewController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\Backend\ServiceOrderController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('about-us', [HomeController::class, 'about'])->name('about');

Route::get('event/view', [HomeController::class, 'eventView'])->name('event.view');

Route::get('event/view/calendar/ajax/filter', [HomeController::class, 'eventViewAjax'])->name('event.view.ajax');

Route::get('event/single/{alias}', [HomeController::class, 'eventSinglePage'])->name('event.single');

Route::get('event/post', [HomeController::class, 'eventPostView'])->name('event.post');

Route::post('event/post', [HomeController::class, 'eventPost'])->name('event.post');

Route::get('book-band/post', [HomeController::class, 'bookBandDj'])->name('book-band.post');

Route::post('book-band/post', [HomeController::class, 'bookBandDjPost'])->name('book-band.post');

Route::get('classified/buy', [HomeController::class, 'buyClassified'])->name('classified.buy');

Route::get('classified/sell', [HomeController::class, 'sellClassified'])->name('classified.sell');

Route::get('classified/detail/{alias}', [HomeController::class, 'classifiedSinglePage'])->name('classified.single-page');

Route::post('cd-sell/post', [HomeController::class, 'sellCDPost'])->name('cd-sell.post');

Route::get('cd/detail/{alias}', [HomeController::class, 'cdSinglePage'])->name('cd.single-page');

Route::post('classified/sell/post', [HomeController::class, 'sellClassifiedPost'])->name('classified.sell.post');

Route::get('musician/search', [HomeController::class, 'musicianSearch'])->name('musician.search');

Route::get('musician/search/result', [HomeController::class, 'musicianSearchResult'])->name('musican.search.result');

Route::get('cd-store', [HomeController::class, 'cdStore'])->name('cd.store');

Route::get('cd-sell', [HomeController::class, 'cdSell'])->name('cd.sell');

Route::get('cd/{alias}', [HomeController::class, 'cdDetails'])->name('cd.detail');

Route::get('contact-us', [HomeController::class, 'contact'])->name('contact');

Route::post('contact-us/form/post', [HomeController::class, 'contactPost'])->name('frontend.contact.post');

Route::get('product/{alias}/classified/category', [HomeController::class, 'productClassifiedCategory'])->name('product.classified.category');

Route::get('music/login', [MemberLoginController::class, 'login'])->name('music.login');

Route::get('music/otp/verify/{phoneNumber}', [MemberRegisterController::class, 'phoneOTPVerify'])->name('music.otp.verify');

Route::post('music/login', [MemberLoginController::class, 'loginMember'])->name('music.login');

Route::get('music/logout', [MemberLoginController::class, 'logout'])->name('music.logout');

Route::get('sign-up', [MemberRegisterController::class, 'register'])->name('signUp');

Route::get('sign-up/{type}', [MemberRegisterController::class, 'memberRegisterFormByType'])->name('signup.type');

Route::post('sign-up/post', [MemberRegisterController::class, 'memberPostFormByType'])->name('signup.post');

Route::get('create/music-category/from-register-form', [MemberRegisterController::class, 'createMusicCategoryFromMemberRegisterForm'])->name('create.music-category.from-register-form');

Auth::routes();

Route::get('/admin/login-alpha', [LoginController::class, 'showLoginForm']);

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function(){
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category
    Route::get('category/list', [CategoryController::class, 'index'])->name('category.list');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('category/view/file/{id}', [CategoryController::class, 'storageLocationFileDisplay'])->name('category.storage');
    Route::post('category/save', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/{id}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
    Route::get('category/confirm-delete/{id}', [CategoryController::class, 'getModalDelete'])->name('category.delete.confirm');
    Route::get('category/{id}/change/status', [CategoryController::class, 'statusChange'])->name('category.change.status');


    // Product
    Route::get('product/list', [ProductController::class, 'index'])->name('product.list');
    Route::get('product/data', [ProductController::class, 'getproductData'])->name('product.data');
    Route::get('product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('product/view/file/{id}', [ProductController::class, 'storageLocationFileDisplay'])->name('product.storage');

    Route::get('product/view/back/file/{id}', [ProductController::class, 'storageLocationFileBackDisplay'])->name('product.back.storage');

    Route::post('product/save', [ProductController::class, 'store'])->name('product.store');
    Route::get('product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('product/confirm-delete/{id}', [ProductController::class, 'getModalDelete'])->name('product.delete.confirm');
    Route::get('product/{id}/change/status', [ProductController::class, 'statusChange'])->name('product.change.status');
    Route::get('product/{id}/show', [ProductController::class, 'show'])->name('product.view');

    //Song
    Route::get('song/list', [SongController::class, 'index'])->name('song.list');
    Route::get('song/delete/{id}', [SongController::class, 'destroy'])->name('song.delete');
    Route::get('song/confirm-delete/{id}', [SongController::class, 'getModalDelete'])->name('song.delete.confirm');

    //Review
    Route::get('review/list', [ReviewController::class, 'index'])->name('review.list');
    Route::get('review/delete/{id}', [ReviewController::class, 'destroy'])->name('review.delete');
    Route::get('review/confirm-delete/{id}', [ReviewController::class, 'getModalDelete'])->name('review.delete.confirm');
    Route::get('review/status/{id}', [ReviewController::class, 'changeStatus'])->name('review.status');
    Route::get('review/confirm-status/{id}', [ReviewController::class, 'getModalStatus'])->name('review.status.confirm');


    // Event
    Route::get('event/list', [EventController::class, 'index'])->name('event.list');
    Route::get('event/data', [EventController::class, 'geteventData'])->name('event.data');
    Route::get('event/create', [EventController::class, 'create'])->name('event.create');
    Route::get('event/view/file/{id}', [EventController::class, 'storageLocationFileDisplay'])->name('event.storage');
    Route::post('event/save', [EventController::class, 'store'])->name('event.store');
    Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::post('event/{id}/update', [EventController::class, 'update'])->name('event.update');
    Route::get('event/delete/{id}', [EventController::class, 'destroy'])->name('event.delete');
    Route::get('event/confirm-delete/{id}', [EventController::class, 'getModalDelete'])->name('event.delete.confirm');
    Route::get('event/{id}/change/status', [EventController::class, 'statusChange'])->name('event.change.status');

    // Customer
    Route::get('member/list', [MemberController::class, 'index'])->name('member.list');
    Route::get('member/data', [MemberController::class, 'getmemberData'])->name('member.data');
    Route::get('member/create', [MemberController::class, 'create'])->name('member.create');
    Route::get('member/view/file/{id}', [MemberController::class, 'storageLocationFileDisplay'])->name('member.storage');
    Route::post('member/save', [MemberController::class, 'store'])->name('member.store');
    Route::get('member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::post('member/{id}/update', [MemberController::class, 'update'])->name('member.update');
    Route::get('member/delete/{id}', [MemberController::class, 'destroy'])->name('member.delete');
    Route::get('member/confirm-delete/{id}', [MemberController::class, 'getModalDelete'])->name('member.delete.confirm');
    Route::get('member/{id}/change/status', [MemberController::class, 'statusChange'])->name('member.change.status');
    Route::get('member/restore/list', [MemberController::class, 'onlyTrashMember'])->name('member.restore.list');
    Route::get('member/restore/{id}/item', [MemberController::class, 'restoreTrashMember'])->name('member.restore.item');
    Route::get('member/permanently-remove/{id}/item', [MemberController::class, 'permanentlyRemoveMember'])->name('member.permanently.remove.item');


    Route::get('member-setting/list', [MemberSettingController::class, 'list'])->name('member-setting.list');
    Route::get('member-setting/edit/{id}', [MemberSettingController::class, 'edit'])->name('member-setting.edit');
    Route::post('member-setting/update/{id}', [MemberSettingController::class, 'update'])->name('member-setting.update');
    
    // Music Genre
    Route::get('genre/list', [MusicGenreController::class, 'index'])->name('genre.list');
    Route::get('genre/data', [MusicGenreController::class, 'getgenreData'])->name('genre.data');
    Route::get('genre/create', [MusicGenreController::class, 'create'])->name('genre.create');
    Route::get('genre/view/file/{id}', [MusicGenreController::class, 'storageLocationFileDisplay'])->name('genre.storage');
    Route::post('genre/save', [MusicGenreController::class, 'store'])->name('genre.store');
    Route::get('genre/{id}/edit', [MusicGenreController::class, 'edit'])->name('genre.edit');
    Route::post('genre/{id}/update', [MusicGenreController::class, 'update'])->name('genre.update');
    Route::get('genre/delete/{id}', [MusicGenreController::class, 'destroy'])->name('genre.delete');
    Route::get('genre/confirm-delete/{id}', [MusicGenreController::class, 'getModalDelete'])->name('genre.delete.confirm');
    Route::get('genre/{id}/change/status', [MusicGenreController::class, 'statusChange'])->name('genre.change.status');

    // Music Category
    Route::get('music-category/list', [MusicCategoryController::class, 'index'])->name('music-category.list');
    Route::get('music-category/data', [MusicCategoryController::class, 'getMusicCategoryData'])->name('music-category.data');
    Route::get('music-category/create', [MusicCategoryController::class, 'create'])->name('music-category.create');
    Route::get('music-category/view/file/{id}', [MusicCategoryController::class, 'storageLocationFileDisplay'])->name('music-category.storage');
    Route::post('music-category/save', [MusicCategoryController::class, 'store'])->name('music-category.store');
    Route::get('music-category/{id}/edit', [MusicCategoryController::class, 'edit'])->name('music-category.edit');
    Route::post('music-category/{id}/update', [MusicCategoryController::class, 'update'])->name('music-category.update');
    Route::get('music-category/delete/{id}', [MusicCategoryController::class, 'destroy'])->name('music-category.delete');
    Route::get('music-category/confirm-delete/{id}', [MusicCategoryController::class, 'getModalDelete'])->name('music-category.delete.confirm');
    Route::get('music-category/{id}/change/status', [MusicCategoryController::class, 'statusChange'])->name('music-category.change.status');


    // Band/ Dj Event Type
    Route::get('band-dj/event/type/list', [BandDjEventTypeController::class, 'index'])->name('banddjeventtype.list');

    Route::get('band-dj/event/type/create', [BandDjEventTypeController::class, 'create'])->name('banddjeventtype.create');
  
    Route::post('band-dj/event/type/save', [BandDjEventTypeController::class, 'store'])->name('banddjeventtype.store');

    Route::get('band-dj/event/type/{id}/edit', [BandDjEventTypeController::class, 'edit'])->name('banddjeventtype.edit');

    Route::post('band-dj/event/type/{id}/update', [BandDjEventTypeController::class, 'update'])->name('banddjeventtype.update');

    Route::get('band-dj/event/type/delete/{id}', [BandDjEventTypeController::class, 'destroy'])->name('banddjeventtype.delete');

    Route::get('band-dj/event/type/confirm-delete/{id}', [BandDjEventTypeController::class, 'getModalDelete'])->name('banddjeventtype.delete.confirm');


    // Band/ Dj Age Group
    Route::get('band-dj/age/group/list', [BandDjAgeGroupController::class, 'index'])->name('banddjagegroup.list');

    Route::get('band-dj/age/group/create', [BandDjAgeGroupController::class, 'create'])->name('banddjagegroup.create');
  
    Route::post('band-dj/age/group/save', [BandDjAgeGroupController::class, 'store'])->name('banddjagegroup.store');

    Route::get('band-dj/age/group/{id}/edit', [BandDjAgeGroupController::class, 'edit'])->name('banddjagegroup.edit');

    Route::post('band-dj/age/group/{id}/update', [BandDjAgeGroupController::class, 'update'])->name('banddjagegroup.update');

    Route::get('band-dj/age/group/delete/{id}', [BandDjAgeGroupController::class, 'destroy'])->name('banddjagegroup.delete');

    Route::get('band-dj/age/group/confirm-delete/{id}', [BandDjAgeGroupController::class, 'getModalDelete'])->name('banddjagegroup.delete.confirm');
    

    // Band/ Dj Book
    Route::get('band-dj/book/list', [BandDjBookController::class, 'index'])->name('banddjbook.list');

    Route::get('band-dj/book/create', [BandDjBookController::class, 'create'])->name('banddjbook.create');
  
    Route::post('band-dj/book/save', [BandDjBookController::class, 'store'])->name('banddjbook.store');

    Route::get('band-dj/book/{id}/edit', [BandDjBookController::class, 'edit'])->name('banddjbook.edit');

    Route::post('band-dj/book/{id}/update', [BandDjBookController::class, 'update'])->name('banddjbook.update');

    Route::get('band-dj/book/delete/{id}', [BandDjBookController::class, 'destroy'])->name('banddjbook.delete');

    Route::get('band-dj/book/confirm-delete/{id}', [BandDjBookController::class, 'getModalDelete'])->name('banddjbook.delete.confirm');

    Route::get('band-dj/book/{id}/cancel-modal', [BandDjBookController::class, 'cancelBookingModal'])->name('banddjbook.cancel.modal');

    Route::get('band-dj/book/{id}/cancel', [BandDjBookController::class, 'cancelBooking'])->name('banddjbook.cancel');


    // Site Settings
    Route::get('site-setting/list', [SiteSettingController::class, 'index'])->name('site-setting.list');

    Route::get('site-setting/create', [SiteSettingController::class, 'create'])->name('site-setting.create');
  
    Route::post('site-setting/save', [SiteSettingController::class, 'store'])->name('site-setting.store');

    Route::get('site-setting/view/file/{id}', [SiteSettingController::class, 'storageLocationFileDisplay'])->name('site-setting.storage');

    Route::get('site-setting/{id}/edit', [SiteSettingController::class, 'edit'])->name('site-setting.edit');

    Route::post('site-setting/{id}/update', [SiteSettingController::class, 'update'])->name('site-setting.update');

    Route::get('site-setting/delete/{id}', [SiteSettingController::class, 'destroy'])->name('site-setting.delete');

    Route::get('site-setting/confirm-delete/{id}', [SiteSettingController::class, 'getModalDelete'])->name('site-setting.delete.confirm');

     // Slider Image
     Route::get('slider-image/list', [SliderImageController::class, 'index'])->name('slider-image.list');

     Route::get('slider-image/create', [SliderImageController::class, 'create'])->name('slider-image.create');
   
     Route::post('slider-image/save', [SliderImageController::class, 'store'])->name('slider-image.store');
 
     Route::get('slider-image/view/file/{id}', [SliderImageController::class, 'storageLocationFileDisplay'])->name('slider-image.storage');
 
     Route::get('slider-image/{id}/edit', [SliderImageController::class, 'edit'])->name('slider-image.edit');
 
     Route::post('slider-image/{id}/update', [SliderImageController::class, 'update'])->name('slider-image.update');
 
     Route::get('slider-image/delete/{id}', [SliderImageController::class, 'destroy'])->name('slider-image.delete');
 
     Route::get('slider-image/confirm-delete/{id}', [SliderImageController::class, 'getModalDelete'])->name('slider-image.delete.confirm');

     Route::get('contact/list', [ContactController::class, 'index'])->name('contact.list');

    
     // Order List
     Route::get('order/pending', [OrderController::class, 'orderPending'])->name('order.pending');
     Route::get('order/success', [OrderController::class, 'orderSuccess'])->name('order.success');
     Route::get('order/cancel', [OrderController::class, 'orderCancel'])->name('order.cancel');
     Route::get('order/{order_id}/details', [OrderController::class, 'orderDetails'])->name('order.details');
     Route::get('order/{order_id}/invoice', [OrderController::class, 'orderInvoice'])->name('invoice.preview');

    Route::get('send/email/{orderID}/invoice', [OrderController::class, 'invoiceSendCustomer'])->name('send.email.invoice.customer');


    // Rate Setting
    Route::get('rate-setting/index', [RateSettingController::class, 'index'])->name('rate-setting.index');
  
    Route::post('rate-setting/save', [RateSettingController::class, 'store'])->name('rate-setting.store');

    // Page Controller
    Route::get('page',  [PageController::class, 'index'])->name('page.list');
    Route::get('page/create', [PageController::class, 'create'])->name('page.create');
    Route::post('page/save', [PageController::class, 'store'])->name('page.store');
    Route::get('page/{id}/edit', [PageController::class, 'edit'])->name('page.edit');
    Route::post('page/{id}/update', [PageController::class, 'update'])->name('page.update');
    Route::get('page/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');
    Route::get('page/confirm-delete/{id}', [PageController::class, 'getModalDelete'])->name('page.delete.confirm');
    Route::get('page/confirm-status/{id}', [PageController::class, 'getModalStatus'])->name('page.status.confirm');
    Route::get('page/{id}/status', [PageController::class, 'statusChange'])->name('page.status');

    // Service Order
    Route::get('service/enquiry', [ServiceOrderController::class, 'serviceEnquiry'])->name('service.inquiry');
    Route::get('service/{id}/enquiry/detail', [ServiceOrderController::class, 'serviceEnquiryDetail'])->name('service.inquiry.detail');
    Route::get('service/{id}/enquiry/status', [ServiceOrderController::class, 'serviceSatusUpdate'])->name('service.inquiry.status');
});

// Frontend Route
Route::get('member/{id}/profile', [MemberRegisterController::class, 'storageLocationFileDisplay'])->name('frontend.member.profile');

Route::get('member/dashboard', [MemberDashboardController::class, 'index'])->name('frontend.member.dashboard');

Route::get('member/{alias}/profile/details', [MemberDashboardController::class, 'memeberProfileDetail'])->name('frontend.member.profile.details');

Route::get('member/{alias}/edit', [MemberDashboardController::class, 'editProfile'])->name('frontend.member.edit');

Route::post('member/upload/profile-image', [MemberDashboardController::class, 'uploadProfileImage'])->name('frontend.member.upload.profile.image');

Route::get('member/upload/profile-image/remove', [MemberDashboardController::class, 'removeProfileImage'])->name('frontend.member.upload.profile.image.remove');


Route::get('member/old/profile/{id}/image', [MemberDashboardController::class, 'storageLocationFileDisplay'])->name('frontend.member.old.profile.image');


Route::post('member/profile-image/update', [MemberDashboardController::class, 'UpdateProfileImage'])->name('frontend.member.profile.image.update');


// Photo Start
Route::get('member/edit/photo', [MemberDashboardController::class, 'editMemberPhoto'])->name('frontend.member.edit.photo');
Route::post('member/update/photo', [MemberDashboardController::class, 'updateMemberPhoto'])->name('frontend.member.update.photo');
Route::get('member/photo/{id}', [MemberDashboardController::class, 'storageLocationFileMemberPhoto'])->name('frontend.member.photo');
// Photo End

// Video Start
Route::get('member/edit/video', [MemberDashboardController::class, 'editMemberVideo'])->name('frontend.member.edit.video');
Route::post('member/update/video', [MemberDashboardController::class, 'updateMemberVideo'])->name('frontend.member.update.video');
Route::get('member/video/{id}', [MemberDashboardController::class, 'storageLocationFileMemberVideo'])->name('frontend.member.video');
// Video End

// Instrument Start
Route::get('member/edit/instrument', [MemberDashboardController::class, 'editMemberInstrument'])->name('frontend.member.edit.instrument');
Route::post('member/update/instrument', [MemberDashboardController::class, 'updateMemberInstrument'])->name('frontend.member.update.instrument');
Route::get('member/instrument/{id}', [MemberDashboardController::class, 'storageLocationFileMemberInstrument'])->name('frontend.member.instrument');
// Instrument End

// Song Start
Route::get('song/submit', [MemberDashboardController::class, 'submitSongForm'])->name('frontend.song.form');
Route::post('song/submit/post', [MemberDashboardController::class, 'submitSongFormPost'])->name('frontend.song.post');

Route::get('member/song/{id}', [MemberDashboardController::class, 'storageLocationFileMemberSong'])->name('frontend.member.song');

Route::get('member/song/lyric/{id}', [MemberDashboardController::class, 'storageLocationFileMemberSongLyric'])->name('frontend.member.song.lyric');

// Song End

Route::post('member/update/data', [MemberDashboardController::class, 'updateMember'])->name('frontend.member.update.data');


Route::get('account/order', [MemberDashboardController::class, 'memberOrderList'])->name('frontend.account.order');


Route::get('account/order/{orderId}/details', [MemberDashboardController::class, 'memberOrderDetails'])->name('frontend.account.order.details');


Route::post('member/send/email/verify/link', [MemberLoginController::class, 'sendMemberEmailVerifyLink'])->name('frontend.member.send.email.verify.link');

Route::post('member/resend/phone/verify/code', [MemberLoginController::class, 'reSendMemberPhoneVerifyCode'])->name('frontend.member.resend.phone.verify.code');

Route::post('member/phone/verify/{phone}', [MemberLoginController::class, 'phoneVerification'])->name('frontend.member.phone.verify');


Route::get('member/send/email/verify/link/view', [MemberLoginController::class, 'sendEmailVerifyView'])->name('frontend.member.email.verify.view');

Route::get('member/reverify/phone', [MemberLoginController::class, 'reVerifyPhone'])->name('frontend.member.reverify.phone');


Route::get('member/{email}/email/verify', [MemberLoginController::class, 'updateMemeberVerify'])->name('frontend.member.email.verify.status');


Route::get('member/forgot/password', [MemberForgotPasswordController::class, 'memberForgotPassword'])->name('frontend.member.forgot.password');


Route::post('member/reset/password', [MemberForgotPasswordController::class, 'sendMemberResetPasswordLink'])->name('frontend.member.reset.password');


Route::get('member/{email}/reset/password', [MemberForgotPasswordController::class, 'memberResetPasswordForm'])->name('frontend.member.reset.password.form');

Route::post('member/{email}/reset/password/post', [MemberForgotPasswordController::class, 'memberResetPasswordPost'])->name('frontend.member.reset.password.post');


Route::get('product/cart', [CartController::class, 'cartPage'])->name('frontend.cart');

Route::get('product/checkout', [CheckoutController::class, 'checkout'])->name('frontend.checkout');

Route::post('product/checkout/payment', [CheckoutController::class, 'payNow'])->name('frontend.payment.now');


Route::get('paypal/success/url', [CheckoutController::class, 'paypalSuccessUrl'])->name('paypal.success.url');


Route::get('paypal/cancel/url', [CheckoutController::class, 'paypalCancelUrl'])->name('paypal.cancel.url');


Route::post('classfied/{id}/add-to-cart', [CartController::class, 'addToCartClassifiedProduct'])->name('frontend.classified.addtocart');

Route::post('cd/{id}/add-to-cart', [CartController::class, 'addToCartCdProduct'])->name('frontend.cd.addtocart');

Route::post('cart/update', [CartController::class, 'updateCart'])->name('frontend.update.cart');

Route::post('cart/remove', [CartController::class, 'removeCart'])->name('frontend.remove.cart');

Route::post('product/{id}/review', [ProductReviewController::class, 'postProductReview'])->name('frontend.product.review');

Route::get('classifed/{alias}/service', [HomeController::class, 'classifiedService'])->name('classified.service.form');


Route::post('classified/{alias}/service/buy', [CheckoutController::class, 'classifiedServiceBuy'])->name('classified.service.buy');

Route::get('classified/service/paypal/success/url', [CheckoutController::class, 'classifiedServicePaypalSuccessUrl'])->name('paypal.classified.service.success.url');


Route::get('classified/service/paypal/cancel/url', [CheckoutController::class, 'classifiedServicePaypalCancelUrl'])->name('paypal.classified.service.cancel.url');

Route::post('classified/service/cancel', [HomeController::class, 'cancelClassifiedService'])->name('classified.service.cancel');

Route::get('radio/listen', [HomeController::class, 'voscastPage'])->name('radio.listen');

Route::get('member/{alias}/upgrade', [HomeController::class, 'memeberUpgrade'])->name('member.upgrade');

Route::get('page/{alias}',[FrontPageController::class, 'pageDetail'])->name('page.detail');
