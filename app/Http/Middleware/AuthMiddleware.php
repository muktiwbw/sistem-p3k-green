<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null)
    {
        // Auth::check() untuk mengecek apakah user sudah login atau belum
        if (!Auth::check()) {
            return redirect('/');
        }

        // Auth::user() untuk mengambil data user yang login saat itu
        if($role != null && Auth::user()->admin != $role){
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
