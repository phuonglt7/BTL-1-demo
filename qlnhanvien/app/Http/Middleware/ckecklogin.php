<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class ckecklogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
         if(Auth::user()->count_login>0){
        return $next($request);
        }
    return redirect('/changepass')->with('status','bạn phải đổi lại mật khẩu mới!');
    }
}
