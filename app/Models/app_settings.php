<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_settings extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [] , $appends=['phones','emails'],$with=['country'];
    protected $table = 'app_settings';

    function GetPhonesAttribute()
    {
        return json_decode($this->attributes['phones'],true);
    }
    function GetEmailsAttribute()
    {
        return json_decode($this->attributes['emails'],true);
    }
    function country()
    {
        return $this->belongsTo(countries::class,'countries_id');
    }

}
