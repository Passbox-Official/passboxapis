<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use App\Facades\User;

class SignUpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\NotFoundException
     * @throws AuthenticationException
     */
    public function handle(Request $request, Closure $next)
    {
        $this->check_authorization_key($request);
        if (! valid_master_password($request->input('master_password'))) {
            throw new AuthenticationException('Invalid master password');
        }
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

        if (! valid_signup_bearer_key($request->bearerToken())) {
            throw new AuthenticationException('Invalid key');
        }
    }
}
