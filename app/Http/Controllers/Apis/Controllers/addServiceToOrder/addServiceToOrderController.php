<?php
namespace App\Http\Controllers\Apis\Controllers\addServiceToOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\carts;

class addServiceToOrderController extends index
{
    public static function api()
    {
        $records=  carts::create([
            'services_id'=>self::$request->service['id']??null,
            'quantity'=>self::$request->service['quantity']??1,
            'price'=>self::$request->service['price']??0,
            'orders_id'=>self::$request->orderId,
        ]);
        return [
            "status"=>200,
        ];
    }
}