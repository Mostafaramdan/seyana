<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class providers_categories extends Model
{
    use HasFactory;
    public $guarded =[],$timestamps=false, $appends= ['images'];
    function category()
    {
        return $this->belongsTo(categories::class,'categories_id');
    }
    function GetImagesAttribute()
    {
        if($this->attributes['images']??'')
            return images::find(json_decode($this->attributes['images'],true));
    }

}
