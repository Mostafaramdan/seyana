<?php
namespace App\Http\Controllers\Apis\Controllers\registerProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers;
use App\Models\images;
use App\Models\sessions;
use App\Models\locations;
use Illuminate\Support\Facades\Hash;
use App\Models\tokens;

class registerProviderController extends index
{
    public static function api()
    {
        $request = self::$request;
        if($request->location){
            $location = locations::create($request->location);
        }
        $create = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'locations_id'=>$location->id??null,
            'city_id'=>$request->cityId,
            'password'=>Hash::make($request->password),
            'apiToken'=>helper::UniqueRandomXChar(70,['users','providers']),
            'fireBaseToken'=>$request->fireBaseToken,
            'lang'=>$request->lang??'ar',
            'front_identity_images_id'=>images::create(['image'=>helper::base64_image($request->identityImages[0],'providers')])->id,
            'back_identity_images_id'=>images::create(['image'=>helper::base64_image($request->identityImages[1],'providers')])->id

        ]; 
        if($request->image){
            $create['images_id']=images::create(['image'=>helper::base64_image($request->image,'providers')])->id;
        }

        $record= providers::create($create);
        $session = sessions::createUpdate([
                $record->getTable().'_id' =>$record->id,
                // 'code'=>helper::RandomXDigits(5)
                'code'=>1234
            ]);
        helper::sendSms( $record->phone, $session->code );
        $token = helper::UniqueRandomXChar(69,'apiToken');
        tokens::create([
            'apiToken'=>$token,
            $record->getTable().'_id'=>$record->id,
            'created_at'=>date('Y-m-d H:i:s')
        ]);
        $record['apiToken']=$token;

        return [
            'status'=>200,
            'message'=>self::$messages['register']["200"],
            'account'=>objects::account($record)
        ];
    }
}