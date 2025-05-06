<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/short-link/not-found', function () {
    return view('not-found');
})->name('not-found');
Route::get('/short-link/inactive', function () {
    return view('inactive');
})->name('inactive');
Route::get('/{slug}', [\App\Http\Controllers\ShortLinkController::class, 'redirect']);

Route::get('/', function () {
    return view('welcome');
});
