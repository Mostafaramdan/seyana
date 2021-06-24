<?php
namespace App\Http\Controllers\Apis\Controllers\getServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\services;

class getServicesController extends index
{
    public static function api()
    {
        $records=  services::where('is_active',1)
                        ->where('categories_id',self::$request->categoryId)
                        ;
        $data= $records->get();
        return [
            "status"=>$data->count()? 200: 204,
            "count"=>$data->count(),
            "services"=>objects::ArrayOfObjects($data,"service"),
        ];
    }
}
