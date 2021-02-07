<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AuthenticateDevice extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $token = trim($request->bearerToken());
        if (strlen($token) == 0) throw new AuthenticationException('Token not defined.');

        $device = Device::fromHeader();
        if (is_null($device)) throw new AuthenticationException('Device not registered.');

        return $next($request);
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
