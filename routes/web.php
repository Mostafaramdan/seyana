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
route::get('/export/exportUsers',[App\Http\Controllers\dashboard\dashboard::class,'exportUsers']);
route::get('/export/exportProviders',[App\Http\Controllers\dashboard\dashboard::class,'exportProviders']);
route::get('/export/exportCompanies',[App\Http\Controllers\dashboard\dashboard::class,'exportCompanies']);
route::get('/export/exportServices',[App\Http\Controllers\dashboard\dashboard::class,'exportServices']);
route::get('/export/exportCategories',[App\Http\Controllers\dashboard\dashboard::class,'exportCategories']);