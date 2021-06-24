<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class carts extends Model
{
    public $timestamps = false ;
    protected $guarded=[],$appends=['service_name','category_id'];

    public function order()
    {
        return $this->belongsTo(orders::class,'orders_id');
    }
    public function service()
    {
        return $this->belongsTo(services::class,'services_id');
    }
    function GetServiceNameAttribute()
    {
        return $this->service->name_ar??'other';
    }
    function GetCategoryIdAttribute()
    {
        return $this->service->categories_id??'other';
    }
}
