<?php

namespace App\Http\Middleware;

use Closure;

class CleanFormRequest
{
    /**
     * clean null value from FormRequest , make sure SQL INSERT success.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isJson()) {
            $request->replace(array_filter($request->all(), function ($value) {
                return is_null($value) ? false : true;
            }));
        }

        return $next($request);
    }
}
