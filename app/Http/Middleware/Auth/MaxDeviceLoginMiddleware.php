<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use App\Facades\User;
use App\Models\SystemConfig;
use App\Exceptions\MaxDeviceExceededException;

class MaxDeviceLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throws \App\Exceptions\NotFoundException
     * @throws MaxDeviceExceededException
     */
    public function handle(Request $request, Closure $next)
    {
        $total_active_device = (int) User::total_active_devices($request->input('email'))->count();
        $max_active_device = system_config(SystemConfig::MAX_DEVICE_LOGIN);

        if ($total_active_device >= $max_active_device) {
            throw new MaxDeviceExceededException(sprintf('Only %s device is allowed', $max_active_device));
        }

        return $next($request);
    }
}
