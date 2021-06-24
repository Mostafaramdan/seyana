<?php
namespace App\Http\Controllers\Apis\Controllers\registerBySocialToken;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\users;
use App\Models\providers;
use App\Models\images;

class registerBySocialTokenController extends index
{
    public static function api()
    {
        $request=self::$request;
        $model = 'App\Models\\'.$request->type;
        $create=[
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'lang'=>$request->lang??'en',
            'fireBaseToken'=>$request->fireBaseToken,
            'apiToken'=>helper::UniqueRandomXChar(70,['users','providers']),
        ];
        if($request->imageSocial){
            $create['images_id']=(images::create(['image'=>$request->imageSocial]))->id;
        }
        $record=  $model::create($create);
        $record->is_verified=1;
        $record->save();
        return [
            "status"=>200,
            'account'=>objects::account( $record)
        ];

    }
}
