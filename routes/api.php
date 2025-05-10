<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Movie;
use App\Http\Controllers\MovieController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/movie', [MovieController::class, 'index']);

Route::get('/movie/{id}', [MovieController::class, 'show']);
Route::post('/movie', [MovieController::class, 'store']);
Route::put('/movie/{id}', [MovieController::class, 'update']);
Route::delete('/movie/{id}', [MovieController::class, 'destroy']);
