<?php

namespace App\Http\Controllers\Apis\Controllers\login;
use  App\Http\Controllers\Apis\Controllers\index;
use App\Http\Controllers\Apis\Resources\objects;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\notifications;
use App\Http\Controllers\Apis\Helper\helper ;

class loginController extends index
{
    public static function api()
    {
        if(self::$account->getTable() == 'users' &&  self::$request->type == 'providers'){
            return [
                'status'=>421,
                'message'=>self::$messages['validateAccount']['421']
            ];
        }
        if(self::$account->getTable() == 'providers' &&  self::$request->type == 'users'){
            return [
                'status'=>420,
                'message'=>self::$messages['validateAccount']['420']
            ];
        }
        $token = helper::login(self::$account,self::$request->password);
        if(  $token){
            if(self::$request->has('lang'))
                self::$account->lang=self::$request->lang;
                self::$account->save();
                self::$account['apiToken'] = $token;

            return  [
                'status'=>200,
                'account'=>objects::account( self::$account),
                'message'=>self::$messages['login']['200']
            ];
        }else{
            return [
                'status'=>406,
                'message'=>self::$messages['login']['406']
            ];
        }
    }
}