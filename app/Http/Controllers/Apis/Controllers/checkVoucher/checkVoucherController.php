<?php
namespace App\Http\Controllers\Apis\Controllers\checkVoucher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\vouchers;
use App\Models\code_used;
use App\Models\orders;

class checkVoucherController extends index
{
    public static function api()
    {
        $record=  vouchers::where("code",self::$request->code)->first();
        $date =   strtotime(date('Y-m-d'));
        if($record->start_at <= $date && $record->end_at < $date){
            return [
                "status"=>411,
                "message"=>'Expired code',
            ];
        }
        if(code_used::where('users_id',self::$account->id)->where('vouchers_id',$record->id)->count()){
            return [
                "status"=>412,
                "message"=>'you have used this code before .',
            ];
        }
        $orderCount = orders::where('users_id',self::$account->id)->where('status','finished')->count();
        if($record->number_of_orders >  $orderCount){
            return [
                "status"=>413,
                "message"=>"you must reach to ".$record->number_of_orders." finished orders to get this voucher.",
                'yourOrder'=>$orderCount
            ];

        }
        return [
            "status"=>200,
            "voucherId"=>$record->id,
        ];
    }
}
