<?php

use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

Route::get('applications', [ApplicationsController::class, 'index']);
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('applications', ApplicationsController::class)->except(['create', 'edit', 'index']);
    Route::get('cities', [CityController::class, 'index']);
    Route::get('statuses', [StatusController::class, 'index']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
        Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
    });
});
