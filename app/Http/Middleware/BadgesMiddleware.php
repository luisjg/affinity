<?php namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BadgesMiddleware
{
    public function handle($request, Closure $next)
    {

    	if($request->is('api/badges/*'))
    	{
	        $user = User::email($request->route()[2]['email'])->first();
	        
	        if(!$user)
	        {
	            throw new NotFoundHttpException;
	        }
    	}

        return $next($request);
    }
}