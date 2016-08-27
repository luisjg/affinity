<?php namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class BadgesMiddleware
{
    public function handle($request, Closure $next)
    {
        if(array_key_exists('email', $request->route()[2]))
        {
            $user = User::email($request->route()[2]['email'])->first();

            if(is_null($user))
            {
                abort(404);
            }
        }

        return $next($request);
    }
}