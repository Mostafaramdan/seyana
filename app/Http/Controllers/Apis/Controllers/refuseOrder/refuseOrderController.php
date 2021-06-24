<?php
namespace App\Http\Controllers\Apis\Controllers\refuseOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\orders;

class refuseOrderController extends index
{
    public static function api()
    {
        orders::where('id',self::$request->orderId)->update(['status'=>'refused']);
        return [
            "status"=>200
        ];
    }
}