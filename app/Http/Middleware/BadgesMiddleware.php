<?php namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BadgesMiddleware
{
    public function handle($request, Closure $next)
    {
        if(count($request->all()) > 0)
        {
            // No more than 1 GET param allowed
            if(count($request->all()) > 1)
            {
                throw new NotFoundHttpException;
            }

            // first query string must be ?email=
            if(current(array_keys($request->all())) !== 'email')
            {
                throw new NotFoundHttpException;
            }

            $user = User::email($request['email'])->first();

            if(is_null($user))
            {
                throw new NotFoundHttpException;
            }
        }

        return $next($request);
    }
}