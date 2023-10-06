<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;
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
Route::controller(UrlController::class)->group(function (){
    Route::get('/', 'redirectUrl');
    Route::post('/url', 'shortUrl');
});

Route::middleware('api')->group(function (){
    Route::get('/logout', [AuthController::class, 'login']);
});

Route::post('/login', [AuthController::class, 'login']);
