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

Route::get('/articles', \App\Http\Controllers\ArticlesController::class . '@index');
Route::post('/article', \App\Http\Controllers\ArticlesController::class . '@store');

Route::get('/categories', \App\Http\Controllers\CategoriesController::class . '@list');
// Route::get('/articles', function(){
//     return 'articles';
// });
