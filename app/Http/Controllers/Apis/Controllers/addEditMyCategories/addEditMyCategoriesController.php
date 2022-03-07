<?php
namespace App\Http\Controllers\Apis\Controllers\addEditMyCategories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers_categories;
use App\Models\images;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class addEditMyCategoriesController extends index
{
    public static function api()
    {
        providers_categories::where('providers_id',self::$account->id)->delete();
        foreach(self::$request->categories as $category){
            $images_ides=[];
            foreach($category['images']?? []  as $image) {
                $images_ides[]= images::create(['image'=>helper::base64_image($image,'providers_categories')])->id;
            }

            providers_categories::create([
                'description'=>$category['description']??'',
                'categories_id'=>$category['categoryId'],
                'providers_id'=>self::$account->id,
                'images' => json_encode($images_ides??[])
            ]);
        }
        return [
            "status"=>200,
        ];
    }
}