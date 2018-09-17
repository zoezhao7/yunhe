<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthStoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'store')
    {
        if(Auth::guard($guard)->guest()) {
            if($request->ajax() || $request->wantsJson() || $request->isJson()) {
                return response('Unauthorized', 401);
            } else {
                return redirect()->route('store.login');
            }
        }

        return $next($request);
    }
}
