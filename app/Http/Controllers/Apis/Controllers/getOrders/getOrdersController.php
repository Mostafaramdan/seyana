<?php
namespace App\Http\Controllers\Apis\Controllers\getOrders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\orders;

class getOrdersController extends index
{
    public static function api()
    {
        $records=  orders::where(self::$account->getTable()."_id",self::$account->id)
                            ->when(self::$request->status,function($q){
                                $q->whereIn('status',self::$request->status);
                            })
                            ->get();
        return [
            "status"=>$records->forPage(self::$request->page+1,self::$itemPerPage)->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "orders"=>objects::ArrayOfObjects($records->forPage(self::$request->page+1,self::$itemPerPage),"order"),
        ];
    }
}
