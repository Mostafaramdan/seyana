<?php
namespace App\Http\Controllers\Apis\Controllers\makeOrder;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class makeOrderRules extends index
{
    public static function rules (){

        $rules=[
            "apiToken"          =>"required|",
            "services"          =>"required|array",
            // "services.*.id"     =>"required|exists:services,id",
            "services.*.price"  =>"required",
            'materials'         =>'string',
            'location'          =>'required|array',
            'images'            =>'array',
            'images.*'           =>'string',
            'description'       =>'string',
            'date'              =>'int',
            'time'              =>'int',
            'voucherId'         =>'exists:vouchers,id',
            'providerId'        =>'required|exists:providers,id'


        ];

        $messages=[
            "apiToken.required"         =>400,
            "apiToken.exists"           =>405,

            "services.required"         =>400,
            "services.*.id.required"    =>400,
            "services.*.id.exists"      =>405,

            "services.*.price.required" =>400,

            "materials.required"        =>400,

            "location.required"         =>400,

            "images.required"           =>400,
            "images.*.string"           =>405,

            "description.required"      =>400,

            "date.required"             =>400,

            "time.required"             =>400,

            "voucherId.exists"        =>400,

            "providerId.required"       =>400,
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