<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\StateController;

Route::prefix('v1')->group(function(){
    Route::apiResource('states', StateController::class);
});



