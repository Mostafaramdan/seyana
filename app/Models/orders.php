<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    public $timestamps = false;
    protected $guarded=[],$appends=['images','servives_price','total'],$with=['voucher','user','provider'];

    public function carts(){
        return $this->hasMany(carts::class,'orders_id');
    }
    public function location(){
        return $this->belongsTo(locations::class,'locations_id');
    }
    public function provider(){
        return $this->belongsTo(providers::class,'providers_id');
    }
    public function voucher(){
        return $this->belongsTo(vouchers::class,'vouchers_id');
    }
    public function user(){
        return $this->belongsTo(users::class,'users_id');
    }
    function GetImagesAttribute()
    {
        return images::find(json_decode($this->attributes['images'],true));
    }
    function GetServivesPriceAttribute()
    {
        return $this->carts->sum('price');
    }
    function GetTotalAttribute()
    {
        $total_prices= $this->carts->sum('price');
        if($this->voucher)
        $total_prices-= ($total_prices*$this->voucher->discount/100);
        if($this->fees)
            $total_prices+= ($total_prices*$this->fees/100);
        
        return $total_prices;
    }
}
