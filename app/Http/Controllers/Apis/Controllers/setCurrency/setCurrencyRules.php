<?php
namespace App\Http\Controllers\Apis\Controllers\setCurrency;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class setCurrencyRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"   =>"required",
            "currencyId"     =>"required|exists:currencies,id",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "currencyId.required"       =>400,
            "currencyId.exists"         =>405,
        ];

        $messagesAr=[
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "currencyId.exists"         =>" عملة غير موجودة",
            "currencyId.required"       =>"يجب ادخال العملة",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }
}
