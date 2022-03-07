<?php
namespace App\Http\Controllers\Apis\Controllers\deleteCategory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers_categories;

class deleteCategoryController extends index
{
    public static function api(){

        $records=  providers_categories::destroy(self::$request->id);
        return [
            "status"=>200
        ];
    }
}