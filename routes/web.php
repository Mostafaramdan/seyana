<?php

use Illuminate\Support\Facades\Route;


Route::view('/','welcome');
Route::view('/dashboard','welcome');
Route::view('/dashboard/{a}','welcome');
Route::view('/dashboard/{a}/{b}','welcome');
Route::view('/dashboard/{a}/{b}/{c}','welcome');
Route::view('/dashboard/{a}/{b}/{c}/{d}','welcome');

route::get('/docs-api',[App\Http\Controllers\Controller::class,'docs']);
route::get('/api/json_download',[App\Http\Controllers\Controller::class,'download'])->name('postman');
route::get('/download-orders',[App\Http\Controllers\dashboard\orders::class,'downloadOrders']);
route::view('masterCard','masterCard');
