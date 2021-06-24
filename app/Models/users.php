<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Apis\Helper\helper ;

class users extends Model
{
    public $timestamps = false;
    protected $table= 'users', $guarded =[],$appends= ['fees'];

    public function region(){
        return $this->belongsTo(regions::class,'regions_id');
    }
    public function image(){
        return $this->belongsTo(images::class,'images_id');
    }
    public function location(){
        return $this->belongsTo(locations::class,'locations_id');
    }
    public function currency(){
        return $this->belongsTo(currencies::class,'currencies_id');
    }
    public function sessions(){
        return $this->hasMany(sessions::class,'users_id');
    }
    function GetSessionAttribute(){
        return count($this->sessions)>0 ? $this->sessions->first():null;
    }
    function GetFeesAttribute(){
        if($this->attributes['fees']??''){
            return $this->attributes['fees'];
        }
        if($this->region->region??'')
        return $this->region->region?
            $this->region->region->country->fees->first()->fees??0 :
            $this->region->country->fees->first()->fees??0;
    }
    public function contacts(){
        return $this->hasMany(contacts::class);
    }
    public function insurances(){
        return $this->hasMany(insurances::class);
    }
}
