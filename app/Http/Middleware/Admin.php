<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        if($request->session()->exists('role') && $request->session()->get('role')=='admin'){
            return $next($request);
        }else{
            return redirect('/')->with(['error_message'=>'Your are not authorize to access']);
        }
    }
}
