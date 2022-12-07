<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PlantShopController;

/*
 Here is where one can register API routes for the application. These
 routes are loaded by the RouteServiceProvider within a group which
 is assigned the "api" middleware group.


*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/auth/logout',[AuthController::class, 'logout']);
    Route::get('/auth/user',[AuthController::class, 'user']);

    Route::apiResource('/plants', PlantController::class)->except((['index', 'show']));
    Route::apiResource('/providers', ProviderController::class)->except((['index', 'show']));
    // Route::apiResource('/plantShop', PlantShopController::class)->except((['index', 'show']));
});

Route::get('/plants', [PlantController::class, 'index']);
Route::get('/plants/{plant}', [PlantController::class, 'show']);




Route::get('/shops', [ShopController::class, 'index']);
Route::get('/shops/{shop}', [ShopController::class, 'show']);
Route::post('/shops', [ShopController::class, 'store']);
Route::put('/shops/{shop}', [ShopController::class, 'update']);
Route::delete('/shops/{shop}', [ShopController::class, 'destroy']);




Route::get('/plantShop', [PlantShopController::class, 'index']);
Route::get('/plantShop/{plantShop}', [PlantShopController::class, 'show']);
Route::post('/plantShop', [PlantShopController::class, 'store']);
Route::put('/plantShop/{plantShop}', [PlantShopController::class, 'update']);
Route::delete('/plantShop/{plantShop}', [PlantShopController::class, 'destroy']);

Route::get('/providers', [ProviderController::class, 'index']);
Route::get('/providers/{provider}', [ProviderController::class, 'show']);

