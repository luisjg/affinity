<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;

use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        PDOException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($e instanceof HttpException || $e instanceof ModelNotFoundException || $e instanceof PDOException)
        {
            $response = buildResponseArray('errors', false,404);
            $errors = ['Resource could not be resolved'];
            $response['errors'] = $errors;
            return response($response,404);
//            return json_encode([
//                'version'  => 'affinity-2.0',
//                'status'   => app('Illuminate\Http\Response')->status(),
//                'success'  => 'false',
//                'type':'errors',
//                'errors':
//            ]);
        }

        return parent::render($request, $e);
    }
}
