<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;

class MidLoginCheck
{
    /**
     * 用于拦截一些需要登录的页面非登录进入
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
     // dd(Cookie::get('accountid'));
        if(!$request->cookies->get("phone")){

            return redirect('/login');
      }
        return $next($request);
    }
}
