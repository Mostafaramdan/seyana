<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class services extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $guarded = [];
    public $timestamps = false;
    function category()
    {
        return $this->belongsTo(categories::class,'categories_id');
    }
}
