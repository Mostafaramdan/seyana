<?php
namespace App\Http\Controllers\Apis\Controllers\makeOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\orders;
use App\Models\carts;
use App\Models\images;
use App\Models\locations;
use App\Models\code_used;
use App\Models\providers;
use App\Models\reviews;

class makeOrderController extends index
{
    public static function api()
    {   
        $images=[];
        $location = locations::create(self::$request->location);
        foreach(self::$request->images??[] as $image){
            $img = images::create([
                'image'=>helper::base64_image( $image , 'services'),
            ]);
            $images[]=$img->id;
        }
        if(self::$request->voucherId){
            code_used::create([
                'users_id'=>self::$account->id,
                'vouchers_id'=>self::$request->voucherId,
                'created_at'=>date('now'),
            ]);
        }
        $record=  orders::create([
            'fees'=>self::$account->fees,
            'users_id'=>self::$account->id,
            'date'=>date('Y-m-d'),
            'time'=>date('H:i:s'),
            'materials'=>self::$request->materials,
            'description'=>self::$request->description,
            'vouchers_id'=>self::$request->voucherId,
            'providers_id'=>self::$request->providerId,
            'images'=>json_encode($images),
            'locations_id'=>$location->id,
            'created_at'=>date('Y-m-d H:i:s'),
        ]);
        foreach(self::$request->services as $service){
            $records=  carts::create([
                'services_id'=>$service['id']??null,
                'quantity'=>$service['quantity']??1,
                'description'=>$service['description']??'',
                'price'=>$service['price']??0,
                'orders_id'=>$record->id,
            ]);
        }
        return [
            "status"=>200,
        ];
    }
}
