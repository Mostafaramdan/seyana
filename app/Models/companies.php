<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    use HasFactory;
    protected $guarded = [],$with=['country'];
    public $timestamps= false;
    function country()
    {
        return $this->belongsTo(countries::class,'countries_id');
    }
}
