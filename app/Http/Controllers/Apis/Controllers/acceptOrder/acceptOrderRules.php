<?php
namespace App\Http\Controllers\Apis\Controllers\acceptOrder;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class acceptOrderRules extends index
{
    public static function rules (){
        
        $rules=[
            "apiToken"   =>"required|",
            "orderId"     =>"required|exists:orders,id",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "orderId.required"       =>400,
            "orderId.exists"         =>405,

            "page.required"         =>400,
            "page.numeric"          =>405
        ];

        $messagesAr=[   
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "orderId.exists"         =>"هذا الشخص غير موجود",
            "orderId.required"       =>"يجب ادخال رقم الشخص",

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
