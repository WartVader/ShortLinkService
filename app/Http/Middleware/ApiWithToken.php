<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiWithToken
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('Authorization');
        $validToken = config('shortlink.token');

        if ($token !== "Bearer $validToken") {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
