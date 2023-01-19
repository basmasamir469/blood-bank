<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\DonationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix'=>'v1','namespace'=>'Api'],function(){
 Route::get('/governorates', [MainController::class, 'governorates']);
 Route::get('/cities', [MainController::class, 'cities']);
 Route::post('/register', [AuthController::class, 'register']);
 Route::post('/login', [AuthController::class, 'login']);
 Route::post('/resetpassword', [AuthController::class, 'reset']);
 Route::post('/newpassword', [AuthController::class, 'newpassword']);
 Route::post('/contactus', [MainController::class, 'contactus']);
 Route::get('/categories', [PostController::class, 'categories']);
 Route::post('/category', [PostController::class, 'storeCategory']);
 Route::get('/bloodtypes', [MainController::class, 'bloodTypes']);

});
Route::group(['prefix'=>'v1','namespace'=>'Api','middleware'=>'auth:api'],function(){
    Route::get('/posts', [PostController::class, 'posts']);
    Route::get('/post/{id}', [PostController::class, 'show']);
    Route::post('/togglefavourite', [PostController::class, 'toggleFavourite']);
    Route::get('/favourites', [PostController::class, 'favourites']);
    Route::get('/settings', [MainController::class, 'settings']);
    Route::get('/myprofile', [ClientController::class, 'profile']);
    Route::post('/send_donation_request', [DonationController::class, 'store']);
    Route::get('/donation_requests', [DonationController::class, 'index']);
    Route::get('/notifications', [DonationController::class, 'notifications']);
    Route::post('/updateprofile', [ClientController::class, 'updateProfile']);
    Route::post('/notificationSettings', [MainController::class,'notificationSettings']);
    Route::get('/notificationSettings', [MainController::class,'notificationSettings']);
    Route::post('/registertoken', [AuthController::class, 'registerToken']);

});
