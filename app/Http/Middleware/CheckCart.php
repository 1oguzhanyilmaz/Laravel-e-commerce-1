<?php

namespace App\Http\Middleware;

use App\Cart_model;
use Closure;
use Illuminate\Support\Facades\Session;

class CheckCart
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
        $session_id = Session::get('session_id');
        if (!Cart_model::where('session_id',$session_id)->first()){
            return redirect('viewcart');
        }
        return $next($request);
    }
}
