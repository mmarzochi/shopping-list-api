<?php

namespace App\Exceptions;

use ErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {

        if ($exception instanceof MethodNotAllowedHttpException) {
            return response()->json(['message' => $exception->getMessage()], 405);
        }
        
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => $exception->getMessage()], 404);
        }

        if($exception instanceof ErrorException){
            return response()->json(['message' => 'One or more params are invalid. Check them out in the docs and try again.'], 400);
        }

        if ($request->is('api/*')){
            return response()->json(['message' => $exception->getMessage()], 401);
        }

        return parent::render($request, $exception);
    }
}
