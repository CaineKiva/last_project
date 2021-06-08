<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CheckLogin
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
        if (Session::has('id')){
            return $next($request);
        }elseif(Session::has('doctor_id')){
            return $next($request);
        }elseif(Session::has('nurse_id')){
            return $next($request);
        }elseif(Session::has('patient_id')){
            return $next($request);
        }else{
            return redirect()-> route('login')->with('erron','sai cmnr');
        }
        
    }
}
