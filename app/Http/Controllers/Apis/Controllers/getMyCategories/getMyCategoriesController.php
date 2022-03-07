<?php
namespace App\Http\Controllers\Apis\Controllers\getMyCategories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers_categories;

class getMyCategoriesController extends index
{
    public static function api()
    {
        $records= providers_categories::where('providers_id',self::$request->providerId??self::$account->id)->get();
        return [
            "status"=>$records->count()>0 ? 200:204,
            "categories"=>objects::ArrayOfObjects($records,"category_provider"),
        ];
    }
}