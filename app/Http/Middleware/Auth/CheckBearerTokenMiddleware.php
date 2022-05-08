<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class CheckBearerTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->check_authorization_key($request);
        return $next($request);
    }

    /**
     * Checks if Authorization token is valid
     *
     * @param Request $request
     * @throws AuthenticationException
     */
    private function check_authorization_key(Request $request)
    {
        if (! $request->header('Authorization')) {
            throw new AuthenticationException('Unauthenticated.');
        }

        if (! valid_bearer_key($request->bearerToken())) {
            throw new AuthenticationException('Invalid key');
        }
    }
}
