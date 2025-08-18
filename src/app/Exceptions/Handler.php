<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Domain\Exceptions\Campaign\ActiveCampaignAlreadyExistsException;
use Illuminate\Http\Client\HttpClientException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Handler extends ExceptionHandler
{
    public function register(): void
    {

        $this->renderable(function (ModelNotFoundException $e, $request) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Recurso não encontrado.'
                ], 404);
            }
        });

       $this->renderable(function (NotFoundHttpException $e, $request) {
            // Temporarily always return JSON to test
            return response()->json([
                'message' => 'Recurso não encontrado.'
            ], 404);
        });

        $this->renderable(function (ActiveCampaignAlreadyExistsException $e, $request) {
            if ($request->wantsJson()) {
                return response()->json(['message' => $e->getMessage()], 409);
            }   
        });
    }
}
