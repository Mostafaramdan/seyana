<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;
    protected $fillable=['image'],$appends=['path','src'];
    public $timestamps = false;
    function GetPathAttribute()
    {
        return $this->attributes['image'];
    }
    function GetSrcAttribute()
    {
        return $this->attributes['image'];
    }
}
