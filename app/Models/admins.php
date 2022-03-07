<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class admins extends  Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'admins',$with=['country'],$guarded=[],$appends=['permissions'];
    public $timestamps = false;

    function country()
    {
        return $this->belongsTo(countries::class,'countries_id');
    }
    function GetPermissionsAttribute()
    {
        return json_decode($this->attributes['permissions'],true);
    }
}
