<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PDOException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        if($e instanceof PDOException)
        {
            $response = buildResponseArray('errors', false,500);
            $errors = ['Error connecting to database'];
            $response['errors'] = $errors;
            return response($response,500);
        }
        if($e instanceof NotAcceptableHttpException)
        {
            $response = buildResponseArray('errors', false,406);
            $errors = ['Invalid query parameters'];
            $response['errors'] = $errors;
            return response($response,406);
        }
        if($e instanceof NotFoundHttpException)
        {
            $response = buildResponseArray('errors', false,404);
            $errors = ['Item not found'];
            $response['errors'] = $errors;
            return response($response,404);
        }
        if($e instanceof BadRequestHttpException)
        {
            $response = buildResponseArray('errors', false,400);
            $errors = ['Bad Request'];
            $response['errors'] = $errors;
            return response($response,400);
        }
        if($e instanceof HttpException || $e instanceof ModelNotFoundException)
        {
            $response = buildResponseArray('errors', false,409);
            $errors = ['Resource could not be resolved'];
            $response['errors'] = $errors;
            return response($response,409);
        }

        return parent::render($request, $e);
    }
}
