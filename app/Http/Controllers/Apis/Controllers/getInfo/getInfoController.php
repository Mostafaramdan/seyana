<?php
namespace App\Http\Controllers\Apis\Controllers\getInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\app_settings;
use App\Models\regions;

class getInfoController extends index
{
    public static function api()
    {
        if(self::$request->districtId)
            $record=  app_settings::where('countries_id',regions::find(self::$request->districtId)->region->countries_id)->first();
       else 
            $record=  app_settings::first();

        return [
            "status"=>$record?200:204,
            "info"=>!$record?:objects::info($record)
        ];
    }
}