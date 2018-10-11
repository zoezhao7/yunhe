<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class checkPermission
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

        if (!$admin->isSuperAdmin() && !in_array(getControllerActionName(), $admin->getNodes())) {

            if ($request->expectsJson()) {
                return response('Unauthorized', 403);
            } else {
                echo "<script type='text/javascript'>alert('您没有权限！'); window.history.back();</script>";
                exit;
            }
        }

        return $next($request);
    }
}
