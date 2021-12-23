<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
	Route::post('refresh', [AuthController::class, 'refresh']);

    Route::group(['middleware' => 'jwt.verify'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
      Route::get('user', [AuthController::class, 'getAuthenticatedUser']);
    });
});

Route::group(['prefix' => 'news'], function () {
	Route::group(['middleware' => 'jwt.verify'], function () {
		Route::get('list', [NewsController::class, 'getList']);
		Route::get('detail/{id}', [NewsController::class, 'getDetail']);
	});
});
