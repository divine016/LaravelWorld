<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $expectedCategory): Response
    {
        if ($request->user()->category !== $expectedCategory) {
            abort(403, 'Unauthorized Access'); // Or redirect to a specific error page
        }

        return $next($request);
    }
}
