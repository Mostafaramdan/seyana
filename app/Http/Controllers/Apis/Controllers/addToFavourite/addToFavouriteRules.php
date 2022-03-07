<?php
namespace App\Http\Controllers\Apis\Controllers\addToFavourite;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class addToFavouriteRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"   =>"required|",
            "providerId"     =>"required|exists:providers,id",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "providerId.required"       =>400,
            "providerId.exists"         =>405,

        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "providerId.exists"         =>"رقم مزود الخدمة غير موجود",
            "providerId.required"       =>"يجب ادخال رقم مزود الخدمة",

        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
