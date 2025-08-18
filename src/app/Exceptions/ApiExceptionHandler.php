<?php
namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ApiExceptionHandler
{
    public static array $handlers = [
        ValidationException::class => 'handleValidationException',
        ModelNotFoundException::class => 'handleNotFoundException',
        NotFoundHttpException::class => 'handleNotFoundException',
        MethodNotAllowedHttpException::class => 'handleMethodNotAllowedException',
        HttpException::class => 'handleHttpException',
        QueryException::class => 'handleQueryException',
    ];

    public function handleValidationException(
        ValidationException $e, 
        Request $request
    ): JsonResponse {
        $errors = [];
        
        foreach ($e->errors() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'field' => $field,
                    'message' => $message,
                ];
            }
        }

        $this->logException($e, 'Validation failed', ['errors' => $errors]);

        return response()->json([
            'error' => [
                'type' => $this->getExceptionType($e),
                'status' => 422,
                'message' => 'The provided data is invalid.',
                'timestamp' => now()->toISOString(),
                'validation_errors' => $errors,
            ]
        ], 422);
    }

    public function handleNotFoundException(
        ModelNotFoundException|NotFoundHttpException $e, 
        Request $request
    ): JsonResponse {
        $this->logException($e, 'Resource not found');

        $message = $e instanceof ModelNotFoundException 
            ? 'O recurso requisitado não foi encontrado'
            : "O endpoint '{$request->getRequestUri()}' não foi encontrado.";

        return response()->json([
            'error' => [
                'type' => $this->getExceptionType($e),
                'status' => 404,
                'message' => $message,
                'timestamp' => now()->toISOString(),
            ]
        ], 404);
    }

    public function handleMethodNotAllowedException(
        MethodNotAllowedHttpException $e, 
        Request $request
    ): JsonResponse {
        $this->logException($e, 'Método não permitido');

        return response()->json([
            'error' => [
                'type' => $this->getExceptionType($e),
                'status' => 405,
                'message' => "O método {$request->method()} não é permitido neste endpoint.",
                'timestamp' => now()->toISOString(),
                'allowed_methods' => $e->getHeaders()['Allow'] ?? 'Unknown',
            ]
        ], 405);
    }

    public function handleHttpException(HttpException $e, Request $request): JsonResponse
    {
        $this->logException($e, 'Exceção HTTP');

        return response()->json([
            'error' => [
                'type' => $this->getExceptionType($e),
                'status' => $e->getStatusCode(),
                'message' => $e->getMessage() ?: 'Erro HTTP.',
                'timestamp' => now()->toISOString(),
            ]
        ], $e->getStatusCode());
    }

    public function handleQueryException(QueryException $e, Request $request): JsonResponse
    {
        $this->logException($e, 'A query do banco falhou', ['sql' => $e->getSql()]);

        $errorCode = $e->errorInfo[1] ?? null;
        
        switch ($errorCode) {
            case 1451: // Foreign key constraint violation
                return response()->json([
                    'error' => [
                        'type' => $this->getExceptionType($e),
                        'status' => 409,
                        'message' => ' Não é possível excluir este recurso pois é referenciado por outro.',
                        'timestamp' => now()->toISOString(),
                    ]
                ], 409);
                
            case 1062: // Duplicate entry
                return response()->json([
                    'error' => [
                        'type' => $this->getExceptionType($e),
                        'status' => 409,
                        'message' => 'Já existe um registro com essa informação.',
                        'timestamp' => now()->toISOString(),
                    ]
                ], 409);
                
            default:
                return response()->json([
                    'error' => [
                        'type' => $this->getExceptionType($e),
                        'status' => 500,
                        'message' => 'Erro no banco, tente novamente.',
                        'timestamp' => now()->toISOString(),
                    ]
                ], 500);
        }
    }

    private function getExceptionType(Throwable $e): string
    {
        $className = basename(str_replace('\\', '/', get_class($e)));
        return $className;
    }

    private function logException(Throwable $e, string $message, array $context = []): void
    {
        $logContext = array_merge([
            'exception' => get_class($e),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'url' => request()->fullUrl(),
            'method' => request()->method(),
            'ip' => request()->ip(),
        ], $context);

        Log::warning($message, $logContext);
    }
}