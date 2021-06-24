<?php
namespace App\Http\Controllers\Apis\Controllers\registerProvider;

use App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Apis\Helper\helper;

class registerProviderRules extends index
{
    public static function rules (){
        
        $rules=[
            "name"     =>"required|min:3|max:30",
            "image"     =>"nullable",
            "phone"    =>"required|numeric|between:10000000,999999999999999|unique:users,phone|unique:providers,phone",
            "email"    =>"unique:users,email|unique:users,email",
            'fireBaseToken'    =>"nullable",
            "password" =>"required|min:6|max:20",
            'identityImages' => 'required|array|min:2|max:2'
        ];

        $messages=[
            "name.required"      =>400,
            "name.min"           =>405,

            "type.required"      =>400,
            "type.in"            =>405,

            "phone.required"     =>400,
            "phone.numeric"      =>405,
            "phone.between"      =>405,
            "phone.unique"       =>408,

            "email.unique"       =>409,

            "image.required"     =>400,

            "password.required"  =>400,
            "password.min"       =>405,

            "lang.required"      =>400,
            "lang.in"            =>405,

            'identityImages.required' =>400,
            'identityImages.array'    =>405,
            'identityImages.min'      =>405,
            'identityImages.min'      =>405,

        ];

        $messagesAr=[

            "name.required"     =>"يجب ادخال الاسم",
            "name.min"          =>"يجب ان لا يقل الاسم عن 3 حروف ",

            "type.required"     =>"يجب ادخال نوع المستخدم",
            "type.in"           =>" users Or Providers يجب ان يكون النوع  ",

            "phone.required"    =>"يجب ادخال رقم التليفون   ",
            "phone.nemeric"     =>"يجب ادخال رقم التليفون بشكل صحيح ",
            "phone.between"     =>"يجب ان لا يقل رقم التليفون عن 11 ارقام ولا يزيد عن 15 رقم ",
            "phone.unique"      =>"هذا الهاتف مسجل مسبقا",

            "email.unique"      =>"هذا البريد الإلكتروني مسجل مسبقا",

            "image.required"    =>"يجب ادخال صورة المستخدم ",

            "password.required" =>"يجب ادخال الرقم السري",
            "password.min"      =>"يجب ان لا يقل الرقم السري عن 6 ارقام او حروف",

            "lang.required"     =>"يجب ادخال اللغة ",
            "lang.in"           =>" ar , en يجب ادخال اللغة بشكل صحيح ",
        ];

        $messagesEn=[
        ];
        $ValidationFunction=self::$request->showAllErrors==1?"showAllErrors":"Validator";
        $Validation = helper::{$ValidationFunction}(self::$request->all(), $rules, $messages,self::$lang=="ar"?$messagesAr:$messagesEn);
        if ($Validation !== null) {    return $Validation;    }

        // return helper::validateAccount()??null;
    }
}
