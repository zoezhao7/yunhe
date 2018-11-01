<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StorePermission
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
        $employee = Auth::guard('store')->user();

        if (!$employee->checkPermission(getControllerActionName())) {
            if ($request->expectsJson()) {
                return response('Unauthorized', 403);
            } else {
                denied();
            }
        }

        return $next($request);
    }
}
