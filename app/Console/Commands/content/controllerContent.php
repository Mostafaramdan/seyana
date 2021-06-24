<?php

namespace App\Console\Commands\content;

class controllerContent
{

public static function index ( $fileName){

return
'<?php
namespace App\Http\Controllers\Apis\Controllers\\'.$fileName.';

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\ModelName;

class '.$fileName.'Controller extends index
{
    public static function api(){

        $records=  ModelName::where("is_active",1);
        $data= helper::get($records);
        return [
            "status"=>$data[2],
            "totalPages"=>$data[1],
            "providers"=>objects::ArrayOfObjects($data[0]->forPage(self::$request->page+1,self::$itemPerPage),"provider"),
        ];
    }
}';
   }
}
