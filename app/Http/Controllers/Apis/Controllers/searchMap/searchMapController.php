<?php
namespace App\Http\Controllers\Apis\Controllers\searchMap;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers;
use App\Models\app_settings;
use Illuminate\Support\Arr;

class searchMapController extends index
{
    public static  $records;
    public static function api()
    {
         
        $records = providers::when(self::$request->countryId,function($q){
            return $q->whereHas('region',function($q){
                return $q->whereHas('region',function($q){
                    return $q->where('countries_id',self::$request->countryId);
                });
            });
        })
        ->get();
        $providers= objects::ArrayOfObjects($records,"providerMin");
        return [
            "providers"=> $providers
        ];
    }
   
}