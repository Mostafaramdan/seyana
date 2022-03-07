<?php
namespace App\Http\Controllers\Apis\Controllers\getCurrencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\currencies;

class getCurrenciesController extends index
{
    public static function api()
    {
        $records=  currencies::where('is_active',1)->get();
        return [
            "status"=>$records->count()?200:204,
            "currencies"=>objects::ArrayOfObjects($records,"currency"),
        ];
    }
}
