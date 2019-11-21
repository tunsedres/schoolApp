<?php

namespace App\Http\Middleware;

use Closure;


class AdminAuth
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
        if($user = auth('api')->user()){
            if($user->hasRole('admin')){
                return $next($request);
            }
        }

        $response = [
            'code' => 404,
            'status' => 'fail',
            'message' => 'access.denied'
        ];
        return response($response, 404);
    }
}
