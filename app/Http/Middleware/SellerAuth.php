<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() ){
            if(Auth::user()->type == 'seller'){
                return $next($request);
            }
            else{
                // return redirect('seller/login')->with('error', 'Invalid email or pasword / You have no permission!!');
                return redirect('error');
            }
        }else{
            return redirect('login')->with('error', 'Please Login First to Enter the User Section!');
        }
    }
}
