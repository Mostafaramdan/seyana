<?php
namespace App\Http\Controllers\Apis\Controllers\setCurrency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

class setCurrencyController extends index
{
    public static function api()
    {
        self::$account->currencies_id= self::$request->currencyId;
        self::$account->save();
        return [
            "status"=>200,
        ];
    }
}
