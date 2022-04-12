<?php
namespace App\Http\Controllers\Apis\Controllers\getProvider;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class getProviderRules extends index
{
    public static function rules (){
        
        $rules=[
            "providerId"     =>"required|exists:providers,id",
        ];

        $messages=[
            "providerId.required"       =>400,
            "providerId.exists"         =>405,

        ];

        $messagesAr=[   
            "providerId.exists"         =>" مزود الخدمة غير موجود",
            "providerId.required"       =>"يجب ادخال رقم مزود الخدمة",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        // return helper::validateAccount()??null;
    }
}
