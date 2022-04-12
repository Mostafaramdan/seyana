<?php
namespace App\Http\Controllers\Apis\Controllers\search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;
use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Models\providers;
use App\Models\app_settings;
use Illuminate\Support\Arr;

class searchController extends index
{
    public static  $records;
    public static function api()
    {
        self::$records=  providers::query();
        self::$request->search?  self::search() :null;
        self::$request->districtId?  self::filterByCity() :null;// filter by city
        self::$request->rate?  self::filterByRate() :null;// filter by rate
        self::$request->isCompanyProvider ?  self::isCompanyProvider() :null;// filter by rate
        // self::$request->location ?  self::filterByNearset() :null;// filter by rate

        self::$request->categoryIds?  self::filterByCategories() :null;// filter by category
        self::sort() ;// sort by and sort type

        $response = self::get();
        return [
            "status"=>$response[1],
            "totalPages"=>$response[0],
            "providers"=>objects::ArrayOfObjects(self::$records,"provider"),
        ];
    }

    public static function search()
    {
            self::$records->where(function($q){
                $search = self::$request->search;
                return $q->where('name'  ,'like', '%'.$search.'%')
                    ->orWhere('email','like', '%'.$search.'%')
                    ->orWhere('phone','like', '%'.$search.'%');
            });
    }

    public static function filterByCategories()
    {
        self::$records->whereHas('providers_categories',function($q){
            return $q->whereIn('categories_id',self::$request->categoryIds);
        });
    }
    public static function filterByRate()
    {
        self::$records->whereHas('reviews', function ($query)  {
            $query->Where('rate',self::$request->rate);
        });
    }
    public static function isCompanyProvider()
    {
        self::$records->whereHas('company',function($q){
            return $q;
        });
    }

    public static function filterByCity()
    {
        self::$records->where('regions_id', self::$request->districtId);
    }
    public static function filterByNearset()
    {
        if(self::$account->region && self::$request->location)
            self::$records->with('location')->whereHas('location',function($q){
                $distance = app_settings::where('countries_id',self::$account->region->countries_id??'')->first()->distance??1000;
                $lat= self::$request->location['latitude'];
                $lng= self::$request->location['longitude'];
                return $q->select(['*',\DB::raw('( 0.621371 * 3959 * acos( cos( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians(latitude) ) ) ) AS distance')])
                        ->havingRaw('distance <= '. $distance);
            });
    }

    public static function sort()
    {
        if(self::$request->sortBy=='rate'){
            self::$records->withCount(['reviews as average_rating' => function($query) {
                        $query->select(\DB::raw('coalesce(avg(rate),0)'));
                    }])
                    ->orderBy('average_rating',self::$request->sortType??"DESC");
        }else
            self::$records->orderBy('id', self::$request->sortType??"DESC");

    }

    public static function get()
    {
        $totalPages=ceil(self::$records->count()/self::$itemPerPage);
        self::$records = self::$records->forPage(self::$request->page+1,self::$itemPerPage)->get();
        $status = self::$records->count()?200:204;
        return [$totalPages,$status ];
    }
}
