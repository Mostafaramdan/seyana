<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class services extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $guarded = [],$with=['category'];
    public $timestamps = false, $appends=['warranty_type_ar'];
    function category()
    {
        return $this->belongsTo(categories::class,'categories_id');
    }
    function getWarrantyTypeArAttribute()
    {
        $ar= ['days'=>'يوم','months'=>'شهر','years'=>'سنة'];
        return $ar[$this->warranty_type];
    }
}
