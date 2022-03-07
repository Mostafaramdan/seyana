<?php
namespace App\Http\Controllers\Apis\Controllers\getMyCategories;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class getMyCategoriesRules extends index
{
    public static function rules ()
    {
        $rules=[
            "apiToken"   =>"required_if:providerId,",
            "providerId"   =>"required_if:apiToken,|exists:providers,id",
        ];
        if(!self::$request->providerId && !self::$request->providerId){
            abort(403);
        }

        $messages=[
            "apiToken.required_if"     =>400,
            "apiToken.exists"       =>405,
            
            "providerId.exists"       =>405,
            "providerId.required_if"     =>400,

        ];

        $messagesAr=[   
            "apiToken.required_if"     =>"يجب ادخال التوكن",
            "apiToken.exists"       =>"هذا التوكن غير موجود",

            "providerId.exists"         =>" مزود خدمة غير موجود",
            "providerId.required_if"         =>" مزود خدمة غير موجود",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        if(self::$request->apiToken)
            return helper::validateAccount()??null;
    }
}
