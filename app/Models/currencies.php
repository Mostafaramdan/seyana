<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\allActive;

class currencies extends Model
{
    use HasFactory;
    protected $table = 'currencies';
    public $timestamps = false;
    protected $guarded = [];
    public function scopeAllActive($query)
    {
        return $query->where('is_active', 1)->get();
    }
}
