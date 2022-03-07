<?php
namespace App\Http\Controllers\Apis\Controllers\getInfo;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class getInfoRules extends index
{
    public static function rules ()
    {       
        $rules=[
            "districtId"   =>"exists:regions,id",

        ];

        $messages=[
            "districtId.exists"      =>405,
            "districtId.required"    =>400,
            
        ];

        $messagesAr=[   
            "districtId.exists"       =>" رقم الحي غير موجود",
            "districtId.required"       =>"يجب إدخال رقم الحي",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        // return helper::validateAccount()??null;
    }
}