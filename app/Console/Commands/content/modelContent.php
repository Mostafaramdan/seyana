<?php

namespace App\Console\Commands\content;

class modelContent
{

public static function index ( $fileName){

return
'<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class '.$fileName.' extends Model
{
    use HasFactory;
    protected $table = '.'\''."{$fileName}".'\''.';
    protected $guard = [];

    public function user(){
        return $this->belongsTo(users::class,"users_id");
    }
    public function users(){
        return $this->hasMany(users::class,'.'\''."{$fileName}".'_id\''.');

    }
}';
}
}
