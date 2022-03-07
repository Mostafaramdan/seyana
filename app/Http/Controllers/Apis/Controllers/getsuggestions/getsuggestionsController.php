<?php
namespace App\Http\Controllers\Apis\Controllers\getsuggestions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers;

class getsuggestionsController extends index
{
    public static function api(){

        $records=  providers::where("is_active",1);
        $data= helper::get($records);
        return [
            "status"=>$data[2],
            "totalPages"=>$data[1],
            "providers"=>objects::ArrayOfObjects($data[0]->forPage(self::$request->page+1,self::$itemPerPage),"provider"),
        ];
    }
}