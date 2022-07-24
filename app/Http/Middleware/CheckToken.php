<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
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
        $token = $request->bearerToken();
        if ($request->has('token')) {
            $token = $request->get('token');
        }
        if (!$token || $token !== env('APP_TOKEN')) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        return $next($request);
    }
}
