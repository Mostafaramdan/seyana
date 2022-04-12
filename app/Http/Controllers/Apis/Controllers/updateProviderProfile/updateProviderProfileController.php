<?php
namespace App\Http\Controllers\Apis\Controllers\updateProviderProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\ModelName;

class updateProviderProfileController extends index
{
    public static function api(){

        $request = self::$request;
        if($request->location){
            $location = locations::create($request->location);
        }
        $record= self::$account::update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'locations_id'=>$location->id??null,
            'city_id'=>$request->cityId,
            'password'=>Hash::make($request->password),
            'apiToken'=>helper::UniqueRandomXChar(70,['users','providers']),
            'images_id'=>images::create(['image'=>helper::base64_image($request->image,'providers')])->id,
            'fireBaseToken'=>$request->fireBaseToken,
            'lang'=>$request->lang??'ar',
            'front_identity_images_id'=>images::create(['image'=>helper::base64_image($request->identityImages[0],'providers')])->id,
            'back_identity_images_id'=>images::create(['image'=>helper::base64_image($request->identityImages[1],'providers')])->id

        ]);
        $session = sessions::createUpdate([
                $record->getTable().'_id' =>$record->id,
                // 'code'=>helper::RandomXDigits(5)
                'code'=>helper::RandomXDigits(4)
            ]);
        helper::sendSms( $record->phone, $session->code );
    }
}