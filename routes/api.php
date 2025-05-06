<?php

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


Route::post('/short-link', [\App\Http\Controllers\ShortLinkController::class, 'store'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
//Route::apiResource('short-link', \App\Http\Controllers\ShortLinkController::class);
