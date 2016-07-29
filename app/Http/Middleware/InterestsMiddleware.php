<?php namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InterestsMiddleware
{
    public function handle($request, Closure $next)
    {
        $type = $request->route()[2]['type'];

        $interests = [
            'research',
            'teaching',
            'personal',
        ];

        if($request->is('api/interests/*'))
        {
            if(str_contains($type, ':'))
            {
                $type = strtok($type, ':');
            }
            
            if(!in_array($type, $interests))
            {
                throw new NotFoundHttpException;
            }
        }

        return $next($request);
    }
}
