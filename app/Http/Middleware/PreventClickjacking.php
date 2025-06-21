<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PreventClickjacking
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // 'DENY' を設定して、他のサイトからの埋め込みを完全に拒否します。
        $response->headers->set('X-Frame-Options', 'DENY');
        return $next($request);
    }
}
