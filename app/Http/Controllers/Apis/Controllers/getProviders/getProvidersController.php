<?php
namespace App\Http\Controllers\Apis\Controllers\getProviders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers;

class getProvidersController extends index
{
    public static function api()
    {
        $categoryIds = array_map('intval', [self::$request->categoryId]);
        $records=  providers::where('is_active',1)
                            ->whereJsonContains('categories_ids',$categoryIds)
                        ;
        $data= helper::get($records);
        return [
            "status"=>$data[2],
            "totalPages"=>$data[1],
            "providers"=>objects::ArrayOfObjects($data[0]->forPage(self::$request->page+1,self::$itemPerPage),"provider"),
        ];
    }
}
