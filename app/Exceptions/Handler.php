<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException) {
            $arr = Arr::collapse($exception->errors());
            return response()->error(400, '请求参数错误。'.Arr::first($arr));
        }

        if ($exception instanceof BusinessException) {
            return response()->error($exception->getCode(), $exception->getMessage());
        }

        if ($exception instanceof UnauthorizedHttpException) {
            return response()->error(401, $exception->getMessage());
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->error(500, $exception->getMessage());
        }

        if (env('app.debug') == false) {
            return response()->error(500, $exception->getMessage().$exception->getLine().$exception->getFile());
        }

        return parent::render($request, $exception);
    }
}
