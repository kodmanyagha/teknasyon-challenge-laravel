<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        $token = trim($request->bearerToken());
        if (strlen($token) == 0)
            throw new AuthenticationException('Unauthenticated.');

        $token       = explode('_', $token);
        $clientToken = @$token[0];
        $userToken   = @$token[1];
        $user        = User::where('user_token', $userToken)->first();
        if (is_null($user)) throw new AuthenticationException('Unauthenticated.');

        Auth::loginUsingId($user->id);
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
