<?php

namespace App\Exceptions;

use Exception;
use App\Http\Traits\ApiResponser;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException as QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    use ApiResponser;


    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        // if ($request->expectsJson()){

           
            if(config('app.debug'))
                return parent::render($request, $exception);


            if ($exception instanceof ModelNotFoundException) {

                $modelo = strtolower(class_basename($exception->getModel()));
                return $this->errorResponse("No existe ninguna instancia de {$modelo} con el id especificado", 404);
            }

            if ($exception instanceof NotFoundHttpException) {

               
                return response()->json(['message' => 'Not Found!'], 404);
            }

            if ($exception instanceof QueryException) {

                // dd($exception);
                $codigo = $exception->errorInfo[1];

                if($codigo == 1451)
                    return $this->errorResponse('No se puede eliminar permanentemente el recurso porque esta relacionado con algun otro.', 409);  

                if($codigo == 1062)
                    return $this->errorResponse('Email debe ser unico', 400);  
            }

            if ($exception instanceof HttpException) {
               
               return $this->errorResponse($exception->getMessage(), $exception->getCode());  
            }

      

            return $this->errorResponse($exception, 500);  
   
        // }

        
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {

        $guard = array_get($exception->guards(), 0);

        dd($guard);

        switch ($guard) {
            case 'admin':
                $redirect = route('admin.login');
                break;
            
            default:
                $redirect = route('login');
                break;
        }

        return $request->expectsJson()
                    ? response()->json(['message' => $exception->getMessage()], 401)
                    : redirect()->guest($exception->redirectTo() ?? route('login'));
    }

    /**
     * Create a response object from the given validation exception.
     *
     * @param  \Illuminate\Validation\ValidationException  $e
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    // protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    // {
    //     if ($e->response) {
    //         return $e->response;
    //     }

    //     return $request->expectsJson()
    //                 ? $this->invalidJson($request, $e)
    //                 : $this->invalid($request, $e);
    // }


}
