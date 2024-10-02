<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [\App\Http\Controllers\PeopleController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\PeopleController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [PeopleController::class,'logout']);