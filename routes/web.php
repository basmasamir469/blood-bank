<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MainController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\ClientController;
use App\Http\Controllers\Front\DonationController;

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


Auth::routes();

// front
Route::group(['namespace'=>'Front'],function(){
    Route::get('/',[MainController::class,'home'])->name('front-home');
    Route::get('/aboutus',[MainController::class,'about'])->name('about-us');
    Route::get('/contactus',[MainController::class,'contactus'])->name('contact-us');
    Route::post('/contact',[MainController::class,'contact'])->name('contact');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/store',[AuthController::class,'store'])->name('store');
    Route::get('/signin',[AuthController::class,'signin'])->name('signin');
    Route::post('/front-login',[AuthController::class,'login'])->name('front-login');
    // forget password page
    Route::get('/forgetpassword',[AuthController::class,'forgetpassword'])->name('forget-password');
    // send code
    Route::post('/resetpassword',[AuthController::class,'reset'])->name('reset-password');
    // reset password page
    Route::get('/changepassword',[AuthController::class,'changepassword'])->name('change-password');
    // confirm password
    Route::post('/newpassword',[AuthController::class,'newpassword'])->name('confirm-password');
    Route::post('/searchdonations',[DonationController::class,'search'])->name('search');
    Route::get('/donations',[DonationController::class,'index'])->name('donation_requests');
    Route::get('/donation/{id}',[DonationController::class,'show'])->name('donation-details');
    Route::get('/post-details/{id}',[PostController::class,'show'])->name('post-details');
    Route::get('/allposts',[PostController::class,'posts'])->name('posts');


    // Route::get('/front-logout',[AuthController::class,'destroy'])->name('front-logout');
    // Route::get('/profile',[ClientController::class,'profile'])->name('myprofile');
    // Route::patch('/updateprofile',[ClientController::class,'updateProfile'])->name('updateprofile');

});

Route::group(['namespace'=>'Front','middleware'=>'auth:front'],function(){
    Route::get('/front-logout',[AuthController::class,'destroy'])->name('front-logout');
    Route::get('/profile',[ClientController::class,'profile'])->name('myprofile');
    Route::patch('/updateprofile',[ClientController::class,'updateProfile'])->name('updateprofile');
    Route::post('/togglefav', [PostController::class, 'toggleFavourite'])->name('togglefav');
    Route::get('/favouriteposts', [PostController::class, 'favourites']);
    Route::get('/createrequest',[DonationController::class,'create'])->name('create-request');
    Route::post('/sendrequest',[DonationController::class,'store'])->name('send-request');
    Route::get('/notifiSettings',[MainController::class,'notificationsettings'])->name('notification-settings');
    Route::Patch('/notifiSettings',[MainController::class,'notificationsettings'])->name('notification-settings');


});

// admin dashboard
Route::group(['middleware'=>['auth:web','AutoCheckPermission'],'prefix'=>'admin'],function(){
    Route::get('/dashboard', function () {
        return view('home');
    });    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/editsettings', [App\Http\Controllers\HomeController::class, 'edit'])->name('settings.edit');
Route::patch('/updatesettings', [App\Http\Controllers\HomeController::class, 'update'])->name('settings.update');
Route::resource('/governorates', App\Http\Controllers\GovernorateController::class);
Route::resource('/cities', App\Http\Controllers\CityController::class);
Route::resource('/categories', App\Http\Controllers\CategoryController::class);
Route::resource('/posts', App\Http\Controllers\PostController::class);
Route::resource('/clients', App\Http\Controllers\ClientController::class);
Route::resource('/contacts', App\Http\Controllers\ContactController::class);
Route::resource('/donations', App\Http\Controllers\DonationController::class);
Route::resource('/roles','App\Http\Controllers\RoleController');
Route::resource('/users','App\Http\Controllers\UserController');
Route::get('/changepassword', [App\Http\Controllers\UserController::class,'changePassword'])->name('change_password');
Route::patch('/updatepassword', [App\Http\Controllers\UserController::class,'updatePassword'])->name('update_password');
Route::get('/contactsearch', [App\Http\Controllers\ContactController::class,'search'])->name('contacts.search');
Route::get('/changestatus', [App\Http\Controllers\ClientController::class,'changestatus']);
Route::get('/clientsearch', [App\Http\Controllers\ClientController::class,'search'])->name('clients.search');
Route::get('/donationsearch', [App\Http\Controllers\DonationController::class,'search'])->name('donations.search');


});






