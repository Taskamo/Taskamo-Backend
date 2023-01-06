<?php

use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

Route::post('/register', [AuthenticationController::class, 'createAccount']);
Route::post('/login', [AuthenticationController::class, 'signin']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function (Request $request) {
        return auth()->user();
    });
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});

Route::post('/event', [EventController::class, 'store'])->middleware(['auth:sanctum']);
Route::get('/event', [EventController::class, 'index'])->middleware(['auth:sanctum']);
Route::get('/event/{event}', [EventController::class, 'show'])->middleware(['auth:sanctum']);
Route::delete('/event/{event}', [EventController::class, 'destroy'])->middleware(['auth:sanctum']);
Route::put('/event/{event}', [EventController::class, 'update'])->middleware(['auth:sanctum']);
