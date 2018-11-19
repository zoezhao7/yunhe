<?php

namespace App\Http\Middleware;

use Closure;

class OperationLog
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
        // 查询操作不记录
        if(getActionName() !== 'index' && getActionName() !== 'show') {
            $data= [
                'route' => $request->route()->getName(),
            ];
        }
        var_dump($request->url());
        var_dump(getActionName());
        var_dump(getControllerActionName());
        dd($request->getRealMethod());
        return $next($request);
    }
}
