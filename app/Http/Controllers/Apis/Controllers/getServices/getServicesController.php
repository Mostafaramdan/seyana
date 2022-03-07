<?php
namespace App\Http\Controllers\Apis\Controllers\getServices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\services;
use App\Models\providers;

class getServicesController extends index
{
    public static function api()
    {
        $records=  services::where('is_active',1)
                        ->when(self::$request->categoryId,function($q){
                            return $q->where('categories_id',self::$request->categoryId);
                        })
                        ->when(self::$request->providerId,function($q){
                            return $q->whereIn('categories_id',json_decode(providers::find(self::$request->providerId)->categories_ids,true )  );
                        })
                ;
        $data= $records->get();
        return [
            "status"=>$data->count()? 200: 204,
            "count"=>$data->count(),
            "services"=>objects::ArrayOfObjects($data,"service"),
        ];
    }
}
