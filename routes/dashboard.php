<?php

use Illuminate\Support\Facades\Route;

Route::ANY('/login',[App\Http\Controllers\dashboard\login::class, 'login']);
Route::get('/toggle/{table}/{column}/{id}',[App\Http\Controllers\dashboard\dashboard::class, 'toggle']);
Route::get('/dropdown/{table}/',[App\Http\Controllers\dashboard\dashboard::class, 'dropdown']);
Route::get('/dropdown/districts/{table}/',[App\Http\Controllers\dashboard\dashboard::class, 'dropdownDistricts']);

Route::resource('services',services::class);
Route::resource('categories',categories::class);
Route::resource('users',users::class);
Route::resource('providers',providers::class);
Route::resource('app_settings',app_settings::class);
Route::resource('admins',admins::class);
Route::resource('regions',regions::class);
Route::resource('countries',countries::class);
Route::resource('orders',orders::class);
Route::resource('contacts',contacts::class);
Route::resource('notifications',notifications::class);
Route::resource('statistics',statistics::class);
Route::resource('currencies',currencies::class);
Route::resource('companies',companies::class);
Route::resource('vouchers',vouchers::class);
// Route::get('/getAllAttachments',[App\Http\Controllers\dashboard\attachments::class, 'getAll']);
Route::get('/permissions',[App\Http\Controllers\dashboard\dashboard::class, 'permissions']);
Route::post('/permissions/{admin}',[App\Http\Controllers\dashboard\dashboard::class, 'setPermissions']);

route::post('test',function(){
    return App\Models\admins::all();
});