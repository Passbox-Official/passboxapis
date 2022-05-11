<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

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
        if (! $request->has('master_password')) {
            throw new AuthenticationException('Invalid master password');
        }
        if (! valid_master_password($request->input('master_password'))) {
            throw new AuthenticationException('Invalid master password');
        }
        return $next($request);
    }
}
