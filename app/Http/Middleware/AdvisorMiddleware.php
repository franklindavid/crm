<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class AdvisorMiddleware
{
    protected $auth;
    public function __construct(Guard $auth){
        $this->auth=$auth;
    }
    public function handle($request, Closure $next)
    {
        if($this->auth->user()->advisor()){
             return $next($request);
        }else{
            return redirect('/');
        }
    }
}
