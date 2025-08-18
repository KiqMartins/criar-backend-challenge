<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Http\Request;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\ApiExceptionHandler;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {
            $className = get_class($e);
            
            $handlers = ApiExceptionHandler::$handlers;

            if (array_key_exists($className, $handlers)) {
                $method = $handlers[$className];
                $apiHandler = new ApiExceptionHandler();
                return $apiHandler->$method($e, $request);
            }
            
            return response()->json([
                'error' => [
                    'type' => basename(get_class($e)),
                    'status' => $e->getCode() ?: 500,
                    'message' => $e->getMessage() ?: 'Um erro inesperado aconteceu.',
                    'timestamp' => now()->toISOString(),
                    'debug' => app()->environment('local', 'testing') ? [
                        'file' => $e->getFile(),
                        'line' => $e->getLine(),
                        'trace' => $e->getTraceAsString()
                    ] : null
                ]
            ], $e->getCode() ?: 500);
        });
    })
    ->create();