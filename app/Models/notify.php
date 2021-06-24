<?php

namespace App\Models;
use App\Http\Controllers\Apis\Controllers\index;
use Illuminate\Database\Eloquent\Model;

class notify extends Model
{
    protected   $table = 'notify',
                $appends=['type','target_user'],$guarded=[];
    public $timestamps=false;

    public function notification (){
        return $this->belongsTo(notifications::class,'notifications_id');
    }

    public function user (){
        return $this->belongsTo(users::class,'users_id');
    }
    function GetTypeAttribute(){
        return $this->orders? 'order' : 'dashboard';
    }
    function GetTargetUserAttribute(){
        return $this->user ;
    }
}
