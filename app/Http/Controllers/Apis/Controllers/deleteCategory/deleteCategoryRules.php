<?php
namespace App\Http\Controllers\Apis\Controllers\deleteCategory;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class deleteCategoryRules extends index
{
    public static function rules ()
    {
        
        $rules=[
            "apiToken"   =>"required|",
            "id"     =>"required|exists:providers_categories,id",
        ];

        $messages=[
            "apiToken.required"     =>400,
            "apiToken.exists"       =>405,

            "id.required"       =>400,
            "id.exists"         =>405,

            "page.required"         =>400,
            "page.numeric"          =>405
        ];

        $messagesAr=[   
            "apiToken.required"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "id.exists"         =>"هذا القسم غير موجود",
            "id.required"       =>"يجب ادخال رقم القسم",

        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        return helper::validateAccount()??null;
    }

}
