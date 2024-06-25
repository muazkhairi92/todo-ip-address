<?php

use App\Http\Controllers\AllowedIpController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware(['log.ip'])->group(function () {

    // To-do List Endpoints
    Route::apiResource('todo', TodoController::class)->except('store');
    Route::post('todo', [TodoController::class, 'store'])->middleware('ip.auth');

    // To-do List Endpoints
    Route::apiResource('category', CategoryController::class)->except('store');
    Route::post('category', [CategoryController::class, 'store'])->middleware('ip.auth');

    // To-do List Endpoints
    Route::apiResource('allowed-ip', AllowedIpController::class)->except('index')->middleware('ip.auth');
    Route::get('allowed-ip', [AllowedIpController::class, 'index']);

});