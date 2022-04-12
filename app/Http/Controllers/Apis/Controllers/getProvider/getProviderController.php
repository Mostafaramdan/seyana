<?php
namespace App\Http\Controllers\Apis\Controllers\getProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers;

class getProviderController extends index
{
    public static function api()
    {
        $record =  providers::find(self::$request->providerId);
        return [
            "status"=>200,
            "provider"=>objects::provider($record),
        ];
    }
}