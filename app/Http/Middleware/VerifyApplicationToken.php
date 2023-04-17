<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApplicationToken
{
    /**
     * Verifies if the application token matches the token in the env file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        abort_if(
            $request->bearerToken() !== env('API_APP_TOKEN'),
            403,
            'The application token is not valid.',
        );

        return $next($request);
    }
}
