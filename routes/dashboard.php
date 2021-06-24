<?php

use Illuminate\Support\Facades\Route;

Route::ANY('/login',[App\Http\Controllers\dashboard\login::class, 'login']);
Route::get('/toggle/{table}/{column}/{id}',[App\Http\Controllers\dashboard\dashboard::class, 'toggle']);
Route::get('/dropdown/{table}/',[App\Http\Controllers\dashboard\dashboard::class, 'dropdown']);

Route::apiResource('services',services::class);
Route::apiResource('categories',categories::class);
Route::apiResource('users',users::class);
Route::apiResource('providers',providers::class);
Route::apiResource('app_settings',app_settings::class);
Route::apiResource('admins',admins::class);
Route::apiResource('regions',regions::class);
Route::apiResource('countries',countries::class);
Route::apiResource('orders',orders::class);
Route::apiResource('contacts',contacts::class);
Route::apiResource('notifications',notifications::class);
Route::apiResource('statistics',statistics::class);
Route::apiResource('currencies',currencies::class);
Route::apiResource('companies',companies::class);
Route::apiResource('vouchers',vouchers::class);
Route::get('/getAllAttachments',[App\Http\Controllers\dashboard\attachments::class, 'getAll']);
Route::get('/permissions',[App\Http\Controllers\dashboard\dashboard::class, 'permissions']);
Route::post('/permissions/{admin}',[App\Http\Controllers\dashboard\dashboard::class, 'setPermissions']);

