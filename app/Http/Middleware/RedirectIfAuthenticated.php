<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @param  string|null              $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $current_user = DB::table('users')
                ->where('email', '=', $credentials['email'])
                ->first();

            if($current_user->role == 'ADMIN') {
                return redirect()->route('dashboard');
            }else if($current_user->role == 'USER') {
                return redirect()->route('inicio');
            }  
        }

        return $next($request);
    }
}
