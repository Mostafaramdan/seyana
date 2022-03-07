<?php
namespace App\Http\Controllers\Apis\Controllers\getMyFavorites;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class getMyFavoritesRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"   =>"required|",
            "providerId"     =>"exists:providers,id",
            "page"      =>"required|numeric"
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "providerId.required"       =>400,
            "providerId.exists"         =>405,

            "page.required"         =>400,
            "page.numeric"          =>405
        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "providerId.exists"         =>"هذه العلامة غير موجودة",
            "providerId.required"       =>"يجب ادخال رقم العلامة",

            "page.required"         =>"يجب ادخال رقم الصفحة",
            "page.numeric"          =>"يجب ادخال رقم الصفحة بشكل صحيح",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
