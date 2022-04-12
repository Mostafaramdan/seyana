<?php
namespace App\Http\Controllers\Apis\Controllers\finishOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\orders;
use App\Models\providers;

class finishOrderController extends index
{
    public static function api()
    {
        $order= orders::find(self::$request->orderId);
        $provider= $order->provider;
        $order->update(['status'=>'finished']);
        $provider->update(['balance'=>$order->provider->balance+$order->carts->sum('price')]);   
        return [
            "status"=>200
        ];
    }
}