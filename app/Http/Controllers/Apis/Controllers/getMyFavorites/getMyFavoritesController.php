<?php
namespace App\Http\Controllers\Apis\Controllers\getMyFavorites;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers;

class getMyFavoritesController extends index
{
    public static function api()
    {
        $records=  providers::whereHas('favourites',function($q){
                            // return $q->where('users_id',self::$account->id);
                        })
                        ->get();
        return [
            "status"=>$records->forPage(self::$request->page+1,self::$itemPerPage)->count()?200:204,
            "totalPages"=>ceil($records->count()/self::$itemPerPage),
            "providers"=>objects::ArrayOfObjects($records->forPage(self::$request->page+1,self::$itemPerPage),"provider"),
        ];
    }
}
