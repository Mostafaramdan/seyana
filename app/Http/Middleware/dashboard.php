<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use App\Models\admins;
use Illuminate\Support\Str;

class dashboard 
{
    public function handle($request, Closure $next)
    {
        return $next($request);
        if(Str::contains($request->url(),'login')){
            return $next($request);
        }
        $admin = admins::where('apiToken',$request->header('Authorization'))->first();
        if($admin && $admin->is_active)
            return $next($request);
        else
            abort(403);
    }
}
