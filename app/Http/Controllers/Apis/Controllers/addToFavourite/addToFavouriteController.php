<?php
namespace App\Http\Controllers\Apis\Controllers\addToFavourite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\favourites;

class addToFavouriteController extends index
{
    public static function api()
    {
        if(favourites::where('users_id',self::$account->id)->where('providers_id',self::$request->providerId)->count()){
            favourites::where('users_id',self::$account->id)->where('providers_id',self::$request->providerId)->delete();
            $action = 'unfavourite';
        }else{
            favourites::create([
                'users_id'=>self::$account->id,
                'providers_id'=>self::$request->providerId
            ]);
            $action = 'favourite';
        }
        return [
            "status"=>200,
            'action'=>$action
        ];
    }
}
