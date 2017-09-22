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
     * Constructs the response object
     *
     * @param $message
     * @param $status
     * @return \Laravel\Lumen\Http\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function buildResponse($message,$status){
        $response = buildResponseArray('errors', false,$status);
        $errors = [$message];
        $response['errors'] = $errors;
        return response($response,$status);
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
            return $this->buildResponse('Error connecting to database',500);
        }
        if($e instanceof NotAcceptableHttpException)
        {
            return $this->buildResponse('Invalid query parameters',406);
        }
        if($e instanceof NotFoundHttpException)
        {
            return $this->buildResponse('Item not found',404);
        }
        if($e instanceof BadRequestHttpException)
        {
            return $this->buildResponse('Bad Request',400);
        }
        if($e instanceof HttpException || $e instanceof ModelNotFoundException)
        {
            return $this->buildResponse('Resource could not be resolved',409);
        }

        return parent::render($request, $e);
    }
}
