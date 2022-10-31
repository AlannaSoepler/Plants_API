<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProviderController;

/*
 Here is where one can register API routes for the application. These
 routes are loaded by the RouteServiceProvider within a group which
 is assigned the "api" middleware group.


*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/plants', PlantController::class);
Route::apiResource('/providers', ProviderController::class);

