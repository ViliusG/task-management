<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class ,'login']);
Route::post('/register', [AuthController::class ,'register']);

Route::apiResource('/categories', CategoryController::class)->middleware('auth:sanctum');
Route::apiResource('/tasks', TaskController::class)->middleware('auth:sanctum');
