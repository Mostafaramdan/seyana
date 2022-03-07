<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Apis\Helper\helper ;
use App\Http\Controllers\Apis\Controllers\index;

class GeneralModel extends Model
{
    public $timestamps=false;
    public static  $account,$helper,$request;

    function __construct(){
        self::$account=index::$account;
        self::$request=index::$request;
        self::$helper=helper::class;
    }

    public static function allNoTrashed(){

        return self::where('deleted_at',null)->get();
    }
    public static function findNoTrashed($id){

        $record = self::find($id);
        if($record==null )
            return null;
        else
            return $record->deleted_at == null ? $record : null ;

    }
    public static function allActive(){

        return self::orderBy('id','DESC')->get()->where('deleted_at',null)->where('is_active',1);
    }
    public static function allActiveOnly(){

        return self::orderBy('id','DESC')->get()->where('is_active',1);
    }
    public static function findActive($id){

        return self::where('id',$id)->where('deleted_at',null)->where('is_active',1)->first();
    }
    public static function findAllActive($id){

        return self::whereIn('id',$id)->where('deleted_at',null)->where('is_active',1)->get();
    }

}
