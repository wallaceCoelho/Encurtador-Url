<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UsersController;
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
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['jwt.auth'])->group(function () {

    Route::controller(UrlController::class)->group(function (){
        Route::post('/url', 'shortUrl');
        Route::get('/getUrl', 'getAllUrls');
    });
    Route::controller(AuthController::class)->group(function (){
        Route::post('/logout','logout');
    });
});

