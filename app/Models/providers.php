<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Apis\Helper\helper ;
use App\Http\Controllers\Apis\Controllers\index;

class providers extends Model
{
    public $timestamps = false;
    protected $table= 'providers', $appends=["session",'categories','images','distance' ],$guarded =[];

    function GetImagesAttribute()
    {
        if($this->attributes['images']??'')
            return images::find(json_decode($this->attributes['images'],true));
    }
    function GetSessionAttribute(){
        return count($this->sessions)>0 ? $this->sessions->first():null;
    }
    public function sessions(){
        return $this->hasMany(sessions::class,'providers_id');
    }
    public function region(){
        return $this->belongsTo(regions::class,'regions_id');
    }
    public function currency(){
        return $this->belongsTo(currencies::class,'currencies_id');
    }
    public function city(){
        return $this->belongsTo(regions::class,'city_id');
    }
    public function company(){
        return $this->belongsTo(companies::class,'companies_id');
    }
    public function location(){
        return $this->belongsTo(locations::class,'locations_id');
    }
    public function reviews(){
        return $this->hasMany(reviews::class,'providers_id');
    }
    public function front_identity()
    {
        return $this->belongsTo(images::class,'front_identity_images_id');
    }
    public function image()
    {
        return $this->belongsTo(images::class,'images_id');
    }
    public function back_identity(){
        return $this->belongsTo(images::class,'back_identity_images_id');
    }
    function providers_categories()
    {
        return $this->hasMany(providers_categories::class,'providers_id');
    }
    public function favourites(){
        return $this->hasMany(favourites::class,'providers_id');
    }
    function GetCategoriesAttribute()
    {
        return categories::find(json_decode($this->attributes['categories_ids']??'[]',true));
    }
    function GetDistanceAttribute()
    {
        if($this->location && index::$request && index::$request->location ){
            return  helper::distance(
                $this->location->latitude,$this->location->longitude,
                index::$request->location['latitude'],index::$request->location['longitude']
            );
        }
    }
}
