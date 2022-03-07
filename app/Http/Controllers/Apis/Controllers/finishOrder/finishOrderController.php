<?php
namespace App\Http\Controllers\Apis\Controllers\finishOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\orders;

class finishOrderController extends index
{
    public static function api()
    {
        orders::where('id',self::$request->orderId)->update(['status'=>'finished']);
        return [
            "status"=>200
        ];
    }
}