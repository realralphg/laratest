<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// A U T H E N T I C A T E D  Routes using middleware
Route::group(['middleware' => 'auth:api'], function () {

    Route::get('/logout', \App\Http\Controllers\AuthController::class . '@logout');    
});

//  U N A U T H E N T I C A T E D
Route::post('/register', \App\Http\Controllers\AuthController::class . '@register');
Route::post('/login', \App\Http\Controllers\AuthController::class . '@login');

Route::get('/articles', \App\Http\Controllers\ArticlesController::class . '@index');
Route::get('/article/{id}', \App\Http\Controllers\ArticlesController::class . '@show');
Route::post('/article', \App\Http\Controllers\ArticlesController::class . '@store');
Route::put('/article/{id}', \App\Http\Controllers\ArticlesController::class . '@update');
Route::delete('/article/{id}', \App\Http\Controllers\ArticlesController::class . '@destroy');


//Route::get('/categories', \App\Http\Controllers\CategoriesController::class . '@list');

