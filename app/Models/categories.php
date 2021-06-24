<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    use HasFactory;
    protected $table = 'categories', $with=['image'];

    public $timestamps = false;
    protected $guarded = [

    ];
    function image()
    {
        return $this->belongsTo(images::class,'images_id');
    }

}
