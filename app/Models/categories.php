<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;
    protected $table = 'categories', $with=['image','country'];

    public $timestamps = false;
    protected $guarded = [

    ];
    function image()
    {
        return $this->belongsTo(images::class,'images_id');
    }
    function country()
    {
        return $this->belongsTo(countries::class,'countries_id');
    }

}
