<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfficeHours
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $currentHour = now()->hour;
        if ($currentHour < 9 || $currentHour > 17) {
            return response()->json(['message' => 'Sorry, we are closed. Our office hours are from 9 AM to 5 PM.'], 403);
        }
        return $next($request);
    }
}
