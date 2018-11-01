<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $admin = Auth::user();

        if (!$admin->checkPermission(getControllerActionName())) {
            if ($request->expectsJson()) {
                return response('Unauthorized', 403);
            } else {
                denied();
            }
        }

        return $next($request);
    }
}
