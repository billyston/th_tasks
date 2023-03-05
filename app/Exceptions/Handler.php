<?php

namespace App\Exceptions;

use App\Traits\apiResponseBuilder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use apiResponseBuilder;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array
     */
    protected $levels =
    [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport =
    [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array
     */
    protected $dontFlash =
    [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse|Response
     * @throws Throwable
     */
    public function render( $request, Throwable $exception ) : JsonResponse|Response
    {
        if ( $exception instanceof ModelNotFoundException )
        {
            return $this -> errorResponse( array(), false, 'Resource not found', Response::HTTP_NOT_FOUND );
        }
        elseif ( $exception instanceof MethodNotAllowedHttpException )
        {
            return $this -> errorResponse( array(), false, 'You do not have permission to perform this action', Response::HTTP_METHOD_NOT_ALLOWED );
        }
        elseif ( $exception instanceof NotFoundHttpException )
        {
            return $this -> errorResponse( array(), false, 'Resource not found', Response::HTTP_NOT_FOUND );
        }
        elseif ( $exception instanceof QueryException )
        {
            return $this -> errorResponse( array(), false, 'Connection refused', Response::HTTP_UNAUTHORIZED );
        }
        elseif ( $exception instanceof RelationNotFoundException )
        {
            return $this -> errorResponse( array(), false, 'Undefined relationship', Response::HTTP_INTERNAL_SERVER_ERROR );
        }
        elseif ( $exception instanceof AccessDeniedHttpException )
        {
            return $this -> errorResponse( array(), false, 'This action is unauthorized.', Response::HTTP_FORBIDDEN );
        }

        return parent::render( $request, $exception );
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register() : void
    {
        $this -> reportable(function ( Throwable $e )
        {
            //
        });
    }
}
