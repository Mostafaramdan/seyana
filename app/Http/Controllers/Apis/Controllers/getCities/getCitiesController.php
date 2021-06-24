<?php
namespace App\Http\Controllers\Apis\Controllers\getCities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\regions;

class getCitiesController extends index
{
    public static function api()
    {
        $records=  regions::where('is_active',1)
                        ->when(self::$request->countryId ,function($q){
                            $q->where('countries_id',self::$request->countryId);
                        })
                        ->when(self::$request->countryCode ,function($q){
                            $q->whereHas('country',function($q){
                                $q->where('call_key',self::$request->countryCode);
                            });
                        })
                        ->get();
        return [
            "status"=>$records->count()?200:204,
            "cities"=>objects::ArrayOfObjects($records,"city"),
        ];
    }
}
