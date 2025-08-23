<?php

namespace App\Http\Middleware\Permissions;

use App\Utils\UserUtils;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminGateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ban request for other roles except admin (admin = 2)
        new UserUtils()->userPermission(auth('api')->user(), 2); 

        return $next($request);
    }
}
