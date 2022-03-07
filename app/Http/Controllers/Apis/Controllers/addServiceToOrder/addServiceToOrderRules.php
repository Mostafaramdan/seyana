<?php
namespace App\Http\Controllers\Apis\Controllers\addServiceToOrder;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class addServiceToOrderRules extends index
{
    public static function rules (){
        
        $rules=[
            "apiToken"   =>"required|",
            "orderId"     =>"required||exists:orders,id",
            "service"     =>"required",
            "service.price"  =>"required",
            "service.quantity"  =>"required",
            "service.id"  =>"required|exists:services,id",
        ];

        $messages=[
            "apiToken.required"         =>400,
            "apiToken.exists"           =>405,

            "orderId.required"          =>400,
            "orderId.exists"            =>405,

            "service.required"          =>400,
            "service.array"             =>405,
            "service.*.price.required" =>400,
            "service.*.id.required"    =>400,
            "service.*.id.exists"      =>405,

        ];

        $messagesAr=[   
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "userId.exists"         =>"هذا الشخص غير موجود",
            "userId.required"       =>"يجب ادخال رقم الشخص",

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
