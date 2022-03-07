<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Controllers\testApi\testApiController;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('/image',App\Http\Controllers\dashboard\uploadImage::class);

Route::ANY('/register',[index::class, 'index']);
Route::ANY('/forgetPassword',[index::class, 'index']);
Route::ANY('/validateCode',[index::class, 'index']);
Route::ANY('/resendCode',[index::class, 'index']);
Route::ANY('/updatePassword',[index::class, 'index']);
Route::ANY('/login',[index::class, 'index']);
Route::ANY('/logout',[index::class, 'index']);
Route::ANY('/updateProfile',[index::class, 'index']);
Route::ANY('/unseenNotifications',[index::class, 'index']);
Route::ANY('/notifications',[index::class, 'index']);
Route::ANY('/changePassword',[index::class, 'index']);
Route::ANY('/contactUs',[index::class, 'index']);
Route::ANY('/getRegions',[index::class, 'index']);
Route::ANY('/getInfo',[index::class, 'index']);
Route::ANY('/getCategories',[index::class, 'index']);
Route::ANY('/setMyLocation',[index::class, 'index']);
Route::ANY('/getMyLocation',[index::class, 'index']);
Route::ANY('/getOffers',[index::class, 'index']);
Route::ANY('/getRecommended',[index::class, 'index']);
Route::ANY('/getMyLocation',[index::class, 'index']);
Route::ANY('/search',[index::class, 'index']);
Route::ANY('/getReviews',[index::class, 'index']);
Route::ANY('/addReviews',[index::class, 'index']);
Route::ANY('/addOrder',[index::class, 'index']);
Route::ANY('/getOrders',[index::class, 'index']);
Route::ANY('/getOrderInfo',[index::class, 'index']);
Route::ANY('/getProfile',[index::class, 'index']);
Route::ANY('/updateFireBaseToken',[index::class, 'index']);
Route::ANY('/loginBySocialToken',[index::class, 'index']);
Route::ANY('/registerBySocialToken',[index::class, 'index']);
Route::ANY('/getCountries',[index::class, 'index']);
Route::ANY('/getCities',[index::class, 'index']);
Route::ANY('/getDistricts',[index::class, 'index']);
Route::ANY('/addToFavourite',[index::class, 'index']);
Route::ANY('/getMyFavorites',[index::class, 'index']);
Route::ANY('/getProviders',[index::class, 'index']);
Route::ANY('/getServices',[index::class, 'index']);
Route::ANY('/makeOrder',[index::class, 'index']);
Route::ANY('/editOrder',[index::class, 'index']);
Route::ANY('/checkVoucher',[index::class, 'index']);
Route::ANY('/getCurrencies',[index::class, 'index']);
Route::ANY('/setCurrency',[index::class, 'index']);
Route::ANY('/getsuggestions',[index::class, 'index']);
Route::ANY('/registerProvider',[index::class, 'index']);
Route::ANY('/getMyCategories',[index::class, 'index']);
Route::ANY('/addEditMyCategories',[index::class, 'index']);
Route::ANY('/acceptOrder',[index::class, 'index']);
Route::ANY('/refuseOrder',[index::class, 'index']);
Route::ANY('/finishOrder',[index::class, 'index']);
Route::ANY('/addServiceToOrder',[index::class, 'index']);
Route::ANY('/updateProviderProfile',[index::class, 'index']);
Route::ANY('/deleteCategory',[index::class, 'index']);