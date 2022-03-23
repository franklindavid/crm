<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Contracts\Auth\Guard;

class MarketingManagerMiddleware
{
    protected $auth;
    public function __construct(Guard $auth){
        $this->auth=$auth;
    } 
    public function handle($request, Closure $next)
    {
        if($this->auth->user()->marketing_manager()){
             return $next($request);
        }else{
            return redirect('/');
        }
       
    }
}
 