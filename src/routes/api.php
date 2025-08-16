<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\StateController;
use App\Http\Controllers\Api\V1\CityController;

Route::prefix('v1')->group(function(){
    Route::apiResource('states', StateController::class);
    Route::apiResource('cities', CityController::class);
});



